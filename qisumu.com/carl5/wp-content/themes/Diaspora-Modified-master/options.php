<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 */
function optionsframework_option_name() {
	// This gets the theme name from the stylesheet
	$themename = wp_get_theme();
	$themename = preg_replace("/\W/", "_", strtolower($themename) );
	$optionsframework_settings = get_option('optionsframework' );
	$optionsframework_settings['id'] = $themename;
	update_option('optionsframework', $optionsframework_settings );
}
/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 * If you are making your theme translatable, you should replace 'options_framework_theme'
 * with the actual text domain for your theme.  Read more:
 * http://codex.wordpress.org/Function_Reference/load_theme_textdomain
 */
function optionsframework_options() {
// 将所有页面（pages）加入数组
	$options_pages = array();
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = '选择页面：';
	foreach ($options_pages_obj as $page) {
		$options_pages[$page->ID] = $page->post_title;
	}
	// Pull all the categories into an array
	$options_categories = array();
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
		$options_categories[$category->cat_ID] = $category->cat_name;
	}
	
	$options = array();
	$options[] = array(
		'name' => __('基本设置'),
		'type' => 'heading');
	$options[] = array(
		'name' => __('网站作者'),
		'desc' => __('显示于全站 Meta 标签'),
		'id' => 'author',
		'type' => 'text');
	$options[] = array(
		'name' => __('网站描述'),
		'desc' => __('SEO 设置，输入您的网站描述，一般不超过 200 字符'),
		'id' => 'desc',
		'type' => 'text');
	$options[] = array(
		'name' => __('网站关键词'),
		'desc' => __('SEO 设置，输入您的网站关键词，以英文逗号 (,) 隔开。'),
		'id' => 'keywords',
		'type' => 'textarea');
	$options[] = array(
		'name' => __('网站 Favicon 地址'),
		'id' => 'favicon',
		'type' => 'text');
	$options[] = array(
		'name' => __('默认图像'),
		'desc' => __('当文章内不存在图像时将自动显示此默认图像'),
		'id' => 'post_default_image',
		'type' => 'upload');
	$options[] = array(
		'name' => __('顶部Logo-浅色'),
		'desc' => __('请上传一个尺寸为 20*20 的 Logo 文件或是输入文件 URL'),
		'id' => 'uploadlogo-index',
		'type' => 'upload');
	$options[] = array(
		'name' => __('顶部Logo-深色'),
		'desc' => __('请上传一个尺寸为 20*20 的 Logo 文件或是输入文件 URL'),
		'id' => 'uploadlogo',
		'type' => 'upload');

	return $options;
}