<?php
/*
* ----------------------------------------------------------------------------------------------------
* Add Option Functions
* @PACKAGE BY HAWKTHEME
* ----------------------------------------------------------------------------------------------------
*/


/*------------------------------------------------------------------------
*Add SEO meta
------------------------------------------------------------------------*/
function theme_add_seo_meta() 
{
	$seo_follow = get_meta_option('seo_follow');
	$seo_noindex = get_meta_option('seo_noindex');
	$seo_keywords = get_meta_option('seo_keywords');
	$seo_description = get_meta_option('seo_description');
	$seo_title_tags = get_meta_option('seo_title_tags');

	if( is_singular() )
	{
		if($seo_follow == true) { $seo_follow = 'follow'; } else { $seo_follow = 'nofollow'; }
		if($seo_noindex == true) { $seo_noindex = 'noindex'; } else { $seo_noindex = 'index'; }

		echo '<meta name="robots" content="'.$seo_noindex.', '.$seo_follow.'" />'."\n";

		if($seo_keywords) 
		{
		echo '<meta name="keywords" content="'.stripslashes($seo_keywords).'" />'."\n";
		}

		if($seo_description)
		{
		echo '<meta name="description" content="'.stripslashes($seo_description).'" />'."\n";
		}
	}

	echo ''."\n";
	echo '<!--Title-->'."\n";
	if( is_singular() && $seo_title_tags != '') 
	{
	echo '<title>'.stripslashes($seo_title_tags).'</title>'."\n";
	}else
	{
	echo '<title>';
	wp_title('-', true, 'right');
	echo '</title>'."\n";
	}
}

add_action('wp_seo', 'theme_add_seo_meta');


/*------------------------------------------------------------------------
*Load all styles
------------------------------------------------------------------------*/
function theme_load_all_styles() 
{
	$current_style = theme_get_option('style','current_style');
	$favicon = theme_get_option('general','favicon');
	echo '<link type="text/css" rel="stylesheet" href="'.ASSETS_URI.'/css/common.css?ver='.THEME_VERSION.'" media="screen" />'."\n";
	echo '<link type="text/css" rel="stylesheet" href="'.ASSETS_URI.'/css/typography.css?ver='.THEME_VERSION.'" media="screen" />'."\n";
	echo '<link type="text/css" rel="stylesheet" href="'.ASSETS_URI.'/css/slider.css?ver='.THEME_VERSION.'" media="screen" />'."\n";
	echo '<link type="text/css" rel="stylesheet" href="'.ASSETS_URI.'/css/layout.css?ver='.THEME_VERSION.'" media="screen" />'."\n";
	echo '<link type="text/css" rel="stylesheet" href="'.ASSETS_URI.'/css/widgets.css?ver='.THEME_VERSION.'" media="screen" />'."\n";
	echo '<link type="text/css" rel="stylesheet" href="'.ASSETS_URI.'/css/shortcodes.css?ver='.THEME_VERSION.'" media="screen" />'."\n";
	echo '<link type="text/css" rel="stylesheet" href="'.ASSETS_URI.'/css/jquery.fancybox-1.3.4.css?ver='.THEME_VERSION.'" media="screen" />'."\n";
	echo '<link type="text/css" rel="stylesheet" href="'.ASSETS_URI.'/css/fonts.css?ver='.THEME_VERSION.'" media="screen" />'."\n";
	echo '<link type="text/css" rel="stylesheet" href="'.ASSETS_URI.'/css/responsive.css?ver='.THEME_VERSION.'" media="screen" />'."\n";
	echo '<link type="text/css" rel="stylesheet" href="'.ASSETS_URI.'/css/styles/style-'.$current_style.'.css?ver='.THEME_VERSION.'" media="screen" />'."\n";
	if ($favicon) { echo '<link rel="shortcut icon" href="'.$favicon.'" />',"\n"; }
}

add_action('wp_styles', 'theme_load_all_styles');



/*------------------------------------------------------------------------
*Load all srcipts
------------------------------------------------------------------------*/
function theme_load_all_srcipts() 
{
	//JavaSrcipts
	if(!is_admin())
	{
		wp_deregister_script( 'jquery' );
		wp_register_script( 'jquery', ASSETS_URI. '/js/jquery-1.7.min.js', false, THEME_VERSION );
		wp_register_script( 'ddsmoothmenu', ASSETS_URI. '/js/ddsmoothmenu-1.5.js', false, THEME_VERSION );
		wp_register_script( 'jquery.easing', ASSETS_URI. '/js/jquery.easing-1.3.js', false, THEME_VERSION );
		wp_register_script( 'jquery.quicksand', ASSETS_URI. '/js/jquery.quicksand-1.2.2.js', false, THEME_VERSION );
		wp_register_script( 'jquery.fancybox', ASSETS_URI. '/js/jquery.fancybox-1.3.4.pack.js', false, THEME_VERSION );
		wp_register_script( 'jquery.validate', ASSETS_URI. '/js/jquery.validate-1.9.min.js', false, THEME_VERSION );
		wp_register_script( 'jquery.slider', ASSETS_URI. '/js/jquery.slider.pack.js', false, THEME_VERSION );
		wp_register_script( 'jquery.flexslider', ASSETS_URI. '/js/jquery.flexslider-min.js', false, THEME_VERSION );
		wp_register_script( 'jquery.mobilemenu', ASSETS_URI. '/js/jquery.mobilemenu.js', false, THEME_VERSION );
		wp_register_script( 'custom', ASSETS_URI. '/js/custom.js', false, THEME_VERSION );
		wp_enqueue_script('jquery');
		wp_enqueue_script('ddsmoothmenu');
		wp_enqueue_script('jquery.easing');
		wp_enqueue_script('jquery.quicksand');
		wp_enqueue_script('jquery.fancybox');
		wp_enqueue_script('jquery.validate');
		wp_enqueue_script('jquery.slider');
		wp_enqueue_script('jquery.flexslider');
		wp_enqueue_script('jquery.mobilemenu');
		wp_enqueue_script('custom');
		if ( is_singular() && get_option( 'thread_comments' ) ) 
		{ 
			wp_enqueue_script( 'comment-reply' ); 
		}
	}
}

add_action('wp_print_scripts', 'theme_load_all_srcipts');


function theme_load_ie_srcipts() 
{
	if(!is_admin())
	{
		echo '<!--[if lt IE 9]>'."\n";
		echo '<script type="text/javascript" src="'.ASSETS_URI.'/js/iepp-2.1.min.js?ver='.THEME_VERSION.'"></script>'."\n";
		echo '<script type="text/javascript" src="'.ASSETS_URI.'/js/selectivizr-1.0.2.min.js?ver='.THEME_VERSION.'"></script>'."\n";
		echo '<![endif]-->'."\n";
	}
}

add_action('wp_head', 'theme_load_ie_srcipts');



/*------------------------------------------------------------------------
*Load custom styles
------------------------------------------------------------------------*/
function theme_load_custom_styles() 
{
	$font_stacks = array(
		'arial' => 'Arial, "Helvetica Neue", Helvetica, sans-serif',
		'baskerville' => 'Baskerville, "Times New Roman", Times, serif',
		'cambria' => 'Cambria, Georgia, Times, "Times New Roman", serif',
		'century-gothic' => '"Century Gothic", "Apple Gothic", sans-serif',
		'consolas' => 'Consolas, "Lucida Console", Monaco, monospace',
		'copperplate-light' => '"Copperplate Light", "Copperplate Gothic Light", serif',
		'courier-new' => '"Courier New", Courier, monospace',
		'franklin' => '"Franklin Gothic Medium", "Arial Narrow Bold", Arial, sans-serif',
		'futura' => 'Futura, "Century Gothic", AppleGothic, sans-serif',
		'garamond' => 'Garamond, "Hoefler Text", Times New Roman, Times, serif',
		'geneva' => 'Geneva, "Lucida Sans", "Lucida Grande", "Lucida Sans Unicode", Verdana, sans-serif',
		'georgia' => 'Georgia, Palatino," Palatino Linotype", Times, "Times New Roman", serif',
		'gill-sans' => '"Gill Sans", Calibri, "Trebuchet MS", sans-serif',
		'helvetica' => '"Helvetica Neue", Arial, Helvetica, sans-serif',
		'impact' => 'Impact, Haettenschweiler, "Arial Narrow Bold", sans-serif',
		'lucida' => '"Lucida Sans", "Lucida Grande", "Lucida Sans Unicode", sans-serif',
		'metrophobic' => 'MetrophobicRegular, "Lucida Sans", "Lucida Grande", "Lucida Sans Unicode", sans-serif',
		'palatino' => 'Palatino, "Palatino Linotype", Georgia, Times, "Times New Roman", serif',
		'tahoma' => 'Tahoma, Geneva, Verdana',
		'times' => 'Times, "Times New Roman", Georgia, serif',
		'trebuchet' => '"Trebuchet MS", "Lucida Sans Unicode", "Lucida Grande", "Lucida Sans", Arial, sans-serif',
		'verdana' => 'Verdana, Geneva, Tahoma, sans-serif',
		'vegur' => '"VegurRegular", "Helvetica Neue", Helvetica, Arial, sans-serif'
	);

	//Custom CSS
	$header_height = theme_get_option('header','header_height');
	$header_position = theme_get_option('header','header_position');
	$header_logo_top = theme_get_option('header','logo_top');
	$header_logo_left = theme_get_option('header','logo_left');
	$menu_top = theme_get_option('header','menu_top');
	$footer_logo_top = theme_get_option('footer','logo_top');
	$footer_logo_left = theme_get_option('footer','logo_left');
	$footer_logo_right = theme_get_option('footer','logo_right');

	//Custom Fonts
	$body_font_family = theme_get_option('font','body_font_family');
	$nav_font_family = theme_get_option('font','nav_font_family');
	$headings_font_family = theme_get_option('font','headings_font_family');

	$body_family  = $font_stacks[$body_font_family]; 
	$nav_family  = $font_stacks[$nav_font_family]; 
	$headings_family  = $font_stacks[$headings_font_family]; 

	$headings_font_weight = theme_get_option('font','headings_font_weight');
	$menu_font_size = theme_get_option('font','menu_font_size');
	$sub_menu_font_size = theme_get_option('font','sub_menu_font_size');
	$h1_font_size = theme_get_option('font','h1_font_size');
	$h2_font_size = theme_get_option('font','h2_font_size');
	$h3_font_size = theme_get_option('font','h3_font_size');
	$h4_font_size = theme_get_option('font','h4_font_size');
	$h5_font_size = theme_get_option('font','h5_font_size');
	$h6_font_size = theme_get_option('font','h6_font_size');

	//Custom Styles
	$text_color = theme_get_option('style','text_color');
	$link_color = theme_get_option('style','link_color');
	$hover_color = theme_get_option('style','hover_color');
	$pattern = theme_get_option('style','body_pattern');

	//Background
	$body_bg_img = theme_get_option('style','body_bg_image');
	$body_bg_p = theme_get_option('style','body_bg_properties');
	$body_bg_h = theme_get_option('style','body_bg_horizontal');
	$body_bg_v = theme_get_option('style','body_bg_vertical');
	$body_bg_a = theme_get_option('style','body_bg_attachment');


	$output = '';
	if($body_bg_img != ''){
		$output .= 'body { background: url('.$body_bg_img.') '.$body_bg_p.' '.$body_bg_h.' '.$body_bg_v.' '.$body_bg_a.';} '."\n";
	}
	elseif($pattern != '0') 
	{
		$output .= 'body { background-image: url('.ASSETS_URI.'/images/bodybg/bg-'.$pattern.'.png); } '."\n";
	}

	if($text_color) {
		$output .= 'body { color: #'.$text_color.'; } '."\n";
	}

	if($link_color) {
		$output .= 'a { color: #'.$link_color.'; } '."\n";
	}

	if($hover_color) {
		$output .= 'a:hover { color: #'.$hover_color.'; } '."\n";
	}

	if($header_position == true) {
		$output .= 'header { width: 100%; position: fixed; z-index: 300; top: 0; }'."\n";
		$output .= '#container { padding-top: '.$header_height.'px;}'."\n";
	}
	$output .= 'header .header-inner { height: '.$header_height.'px; }'."\n";
	$output .= 'header .site-logo, header .site-name { margin-top: '.$header_logo_top.'px;  margin-left: '.$header_logo_left.'px; }'."\n";
	$output .= 'header #top-menu { margin-top: '.$menu_top.'px; }'."\n";
	$output .= 'footer .site-logo { margin-top: '.$footer_logo_top.'px;  margin-left: '.$footer_logo_left.'px;  margin-right: '.$footer_logo_right.'px; }'."\n";
	$output .= 'body { font-family: '.$body_family.'; } '."\n";
	$output .= 'nav { font-family: '.$nav_family.'; } '."\n";
	$output .= 'h1, h2, h3, h4, h5, h6 { font-family: '.$headings_family.'; font-weight: '.$headings_font_weight.';} '."\n";
	$output .= 'header #top-menu ul li { font-size: '.$menu_font_size.'px; } '."\n";
	$output .= 'header #top-menu ul li ul li { font-size: '.$sub_menu_font_size.'px; } '."\n";
	$output .= 'h1 { font-size: '.$h1_font_size.'px; } '."\n";
	$output .= 'h2 { font-size: '.$h2_font_size.'px; } '."\n";
	$output .= 'h3 { font-size: '.$h3_font_size.'px; } '."\n";
	$output .= 'h4 { font-size: '.$h4_font_size.'px; } '."\n";
	$output .= 'h5 { font-size: '.$h5_font_size.'px; } '."\n";
	$output .= 'h6 { font-size: '.$h6_font_size.'px; } '."\n";

	echo "\n";
	echo '<!--Extend CSS-->'."\n";
	echo '<style type="text/css">'."\n";
	echo $output;
	echo '</style>'."\n";
	echo '<link type="text/css" rel="stylesheet" href="'.ASSETS_URI.'/css/custom.css?ver='.THEME_VERSION.'" media="screen" />'."\n";

}

add_action('wp_head', 'theme_load_custom_styles');


/*------------------------------------------------------------------------
*Theme load drop menu js
------------------------------------------------------------------------*/
function  theme_load_menu_js() 
{	
	echo '<script type="text/javascript">'."\n";
	echo '//<![CDATA['."\n";
	echo 'ddsmoothmenu.init({'."\n";
	echo 'mainmenuid: "top-menu", '."\n";
	echo 'orientation: "h", '."\n";
	echo 'classname: "ddsmoothmenu", '."\n";
	echo 'contentsource: "markup" '."\n";
	echo '});'."\n";
	echo '//]]>'."\n";
	echo '</script>'."\n";
}

add_action('wp_footer', 'theme_load_menu_js');



/*------------------------------------------------------------------------
*Theme load google analytics
------------------------------------------------------------------------*/
function  theme_load_google_analytics() 
{	
	$google_analytics = theme_get_option('general','analytics');

	if($google_analytics) { echo stripslashes($google_analytics) ."\n"; }
}

add_action('wp_footer', 'theme_load_google_analytics');

?>