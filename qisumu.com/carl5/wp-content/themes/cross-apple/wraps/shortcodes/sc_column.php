<?php 
/*
* ----------------------------------------------------------------------------------------------------
* SHORTCODE FOR COLUMNS
* @PACKAGE BY HAWKTHEME
* ----------------------------------------------------------------------------------------------------
*/

add_shortcode('one_half', 'theme_sc_one_half');
add_shortcode('one_half_last', 'theme_sc_one_half_last');
add_shortcode('one_third', 'theme_sc_one_third');
add_shortcode('one_third_last', 'theme_sc_one_third_last');
add_shortcode('two_third', 'theme_sc_two_third');
add_shortcode('two_third_last', 'theme_sc_two_third_last');
add_shortcode('one_fourth', 'theme_sc_one_fourth');
add_shortcode('one_fourth_last', 'theme_sc_one_fourth_last');
add_shortcode('three_fourth', 'theme_sc_three_fourth');
add_shortcode('three_fourth_last', 'theme_sc_three_fourth_last');
add_shortcode('one_fifth', 'theme_sc_one_fifth');
add_shortcode('one_fifth_last', 'theme_sc_one_fifth_last');
add_shortcode('two_fifth', 'theme_sc_two_fifth');
add_shortcode('two_fifth_last', 'theme_sc_two_fifth_last');
add_shortcode('three_fifth', 'theme_sc_three_fifth');
add_shortcode('three_fifth_last', 'theme_sc_three_fifth_last');
add_shortcode('four_fifth', 'theme_sc_four_fifth');
add_shortcode('four_fifth_last', 'theme_sc_four_fifth_last');


/***************************************************************************
 * Add shortcode [one_half] [/one_half]
***************************************************************************/
function theme_sc_one_half( $atts, $content = null)
{
	$output = '<div class="sc-col-2-1">' . theme_remove_autop($content) . '</div>'."\n";

	return $output;
}


function theme_sc_one_half_last( $atts, $content = null)
{
	$output = '<div class="sc-col-2-1 sc-last">' . theme_remove_autop($content) . '</div><div class="clear"></div>'."\n";

	return $output;
}


/***************************************************************************
 * Add shortcode [one_third] [/one_third]
***************************************************************************/
function theme_sc_one_third( $atts, $content = null)
{
	$output = '<div class="sc-col-3-1">' . theme_remove_autop($content) . '</div>'."\n";

	return $output;
}


function theme_sc_one_third_last( $atts, $content = null)
{
	$output = '<div class="sc-col-3-1 sc-last">' . theme_remove_autop($content) . '</div><div class="clear"></div>'."\n";

	return $output;
}


/***************************************************************************
 * Add shortcode [two_third] [/two_third]
***************************************************************************/
function theme_sc_two_third( $atts, $content = null)
{
	$output = '<div class="sc-col-3-2">' . theme_remove_autop($content) . '</div>'."\n";

	return $output;
}


function theme_sc_two_third_last( $atts, $content = null)
{
	$output = '<div class="sc-col-3-2 sc-last">' . theme_remove_autop($content) . '</div><div class="clear"></div>'."\n";

	return $output;
}


/***************************************************************************
 * Add shortcode [one_fourth] [/one_fourth]
***************************************************************************/
function theme_sc_one_fourth( $atts, $content = null)
{
	$output = '<div class="sc-col-4-1">' . theme_remove_autop($content) . '</div>'."\n";

	return $output;
}


function theme_sc_one_fourth_last( $atts, $content = null)
{
	$output = '<div class="sc-col-4-1 sc-last">' . theme_remove_autop($content) . '</div><div class="clear"></div>'."\n";

	return $output;
}


/***************************************************************************
 * Add shortcode [three_fourth] [/three_fourth]
***************************************************************************/
function theme_sc_three_fourth( $atts, $content = null)
{
	$output = '<div class="sc-col-4-3">' . theme_remove_autop($content) . '</div>'."\n";

	return $output;
}


function theme_sc_three_fourth_last( $atts, $content = null)
{
	$output = '<div class="sc-col-4-3 sc-last">' . theme_remove_autop($content) . '</div><div class="clear"></div>'."\n";

	return $output;
}


/***************************************************************************
 * Add shortcode [one_fifth] [/one_fifth]
***************************************************************************/
function theme_sc_one_fifth( $atts, $content = null)
{
	$output = '<div class="sc-col-5-1">' . theme_remove_autop($content) . '</div>'."\n";

	return $output;
}


function theme_sc_one_fifth_last( $atts, $content = null)
{
	$output = '<div class="sc-col-5-1 sc-last">' . theme_remove_autop($content) . '</div><div class="clear"></div>'."\n";

	return $output;
}


/***************************************************************************
 * Add shortcode [two_fifth] [/two_fifth]
***************************************************************************/
function theme_sc_two_fifth( $atts, $content = null)
{
	$output = '<div class="sc-col-5-2">' . theme_remove_autop($content) . '</div>'."\n";

	return $output;
}


function theme_sc_two_fifth_last( $atts, $content = null)
{
	$output = '<div class="sc-col-5-2 sc-last">' . theme_remove_autop($content) . '</div><div class="clear"></div>'."\n";

	return $output;
}


/***************************************************************************
 * Add shortcode [three_fifth] [/three_fifth]
***************************************************************************/
function theme_sc_three_fifth( $atts, $content = null)
{
	$output = '<div class="sc-col-5-3">' . theme_remove_autop($content) . '</div>'."\n";

	return $output;
}


function theme_sc_three_fifth_last( $atts, $content = null)
{
	$output = '<div class="sc-col-5-3 sc-last">' . theme_remove_autop($content) . '</div><div class="clear"></div>'."\n";

	return $output;
}


/***************************************************************************
 * Add shortcode [four_fifth] [/four_fifth]
***************************************************************************/
function theme_sc_four_fifth( $atts, $content = null)
{
	$output = '<div class="sc-col-5-4">' . theme_remove_autop($content) . '</div>'."\n";

	return $output;
}


function theme_sc_four_fifth_last( $atts, $content = null)
{
	$output = '<div class="sc-col-5-4 sc-last">' . theme_remove_autop($content) . '</div><div class="clear"></div>'."\n";

	return $output;
}

?>