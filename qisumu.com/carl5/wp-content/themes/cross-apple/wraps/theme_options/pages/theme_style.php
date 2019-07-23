<?php 
/*
* ----------------------------------------------------------------------------------------------------
* Style Page
* @PACKAGE BY HAWKTHEME
* ----------------------------------------------------------------------------------------------------
*/
$styles = array(
		'blue' => esc_html__('蓝色','HK'),
		'coffee' => esc_html__('咖啡色','HK'),
		'grey' => esc_html__('灰色','HK'),
		'green' => esc_html__('绿色','HK'),
		'red' => esc_html__('红色','HK')
);


$repeat_options = array(
		'no-repeat' => esc_html__('不重复','HK'),
		'repeat-x' => esc_html__('水平方向重复','HK'),
		'repeat-y' => esc_html__('垂直方向重复','HK'),
		'repeat' => esc_html__('水平垂直方向都重复','HK')
);

$horizontal_options = array(
		'left' => esc_html__('左','HK'),
		'right' => esc_html__('右','HK'),
		'center' => esc_html__('中','HK')
);

$vertical_options = array(
		'top' => esc_html__('顶','HK'),
		'bottom' => esc_html__('底','HK'),
		'center' => esc_html__('中','HK')
);

$attachment_options = array(
		'fixed' => esc_html__('固定','HK'),
		'scroll' => esc_html__('滚动','HK'),
);

$options = array(

	array(
			'name' => esc_html__('样式设置', 'HK'),
			'type' => 'title'
	),

	array('type' => 'head'),

	array(
			'name' => esc_html__('样式','HK'),
			'desc' => esc_html__('选择一种默认样式','HK'),
			'id' => 'current_style',
			'std' => 'grey',
			'options' => $styles,
			'type' => 'radio',
	),

	array(
			'name' => esc_html__('字体颜色','HK'),
			'desc' => esc_html__('如果你想自定义的颜色，你可以选择颜色拾色器。如果没有，你可以让它空白','HK'),
			'id' => 'text_color',
			'std' => '',
			'size' => '10',
			'type' => 'color',
	),

	array(
			'name' => esc_html__('连接颜色','HK'),
			'desc' => esc_html__('如果你想自定义的颜色，你可以选择颜色拾色器。如果没有，你可以让它空白','HK'),
			'id' => 'link_color',
			'std' => '',
			'size' => '10',
			'type' => 'color',
	),

	array(
			'name' => esc_html__('鼠标悬停颜色','HK'),
			'desc' => esc_html__('如果你想自定义的颜色，你可以选择颜色拾色器。如果没有，你可以让它空白','HK'),
			'id' => 'hover_color',
			'std' => '',
			'size' => '10',
			'type' => 'color',
	),

	array(
			'name' => esc_html__('背景','HK'),
			'desc' => esc_html__('选择一个图案背景','HK'),
			'id' => 'body_pattern',
			'std' => '10',
			'options' => array(
				'0' => esc_html__('禁用背景','HK'),
				'1' => esc_html__('背景 1','HK'),
				'2' => esc_html__('背景 2','HK'),
				'3' => esc_html__('背景 3','HK'),
				'4' => esc_html__('背景 4','HK'),
				'5' => esc_html__('背景 5','HK'),
				'6' => esc_html__('背景 6','HK'),
				'7' => esc_html__('背景 7','HK'),
				'8' => esc_html__('背景 8','HK'),
				'9' => esc_html__('背景 9','HK'),
				'10' => esc_html__('背景 10','HK'),
			),
			'type' => 'select',
	),
	
	array('type' => 'foot'),

	array(
			'name' => esc_html__('自定义背景', 'HK'),
			'type' => 'sub_title',
	),

	array('type' => 'head'),

	array(
			'name' => esc_html__('图像','HK'),
			'desc' => '上传的图像作为背景。 ',
			'id' => 'body_bg_image',
			'std' => '',
			'title' => '输入一个URL或上传图片：',
			'size' => '70',
			'button' => esc_html__('上传图像','HK'),
			'type' => 'upload',
	),

	array(
			'name' => esc_html__('属性','HK'),
			'desc' => '',
			'id' => 'body_bg_properties',
			'std' => 'no-repeat',
			'options' => $repeat_options,
			'type' => 'select',
	),

	array(
			'name' => esc_html__('水平','HK'),
			'desc' => '',
			'id' => 'body_bg_horizontal',
			'std' => 'left',
			'options' => $horizontal_options,
			'type' => 'select',
	),

	array(
			'name' => esc_html__('垂直','HK'),
			'desc' => '',
			'id' => 'body_bg_vertical',
			'std' => 'top',
			'options' => $vertical_options,
			'type' => 'select',
	),

	array(
			'name' => esc_html__('附件','HK'),
			'desc' => '',
			'id' => 'body_bg_attachment',
			'std' => 'scroll',
			'options' => $attachment_options,
			'type' => 'select',
	),

	array('type' => 'foot'),

);

return array('auto' => true, 'name' => 'style', 'options' => $options );

?>