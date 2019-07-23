<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Acme Themes
 * @subpackage Infinite Photography
 */

get_header();
global $infinite_photography_customizer_all_values;
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<?php if ( is_home() && ! is_front_page() ) : ?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>
			<?php endif; ?>
			<?php
			/**
			 * infinite_photography_action_masonry_start hook
			 * @since infinite-photography 1.0.0
			 *
			 * @hooked infinite_photography_masonry_start -  0
			 */
			do_action( 'infinite_photography_action_masonry_start' );
			?>
			<?php /* Start the Loop */ ?>
			<?php
			$photo_index = 1;
			while ( have_posts() ) : the_post(); ?>
				<?php
					/*
					 * Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
				if ( $infinite_photography_customizer_all_values['infinite-photography-blog-archive-layout'] == 'photography') {
					get_template_part( 'template-parts/content', 'photography' );
					if( $photo_index % 3 == 0 ){
						echo "<div class='clearfix'></div>";
					}
				}
				else{
					get_template_part( 'template-parts/content', get_post_format() );
				}
				?>

			<?php
				$photo_index++;
			endwhile; ?>
			<?php
			/**
			 * infinite_photography_action_masonry_end hook
			 * @since infinite-photography 1.0.0
			 *
			 * @hooked infinite_photography_masonry_end -  0
			 */
			do_action( 'infinite_photography_action_masonry_end' );
			?>
			<div class="clearfix"></div>
			<?php the_posts_navigation(); ?>

		<?php else : ?>

			<?php get_template_part( 'template-parts/content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->
<?php get_sidebar( 'left' ); ?>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
