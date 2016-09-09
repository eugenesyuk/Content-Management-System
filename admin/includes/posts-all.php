<?php 
    global $success; 
    posts_actions();
?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Posts <small>Management</small></h1> 
        <ol class="breadcrumb">
            <li><a href="<?= ADMINURL; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?= ADMINURL; ?>posts.php">Posts</a></li>
            <li class="active">All posts</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <?php display_success($success); ?>
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <a class="btn-sm btn-primary" href="<?= ADMINURL; ?>posts.php?source=add_post">Add new</a>
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
                                            <option value="published">Publish</option>
                                            <option value="draft">Draft</option>
                                            <option value="clone">Clone</option>
                                            <option value="delete">Delete</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-2 col-md-2 col-lg-1">
                                        <button type="submit" class="btn btn-default form-control bulk" name="bulk_submit">Apply</button>
                                    </div>
                                </div>
                                <table id="posts" class="table table-hover table-responsive table-striped">
                                    <thead>
                                        <tr>
                                            <th><input id="select-all" type="checkbox"></th>
                                            <th>Title</th>
                                            <th>Author</th>
                                            <th>Category</th>
                                            <th>Tags</th>
                                            <th><i class="fa fa-commenting"></i></th>
                                            <th>Last update</th>
                                            <th>Status</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php posts(); ?>
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
            $('.count').counterUp();
            
            //iCheck for checkbox and radio inputs
            $('input[type="checkbox"].post-checkbox, #select-all').iCheck({
              checkboxClass: 'icheckbox_minimal-blue',
            });
            
            $('#select-all').on('ifChecked', function(event){
                $('.post-checkbox').each(function(event){
                    $(this).iCheck('check');
                });
            });
            
            $('#select-all').on('ifUnchecked', function(event){
                $('.post-checkbox').each(function(event){
                    $(this).iCheck('uncheck');
                });
            });
        });
    </script>