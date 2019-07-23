<?php

/*====================================*\
	FUNCTIONS
\*====================================*/

function pbpanel_options($option) {
	$option('pbpanel_infinite_scroll', 1);
	$option('pbpanel_posts_in_same_cat', 2);
	$option('pbpanel_pinbox_show_comments', 1);
	$option('pbpanel_pinbox_show_postdate', 1);
	$option('pbpanel_header_code', '');
	$option('pbpanel_google_code', '');
	$option('pbpanel_footer_showlinks', 5);
	$option('pbpanel_footer_copyright', '');
	
	$option('pbpanel_site_skin', 'default');
	$option('pbpanel_site_bg', 2);
	$option('pbpanel_site_logo', '');
	$option('pbpanel_site_favicon', '');
	
	$option('pbpanel_slider_show', 2);
	$option('pbpanel_slider_arrows', 'true');
	$option('pbpanel_slider_arrows_constraint', 'false');
	$option('pbpanel_slider_slideshow', 'true');
	$option('pbpanel_slider_slideshow_delay', 10);
	$option('pbpanel_slider_blocktext', 'false');
	$option('pbpanel_slider_dotnav', 'true');
	$option('pbpanel_slider_dotnav_alignment', 'center');
	$option('pbpanel_slider_slide_position', 1);
	
	$option('pbpanel_meta_keywords', '');
	$option('pbpanel_meta_description', '');
	$option('pbpanel_meta_author', '');
	$option('pbpanel_title_separator', '&laquo;');
	
	$option('pbpanel_pinbox_soc_icons', 1);
	$option('pbpanel_url_facebook', '');
	$option('pbpanel_url_pinterest', '');
	$option('pbpanel_url_twitter', '');
	$option('pbpanel_url_instagram', '');
	$option('pbpanel_url_youtube', '');
	$option('pbpanel_url_linkedin', '');
	$option('pbpanel_url_gplus', '');
	$option('pbpanel_url_behance', '');
	$option('pbpanel_url_flickr', '');
	$option('pbpanel_url_foursquare', '');
	$option('pbpanel_url_vimeo', '');
	$option('pbpanel_url_soundcloud', '');	
}

?>