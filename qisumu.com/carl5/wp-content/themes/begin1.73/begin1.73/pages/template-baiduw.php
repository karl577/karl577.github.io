<?php
/*
Template Name: 百度搜索宽屏
*/
?>

<?php get_header(); ?>

<style type="text/css">
.page-template-template-baiduw #primary {
	width: 100%;
}
</style>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<!-- 百度搜索代码 -->
				<div id="bdcs-frame-box"></div>
				<script type="text/javascript">
				var bdcsFrameSid="<?php echo zm_get_option('baidu_id'); ?>";
				var bdcsFrameCharset= "utf-8";
				var bdcsFrameWidth = 650;
				var bdcsFrameHeight = 1300;
				var bdcsFrameWt = 1;
				var bdcsFrameHt = 2;
				var bdcsFrameResultNum = 20;
				var bdcsFrameBgColor = "#fff";
				var bdcsRecommend = 0;
				var bdcsDefaultQuery = 0;
				var bdcsRemoveUrl = 0;
				</script>
				<script type="text/javascript" src="http://zhannei.baidu.com/static/js/iframe.js"></script>
				<!-- 百度搜索代码结束 -->

			</article><!-- #page -->
		</main><!-- .site-main -->
	</div><!-- .content-area -->

<?php get_footer(); ?>