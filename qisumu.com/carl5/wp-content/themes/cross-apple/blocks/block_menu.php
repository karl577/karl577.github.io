<?php 
/*
* ----------------------------------------------------------------------------------------------------
* MENU FUNCTIONS
* @PACKAGE BY HAWKTHEME
* ----------------------------------------------------------------------------------------------------
*/


/*------------------------------------------------------------------------
*Top Menu
------------------------------------------------------------------------*/
function theme_top_wp_nav() 
{

	$level = theme_get_option('header','menu_depth');
	$args = array( 
		'container' => 'nav',
		'container_id' => 'top-menu', 
		'container_class' =>'ddsmoothmenu', 
		'menu_class' => 'drop-menu',
		'fallback_cb' => 'theme_top_wp_page_menu', 
		'theme_location' => 'top menu',
		'depth' => $level
	);
	wp_nav_menu($args); 

}


/*------------------------------------------------------------------------
*Top Page Menu
------------------------------------------------------------------------*/
function theme_top_wp_page_menu() 
{

	$level = theme_get_option('header','menu_depth');
	$args = array(
		'title_li' => '0',
		'sort_column' => 'menu_order',
		'depth' => $level
	);

	echo '<nav id="top-menu" class="ddsmoothmenu">'."\n";
	echo '<ul class="drop-menu">'."\n";
	wp_list_pages($args); 
	echo '</ul>'."\n";
	echo '</nav>'."\n";

}


/*------------------------------------------------------------------------
*Bottom Menu
------------------------------------------------------------------------*/
function theme_bottom_wp_nav() 
{

	$args = array( 
			'container' => 'nav',
			'container_id' => 'bottom-menu', 
			'container_class' =>'bottom-menu-container', 
			'menu_class' => 'bottom-menu-class clearfix', 
			'theme_location' => 'bottom menu',
			'after' => '<span>/</span>',
			'depth' => 1
	);
	wp_nav_menu($args); 

}


?>