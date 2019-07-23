<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Acme Themes
 * @subpackage Infinite Photography
 */
global $infinite_photography_customizer_all_values;
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

		<?php if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php infinite_photography_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->
	<!--post thumbnal options-->
	<div class="post-thumb">
		<?php
		if( has_post_thumbnail() ):
			$image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' );
		else:
			$image_url[0] = get_template_directory_uri().'/assets/img/no-image-840-480.jpg';
		endif;
		?>
		<a href="<?php the_permalink(); ?>"><img src="<?php echo esc_url( $image_url[0] ); ?>" alt="<?php the_title_attribute(); ?>" title="<?php the_title_attribute(); ?>" /></a>
	</div><!-- .post-thumb-->

	<div class="entry-content">
		<?php
		the_excerpt();
		?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'infinite-photography' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php infinite_photography_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
