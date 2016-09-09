<?php require_once( dirname(__FILE__). '/includes/header.php'); ?>
<?php
    global $category_title, $category_id;
    get_category_title_by_post();
?>
    <!-- PAGE HEADER -->
    <div class="page_header">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <div class="page_header_title">
                        <h2>BLOG POST</h2>
                        <p>Lorem Ipsum is simply dummy text of the printing.</p>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="page_header_breadcumb">
                        <ul>
                            <li><a href="<?= HOMEURL; ?>">HOME</a></li>
                            <li><a href="<?= HOMEURL; ?>blog.php">BLOG</a></li>
                            <li>
                                <a href="<?= HOMEURL; ?>category.php?id=<?= $category_id; ?>" class="uppercase">
                                    <?php echo $category_title; ?>
                                </a>
                            </li>
                            <li><a class="active">POST</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END PAGE HEADER -->
    <!-- BLOG SECTION -->
    <section class="blog_page">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <!-- START SINGLE BLOG ELEMENT -->
                    <?php get_post(); ?>
                        <!-- END SINGLE BLOG ELEMENT -->


                        <!-- START COMMENT SECTION -->
                        <div class="comment_section" id="comments">
                            <h6>Comments</h6>
                            <ul class="comment_list">
                            <?php get_post_comments(); ?>
                            </ul>
                        </div>
                        <!-- END COMMENT SECTION -->
                        
                        <?php if(isset($_SESSION['username'])): ?>
                        
                        <!-- START COMMENT FORM -->
                        <div class="comment_form">
                            <form action="" method="post">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <textarea class="form-control" rows="5" name="comment_content" id="Comment" placeholder="Write Down Your Comment" required></textarea>
                                        </div>

                                    </div>
                                    <div class="col-md-12">
                                        <input type="submit" class="btn cmnt_sbt" name="add_comment" value="Submit Comment">
                                    </div>
                                </div>
                            </form>
                            <?php add_comment(); ?>
                        </div>
                        <!-- END COMMENT FORM -->
                        
                        <?php endif; ?>
                </div>
                <?php include( ABSPATH. 'includes/sidebar.php'); ?>
            </div>
        </div>
    </section>
    <!-- START BLOG SECTION -->
<?php include( ABSPATH. 'includes/footer.php'); ?>