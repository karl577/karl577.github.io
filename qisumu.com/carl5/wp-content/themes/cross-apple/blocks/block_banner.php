<?php 
/*
* ----------------------------------------------------------------------------------------------------
* BANNER FUNCTIONS
* @PACKAGE BY HAWKTHEME
* ----------------------------------------------------------------------------------------------------
*/

function theme_page_banner() 
{

	$enable_banners = theme_get_option('general','enable_banners');

	if(! is_front_page() && $enable_banners == 'yes') {

	global $wp_query;
	//$home_page = get_page( $wp_query->get_queried_object_id() );
	$tax_portfolio_id = theme_get_option('portfolio','page_for_portfolio');
	$tax_product_id = theme_get_option('product','page_for_product');
	$tax_category_id = theme_get_option('blog','page_for_blog');

	$default_image = ASSETS_URI.'/images/banner.png';
	$banner_image = get_meta_option('banner_image');
	$banner_top = get_meta_option('banner_top');
	//$blog_banner_image = get_meta_option('banner_image',$home_page->ID);
	//$blog_banner_top = get_meta_option('banner_top',$home_page->ID);
	$portfolio_banner_image = get_meta_option('banner_image',$tax_portfolio_id);
	$portfolio_banner_top = get_meta_option('banner_top',$tax_portfolio_id);
	$product_banner_image = get_meta_option('banner_image',$tax_product_id);
	$product_banner_top = get_meta_option('banner_top',$tax_product_id);
	$category_banner_image = get_meta_option('banner_image',$tax_category_id);
	$category_banner_top = get_meta_option('banner_top',$tax_category_id);

	
	if(is_page()) {

		if($banner_image) { $image = $banner_image; } else { $image = $default_image; }
		if($banner_top) { $top = $banner_top; } else { $top = '50'; }
	
	}elseif(is_tax('portfolio-types') || is_singular('portfolio')) {
	
		if($portfolio_banner_image) { $image = $portfolio_banner_image; } else { $image = $default_image; }
		if($portfolio_banner_top) { $top = $portfolio_banner_top; } else { $top = '50'; }
	
	}elseif(is_tax('product-types') || is_singular('product')) {
	
		if($product_banner_image) { $image = $product_banner_image; } else { $image = $default_image; }
		if($product_banner_top) { $top = $product_banner_top; } else { $top = '50'; }
	
	}elseif(is_archive() || is_singular('post')) {
	
		if($category_banner_image) { $image = $category_banner_image; } else { $image = $default_image; }
		if($category_banner_top) { $top = $category_banner_top; } else { $top = '50'; }
	
	}elseif(is_search()) {
	
		 $image = ASSETS_URI.'/images/banner-search.png';
		 $top = '35';
	
	}

	echo '<div class="banner-section" style="padding-top: '.$top.'px;">';
	echo '<img src="'.$image.'" />';
	echo '</div>';

	}
}

?>