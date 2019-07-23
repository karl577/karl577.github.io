<div class="box">
	<?php if (is_user_logged_in()) { ?>
	<?php 
		$like_array = get_post_meta($post->ID,'xihuan_user_value',false);
		if ( in_array(wt_get_user_id(),$like_array) ) {
	?>
	<a class="box-btn box-like" href="javascript:;" id="like<?php the_ID(); ?>"><i class="icon-heart"></i> 已喜欢</a>
	<?php } else { ?>
	<a class="box-btn box-like" href="javascript:like(<?php the_ID(); ?>);" id="like<?php the_ID(); ?>"><i class="icon-heart-empty"></i> 喜欢</a>
	<?php } ?>
	<?php } else { ?>
	<a class="box-btn box-like" href="<?php echo get_option('mao10_sign'); ?>" id="like<?php the_ID(); ?>"><i class="icon-heart-empty"></i> 喜欢</a>
	<?php } ?>
	<?php if (is_user_logged_in()) { ?>
	<?php 
		$fav_array = get_post_meta($post->ID,'fav_user_value',false);
		if ( in_array(wt_get_user_id(),$fav_array) ) {
	?>
	<a class="box-btn box-fav" href="javascript:favx(<?php the_ID(); ?>);" id="fav<?php the_ID(); ?>"><i class="icon-star"></i> 取消收藏</a>
	<?php } else { ?>
	<a class="box-btn box-fav" href="javascript:fav(<?php the_ID(); ?>);" id="fav<?php the_ID(); ?>"><i class="icon-star-empty"></i> 收藏</a>
	<?php } ?>
	<?php } else { ?>
	<a class="box-btn box-fav" href="<?php echo get_option('mao10_sign'); ?>" id="fav<?php the_ID(); ?>"><i class="icon-star-empty"></i> 收藏</a>
	<?php } ?>
	<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><img src="<?php echo img(); ?>" alt=<?php the_title(); ?>""></a>
	<div class="caption">
		<a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" class="avatar"><img src="<?php echo touxiang(get_the_author_meta('ID')); ?>"></a>
		<div class="avatar-right">
			<a href="<?php echo get_author_posts_url(); ?>"><?php echo get_the_author_meta('display_name'); ?></a> 分享了这个图片 : <?php the_title(); ?>
		</div>
		<div class="c"></div>
	</div>
	<?php global $withcomments;$withcomments = true; comments_template("/box-comments.php"); ?>
</div>