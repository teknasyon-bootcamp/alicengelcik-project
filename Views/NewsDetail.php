<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <?php include("header.php"); ?>

    <!--Navbar Menu Finish!-->

    <!--Crousel Start!-->
    <div class="container">
        <div class="col-12">
            <?php include("slider.php"); ?>
            <!--Crousel Finish!-->
            <div class="container p-0">
                <div class="row ps-0 me-0">
                    <!--left content start!-->
                    <?php
                    if (!$new){
                        include "NotNews.php";
                    }
                    else{
                        if (isset($_SESSION["user_id"])){
                        addNewsLog($new[0]["id"]);
                        }
                        foreach ($new as $n)
                        $header=$n["header"];
                        $img=getImageURL("news",$n["image"]);
                        $content=$n["content"];
                        $author=getUserInfo($n["user_id"]);
                        $author=$author[0]["name"]." ".$author[0]["surname"];
                        ?>
                        <div class="left col-9 p-0 me-0">
                            <div class="container mt-3">
                                        <div class="p-3 border bg-light mb-5">
                                            <div class="row g-0 align-items-center">
                                                <div class="card-body">
                                                    <h5 class="card-title text-center"><?php echo $header; ?></h5>
                                                    <hr>
                                                <img src="<?php echo $img; ?>" class="pe-3" style="width: 25%;float: left" alt="...">
                                               <p><?php echo $content; ?></p>

                                                        <p class="card-text"><b>Author:</b> <?php echo $author;?></p>
                                                        <p class="card-text"><b>Created_at:</b> <?php echo $n["created_at"];?></p>
                                                    </div>

                                            </div>
                                            <h5 class="card-title mt-5 text-center">Comments</h5>
                                            <hr>
                                            <?php
                                            if ($comments){
                                                foreach ($comments as $comment) {
                                                    $user=getUserInfo($comment["user_id"])[0];
                                                    $image=getImageURL("users",$user["image"]);
                                                    $image_anonymous=getImageURL("users","anonymous.png");
                                                    $user=$user["name"]." ".$user["surname"];
                                                    $content=$comment["comment"];
                                                    $date=$comment["created_at"];
                                                    ?>
                                                    <div class="card mb-3">
                                                        <div class="row g-0">
                                                            <div class="col-2 text-center">

                                                                    <img src="<?php
                                                                    if ($comment["anonymous"]==1){echo $image_anonymous;}
                                                                    else{echo $image;}
                                                                    ?>"  style="vertical-align: baseline;" class="img-fluid rounded-start p-2" alt="...">
                                                            </div>
                                                            <div class="col-10">
                                                                <div class="card-body">
                                                                    <?php if ($comment["anonymous"]==1){
                                                                        echo "<h5 class='card-title'>Anonymous</h5>";
                                                                    }
                                                                    else{
                                                                        echo "<h5 class='card-title'>$user</h5>";
                                                                    }?>
                                                                    <p class="card-text"><?php echo $content; ?></p>
                                                                    <p class="card-text"><small class="text-muted"><?php echo $date; ?></small></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <?php
                                                }
                                            }
                                            else{
                                                echo "<h6 class='card-title'>No Comment!</h6>";
                                            }

                                            if (isset($_SESSION["login"])==true){
                                            ?>
                                            <form action="/addcomment" method="post">
                                                <div class="form-group">
                                                    <label class="col-12 h5 align-content-center text-danger" style="text-align: center">Your comment</label>
                                                    <hr class="mt-0">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="name" value="0" checked>
                                                        <label class="form-check-label">Show My Name</label>
                                                    </div>
                                                    <div class="form-check pb-2">
                                                        <input class="form-check-input" type="radio" name="name" value="1">
                                                        <label class="form-check-label">Anonymous</label>
                                                    </div>
                                                    <label class="form-label h5">Comment:</label>
                                                    <textarea required class="form-control mb-2" name="comment" cols="30" rows="5"></textarea>
                                                    <input type="hidden" name="new_id" value="<?php echo $n["id"]; ?>">
                                                    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION["csrf_token"]; ?>">
                                                    <center><button class="btn btn-success text-center" type="submit">Comment Save</button></center>
                                            </form></div>
                                            <?php }
                                            else{?>
                                            <h6 class='card-title'>Please, login or register to comment! <a href='<?php echo loginURL(); ?>'>Login</a>&nbsp;/&nbsp;<a href='<?php echo registerURL();?>'>Register</a></h6>
                                            <?php } ?>
                                        </div>
                        </div>
                        </div>

                        <!--left content finish!-->
                        <?php include ("LastNewsView.php"); ?>
                    <?php }?>
                </div>
            </div>
        </div>
    </div>
    <?php include("footer.php"); ?>
    </body>
</html>