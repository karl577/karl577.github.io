<?php 
/*
* ----------------------------------------------------------------------------------------------------
* SHORTCODE FOR HTML
* @PACKAGE BY HAWKTHEME
* ----------------------------------------------------------------------------------------------------
*/

add_shortcode('box', 'theme_sc_box');
add_shortcode('br', 'theme_sc_br');
add_shortcode('clear', 'theme_sc_clear');
add_shortcode('gotop', 'theme_sc_gotop');
add_shortcode('hr', 'theme_sc_hr');


/***************************************************************************
 * Add shortcode [box] [/box]
***************************************************************************/
function theme_sc_box($atts, $content = null)
{

    $output = '<div class="sc-box">'.theme_remove_autop($content) .'</div>'."\n";

    return $output;
}




/***************************************************************************
 * Add shortcode [br]
***************************************************************************/
function theme_sc_br($atts, $content = null)
{
	extract(shortcode_atts(
        array(
            'top' => '0'
    ), $atts));

    $output = '<div style="margin-top: '.$top.'px;"></div>'."\n";

    return $output;
}


/***************************************************************************
 * Add shortcode [clear]
***************************************************************************/
function theme_sc_clear($atts, $content = null)
{
	$output = '<div class="clear"></div>'."\n";

	return $output;
}


/***************************************************************************
 * Add shortcode [gotop]
***************************************************************************/
function theme_sc_gotop($atts, $content = null) 
{
	extract(shortcode_atts(
        array(
            'top' => '0',
			'bottom' => '0'
    ), $atts));

    $output = '<div class="sc-gotop" style="margin-top: '.$top.'px; margin-bottom: '.$bottom.'px;"><a href="#">TOP</a></div>'."\n";

    return $output;
}


/***************************************************************************
 * Add shortcode [hr]
***************************************************************************/
function theme_sc_hr($atts, $content = null) 
{
	extract(shortcode_atts(
        array(
            'top' => '0',
			'bottom' => '0'
    ), $atts));

    $output = '<div class="sc-hr" style="margin-top: '.$top.'px; margin-bottom: '.$bottom.'px; clear:both;"></div>'."\n";

    return $output;
}

?>