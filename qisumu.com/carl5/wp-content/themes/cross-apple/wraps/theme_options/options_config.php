<?php
/*
* ----------------------------------------------------------------------------------------------------
* Options Config
* @PACKAGE BY HAWKTHEME
* ----------------------------------------------------------------------------------------------------
*/

/**
* This function be used for add theme options menu.
*/
function theme_options_menu ()
{

	add_menu_page(THEME_NAME, THEME_NAME, 'administrator', 'theme_general.php', 'theme_load_theme_pages', WRAPS_URI . '/assets/images/icon-options.png', 58);
	add_submenu_page('theme_general.php', 'General', '一般', 'administrator', 'theme_general.php', 'theme_load_theme_pages');
	add_submenu_page('theme_general.php', 'Header', '头部', 'administrator', 'theme_header.php', 'theme_load_theme_pages');
	add_submenu_page('theme_general.php', 'Footer', '页脚', 'administrator', 'theme_footer.php', 'theme_load_theme_pages');
	add_submenu_page('theme_general.php', 'Slider', '滑块', 'administrator', 'theme_slider.php', 'theme_load_theme_pages');
	add_submenu_page('theme_general.php', 'Blog', '博客', 'administrator', 'theme_blog.php', 'theme_load_theme_pages');
	add_submenu_page('theme_general.php', 'Portfolio', '投资组合', 'administrator', 'theme_portfolio.php', 'theme_load_theme_pages');
	add_submenu_page('theme_general.php', 'Product', '产品', 'administrator', 'theme_product.php', 'theme_load_theme_pages');
	add_submenu_page('theme_general.php', 'Fonts', '字体', 'administrator', 'theme_font.php', 'theme_load_theme_pages');
	add_submenu_page('theme_general.php', 'Styles', '样式', 'administrator', 'theme_style.php', 'theme_load_theme_pages');

}

add_action('admin_menu', 'theme_options_menu');



/**
* This function be used for load theme pages.
*/
function theme_load_theme_pages() 
{

	$page = include(WRAPS_DIR . '/theme_options/pages/' . $_GET['page']);

	if($page['auto'])
	{
		new theme_options_generator($page['name'],$page['options']);
	}

}



/**
* This function be used for getting theme options.
*/
function theme_get_option($page, $name = NULL) 
{

	global $theme_options;

	if ($name == NULL) {
		if (isset($theme_options[$page])) {
			return $theme_options[$page];
		} else {
			return false;
		}

	} else {
		if (isset($theme_options[$page][$name])) {
			return $theme_options[$page][$name];
		} else {
			return false;
		}
	}

}




/**
* Loads the default theme options.
*/

class Theme_Options
{
	function theme_default_options() {
		global $theme_options;
		$theme_options = array();
		$option_files = array(
			'theme_general',
			'theme_header',
			'theme_footer',
			'theme_slider',
			'theme_blog',
			'theme_portfolio',
			'theme_product',
			'theme_font',
			'theme_style'
		);
		foreach($option_files as $file){
			$page = include (WRAPS_DIR . '/theme_options/pages/' . $file.'.php');
			$theme_options[$page['name']] = array();
			foreach($page['options'] as $option) {
				if (isset($option['std'])) {
					$theme_options[$page['name']][$option['id']] = $option['std'];
				}
			}
			$theme_options[$page['name']] = array_merge((array) $theme_options[$page['name']], (array) get_option('theme_' .THEME_SLUG . '_' . $page['name']));
		}
	}
}
?>