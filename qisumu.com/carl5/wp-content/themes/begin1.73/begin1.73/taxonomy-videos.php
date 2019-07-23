<?php get_header(); ?>

	<section id="picture" class="content-area">
		<main id="main" class="site-main" role="main">
			<?php $posts = query_posts($query_string . '&orderby=date&showposts=16');?>
			<?php while ( have_posts() ) : the_post(); ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<div class="xl5 xm5">
					<div class="picture-box">
						<figure class="picture-img">
							<?php 
								if (zm_get_option('lazy_s')) {
								zm_videos_thumbnail_h();
								} else {
								zm_videos_thumbnail();
								}
							 ?>
						</figure>
						<?php the_title( sprintf( '<h3 class="picture-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>
					</div>
				</div>

			</article><!-- #post -->
			<?php endwhile; ?>

			<?php if (zm_get_option('scroll')) { ?>
				<?php zmingcx_page_nav( 'nav-below' ); ?>
			<?php } ?>

		</main><!-- .site-main -->

		<div class="clear"></div>
		<?php pagenavi(); ?>

	</section><!-- .content-area -->

<?php get_footer(); ?>