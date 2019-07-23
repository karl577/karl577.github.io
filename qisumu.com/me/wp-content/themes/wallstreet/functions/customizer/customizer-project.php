<?php
function wallstreet_project_customizer( $wp_customize ) {

//Home project Section
	$wp_customize->add_panel( 'wallstreet_project_setting', array(
		'priority'       => 700,
		'capability'     => 'edit_theme_options',
		'title'      => __('Project settings', 'wallstreet'),
	) );
	
	$wp_customize->add_section(
        'project_section_settings',
        array(
            'title' => __('Project settings','wallstreet'),
            'description' => '',
			'panel'  => 'wallstreet_project_setting',)
    );
	
	
	//Show and hide Project section
	$wp_customize->add_setting(
	'wallstreet_pro_options[portfolio_section_enabled]'
    ,
    array(
        'default' => true,
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'type' => 'option',
    )	
	);
	$wp_customize->add_control(
    'wallstreet_pro_options[portfolio_section_enabled]',
    array(
        'label' => __('Enable portfolio section on homepage (project section)','wallstreet'),
        'section' => 'project_section_settings',
        'type' => 'checkbox',
    )
	);
	
	
	//Project one Title
	$wp_customize->add_setting(
	'wallstreet_pro_options[portfolio_title_one]', array(
        'default'        => __('WallStreet style','wallstreet'),
        'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'type' => 'option',
    ));
    $wp_customize->add_control('wallstreet_pro_options[portfolio_title_one]', array(
        'label'   => __('Title', 'wallstreet'),
        'section' => 'project_one_section_settings',
		'type' => 'text',
    ));
	
	
	//Project one description
	$wp_customize->add_setting(
    'wallstreet_pro_options[portfolio_description_one]',
    array(
        'default' => __('A wonderful serenity has taken possession of my entire soul, like these sweet mornings.','wallstreet'),
		 'capability'     => 'edit_theme_options',
		 'sanitize_callback' => 'sanitize_text_field',
		 'type' => 'option'
    )	
	);
	$wp_customize->add_control(
    'wallstreet_pro_options[portfolio_description_one]',
    array(
        'label' => __('Description','wallstreet'),
        'section' => 'project_one_section_settings',
        'type' => 'textarea',	
    )
);
	
	
	//Project Two
	$wp_customize->add_section(
        'project_one_section_settings',
        array(
            'title' => __('Homepage portfolio one','wallstreet'),
            'description' => '',
			'panel'  => 'wallstreet_project_setting',)
    );
	
	//Project one image
	$wp_customize->add_setting( 'wallstreet_pro_options[portfolio_image_one]',array('default' => get_template_directory_uri().'/images/portfolio1.jpg',
	'type' => 'option','sanitize_callback' => 'esc_url_raw',));
 
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'wallstreet_pro_options[portfolio_image_one]',
			array(
				'label' => __('Image','wallstreet'),
				'section' => 'example_section_one',
				'settings' =>'wallstreet_pro_options[portfolio_image_one]',
				'section' => 'project_one_section_settings',
				'type' => 'upload',
			)
		)
	);
	//Project Two
	$wp_customize->add_section(
        'project_two_section_settings',
        array(
            'title' => __('Homepage portfolio two','wallstreet'),
            'description' => '',
			'panel'  => 'wallstreet_project_setting',)
    );
	
	//Project Two Title
	$wp_customize->add_setting(
	'wallstreet_pro_options[portfolio_title_two]', array(
        'default'        => __('WallStreet style','wallstreet'),
        'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'type' => 'option',
    ));
    $wp_customize->add_control('wallstreet_pro_options[portfolio_title_two]', array(
        'label'   => __('Title', 'wallstreet'),
        'section' => 'project_two_section_settings',
		'type' => 'text',
    ));
	
	//Project two description
	$wp_customize->add_setting(
    'wallstreet_pro_options[portfolio_description_two]',
    array(
        'default' => __('A wonderful serenity has taken possession of my entire soul, like these sweet mornings.','wallstreet'),
		 'capability'     => 'edit_theme_options',
		 'sanitize_callback' => 'sanitize_text_field',
		 'type' => 'option'
    )	
	);
	$wp_customize->add_control(
    'wallstreet_pro_options[portfolio_description_two]',
    array(
        'label' => __('Description','wallstreet'),
        'section' => 'project_two_section_settings',
        'type' => 'textarea',	
    )
);
	
	//Project two image
	$wp_customize->add_setting( 'wallstreet_pro_options[portfolio_image_two]',array('default' => get_template_directory_uri().'/images/portfolio2.jpg','type' => 'option','sanitize_callback' => 'esc_url_raw',));	
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'wallstreet_pro_options[portfolio_image_two]',
			array(
				'label' => __('Image','wallstreet'),
				'section' => 'example_section_one',
				'settings' =>'wallstreet_pro_options[portfolio_image_two]',
				'section' => 'project_two_section_settings',
				'type' => 'upload',
			)
		)
	);
	
	//Project Three section
	$wp_customize->add_section(
        'project_three_section_settings',
        array(
            'title' => __('Homepage portfolio three','wallstreet'),
            'description' => '',
			'panel'  => 'wallstreet_project_setting',)
    );
	
	
	
	//Project Three Title
	$wp_customize->add_setting(
	'wallstreet_pro_options[portfolio_title_three]', array(
       'default'        => __('WallStreet style','wallstreet'),
        'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'type' => 'option',
    ));
    $wp_customize->add_control('wallstreet_pro_options[portfolio_title_three]', array(
        'label'   => __('Title', 'wallstreet'),
        'section' => 'project_three_section_settings',
		'type' => 'text',
    ));
	
	//Project three description
	$wp_customize->add_setting(
    'wallstreet_pro_options[portfolio_description_three]',
    array(
        'default' => __('A wonderful serenity has taken possession of my entire soul, like these sweet mornings.','wallstreet'),
		 'capability'     => 'edit_theme_options',
		 'sanitize_callback' => 'sanitize_text_field',
		 'type' => 'option'
    )	
	);
	$wp_customize->add_control(
    'wallstreet_pro_options[portfolio_description_three]',
    array(
        'label' => __('Description','wallstreet'),
        'section' => 'project_three_section_settings',
        'type' => 'textarea',	
    )
);
	
	//Project three image
	$wp_customize->add_setting( 'wallstreet_pro_options[portfolio_image_three]',array('default' => get_template_directory_uri().'/images/portfolio3.jpg','type' => 'option','sanitize_callback' => 'esc_url_raw',));
 
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'wallstreet_pro_options[portfolio_image_three]',
			array(
				'label' => __('Image','wallstreet'),
				'section' => 'example_section_one',
				'settings' =>'wallstreet_pro_options[portfolio_image_three]',
				'section' => 'project_three_section_settings',
				'type' => 'upload',
			)
		)
	);
	
	
	//Project Four section
	$wp_customize->add_section(
        'project_four_section_settings',
        array(
            'title' => __('Homepage portfolio four','wallstreet'),
            'description' => '',
			'panel'  => 'wallstreet_project_setting',)
    );
	
	//Project Four Title
	$wp_customize->add_setting(
	'wallstreet_pro_options[portfolio_title_four]', array(
       'default'        => __('WallStreet style','wallstreet'),
        'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
		'type' => 'option',
    ));
    $wp_customize->add_control('wallstreet_pro_options[portfolio_title_four]', array(
        'label'   => __('Title', 'wallstreet'),
        'section' => 'project_four_section_settings',
		'type' => 'text',
    ));
	
	//Project four description
	$wp_customize->add_setting(
    'wallstreet_pro_options[portfolio_description_four]',
    array(
        'default' => __('A wonderful serenity has taken possession of my entire soul, like these sweet mornings.','wallstreet'),
		 'capability'     => 'edit_theme_options',
		 'sanitize_callback' => 'sanitize_text_field',
		 'type' => 'option'
    )	
	);
	$wp_customize->add_control(
    'wallstreet_pro_options[portfolio_description_four]',
    array(
        'label' => __('Description','wallstreet'),
        'section' => 'project_four_section_settings',
        'type' => 'textarea',	
    )
);
	
	//Project Four image
	$wp_customize->add_setting( 'wallstreet_pro_options[portfolio_image_four]',array('default' => get_template_directory_uri().'/images/portfolio4.jpg','type' => 'option','sanitize_callback' => 'esc_url_raw',));
 
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'wallstreet_pro_options[portfolio_image_four]',
			array(
				'label' => __('Image','wallstreet'),
				'section' => 'example_section_one',
				'settings' =>'wallstreet_pro_options[portfolio_image_four]',
				'section' => 'project_four_section_settings',
				'type' => 'upload',
			)
		)
	);
	
	
	$wp_customize->add_section( 'more_project' , array(
		'title'      => __('Add More Projects', 'wallstreet'),
		'panel'  => 'wallstreet_project_setting',
		'priority'   => 400,
   	) );
	
	class WP_project_Customize_Control extends WP_Customize_Control {
    public $type = 'new_menu';
    /**
    * Render the control's content.
    */
    public function render_content() {
    ?>
     <div class="pro-vesrion">
	 <P><?php _e('Want to add more projects and categorizations? Then upgrade to Pro.','wallstreet');?></P>
	 </div>
	  <div class="pro-box">
	 <a href="<?php echo 'http://webriti.com/wallstreet/';?>" target="_blank" class="service" id="review_pro"><?php _e('Upgrade to Pro','wallstreet' ); ?></a>
	 <div>
    <?php
    }
}

$wp_customize->add_setting(
    'project_pro',
    array(
        'default' => '',
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
    )	
);
$wp_customize->add_control( new WP_project_Customize_Control( $wp_customize, 'project_pro', array(	
		'section' => 'more_project',
		'setting' => 'project_pro',
    ))
);
}		
	add_action( 'customize_register', 'wallstreet_project_customizer' );
?>