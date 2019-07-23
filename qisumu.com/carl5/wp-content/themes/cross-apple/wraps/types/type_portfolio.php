<?php 
/*
* ----------------------------------------------------------------------------------------------------
* Create Post Type For Portfolio
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

add_action('init', 'theme_create_post_type_portfolio');
add_filter("manage_edit-portfolio_columns", "prod_edit_columns_portfolio");
add_action("manage_posts_custom_column",  "prod_custom_columns_portfolio");


/*Create post type for portfolio*/
function theme_create_post_type_portfolio() 
{

	$item_slug = theme_get_option('portfolio','single_item_slug');

	$labels = array(
		'name' => esc_html__( '投资组合','HK'),
		'singular_name' => esc_html__( 'Portfolio','HK' ),
		'add_new' => esc_html__('添加','HK'),
		'add_new_item' => esc_html__('添加新的投资组合','HK'),
		'edit_item' => esc_html__('编辑投资组合','HK'),
		'new_item' => esc_html__('新投资组合','HK'),
		'view_item' => esc_html__('预览投资组合','HK'),
		'search_items' => esc_html__('搜索投资组合','HK'),
		'not_found' => esc_html__('没有发现','HK'),
		'not_found_in_trash' => esc_html__('没有在回收站中找到投资组合','HK'), 
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
		'menu_icon' => WRAPS_URI . '/assets/images/icon-portfolio.png',
		'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'comments')
	); 

	register_post_type( 'portfolio' , $args );
	
	register_taxonomy('portfolio-types','portfolio',array(
		'hierarchical' => true, 
		'label' => '投资组合分类', 
		'singular_label' => 'Portfolio Types', 
		'rewrite' => true,
		'query_var' => true
	));

}


/*Prod edit columns*/
function prod_edit_columns_portfolio($columns)
{
	$newcolumns = array(
		"cb" => "<input type=\"checkbox\" />",
		"portfolio_thumbnail" => esc_html__('缩略图', 'HK'),
		"title" => "Title",
		"portfolio_types" => esc_html__('分类', 'HK')
	);
	
	$columns= array_merge($newcolumns, $columns);
	
	return $columns;
}


/*Prod custom columns*/
function prod_custom_columns_portfolio($column)
{
	global $post;
	switch ($column)
	{
		case "portfolio_types":
		echo get_the_term_list($post->ID, 'portfolio-types', '', ', ','');
		break;

		case "portfolio_thumbnail":
		 if ( has_post_thumbnail() ) { the_post_thumbnail('50-50'); }
		break;	
	}
}

?>