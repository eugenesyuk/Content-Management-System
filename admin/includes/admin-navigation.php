<nav class="navbar navbar-static-top" role="navigation">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
    </a>
    <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
            <!-- User Account: style can be found in dropdown.less -->
            <li><a href="<?= HOMEURL; ?>">Home Page</a></li>
            <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <img src="<?php display_image() ?>" class="user-image" alt="User Image">
                    <?php display_full_name(); ?>
                    <span class="hidden-xs"></span>
                </a>
                <ul class="dropdown-menu">
                    <!-- User image -->
                    <li class="user-header">
                        <img src="<?php display_image() ?>" class="img-circle" alt="User Image">
                        <p>
                            <?php display_nick_name(); ?> - <span class="capitalize"><?php display_role(); ?></span>
                            <small>Member since <?php display_registration_date('F Y'); ?></small>
                        </p>
                    </li>
                    <!-- Menu Footer-->
                    <li class="user-footer">
                        <div class="pull-left">
                            <a href="<?= ADMINURL; ?>profile.php" class="btn btn-default btn-flat">Profile</a>
                        </div>
                        <div class="pull-right">
                            <a href="<?= ADMINURL; ?>logout.php" class="btn btn-default btn-flat">Sign out</a>
                        </div>
                    </li>
                </ul>
            </li>
            <!-- Home Button -->
        </ul>
    </div>
</nav>