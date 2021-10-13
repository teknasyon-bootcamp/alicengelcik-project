<?php
namespace App\Model;

class DeleteUserModel extends BaseModel{
    protected static function getTable(): string
    {
        return "user_delete";
    }
    public static function find($values)
    {
        return parent::find($values);
    }
}