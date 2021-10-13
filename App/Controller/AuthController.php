<?php
namespace App\Controller;

class AuthController extends BaseController{
    public function __construct()
    {
        loginPanelControl();
    }

    public static function login(){
        session_start();
        $login=$_SESSION["login"]=true;
        $userid=$_SESSION["id"];
        echo view("home");

    }
    /*public static function loginon(){
        echo "Post login";
        if (isset($_POST["test"])){echo "Test post geldi";}
    }*/
}