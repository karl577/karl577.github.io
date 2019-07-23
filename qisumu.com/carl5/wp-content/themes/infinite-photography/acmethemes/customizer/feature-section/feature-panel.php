<?php
/*adding feature options panel*/
$wp_customize->add_panel( 'infinite-photography-feature-panel', array(
    'priority'       => 105,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Featured Section Options', 'infinite-photography' ),
    'description'    => __( 'Customize your awesome site feature section ', 'infinite-photography' )
) );

/*
* file for feature section enable
*/
$infinite_photography_customizer_feature_enable_file_path = infinite_photography_file_directory('acmethemes/customizer/feature-section/feature-enable.php');
require $infinite_photography_customizer_feature_enable_file_path;

/*adding header image inside this panel*/
$wp_customize->get_section( 'header_image' )->panel = 'infinite-photography-feature-panel';
$wp_customize->get_section( 'header_image' )->description = __( 'Applied to the header image on home/front page', 'infinite-photography' );
$wp_customize->remove_control( 'display_header_text' );