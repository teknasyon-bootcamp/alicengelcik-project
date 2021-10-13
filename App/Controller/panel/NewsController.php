<?php
namespace App\Controller\panel;

use App\Controller\BaseController;
use App\Model\BaseModel;
use App\Model\CategoryModel;
use App\Model\NewsModel;
use App\Model\ResourceCategoryModel;

class NewsController extends BaseController{
    public function __construct()
    {
        loginPanelControl();
        AuthController::permissionSet();
        AuthController::permissionControl([99,1]);
    }
    public function addnews(){
        echo view("PanelAddNews");
    }
    public function newslist(){
        $allNews=\App\Model\NewsModel::all();
        echo view("PanelNewlist",["allNews"=>$allNews]);
    }
    public function newsdelete($id){
        echo getMethodCsrfToken();
        $news_id=(int) $id;
        $img=NewsModel::find(["id"=>$id])[0]["image"];
        $resource_id=getResourceCategory($news_id,"news")[0]["id"];
        try {
            $delete=NewsModel::delete(["id"=>$id]);
            unlink("assets/img/news/".$img);
            $delete_resource=ResourceCategoryModel::delete(["id"=>$resource_id]);
        }catch (Exception $e){
            die("Delete query error<br>".$e);
        }
        return header("Location:".baseurlpanel()."/newslist");
    }

    public function savenews(){
        if ($_POST){
            $header=inputCleaner($_POST["newsheader"]);
            $content=inputCleaner($_POST["content"]);
            $category_id=$_POST["categoryid"];
            $image=$_FILES["newsimg"];
            $imgupload=BaseController::imageUpload($image);
            //$user_id=$_SESSION["panel_userid"];
            try {
                $addnews= NewsModel::add([
                    "header"=>$header,
                    "content"=>$content,
                    "image"=>$imgupload,
                    "user_id"=>$_SESSION["panel_user_id"],
                ]);
                try {
                    $resourceadd=ResourceCategoryModel::add(
                        ["category_id"=>$category_id,
                        "resource_id"=>$addnews,
                        "resource"=>"news",]
                    );
                }
                catch (\Exception $e){
                    die("ResourceCategoryAdd Error: ".$e);
                }
                return header("Location:".baseurlpanel()."/newslist");
            }catch (Exception $e){
                die("News Add Error:<br>".$e);
            }

        }
    }
public static function newsEdit($id)
{
    $news=\App\Model\NewsModel::find(["id"=>$id]);
    if (isset($id) && count($news)>0){
    $userCategory=ResourceCategoryModel::find(["resource_id"=>$_SESSION["panel_user_id"],"resource"=>"user"]);
    $userCategoryID=[];
    foreach ($userCategory as $row=> $uc){
        $userCategoryID+=[$row=>$uc["category_id"]];
    }
    $newCategory=ResourceCategoryModel::find(["resource_id"=>$id,"resource"=>"news"]);
    if (in_array($newCategory[0]["category_id"],$userCategoryID)){
        $news=\App\Model\NewsModel::find(["id"=>$id]);
        echo view("PanelEditNews",["news"=>$news]);
    }else{
        //echo view("PanelLogin",["fail"=>"loginFail"]);
        //exit();
    }
    }else{
        return header("Location:".baseurlpanel());
    }
}
public static function newsupdate(){
    if (isset($_POST["news_id"])){
        $news_id=(int) $_POST["news_id"];
        $header=inputCleaner($_POST["newsheader"]);
        $content=inputCleaner($_POST["content"]);
        $category_id=(int) $_POST["categoryid"];
        $image=$_FILES["newsimg"];
        if ($_FILES["newsimg"]["name"]!=null){
            $image=$_FILES["newsimg"];
            $oldimg=getNewsInfo($news_id)[0]["image"];
            $imgupload=BaseController::imageUpload($image);
            unlink("assets/img/news/".$oldimg);
            try {
                $updatenews = \App\Model\NewsModel::update($news_id, [
                    "header" => $header,
                    "content" => $content,
                    "image" => $imgupload,
                    "update_user_id" => $_SESSION["panel_user_id"],
                ]);
            }catch (Exception $e){
                die("Update image & news error:<br>".$e);
            }
        }
        else {
            try {
                $updatenews = \App\Model\NewsModel::update($news_id, [
                    "header" => $header,
                    "content" => $content,
                    "update_user_id" => $_SESSION["panel_user_id"],
                ]);
            }catch (Exception $e){
                die("Update news (no image) error:<br>".$e);
            }
        }
        if ($updatenews){
            //news category update
            try {
                $resoruce_query=ResourceCategoryModel::find(["resource_id"=>$news_id,"resource"=>"news"]);
                $resoruce_category_id=$resoruce_query[0]["id"];
                $categoryupdate=\App\Model\ResourceCategoryModel::update($resoruce_category_id,["category_id"=>$category_id]);
            }
            catch (Exception $e){
                die("Update newsCategory error:<br>".$e);
            }
            return header("Location:".baseurlpanel()."/newslist");
        }
        else{
            die("Resource update error!");
        }
    }
}

}