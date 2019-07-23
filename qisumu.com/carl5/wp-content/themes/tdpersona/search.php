<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package tdpersona
 * @since tdpersona 1.0
 */

get_header(); ?>

		<section id="primary" class="content-area">
			<div id="content" class="site-content" role="main">

			<?php if ( have_posts() ) : ?>

				<header class="page-header">
					<h4 class="page-title"><?php printf( __( '搜索结果: %s', 'tdpersona' ), '<span>' . get_search_query() . '</span>' ); ?></h4>
				</header><!-- .page-header -->

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', 'search' ); ?>

				<?php endwhile; ?>

				<?php tdpersona_content_nav( 'nav-below' ); ?>

			<?php else : ?>

				<?php get_template_part( 'no-results', 'search' ); ?>

			<?php endif; ?>

			</div><!-- #content .site-content -->
		</section><!-- #primary .content-area -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>