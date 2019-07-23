<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

get_header(); ?>
		
			<div id="container">
			<?php if ( have_posts() ) : ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<?php
						get_template_part( 'content', get_post_format() );
					?>
				<?php endwhile; ?>

			<?php else : ?>
					<div class="entry-content">
						<p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'mumale' ); ?></p>
						<?php get_search_form(); ?>
					</div><!-- .entry-content -->
			<?php endif; ?>

			</div><!-- #container -->
		
<?php get_footer(); ?>