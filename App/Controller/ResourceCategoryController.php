<?php
namespace App\Controller;

use App\Model\ResourceCategoryModel;

class ResourceCategoryController extends BaseController{
    public function __construct()
    {
        loginPanelControl();
        return loginControl();
    }
    public static function saveUserCategory(){
        $usercategory=$_POST["usercategory"];
        $user_id=$_SESSION["user_id"];
        //user category ilk silip tekrar hepsini ekleyeceğiz
            $delete=ResourceCategoryModel::delete(["resource_id"=>$user_id,"resource"=>"follow"]);
        if ($delete==true) {
            if ($usercategory != null) {
                //insert
                foreach ($usercategory as $userCat) {
                    $resourceCategoryAdd = ResourceCategoryModel::add([
                        "category_id" => $userCat,
                        "resource_id" => $user_id,
                        "resource"=>"follow",]);

                }
            }
        }
        $link=getLinkCleaner(prevURL(),"?");
        return header("Location:".$link."?userfollow=change&userCategorySave=true");
        }
}