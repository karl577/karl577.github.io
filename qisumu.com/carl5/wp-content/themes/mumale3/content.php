<div id="post-<?php the_ID(); ?>" class="post-home">
	<div class="post-thumbnail">
	<?php if(get_post_meta($post->ID, 'sale_price', true)!=''){?>
	<div class="shop"></div>
	<?php }?>
		<?php post_thumbnail();?>
	</div>
	<div class="post-info topbo">
		<div class="views"><?php if(function_exists('the_views')) {$views = the_views(0);preg_match('/\d+/', $views, $match);echo '<span>'.$match[0].'</span>';} ?></div>
		<div class="comments"><span><?php comments_popup_link('0', '1', '%'); ?></span></div>
		<?php if(function_exists('wizylike')) wizylike('button');  ?>
	</div>
	<div class="post-info-1 topbo">
      <div class="content-author"><a href="<?php the_author_meta( user_url ); ?>" hidefocus="true"><?php echo get_avatar(get_the_author_email(),"32");?></a></div> 
      <div class="content-reader"><?php the_author_posts_link(); ?> 在<?php echo human_time_diff(get_the_time('U'),current_time('timestamp',1)).'前'; ?>发布到 <?php the_category(', ') ?> </div>
  	</div>
	<?php 
      $comments=get_comments('status=approve&type=comment&order=ASC&number=3&post_id='.get_the_ID());
	  if( !empty($comments) ) {
    ?>
	<div class="post-info-2 topbo">
	<a href="<?php comments_link(); ?>" class="views-comments" hidefocus="true">查看全部<?php comments_number('0','1','%');?>条评论&nbsp;&raquo;</a>
	</div>
    <?php }?>

	<?php foreach($comments as $comment){;?>
	<div class="post-info-1 topbo">
	<div class="content-author">
	<?php echo get_avatar($comment->comment_author_email,32);?>
	</div>
	<div class="content-reader">
	<a href="<?php echo $comment->comment_author_url;?>"><?php echo $comment->comment_author; ?></a>：
    <?php echo convert_smilies(strip_tags($comment->comment_content));?>
	</div>
	</div>
	<?php }?>

</div>