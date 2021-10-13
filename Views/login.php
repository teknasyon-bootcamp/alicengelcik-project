<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>NEWS | Home Page</title>
    <?php include("header.php"); ?>

<!--Navbar Menu Finish!-->

<!--Crousel Start!-->
<div class="container">
<div class="col-12">
<!--Crousel Finish!-->
    <div class="container p-0">
        <div class="row ps-0 me-0">


            <!--login start!-->
            <center>
            <div class="col-6 mt-5">
                <?php
                if (isset($false)){
                    echo "<div class='alert alert-danger'><h5>Login failed!</h5> The email or password is incorrect</div>";
                }
                ?>

                <div class="card-body p-3  border-1 border">
                    <center><span class="h4 text-center">Login</span></center>
                    <div class="form-group p-3">
                        <form action="/loginon" method="POST">
                        <label class="h5">Email address</label>
                        <input type="email" name="email" class="form-control" style="font-size: 20px;" placeholder="Enter email" autocomplete="off">
                    </div>
                    <div class="form-group ps-3 pe-3">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" name="password" class="form-control" style="font-size: 20px;" placeholder="Password">
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
    <?php include("footer.php"); ?>
</body>
</html>