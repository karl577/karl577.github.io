</div>
<div id="footer">
<?php if(!is_home()){?>
<div class="realfoot">
	<div class="footct">
		<div class="frdlk">
		<?php wp_nav_menu( array( 'theme_location' => 'footer-menu' ) ); ?>
		
		</div>
		<?php if(stripslashes(get_option('mumale_copyright'))!=''){echo stripslashes(get_option('mumale_copyright'));}else{echo 'Copyright &copy; '.date("Y").' '.'<a href="'.home_url( '/' ).'" title="'.esc_attr( get_bloginfo( 'name') ).'">'.esc_attr( get_bloginfo( 'name') ).'</a> All rights reserved';}?> Themes By <a href="http://mumale.com">木马乐</a>
	</div>
</div>
<!-- is home -->
<?php }else{?>
<div class="realfoot footcont" style="visibility: visible;">
	<div class="footct">
		<div class="ft-us dgraylk">
			<?php wp_nav_menu( array( 'theme_location' => 'footer-menu') ); ?>
		</div>
		<div class="ft-out social graylk">
			<a href="http://www.mumale.com/" class="renren">人人网</a>
			<a href="http://www.mumale.com/" class="douban">豆瓣小站</a>
			<a href="http://www.mumale.com/" class="oicq">QQ空间</a>
			<a href="http://www.mumale.com/" class="qweibo">腾讯微博</a>
			<a href="http://www.mumale.com/" class="sina">新浪微博</a>
			<em>关注我们：</em>
		</div>
		<div class="ft-frd graylk">
			<?php wp_list_bookmarks(array('category_before'=>'','category_after'=>'','categorize'=>'0','title_li'=>'友情链接：','title_before'=>'<div class="linkleft">','title_after'=>'</div>','limit'=>'5','before'=>'','after'=>'',)); ?>
		</div>
		<div>
			<a href="http://www.mumale.com/" target="_blank" class="zhengxin"></a>
			<a href="http://www.mumale.com/" target="_blank" class="wangjing"></a>
		    <?php if(stripslashes(get_option('mumale_copyright'))!=''){echo stripslashes(get_option('mumale_copyright'));}else{echo 'Copyright &copy; '.date("Y").' '.'<a href="'.home_url( '/' ).'" title="'.esc_attr( get_bloginfo( 'name') ).'">'.esc_attr( get_bloginfo( 'name') ).'</a> All rights reserved';}?> Themes By <a href="http://mumale.com">木马乐</a>
		</div>
	</div>
</div>
<!-- is home end -->
<?php }?>
</div>
<div class="miss" style="display: block; margin-left: 1199.5px; ">
<div id="scrollTop"><a href="javascript:void(0);"></a></div>
</div>
<!--[if IE 6]><script src="<?php bloginfo('template_url');?>/includes/jQuery.autoIMG.min.js"></script><![endif]-->
<?php if (is_home()) {?>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/includes/index1.js" ></script>
<?php }?>
<?php wp_footer(); ?>
</body>
</html>