<?php
namespace App\Controller\panel;

use App\Controller\BaseController;
use App\Model\CategoryModel;
use App\Model\CommentModel;
use App\Model\NewsModel;

class HomeController extends BaseController{
    public function __construct()
    {
        loginPanelControl();
        AuthController::permissionSet();
        AuthController::permissionControl([99]);
    }
    public function __invoke()
    {

    }

    public static function index(){
        $newsCount=count(NewsModel::all());
        $commentCount=count(CommentModel::all());
        $categoryCount=count(CategoryModel::all());
        echo view("PanelHome",["newsCount"=>$newsCount,"commentCount"=>$commentCount,"categoryCount"=>$categoryCount]);
    }
}