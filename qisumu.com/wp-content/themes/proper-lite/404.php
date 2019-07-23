<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package proper-lite
 */

get_header(); ?>

	<header class="page-entry-header"> 
    	<div class="grid grid-pad overflow">
        	<div class="col-1-1">
            	<div class="animated fadeInUp delay">
					<h1 class="entry-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'proper-lite' ); ?></h1>
                </div><!-- animated -->
            </div><!-- col-1-1 -->
        </div><!-- grid -->
        <div class="page-bg-image" data-parallax="scroll" data-image-src="<?php echo esc_url( get_theme_mod( 'proper_lite_blog_bg' )); ?>" data-z-index="1"></div> 
	</header><!-- .entry-header -->

<section id="page-content-container" class="animated fadeIn delay-2">
    <div class="grid grid-pad page-contain">
       	<div class="col-1-1">    
            <div id="primary" class="content-area">
                <main id="main" class="site-main" role="main">
        
                    <div class="error-404 not-found">
        
                        <div class="page-content">
                            <p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'proper-lite' ); ?></p>
        
                            <?php get_search_form(); ?>
        
                        </div><!-- .page-content -->
                    </div><!-- .error-404 -->
        
                </main><!-- #main -->
            </div><!-- #primary -->
      	</div><!-- col -->
   	</div><!-- grid -->
</section><!-- page-content-container -->
<?php get_footer(); ?>
