<?php include( dirname(__FILE__). '/includes/admin-header.php'); ?>
<?php 
    edit_profile();
    $image = basename($_SESSION['user_image']); 
    global $role_select, $edit_error, $success;
?>
    <?php if(check_access('profile')): ?>
        <!-- LEFT NAVIGATION COLUMN -->
        <?php include( ABSPATH. 'admin/includes/admin-left-sidebar.php'); ?>
            <!-- END LEFT NAVIGATION COLUMN -->

            <!-- CONTENT WRAPPER -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                    Profile <small><?php display_full_name(); ?></small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?= ADMINURL; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Profile</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                                <?php display_error($edit_error); ?>
                                <?php display_success($success); ?>
                                <div class="box box-primary">
                                    <!-- /.box-header -->
                                    <div class="box-body">
                                        <form action="" method="post" id="add-user-form" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label for="display_name"> Username <small>(Cannot be changed)</small></label>
                                                <input type="text" value="<?php display_nick_name(); ?>" class="form-control" id="display_name" disabled="disabled">
                                            </div>
                                            <div class="form-group">
                                                <label for="user_email"> * Email </label>
                                                <input type="text" id="user_email" value="<?php display_email(); ?>" class="form-control" name="user_email">
                                            </div>
                                            <div class="form-group">
                                                <label for="user_password"> New Password</label>
                                                <input type="password" class="form-control" id="password" name="user_password">
                                                <em>Leave blank if dont want to change</em>
                                            </div>
                                            <div class="form-group">
                                                <label for="password_confirmation"> Repeat New Password </label>
                                                <input type="password" class="form-control" name="password_confirmation" id="p_confirmation">
                                            </div>
                                            <div class="form-group">
                                                <div class="strengh-bar" id="strengh-bar"></div>
                                            </div>
                                            <div class="form-group">
                                                <label for="user_firstname">First Name</label>
                                                <input type="text" value="<?php display_firstname(); ?>" class="form-control" id="user_firstname" name="user_firstname">
                                            </div>
                                            <div class="form-group">
                                                <label for="user_lastname">Last Name</label>
                                                <input type="text" value="<?php display_lastname(); ?>" class="form-control" id="user_lastname" name="user_lastname">
                                            </div>
                                            <div class="form-group">
                                                <label for="image">Image</label>
                                                <input type="file" name="user_image" id="image" data-show-upload="false">
                                            </div>
                                            <div class="form-group">
                                                <input type="submit" name="update_user" value="Update profile" class="btn btn-primary">
                                            </div>
                                            <script>
                                                $(document).on('ready', function () {
                                                    $("#image").fileinput(
                                                        <?php if($image) { ?> {
                                                            initialPreview: '<img src="<?= HOMEURL; ?>uploads/users/<?= $image; ?>" class="file-preview-image">'
                                                            , initialCaption: '<?= $image; ?>'
                                                            , previewFileType: "image"
                                                            , allowedFileExtensions: ["jpg", "png"]
                                                            , showRemove: false
                                                            , maxFileSize: 5000
                                                        }
                                                        <?php } ?>
                                                    );
                                                });
                                            </script>
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

                <!-- PASSWORD STHENGTH INDICATOR -->
                <script type="text/javascript" src="<?= ADMINURL; ?>js/pwstrength.js"></script>
                <script type="text/javascript">
                    jQuery(document).ready(function () {
                        "use strict";
                        var options = {};
                        options.ui = {
                            container: "#add-user-form"
                            , verdicts: [
                    "Weak"
                    , "Normal"
                    , "Medium"
                    , "Strong"
                    , "Very Strong"]
                            , showVerdictsInsideProgressBar: true
                            , viewports: {
                                progress: ".strengh-bar"
                            }
                        };
                        options.common = {
                            debug: false
                        };
                        $('#password').pwstrength(options);
                    });
                </script>
            </div>
            <!-- END CONTENT WRAPPER -->
    <?php else: header("Location: ".ADMINURL); endif; ?>
<?php include( ABSPATH. 'admin/includes/admin-footer.php'); ?>