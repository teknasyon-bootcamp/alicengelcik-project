<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <?php

            use App\Controller\panel\AuthController;

            $userInfo=getUserInfo($_SESSION["panel_user_id"])[0];
            $name=$userInfo["name"]." ".$userInfo["surname"];
            $img=getImageURL("users",$userInfo["image"]);
            ?>
            <div class="image">
                <img src="<?php echo $img;?>" class="img-circle elevation-2" alt="User Image">

            </div>
            <div class="info"><a href="#" class="d-block col-12"><?php echo $name;?></a></div>
            <a class="btn btn-danger text-right mt-1" href="<?php echo baseurlpanel()."/logout";?>" class="d-block">Logout</a>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item menu-is-opening menu-open">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo baseurlpanel(); ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <?php if (AuthController::permissionControl([99,7],"menu")){?>
                <li class="nav-item menu-is-opening menu-open">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tasks"></i>
                        <p>
                            Authorization
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo baseurlpanel()."/rolepermission"; ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Role Permissions</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo baseurlpanel()."/userroles"; ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>User Roles</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo baseurlpanel()."/usercategory"; ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>User Category</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <?php }?>
                <li class="nav-item menu-is-opening menu-open">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-newspaper"></i>
                        <p>
                            News
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo baseurlpanel()."/addnews"; ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add News</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo baseurlpanel()."/newslist"; ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>News List</p>
                            </a>
                    </ul>
                </li>
                <?php if (AuthController::permissionControl([99,2],"menu")){?>
                <li class="nav-item menu-is-opening menu-open">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-comments"></i>
                        <p>
                            Comment
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo baseurlpanel()."/commentlist"; ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Comment List</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <?php }?>
                <?php if (AuthController::permissionControl([99,3],"menu")){?>
                <li class="nav-item menu-is-opening menu-open">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-user-cog"></i>
                        <p>
                            Account
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo baseurlpanel()."/accountmanage"; ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Account Management</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <?php } ?>
                <?php if (AuthController::permissionControl([99,14],"menu")){?>
                <li class="nav-item menu-is-opening menu-open">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fab fa-elementor"></i>
                        <p>
                            Category
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo baseurlpanel()."/addcategory"; ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add Category</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo baseurlpanel()."/categorylist"; ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Category List</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <?php } ?>
                <?php if (AuthController::permissionControl([99,8],"menu")){?>
                <li class="nav-item menu-is-opening menu-open">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>
                            Config
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo baseurlpanel()."/config"; ?>" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Config List</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <?php } ?>
            </ul>
            </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>