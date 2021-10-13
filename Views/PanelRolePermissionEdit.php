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
                            <h3 class="card-title">Role Permissions</h3>
                        </div>
                        <div class="card-body">
                            <?php
                            if (isset($_GET["save"]) && $_GET["save"]=="yes"){
                                echo "<div class='alert alert-success'><h5>Permission update success!</h5></div>";
                            }
                            ?>
                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th style="padding: 5px;">Perm ID</th>
                                    <th style="padding: 5px;">#</th>
                                    <th style="padding: 5px;">Permission</th>
                                    <th style="padding: 5px;">Permission Desc</th>
                                </tr>
                                </thead>
                                <tbody>
                                <form action="<?php echo baseurlpanel()."/saverolepermission" ?>" method="POST">
                                <?php if ($permissions) {
                                        foreach ($permissions as $perm) {
                                            echo "<tr data-widget='expandable-table' aria-expanded='false'>
                                            <td style='padding: 5px; text-align: center'>{$perm['id']}</td>";
                                             if ($rolePerm) {
                                                $rolePermList=[];
                                                foreach ($rolePerm as $rp){$rolePermList[]+=$rp["permission_id"];}
                                                if (in_array($perm["id"],$rolePermList)) {
                                                echo "<td style='padding: 5px; text-align: center'><input type='checkbox' name='permission_id[]' value='{$perm["id"]}' checked></td>";
                                                }
                                                else {
                                                echo "<td style='padding: 5px; text-align: center'><input type='checkbox' name='permission_id[]' value='{$perm["id"]}'></td>";
                                                }
                                                echo "<td style='padding: 5px;'><label style='font-weight: normal;' class='form-check-label'>{$perm["name"]}</label></td>
                                                <td style='padding: 5px;'><label style='font-weight: normal;' class='form-check-label'>{$perm["desc"]}</label></td>";
                                        }else {
                                                echo "<td style='padding: 5px; text-align: center'><input type='checkbox' name='permission_id[]' value='{$perm["id"]}'></td>
                                                <td style='padding: 5px;'><label style='font-weight: normal;' class='form-check-label'>{$perm["name"]}</label></td>
                                                <td style='padding: 5px;'><label style='font-weight: normal;' class='form-check-label'>{$perm["desc"]}</label></td>";
                                            }

                                             }}?>
                                             </tr>
                                </tbody>
                            </table>
                            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION["csrf_token"];?>">
                            <input type='hidden' name='role_id' value="<?php if (!is_int($role_id)){return header('Location:'.prevURL());} else{echo $role_id;} ?>">
                            <center><button type="submit" class="btn btn-success mt-3">Save All List Status</button></center>
                        </form>
                        </div>

                        <!-- /.card -->
                    </div>
                </div>
        </section>
        <!-- /.content -->
    </div>
<?php include ("PanelFooter.php"); ?>