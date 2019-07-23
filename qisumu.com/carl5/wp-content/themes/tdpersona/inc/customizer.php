<?php
/**
 * tdpersona Theme Customizer
 *
 * @package tdpersona
 * @since tdpersona 1.0
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 *
 * @since tdpersona 1.0
 */
function tdpersona_customize_register( $wp_customize ) {

    /* position for site title and description */
	$wp_customize->add_setting( 'tdpersona_header_align', array(
		'default' => 'center',
		'sanitize_callback' => 'sanitize_text_field'
	) );

	$wp_customize->add_control( 'tdpersona_header_align', array(
		'type' => 'select',
		'label' => '标题 & 标签 文本位置',
		'section' => 'title_tagline',
		'choices' => array(
			'left' => __( '靠左', 'tdpersona' ),
			'center' => __( '居中', 'tdpersona' ),
			'right' => __( '靠右', 'tdpersona' ),
		),
		'priority' => 3
	) );

	/* Uploader for logo */
    $wp_customize->add_setting( 'tdpersona_logo_img', array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw'
	) );

	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'tdpersona_logo_img', array(
		'label' => __( '图像/Logo 上传', 'tdpersona' ),
		'section' => 'title_tagline',
		'settings' => 'tdpersona_logo_img'
	) ) );

	/* Logo Corner Settings */
	$wp_customize->add_setting( 'tdpersona_logo_img_style', array(
		'default' => 'round',
		'sanitize_callback' => 'sanitize_text_field'
	) );

	$wp_customize->add_control( 'tdpersona_logo_img_style', array(
		'type' => 'select',
		'label' => __( '图像/Logo 风格', 'tdpersona' ),
		'section' => 'title_tagline',
		'choices' => array(
			'round' => __( '圆形', 'tdpersona' ),
			'square' => __( '方形', 'tdpersona' ),
		),
	) );

    /* Post Formats Navigations */
	$wp_customize->add_setting( 'tdpersona_post_formats_navigation', array(
		'default' => 'hide',
		'sanitize_callback' => 'sanitize_text_field'
	) );

	$wp_customize->add_control( 'tdpersona_post_formats_navigation', array(
		'type' => 'select',
		'label' => __( '贴子形式导航', 'tdpersona' ),
		'section' => 'nav',
		'choices' => array(
			'show' => __( '显示', 'tdpersona' ),
			'hide' => __( '隐藏', 'tdpersona' ),
		)
	) );

	/**
	* Blog Settings
 	*/
 	$wp_customize->add_section( 'tdpersona_blog_settings', array(
     	'title'    => __( '博客设置', 'tdpersona' ),
     	'priority' => 2000,
	) );

	/* Blog Layout */
	$wp_customize->add_setting( 'tdpersona_blog_date_format', array(
        'default' => 'mdy',
        'sanitize_callback' => 'sanitize_text_field'
    ) );

	$wp_customize->add_control( 'tdpersona_blog_date_format', array(
        'type' => 'select',
        'label' => __( '日期格式', 'tdpersona' ),
        'section' => 'tdpersona_blog_settings',
        'choices' => array(
            'mdy' => __( '月-日-年', 'tdpersona' ),
            'dmy' => __( '日-月-年', 'tdpersona' ),
        ),
        'priority' => 1
    ));
}
add_action( 'customize_register', 'tdpersona_customize_register');