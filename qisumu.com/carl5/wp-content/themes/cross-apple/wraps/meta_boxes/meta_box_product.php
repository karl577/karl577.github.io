<?php 
/*
* ----------------------------------------------------------------------------------------------------
* Metaboxes for product
* @PACKAGE BY HAWKTHEME
* ----------------------------------------------------------------------------------------------------
*/
$config = array(
	'title' => esc_html__('产品设置','HK'),
	'id' => 'product_meta_boxes',
	'pages' => array('product'),
	'callback' => '',
	'context' => 'normal',
	'priority' => 'high',
);


$options = array(

	array(
			'name' => esc_html__('产品细节', 'HK'),
			'type' => 'title',
			'desc' => esc_html__('在这里设置产品的详细信息，您可以设定的价格和外部链接的网址','HK'),
	),

	array(
			'name' => esc_html__('原价','HK'),
			'desc' => esc_html__('如果你不想显示这个，就把它空着','HK'),
			'id' => 'product_original_price',
			'std' => '50',
			'size' => '20',
			'type' => 'text',
	),

	array(
			'name' => esc_html__('折扣价','HK'),
			'id' => 'product_discount_price',
			'std' => '39',
			'size' => '20',
			'type' => 'text',
	),

	array(
			'name' => esc_html__('外部链接','HK'),
			'desc' => esc_html__('输入一个网址，为您的产品自定义链接，例如：http://jinui.com。如果你不想用这个，就把它空着。','HK'),
			'id' => 'product_external_link',
			'std' => '#',
			'size' => '100',
			'type' => 'text',
	),

	array(
			'name' => esc_html__('自定义功能图片', 'HK'),
			'type' => 'title',
			'desc' => esc_html__('如果你想在列表中显示自定义图像，在这里你可以上传图片。你需要设置特征图像，它会显示在其他地方。','HK'),
	),

	array(
			'name' => esc_html__('功能图片','HK'),
			'desc' => __('点击“上传图片”按钮上传图片。或者，您可以输入图片的网址。','HK'),
			'id' => 'feature_image',
			'std' => '',
			'size' => '100',
			'type' => 'upload',
	),

	array(
			'name' => esc_html__('SEO设置', 'HK'),
			'type' => 'title',
			'desc' => esc_html__('您可以对这篇文章/页自定义标题，meta关键字和meta描述，来让搜索引擎找到。','HK'),
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