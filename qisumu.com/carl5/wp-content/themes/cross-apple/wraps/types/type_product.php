<?php 
/*
* ----------------------------------------------------------------------------------------------------
* Create Post Type For Product
* @PACKAGE BY HAWKTHEME
*
* menu_position
* 5 - below Posts 
*10 - below Media 
*15 - below Links 
*20 - below Pages 
*25 - below comments 
*60 - below first separator 
*65 - below Plugins 
*70 - below Users 
*75 - below Tools 
*80 - below Settings 
*100 - below second separator 
*
* ----------------------------------------------------------------------------------------------------
*/

add_action('init', 'theme_create_post_type_product');
add_filter("manage_edit-product_columns", "prod_edit_columns_product");
add_action("manage_posts_custom_column",  "prod_custom_columns_product");


/*Create post type for product*/
function theme_create_post_type_product() 
{

	$item_slug = theme_get_option('product','single_item_slug');

	$labels = array(
		'name' => esc_html__( '产品','HK'),
		'singular_name' => esc_html__( '产品','HK' ),
		'add_new' => esc_html__('添加','HK'),
		'add_new_item' => esc_html__('添加新产品','HK'),
		'edit_item' => esc_html__('编辑','HK'),
		'new_item' => esc_html__('新产品','HK'),
		'view_item' => esc_html__('预览产品','HK'),
		'search_items' => esc_html__('搜索产品','HK'),
		'not_found' => esc_html__('没有找到相应产品','HK'),
		'not_found_in_trash' => esc_html__('在回收站中没有找到产品','HK'), 
		'parent_item_colon' => ''
	);

	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true, 
		'query_var' => true,
		'can_export' => true,
		'rewrite' => array('slug'=>$item_slug,'with_front'=>true),
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => 25,
		//'menu_icon' => WRAPS_URI . '/assets/images/icon-product.png',
		'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'comments')
	); 

	register_post_type( 'product' , $args );
	
	register_taxonomy('product-types','product',array(
		'hierarchical' => true, 
		'label' => '产品分类', 
		'singular_label' => 'Product Types', 
		'rewrite' => true,
		'query_var' => true
	));

}


/*Prod edit columns*/
function prod_edit_columns_product($columns)
{
	$newcolumns = array(
		"cb" => "<input type=\"checkbox\" />",
		"product_thumbnail" => esc_html__('缩略图', 'HK'),
		"title" => "Title",
		"product_types" => esc_html__('分类', 'HK')
	);
	
	$columns= array_merge($newcolumns, $columns);
	
	return $columns;
}


/*Prod custom columns*/
function prod_custom_columns_product($column)
{
	global $post;
	switch ($column)
	{
		case "product_types":
		echo get_the_term_list($post->ID, 'product-types', '', ', ','');
		break;

		case "product_thumbnail":
		 if ( has_post_thumbnail() ) { the_post_thumbnail('50-50'); }
		break;	
	}
}

?>