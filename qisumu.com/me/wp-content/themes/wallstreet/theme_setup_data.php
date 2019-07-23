<?php
function theme_data_setup()
{
	$slider_image = WEBRITI_TEMPLATE_DIR_URI . "/images/slider.jpg";
	$service_image1 = WEBRITI_TEMPLATE_DIR_URI . "/images/service.jpg";
	$service_image2 = WEBRITI_TEMPLATE_DIR_URI . "/images/service2.jpg";
	$service_image3 = WEBRITI_TEMPLATE_DIR_URI . "/images/service3.jpg";
	$portfolio_image1 = WEBRITI_TEMPLATE_DIR_URI . "/images/portfolio1.jpg";
	$portfolio_image2 = WEBRITI_TEMPLATE_DIR_URI . "/images/portfolio2.jpg";
	$portfolio_image3 = WEBRITI_TEMPLATE_DIR_URI . "/images/portfolio3.jpg";
	$portfolio_image4 = WEBRITI_TEMPLATE_DIR_URI . "/images/portfolio4.jpg";
	
	return $theme_options=array(
			//Logo and Fevicon header					
			'upload_image_logo'=>'',
			'height'=>'50',
			'width'=>'250',
			'text_title'=>'on',
			'upload_image_favicon'=>'',
			'webrit_custom_css'=>'',
			
			//Featured Image Setting
			'home_banner_enabled'=>'on',
			'slider_title_one' => __('Clean & fresh theme','wallstreet'),
			'slider_title_two' => __('Welcome to WallStreet','wallstreet'),
			'slider_description' => __('State-of-the-art HTML5-powered flexible layout with lightspeed fast CSS3 transition effects. Works perfectly on any modern mobile device.','wallstreet'),
			'slider_image' => $slider_image,
			
			// service
			'service_section_enabled' => true,
			
			'service_image_one' => $service_image1, 
			'service_title_one'=> __('Product Design','wallstreet'),
			'service_description_one' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.Lorem ipsum dolor sit amet, consectetur adipisicing elit dignissim dapib tumst dign eger porta nisl.',
			
			'service_image_two' => $service_image2, 
			'service_title_two'=> __('WordPress themes','wallstreet'),
			'service_description_two' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.Lorem ipsum dolor sit amet, consectetur adipisicing elit dignissim dapib tumst dign eger porta nisl.',
			
			'service_image_three' => $service_image3, 
			'service_title_three'=> __('Responsive designs','wallstreet'),
			'service_description_three' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.Lorem ipsum dolor sit amet, consectetur adipisicing elit dignissim dapib tumst dign eger porta nisl.',
			
			//portfolio
			'portfolio_section_enabled' => true,
			
			'portfolio_title_one' => __('WallStreet style','wallstreet'),
			'portfolio_description_one' => __('A wonderful serenity has taken possession of my entire soul, like these sweet mornings.','wallstreet'),
			'portfolio_image_one' => $portfolio_image1,
			
			'portfolio_title_two' => __('WallStreet style','wallstreet'),
			'portfolio_description_two' => __('A wonderful serenity has taken possession of my entire soul, like these sweet mornings.','wallstreet'),
			'portfolio_image_two' => $portfolio_image2,
			
			'portfolio_title_three' => __('WallStreet style','wallstreet'),
			'portfolio_description_three' => __('A wonderful serenity has taken possession of my entire soul, like these sweet mornings.','wallstreet'),
			'portfolio_image_three' => $portfolio_image3,
			
			'portfolio_title_four' => __('WallStreet style','wallstreet'),
			'portfolio_description_four' => __('A wonderful serenity has taken possession of my entire soul, like these sweet mornings.','wallstreet'),
			'portfolio_image_four' => $portfolio_image4,
			
			//Home blog
			'blog_section_enabled' => 'on',
			
			// Head Titles
			'contact_header_settings' => true,
			'contact_phone_number' => '1-800-123-789',
			'contact_email' => 'info@webriti.com',
			'service_title' => __('Our services','wallstreet'),
			'service_description' => __('We offer great services to our clients.','wallstreet'),
			'portfolio_title' => __('Featured portfolio project','wallstreet'),
			'portfolio_description' => __('Our most popular work','wallstreet'),
			'home_blog_heading'=> __('Our latest blog post','wallstreet'),
			'home_blog_description' => __('We work with new customers and grow their business.','wallstreet'),
			
			/** Social media links **/
			'header_social_media_enabled'=>'on',			
			'footer_social_media_enabled'=>'on',			
			'social_media_twitter_link' =>"#",			
			'social_media_facebook_link' =>"#",
			'social_media_googleplus_link' =>"#",
			'social_media_linkedin_link' =>"#",		
			'social_media_youtube_link' =>"#",
			
			/** footer customization **/
			'footer_copyright' =>sprintf (__('Copyright @ 2017 - WALL STREET Designed by <a href="%1$s" target="_blank">Webriti</a>.','wallstreet'),'http://www.webriti.com'),
		
		);
}
?>