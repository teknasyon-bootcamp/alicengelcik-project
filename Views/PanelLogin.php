<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>NEWS | Control Panel</title>

    <link rel="stylesheet" href="/assets/panel/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/assets/panel/dist/css/adminlte.min.css">
</head>
<body style="background-color: #f4f6f9;">
<div class="content-wrapper col-8 ml-auto mr-auto mt-5 pb-5">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-12 text-center">
                    <h1>Control Panel Login</h1>
                    <i><a href="<?php echo baseurl();?>">Site Page</a></i>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
            <!--login start!-->
            <center>
            <div class="col-6 mt-5 pb-5">
                <?php
                if (isset($fail) && $fail=="loginFail"){
                    failMessage("loginFail");
                }elseif(isset($fail) && $fail=403){
                    failMessage("403");
                }
                ?>

                <div class="card-body p-3  border-1 border">
                    <center><span class="h4 text-center">Login</span></center>
                    <form action="<?php echo baseurlpanel()."/loginon" ?>" method="POST">
                    <div class="form-group p-3">
                        <label class="h5">Email address</label>
                        <input type="email" name="email" class="form-control" required style="font-size: 20px;" placeholder="Enter email" autocomplete="off">
                    </div>
                    <div class="form-group pt-0 pl-3 pr-3">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" name="password" class="form-control" required style="font-size: 20px;" placeholder="Password">
                    </div>
                    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION["csrf_token"];?>">
                    <center><button class="btn btn-primary m-3 btn-lg" type="submit">Login</button></center>
                    </form>
                </div>
            </div>
            </center>
            <!--login finish!-->
        </div>
    </div>
    </div>
</div>
</body>
</html>