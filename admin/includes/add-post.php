<?php 
    publish_post(); 
    global $publish_error, $draft_error, $success;
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
            Posts
            <small>Add new post</small>
          </h1>
    <ol class="breadcrumb">
        <li><a href="<?= ADMINURL ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?= ADMINURL ?>posts.php">Posts</a></li>
        <li class="active">Add post</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <?php display_error($publish_error) ?>
            <?php display_success($success) ?>
            <?php display_error($draft_error) ?>
            <div class="box box-primary">
                <!-- /.box-header -->
                <div class="box-body">
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="title"> * Title </label>
                                <input type="text" class="form-control" name="post_title">
                            </div>
                            <div class="form-group">
                                <label for="image"> * Image </label>
                                <input type="file" name="post_image" data-show-upload="false" class="file">
                            </div>
                            <div class="form-group">
                                <label for="post_category">Category</label>
                                <br>
                                <?php get_categories_select() ?>
                            </div>
                            <div class="form-group">
                                <label for="tags">Tags</label>
                                <br>
                                <input type="text" class="form-control" data-role="tagsinput" name="post_tags">
                            </div>
                            <div class="form-group">
                                <label for="content"></label>
                                <textarea name="post_content" id="" cols="30" rows="10" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <input type="submit" name="create_post" value="Publish Post" class="btn btn-primary">
                                <input type="submit" name="save_draft" value="Save Draft" class="btn btn-default">
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
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script>
    tinymce.init({
      selector: 'textarea',
      height: 500,
      theme: 'modern',
      plugins: [
        'advlist autolink lists link image charmap print preview hr anchor pagebreak',
        'searchreplace wordcount visualblocks visualchars code fullscreen',
        'insertdatetime media nonbreaking save table contextmenu directionality',
        'emoticons template paste textcolor colorpicker textpattern imagetools'
      ],
      toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | preview media | forecolor backcolor emoticons',
      image_advtab: true,
      templates: [
      ],
      content_css: [
        '//fast.fonts.net/cssapi/e6dc9b99-64fe-4292-ad98-6974f93cd2a2.css',
        '<?= ADMINURL ?>css/tinymce-content.css'
      ]
     });
</script>

<!-- /.content -->