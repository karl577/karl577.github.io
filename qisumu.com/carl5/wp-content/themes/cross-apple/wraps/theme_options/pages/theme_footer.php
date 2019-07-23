<?php 
/*
* ----------------------------------------------------------------------------------------------------
* Footer Page
* @PACKAGE BY HAWKTHEME
* ----------------------------------------------------------------------------------------------------
*/
$options = array(

	array(
			'name' => esc_html__('页脚设置', 'HK'),
			'type' => 'title'
	),

	array('type' => 'head'),

	array(
			'name' => esc_html__('启用足部窗口小部件','HK'),
			'desc' => esc_html__("如果选择是，你将在所有页面启用页脚窗口小部件",'HK'),
			'id' => 'enable_footer_widgets',
			'std' => 'yes',
			'options' => array(
				'yes' => esc_html__('是','HK'),
				'no' => esc_html__('否','HK'),
			),
			'type' => 'radio',
	),

	array(
			'name' => esc_html__('页脚小工具栏','HK'),
			'desc' => esc_html__('您的页脚部件区域中选择一列','HK'),
			'id' => 'widget_columns',
			'std' => '3',
			'options' => array(
				'1' => esc_html__('1 Column','HK'),
				'2' => esc_html__('2 Column','HK'),
				'3' => esc_html__('3 Column','HK'),
				'4' => esc_html__('4 Column','HK'),
			),
			'type' => 'select',
	),

	array(
			'name' => esc_html__('版权信息','HK'),
			'desc' => __('在页脚中显示的版权信息','HK'),
			'id' => 'copyright',
			'std' => 'Copyright &copy; <a href="'. home_url( '/' ) . '">' .esc_attr( get_bloginfo('name') ).'</a>, Privacy Statement Terms and Conditions.',
			'rows' => '3',
			'type' => 'textarea',
	),

	array(
			'name' => esc_html__('WordPress的链接','HK'),
			'desc' => esc_html__('显示“本站由WordPress的”页脚? ','HK'),
			'id' => 'wordpress_link',
			'std' => 1,
			'type' => 'checkbox',
	),

	array(
			'name' => esc_html__('返回顶部','HK'),
			'desc' => esc_html__('显示页脚中去顶部的按钮？','HK'),
			'id' => 'go_top',
			'std' => 1,
			'type' => 'checkbox',
	),

	array('type' => 'foot'),

	array(
			'name' => esc_html__('页脚标志', 'HK'),
			'type' => 'sub_title',
	),

	array('type' => 'head'),

	array(
			'name' => esc_html__('图像','HK'),
			'desc' => esc_html__('上传一个图片，点击“上传图片”按钮。一旦图像上传，它会给你不同的选项','HK'),
			'id' => 'logo',
			'std' => ASSETS_URI.'/images/logo-small.png',
			'title' => '输入一个URL或图像上传您的标志:',
			'size' => '100',
			'button' => esc_html__('Upload Logo','HK'),
			'type' => 'upload',
	),

	array(
			'name' => esc_html__('从顶部的位置','HK'),
			'id' => 'logo_top',
			'std' => '10',
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

	array(
			'name' => esc_html__('从右侧的位置','HK'),
			'id' => 'logo_right',
			'std' => '30',
			'size' => '5',
			'unit' => 'px',
			'type' => 'text',
	),

	array('type' => 'foot'),

);

return array('auto' => true, 'name' => 'footer', 'options' => $options );

?>