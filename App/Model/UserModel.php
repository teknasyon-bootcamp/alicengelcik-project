<?php
namespace App\Model;

class UserModel extends BaseModel{

    protected static function getTable(): string
    {
        return "users";
    }
    protected static function getUserInfo($values){
        return $values;
    }
}