<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <?php include("header.php"); ?>

    <!--Navbar Menu Finish!-->

    <!--Crousel Start!-->
    <div class="container mb-5">
        <div class="col-12">
            <?php include("slider.php"); ?>
            <!--Crousel Finish!-->
            <div class="container p-0">
                <div class="row ps-0 me-0">
                    <!--left content start!-->
                    <div class="left col-9 p-0 me-0">
                        <div class="container mt-3">
                            <div class="row">
                    <?php
                                if (!$newsCategory){
                                    include "NotNews.php";
                                }
                                else{
                                    foreach ($newsCategory as $news){
                                    $id = $news["id"];
                                    $header=substr($news["header"],0,35).'...';;
                                    $img=getImageURL("news",$news["image"]);
                                    $content=substr($news["content"],0,120);
                                    $sefheaderlink = baseurl().'news/details/'.$id.'/'.seflink($news["header"]);
                                ?>
                                <div class="col-6 mb-3">
                                    <div class="p-3 border bg-light pb-1">
                                        <div class="row g-0 align-items-center" style="min-height: 200px;">
                                            <h5 class="card-title"><?php echo $header; ?></h5>
                                            <hr>
                                            <div class="col-md-4 p-1">
                                                <img src="<?php echo $img;?>" class="img-thumbnail" alt="...">
                                            </div>
                                            <div class="col-md-8">
                                                <div class="card-body p-0">
                                                    <p class="card-text ps-1" style="min-height: 110px;"><?php echo $content; ?></p>
                                                    <p class=" ps-1"><a href="<?php echo $sefheaderlink ;?>">Read More</a></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                    <!--left content finish!-->
                                    <?php } ?>
                            </div>

                        </div>
                    </div>
                    <?php include ("LastNewsView.php"); ?>

                    <?php }?>

                </div>
            </div>
        </div>
    </div>
    <?php include("footer.php"); ?>
    </body>
</html>