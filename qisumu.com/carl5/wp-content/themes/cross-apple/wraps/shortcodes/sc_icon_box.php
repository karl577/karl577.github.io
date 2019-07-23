<?php 
/*
* ----------------------------------------------------------------------------------------------------
* SHORTCODE FOR ICONBOX
* @PACKAGE BY HAWKTHEME
* ----------------------------------------------------------------------------------------------------
*/
add_shortcode('icon_box', 'theme_sc_icon_box');

function theme_sc_icon_box($atts, $content = null) 
{
	extract(shortcode_atts(
        array(
			'title' => '',
     		'icon' => ''
    ), $atts));

	//check wich link base we should use for the icon. by default we take the iconbox folder. if the user sets a path use that path
	if($icon != ""&& strpos('/', $icon) === false) { $icon_url = THEME_URI . '/assets/images/shortcode/'.$icon; }

	if($icon != "") { $icon_img = '<img src="'.$icon_url.'" alt="" />'; }

	$output = '<div class="sc-iconbox">'."\n";
	$output .= '<div class="iconbox-head clearfix">';
	$output .= '<div class="iconbox-img alignleft">'.$icon_img.'</div>';
	$output .= '<h5 class="iconbox-title">'.$title.'</h5>';
	$output .= '</div>';
	$output .= '<p class="iconbox-desc">'.theme_remove_autop($content) .'</p>';
	$output .= '</div>'."\n";

	return $output;

}

?>