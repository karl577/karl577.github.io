<?php
/**
 * The template part for displaying a message that posts cannot be found.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package tdpersona
 * @since tdpersona 1.0
 */
?>

<article id="post-0" class="post no-results not-found">
	<header class="entry-header">
		<h2 class="entry-title"><?php _e( '什么都没找到', 'tdpersona' ); ?></h2>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<p class="sub-info"><?php printf( __( '准备好发布你的第一篇帖子吗? <a href="%1$s">从这里开始</a>.', 'tdpersona' ), admin_url( 'post-new.php' ) ); ?></p>

		<?php elseif ( is_search() ) : ?>

			<p class="sub-info"><?php _e( '抱歉, 但是没有与你的搜索相匹配的内容。 请换用不同的关键词再试试。', 'tdpersona' ); ?></p>
			<?php get_search_form(); ?>

		<?php else : ?>

			<p class="sub-info"><?php _e( '看起来我们找不到你在寻找的内容。 也许搜索能提供帮助。', 'tdpersona' ); ?></p>
			<?php get_search_form(); ?>

		<?php endif; ?>
	</div><!-- .entry-content -->
</article><!-- #post-0 .post .no-results .not-found -->
