

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
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
        
        <div class="entry-summary">
            <?php the_content(); ?>
            <?php
                wp_link_pages( array(
                    'before' => '<div class="page-links">' . __( 'Pages:', 'shaped-blog' ),
                    'after'  => '</div>',
                ) );
            ?>
        </div> <!-- //.entry-summary -->

    </div>

</article> <!--/#post-->