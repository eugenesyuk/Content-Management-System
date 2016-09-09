<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php display_image() ?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?php display_full_name() ?></p>
                <small class="capitalize"><?php display_role() ?></small>
            </div>
        </div>

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <?php admin_navigation() ?>
    </section>
    <!-- /.sidebar -->
</aside>