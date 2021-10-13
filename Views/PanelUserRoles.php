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
                            <h3 class="card-title">User Roles</h3>
                        </div>
                        <!-- ./card-header -->
                        <div class="card-body">
                            <?php
                            if (isset($_GET["save"]) &&$_GET["save"]=="yes"){
                                echo "<div class='alert alert-success'><h5>User role update success!</h5></div>";
                            }
                            ?>
                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr data-widget="expandable-table" aria-expanded="false">
                                    <?php
                                    foreach ($userRole as $row=>$url){
                                    $userRoleId=$url["role_id"];
                                    $userRoleLevel=getRoleLevel($userRoleId);
                                    if(($userRoleLevel>$_SESSION["roleLevel"]) || $_SESSION["roleLevel"]==1){
                                        $name=$url["name"]." ".$url["surname"];
                                    ?>
                                    <td><?php echo $row+1; ?></td>
                                    <td><?php echo $name; ?></td>
                                    <td><?php echo $url["email"]; ?></td>
                                    <td>
                                        <form action="<?php echo baseurlpanel()."/saveuserrole" ?>" method="POST">
                                            <input type='hidden' name='resource_role_id[]' value='<?php echo $url["resource_id"];?>'>
                                            <select name="userrole_id[]" class="form-control select2" style="width: 100%;">

                                                <?php
                                                foreach ($roles as $role){
                                                    if (($role["level"]>$_SESSION["roleLevel"]) || $_SESSION["roleLevel"]==1){
                                                    if ($role["id"]==$url["role_id"]){
                                                        echo "<option value='{$role["id"]}' name='userroleid' selected='selected'>{$role["role"]}</option>";
                                                    }else{
                                                        echo "<option value='{$role["id"]}' name='userroleid'>{$role["role"]}</option>";
                                                    }
                                                    ?>

                                                <?php }} ?>
                                            </select>
                                    </td>
                                </tr>
                                <?php }}?>
                                </tbody>
                            </table>
                            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION["csrf_token"];?>">
                            <center><button type="submit" class="btn btn-danger mt-2">Save All Roles</button></center>
                            </form>
                        </div>
                    </div>
                </div>
        </section>
        <!-- /.content -->
    </div>
<?php include ("PanelFooter.php"); ?>