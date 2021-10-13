<?php
namespace App\Controller;

use App\Controller\BaseController;
use App\Model\NewsModel;


class HomeController extends BaseController{

    public function __construct()
{
    loginPanelControl();
}
    public static function index(){
        $news=NewsModel::all();
        echo view("home");
    }
}