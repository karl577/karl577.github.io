<?php get_header(); ?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<ul class="search-page">
				<?php if ( have_posts() ) : ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<li class="search-inf">
						<?php the_time( 'Y年m月d日' ); ?>
					</li>
					<?php the_title( sprintf( '<li class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></li>' ); ?>

				<?php endwhile; ?>
			</ul>
			<?php else : ?>
				<?php get_template_part( 'content', 'none' ); ?>
			<?php endif; ?>

		</main><!-- .site-main -->

		<?php pagenavi(); ?>

	</section><!-- .content-area -->


<?php get_footer(); ?>