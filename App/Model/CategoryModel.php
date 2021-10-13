<?php
namespace App\Model;

class CategoryModel extends BaseModel{
    public static function getTable(): string
    {
       return "category";
    }
}