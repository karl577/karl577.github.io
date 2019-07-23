<?php
function wallstreet_features_customizer( $wp_customize ) {

class wallstreet_Customize_feature_upgrade extends WP_Customize_Control {
		public function render_content() { ?>
        <h3><?php _e('Want to add a theme feature section? Then upgrade to Pro.','wallstreet'); ?><a href="<?php echo esc_url( 'http://www.webriti.com/wallstreet' ); ?>" target="_blank"><?php _e('Upgrade to Pro','wallstreet'); ?> </a>  
		<?php
		}
	}
 
//Service section panel
$wp_customize->add_panel( 'wallstreet_features_options', array(
		'priority'       => 850,
		'capability'     => 'edit_theme_options',
		'title'      => __('Theme feature settings', 'wallstreet'),
	) );

	
	$wp_customize->add_section( 'features_section' , array(
		'title'      => __('Theme feature settings', 'wallstreet'),
		'panel'  => 'wallstreet_features_options',
		'priority'   => 50,
   	) );
	
	
	$wp_customize->add_setting( 'wallstreet_pro_options[theme_upgrade]', array(
		'default'				=> false,
		'capability'			=> 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
	));
	$wp_customize->add_control(
		new wallstreet_Customize_feature_upgrade(
		$wp_customize,
		'wallstreet_pro_options[theme_upgrade]',
			array(
				'label'					=> __('WallStreet upgrade','wallstreet'),
				'section'				=> 'features_section',
				'settings'				=> 'wallstreet_pro_options[theme_upgrade]',
			)
		)
	);
	
	
	// Enable/disable Feature Section
	
	$wp_customize->add_setting(
    'wallstreet_pro_options[theme_feature_enabled]',
    array(
        'default' => false,
		'type' => 'option',
		'sanitize_callback' => 'sanitize_text_field',
		
    )
	);

	$wp_customize->add_control(
    'wallstreet_pro_options[theme_feature_enabled]',
    array(
        'type' => 'checkbox',
        'label' => __('Check to enable a theme-featured section on the homepage.','wallstreet'),
        'section' => 'features_section',
		
		));
		
		
	//Feature image
    $wp_customize->add_setting( 'wallstreet_pro_options[theme_feature_image]', array(
      'sanitize_callback' => 'esc_url_raw',
	  'type' => 'option',
	  'default' =>WEBRITI_TEMPLATE_DIR_URI . "/images/desk-image.png",
    ) );
    
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'wallstreet_pro_options[theme_feature_image]', array(
      'label'    => __( 'Image', 'wallstreet' ),
      'section'  => 'features_section',
      'settings' => 'wallstreet_pro_options[theme_feature_image]',
    ) ) );	
	
	
	//Feature title
	
	$wp_customize->add_setting(
    'wallstreet_pro_options[theme_feature_title]',
    array(
        'default' => __('Core features of theme','wallstreet'),
		'type' => 'option',
		'sanitize_callback' => 'sanitize_text_field',
		
    )
	);

	$wp_customize->add_control(
    'wallstreet_pro_options[theme_feature_title]',
    array(
        'type' => 'text',
        'label' => __('Title','wallstreet'),
        'section' => 'features_section',
		'input_attrs' => array('disabled' => 'disabled')
		
		));
		
	
	//Theme first icon
	$wp_customize->add_setting(
    'wallstreet_pro_options[theme_first_feature_icon]',
    array(
        'default' => 'fa-sliders',
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'type' => 'option'
    )	
	);
	$wp_customize->add_control(
    'wallstreet_pro_options[theme_first_feature_icon]',
    array(
        'label' => __('Icon','wallstreet'),
        'section' => 'features_section',
        'type' => 'text',
		'input_attrs' => array('disabled' => 'disabled')
    )
	);
	
	//First Feature Title:
	
	$wp_customize->add_setting(
    'wallstreet_pro_options[theme_first_title]',
    array(
        'default' => __('Incredibly flexible','wallstreet'),
		'sanitize_callback' => 'sanitize_text_field',
		'type' => 'option'
    )	
	);
	$wp_customize->add_control(
    'wallstreet_pro_options[theme_first_title]',
    array(
        'label' => __('Title','wallstreet'),
        'section' => 'features_section',
        'type' => 'text',
		'sanitize_callback' => 'sanitize_text_field',
		'input_attrs' => array('disabled' => 'disabled')
    )
	);
	
	//First Feature Description:
	
	$wp_customize->add_setting(
    'wallstreet_pro_options[theme_first_description]',
    array(
        'default' => 'Perspiciatis unde omnis iste natus error sit voluptaem omnis iste.',
		'sanitize_callback' => 'sanitize_text_field',
		'type' => 'option'
    )	
	);
	$wp_customize->add_control(
    'wallstreet_pro_options[theme_first_description]',
    array(
        'label' => __('Description','wallstreet'),
        'section' => 'features_section',
        'type' => 'text',
		'sanitize_callback' => 'sanitize_text_field',
		'input_attrs' => array('disabled' => 'disabled')
    )
	);
	
	//Second feature section
	//Theme second icon
	$wp_customize->add_setting(
    'wallstreet_pro_options[theme_second_feature_icon]',
    array(
        'default' => 'fa-paper-plane-o',
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'type' => 'option'
    )	
	);
	$wp_customize->add_control(
    'wallstreet_pro_options[theme_second_feature_icon]',
    array(
        'label' => __('Icon','wallstreet'),
        'section' => 'features_section',
        'type' => 'text',
		'input_attrs' => array('disabled' => 'disabled')
    )
	);
	
	//second Feature Title:
	
	$wp_customize->add_setting(
    'wallstreet_pro_options[theme_second_title]',
    array(
        'default' => __('Incredibly flexible','wallstreet'),
		'sanitize_callback' => 'sanitize_text_field',
		'type' => 'option'
    )	
	);
	$wp_customize->add_control(
    'wallstreet_pro_options[theme_second_title]',
    array(
        'label' => __('Title','wallstreet'),
        'section' => 'features_section',
        'type' => 'text',
		'sanitize_callback' => 'sanitize_text_field',
		'input_attrs' => array('disabled' => 'disabled')
    )
	);
	
	//second Feature Description:
	
	$wp_customize->add_setting(
    'wallstreet_pro_options[theme_second_description]',
    array(
        'default' => 'Perspiciatis unde omnis iste natus error sit voluptaem omnis iste.',
		'sanitize_callback' => 'sanitize_text_field',
		'type' => 'option'
    )	
	);
	$wp_customize->add_control(
    'wallstreet_pro_options[theme_second_description]',
    array(
        'label' => __('Description','wallstreet'),
        'section' => 'features_section',
        'type' => 'text',
		'sanitize_callback' => 'sanitize_text_field',
		'input_attrs' => array('disabled' => 'disabled')
    )
	);
	
	//Third feature section
	//Theme Third icon
	$wp_customize->add_setting(
    'wallstreet_pro_options[theme_third_feature_icon]',
    array(
        'default' => 'fa-bolt',
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'type' => 'option'
    )	
	);
	$wp_customize->add_control(
    'wallstreet_pro_options[theme_third_feature_icon]',
    array(
        'label' => __('Icon','wallstreet'),
        'section' => 'features_section',
        'type' => 'text',
		'input_attrs' => array('disabled' => 'disabled')
    )
	);
	
	//third Feature Title:
	
	$wp_customize->add_setting(
    'wallstreet_pro_options[theme_third_title]',
    array(
        'default' => __('Shortcodes','wallstreet'),
		'sanitize_callback' => 'sanitize_text_field',
		'type' => 'option'
    )	
	);
	$wp_customize->add_control(
    'wallstreet_pro_options[theme_third_title]',
    array(
        'label' => __('Title','wallstreet'),
        'section' => 'features_section',
        'type' => 'text',
		'sanitize_callback' => 'sanitize_text_field',
		'input_attrs' => array('disabled' => 'disabled')
    )
	);
	
	//third Feature Description:
	
	$wp_customize->add_setting(
    'wallstreet_pro_options[theme_third_description]',
    array(
        'default' => 'Perspiciatis unde omnis iste natus error sit voluptaem omnis iste',
		'sanitize_callback' => 'sanitize_text_field',
		'type' => 'option'
    )	
	);
	$wp_customize->add_control(
    'wallstreet_pro_options[theme_third_description]',
    array(
        'label' => __('Description','wallstreet'),
        'section' => 'features_section',
        'type' => 'text',
		'sanitize_callback' => 'sanitize_text_field',
		'input_attrs' => array('disabled' => 'disabled')
    )
	);
	

}
add_action( 'customize_register', 'wallstreet_features_customizer' );
?>