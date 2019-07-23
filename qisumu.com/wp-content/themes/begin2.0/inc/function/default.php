<?php
function ajax_scroll_js() {
if ( !is_singular() && !is_paged() ) { ?>
<script type="text/javascript">var ias=$.ias({container:"#main",item:"article",pagination:"#nav-below",next:"#nav-below .nav-previous a",});ias.extension(new IASTriggerExtension({text:'<i class="fa fa-chevron-circle-down"></i>更多',offset:<?php echo zm_get_option('scroll_n');?>,}));ias.extension(new IASSpinnerExtension());ias.extension(new IASNoneLeftExtension({text:'已是最后',}));ias.on('rendered',function(items){$("img").lazyload({effect: "fadeIn",failure_limit: 70});});ias.on('rendered',function(items){$(".picture-img,.img-box").hover(function(){$(this).find(".hide-box,.hide-excerpt,.img-title").fadeIn(500);},function(){$(this).find(".hide-box,.hide-excerpt,.img-title").hide();})})</script>
<?php }
}

function ajax_c_scroll_js() {
if ( is_single() ) { ?>
<script type="text/javascript">var ias=$.ias({container:"#comments",item:".comment-list",pagination:".scroll-links",next:".scroll-links .nav-previous a",});ias.extension(new IASTriggerExtension({text:'<i class="fa fa-chevron-circle-down"></i>更多',offset: 0,}));ias.extension(new IASSpinnerExtension());ias.extension(new IASNoneLeftExtension({text:'已是最后',}));ias.on('rendered',function(items){$("img").lazyload({effect: "fadeIn",failure_limit: 10});});</script>
<?php }
}

// 选择颜色
function head_color(){
    custom_color();
}
function custom_color(){
    if (zm_get_option("custom_color")) {
        $color = substr(zm_get_option("custom_color"), 1);
    }
    if ($color) {
        $styles .= "
a:hover,.top-menu a:hover,.show-more span,.cat-box .icon-cat,.single-content a,.single-content a:visited,#site-nav .down-menu > .current-menu-item > a,.entry-meta a,#site-nav .down-menu > .current-menu-item > a:hover,#site-nav .down-menu > li > a:hover,#site-nav .down-menu > li.sfHover > a, .cat-title .fa-bars,.widget-title .fa-bars,.at, .at a,#user-profile a:hover,#comments .fa-exclamation-circle, #comments .fa-check-square, #comments .fa-spinner, #comments .fa-pencil-square-o {color: #" . $color . ";}
.sf-arrows > li > .sf-with-ul:focus:after,.sf-arrows > li:hover > .sf-with-ul:after,.sf-arrows > .sfHover > .sf-with-ul:after{border-top-color: #" . $color . ";}
.thumbnail .cat,.format-cat,.format-img-cat {background: #" . $color . ";opacity: 0.8;}
#login h1 a,.format-aside .post-format a,#searchform button,.li-icon-1,.li-icon-2,.li-icon-3,.new-icon, .title-l,.buttons a, .li-number, .post-format {background: #" . $color . ";}
.entry-more a, .qqonline a, #login input[type='submit'] {background: #" . $color . ";}
.entry-more a {	right: -1px;}
.entry-more a:hover {color: #fff;background: #595959;}
.entry-direct a:hover {border: 1px solid #" . $color . ";}
#down a,.page-links span,.reply a:hover,.widget_categories a:hover,.widget_links a:hover,#respond #submit:hover,.rslides_tabs .rslides_here a,#fontsize:hover,.single-meta .comment a:hover,.single-meta .edit-link a:hover,.r-hide a:hover,.meta-nav:hover,.nav-single i:hover, .widget_categories a:hover, .widget_links a:hover, .tagcloud a:hover, #sidebar .widget_nav_menu a:hover {background: #" . $color . ";border: 1px solid #" . $color . ";}
.comment-tool a, .link-all a:hover, .link-f a:hover, .ias-trigger-next a:hover  {background: #" . $color . ";border: 1px solid #" . $color . ";}
.login-t, .login-t a, .login-b, .social-main a, .at-top-ico, .at-top-header a {background: #" . $color . ";}
.entry-header h1 {border-left: 5px solid #" . $color . ";border-right: 5px solid #" . $color . ";}
.slider-caption, .grid,icon-zan, .grid-cat {background: #" . $color . ";opacity: 0.8;}
@media screen and (min-width: 900px) {#scroll li a:hover {background: #" . $color . ";border: 1px solid #" . $color . ";}.nav-search,.custom-more a, .cat-more a {background: #" . $color . ";}}
@media screen and (max-width: 900px) {#navigation-toggle:hover,.nav-search:hover,.mobile-login a:hover,.nav-mobile:hover, {color: #" . $color . ";}}
@media screen and (min-width: 550px) {.pagination span.current, .pagination a:hover {background: #" . $color . ";border: 1px solid #" . $color . ";}}
@media screen and (max-width: 550px) {.pagination .prev,.pagination .next {background: #" . $color . ";}}
.single-content h3 {border-left: 5px solid #" . $color . ";}
.page-links  a:hover span {background: #a3a3a3;border: 1px solid #a3a3a3;}
.single-content a:hover {color: #555;}
.format-aside .post-format a:hover,.cat-more a:hover,.custom-more a:hover {color: #fff;}
.social-main a:hover {color: #fff;}";
    }
    if ($styles) {
        echo "<style>" . $styles . "</style>";
    }
}

// 定制CSS
function head_css(){
    custom_css();
}
function custom_css(){
    if (zm_get_option("custom_css")) {
        $css = substr(zm_get_option("custom_css"), 0);
        echo "<style>" . $css . "</style>";
    }
}

// 自定义宽度
function zm_width(){
    custom_width();
}
function custom_width(){
if (zm_get_option("custom_width")) {
$width = substr(zm_get_option("custom_width"), 0);
echo "<style>#content, .top-nav, #top-menu, #mobile-nav, #main-search, #search-main, .breadcrumb, .footer-widget {width: " . $width . "px;}@media screen and (max-width: " . $width . "px) {#content, #colophon, .breadcrumb, .footer-widget {width: 98%;}#top-menu{width: 98%;}.top-nav {width: 98%;}#main-search, #search-main, #mobile-nav {width: 98%;}.breadcrumb {width: 98%;}}</style>";
}
}

// gravatar头像调用
function cn_avatar($avatar) {
   $avatar = preg_replace('/.*\/avatar\/(.*)\?s=([\d]+)&.*/','<img src="http://cn.gravatar.com/avatar/$1?s=$2&d=mm" class="avatar avatar-$2" height="$2" width="$2">',$avatar);
   return $avatar;
}
function ssl_avatar($avatar) {
      $avatar = preg_replace('/.*\/avatar\/(.*)\?s=([\d]+)&.*/','<img src="https://secure.gravatar.com/avatar/$1?s=$2&d=mm" class="avatar avatar-$2" height="$2" width="$2">',$avatar);
   return $avatar;
}
function duoshuo_avatar($avatar) {
$avatar = preg_replace( "/http:\/\/(www|\d).gravatar.com/","http://gravatar.duoshuo.com",$avatar );
   return $avatar;
}

if (zm_get_option('no') !== 'no') :
	if (!zm_get_option('gravatar_url') || (zm_get_option("gravatar_url") == 'cn')) {
		add_filter('get_avatar', 'cn_avatar');
	}
	if (zm_get_option('gravatar_url') == 'duoshuo') {
		add_filter('get_avatar', 'duoshuo_avatar');
	}
	if (zm_get_option('gravatar_url') == 'ssl') {
		add_filter('get_avatar', 'ssl_avatar');
	}
endif;

// 标签
require get_template_directory() . '/inc/function/tag-letter.php';

// 字数统计
function count_words ($text) {
	global $post;
	if ( '' == $text ) {
	   $text = $post->post_content;
	   if (mb_strlen($output, 'UTF-8') < mb_strlen($text, 'UTF-8')) $output .= '共 ' . mb_strlen(preg_replace('/\s/','',html_entity_decode(strip_tags($post->post_content))),'UTF-8') . '字';
	   return $output;
	}
}

// 索引
function zm_get_current_count() {
    global $wpdb;
	$current_post = get_the_ID();
    $query = "SELECT post_id, meta_value, post_status FROM $wpdb->postmeta";
    $query .= " LEFT JOIN $wpdb->posts ON post_id=$wpdb->posts.ID";
    $query .= " WHERE post_status='publish' AND meta_key='zm_like' AND post_id = '".$current_post."'";
    $results = $wpdb->get_results($query);
    if ($results) {
        foreach ($results as $o):
            echo $o->meta_value;
        endforeach;
    }else {echo( '0' );}
}

// 文章归档更新
function clear_archives_cache() {
	update_option('cx_archives_list', '');
}

if (zm_get_option('index_c')) {
// 目录
function article_catalog($content) {
    $matches = array();
    $ul_li = '';
    $r = "/<h4>([^<]+)<\/h4>/im";

    if(preg_match_all($r, $content, $matches)) {
        foreach($matches[1] as $num => $title) {
            $content = str_replace($matches[0][$num], '<span class="directory"></span><h4 id="title-'.$num.'">'.$title.'</h4>', $content);
            $ul_li .= '<li><i class="fa fa-angle-right"></i> <a href="#title-'.$num.'" title="'.$title.'">'.$title."</a></li>\n";
        }
        $content = "<div id=\"log-box\">
            <div id=\"catalog\"><ul id=\"catalog-ul\">\n" . $ul_li . "</ul>
			<span class=\"log-zd\"><span class=\"log-close\"><a title=\"隐藏目录\"><i class=\"fa fa-times\"></i><strong>文章目录</strong></a></span></span></div>
			</div>\n" . $content;
    }
    return $content;
}
add_filter( "the_content", "article_catalog" );
}

if (zm_get_option('tag_c')) {
// 关键词加链接
$match_num_from = 1; //一个关键字少于多少不替换
$match_num_to = zm_get_option('chain_n');

add_filter('the_content','tag_link',1);

function tag_sort($a, $b){
if ( $a->name == $b->name ) return 0;
return ( strlen($a->name) > strlen($b->name) ) ? -1 : 1;
}

function tag_link($content){
global $match_num_from,$match_num_to;
$posttags = get_the_tags();
	if ($posttags) {
		usort($posttags, "tag_sort");
		foreach($posttags as $tag) {
			$link = get_tag_link($tag->term_id);
			$keyword = $tag->name;
			if (preg_match_all('|(<h[^>]+>)(.*?)'.$keyword.'(.*?)(</h[^>]*>)|U', $content, $matchs)) {continue;}
			if (preg_match_all('|(<a[^>]+>)(.*?)'.$keyword.'(.*?)(</a[^>]*>)|U', $content, $matchs)) {continue;}

			$cleankeyword = stripslashes($keyword);
			$url = "<a href=\"$link\" title=\"".str_replace('%s',addcslashes($cleankeyword, '$'),__('查看与 %s 相关的文章'))."\"";
			$url .= 'target="_blank"';
			$url .= ">".addcslashes($cleankeyword, '$')."</a>";
			$limit = rand($match_num_from,$match_num_to);

			$content = preg_replace( '|(<a[^>]+>)(.*)('.$ex_word.')(.*)(</a[^>]*>)|U'.$case, '$1$2%&&&&&%$4$5', $content);
			$content = preg_replace( '|(<img)(.*?)('.$ex_word.')(.*?)(>)|U'.$case, '$1$2%&&&&&%$4$5', $content);
			$cleankeyword = preg_quote($cleankeyword,'\'');
			$regEx = '\'(?!((<.*?)|(<a.*?)))('. $cleankeyword . ')(?!(([^<>]*?)>)|([^>]*?</a>))\'s' . $case;
			$content = preg_replace($regEx,$url,$content,$limit);
			$content = str_replace( '%&&&&&%', stripslashes($ex_word), $content);
		}
	}
	return $content;
}
}
// 添加视频
function my_videos( $atts, $content = null ) {
  extract( shortcode_atts( array (
    'href' => '',
     'img' => '<img class="aligncenter" src="'.$content.'">'
  ), $atts ) );
	return '<div class="video-content"><a class="videos" href="'.$href.'" title="播放视频">'.$img.'<i class="fa fa-play-circle-o"></i></a></div>';
}

// 评论可见
function reply_read($atts, $content=null) {
    extract(shortcode_atts(array("notice" => '
    <div class="reply-read">
		<div class="reply-ts">
    		<div class="read-sm"><i class="fa fa-exclamation-circle"></i>此处为隐藏的内容！</div>
			<div class="read-sm"><i class="fa fa-spinner"></i>发表评论并刷新，才能查看</div>
		</div>
    	<div class="read-pl"><a href="#respond">发表评论</a></div>
    	<div class="clear"></div>
    </div>'), $atts));
    $email = null;
    $user_ID = (int) wp_get_current_user()->ID;
    if ($user_ID > 0) {
        $email = get_userdata($user_ID)->user_email;
		if ( current_user_can('level_10') ) {
	return '<div class="secret-password"><i class="fa fa-check-square"></i>隐藏的内容：<br />'.do_shortcode( $content ).'</div>';
		}
    } else if (isset($_COOKIE['comment_author_email_' . COOKIEHASH])) {
        $email = str_replace('%40', '@', $_COOKIE['comment_author_email_' . COOKIEHASH]);
    } else {
        return $notice;
    }
    if (empty($email)) {
        return $notice;
    }
    global $wpdb;
    $post_id = get_the_ID();
    $query = "SELECT `comment_ID` FROM {$wpdb->comments} WHERE `comment_post_ID`={$post_id} and `comment_approved`='1' and `comment_author_email`='{$email}' LIMIT 1";
    if ($wpdb->get_results($query)) {
        return do_shortcode('<div class="secret-password"><i class="fa fa-check-square"></i>隐藏的内容：<br />'.do_shortcode( $content ).'</div>');
    } else {
        return $notice;
    }
}

// 加密内容
function secret($atts, $content=null){
extract(shortcode_atts(array('key'=>null), $atts));
if(isset($_POST['secret_key']) && $_POST['secret_key']==$key){
	return '<div class="secret-password"><i class="fa fa-check-square"></i>加密的内容：<br />'.do_shortcode( $content ).'</div>';
	} else {
		return '
		<form class="post-password-form" action="'.get_permalink().'" method="post">
			<div class="post-secret"><i class="fa fa-exclamation-circle"></i>输入密码查看加密内容：</div>
			<p>
				<input id="pwbox" type="password" size="20" name="secret_key">
				<a class="a2" href="javascript:;"><input type="submit" value="提交" name="Submit"></a>
			</p>
		</form>	';
	}
}

// 图片alt
if (zm_get_option('image_alt')) {
function image_alt($c) {
	global $post;
	$title = $post->post_title;
	$s = array('/src="(.+?.(jpg|bmp|png|jepg|gif))"/i' => 'src="$1" alt="'.$title.'"');
	foreach($s as $p => $r){
	$c = preg_replace($p,$r,$c);
	}
	return $c;
}
add_filter( 'the_content', 'image_alt' );
}

// 形式名称
function zm_post_formats( $safe_text ) {
    if ( $safe_text == '引语' )
        return '软件';
    return $safe_text;
}

// 分页
function begin_pagenav() {
if (zm_get_option('scroll')) {
	global $wp_query;
	if ( $wp_query->max_num_pages > 1 ) : ?>
		<nav id="nav-below">
			<div class="nav-next"><?php previous_posts_link(''); ?></div>
			<div class="nav-previous"><?php next_posts_link(''); ?></div>
		</nav>
	<?php endif;
}
	the_posts_pagination( array(
		'prev_text'          => '<i class="fa fa-angle-left"></i>',
		'next_text'          => '<i class="fa fa-angle-right"></i>',
		'before_page_number' => '<span class="screen-reader-text">第 </span>',
		'after_page_number' => '<span class="screen-reader-text"> 页</span>',
	) );
}

// 面包屑导航
function begin_crumbs() {
		if (is_home()) {
			if (zm_get_option('bulletin')) {
				echo '<div class="bull">';
				echo '<i class="fa fa-volume-up"></i>';
				echo "</div>";
				get_template_part( 'inc/bulletin' );
			} else {
				echo '现在位置： ';
				echo '首页';
			}
		}

		if (!is_home() && !is_front_page()) {
			echo '<a class="crumbs" title="返回首页" href="';
			echo home_url();
			echo '">';
			echo '首页';
			echo "</a>";
		}

		if (is_category()) {
			echo '<i class="fa fa-angle-right"></i>';
			echo get_category_parents( get_query_var('cat') , true , '<i class="fa fa-angle-right"></i>' );
			echo '文章 ';
		}

		if ( is_tax('notice') ) {
			echo '<i class="fa fa-angle-right"></i>';
			
		}
		if ( is_tax('gallery') ) {
			echo '<i class="fa fa-angle-right"></i>';
		}

		if ( is_tax('gallerytag') ) {
			echo '<i class="fa fa-angle-right"></i>';
			echo setTitle();
		}

		if ( is_tax('videos') ) {
			echo '<i class="fa fa-angle-right"></i>';
		}

		if ( is_tax('videotag') ) {
			echo '<i class="fa fa-angle-right"></i>';
			echo setTitle();
		}

		if ( is_tax('taobao') ) {
			echo '<i class="fa fa-angle-right"></i>';
		}

		if ( is_tax('taotag') ) {
			echo '<i class="fa fa-angle-right"></i>';
			echo setTitle();
		}

		if (is_single()) {
			echo '<i class="fa fa-angle-right"></i>';
			echo the_category('<i class="fa fa-angle-right"></i>', 'multiple');
			if ( 'post' == get_post_type() ) {
				echo '<i class="fa fa-angle-right"></i>';
				echo '正文 ';
			}
			if (is_attachment() ) {	echo '附件 '; }
		}

		if (is_page() && !is_front_page()) {
			echo '<i class="fa fa-angle-right"></i>';
			echo the_title();
		}
		if (is_page() && is_front_page()) {
			if (zm_get_option('bulletin')) {
				echo '<div class="bull">';
				echo '<i class="fa fa-volume-up"></i>';
				echo "</div>";
				get_template_part( 'inc/bulletin' );
			} else {
				echo '现在位置： ';
				echo '首页';
			}
		}

	elseif (is_tag()) {echo '<i class="fa fa-angle-right"></i>';single_tag_title();echo '<i class="fa fa-angle-right"></i>文章 ';}
	elseif (is_day()) {echo '<i class="fa fa-angle-right"></i>';echo"发表于"; the_time('Y年m月d日'); echo'的文章';}
	elseif (is_month()) {echo '<i class="fa fa-angle-right"></i>';echo"发表于"; the_time('Y年m月'); echo'的文章';}
	elseif (is_year()) {echo '<i class="fa fa-angle-right"></i>';echo"发表于"; the_time('Y年'); echo'的文章';}
	elseif (is_author()) {echo '<i class="fa fa-angle-right"></i>';echo wp_title( ''); echo'发表的文章';}
	elseif (is_404()) {echo '<i class="fa fa-angle-right"></i>';echo"亲，你迷路了！"; echo'';}
	elseif (is_search()) {
		echo '<i class="fa fa-angle-right"></i>搜索';
		echo get_template_part( 'inc/function/crumb-search' );
	}
}

//点击最多文章
function get_timespan_most_viewed($mode = '', $limit = 10, $days = 7, $display = true) {
	global $wpdb, $post;
	$limit_date = current_time('timestamp') - ($days*86400);
	$limit_date = date("Y-m-d H:i:s",$limit_date);	
	$where = '';
	$temp = '';
	if(!empty($mode) && $mode != 'both') {
		$where = "post_type = '$mode'";
	} else {
		$where = '1=1';
	}
	$most_viewed = $wpdb->get_results("SELECT $wpdb->posts.*, (meta_value+0) AS views FROM $wpdb->posts LEFT JOIN $wpdb->postmeta ON $wpdb->postmeta.post_id = $wpdb->posts.ID WHERE post_date < '".current_time('mysql')."' AND post_date > '".$limit_date."' AND $where AND post_status = 'publish' AND meta_key = 'views' AND post_password = '' ORDER  BY views DESC LIMIT $limit");
	if($most_viewed) {
		$i = 1;
		foreach ($most_viewed as $post) {
			$post_title =  get_the_title();
			$post_views = intval($post->views);
			$post_views = number_format($post_views);
			$temp .= "<li><span class='li-icon li-icon-$i'>$i</span><a href=\"".get_permalink()."\">$post_title</a></li>";
			$i++;
		}
	} else {
		$temp = '<li>暂无文章</li>';
	}
	if($display) {
		echo $temp;
	} else {
		return $temp;
	}
}

// 时间
function timeago($ptime)
{
    $ptime = strtotime($ptime);
    $etime = time() - $ptime;
    if ($etime < 1) {
        return '刚刚';
    }
    $interval = array(
		12 * 30 * 24 * 60 * 60 => '年前', 
		30 * 24 * 60 * 60 => '个月前', 
		7 * 24 * 60 * 60 => '周前',
		24 * 60 * 60 => '天前',
		60 * 60 => '小时前',
		60 => '分钟前',
		1 => '秒前'
	);
    foreach ($interval as $secs => $str) {
        $d = $etime / $secs;
        if (1 <= $d) {
            $r = round($d);
            return $r . $str;
        }
    }
}

// 幻灯
function gallery($atts, $content=null){
	return '<div id="gallery"><div class="rslides" id="slide">'.$content.'</div></div>
	<div class="img-n">共<span class="myimg"></span></div>
	<script type="text/javascript" src="'.get_template_directory_uri().'/js/slides.js"></script>';
}

// 下载按钮
function button_a($atts, $content = null) {
return '<div id="down"><a id="load" title="下载链接" href="#button_file"><i class="fa fa-download"></i>下载地址</a><div class="clear"></div></div>';
}

// 自定义按钮
function button_b($atts, $content = null) {
return '<div id="down"><a id="load" title="下载链接" href="#button_file"><i class="fa fa-download"></i>'.$content.'</a><div class="clear"></div></div>';
}

// 链接按钮
function button_url($atts,$content=null){
 extract(shortcode_atts(array("href"=>'http://'),$atts));
 return '<div id="down"><a href="'.$href.'" target="_blank"><i class="fa fa-cloud-download"></i>'.$content.'</a><div class="clear"></div></div>';
 }

//点赞最多文章
function get_like_most($mode = '', $limit = 10, $days = 7, $display = true) {
	global $wpdb, $post;
	$limit_date = current_time('timestamp') - ($days*86400);
	$limit_date = date("Y-m-d H:i:s",$limit_date);	
	$where = '';
	$temp = '';
	if(!empty($mode) && $mode != 'both') {
		$where = "post_type = '$mode'";
	} else {
		$where = '1=1';
	}
	$most_viewed = $wpdb->get_results("SELECT $wpdb->posts.*, (meta_value+0) AS zm_like FROM $wpdb->posts LEFT JOIN $wpdb->postmeta ON $wpdb->postmeta.post_id = $wpdb->posts.ID WHERE post_date < '".current_time('mysql')."' AND post_date > '".$limit_date."' AND $where AND post_status = 'publish' AND meta_key = 'zm_like' AND post_password = '' ORDER  BY zm_like DESC LIMIT $limit");
	if($most_viewed) {
		$i = 1;
		foreach ($most_viewed as $post) {
			$post_title = get_the_title();
			$post_like = intval($post->like);
			$post_like = number_format($post_like);
			$temp .= "<li><span class='li-icon li-icon-$i'>$i</span><a href=\"".get_permalink()."\">$post_title</a></li>";
			$i++;
		}
	} else {
		$temp = '<li>暂无文章</li>';
	}
	if($display) {
		echo $temp;
	} else {
		return $temp;
	}
}

// 文字展开
function show_more($atts, $content = null) {
return '<span class="show-more" title="显示隐藏"><span><i class="fa fa-caret-down"></i></span></span>';
}

function section_content($atts, $content = null) {
return '<div class="section-content">'.do_shortcode( $content ).'</div>';
}

// 点赞
function begin_ding(){
    global $wpdb,$post;
    $id = $_POST["um_id"];
    $action = $_POST["um_action"];
    if ( $action == 'ding'){
	    $bigfa_raters = get_post_meta($id,'zm_like',true);
	    $expire = time() + 99999999;
	    $domain = ($_SERVER['HTTP_HOST'] != 'localhost') ? $_SERVER['HTTP_HOST'] : false;
	    setcookie('zm_like_'.$id,$id,$expire,'/',$domain,false);
	    if (!$bigfa_raters || !is_numeric($bigfa_raters)) {
			update_post_meta($id, 'zm_like', 1);
		}
	    else {
			update_post_meta($id, 'zm_like', ($bigfa_raters + 1));
		}
		echo get_post_meta($id,'zm_like',true);
    }
    die;
}

if (zm_get_option('baidu_submit')) {
// 主动推送
if(!function_exists('Baidu_Submit')){
    function Baidu_Submit($post_ID) {
        $WEB_DOMAIN = get_option('home');
        if(get_post_meta($post_ID,'Baidusubmit',true) == 1) return;
        $url = get_permalink($post_ID);
        $api = 'http://data.zz.baidu.com/urls?site='.$WEB_DOMAIN.'&token='.zm_get_option('token_p');
        $request = new WP_Http;
        $result = $request->request( $api , array( 'method' => 'POST', 'body' => $url , 'headers' => 'Content-Type: text/plain') );
        $result = json_decode($result['body'],true);
        if (array_key_exists('success',$result)) {
            add_post_meta($post_ID, 'Baidusubmit', 1, true);
        }
    }
    add_action('publish_post', 'Baidu_Submit', 0);
}
}

// 去掉描述P标签
function deletehtml($description) {
	$description = trim($description);
	$description = strip_tags($description,"");
	return ($description);
}

// 评论贴图
function message_img($content) {
	// php5.2
	$content = preg_replace('/\[img=?\]*(.*?)(\[\/img)?\]/e', '"<img src=\"$1\" alt=\"" . basename("$1") . "\" />"', $content);
	// 如果是php7删除上行，并删除下行开头的“// ”注释
 	// $content = preg_replace_callback('/\[img=?\]*(.*?)(\[\/img)?\]/', function($matches) {return "<img src=\"$matches[1]\" alt=\"" . basename("$matches[1]") . "\" />";}, $content);
  return $content;
}

// title
if (zm_get_option('wp_title')) {
} else {
function begin_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() ) {
		return $title;
	}
	$title .= get_bloginfo( 'name', 'display' );
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title = "$title $sep $site_description";
	}
	if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
		$title = "$title $sep " . sprintf( __( 'Page %s', 'twentyfourteen' ), max( $paged, $page ) );
	}

	return $title;
}
add_filter( 'wp_title', 'begin_wp_title', 10, 2 );
}

// 禁止无中文留言
if ( current_user_can('level_10') ) {
} else {
function refused_spam_comments( $comment_data ) {
	$pattern = '/[一-龥]/u';  
	if(!preg_match($pattern,$comment_data['comment_content'])) {
		err('评论必须含中文！');
	}
	return( $comment_data );
}
add_filter('preprocess_comment','refused_spam_comments');
}

// @回复
if (zm_get_option('at')) {
function comment_at( $comment_text, $comment = '') {
  if( $comment->comment_parent > 0) {
    $comment_text = '<span class="at">@<a href="#comment-' . $comment->comment_parent . '">'.get_comment_author( $comment->comment_parent ) . '</a></span> ' . $comment_text;
  }
  return $comment_text;
}
add_filter( 'comment_text' , 'comment_at', 20, 2);
}

// 表情
function custom_smilies_src( $old, $img ) {
    return get_stylesheet_directory_uri().'/img/smilies/'.$img;
}
function begin_smilies(){
	global $wpsmiliestrans;
	$wpsmiliestrans = array(
		':mrgreen:' => 'icon_mrgreen.gif',
		':neutral:' => 'icon_neutral.gif',
		':twisted:' => 'icon_twisted.gif',
		  ':arrow:' => 'icon_arrow.gif',
		  ':shock:' => 'icon_eek.gif',
		  ':smile:' => 'icon_smile.gif',
		    ':???:' => 'icon_confused.gif',
		   ':cool:' => 'icon_cool.gif',
		   ':evil:' => 'icon_evil.gif',
		   ':grin:' => 'icon_biggrin.gif',
		   ':idea:' => 'icon_idea.gif',
		   ':oops:' => 'icon_redface.gif',
		   ':razz:' => 'icon_razz.gif',
		   ':roll:' => 'icon_rolleyes.gif',
		   ':wink:' => 'icon_wink.gif',
		    ':cry:' => 'icon_cry.gif',
		    ':eek:' => 'icon_surprised.gif',
		    ':lol:' => 'icon_lol.gif',
		    ':mad:' => 'icon_mad.gif',
		    ':sad:' => 'icon_sad.gif',
		      '8-)' => 'icon_cool.gif',
		      '8-O' => 'icon_eek.gif',
		      ':-(' => 'icon_sad.gif',
		      ':-)' => 'icon_smile.gif',
		      ':-?' => 'icon_confused.gif',
		      ':-D' => 'icon_biggrin.gif',
		      ':-P' => 'icon_razz.gif',
		      ':-o' => 'icon_surprised.gif',
		      ':-x' => 'icon_mad.gif',
		      ':-|' => 'icon_neutral.gif',
		      ';-)' => 'icon_wink.gif',
		       '8O' => 'icon_eek.gif',
		       ':(' => 'icon_sad.gif',
		       ':)' => 'icon_smile.gif',
		       ':?' => 'icon_confused.gif',
		       ':D' => 'icon_biggrin.gif',
		       ':P' => 'icon_razz.gif',
		       ':o' => 'icon_surprised.gif',
		       ':x' => 'icon_mad.gif',
		       ':|' => 'icon_neutral.gif',
		       ';)' => 'icon_wink.gif',
		      ':!:' => 'icon_exclaim.gif',
		      ':?:' => 'icon_question.gif',
	);

	remove_action( 'wp_head' , 'print_emoji_detection_script', 7 );
	add_filter( 'smilies_src' , 'custom_smilies_src' , 10 , 2 );
}

// 浏览总数
function all_view(){
global $wpdb;
$count=0;
$views= $wpdb->get_results("SELECT * FROM $wpdb->postmeta WHERE meta_key='views'");
foreach($views as $key=>$value)
	{
		$meta_value=$value->meta_value;
		if($meta_value!=' '){
			$count+=(int)$meta_value;
		}
	}
return $count;
}

// 登录
function custom_login_head(){
$imgurl=zm_get_option('login_img');
$logourl=zm_get_option('logo');
echo'<style type="text/css">
body{
	font-family: "Microsoft YaHei", Helvetica, Arial, Lucida Grande, Tahoma, sans-serif;
	background: url('.$imgurl.');
	width:100%;
	height:100%;
}
.login h1 a {
	background:url('.$logourl.') no-repeat 0 0 transparent;
	width: 220px;
	height: 50px;
	padding: 0;
	margin: 0 auto 1em;
}
.login form, .login .message {
	background: #fff;
	background: rgba(255, 255, 255, 0.6);
	border-radius: 2px;
	border: 1px solid #fff;
	box-shadow: 0 1px 1px rgba(0, 0, 0, 0.8);
}
.login label {
	color: #000;
	font-weight: bold;
}
.login .message {
	color: #000;
}
#backtoblog a, #nav a {
	color: #fff !important;
}
</style>';

}
if (zm_get_option('custom_login')) {
	add_action('login_head', 'custom_login_head');
}

// 登录提示
function  zm_login_title() {
	return '欢迎您光临本站！';
}
add_filter('login_headertitle', 'zm_login_title');
add_filter('login_headerurl', create_function(false,"return get_bloginfo('url');"));

// 添加按钮
function begin_select(){
echo '
<select id="sc_select">
	<option value="您需要选择一个短代码">插入短代码</option>
	<option value="[file]">下载按钮</option>
	<option value="[button]按钮名称[/button]">下载链接</option>
	<option value="[url href=链接地址]按钮名称[/url]">链接按钮</option>
	<option value="[videos href=视频代码]图片链接[/videos]">添加视频</option>
	<option value="[img]插入图片[/img]">添加相册</option>
	<option value="[reply]隐藏的内容[/reply]">回复可见</option>
	<option value="[password key=密码]加密的内容[/password]">密码保护</option>
</select>';
}

function begin_button_js() {
echo '<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery("#sc_select").change(function() {
	send_to_editor(jQuery("#sc_select :selected").val());
	return false;
	});
});
</script>';
}
// 后台样式
function admin_style(){
	echo'<style type="text/css">body{ font-family: Microsoft YaHei;}#activity-widget #the-comment-list .avatar {width: 48px;height: 48px;}.show-id {float: left;color: #999;width: 50%;margin: 0;padding: 3px 0;}.clear {clear: both;margin: 0 0 8px 0}</style>';
}
add_action('admin_head', 'admin_style');

// 外链跳转
if (zm_get_option('link_to')) {
	add_filter('the_content','link_to_jump',999);
	function link_to_jump($content){
		preg_match_all('/<a(.*?)href="(.*?)"(.*?)>/',$content,$matches);
		if($matches){
		    foreach($matches[2] as $val){
			    if(strpos($val,'://')!==false && strpos($val,home_url())===false && !preg_match('/\.(jpg|jepg|png|ico|bmp|gif|tiff)/i',$val) && !preg_match('/(ed2k|thunder|Flashget|flashget|qqdl):\/\//i',$val)){
			    	$content=str_replace("href=\"$val\"", "href=\"".get_template_directory_uri()."/inc/go.php?url=$val\" ",$content);
				}
			}
		}
		return $content;
	}

	// 评论者链接跳转并新窗口打开
	function commentauthor($comment_ID = 0) {
	    $url    = get_comment_author_url( $comment_ID );
	    $author = get_comment_author( $comment_ID );
	    if ( empty( $url ) || 'http://' == $url )
	    echo $author;
	    else
	    echo "<a href='".get_template_directory_uri()."/inc/go.php?url=$url' rel='external nofollow' target='_blank' class='url'>$author</a>";
	}

	// 下载外链跳转
	function link_nofollow($url) {
	    if(strpos($url,'://')!==false && strpos($url,home_url())===false && !preg_match('/(ed2k|thunder|Flashget|flashget|qqdl):\/\//i',$url)) {
			$url = str_replace($url, get_template_directory_uri()."/inc/go.php?url=".$url,$url);
	     }
	     return $url;
	}
}

// 添加斜杠
function nice_trailingslashit($string, $type_of_url) {
    if ( $type_of_url != 'single' && $type_of_url != 'page' )
      $string = trailingslashit($string);
    return $string;
}
add_filter('user_trailingslashit', 'nice_trailingslashit', 10, 2);

// 页面添加html后缀
function html_page_permalink() {
	global $wp_rewrite;
	if ( !strpos($wp_rewrite->get_page_permastruct(), '.html')){
		$wp_rewrite->page_structure = $wp_rewrite->page_structure . '.html';
	}
}

// 非管理员不允许进入后台
function redirect_non_admin_users() {
	if ( ! current_user_can( 'manage_options' ) && '/wp-admin/admin-ajax.php' != $_SERVER['PHP_SELF'] ) {
		wp_redirect( home_url() );
		exit;
	}
}

// 修改个人信息
function zm_user_contact($user_contactmethods){
    //去掉默认联系方式
    unset($user_contactmethods['aim']);
    unset($user_contactmethods['yim']);
    unset($user_contactmethods['jabber']);

    //添加自定义联系方式
    $user_contactmethods['qq'] = 'QQ';
    $user_contactmethods['weixin'] = '微信';
    $user_contactmethods['weibo'] = '新浪微博';

    return $user_contactmethods;
}

// 用户文章
function num_of_author_posts($authorID=''){
    if ($authorID) {
        $author_query = new WP_Query( 'posts_per_page=-1&author='.$authorID );
        $i=0;
        while ($author_query->have_posts()) : $author_query->the_post(); ++$i; endwhile; wp_reset_postdata();
        return $i;
    }
    return false;
}

// 密码提示
function change_protected_title_prefix() {
    return '%s';
}
add_filter('protected_title_format', 'change_protected_title_prefix');

// 评论等级
if (zm_get_option('vip')) {
	function get_author_class($comment_author_email,$user_id){
		global $wpdb;
		$author_count = count($wpdb->get_results(
		"SELECT comment_ID as author_count FROM $wpdb->comments WHERE comment_author_email = '$comment_author_email' "));
		$adminEmail = get_option('admin_email');if($comment_author_email ==$adminEmail) return;
		if($author_count>=0 && $author_count<2)
			echo '<a class="vip0" title="评论达人 VIP.0"><i class="fa fa-vimeo-square"></i><span class="lv">0</span></a>';
		else if($author_count>=2 && $author_count<5)
			echo '<a class="vip1" title="评论达人 VIP.1"><i class="fa fa-vimeo-square"></i><span class="lv">1</span></a>';
		else if($author_count>=5 && $author_count<10)
			echo '<a class="vip2" title="评论达人 VIP.2"><i class="fa fa-vimeo-square"></i><span class="lv">2</span></a>';
		else if($author_count>=10 && $author_count<20)
			echo '<a class="vip3" title="评论达人 VIP.3"><i class="fa fa-vimeo-square"></i><span class="lv">3</span></a>';
		else if($author_count>=20 && $author_count<50)
			echo '<a class="vip4" title="评论达人 VIP.4"><i class="fa fa-vimeo-square"></i><span class="lv">4</span></a>';
		else if($author_count>=50)
			echo '<a class="vip5" title="评论达人 VIP.5"><i class="fa fa-vimeo-square"></i><span class="lv">5</span></a>';
	}
}
// 图标
class fontawesome {
    var $defaults;
    function menu( $nav ){
        $menu_item = preg_replace_callback(
            '/(<li[^>]+class=")([^"]+)("?[^>]+>[^>]+>)([^<]+)<\/a>/',
            array( $this, 'replace' ),
            $nav
        );
        return $menu_item;
    }
    
    function replace( $a ){
        $start = $a[ 1 ];
        $classes = $a[ 2 ];
        $rest = $a[ 3 ];
        $text = $a[ 4 ];
        $before = true;
        
        $class_array = explode( ' ', $classes );
        $fontawesome_classes = array();
        foreach( $class_array as $key => $val ){
            if( 'fa' == substr( $val, 0, 2 ) ){
                if( 'fa' == $val ){
                    unset( $class_array[ $key ] );
                } elseif( 'fa-after' == $val ){
                    $before = false;
                    unset( $class_array[ $key ] );
                } else {
                    $fontawesome_classes[] = $val;
                    unset( $class_array[ $key ] );
                }
            }
        }
        
        if( !empty( $fontawesome_classes ) ){
            $fontawesome_classes[] = 'fa';
            $settings = get_option( '', $this->defaults );
            if( $before ){
                if( 1 == $settings[ 'spacing' ] ){
                    $text = ' '.$text;
                }
                $newtext = '<i class="'.implode( ' ', $fontawesome_classes ).'"></i><span class="font-text">'.$text.'</span>';
            } else {
                if( 1 == $settings[ 'spacing' ] ){
                    $text = $text.' ';
                }
                $newtext = '<span class="font-text">'.$text.'</span><i class="'.implode( ' ', $fontawesome_classes ).'"></i>';
            }
        } else {
            $newtext = $text;
        }
        
        $item = $start.implode( ' ', $class_array ).$rest.$newtext.'</a>';
        return $item;
    }
    

    
    
    function __construct(){
        add_filter( 'wp_nav_menu' , array( $this, 'menu' ), 10, 2 );
    }
}
new fontawesome();

// 防止冒充管理员
function usercheck($incoming_comment) {
	$isSpam = 0;
	if (trim($incoming_comment['comment_author']) == ''.zm_get_option('admin_name').'')
	$isSpam = 1;
	if (trim($incoming_comment['comment_author_email']) == ''.zm_get_option('admin_email').'')
	$isSpam = 1;
	if(!$isSpam)
	return $incoming_comment;
	err('<i class="fa fa-exclamation-circle"></i>请勿冒充管理员发表评论！');
}

// 安装插件提示
function showadminmessages() {
	$plugin_messages = array();
	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	// 下载插件
	if(!is_plugin_active( 'wp-postviews/wp-postviews.php' )) {
		$plugin_messages[] = '主题部分功能需要安装并启用文章浏览统计插件 WP-PostViews 才能使用，您可以在插件安装页面搜索并安装，也可以到此<a href="https://wordpress.org/plugins/wp-postviews/">下载插件</a>';
	}
	if(count($plugin_messages) > 0) {
		echo '<div id="message" class="error">';
			foreach($plugin_messages as $message) {
				echo '<p><strong>'.$message.'</strong></p>';
			}
		echo '</div>';
	}
}

// 邀请码
if (zm_get_option('invitation_code')) {
	if ( ! is_admin() ) {
		require get_template_directory() . '/inc/invitation/front-end.php';
	} else {
		require get_template_directory() . '/inc/invitation/back-end.php';
	}
}

// 自动标签
function auto_add_tags(){
	$tags = get_tags( array('hide_empty' => false) );
	$post_id = get_the_ID();
	$post_content = get_post($post_id)->post_content;
	if ($tags) {
		foreach ( $tags as $tag ) {
			if ( strpos($post_content, $tag->name) !== false)
				wp_set_post_tags( $post_id, $tag->name, true );
		}
	}
}

// 页面添加标签
class PTCFP{
	function __construct(){
	add_action( 'init', array( $this, 'taxonomies_for_pages' ) );
		if ( ! is_admin() ) {
			add_action( 'pre_get_posts', array( $this, 'tags_archives' ) );
		}
	}
	function taxonomies_for_pages() {
		register_taxonomy_for_object_type( 'post_tag', 'page' );
	}
	function tags_archives( $wp_query ) {
	if ( $wp_query->get( 'tag' ) )
		$wp_query->set( 'post_type', 'any' );
	}
}
$ptcfp = new PTCFP();

// 分类标签
function get_category_tags($args) {
	global $wpdb;
	$tags = $wpdb->get_results ("
		SELECT DISTINCT terms2.term_id as tag_id, terms2.name as tag_name
		FROM
			$wpdb->posts as p1
			LEFT JOIN $wpdb->term_relationships as r1 ON p1.ID = r1.object_ID
            LEFT JOIN $wpdb->term_taxonomy as t1 ON r1.term_taxonomy_id = t1.term_taxonomy_id
			LEFT JOIN $wpdb->terms as terms1 ON t1.term_id = terms1.term_id,

			$wpdb->posts as p2
			LEFT JOIN $wpdb->term_relationships as r2 ON p2.ID = r2.object_ID
			LEFT JOIN $wpdb->term_taxonomy as t2 ON r2.term_taxonomy_id = t2.term_taxonomy_id
			LEFT JOIN $wpdb->terms as terms2 ON t2.term_id = terms2.term_id
		WHERE
			t1.taxonomy = 'category' AND p1.post_status = 'publish' AND terms1.term_id IN (".$args['categories'].") AND
			t2.taxonomy = 'post_tag' AND p2.post_status = 'publish'
			AND p1.ID = p2.ID
			ORDER by tag_name
	");
	$count = 0;

    if($tags) {
		foreach ($tags as $tag) {
			$mytag[$count] = get_term_by('id', $tag->tag_id, 'post_tag');
			$count++;
		}
	} else {
      $mytag = NULL;
    }
    return $mytag;
}

// 获取当前页面地址
function currenturl() {
	$current_url = home_url(add_query_arg(array()));
	if (is_single()) {
		$current_url = preg_replace('/(\/comment|page|#).*$/','',$current_url);
	} else {
		$current_url = preg_replace('/(comment|page|#).*$/','',$current_url);
	}
	echo $current_url;
}

// 自定义类型面包屑
function begin_taxonomy_terms( $product_id, $taxonomy, $args = array() ) {
    $terms = wp_get_post_terms( $product_id, $taxonomy, $args );
  return apply_filters( 'begin_taxonomy_terms' , $terms, $product_id, $taxonomy, $args );
}

// 图片数量
if( !function_exists('get_post_images_number') ){
	function get_post_images_number(){
		global $post;
		$content = $post->post_content; 
		preg_match_all('/<img.*?(?: |\\t|\\r|\\n)?src=[\'"]?(.+?)[\'"]?(?:(?: |\\t|\\r|\\n)+.*?)?>/sim', $content, $result, PREG_PATTERN_ORDER);
		return count($result[1]);
	}
}