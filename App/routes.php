<?php

namespace App\Controller;

use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Loader\Configurator\RouteConfigurator;


$routes=new RouteCollection;
$panellink="/admin";

$routes->add("Site_HomePage", new Route("/",["controller"=>NewsController::class,"method"=>"index"]));
$routes->add("Site_News_Category", new Route("/news/{id}/{sefurl}",["controller"=>NewsController::class,"method"=>"newsCategory"]));
$routes->add("Site_News_Detail", new Route("/news/details/{id}/{sefurl}",["controller"=>NewsController::class,"method"=>"newsDetail"]));
$routes->add("Site_Login", new Route("/login",["controller"=>LoginController::class,"method"=>"index"]));
$routes->add("Site_LoginOn", new Route("/loginon",["controller"=>LoginController::class,"method"=>"loginon"]));
$routes->add("Site_LogOut", new Route("/logout",["controller"=>LoginController::class,"method"=>"logout"]));
$routes->add("Site_Register", new Route("/register",["controller"=>RegisterController::class,"method"=>"index"]));
$routes->add("Site_RegisterSave", new Route("/registersave",["controller"=>RegisterController::class,"method"=>"registersave"]));
$routes->add("Site_User", new Route("/user/{sef}",["controller"=>UserController::class,"method"=>"index"]));
$routes->add("DeleteAccount", new Route("/deleteaccount",["controller"=>DeleteUserController::class,"method"=>"requestdelete"]));
$routes->add("CancelDeleteAccount", new Route("/deleteaccountcancel",["controller"=>DeleteUserController::class,"method"=>"cancel"]));
$routes->add("Site_UserCategory", new Route("/saveusercategory",["controller"=>ResourceCategoryController::class,"method"=>"saveUserCategory"]));
$routes->add("Site_AddComment", new Route("/addcomment",["controller"=>CommentController::class,"method"=>"addComment"]));

//Panel Routes
$routes->add("Admin_Home", new Route("$panellink",["controller"=>panel\HomeController::class,"method"=>"index"]));
/*Author Routes*/
$routes->add("Admin_rolepermission", new Route("$panellink/rolepermission",["controller"=>panel\AuthController::class,"method"=>"rolepermission"]));
$routes->add("Admin_edit_rolepermission", new Route("$panellink/role/permission/{role_id}",["controller"=>panel\AuthController::class,"method"=>"rolepermissionedit"]));
$routes->add("Admin_save_rolepermission", new Route("$panellink/saverolepermission",["controller"=>panel\AuthController::class,"method"=>"saverolepermission"]));
$routes->add("Admin_userroles", new Route("$panellink/userrole{get}",["controller"=>panel\AuthController::class,"method"=>"userroles"]));
$routes->add("Admin_save_userrole", new Route("$panellink/saveuserrole",["controller"=>panel\AuthController::class,"method"=>"saveuserrole"]));
$routes->add("Admin_usercategory", new Route("$panellink/usercategory",["controller"=>panel\AuthController::class,"method"=>"usercategory"]));
$routes->add("Admin_save_usercategory", new Route("$panellink/usercategory/save",["controller"=>panel\AuthController::class,"method"=>"panelsaveusercategory"]));
$routes->add("Admin_edit_usercategory", new Route("$panellink/usercategory/edit/{user_id}",["controller"=>panel\AuthController::class,"method"=>"editusercategory"]));
/*News Route*/
$routes->add("Admin_addnews", new Route("$panellink/addnews",["controller"=>panel\NewsController::class,"method"=>"addnews"]));
$routes->add("Admin_savenews", new Route("$panellink/savenews",["controller"=>panel\NewsController::class,"method"=>"savenews"]));
$routes->add("Admin_newslist", new Route("$panellink/newslist",["controller"=>panel\NewsController::class,"method"=>"newslist"]));
$routes->add("Admin_newsupdate", new Route("$panellink/newsupdate",["controller"=>panel\NewsController::class,"method"=>"newsupdate"]));
$routes->add("Admin_newsdelete", new Route("$panellink/news/delete/{id}",["controller"=>panel\NewsController::class,"method"=>"newsdelete"]));
$routes->add("Admin_newsedit", new Route("$panellink/news/edit/{id}",["controller"=>panel\NewsController::class,"method"=>"newsEdit"]));
/*Comment route*/
$routes->add("Admin_commentlist", new Route("$panellink/commentlis{status}",["controller"=>panel\CommentController::class,"method"=>"commentlist"]));
$routes->add("Admin_commentSaveStatus", new Route("$panellink/comment/savestatus",["controller"=>panel\CommentController::class,"method"=>"savestatus"]));
$routes->add("Admin_commentedit", new Route("$panellink/comment/edit/{id}",["controller"=>panel\CommentController::class,"method"=>"commentedit"]));
$routes->add("Admin_commentdelete", new Route("$panellink/comment/delete/{id}",["controller"=>panel\CommentController::class,"method"=>"commentdelete"]));
/*Account Manage route*/
$routes->add("Admin_accountmanage", new Route("$panellink/accountmanag{status}",["controller"=>panel\AccountController::class,"method"=>"accountmanage"]));
$routes->add("Admin_accountsaveStatus", new Route("$panellink/account/savestatus",["controller"=>panel\AccountController::class,"method"=>"accountsavestatus"]));
/*Category route*/
$routes->add("Admin_listcategory", new Route("$panellink/categorylis{get}",["controller"=>panel\CategoryController::class,"method"=>"categorylist"]));
$routes->add("Admin_addcategory", new Route("$panellink/addcategory",["controller"=>panel\CategoryController::class,"method"=>"addcategory"]));
$routes->add("Admin_categoryupdate", new Route("$panellink/categoryupdate",["controller"=>panel\CategoryController::class,"method"=>"categoryupdate"]));
$routes->add("Admin_deletecategory", new Route("$panellink/category/delete/{id}",["controller"=>panel\CategoryController::class,"method"=>"deletecategory"]));
$routes->add("Admin_editcategory", new Route("$panellink/category/edit/{id}",["controller"=>panel\CategoryController::class,"method"=>"editcategory"]));
/*COnfig*/
$routes->add("Admin_config", new Route("$panellink/confi{get}",["controller"=>panel\ConfigController::class,"method"=>"config"]));
$routes->add("Admin_saveNewsDate", new Route("$panellink/config/savenewsdate",["controller"=>panel\ConfigController::class,"method"=>"savenewsdate"]));
$routes->add("Admin_saveMaintenance", new Route("$panellink/config/savemaintenance",["controller"=>panel\ConfigController::class,"method"=>"savemaintenance"]));
/*LoginLogOut*/
$routes->add("Admin_login", new Route("$panellink/login",["controller"=>panel\LoginController::class,"method"=>"login"]));
$routes->add("Admin_loginon", new Route("$panellink/loginon",["controller"=>panel\LoginController::class,"method"=>"loginon"]));
$routes->add("Admin_logout", new Route("$panellink/logout",["controller"=>panel\LoginController::class,"method"=>"logout"]));


$routes->add("Admin_Maintenance", new Route("/maintenanceoff",["controller"=>panel\MaintenanceController::class,"method"=>"maintenanceoff"]));

/*API ROUTES*/
$routes->add("API", new Route("/API/v1/news",["controller"=>APIController::class,"method"=>"getAllNews"]));
return $routes;