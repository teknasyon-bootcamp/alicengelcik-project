<?php
namespace App\Controller\panel;

use App\Controller\BaseController;
use App\Model\ConfigModel;

class ConfigController extends BaseController{
    public function __construct()
    {
        loginPanelControl();
        AuthController::permissionSet();
        AuthController::permissionControl([99,8]);
    }
    public static function config($get){
        $newsdate=ConfigModel::find(["config_name"=>"news_time"]);
        echo view("PanelConfig",["newsdate"=>$newsdate[0]]);
    }
    public static function savenewsdate(){
        if (isset($_POST["number"])){
            $time=(int) inputCleaner($_POST["number"]);
            $dayyear=(int) inputCleaner($_POST["dayyear"]);//1 day 2 year
            try {
                $update=ConfigModel::update(1,["config_type"=>$dayyear,"config_value"=>$time]);
            } catch (Exception $e) {
                die("Config upate error:" . $e);
            }
            return header("Location:".baseurlpanel()."/config?save=yes");
        }
    }
    public static function savemaintenance(){
        if (isset($_POST["maintenance"]) && $_POST["maintenance"]=="1"){
            if (touch("maintenance.php")){
                return header("Location:".baseurlpanel());
            }
        }
    }
}