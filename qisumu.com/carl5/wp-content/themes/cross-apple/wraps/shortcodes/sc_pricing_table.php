<?php 
/*
* ----------------------------------------------------------------------------------------------------
* Pricing Table
* @PACKAGE BY HAWKTHEME
* ----------------------------------------------------------------------------------------------------
*/

add_shortcode('pricing_table', 'theme_sc_pricing_table');

function theme_sc_pricing_table( $atts, $content = null)
{

	extract(shortcode_atts(
        array(
            'title' => '',
			'price' => '',
			'time' => '',
			'image' => ''
    ), $atts));	

	$output = '<div class="sc-pricing-table">'."\n";
	$output .= '<section class="title clearfix"><h3>'.$title.'</h3><b>'.$price.'</b><span>'.$time.'</span></section>'."\n";
	$output .= '<article class="content clearfix">'."\n";
	$output .= theme_remove_autop($content);
	$output .= '<figure class="img"><img src="'.$image.'" alt="" /></figure>'."\n";
	$output .= '<article>'."\n";
	$output .= '</div>'."\n";

	return $output;

}

?>