<div class="right col-3 p-0 mt-1">

    <h6 class="p-2 text-center text-primary">Last Views</h6>
    <aside>
        <?php if (isset($_SESSION["user_id"])){?>
        <div class="p-3 border bg-light">

            <?php
            $lastView=\App\Model\NewsViewModel::find(["user_id"=>$_SESSION["user_id"]]);
            $number=0;
            foreach ($lastView as $last){
                if ($number!=5){
                    $number++;
                $lastView_newsInfo=getNewsInfo($last["news_id"])[0];
                $lastView_header=$lastView_newsInfo["header"];
                $lastView_img=$lastView_newsInfo["image"];
                $lastView_create=$lastView_newsInfo["created_at"];
            ?>
            <div class="row g-0 align-items-center">
                <div class="col-4 p-1">
                    <img src="<?php echo getImageURL("news",$lastView_img); ?>" class="img-thumbnail" alt="...">
                </div>
                <div class="col-8">
                    <div class="card-body">
                        <h6 class="card-title"><?php echo $lastView_header; ?></h6>
                        <h7 class="card-title"><?php echo $lastView_create; ?></h7>
                    </div>
                </div>
            </div>
            <?php }}?>
        </div>
        <h6 class="p-2 text-center text-primary"><a href="<?php echo baseurl()."user/user?usernews=news"?>">All view</a></h6>
    </aside>
    <?php }
    else{?>
        <h6 class='card-title'>Please, login or register to see your recent views! <a href="<?php echo loginURL();?>">Login</a>&nbsp;/&nbsp;<a href='<?php echo registerURL();?>'>Register</a></h6>
    <?php } ?>
</div>