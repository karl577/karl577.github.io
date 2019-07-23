<?php
/*
* ----------------------------------------------------------------------------------------------------
* Blog Loop 1
* @PACKAGE BY HAWKTHEME
* ----------------------------------------------------------------------------------------------------
*/

$list_lightbox = theme_get_option('blog','list_lightbox');
$time = theme_get_option('blog','enable_time');
$comment = theme_get_option('blog','enable_comment');
$author = theme_get_option('blog','enable_author');
$category = theme_get_option('blog','enable_category');
$excerpt_length = theme_get_option('blog','excerpt_length');
$read_more = theme_get_option('blog','read_more');
?>

<ul class="blog-lists blog-lists-1">
<?php 
while (have_posts()) : the_post(); 

	if($list_lightbox == true) 
	{
		$link = theme_large_image_uri();
		$rel = 'data-id="fancybox"';
	}else{
		$link = get_permalink();
		$rel = 'rel="bookmark"';
	}

	$feature_image = get_meta_option('feature_image');
?>
<!--Begin Item-->
<li class="post clearfix">
	<div class="post-entry">
		<h2><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
		<p class="post-meta">
		<?php if($author == true) : ?><?php esc_html_e('作者： ','HK'); the_author_posts_link(); ?><span>//</span><?php endif; ?>
		<?php if($time == true) : ?><?php printf( __('%1$s', 'HK'), get_the_time('F j, Y') ); ?><span>//</span><?php endif; ?>
		<?php if($comment == true) : ?><?php comments_popup_link(__('无评论', 'HK'), __('1评论', 'HK'), __('%评论', 'HK'), '', __('评论关闭', 'HK')); ?><span>//</span><?php endif; ?>
		<?php if($category == true) : ?><?php the_category(', '); ?><span>//</span><?php endif; ?>
		<?php edit_post_link( __( '编辑', 'HK' ), '', '<span>//</span>' ); ?>
		</p>
	</div>
	<?php if($feature_image) : ?>
	<div class="post-thumb">
	<a href="<?php echo $link; ?>" title="<?php the_title_attribute(); ?>" class="image-link" <?php echo $rel; ?>>
	<img width="650" height="200" src="<?php echo $feature_image; ?>"  class="wp-post-image" alt="<?php the_title_attribute(); ?>"  title="<?php the_title_attribute(); ?>" />
	</a>
	</div>
	<?php elseif ( has_post_thumbnail() ) : ?>
	<div class="post-thumb">
	<a href="<?php echo $link; ?>" title="<?php the_title_attribute(); ?>" class="image-link" <?php echo $rel; ?>>
	<?php the_post_thumbnail('650-200'); ?>
	</a>
	</div>
	<?php endif; ?>
	<div class="post-entry">
		<p class="post-excerpt"><?php theme_description($excerpt_length); ?></p>
		<?php if($read_more) : ?><p class="post-more"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php echo $read_more; ?></a></p><?php endif; ?>
	</div>
</li>
<!--End Item-->
<?php endwhile; ?>
</ul>