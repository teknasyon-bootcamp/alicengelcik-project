<?php include("PanelHeader.php");?>
<?php include("PanelSidebar.php");?>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Comment List</h1>
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
                            <div class="card-body">
                                <div class="form-group">

                                    <label for="exampleInputFile">Status:</label>
                                    <form action="" method="get">
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
                                </div>
                            </div>
                            <table class="table table-bordered table-hover">
                                <?php
                                    if ($comments){?>
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Header</th>
                                            <th>Author</th>
                                            <th>Anonymous</th>
                                            <th>Created_at</th>
                                            <th>Updated_at</th>
                                            <th style="min-width: 200px;">Status</th>
                                            <th style="min-width: 250px;">#</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        foreach ($comments as $row=>$comment){
                                            $header=getNewsInfo($comment["new_id"])[0]["header"];
                                            $userInfo=getUserInfo($comment["user_id"])[0];
                                            $user=$userInfo["name"]." ".$userInfo["surname"];
                                            $anonymous=$comment["anonymous"];
                                            $created_at=$comment["created_at"];
                                            $updated_at=$comment["updated_at"];
                                            ?>
                                            <tr data-widget="expandable-table" aria-expanded="false">
                                            <td><?php echo $row+1; ?></td>
                                            <td><?php echo $header; ?></td>
                                            <td><?php echo $user; ?></td>
                                            <td class="text-center"><?php if ($anonymous==1){echo "Yes";}else{echo "No";}; ?></td>
                                            <td><?php echo $created_at; ?></td>
                                            <td><?php echo $updated_at; ?></td>
                                            <td>
                                                <form action="<?php echo baseurlpanel()."/comment/savestatus";?>" method="POST">
                                                <select name="commentstatus[]" class="form-control mr-2">
                                                    <?php
                                                    $commentstatus=\App\Model\CommentStatusModel::all();
                                                        foreach ($commentstatus as $cs) {
                                                            if ($cs["status_id"] == $comment["status"]) {
                                                                echo "<option value='{$cs['status_id']}' selected='selected'>{$cs['value']}</option>";
                                                            } else {
                                                                echo "<option value='{$cs['status_id']}'>{$cs['value']}</option>";
                                                            }
                                                        }
                                                    ?>
                                                </select>
                                                <input type="hidden" name="comment_id[]" value="<?php echo $comment["id"]; ?>">
                                            </td>
                                            <td>
                                                <a href="#" class="btn btn-info"  data-toggle="modal" data-target="#myModal<?php echo $comment["id"];?>">Read Comment</a>
                                                <a class="btn btn-danger" href="<?php echo baseurlpanel()."/comment/delete/".$comment["id"]."?token=".$_SESSION["csrf_token"]; ?>">Delete</a>
                                            </td>
                                        </tr>
                                            <!--Comment Modal!-->
                                            <div id="myModal<?php echo $comment["id"];?>" class="modal fade" role="dialog">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-body">
                                                            <p><?php echo $comment["comment"];?></p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <!--COmment Modal!-->
                                    <?php }}else{echo "<div class='alert alert-danger'>No Comment</div>";} ?>

                                </tbody>
                            </table>

                        </div>
                        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION["csrf_token"];?>">
                        <center><button type="submit" class="btn btn-success">Save All List Status</button></center>
                        </form>

                        <!-- /.card -->
                    </div>
                </div>
        </section>
        <!-- /.content -->
    </div>
<?php include ("PanelFooter.php"); ?>