<?php
/*
* ----------------------------------------------------------------------------------------------------
* Portfolio Loop 1- This is a pagination list with one column.
* @PACKAGE BY HAWKTHEME
* ----------------------------------------------------------------------------------------------------
*/

$portfolio_page_id = theme_get_option('portfolio','page_for_portfolio');
$list_lightbox = theme_get_option('portfolio','list_lightbox');
$read_more = theme_get_option('portfolio','read_more');
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

<ul class="portfolio-lists">
<?php 
while (have_posts()) : the_post();

	$desc = get_the_excerpt();

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
	<div class="post-entry clearfix"<?php if ( !has_post_thumbnail() ) { echo ' style="width: 100%;"'; } ?>>
	<h2><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
	<p class="post-excerpt"><?php echo do_shortcode( shortcode_unautop( $desc ) ); ?></p>
	<?php if($read_more) :?><p class="post-more"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php echo $read_more; ?></a></p><?php endif; ?>
	</div>
	<?php if($feature_image) : ?>
	<div class="post-thumb">
	<a href="<?php echo $link; ?>" title="<?php the_title_attribute(); ?>" class="image-link" <?php echo $rel; ?>>
	<img width="650" height="260" src="<?php echo $feature_image; ?>"  class="wp-post-image" alt="<?php the_title_attribute(); ?>"  title="<?php the_title_attribute(); ?>" />
	</a>
	</div>
	<?php elseif ( has_post_thumbnail() ) : ?>
	<div class="post-thumb">
	<a href="<?php echo $link; ?>" title="<?php the_title_attribute(); ?>" class="image-link" <?php echo $rel; ?>>
	<?php the_post_thumbnail('650-260'); ?>
	</a>
	</div>
	<?php endif; ?>
</li>
<!--End Item-->
<?php endwhile; ?>
</ul>