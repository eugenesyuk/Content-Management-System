<?php require_once( dirname(__FILE__). '/includes/header.php'); ?>
    <!-- PAGE HEADER -->
    <div class="page_header">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <div class="page_header_title">
                        <h2>Posts by author</h2>
                        <p>
                            <span>Check out all posts by - </span>
                            <?php if(isset($_GET['name'])) echo strip_tags(trim($_GET['name'])); ?>
                        </p>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="page_header_breadcumb">
                        <ul>
                            <li><a href="<?= HOMEURL; ?>">HOME</a></li>
                            <li><a href="<?= HOMEURL; ?>blog.php">BLOG</a></li>
                            <li>
                                <a class="active">
                                    <span class="uppercase">
                                    <?php if(isset($_GET['name'])) echo strip_tags(trim($_GET['name'])); ?>
                                    </span>
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
                    <?php get_author_posts(); ?>
                </div>

                <?php include('includes/sidebar.php'); ?>

                    <div class="col-md-8">
                        <!-- START PAGINATION -->
                        <div class="pagination_area">
                            <nav>
                                <ul class="pagination">
                                    <?php author_pagination(); ?>
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