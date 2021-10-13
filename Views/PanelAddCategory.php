<?php include("PanelHeader.php");?>
<?php include("PanelSidebar.php");?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>New Category</h1>
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
                                <form action="" method="POST">
                                    <input type="text" id="inputName" name="categorynew" class="form-control" autofocus="on">
                                    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION["csrf_token"];?>">
                                    <button type="submit" class="btn btn-primary mt-2">Add New Category</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
        <!-- /.content -->
    </div>
<?php include ("PanelFooter.php"); ?>