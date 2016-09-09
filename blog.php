<?php require_once( dirname(__FILE__). '/includes/header.php'); ?>
    <!-- PAGE HEADER -->
    <div class="page_header">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <div class="page_header_title">
                        <h2>BLOG</h2>
                        <p>Here you can find our latest articles, lessons, covers.</p>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="page_header_breadcumb">
                        <ul>
                            <li><a href="<?= HOMEURL; ?>">HOME</a></li>
                            <li><a class="active">BLOG</a></li>
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
                    <?php get_blog_posts(); ?>
                </div>

                <?php include('includes/sidebar.php'); ?>

                    <div class="col-md-8">
                        <!-- START PAGINATION -->
                        <div class="pagination_area">
                            <nav>
                                <ul class="pagination">
                                    <?php blog_pagination(); ?>
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