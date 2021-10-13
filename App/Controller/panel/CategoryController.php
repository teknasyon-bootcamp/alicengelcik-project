<?php
namespace App\Controller\panel;

use App\Controller\BaseController;
use App\Model\CategoryModel;
use App\Model\NewsModel;
use App\Model\ResourceCategoryModel;
use Cassandra\Varint;

class CategoryController extends BaseController{
    public function __construct()
    {
        loginPanelControl();
        AuthController::permissionSet();
        AuthController::permissionControl([99,14]);
    }
    public static function addcategory(){
        if (isset($_POST["categorynew"])){
            $category=strtoupper(inputCleaner($_POST["categorynew"]));
            try {
                $add=CategoryModel::add(["category"=>$category]);
            }catch (Exception $e){die("NewCategory add error".$e);}
            return header("Location:".baseurlpanel()."/categorylist");
        }
        else{
        echo view("PanelAddCategory");
        }
    }
    public static function categorylist($get){
        $userCatId=getUserCategory();
        $allCategory=CategoryModel::all();
        echo view("PanelCategoryList",["category"=>$allCategory,"userCategory"=>$userCatId]);
    }
    public static function editcategory($id){
        $userCat=getUserCategory();
        if (in_array($id,$userCat)){
        try {
            $category=CategoryModel::find(["id"=>$id]);
            if (!$category){
                return header("Location:".baseurlpanel()."/categorylist");
            }
            else{
                echo view("PanelEditCategory",["category"=>$category[0]]);
            }
        }
        catch (Exception $e){
            die("Editcategory find error".$e);
        }
        }else{
            echo view("PanelLogin",["fail"=>403]);// failMessage(403);
        }
    }
    public static function categoryupdate(){
        if (isset($_POST["category"])){
            $category=strtoupper(inputCleaner($_POST["category"]));
            $category_id=(int) $_POST["category_id"];
            try {
                $update=CategoryModel::update($category_id,["category"=>$category]);
            }
            catch (Exception $e){die("Category update error".$e);}
            return header("Location:".baseurlpanel()."/categorylist");
        }
        else{
            echo view("PanelAddCategory");
        }
    }
public static function deletecategory($id){
        echo getMethodCsrfToken();
        try {
            $categorynews=ResourceCategoryModel::find(["category_id"=>$id,"resource"=>"news"]);
        }catch (Exception $e){
            die("Category delete error".$e);
        }
        if ($categorynews){
            return header("Location:".baseurlpanel()."/categorylist?news=yes");
        }else{
            $categorydelete=CategoryModel::delete(["id"=>$id]);
        }
        return header("Location:".baseurlpanel()."/categorylist");
    }
}