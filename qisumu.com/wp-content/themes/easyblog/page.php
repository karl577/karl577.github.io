<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package EasyBlog
 */

get_header(); ?>

<div class="container">
	<div class="row">
		<div class="col-lg-8 col-md-8">
			<div id="primary" class="content-area dt-content-area">
				<main id="main" class="site-main" role="main">

				<?php
				while ( have_posts() ) : the_post();

					get_template_part( 'template-parts/content', 'page' );

					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;

				endwhile; // End of the loop.
				?>

				</main><!-- #main -->
			</div><!-- #primary -->
		</div><!-- .col-lg-8 -->

		<aside class="col-lg-4 col-md-4">
			<div class="dt-sidebar">
				<?php get_sidebar(); ?>
			</div><!-- .dt-sidebar -->
		</aside><!-- .col-lg-4 -->
	</div><!-- .row -->
</div><!-- .container -->

<?php
get_footer();
