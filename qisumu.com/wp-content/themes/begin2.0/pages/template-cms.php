<?php
/*
Template Name: 杂志布局
*/
?>
<?php get_header(); ?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<!-- 幻灯 -->
			<?php if (zm_get_option('slider')) { ?>
				<?php require get_template_directory() . '/inc/slider.php'; ?>
			<?php } ?>
			<!-- 置顶 -->
			<?php if (zm_get_option('cms_top')) { ?><?php get_template_part( 'template/cms-top' ); ?><?php } ?>
			<!-- 最新 -->
			<?php if (zm_get_option('news')) { ?>
				<?php require get_template_directory() . '/cms/cms-news.php'; ?>
			<?php } ?>
			<!-- 单栏小工具  -->
			<div id="cms-widget-one" class="wow fadeInUp" data-wow-delay="0.3s">
				<?php dynamic_sidebar( 'cms-one' ); ?>
				<div class="clear"></div>
			</div>
			<!-- 图片日志 -->
			<?php if (zm_get_option('picture')) { ?>
			<div class="line-four">
			<?php get_template_part( '/cms/cms-picture' ); ?>
			</div>
			<?php } ?>
			<!-- 两栏小工具 -->
			<div id="cms-widget-two" class="wow fadeInUp" data-wow-delay="0.3s">
				<?php dynamic_sidebar( 'cms-two' ); ?>
				<div class="clear"></div>
			</div>
			<!-- 图文日志 -->
			<?php if (zm_get_option('post_img')) { ?>
				<div class="line-four wow fadeInUp" data-wow-delay="0.3s">
					<?php require get_template_directory() . '/cms/cms-postimg.php'; ?>
				</div>
			<?php } ?>
			<!-- 单栏分类 -->
			<?php if (zm_get_option('cat_one')) { ?>
				<div class="line-one wow fadeInUp" data-wow-delay="0.3s">
					<?php require get_template_directory() . '/cms/cms-catone.php'; ?>
				</div>
			<?php } ?>
			<!-- 广告 -->
				<div class="wow fadeInUp" data-wow-delay="0.5s"><?php get_template_part('ad/ads', 'cms'); ?></div>
			<!-- 视频日志 -->
			<?php if (zm_get_option('video')) { ?>
				<div class="line-four wow fadeInUp" data-wow-delay="0.3s">
					<?php get_template_part( '/cms/cms-video' ); ?>
				</div>
			<?php } ?>
			<!-- 主体两栏分类 -->
			<?php if (zm_get_option('cat_small')) { ?>
				<div class="line-small wow fadeInUp" data-wow-delay="0.3s">
					<?php require get_template_directory() . '/cms/cms-catsmall.php'; ?>
				</div>
			<?php } ?>
			<!-- TAB切换 -->
			<?php if (zm_get_option('tab_h')) { ?>
				<div class="wow fadeInUp" data-wow-delay="0.3s"><?php get_template_part( '/cms/cms-tab' ); ?></div>
			<?php } ?>

		</main><!-- .site-main -->
	</div><!-- .content-area -->
<!-- 侧边小工具 -->
<?php get_sidebar(); ?>
<!-- 横向图片滚动 -->
<?php if (zm_get_option('flexisel')) { ?>
	<div class="wow fadeInUp" data-wow-delay="0.3s"><?php get_template_part( '/cms/cms-scrolling' ); ?></div>
<?php } ?>
<!-- 底部分类 -->
<?php if (zm_get_option('cat_big')) { ?>
	<div class="line-big wow fadeInUp" data-wow-delay="0.3s">
		<?php require get_template_directory() . '/cms/cms-catbig.php'; ?>
	</div>
<?php } ?>
<!-- 淘客 -->
<?php if (zm_get_option('tao_h')) { ?>
	<div class="line-tao wow fadeInUp" data-wow-delay="0.3s">
		<?php get_template_part( '/cms/cms-tao' ); ?>
	</div>
<?php } ?>
<!-- 无缩略图分类 -->
<?php if (zm_get_option('cat_big_not')) { ?>
	<div class="line-big wow fadeInUp" data-wow-delay="0.3s">
		<?php require get_template_directory() . '/cms/cms-catbign.php'; ?>
	</div>
<?php } ?>
<!-- 页脚 -->
<?php get_footer(); ?>