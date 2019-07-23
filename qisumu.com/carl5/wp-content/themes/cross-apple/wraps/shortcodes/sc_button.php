<?php 
/*
* ----------------------------------------------------------------------------------------------------
* Button
* @PACKAGE BY HAWKTHEME
* ----------------------------------------------------------------------------------------------------
*/

add_shortcode('button', 'theme_sc_button');

function theme_sc_button( $atts, $content = null)
{

	extract(shortcode_atts(
        array(
            'url' => '',
			'style' => 'white',
			'open_type' => 'self'
    ), $atts));	

	if($open_type == 'self') {

		$target = 'bookmark';

	}elseif($open_type == 'blank') {

		$target = 'external';

	}

	$output = '<div class="button-wrap">'."\n";
	$output .= '<a href="'.$url.'" class="sc-button sc-button-'.$style.'" rel="'.$target.'">'. theme_remove_autop($content) .'</a>'."\n";
	$output .= '</div>'."\n";

	return $output;

}

?>