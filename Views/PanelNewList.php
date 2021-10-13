<?php include("PanelHeader.php");?>
<?php include("PanelSidebar.php");?>
    <div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>News Control</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <?php
                    $userCategory=\App\Model\ResourceCategoryModel::find(["resource_id"=>$_SESSION["panel_user_id"],"resource"=>"user"]);
                    if (count($userCategory)==0){
                        echo failMessage("nocategory");
                        exit();
                    }
                    ?>
<div class="card-body">
    <table class="table table-bordered table-hover">
        <thead>
        <tr>
            <th>#</th>
            <th>Image</th>
            <th>Header</th>
            <th>Author</th>
            <th>Created_at</th>
            <th>#</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if ($allNews){
            $userCategoryID=[];
            foreach ($userCategory as $row=> $uc){
                $userCategoryID+=[$row=>$uc["category_id"]];
            }
            foreach ($allNews as $row=> $new){
                $createddate=$new["created_at"];
                $dateDif=getNewsEditDate($createddate);
                $newsCategory=\App\Model\ResourceCategoryModel::find(["resource_id"=>$new["id"],"resource"=>"news"])[0];
                if (in_array($newsCategory["category_id"],$userCategoryID)){
                        //editör kendi yetkisi olduğu categoriyi ve haberlerini görecek moderatör ve admin hepsini
                        if ($new["user_id"]==$_SESSION["panel_user_id"] || $_SESSION["roleLevel"]<3){
                $header=$new["header"];
                $image=getImageURL("news",$new["image"]);
                $userInfo=getUserInfo($new["user_id"]);
                $user=$userInfo[0]["name"]." ".$userInfo[0]["surname"];
                $created_at=$new["created_at"];
                $news_id=$new["id"];?>

                <tr data-widget="expandable-table" aria-expanded="false">
                    <td><?php echo $row+1; ?></td>
                    <td class="text-center"><a target="_blank" href="<?php echo $image ?>"><img src="<?php echo $image; ?>" width="50px" height="50px"></a></td>
                    <td><?php echo $header; ?></td>
                    <td><?php echo $user ?></td>
                    <td><?php echo $created_at ?></td>
                    <td>
                        <?php
                        if ($dateDif==true){
                        ?>
                        <a class="btn btn-warning" href="<?php echo baseurlpanel()."/news/edit/".$news_id;?>">Edit</a>
                        <a class="btn btn-danger" href="<?php echo baseurlpanel()."/news/delete/".$news_id."?token=".$_SESSION["csrf_token"];?>">Delete</a>
                    </td>
                </tr>

                <?php
            }else{echo "<div class='text-danger text-bold'>Editing period has expired</div>";}
                }}}}
        ?>


        </tbody>
    </table>
</div>

                </div>
            </div>
    </section>
        <!-- /.content -->
    </div>
<?php include ("PanelFooter.php"); ?>