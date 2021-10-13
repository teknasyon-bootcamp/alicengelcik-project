<?php include("PanelHeader.php");?>
<?php include("PanelSidebar.php");?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Category List</h1>
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
                                if (isset($_GET["news"]) && $_GET["news"]=="yes"){
                                    echo "<div class='alert alert-danger'><h5>There is news belonging to the category CANNOT BE DELETED</h5></div>";
                                }
                                ?>
                                <!-- ./card-header -->
                                <table class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th width="100px;">#</th>
                                        <th>Category Name</th>
                                        <th width="200px;"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php if ($category){?>
                                    <tr data-widget="expandable-table" aria-expanded="false">
                                    <?php
                                    foreach ($category as $row=>$cat){
                                        if (in_array($cat["id"],$userCategory) || $_SESSION["roleLevel"]==1){
                                            ?>
                                        <td class="text-center"><?php echo $row+1; ?></td>
                                        <td><?php echo $cat["category"]; ?></td>
                                        <td>
                                            <a class="btn btn-warning" href="<?php echo baseurlpanel()."/category/edit/".$cat["id"];?>">Edit</a>
                                            <a class="btn btn-danger" href="<?php echo baseurlpanel()."/category/delete/".$cat["id"]."?token=".$_SESSION["csrf_token"];?>">Delete</a>
                                        </td>
                                    </tr>
                                    <?php }}}?>
                                    </tbody>
                                </table>
                                </form>
                            </div>
                        </div>

                        <!-- /.card -->
                    </div>
                </div>
        </section>
        <!-- /.content -->
    </div>
<?php include ("PanelFooter.php"); ?>