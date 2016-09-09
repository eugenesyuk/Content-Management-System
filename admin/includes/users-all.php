<?php
    global $success;
    users_bulk_actions();
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
                Users
            <small>Management</small>
          </h1>
    <ol class="breadcrumb">
        <li><a href="<?= ADMINURL; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?= ADMINURL; ?>users.php">Users</a></li>
        <li class="active">All users</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <?php display_success($success); ?>
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">All users</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse"><i class="fa fa-minus"></i></button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <form action="" method="post">
                        <div class="row bulk-gutter" id="bulkactions">
                            <div class="col-sm-3 col-lg-2">
                                <select name="bulk_action" id="" class="form-control bulk">
                                    <option value="">Bulk Actions</option>
                                    <option value="delete">Delete</option>
                                </select>
                            </div>
                            <div class="col-sm-2 col-md-2 col-lg-1">
                                <button type="submit" class="btn btn-default form-control bulk" name="bulk_submit">Apply</button>
                            </div>
                        </div>
                        <table id="users" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>
                                        <input id="select-all" type="checkbox">
                                    </th>
                                    <th>Username</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Posts</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php users(); ?>
                            </tbody>
                            <!--
                                    <tfoot>
                                        <tr>
                                            <th>Rendering engine</th>
                                            <th>Browser</th>
                                            <th>Platform(s)</th>
                                            <th>Engine version</th>
                                            <th>CSS grade</th>
                                        </tr>
                                    </tfoot>
-->
                        </table>
                    </form>
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