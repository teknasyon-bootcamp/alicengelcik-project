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
                            <h3 class="card-title">User Category</h3>
                        </div>
                        <!-- ./card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th width="200px">Role</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                foreach ($users as $row=> $u){
                                    $userRoleId=\App\Model\ResourceRoleModel::find(["resource_id"=>$u["id"]])[0]["role_id"];
                                    $userRoleLevel=getRoleLevel($userRoleId);
                                    if (($userRoleLevel>$_SESSION["roleLevel"]) || $_SESSION["roleLevel"]==1){
                                ?>
                                <tr data-widget="expandable-table" aria-expanded="false">
                                    <td><?php echo $row+1; ?></td>
                                    <td><?php echo $u["name"]." ".$u["surname"]; ?></td>
                                    <td><?php echo $u["email"]; ?></td>
                                    <td>
                                        <a href="<?php echo baseurlpanel()."/usercategory/edit/".$u["id"]; ?>" class="btn btn-warning">Category Edit</a>
                                    </td>
                                </tr>
                                <?php }} ?>
                                </tbody>
                            </table>
                            <input type="hidden" name="userid" value="$userid">
                            </form>
                        </div>
                    </div>
                </div>
        </section>
        <!-- /.content -->
    </div>
<?php include ("PanelFooter.php"); ?>