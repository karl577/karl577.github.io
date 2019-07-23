<?php
// Footer copyright section 
	function wallstreet_copyright_customizer( $wp_customize ) {
	
	$wp_customize->add_section(
        'copyright_section_one',
        array(
            'title' => __('Footer copyright settings','wallstreet'),
            'priority' => 800,
        )
    );
	$wp_customize->add_setting(
    'wallstreet_pro_options[footer_copyright]',
    array(
        'default' => sprintf (__('Copyright @ 2014 - WALL STREET Designed by <a href="%1$s" target="_blank">Webriti</a>.','wallstreet'),'http://www.webriti.com'),
		'type' =>'option',
		'sanitize_callback' => 'wallstreet_copyright_sanitize_text'
		
    )
);
$wp_customize->add_control(
    'wallstreet_pro_options[footer_copyright]',
    array(
        'label' => __('Copyright text','wallstreet'),
        'section' => 'copyright_section_one',
        'type' => 'textarea',
    ));
	
	function wallstreet_copyright_sanitize_text( $input ) {

    return wp_kses_post( force_balance_tags( $input ) );

}
	
	function wallstreet_copyright_sanitize_html( $input ) {

    return force_balance_tags( $input );

}
}
add_action( 'customize_register', 'wallstreet_copyright_customizer' );
?>