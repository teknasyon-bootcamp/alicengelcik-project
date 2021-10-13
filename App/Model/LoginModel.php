<?php
namespace App\Model;

class LoginModel extends BaseModel{
    protected static function getTable(): string
    {
        return "users";
    }
    public static function find($values){
        return parent::find($values);
    }
}