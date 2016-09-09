<?php require_once( dirname(__FILE__). '/includes/header.php'); ?>
<?php
    global $category_title;
    get_category_title();
?>
    <!-- PAGE HEADER -->
    <div class="page_header">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <div class="page_header_title">
                        <h2>CATEGORY POSTS</h2>
                        <p>Check out our latest posts in category - 
                        <span><?php if(!empty($category_title)) echo $category_title; ?></span>
                        </p>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="page_header_breadcumb">
                        <ul>
                            <li><a href="<?= HOMEURL; ?>">HOME</a></li>
                            <li><a href="<?= HOMEURL; ?>blog.php">BLOG</a></li>
                            <li>
                                <a class="active uppercase">
                                    <?php if(!empty($category_title)) echo $category_title; ?>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END PAGE HEADER -->

    </header>
    <!-- START BLOG SECTION -->
    <section class="blog_page">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <?php get_category_posts(); ?>
                </div>
                
                <?php include('includes/sidebar.php'); ?>
                
                <div class="col-md-8">
                    <!-- START PAGINATION -->
                    <div class="pagination_area">
                        <nav>
                            <ul class="pagination">
                                <?php category_pagination(); ?>
                            </ul>
                        </nav>
                    </div>
                    <!-- END PAGINATION -->
                </div>
            </div>
        </div>
    </section>
    <!-- START BLOG SECTION -->
<?php include( ABSPATH. 'includes/footer.php'); ?>