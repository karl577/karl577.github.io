<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package proper-lite
 */

get_header(); ?>

	<header class="page-entry-header"> 
    	<div class="grid grid-pad overflow">
        	<div class="col-1-1">
            	<div class="animated fadeInUp delay">
					<h1 class="entry-title"><?php echo esc_html( get_theme_mod( 'proper_lite_blog_title', esc_html__( 'Our Latest News', 'proper-lite' ) )) ?></h1>
                </div><!-- animated -->
            </div><!-- col-1-1 -->
        </div><!-- grid -->
        <div class="page-bg-image" data-parallax="scroll" data-image-src="<?php echo esc_url( get_theme_mod( 'proper_lite_blog_bg' )); ?>" data-z-index="1"></div> 
	</header><!-- .entry-header -->

<section id="archive-content-container" class="animated fadeIn delay-2">      
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php
					/* Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'content', get_post_format() );
				?>

			<?php endwhile; ?>

			<?php the_posts_navigation(); ?> 

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?> 

		<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->
</section><!-- archive-content-container -->

<?php get_footer(); ?>
