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
 * @package Nikkon
 */

$blog_style = 'blog-style-postblock';
if ( get_theme_mod( 'nikkon-blog-blocks-style' ) )
	$blog_style = get_theme_mod( 'nikkon-blog-blocks-style' );

get_header(); ?>

	<?php if ( is_home() ) : ?>
	<div id="primary" class="content-area <?php echo ( get_theme_mod( 'nikkon-blog-full-width', false ) ) ? sanitize_html_class( 'content-area-full' ) : ''; ?>">
    <?php else : ?>
    <div id="primary" class="content-area">
    <?php endif; ?>
		
		<main id="main" class="site-main" role="main">
			
			<?php get_template_part( '/templates/titlebar' ); ?>

			<?php if ( have_posts() ) : ?>
			
				<?php echo ( get_theme_mod( 'nikkon-blog-layout' ) == 'blog-blocks-layout' ) ? '<div class="blog-blocks-wrap blog-blocks-wrap-remove blog-columns-three ' . sanitize_html_class( $blog_style ) . '">' : ''; ?>
					<?php echo ( get_theme_mod( 'nikkon-blog-layout' ) == 'blog-blocks-layout' ) ? '<div class="blog-blocks-wrap-inner">' : ''; ?>
							
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

					<?php echo ( get_theme_mod( 'nikkon-blog-layout' ) == 'blog-blocks-layout' ) ? '<div class="clearboth"></div></div>' : ''; ?>
				<?php echo ( get_theme_mod( 'nikkon-blog-layout' ) == 'blog-blocks-layout' ) ? '</div>' : ''; ?>
					
			<?php else : ?>

				<?php get_template_part( 'templates/contents/content', 'none' ); ?>

			<?php endif; ?>

		</main><!-- #main -->
		
		<?php the_posts_navigation(); ?>
		
	</div><!-- #primary -->
	
	<?php if ( is_home() ) : ?>
    
        <?php if ( get_theme_mod( 'nikkon-blog-full-width', false ) ) : ?>
            <!-- No Sidebar -->
        <?php else : ?>
            <?php get_sidebar(); ?>
        <?php endif; ?>
        
    <?php else : ?>
    	<?php get_sidebar(); ?>
    <?php endif; ?>
    
    <div class="clearboth"></div>
	
<?php get_footer(); ?>
