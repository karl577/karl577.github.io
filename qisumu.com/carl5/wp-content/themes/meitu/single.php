<?php get_header(); ?>
<div class="w960">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<?php setPostViews(get_the_ID()); ?>
	<div id="content">
		<div id="content-post">
			<div id="brd">
				<a href="<?php bloginfo('url'); ?>" title="<?php bloginfo('name'); ?>">首页</a><?php the_tags(' > ',', ',''); ?>
			</div>
			<div id="single-btn-div">
				<?php if (is_user_logged_in()) { ?>
				<?php 
					$fav_array = get_post_meta($post->ID,'fav_user_value',false);
					if ( in_array(wt_get_user_id(),$fav_array) ) {
				?>
				<a id="fav-btn" class="single-btn" href="javascript:favx(<?php the_ID(); ?>);"><i class="icon-star"></i> 取消收藏</a>
				<?php } else { ?>
				<a id="fav-btn" class="single-btn" href="javascript:fav(<?php the_ID(); ?>);"><i class="icon-star-empty"></i> 收藏 (<span><?php echo getFavCount(get_the_ID()); ?></span>)</a>
				<?php } ?>
				<?php } else { ?>
				<a id="fav-btn" class="single-btn" href="<?php echo get_option('mao10_sign'); ?>"><i class="icon-star-empty"></i> 收藏 (<span><?php echo getFavCount(get_the_ID()); ?></span>)</a>
				<?php } ?>
				<?php if (is_user_logged_in()) { ?>
				<?php 
					$like_array = get_post_meta($post->ID,'xihuan_user_value',false);
					if ( in_array(wt_get_user_id(),$like_array) ) {
				?>
				<a id="like-btn" class="single-btn" href="javascript:;"><i class="icon-heart"></i> 已喜欢</a>
				<?php } else { ?>
				<a id="like-btn" class="single-btn" href="javascript:like(<?php the_ID(); ?>);"><i class="icon-heart-empty"></i> 喜欢 (<span><?php echo getLikeCount(get_the_ID()); ?></span>)</a>
				<?php } ?>
				<?php } else { ?>
				<a class="box-btn box-like" href="<?php echo get_option('mao10_sign'); ?>" id="like<?php the_ID(); ?>"><i class="icon-heart-empty"></i> 喜欢</a>
				<?php } ?>
			</div>
			<img id="single-img" src="<?php echo img(); ?>" alt="<?php the_title(); ?>">
		</div>
		<h1 id="entry">
			<?php the_title(); ?>
		</h1>
		<div id="comment">
			<h3 class="title">评论 (<?php comments_number('0', '1', '%' );?>)</h3>
			</ul>
			<?php comments_template(); ?>
		</div>
	</div>
	<div id="sidebar">
		<?php get_template_part('author-side'); ?>
	<?php endwhile; ?><?php endif; ?>
		<div id="author-post">
			<h3>TA的其他图片</h3>
			<?php
				global $post;
				$post_author = get_the_author_meta( 'ID' );
				$args = array(
					'author_name' => $post_author,
			        'post__not_in' => array($post->ID),
			        'showposts' => 9,
			        'orderby' => 'date',
			        'caller_get_posts' => 1
				);
				query_posts($args);
			?>
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<div class="author-post">
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><img alt="<?php the_title(); ?>" src="<?php echo img(); ?>"></a>
			</div>
			<?php endwhile; else : ?>
			<div id="author-post-none">TA还没有发布其他图片</div>
			<?php endif; wp_reset_query(); ?>
		</div>
	</div>
</div>
<?php get_template_part('single-js'); ?>
<?php get_footer(); ?>