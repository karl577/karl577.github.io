<?php 
/*
* ----------------------------------------------------------------------------------------------------
* SHORTCODE FOR HIGHLIGHT TEXT
* @PACKAGE BY HAWKTHEME
* ----------------------------------------------------------------------------------------------------
*/
add_shortcode('highlight_text', 'theme_sc_highlight');


function theme_sc_highlight( $atts, $content = null) {

	extract(shortcode_atts(
        array(
            'bg_color' => '',
			'text_color' => ''
    ), $atts));

	$value = 'background-color: '.$bg_color.'; color: '.$text_color.';';

	$output = '<span class="highlight" style="'.$value.'">' . theme_remove_autop($content) . '</span>'."\n";

	return $output;
}

?>