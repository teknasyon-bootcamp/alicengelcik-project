<?php
namespace App\Model;

class PermissionModel extends BaseModel{
    public function __construct()
    {
    }
    protected static function getTable(): string
    {
        return "permissions";
    }
}