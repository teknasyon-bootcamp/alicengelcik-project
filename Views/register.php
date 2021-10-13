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
                <div class="card-body p-3  border-1 border">
                    <center><span class="h4 text-center">Register</span></center>
                    <div class="form-group p-3">
                        <?php
                        if (isset($fail) && $fail=="registerFail"){
                            echo failMessage("registerFail");
                        }elseif (isset($register) && $register=="yes"){
                        echo "<div class='alert alert-success'><h5>Register Successful!</h5></div>";
                        }
                        ?>
                        <form action="/registersave" method="POST">
                            <div style="text-align: left;">
                                <label class="h5 me-3">Gender: </label>
                                <input class="p-2 form-check-input" checked type="radio" name="gender" value="1">
                                <label for="gender" class="me-3">Male</label>
                                <input class="p-2 form-check-input" type="radio" name="gender" value="2">
                                <label for="gender">Female</label>
                            </div>
                            </select>
                            </select>
                        <input type="text" name="name" class="form-control mt-3" style="font-size: 20px;" placeholder="Name" required>
                        <input type="text" name="surname" class="form-control mt-3" style="font-size: 20px;" placeholder="Surname" required>
                        <input type="email" name="email" class="form-control mt-3" style="font-size: 20px;" placeholder="Email" required>
                    </div>
                    <div class="form-group ps-3 pe-3">
                        <input type="password" name="password" class="form-control" style="font-size: 20px;" placeholder="Password" required>
                    </div>
                    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION["csrf_token"]; ?>">
                    <center><button class="btn btn-success m-3 btn-lg" type="submit">Register</button></center>
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