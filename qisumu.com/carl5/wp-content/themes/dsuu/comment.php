<?php
/**
Template Name: 评论页
url : /comment/
*/
get_header();
?>
<div id="content">
<div class="atop">
<div class="layer" id="mblogdetail">
<div class="tube tube-a">
<div class="block" id="detailcnt">
<div class="center section">
<div class="crumb clr"><?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?></div>
<div class="article clr" id="article">
<div class="bdfx"><script type="text/javascript">
/*640*60，创建于2013-4-11*/
var cpro_id = "u1258613";
</script>
<script src="http://cpro.baidustatic.com/cpro/ui/c.js" type="text/javascript"></script></div>
</div>
<div class="replyinfo">
<div class="itop"></div>
<div id="comments">
	<div class="comments-title"><h4>最新评论<i>网友已在本站留下 <?php echo $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->comments");?> 条评论</i></h4></div>
	<ol id="comments-lists">
<?php
$sql = "SELECT DISTINCT ID, post_title, post_password, comment_ID, comment_post_ID, comment_author, comment_author_email, comment_author_url, comment_date, comment_approved, comment_type, comment_content
FROM $wpdb->comments
LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID = $wpdb->posts.ID)
WHERE comment_approved = '1' AND comment_type = '' AND post_password = ''
ORDER BY comment_date DESC
LIMIT 30";
$comments = $wpdb->get_results($sql);
foreach ($comments as $comment) {
?>
<li>
	<div id="comment-<?php echo $comment->comment_ID; ?>" class="comment-box" itemprop="comment" itemscope="" itemtype="http://schema.org/Comment">
		<div class="comment-avatar"><?php echo get_avatar($comment,$size='48',$default, $alt=get_comment_author($id)); ?></div>
		<div class="comment-info">
			<span class="comment_author" itemprop="author"><?php comment_author_link() ?></span>
			<span class="t">在《<a href="<?php echo get_permalink($comment->ID);?>" rel="bookmark" title="查看 《<?php echo get_the_title($comment->ID); ?>》 全文"><?php echo get_the_title($comment->ID); ?></a>》中说到：</span>

			<span class="reply"><a href="<?php echo get_permalink($comment->ID);?>#respond" rel="nofollow" data-comment-id="<?php echo $comment->comment_ID; ?>" data-comment-author="<?php echo $comment_author; ?>">回复</a></span>
			<span class="edit"><?php edit_comment_link('编辑','','') ?></span>
		</div>
		<div class="comment-content" itemprop="description"><p><?php comment_text() ?></p><p class="t"><span itemprop="datePublished" datetime="<?php comment_date('Y-m-d') ?>"><?php comment_date('Y/m/d') ?> </span><span><?php comment_time('H:i:s'); ?></span></p>
</div>
<div class="clear"></div>
	</div>
</li>
<?php
}
?>
</ol>
<div id="respond-line" class="line"></div>
<div id="respond">
</div>
</div>
</div>
</div>
<div class="bottom"></div>	
</div>
</div>
<div class="tube tube-b" id="wrapper">
<div class="block">
<div class="aright">
<div class="section mt20" id="sidebar">
<script type="text/javascript">
/*300*250，创建于2013-4-11*/
var cpro_id = "u1258622";
</script>
<script src="http://cpro.baidustatic.com/cpro/ui/c.js" type="text/javascript"></script>
</div>
<div class="section mt10" id="curalbum">
<h4 class="clr">你可能也会喜欢<i><a href="/top/">更多</a></i></h4>
<div class="switch clr"><div class="p5"> 
<ul>
<?php query_posts('showposts=9&meta_key=_thumbnail_id'); ?>
<?php while (have_posts()) : the_post(); ?>
<li><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><img class="postimg" src="<?php get_image_url(); ?>" width="100" height="100" alt="<?php the_title(); ?>"/></a></li>
<?php endwhile; ?>
</ul>
</div></div>
</div>
</div>
</div>
<div class="block dbi blockevent"></div>
</div>
</div>
</div>
</div>
<?php get_footer(); ?>