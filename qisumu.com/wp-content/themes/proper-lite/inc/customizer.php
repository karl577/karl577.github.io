<?php
/**
 * proper-lite Theme Customizer 
 *
 * @package proper-lite
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object. 
 */
function proper_lite_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage'; 
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	
//-------------------------------------------------------------------------------------------------------------------//
// Move and Replace
//-------------------------------------------------------------------------------------------------------------------// 
	
	//Colors
	$wp_customize->add_panel( 'proper_lite_colors_panel', array( 
    'priority'       => 40,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => esc_html__( 'General Colors', 'proper-lite' ),
    'description'    => esc_html__( 'Edit your general color settings.', 'proper-lite' ),
	));
	
	//Nav
	$wp_customize->add_panel( 'proper_lite_nav_panel', array(
    'priority'       => 11,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => esc_html__( 'Navigation', 'proper-lite' ),
    'description'    => esc_html__( 'Edit your theme navigation settings.', 'proper-lite' ),
	));
	
	// nav 
	$wp_customize->add_section( 'nav', array( 
	'title' => esc_html__( 'Navigation Settings', 'proper-lite' ),
	'priority' => '10', 
	'panel' => 'proper_lite_nav_panel'
	) );
	
	// colors
	$wp_customize->add_section( 'colors', array(
	'title' => esc_html__( 'Theme Colors', 'proper-lite' ),   
	'priority' => '10', 
	'panel' => 'proper_lite_colors_panel' 
	) );
	
	// Move sections up 
	$wp_customize->get_section('static_front_page')->priority = 8; 
	$wp_customize->get_section('title_tagline')->priority = 10;  
	$wp_customize->remove_section('header_image');
	
	//premiums are better
    class proper_lite_Info extends WP_Customize_Control { 
     
        public $label = '';
        public function render_content() {
        ?>

        <?php
        }
    }	
	

//-------------------------------------------------------------------------------------------------------------------//
// Upgrade
//-------------------------------------------------------------------------------------------------------------------//

    $wp_customize->add_section(
        'proper_lite_theme_info',
        array(
            'title' => esc_html__('Proper Premium', 'proper-lite'),  
            'priority' => 5, 
            'description' => __('Need some more Proper? If you want to see what additional features <a href="http://modernthemes.net/premium-wordpress-themes/proper/" target="_blank">Proper Premium</a> has, check them all out right <a href="http://modernthemes.net/premium-wordpress-themes/proper/" target="_blank">here</a>.', 'proper-lite'), 
        )
    );
	 
    //show them what we have to offer 
    $wp_customize->add_setting('proper_lite_help', array(
			'sanitize_callback' => 'proper_lite_no_sanitize',
            'type' => 'info_control',
            'capability' => 'edit_theme_options',
        )
    );
    $wp_customize->add_control( new proper_lite_Info( $wp_customize, 'proper_lite_help', array( 
        'section' => 'proper_lite_theme_info', 
        'settings' => 'proper_lite_help',  
        'priority' => 10
        ) )
    );
	
	
//-------------------------------------------------------------------------------------------------------------------//
// Navigation
//-------------------------------------------------------------------------------------------------------------------//


	//Navigation/Menu Options
	$wp_customize->add_setting( 'proper_lite_menu_method', array( 
		'default'	        => 'option1', 
		'sanitize_callback' => 'proper_lite_sanitize_index_content',
	));

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'proper_lite_menu_method', array(
		'description'    => esc_html__( 'Choose between a the Icon Toggle Menu or a classic listed menu.', 'proper-lite' ),
		'section'  => 'nav', 
		'settings' => 'proper_lite_menu_method',
		'type'     => 'radio',
		'choices'  => array(
			'option1' => esc_html__( 'Toggle Menu', 'proper-lite' ),
			'option2' => esc_html__( 'Classic Menu', 'proper-lite' ),  
			), 
		'input_attrs' => array(
            'style' => 'margin-top: 15px;', 
        ),
	)));
	
	$wp_customize->add_setting( 'proper_lite_menu_toggle', array(
		'default' => 'icon', 
    	'capability' => 'edit_theme_options',
    	'sanitize_callback' => 'proper_lite_sanitize_menu_toggle_display', 
  	));

  	$wp_customize->add_control( 'proper_lite_menu_toggle_radio', array(
    	'settings' => 'proper_lite_menu_toggle',
    	'label'    => esc_html__( 'Menu Toggle Display', 'proper-lite' ), 
    	'section'  => 'nav',
    	'type'     => 'radio',
    	'choices'  => array(
      		'icon' => esc_html__( 'Icon', 'proper-lite' ),
      		'label' => esc_html__( 'Menu', 'proper-lite' ), 
    	),
	));
	
	//nav font size
    $wp_customize->add_setting( 
        'proper_lite_nav_text_size',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '14',
        )
    );
	
    $wp_customize->add_control( 'proper_lite_nav_text_size', array( 
        'type'        => 'number', 
        'priority'    => 30,
        'section'     => 'nav',  
        'label'       => esc_html__('Navigation Font Size', 'proper-lite'), 
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 32, 
            'step'  => 1,
            'style' => 'margin-bottom: 10px;',
        ),
  	));
	
	// Nav Colors
    $wp_customize->add_section( 'proper_lite_nav_colors_section' , array(
	    'title'       => esc_html__( 'Navigation Colors', 'proper-lite' ),
	    'priority'    => 20, 
	    'description' => esc_html__( 'Set your theme navigation colors.', 'proper-lite'),
		'panel' => 'proper_lite_nav_panel',
	));
	
	$wp_customize->add_setting( 'proper_lite_nav_bg_color', array(
        'default'     => '#111111', 
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'proper_lite_nav_bg_color', array(
        'label'	   => esc_html__( 'Navigation Background Color', 'proper-lite' ),
        'section'  => 'proper_lite_nav_colors_section',
        'settings' => 'proper_lite_nav_bg_color',
		'priority' => 10
    )));
	
	$wp_customize->add_setting( 'proper_lite_nav_link_color', array(
        'default'     => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'proper_lite_nav_link_color', array(
        'label'	   => esc_html__( 'Navigation Link', 'proper-lite' ),
        'section'  => 'proper_lite_nav_colors_section',
        'settings' => 'proper_lite_nav_link_color',
		'priority' => 20 
    )));
	
	$wp_customize->add_setting( 'proper_lite_nav_link_hover_color', array(
        'default'     => '#999999', 
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'proper_lite_nav_link_hover_color', array(
        'label'	   => esc_html__( 'Navigation Link Hover', 'proper-lite' ),
        'section'  => 'proper_lite_nav_colors_section',
        'settings' => 'proper_lite_nav_link_hover_color', 
		'priority' => 30
    )));
	
	$wp_customize->add_setting( 'proper_lite_menu_button', array(
        'default'     => '#111111',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'proper_lite_menu_button', array(
        'label'	   => esc_html__( 'Navigation Button', 'proper-lite' ),
        'section'  => 'proper_lite_nav_colors_section',
        'settings' => 'proper_lite_menu_button',
		'priority' => 40 
    )));
	
	$wp_customize->add_setting( 'proper_lite_menu_button_hover', array(
        'default'     => '#444444',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'proper_lite_menu_button_hover', array(
        'label'	   => esc_html__( 'Navigation Button Hover', 'proper-lite' ),
        'section'  => 'proper_lite_nav_colors_section',
        'settings' => 'proper_lite_menu_button_hover',
		'priority' => 50 
    )));
	
	$wp_customize->add_setting( 'proper_lite_nav_dropdown_bg', array(
        'default'     => '#212121',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'proper_lite_nav_dropdown_bg', array(
        'label'	   => esc_html__( 'Classic Menu Dropdown Background', 'proper-lite' ),
        'section'  => 'proper_lite_nav_colors_section',
        'settings' => 'proper_lite_nav_dropdown_bg',
		'priority' => 55 
    )));
	
	
//-------------------------------------------------------------------------------------------------------------------//
// Logos and Favicons
//-------------------------------------------------------------------------------------------------------------------//
	
	
	// Logo upload
    $wp_customize->add_section( 'proper_lite_logo_section' , array(  
	    'title'       => esc_html__( 'Logo', 'proper-lite' ),
	    'priority'    => 20, 
	    'description' => esc_html__( 'Upload a logo to replace the default site name and description in the header.', 'proper-lite'),
	));

	$wp_customize->add_setting( 'proper_lite_logo', array( 
		'sanitize_callback' => 'esc_url_raw',
	));

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'proper_lite_logo', array( 
		'label'    => esc_html__( 'Logo', 'proper-lite' ),
		'type'           => 'image',
		'section'  => 'proper_lite_logo_section', 
		'settings' => 'proper_lite_logo',
		'priority' => 10,
	))); 
	
	// Logo Width
	$wp_customize->add_setting( 'logo_size', array(
	    'sanitize_callback' => 'absint',
		'default' => '120'
	));

	$wp_customize->add_control( 'logo_size', array( 
		'label'    => esc_html__( 'Logo Size', 'proper-lite' ), 
		'description' => esc_html__( 'Change the width of the Logo in PX. Only enter numeric value.', 'proper-lite' ),
		'section'  => 'proper_lite_logo_section', 
		'settings' => 'logo_size',
		'type'        => 'number',
		'priority'   => 30,
		'input_attrs' => array(
            'style' => 'margin-bottom: 15px;',  
        ), 
	));
	

//-------------------------------------------------------------------------------------------------------------------//
// Hero Section
//-------------------------------------------------------------------------------------------------------------------//

	$wp_customize->add_panel( 'proper_lite_home_hero_panel', array(
    'priority'       => 22,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => esc_html__( 'Home Hero Section', 'proper-lite' ),
    'description'    => esc_html__( 'Edit your home page settings', 'proper-lite' ),
	));
	
	//Home Hero Section
    $wp_customize->add_section( 'proper_lite_home_hero_section' , array(  
	    'title'       => esc_html__( 'Home Hero Options', 'proper-lite' ),
	    'priority'    => 10, 
	    'description' => esc_html__( 'Edit the options for the home page Hero section.', 'proper-lite'),
		'panel' => 'proper_lite_home_hero_panel',
	));
	
	$wp_customize->add_setting( 'proper_lite_home_bg_image', array(
		'sanitize_callback' => 'esc_url_raw',
	));

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'proper_lite_home_bg_image', array( 
		'label'    => esc_html__( 'Background Image', 'proper-lite' ),
		'type'           => 'image', 
		'section'  => 'proper_lite_home_hero_section', 
		'settings' => 'proper_lite_home_bg_image', 
		'priority' => 10,
	)));
	
	$wp_customize->add_setting( 'proper_lite_hero_bg_color', array(
        'default'     => '#111111', 
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'proper_lite_hero_bg_color', array(
        'label'	   => esc_html__( 'Background Color', 'proper-lite' ),
        'section'  => 'proper_lite_home_hero_section',
        'settings' => 'proper_lite_hero_bg_color',
		'priority' => 15
    ))); 
	
	//Title
	$wp_customize->add_setting( 'proper_lite_home_title',
	    array(
	        'sanitize_callback' => 'proper_lite_sanitize_text',  
	));  

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'proper_lite_home_title', array(
		'label'    => esc_html__( 'Title Text', 'proper-lite' ), 
		'section'  => 'proper_lite_home_hero_section',  
		'settings' => 'proper_lite_home_title', 
		'priority'   => 20
	)));
	
	$wp_customize->add_setting( 'proper_lite_hero_heading_color', array(
        'default'     => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'proper_lite_hero_heading_color', array(
        'label'	   => esc_html__( 'Title Color', 'proper-lite' ),
        'section'  => 'proper_lite_home_hero_section',
        'settings' => 'proper_lite_hero_heading_color',
		'priority' => 25
    )));
	
	//Button Text
	$wp_customize->add_setting( 'proper_lite_home_button_text',
	    array(
	        'sanitize_callback' => 'proper_lite_sanitize_text',  
	));  

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'proper_lite_home_button_text', array(
		'label'    => esc_html__( 'Button Text', 'proper-lite' ), 
		'section'  => 'proper_lite_home_hero_section',  
		'settings' => 'proper_lite_home_button_text', 
		'priority'   => 30
	)));
	
	
	// Page Drop Downs 
	$wp_customize->add_setting('proper_lite_home_button_url', array( 
		'capability' => 'edit_theme_options', 
        'sanitize_callback' => 'proper_lite_sanitize_int' 
	));
	
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'proper_lite_home_button_url', array( 
    	'label' => esc_html__( 'Hero Button URL', 'proper-lite' ), 
    	'section' => 'proper_lite_home_hero_section', 
		'type' => 'dropdown-pages',
    	'settings' => 'proper_lite_home_button_url', 
		'priority'   => 40  
	)));
	
	
	$wp_customize->add_setting( 'proper_lite_button_text_color', array(
        'default'     => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'proper_lite_button_text_color', array(
        'label'	   => esc_html__( 'Button Text Color', 'proper-lite' ),
        'section'  => 'proper_lite_home_hero_section',
        'settings' => 'proper_lite_button_text_color',
		'priority' => 45
    )));
	
	$wp_customize->add_setting( 'proper_lite_button_bg_color', array(
        'default'     => '#111111',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'proper_lite_button_bg_color', array(
        'label'	   => esc_html__( 'Button Background Color', 'proper-lite' ),
        'section'  => 'proper_lite_home_hero_section',
        'settings' => 'proper_lite_button_bg_color',
		'priority' => 50
    )));
	
	$wp_customize->add_setting( 'proper_lite_button_hover_color', array(
        'default'     => '#444444',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'proper_lite_button_hover_color', array(
        'label'	   => esc_html__( 'Button Hover Color', 'proper-lite' ),
        'section'  => 'proper_lite_home_hero_section',
        'settings' => 'proper_lite_button_hover_color',
		'priority' => 60
    )));
	
	
//-------------------------------------------------------------------------------------------------------------------//
// Home Page
//-------------------------------------------------------------------------------------------------------------------//
	
	
	$wp_customize->add_panel( 'proper_lite_home_page_panel', array(
    'priority'       => 25,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => esc_html__( 'Home Page', 'proper-lite' ),
    'description'    => esc_html__( 'Edit your home page settings', 'proper-lite' ),
	));
	
	//First Widget Area
    $wp_customize->add_section( 'proper_lite_home_widget_section_1' , array(  
	    'title'       => esc_html__( 'Home Widget Area #1', 'proper-lite' ),
	    'priority'    => 10, 
	    'description' => esc_html__( 'Edit the options for the first home page widget area.', 'proper-lite'),
		'panel' 	  => 'proper_lite_home_page_panel', 
	));
	
	
	// Number of Widget Columns 
	$wp_customize->add_setting( 'proper_lite_widget_column_one', array(
		'default'	        => 'option1',
		'sanitize_callback' => 'proper_lite_sanitize_widget_content', 
	));

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'proper_lite_widget_column_one', array(
		'label'    => esc_html__( 'Number of Widget Columns', 'proper-lite' ),
		'description'    => esc_html__( '1 Column will take up the entire widget area, while 4 columns will give space to use 4 widgets for content in one row. Recommended: Set to 1 Column if you are using ModernThemes plugin widgets.', 'proper-lite' ),
		'section'  => 'proper_lite_home_widget_section_1', 
		'settings' => 'proper_lite_widget_column_one', 
		'type'     => 'radio',
		'priority'   => 5,  
		'choices'  => array(
			'option1' => esc_html__( '1 Column', 'proper-lite' ),
			'option2' => esc_html__( '2 Columns', 'proper-lite' ), 
			'option3' => esc_html__( '3 Columns', 'proper-lite' ),
			'option4' => esc_html__( '4 Columns', 'proper-lite' ),
			),
		'input_attrs' => array(
            'style' => 'margin-bottom: 10px;',
        ),
	)));
	
	
	//Hide Section 
	$wp_customize->add_setting('active_hw_1',
	    array(
	        'sanitize_callback' => 'proper_lite_sanitize_checkbox',
	)); 
	
	$wp_customize->add_control( 'active_hw_1', array(
        'type' => 'checkbox',
        'label' => esc_html__( 'Hide Home Widget Area #1', 'proper-lite' ),
        'section' => 'proper_lite_home_widget_section_1', 
		'priority'   => 10
    ));
	
	$wp_customize->add_setting( 'proper_lite_hw_area_1_bg_color', array(
        'default'     => '#f5f5f3',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'proper_lite_hw_area_1_bg_color', array(
        'label'	   => esc_html__( 'Background Color', 'proper-lite' ),
        'section'  => 'proper_lite_home_widget_section_1',
        'settings' => 'proper_lite_hw_area_1_bg_color',
		'priority' => 20 
    )));
	
	$wp_customize->add_setting( 'proper_lite_hw_area_1_text_color', array(
        'default'     => '#404040',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'proper_lite_hw_area_1_text_color', array(
        'label'	   => esc_html__( 'Text Color', 'proper-lite' ),
        'section'  => 'proper_lite_home_widget_section_1',
        'settings' => 'proper_lite_hw_area_1_text_color',
		'priority' => 30 
    )));
	
	$wp_customize->add_setting( 'proper_lite_hw_area_1_heading_color', array(
        'default'     => '#404040',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'proper_lite_hw_area_1_heading_color', array(
        'label'	   => esc_html__( 'Heading Color', 'proper-lite' ),
        'section'  => 'proper_lite_home_widget_section_1',
        'settings' => 'proper_lite_hw_area_1_heading_color',
		'priority' => 35
    )));
	
	$wp_customize->add_setting( 'proper_lite_hw_area_1_link_color', array(
        'default'     => '#000000',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'proper_lite_hw_area_1_link_color', array(
        'label'	   => esc_html__( 'Link Color', 'proper-lite' ),
        'section'  => 'proper_lite_home_widget_section_1',
        'settings' => 'proper_lite_hw_area_1_link_color', 
		'priority' => 38
    )));
	
	$wp_customize->add_setting( 'proper_lite_hw_area_1_link_hover_color', array(
        'default'     => '#000000',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'proper_lite_hw_area_1_link_hover_color', array(
        'label'	   => esc_html__( 'Link Hover Color', 'proper-lite' ),
        'section'  => 'proper_lite_home_widget_section_1',
        'settings' => 'proper_lite_hw_area_1_link_hover_color', 
		'priority' => 39
    )));
	
	$wp_customize->add_setting( 'proper_lite_hw_area_1_button_color', array(
        'default'     => '#111111',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'proper_lite_hw_area_1_button_color', array(
        'label'	   => esc_html__( 'Button Color', 'proper-lite' ),
        'section'  => 'proper_lite_home_widget_section_1',
        'settings' => 'proper_lite_hw_area_1_button_color',
		'priority' => 40 
    ))); 
	
	$wp_customize->add_setting( 'proper_lite_hw_area_1_button_hover_color', array(
        'default'     => '#444444', 
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'proper_lite_hw_area_1_button_hover_color', array(
        'label'	   => esc_html__( 'Button Hover Color', 'proper-lite' ),
        'section'  => 'proper_lite_home_widget_section_1',
        'settings' => 'proper_lite_hw_area_1_button_hover_color',
		'priority' => 50  
    ))); 
	
	//Second Widget Area
    $wp_customize->add_section( 'proper_lite_home_widget_section_2' , array(  
	    'title'       => esc_html__( 'Home Widget Area #2', 'proper-lite' ),
	    'priority'    => 20, 
	    'description' => esc_html__( 'Edit the options for the second home page widget area.', 'proper-lite'),
		'panel' 	  => 'proper_lite_home_page_panel',
	));
	
	// Number of Widget Columns 
	$wp_customize->add_setting( 'proper_lite_widget_column_two', array(
		'default'	        => 'option1',
		'sanitize_callback' => 'proper_lite_sanitize_widget_content', 
	));

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'proper_lite_widget_column_two', array(
		'label'    => esc_html__( 'Number of Widget Columns', 'proper-lite' ),
		'description'    => esc_html__( '1 Column will take up the entire widget area, while 4 columns will give space to use 4 widgets for content in one row. Recommended: Set to 1 Column if you are using ModernThemes plugin widgets.', 'proper-lite' ),
		'section'  => 'proper_lite_home_widget_section_2', 
		'settings' => 'proper_lite_widget_column_two', 
		'type'     => 'radio',
		'priority'   => 5,  
		'choices'  => array(
			'option1' => esc_html__( '1 Column', 'proper-lite' ),
			'option2' => esc_html__( '2 Columns', 'proper-lite' ), 
			'option3' => esc_html__( '3 Columns', 'proper-lite' ),
			'option4' => esc_html__( '4 Columns', 'proper-lite' ),
			),
		'input_attrs' => array(
            'style' => 'margin-bottom: 10px;',
        ),
	)));
	
	//Hide Section 
	$wp_customize->add_setting('active_hw_2',
	    array(
	        'sanitize_callback' => 'proper_lite_sanitize_checkbox',
	)); 
	
	$wp_customize->add_control( 'active_hw_2', array(
        'type' => 'checkbox',
        'label' => esc_html__( 'Hide Home Widget Area #2', 'proper-lite' ),
        'section' => 'proper_lite_home_widget_section_2', 
		'priority'   => 10
    ));
	
	$wp_customize->add_setting( 'proper_lite_hw_area_2_bg_color', array(
        'default'     => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color', 
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'proper_lite_hw_area_2_bg_color', array(
        'label'	   => esc_html__( 'Background Color', 'proper-lite' ),
        'section'  => 'proper_lite_home_widget_section_2',
        'settings' => 'proper_lite_hw_area_2_bg_color',
		'priority' => 20 
    )));
	
	$wp_customize->add_setting( 'proper_lite_hw_area_2_text_color', array(
        'default'     => '#404040',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'proper_lite_hw_area_2_text_color', array(
        'label'	   => esc_html__( 'Text Color', 'proper-lite' ),
        'section'  => 'proper_lite_home_widget_section_2',
        'settings' => 'proper_lite_hw_area_2_text_color',
		'priority' => 30 
    )));
	
	
	$wp_customize->add_setting( 'proper_lite_hw_area_2_heading_color', array(
        'default'     => '#404040',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'proper_lite_hw_area_2_heading_color', array(
        'label'	   => esc_html__( 'Heading Color', 'proper-lite' ),
        'section'  => 'proper_lite_home_widget_section_2',
        'settings' => 'proper_lite_hw_area_2_heading_color',
		'priority' => 35
    )));
	
	$wp_customize->add_setting( 'proper_lite_hw_area_2_link_color', array(
        'default'     => '#000000',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'proper_lite_hw_area_2_link_color', array(
        'label'	   => esc_html__( 'Link Color', 'proper-lite' ),
        'section'  => 'proper_lite_home_widget_section_2',
        'settings' => 'proper_lite_hw_area_2_link_color', 
		'priority' => 38
    )));
	
	$wp_customize->add_setting( 'proper_lite_hw_area_2_link_hover_color', array(
        'default'     => '#000000',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'proper_lite_hw_area_2_link_hover_color', array(
        'label'	   => esc_html__( 'Link Hover Color', 'proper-lite' ),
        'section'  => 'proper_lite_home_widget_section_2',
        'settings' => 'proper_lite_hw_area_2_link_hover_color', 
		'priority' => 39
    )));
	
	
	$wp_customize->add_setting( 'proper_lite_hw_area_2_button_color', array(
        'default'     => '#111111',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'proper_lite_hw_area_2_button_color', array(
        'label'	   => esc_html__( 'Button Color', 'proper-lite' ),
        'section'  => 'proper_lite_home_widget_section_2',
        'settings' => 'proper_lite_hw_area_2_button_color',
		'priority' => 40 
    ))); 
	
	$wp_customize->add_setting( 'proper_lite_hw_area_2_button_hover_color', array(
        'default'     => '#444444', 
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'proper_lite_hw_area_2_button_hover_color', array(
        'label'	   => esc_html__( 'Button Hover Color', 'proper-lite' ),
        'section'  => 'proper_lite_home_widget_section_2',
        'settings' => 'proper_lite_hw_area_2_button_hover_color', 
		'priority' => 50  
    )));
	
	
//-------------------------------------------------------------------------------------------------------------------//
// Footer
//-------------------------------------------------------------------------------------------------------------------//
	 
	// Footer Panel
	$wp_customize->add_panel( 'proper_lite_footer_panel', array(
    'priority'       => 30,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => esc_html__( 'Footer', 'proper-lite' ),
    'description'    		 => esc_html__( 'Edit your footer options', 'proper-lite' ),
	));
	 
	 
	// Add Footer Section
	$wp_customize->add_section( 'footer-custom' , array(
    	'title' => esc_html__( 'Footer Options', 'proper-lite' ),
    	'priority' => 20,
    	'description' => esc_html__( 'Customize your footer area', 'proper-lite' ),
		'panel' => 'proper_lite_footer_panel'
	));

	$wp_customize->add_setting( 'proper_lite_footer_logo', array(
		'sanitize_callback' => 'esc_url_raw',
	));

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'proper_lite_footer_logo', array( 
		'label'    => esc_html__( 'Footer Logo', 'proper-lite' ),
		'type'           => 'image',
		'section'  => 'footer-custom', 
		'settings' => 'proper_lite_footer_logo',
		'priority' => 10,
	)));
	
	// Footer Logo Width
	$wp_customize->add_setting( 'footer_logo_size', array(
	    'sanitize_callback' => 'absint',
		'default' => '120'
	));

	$wp_customize->add_control( 'footer_logo_size', array( 
		'label'    => esc_html__( 'Footer Logo Size', 'proper-lite' ),
		'description' => esc_html__( 'Change the width of the Logo in PX. Only enter numeric value.', 'proper-lite' ),
		'section'  => 'footer-custom', 
		'settings' => 'footer_logo_size', 
		'type'        => 'number',
		'priority'   => 20,
		'input_attrs' => array(
            'style' => 'margin-bottom: 15px;',  
        ),
	));
	
	// Footer Text
	$wp_customize->add_setting( 'proper_lite_footer_text',
	    array(
	        'sanitize_callback' => 'proper_lite_sanitize_text',
	));
	 
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'proper_lite_footer_text', array(
	'type'     => 'textarea',
    'label' => esc_html__( 'Footer Text', 'proper-lite' ),
    'section' => 'footer-custom', 
    'settings' => 'proper_lite_footer_text',
	'priority'   => 25
	)));

	// Footer Byline Text 
	$wp_customize->add_setting( 'proper_lite_footerid',
	    array(
	        'sanitize_callback' => 'proper_lite_sanitize_text',
	));
	 
	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'proper_lite_footerid', array(
    'label' => esc_html__( 'Footer Byline Text', 'proper-lite' ),
    'section' => 'footer-custom', 
    'settings' => 'proper_lite_footerid',
	'priority'   => 30
	)));
	
	//Hide Section 
	$wp_customize->add_setting('active_byline',
	    array(
	        'sanitize_callback' => 'proper_lite_sanitize_checkbox',
	)); 
	
	$wp_customize->add_control( 'active_byline', array(
        'type' => 'checkbox',
        'label' => esc_html__( 'Hide Footer Byline', 'proper-lite' ),
        'section' => 'footer-custom',  
		'priority'   => 35
    ));
	
	$wp_customize->add_setting( 'proper_lite_footer_color', array( 
        'default'     => '#040404',  
        'sanitize_callback' => 'sanitize_hex_color', 
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'proper_lite_footer_color', array(
        'label'	   => esc_html__( 'Footer Background Color', 'proper-lite'),
        'section'  => 'footer-custom',
        'settings' => 'proper_lite_footer_color',
		'priority' => 40
    )));
	
	$wp_customize->add_setting( 'proper_lite_footer_text_color', array( 
        'default'     => '#cccccc', 
        'sanitize_callback' => 'sanitize_hex_color', 
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'proper_lite_footer_text_color', array(
        'label'	   => esc_html__( 'Footer Text Color', 'proper-lite'),
        'section'  => 'footer-custom',
        'settings' => 'proper_lite_footer_text_color', 
		'priority' => 50
    )));
	
	$wp_customize->add_setting( 'proper_lite_footer_heading_color', array( 
        'default'     => '#cccccc', 
        'sanitize_callback' => 'sanitize_hex_color', 
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'proper_lite_footer_heading_color', array(
        'label'	   => esc_html__( 'Footer Heading Color', 'proper-lite'),
        'section'  => 'footer-custom',
        'settings' => 'proper_lite_footer_heading_color',
		'priority' => 50
    )));
	
	$wp_customize->add_setting( 'proper_lite_footer_link_color', array(  
        'default'     => '#cccccc', 
        'sanitize_callback' => 'sanitize_hex_color', 
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'proper_lite_footer_link_color', array(
        'label'	   => esc_html__( 'Footer Link Color', 'proper-lite'),  
        'section'  => 'footer-custom',
        'settings' => 'proper_lite_footer_link_color', 
		'priority' => 60 
    )));
	
	$wp_customize->add_setting( 'proper_lite_footer_link_hover_color', array(  
        'default'     => '#cccccc', 
        'sanitize_callback' => 'sanitize_hex_color', 
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'proper_lite_footer_link_hover_color', array(
        'label'	   => esc_html__( 'Footer Link Hover Color', 'proper-lite'),  
        'section'  => 'footer-custom', 
        'settings' => 'proper_lite_footer_link_hover_color', 
		'priority' => 70
    )));
	
	$wp_customize->add_setting( 'proper_lite_footer_button_color', array(
        'default'     => '#111111',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'proper_lite_footer_button_color', array(
        'label'	   => esc_html__( 'Button Color', 'proper-lite' ),
        'section'  => 'footer-custom',
        'settings' => 'proper_lite_footer_button_color',
		'priority' => 80 
    ))); 
	
	$wp_customize->add_setting( 'proper_lite_footer_button_hover_color', array(
        'default'     => '#444444', 
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'proper_lite_footer_button_hover_color', array(
        'label'	   => esc_html__( 'Button Hover Color', 'proper-lite' ),
        'section'  => 'footer-custom',
        'settings' => 'proper_lite_footer_button_hover_color', 
		'priority' => 90
    ))); 
    
	
//-------------------------------------------------------------------------------------------------------------------//
// Social Icons
//-------------------------------------------------------------------------------------------------------------------//


	$wp_customize->add_panel( 'social_panel', array(
    'priority'       => 38,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => esc_html__( 'Social Media Icons', 'proper-lite' ),
    'description'    => esc_html__( 'Edit your social media icons', 'proper-lite' ),
	)); 
	
	//Social Section
	$wp_customize->add_section( 'proper_lite_settings', array(
            'title'          => esc_html__( 'Social Media Settings', 'proper-lite' ),
            'priority'       => 10,
			'panel' => 'social_panel',
    ) );
	
	//Hide Social Section 
	$wp_customize->add_setting('active_social',
	    array(
	        'sanitize_callback' => 'proper_lite_sanitize_checkbox',
	)); 
	
	$wp_customize->add_control( 
    'active_social', 
    array(
        'type' => 'checkbox',
        'label' => esc_html__( 'Hide Social Media Icons', 'proper-lite' ),
        'section' => 'proper_lite_settings',  
		'priority'   => 10
    ));
	
	//social font size
    $wp_customize->add_setting( 
        'proper_lite_social_text_size',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '20',
        )
    );
	
    $wp_customize->add_control( 'proper_lite_social_text_size', array(
        'type'        => 'number', 
        'priority'    => 15,
        'section'     => 'proper_lite_settings', 
        'label'       => esc_html__('Social Icon Size', 'proper-lite'), 
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 32, 
            'step'  => 1,
            'style' => 'margin-bottom: 10px;',
        ),
  	));
		
	//Social Icon Colors
	$wp_customize->add_setting( 'proper_lite_social_color', array( 
        'default'     => '#ffffff',  
		'sanitize_callback' => 'sanitize_hex_color', 
    ));
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'proper_lite_social_color', array(
        'label'	   => esc_html__( 'Social Icon Color', 'proper-lite' ),
        'section'  => 'proper_lite_settings',
        'settings' => 'proper_lite_social_color', 
		'priority' => 20
    )));
	
	$wp_customize->add_setting( 'proper_lite_social_color_hover', array( 
        'default'     => '#999999',  
		'sanitize_callback' => 'sanitize_hex_color',  
    ));
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'proper_lite_social_color_hover', array(
        'label'	   => esc_html__( 'Social Icon Hover Color', 'proper-lite' ), 
        'section'  => 'proper_lite_settings',
        'settings' => 'proper_lite_social_color_hover', 
		'priority' => 30
    ))); 
	

//-------------------------------------------------------------------------------------------------------------------//
// General Colors
//-------------------------------------------------------------------------------------------------------------------//

	$wp_customize->add_setting( 'proper_lite_text_color', array(
        'default'     => '#404040',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'proper_lite_text_color', array(
        'label'	   => esc_html__( 'Text Color', 'proper-lite' ),
        'section'  => 'colors',
        'settings' => 'proper_lite_text_color',
		'priority' => 10 
    ))); 
	
    $wp_customize->add_setting( 'proper_lite_link_color', array( 
        'default'     => '#000000',   
        'sanitize_callback' => 'sanitize_hex_color', 
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'proper_lite_link_color', array(
        'label'	   => esc_html__( 'Link Color', 'proper-lite'),
        'section'  => 'colors',
        'settings' => 'proper_lite_link_color', 
		'priority' => 30
    )));
	
	$wp_customize->add_setting( 'proper_lite_hover_color', array(
        'default'     => '#999999',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'proper_lite_hover_color', array(
        'label'	   => esc_html__( 'Hover Color', 'proper-lite' ), 
        'section'  => 'colors',
        'settings' => 'proper_lite_hover_color',
		'priority' => 35 
    )));
	
	$wp_customize->add_setting( 'proper_lite_site_title_color', array(
        'default'     => '#ffffff', 
        'sanitize_callback' => 'sanitize_hex_color',
    ));
	
	 $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'proper_lite_site_title_color', array(
        'label'	   => esc_html__( 'Site Title Color', 'proper-lite' ),  
        'section'  => 'colors',
        'settings' => 'proper_lite_site_title_color',
		'priority' => 40
    )));
	
	
	
	//Page Colors
    $wp_customize->add_section( 'proper_lite_page_colors_section' , array(  
	    'title'       => esc_html__( 'Page Colors', 'proper-lite' ),
	    'priority'    => 20, 
	    'description' => esc_html__( 'Set your page colors.', 'proper-lite'),
		'panel' => 'proper_lite_colors_panel', 
	));
	
	$wp_customize->add_setting( 'proper_lite_page_header', array(
        'default'     => '#222222', 
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'proper_lite_page_header', array(
        'label'	   => esc_html__( 'Page Header Background Color', 'proper-lite' ),
        'section'  => 'proper_lite_page_colors_section',
        'settings' => 'proper_lite_page_header',
		'priority' => 35
    ))); 
	
	$wp_customize->add_setting( 'proper_lite_entry', array(
        'default'     => '#ffffff', 
        'sanitize_callback' => 'sanitize_hex_color',
    ));
 
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'proper_lite_entry', array(
        'label'	   => esc_html__( 'Entry Title Color', 'proper-lite' ), 
        'section'  => 'proper_lite_page_colors_section',
        'settings' => 'proper_lite_entry',  
		'priority' => 55
    )));
	
	$wp_customize->add_setting( 'proper_lite_custom_color', array( 
        'default'     => '#111111', 
		'sanitize_callback' => 'sanitize_hex_color',
    ));
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'proper_lite_custom_color', array(
        'label'	   => esc_html__( 'Button Color', 'proper-lite' ), 
        'section'  => 'proper_lite_page_colors_section',
        'settings' => 'proper_lite_custom_color', 
		'priority' => 65
    )));
	
	$wp_customize->add_setting( 'proper_lite_custom_color_hover', array( 
        'default'     => '#444444', 
		'sanitize_callback' => 'sanitize_hex_color', 
    ));
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'proper_lite_custom_color_hover', array(
        'label'	   => esc_html__( 'Button Hover Color', 'proper-lite' ), 
        'section'  => 'proper_lite_page_colors_section',
        'settings' => 'proper_lite_custom_color_hover', 
		'priority' => 75
    )));
	
	
//-------------------------------------------------------------------------------------------------------------------//
// Fonts
//-------------------------------------------------------------------------------------------------------------------//	
	
    $wp_customize->add_section(
        'proper_lite_typography',
        array(
            'title' => esc_html__('Fonts', 'proper-lite' ),   
            'priority' => 45, 
    ));
	
    $font_choices = 
        array(
			' ', 
			'Source Sans Pro:400,700,400italic,700italic' => 'Source Sans Pro',
			'Playfair Display:400,700,400italic' => 'Playfair Display',
			'Open Sans:400italic,700italic,400,700' => 'Open Sans',
			'Oswald:400,700' => 'Oswald',
			'Montserrat:400,700' => 'Montserrat',
			'Raleway:400,700' => 'Raleway',
            'Droid Sans:400,700' => 'Droid Sans',
            'Lato:400,700,400italic,700italic' => 'Lato',
            'Arvo:400,700,400italic,700italic' => 'Arvo',
            'Lora:400,700,400italic,700italic' => 'Lora',
			'Merriweather:400,300italic,300,400italic,700,700italic' => 'Merriweather',
			'Oxygen:400,300,700' => 'Oxygen',
			'PT Serif:400,700' => 'PT Serif', 
            'PT Sans:400,700,400italic,700italic' => 'PT Sans',
            'PT Sans Narrow:400,700' => 'PT Sans Narrow',
			'Cabin:400,700,400italic' => 'Cabin',
			'Fjalla One:400' => 'Fjalla One',
			'Francois One:400' => 'Francois One',
			'Josefin Sans:400,300,600,700' => 'Josefin Sans',  
			'Libre Baskerville:400,400italic,700' => 'Libre Baskerville',
            'Arimo:400,700,400italic,700italic' => 'Arimo',
            'Ubuntu:400,700,400italic,700italic' => 'Ubuntu',
            'Bitter:400,700,400italic' => 'Bitter',
            'Droid Serif:400,700,400italic,700italic' => 'Droid Serif',
            'Roboto:400,400italic,700,700italic' => 'Roboto',
            'Open Sans Condensed:700,300italic,300' => 'Open Sans Condensed',
            'Roboto Condensed:400italic,700italic,400,700' => 'Roboto Condensed',
            'Roboto Slab:400,700' => 'Roboto Slab',
            'Yanone Kaffeesatz:400,700' => 'Yanone Kaffeesatz',
            'Rokkitt:400' => 'Rokkitt',
    );
	
	//body font size
    $wp_customize->add_setting(
        'proper_lite_body_size',
        array(
            'sanitize_callback' => 'absint',
            'default'           => '14',
        )
    );
	
    $wp_customize->add_control( 'proper_lite_body_size', array(
        'type'        => 'number', 
        'priority'    => 10,
        'section'     => 'proper_lite_typography',
        'label'       => esc_html__('Body Font Size', 'proper-lite'), 
        'input_attrs' => array(
            'min'   => 10,
            'max'   => 28,
            'step'  => 1,
            'style' => 'margin-bottom: 10px;',
        ),
  	));
    
    $wp_customize->add_setting(
        'headings_fonts',
        array(
            'sanitize_callback' => 'proper_lite_sanitize_fonts',
    ));
    
    $wp_customize->add_control(
        'headings_fonts',
        array(
            'type' => 'select',
			'default'           => '20', 
            'description' => esc_html__('Select your desired font for the headings. Playfair Display is the default Heading font.', 'proper-lite'),
            'section' => 'proper_lite_typography',
            'choices' => $font_choices
    ));
    
    $wp_customize->add_setting(
        'body_fonts',
        array(
            'sanitize_callback' => 'proper_lite_sanitize_fonts',
    ));
    
    $wp_customize->add_control(
        'body_fonts',
        array(
            'type' => 'select',
			'default'           => '30', 
            'description' => esc_html__( 'Select your desired font for the body. Source Sans Pro is the default Body font.', 'proper-lite' ), 
            'section' => 'proper_lite_typography',  
            'choices' => $font_choices 
    ));
	

//-------------------------------------------------------------------------------------------------------------------//
// Blog Layout
//-------------------------------------------------------------------------------------------------------------------//

    $wp_customize->add_section( 'proper_lite_layout_section' , array( 
	    'title'       => esc_html__( 'Blog', 'proper-lite' ),
	    'priority'    => 38, 
	    'description' => 'Change how Proper Lite displays posts', 
	));
	
	// Blog Title
	$wp_customize->add_setting( 'proper_lite_blog_title',
	    array(
	        'sanitize_callback' => 'proper_lite_sanitize_text', 
			'default' => 'Our Latest News',  
	));  

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'proper_lite_blog_title', array(
		'label'    => esc_html__( 'Posts Page Title', 'proper-lite' ),
		'section'  => 'proper_lite_layout_section', 
		'settings' => 'proper_lite_blog_title',
		'priority'   => 10 
	))); 
	
	//Blog Background
	$wp_customize->add_setting( 'proper_lite_blog_bg', array(
		'sanitize_callback' => 'esc_url_raw',
	));

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'proper_lite_blog_bg', array( 
		'label'    => esc_html__( 'Blog Header Background Image', 'proper-lite' ),
		'section'  => 'proper_lite_layout_section',
		'settings' => 'proper_lite_blog_bg',   
		'priority'   => 20
	)));
	
	//Blog Colors
	$wp_customize->add_setting( 'proper_lite_archive_hover', array( 
        'default'     => '#f9f9f9',  
		'sanitize_callback' => 'sanitize_hex_color', 
    ));
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'proper_lite_archive_hover', array(
        'label'	   => esc_html__( 'Blog Archive Hover Background', 'proper-lite' ),
        'section'  => 'proper_lite_layout_section',
        'settings' => 'proper_lite_archive_hover', 
		'priority' => 30
    )));
	
	$wp_customize->add_setting( 'proper_lite_archive_border', array( 
        'default'     => '#ededed', 
		'sanitize_callback' => 'sanitize_hex_color', 
    ));
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'proper_lite_archive_border', array(
        'label'	   => esc_html__( 'Blog Archive Border Color', 'proper-lite' ),
        'section'  => 'proper_lite_layout_section',
        'settings' => 'proper_lite_archive_border',
		'priority' => 30
    )));
	
	
	//Post Content
	$wp_customize->add_setting( 'proper_lite_post_content', array(
		'default'	        => 'option1',
		'sanitize_callback' => 'proper_lite_sanitize_index_content',
	));

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'proper_lite_post_content', array(
		'label'    => __( 'Post content', 'proper-lite' ), 
		'section'  => 'proper_lite_layout_section',
		'settings' => 'proper_lite_post_content',
		'type'     => 'radio',
		'priority'   => 30, 
		'choices'  => array(
			'option1' => 'Title', 
			'option2' => 'Full content',
			),
	)));
	 
	 
	
	//Animations
	$wp_customize->add_section( 'proper_lite_animations' , array(  
	    'title'       => esc_html__( 'Animation Effects', 'proper-lite' ), 
	    'priority'    => 50,  
	    'description' => esc_html__( 'Get yourself animated or disable it.', 'proper-lite' ), 
	)); 
	
    $wp_customize->add_setting(
        'proper_lite_animate',
        array(
            'sanitize_callback' => 'proper_lite_sanitize_checkbox',
            'default' => 0,
    ));
	
    $wp_customize->add_control( 
        'proper_lite_animate',
        array(
            'type' => 'checkbox',
            'label' => esc_html__('Check this box if you want to disable the animations.', 'proper-lite'),
            'section' => 'proper_lite_animations', 
            'priority' => 1,           
    ));
	
	
//-------------------------------------------------------------------------------------------------------------------//
// Plugin Options
//-------------------------------------------------------------------------------------------------------------------//


	$wp_customize->add_panel( 'proper_lite_plugin_panel', array(
    'priority'       => 42, 
    'capability'     => 'edit_theme_options',
    'title'          => esc_html__( 'ModernThemes Plugin Options', 'proper-lite' ),
    'description'    => esc_html__( 'If you have installed any of our ModernThemes content plugins at http://modernthemes.net/plugins/ use this section to edit theme-specific options. Our plugins are styled different from theme to theme, so you can use this area to customize the content to match your theme.', 'proper-lite' ),
	));
	
	//Services Plugins 
	$wp_customize->add_section( 'proper_lite_plugin_services_colors' , array(  
	    'title'       => esc_html__( 'Services', 'proper-lite' ), 
		'theme_supports' => 'mt_services', 
	    'priority'    => 10, 
	    'description' => esc_html__( 'If you have installed any of our ModernThemes content plugins at http://modernthemes.net/plugins/ use this section to edit theme-specific options. Our plugins are styled different from theme to theme, so you can use this area to customize the content to match your theme.', 'proper-lite'), 
		'panel' => 'proper_lite_plugin_panel',
	));

	
	$wp_customize->add_setting( 'proper_lite_plugin_service_page_icon_color', array( 
		'default' => '#404040',
		'sanitize_callback' => 'sanitize_hex_color',
    ));
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'proper_lite_plugin_service_page_icon_color', array(
        'label'	   => esc_html__( 'Service Icon', 'proper-lite' ), 
        'section'  => 'proper_lite_plugin_services_colors',
        'settings' => 'proper_lite_plugin_service_page_icon_color', 
		'priority' => 110
    ))); 
	
	
	$wp_customize->add_setting( 'proper_lite_plugin_service_page_icon_bg_color', array(
		'sanitize_callback' => 'sanitize_hex_color',
    ));
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'proper_lite_plugin_service_page_icon_bg_color', array(
        'label'	   => esc_html__( 'Service Icon Background', 'proper-lite' ), 
        'section'  => 'proper_lite_plugin_services_colors',
        'settings' => 'proper_lite_plugin_service_page_icon_bg_color', 
		'priority' => 115 
    ))); 
	
	$wp_customize->add_setting( 'proper_lite_plugin_service_page_icon_border_color', array(	
		'default' => '#404040',
		'sanitize_callback' => 'sanitize_hex_color', 
    ));
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'proper_lite_plugin_service_page_icon_border_color', array(
        'label'	   => esc_html__( 'Service Icon Border', 'proper-lite' ), 
        'section'  => 'proper_lite_plugin_services_colors',
        'settings' => 'proper_lite_plugin_service_page_icon_border_color', 
		'priority' => 118
    )));
	
	//Projects Plugins 
	$wp_customize->add_section( 'proper_lite_plugin_projects_colors' , array(  
	    'title'       => esc_html__( 'Projects', 'proper-lite' ), 
		'theme_supports' => 'mt_projects',  
	    'priority'    => 20, 
	    'description' => esc_html__( 'If you have installed any of our ModernThemes content plugins at http://modernthemes.net/plugins/ use this section to edit theme-specific options. Our plugins are styled different from theme to theme, so you can use this area to customize the content to match your theme.', 'proper-lite'), 
		'panel' => 'proper_lite_plugin_panel',
	));
	
	$wp_customize->add_setting( 'proper_lite_plugin_project_hover_color', array( 
        'default'     => '#151515',  
		'sanitize_callback' => 'sanitize_hex_color', 
    ));
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'proper_lite_plugin_project_hover_color', array(
        'label'	   => esc_html__( 'Hover Background', 'proper-lite' ), 
        'section'  => 'proper_lite_plugin_projects_colors',
        'settings' => 'proper_lite_plugin_project_hover_color', 
		'priority' => 10 
    ))); 
	
	$wp_customize->add_setting( 'proper_lite_plugin_project_hover_text_color', array( 
        'default'     => '#ffffff',
		'sanitize_callback' => 'sanitize_hex_color', 
    ));
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'proper_lite_plugin_project_hover_text_color', array(
        'label'	   => esc_html__( 'Hover Text', 'proper-lite' ), 
        'section'  => 'proper_lite_plugin_projects_colors',
        'settings' => 'proper_lite_plugin_project_hover_text_color', 
		'priority' => 20 
    ))); 
	
	//Team Members Plugins 
	$wp_customize->add_section( 'proper_lite_plugin_team_colors' , array(  
	    'title'       => esc_html__( 'Team Members', 'proper-lite' ), 
		'theme_supports' => 'mt_members',  
	    'priority'    => 30, 
	    'description' => esc_html__( 'If you have installed any of our ModernThemes content plugins at http://modernthemes.net/plugins/ use this section to edit theme-specific options. Our plugins are styled different from theme to theme, so you can use this area to customize the content to match your theme.', 'proper-lite'), 
		'panel' => 'proper_lite_plugin_panel',
	));
	
	$wp_customize->add_setting( 'proper_lite_plugin_team_icon', array( 
        'default'     => '#1f2023',  
		'sanitize_callback' => 'sanitize_hex_color', 
    ));
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'proper_lite_plugin_team_icon', array(
        'label'	   => esc_html__( 'Team Member Icon Color', 'proper-lite' ), 
        'section'  => 'proper_lite_plugin_team_colors',
        'settings' => 'proper_lite_plugin_team_icon', 
		'priority' => 10 
    ))); 
	
	$wp_customize->add_setting( 'proper_lite_plugin_team_icon_border', array( 
        'default'     => '#1f2023',
		'sanitize_callback' => 'sanitize_hex_color', 
    ));
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'proper_lite_plugin_team_icon_border', array(
        'label'	   => esc_html__( 'Team Member Icon Border', 'proper-lite' ),
        'section'  => 'proper_lite_plugin_team_colors',
        'settings' => 'proper_lite_plugin_team_icon_border',
		'priority' => 30
    )));
	
	$wp_customize->add_setting( 'proper_lite_plugin_team_icon_hover', array(
        'default'     => '#ffffff',
		'sanitize_callback' => 'sanitize_hex_color', 
    ));
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'proper_lite_plugin_team_icon_hover', array(
        'label'	   => esc_html__( 'Team Member Icon Hover', 'proper-lite' ), 
        'section'  => 'proper_lite_plugin_team_colors',
        'settings' => 'proper_lite_plugin_team_icon_hover', 
		'priority' => 40 
    ))); 
	
	$wp_customize->add_setting( 'proper_lite_plugin_team_icon_bg_hover', array(
        'default'     => '#1f2023',
		'sanitize_callback' => 'sanitize_hex_color', 
    ));
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'proper_lite_plugin_team_icon_bg_hover', array(
        'label'	   => esc_html__( 'Team Member Icon Background Hover', 'proper-lite' ), 
        'section'  => 'proper_lite_plugin_team_colors',
        'settings' => 'proper_lite_plugin_team_icon_bg_hover', 
		'priority' => 40 
    ))); 
	
	$wp_customize->add_setting( 'proper_lite_plugin_team_divider', array(
        'default'     => '#222222',
		'sanitize_callback' => 'sanitize_hex_color', 
    ));
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'proper_lite_plugin_team_divider', array(
        'label'	   => esc_html__( 'Team Member Divider', 'proper-lite' ), 
        'section'  => 'proper_lite_plugin_team_colors',
        'settings' => 'proper_lite_plugin_team_divider',  
		'priority' => 50 
    ))); 
	
	//Testimonials Plugins 
	$wp_customize->add_section( 'proper_lite_plugin_testimonial_colors' , array(  
	    'title'       => esc_html__( 'Testimonials', 'proper-lite' ),
		'theme_supports' => 'mt_testimonials',  
	    'priority'    => 40, 
	    'description' => esc_html__( 'If you have installed any of our ModernThemes content plugins at http://modernthemes.net/plugins/ use this section to edit theme-specific options. Our plugins are styled different from theme to theme, so you can use this area to customize the content to match your theme.', 'proper-lite'), 
		'panel' => 'proper_lite_plugin_panel', 
	));
	
	$wp_customize->add_setting( 'proper_lite_plugin_testimonial_bg', array( 
        'default'     => '#ffffff',  
		'sanitize_callback' => 'sanitize_hex_color', 
    ));
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'proper_lite_plugin_testimonial_bg', array(
        'label'	   => esc_html__( 'Content Background', 'proper-lite' ), 
        'section'  => 'proper_lite_plugin_testimonial_colors',
        'settings' => 'proper_lite_plugin_testimonial_bg', 
		'priority' => 10 
    ))); 
	
	$wp_customize->add_setting( 'proper_lite_plugin_testimonial_text_color', array( 
        'default'     => '#404040',
		'sanitize_callback' => 'sanitize_hex_color', 
    ));
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'proper_lite_plugin_testimonial_text_color', array(
        'label'	   => esc_html__( 'Text Color', 'proper-lite' ), 
        'section'  => 'proper_lite_plugin_testimonial_colors',
        'settings' => 'proper_lite_plugin_testimonial_text_color', 
		'priority' => 20 
    )));
	
	//Font Style
	$wp_customize->add_setting( 'proper_lite_plugin_testimonial_font_style', array(
		'default'	        => 'option1',
		'sanitize_callback' => 'proper_lite_sanitize_index_content',
	));

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'proper_lite_plugin_testimonial_font_style', array(
		'label'    => esc_html__( 'Font Style', 'proper-lite' ),
		'section'  => 'proper_lite_plugin_testimonial_colors',
		'settings' => 'proper_lite_plugin_testimonial_font_style',
		'type'     => 'radio',
		'priority'   => 30, 
		'choices'  => array(
			'option1' => 'Italic',
			'option2' => 'Normal',
			),
	)));
	
	//Skills Plugins 
	$wp_customize->add_section( 'proper_lite_plugin_skills_colors' , array(  
	    'title'       => esc_html__( 'Skill Bars', 'proper-lite' ), 
		'theme_supports' => 'mt_skills', 
	    'priority'    => 50, 
	    'description' => esc_html__( 'If you have installed any of our ModernThemes content plugins at http://modernthemes.net/plugins/ use this section to edit theme-specific options. Our plugins are styled different from theme to theme, so you can use this area to customize the content to match your theme.', 'proper-lite'), 
		'panel' => 'proper_lite_plugin_panel', 
	));
	
	$wp_customize->add_setting( 'proper_lite_plugin_skill_color', array( 
        'default'     => '#040404',
		'sanitize_callback' => 'sanitize_hex_color', 
    ));
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'proper_lite_plugin_skill_color', array(
        'label'	   => esc_html__( 'Skill Bar Color', 'proper-lite' ), 
        'section'  => 'proper_lite_plugin_skills_colors', 
        'settings' => 'proper_lite_plugin_skill_color', 
		'priority' => 20
    )));
	
	$wp_customize->add_setting( 'proper_lite_plugin_skill_bg_color', array( 
        'default'     => '#dddddd', 
		'sanitize_callback' => 'sanitize_hex_color', 
    ));
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'proper_lite_plugin_skill_bg_color', array(
        'label'	   => esc_html__( 'Skill Bar Background', 'proper-lite' ), 
        'section'  => 'proper_lite_plugin_skills_colors', 
        'settings' => 'proper_lite_plugin_skill_bg_color', 
		'priority' => 20 
    )));  
	
	//Details Plugins 
	$wp_customize->add_section( 'proper_lite_plugin_detail_colors' , array(  
	    'title'       => esc_html__( 'Details', 'proper-lite' ), 
		'theme_supports' => 'mt_details',  
	    'priority'    => 60, 
	    'description' => esc_html__( 'If you have installed any of our ModernThemes content plugins at http://modernthemes.net/plugins/ use this section to edit theme-specific options. Our plugins are styled different from theme to theme, so you can use this area to customize the content to match your theme.', 'proper-lite'), 
		'panel' => 'proper_lite_plugin_panel', 
	));
	
	$wp_customize->add_setting( 'proper_lite_plugin_detail_icon_color', array( 
        'default'     => '#404040',
		'sanitize_callback' => 'sanitize_hex_color', 
    ));
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'proper_lite_plugin_detail_icon_color', array(
        'label'	   => esc_html__( 'Icon Color', 'proper-lite' ), 
        'section'  => 'proper_lite_plugin_detail_colors', 
        'settings' => 'proper_lite_plugin_detail_icon_color', 
		'priority' => 10 
    )));
	
	$wp_customize->add_setting( 'proper_lite_plugin_detail_text_color', array( 
        'default'     => '#404040', 
		'sanitize_callback' => 'sanitize_hex_color', 
    ));
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'proper_lite_plugin_detail_text_color', array(
        'label'	   => esc_html__( 'Number Color', 'proper-lite' ),
        'section'  => 'proper_lite_plugin_detail_colors', 
        'settings' => 'proper_lite_plugin_detail_text_color', 
		'priority' => 30 
    ))); 
	
	
	//Columns Plugins 
	$wp_customize->add_section( 'proper_lite_plugin_columns_colors' , array(  
	    'title'       => esc_html__( 'Home Page Columns', 'proper-lite' ), 
		'theme_supports' => 'mt_columns',  
	    'priority'    => 70, 
	    'description' => esc_html__( 'If you have installed any of our ModernThemes content plugins at http://modernthemes.net/plugins/ use this section to edit theme-specific options. Our plugins are styled different from theme to theme, so you can use this area to customize the content to match your theme.', 'proper-lite'), 
		'panel' => 'proper_lite_plugin_panel', 
	));
	
	$wp_customize->add_setting( 'proper_lite_plugin_columns_icon_color', array( 
        'default'     => '#404040',
		'sanitize_callback' => 'sanitize_hex_color', 
    ));
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'proper_lite_plugin_columns_icon_color', array(
        'label'	   => esc_html__( 'Icon Color', 'proper-lite' ), 
        'section'  => 'proper_lite_plugin_columns_colors', 
        'settings' => 'proper_lite_plugin_columns_icon_color', 
		'priority' => 10 
    )));
	
	$wp_customize->add_setting( 'proper_lite_plugin_columns_link_color', array( 
        'default'     => '#000000', 
		'sanitize_callback' => 'sanitize_hex_color', 
    ));
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'proper_lite_plugin_columns_link_color', array(
        'label'	   => esc_html__( 'Link Color', 'proper-lite' ),
        'section'  => 'proper_lite_plugin_columns_colors', 
        'settings' => 'proper_lite_plugin_columns_link_color', 
		'priority' => 40
    ))); 
	
	$wp_customize->add_setting( 'proper_lite_plugin_columns_hover_color', array(  
        'default'     => '#999999',
		'sanitize_callback' => 'sanitize_hex_color', 
    ));
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'proper_lite_plugin_columns_hover_color', array(
        'label'	   => esc_html__( 'Hover Color', 'proper-lite' ),
        'section'  => 'proper_lite_plugin_columns_colors', 
        'settings' => 'proper_lite_plugin_columns_hover_color', 
		'priority' => 50
    ))); 
	
	//News Widget
	$wp_customize->add_section( 'proper_lite_plugin_news_colors' , array(  
	    'title'       => esc_html__( 'Home Posts Widget', 'proper-lite' ),
		'theme_supports' => 'mt_news',   
	    'priority'    => 45, 
	    'description' => esc_html__( 'Edit your MT - Home Posts options', 'proper-lite'),
		'panel' => 'proper_lite_plugin_panel',
	)); 
	
	$wp_customize->add_setting( 'proper_lite_plugin_news_bg_color', array( 
        'default'     => '#f5f5f3',
		'sanitize_callback' => 'sanitize_hex_color', 
    ));
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'proper_lite_plugin_news_bg_color', array(
        'label'	   => esc_html__( 'Background Color', 'proper-lite' ), 
        'section'  => 'proper_lite_plugin_news_colors', 
        'settings' => 'proper_lite_plugin_news_bg_color', 
		'priority' => 10 
    )));
	
	$wp_customize->add_setting( 'proper_lite_plugin_news_text_color', array( 
        'default'     => '#252525',
		'sanitize_callback' => 'sanitize_hex_color', 
    ));
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'proper_lite_plugin_news_text_color', array(
        'label'	   => esc_html__( 'Title Color', 'proper-lite' ), 
        'section'  => 'proper_lite_plugin_news_colors', 
        'settings' => 'proper_lite_plugin_news_text_color', 
		'priority' => 20
    )));
	
	$wp_customize->add_setting( 'proper_lite_plugin_news_date_color', array( 
        'default'     => '#636363',
		'sanitize_callback' => 'sanitize_hex_color', 
    ));
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'proper_lite_plugin_news_date_color', array(
        'label'	   => esc_html__( 'Date Color', 'proper-lite' ), 
        'section'  => 'proper_lite_plugin_news_colors', 
        'settings' => 'proper_lite_plugin_news_date_color', 
		'priority' => 30
    )));
	
	$wp_customize->add_setting( 'proper_lite_plugin_news_button_color', array( 
        'default'     => '#111111',
		'sanitize_callback' => 'sanitize_hex_color', 
    ));
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'proper_lite_plugin_news_button_color', array(
        'label'	   => esc_html__( 'Button Color', 'proper-lite' ), 
        'section'  => 'proper_lite_plugin_news_colors', 
        'settings' => 'proper_lite_plugin_news_button_color',
		'priority' => 40
    )));
	
	$wp_customize->add_setting( 'proper_lite_plugin_news_button_text_color', array( 
        'default'     => '#ffffff',
		'sanitize_callback' => 'sanitize_hex_color', 
    ));
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'proper_lite_plugin_news_button_text_color', array(
        'label'	   => esc_html__( 'Button Text Color', 'proper-lite' ), 
        'section'  => 'proper_lite_plugin_news_colors', 
        'settings' => 'proper_lite_plugin_news_button_text_color',
		'priority' => 50
    )));
	
	$wp_customize->add_setting( 'proper_lite_plugin_news_button_hover_color', array( 
        'default'     => '#444444',
		'sanitize_callback' => 'sanitize_hex_color', 
    ));
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'proper_lite_plugin_news_button_hover_color', array(
        'label'	   => esc_html__( 'Button Hover Color', 'proper-lite' ), 
        'section'  => 'proper_lite_plugin_news_colors', 
        'settings' => 'proper_lite_plugin_news_button_hover_color',
		'priority' => 50 
    )));
	
	//Font Style
	$wp_customize->add_setting( 'proper_lite_plugin_news_text_style', array(
		'default'	        => 'option1',
		'sanitize_callback' => 'proper_lite_sanitize_index_content',
	));

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'proper_lite_plugin_news_text_style', array(
		'label'    => esc_html__( 'Text Align', 'proper-lite' ), 
		'section'  => 'proper_lite_plugin_news_colors',
		'settings' => 'proper_lite_plugin_news_text_style',
		'type'     => 'radio', 
		'priority'   => 60, 
		'choices'  => array(
			'option1' => 'Left',
			'option2' => 'Center', 
			),
	)));
	
	
}
add_action( 'customize_register', 'proper_lite_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function proper_lite_customize_preview_js() {
	wp_enqueue_script( 'proper_lite_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'proper_lite_customize_preview_js' ); 
