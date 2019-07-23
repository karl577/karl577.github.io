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
            <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
        </h2> <!-- //.entry-title -->

        <div class="clearfix entry-meta">
            <?php shaped_blog_posted_on() ?>
        </div> <!--/.entry-meta -->
        
        <div class="entry-summary">
            <?php the_content(__('<span class="btn-readmore">Continue Reading</span>', 'shaped-blog')); ?>
        </div> <!-- //.entry-summary -->

    </div>

</article> <!--/#post-->