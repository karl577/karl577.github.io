<?php get_header(); ?>

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

	<section id="picture" class="content-area">
		<main id="main" class="site-main" role="main">
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
			<?php while ( have_posts() ) : the_post(); ?>
			<article class="picture wow fadeInUp" data-wow-delay="0.3s">
				<div class="picture-box">
					<figure class="picture-img">
						<?php if (zm_get_option('hide_box')) { ?>
							<a rel="bookmark" href="<?php echo esc_url( get_permalink() ); ?>"><div class="hide-box"></div></a>
							<a rel="bookmark" href="<?php echo esc_url( get_permalink() ); ?>"><div class="hide-excerpt"><?php if (has_excerpt('')){ echo wp_trim_words( get_the_excerpt(), 62, '...' ); } else { echo wp_trim_words( get_the_content(), 72, '...' ); } ?></div></a>
						<?php } ?>
						<?php if (zm_get_option('lazy_s')) { zm_thumbnail_h(); } else { zm_thumbnail(); } ?>
						<?php if (function_exists('zm_link')) { zm_link(); } ?><span class="grid"><span class="fa fa-thumbs-o-up">&nbsp;<?php zm_get_current_count(); ?></span></span>
					</figure>
					<?php the_title( sprintf( '<h3 class="grid-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>
					<span class="grid-inf">
						<span class="date"><i class="fa fa-clock-o"></i> <?php the_time( 'm/d' ); ?> </span>
						<?php if( function_exists( 'the_views' ) ) { the_views( true, '<span class="views"><i class="fa fa-eye"></i> ','</span>' ); } ?>
		 			</span>
		 			<div class="clear"></div>
				</div>
			</article>
			<?php endwhile;?>
		</main><!-- .site-main -->
		<?php begin_pagenav(); ?>
	</section><!-- .content-area -->

<?php get_footer(); ?>