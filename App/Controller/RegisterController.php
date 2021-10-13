<?php
namespace App\Controller;

use App\Model\ResourceRoleModel;
use App\Model\UserModel;
use http\Client\Curl\User;

class RegisterController extends BaseController{
    public function __construct()
    {
        loginPanelControl();
    }

    public static function index(){
        echo view("register");
    }
    public static function registersave(){
        $gender=inputCleaner($_POST["gender"]);
        $name=inputCleaner($_POST["name"]);
        $surname=inputCleaner($_POST["surname"]);
        $email=inputCleaner($_POST["email"]);
        $passwordPost=inputCleaner($_POST["password"]);
        $password=password_hash($passwordPost, PASSWORD_DEFAULT);
        $email_find=UserModel::find(["email"=>$email]);
        if (!$email_find){
            if ($gender==1){
                $image="user_male.png";
            }elseif ($gender==2) {
                $image = "user_female.png";
            }

            $add=UserModel::add([
                "name"=>$name,
                "surname"=>$surname,
                "gender"=>$gender,
                "email"=>$email,
                "password"=>$password,
                "image"=>$image,
            ]);
            $userIdFind=UserModel::find(["email"=>$email])[0]["id"];
            $userRoleAdd=ResourceRoleModel::add([
                "role_id"=>"4",
                "resource_id"=>$userIdFind,
                "resource"=>"user",
            ]);
            echo view("register",["register"=>"yes"]);
        }else{
            echo view("register",["fail"=>"registerFail"]);
            exit();
        }
    }
}