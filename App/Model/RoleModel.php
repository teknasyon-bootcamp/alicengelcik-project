<?php
namespace App\Model;

class RoleModel extends BaseModel{
    public function __construct()
    {
    }
    protected static function getTable(): string
    {
        return "roles";
    }
}