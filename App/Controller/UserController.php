<?php
namespace App\Controller;
use App\DeleteUserModel;
use App\Model\CommentModel;
use App\Model\UserModel;

class UserController extends BaseController{
    public function __construct()
    {
        loginPanelControl();
        return loginControl();
    }
    public function index($sef){
        $user_id=$_SESSION["user_id"];
        $userInfo=getUserInfo($user_id);
        $usercomments=CommentModel::find(["user_id"=>$user_id]);//onaylanan kullanıcı yorumlarını alıyoruz
        $deleteuser=\App\Model\DeleteUserModel::find(["user_id"=>$user_id]);
        $userfollowcategory=\App\Model\ResourceCategoryModel::find(["resource"=>"follow","resource_id"=>$user_id]);
        $usernews=\App\Model\NewsViewModel::find(["user_id"=>$_SESSION["user_id"]]);

        echo view("user",["userNews"=>$usernews,"userInfo"=>$userInfo,"userComments"=>$usercomments,"userCategory"=>$userfollowcategory,"deleteInfo"=>$deleteuser]);
        }
}