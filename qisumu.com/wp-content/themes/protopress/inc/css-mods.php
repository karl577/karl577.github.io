<?php
/* 
**   Custom Modifcations in CSS depending on user settings.
*/

function protopress_custom_css_mods() {

	echo "<style id='custom-css-mods'>";
	
	
	//If Menu Description is Disabled.
	if ( !has_nav_menu('primary') || get_theme_mod('protopress_disable_nav_desc') ) :
		/*
			echo "#site-navigation ul li ul.sub-menu, #site-navigation ul li ul.children { top: 40px; }";
			echo "#site-navigation ul li ul.sub-menu li ul.sub-menu, #site-navigation ul li ul.children li ul.children { top: 0px; }";
		*/
		echo "#site-navigation ul li a { padding: 20px 12px; }";
		
	endif;
	
	//If Highlighting Nav active item is disabled
	if ( get_theme_mod('protopress_disable_active_nav') ) :
		echo "#site-navigation ul .current_page_item > a, #site-navigation ul .current-menu-item > a, #site-navigation ul .current_page_ancestor > a { border:none; background: inherit; }"; 
	endif;
	
	//If Title and Desc is set to Show Below the Logo
	if (  get_theme_mod('protopress_branding_below_logo') ) :
		
		echo "#masthead #text-title-desc { display: block; clear: both; } ";
		
	endif;
	
	//If Logo is Centered
	if ( get_theme_mod('protopress_center_logo') ) :
		
		echo "#masthead #text-title-desc, #masthead #site-logo { float: none; } .site-branding { text-align: center; } #text-title-desc { display: inline-block; }";
		
	endif;
	
	//Exception: When Logo is Centered, and Title Not Set to display in next line.
	if ( get_theme_mod('protopress_center_logo') && !get_theme_mod('protopress_branding_below_logo') ) :
		echo ".site-branding #text-title-desc { text-align: left; }";
	endif;
	
	//Exception: When Logo is centered, but there is no logo.
	if ( get_theme_mod('protopress_center_logo') && !get_theme_mod('protopress_logo') ) :
		echo ".site-branding #text-title-desc { text-align: center; }";
	endif;
	
	//Exception: IMage transform origin should be left on Left Alignment, i.e. Default
	if ( !get_theme_mod('protopress_center_logo') ) :
		echo "#masthead #site-logo img { transform-origin: left; }";
	endif;	
	
	
	//Modify Menu bars, if header image has been set
	if ( get_header_image() ) :
		echo "#site-navigation { background: ".protopress_fade("#f4f4f4", 0.9)."; }";
	endif;
	
	if ( get_theme_mod('protopress_title_font') ) :
		echo ".title-font, h1, h2, .section-title { font-family: ".get_theme_mod('protopress_title_font')."; }";
	endif;
	
	if ( get_theme_mod('protopress_body_font') ) :
		echo "body { font-family: ".get_theme_mod('protopress_body_font')."; }";
	endif;
	
	if ( get_theme_mod('protopress_site_titlecolor') ) :
		echo ".site-title a { color: ".get_theme_mod('protopress_site_titlecolor', '#e10d0d')."; }";
	endif;
	
	
	if ( get_theme_mod('protopress_header_desccolor','#777') ) :
		echo ".site-description { color: ".get_theme_mod('protopress_header_desccolor','#777')."; }";
	endif;
	
	if ( get_theme_mod('protopress_custom_css') ) :
		echo  get_theme_mod('protopress_custom_css');
	endif;
	
	
	if ( get_theme_mod('protopress_hide_title_tagline') ) :
		echo "#masthead .site-branding #text-title-desc { display: none; }";
	endif;
	
	if ( get_theme_mod('protopress_logo_resize') ) :
		$val = get_theme_mod('protopress_logo_resize')/100;
		echo "#masthead #site-logo img { transform: scale(".$val."); -webkit-transform: scale(".$val."); -moz-transform: scale(".$val."); -ms-transform: scale(".$val."); }";
		endif;

	echo "</style>";
}

add_action('wp_head', 'protopress_custom_css_mods');