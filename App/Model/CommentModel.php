<?php
namespace App\Model;

class CommentModel extends BaseModel{
    public static function getTable(): string
    {
        return "comments";
    }
    public static function find($values)
    {
        return parent::find($values);
    }
}