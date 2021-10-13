<?php
namespace App\Controller\panel;
use App\Controller\BaseController;

class MaintenanceController extends BaseController {
    public function __construct()
    {
        //loginPanelControl();
        AuthController::permissionSet();
        AuthController::permissionControl([99,11]);
    }
    public static function maintenanceoff(){
        if (unlink("maintenance.php")){
        return header("Location:".baseurlpanel());
        }
    }
}