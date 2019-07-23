<?php get_header(); ?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

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

		<?php
			// the_posts_pagination( array(
				// 'prev_text'          =>上页,
				// 'next_text'          =>下页,
				// 'before_page_number' => '<span class="meta-nav screen-reader-text">第 </span>',
				// 'after_page_number' => '<span class="meta-nav screen-reader-text"> 页</span>',
			// ) );
		?>

		<?php pagenavi(); ?>

	</section><!-- .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>