<?php 
/*
* ----------------------------------------------------------------------------------------------------
* SHORTCODE FOR ICONLIST
* @PACKAGE BY HAWKTHEME
* ----------------------------------------------------------------------------------------------------
*/

add_shortcode('icon_list', 'theme_sc_icon_list');

function theme_sc_icon_list($atts, $content = null) 
{
	extract(shortcode_atts(
        array(
     		'style' => ''
    ), $atts));

	$output = '<div class="sc-iconlist sc-iconlist-'.$style.'">'."\n";
	$output .= theme_remove_autop($content);
	$output .= '</div>'."\n";

	return $output;
}

?>