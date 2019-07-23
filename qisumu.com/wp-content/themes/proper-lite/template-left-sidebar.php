<?php
/**
Template Name: Page - Left Sidebar
 *
 * @package proper-lite
 */

get_header(); ?>

	<?php while ( have_posts() ) : the_post(); ?>
   
    
	<header class="page-entry-header"> 
    	<div class="grid grid-pad overflow"> 
        	<div class="col-1-1">
            	<div class="animated fadeInUp delay">
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
                </div>
            </div>
        </div>
        
        <?php if ( has_post_thumbnail( $post->ID ) ): ?>
        
        <div class="page-bg-image" data-parallax="scroll" data-image-src="<?php echo esc_url( wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) , 'proper-lite-max-control' )); ?>" data-z-index="1"></div>  
        
        <?php endif; ?> 
        
	</header><!-- .entry-header -->
   
<section id="page-content-container" class="animated fadeIn delay-2"> 
    <div class="grid grid-pad page-contain">
       	<div class="col-9-12 push-right">    
            <div id="primary" class="content-area shortcodes">
                <main id="main" class="site-main" role="main">
        
                        <?php get_template_part( 'content', 'page' ); ?>
        
                        <?php
                            // If comments are open or we have at least one comment, load up the comment template
                            if ( comments_open() || get_comments_number() ) :
                                comments_template();
                            endif;
                        ?>
        
                    <?php endwhile; // end of the loop. ?>
        
                </main><!-- #main -->
            </div><!-- #primary -->
		</div>
	<?php get_sidebar(); ?>
	</div>
</section>
<?php get_footer(); ?>
