			</div>
	</div>

	<div class="footer">
		<div>
			<?php if(is_home() && ! is_paged()) { ?>
			<?php wp_nav_menu( array('fallback_cb' => 'black_with_orange_page_menu_flat', 'container' => false, 'depth' => '1', 'theme_location' => 'secondary', 'link_before' => '', 'link_after' => '') ); ?>
			<?php } ?>
			<p class="powered">个人网站：
<img src="http://www.chishuiba.com/favicon.ico" width="20" height="20"><a href="http://www.chishuiba.com/" target="_blank" title="吃睡吧 - 世界上最幸福的事情莫过于吃着吃着睡着了" target="_blank">吃睡吧</a>
<img src="http://www.car2parts.com/favicon.ico" width="20" height="20"><a href="http://www.car2parts.com/" target="_blank" title="汽车配件超市 - 致力打造优质划算的汽车配件网上超市" target="_blank">汽车配件网</a>
<img src="http://www.taoxie8.com/favicon.ico" width="20" height="20"><a href="http://www.taoxie8.com/" target="_blank" title="淘鞋吧 - 淘喜欢的鞋，好鞋尽在淘鞋吧" target="_blank">淘鞋吧</a>

			</p>
			<p class="powered">Copyright © <a href="http://www.aimks.com/">明凯博客</a> <a href="http://www.miitbeian.gov.cn" target="_blank">粤ICP备13057695号-1</a>  <a href="http://www.aimks.com/sitemap_baidu.xml" target="_blank">百度地图</a>  <a href="http://www.aimks.com/sitemap.xml" target="_blank">谷歌地图</a>  <a href="http://www.aimks.com/sitemap.html" target="_blank">站点地图</a>  <a href="http://www.aimks.com/tags" target="_blank">标签存档</a></p>
		</div>
	</div>
	<?php wp_footer(); ?>
<div id="roll">
       <div id="roll_up" title="↑ 返回顶部"></div>
       <?php if ( is_singular() ){ ?>
       <div id="roll_comment" title="查看评论"></div>
       <?php } ?>
       <div id="roll_down" title="↓ 移至底部"></div>
</div>

</body>
</html>