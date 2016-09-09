<div class="col-md-3 col-md-offset-1">
    <!-- START SIDEBAR -->
    <div class="sidebar">
        <!-- START WIDGET -->
        <div class="widget search">
            <form action="<?= HOMEURL; ?>search.php" method="post">
                <div class="form-group">
                    <i class="pe-7s-search"></i>
                    <input type="search" name="search" class="form-control" id="Search" placeholder="Search Here ...">
                </div>
            </form>
        </div>
        <!-- END WIDGET -->


        <!-- START WIDGET -->
        <div class="widget category">
            <h2>Categoties</h2>
            <ul>
                <?php blog_categories(); ?>
            </ul>
        </div>
        <!-- END WIDGET -->

        <!-- START WIDGET -->
        <div class="widget tags">
            <h2>Tags</h2>
            <ul>
                <li><a href="#">Branding</a></li>
                <li><a href="#">Web</a></li>
                <li><a href="#">Photography</a></li>
                <li><a href="#">Development</a></li>
                <li><a href="#">Ui</a></li>
                <li><a href="#">Ux</a></li>
                <li><a href="#">Art</a></li>
            </ul>
        </div>
        <!-- END WIDGET -->

        <!-- START WIDGET -->
        <div class="widget recent_post">
            <h2>Recent Post</h2>
            <?php recent_posts_widget(); ?>
        </div>
    </div>
    <!-- END SIDEBAR -->
</div>