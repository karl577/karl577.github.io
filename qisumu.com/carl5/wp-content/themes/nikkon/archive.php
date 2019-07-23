<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Nikkon
 */

$blog_style = 'blog-style-postblock';
if ( get_theme_mod( 'nikkon-blog-blocks-style' ) )
	$blog_style = get_theme_mod( 'nikkon-blog-blocks-style' );

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php if ( have_posts() ) : ?>

				<header class="page-header">
					<?php
						the_archive_title( '<h1 class="page-title">', '</h1>' );
						the_archive_description( '<div class="taxonomy-description">', '</div>' );
					?>
				</header><!-- .page-header -->
				
				<?php
				// if archive pages are set to be blocks
				echo ( get_theme_mod( 'nikkon-blog-layout' ) == 'blog-blocks-layout' && get_theme_mod( 'nikkon-blog-cats-blocks' ) == 1 ) ? '<div class="blog-blocks-wrap blog-blocks-wrap-remove blog-columns-three ' . sanitize_html_class( $blog_style ) . '">' : '';
					echo ( get_theme_mod( 'nikkon-blog-layout' ) == 'blog-blocks-layout' && get_theme_mod( 'nikkon-blog-cats-blocks' ) == 1 ) ? '<div class="blog-blocks-wrap-inner">' : ''; ?>
				
					<?php /* Start the Loop */ ?>
					<?php while ( have_posts() ) : the_post(); ?>
					
						<?php
							/* Include the Post-Format-specific template for the content.
							 * If you want to override this in a child theme, then include a file
							 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
							 */
							get_template_part( 'templates/contents/content', get_post_format() );
						?>
						
					<?php endwhile; ?>
					
					<?php
					// Close the divs for the blocks layout
					echo ( get_theme_mod( 'nikkon-blog-layout' ) == 'blog-blocks-layout' && get_theme_mod( 'nikkon-blog-cats-blocks' ) == 1 ) ? '<div class="clearboth"></div></div>' : '';
				echo ( get_theme_mod( 'nikkon-blog-layout' ) == 'blog-blocks-layout' && get_theme_mod( 'nikkon-blog-cats-blocks' ) == 1 ) ? '</div>' : ''; ?>
				
				<?php the_posts_navigation(); ?>

			<?php else : ?>

				<?php get_template_part( 'templates/contents/content', 'none' ); ?>

			<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

	<?php get_sidebar(); ?>
	
	<div class="clearboth"></div>
	
<?php get_footer(); ?>
