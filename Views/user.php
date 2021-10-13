<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>NEWS | Home Page</title>
    <?php include("header.php"); ?>

    <!--Navbar Menu Finish!-->

    <!--Crousel Start!-->
    <div class="container  mb-5">
        <div class="col-12">
            <!--Crousel Finish!-->
            <div class="container p-0">
                <div class="row ps-0 me-0">
                    <!--content start!-->
                    <?php
                    $user=getUserInfo($_SESSION["user_id"])[0];
                    $name=$user["name"]." ".$user["surname"];
                    $image=getImageURL("users",$user["image"]);
                    $email=$user["email"];
                    ?>
                    <div class="col-12">
                        <div class="row">
                            <div class="col-3 mt-3">
                                <div class="card p-3">
                                    <img src="<?php echo $image; ?>" class="card-img-top p-3 border border-1" style="border-radius:200px" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title text-center"><?php echo $name; ?></h5>
                                        <h5 class="card-title text-center"><?php echo $email; ?></h5>
                                        <p class="card-text"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-9 mt-3">
                              <header>
                                  <?php
                                  $userInfo=getUserInfo($_SESSION["user_id"])[0];
                                  $name=$userInfo["name"]." ".$userInfo["surname"];
                                  $sefaccount=baseurl()."user/".seflink($name);
                                  ?>
                                  <a href="<?php echo $sefaccount; ?>" class="btn btn-dark">Account Home</a>
                                  <a href="?delete=user" class="btn btn-danger">Delete Account and My Data(Permanently)</a>
                                  <a href="?usernews=news" class="btn btn-warning">Recent View News</a>
                                  <a href="?userfollow=change" class="btn btn-primary">Categories I follow</a>
                              </header>
                                <div class="col-12 mt-4">
                                    <div class="col-12">

                                    <?php
                                    $allCategory=getAllCategory();
                                    $base=baseurl();
                                    if (isset($_GET["userfollow"]) && $_GET["userfollow"]=="change") {
                                        if (isset($_GET["userCategorySave"]) && $_GET["userCategorySave"]=="true"){
                                            echo "<div class='alert alert alert-success'><h5>Category Save Success!</h5></div>";
                                        }
                                        ?>
                                        <h5 class='mb-0'>Follow category</h5><hr class='mt-0'>
                                        <form action='<?php echo baseurl().'saveusercategory'?>' method='POST'>
                                        <?php
                                        if (isset($userCategory) && $userCategory != null) {
                                            $userCatList[] = [];
                                            foreach ($allCategory as $cat) {
                                                $catname = $cat["category"];
                                                $catid = $cat["id"];
                                                echo "<div class='form-check'>";
                                                foreach ($userCategory as $uc) {
                                                    $userCatList[] += $uc["category_id"];
                                                }
                                                if (in_array($cat["id"], $userCatList) != null) {
                                                    echo "<input class='form-check-input' type='checkbox' name='usercategory[]' value='$catid' checked>";
                                                } else {
                                                    echo "<input class='form-check-input' type='checkbox' name='usercategory[]' value='$catid'>";
                                                }
                                                echo "<label class='form-check-label'>{$catname}</label>
                                                    </div>
                                                    ";
                                            }

                                        } else {
                                            foreach ($allCategory as $cat) {
                                                echo "<div class='form-check'>
                                                        <input class='form-check-input' type='checkbox' name='usercategory[]' value='{$cat["id"]}'>
                                                        <label class='form-check-label'>{$cat["category"]}</label>
                                                    </div>";
                                            }
                                        }
                                        echo "<input type='hidden' name='csrf_token' value='{$_SESSION["csrf_token"]}'>";
                                        echo "<button type='submit' class='btn btn-success'>Save Follow Category</button>
                                                </form>";
                                    }
                                    if (isset($_GET["delete"])=="user"){
                                        if ($deleteInfo!=null){
                                            echo "
                                            <h5 class='alert alert-danger'>You already have a request!</h5>
                                            <a href='/deleteaccountcancel' class='btn btn-danger'>Cancel account deletion request</a>
                                            ";
                                        }else{
                                        ?>
                                        <h5>Delete Account Confirm</h5>
                                        <hr>
                                        <div class="border border-1 p-2 mt-2" style="border-radius: 10px;">
                                            <div class="row pe-3 ps-3">
                                                <h5 class="alert alert-danger">Your account will be permanently deleted. Are you sure?</h5>
                                                <form action="<?php echo baseurl()."deleteaccount";?>" method="POST">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="confirm" value="1">
                                                    <label class="form-check-label">YES</label>
                                                </div>
                                                <div class="form-check pb-2">
                                                    <input class="form-check-input" type="radio" name="confirm" value="2" checked>
                                                    <label class="form-check-label">NO</label>
                                                </div>
                                                    <div class="mb-2">
                                                        <h5>Your reason for deleting the account?</h5>
                                                        <textarea required class="form-control" name="why" cols="30" rows="5"></textarea>
                                                    </div>
                                                    <input type="hidden" name="user_id" value="<?php echo $_SESSION["user_id"]; ?>">
                                                    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION["csrf_token"]; ?>">
                                                    <button class="btn btn-danger" type="submit">Delete My Account</button>
                                                </form>
                                            </div>
                                        </div>
                                        <?php
                                    }}else{
                                        if (isset($_GET["deleteuser"]) && $_GET["deleteuser"]=="yes"){
                                            echo "<h5><div class='alert alert-success'>Your account deletion request has been received!</div></h5>";
                                        }
                                        else{
                                            if (!isset($_GET["userfollow"])){
                                    ?>
                                    <h5 class="mt-2">My Comments</h5>
                                    <hr class='mt-0'>
                                    <?php
                                                if (isset($_GET["usernews"]) && $_GET["usernews"]=="news"){
                                                        if ($userNews==null){
                                                        echo "<h6>No View News</h6>";
                                                    }
                                                    foreach ($userNews as $row=> $un){
                                                        $news_id=$un["news_id"];
                                                        $newsInfo=getNewsInfo($news_id);
                                                        $header_usernews=$newsInfo[0]["header"];
                                                        $date_usernews=$un["created_at"];
                                                        $img_usernews=$newsInfo[0]["image"];
                                                        $row_num=$row+1;

                                                        ?>
                                                        <div class="border border-1 p-2 mt-2" style="border-radius: 10px;">
                                                            <div class="row">
                                                                <div class="col-1 text-center"><h1>#<?php echo $row_num;?></h1></div>
                                                                <div class="col-9">
                                                                    <h6>News Header: <span class="fw-normal""><?php echo $header_usernews;?>
                                                                        <a href="<?php echo baseurl()."news/details/".$news_id."/".seflink($header_usernews) ?>">Read</a></span></h6>
                                                                    <h6>View Date: <span class="fw-normal"><?php echo $date_usernews;?></span></h6>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    <?php  }}

                                    if (isset($userComments) and !isset($_GET["usernews"])){
                                        if ($userComments==null){
                                            echo "<h6>No Comment</h6>";
                                        }
                                        foreach ($userComments as $row=> $uc){
                                        $commentNews=getNewsInfo($uc["new_id"]);
                                        $header=$commentNews[0]["header"];
                                        $date=$uc["created_at"];
                                        $comment=substr($uc["comment"],0,80)."...";
                                        $row_num=$row+1;

                                    ?>
                                    <div class="border border-1 p-2 mt-2" style="border-radius: 10px;">
                                        <div class="row">
                                            <div class="col-1 text-center"><h1>#<?php echo $row_num;?></h1></div>
                                        <div class="col-11">
                                            <h6>Anonymous: <span class="fw-normal"><?php if ($uc["anonymous"]==1){echo "Yes";}else{echo "No";};?></span></h6>
                                            <h6>News: <span class="fw-normal""><?php echo $header;?></span></h6>
                                            <h6>Comment: <span class="fw-normal"><?php echo $comment;?></span></h6>
                                            <h6>Satus: <span class="fw-normal"><?php echo getStatus(["status_id"=>$uc["status"]],"en");?></span></h6>
                                            <h6>Date: <span class="fw-normal"><?php echo $date;?></span></h6>
                                        </div>
                                        </div>
                                    </div>

                                    <?php  }}}}}?>

                                </div>
                            </div>

                        </div>

                    </div>
                    <!--content finish!-->
                </div>
            </div>
        </div>
    </div>
    <?php include("footer.php"); ?>
    </body>
</html>