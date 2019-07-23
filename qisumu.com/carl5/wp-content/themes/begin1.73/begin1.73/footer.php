	<div class="clear"></div>
	<?php if (zm_get_option('footer_link')) { ?>
		<?php get_template_part( 'inc/footer-links' ); ?>
	<?php } ?>
	</div><!-- .site-content -->
	<?php if (zm_get_option('footer_w')) { ?>
		<div id="footer-widget-box">
			<div class="footer-widget">
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
	<?php echo zm_get_option('share_code'); ?>
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