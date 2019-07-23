<?php
function wallstreet_blog_customizer( $wp_customize ) {
	//Blog Heading section 
	$wp_customize->add_section(
        'blog_setting',
        array(
            'title' => __('Homepage blog settings','wallstreet'),
			'priority'   => 700,
			
			)
    );
	
	//Show and hide Blog section
	$wp_customize->add_setting(
	'wallstreet_pro_options[blog_section_enabled]'
    ,
    array(
        'default' => true,
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'type' => 'option',
    )	
	);
	$wp_customize->add_control(
    'wallstreet_pro_options[blog_section_enabled]',
    array(
        'label' => __('Enable Homepage Blog Section','wallstreet'),
        'section' => 'blog_setting',
        'type' => 'checkbox',
    )
	);
	}
	add_action( 'customize_register', 'wallstreet_blog_customizer' );
	?>