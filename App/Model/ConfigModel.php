<?php
namespace App\Model;

class ConfigModel extends BaseModel{
    public function __construct()
    {
    }
    protected static function getTable(): string
    {
        return "config";
    }
}