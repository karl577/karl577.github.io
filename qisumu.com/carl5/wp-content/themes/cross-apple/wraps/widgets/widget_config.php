<?php
/*
* ----------------------------------------------------------------------------------------------------
* Widget Config
* @PACKAGE BY HAWKTHEME
* ----------------------------------------------------------------------------------------------------
*/

/*------------------------------------------------------------------------
*Widgets Function
------------------------------------------------------------------------*/
add_filter('widget_text', 'do_shortcode');
add_action('widgets_init', 'theme_remove_wp_widgets');
add_action('widgets_init','theme_register_sidebars');


function theme_remove_wp_widgets()
{
	unregister_widget('WP_Widget_Calendar');
	unregister_widget('WP_Widget_Search');
	unregister_widget('WP_Widget_Recent_Comments');
	unregister_widget('WP_Widget_Recent_Posts');
	unregister_widget('WP_Widget_RSS');
	unregister_widget('WP_Widget_Tag_Cloud');
}


function theme_register_sidebars()
{
	register_widget('Ads_Widget');
	register_widget('Comments_Widget');
	register_widget('Flickr_Widget');
	register_widget('Posts_Widget');
	register_widget('Search_Widget');
	register_widget('Social_Media_Widget');
	register_widget('Tweets_Widget');
}


/*------------------------------------------------------------------------
*Register Widgets
------------------------------------------------------------------------*/
if ( function_exists('register_sidebar') )
{	

	$sidebars = array('page', 'blog', 'portfolio', 'product', 'archives', 'contact', 'search');
	foreach ($sidebars as $sidebar)
	{	
		register_sidebar( array (
			'name' => $sidebar.' sidebar',
			'id' => $sidebar.'-widget-area',
			'before_widget' => '<div class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3>',
			'after_title' => '</h3>'
		));
	}


	$footer_columns = theme_get_option('footer','widget_columns');
	for ($i = 1; $i <= $footer_columns; $i++)
	{
		register_sidebar(array(
			'name' => 'footer widget #'.$i,
			'id' => 'footer-widget-area-'.$i,
			'before_widget' => '<div class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h3>',
			'after_title' => '</h3>',
		));
	}

}

?>