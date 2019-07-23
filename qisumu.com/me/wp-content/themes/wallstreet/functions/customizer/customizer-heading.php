<?php
function wallstreet_template_customizer( $wp_customize ) {


// add section to manage Section heading
	$wp_customize->add_section(
        'section_heading',
        array(
            'title' => __('Section Heading','wallstreet'),
			'priority'   => 500,
			)
    );
	
	
	//Enable Contact Information On Front Page
	$wp_customize->add_setting(
		'wallstreet_pro_options[contact_header_settings]',
		array('capability'  => 'edit_theme_options',
		'default' => true ,  
		'type' => 'option',
		'sanitize_callback' => 'sanitize_text_field',
		));

	$wp_customize->add_control(
		'wallstreet_pro_options[contact_header_settings]',
		array(
			'type' => 'checkbox',
			'label' => __('Enable contact information','wallstreet'),
			'section' => 'section_heading',
		)
	);
	
	
	//Contect phone number front
	$wp_customize->add_setting(
		'wallstreet_pro_options[contact_phone_number]',
		array('capability'  => 'edit_theme_options',
		'default' => '1-800-123-789', 
		'type' => 'option',
		'sanitize_callback' => 'wallstreet_home_page_sanitize_text',
		));

	$wp_customize->add_control(
		'wallstreet_pro_options[contact_phone_number]',
		array(
			'type' => 'text',
			'label' => __('Contact phone number','wallstreet'),
			'section' => 'section_heading',
		)
	);
	
	//Contect phone number front
	$wp_customize->add_setting(
		'wallstreet_pro_options[contact_email]',
		array('capability'  => 'edit_theme_options',
		'default' => 'info@webriti.com', 
		'type' => 'option',
		'sanitize_callback' => 'wallstreet_home_page_sanitize_text',
		));

	$wp_customize->add_control(
		'wallstreet_pro_options[contact_email]',
		array(
			'type' => 'text',
			'label' => __('Contact email','wallstreet'),
			'section' => 'section_heading',
		)
	);
	
	
	
	//Service section heading
	$wp_customize->add_setting(
		'wallstreet_pro_options[service_title]',
		array('capability'  => 'edit_theme_options',
		'default' => __('Our services','wallstreet'), 
		'type' => 'option',
		'sanitize_callback' => 'sanitize_text_field',
		));

	$wp_customize->add_control(
		'wallstreet_pro_options[service_title]',
		array(
			'type' => 'text',
			'label' => __('Services Title','wallstreet'),
			'section' => 'section_heading',
		)
	);
	
	
	//Service section description
	$wp_customize->add_setting(
		'wallstreet_pro_options[service_description]',
		array('capability'  => 'edit_theme_options',
		'default' => __('We offer great services to our clients.','wallstreet'), 
		'type' => 'option',
		'sanitize_callback' => 'sanitize_text_field',
		));

	$wp_customize->add_control(
		'wallstreet_pro_options[service_description]',
		array(
			'type' => 'text',
			'label' => __('Services Description','wallstreet'),
			'section' => 'section_heading',
		)
	);
	
	//Portfolio section heading
	$wp_customize->add_setting(
		'wallstreet_pro_options[portfolio_title]',
		array('capability'  => 'edit_theme_options',
		'default' => __('Featured portfolio project','wallstreet'), 
		'type' => 'option',
		'sanitize_callback' => 'sanitize_text_field',
		));

	$wp_customize->add_control(
		'wallstreet_pro_options[portfolio_title]',
		array(
			'type' => 'text',
			'label' => __('Portfolio Title','wallstreet'),
			'section' => 'section_heading',
		)
	);
	
	
	//Service section description
	$wp_customize->add_setting(
		'wallstreet_pro_options[portfolio_description]',
		array('capability'  => 'edit_theme_options',
		'default' => __('Our most popular work','wallstreet'), 
		'type' => 'option',
		'sanitize_callback' => 'sanitize_text_field',
		));

	$wp_customize->add_control(
		'wallstreet_pro_options[portfolio_description]',
		array(
			'type' => 'text',
			'label' => __('Portfolio Description','wallstreet'),
			'section' => 'section_heading',
		)
	);
	
	
	// Blog Heading
	$wp_customize->add_setting(
		'wallstreet_pro_options[home_blog_heading]',
		array('capability'  => 'edit_theme_options',
		'default' => __('Our latest blog post','wallstreet'), 
		'type' => 'option',
		'sanitize_callback' => 'sanitize_text_field',
		));

	$wp_customize->add_control(
		'wallstreet_pro_options[home_blog_heading]',
		array(
			'type' => 'text',
			'label' => __('Homepage blog section heading','wallstreet'),
			'section' => 'section_heading',
		)
	);
	
	
	
	$wp_customize->add_setting(
		'wallstreet_pro_options[home_blog_description]',
		array('capability'  => 'edit_theme_options',
		'default' => __('We work with new customers and grow their business.','wallstreet'), 
		'type' => 'option',
		'sanitize_callback' => 'sanitize_text_field',
		));

	$wp_customize->add_control(
		'wallstreet_pro_options[home_blog_description]',
		array(
			'type' => 'text',
			'label' => __('Homepage blog section description','wallstreet'),
			'section' => 'section_heading',
		)
	);

	
	}
	add_action( 'customize_register', 'wallstreet_template_customizer' );
	
	function wallstreet_home_page_sanitize_text( $input ) {

			return wp_kses_post( force_balance_tags( $input ) );

	}
	?>