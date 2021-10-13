<?php
namespace App\Controller\panel;

use App\Controller\BaseController;
use App\Model\LoginModel;

class LoginController extends BaseController{
    public function __construct()
    {
        loginPanelControl();
    }
    public static function login(){
        if (!isset($_SESSION["panel_user_id"])){
            echo view("PanelLogin");
        }else{
            return header("Location:".baseurlpanel());
        }
    }
    public static function loginon(){
        if (!$_POST){
            header("Location:".loginPanelURL());
        }else{
            $email=inputCleaner($_POST["email"]);
            $password=$_POST["password"];
            $text = strip_tags($password);
            $content = preg_replace("/&#?[a-z0-9]{2,8};/i","",$text );
            $request=LoginModel::find(["email"=>$email]);
            //gelen mail users tablosunda var mı kontrol ediliyor. Varsa o kullanıcıya ait parolaya ulaşılıyor.
            //password_verify ile parola kontrolü yapılıyor.
            if ($request){
                $user_id=$request[0]["id"];
                $result=password_verify($password,$request[0]["password"]);
                if ($result){
                    $_SESSION["panel_login"]=true;
                    $_SESSION["panel_user_id"]=$user_id;

                    return header("Location:".baseurlpanel());
                    exit;
                }
                else{
                    echo view("PanelLogin",["fail"=>"loginFail"]);
                    exit();
                }
            }
            else{
                echo view("PanelLogin",["fail"=>"loginFail"]);
                exit();
            }
        }
}
    public static function logout(){
        //session_destroy();
        unset($_SESSION["panel_user_id"]);
        unset($_SESSION["roleLevel"]);
        unset($_SESSION["rolePerm"]);
        unset($_SESSION["panel_login"]);
        return header("Location:".loginPanelURL());
    }
}