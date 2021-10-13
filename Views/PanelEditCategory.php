<?php include("PanelHeader.php");?>
<?php include("PanelSidebar.php");?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Category</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="inputName">Category</label>
                                <form action="<?php echo baseurlpanel()."/categoryupdate"; ?>" method="POST">
                                    <input type="text" id="inputName" name="category" value="<?php echo $category["category"];?>" class="form-control" autofocus="on" autocomplete="off">
                                    <input type="hidden" id="inputName" name="category_id" value="<?php echo $category["id"];?>" class="form-control" autofocus="on">
                                    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION["csrf_token"];?>">
                                    <button type="submit" class="btn btn-primary mt-2">Update category</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
        <!-- /.content -->
    </div>
<?php include ("PanelFooter.php"); ?>