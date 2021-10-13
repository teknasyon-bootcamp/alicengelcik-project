<?php
namespace App\Model;

use App\Model\BaseModel;

class ResourceCategoryModel extends BaseModel{
    public function __construct()
    {
        loginPanelControl();
        return loginControl();
    }
    protected static function getTable(): string
    {
       return "resource_category";
    }
}