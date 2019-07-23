<?php 
/*
* ----------------------------------------------------------------------------------------------------
* Metaboxes for post
* @PACKAGE BY HAWKTHEME
* ----------------------------------------------------------------------------------------------------
*/
$config = array(
	'title' => esc_html__('页面设置','HK'),
	'id' => 'page_meta_boxes',
	'pages' => array('page'),
	'callback' => '',
	'context' => 'normal',
	'priority' => 'high',
);


$options = array(

	array(
			'name' => esc_html__('自定义顶部的横幅', 'HK'),
			'type' => 'title',
			'desc' => esc_html__('如果你想在页面的顶部显示自定义图像，在这里可以上传图片','HK'),
	),

	array(
			'name' => esc_html__('横幅图片','HK'),
			'desc' => __('点击“上传图片”按钮上传图片。或者，您可以输入图片的网址。','HK'),
			'id' => 'banner_image',
			'std' => '',
			'size' => '100',
			'type' => 'upload',
	),

	array(
			'name' => esc_html__('横幅距离顶部','HK'),
			'desc' => esc_html__('S设置横幅到顶部的距离','HK'),
			'id' => 'banner_top',
			'std' => '50',
			'size' => '5',
			'unit' => 'px',
			'type' => 'text',
	),

	array(
			'name' => esc_html__('SEO设置', 'HK'),
			'type' => 'title',
			'desc' => esc_html__('您可以从这篇文章/页从动的搜索引擎，自定义标题，meta关键字和meta描述。','HK'),
	),

	array(
			'name' => esc_html__('SEO - 设置','HK'),
			'desc' => esc_html__('让搜索引擎链接这篇文章/页。','HK'),
			'id' => 'seo_follow',
			'std' => 0,
			'type' => 'checkbox',
	),

	array(
			'name' => esc_html__('SEO - 蜘蛛','HK'),
			'desc' => esc_html__('让搜索引擎蜘蛛检索这篇文章/页。','HK'),
			'id' => 'seo_noindex',
			'std' => 0,
			'type' => 'checkbox',
	),

	array(
			'name' => esc_html__('SEO - 标题标签','HK'),
			'desc' => esc_html__('在标题中输入你想被显示的内容。例如：<Title>在这里的标题</Title>','HK'),
			'id' => 'seo_title_tags',
			'std' => '',
			'size' => '100',
			'type' => 'text',
	),

	array(
			'name' => esc_html__('SEO - 关键字','HK'),
			'desc' => esc_html__('输入你想与此页以英文逗号分隔的关键字列表。例如：<meta name="keywords" content="keyword1, keyword2, keyword3" />','HK'),
			'id' => 'seo_keywords',
			'std' => '',
			'rows' => '2',
			'type' => 'textarea',
	),

	array(
			'name' => esc_html__('SEO - 描述','HK'),
			'desc' => esc_html__('输入你对产品的描述，用英文逗号分开， 例如:<meta name="description" content="这儿是你的描述" />','HK'),
			'id' => 'seo_description',
			'std' => '',
			'rows' => '2',
			'class' => 'noborder',
			'type' => 'textarea',
	),

);

new meta_boxes_generator($config,$options);

?>