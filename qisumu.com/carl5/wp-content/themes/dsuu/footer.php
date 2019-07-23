<?php if ( is_single() ) { ?>
<script type="text/javascript">
    var wumiiPermaLink = "<?php the_permalink() ?>";
    var wumiiTitle = "<?php the_title(); ?> - <?php tagtext(); ?>";
    var wumiiTags = "<?php tagtext(); ?>";
    var wumiiSitePrefix = "http://www.dsuu.cc/";
    var wumiiParams = "&num=6&mode=2&pf=JAVASCRIPT";
</script>
<script type="text/javascript" src="http://widget.wumii.com/ext/relatedItemsWidget"></script>
<a href="http://www.wumii.com/widget/relatedItems" style="border:0;">
    <img src="http://static.wumii.cn/images/pixel.png" alt="无觅相关文章插件，快速提升流量" style="border:0;padding:0;margin:0;" />
</a>
<?php } ?>
<div id="footer" class="clr">
<div class="footerc">
<div class="link">
<?php wp_reset_query(); if ( is_home() && !is_paged() ) { ?>
<a href="http://www.dsuu.cc" target="_blank">趣味集</a>
<?php }else{ ?>
<?php get_ointag(); ?>
<?php } ?>
</div>
<div class="footcont">
	<div class="footct">
		<div>
		<div class="frdlk"><a href="/tags/">TAG</a><i>|</i><a href="/feed/" rel="nofollow">RSS</a><i>|</i><a href="/sitemap.xml" target="_blank">Sitemap</a></div>
		<div class="l">&copy;Copyright by <a href="http://www.dsuu.cc" title="趣味集,专注于搞笑图,搞笑视频,搞笑段子的分享网站">趣味集</a>, all rights reserved. 搞笑图,搞笑视频,搞笑段子分享网站 <a href="http://www.miibeian.gov.cn/" rel="external nofollow">浙ICP备13002817号-1</a></div>
		</div>
	</div>
</div>
</div>
</div>
<script type="text/javascript" src="/wp-content/themes/twentytwelve/js/jquery.masonry.min.js"></script>
<script>
jQuery(document).ready(function($) {
$('#container').masonry({
   itemSelector: '.item',
   columnWidth: 0,
});	
});
</script>
<p id="back-top"><a href="#top" title="返回顶部"></a></p>
<script type="text/javascript">
jQuery(document).ready(function($){
	$("#back-top").hide();
	$(function () {
		$(window).scroll(function () {
			if ($(this).scrollTop() > 100) {
				$('#back-top').fadeIn();
			} else {
				$('#back-top').fadeOut();
			}
		});
		$('#back-top a').click(function () {
			$('body,html').animate({
				scrollTop: 0
			}, 800);
			return false;
		});
	});
});
</script>
<?php if ( is_home() || is_single() ) { ?>
<script>
jQuery(document).ready(function($) {
$('#viewReInfo').myHoverTip('receiptInfo');
});
</script>
<?php } ?>
<?php if ( is_single() || is_page('2591') || is_page('5433') ) { ?>
<script>
jQuery(document).ready(function($) {
	$('.p5 a').hover(
		function(){
			$(this).find('img').stop().animate({opacity: 0.8}, 300);
		},
		function(){
			$(this).find('img').stop().animate({opacity: 1}, 300);
		}
	)
});
</script>
<script src="/wp-content/themes/twentytwelve/js/portamento-min.js"></script>
<script>
jQuery(document).ready(function($) {
$('#sidebar').portamento({wrapper:$('#mblogdetail'),gap:40,disableWorkaround:true});
});
</script>
<script type="text/javascript" id="bdshare_js" data="type=button&amp;uid=38721" ></script>
<script type="text/javascript" id="bdshell_js"></script>
<script type="text/javascript">
var bds_config={"snsKey":{'tsina':'1436654363','tqq':'801312079','t163':'','tsohu':''}}
document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date()/3600000);
</script>
<?php } ?>
<?php wp_footer();?>
<?php if (is_user_logged_in()) { ?>  
<?php echo get_num_queries(); ?> queries in <?php timer_stop(1); ?> seconds.  
<?php } ?>
</body>
</html>