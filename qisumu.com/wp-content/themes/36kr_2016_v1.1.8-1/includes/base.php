<?php
date_default_timezone_set('PRC'); 

$options = get_option('monkey-options');
global $wpdb;
$var = $wpdb->query("SELECT qqid FROM $wpdb->users");
if(!$var){
	$wpdb->query("ALTER TABLE $wpdb->users ADD qqid varchar(50)");
}
$var1 = $wpdb->query("SELECT sinaid FROM $wpdb->users");
if(!$var1){
 $wpdb->query("ALTER TABLE $wpdb->users ADD sinaid varchar(50)");
}


remove_action( 'wp_head',   'feed_links_extra', 3 ); 
remove_action( 'wp_head',   'rsd_link' ); 
remove_action( 'wp_head',   'wlwmanifest_link' ); 
remove_action( 'wp_head',   'index_rel_link' ); 
remove_action( 'wp_head',   'start_post_rel_link', 10, 0 ); 
remove_action( 'wp_head',   'wp_generator' ); 

add_filter('show_admin_bar','hide_admin_bar');
function hide_admin_bar($flag) {
	return false;
}

function my_enqueue_scripts() {
	wp_deregister_script('jquery');
}
add_action( 'wp_enqueue_scripts', 'my_enqueue_scripts', 1 );

function remove_open_sans() {
wp_deregister_style( 'open-sans' );
wp_register_style( 'open-sans', false );
wp_enqueue_style('open-sans', '');
}
add_action( 'init', 'remove_open_sans' );


if($options['pingback']){
	add_action('pre_ping','monkey_noself_ping');   
}

function selfURL(){  
    $pageURL = 'http';
    $pageURL .= (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on")?"s":"";
    $pageURL .= "://";
    $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
    return $pageURL;      
}


function MBT_add_querystring_var($url, $key, $value) {
    $url = preg_replace('/(.*)(?|&)' . $key . '=[^&]+?(&)(.*)/i', '$1$2$4', $url . '&');
    $url = substr($url, 0, -1);
    if (strpos($url, '?') === false) {
        return ($url . '?' . $key . '=' . $value);
    } else {
        return ($url . '&' . $key . '=' . $value);
    }
}

function mbthemes_strip_tags($content){
	if($content){
		$content = preg_replace("/\[.*?\].*?\[\/.*?\]/is", "", $content);
	}
	return strip_tags($content);
}

add_action('template_redirect', 'redirect_single_post');
function redirect_single_post() {
	if (is_search()) {
		global $wp_query;
		if ($wp_query->post_count == 1 && $wp_query->max_num_pages == 1) {
			wp_redirect( get_permalink( $wp_query->posts['0']->ID ) );
			exit;
		}
	}
}

function mbthemes_filter_images($content){
	if($content){
		$content = preg_replace("/<img[^>]+\>/i", "", $content);
	}
	return $content;
}

function monkey_noself_ping( &$links ) {
  $home = get_option( 'home' );
  foreach ( $links as $l => $link )
  if ( 0 === strpos( $link, $home ) )
  unset($links[$l]);
}		

function custom_toolbar_link($wp_admin_bar) {$args = array('id' => 'themeset','title' => '主题设置', 'href' => admin_url("admin.php?page=monkey-option"),'meta' => array('class' => 'gmail', 'title' => '主题设置','target' => '_blank'));
if(current_user_can('level_10')){ $wp_admin_bar->add_node($args);}}add_action('admin_bar_menu', 'custom_toolbar_link', 999);

function mbt_domain_can_use(){
	return "1";
}

function time_ago( $type = 'commennt', $day = 7 ) {
  $d = $type == 'post' ? 'get_post_time' : 'get_comment_time';
  //if (time() - $d('U') > 60*60*24*$day) return;
  echo '', human_time_diff($d('U'), strtotime(current_time('mysql', 0))), '前';
}

function timeago( $ptime ) {
    $ptime = strtotime($ptime);
    $etime = time() - 28800 - $ptime;
    if($etime < 1) return '刚刚';
    $interval = array (
        12 * 30 * 24 * 60 * 60  =>  '年前 ('.date('Y-m-d', $ptime).')',
        30 * 24 * 60 * 60       =>  '个月前 ('.date('m-d', $ptime).')',
        7 * 24 * 60 * 60        =>  '周前 ('.date('m-d', $ptime).')',
        24 * 60 * 60            =>  '天前',
        60 * 60                 =>  '小时前',
        60                      =>  '分钟前',
        1                       =>  '秒前'
    );
    foreach ($interval as $secs => $str) {
        $d = $etime / $secs;
        if ($d >= 1) {
            $r = round($d);
            return $r . $str;
        }
    };
}







//评论样式
function monkey_comment_list($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	   $comorder =  get_option('comment_order');
	   if($comorder == 'asc'){
		 global $commentcount,$wpdb, $post;
		 if(!$commentcount) { 
			  $comments = $wpdb->get_results("SELECT * FROM $wpdb->comments WHERE comment_post_ID = $post->ID AND comment_type = '' AND comment_approved = '1' AND !comment_parent"); 
			  $cnt = count($comments);
			  $page = get_query_var('cpage');
			  $cpp=get_option('comments_per_page');
			 if (ceil($cnt / $cpp) == 1 ) {
				 $commentcount = 0;
			 } else {
				 $commentcount = $cpp * ($page-1);
			 }
		 }
	   }else{
		  global $commentcount,$wpdb, $post;
		  if(!$commentcount) { 
			  $comments = $wpdb->get_results("SELECT * FROM $wpdb->comments WHERE comment_post_ID = $post->ID AND comment_type = '' AND comment_approved = '1' AND !comment_parent"); 
			  $cnt = count($comments);
			  $page = get_query_var('cpage');
			  $cpp=get_option('comments_per_page');
			 if (ceil($cnt / $cpp) == 1 || ($page > 1 && $page  == ceil($cnt / $cpp))) {
				 $commentcount = $cnt+1;
			 } else {
				 $commentcount = $cpp * ($page)+1;
			 }
		  }
	   }
	   
	   echo '<li><div class="comment cf comment_details" id="comment-'.get_comment_ID().'">
        <div class="avatar left"><a href="javascript:void(0)"><img alt="'.$comment->comment_author.'" class="before-fade-in after-fade-in" src="'.MBT_monkey_get_avatar($comment->user_id).'"></a></div>
        <div class="comment-wrapper">
          <div class="postmeta"><a class="user_info_name" href="javascript:void(0)">'.$comment->comment_author.'</a>&nbsp;•&nbsp;
            <time class="timeago" datetime="'.$comment->comment_date.'"> '.timeago($comment->comment_date).'</time>';
			comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) );
          echo '</div>
          <div class="commemt-main">
            <p>'.get_comment_text().'</p>
          </div>
          <div class="opts"></div>
        </div>
      </div>';	
}

if ( ! function_exists( 'monkey_views' ) ) :
function monkey_record_visitors(){
	if (is_singular()) 
	{
	  global $post;
	  $post_ID = $post->ID;
	  if($post_ID) 
	  {
		  $post_views = (int)get_post_meta($post_ID, 'views', true);
		  if(!update_post_meta($post_ID, 'views', ($post_views+1))) 
		  {
			add_post_meta($post_ID, 'views', 1, true);
		  }
	  }
	}
}
add_action('wp_head', 'monkey_record_visitors');  

function monkey_views($after=''){
  global $post;
  $post_ID = $post->ID;
  $views = (int)get_post_meta($post_ID, 'views', true);
  echo $views, $after;
}
endif;

add_action('after_switch_theme', 'mbInit_theme');
function mbInit_theme($oldthemename){
  global $pagenow;

  if ( 'themes.php' == $pagenow && isset( $_GET['activated'] ) ) {
    wp_redirect( admin_url( "admin.php?page=monkey-option" ) );
    exit;
  }
}


if (function_exists('register_nav_menus')){
	register_nav_menus( array(
		'header' => __('主菜单')
	));
	register_nav_menus( array(
		'cat' => __('分类菜单')
	));

	register_nav_menus( array(
		'user' => __('用户中心菜单')
	));
}

if ( function_exists('register_sidebar') ){
	register_sidebar(array(
		'name'=>'首页侧边栏',
		'id' => 'sidebar-index',
		'before_widget' => '<div class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>'
	));
	register_sidebar(array(
		'name'=>'文章侧边栏',
		'id' => 'sidebar-single',
		'before_widget' => '<div class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>'
	));
	register_sidebar(array(
		'name'=>'其他侧边栏',
		'id' => 'sidebar-other',
		'before_widget' => '<section class="widget %2$s">',
		'after_widget' => '</section>',
		'before_title' => '<h3>',
		'after_title' => '</h3>'
	));
	register_sidebar(array(
		'name'=>'底部小工具',
		'id' => 'sidebar-footer',
		'before_widget' => '<section class="widget-foot %2$s">',
		'after_widget' => '</section>',
		'before_title' => '<h3>',
		'after_title' => '</h3>'
	));
}

function monkey_keywords() {
  global $s, $post;
  $options = get_option('monkey-options');
  $keywords = '';
  if ( is_single() ) {
	if ( get_the_tags( $post->ID ) ) {
	  foreach ( get_the_tags( $post->ID ) as $tag ) $keywords .= $tag->name . ', ';
	}
	foreach ( get_the_category( $post->ID ) as $category ) $keywords .= $category->cat_name . ', ';
	$keywords = substr_replace( $keywords , '' , -2);
  } elseif ( is_home () )    { $keywords = $options['keywords'];
  } elseif ( is_tag() )      { $keywords = single_tag_title('', false);
  } elseif ( is_category() ) { $keywords = single_cat_title('', false);
  } elseif ( is_search() )   { $keywords = esc_html( $s, 1 );
  } else { $keywords = trim( wp_title('', false) );
  }
  if ( $keywords ) {
	echo "<meta name=\"keywords\" content=\"$keywords\">\n";
  }
}

function monkey_description() {
  global $s, $post;
  $options = get_option('monkey-options');
  $description = '';
  $blog_name = get_bloginfo('name');
  if ( is_singular() ) {
	if( !empty( $post->post_excerpt ) ) {
	  $text = $post->post_excerpt;
	} else {
	  $text = $post->post_content;
	}
	$description = trim( str_replace( array( "\r\n", "\r", "\n", "　", " "), " ", str_replace( "\"", "'", strip_tags( $text ) ) ) );
	if ( !( $description ) ) $description = $blog_name . "-" . trim( wp_title('', false) );
  } elseif ( is_home () )    { $description = $options['description'];
  } elseif ( is_tag() )      { $description = $blog_name . "'" . single_tag_title('', false) . "'";
  } elseif ( is_category() ) { $description = trim(strip_tags(category_description()));
  } elseif ( is_archive() )  { $description = $blog_name . "'" . trim( wp_title('', false) ) . "'";
  } elseif ( is_search() )   { $description = $blog_name . ": '" . esc_html( $s, 1 ) . "' 的搜索結果";
  } else { $description = $blog_name . "'" . trim( wp_title('', false) ) . "'";
  }
  $description = mb_substr( $description, 0, 220, 'utf-8' );
  echo "<meta name=\"description\" content=\"$description\">\n";
}

	
function news_wp_title( $title, $sep ) {
	global $paged, $page;
	if ( is_feed() )
		return $title;
	$title .= get_bloginfo( 'name' );
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'monkey' ), max( $paged, $page ) );
	return $title;
}
add_filter( 'wp_title', 'news_wp_title', 10, 2 );

add_filter( 'pre_option_link_manager_enabled', '__return_true' );
remove_filter('the_content', 'wptexturize');


function newwinlinks($text) {
	$text = preg_replace('/<a (.+?)>/i', "<a $1 target='_blank'>", $text);
	return $text;
}
add_filter('get_comment_author_link', 'newwinlinks', 6);


add_theme_support( 'post-thumbnails' );
function MThemes_thumbnail($width=180, $height=120, $echo=1){
	$options = get_option('monkey-options');
	global $post;
	$title = $post->post_title;
	$dir = get_bloginfo('template_directory');
	$post_img = '';
	if( has_post_thumbnail() ){
        $timthumb_src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'full');
		$src = $timthumb_src[0];
		if($options['timthumb'])
			$post_img_src = "$src";
		else
			$post_img_src = "$dir/timthumb.php&#63;src=$src&#38;w=$width&#38;h=$height&#38;zc=1&#38;q=100";
	}else{
		ob_start();
		ob_end_clean();
		$output = preg_match_all('/\<img.+?src="(.+?)".*?\/>/is',$post->post_content,$matches ,PREG_SET_ORDER);
		$cnt = count( $matches );
		if($cnt>0){
			$src = $matches[0][1];
		}else{ // thumb
			
			$thumbs = $options['thumbs'];
			$cnt = count($thumbs);
			if($cnt >0){ 
				$index = rand(0, $cnt-1);
				$src = $thumbs[$index];
			}else{
				$src = "{$dir}/img/thumbnail.png";
			}
		}
		if($options['timthumb'])
			$post_img_src = "$src";
		else 
			$post_img_src = "$dir/timthumb.php&#63;src=$src&#38;w=$width&#38;h=$height&#38;zc=1&#38;q=100";
	}
	$post_img =$post_img_src;
	return $post_img;
	
}

function MThemes_thumbnail_custom($width=180, $height=120, $postid, $echo=1){
	$options = get_option('monkey-options');
	$dir = get_bloginfo('template_directory');
	$post_img = '';
	if( has_post_thumbnail($postid) ){
        $timthumb_src = wp_get_attachment_image_src(get_post_thumbnail_id($postid),'full');
		$src = $timthumb_src[0];
		if($options['timthumb'])
			$post_img_src = "$src";
		else
			$post_img_src = "$dir/timthumb.php&#63;src=$src&#38;w=$width&#38;h=$height&#38;zc=1&#38;q=100";
	}else{
		ob_start();
		ob_end_clean();
		$output = preg_match_all('/\<img.+?src="(.+?)".*?\/>/is',get_post($postid)->post_content,$matches ,PREG_SET_ORDER);
		$cnt = count( $matches );
		if($cnt>0){
			$src = $matches[0][1];
		}else{ // thumb
			
			$thumbs = $options['thumbs'];
			$cnt = count($thumbs);
			if($cnt >0){ 
				$index = rand(0, $cnt-1);
				$src = $thumbs[$index];
			}else{
				$src = "{$dir}/img/thumbnail.png";
			}
		}
		if($options['timthumb'])
			$post_img_src = "$src";
		else 
			$post_img_src = "$dir/timthumb.php&#63;src=$src&#38;w=$width&#38;h=$height&#38;zc=1&#38;q=100";
	}
	$post_img =$post_img_src;
	return $post_img;
	
}


function MBT_monkey_pagination() {
    $p = 2;
    if ( is_singular() ) return;
    global $wp_query, $paged;
    $max_page = $wp_query->max_num_pages;
    if ( $max_page == 1 ) return; 
    echo '<ul class="pagination-sm pagination ias_pagination ng-isolate-scope ng-valid">';
    if ( empty( $paged ) ) $paged = 1;
    echo '<li class="ng-scope prev-page">'.str_replace("filter=1","",get_previous_posts_link()).'</li>';
    if ( $paged > $p + 1 ) p_link( 1 );
    if ( $paged > $p + 2 ) echo "<li class='ng-scope disabled'><a href=\"#\">···</a></li>";
    for( $i = $paged - $p; $i <= $paged + $p; $i++ ) { 
        if ( $i > 0 && $i <= $max_page ) $i == $paged ? print "<li class=\"ng-scope active\"><a href=\"#\">{$i}</a></li>" : p_link( $i );
    }
    if ( $paged < $max_page - $p - 1 ) echo "<li class='ng-scope disabled'><a href=\"#\">···</a></li>";
	if( $paged < $max_page - $p ) p_link($max_page);
    echo '<li class="ng-scope next-page ias_next-page">'.str_replace("filter=1","",get_next_posts_link()).'</li>';
    echo '</ul>';
}
function MBT_monkey_page_pagination($paged,$max_page) {
    $p = 2;
    if ( $max_page == 1 || $max_page < 1) return; 
    echo '<ul class="pagination-sm pagination ias_pagination ng-isolate-scope ng-valid">';
    if ( empty( $paged ) ) $paged = 1;
    echo '<li class="ng-scope prev-page">'.get_previous_posts_link().'</li>';
    if ( $paged > $p + 1 ) p_link( 1 );
    if ( $paged > $p + 2 ) echo "<li class='ng-scope disabled'><a href=\"#\">···</a></li>";
    for( $i = $paged - $p; $i <= $paged + $p; $i++ ) { 
        if ( $i > 0 && $i <= $max_page ) $i == $paged ? print "<li class=\"ng-scope active\"><a href=\"#\">{$i}</a></li>" : p_link( $i );
    }
    if ( $paged < $max_page - $p - 1 ) echo "<li class='ng-scope disabled'><a href=\"#\">···</a></li>";
	if( $paged < $max_page - $p ) p_link($max_page);
    echo '<li class="ng-scope next-page ias_next-page">'.get_next_posts_link().'</li>';
    echo '</ul>';
}
function p_link( $i) {
    echo "<li class='ng-scope'><a href='", esc_html( str_replace("filter=1","",get_pagenum_link( $i )) ), "'>{$i}</a></li>";
}

function monkey_new_contactmethods( $contactmethods ) { 
	$contactmethods['avatar'] = '头像地址'; 
	return $contactmethods; 
} 
add_filter('user_contactmethods','monkey_new_contactmethods',10,1); 

function monkey_current_user_role($user_id){
	$nick = get_user_meta($user_id,'nick',true);
	if($nick) return $nick;
	else{
	if(user_can($user_id,'install_plugins')){return '主编';}   
	elseif(user_can($user_id,'edit_others_posts')){return '编辑';}
	elseif(user_can($user_id,'publish_posts')){return '作者';}
	elseif(user_can($user_id,'delete_posts')){return '投稿者';}
	elseif(user_can($user_id,'read')){return '订阅者';}  
	else{return '火星人';} 
	}
}

function MBT_monkey_get_avatar($uid){
	$photo = get_user_meta($uid, 'avatar', true);
	if($photo) return $photo;
	else return get_bloginfo('template_url').'/static/img/avatar.jpg';
}

function MBT_monkey_get_excerpt($limit = 286, $after = "..."){
	global $post;
	return mb_strimwidth( mbthemes_strip_tags( $post->post_content ), 0, "120","...");
}

//function MBT_excerpt_length($length){
//	return 120;
//}
//add_filter("excerpt_length", "MBT_excerpt_length");

function MBT_str_cut($str, $start, $width, $trimmarker){
	$output = preg_replace("/^(?:[\\x00-\\x7F]|[\\xC0-\\xFF][\\x80-\\xBF]+){0," . $start . "}((?:[\\x00-\\x7F]|[\\xC0-\\xFF][\\x80-\\xBF]+){0," . $width . "}).*/s", "\1", $str);
	return $output . $trimmarker;
}

function MBT_new_strlen($str, $charset = "utf-8"){
	$n = 0;
	$p = 0;
	$c = "";
	$len = strlen($str);

	if ($charset == "utf-8") {
		for ($i = 0; $i < $len; $i++) {
			$c = ord($str[$i]);

			if (252 < $c) {
				$p = 5;
			}
			else if (248 < $c) {
				$p = 4;
			}
			else if (240 < $c) {
				$p = 3;
			}
			else if (224 < $c) {
				$p = 2;
			}
			else if (192 < $c) {
				$p = 1;
			}
			else {
				$p = 0;
			}

			$i += $p;
			$n++;
		}
	}
	else {
		for ($i = 0; $i < $len; $i++) {
			$c = ord($str[$i]);

			if (127 < $c) {
				$p = 1;
			}
			else {
				$p = 0;
			}

			$i += $p;
			$n++;
		}
	}

	return $n;
}

function get_page_id_from_template($template) {
   global $wpdb;
   $page_id = $wpdb->get_var($wpdb->prepare("SELECT `post_id` 
                              FROM `$wpdb->postmeta`, `$wpdb->posts`
                              WHERE `post_id` = `ID`
                                    AND `post_status` = 'publish'
                                    AND `meta_key` = '_wp_page_template'
                                    AND `meta_value` = %s
                                    LIMIT 1;", $template));
   return $page_id;
}


?>