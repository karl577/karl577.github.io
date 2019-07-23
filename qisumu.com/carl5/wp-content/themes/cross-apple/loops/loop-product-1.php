<?php
/*
* ----------------------------------------------------------------------------------------------------
* Product Loop 1- This is a grid layout with no sidebar.
* @PACKAGE BY HAWKTHEME
* ----------------------------------------------------------------------------------------------------
*/

$product_page_id = theme_get_option('product','page_for_product');
$list_lightbox = theme_get_option('product','list_lightbox');
$enable_excerpt = theme_get_option('product','enable_excerpt');
$read_more = theme_get_option('product','read_more');
$currency = theme_get_option('product','currency');
$loop_count = 0;
?>

<?php
$menu_args = array(
	'taxonomy' => 'product-types',
	'orderby' => 'name',
	'show_count' => 0, // 1 for yes, 0 for no
	'hierarchical' => 1, // 1 for yes, 0 for no
	'hide_empty' => 0, // 1 for yes, 0 for no
	'title_li' => '',
	'depth' => 1
);
?>
<nav class="product-menu">
<ul class="clearfix">
<?php
	if(get_the_ID() == $product_page_id ) {
		$current_class = ' class="current-cat"';
	}else{
		$current_class = '';
	}

	if($product_page_id) {
		echo '<li'.$current_class.'><a href="'.get_page_link($product_page_id).'">';
		esc_html_e('All','HK');
		echo '</a></li>';
	}

	wp_list_categories( $menu_args ); 
?>
</ul>
</nav>

<ul class="product-grid clearfix">
<?php 
while (have_posts()) : the_post();

$loop_count++; 

if ( ($loop_count-1) % 2 == 0 ) {
	$post_class = 'class="post col-2-1 first"';
}elseif( $loop_count % 2 == 0 ) {
	$post_class = 'class="post col-2-1 last"';
}else{
	$post_class = 'class="post col-2-1"';
}

if($list_lightbox == true) 
{
	$link = theme_large_image_uri();
	$rel = 'data-id="fancybox"';
}else{
	$link = get_permalink();
	$rel = 'rel="bookmark"';
}

$original_price = get_meta_option('product_original_price');
$discount_price = get_meta_option('product_discount_price');
$external_link = get_meta_option('product_external_link');

?>
<!--Begin Item-->
<li <?php echo $post_class; ?>>
	<?php if ( has_post_thumbnail() ) : ?>
	<div class="post-thumb">
	<a href="<?php echo $link; ?>" title="<?php the_title_attribute(); ?>" class="image-link" <?php echo $rel; ?>>
	<?php the_post_thumbnail('205-140'); ?>
	</a>
	</div>
	<?php endif; ?>
	<div class="post-entry clearfix">
	<h2><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
	<p class="post-price">
	<?php if($original_price) : ?><s><?php echo $currency.$original_price; ?> .00</s><?php endif; ?>
	<?php if($discount_price) : ?><span><?php echo $currency.$discount_price; ?> .00</span><?php endif; ?>
	</p>
	<?php if($enable_excerpt == true) : ?><p class="post-excerpt"><?php theme_description(60); ?></p><?php endif; ?>
	<?php if($read_more) :?><p class="post-more"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php echo $read_more; ?></a></p><?php endif; ?>
	<?php if($external_link) :?><p class="post-more"><a href="<?php echo $external_link; ?>" title=""><?php esc_html_e('购买','HK'); ?></a></p><?php endif; ?>
	</div>
</li>
<!--End Item-->
<?php endwhile; ?>
</ul>