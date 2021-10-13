<?php include("PanelHeader.php");?>
<?php include("PanelSidebar.php");?>

<div class="content-wrapper">
    <!-- Main content -->
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit News</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <!-- ./card-header -->
                        <div class="card-body">
                            <div class="form-group">
                                <?php if ($news){
                                    $difDate=getNewsEditDate($news[0]["created_at"]);
                                    if ($difDate==true){
                                    ?>
                                <form action="<?php echo baseurlpanel()."/newsupdate"; ?>" method="POST" enctype="multipart/form-data">
                                <label for="inputName">News Header</label>
                                <input type="text" name="newsheader" id="inputName" value="<?php echo $news[0]["header"];?>" autocomplete="off" class="form-control" maxlength="99" autofocus="on" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">News Image: </label>
                                <input type="file" name="newsimg" accept="image/*" id="image"  onchange="return fileValidation()" class="form-control pb-5 pt-3">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">Category</label>
                                <select name="categoryid" class="form-control select2" style="width: 25%;" required>
                                    <?php
                                    $allCategory=getAllCategory();
                                    $news_category_id = getResourceCategory($news[0]["id"], "news")[0]["category_id"];
                                    //$news_category_id = getResourceCategoryID($news[0]["id"], "news");
                                    foreach ($allCategory as $cat) {
                                        $category = $cat["category"];
                                        $category_id = $cat["id"];
                                        if ($news_category_id == $cat["id"]) {
                                            echo "<option value='{$category_id}' selected>$category</option>";
                                        } else {
                                            echo "<option value='{$category_id}'>$category</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="inputDescription">News Content</label>
                                <textarea name="content" class="form-control" rows="8" required><?php echo $news[0]["content"];?></textarea>
                            </div>
                            <input type="hidden" name="news_id" and value="<?php echo $news[0]["id"] ?>">
                            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION["csrf_token"];?>">
                            <button type="submit" class="btn btn-primary mt-2">Update News</button>
                            </form>
                            <?php }else{
                                echo "<div class='alert alert-danger'><h5>News failed!</h5>Editing period has expired!</div>";
                            }}else{
                                echo "<div class='alert alert-danger'><h5>News id error!</h5><a href='{baseurlpanel()}.{'/newslist'}'> Go to Control Panel News List</a></div>";
                                 } ?>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
        </section>
        <!-- /.content -->
</div>
<?php include ("PanelFooter.php"); ?>