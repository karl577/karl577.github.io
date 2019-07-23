<?php
/*
* ----------------------------------------------------------------------------------------------------
* Include Wraps
* @PACKAGE BY HAWKTHEME
* ----------------------------------------------------------------------------------------------------
*/

//LOAD THEME OPTIONS
require_once(WRAPS_DIR.'/theme_options/options_config.php');
require_once(WRAPS_DIR.'/theme_options/options_generator.php');
require_once(WRAPS_DIR.'/wrap_backend.php');
//LOAD THEME DEFAULT OPTIONS
$load_theme_options = new Theme_Options();
$load_theme_options->theme_default_options();


//LOAD THEME FUNCTIONS
$enable_theme_panel = theme_get_option('general','enable_theme_panel');
if($enable_theme_panel == 'yes') {
	require_once(WRAPS_DIR.'/wrap_admin_bar.php');
}

require_once(WRAPS_DIR.'/wrap_excerpt.php');
require_once(WRAPS_DIR.'/wrap_functions.php');
require_once(WRAPS_DIR.'/wrap_pagination.php');
require_once(WRAPS_DIR.'/wrap_theme.php');
require_once(WRAPS_DIR.'/wrap_thumbs.php');


//LOAD POST TYPES
require_once(WRAPS_DIR.'/types/type_portfolio.php');
require_once(WRAPS_DIR.'/types/type_product.php');
require_once(WRAPS_DIR.'/types/type_slider.php');


//LOAD META BOXES
require_once(WRAPS_DIR.'/meta_boxes/meta_box_generator.php');
require_once(WRAPS_DIR.'/meta_boxes/meta_box_page.php');
require_once(WRAPS_DIR.'/meta_boxes/meta_box_portfolio.php');
require_once(WRAPS_DIR.'/meta_boxes/meta_box_post.php');
require_once(WRAPS_DIR.'/meta_boxes/meta_box_product.php');
require_once(WRAPS_DIR.'/meta_boxes/meta_box_slider.php');


//LOAD WIDGETS
require_once(WRAPS_DIR.'/widgets/widget_config.php');
require_once(WRAPS_DIR.'/widgets/widget_ads.php');
require_once(WRAPS_DIR.'/widgets/widget_comments.php');
require_once(WRAPS_DIR.'/widgets/widget_flickr.php');
require_once(WRAPS_DIR.'/widgets/widget_post.php');
require_once(WRAPS_DIR.'/widgets/widget_search.php');
require_once(WRAPS_DIR.'/widgets/widget_social.php');
require_once(WRAPS_DIR.'/widgets/widget_tweets.php');


//LOAD SHORTCODES
require_once(WRAPS_DIR.'/shortcodes/tinymce/tinymce_loader.php');
require_once(WRAPS_DIR.'/shortcodes/sc_button.php');
require_once(WRAPS_DIR.'/shortcodes/sc_blog_slider_list.php');
require_once(WRAPS_DIR.'/shortcodes/sc_column.php');
require_once(WRAPS_DIR.'/shortcodes/sc_highlight_text.php');
require_once(WRAPS_DIR.'/shortcodes/sc_html.php');
require_once(WRAPS_DIR.'/shortcodes/sc_icon_box.php');
require_once(WRAPS_DIR.'/shortcodes/sc_icon_list.php');
require_once(WRAPS_DIR.'/shortcodes/sc_latest_news_list.php');
require_once(WRAPS_DIR.'/shortcodes/sc_message_box.php');
require_once(WRAPS_DIR.'/shortcodes/sc_product_slider_list.php');
require_once(WRAPS_DIR.'/shortcodes/sc_portfolio_slider_list.php');
require_once(WRAPS_DIR.'/shortcodes/sc_portfolio_category_list.php');
require_once(WRAPS_DIR.'/shortcodes/sc_pricing_table.php');
require_once(WRAPS_DIR.'/shortcodes/sc_style_image.php');
require_once(WRAPS_DIR.'/shortcodes/sc_tab.php');
require_once(WRAPS_DIR.'/shortcodes/sc_testimonial.php');
require_once(WRAPS_DIR.'/shortcodes/sc_toggle.php');

?>