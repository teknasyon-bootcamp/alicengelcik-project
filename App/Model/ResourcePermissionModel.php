<?php
namespace App\Model;

class ResourcePermissionModel extends BaseModel{
    public function __construct()
    {
    }
    protected static function getTable(): string
    {
        return "resource_permission";
    }
}