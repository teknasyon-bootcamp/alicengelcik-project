<?php
namespace App;

use Cassandra\Varint;
use Exception;
use PDO;
use PDOException;

class Database extends Singleton{
    public PDO $pdo;
    public $test;
    public function initialize(string $host,?string $user=null,?string $password=null,string $dbname="test"):void{
        try {
            $this->pdo=new PDO("mysql:host={$host};dbname={$dbname}",$user,$password);
        }
        catch (Exception $e){
            die("DB Connection Error");
        }
        catch (PDOException $e){
            die("PDO Database error!");
        }

    }
    public function select($table):array{
        try {
            return $this->pdo->query("select * from {$table}")->fetchAll(PDO::FETCH_ASSOC);
        }catch (PDOException $e){
            die("{$table} Table Select Query Error".$e);
        }
    }
    public function selectColumn($columns,$table):array{
        try {
            return $this->pdo->query("select $columns/*news.id,news.header,news.image,news.created_at*/  from news")->fetchAll(PDO::FETCH_ASSOC);
        }catch (PDOException $e){
            die("{$table} Table Select Query Error".$e);
        }
    }
    public function find($table,$values):array {
        try {
            $whereSerialize = QuerySerialize($values,'where');
            $query = "SELECT * FROM $table WHERE $whereSerialize";
            $statement = $this->pdo->prepare($query);
            foreach ($values as $param => $value) {
                $statement->bindValue(":$param", $value);
            }
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }catch (PDOException $e){
            die("{$table} Table Find Query Error".$e);
        }
    }
    public function delete($table,$values) {
        try {
            $whereSerialize = QuerySerialize($values,'where');
            $query = "delete FROM $table WHERE $whereSerialize";
            $statement = $this->pdo->prepare($query);
            foreach ($values as $param => $value) {
                $statement->bindValue(":$param", $value);
            }
            $statement->execute();
            return true;
        }catch (PDOException $e){
            die("{$table} Table Delete Query Error".$e);
        }
    }
    public function add($table,$values) {
        try {
            $columnSerialize = QuerySerialize($values,'column');
            $valuesSerialize = QuerySerialize($values,'value');
            $query = "INSERT INTO $table($columnSerialize) values($valuesSerialize)";
            $statement = $this->pdo->prepare($query);

            foreach ($values as $param => $value) {
                $statement->bindValue(":$param", $value);
            }
            $result = $statement->execute();
            $lastId=$this->pdo->lastInsertId();
            return $lastId;
        }catch (PDOException $e){
            die("{$table} Table Add Query Error".$e);
        }
    }
    public function findUserInfo($table,$values):array{
        //password array ile gelmemesi için ayrı method hazırlanıp sütun ismiyle çağırdım
        try {
            $whereSerialize = QuerySerialize($values,'where');
            $query = "SELECT users.id,users.name,users.surname,users.email,users.image,users.gender FROM $table WHERE $whereSerialize";
            $statement = $this->pdo->prepare($query);
            foreach ($values as $param => $value) {
                $statement->bindValue(":$param", $value);
            }
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }catch (PDOException $e){
            die("{$table} Table Query Error".$e);
        }
    }
    public function newsCategory($id):array{
        try {
            $id=(int) $id;
            $query = "SELECT c.category,n.* FROM news n,category c,resource_category rc WHERE c.id={$id} and n.id=rc.resource_id and c.id=rc.category_id and rc.resource='news'";
            $statement = $this->pdo->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }catch (PDOException $e){
            die("Table FindSelect Query Error".$e);
        }
    }
    public function userRole():array{
        try {
            $query = "SELECT rr.id as resource_id,u.id as user_id,u.name,u.surname,u.email,rr.role_id FROM users u,resource_role rr WHERE u.id=rr.resource_id and rr.resource='user'";
            $statement = $this->pdo->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        }catch (PDOException $e){
            die("Table UserRole query error".$e);
        }
    }
    public function update($table,$id,array $values): bool
    {
        try {
            $setSerialize = QuerySerialize($values,'set');
            $query = "UPDATE $table SET $setSerialize WHERE id=:id";
            $statement = $this->pdo->prepare($query);
            foreach ($values as $param => $value) {
                $statement->bindValue(":$param", $value);
            }
            $statement->bindValue(":id", $id);
            $result = $statement->execute();
            //$this->pdo->rollBack();
            return $result;
        }catch (Exception $e){
            die($table." table update error".$e);
        }
    }
}