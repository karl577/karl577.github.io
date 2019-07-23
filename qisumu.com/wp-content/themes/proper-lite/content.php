<?php
/**
 * @package proper-lite 
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="grid grid-pad">
    	<div class="col-1-1">
            <header class="entry-header">
            	
                <?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>
                
                <?php if ( 'option2' == proper_lite_sanitize_index_content( get_theme_mod( 'proper_lite_post_content' ) ) ) :
				the_post_thumbnail();
				the_content();
				else :
				
				endif;  ?>
                
                <?php if ( 'post' == get_post_type() ) : ?>
                <div class="entry-meta">
                    <?php proper_lite_posted_on(); ?>
                </div><!-- .entry-meta -->
                <?php endif; ?>
            </header><!-- .entry-header -->
      	</div><!-- .col -->
  	</div><!-- .grid -->
</article><!-- #post-## -->