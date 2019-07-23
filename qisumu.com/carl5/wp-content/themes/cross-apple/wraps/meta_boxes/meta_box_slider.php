<?php 
/*
* ----------------------------------------------------------------------------------------------------
* Metaboxes for slidershow
* @PACKAGE BY HAWKTHEME
* ----------------------------------------------------------------------------------------------------
*/
$config = array(
	'title' => esc_html__('滑块设置','HK'),
	'id' => 'slidershow_meta_boxes',
	'pages' => array('slidershow'),
	'callback' => '',
	'context' => 'normal',
	'priority' => 'high',
);


$options = array(

	array(
			'name' => esc_html__('启用标题','HK'),
			'desc' => esc_html__('在滑块中启用标题','HK'),
			'id' => 'enable_slidershow_title',
			'std' => 0,
			'type' => 'checkbox',
	),

	array(
			'name' => esc_html__('启用描述','HK'),
			'desc' => esc_html__('在滑块中启用描述','HK'),
			'id' => 'enable_slidershow_desc',
			'std' => 0,
			'type' => 'checkbox',
	),

	array(
			'name' => esc_html__('描述','HK'),
			'desc' => esc_html__('在这儿输入滑块的描述内容','HK'),
			'id' => 'slidershow_desc',
			'std' => '',
			'rows' => '5',
			'type' => 'textarea',
	),

	array(
			'name' => esc_html__('启用链接','HK'),
			'desc' => esc_html__('为您的自定义链接输入一个地址：例如: http://www.idage.net. 如果你不想使用就留空','HK'),
			'id' => 'slidershow_external_link',
			'std' => 'http://www.idage.net',
			'size' => '80',
			'type' => 'text',
	),

	array(
			'name' => esc_html__('功能图像','HK'),
			'desc' => __('点击“上传图片”按钮上传图片。或者，您可以输入图片的网址。','HK'),
			'id' => 'slidershow_image',
			'std' => '',
			'size' => '80',
			'type' => 'upload',
	),

	array(
			'name' => esc_html__('缩略图','HK'),
			'desc' => __('当你使用NIVO滑块，你需要上传的大小是54px * 40px的缩略图。','HK'),
			'id' => 'slidershow_thumbnail',
			'std' => '',
			'size' => '80',
			'class' => 'noborder',
			'type' => 'upload',
	),
);

new meta_boxes_generator($config,$options);

?>