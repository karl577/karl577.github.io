<!--Begin Footer-->
<footer>
<?php theme_footer_sidebar(); ?>
<div class="footer-section col-width clearfix">
	<?php 
	$logo = theme_get_option('footer', 'logo');
	if($logo) {
		echo  '<div class="site-logo">'."\n";
		echo  '<a href="'.home_url( '/' ).'" title="'. esc_attr( get_bloginfo( 'name', 'display' ) ).'"><img src="'.$logo.'" /></a>';
		echo  '</div>'."\n";
	}
	?>
	<div class="footer-wrap">
	<?php 
		if (has_nav_menu('bottom menu')) {
			theme_bottom_wp_nav(); 
		}
	?>
	<div class="footer-copyright">
	<?php
		/*add the copyright to footer*/
		if(theme_get_option('footer','copyright')) {
			echo stripslashes(theme_get_option('footer','copyright'));
		}

		/*add the wordpress link to footer*/
		if(theme_get_option('footer','wordpress_link') == true) { 
			_e(' &nbsp; ', 'HK'); 
		}
	?>
	</div>
	</div>
</div>
<!--End Footer-->
</footer>

<!--End Wrap-->
</div>
<?php if(theme_get_option('footer','go_top') == true) : ?>
<div id="toTop">Back to top</div>
<?php endif; ?>
<?php wp_footer(); ?>
<!--End Body-->


</body>

<!--End Html-->
</html>

<!-- Baidu Button BEGIN -->
<script type="text/javascript" id="bdshare_js" data="type=slide&amp;img=2&amp;pos=left&amp;uid=6567974" ></script>
<script type="text/javascript" id="bdshell_js"></script>
<script type="text/javascript">
var bds_config={"bdTop":174};
document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date()/3600000);
</script>
<!-- Baidu Button END -->