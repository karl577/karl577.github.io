<div class="fat-footer">
	<div class="wrapper">
		<div class="layout layout--center">
			<div class="layout__item palm-mb">
				<div class="media">
					<img class="media__img avatar" src="<?php echo stripslashes(get_option('strive_zztxurl')); ?>" alt="" height="50" width="50">
					<div class="media__body">
						<h4><?php echo stripslashes(get_option('strive_zznc')); ?></h4>
						<p>
							<?php echo stripslashes(get_option('strive_grsm')); ?>
						</p>
					</div>
				</div>
			</div>
			<?php if(get_option('strive_weixin') == 'Display') { ?>
			<div class="layout__item yc">
				<div class="fat-footer__social">
					<ul class="list-bare list-inline">
				        <li><a href="<?php echo stripslashes(get_option('strive_zzwburl')); ?>" target="_blank" rel="nofollow"><i class="iconfont" aria-hidden="true"></i></a></li>
 					    <li><a href="<?php echo stripslashes(get_option('strive_zzqqurl')); ?>" target="_blank" rel="nofollow"><img class="qq" src="<?php bloginfo('template_directory'); ?>/images/qq.png"></a></li>
						<li><a href="javascript:void(0)" onMouseOut="hideImg()"  onmouseover="showImg()"><i class="iconfont" aria-hidden="true"></i></a><div id="wxImg" style="height: 50px; position: absolute; margin-top: -143px; margin-left: -20px; display: none;"><img src="<?php echo stripslashes(get_option('strive_zzwxurl')); ?>"></div></li>
					</ul>
				</div>
			</div>
			<?php } else { } ?>
		</div>
	</div>
</div>
<footer class="footer" role="contentinfo">
<div class="wrapper wrapper--wide split split--responsive">
	<div class="split__title">
			© 2016 by <?php bloginfo('name'); ?>. All rights reserved.
	</div>
		Theme:		
	<a href="http://pixelrevel.com/themes/wordpress/thoughts" target="_blank" rel="nofollow">Variant</a> copy by
	<a href="http://ztmao.com/" target="_blank">wordpress主题</a>
</div>
</footer>
<form class="js-search search-form search-form--modal" method="get" action="<?php bloginfo('url'); ?>" role="search">
	<div class="search-form__inner">
		<div>
			<i class="iconfont"></i>
			<input class="text-input" name="s" placeholder="Enter keyword ..." type="search">
		</div>
	</div>
</form>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/module.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/script.js"></script>
<script>
		var infinite_scroll = {
			loading: {
				img: '/wp-content/themes/Variant/images/ajax-loader.gif',
				msgText: '',
				finishedMsg: ''
			},
			nextSelector: '.js-next a',
			navSelector: '.js-pagination',
			itemSelector: '.post',
			contentSelector: '.js-posts'
		};
	</script>
<script type="text/javascript">
function  showImg(){
document.getElementById("wxImg").style.display='block';
}
function hideImg(){
document.getElementById("wxImg").style.display='none';
}
</script>
<div id="fb-root">
</div>
<?php echo stripslashes(get_option('strive_yjtjcode')); ?>
<?php wp_footer(); ?>
</body>
</html>