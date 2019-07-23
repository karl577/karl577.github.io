<?php

//////////////////////////////////////////////////////////////////
// Customizer - Add Settings
//////////////////////////////////////////////////////////////////
function shaped_blog_register_theme_customizer( $wp_customize ) {
 	
	// Add Sections
	$wp_customize->add_section( 'shaped_blog_new_section_custom_css' , array(
   		'title'      => __('Custom CSS', 'shaped-blog'),
   		'description'=> __('Add your custom CSS which will overwrite the theme CSS', 'shaped-blog'),
   		'priority'   => 100,
	) );
	$wp_customize->add_section( 'shaped_blog_new_section_footer' , array(
   		'title'      => __('Footer Settings', 'shaped-blog'),
   		'priority'   => 99,
	) );
	$wp_customize->add_section( 'shaped_blog_new_section_social' , array(
   		'title'      => __('Social Media Settings', 'shaped-blog'),
   		'description'=> __('Enter your social media usernames. Icons will not show if left blank.', 'shaped-blog'),
   		'priority'   => 98,
	) );
	$wp_customize->add_section( 'shaped_blog_new_section_general' , array(
   		'title'      => __('General Settings', 'shaped-blog'),
   		'priority'   => 97,
	) );
	
	
	
	// Add Setting
		
		// General

		$wp_customize->add_setting(
	        'shaped_blog_home_layout',
	        array(
	            'default'     => 'rightsidebar',
	            'sanitize_callback' => 'esc_attr'
	        )
	    );

		$wp_customize->add_setting(
	        'shaped_blog_pagination',
	        array(
	            'default'     => 'pagination',
	            'sanitize_callback' => 'esc_attr'
	        )
	    );

		$wp_customize->add_setting(
	        'shaped_blog_preloader',
	        array(
	            'default'     => false,
	            'sanitize_callback' => 'esc_attr'
	        )
	    );

		
		// Logo
		$wp_customize->add_setting(
	        'shaped_blog_logo',
	        array(
	        	'sanitize_callback' => 'esc_url'
	        )
	    );


		
		// Social Media

		$wp_customize->add_setting(
	        'shaped_blog_footer_social_check',
	        array(
	            'default'     => false,
	            'sanitize_callback' => 'esc_attr'
	        )
	    );
		
		$wp_customize->add_setting(
	        'shaped_blog_facebook',
	        array(
	            'default'     => '',
	            'sanitize_callback' => 'esc_url'
	        )
	    );
		$wp_customize->add_setting(
	        'shaped_blog_twitter',
	        array(
	            'default'     => '',
	            'sanitize_callback' => 'esc_url'
	        )
	    );
		$wp_customize->add_setting(
	        'shaped_blog_google',
	        array(
	            'default'     => '',
	            'sanitize_callback' => 'esc_url'
	        )
	    );
		$wp_customize->add_setting(
	        'shaped_blog_youtube',
	        array(
	            'default'     => '',
	            'sanitize_callback' => 'esc_url'
	        )
	    );
		$wp_customize->add_setting(
	        'shaped_blog_skype',
	        array(
	            'default'     => '',
	            'sanitize_callback' => 'esc_url'
	        )
	    );
		$wp_customize->add_setting(
	        'shaped_blog_pinterest',
	        array(
	            'default'     => '',
	            'sanitize_callback' => 'esc_url'
	        )
	    );
		$wp_customize->add_setting(
	        'shaped_blog_flickr',
	        array(
	            'default'     => '',
	            'sanitize_callback' => 'esc_url'
	        )
	    );
		$wp_customize->add_setting(
	        'shaped_blog_linkedin',
	        array(
	            'default'     => '',
	            'sanitize_callback' => 'esc_url'
	        )
	    );
		$wp_customize->add_setting(
	        'shaped_blog_vimeo',
	        array(
	            'default'     => '',
	            'sanitize_callback' => 'esc_url'
	        )
	    );
		$wp_customize->add_setting(
	        'shaped_blog_instagram',
	        array(
	            'default'     => '',
	            'sanitize_callback' => 'esc_url'
	        )
	    );
		$wp_customize->add_setting(
	        'shaped_blog_dribbble',
	        array(
	            'default'     => '',
	            'sanitize_callback' => 'esc_url'
	        )
	    );
		$wp_customize->add_setting(
	        'shaped_blog_tumblr',
	        array(
	            'default'     => '',
	            'sanitize_callback' => 'esc_url'
	        )
	    );



		
		// Footer Options

		$wp_customize->add_setting(
	        'shaped_blog_back_to_top',
	        array(
	            'default'     => false,
	            'sanitize_callback' => 'esc_attr'
	        )
	    );
		$wp_customize->add_setting(
	        'shaped_blog_footer_copyright',
	        array(
	            'sanitize_callback' => 'wp_kses'
	        )
	    );
		
		// Color Options

			// Color general
			$wp_customize->add_setting(
				'shaped_blog_theme_color',
				array(
					'default'     => '#68c3a3',
					'sanitize_callback' => 'sanitize_hex_color'
				)
			);
			$wp_customize->add_setting(
				'shaped_blog_anchor_color',
				array(
					'default'     => '#68c3a3',
					'sanitize_callback' => 'sanitize_hex_color'
				)
			);
			$wp_customize->add_setting(
				'shaped_blog_anchor_hover_color',
				array(
					'default'     => '#48A987',
					'sanitize_callback' => 'sanitize_hex_color'
				)
			);
			
			// Custom CSS
			$wp_customize->add_setting(
				'shaped_blog_custom_css',
				array(
					'sanitize_callback' => 'wp_strip_all_tags'
				)
			);


    // Add Control
		
		// General
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'shaped_blog_home_layout',
				array(
					'label'          => __('Home Layout', 'shaped-blog'),
					'section'        => 'shaped_blog_new_section_general',
					'settings'       => 'shaped_blog_home_layout',
					'type'           => 'select',
					'priority'	 => 2,
					'choices'        => array(
						'col-md-12'   => __('Full Posts', 'shaped-blog'),
						'col-md-8'  => __('Right Sidebar', 'shaped-blog'),
						'col-md-8 col-md-push-4'  => __('Left Sidebar', 'shaped-blog')
					)
				)
			)
		);
		
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'shaped_blog_pagination',
				array(
					'label'          => __('Blog Pagination or Navigation', 'shaped-blog'),
					'section'        => 'shaped_blog_new_section_general',
					'settings'       => 'shaped_blog_pagination',
					'type'           => 'radio',
					'priority'	 => 5,
					'choices'        => array(
						'pagination'   => __('Pagination', 'shaped-blog'),
						'navigation'  => __('Navigation', 'shaped-blog')
					)
				)
			)
		);
		
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'shaped_blog_preloader',
				array(
					'label'      => __('Disable Preloader', 'shaped-blog'),
					'section'    => 'shaped_blog_new_section_general',
					'settings'   => 'shaped_blog_preloader',
					'type'		 => 'checkbox',
					'priority'	 => 6
				)
			)
		);
		
		// Logo
		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'shaped_blog_logo',
				array(
					'label'      => __('Upload Logo', 'shaped-blog'),
					'section'    => 'title_tagline',
					'settings'   => 'shaped_blog_logo',
					'priority'	 => 60
				)
			)
		);
		
		
		
		// Social Media
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'shaped_blog_footer_social_check',
				array(
					'label'      => __('Disable Top Social Icons', 'shaped-blog'),
					'section'    => 'shaped_blog_new_section_social',
					'settings'   => 'shaped_blog_footer_social_check',
					'type'		 => 'checkbox',
					'priority'	 => 1
				)
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'shaped_blog_facebook',
				array(
					'label'      => __('Facebook', 'shaped-blog'),
					'section'    => 'shaped_blog_new_section_social',
					'settings'   => 'shaped_blog_facebook',
					'type'		 => 'text',
					'priority'	 => 2
				)
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'shaped_blog_twitter',
				array(
					'label'      => __('Twitter', 'shaped-blog'),
					'section'    => 'shaped_blog_new_section_social',
					'settings'   => 'shaped_blog_twitter',
					'type'		 => 'text',
					'priority'	 => 3
				)
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'shaped_blog_google',
				array(
					'label'      => __('Google Plus', 'shaped-blog'),
					'section'    => 'shaped_blog_new_section_social',
					'settings'   => 'shaped_blog_google',
					'type'		 => 'text',
					'priority'	 => 4
				)
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'shaped_blog_youtube',
				array(
					'label'      => __('Youtube', 'shaped-blog'),
					'section'    => 'shaped_blog_new_section_social',
					'settings'   => 'shaped_blog_youtube',
					'type'		 => 'text',
					'priority'	 => 5
				)
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'shaped_blog_skype',
				array(
					'label'      => __('Skype', 'shaped-blog'),
					'section'    => 'shaped_blog_new_section_social',
					'settings'   => 'shaped_blog_skype',
					'type'		 => 'text',
					'priority'	 => 6
				)
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'shaped_blog_pinterest',
				array(
					'label'      => __('Pinterest', 'shaped-blog'),
					'section'    => 'shaped_blog_new_section_social',
					'settings'   => 'shaped_blog_pinterest',
					'type'		 => 'text',
					'priority'	 => 7
				)
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'shaped_blog_flickr',
				array(
					'label'      => __('Flickr', 'shaped-blog'),
					'section'    => 'shaped_blog_new_section_social',
					'settings'   => 'shaped_blog_flickr',
					'type'		 => 'text',
					'priority'	 => 8
				)
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'shaped_blog_linkedin',
				array(
					'label'      => __('Linkedin', 'shaped-blog'),
					'section'    => 'shaped_blog_new_section_social',
					'settings'   => 'shaped_blog_linkedin',
					'type'		 => 'text',
					'priority'	 => 9
				)
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'shaped_blog_vimeo',
				array(
					'label'      => __('Vimeo', 'shaped-blog'),
					'section'    => 'shaped_blog_new_section_social',
					'settings'   => 'shaped_blog_vimeo',
					'type'		 => 'text',
					'priority'	 => 10
				)
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'shaped_blog_instagram',
				array(
					'label'      => __('Instagram', 'shaped-blog'),
					'section'    => 'shaped_blog_new_section_social',
					'settings'   => 'shaped_blog_instagram',
					'type'		 => 'text',
					'priority'	 => 11
				)
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'shaped_blog_dribbble',
				array(
					'label'      => __('Dribbble', 'shaped-blog'),
					'section'    => 'shaped_blog_new_section_social',
					'settings'   => 'shaped_blog_dribbble',
					'type'		 => 'text',
					'priority'	 => 12
				)
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'shaped_blog_tumblr',
				array(
					'label'      => __('Tumblr', 'shaped-blog'),
					'section'    => 'shaped_blog_new_section_social',
					'settings'   => 'shaped_blog_tumblr',
					'type'		 => 'text',
					'priority'	 => 13
				)
			)
		);


		
		// Footer Settings

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'shaped_blog_back_to_top',
				array(
					'label'      => __('Disable Back to top', 'shaped-blog'),
					'section'    => 'shaped_blog_new_section_footer',
					'settings'   => 'shaped_blog_back_to_top',
					'type'		 => 'checkbox',
					'priority'	 => 1
				)
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'shaped_blog_footer_copyright',
				array(
					'label'      => __('Footer Copyright Text', 'shaped-blog'),
					'section'    => 'shaped_blog_new_section_footer',
					'settings'   => 'shaped_blog_footer_copyright',
					'type'		 => 'text',
					'priority'	 => 2
				)
			)
		);
		
		// Color Settings
			
			// Colors general
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'shaped_blog_theme_color',
					array(
						'label'      => __('Theme Color', 'shaped-blog'),
						'section'    => 'colors',
						'settings'   => 'shaped_blog_theme_color',
						'priority'	 => 1
					)
				)
			);
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'shaped_blog_anchor_color',
					array(
						'label'      => __('Anchor Color', 'shaped-blog'),
						'section'    => 'colors',
						'settings'   => 'shaped_blog_anchor_color',
						'priority'	 => 2
					)
				)
			);
			$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					'shaped_blog_anchor_hover_color',
					array(
						'label'      => __('Anchor Hover Color', 'shaped-blog'),
						'section'    => 'colors',
						'settings'   => 'shaped_blog_anchor_hover_color',
						'priority'	 => 3
					)
				)
			);
			
			// Custom CSS
			$wp_customize->add_control(
				new WP_Customize_Control(
					$wp_customize,
					'shaped_blog_custom_css',
					array(
						'label'      => __('Custom CSS', 'shaped-blog'),
						'section'    => 'shaped_blog_new_section_custom_css',
						'settings'   => 'shaped_blog_custom_css',
						'type'		 => 'textarea',
						'priority'	 => 1
					)
				)
			);
		
	

	// Remove Sections
	$wp_customize->remove_section( 'nav');
	$wp_customize->remove_section( 'static_front_page');
	
 
}
add_action( 'customize_register', 'shaped_blog_register_theme_customizer' );
?>