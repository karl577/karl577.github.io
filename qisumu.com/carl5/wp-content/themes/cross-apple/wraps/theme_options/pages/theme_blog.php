<?php 
/*
* ----------------------------------------------------------------------------------------------------
* Blog Page
* @PACKAGE BY HAWKTHEME
* ----------------------------------------------------------------------------------------------------
*/
$options = array(

	array(
			'name' => esc_html__('博客设置', 'HK'),
			'type' => 'title'
	),

	array('type' => 'head'),

	array(
			'name' => esc_html__('指定博客页面','HK'),
			'desc' => esc_html__('这将应用于所有的博客地址和横幅URL','HK'),
			'id' => 'page_for_blog',
			'std' => '',
			'prompt' => esc_html__('选择页面..','HK'),
			'target' => 'page',
			'type' => 'select',
	),

	array(
			'name' => esc_html__('列表样式','HK'),
			'desc' => esc_html__('为您的文章选择一个列表样式','HK'),
			'id' => 'list_style',
			'std' => '1',
			'options' => array(
				'1' => esc_html__('列表样式一','HK'),
				'2' => esc_html__('列表样式二','HK'),
			),
			'type' => 'select',
	),

	array(
			'name' => esc_html__('显示项目','HK'),
			'desc' => esc_html__('设置每页显示的项目。','HK'),
			'id' => 'list_showposts',
			'std' => '10',
			'size' => '5',
			'unit' => '每页的项目',
			'type' => 'text',
	),

	array(
			'name' => esc_html__('灯箱效果','HK'),
			'desc' => esc_html__('用灯箱效果展示显示列表的图片','HK'),
			'id' => 'list_lightbox',
			'std' => 1,
			'type' => 'checkbox',
	),

	array(
			'name' => esc_html__('启用时间','HK'),
			'desc' => esc_html__('随着时间更新显示列表?','HK'),
			'id' => 'enable_time',
			'std' => 1,
			'type' => 'checkbox',
	),

	array(
			'name' => esc_html__('启用评论','HK'),
			'desc' => esc_html__('显示评论列表？','HK'),
			'id' => 'enable_comment',
			'std' => 1,
			'type' => 'checkbox',
	),

	array(
			'name' => esc_html__('启用作者','HK'),
			'desc' => esc_html__('显示列表的作者?','HK'),
			'id' => 'enable_author',
			'std' => 1,
			'type' => 'checkbox',
	),

	array(
			'name' => esc_html__('启用类别','HK'),
			'desc' => esc_html__('显示列表的类别吗？','HK'),
			'id' => 'enable_category',
			'std' => 1,
			'type' => 'checkbox',
	),

	array(
			'name' => esc_html__('文摘长度','HK'),
			'desc' => esc_html__('文章内容在列表中显示摘要的长度','HK'),
			'id' => 'excerpt_length',
			'std' => '320',
			'size' => '5',
			'unit' => '字符',
			'type' => 'text',
	),

	array(
			'name' => esc_html__('"阅读更多" 链接','HK'),
			'desc' => esc_html__("输入文章的“阅读更多”链接的文字，如果你不想显示，留下空白",'HK'),
			'id' => 'read_more',
			'std' => '更多',
			'size' => '30',
			'type' => 'text',
	),

	array(
			'name' => esc_html__('启用作者信息','HK'),
			'desc' => esc_html__('显示作者信息单页？','HK'),
			'id' => 'enable_author_info',
			'std' => 1,
			'type' => 'checkbox',
	),

	array('type' => 'foot'),

);

return array('auto' => true, 'name' => 'blog', 'options' => $options );

?>