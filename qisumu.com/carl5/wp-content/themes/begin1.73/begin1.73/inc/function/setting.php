<?php

// 自动缩略图
function zm_the_thumbnail() {
    global $post;
    if ( get_post_meta($post->ID, 'thumbnail', true) ) {
    	$image = get_post_meta($post->ID, 'thumbnail', true);
        echo '<a href="'.get_permalink().'"><img src=';
        echo $image;
        echo ' alt="'.$post->post_title .'" /></a>';
    } else {
	    if ( has_post_thumbnail() ) {
	        echo '<a href="'.get_permalink().'">';
	        the_post_thumbnail('content', array('alt' => get_the_title()));
	        echo '</a>';
		} else {
	        $content = $post->post_content;
	        preg_match_all('/<img.*?(?: |\\t|\\r|\\n)?src=[\'"]?(.+?)[\'"]?(?:(?: |\\t|\\r|\\n)+.*?)?>/sim', $content, $strResult, PREG_PATTERN_ORDER);
	        $n = count($strResult[1]);
	        if($n > 0){
	            echo '<a href="'.get_permalink().'"><img src="'.$strResult[1][0].'" alt="'.$post->post_title .'" /></a>';
	        }else { 
				$random = mt_rand(1, 20);
				echo '<a href="'.get_permalink().'"><img src="'.get_template_directory_uri().'/img/random/'. $random .'.jpg" alt="'.$post->post_title .'" /></a>';
	        }
		}
	}
}

function zm_video_thumbnail() {
    global $post;
    $img = get_post_meta($post->ID, 'big', true);
    if ( get_post_meta($post->ID, 'small', true) ) {
    	$image = get_post_meta($post->ID, 'small', true);
        echo '<a class="videos" href="'.$img.'"><img src=';
        echo $image;
        echo ' alt="'.$post->post_title .'" /><i class="icon-btnPlay"></i></a>';
    } else {
	    if ( has_post_thumbnail() ) {
	        echo '<a class="videos" href="'.$img.'">';
	        the_post_thumbnail('content', array('alt' => get_the_title()));
	        echo '<i class="icon-btnPlay"></i></a>';
		}
	}
}

function zm_videos_thumbnail() {
    global $post;
    if ( get_post_meta($post->ID, 'small', true) ) {
    	$image = get_post_meta($post->ID, 'small', true);
        echo '<a class="videos" href="'.get_permalink().'"><img src=';
        echo $image;
        echo ' alt="'.$post->post_title .'" /><i class="icon-btnPlay"></i></a>';
    } else {
	    if ( has_post_thumbnail() ) {
	        echo '<a class="videos" href="'.get_permalink().'">';
	        the_post_thumbnail('content', array('alt' => get_the_title()));
	        echo '<i class="icon-btnPlay"></i></a>';
		}
	}
}

function tao_thumbnail() {
		global $post;
		$url = get_post_meta($post->ID, 'taourl', true);
		if ( get_post_meta($post->ID, 'thumbnail', true) ) {
		$image = get_post_meta($post->ID, 'thumbnail', true);
		echo '<a target="_blank" rel="external nofollow" href="'.$url.'"><img src=';
		echo $image;
		echo ' /></a>';
    } else {
	    $content = $post->post_content;
	    preg_match_all('/<img.*?(?: |\\t|\\r|\\n)?src=[\'"]?(.+?)[\'"]?(?:(?: |\\t|\\r|\\n)+.*?)?>/sim', $content, $strResult, PREG_PATTERN_ORDER);
	    $n = count($strResult[1]);
	    if($n > 0){
	        echo '<a href="'.$url.'"><img src="'.$strResult[1][0].'" alt="'.$post->post_title .'" /></a>';
	    }
	}
}

function zm_the_thumbnail_h() {
    global $post;
    if ( get_post_meta($post->ID, 'thumbnail', true) ) {
    	$image = get_post_meta($post->ID, 'thumbnail', true);
        echo '<a href="'.get_permalink().'"><img src="' . get_template_directory_uri() . '/img/loading.gif" data-echo=';
        echo $image;
        echo ' alt="'.$post->post_title .'" /></a>';
    } else {
	    if ( has_post_thumbnail() ) {
	        echo '<a href="'.get_permalink().'">';
	        the_post_thumbnail('content', array('alt' => get_the_title()));
	        echo '</a>';
		} else {
	        $content = $post->post_content;
	        preg_match_all('/<img.*?(?: |\\t|\\r|\\n)?src=[\'"]?(.+?)[\'"]?(?:(?: |\\t|\\r|\\n)+.*?)?>/sim', $content, $strResult, PREG_PATTERN_ORDER);
	        $n = count($strResult[1]);
	        if($n > 0){
	            echo '<a href="'.get_permalink().'"><img src="' . get_template_directory_uri() . '/img/loading.gif" data-echo="'.$strResult[1][0].'" alt="'.$post->post_title .'" /></a>';
	        }else { 
	        	$random = mt_rand(1, 20);
				echo '<a href="'.get_permalink().'"><img src="' . get_template_directory_uri() . '/img/loading.gif" data-echo="'.get_template_directory_uri().'/img/random/'. $random .'.jpg" alt="'.$post->post_title .'" /></a>';
	        }
		}
	}
}

function zm_videos_thumbnail_h() {
    global $post;
    if ( get_post_meta($post->ID, 'small', true) ) {
    	$image = get_post_meta($post->ID, 'small', true);
        echo '<a class="videos" href="'.get_permalink().'"><img src="' . get_template_directory_uri() . '/img/loading.gif" data-echo=';
        echo $image;
        echo ' alt="'.$post->post_title .'" /><i class="icon-btnPlay"></i></a>';
    } else {
	    if ( has_post_thumbnail() ) {
	        echo '<a class="videos" href="'.get_permalink().'">';
	        the_post_thumbnail('content', array('alt' => get_the_title()));
	        echo '<i class="icon-btnPlay"></i></a>';
		}
	}
}

function zm_videor_thumbnail_h() {
    global $post;
    if ( get_post_meta($post->ID, 'small', true) ) {
    	$image = get_post_meta($post->ID, 'small', true);
        echo '<a class="videor" href="'.get_permalink().'"><img src="' . get_template_directory_uri() . '/img/loading.gif" data-echo=';
        echo $image;
        echo ' alt="'.$post->post_title .'" /><i class="icon-btnPlay"></i></a>';
    } else {
	    if ( has_post_thumbnail() ) {
	        echo '<a class="videor" href="'.get_permalink().'">';
	        the_post_thumbnail('content', array('alt' => get_the_title()));
	        echo '<i class="icon-btnPlay"></i></a>';
		}
	}
}

function zm_videor_thumbnail() {
    global $post;
    if ( get_post_meta($post->ID, 'small', true) ) {
    	$image = get_post_meta($post->ID, 'small', true);
        echo '<a class="videor" href="'.get_permalink().'"><img src=';
        echo $image;
        echo ' alt="'.$post->post_title .'" /><i class="icon-btnPlay"></i></a>';
    } else {
	    if ( has_post_thumbnail() ) {
	        echo '<a class="videor" href="'.get_permalink().'">';
	        the_post_thumbnail('content', array('alt' => get_the_title()));
	        echo '<i class="icon-btnPlay"></i></a>';
		}
	}
}

function tao_thumbnail_h() {
		global $post;
		$url = get_post_meta($post->ID, 'taourl', true);
		if ( get_post_meta($post->ID, 'thumbnail', true) ) {
		$image = get_post_meta($post->ID, 'thumbnail', true);
		echo '<a target="_blank" rel="external nofollow" href="'.$url.'"><img src="' . get_template_directory_uri() . '/img/loading.gif" data-echo=';
		echo $image;
		echo ' /></a>';
    } else {
	    $content = $post->post_content;
	    preg_match_all('/<img.*?(?: |\\t|\\r|\\n)?src=[\'"]?(.+?)[\'"]?(?:(?: |\\t|\\r|\\n)+.*?)?>/sim', $content, $strResult, PREG_PATTERN_ORDER);
	    $n = count($strResult[1]);
	    if($n > 0){
	        echo '<a href="'.$url.'"><img src="' . get_template_directory_uri() . '/img/loading.gif" data-echo="'.$strResult[1][0].'" alt="'.$post->post_title .'" /></a>';
	    }
	}
}

// 所有图片
function all_img($soContent){
	$soImages = '~<img [^\>]*\ />~';
	preg_match_all( $soImages, $soContent, $thePics );
	$allPics = count($thePics);
	if( $allPics > 0 ){ 
		$count=0;
			foreach($thePics[0] as $v){
				 if( $count == 4 ){break;}
				 else {echo $v;}
				$count++;
			}
	}
}

// 滚动加载
if (zm_get_option('scroll')) {
	require get_template_directory() . '/inc/function/infinite-scroll.php';
	function footerscroll() {
		wp_register_script('infinite_scroll', get_template_directory_uri() . '/js/infinite_scroll.js', false, '2.0.2', true );
		if ( !is_singular() ) {
			wp_enqueue_script( 'infinite_scroll' );
		}
	}
	add_action( 'wp_enqueue_scripts', 'footerscroll' );
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
		a:hover,.top-menu a:hover,.showmore span,.cat-box .icon-cat,.single-content a,.floor,.single-content a:visited,#site-nav .down-menu > .current-menu-item > a,.entry-meta a,#site-nav .down-menu > .current-menu-item > a:hover,#site-nav .down-menu > li > a:hover,#site-nav .down-menu > li.sfHover > a,.cat-box .cat-title a,.icon-m,.icon-cat,.widget-title .icon-cat,.at, .at a,#user-profile a:hover, .hot_commend .icon-zan, .nbs-flexisel-nav-left, .nbs-flexisel-nav-right{color: #" . $color . ";}
		.sf-arrows > li > .sf-with-ul:focus:after,.sf-arrows > li:hover > .sf-with-ul:after,.sf-arrows > .sfHover > .sf-with-ul:after{border-top-color: #" . $color . ";}
		.thumbnail .cat,.aside-cat {background: #" . $color . ";opacity: 0.8;}
		#login h1 a,.format-aside .post-format a,#searchform button,.li-icon-1,.li-icon-2,.li-icon-3,.new-icon, .post-format a, .title-l,.buttons a {background: #" . $color . ";}
		.entry-more a {background: #" . $color . ";}
		.entry-more a {	right: -1px;}
		.entry-more a:hover {color: #fff;background: #595959;}
		#down a,.page-links span,.reply a:hover,.widget_categories a:hover,.widget_links a:hover,#respond #submit:hover,#navigation-toggle:hover,.rslides_tabs .rslides_here a,#scroll li a:hover,#fontsize:hover,.single-meta .comment a:hover,.single-meta .edit-link a:hover,.r-hide a:hover,.meta-nav:hover,.nav-single i:hover {background: #" . $color . ";border: 1px solid #" . $color . ";}
		.comment-tool a, .linkcat h2, .link-all a:hover, .link-f a:hover, #login input[type='submit']  {background: #" . $color . ";border: 1px solid #" . $color . ";}
		.login-t, .login-t a, .login-b, .social-main a {background: #" . $color . ";}
		.entry-header h1 {border-left: 5px solid #" . $color . ";border-right: 5px solid #" . $color . ";}
		.slider-caption, .grid,icon-zan, .video-img i, .picture-img i, .picture-h-img i {background: #" . $color . ";opacity: 0.8;}
		@media screen and (min-width: 900px) {.nav-search {background: #" . $color . ";}}
		@media screen and (min-width: 550px) {.pagination span.current, .pagination a:hover {background: #" . $color . ";border: 1px solid #" . $color . ";}}
		@media screen and (max-width: 550px) {.pagination .prev,.pagination .next {background: #" . $color . ";}}
		.single-content h3 {border-left: 5px solid #" . $color . ";}
		.page-links  a:hover span {background: #a3a3a3;border: 1px solid #a3a3a3;}
		.single-content a:hover {color: #555;}
		.format-aside .post-format a:hover, {color: #fff;}
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
function head_width(){
    custom_width();
}
function custom_width(){
if (zm_get_option("custom_width")) {
$width = substr(zm_get_option("custom_width"), 0);
echo "<style>#content, .top-nav, #top-menu, #mobile-nav, #main-search, .breadcrumb, .footer-widget {width: " . $width . "px;}@media screen and (max-width: " . $width . "px) {#content, #colophon, .breadcrumb, .footer-widget {width: 98%;}#top-menu{width: 98%;}.top-nav {width: 98%;}#main-search, #mobile-nav {width: 98%;}.breadcrumb {	width: 98%;}}</style>";
}
}

// 3D标签
function head_3dtag(){
    custom_3dtag();
}
function custom_3dtag(){
echo "<style>
#tag_cloud_widget {
	position:relative;
	width:240px;
	height:240px;
	margin: 10px auto 10px;
}
#tag_cloud_widget a {
	position:absolute;
	color: #fff;
	text-align: center;
	text-overflow: ellipsis;
	white-space: nowrap;
	top:0px;
	left:0px; 
	padding: 3px 5px;
	border: none;
}
#tag_cloud_widget a:hover {
	background: #d02f53;
	display: block;
}
#tag_cloud_widget a:nth-child(n) {
	background: #666;
	border-radius: 3px;
	display: inline-block;
	line-height: 18px;
	margin: 0 10px 15px 0;
}
#tag_cloud_widget a:nth-child(2n) {
	background: #d1a601;
}
#tag_cloud_widget a:nth-child(3n) {
	background: #286c4a;
}
#tag_cloud_widget a:nth-child(5n) {
	background: #518ab2;
}
#tag_cloud_widget a:nth-child(4n) {
	background: #c91d13;
}
</style>";
}
if (zm_get_option("3dtag")) {
add_action('wp_head', 'head_3dtag');
}
// gravatar头像调用
function get_cn_avatar($avatar) {
   $avatar = preg_replace('/.*\/avatar\/(.*)\?s=([\d]+)&.*/','<img src="http://cn.gravatar.com/avatar/$1?s=$2&d=mm" class="avatar avatar-$2" height="$2" width="$2">',$avatar);
   return $avatar;
}
function get_ssl_avatar($avatar) {
      $avatar = preg_replace('/.*\/avatar\/(.*)\?s=([\d]+)&.*/','<img src="https://secure.gravatar.com/avatar/$1?s=$2&d=mm" class="avatar avatar-$2" height="$2" width="$2">',$avatar);
   return $avatar;
}
function get_duoshuo_avatar($avatar) {
$avatar = preg_replace( "/http:\/\/(www|\d).gravatar.com/","http://gravatar.duoshuo.com",$avatar );
   return $avatar;
}

// 标签
require get_template_directory() . '/inc/function/tag-letter.php';

// 分页
function zmingcx_page_nav( ) {
	global $wp_query;
	if ( $wp_query->max_num_pages > 1 ) : ?>
		<nav id="nav-below">
			<div class="nav-next"><?php previous_posts_link(''); ?></div>
			<div class="nav-previous"><?php next_posts_link(''); ?></div>
		</nav>
	<?php endif;
}

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

if (zm_get_option('index_c')) {

// 目录
function article_catalog($content) {
    $matches = array();
    $ul_li = '';
    $r = "/<h4>([^<]+)<\/h4>/im";

    if(preg_match_all($r, $content, $matches)) {
        foreach($matches[1] as $num => $title) {
            $content = str_replace($matches[0][$num], '<span class="directory"></span><h4 id="title-'.$num.'">'.$title.'</h4>', $content);
            $ul_li .= '<li><i class="icon-btnPlay"></i><a href="#title-'.$num.'" title="'.$title.'">'.$title."</a></li>\n";
        }
        $content = "\n<div class=\"catalog-button\"><a title=\"本文目录\"><i class=\"icon-cat\"></i></a></div>
        	<div id=\"catalog-box\">
                <span class=\"catalog-close\"><a title=\"隐藏目录\"><i class=\"icon-cat\"></i><strong>文章目录</strong></a></span>
	            <div id=\"catalog\"><ul id=\"catalog-ul\">\n" . $ul_li . "</ul></div>
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
function my_video( $atts, $content = null ) {
  extract( shortcode_atts( array (
    'href' => '',
     'img' => '<img class="aligncenter" src="'.$content.'">'
  ), $atts ) );
	return '<div class="video-content"><a class="videos" href="'.$href.'" title="播放视频">'.$img.'<i class="icon-btnPlay"></i></a></div>';
}
add_shortcode('video','my_video');

// 评论可见
function reply_to_read($atts, $content=null) {
    extract(shortcode_atts(array("notice" => '<p class="reply-to-read" style="font-weight: 700;">温馨提示：此处内容需要<a href="#respond" title="发表评论"> 发表评论 </a>并刷新，才能查看！</p>'), $atts));
    $email = null;
    $user_ID = (int) wp_get_current_user()->ID;
    if ($user_ID > 0) {
        $email = get_userdata($user_ID)->user_email;
		if (is_user_logged_in() && !is_null($content) && !is_feed()) {
			if ( current_user_can('level_10') ) {
				return $content;
			}
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
        return do_shortcode($content);
    } else {
        return $notice;
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
function rename_post_formats( $safe_text ) {
    if ( $safe_text == '引语' )
        return '软件';
    return $safe_text;
}

// 分页
function pagenavi( $before = '', $after = '', $p = 3 ) {
	if ( is_singular() ) return;
	global $wp_query, $paged;
	$max_page = $wp_query->max_num_pages;
	if ( $max_page == 1 ) return;
	if ( empty( $paged ) ) $paged = 1;
	echo $before.'<nav class="navigation pagination" role="navigation"><div class="nav-links">'."\n";
	echo $before.'<span class="prev">'."\n";
	if ( $paged > 1 ) p_link( $paged - 1, '', '上页' );
	echo '</span>'.$after."\n";
	if ( $paged > $p + 1 ) p_link( 1, '' );
	echo '<span class="pages">第</span>'.$before."\n";
	if ( $paged > $p + 2 ) echo '<span class="page-numbers dots">...</span>';
	for( $i = $paged - $p; $i <= $paged + $p; $i++ ) {
		if ( $i > 0 && $i <= $max_page ) $i == $paged ? print "<span class='page-numbers current'>{$i}</span>" : p_link( $i );
	}
	echo '<span class="pages">页</span>'.$after."\n";
	if ( $paged < $max_page - $p - 1 ) echo '<span class="page-numbers dots">...</span>';
		if ( $paged < $max_page - $p ) p_link( $max_page, '' );
	echo $before.'<span class="next">'."\n";
	if ( $paged < $max_page ) p_link( $paged + 1,'', '下页' );
	echo '</span>'.$after."\n";
	echo '</div></nav>'.$after."\n";
}
function p_link( $i, $title = '', $linktype = '' ) {
	if ( $title == '' ) $title = "";
	if ( $linktype == '' ) { $linktext = $i; } else { $linktext = $linktype; }
	echo "<a class='page-numbers' href='", esc_html( get_pagenum_link( $i ) ), "'>{$linktext}</a>";
}

// 面包屑导航
function the_crumbs() {
		if (is_home()) {
			if (zm_get_option('bulletin')) {
				echo '<div class="bull">';
				echo '本站公告';
				echo "</div>";
				get_template_part( 'inc/bulletin' );
			} else {
				echo '现在位置： ';
				echo '首页';
			}
		}

		if (!is_home()) {
			echo '<a title="返回首页" href="';
			echo home_url();
			echo '">';
			echo '首页';
			echo "</a>";
		}

		if (is_category()) {
			echo ' &gt; ';
			echo get_category_parents( get_query_var('cat') , true , ' &gt; ' );
			echo ' 文章 ';
		}

		if (! is_home() && ! is_category() && ! is_search()) {
			if ( has_post_format( 'image' )) {
				echo ' &gt; ';
				echo get_post_format_string( 'image' );
			}
		}

		if ( is_tax('notice') ) {
			echo ' &gt; ';
			echo get_the_term_list( $post->ID,  'notice', '' );
		}
		if ( is_tax('gallery') ) {
			echo ' &gt; ';
			echo get_the_term_list( $post->ID,  'gallery', '' );
		}

		if ( is_tax('videos') ) {
			echo ' &gt; ';
			echo get_the_term_list( $post->ID,  'videos', '' );
		}

		if ( is_tax('taobao') ) {
			echo ' &gt; ';
			echo get_the_term_list( $post->ID,  'taobao', '' );
		}

		if (is_single()) {
			echo ' &gt; ';
			echo the_category(' &gt; ', 'multiple');
			echo get_the_term_list( $post->ID,  'notice', '' );
			echo get_the_term_list( $post->ID,  'gallery', '' );
			echo get_the_term_list( $post->ID,  'videos', '' );
			echo get_the_term_list( $post->ID,  'taobao', '' );
			echo ' &gt; ';
			echo ' 正文 ';
		}

		if (is_page()) {
			echo ' &gt; ';
			echo the_title();
		}

	elseif (is_tag()) {echo ' &gt; ';single_tag_title();echo ' &gt; 文章 ';}
	elseif (is_day()) {echo ' &gt; ';echo"发表于"; the_time('Y年m月d日'); echo'的文章';}
	elseif (is_month()) {echo ' &gt; ';echo"发表于"; the_time('Y年m月'); echo'的文章';}
	elseif (is_year()) {echo ' &gt; ';echo"发表于"; the_time('Y年'); echo'的文章';}
	elseif (is_author()) {echo ' &gt; ';echo wp_title( ''); echo'发表的文章';}
	elseif (is_search()) {echo ' &gt; ';echo"搜索"; echo' ';}
	elseif (is_404()) {echo ' &gt; ';echo"亲，你迷路了！"; echo'';}
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
			$post_title = mb_strimwidth(get_the_title(), 0, 120, '...');
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
function picture($atts, $content=null){
	return '<div id="slides">'.$content.'</div>
	<div class="img-n">共<span class="myimg"></span>，点击查看原图</div>
	<script type="text/javascript" src="'.get_template_directory_uri().'/js/gallery.js"></script>';
}

// 自定义按钮
function button_b($atts, $content = null) {
return '<div id="down"><a id="load" title="下载链接" href="#button_file"><i class="icon-down"></i>'.$content.'</a><div class="clear"></div></div>';
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
			$post_title = mb_strimwidth(get_the_title(), 0, 120, '...');
			$post_like = intval($post->like);
			$post_like = number_format($post_like);
			$temp .= "<li><span class='li-icon li-icon-$i'>$i</span><a href=\"".get_permalink()."\">$post_title</a>".__('', 'wp-postviews')."</li>";
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
return '<span class="showmore" title="显示隐藏"><span>▼显示</span></span>';
}

function section_content($atts, $content = null) {
return '<div class="section-content">'.$content.'</div>';
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
function cx_images($content) {
  $content = preg_replace('/\[img=?\]*(.*?)(\[\/img)?\]/e', '"<img src=\"$1\" alt=\"" . basename("$1") . "\" />"', $content);
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

// 彩色标签云
if (zm_get_option('color_tag')) {
function colorCloud($text) {
	$text = preg_replace_callback('|<a (.+?)>|i', 'colorCloudCallback', $text);
	return $text;
}
function colorCloudCallback($matches) {
	$text = $matches[1];
	$color = dechex(rand(0,16777215));
	$pattern = '/style=(\'|\")(.*)(\'|\")/i';
	$text = preg_replace($pattern, "style=\"color:#{$color};$2;\"", $text);
	return "<a $text>";
}
add_filter('wp_tag_cloud', 'colorCloud', 1);
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
function init_smilies(){
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
	background-image:url('.$imgurl.');
	-moz-background-size: 100% 100%;
	-o-background-size: 100% 100%;
	-webkit-background-size: 100% 100%;
	background-size: 100% 100%;
	-moz-border-image: url('.$imgurl.') 0;
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
function  custom_login_title() {
	return '欢迎您光临本站！';
}
add_filter('login_headertitle', 'custom_login_title');
add_filter('login_headerurl', create_function(false,"return get_bloginfo('url');"));

// 添加按钮
if ( is_admin() ) {
add_action('after_wp_tiny_mce', 'bolo_after_wp_tiny_mce');
}
function bolo_after_wp_tiny_mce($mce_settings) {
?>
<script type="text/javascript">
QTags.addButton( 'file', '下载按钮', "[file]" );
QTags.addButton( 'button', '下载链接', "[button]按钮名称[/button]" );
QTags.addButton( 'video', '添加视频', "[video href='视频代码']图片链接[/video]" );
QTags.addButton( 'img', '添加相册', "[img]插入图片[/img]" );
QTags.addButton( 'reply', '回复可见', "[reply]隐藏的内容[/reply]" );
function bolo_QTnextpage_arg1() {
}
</script>
<?php }

// 后台样式
function admin_style(){
	echo'<style type="text/css">
	body{ font-family: Microsoft YaHei;}
	#activity-widget #the-comment-list .avatar {
	width: 48px;
	height: 48px;
	}
    </style>';
    }
add_action('admin_head', 'admin_style');

// 外链跳转
if (zm_get_option('link_to')) {
add_filter('the_content','link_to_jump',999);
function link_to_jump($content){
	preg_match_all('/<a(.*?)href="(.*?)"(.*?)>/',$content,$matches);
	if($matches){
	    foreach($matches[2] as $val){
		    if(strpos($val,'://')!==false && strpos($val,home_url())===false && !preg_match('/\.(jpg|jepg|png|ico|bmp|gif|tiff)/i',$val)){
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
}

// 链接下载外跳转
function link_nofollow($url) {
    if(strpos($url,'://')!==false && strpos($url,home_url())===false) {
		$url = str_replace($url, get_template_directory_uri()."/inc/go.php?url=".$url,$url);
     }
     return $url;
}

// 非管理员不允许进入后台
if (zm_get_option('no_admin')) {
	if ( is_admin() && ( !defined( 'DOING_AJAX' ) || !DOING_AJAX ) ) {
	  $current_user = wp_get_current_user();
	  if($current_user->roles[0] == get_option('default_role')) {
	    wp_safe_redirect( home_url() );
	    exit();
	  }
	}
}

// 修改个人信息
function my_user_contactmethods($user_contactmethods){
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
?>