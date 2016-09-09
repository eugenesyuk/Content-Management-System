<?php include( dirname(__FILE__). '/includes/admin-header.php'); ?>
    <?php if(check_access('posts')) { ?>
        <!-- LEFT NAVIGATION COLUMN -->
        <?php include( ABSPATH. 'admin/includes/admin-left-sidebar.php'); ?>
        <!-- END LEFT NAVIGATION COLUMN -->
        
        <!-- CONTENT WRAPPER -->
        <div class="content-wrapper">
            <?php switch_posts_source(); ?>
        </div>
        <!-- END CONTENT WRAPPER -->
    <?php } else header("Location: ".ADMINURL); ?>
<?php include( ABSPATH. 'admin/includes/admin-footer.php'); ?>