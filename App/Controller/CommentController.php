<?php
namespace App\Controller;

use App\Controller\BaseController;
use App\Model\CommentModel;

class CommentController extends BaseController{
    public function __construct()
    {
        loginPanelControl();
        return loginControl();
    }

    public static function getCommentPublish($newid):array{
        $comment=CommentModel::find(["new_id"=>$newid,"status"=>2]);
        //status1=Onay bekliyor-status2=Yayınlandı-status3=Reddedildi
        return $comment;
    }
    public function addComment(){
        //1 name 2 anonim
        $user_id=$_SESSION["user_id"];
        $nameoption=$_POST["name"];//1-name 2-anonim
        $comment= inputCleaner($_POST["comment"]);
        $new_id=(int) $_POST["new_id"];
        $addcomment=CommentModel::add([
            "new_id"=>$new_id,
            "user_id"=>$user_id,
            "anonymous"=>$nameoption,
            "comment"=>$comment,
            "status"=>1,
        ]);
        $base=baseurl();
        return header("Location:".$base."user/user");
    }
}