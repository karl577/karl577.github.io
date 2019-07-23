<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package tdpersona
 * @since tdpersona1.0
 */

get_header(); ?>

	<div id="primary" class="content-area large-12 columns">
		<div id="content" class="site-content" role="main">

			<article id="post-0" class="post error404 not-found">
				<header class="entry-header">
					<h2 class="entry-title"><?php _e( '哦! 这个页面找不到。', 'tdpersona' ); ?></h2>
				</header><!-- .entry-header -->

				<div class="entry-content">
					<p class="sub-info"><?php _e( '看起来这里什么也没有找到。 试试搜索一下?', 'tdpersona' ); ?></p>

					<?php get_search_form(); ?>

				</div><!-- .entry-content -->
			</article><!-- #post-0 .post .error404 .not-found -->

		</div><!-- #content .site-content -->
	</div><!-- #primary .content-area -->

<?php get_footer(); ?>