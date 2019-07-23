<?php
/*
* ----------------------------------------------------------------------------------------------------
* Portfolio Loop 3- This is a sortable list with two/three/four column.
* @PACKAGE BY HAWKTHEME
* ----------------------------------------------------------------------------------------------------
*/

$list_lightbox = theme_get_option('portfolio','list_lightbox');
$enable_excerpt = theme_get_option('portfolio','enable_excerpt');
$read_more = theme_get_option('portfolio','read_more');
$list_style = theme_get_option('portfolio','list_style');
switch($list_style)
{
	case 5: $thumb_size = '460-320'; $column = '2'; $thumb_width= '460'; $thumb_height= '320'; $excerpt_length = '150'; break;
	case 6: $thumb_size = '290-190'; $column = '3'; $thumb_width= '290'; $thumb_height= '190'; $excerpt_length = '120'; break;
	case 7: $thumb_size = '205-140'; $column = '4'; $thumb_width= '205'; $thumb_height= '140'; $excerpt_length = '70'; break;
}

$cat_args = array(	
	'taxonomy'	=> 'portfolio-types',
	'hide_empty'=> 0
);

$loop_count = 0;

?>

<nav class="portfolio-menu portfolio-sortable-menu">
<ul class="filter clearfix">
<li class="active all-items" ><a href="?filter=all"><?php esc_html_e('All','HK'); ?></a></li>
<?php
	$terms = get_categories($cat_args); 
	foreach ($terms as $term) {
		echo '<li class="cat-item '.$term->slug.'"><a href="?filter='.$term->slug.'" data-value="'.$term->slug.'" >'.$term->name.'</a>';
	}
?>
</ul>
</nav>

<ul class="portfolio-grid portfolio-sortable-grid portfolio-sortable-grid-<?php echo $column; ?> clearfix">
<?php
while (have_posts()) : the_post();

	$item_categories = get_the_terms ($post->ID, 'portfolio-types');
	foreach ($item_categories as $key => $cat) {
		$item_categories[$key] = $cat->slug;
	}
	$sort_classes = implode( ' ',$item_categories);
	$post_class = 'class="post item col-'.$column.'-1 '.$sort_classes.'"';

	if($list_lightbox == true) 
	{
		$link = theme_large_image_uri();
		$rel = 'data-id="fancybox"';
	}else{
		$link = get_permalink();
		$rel = 'rel="bookmark"';
	}

	$loop_count++;

	$feature_image = get_meta_option('feature_image');

?>
<!--Begin Item-->
<li <?php echo $post_class; ?> data-id="post-<?php echo $loop_count; ?>">
	<?php if($feature_image) : ?>
	<div class="post-thumb">
	<a href="<?php echo $link; ?>" title="<?php the_title_attribute(); ?>" class="image-link" <?php echo $rel; ?>>
	<img width="<?php echo $thumb_width; ?>" height="<?php echo $thumb_height; ?>" src="<?php echo $feature_image; ?>"  class="wp-post-image" alt="<?php the_title_attribute(); ?>"  title="<?php the_title_attribute(); ?>" />
	</a>
	</div>
	<?php elseif ( has_post_thumbnail() ) : ?>
	<div class="post-thumb">
	<a href="<?php echo $link; ?>" title="<?php the_title_attribute(); ?>" class="image-link" <?php echo $rel; ?>>
	<?php the_post_thumbnail($thumb_size); ?>
	</a>
	</div>
	<?php endif; ?>
	<div class="post-entry">
	<h2><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
	<?php if($enable_excerpt == true) : ?><p class="post-excerpt"><?php theme_description($excerpt_length); ?></p><?php endif; ?>
	<?php if($read_more) :?><p class="post-more"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php echo $read_more; ?></a></p><?php endif; ?>
	</div>
</li>
<!--End Item-->
<?php endwhile; ?>
</ul>