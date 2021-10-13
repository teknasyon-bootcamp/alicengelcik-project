<?php include("PanelHeader.php");?>
<?php include("PanelSidebar.php");?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Authorization-User Category</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header border-0 pb-0">
                            <h4 >User Info</h4>
                            <div class="h5">Name: <?php echo $userInfoCategory[0]["name"]." ".$userInfoCategory[0]["surname"]; ?></div>
                            <div class="h5">Email: <?php echo $userInfoCategory[0]["email"];?></div>
                        </div>
                        <hr>
                        <div class="card-body pt-1">
                            <?php
                            if (isset($_GET["save"]) &&$_GET["save"]=="yes"){
                                echo "<div class='alert alert-success'><h5>User category save success!</h5></div>";
                            }
                            ?>
                            <div class="form-group">
                                <?php
                                $allCategory=getAllCategory();
                                $userCategoryList=[];
                                foreach ($userCategory as $uc){$userCategoryList[]+=$uc["category_id"];}
                                foreach ($allCategory as $cat){?>
                                    <form action="<?php echo baseurlpanel()."/usercategory/save"?>" method="post">
                                <div class='form-check'>
                                    <?php
                                    if (in_array($cat["id"],$userCategoryList)){
                                        echo "<input class='form-check-input' name='categoryid[]' value='{$cat["id"]}' type='checkbox' checked>";
                                    }else{
                                        echo "<input class='form-check-input' name='categoryid[]' value='{$cat["id"]}' type='checkbox'>";
                                    }
                                    ?>
                                    <label class='form-check-label'><?php echo $cat["category"]; ?></label>
                                </div>
                                <?php } ?>
                                        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION["csrf_token"];?>">
                                        <input type="hidden" name="user_id" value="<?php echo $userInfoCategory[0]["id"] ?>">
                                <button type="submit" class="btn btn-success mt-3">Save</button>
                                </form>
                            </div>
                            <!-- /.card-body -->
                        </div>

                        <!-- /.card -->
                    </div>
                </div>
        </section>
        <!-- /.content -->
    </div>
<?php include ("PanelFooter.php"); ?>