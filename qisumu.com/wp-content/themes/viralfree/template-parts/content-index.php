<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ViralFree
 */

?>
<div class="index-content">
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>
		<header class="entry-header">
			<?php if ( has_post_thumbnail()) : ?>
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
					<?php the_post_thumbnail(); ?>
				</a>
			<?php else : ?>
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
					<div class="no-featured-image"></div>	
				</a>
			<?php endif; ?>
			<?php
				if ( is_single() ) {
					the_title( '<h1 class="entry-title">', '</h1>' );
				} else {
					the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
				}
			?>
		</header><!-- .entry-header -->
	</article><!-- #post-## -->
</div><!-- .index-content -->
