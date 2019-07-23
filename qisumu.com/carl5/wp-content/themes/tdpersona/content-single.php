<?php
/**
 * @package tdpersona
 * @since tdpersona 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h2 class="entry-title"><?php the_title(); ?></h2>

		<?php if ( 'post' == get_post_type() ) : ?>
			<?php tdpersona_post_date(); ?>
		<?php endif; ?>

		<?php if ( has_post_thumbnail() ): ?>
		<div class="post-thumb">
			<?php the_post_thumbnail(); ?>
		</div><!-- .post-thumb -->
		<?php endif; ?>

	</header><!-- .entry-header -->

	<div class="entry-content">

		<?php the_content(); ?>

		<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( '页面:', 'tdpersona' ), 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->

	<footer class="entry-meta bottom">
		<?php
			/* translators: used between list items, there is a space after the comma */
			$category_list = get_the_category_list( __( ', ', 'tdpersona' ) );

			/* translators: used between list items, there is a space after the comma */
			$tag_list = get_the_tag_list( '', __( ', ', 'tdpersona' ) );

			if ( ! tdpersona_categorized_blog() ) {
				// This blog only has 1 category so we just need to worry about tags in the meta text
				// (此事项被标记为...)中， entry 被翻译为 事项，根据斯科林英汉双解词典
				if ( '' != $tag_list ) {
					$meta_text = __( '此事项被标记为 %2$s。 添加 <a href="%3$s" title="永久链接到 %4$s" rel="bookmark">永久链接</a> 到书签。', 'tdpersona' );
				} else {
					$meta_text = __( '添加 <a href="%3$s" title="永久链接到 %4$s" rel="bookmark">永久链接</a> 到书签。', 'tdpersona' );
				}

			} else {
				// But this blog has loads of categories so we should probably display them here
				if ( '' != $tag_list ) {
					$meta_text = __( '此事项被发布在 %1$s 并被标记为 %2$s 。添加 <a href="%3$s" title="永久链接到 %4$s" rel="bookmark">永久链接</a> 到书签。', 'tdpersona' );
				} else {
					$meta_text = __( '此事项被发布在 %1$s。添加 <a href="%3$s" title="永久链接到 %4$s" rel="bookmark">永久链接</a> 到书签。', 'tdpersona' );
				}

			} // end check for categories on this blog

			printf(
				$meta_text,
				$category_list,
				$tag_list,
				get_permalink(),
				the_title_attribute( 'echo=0' )
			);
		?>

		<?php edit_post_link( __( '编辑', 'tdpersona' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-meta -->
</article><!-- #post-<?php the_ID(); ?> -->