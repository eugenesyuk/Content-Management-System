<?php include( dirname(__FILE__). '/includes/header.php'); ?>
     <!-- PAGE HEADER -->
    <div class="page_header">
        <div class="container">
            <div class="row">
                <div class="col-md-7">
                    <div class="page_header_title">
                        <h2>Search</h2>
                        <p>Showing results for - "<?php search_query() ?>"</p>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="page_header_breadcumb">
                        <ul>
                            <li><a href="<?= HOMEURL; ?>">HOME</a></li>
                            <li><a class="active">SEARCH</a></li>
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
                    <?php search_by_tags(); ?>
                </div>
                
                <?php include('includes/sidebar.php'); ?>
                
                <div class="col-md-8">
                    <!-- START PAGINATION -->
                    <div class="pagination_area">
                        <nav>
                            <ul class="pagination">
                                <li>
                                    <a class="prev" href="#" aria-label="Previous">
                            Prev
                          </a>
                                </li>
                                <li class="active"><a href="#">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">4</a></li>
                                <li><a href="#">5</a></li>
                                <li>
                                    <a class="next" href="#" aria-label="Next">
                            Next
                          </a>
                                </li>
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