<?php require_once( dirname(__FILE__). '/includes/header.php'); ?>

    <!-- MAIN PARALAX SECTION -->
    <div class="hero_section fixed_bg slider-parallax blog_bg">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <!-- END HERO SECTION DESC -->
                    <div class="inner_hero_section">
                        <h3 class="typed" data-elements="WELCOME TO SK MUSIQUE" style="display:inline"></h3>
                        <h4 class="fadeIn" style="display:none">Lessons / Tabs / Software</h4>
                    </div>
                    <!-- END HERO SECTION DESC -->
                </div>
            </div>
        </div>
    </div>
    <!-- MAIN PARALAX SECTION -->

    <!-- LATEST POSTS -->
    <section class="blog_page">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="row masonry-container" style="position: relative; height: 1947px;">
                        <?php latest_posts(); ?>
                    </div>
                </div>
                <div class="col-md-12 text-center">
                    <!-- START PAGINATION -->
                    <div class="pagination_area">
                        <nav>
                            <ul class="pagination">
                                <?php latest_pagination(); ?>
                            </ul>
                        </nav>
                    </div>
                    <!-- END PAGINATION -->
                </div>
            </div>
        </div>
    </section>
    <!-- END LATEST POSTS -->

    <!-- SUBSCRIBE -->
    <div class="subscribe_area">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="inner_subscribe">
                        <h2><span>SUBSCRIBE</span> TO GET IN TOUCH</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, </p>
                        <!--  SUBSCRIBE FORM -->
                        <form id="mc-form">
                            <label class="InputEmail1_lab" for="mce-EMAIL"></label>
                            <input type="email" class="form-control required email" id="mce-EMAIL" placeholder="ENTER YOUR EMAIL" name="EMAIL">
                            <button type="submit" class="btn btn-sb">SUBSCRIBE</button>
                        </form>
                        <!-- END SUBSCRIBE FORM -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END SUBSCRIBE -->

    <?php include( ABSPATH. 'includes/footer.php'); ?>