<?php include("PanelHeader.php");?>
<?php include("PanelSidebar.php");?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Authorization-Role Permissions</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Roller</h3>
                        </div>
                        <!-- ./card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th width="100px">#</th>
                                    <th>Rol Name</th>
                                    <th style="width: 250px;"></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                foreach ($roles as $row=>$role){
                                    if (($role["level"]>$_SESSION["roleLevel"]) || $_SESSION["roleLevel"]==1){
                                    ?>
                                    <tr data-widget="expandable-table" aria-expanded="false">
                                        <td class="text-center"><?php echo $row+1; ?></td>
                                        <td><?php echo $role["role"]; ?></td>
                                        <td class="text-center">
                                            <a href="<?php echo baseurlpanel()."/role/permission/".$role["id"]; ?>" class="btn btn-warning">Permission Edit</a>
                                        </td>
                                    </tr>
                                <?php }}?>


                                </tbody>
                            </table>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
        </section>
        <!-- /.content -->
    </div>
<?php include ("PanelFooter.php"); ?>