<?php
namespace App\Controller\panel;

use App\Controller\BaseController;
use App\Controller\ResourceCategoryController;
use App\Model\PermissionModel;
use App\Model\ResourceCategoryModel;
use App\Model\ResourcePermissionModel;
use App\Model\ResourceRoleModel;
use App\Model\RoleModel;
use App\Model\UserModel;

class AuthController extends BaseController
{
    public function __construct()
    {
        loginPanelControl();
        static::permissionSet();
        static::permissionControl([99,7]);
    }
    public static function permissionSet(){
        if (!isset($_SESSION["rolePerm"]) || !isset($_SESSION["roleLevel"])) {
            if (isset($_SESSION["panel_user_id"])) {
                //rol ve izin ataması yapan method
                $user_id = (int)$_SESSION["panel_user_id"];
                $role = ResourceRoleModel::find(["resource_id" => $user_id, "resource" => "user"])[0];//kullanıcının rolüne ulaştık
                $role_id = $role["role_id"];
                $roleLevel = RoleModel::find(["id" => $role_id])[0]["level"];
                if ($role) {//role varsa
                    $allPermList = [];
                    $userPermList = [];
                    if (self::isAdmin($role, $roleLevel)) {//admin mi
                        $allPermission = PermissionModel::all();
                        foreach ($allPermission as $row => $allperm) {
                            $allPermList += [$row => $allperm["id"]];
                        }
                        $_SESSION["rolePerm"] = $allPermList;
                        $_SESSION["roleLevel"] = 1;
                    } else {
                        //giriş yapan kullanıcı admin değilse rolüne ait izinler session'a atanacak.
                        //Bir sayfaya girmeye çalıştığındna Controller ve menü kısmında bu sessiondan veri alınıp kontrol edilecek
                        $rolePermission = ResourcePermissionModel::find(["resource_id" => $role_id, "resource" => "role"]);
                        foreach ($rolePermission as $row => $userperm) {
                            $userPermList += [$row => $userperm["permission_id"]];
                        }
                        $_SESSION["rolePerm"] = $userPermList;
                        $_SESSION["roleLevel"] = $roleLevel;
                    }
                }
            } else {
                return header("Location:" . loginPanelURL());
            }
        }
    }
    public static function permissionControl(array $pagePermissions,string $perParam="page"){
        if (isset($_SESSION["rolePerm"])){
                  $sumPerm=0;
                foreach($pagePermissions as $perm){
                if (in_array($perm,$_SESSION["rolePerm"])){
                    $sumPerm=$sumPerm+1;
                }
                }
                 if($sumPerm==count($pagePermissions)){return true;}
                     else{
                         if ($perParam=="page"){
                         unset($_SESSION["panel_user_id"]);
                         unset($_SESSION["rolePerm"]);
                         unset($_SESSION["roleLevel"]);
                         echo view("PanelLogin",["fail"=>"403"]);
                         exit();
                         }elseif($perParam=="menu"){
                             return false;
                         }
                     }
                }else{
            return self::permissionSet();
        }
    }
    public static function isAdmin($role,$roleLevel){
        //admin ise her halukarda tüm izinlere sahip olacak
        $role_id=$role["id"];
        if ($role_id==1 && $roleLevel==1){
            return true;
        }else{return false;}
    }
    public static function rolepermission()
    {
            $roles = RoleModel::all();
        echo view("PanelRolePermission", ["roles" => $roles]);
    }
    public static function rolepermissionedit($role_id)
    {
        //if (self::permissionControl([7],"menu")) {
            $role_id = (int)$role_id;
            if (is_int($role_id)) {
                $role = RoleModel::find(["id" => $role_id]);
                $editRoleLevel=$role[0]["level"];
                if (($_SESSION["roleLevel"]<$editRoleLevel) || $_SESSION["roleLevel"]==1){
                if ($role) {
                    $rolePerm = ResourcePermissionModel::find(["resource" => "role", "resource_id" => $role_id]);
                    $permisions = PermissionModel::all();
                    echo view("PanelRolePermissionEdit", ["role_id" => $role_id, "rolePerm" => $rolePerm, "permissions" => $permisions]);
                } else {
                    return header("Location:" . baseurlpanel() . "/rolepermission");
                }
                }else {
                    echo view("panelLogin",["fail"=>"loginFalse"]);
                    exit();
                }
            } else {
                return header("Location:" . baseurlpanel() . "/rolepermission");
            }
        }
    public static function saverolepermission()
    {
        $permList = $_POST["permission_id"];
        $role_id = $_POST["role_id"];
        try {
            $permDelete = ResourcePermissionModel::delete(["resource_id" => $role_id, "resource" => "role"]);
        } catch (Exception $e) {
            die("Permission delete error" . $e);
        }
        if ($permDelete) {
            try {
                foreach ($permList as $perm) {
                    $perAdd = ResourcePermissionModel::add([
                        "permission_id" => $perm,
                        "resource_id" => $role_id,
                        "resource" => "role"]);
                }
            } catch (Exception $e) {
                die("ResourcePermission add error" . $e);
            }
        }
        return header("Location:" . baseurlpanel() . "/role/permission/" . $role_id . "?save=yes");
    }



    public static function userroles($get)
    {
        $allUsersRole = UserModel::UserRole();
        $allRoles = RoleModel::all();
        echo view("PanelUserRoles", ["userRole" => $allUsersRole, "roles" => $allRoles]);
    }
    public static function saveuserrole(){
        if (isset($_POST["userrole_id"])){
            $postResourceRoleId=$_POST["resource_role_id"];
            $postRoleId=$_POST["userrole_id"];
            foreach ($postRoleId as $row=> $ur){
                try {
                    $updateUserRole=ResourceRoleModel::update($postResourceRoleId[$row],[
                        "role_id"=>$ur,
                    ]);
                }catch (Exception $e){
                    die("ResourceRole update error: ".$e);
                }
            }
            }
            return header("Location:".baseurlpanel()."/userroles?save=yes");
        }
    public static function usercategory()
    {
        //password hariç users tablosunu çekmek için 0=0
        $users = UserModel::findUserInfo(["0" => "0"]);
        echo view("PanelUserCategory", ["users" => $users]);
    }

    public static function editusercategory($user_id)
    {
        $user_id = (int)$user_id;
        $userRoleId=\App\Model\ResourceRoleModel::find(["resource_id"=>$user_id])[0]["role_id"];
        $userRoleLevel=getRoleLevel($userRoleId);
        $userInfo = getUserInfo($user_id);

        if (($_SESSION["roleLevel"]<$userRoleLevel) || $_SESSION["roleLevel"]==1) {
            if (is_int($user_id) && $userInfo) {
                $user_category = ResourceCategoryModel::find(["resource_id" => $user_id, "resource" => "user"]);
                echo view("PanelUserCategoryEdit", ["userCategory" => $user_category, "userInfoCategory" => $userInfo]);
            } else {
                return header("Location:" . baseurlpanel() . "/usercategory");
            }
        }else{
            echo view("PanelLogin",["fail"=>403]);
            exit();
        }
    }

    public static function panelsaveusercategory()
    {
        $postUserId = (int)$_POST["user_id"];
        if ($_POST["categoryid"]) {
            $postCategory = $_POST["categoryid"];
            try {
                $deleteResourceCategory = ResourceCategoryModel::delete(["resource_id" => $postUserId, "resource" => "user"]);
            } catch (Exception $e) {
                die("Resorucecategory delete error" . $e);
            }

            if ($deleteResourceCategory) {
                foreach ($postCategory as $pc) {
                    try {
                        $addResourceCategory = ResourceCategoryModel::add([
                            "category_id" => $pc,
                            "resource_id" => $postUserId,
                            "resource" => "user",
                        ]);
                    } catch (Exception $e) {
                        die("Add resourceCategory error" . $e);
                    }
                }
            } else {
                return header("Location:" . baseurlpanel() . "/usercategory/edit/" . $postUserId);
            }
            return header("Location:" . baseurlpanel() . "/usercategory/edit/" . $postUserId . "?save=yes");
        } else {
            try {
                $deleteResourceCategory = ResourceCategoryModel::delete(["resource_id" => $postUserId, "resource" => "user"]);
                return header("Location:" . baseurlpanel() . "/usercategory/edit/" . $postUserId . "?save=yes");
            } catch (Exception $e) {
                die("Resorucecategory delete error" . $e);
            }
        }
    }
}