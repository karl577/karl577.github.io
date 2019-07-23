<?php 
/*
* ----------------------------------------------------------------------------------------------------
* Slider Page
* @PACKAGE BY HAWKTHEME
* ----------------------------------------------------------------------------------------------------
*/

$options = array(

	array(
			'name' => esc_html__('滑块设置', 'HK'),
			'type' => 'title'
	),

	array('type' => 'head'),

	array(
			'name' => esc_html__('使用滑块','HK'),
			'desc' => esc_html__("如果选择是，你会在所有页面支持滑块。",'HK'),
			'id' => 'enable_slider',
			'std' => 'yes',
			'options' => array(
				'yes' => esc_html__('是','HK'),
				'no' => esc_html__('否','HK'),
			),
			'type' => 'radio',
	),

	array(
			'name' => esc_html__('显示方式','HK'),
			'desc' => __('复制下面的一个的滑块简码，它会显示滑块的效果<br /><span>[slider_accordion autoplay="true" speed="800" delay="4000"]</span><br /><span>[slider_cycle effect="turnDown" height="350" speed="800" delay="4000" "easing"="easeOutBounce"]</span><br /><span> [slider_nivo effect="fade" height="400" speed="800" delay="3000"]</span><br /><span>[slider_slides_js effect="fade" height="350" speed="800" delay="4000"]</span>','HK'),
			'id' => 'shortcode',
			'std' => '[slider_nivo effect="fade" speed="800" delay="4000"]',
			'rows' => '3',
			'type' => 'textarea',
	),
	
	array('type' => 'foot'),

);

return array('auto' => true, 'name' => 'slider', 'options' => $options );

?>