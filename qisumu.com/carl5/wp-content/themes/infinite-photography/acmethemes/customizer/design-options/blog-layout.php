<?php
/*adding sections for blog layout options*/
$wp_customize->add_section( 'infinite-photography-design-blog-layout-option', array(
    'priority'       => 30,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Default Blog Layout', 'infinite-photography' ),
    'panel'          => 'infinite-photography-design-panel'
) );

/*blog layout*/
$wp_customize->add_setting( 'infinite_photography_theme_options[infinite-photography-blog-archive-layout]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['infinite-photography-blog-archive-layout'],
    'sanitize_callback' => 'infinite_photography_sanitize_select'
) );
$choices = infinite_photography_blog_layout();
$wp_customize->add_control( 'infinite_photography_theme_options[infinite-photography-blog-archive-layout]', array(
    'choices'  	=> $choices,
    'label'		=> __( 'Default Blog Layout', 'infinite-photography' ),
    'section'   => 'infinite-photography-design-blog-layout-option',
    'settings'  => 'infinite_photography_theme_options[infinite-photography-blog-archive-layout]',
    'type'	  	=> 'select'
) );