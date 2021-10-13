<link href="/assets/css/bootstrap.min.css" rel="stylesheet">
<link href="/assets/css/style.css" rel="stylesheet">
<script src="/assets/js/bootstrap.bundle.min.js"></script>

</head>
<body>
<!--Navbar Menu Start!-->
<nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
    <div class="container">
        <div class="col-10 col-sm-12">
            <div class="container-fluid p-1">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                    <a class="navbar-brand bg-danger p-3" href="<?php echo baseurl(); ?>">NEWS</a>
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <strong><a class="nav-link active text-danger" aria-current="page" href="<?php echo baseurl(); ?>">HOME</a></strong>
                        </li>
                        <?php
                        $allcategory=getAllCategory();
                        foreach ($allcategory as $category){
                            $link='/news/'.$category["id"].'/'.seflink($category["category"]);
                            $name=ucwords($category['category']);
                        echo "<li class='nav-item'>
                            <strong><a class='nav-link text-danger' href='$link'>$name</a></strong></li>";
                        } ?>
                    </ul>

                    <div class="d-flex">

                        <?php
                            if (!isset($_SESSION["login"])==true){?>
                        <a class="btn btn-primary me-3" type="submit" href="<?php echo registerURL();?>">Register</a>
                        <a class="btn btn-outline-light" type="submit" href="<?php echo loginURL();?>">Login</a>
                            <?php }
                            else{
                                $userInfo=getUserInfo($_SESSION["user_id"])[0];
                                $name=$userInfo["name"]." ".$userInfo["surname"];
                                $sefaccount=baseurl()."user/".seflink($name);
                        ?>
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                Welcome, <strong><?php echo $name; ?></strong>
                            </button>
                            <ul class="dropdown-menu text-center" style="right: 0px" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item" href="<?php echo $sefaccount; ?>"><i class="bi bi-person-circle"></i>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                                            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                                        </svg>
                                        Account</a></li>
                                <li><a class="dropdown-item" href="<?php echo baseurl().'logout'; ?>">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-box-arrow-in-left" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M10 3.5a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-2a.5.5 0 0 1 1 0v2A1.5 1.5 0 0 1 9.5 14h-8A1.5 1.5 0 0 1 0 12.5v-9A1.5 1.5 0 0 1 1.5 2h8A1.5 1.5 0 0 1 11 3.5v2a.5.5 0 0 1-1 0v-2z"/>
                                            <path fill-rule="evenodd" d="M4.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H14.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z"/>
                                        </svg>
                                        Logout</a></li>
                            </ul>
                        </div>
                        <?php }?>
                        <!--

                        !-->
                    </div>
                </div>
            </div>
        </div></div>
</nav>