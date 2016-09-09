<?php include( dirname(__FILE__). '/includes/admin-header.php'); ?>
    <?php if(check_access('comments')): ?>
        <?php 
            global $success;
            comments_actions();
        ?>
        <!-- Left side column. contains the logo and sidebar -->
        <?php include( ABSPATH. 'admin/includes/admin-left-sidebar.php'); ?>
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
            Comments
            <small>management</small>
          </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Comments</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <?php display_success($success); ?>
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <h3 class="box-title">All comments</h3>
                                    <div class="box-tools pull-right">
                                        <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse"><i class="fa fa-minus"></i></button>
                                    </div>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <?php switch_comments_source(); ?>
                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->
    <?php else: header("Location: ".ADMINURL); endif ?>
<?php include( ABSPATH. 'admin/includes/admin-footer.php'); ?>