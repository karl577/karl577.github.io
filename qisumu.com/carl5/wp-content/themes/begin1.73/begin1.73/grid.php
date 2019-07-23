<?php get_header(); ?>

	<section id="picture" class="content-area">
		<main id="main" class="site-main" role="main">
			<?php
				$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
				$sticky = get_option( 'sticky_posts' );
				$notcat = explode(',',zm_get_option('not_cat_n'));
				$args = array(
					'category__not_in' => $notcat,
					'post__not_in' => $sticky,
					'showposts' => 20,
					'paged' => $paged
				);
				query_posts( $args );
		 	?>
			<?php while ( have_posts() ) : the_post(); ?>
			<article class="picture">

				<div class="xl5 xm5">
					<div class="picture-box">
						<figure class="picture-img">
							<?php 
								if (zm_get_option('lazy_s')) {
								zm_the_thumbnail_h();
								} else {
								zm_the_thumbnail();
								}
							 ?>
						<?php if (zm_get_option('hide_box')) { ?>
							<a rel="bookmark" href="<?php echo esc_url( get_permalink() ); ?>"><div class="hide-box"></div></a>
							<a rel="bookmark" href="<?php echo esc_url( get_permalink() ); ?>"><div class="hide-excerpt"><?php if (has_excerpt('')){ echo wp_trim_words( get_the_excerpt(), 62, '...' ); } else { echo wp_trim_words( get_the_content(), 72, '...' ); } ?></div></a>
						<?php } ?>
							<?php if (function_exists('zm_link')) { zm_link(); } ?><span class="grid"><span class="fa fa-thumbs-o-up">&nbsp;<?php zm_get_current_count(); ?></span></span>
						</figure>
						<?php the_title( sprintf( '<h3 class="grid-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>
						<span class="grid-inf">
							<span class="date"><?php the_time( 'm/d' ); ?> </span>
							<?php if( function_exists( 'the_views' ) ) { print '<span class="views"> 阅读 '; the_views(); print '</span>';  } ?>
		 				</span>
		 				<div class="clear"></div>
					</div>
				</div>

			</article>
			<?php endwhile;?>

			<?php if (zm_get_option('scroll')) { ?>
				<?php zmingcx_page_nav( 'nav-below' ); ?>
			<?php } ?>

		</main><!-- .site-main -->

		<div class="clear"></div>

		<?php pagenavi(); ?>

	</section><!-- .content-area -->

<?php get_footer(); ?>