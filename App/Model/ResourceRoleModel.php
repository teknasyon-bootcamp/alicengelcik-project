<?php
namespace App\Model;

class ResourceRoleModel extends BaseModel{
    public function __construct()
    {
    }
    protected static function getTable(): string
    {
        return "resource_role";
    }
}