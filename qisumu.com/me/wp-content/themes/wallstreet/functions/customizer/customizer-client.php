<?php
function wallstreet_client_customizer( $wp_customize ) {
class wallstreet_Customize_client_upgrade extends WP_Customize_Control {
		public function render_content() { ?>
        <h3><?php _e('Want to add a client section? Then upgrade to Pro.','wallstreet'); ?><a href="<?php echo esc_url( 'http://www.webriti.com/wallstreet' ); ?>" target="_blank"><?php _e('Upgrade to Pro','wallstreet'); ?> </a>  
		<?php
		}
	}

//Front Client section
	$wp_customize->add_section(
        'client_section_settings',
        array(
            'title' => __('Client settings','wallstreet'),
            'description' => '',
			'priority'       => 950,
			)
    );
	
	$wp_customize->add_setting( 'wallstreet_pro_options[client_upgrade]', array(
		'default'				=> false,
		'capability'			=> 'edit_theme_options',
		'sanitize_callback' 	=> 'sanitize_text_field',
	));
	$wp_customize->add_control(
		new wallstreet_Customize_client_upgrade(
		$wp_customize,
		'wallstreet_pro_options[client_upgrade]',
			array(
				'label'					=> __('WallStreet upgrade','wallstreet'),
				'section'				=> 'client_section_settings',
				'settings'				=> 'wallstreet_pro_options[client_upgrade]',
				'input_attrs' => array('disabled' => 'disabled')
			)
		)
	);
	
	//Client title
	$wp_customize ->add_setting (
	'wallstreet_pro_options[home_client_title]',
	array( 
	'default' => __('Our Clients','wallstreet'),
	'capability'     => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	'type' => 'option',
	) );

	$wp_customize->add_control (
	'wallstreet_pro_options[home_client_title]',
	array (  
	'label' => __('Title','wallstreet'),
	'section' => 'client_section_settings',
	'type' => 'text',
	'input_attrs' => array('disabled' => 'disabled')
	) );
	
	//Client Discription
	$wp_customize ->add_setting (
	'wallstreet_pro_options[home_client_description]',
	array( 
	'default' => __('Have a look at our client base. We are growing their business and they are moving up in the market by beating their competitors.','wallstreet'),
	'capability'     => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	'type' => 'option'
	) );

	$wp_customize->add_control (
	'wallstreet_pro_options[home_client_description]',
	array (  
	'label' => __('Description','wallstreet'),
	'section' => 'client_section_settings',
	'type' => 'text',
	'input_attrs' => array('disabled' => 'disabled')
	) );
	}
	add_action( 'customize_register', 'wallstreet_client_customizer' );
	?>