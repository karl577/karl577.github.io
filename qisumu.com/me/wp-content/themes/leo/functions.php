<?php //enqueue default.css
add_action( 'wp_enqueue_scripts','leo_theme_css',999);
function leo_theme_css() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
	wp_enqueue_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.css');
	wp_dequeue_style('wallstreet-default',get_template_directory_uri() .'/css/default.css');
	wp_enqueue_style('leo-default', get_stylesheet_directory_uri() . '/css/default.css');
}
?>