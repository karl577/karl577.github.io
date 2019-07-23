<?php
/*
Template Name: 排行
*/
?>
<?php
//文章排行
function most_viewed($time,$limit) {
global $wpdb, $post;
$output = "<ul class=\"hot_views\">";
$most_viewed = $wpdb->get_results("SELECT DISTINCT $wpdb->posts.*, (meta_value+0) AS post_views_count FROM $wpdb->posts LEFT JOIN $wpdb->postmeta ON $wpdb->postmeta.post_id = $wpdb->posts.ID WHERE post_date > date_sub( now(), interval $time day ) AND post_type ='post' AND post_status = 'publish' AND meta_key = 'post_views_count' AND post_password = '' ORDER BY post_views_count DESC LIMIT $limit");
if($most_viewed) {
$num=1;
foreach ($most_viewed as $post) {
$output .= "\n<li><a href= \"".get_permalink($post->ID)."\" rel=\"bookmark\" title=\"".$post->post_title." (".$post->post_views_count."+)\" >$num. ". $post->post_title." (".$post->post_views_count."+)</a></li>";
$num++;
}
$output .= "</ul><br>";
echo $output;
}
}
//评论排行
function most_commmented($time,$limit) {
global $wpdb, $post;
$output = "<ul class=\"hot_views\">";
$most_viewed = $wpdb->get_results("SELECT DISTINCT $wpdb->posts.* FROM $wpdb->posts  WHERE post_date > date_sub( now(), interval $time day ) AND post_type ='post' AND post_status = 'publish'  AND post_password = '' ORDER BY comment_count DESC LIMIT $limit");
if($most_viewed) {
$num=1;
foreach ($most_viewed as $post) {
$output .= "\n<li><a href= \"".get_permalink($post->ID)."\" rel=\"bookmark\" title=\"".$post->post_title." (".$post->comment_count."+)\" >$num. ". $post->post_title." (".$post->comment_count."+)</a></li>";
$num++;
}
$output .= "</ul><br>";
echo $output;
}
}
?>
<?php get_header(); ?>
<div class="main">
	<?php if (have_posts()) while (have_posts()) : the_post(); ?>
	<?php $plink=get_the_permalink();$pid=get_the_ID();$ptitle=get_the_title(); ?>
	<?php setPostViews(get_the_ID()); ?> 
		<h2>本月浏览量排行</h2>
		<?php most_viewed(30,10); ?>
		<h2>本月评论量排行</h2>
		<?php most_commmented(30,10); ?>
		<h2>年度浏览量排行</h2>
		<?php most_viewed(365,10); ?>
		<h2>年度评论量排行</h2>
		<?php most_commmented(365,10); ?>
<div class="share">
<a target="_blank" href="http://shang.qq.com/wpa/qunwpa?idkey=cd7ec9ca7a13314e68d75fa4c843dc35a0382618cfbdd3fd478d3e18acc5d052"><img border="0" src="http://www.aimks.com/wp-content/themes/MK/images/group.png" alt="WEB技术交流群" title="WEB技术交流群"></a>
明凯博客版权所有，转载请注明，转载自：<strong><a href="<?php echo get_settings('home'); ?>" title="<?php bloginfo('name'); ?>">www.aimks.com</a></strong><br>
本文链接：<a href="<?php echo $plink; ?>" title="<?php echo $ptitle; ?>"><?php echo $plink; ?></a>，共被阅读 <?php echo getPostViews($pid); ?>次。
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
		<p class="pages"><?php wp_link_pages(); ?></p>
	<?php endwhile; ?>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>