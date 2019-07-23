<?php 
/*
* ----------------------------------------------------------------------------------------------------
* Header Page
* @PACKAGE BY HAWKTHEME
* ----------------------------------------------------------------------------------------------------
*/
$options = array(

	array(
			'name' => esc_html__('头部设置', 'HK'),
			'type' => 'title',
	),

	array('type' => 'head'),

	array(
			'name' => esc_html__('头部高度','HK'),
			'desc' => esc_html__('在这里输入数值可以设置标题的高度','HK'),
			'id' => 'header_height',
			'std' => '100',
			'size' => '5',
			'unit' => 'px',
			'type' => 'text',
	),

	array(
			'name' => esc_html__('头部固定','HK'),
			'desc' => esc_html__('设置头部固定?','HK'),
			'id' => 'header_position',
			'std' => 0,
			'type' => 'checkbox',
	),

	array('type' => 'foot'),

	array(
			'name' => esc_html__('标志', 'HK'),
			'type' => 'sub_title',
	),

	array('type' => 'head'),

	array(
			'name' => esc_html__('图像','HK'),
			'desc' => esc_html__('上传一个图片，点击“上传图片”按钮。一旦图像上传，它会给你不同的选项。','HK'),
			'id' => 'logo',
			'std' => ASSETS_URI.'/images/logo.png',
			'title' => '输入一个URL或图像上传您的标志：',
			'size' => '100',
			'button' => esc_html__('上传标志','HK'),
			'type' => 'upload',
	),

	array(
			'name' => esc_html__('从顶部的位置','HK'),
			'id' => 'logo_top',
			'std' => '20',
			'size' => '5',
			'unit' => 'px',
			'type' => 'text',
	),

	array(
			'name' => esc_html__('从左侧的位置','HK'),
			'id' => 'logo_left',
			'std' => '0',
			'size' => '5',
			'unit' => 'px',
			'type' => 'text',
	),

	array('type' => 'foot'),

	array(
			'name' => esc_html__('菜单', 'HK'),
			'type' => 'sub_title',
	),

	array('type' => 'head'),

	array(
			'name' => esc_html__('从顶部的位置','HK'),
			'id' => 'menu_top',
			'std' => '35',
			'size' => '5',
			'unit' => 'px',
			'type' => 'text',
	),

	array(
			'name' => esc_html__('深度','HK'),
			'desc' => esc_html__('将其设置为“0”，在菜单级别将是无限的。','HK'),
			'id' => 'menu_depth',
			'std' => '3',
			'size' => '5',
			'unit' => 'level',
			'type' => 'text',
	),

	array('type' => 'foot'),

);

return array('auto' => true, 'name' => 'header', 'options' => $options );

?>