<?php
/*
* ----------------------------------------------------------------------------------------------------
* Portfolio Loop 2- This is a pagination list with two/three/four column.
* @PACKAGE BY HAWKTHEME
* ----------------------------------------------------------------------------------------------------
*/

$portfolio_page_id = theme_get_option('portfolio','page_for_portfolio');
$list_lightbox = theme_get_option('portfolio','list_lightbox');
$enable_excerpt = theme_get_option('portfolio','enable_excerpt');
$read_more = theme_get_option('portfolio','read_more');
$list_style = theme_get_option('portfolio','list_style');
switch($list_style)
{
	case 2: $thumb_size = '460-320'; $column = '2'; $thumb_width= '460'; $thumb_height= '320'; $excerpt_length = '150'; break;
	case 3: $thumb_size = '290-190'; $column = '3'; $thumb_width= '290'; $thumb_height= '190'; $excerpt_length = '120'; break;
	case 4: $thumb_size = '205-140'; $column = '4'; $thumb_width= '205'; $thumb_height= '140'; $excerpt_length = '70'; break;
	case 5: $thumb_size = '460-320'; $column = '2'; $thumb_width= '460'; $thumb_height= '320'; $excerpt_length = '150'; break;
	case 6: $thumb_size = '290-190'; $column = '3'; $thumb_width= '290'; $thumb_height= '190'; $excerpt_length = '120'; break;
	case 7: $thumb_size = '205-140'; $column = '4'; $thumb_width= '205'; $thumb_height= '140'; $excerpt_length = '70'; break;
}

$loop_count = 0;
?>

<?php
$menu_args = array(
	'taxonomy' => 'portfolio-types',
	'orderby' => 'name',
	'show_count' => 0, // 1 for yes, 0 for no
	'hierarchical' => 1, // 1 for yes, 0 for no
	'hide_empty' => 0, // 1 for yes, 0 for no
	'title_li' => '',
	'depth' => 1
);
?>
<nav class="portfolio-menu">
<ul class="clearfix">
<?php
	if(get_the_ID() == $portfolio_page_id ) {
		$current_class = ' class="current-cat"';
	}else{
		$current_class = '';
	}

	if($portfolio_page_id) {
		echo '<li'.$current_class.'><a href="'.get_page_link($portfolio_page_id).'">';
		esc_html_e('All','HK');
		echo '</a></li>';
	}

	wp_list_categories( $menu_args ); 
?>
</ul>
</nav>

<ul class="portfolio-grid clearfix">
<?php
while (have_posts()) : the_post();
	$loop_count++; 

	if ( ($loop_count -1) % $column == 0 ) {
		$post_class = 'class="post col-'.$column.'-1 first"';
	}elseif( $loop_count % $column == 0 ) {
		$post_class = 'class="post col-'.$column.'-1 last"';
	}else{
		$post_class = 'class="post col-'.$column.'-1"';
	}

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
<li <?php echo $post_class; ?>>
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