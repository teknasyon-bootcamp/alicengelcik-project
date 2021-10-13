<?php
namespace App\Controller;

use App\Model\NewsModel;

class APIController extends BaseController{
    public function __construct()
    {
    }
    public static function getAllNews(){
        $allNews=NewsModel::all();
        echo view("API",["allNews"=>$allNews]);
    }
}