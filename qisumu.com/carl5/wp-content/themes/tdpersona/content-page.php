<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package tdpersona
 * @since tdpersona 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h2 class="entry-title"><?php the_title(); ?></h2>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( '页面:', 'tdpersona' ), 'after' => '</div>' ) ); ?>
		<div class="clear"></div>
		<?php edit_post_link( __( '编辑', 'tdpersona' ), '<span class="edit-link">', '</span>' ); ?>
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->
