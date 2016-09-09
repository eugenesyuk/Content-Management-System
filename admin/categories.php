<?php include( dirname(__FILE__). '/includes/admin-header.php'); ?>
    <?php 
    categories_actions();
    global $insert_error, $update_error, $success; 
?>
        <?php if(check_access('categories')): ?>
            <!-- Left side column. contains the logo and sidebar -->
            <?php include( ABSPATH. 'admin/includes/admin-left-sidebar.php'); ?>
                <!-- Content Wrapper. Contains page content -->
                <div class="content-wrapper">
                    <!-- Content Header (Page header) -->
                    <section class="content-header">
                        <h1>
            Categories
            <small>management</small>
          </h1>
                        <ol class="breadcrumb">
                            <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
                            <li class="active">Categories</li>
                        </ol>
                    </section>

                    <!-- Main content -->
                    <section class="content">
                        <?php display_error($insert_error); ?>
                            <?php display_error($update_error); ?>
                                <?php display_success($success); ?>
                                    <div class="row">
                                        <!-- left column -->
                                        <div class="col-md-6">
                                            <!-- Categories table box -->
                                            <div class="box box-primary">
                                                <div class="box-header with-border">
                                                    <h3 class="box-title">All categories</h3>
                                                    <div class="box-tools pull-right">
                                                        <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse"><i class="fa fa-minus"></i></button>
                                                    </div>
                                                </div>
                                                <div class="box-body">
                                                    <form action="" method="post">
                                                        <div class="row bulk-gutter" id="bulkactions">
                                                            <div class="col-sm-4 col-lg-3">
                                                                <select name="bulk_action" id="" class="form-control bulk">
                                                                    <option value="">Bulk Actions</option>
                                                                    <option value="delete">Delete</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-sm-3 col-md-3 col-lg-2">
                                                                <button type="submit" class="btn btn-default form-control bulk" name="bulk_submit">Apply</button>
                                                            </div>
                                                        </div>
                                                        <table class="table table-striped table-hover" id="categories">
                                                            <thead>
                                                                <tr>
                                                                    <th>
                                                                        <input id="select-all" type="checkbox">
                                                                    </th>
                                                                    <th>Category Name</th>
                                                                    <th></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php get_all_categories(); ?>
                                                            </tbody>
                                                        </table>
                                                    </form>
                                                </div>
                                                <!-- /.box-body -->
                                            </div>
                                            <!-- /.box -->


                                        </div>
                                        <!--/.col (left) -->
                                        <!-- right column -->
                                        <div class="col-md-6">
                                            <!-- Horizontal Form -->
                                            <div class="box box-info">
                                                <?php switch_cat_edit_forms(); ?>
                                            </div>
                                            <!-- /.box -->
                                        </div>
                                        <!--/.col (right) -->
                                    </div>
                                    <!-- /.row -->
                    </section>
                    <!-- /.content -->
                </div>
                <script>
                    jQuery(document).ready(function ($) {
                        //iCheck for checkbox and radio inputs
                        $('input[type="checkbox"].post-checkbox, #select-all').iCheck({
                            checkboxClass: 'icheckbox_minimal-blue'
                        , });

                        $('#select-all').on('ifChecked', function (event) {
                            $('.post-checkbox').each(function (event) {
                                $(this).iCheck('check');
                            });
                        });

                        $('#select-all').on('ifUnchecked', function (event) {
                            $('.post-checkbox').each(function (event) {
                                $(this).iCheck('uncheck');
                            });
                        });
                    });
                </script>
                <?php else: header("Location: ".ADMINURL); endif?>
                <?php include( ABSPATH. 'admin/includes/admin-footer.php'); ?>