<?php
/**
 * The template for displaying Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package tdpersona
 * @since tdpersona 1.0
 */

get_header(); ?>

		<section id="primary" class="content-area">
			<div id="content" class="site-content" role="main">

			<?php if ( have_posts() ) : ?>

				<header class="page-header">
				<h4 class="page-title">
					<?php
						if ( is_category() ) :
							single_cat_title();

						elseif ( is_tag() ) :
							single_tag_title();

						elseif ( is_author() ) :
							printf( __( '作者: %s', 'tdpersona' ), '<span class="vcard">' . get_the_author() . '</span>' );

						elseif ( is_day() ) :
							printf( __( '天: %s', 'tdpersona' ), '<span>' . get_the_date() . '</span>' );

						elseif ( is_month() ) :
							printf( __( '月: %s', 'tdpersona' ), '<span>' . get_the_date( _x( 'F Y', '每月归档日期格式', 'tdpersona' ) ) . '</span>' );

						elseif ( is_year() ) :
							printf( __( '年: %s', 'tdpersona' ), '<span>' . get_the_date( _x( 'Y', '每年归档日期格式', 'tdpersona' ) ) . '</span>' );

						elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
							_e( '旁白内容', 'tdpersona' );

						elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) :
							_e( '图库', 'tdpersona');

						elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
							_e( '图像', 'tdpersona');

						elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
							_e( '视频', 'tdpersona' );

						elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
							_e( '引用', 'tdpersona' );

						elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
							_e( '链接', 'tdpersona' );

						elseif ( is_tax( 'post_format', 'post-format-status' ) ) :
							_e( '状态', 'tdpersona' );

						elseif ( is_tax( 'post_format', 'post-format-audio' ) ) :
							_e( '音频', 'tdpersona' );

						elseif ( is_tax( 'post_format', 'post-format-chat' ) ) :
							_e( '聊天', 'tdpersona' );

						else :
							_e( '归档', 'tdpersona' );

						endif;
					?>
				</h4>
				<?php
					// Show an optional term description.
					$term_description = term_description();
					if ( ! empty( $term_description ) ) :
						printf( '<div class="taxonomy-description">%s</div>', $term_description );
					endif;
				?>
			</header><!-- .page-header -->

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', get_post_format() ); ?>

				<?php endwhile; ?>

				<?php tdpersona_content_nav( 'nav-below' ); ?>

			<?php else : ?>

				<?php get_template_part( 'no-results', 'archive' ); ?>

			<?php endif; ?>

			</div><!-- #content .site-content -->
		</section><!-- #primary .content-area -->

	<?php get_sidebar(); ?>

<?php get_footer(); ?>