<?php 
/*
* ----------------------------------------------------------------------------------------------------
* SHORTCODE FOR TOGGLE
* @PACKAGE BY HAWKTHEME
* ----------------------------------------------------------------------------------------------------
*/
add_shortcode('toggle', 'theme_sc_toggle');


function theme_sc_toggle($atts, $content=null)
{	
	extract(shortcode_atts(array('title' => 'Title goes here'), $atts));
	
	$output = '<div class="sc-toggle">';
	$output .= '<div class="title"><span>'.$title.'</span></div>';
	$output .= '<div class="inner clearfix">';
	$output .= theme_remove_autop($content)."\n";
	$output .= '</div>';
	$output .= '</div>';

	return $output;
}

?>