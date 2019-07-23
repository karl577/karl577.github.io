<aside>
<?php $options = get_option('Newer_options'); ?>


<div class="postdetail">
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		您正在阅读的是：<?php the_title(); ?><br/>
		由 <?php the_author(); ?> 发表于 <?php the_time('n月d日') ?><br/>
		文章分类：<?php the_category(', ') ?><br/>
		标签：<?php if ( get_the_tags() ) { the_tags('', ', ', ' '); } else{ echo "暂无关键词";  } ?>
		<?php endwhile; endif;?></div>

	
					
		
		<div id="sidebarwidgit">
		
		
		
	<?php if ( ! dynamic_sidebar( '单篇文章的Sidebar' )) : ?>
	
	<?php endif; ?>
	<div class="widgit-area">
		<h3>Your steps</h3>
		<?php
if($_COOKIE["comment_author_" . COOKIEHASH]!=""){
//1.如果COOKIE不为空，则输出您的足迹
global $wpdb;//2.读取数据库相关项
$sql = "SELECT DISTINCT ID, post_title,post_password,
comment_ID, comment_post_ID,comment_author,
comment_count,
comment_date_gmt,comment_approved, comment_author_email,
comment_type,comment_author_url,
SUBSTRING(comment_content,1,25)
AS com_excerpt FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts
ON ($wpdb->comments.comment_post_ID = $wpdb->posts.ID)
WHERE comment_approved = '1' AND comment_type = ''
AND comment_author = '".$_COOKIE["comment_author_" . COOKIEHASH]."'
AND post_password = ''
GROUP BY comment_post_ID
ORDER BY comment_date_gmt
DESC LIMIT 5";//3.输出10篇文章
$comments = $wpdb->get_results($sql);
foreach ($comments as $comment) {
$output .= "\n<li><a href=\"" .get_permalink($comment->ID)."#comment-".$comment->comment_ID. "\" title=\"" . $comment->post_title ."(". $comment->comment_count."评论)\">" . $comment->post_title . "</a></li>";
}//4.输出最近评论过的文章
$output = '<ul class="ulstyle">'.$output.'</ul>';
$output = convert_smilies($output);
echo $output;
}
else{
echo '<ul class="class"><li>'."居然还没发表过评论！！可恶".'</li></ul>';
}
?>		
		</div>
	</div>
	
	

</aside>


<script type="text/javascript">
		$("#loadbar").show();
		$("#loadbar div").animate({width:"80%"});
</script>