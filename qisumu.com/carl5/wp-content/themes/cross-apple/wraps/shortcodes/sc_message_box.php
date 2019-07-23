<?php 
/*
* ----------------------------------------------------------------------------------------------------
* SHORTCODE FOR MESSAGE BOX
* @PACKAGE BY HAWKTHEME
* ----------------------------------------------------------------------------------------------------
*/

add_shortcode('message_box', 'theme_sc_message_box');

function theme_sc_message_box($atts, $content = null)
{

	extract(shortcode_atts(
        array(
			'style' => '',
     		'icon' => '',
			'hide' => '',
			'width' => ''
    ), $atts));

	 //ICON
	if($icon == 'yes') {
	
		$icon_class = ' icon';
	
	}else{
	
		$icon_class = ' no-icon';

	}

	//PADDING
	if($hide =='yes') {

		$hide_class = ' hide-padding';

	}else{
	
		$hide_class = '';
	
	}

	//WIDTH
	if($width) {
	
		$width_value = $width;
	
	}else{
	
		$width_value = '100%';
	
	}

	$output = '<div class="message-box message-box-'.$style.'" style="width:'.$width_value.';">';
	$output .= '<div class="message-box-inner'.$icon_class.$hide_class.'">' . theme_remove_autop($content) . '</div>'."\n";

	if($hide =='yes') {
		$output .= '<span class="close">Hide</span>';
	}

	$output .= '</div>'."\n";

	return $output;

}

?>