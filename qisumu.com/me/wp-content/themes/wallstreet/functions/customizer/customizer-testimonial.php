<?php
function wallstreet_testimonial_customizer( $wp_customize ) {
class wallstreet_Customize_testimonial_section_upgrade extends WP_Customize_Control {
		public function render_content() { ?>
        <h3><?php _e('Want to add a testimonial? Then upgrade to Pro.','wallstreet'); ?><a href="<?php echo 'http://www.webriti.com/wallstreet'; ?>" target="_blank"><?php _e('Upgrade to Pro','wallstreet'); ?> </a>  
		<?php
		}
	}

//Home project Section
	$wp_customize->add_panel( 'wallstreet_test_setting', array(
		'priority'       => 850,
		'capability'     => 'edit_theme_options',
		'title'      => __('Testimonial settings','wallstreet'),
	) );
	
	$wp_customize->add_section(
        'test_section_settings',
        array(
            'title' => __('Testimonial settings','wallstreet'),
            'description' => '',
			'panel'  => 'wallstreet_test_setting',)
    );
	
	$wp_customize->add_setting( 'wallstreet_pro_options[testimonial_upgrade]', array(
		'default'				=> false,
		'capability'			=> 'edit_theme_options',
		'sanitize_callback'	=> 'wp_filter_nohtml_kses',
	));
	$wp_customize->add_control(
		new wallstreet_Customize_testimonial_section_upgrade(
		$wp_customize,
		'wallstreet_pro_options[testimonial_upgrade]',
			array(
				'label'					=> __('WallStreet upgrade','wallstreet'),
				'section'				=> 'test_section_settings',
				'settings'				=> 'wallstreet_pro_options[testimonial_upgrade]',
			)
		)
	);
	
	//Testimonial animation
	
	$wp_customize->add_setting(
    'wallstreet_pro_options[testi_slide_type]',
    array(
        'default' => __('scroll','wallstreet'),
		'type' => 'option',
		'sanitize_callback' => 'sanitize_text_field',
    )
	);

	$wp_customize->add_control(
    'wallstreet_pro_options[testi_slide_type]',
    array(
        'type' => 'select',
        'label' => __('Slide type variations','wallstreet'),
        'section' => 'test_section_settings',
		 'choices' => array('scroll'=>__('scroll', 'wallstreet'), 'fade'=>__('fade', 'wallstreet') ,'crossfade'=>__('cross-fade','wallstreet'),'cover-fade' =>__('cover-fade','wallstreet')),
		));
		
	
	//Testimonial Scroll Items
	
	$wp_customize->add_setting(
    'wallstreet_pro_options[testi_scroll_items]',
    array(
        'default' => __('scroll','wallstreet'),
		'type' => 'option',
		'sanitize_callback' => 'sanitize_text_field',
    )
	);

	$wp_customize->add_control(
    'wallstreet_pro_options[testi_scroll_items]',
    array(
        'type' => 'select',
        'label' => __('Scroll Items','wallstreet'),
        'section' => 'test_section_settings',
		 'choices' => array(1=>1,2=>2,3=>3),
		));
		
	//Testimonial Animation speed	
	$wp_customize->add_setting(
    'wallstreet_pro_options[testi_scroll_dura]',
    array(
        'default' => '1500',
		'type' => 'option',
		'sanitize_callback' => 'sanitize_text_field',
		
    )
	);

	$wp_customize->add_control(
    'wallstreet_pro_options[testi_scroll_dura]',
    array(
        'type' => 'select',
        'label' => __('Scroll duration','wallstreet'),
        'section' => 'test_section_settings',
		'priority'   => 300,
		 'choices' => array('500'=>'0.5','1000'=>'1.0','1500'=>'1.5','2000' => '2.0','2500' => '2.5' ,'3000' =>'3.0' , '3500' => '3.5', '4000' => '4.0','4500' => '4.5' ,'5000' => '5.0' , '5500' => '5.5' )));	
		 
	//Testimonail Time out Duration
	$wp_customize->add_setting(
    'wallstreet_pro_options[testi_timeout_dura]',
    array(
        'default' => '2000',
		'type' => 'option',
		'sanitize_callback' => 'sanitize_text_field',
		
    )
	);

	$wp_customize->add_control(
    'wallstreet_pro_options[testi_timeout_dura]',
    array(
        'type' => 'select',
        'label' => __('Time-out duration','wallstreet'),
        'section' => 'test_section_settings',
		'priority'   => 300,
		 'choices' => array('500'=>'0.5','1000'=>'1.0','1500'=>'1.5','2000' => '2.0','2500' => '2.5' ,'3000' =>'3.0' , '3500' => '3.5', '4000' => '4.0','4500' => '4.5' ,'5000' => '5.0' , '5500' => '5.5' )));	
}
		add_action( 'customize_register', 'wallstreet_testimonial_customizer' );
	?>