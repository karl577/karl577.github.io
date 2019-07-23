<?php 
/*
* ----------------------------------------------------------------------------------------------------
* LOGO FUNCTIONS
* @PACKAGE BY HAWKTHEME
* ----------------------------------------------------------------------------------------------------
*/

function theme_site_name() 
{

	$logo = theme_get_option('header', 'logo');

	if($logo) {

		echo  '<div class="site-logo">'."\n";
		echo  '<a href="'.home_url( '/' ).'" title="'. esc_attr( get_bloginfo( 'name', 'display' ) ).'"><img src="'.$logo.'" /></a>'."\n";
		echo  '</div>'."\n";

	}else{
	
		echo  '<div class="site-name">'."\n";
		echo  '<h1><a href="'.home_url( '/' ).'" title="'. esc_attr( get_bloginfo( 'name', 'display' ) ).'">';
		bloginfo( 'name' );
		echo  '</a></h1>'."\n";
		echo  '<p>';
		bloginfo( 'description' );
		echo  '</p>'."\n";
		echo  '</div>'."\n";
	
	}

}

?>