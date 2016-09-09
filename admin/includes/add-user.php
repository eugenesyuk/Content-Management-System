<?php 
    add_user(); 
    global $add_user_error, $success;
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Users <small>Add new user</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= ADMINURL ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?= ADMINURL ?>users.php">Users</a></li>
        <li class="active">Add user</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
                <?php display_error($add_user_error) ?>
                <?php display_success($success) ?>
                <div class="box box-primary">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form action="" method="post" id="add-user-form" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="username"> * Username </label>
                                <input type="text" class="form-control" id="username" name="username">
                            </div>
                            <div class="form-group">
                                <label for="user_email"> * Email </label>
                                <input type="text" id="user_email" class="form-control" name="user_email">
                            </div>
                            <div class="form-group">
                                <label for="user_password"> * Password </label>
                                <input type="password" class="form-control" id="password" name="user_password">
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation"> * Repeat Password </label>
                                <input type="password" class="form-control" name="password_confirmation" id="p_confirmation">
                            </div>
                            <div class="form-group">
                                <div class="strengh-bar" id="strengh-bar"></div>
                            </div>
                            <div class="form-group">
                                <label for="user_firstname">First Name</label>
                                <input type="text" class="form-control" id="user_firstname" name="user_firstname">
                            </div>
                            <div class="form-group">
                                <label for="user_lastname">Last Name</label>
                                <input type="text" class="form-control" id="user_lastname" name="user_lastname">
                            </div>
                            <div class="form-group">
                                <label for="image">Image</label>
                                <input type="file" name="user_image" id="user_image" data-show-upload="false" class="file">
                            </div>
                            <div class="form-group">
                                <label>Role</label>
                                <select class="form-control" name="user_role">
                                    <option value="subscriber">Subscriber</option>
                                    <option value="administrator">Administrator</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="submit" name="add_user" value="Add user" class="btn btn-primary">
                            </div>
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
<script type="text/javascript" src="<?= ADMINURL ?>js/pwstrength.js"></script>
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