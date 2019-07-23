<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
        <?php if ( is_sticky() && is_home() && ! is_paged() ) { ?>
            <sup class="featured-post"><i class="fa fa-star"></i></sup>
        <?php } ?>

        <?php if ( has_post_thumbnail() && ! post_password_required() ) { ?>
        <div class="entry-thumbnail">
            <?php the_post_thumbnail('shaped-blog-thumb', array('class' => 'img-responsive')); ?>
        </div>
        <?php } //.entry-thumbnail ?>

    </header> <!--/.entry-header -->

    <div class="clearfix post-content media">

        <h2 class="entry-title">
            <?php the_title(); ?>
        </h2> <!-- //.entry-title -->

        <div class="clearfix entry-meta">
            <?php shaped_blog_posted_on() ?>
        </div> <!--/.entry-meta -->
        
        <div class="entry-summary">
            <?php the_content(); ?>
        </div> <!-- //.entry-summary -->
        
        <?php if (!get_theme_mod('shaped_blog_post_tags')): ?>
            <div class="entry-tags"><?php the_tags(__('<b>Tags:</b> ', 'shaped-blog'), ', ', ''); ?></div>
        <?php endif; ?>

    </div>

</article> <!--/#post-->




