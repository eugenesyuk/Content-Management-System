<?php 
    edit_post();
    get_post_data_to_edit();
    global $get_post_data_id_to_get, $get_post_data_author, $get_post_data_title, $get_post_data_cat_id, $get_post_data_status, $get_post_data_image, $get_post_data_date, $get_post_data_tags, $get_post_data_content, $get_post_data_comment_count, $edit_error, $success;
?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Posts
            <small>Edit post</small>
          </h1>
        <ol class="breadcrumb">
            <li><a href="<?= ADMINURL ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?= ADMINURL ?>posts.php">Posts</a></li>
            <li class="active">Edit post</li>
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
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" class="form-control" name="post_title" value="<?= $get_post_data_title; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="title">Category</label>
                                    <br>
                                    <?php get_categories_select($get_post_data_cat_id); ?>
                                </div>
                                <div class="form-group">
                                    <label for="author">Author</label>
                                    <input type="text" class="form-control" name="post_author" value="<?= $get_post_data_author; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <br>
                                    <?php get_post_status_select($get_post_data_status); ?>
                                </div>
                                <div class="form-group">
                                    <label for="image">Image</label>
                                    <input type="file" id="image" name="post_image" data-show-upload="false">
                                </div>
                                <div class="form-group">
                                    <label for="tags">Tags</label>
                                    <br>
                                    <input type="text" value="<?= $get_post_data_tags; ?>" class="form-control" data-role="tagsinput" name="post_tags">
                                </div>
                                <div class="form-group">
                                    <label for="content"></label>
                                    <textarea name="post_content" id="" cols="30" rows="10" class="form-control">
                                        <?= $get_post_data_content; ?>
                                    </textarea>
                                </div>
                                <div class="form-group">
                                    <input type="submit" name="update_post" value="Update Post" class="btn btn-primary">
                                    <button class="btn btn-default"><a href="<?= ADMINURL; ?>posts.php">Cancel</a></button>
                                </div>
                            </form>
                            <script>
                                $(document).on('ready', function () {
                                    $("#image").fileinput(
                                        <?php if(!empty($get_post_data_image)): ?> {
                                            initialPreview: '<img src="<?= HOMEURL; ?>uploads/posts/<?= $get_post_data_image; ?>" class="file-preview-image">'
                                            , initialCaption: '<?= $get_post_data_image; ?>'
                                            , previewFileType: "image"
                                            , allowedFileExtensions: ["jpg", "png"]
                                        }
                                        <?php endif ?>
                                    );
                                });
                            </script>
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
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
    <script>
        tinymce.init({
            selector: 'textarea'
            , height: 500
            , theme: 'modern'
            , plugins: [
        'advlist autolink lists link image charmap print preview hr anchor pagebreak'
        , 'searchreplace wordcount visualblocks visualchars code fullscreen'
        , 'insertdatetime media nonbreaking save table contextmenu directionality'
        , 'emoticons template paste textcolor colorpicker textpattern imagetools'
      ]
            , toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | preview media | forecolor backcolor emoticons'
            , image_advtab: true
            , templates: [
      ]
            , content_css: [
        '//fast.fonts.net/cssapi/e6dc9b99-64fe-4292-ad98-6974f93cd2a2.css'
        , '<?= ADMINURL; ?>css/tinymce-content.css'
      ]
        });
    </script>