<!-- NAV MENU -->
<nav class="navbar-fixed-top">
    <div class="container">
        <div id="menuzord" class="menuzord red">
            <a href="<?= HOMEURL; ?>" class="menuzord-brand"><img src="<?= HOMEURL; ?>images/logo.png" alt=""></a>
                        <div class="right_mp_menu">
                <ul>
                    <?php if(!user_loged_in()): ?>
                    <li>
                        <a id="filter-login" class="signup-link" href="<?= ADMINURL; ?>login.php">Login</a>/<a id="filter-login" class="signup-link" href="<?= ADMINURL; ?>register.php">Register</a>
                    </li>
                        
                    <?php else: ?>
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="<?php display_image() ?>" class="user-image" alt="User Image"><?php display_full_name(); ?><span class="hidden-xs"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header">
                                    <img src="<?php display_image() ?>" class="img-circle" alt="User Image">
                                    <p>
                                        <?php display_nick_name(); ?> - <span class="capitalize"><?php display_role(); ?></span>
                                            <br>
                                            <small>Member since <?php display_registration_date('F Y'); ?></small>
                                    </p>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="user-buttons">
                                        <a href="<?= ADMINURL; ?>profile.php">
                                            <button type="button" class="btn_st_five btn btn-primary btn-xs">Profile</button>
                                        </a>
                                        <a href="<?= ADMINURL; ?>logout.php">
                                            <button type="button" class="btn_st_five btn btn-primary btn-xs">Logout</button>
                                        </a>
                                        <?php if(is_administrator()): ?>
                                            <a href="<?= ADMINURL; ?>">
                                                <button type="button" id="admin_btn" class="btn_st_five btn btn-primary btn-xs">Administration</button>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    <?php endif; ?>
                    <li><a id="filter-search" href="javascript:void(0)"><i class="fa fa-search"></i>SEARCH</a></li>
                </ul>
            </div>
            <ul class="menuzord-menu mp_menu">
                <li <?php check_class( 'index'); ?>><a href="<?= HOMEURL; ?>">HOME</a></li>
                <li <?php check_class( 'blog'); ?>><a href="<?= HOMEURL; ?>blog.php">BLOG</a>
                    <ul class="dropdown">
                        <li><a href="<?= HOMEURL; ?>blog.php">All posts</a></li>
                        <?php blog_categories(); ?>
                    </ul>
                </li>
                <li><a href="javascript:void(0)">Tabs</a>
                    <ul class="dropdown">
                        <li><a href="javascript:void(0)">Category</a></li>
                        <li><a href="javascript:void(0)">Category</a></li>
                    </ul>
                </li>
                <li><a href="javascript:void(0)">Apps</a></li>
                <li><a href="javascript:void(0)">Contact</a></li>
                <li style="height: 1px" class="scrollable-fix"></li>
            </ul>
        </div>
    </div>
</nav>
<!-- END NAV BAR -->