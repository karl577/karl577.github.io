<?php
/**Theme Name	: wallstreet
 * Theme Core Functions and Codes
*/	
	/**Includes reqired resources here**/
	define('WEBRITI_TEMPLATE_DIR_URI',get_template_directory_uri());	
	define('WEBRITI_TEMPLATE_DIR',get_template_directory());
	define('WEBRITI_THEME_FUNCTIONS_PATH',WEBRITI_TEMPLATE_DIR.'/functions');	
	require( WEBRITI_THEME_FUNCTIONS_PATH . '/menu/default_menu_walker.php'); 
	require( WEBRITI_THEME_FUNCTIONS_PATH . '/menu/webriti_nav_walker.php');
	require( WEBRITI_THEME_FUNCTIONS_PATH . '/breadcrumbs/breadcrumbs.php');
	require( WEBRITI_THEME_FUNCTIONS_PATH . '/font/font.php');
	
	
	//Customizer 
	require( WEBRITI_THEME_FUNCTIONS_PATH . '/customizer/customizer-service.php');
	require( WEBRITI_THEME_FUNCTIONS_PATH . '/customizer/customizer-slider.php');
	require( WEBRITI_THEME_FUNCTIONS_PATH . '/customizer/customizer-copyright.php');
	require( WEBRITI_THEME_FUNCTIONS_PATH . '/customizer/customizer-home.php');
	require( WEBRITI_THEME_FUNCTIONS_PATH . '/customizer/customizer-project.php');
	require( WEBRITI_THEME_FUNCTIONS_PATH . '/customizer/customizer-social.php');
	require( WEBRITI_THEME_FUNCTIONS_PATH . '/customizer/customizer-blog.php');
	require( WEBRITI_THEME_FUNCTIONS_PATH . '/customizer/customizer-pro.php');
	require( WEBRITI_THEME_FUNCTIONS_PATH . '/customizer/customizer-heading.php');
	require( WEBRITI_THEME_FUNCTIONS_PATH . '/customizer/customizer-feature.php');
	require( WEBRITI_THEME_FUNCTIONS_PATH . '/customizer/customizer-testimonial.php');
	require( WEBRITI_THEME_FUNCTIONS_PATH . '/customizer/customizer-client.php');
	require( WEBRITI_THEME_FUNCTIONS_PATH . '/customizer/customizer-template.php');
	require( WEBRITI_THEME_FUNCTIONS_PATH . '/customizer/customizer-typography.php');
	require( WEBRITI_THEME_FUNCTIONS_PATH . '/customizer/customizer-help.php');
	
	
	
	
	
	
	
	
	//wp title tag starts here
	function wallstreet_head( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name', 'display' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() )
		$title = "$title $sep " . sprintf( __( 'Page', 'wallstreet' ), max( $paged, $page ) );

	return $title;
}
	add_filter( 'wp_title', 'wallstreet_head', 10, 2);
	
	add_action( 'after_setup_theme', 'wallstreet_setup' ); 	
	function wallstreet_setup()
	{
		global $content_width;
		if ( ! isset( $content_width ) ) $content_width = 600;//In PX
		
		// Load text domain for translation-ready
		load_theme_textdomain( 'wallstreet', WEBRITI_THEME_FUNCTIONS_PATH . '/lang' );
		
		add_theme_support( 'post-thumbnails' ); //supports featured image
		// This theme uses wp_nav_menu() in one location.
		register_nav_menu( 'primary', __( 'Primary Menu', 'wallstreet' ) ); //Navigation
		// theme support 	
		$args = array('default-color' => '000000',);
		add_theme_support( 'custom-background', $args  ); 
		add_theme_support( 'automatic-feed-links');
		
		//Add theme Support Title Tag
		add_theme_support( 'title-tag');
		
		require_once('theme_setup_data.php');

		add_action('wp_enqueue_scripts', 'webriti_scripts');
		if ( is_singular() ){ wp_enqueue_script( "comment-reply" );	}
	}
	// Read more tag to formatting in blog page 	
	function new_content_more($more)
	{  global $post;
		return '<div class=\"blog-btn-col\"><a href="' . get_permalink() . "#more-{$post->ID}\" class=\"blog-btn\">".__('Read More','wallstreet').'</a></div>';
	}   
	add_filter( 'the_content_more_link', 'new_content_more' );

	/*sidebar*/
add_action( 'widgets_init', 'webriti_widgets_init');
function webriti_widgets_init() {
register_sidebar( array(
		'name' => __( 'Sidebar widget area', 'wallstreet' ),
		'id' => 'sidebar_primary',
		'description' => __( 'Sidebar widget area', 'wallstreet' ),
		'before_widget' => '<div class="sidebar-widget" >',
		'after_widget' => '</div>',
		'before_title' => '<div class="sidebar-widget-title"><h2>',
		'after_title' => '</h2></div>',
	) );

register_sidebar( array(
		'name' => __( 'Footer widget area', 'wallstreet' ),
		'id' => 'footer-widget-area',
		'description' => __( 'Footer widget area', 'wallstreet' ),
		'before_widget' => '<div class="col-md-3 col-sm-6 footer_widget_column">',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="footer_widget_title">',
		'after_title' => '</h2>',
	) );
}

	
	function webriti_add_gravatar_class($class) {
		$class = str_replace("class='avatar", "class='img-responsive comment-img img-circle", $class);
		return $class;
	}
	
	add_filter('get_avatar','webriti_add_gravatar_class');

function webriti_scripts()
{	
	$current_options = get_option('wallstreet_pro_options');
	wp_enqueue_style('wallstreet-style', get_stylesheet_uri() );
	wp_enqueue_style('bootstrap', WEBRITI_TEMPLATE_DIR_URI . '/css/bootstrap.css');
	wp_enqueue_style('wallstreet-default',WEBRITI_TEMPLATE_DIR_URI.'/css/default.css');	
	wp_enqueue_style('wallstreet-theme-menu', WEBRITI_TEMPLATE_DIR_URI . '/css/theme-menu.css');
	wp_enqueue_style('wallstreet-media-responsive', WEBRITI_TEMPLATE_DIR_URI . '/css/media-responsive.css');	
	wp_enqueue_style('wallstreet-font-awesome-min', WEBRITI_TEMPLATE_DIR_URI . '/css/font-awesome/css/font-awesome.min.css');
	wp_enqueue_style('wallstreet-tool-tip', WEBRITI_TEMPLATE_DIR_URI . '/css/css-tooltips.css');
	
	wp_enqueue_script('wallstreet-menu', WEBRITI_TEMPLATE_DIR_URI .'/js/menu/menu.js',array('jquery'));
	wp_enqueue_script('wallstreet-bootstrap', WEBRITI_TEMPLATE_DIR_URI .'/js/bootstrap.min.js');
}	
		// code for comment
		if ( ! function_exists( 'wallstreet_comment' ) ) {
		function wallstreet_comment( $comment, $args, $depth ) 
		{
		$GLOBALS['comment'] = $comment;
		//get theme data
		global $comment_data;
		//translations
		$leave_reply = $comment_data['translation_reply_to_coment'] ? $comment_data['translation_reply_to_coment'] : __('Reply','wallstreet');
	?><div <?php comment_class('media comment_box'); ?> id="comment-<?php comment_ID(); ?>">
			<a class="pull-left-comment" href="<?php the_author_meta('user_url'); ?>">
			<?php echo get_avatar( $comment , 70); ?>		
			</a>
			<div class="media-body">
				<div class="comment-detail">
					<h4 class="comment-detail-title"><?php comment_author(); ?><span class="comment-date"><a href="<?php echo get_comment_link( $comment->comment_ID );?>"><?php _e('Posted on &nbsp;', 'wallstreet'); ?><?php echo comment_time('g:i a'); ?><?php echo " - "; echo comment_date('M j, Y');?></a></span></h4>
					<?php comment_text(); ?>
					<?php edit_comment_link( __( 'Edit', 'wallstreet' ), '<p class="edit-link">', '</p>' ); ?>
					<div class="reply">
						<?php comment_reply_link(array_merge( $args, array('reply_text' => $leave_reply,'depth' => $depth, 'max_depth' => $args['max_depth'], 'per_page' => $args['per_page']))) ?>
					</div>					
					<?php if ( $comment->comment_approved == '0' ) : ?>
					<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.','wallstreet' ); ?></em>
					<br/>
					<?php endif; ?>				
				</div>
			</div>
		</div>
	<?php } }// end of wallstreet_comment function 
add_action('wp_head','head_enqueue_custom_css');
function head_enqueue_custom_css()
{
	$wallstreet_pro_options=theme_data_setup(); 
	$current_options = wp_parse_args(  get_option( 'wallstreet_pro_options', array() ), $wallstreet_pro_options ); 
	if($current_options['webrit_custom_css']!='') {  ?>
	<style>
	<?php echo $current_options['webrit_custom_css']; ?>
	</style>
<?php } } 

function wallstreet_custmizer_style()
 {
		wp_enqueue_style('wallstreet-customizer-css',WEBRITI_TEMPLATE_DIR_URI.'/css/cust-style.css');
}
add_action('customize_controls_print_styles','wallstreet_custmizer_style'); 

/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @see http://tgmpluginactivation.com/configuration/ for detailed documentation.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.6.1 for child theme Wallstreet for publication on WordPress.org
 * @author     Thomas Griffin, Gary Jones, Juliette Reinders Folmer
 * @copyright  Copyright (c) 2011, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/TGMPA/TGM-Plugin-Activation
 */

/**
 * Include the TGM_Plugin_Activation class.
 *
 * Depending on your implementation, you may want to change the include call:
 *
 * Parent Theme:
 * require_once get_template_directory() . '/path/to/class-tgm-plugin-activation.php';
 *
 * Child Theme:
 * require_once get_stylesheet_directory() . '/path/to/class-tgm-plugin-activation.php';
 *
 * Plugin:
 * require_once dirname( __FILE__ ) . '/path/to/class-tgm-plugin-activation.php';
 */
require_once get_template_directory() . '/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'wallstreet_register_required_plugins' );

/**
 * Register the required plugins for this theme.
 *
 * In this example, we register five plugins:
 * - one included with the TGMPA library
 * - two from an external source, one from an arbitrary source, one from a GitHub repository
 * - two from the .org repo, where one demonstrates the use of the `is_callable` argument
 *
 * The variables passed to the `tgmpa()` function should be:
 * - an array of plugin arrays;
 * - optionally a configuration array.
 * If you are not changing anything in the configuration array, you can remove the array and remove the
 * variable from the function call: `tgmpa( $plugins );`.
 * In that case, the TGMPA default settings will be used.
 *
 * This function is hooked into `tgmpa_register`, which is fired on the WP `init` action on priority 10.
 */
function wallstreet_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(

		
		 // This is an example of how to include a plugin from the WordPress Plugin Repository.
		array(
            'name'      => 'Custom FaceBook Feed',
            'slug'      => 'facebook-feed',
            'required'  => false,
        ),
		array(
            'name'      => 'Easy Testimonials Plugin By Webriti',
            'slug'      => 'wp-easy-testimonial',
            'required'  => false,
        )
		

	);

	/*
	 * Array of configuration settings. Amend each line as needed.
	 *
	 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
	 * strings available, please help us make TGMPA even better by giving us access to these translations or by
	 * sending in a pull-request with .po file(s) with the translations.
	 *
	 * Only uncomment the strings in the config array if you want to customize the strings.
	 */
	$config = array(
		'id'           => 'wallstreet',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.

		/*
		'strings'      => array(
			'page_title'                      => __( 'Install Required Plugins', 'wallstreet' ),
			'menu_title'                      => __( 'Install Plugins', 'wallstreet' ),
			/* translators: %s: plugin name. * /
			'installing'                      => __( 'Installing Plugin: %s', 'wallstreet' ),
			/* translators: %s: plugin name. * /
			'updating'                        => __( 'Updating Plugin: %s', 'wallstreet' ),
			'oops'                            => __( 'Something went wrong with the plugin API.', 'wallstreet' ),
			'notice_can_install_required'     => _n_noop(
				/* translators: 1: plugin name(s). * /
				'This theme requires the following plugin: %1$s.',
				'This theme requires the following plugins: %1$s.',
				'wallstreet'
			),
			'notice_can_install_recommended'  => _n_noop(
				/* translators: 1: plugin name(s). * /
				'This theme recommends the following plugin: %1$s.',
				'This theme recommends the following plugins: %1$s.',
				'wallstreet'
			),
			'notice_ask_to_update'            => _n_noop(
				/* translators: 1: plugin name(s). * /
				'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.',
				'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.',
				'wallstreet'
			),
			'notice_ask_to_update_maybe'      => _n_noop(
				/* translators: 1: plugin name(s). * /
				'There is an update available for: %1$s.',
				'There are updates available for the following plugins: %1$s.',
				'wallstreet'
			),
			'notice_can_activate_required'    => _n_noop(
				/* translators: 1: plugin name(s). * /
				'The following required plugin is currently inactive: %1$s.',
				'The following required plugins are currently inactive: %1$s.',
				'wallstreet'
			),
			'notice_can_activate_recommended' => _n_noop(
				/* translators: 1: plugin name(s). * /
				'The following recommended plugin is currently inactive: %1$s.',
				'The following recommended plugins are currently inactive: %1$s.',
				'wallstreet'
			),
			'install_link'                    => _n_noop(
				'Begin installing plugin',
				'Begin installing plugins',
				'wallstreet'
			),
			'update_link' 					  => _n_noop(
				'Begin updating plugin',
				'Begin updating plugins',
				'wallstreet'
			),
			'activate_link'                   => _n_noop(
				'Begin activating plugin',
				'Begin activating plugins',
				'wallstreet'
			),
			'return'                          => __( 'Return to Required Plugins Installer', 'wallstreet' ),
			'plugin_activated'                => __( 'Plugin activated successfully.', 'wallstreet' ),
			'activated_successfully'          => __( 'The following plugin was activated successfully:', 'wallstreet' ),
			/* translators: 1: plugin name. * /
			'plugin_already_active'           => __( 'No action taken. Plugin %1$s was already active.', 'wallstreet' ),
			/* translators: 1: plugin name. * /
			'plugin_needs_higher_version'     => __( 'Plugin not activated. A higher version of %s is needed for this theme. Please update the plugin.', 'wallstreet' ),
			/* translators: 1: dashboard link. * /
			'complete'                        => __( 'All plugins installed and activated successfully. %1$s', 'wallstreet' ),
			'dismiss'                         => __( 'Dismiss this notice', 'wallstreet' ),
			'notice_cannot_install_activate'  => __( 'There are one or more required or recommended plugins to install, update or activate.', 'wallstreet' ),
			'contact_admin'                   => __( 'Please contact the administrator of this site for help.', 'wallstreet' ),

			'nag_type'                        => '', // Determines admin notice type - can only be one of the typical WP notice classes, such as 'updated', 'update-nag', 'notice-warning', 'notice-info' or 'error'. Some of which may not work as expected in older WP versions.
		),
		*/
	);

	tgmpa( $plugins, $config );
}
?>