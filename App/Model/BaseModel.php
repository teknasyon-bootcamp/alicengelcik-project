<?php
namespace App\Model;

use App\Database;

abstract class BaseModel{
    protected abstract static function getTable():string;

    public static function all(){
        return Database::getInstance()->select(static::getTable());
    }
    public static function find($values){
        return Database::getInstance()->find(static::getTable(),$values);
    }
    public static function findUserInfo($values){
        return Database::getInstance()->findUserInfo(static::getTable(),$values);
    }
    public static function newsCategory($id){
        return Database::getInstance()->newsCategory($id);
    }
    public static function delete($values){
        return Database::getInstance()->delete(static::getTable(),$values);
    }
    public static function add($values){
        return Database::getInstance()->add(static::getTable(),$values);
    }
    public static function update($id,$values){
        return Database::getInstance()->update(static::getTable(),$id,$values);
    }
    public static function UserRole(){
        return Database::getInstance()->UserRole();
    }
    public static function Columnfind($table,$columns){
        return Database::getInstance()->Columnfind(static::getTable(),$columns);
    }
}