<?php
/**
 * proper-lite Theme Customizer
 *
 * @package proper-lite
 */


/**
 * Add CSS in <head> for styles handled by the theme customizer
 *
 * @since 1.5
 */
function proper_lite_add_customizer_css() {
	
?>
	<!-- proper_lite customizer CSS --> 
	<style> 
		
		<?php if ( get_theme_mod( 'proper_lite_nav_bg_color' ) ) : ?>
		.sidr { background: <?php echo esc_attr( get_theme_mod( 'proper_lite_nav_bg_color', '#111111' )) ?>; } 
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'proper_lite_nav_link_color' ) ) : ?>
		.sidr ul li a, .sidr ul li span, .main-navigation a, .sidr ul li ul li a, .sidr ul li ul li span { color: <?php echo esc_attr( get_theme_mod( 'proper_lite_nav_link_color', '#ffffff' )) ?>; } 
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'proper_lite_nav_link_hover_color' ) ) : ?>
		.sidr ul li a:hover, .main-navigation a:hover { color: <?php echo esc_attr( get_theme_mod( 'proper_lite_nav_link_hover_color', '#999999' )) ?>; } 
		<?php endif; ?> 
		
		<?php if ( get_theme_mod( 'proper_lite_menu_button' ) ) : ?>
		.navigation-container a#sidr-menu { background-color: <?php echo esc_attr( get_theme_mod( 'proper_lite_menu_button', '#111111' )) ?>; }
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'proper_lite_menu_button' ) ) : ?>
		.navigation-container a#sidr-menu { border-color: <?php echo esc_attr( get_theme_mod( 'proper_lite_menu_button', '#111111' )) ?>; }
		<?php endif; ?>  
		
		<?php if ( get_theme_mod( 'proper_lite_menu_button_hover' ) ) : ?>
		.navigation-container a#sidr-menu:hover { background-color: <?php echo esc_attr( get_theme_mod( 'proper_lite_menu_button_hover', '#444444' )) ?>; }
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'proper_lite_menu_button_hover' ) ) : ?>
		.navigation-container a#sidr-menu:hover { border-color: <?php echo esc_attr( get_theme_mod( 'proper_lite_menu_button_hover', '#444444' )) ?>; }
		<?php endif; ?> 
		
		<?php if ( get_theme_mod( 'proper_lite_nav_dropdown_bg' ) ) : ?>
		.main-navigation ul ul { background: <?php echo esc_attr( get_theme_mod( 'proper_lite_nav_dropdown_bg', '#212121' )) ?>; } 
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'proper_lite_nav_text_size' ) ) : ?>
		.main-navigation a, .sidr ul li a { font-size: <?php echo esc_attr( get_theme_mod( 'proper_lite_nav_text_size', '14' )) ?>px; } 
		<?php endif; ?> 
		
		
		
		<?php if ( get_theme_mod( 'proper_lite_hero_heading_color' ) ) : ?>
		.hero-content { color: <?php echo esc_attr( get_theme_mod( 'proper_lite_hero_heading_color', '#ffffff' )) ?>; } 
		<?php endif; ?> 
		
		<?php if ( get_theme_mod( 'proper_lite_hero_bg_color' ) ) : ?>
		#home-hero { background-color: <?php echo esc_attr( get_theme_mod( 'proper_lite_hero_bg_color', '#111111' )) ?>; } 
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'proper_lite_hw_area_1_bg_color' ) ) : ?>
		.home-widget-one { background: <?php echo esc_attr( get_theme_mod( 'proper_lite_hw_area_1_bg_color', '#f5f5f3' )) ?>; } 
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'proper_lite_hw_area_1_heading_color' ) ) : ?>
		.home-widget-one h1, .home-widget-one h2, .home-widget-one h3, .home-widget-one h4, .home-widget-one h5, .home-widget-one h6 { color: <?php echo esc_attr( get_theme_mod( 'proper_lite_hw_area_1_heading_color', '#404040' )) ?>; } 
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'proper_lite_hw_area_1_text_color' ) ) : ?> 
		.home-widget-one, .home-widget-one p { color: <?php echo esc_attr( get_theme_mod( 'proper_lite_hw_area_1_text_color', '#404040' )) ?>; } 
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'proper_lite_hw_area_1_link_color' ) ) : ?>
		.home-widget-one a { color: <?php echo esc_attr( get_theme_mod( 'proper_lite_hw_area_1_link_color', '#000000' )) ?>; } 
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'proper_lite_hw_area_1_link_hover_color' ) ) : ?>
		.home-widget-one a:hover { color: <?php echo esc_attr( get_theme_mod( 'proper_lite_hw_area_1_link_hover_color', '#000000' )) ?>; } 
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'proper_lite_hw_area_1_button_color' ) ) : ?>
		.home-widget-one button { background: <?php echo esc_attr( get_theme_mod( 'proper_lite_hw_area_1_button_color', '#111111' )) ?>; } 
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'proper_lite_hw_area_1_button_color' ) ) : ?> 
		.home-widget-one button { border-color: <?php echo esc_attr( get_theme_mod( 'proper_lite_hw_area_1_button_color', '#111111' )) ?>; }   
		<?php endif; ?> 
		
		<?php if ( get_theme_mod( 'proper_lite_hw_area_1_button_hover_color' ) ) : ?>
		.home-widget-one button:hover { background: <?php echo esc_attr( get_theme_mod( 'proper_lite_hw_area_1_button_hover_color', '#444444' )) ?>; } 
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'proper_lite_hw_area_1_button_hover_color' ) ) : ?>
		.home-widget-one button:hover { border-color: <?php echo esc_attr( get_theme_mod( 'proper_lite_hw_area_1_button_hover_color', '#444444' )) ?>; } 
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'proper_lite_hw_area_2_bg_color' ) ) : ?>
		.home-widget-two { background: <?php echo esc_attr( get_theme_mod( 'proper_lite_hw_area_2_bg_color', '#ffffff' )) ?>; } 
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'proper_lite_hw_area_2_heading_color' ) ) : ?>
		.home-widget-two h1, .home-widget-two h2, .home-widget-two h3, .home-widget-two h4, .home-widget-two h5, .home-widget-two h6 { color: <?php echo esc_attr( get_theme_mod( 'proper_lite_hw_area_2_heading_color', '#404040' )) ?>; } 
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'proper_lite_hw_area_2_text_color' ) ) : ?>
		.home-widget-two, .home-widget-two p { color: <?php echo esc_attr( get_theme_mod( 'proper_lite_hw_area_2_text_color', '#404040' )) ?>; } 
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'proper_lite_hw_area_2_link_color' ) ) : ?>
		.home-widget-two a { color: <?php echo esc_attr( get_theme_mod( 'proper_lite_hw_area_2_link_color', '#000000' )) ?>; } 
		<?php endif; ?> 
		
		<?php if ( get_theme_mod( 'proper_lite_hw_area_2_link_hover_color' ) ) : ?>
		.home-widget-two a:hover { color: <?php echo esc_attr( get_theme_mod( 'proper_lite_hw_area_2_link_hover_color', '#000000' )) ?>; } 
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'proper_lite_hw_area_2_button_color' ) ) : ?>
		.home-widget-two button { background: <?php echo esc_attr( get_theme_mod( 'proper_lite_hw_area_2_button_color', '#111111' )) ?>; } 
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'proper_lite_hw_area_2_button_color' ) ) : ?> 
		.home-widget-two button { border-color: <?php echo esc_attr( get_theme_mod( 'proper_lite_hw_area_2_button_color', '#111111' )) ?>; }   
		<?php endif; ?> 
		
		<?php if ( get_theme_mod( 'proper_lite_hw_area_2_button_hover_color' ) ) : ?>
		.home-widget-two button:hover { background: <?php echo esc_attr( get_theme_mod( 'proper_lite_hw_area_2_button_hover_color', '#444444' )) ?>; } 
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'proper_lite_hw_area_2_button_hover_color' ) ) : ?>
		.home-widget-two button:hover { border-color: <?php echo esc_attr( get_theme_mod( 'proper_lite_hw_area_2_button_hover_color', '#444444' )) ?>; } 
		<?php endif; ?> 
		
		
		
		<?php if ( get_theme_mod( 'proper_lite_footer_color' ) ) : ?>
		.site-footer { background: <?php echo esc_attr( get_theme_mod( 'proper_lite_footer_color', '#040404' )) ?>; } 
		<?php endif; ?> 
		
		<?php if ( get_theme_mod( 'proper_lite_footer_text_color' ) ) : ?>
		.site-footer, .site-footer p { color: <?php echo esc_attr( get_theme_mod( 'proper_lite_footer_text_color', '#cccccc' )) ?>; }
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'proper_lite_footer_heading_color' ) ) : ?>
		.site-footer h1, .site-footer h2, .site-footer h3, .site-footer h4, .site-footer h5, .site-footer h6 { color: <?php echo esc_attr( get_theme_mod( 'proper_lite_footer_heading_color', '#cccccc' )) ?>; } 
		<?php endif; ?>
		  
		<?php if ( get_theme_mod( 'proper_lite_footer_link_color' ) ) : ?>
		.site-footer a { color: <?php echo esc_attr( get_theme_mod( 'proper_lite_footer_link_color', '#ffffff' )) ?>; } 
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'proper_lite_footer_link_hover_color' ) ) : ?>
		.site-footer a:hover { color: <?php echo esc_attr( get_theme_mod( 'proper_lite_footer_link_hover_color', '#ffffff' )) ?>; } 
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'proper_lite_footer_button_color' ) ) : ?>
		.site-footer button { background: <?php echo esc_attr( get_theme_mod( 'proper_lite_footer_button_color', '#111111' )) ?>; } 
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'proper_lite_footer_button_color' ) ) : ?> 
		.site-footer button { border-color: <?php echo esc_attr( get_theme_mod( 'proper_lite_footer_button_color', '#111111' )) ?>; }   
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'proper_lite_footer_button_hover_color' ) ) : ?>
		.site-footer button:hover { background: <?php echo esc_attr( get_theme_mod( 'proper_lite_footer_button_hover_color', '#444444' )) ?>; } 
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'proper_lite_footer_button_hover_color' ) ) : ?>
		.site-footer button:hover { border-color: <?php echo esc_attr( get_theme_mod( 'proper_lite_footer_button_hover_color', '#444444' )) ?>; } 
		<?php endif; ?>
		
		
		
		
		<?php if ( get_theme_mod( 'proper_lite_text_color' ) ) : ?> 
		body, textarea, p { color: <?php echo esc_attr( get_theme_mod( 'proper_lite_text_color', '#404040' )) ?>; }
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'proper_lite_link_color' ) ) : ?>
		a { color: <?php echo esc_attr( get_theme_mod( 'proper_lite_link_color', '#000000' )) ?>; } 
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'proper_lite_hover_color' ) ) : ?>
		a:hover { color: <?php echo esc_attr( get_theme_mod( 'proper_lite_hover_color', '#999999' )) ?>; }
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'proper_lite_entry' ) ) : ?>
		.entry-title { color: <?php echo esc_attr( get_theme_mod( 'proper_lite_entry', '#ffffff' )) ?>; }
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'proper_lite_page_header' ) ) : ?>
		.page-entry-header { background-color: <?php echo esc_attr( get_theme_mod( 'proper_lite_page_header', '#222222' )) ?>; }
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'proper_lite_body_size' ) ) : ?>
		body, p { font-size: <?php echo esc_attr( get_theme_mod( 'proper_lite_body_size', '14' )) ?>px; } 
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'proper_lite_site_title_color' ) ) : ?>
		h1.site-title a { color: <?php echo esc_attr( get_theme_mod( 'proper_lite_site_title_color', '#ffffff' )) ?>; } 
		<?php endif; ?> 
		
		<?php if ( get_theme_mod( 'proper_lite_archive_border' ) ) : ?>
		#archive-content-container article { border-color: <?php echo esc_attr( get_theme_mod( 'proper_lite_archive_border', '#ededed' )) ?>; } 
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'proper_lite_archive_hover' ) ) : ?> 
		#archive-content-container article:hover { background: <?php echo esc_attr( get_theme_mod( 'proper_lite_archive_hover', '#f9f9f9' )) ?>; } 
		<?php endif; ?>
		
		
		
		<?php if ( get_theme_mod( 'proper_lite_social_color' ) ) : ?>
		.social-media-icons li .fa { color: <?php echo esc_attr( get_theme_mod( 'proper_lite_social_color', '#ffffff' )) ?>;  } 
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'proper_lite_social_color_hover' ) ) : ?>
		.social-media-icons li .fa:hover { color: <?php echo esc_attr( get_theme_mod( 'proper_lite_social_color_hover', '#999999' )) ?>; }
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'proper_lite_social_text_size' ) ) : ?> 
		.social-media-icons li .fa { font-size: <?php echo esc_attr( get_theme_mod( 'proper_lite_social_text_size', '20' )) ?>px; }
		<?php endif; ?>
		
		
		
		<?php if ( get_theme_mod( 'proper_lite_custom_color' ) ) : ?>
		button, input[type="button"], input[type="reset"], input[type="submit"] { background: <?php echo esc_attr( get_theme_mod( 'proper_lite_custom_color', '#111111' )) ?>; }  
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'proper_lite_custom_color' ) ) : ?> 
		button, input[type="button"], input[type="reset"], input[type="submit"] { border-color: <?php echo esc_attr( get_theme_mod( 'proper_lite_custom_color', '#111111' )) ?>; }   
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'proper_lite_custom_color_hover' ) ) : ?>
		button:hover, input[type="button"]:hover, input[type="reset"]:hover, input[type="submit"]:hover { background: <?php echo esc_attr( get_theme_mod( 'proper_lite_custom_color_hover', '#444444' )) ?>; }  
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'proper_lite_custom_color_hover' ) ) : ?>
		button:hover, input[type="button"]:hover, input[type="reset"]:hover, input[type="submit"]:hover { border-color: <?php echo esc_attr( get_theme_mod( 'proper_lite_custom_color_hover', '#444444' )) ?>; }   
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'proper_lite_slider_title' ) ) : ?>
		.hero-content-container .hero-content h2 { color: <?php echo esc_attr( get_theme_mod( 'proper_lite_slider_title', '#ffffff' )) ?>; }    
		<?php endif; ?> 
		
		<?php if ( get_theme_mod( 'proper_lite_slider_text_color' ) ) : ?>
		.hero-content-container .hero-content p { color: <?php echo esc_attr( get_theme_mod( 'proper_lite_slider_text_color', '#ffffff' )) ?>; }
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'proper_lite_slider_button_color' ) ) : ?>
		 .hero-content button { background-color: <?php echo esc_attr( get_theme_mod( 'proper_lite_slider_button_color', '#ffffff' )) ?>; }
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'proper_lite_slider_button_color_hover' ) ) : ?>
		 .hero-content button:hover { background-color: <?php echo esc_attr( get_theme_mod( 'proper_lite_slider_button_color_hover', '#ffffff' )) ?>; }
		<?php endif; ?> 
		
		
		<?php if ( get_theme_mod( 'proper_lite_plugin_service_page_icon_color' ) ) : ?>  
		  #mt-services .service-content .fa, .shortcodes .service-content .fa  { color: <?php echo esc_attr( get_theme_mod( 'proper_lite_plugin_service_page_icon_color', '#404040' )) ?>; }   
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'proper_lite_plugin_service_page_icon_bg_color' ) ) : ?> 
		  #mt-services .service-content .fa, .shortcodes .service-content .fa  { background-color: <?php echo esc_attr( get_theme_mod( 'proper_lite_plugin_service_page_icon_bg_color' )) ?>; }   
		<?php endif; ?> 
		
		<?php if ( get_theme_mod( 'proper_lite_plugin_service_page_icon_border_color' ) ) : ?>  
		  #mt-services .service-content .fa, .shortcodes .service-content .fa  { border-color: <?php echo esc_attr( get_theme_mod( 'proper_lite_plugin_service_page_icon_border_color', '#404040' )) ?>; }   
		<?php endif; ?> 
		
		<?php if ( get_theme_mod( 'proper_lite_plugin_project_hover_color' ) ) : ?> 
		 .project-box { background-color: <?php echo esc_attr( get_theme_mod( 'proper_lite_plugin_project_hover_color', '#151515' )) ?>; }  
		<?php endif; ?> 
		
		<?php if ( get_theme_mod( 'proper_lite_plugin_project_hover_text_color' ) ) : ?>
		.home-widget .project-box .project-content h3, .project-box .project-content h3 { color: <?php echo esc_attr( get_theme_mod( 'proper_lite_plugin_project_hover_text_color', '#ffffff' )) ?> !important; }   
		<?php endif; ?>
		
		
		<?php if ( get_theme_mod( 'proper_lite_plugin_team_icon_hover' ) ) : ?> 
		 .shortcodes .member .fa:hover  { color: <?php echo esc_attr( get_theme_mod( 'proper_lite_plugin_team_icon_hover', '#ffffff' )) ?>; }   
		<?php endif; ?>  
		
		<?php if ( get_theme_mod( 'proper_lite_plugin_team_icon_bg_hover' ) ) : ?> 
		 .shortcodes .member .fa:hover  { background-color: <?php echo esc_attr( get_theme_mod( 'proper_lite_plugin_team_icon_bg_hover', '#1f2023' )) ?>; }   
		<?php endif; ?> 
		
		<?php if ( get_theme_mod( 'proper_lite_plugin_team_icon_bg_hover' ) ) : ?> 
		 .shortcodes .member .fa:hover  { border-color: <?php echo esc_attr( get_theme_mod( 'proper_lite_plugin_team_icon_bg_hover', '#1f2023' )) ?>; }
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'proper_lite_plugin_team_icon_border' ) ) : ?> 
		 .shortcodes .member .fa  { border-color: <?php echo esc_attr( get_theme_mod( 'proper_lite_plugin_team_icon_border', '#1f2023' )) ?>; }   
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'proper_lite_plugin_team_icon' ) ) : ?> 
		 .shortcodes .member .fa  { color: <?php echo esc_attr( get_theme_mod( 'proper_lite_plugin_team_icon', '#1f2023' )) ?>; }  
		<?php endif; ?> 
		
		<?php if ( get_theme_mod( 'proper_lite_plugin_team_divider' ) ) : ?>
		.shortcodes .member h3::after { border-color: <?php echo esc_attr( get_theme_mod( 'proper_lite_plugin_team_divider', '#222222' )) ?>; }  
		<?php endif; ?> 
		
		
		
		<?php if ( get_theme_mod( 'proper_lite_plugin_testimonial_bg' ) ) : ?> 
		 #secondary > #mt-testimonials .testimonial p, .shortcodes .testimonial p  { background: <?php echo esc_attr( get_theme_mod( 'proper_lite_plugin_testimonial_bg', '#ffffff' )) ?>; }   
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'proper_lite_plugin_testimonial_text_color' ) ) : ?> 
		 #secondary > #mt-testimonials .testimonial p, .shortcodes .testimonial p  { color: <?php echo esc_attr( get_theme_mod( 'proper_lite_plugin_testimonial_text_color', '#404040' )) ?>; }
		<?php endif; ?>
		
		<?php if ( 'option1' == proper_lite_sanitize_index_content( get_theme_mod( 'proper_lite_plugin_testimonial_font_style' ) ) ) : ?>
		#secondary > #mt-testimonials .testimonial p, .shortcodes .testimonial p  { font-style: italic; } 
		<?php else : ?>
		#secondary > #mt-testimonials .testimonial p, .shortcodes .testimonial p  { font-style: normal; }
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'proper_lite_plugin_skill_color' ) ) : ?> 
		.progressBar div { background-color: <?php echo esc_attr( get_theme_mod( 'proper_lite_plugin_skill_color', '#12cc96' )) ?>; }   
		<?php endif; ?> 
		
		<?php if ( get_theme_mod( 'proper_lite_plugin_skill_bg_color' ) ) : ?> 
		.progressBar { background-color: <?php echo esc_attr( get_theme_mod( 'proper_lite_plugin_skill_bg_color', '#dddddd' )) ?>; }   
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'proper_lite_plugin_detail_icon_color' ) ) : ?> 
		#mt-details .fa { color: <?php echo esc_attr( get_theme_mod( 'proper_lite_plugin_detail_icon_color', '#404040' )) ?>; }   
		<?php endif; ?>   
		
		<?php if ( get_theme_mod( 'proper_lite_plugin_detail_text_color' ) ) : ?> 
		.odometer.odometer-auto-theme, .odometer.odometer-theme-default { color: <?php echo esc_attr( get_theme_mod( 'proper_lite_plugin_detail_text_color', '#404040' )) ?>; }   
		<?php endif; ?> 
		
		<?php if ( get_theme_mod( 'proper_lite_plugin_columns_icon_color' ) ) : ?> 
		#mt-columns .fa { color: <?php echo esc_attr( get_theme_mod( 'proper_lite_plugin_columns_icon_color', '#404040' )) ?>; }   
		<?php endif; ?> 
		
		<?php if ( get_theme_mod( 'proper_lite_plugin_columns_link_color' ) ) : ?> 
		#mt-columns a { color: <?php echo esc_attr( get_theme_mod( 'proper_lite_plugin_columns_link_color', '#000000' )) ?>; }   
		<?php endif; ?> 
		
		<?php if ( get_theme_mod( 'proper_lite_plugin_columns_hover_color' ) ) : ?> 
		#mt-columns a:hover { color: <?php echo esc_attr( get_theme_mod( 'proper_lite_plugin_columns_hover_color', '#999999' )) ?>; }   
		<?php endif; ?> 
		
		<?php if ( get_theme_mod( 'proper_lite_plugin_news_bg_color' ) ) : ?> 
		.news-box { background: <?php echo esc_attr( get_theme_mod( 'proper_lite_plugin_news_bg_color', '#f5f5f3' )) ?>; }   
		<?php endif; ?> 
		
		<?php if ( get_theme_mod( 'proper_lite_plugin_news_text_color' ) ) : ?> 
		.news-info h3 { color: <?php echo esc_attr( get_theme_mod( 'proper_lite_plugin_news_text_color', '#252525' )) ?>; }   
		<?php endif; ?> 
		
		<?php if ( get_theme_mod( 'proper_lite_plugin_news_date_color' ) ) : ?> 
		.news-info h6 { color: <?php echo esc_attr( get_theme_mod( 'proper_lite_plugin_news_date_color', '#636363' )) ?>; }   
		<?php endif; ?> 
		
		<?php if ( get_theme_mod( 'proper_lite_plugin_news_button_color' ) ) : ?> 
		.news-content button { background-color: <?php echo esc_attr( get_theme_mod( 'proper_lite_plugin_news_button_color', '#111111' )) ?>; }   
		<?php endif; ?> 
		
		<?php if ( get_theme_mod( 'proper_lite_plugin_news_button_color' ) ) : ?> 
		.news-content button { border-color: <?php echo esc_attr( get_theme_mod( 'proper_lite_plugin_news_button_color', '#111111' )) ?>; }   
		<?php endif; ?> 
		
		<?php if ( get_theme_mod( 'proper_lite_plugin_news_button_text_color' ) ) : ?> 
		.news-content button { color: <?php echo esc_attr( get_theme_mod( 'proper_lite_plugin_news_button_text_color', '#111111' )) ?>; }   
		<?php endif; ?> 
		
		<?php if ( get_theme_mod( 'proper_lite_plugin_news_button_hover_color' ) ) : ?> 
		.news-content button:hover { background-color: <?php echo esc_attr( get_theme_mod( 'proper_lite_plugin_news_button_hover_color', '#444444' )) ?>; }   
		<?php endif; ?> 
		
		<?php if ( get_theme_mod( 'proper_lite_plugin_news_button_hover_color' ) ) : ?> 
		.news-content button:hover { border-color: <?php echo esc_attr( get_theme_mod( 'proper_lite_plugin_news_button_hover_color', '#444444' )) ?>; }   
		<?php endif; ?> 
		
		<?php if ( 'option1' == proper_lite_sanitize_index_content( get_theme_mod( 'proper_lite_plugin_news_text_style' ) ) ) : ?>
		.news-info > div { text-align: left; }
		<?php else : ?>
		.news-info > div { text-align: center; }
		<?php endif; ?>
		
		<?php if ( get_theme_mod( 'proper_lite_button_text_color' ) ) : ?> 
		#home-hero button { color: <?php echo esc_attr( get_theme_mod( 'proper_lite_button_text_color', '#ffffff' )) ?>; }
		<?php endif; ?> 
		
		<?php if ( get_theme_mod( 'proper_lite_button_bg_color' ) ) : ?> 
		#home-hero button { background-color: <?php echo esc_attr( get_theme_mod( 'proper_lite_button_bg_color', '#111111' )) ?>; }
		<?php endif; ?> 
		
		<?php if ( get_theme_mod( 'proper_lite_button_bg_color' ) ) : ?> 
		#home-hero button { border-color: <?php echo esc_attr( get_theme_mod( 'proper_lite_button_bg_color', '#111111' )) ?>; }
		<?php endif; ?> 
		
		<?php if ( get_theme_mod( 'proper_lite_button_hover_color' ) ) : ?> 
		#home-hero button:hover { border-color: <?php echo esc_attr( get_theme_mod( 'proper_lite_button_hover_color', '#444444' )) ?>; }
		<?php endif; ?> 
		
		<?php if ( get_theme_mod( 'proper_lite_button_hover_color' ) ) : ?> 
		#home-hero button:hover { background-color: <?php echo esc_attr( get_theme_mod( 'proper_lite_button_hover_color', '#444444' )) ?>; }
		<?php endif; ?>
		
		  
	</style>
<?php }


add_action( 'wp_head', 'proper_lite_add_customizer_css' );

