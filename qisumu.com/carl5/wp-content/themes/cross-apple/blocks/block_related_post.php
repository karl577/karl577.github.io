<?php 
/*
* ----------------------------------------------------------------------------------------------------
* RELATED POSTS FUNCTIONS
* @PACKAGE BY HAWKTHEME
* ----------------------------------------------------------------------------------------------------
*/

function theme_related_post($taxonomy, $lightbox) 
{
	switch($taxonomy)
	{
		case 'category': $thumb_size = '190-120'; $column = '3'; break;
		case 'portfolio-types': $thumb_size = '205-140'; $column = '4'; break;
		case 'product-types': $thumb_size = '205-140'; $column = '4'; break;
	}
	$count = 0;
?>
	<ul class="clearfix">
	<?php
		$related_posts = get_posts_related_by_taxonomy($taxonomy, $column);
		while ($related_posts->have_posts()) : $related_posts->the_post();
		
		$count ++;

		if($count % $column == 0) {
			$class = ' class="last"';
		}else{
			$class = '';
		}

		if($lightbox == 'yes') 
		{
			$link = theme_large_image_uri();
			$rel = 'data-id="fancybox"';
		}else{
			$link = get_permalink();
			$rel = 'rel="bookmark"';
		}
	?>
	<li<?php echo $class; ?>>
	<?php if ( has_post_thumbnail() ) : ?>
	<div class="post-thumb">
	<a href="<?php echo $link; ?>" title="<?php the_title_attribute(); ?>" class="image-link" <?php echo $rel; ?>>
	<?php the_post_thumbnail($thumb_size); ?>
	</a>
	</div>
	<?php endif; ?>
	<h2><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
	</li>
	<?php endwhile; wp_reset_query(); ?>
	</ul>
<?php
}

?>