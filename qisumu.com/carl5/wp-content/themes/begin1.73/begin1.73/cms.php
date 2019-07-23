<?php get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php if (zm_get_option('slider')) { ?>
				<?php require get_template_directory() . '/inc/slider.php'; ?>
			<?php } ?>

			<?php if (zm_get_option('news')) { ?>
				<?php require get_template_directory() . '/cms/cms-news.php'; ?>
			<?php } ?>

			<?php if (zm_get_option('picture')) { ?>
				<div class="line-four">
					<?php get_template_part( '/cms/cms-picture' ); ?>
				</div>
			<?php } ?>

			<?php if (zm_get_option('post_img')) { ?>
				<div class="line-four">
					<?php require get_template_directory() . '/cms/cms-postimg.php'; ?>
				</div>
			<?php } ?>

			<?php if (zm_get_option('cat_one')) { ?>
				<div class="line-one">
					<?php require get_template_directory() . '/cms/cms-catone.php'; ?>
				</div>
			<?php } ?>

				<?php get_template_part('ad/ads', 'cms'); ?>

			<?php if (zm_get_option('video')) { ?>
				<div class="line-four">
					<?php get_template_part( '/cms/cms-video' ); ?>
				</div>
			<?php } ?>

			<?php if (zm_get_option('cat_small')) { ?>
				<div class="line-small">
					<?php require get_template_directory() . '/cms/cms-catsmall.php'; ?>
				</div>
			<?php } ?>

			<?php if (zm_get_option('tab_h')) { ?>
				<?php get_template_part( '/cms/cms-tab' ); ?>
			<?php } ?>

		</main><!-- .site-main -->
	</div><!-- .content-area -->

<?php get_sidebar(); ?>

<?php if (zm_get_option('flexisel')) { ?>
	<?php get_template_part( '/cms/cms-scrolling' ); ?>
<?php } ?>

<?php if (zm_get_option('cat_big')) { ?>
	<div class="line-big">
		<?php require get_template_directory() . '/cms/cms-catbig.php'; ?>
	</div>
<?php } ?>

<?php if (zm_get_option('tao_h')) { ?>
	<div class="line-tao">
		<?php get_template_part( '/cms/cms-tao' ); ?>
	</div>
<?php } ?>

<?php if (zm_get_option('cat_big_not')) { ?>
	<div class="line-big">
		<?php require get_template_directory() . '/cms/cms-catbign.php'; ?>
	</div>
<?php } ?>

<?php get_footer(); ?>