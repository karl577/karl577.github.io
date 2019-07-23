<?php
/**
 * protopress Theme Customizer
 *
 * @package protopress
 */
/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function protopress_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	
	
	
	//Logo Settings
	$wp_customize->add_section( 'title_tagline' , array(
	    'title'      => __( 'Title, Tagline & Logo', 'protopress' ),
	    'priority'   => 30,
	) );
	
	$wp_customize->add_setting( 'protopress_logo' , array(
	    'default'     => '',
	    'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control(
	    new WP_Customize_Image_Control(
	        $wp_customize,
	        'protopress_logo',
	        array(
	            'label' => __('Upload Logo','protopress'),
	            'section' => 'title_tagline',
	            'settings' => 'protopress_logo',
	            'priority' => 5,
	        )
		)
	);
	
	$wp_customize->add_setting( 'protopress_logo_resize' , array(
	    'default'     => 100,
	    'sanitize_callback' => 'protopress_sanitize_positive_number',
	) );
	$wp_customize->add_control(
	        'protopress_logo_resize',
	        array(
	            'label' => __('Resize & Adjust Logo','protopress'),
	            'section' => 'title_tagline',
	            'settings' => 'protopress_logo_resize',
	            'priority' => 6,
	            'type' => 'range',
	            'active_callback' => 'protopress_logo_enabled',
	            'input_attrs' => array(
			        'min'   => 30,
			        'max'   => 200,
			        'step'  => 5,
			    ),
	        )
	);
	
	function protopress_logo_enabled($control) {
		$option = $control->manager->get_setting('protopress_logo');
		return $option->value() == true;
	}
	
	
	
	//Replace Header Text Color with, separate colors for Title and Description
	//Override protopress_site_titlecolor
	$wp_customize->remove_control('display_header_text');
	$wp_customize->remove_setting('header_textcolor');
	$wp_customize->add_setting('protopress_site_titlecolor', array(
	    'default'     => '#e10d0d',
	    'sanitize_callback' => 'sanitize_hex_color',
	));
	
	$wp_customize->add_control(new WP_Customize_Color_Control( 
		$wp_customize, 
		'protopress_site_titlecolor', array(
			'label' => __('Site Title Color','protopress'),
			'section' => 'colors',
			'settings' => 'protopress_site_titlecolor',
			'type' => 'color'
		) ) 
	);
	
	$wp_customize->add_setting('protopress_header_desccolor', array(
	    'default'     => '#777',
	    'sanitize_callback' => 'sanitize_hex_color',
	));
	
	$wp_customize->add_control(new WP_Customize_Color_Control( 
		$wp_customize, 
		'protopress_header_desccolor', array(
			'label' => __('Site Tagline Color','protopress'),
			'section' => 'colors',
			'settings' => 'protopress_header_desccolor',
			'type' => 'color'
		) ) 
	);
	
	//Settings for Nav Area
	$wp_customize->add_section(
	    'protopress_menu_basic',
	    array(
	        'title'     => __('Menu Settings','protopress'),
	        'priority'  => 0,
	        'panel'     => 'nav_menus'
	    )
	);
	
	$wp_customize->add_setting( 'protopress_disable_nav_desc' , array(
	    'default'     => true,
	    'sanitize_callback' => 'protopress_sanitize_checkbox',
	) );
	
	$wp_customize->add_control(
	'protopress_disable_nav_desc', array(
		'label' => __('Disable Description of Menu Items','protopress'),
		'section' => 'protopress_menu_basic',
		'settings' => 'protopress_disable_nav_desc',
		'type' => 'checkbox'
	) );
	
	$wp_customize->add_setting( 'protopress_disable_active_nav' , array(
	    'default'     => true,
	    'sanitize_callback' => 'protopress_sanitize_checkbox',
	) );
	
	$wp_customize->add_control(
	'protopress_disable_active_nav', array(
		'label' => __('Disable Highlighting of Current Active Item on the Menu.','protopress'),
		'section' => 'nav',
		'settings' => 'protopress_disable_active_nav',
		'type' => 'checkbox'
	) );
	
	//Settings for Header Image
	$wp_customize->add_setting( 'protopress_himg_style' , array(
	    'default'     => true,
	    'sanitize_callback' => 'protopress_sanitize_himg_style'
	) );
	
	/* Sanitization Function */
	function protopress_sanitize_himg_style( $input ) {
		if (in_array( $input, array('contain','cover') ) )
			return $input;
		else
			return '';	
	}
	
	$wp_customize->add_control(
	'protopress_himg_style', array(
		'label' => __('Header Image Arrangement','protopress'),
		'section' => 'header_image',
		'settings' => 'protopress_himg_style',
		'type' => 'select',
		'choices' => array(
				'contain' => __('Contain','protopress'),
				'cover' => __('Cover Completely','protopress'),
				)
	) );
	
	$wp_customize->add_setting( 'protopress_himg_align' , array(
	    'default'     => true,
	    'sanitize_callback' => 'protopress_sanitize_himg_align'
	) );
	
	/* Sanitization Function */
	function protopress_sanitize_himg_align( $input ) {
		if (in_array( $input, array('center','left','right') ) )
			return $input;
		else
			return '';	
	}
	
	$wp_customize->add_control(
	'protopress_himg_align', array(
		'label' => __('Header Image Alignment','protopress'),
		'section' => 'header_image',
		'settings' => 'protopress_himg_align',
		'type' => 'select',
		'choices' => array(
				'center' => __('Center','protopress'),
				'left' => __('Left','protopress'),
				'right' => __('Right','protopress'),
			)
		
	) );
	
	$wp_customize->add_setting( 'protopress_himg_repeat' , array(
	    'default'     => true,
	    'sanitize_callback' => 'protopress_sanitize_checkbox'
	) );
	
	$wp_customize->add_control(
	'protopress_himg_repeat', array(
		'label' => __('Repeat Header Image','protopress'),
		'section' => 'header_image',
		'settings' => 'protopress_himg_repeat',
		'type' => 'checkbox',
	) );
	
	
	//Settings For Logo Area
	
	$wp_customize->add_setting(
		'protopress_hide_title_tagline',
		array( 'sanitize_callback' => 'protopress_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'protopress_hide_title_tagline', array(
		    'settings' => 'protopress_hide_title_tagline',
		    'label'    => __( 'Hide Title and Tagline.', 'protopress' ),
		    'section'  => 'title_tagline',
		    'type'     => 'checkbox',
		)
	);
	
	$wp_customize->add_setting(
		'protopress_branding_below_logo',
		array( 'sanitize_callback' => 'protopress_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'protopress_branding_below_logo', array(
		    'settings' => 'protopress_branding_below_logo',
		    'label'    => __( 'Display Site Title and Tagline Below the Logo.', 'protopress' ),
		    'section'  => 'title_tagline',
		    'type'     => 'checkbox',
		    'active_callback' => 'protopress_title_visible'
		)
	);
	
	function protopress_title_visible( $control ) {
		$option = $control->manager->get_setting('protopress_hide_title_tagline');
	    return $option->value() == false ;
	}
	
	$wp_customize->add_setting(
		'protopress_center_logo',
		array( 'sanitize_callback' => 'protopress_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'protopress_center_logo', array(
		    'settings' => 'protopress_center_logo',
		    'label'    => __( 'Center Align.', 'protopress' ),
		    'section'  => 'title_tagline',
		    'type'     => 'checkbox',
		)
	);
	
	
	
	// SLIDER PANEL
	$wp_customize->add_panel( 'protopress_slider_panel', array(
	    'priority'       => 35,
	    'capability'     => 'edit_theme_options',
	    'theme_supports' => '',
	    'title'          => 'Main Slider',
	) );
	
	$wp_customize->add_section(
	    'protopress_sec_slider_options',
	    array(
	        'title'     => 'Enable/Disable',
	        'priority'  => 0,
	        'panel'     => 'protopress_slider_panel'
	    )
	);
	
	
	$wp_customize->add_setting(
		'protopress_main_slider_enable',
		array( 'sanitize_callback' => 'protopress_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'protopress_main_slider_enable', array(
		    'settings' => 'protopress_main_slider_enable',
		    'label'    => __( 'Enable Slider.', 'protopress' ),
		    'section'  => 'protopress_sec_slider_options',
		    'type'     => 'checkbox',
		)
	);
	
	$wp_customize->add_setting(
		'protopress_main_slider_count',
			array(
				'default' => '0',
				'sanitize_callback' => 'protopress_sanitize_positive_number'
			)
	);
	
	// Select How Many Slides the User wants, and Reload the Page.
	$wp_customize->add_control(
			'protopress_main_slider_count', array(
		    'settings' => 'protopress_main_slider_count',
		    'label'    => __( 'No. of Slides(Min:0, Max: 10)' ,'protopress'),
		    'section'  => 'protopress_sec_slider_options',
		    'type'     => 'number',
		    'description' => __('Save the Settings, and Reload this page to Configure the Slides.','protopress'),
		    
		)
	);
	
	
	$wp_customize->add_section(
	    'protopress_sec_upgrade',
	    array(
	        'title'     => __('Discover ProtoPress Pro','protopress'),
	        'priority'  => 45,
	    )
	);
	
	$wp_customize->add_setting(
			'protopress_upgrade',
			array( 'sanitize_callback' => 'esc_textarea' )
		);
			
	$wp_customize->add_control(
	    new WP_Customize_Upgrade_Control(
	        $wp_customize,
	        'protopress_upgrade',
	        array(
	            'label' => __('More of Everything','protopress'),
	            'description' => __('ProtoPress Pro has more of Everything. More New Features, More Options, More Colors, More Fonts, More Layouts, Configurable Slider, Inbuilt Advertising Options, Multiple Skins, More Widgets, and a lot more options and comes with Dedicated Support. To Know More about the Pro Version, click here: <a href="http://rohitink.com/product/protopress-pro/">Upgrade to Pro</a>.','protopress'),
	            'section' => 'protopress_sec_upgrade',
	            'settings' => 'protopress_upgrade',			       
	        )
		)
	);
		
	
	if ( get_theme_mod('protopress_main_slider_count') > 0 ) :
		$slides = get_theme_mod('protopress_main_slider_count');
		
		for ( $i = 1 ; $i <= $slides ; $i++ ) :
			
			//Create the settings Once, and Loop through it.
			
			$wp_customize->add_setting(
				'protopress_slide_img'.$i,
				array( 'sanitize_callback' => 'esc_url_raw' )
			);
			
			$wp_customize->add_control(
			    new WP_Customize_Image_Control(
			        $wp_customize,
			        'protopress_slide_img'.$i,
			        array(
			            'label' => '',
			            'section' => 'protopress_slide_sec'.$i,
			            'settings' => 'protopress_slide_img'.$i,			       
			        )
				)
			);
			
			
			$wp_customize->add_section(
			    'protopress_slide_sec'.$i,
			    array(
			        'title'     => 'Slide '.$i,
			        'priority'  => $i,
			        'panel'     => 'protopress_slider_panel'
			    )
			);
			
			$wp_customize->add_setting(
				'protopress_slide_title'.$i,
				array( 'sanitize_callback' => 'sanitize_text_field' )
			);
			
			$wp_customize->add_control(
					'protopress_slide_title'.$i, array(
				    'settings' => 'protopress_slide_title'.$i,
				    'label'    => __( 'Slide Title','protopress' ),
				    'section'  => 'protopress_slide_sec'.$i,
				    'type'     => 'text',
				)
			);
			
			$wp_customize->add_setting(
				'protopress_slide_desc'.$i,
				array( 'sanitize_callback' => 'sanitize_text_field' )
			);
			
			$wp_customize->add_control(
					'protopress_slide_desc'.$i, array(
				    'settings' => 'protopress_slide_desc'.$i,
				    'label'    => __( 'Slide Description','protopress' ),
				    'section'  => 'protopress_slide_sec'.$i,
				    'type'     => 'text',
				)
			);
			
			
			
			$wp_customize->add_setting(
				'protopress_slide_CTA_button'.$i,
				array( 'sanitize_callback' => 'sanitize_text_field' )
			);
			
			$wp_customize->add_control(
					'protopress_slide_CTA_button'.$i, array(
				    'settings' => 'protopress_slide_CTA_button'.$i,
				    'label'    => __( 'Custom Call to Action Button Text(Optional)','protopress' ),
				    'section'  => 'protopress_slide_sec'.$i,
				    'type'     => 'text',
				)
			);
			
			$wp_customize->add_setting(
				'protopress_slide_url'.$i,
				array( 'sanitize_callback' => 'esc_url_raw' )
			);
			
			$wp_customize->add_control(
					'protopress_slide_url'.$i, array(
				    'settings' => 'protopress_slide_url'.$i,
				    'label'    => __( 'Target URL','protopress' ),
				    'section'  => 'protopress_slide_sec'.$i,
				    'type'     => 'url',
				)
			);
			
		endfor;
	
	
	endif;
	
	

	
	// CREATE THE FCA PANEL
	$wp_customize->add_panel( 'protopress_fca_panel', array(
	    'priority'       => 40,
	    'capability'     => 'edit_theme_options',
	    'theme_supports' => '',
	    'title'          => 'Featured Content Areas',
	    'description'    => '',
	) );
	
	
	//SQUARE BOXES
	$wp_customize->add_section(
	    'protopress_fc_boxes',
	    array(
	        'title'     => 'Square Boxes',
	        'priority'  => 10,
	        'panel'     => 'protopress_fca_panel'
	    )
	);
	
	$wp_customize->add_setting(
		'protopress_box_enable',
		array( 'sanitize_callback' => 'protopress_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'protopress_box_enable', array(
		    'settings' => 'protopress_box_enable',
		    'label'    => __( 'Enable Square Boxes & Posts Slider.', 'protopress' ),
		    'section'  => 'protopress_fc_boxes',
		    'type'     => 'checkbox',
		)
	);
	
 
	$wp_customize->add_setting(
		'protopress_box_title',
		array( 'sanitize_callback' => 'sanitize_text_field' )
	);
	
	$wp_customize->add_control(
			'protopress_box_title', array(
		    'settings' => 'protopress_box_title',
		    'label'    => __( 'Title for the Boxes','protopress' ),
		    'section'  => 'protopress_fc_boxes',
		    'type'     => 'text',
		)
	);
 
 	$wp_customize->add_setting(
	    'protopress_box_cat',
	    array( 'sanitize_callback' => 'protopress_sanitize_category' )
	);
	
	$wp_customize->add_control(
	    new WP_Customize_Category_Control(
	        $wp_customize,
	        'protopress_box_cat',
	        array(
	            'label'    => 'Category For Square Boxes.',
	            'settings' => 'protopress_box_cat',
	            'section'  => 'protopress_fc_boxes'
	        )
	    )
	);
	
		
	//SLIDER
	$wp_customize->add_section(
	    'protopress_fc_slider',
	    array(
	        'title'     => __('Posts Slider','protopress'),
	        'priority'  => 10,
	        'panel'     => 'protopress_fca_panel',
	        'description' => 'This is the Posts Slider, displayed along with square boxes.',
	    )
	);
	
	
	$wp_customize->add_setting(
		'protopress_slider_title',
		array( 'sanitize_callback' => 'sanitize_text_field' )
	);
	
	$wp_customize->add_control(
			'protopress_slider_title', array(
		    'settings' => 'protopress_slider_title',
		    'label'    => __( 'Title for the Slider', 'protopress' ),
		    'section'  => 'protopress_fc_slider',
		    'type'     => 'text',
		)
	);
	
	
	
/*
	// SETTING TO BE ADDED IN A FUTURE UPDATE.
	
	$wp_customize->add_setting(
		'slider_type'
		array( 'sanitize_callback' => 'protopress_sanitize_slidertype' )
	);
	
	$wp_customize->add_control(
			'slider_type', array(
		    'settings' => 'slider_type',
		    'label'    => __( 'Choose Slider' ),
		    'section'  => 'fc_slider',
		    'type'     => 'select',
		    'choices'  => array(
		    				'3d' => '3D Slider',
		    				'bx' => 'BX Slider'),
		)
	);
*/
	
	$wp_customize->add_setting(
		'protopress_slider_count',
		array( 'sanitize_callback' => 'protopress_sanitize_positive_number' )
	);
	
	$wp_customize->add_control(
			'protopress_slider_count', array(
		    'settings' => 'protopress_slider_count',
		    'label'    => __( 'No. of Posts(Min:3, Max: 10)', 'protopress' ),
		    'section'  => 'protopress_fc_slider',
		    'type'     => 'range',
		    'input_attrs' => array(
		        'min'   => 3,
		        'max'   => 10,
		        'step'  => 1,
		        'class' => 'test-class test',
		        'style' => 'color: #0a0',
		    ),
		)
	);
		
	$wp_customize->add_setting(
		    'protopress_slider_cat',
		    array( 'sanitize_callback' => 'protopress_sanitize_category' )
		);
		
	$wp_customize->add_control(
	    new WP_Customize_Category_Control(
	        $wp_customize,
	        'protopress_slider_cat',
	        array(
	            'label'    => __('Category For Slider.','protopress'),
	            'settings' => 'protopress_slider_cat',
	            'section'  => 'protopress_fc_slider'
	        )
	    )
	);
	
	
	
	//IMAGE GRID
	
	$wp_customize->add_section(
	    'protopress_fc_grid',
	    array(
	        'title'     => __('Image Grid','protopress'),
	        'priority'  => 10,
	        'panel'     => 'protopress_fca_panel'
	    )
	);
	
	$wp_customize->add_setting(
		'protopress_grid_enable',
		array( 'sanitize_callback' => 'protopress_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'protopress_grid_enable', array(
		    'settings' => 'protopress_grid_enable',
		    'label'    => __( 'Enable Grid.', 'protopress' ),
		    'section'  => 'protopress_fc_grid',
		    'type'     => 'checkbox',
		)
	);
	
	
	$wp_customize->add_setting(
		'protopress_grid_title',
		array( 'sanitize_callback' => 'sanitize_text_field' )
	);
	
	$wp_customize->add_control(
			'protopress_grid_title', array(
		    'settings' => 'protopress_grid_title',
		    'label'    => __( 'Title for the Grid', 'protopress' ),
		    'section'  => 'protopress_fc_grid',
		    'type'     => 'text',
		)
	);
	
	
	
	$wp_customize->add_setting(
		    'protopress_grid_cat',
		    array( 'sanitize_callback' => 'protopress_sanitize_category' )
		);
	
		
	$wp_customize->add_control(
	    new WP_Customize_Category_Control(
	        $wp_customize,
	        'protopress_grid_cat',
	        array(
	            'label'    => __('Category For Image Grid','protopress'),
	            'settings' => 'protopress_grid_cat',
	            'section'  => 'protopress_fc_grid'
	        )
	    )
	);
	
	$wp_customize->add_setting(
		'protopress_grid_rows',
		array( 'sanitize_callback' => 'protopress_sanitize_positive_number' )
	);
	
	$wp_customize->add_control(
			'protopress_grid_rows', array(
		    'settings' => 'protopress_grid_rows',
		    'label'    => __( 'Max No. of Posts in the Grid. Enter 0 to Disable the Grid.', 'protopress' ),
		    'section'  => 'protopress_fc_grid',
		    'type'     => 'number',
		    'default'  => '0'
		)
	);
	
	
	// Layout and Design
	$wp_customize->add_panel( 'protopress_design_panel', array(
	    'priority'       => 40,
	    'capability'     => 'edit_theme_options',
	    'theme_supports' => '',
	    'title'          => __('Design & Layout','protopress'),
	) );
	
	$wp_customize->add_section(
	    'protopress_design_options',
	    array(
	        'title'     => __('Blog Layout','protopress'),
	        'priority'  => 0,
	        'panel'     => 'protopress_design_panel'
	    )
	);
	
	
	$wp_customize->add_setting(
		'protopress_blog_layout',
		array( 'sanitize_callback' => 'protopress_sanitize_blog_layout' )
	);
	
	function protopress_sanitize_blog_layout( $input ) {
		if ( in_array($input, array('grid','grid_2_column','grid_3_column') ) )
			return $input;
		else 
			return '';	
	}
	
	$wp_customize->add_control(
		'protopress_blog_layout',array(
				'label' => __('Select Layout','protopress'),
				'settings' => 'protopress_blog_layout',
				'section'  => 'protopress_design_options',
				'type' => 'select',
				'choices' => array(
						'grid' => __('Basic Blog Layout','protopress'),
						'grid_2_column' => __('Grid - 2 Column','protopress'),
						'grid_3_column' => __('Grid - 3 Column','protopress'),
					)
			)
	);
	
	$wp_customize->add_section(
	    'protopress_sidebar_options',
	    array(
	        'title'     => __('Sidebar Layout','protopress'),
	        'priority'  => 0,
	        'panel'     => 'protopress_design_panel'
	    )
	);
	
	$wp_customize->add_setting(
		'protopress_disable_sidebar',
		array( 'sanitize_callback' => 'protopress_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'protopress_disable_sidebar', array(
		    'settings' => 'protopress_disable_sidebar',
		    'label'    => __( 'Disable Sidebar Everywhere.','protopress' ),
		    'section'  => 'protopress_sidebar_options',
		    'type'     => 'checkbox',
		    'default'  => false
		)
	);
	
	$wp_customize->add_setting(
		'protopress_disable_sidebar_home',
		array( 'sanitize_callback' => 'protopress_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'protopress_disable_sidebar_home', array(
		    'settings' => 'protopress_disable_sidebar_home',
		    'label'    => __( 'Disable Sidebar on Home/Blog.','protopress' ),
		    'section'  => 'protopress_sidebar_options',
		    'type'     => 'checkbox',
		    'active_callback' => 'protopress_show_sidebar_options',
		    'default'  => false
		)
	);
	
	$wp_customize->add_setting(
		'protopress_disable_sidebar_front',
		array( 'sanitize_callback' => 'protopress_sanitize_checkbox' )
	);
	
	$wp_customize->add_control(
			'protopress_disable_sidebar_front', array(
		    'settings' => 'protopress_disable_sidebar_front',
		    'label'    => __( 'Disable Sidebar on Front Page.','protopress' ),
		    'section'  => 'protopress_sidebar_options',
		    'type'     => 'checkbox',
		    'active_callback' => 'protopress_show_sidebar_options',
		    'default'  => false
		)
	);
	
	
	$wp_customize->add_setting(
		'protopress_sidebar_width',
		array(
			'default' => 4,
		    'sanitize_callback' => 'protopress_sanitize_positive_number' )
	);
	
	$wp_customize->add_control(
			'protopress_sidebar_width', array(
		    'settings' => 'protopress_sidebar_width',
		    'label'    => __( 'Sidebar Width','protopress' ),
		    'description' => __('Min: 25%, Default: 33%, Max: 40%','protopress'),
		    'section'  => 'protopress_sidebar_options',
		    'type'     => 'range',
		    'active_callback' => 'protopress_show_sidebar_options',
		    'input_attrs' => array(
		        'min'   => 3,
		        'max'   => 5,
		        'step'  => 1,
		        'class' => 'sidebar-width-range',
		        'style' => 'color: #0a0',
		    ),
		)
	);
	
	/* Active Callback Function */
	function protopress_show_sidebar_options($control) {
	   
	    $option = $control->manager->get_setting('protopress_disable_sidebar');
	    return $option->value() == false ;
	    
	}
	
	class Protopress_Custom_CSS_Control extends WP_Customize_Control {
	    public $type = 'textarea';
	 
	    public function render_content() {
	        ?>
	            <label>
	                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
	                <textarea rows="8" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
	            </label>
	        <?php
	    }
	}
	
	$wp_customize-> add_section(
    'protopress_custom_codes',
    array(
    	'title'			=> __('Custom CSS','protopress'),
    	'description'	=> __('Enter your Custom CSS to Modify design.','protopress'),
    	'priority'		=> 11,
    	'panel'			=> 'protopress_design_panel'
    	)
    );
    
	$wp_customize->add_setting(
	'protopress_custom_css',
	array(
		'default'		=> '',
		'sanitize_callback'	=> 'protopress_sanitize_text'
		)
	);
	
	$wp_customize->add_control(
	    new Protopress_Custom_CSS_Control(
	        $wp_customize,
	        'protopress_custom_css',
	        array(
	            'section' => 'protopress_custom_codes',
	            'settings' => 'protopress_custom_css'
	        )
	    )
	);
	
	function protopress_sanitize_text( $input ) {
	    return wp_kses_post( force_balance_tags( $input ) );
	}
	
	$wp_customize-> add_section(
    'protopress_custom_footer',
    array(
    	'title'			=> __('Custom Footer Text','protopress'),
    	'description'	=> __('Enter your Own Copyright Text.','protopress'),
    	'priority'		=> 11,
    	'panel'			=> 'protopress_design_panel'
    	)
    );
    
	$wp_customize->add_setting(
	'protopress_footer_text',
	array(
		'default'		=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
		)
	);
	
	$wp_customize->add_control(	 
	       'protopress_footer_text',
	        array(
	            'section' => 'protopress_custom_footer',
	            'settings' => 'protopress_footer_text',
	            'type' => 'text'
	        )
	);	
	
	$wp_customize->add_section(
	    'protopress_typo_options',
	    array(
	        'title'     => __('Google Web Fonts','protopress'),
	        'priority'  => 41,
	    )
	);
	
	$font_array = array('Raleway','Khula','Open Sans','Droid Sans','Droid Serif','Roboto','Roboto Condensed','Lato','Bree Serif','Oswald','Slabo','Lora','Source Sans Pro','PT Sans','Ubuntu','Lobster','Arimo','Bitter','Noto Sans');
	$fonts = array_combine($font_array, $font_array);
	
	$wp_customize->add_setting(
		'protopress_title_font',
		array(
			'default'=> 'Raleway',
			'sanitize_callback' => 'protopress_sanitize_gfont' 
			)
	);
	
	function protopress_sanitize_gfont( $input ) {
		if ( in_array($input, array('Raleway','Khula','Open Sans','Droid Sans','Droid Serif','Roboto','Roboto Condensed','Lato','Bree Serif','Oswald','Slabo','Lora','Source Sans Pro','PT Sans','Ubuntu','Lobster','Arimo','Bitter','Noto Sans') ) )
			return $input;
		else
			return '';	
	}
	
	$wp_customize->add_control(
		'protopress_title_font',array(
				'label' => __('Title','protopress'),
				'settings' => 'protopress_title_font',
				'section'  => 'protopress_typo_options',
				'type' => 'select',
				'choices' => $fonts,
			)
	);
	
	$wp_customize->add_setting(
		'protopress_body_font',
			array(	'default'=> 'Khula',
					'sanitize_callback' => 'protopress_sanitize_gfont' )
	);
	
	$wp_customize->add_control(
		'protopress_body_font',array(
				'label' => __('Body','protopress'),
				'settings' => 'protopress_body_font',
				'section'  => 'protopress_typo_options',
				'type' => 'select',
				'choices' => $fonts
			)
	);
	
	// Social Icons
	$wp_customize->add_section('protopress_social_section', array(
			'title' => __('Social Icons','protopress'),
			'priority' => 44 ,
	));
	
	$social_networks = array( //Redefinied in Sanitization Function.
					'none' => __('-','protopress'),
					'facebook' => __('Facebook','protopress'),
					'twitter' => __('Twitter','protopress'),
					'google-plus' => __('Google Plus','protopress'),
					'instagram' => __('Instagram','protopress'),
					'rss' => __('RSS Feeds','protopress'),
					'vine' => __('Vine','protopress'),
					'vimeo-square' => __('Vimeo','protopress'),
					'youtube' => __('Youtube','protopress'),
					'flickr' => __('Flickr','protopress'),
				);
				
	$social_count = count($social_networks);
				
	for ($x = 1 ; $x <= ($social_count - 3) ; $x++) :
			
		$wp_customize->add_setting(
			'protopress_social_'.$x, array(
				'sanitize_callback' => 'protopress_sanitize_social',
				'default' => 'none'
			));

		$wp_customize->add_control( 'protopress_social_'.$x, array(
					'settings' => 'protopress_social_'.$x,
					'label' => __('Icon ','protopress').$x,
					'section' => 'protopress_social_section',
					'type' => 'select',
					'choices' => $social_networks,			
		));
		
		$wp_customize->add_setting(
			'protopress_social_url'.$x, array(
				'sanitize_callback' => 'esc_url_raw'
			));

		$wp_customize->add_control( 'protopress_social_url'.$x, array(
					'settings' => 'protopress_social_url'.$x,
					'description' => __('Icon ','protopress').$x.__(' Url','protopress'),
					'section' => 'protopress_social_section',
					'type' => 'url',
					'choices' => $social_networks,			
		));
		
	endfor;
	
	function protopress_sanitize_social( $input ) {
		$social_networks = array(
					'none' ,
					'facebook',
					'twitter',
					'google-plus',
					'instagram',
					'rss',
					'vine',
					'vimeo-square',
					'youtube',
					'flickr'
				);
		if ( in_array($input, $social_networks) )
			return $input;
		else
			return '';	
	}	
	
	
	/* Sanitization Functions Common to Multiple Settings go Here, Specific Sanitization Functions are defined along with add_setting() */
	function protopress_sanitize_checkbox( $input ) {
	    if ( $input == 1 ) {
	        return 1;
	    } else {
	        return '';
	    }
	}
	
	function protopress_sanitize_positive_number( $input ) {
		if ( ($input >= 0) && is_numeric($input) )
			return $input;
		else
			return '';	
	}
	
	function protopress_sanitize_category( $input ) {
		if ( term_exists(get_cat_name( $input ), 'category') )
			return $input;
		else 
			return '';	
	}
	
	
}
add_action( 'customize_register', 'protopress_customize_register' );


/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function protopress_customize_preview_js() {
	wp_enqueue_script( 'protopress_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'protopress_customize_preview_js' );
