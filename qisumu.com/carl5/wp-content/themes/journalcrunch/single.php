<?php get_header(); ?>

<!-- Begin #colleft -->
			<div id="colLeft">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>	
				<div id="singlePost">
					<h1><?php the_title(); ?></h1>
					<div class="meta">
					 <?php the_time('M j, Y') ?> by <?php the_author_posts_link()?>&nbsp;&nbsp;&nbsp;<img src="<?php bloginfo('template_directory'); ?>/images/ico_post_comments.png" alt="" /> <?php comments_popup_link('No Comments', '1 Comment ', '% Comments'); ?>&nbsp;&nbsp;&nbsp;<img src="<?php bloginfo('template_directory'); ?>/images/ico_post_date.png" alt="" /> Posted under:  <?php the_category(', ') ?> <?php edit_post_link('编辑',' [',']&#187;');?>
<!-- 一键转载部分 -->
<img src="http://v.t.qq.com/share/images/s/weiboicon16.png" align="absmiddle" border="0" alt="转播到腾讯微博" /> <a href="javascript:void(0)" onclick="postToWb();return false;" style="height:16px;font-size:12px;line-height:16px;">转播到腾讯微博</a><script type="text/javascript">
	function postToWb(){
		var _t = encodeURI(document.title);
		var _url = encodeURIComponent(document.location);
		var _appkey = encodeURI("e7d54fd3bd144350b8a3cddde13fd7c1");//你从腾讯获得的appkey
		var _pic = encodeURI('http://luqiqi.com');//（例如：var _pic='图片url1|图片url2|图片url3....）
		var _site = '';//你的网站地址
		var _u = 'http://v.t.qq.com/share/share.php?url='+_url+'&appkey='+_appkey+'&site='+_site+'&pic='+_pic+'&title='+_t;
		window.open( _u,'', 'width=700, height=680, top=0, left=0, toolbar=no, menubar=no, scrollbars=no, location=yes, resizable=no, status=no' );
	}
</script>

					</div>
		<?php the_content(); ?>					



</div>
<div id="wumiiDisplayDiv"></div>
<div class="nearbypost">
<h4><div class="alignleft"><?php previous_post_link('向左行 %link'); ?></div>

<div class="alignright"><?php next_post_link('%link
向右走 '); ?></div></h4>
				</div>
				<?php comments_template(); ?>
		<?php endwhile; else: ?>

		<p>对不起，您要查看的页面已经转移了.</p>

	<?php endif; ?>
   
			
			</div>
			<!-- End #colLeft -->
			

<?php get_sidebar(); ?>	
<?php get_footer(); ?>