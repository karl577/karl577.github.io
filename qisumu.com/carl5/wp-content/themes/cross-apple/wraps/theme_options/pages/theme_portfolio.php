<?php 
/*
* ----------------------------------------------------------------------------------------------------
* Portfolio Page
* @PACKAGE BY HAWKTHEME
* ----------------------------------------------------------------------------------------------------
*/
$options = array(

	array(
			'name' => esc_html__('投资组合', 'HK'),
			'type' => 'title'
	),

	array('type' => 'head'),

	array(
			'name' => esc_html__('列表样式','HK'),
			'desc' => esc_html__('为您的文章选择一个列表样式，它会改变显示的样式','HK'),
			'id' => 'list_style',
			'std' => '4',
			'options' => array(
				'1' => esc_html__('1 列与分页','HK'),
				'2' => esc_html__('2 列与分页','HK'),
				'3' => esc_html__('3 列与分页','HK'),
				'4' => esc_html__('4 列与分页','HK'),
				'5' => esc_html__('2 列与浮动','HK'),
				'6' => esc_html__('3 列与浮动','HK'),
				'7' => esc_html__('4 列与浮动','HK'),
			),
			'type' => 'select',
	),

	array(
			'name' => esc_html__('显示项目','HK'),
			'desc' => esc_html__('设置每页显示的项目','HK'),
			'id' => 'list_showposts',
			'std' => '12',
			'size' => '5',
			'unit' => '每页的项目',
			'type' => 'text',
	),

	array(
			'name' => esc_html__('单品组合','HK'),
			'desc' => __('输入页面的访客可以使用的你的产品组合<br /> 例如，如果你输入 <span>"portfolio-item"</span>链接到该项目将是 <span>http://yourweb.com/portfolio-item/post-name</span>. <br />不要使用不允许在URL中的字符，确保不使用这种单品在您的其他页面上<span>(例如作为一个类别或页面)</span>.','HK'),
			'id' => 'single_item_slug',
			'std' => 'portfolio-item',
			'size' => '30',
			'type' => 'text',
	),

	array(
			'name' => esc_html__('指定投资组合的页面','HK'),
			'desc' => esc_html__('这将应用于所有的投资组合URL和横幅URL','HK'),
			'id' => 'page_for_portfolio',
			'std' => '',
			'prompt' => esc_html__('选择一页..','HK'),
			'target' => 'page',
			'type' => 'select',
	),

	array(
			'name' => esc_html__('灯箱效果','HK'),
			'desc' => esc_html__('列表中的图像显示灯箱效果?','HK'),
			'id' => 'list_lightbox',
			'std' => 1,
			'type' => 'checkbox',
	),

	array(
			'name' => esc_html__('启用摘要','HK'),
			'desc' => esc_html__('启用列表摘要？','HK'),
			'id' => 'enable_excerpt',
			'std' => 1,
			'type' => 'checkbox',
	),

	array(
			'name' => esc_html__('“阅读更多" 链接','HK'),
			'desc' => esc_html__("输入文章的“阅读更多”链接的文字，如果你不想显示，留下空白",'HK'),
			'id' => 'read_more',
			'std' => '更多',
			'size' => '30',
			'type' => 'text',
	),

	array('type' => 'foot'),

);

return array('auto' => true, 'name' => 'portfolio', 'options' => $options );

?>