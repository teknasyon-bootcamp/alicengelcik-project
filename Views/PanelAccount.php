<?php include("PanelHeader.php");?>
<?php include("PanelSidebar.php");?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Account Management</h1>
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

                                <label for="exampleInputFile">Status:</label>
                                <form action="">
                                    <div class="row ml-1">

                                        <select name="status" class="form-control mr-2" style="width: 30%;">
                                            <?php
                                            $commentstatus=\App\Model\CommentStatusModel::all();
                                            if (isset($_GET["status"])) {
                                                $getstatus = $_GET["status"];
                                                foreach ($commentstatus as $cs) {
                                                    if ($cs["status_id"] == $getstatus) {
                                                        echo "<option value='{$cs['status_id']}' selected='selected'>{$cs['value']}</option>";
                                                    } else {
                                                        echo "<option value='{$cs['status_id']}'>{$cs['value']}</option>";
                                                    }
                                                }
                                            }else{
                                                foreach ($commentstatus as $cs) {
                                                    echo "<option value='{$cs['status_id']}'>{$cs['value']}</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                        <button class="btn btn-warning" type="submit">Search</button>
                                </form>
                            </div></div>
                        <div class="card-header">
                            <h5 class="">Account deletion requests</h5>
                        </div>
                        <div class="form-group">
                            <!-- ./card-header -->
                            <table class="table table-bordered table-hover">
                                <?php
                                if ($accountList){
                                ?>
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>UserID</th>
                                    <th style="min-width: 200px">Name</th>
                                    <th>Email</th>
                                    <th>Account Deletion Description</th>
                                    <th style="min-width: 150px">Request Date</th>
                                    <th style="min-width: 150px">Update Date</th>
                                    <th style="min-width: 150px">Status</th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php
                                foreach ($accountList as $row=>$acc){
                                //$userInfo=getUserInfo($acc["user_id"]);
                                $name=$acc["name"];
                                $mail=$acc["email"];
                                $desc=$acc["description"];
                                $created_at=$acc["created_at"];
                                $updated_at=$acc["updated_at"];
                                    ?>

                                <tr data-widget="expandable-table" aria-expanded="false">
                                    <td><?php echo $row+1; ?></td>
                                    <td class="text-center"><?php echo $acc["user_id"] ?></td>
                                    <td><?php echo $name; ?></td>
                                    <td><?php echo $mail; ?></td>
                                    <td><?php echo $desc; ?></td>
                                    <td><?php echo $created_at; ?></td>
                                    <td><?php echo $updated_at; ?></td>
                                    <td>
                                        <form action="<?php echo baseurlpanel()."/account/savestatus"; ?>" method="POST">
                                            <select name="accountstatus[]" <?php if (isset($_GET["status"]) and $_GET["status"]==2){echo "disabled";}?> class="form-control mr-2" id="accountstatus" onchange="return StatusValidation()">
                                                <?php
                                                $commentstatus=\App\Model\CommentStatusModel::all();
                                                foreach ($commentstatus as $cs) {
                                                    if ($cs["status_id"] == $acc["status"]) {
                                                        echo "<option value='{$cs['status_id']}' selected='selected'>{$cs['value']}</option>";
                                                    } else {
                                                        echo "<option value='{$cs['status_id']}'>{$cs['value']}</option>";
                                                    }
                                                }
                                                ?>
                                            </select>
                                            <input type="hidden" name="user_delete_id[]" value="<?php echo $acc["id"];?>">
                                    </td>
                                </tr>
                                <?php }}else{
                                echo "<div class='alert alert-danger'>No account deletion request</div>";
                                }?>

                                </tbody>
                            </table>
                            <?php
                            if (isset($_GET["status"]) && $_GET["status"]==2){}else{
                            ?>
                            <div class="text-right"><button type="submit" class="btn btn-danger">Save account deletion request statuses</button></div>
                                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION["csrf_token"];?>">
                                </form>
                                <?php }?>
                        </div>
                    </div>

                    <!-- /.card -->
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
<?php include ("PanelFooter.php"); ?>