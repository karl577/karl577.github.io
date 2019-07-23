<?php get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<?php if (zm_get_option('slider')) { ?>
				<?php require get_template_directory() . '/inc/slider.php'; ?>
			<?php } ?>
			<?php if (zm_get_option('cms_top')) { ?><?php get_template_part( 'template/cms-top' ); ?><?php } ?>
			<?php if (zm_get_option('news')) { ?>
				<?php require get_template_directory() . '/cms/cms-news.php'; ?>
			<?php } ?>
			<div class="wow fadeInUp" data-wow-delay="0.5s"><?php get_template_part('ad/ads', 'cms'); ?></div>
			<div id="cms-widget-one" class="wow fadeInUp" data-wow-delay="0.3s">
				<?php dynamic_sidebar( 'cms-one' ); ?>
				<div class="clear"></div>
			</div>
			<?php if (zm_get_option('picture')) { ?>
			<div class="line-four">
			<?php get_template_part( '/cms/cms-picture' ); ?>
			</div>
			<?php } ?>
			<div id="cms-widget-two" class="wow fadeInUp" data-wow-delay="0.3s">
				<?php dynamic_sidebar( 'cms-two' ); ?>
				<div class="clear"></div>
			</div>
			<?php if (zm_get_option('post_img')) { ?>
				<div class="line-four wow fadeInUp" data-wow-delay="0.3s">
					<?php require get_template_directory() . '/cms/cms-postimg.php'; ?>
				</div>
			<?php } ?>
			<?php if (zm_get_option('cat_one')) { ?>
				<div class="line-one wow fadeInUp" data-wow-delay="0.3s">
					<?php require get_template_directory() . '/cms/cms-catone.php'; ?>
				</div>
			<?php } ?>
			<?php if (zm_get_option('video')) { ?>
				<div class="line-four wow fadeInUp" data-wow-delay="0.3s">
					<?php get_template_part( '/cms/cms-video' ); ?>
				</div>
			<?php } ?>
			<?php if (zm_get_option('cat_small')) { ?>
				<div class="line-small wow fadeInUp" data-wow-delay="0.3s">
				<?php require get_template_directory() . '/cms/cms-catsmall.php'; ?>
				</div>
			<?php } ?>
			<?php if (zm_get_option('tab_h')) { ?>
				<div class="wow fadeInUp" data-wow-delay="0.3s"><?php get_template_part( '/cms/cms-tab' ); ?></div>
			<?php } ?>

		</main>
	</div>
<?php get_sidebar(); ?>
<?php if (zm_get_option('flexisel')) { ?>
	<div class="wow fadeInUp" data-wow-delay="0.3s"><?php get_template_part( '/cms/cms-scrolling' ); ?></div>
<?php } ?>
<?php if (zm_get_option('cat_big')) { ?>
	<div class="line-big wow fadeInUp" data-wow-delay="0.3s">
		<?php require get_template_directory() . '/cms/cms-catbig.php'; ?>
	</div>
<?php } ?>
<?php if (zm_get_option('tao_h')) { ?>
	<div class="line-tao wow fadeInUp" data-wow-delay="0.3s">
		<?php get_template_part( '/cms/cms-tao' ); ?>
	</div>
<?php } ?>
<?php if (zm_get_option('cat_big_not')) { ?>
	<div class="line-big wow fadeInUp" data-wow-delay="0.3s">
		<?php require get_template_directory() . '/cms/cms-catbign.php'; ?>
	</div>
<?php } ?>
<?php get_footer(); ?>