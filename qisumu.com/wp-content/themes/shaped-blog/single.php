<?php get_header(); ?>

    <div class="container">
        <div class="row">
            <div class="<?php echo get_theme_mod('shaped_blog_home_layout', 'col-md-8'); ?>">
                <div id="primary" class="content-area">
                    <main id="main" class="site-main" role="main">

                        <?php if (have_posts()) :
                            while (have_posts()) :
                                the_post();
                                ?>

                                <?php get_template_part( 'content-single' ); ?>

                                <?php if (!get_theme_mod('shaped_blog_post_nav')) { ?>
                                    <div class="post-nav-area">
                                        <?php shaped_blog_post_navigation(); ?>
                                    </div>
                                <?php } ?>

                                <?php
                                // If comments are open or we have at least one comment, load up the comment template
                                if (comments_open() || '0' != get_comments_number()) {
                                    comments_template();
                                }
                                ?>

                            <?php endwhile; // end of the loop. ?>

                        <?php else : ?>

                            <?php get_template_part('content', 'none'); ?>

                        <?php endif; ?>
                    </main> <!-- /.site-main -->
                </div>  <!-- /.content-area -->
            </div> <!-- /col -->

            <!-- Blogsidebar -->
            <?php get_sidebar(); ?>

        </div> <!-- /.row -->
    </div> <!-- /.container -->
<?php get_footer(); ?>