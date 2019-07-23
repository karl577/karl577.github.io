<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package proper-lite
 */ 
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'proper-lite' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php edit_post_link( esc_html__( 'Edit', 'proper-lite' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-footer --> 
</article><!-- #post-## --> 
