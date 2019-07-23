<?php
/**
 * The template for displaying search results pages.
 *
 * @package proper-lite
 */

get_header(); ?>

	<header class="page-entry-header"> 
    	<div class="grid grid-pad overflow">
        	<div class="col-1-1">
            	<div class="animated fadeInUp delay">
					<h1 class="entry-title"><?php printf( __( 'Search Results for: %s', 'proper-lite' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
                </div>
            </div>
        </div>
        <div class="page-bg-image" data-parallax="scroll" data-image-src="<?php echo esc_url(get_theme_mod( 'proper_lite_blog_bg' )); ?>" data-z-index="1"></div> 
	</header><!-- .entry-header -->
 
<section id="archive-content-container" class="animated fadeIn delay-2">  
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php
				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'content', 'search' );
				?>

			<?php endwhile; ?>

			<?php the_posts_navigation(); ?> 

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->
</section>
<?php get_footer(); ?>
