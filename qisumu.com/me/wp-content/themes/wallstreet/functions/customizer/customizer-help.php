<?php
function wallstreet_help_customizer( $wp_customize ) {
$wp_customize->add_section( 'wallstreet_help_section' , array(
		'title'      => __('HELP','wallstreet'),
		'priority'   => 1000,
   	) );

class WP_fur_support_Customize_Control extends WP_Customize_Control {
    public $type = 'new_menu';
    /**
    * Render the control's content.
    */
    public function render_content() {
    ?>
      <div class="pro-box">
	 <a href="<?php echo esc_url('https://wordpress.org/support/theme/wallstreet/');?>" target="_blank" class="document" id="review_pro">
	 <?php _e('THEME SUPPORT','wallstreet' ); ?></a>
	 
	 <div>
	 <div class="pro-vesrion">
	 <?php //_e('Buy the pro version and give us a chance to serve you better.Buy the pro version and give us a chance to serve you better. ','wallstreet');?>
	 </div>
    <?php
    }
}

$wp_customize->add_setting(
    'fur_support',
    array(
		'capability'     => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_text_field',
    )	
);
$wp_customize->add_control( new WP_fur_support_Customize_Control( $wp_customize, 'fur_support', array(	
		'section' => 'wallstreet_help_section',
		'setting' => 'fur_support',
    ))
);

}
add_action( 'customize_register', 'wallstreet_help_customizer' );
?>