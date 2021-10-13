<?php include("PanelHeader.php");?>
<?php include("PanelSidebar.php");?>

<div class="content-wrapper">
    <!-- Main content -->
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Add News</h1>
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
                        <?php inputCleaner("test") ?>
                        <div class="card-body">
                            <?php
                            $userCategory=\App\Model\ResourceCategoryModel::find(["resource_id"=>$_SESSION["panel_user_id"],"resource"=>"user"]);
                            if (count($userCategory)==0){
                            echo failMessage("nocategory");
                            exit();
                            }
                            ?>

                            <div class="form-group">
                                <form action="<?php echo baseurlpanel()."/savenews"; ?>" method="POST" enctype="multipart/form-data">
                                <label for="inputName">News Header</label>
                                <input type="text" name="newsheader" id="inputName" autocomplete="off" class="form-control" maxlength="99" autofocus="on" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">News Image: </label>
                                <input type="file" name="newsimg" accept="image/*" id="image"  onchange="return fileValidation()" required class="form-control pb-5 pt-3">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputFile">Category</label>
                                <select name="categoryid" class="form-control select2" style="width: 25%;" required>
                                    <?php
                                    $allCategory=getAllCategory();
                                    if ($_SESSION["roleLevel"]==1){
                                        foreach ($allCategory as $cat){
                                            $category=$cat["category"];
                                            $category_id=$cat["id"];
                                            echo "<option value='{$category_id}'>$category</option>";
                                        }
                                    }else{
                                        foreach ($userCategory as $row=> $ucat){
                                            $categoryInfo=\App\Model\CategoryModel::find(["id"=>$ucat["category_id"]])[0];
                                            $category=$categoryInfo["category"];
                                            $category_id=$categoryInfo["id"];
                                            echo "<option value='{$category_id}'>$category</option>";
                                        }
                                    }
                                    ?>

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="inputDescription">News Content</label>
                                <textarea name="content" class="form-control" rows="8" required></textarea>
                            </div>
                            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION["csrf_token"];?>">
                            <button type="submit" class="btn btn-primary mt-2">Save News</button>
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
        </section>
        <!-- /.content -->
</div>
<?php include ("PanelFooter.php"); ?>