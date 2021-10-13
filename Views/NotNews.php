<?php
$image=getImageURL("","notnews.png");
?>
        <div class="col-6 m-5 center rounded mx-auto">
            <img class="img-fluid img-thumbnail" src="<?php echo $image;?>" alt="NotNewsImage">
            <i class="h2">News Not Found</i>
            <i><a href="<?php echo baseurl()?>">Go Home Page</a></i>
</div>