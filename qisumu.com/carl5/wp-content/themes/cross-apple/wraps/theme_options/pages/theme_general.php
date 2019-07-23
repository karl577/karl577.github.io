<?php 
/*
* ----------------------------------------------------------------------------------------------------
* General Page
* @PACKAGE BY HAWKTHEME
* ----------------------------------------------------------------------------------------------------
*/
$options = array(

	array(
			'name' => esc_html__('一般选项', 'HK'),
			'type' => 'title',
			'desc' => theme_check_message(),
	),

	array('type' => 'head'),

	array(
			'name' => esc_html__('Feedburner的链接','HK'),
			'desc' => esc_html__('请输入您的Feedburner的链接，如果你不想显示这个，就把它空着','HK'),
			'id' => 'feed',
			'std' => get_bloginfo('rss2_url'),
			'size' => '100',
			'type' => 'text',
	),

	array(
			'name' => esc_html__('联系Email','HK'),
			'desc' => esc_html__('输入您的电子邮件联系方式','HK'),
			'id' => 'email',
			'std' => get_option('admin_email'),
			'size' => '100',
			'type' => 'text',
	),

	array(
			'name' => esc_html__('自定义Favicon图标','HK'),
			'desc' => esc_html__('输入一个URL或上传你的Favicon图标','HK'),
			'id' => 'favicon',
			'std' => '',
			'title' => '输入一个URL或上传你的Favicon图标',
			'size' => '100',
			'button' => esc_html__('上传图标','HK'),
			'type' => 'upload',
	),

	array(
			'name' => esc_html__('分页','HK'),
			'desc' => esc_html__('如果你想使用WP-pagenavi插件，你应该安装它','HK'),
			'id' => 'pagination',
			'std' => '1',
			'options' => array(
				'1' => esc_html__('页面导航','HK'),
				'2' => esc_html__('上一页,下一页','HK'),
				'3' => esc_html__('WP-Pagenavi','HK'),
			),
			'type' => 'radio',
	),

	array(
			'name' => esc_html__('启用顶部横幅','HK'),
			'desc' => esc_html__("如果选择这个选项,你就会在所有页面启用横幅",'HK'),
			'id' => 'enable_banners',
			'std' => 'yes',
			'options' => array(
				'yes' => esc_html__('是','HK'),
				'no' => esc_html__('否','HK'),
			),
			'type' => 'radio',
	),

	array(
			'name' => esc_html__('启用主题面板','HK'),
			'desc' => esc_html__("如果这个选项是肯定的，你会在管理栏全局启用主题面板",'HK'),
			'id' => 'enable_theme_panel',
			'std' => 'yes',
			'options' => array(
				'yes' => esc_html__('是','HK'),
				'no' => esc_html__('否','HK'),
			),
			'type' => 'radio',
	),

	array(
			'name' => esc_html__('谷歌统计代码','HK'),
			'desc' => __('将您的谷歌统计代码粘贴在这里，它会被应用到每一页。','HK'),
			'id' => 'analytics',
			'rows' => '6',
			'std' => '',
			'type' => 'textarea',
	),

	array('type' => 'foot'),

);

return array('auto' => true, 'name' => 'general', 'options' => $options );

?>