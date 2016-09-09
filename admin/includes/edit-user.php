<?php 
    edit_user();
    global $user_id_to_get, $get_user_data_username, $get_user_data_firstname,
    $get_user_data_lastname, $get_user_data_email, $get_user_data_image, $get_user_data_role, $edit_error, $role_select, $success;
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Users <small>Edit user</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= ADMINURL; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?= ADMINURL; ?>users.php">Users</a></li>
        <li class="active">Edit user</li>
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
                                    <label for="username"> Username <small>(Cannot be changed)</small></label>
                                    <input type="text" value="<?= $get_user_data_username; ?>" class="form-control" id="username" disabled="disabled">
                                </div>
                                <div class="form-group">
                                    <label for="user_email"> * Email </label>
                                    <input type="text" id="user_email" value="<?= $get_user_data_email; ?>" class="form-control" name="user_email">
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
                                    <input type="text" value="<?= $get_user_data_firstname; ?>" class="form-control" id="user_firstname" name="user_firstname">
                                </div>
                                <div class="form-group">
                                    <label for="user_lastname">Last Name</label>
                                    <input type="text" value="<?= $get_user_data_lastname; ?>" class="form-control" id="user_lastname" name="user_lastname">
                                </div>
                                <div class="form-group">
                                    <label for="image">Image</label>
                                    <input type="file" name="user_image" id="image" data-show-upload="false">
                                </div>
                                <div class="form-group">
                                    <label>Role</label><br>
                                    <?= $role_select; ?>
                                </div>
                                <div class="form-group">
                                    <input type="submit" name="update_user" value="Update user" class="btn btn-primary">
                                </div>
                                <script>
                                    $(document).on('ready', function () {
                                        $("#image").fileinput(
                                            <?php if(!empty($get_user_data_image)): ?> {
                                                initialPreview: '<img src="<?= HOMEURL; ?>uploads/users/<?= $get_user_data_image; ?>" class="file-preview-image">'
                                                , initialCaption: '<?= $get_user_data_image; ?>'
                                                , previewFileType: "image"
                                                , allowedFileExtensions: ["jpg", "png"]
                                                , showRemove: false
                                                , maxFileSize: 5000
                                            }
                                            <?php endif ?>
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
                container: "#add-user-form",
                 verdicts: [
                    "Weak",
                    "Normal",
                    "Medium",
                    "Strong",
                    "Very Strong"],
                showVerdictsInsideProgressBar: true,
                viewports: {
                    progress: ".strengh-bar"
                }
            };
            options.common = {
                debug: false
            };
            $('#password').pwstrength(options);
        });
</script>