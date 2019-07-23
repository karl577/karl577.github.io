<?php get_header(); ?>
	<?php if ( !is_paged() ) :	get_template_part( 'template/cat-top' ); endif; ?>
	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php if ( have_posts() ) : ?>

			<?php while ( have_posts() ) : the_post(); ?>
				<div class="wow fadeInUp" data-wow-delay="0.3s"><?php get_template_part( 'template/content', get_post_format() ); ?></div>

				<div class="wow fadeInUp" data-wow-delay="0.3s"><?php get_template_part('ad/ads', 'archive'); ?></div>

			<?php endwhile; ?>

			<?php else : ?>
				<?php get_template_part( 'template/content', 'none' ); ?>

			<?php endif; ?>

		</main><!-- .site-main -->

		<?php begin_pagenav(); ?>

	</section><!-- .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>