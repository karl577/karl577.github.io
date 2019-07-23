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

			<?php if (zm_get_option('cms_top')) { ?>
				<?php
					if ( !is_paged() ) :
						get_template_part( 'template/cms-top' );
					endif;
				?>
			<?php } ?>
			<?php if (zm_get_option('cms_top')) { ?>
				<?php
					$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
					$notcat = explode(',',zm_get_option('not_cat_n'));
					$args = array(
						'category__not_in' => $notcat,
					    'ignore_sticky_posts' => 0, 
						'paged' => $paged,
						'meta_query' => array(
							array(
								'key' => 'cms_top',
								'compare' => 'NOT EXISTS'
							)
						)
					);
					query_posts( $args );
			 	?>
			<?php } else { ?>
				<?php
					$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
					$notcat = explode(',',zm_get_option('not_cat_n'));
					$args = array(
						'category__not_in' => $notcat,
					    'ignore_sticky_posts' => 0, 
						'paged' => $paged
					);
					query_posts( $args );
			 	?>
			<?php } ?>
			<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<div class="wow fadeInUp" data-wow-delay="0.3s"><?php get_template_part( 'template/content', get_post_format() ); ?></div>

				<?php get_template_part('ad/ads', 'archive'); ?>

			<?php endwhile; ?>

			<?php else : ?>
				<?php get_template_part( 'template/content', 'none' ); ?>
			<?php endif; ?>

		</main><!-- .site-main -->

		<?php begin_pagenav(); ?>

	</div><!-- .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>