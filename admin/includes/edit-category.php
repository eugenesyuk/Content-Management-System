<?php global $edit_input ?>
<div class="box-header with-border">
    <h3 class="box-title">Edit category</h3>
    <div class="box-tools pull-right">
        <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse"><i class="fa fa-minus"></i></button>
    </div>
</div>
<!-- /.box-header -->
<!-- form start -->
<form role="form" action="" method="post">
    <div class="box-body">
        <div class="form-group">
            <label for="title">Category name</label>
            <?= $edit_input ?>
        </div>
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
        <div class="form-group">
            <input type="submit" name="update_category" value="Update Category" class="btn btn-primary">
            <button type="submit" class="btn btn-default"><a href="<?= ADMINURL ?>categories.php">Cancel</a></button>
        </div>
    </div>
</form>