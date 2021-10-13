<?php
namespace App\Model;

class NewsViewModel extends BaseModel{
    public function __construct()
    {
    }
    protected static function getTable(): string
    {
        return "news_view";
    }
}