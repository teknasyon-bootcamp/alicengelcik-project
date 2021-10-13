<?php
namespace App\Controller\panel;

use App\Controller\BaseController;
use App\Model\CommentModel;

class CommentController extends BaseController{
    public function __construct()
    {
        loginPanelControl();
        AuthController::permissionSet();
        AuthController::permissionControl([99,2]);
    }

    public static function commentlist($status){

        if (isset($_GET["status"]) && $_GET["status"]){
            $status=$_GET["status"];
            switch ($_GET["status"]){
                case 1:
                    $comments=\App\Model\CommentModel::find(["status"=>1]);
                    break;
                case 2:
                    $comments=\App\Model\CommentModel::find(["status"=>2]);
                    break;
                case 3:
                    $comments=\App\Model\CommentModel::find(["status"=>3]);
                    break;
                default:
                    $comments=\App\Model\CommentModel::find(["status"=>1]);
            }
            echo view("PanelCommentList",["comments"=>$comments]);
        }else{
        $comments=\App\Model\CommentModel::find(["status"=>1]);
        echo view("PanelCommentList",["comments"=>$comments]);
        }
    }
    public function commentdelete($id){
        echo getMethodCsrfToken();
        if ($id){
            try {
                $deletecomment=CommentModel::delete(["id"=>$id]);
            }
            catch (Exception $e){
                die("Delete comment error".$e);
            }

            return header("Location:".baseurlpanel()."/commentlist");
        }
    }
    public function savestatus(){
        if ($_POST){
            $comments_id=$_POST["comment_id"];
            $comments_status=$_POST["commentstatus"];
            foreach ($comments_id as  $row=>$com_id){
                try {
                    $commentupdate=CommentModel::update($com_id,["status"=>$comments_status[$row]]);

                }catch (Exception $e){
                    die("Comment update error".$e);
                }
                }
            return header("Location:".baseurlpanel()."/commentlist");
        }
    }
}