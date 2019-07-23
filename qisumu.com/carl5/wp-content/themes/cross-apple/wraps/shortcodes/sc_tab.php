<?php 
/*
* ----------------------------------------------------------------------------------------------------
* SHORTCODE FOR TABBED
* @PACKAGE BY HAWKTHEME
* ----------------------------------------------------------------------------------------------------
*/

add_shortcode('tabs', 'theme_sc_tabs');
add_shortcode('tab', 'theme_sc_tab');


/***************************************************************************
 * Add shortcode [tab] [/tab]
***************************************************************************/
function theme_sc_tab( $atts, $content = null)
{
	global $tabs_array;
	
	extract(shortcode_atts(array(
		'title' => 'Title goes here'
	), $atts));
	
	$tabs_array[] = array(
		'title' => $title,
		'content' => do_shortcode( $content )
	);
}



/***************************************************************************
 * Add shortcode [tabs] [/tabs]
***************************************************************************/
function theme_sc_tabs( $atts, $content = null)
{

	global $tabs_array, $tabs_li_count, $tabs_pane_count;
	$tabs_li_count = 0;
	$tabs_pane_count = 0;

	do_shortcode( $content );

	if( is_array( $tabs_array ) )
	{

		$output = '<div class="tabs-wrap sc-tabs-wrap">';
		$output .= '<ul class="tabs clearfix">';
		
		foreach( $tabs_array as $tab )
		{
			$tabs_li_count++;
			if($tabs_li_count == '1') 
			{
				$output .= '<li><a href="#" class="sc-tab sc-tab-active" id="sc-tab-'.$tabs_li_count.'">' . $tab['title'] . '</a></li>';
			}
			else
			{
				$output .= '<li><a href="#" class="sc-tab" id="sc-tab-'.$tabs_li_count.'">' . $tab['title'] . '</a></li>';
			}
		}
		
		$output .= '</ul>';
		$output .= '<div class="panes">';
		
		foreach( $tabs_array as $tab )
		{
			$tabs_pane_count++;
			if($tabs_pane_count == '1') 
			{
				$output .= '<div class="pane sc-tab-'.$tabs_pane_count.'">' .theme_remove_autop( $tab['content'] ).'</div>';
			}
			else
			{
				$output .= '<div class="pane hide sc-tab-'.$tabs_pane_count.'">' .theme_remove_autop( $tab['content'] ).'</div>';
			}
		}

		$output .= '</div>';		
		$output .= '</div>';
		
		return $output;
	}

}

?>