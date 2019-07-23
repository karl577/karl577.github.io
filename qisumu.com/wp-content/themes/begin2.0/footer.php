	<div class="clear"></div>
	<?php if (zm_get_option('footer_link')) { ?>
		<div class="wow fadeInUp" data-wow-delay="0.3s"><?php get_template_part( 'inc/footer-links' ); ?></div>
	<?php } ?>
	</div><!-- .site-content -->
	<?php if (zm_get_option('footer_w')) { ?>
		<div id="footer-widget-box">
			<div class="footer-widget wow fadeInUp" data-wow-delay="0.5s">
				<?php dynamic_sidebar( 'sidebar-f' ); ?>
				<div class="clear"></div>
			</div>
		</div>
	<?php } ?>
	<footer id="colophon" class="site-footer" role="contentinfo">

		<div class="site-info">
			<?php echo zm_get_option('footer_inf_t'); ?>
			<span class="add-info">
				<?php echo zm_get_option('footer_inf_b'); ?>
				<?php echo zm_get_option('tongji_f'); ?>
			</span>
		</div><!-- .site-info -->
	</footer><!-- .site-footer -->
<?php if (zm_get_option('login')) { ?>
<?php get_template_part( 'inc/login' ); ?>
<?php } ?>

<?php if (zm_get_option('share')) { ?>
<script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"1","bdSize":"16"},"share":{"bdSize":16}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>
<?php } ?>

<?php get_template_part( 'inc/scroll' ); ?>

<?php if (is_home() || is_archive() || is_search()) { ?>
<script type="text/javascript">
    document.onkeydown = chang_page;function chang_page(e) {
        var e = e || event,
        keycode = e.which || e.keyCode;
        if (keycode == 37) location = '<?php echo get_previous_posts_page_link(); ?>';
        if (keycode == 39) location = '<?php echo get_next_posts_page_link(); ?>';
    }
</script>
<?php } ?>
<?php if (zm_get_option('weibo_t')) { ?>
	<script src="http://tjs.sjs.sinajs.cn/open/api/js/wb.js" type="text/javascript" charset="utf-8"></script>
	<html xmlns:wb="http://open.weibo.com/wb">
<?php } ?>
<?php wp_footer(); ?>

</body>
</html>