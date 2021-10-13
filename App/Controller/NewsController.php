<?php
namespace App\Controller;

use App\Controller\BaseController;
use App\Model\BaseModel;
use App\Model\CommentModel;
use App\Model\NewsModel;

class NewsController extends BaseController{
    public function __construct()
    {
        loginPanelControl();
    }
    public static function index(){
        $news=NewsModel::all();
        echo view("HomeNews",["news"=>$news]);
    }
    public static function newsCategory($id,$sefurl):void{
        //kategoriye göre haber listesi
        $categoryNews=NewsModel::newsCategory($id);
        echo view("NewsCategory",["newsCategory"=>$categoryNews]);
    }
    public static function newsDetail($id,$sefurl){
        $new=NewsModel::find(["id"=>$id]);
        $comments=CommentController::getCommentPublish($id);
        echo view("NewsDetail",["new"=>$new,"comments"=>$comments]);
    }
}