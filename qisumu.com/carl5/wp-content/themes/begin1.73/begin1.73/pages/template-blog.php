<?php
/*
Template Name: blog
*/
?>
<?php get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<?php if (zm_get_option('slider')) { ?>
				<?php
					if ( !is_paged() ) :
						get_template_part( 'inc/slider' );
					endif;
				?>
			<?php } ?>
			<?php
				$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
				$sticky = get_option( 'sticky_posts' );
				$notcat = explode(',',zm_get_option('not_cat_n'));
				$args = array(
					'category__not_in' => $notcat,
					'post__not_in' => $sticky,
					'paged' => $paged
				);
				query_posts( $args );
		 	?>
			<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', get_post_format() ); ?>

				<?php get_template_part('ad/ads', 'archive'); ?>

			<?php endwhile; ?>

			<?php else : ?>
				<?php get_template_part( 'content', 'none' ); ?>
			<?php endif; ?>

			<?php if (zm_get_option('scroll')) { ?>
				<?php zmingcx_page_nav( 'nav-below' ); ?>
			<?php } ?>

		</main><!-- .site-main -->

		<?php pagenavi(); ?>

	</div><!-- .content-area -->

<?php get_sidebar(); ?>
<?php if (zm_get_option('scroll')) { ?>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/infinite-scroll.js"></script>
<script type="text/javascript">$(document).ready(function(){var infinite_scroll={loading:{img:"<?php echo get_template_directory_uri(); ?>/img/infinite.gif",msgText:"",finishedMsg:"滚动加载结束."},nextSelector:"#nav-below .nav-previous a",navSelector:"#nav-below",itemSelector:"article",maxPage:"<?php echo zm_get_option('scroll_n'); ?>",contentSelector:"#main"};$(infinite_scroll.contentSelector).infinitescroll(infinite_scroll)});</script>
<?php } ?>
<?php get_footer(); ?>