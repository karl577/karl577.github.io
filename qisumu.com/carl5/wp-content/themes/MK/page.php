<?php get_header(); ?>
<div class="main">
	<?php if (have_posts()) while (have_posts()) : the_post(); ?>
	<?php setPostViews(get_the_ID()); ?> 
		<h1><?php the_title(); ?> <?php edit_post_link(__('Edit', 'black_with_orange'), '', ''); ?></h1>
		<?php the_content(); ?>
<div class="share">
<a target="_blank" href="http://shang.qq.com/wpa/qunwpa?idkey=cd7ec9ca7a13314e68d75fa4c843dc35a0382618cfbdd3fd478d3e18acc5d052"><img border="0" src="http://www.aimks.com/wp-content/themes/MK/images/group.png" alt="WEB技术交流群" title="WEB技术交流群"></a>
明凯博客版权所有，转载请注明，转载自：<strong><a href="<?php echo get_settings('home'); ?>" title="<?php bloginfo(‘name’); ?>">www.aimks.com</a></strong><br>
本文链接：<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_permalink(); ?></a>，共被阅读 <?php echo getPostViews(get_the_ID()); ?>次。
<div class="bshare">
<!-- Baidu Button BEGIN -->
<div id="bdshare" class="bdshare_t bds_tools get-codes-bdshare">
<span class="bds_more"></span>
<a class="bds_tsina"></a>
<a class="bds_qzone"></a>
<a class="bds_tqq"></a>
<a class="bds_renren"></a>
<a class="bds_tieba"></a>
<a class="bds_douban"></a>
<a class="bds_kaixin001"></a>
<a class="bds_ty"></a>
<a class="bds_fbook"></a>
<a class="bds_sqq"></a>
<a class="shareCount"></a>
</div>
<script type="text/javascript" id="bdshare_js" data="type=tools&amp;uid=1955463" ></script>
<script type="text/javascript" id="bdshell_js"></script>
<script type="text/javascript">
document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date()/3600000)
</script>
<!-- Baidu Button END -->
</div></div>
		<?php comments_template(); ?>
		<p class="pages"><?php wp_link_pages(); ?></p>
	<?php endwhile; ?>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>