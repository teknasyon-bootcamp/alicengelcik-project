    <?php use App\Controller\panel\AuthController;

    include("PanelHeader.php");?>

    <!-- Main Sidebar Container -->
    <?php include("PanelSidebar.php");?>
    <!-- Main Sidebar Container -->
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Configuration List</h1>
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
                                <?php
                                if (isset($_GET["save"]) && $_GET["save"]=="yes"){
                                    echo "<div class='alert alert-success'><h5>News date update success!</h5></div>";
                                }?>
                                <form action="<?php echo baseurlpanel()."/config/savenewsdate"; ?>" method="post">
                                <h5><b>News Edit Time Limit:</b> </h5>
                                    <div class="row ml-1">
                                        <input type="number" class="form-control mr-2"  name="number" style="width: 10%;" value="<?php echo $newsdate["config_value"];?>">
                                        <select name="dayyear" class="form-control mr-2" style="width: 10%;">
                                            <?php
                                            if ($newsdate["config_type"]==1){
                                                echo "
                                            <option value='1' selected='selected'>Day</option>
                                            <option value='2'>Year</option>";
                                            }else{
                                                echo "
                                            <option value='1'>Day</option>
                                            <option value='2' selected='selected'>Year</option>";
                                            }
                                            ?>
                                        </select>
                                        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION["csrf_token"];?>">
                                        <button class="btn btn-success" type="submit">Save</button>
                                </form>
                            </div></div>
                        <?php if (AuthController::permissionControl([99,11],"menu")) {?>
                        <div class="form-group mt-5">
                            <h5><b>Maintenance Mode:<br><i class="text-danger">Status: No</i></h5>
                        </div>
                        <div class="alert alert-danger alert-dismissible mt-2">
                            <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                            Please be careful when putting the site into maintenance mode! <br>You will not be able to access the site and administration panel
                        </div>
                            <form action="<?php echo baseurlpanel()."/config/savemaintenance"; ?>" method="post">
                            <select name="maintenance" class="form-control mr-2" style="width: 10%;">
                            <option value="1" selected="selected">Yes</option>
                        </select>
                         <input type="hidden" name="csrf_token" value="<?php echo $_SESSION["csrf_token"];?>">
                        <button class="btn btn-danger mt-2" type="submit">Save</button>
                                <?php }?>
                    </div>

                    <!-- /.card -->
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <?php include ("PanelFooter.php"); ?>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>