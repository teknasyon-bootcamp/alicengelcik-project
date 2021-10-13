<?php
namespace App\Model;

class NewsModel extends BaseModel
{
    protected static function getTable():string
    {
        return "news";
    }
    public static function find($values){
        return parent::find($values);
    }
    public static function add($values)
    {
        return parent::add($values);
    }
    public static function all()
    {
        return parent::all();
    }
}