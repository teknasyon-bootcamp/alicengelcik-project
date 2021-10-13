<?php
namespace App\Controller;

use App\Model\LoginModel;

class LoginController extends BaseController{
    public function __construct()
    {
        loginPanelControl();
    }
    public static function index(){
        if (!isset($_SESSION["login"])==true){
        echo view("login");
        }
        else{
            echo header('Location:'.baseurl());
        }
    }
    public function loginon(){
        if (!$_POST){
            header("Location:".loginURL());
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
                $_SESSION["login"]=true;
                $_SESSION["user_id"]=$user_id;
                return header("Location:".baseurl());
                exit;
            }
            else{echo $this->loginfalse();}
        }
        else{
            echo $this->loginfalse();
        }
    }
    }
    public function loginfalse(){
        echo view("login",["false"=>"false"]);
    }
    public function logout(){
        unset($_SESSION["user_id"]);
        unset($_SESSION["id"]);
        unset($_SESSION["login"]);
        return header("Location:".baseurl());
    }
}