<?php
namespace App\Controller;

use App\Model\CategoryModel;

class CategoryController extends BaseController{
    public function __construct()
    {
        loginPanelControl();
        return loginControl();
    }

    public static function getAllCategory():array{
        return CategoryModel::all();
    }
}