<?php
namespace App\Controller\panel;

use App\Controller\BaseController;
use App\Model\AccountModel;
use App\Model\BaseModel;
use App\Model\CommentModel;
use App\Model\ResourceCategoryModel;
use App\Model\ResourceRoleModel;
use App\Model\UserModel;
use http\Exception\RuntimeException;

class AccountController extends BaseController
{
    public function __construct()
    {
        loginPanelControl();
        AuthController::permissionSet();
        AuthController::permissionControl([99,3]);
    }

    public static function accountmanage($status)
    {
        if (isset($_GET["status"]) && $_GET["status"]) {
            $status =(int) inputCleaner($_GET["status"]);
            switch ($status) {
                case 1:
                    $account = AccountModel::find(["status" => 1]);
                    break;
                case 2:
                    $account = AccountModel::find(["status" => 2]);
                    break;
                case 3:
                    $account = AccountModel::find(["status" => 3]);
                    break;
                default:
                    $account = AccountModel::find(["status" => 1]);
            }
            echo view("PanelAccount", ["accountList" => $account]);
        } else {
            $account = AccountModel::find(["status" => 1]);
            echo view("PanelAccount", ["accountList" => $account]);
        }
    }

    public static function accountsavestatus()
    {
        if ($_POST["accountstatus"]) {
            $accountstatus = $_POST["accountstatus"];
            $user_delete_id = $_POST["user_delete_id"];
            foreach ($accountstatus as $row => $as) {
                try {
                    $user_id =  AccountModel::find(["id" => $user_delete_id[$row]])[0]["user_id"];
                } catch (ErrorException $e) {
                    die("AccoundModel find error" . $e);
                }
                try {
                    if ($as==2){
                        //kalıcı hesap silme işlemleri resource_category,resource_role,comments,users
                        try {
                            $resourcedelete=ResourceCategoryModel::delete(["resource_id"=>$user_id,"resource"=>"follow"]);
                        }catch (Exception $e){die("ResourceCategory delete error".$e);}
                        try {
                            $resourceroledelete=ResourceRoleModel::delete(["resource_id"=>$user_id,"resource"=>"user"]);
                        }catch (Exception $e){die("ResourceRole delete error".$e);}
                        try {
                            $commentsdelete=CommentModel::delete(["user_id"=>$user_id]);
                        }catch (Exception $e){die("Comments delete error".$e);}
                        try {
                            $usersdelete=UserModel::delete(["id"=>$user_id]);
                        }catch (Exception $e){die("Users delete error".$e);}
                        $update = AccountModel::update($user_delete_id[$row], ["status" => $as, "confirm_user_id" => $_SESSION["panel_user_id"]]);
                        session_start();
                        session_destroy();
                    }else{
                        $update = AccountModel::update($user_delete_id[$row], ["status" => $as, "confirm_user_id" => $_SESSION["panel_user_id"]]);
                    }
                }catch (Exception $e){
                    die("Account Update and delete error:".$e);
                }
            }
            //Important!

            return header("Location:".baseurlpanel()."/accountmanage");
        }
    }
}