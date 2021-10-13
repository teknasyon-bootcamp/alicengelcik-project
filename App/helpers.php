<?php

use App\Model\ResourceCategoryModel;
use App\Model\RoleModel;

function view($template, array $data=[]){
    extract($data,EXTR_SKIP);
    //anahtar değer ikililerini değişken ve değere atıyor. [eray=>1,aydin=>2] olanı=> $eray=1;$aydin=2; ye çeviriyor
    ob_start();//buffer başlatma değer döndürme çağırınca veri bas ekrana şimdi yazdırma
    include __DIR__."/../views/{$template}.php";
    return ob_get_clean();
}
function getAllCategory():array{
    //sitede her sayfada kullanılacağı için buraya ekledim
    return \App\Model\CategoryModel::all();
}
function getCategory($values):array{
    return \App\Model\CategoryModel::find($values);
}
function QuerySerialize(array $values, string $type): mixed
{
    $propertiesCounter = 1;
    $result = '';
    foreach ($values as $column => $value )
    {
        if ($propertiesCounter > 1)
        {
            if ($type == 'where')
            {
                $result .= " and ";
            }
            else
            {
                $result .= ",";
            }
        }
        if ($type == 'value')
        {
            $result .= ":$column";
        }
        elseif ($type == 'column')
        {
            $result .= $column;
        }
        elseif ($type == 'set' || $type == 'where')
        {
            $result .= "$column=:$column";
        }
        $propertiesCounter++;
    }
    return $result;
}
function getRoleLevel($role_id){
    $editRoleLevel=RoleModel::find(["id"=>$role_id])[0]["level"];
    return $editRoleLevel;
}
function getUserInfo($user_id):array{
    $info=\App\Model\UserModel::findUserInfo(["id"=>$user_id]);
    return $info;
}
function getImageURL(?string $path=null,$image):string{
    if ($path==null){
        return "/assets/img/".$image;
    }else{
        return "/assets/img/".$path."/".$image;
    }
function getallStatus():array{
    $commentstatus=\App\Model\CommentStatusModel::all()[0];
    return $commentstatus;
    }
}
function baseurl():string{
    return "\\";
}
function baseurlpanel():string{
    return "\\admin";
}
function loginURL():string{
    return "\\"."login";
}
function loginPanelURL():string{
    return baseurlpanel()."/login";
}
function registerURL():string{
    return "\\"."register";
}
/*function sefurlControl($id,$sefurl){
    $categorsef=seflink(\App\Model\CategoryModel::find(["id"=>$id]));
    if ($sefurl!=$categorsef){
        return header('Location:index.php');
    }
}*/
function prevURL(){
    return $_SERVER['HTTP_REFERER'];
}
function seflink(string $text){
    $find = array("/Ğ/","/Ü/","/Ş/","/İ/","/Ö/","/Ç/","/ğ/","/ü/","/ş/","/ı/","/ö/","/ç/");
    $degis = array("G","U","S","I","O","C","g","u","s","i","o","c");
    $text = preg_replace("/[^0-9a-zA-ZÄzÜŞİÖÇğüşıöç]/"," ",$text);
    $text = preg_replace($find,$degis,$text);
    $text = preg_replace("/ +/"," ",$text);
    $text = preg_replace("/ /","-",$text);
    $text = preg_replace("/\s/","",$text);
    $text = strtolower($text);
    $text = preg_replace("/^-/","",$text);
    $text = preg_replace("/-$/","",$text);
    return $text;
}
function loginControl(){
    if (!isset($_SESSION["login"])==true && !isset($_SESSION["user_id"])){
        return header("Location:".loginURL());
    }
}
function loginPanelControl(){
    if(file_exists("maintenance.php")){
        die("<center><h1>Maintenance mode on!<br>For Test: <a href='/maintenanceoff'>Click</a> to turn off maintenance mode</h1><center>");
    }
    else{
    session_start();
    if (!isset($_SESSION["csrf_token"]) || empty($_SESSION["csrf_token"])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    if ($_POST) {
        if (isset($_POST["csrf_token"])) {
            if (isset($_SESSION['csrf_token']) && ($_SESSION['csrf_token'] == $_POST['csrf_token'])) {
                //die("CSRF Token OK!");
            } else {
                $prev=prevURL();
                die("<center><h2>CSRF TOKEN WRONG!<br><a href='$prev'>Previous Page</a></h2></center>");
            }
        }
        else {
            die("<center><h2>CSRF TOKEN NOT FOUND!</center></h2>");
        }
    }elseif (isset($_GET["token"])){
        //direk delete işlemleri için kullanacağım get token'ı gelirse unset ettirme
        //yenileme ki doğruluğunukontrol edebilelim
    }
    else{
        unset($_SESSION["csrf_token"]);
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    }
}
function getMethodCsrfToken(){
    if (isset($_GET["token"])){
            if ($_GET["token"]==$_SESSION["csrf_token"]){
                //doğru ise işleme devam ediyor
            }
            else{
                $prev=prevURL();
                die("<center><h2>CSRF TOKEN WRONG!</h2><a href='$prev'>Previous Page</a></center>");
            }
        }
        else{
            die("<center><h2>CSRF TOKEN NOT FOUND!</center></h2>");
        }
}
function getLinkCleaner($link,$char){
    $find=strrchr($link, $char);
    return explode($find,$link)[0];
}
function getNewsInfo($newsid):array{
    $news=\App\Model\NewsModel::find(["id"=>$newsid]);
    return $news;
}
function getStatus($values,$lang):string{
    $status=\App\Model\CommentStatusModel::find($values);
    if ($lang=="tr"){
        return $status[0]["value_tr"];
    }else{
        return $status[0]["value"];
    }
}
function getResourceCategory($resourceid,$resource){
    $resource_category=\App\Model\ResourceCategoryModel::find(["resource_id"=>$resourceid,"resource"=>$resource]);
    return $resource_category;
}
function inputCleaner($value){
    //input item lardan alınanverilerin temizlenme işlemi
    $value = strip_tags($value);
    $value = htmlspecialchars($value);
    $value = htmlentities($value);

    $chars=["`","/","{","}","(",")","=","&","%","#","<",">","*","and","And","aNd","aND","AND","AnD","'","chr(34)","chr(39)"];
    foreach ($chars as $char){
        $value =str_replace($char,"",$value);
    }
    return $value;
}
function failMessage($code){
    if ($code==403){
        echo "<div class='alert alert-danger'><h5>Permission failed!</h5>You are not authorized to view this page!</div>";
    }elseif ($code=="loginFail"){
        echo "<div class='alert alert-danger'><h5>Login failed!</h5> The email or password is incorrect</div>";
    }elseif ($code=="nocategory"){
        echo "<div class='alert alert-danger'><h5>News category failed!</h5> There is no category for which you are authorized</div>";
    }elseif ($code=="registerFail"){
        echo "<div class='alert alert-danger'><h5>Register failed!</h5> Email address is already used!</div>";
    }
}
function panelFailPage($responseCode){
    if ($responseCode==403){
        return header("Location:".baseurlpanel()."/403");
    }
    elseif ($responseCode==404){
        return header("Location:".baseurlpanel()."/404");
    }
}
function getUserCategory():array{
    $userCategory=ResourceCategoryModel::find(["resource_id"=>$_SESSION["panel_user_id"],"resource"=>"user"]);
    $userCategoryID=[];
    foreach ($userCategory as $row=> $uc){
        $userCategoryID+=[$row=>$uc["category_id"]];
    }
    return $userCategoryID;
}
function getNewsEditDate($Created_at){
    $newsEditDate=\App\Model\ConfigModel::find(["config_name"=>"news_time"])[0];
    $newsEditDate_type=$newsEditDate["config_type"];//1day 2 year
    $newsEditDate_value=$newsEditDate["config_value"];
    $now=new DateTime();
    $now=$now->format('Y-m-d H:i:s');
    $date1= new DateTime($Created_at);
    $date2= new DateTime($now);
    $interval= $date1->diff($date2);
    $diff= $interval->format('%a');
    if ($newsEditDate_value==0){return true;}
    else{
        if ($newsEditDate_type==1){
            //gün kontrol
            if ($diff>$newsEditDate_value){
                return false;
            }else{
                return true;
            }
        }elseif($newsEditDate_type==2){
            if (($diff)/365>$newsEditDate_value){
                return false;
            }else{
                return true;
            }
        }
    }
}
function addNewsLog($news_id){
    $number=0;
    $find=\App\Model\NewsViewModel::find(["user_id"=>$_SESSION["user_id"],"news_id"=>$news_id]);
    $now=new DateTime();
    $now=$now->format("Y-m-d");
    foreach ($find as $f){
        $cdate=substr($f["created_at"],0,10);
        if($now==$cdate){
            $number++;
        }
    }
    if($number==0){
    $add=\App\Model\NewsViewModel::add([
        "news_id"=>$news_id,
        "user_id"=>$_SESSION["user_id"]
    ]);
    }
}