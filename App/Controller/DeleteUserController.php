<?php
namespace App\Controller;

use App\Model\DeleteUserModel;

class DeleteUserController extends BaseController{
    public function __construct()
    {
        loginPanelControl();
        return loginControl();
    }
    public function requestdelete(){
        $confirm=(string) $_POST["confirm"];
        $desc=(string) $_POST["why"];
        $user_id=$_SESSION["user_id"];
        $userInfo=getUserInfo($user_id)[0];
        $name=$userInfo["name"]." ".$userInfo["surname"];
        $email=$userInfo["email"];
        $gender=$userInfo["gender"];
        $prevlink=getLinkCleaner($_SERVER['HTTP_REFERER'],"?");
        if (isset($confirm)){
            if ($confirm=="1"){
                if ($_POST["user_id"]==$_SESSION["user_id"]){
                    $addRequest=DeleteUserModel::add([
                        "name"=>$name,
                        "email"=>$email,
                        "gender"=>$gender,
                        "user_id"=>$user_id,
                        "status"=>1,
                        "description"=>$desc,
                    ]);
                    return header("Location:".$prevlink."?deleteuser=yes");
                }
                else{
                    return header("Location:".$prevlink."?delete=user");
                }
            }
        }
        return header("Location:".$prevlink."?delete=user");
    }
    public static function cancel(){
        $user_id=$_SESSION["user_id"];
        $delrequest=DeleteUserModel::delete(["user_id"=>$user_id]);
        $prev=prevURL();
        return header("Location:".$prev);
    }
}