<?php  
/*
功能：定义Widget 小工具的函数
设计者：明凯博客
创建时间：2013-08-18
*/

// 首页和文章页用不同的侧边栏
if ( function_exists('register_sidebar') ) {
register_sidebar(array(
'name'          => '首页侧栏',
'id'            => 'widget_homesidebar',
'before_widget' => '<div class="widget">',
'after_widget' => '</div>',
'before_title' => '<h2>',
'after_title' => '</h2>',
));
register_sidebar(array(
'name'          => '文章页侧栏',
'id'            => 'widget_postsidebar',
'before_widget' => '<div class="widget">',
'after_widget' => '</div>',
'before_title' => '<h2>',
'after_title' => '</h2>',
));
}

//注册 Widget 小工具
add_action('widgets_init', create_function('', 'return register_widget("mk_visitors");'));
class mk_visitors extends WP_Widget {
	//注册一个WordPress小工具
	function mk_visitors(){
		$this->WP_Widget('mk_visitors', '读者墙', array( 'description' => '显示近期评论最多的读者头像' ));
	}
	//前端显示小工具
	function widget($args, $instance) {
		extract($args, EXTR_SKIP);
		echo $before_widget;
		$title = apply_filters('widget_name', $instance['title']);
		$limit = $instance['limit'];
		$timer = $instance['timer'];
		echo $before_title.$title.$after_title; 
		echo '<ul class="visitors">';
		echo visitors($tim=$timer, $lim=$limit );
		echo '</ul><div class="clear"></div>';
		echo $after_widget;
	}
	//保存小工具设置选项
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['limit'] = strip_tags($new_instance['limit']);
		$instance['timer'] = strip_tags($new_instance['timer']);
		return $instance;
	}
	//后台小工具表单
	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 
			'title' => '最近读者',
			'limit' => '15',
			'timer' => '30' 
			) 
		);
		$title = strip_tags($instance['title']);
		$limit = strip_tags($instance['limit']);
		$timer = strip_tags($instance['timer']);
		echo '<p><label>标题：<input class="widefat" id="'.$this->get_field_id('title').'" name="'.$this->get_field_name('title').'" type="text" value="'.$instance['title'].'" /></label></p><p><label>显示数目：<input class="widefat" id="'.$this->get_field_id('limit').'" name="'.$this->get_field_name('limit').'" type="number" value="'.$instance['limit'].'" /></label></p><p><label>几天内：<input class="widefat" id="'.$this->get_field_id('timer').'" name="'.$this->get_field_name('timer').'" type="number" value="'.$instance['timer'].'" /></label></p>';
	}
}
//获取最近读者
function visitors($tim,$lim){
global $wpdb;
$query="SELECT COUNT(comment_ID) AS cnt, comment_author, comment_author_url, comment_author_email FROM (SELECT * FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->posts.ID=$wpdb->comments.comment_post_ID) WHERE comment_date > date_sub( NOW(), INTERVAL $tim day )  AND comment_author_email != '' AND post_password='' AND comment_approved='1' AND comment_type='') AS tempcmt GROUP BY comment_author_email ORDER BY comment_date DESC LIMIT $lim";
$wall = $wpdb->get_results($query);
foreach ($wall as $comment)
{
if( $comment->comment_author_url )
$url = $comment->comment_author_url;
else $url="#";
$r="rel='external nofollow'";
$tmp = "<li><a href='".$url."' ".$r." title='".$comment->comment_author." 留下".$comment->cnt."条信息'>".get_avatar($comment->comment_author_email, 40)."</a></li>";
$output .= $tmp;
}
echo $output ;
}
add_action('widgets_init', create_function('', 'return register_widget("mk_status");'));
class mk_status extends WP_Widget {
	//注册一个WordPress小工具
	function mk_status(){
		$this->WP_Widget('mk_status', '博客统计', array( 'description' => '显示博客的统计信息' ));
	}
	//前端显示小工具
	function widget($args, $instance) {
		extract($args, EXTR_SKIP);
		echo $before_widget;
		$title = apply_filters('widget_name', $instance['title']);
		$date = $instance['date'];
		$url = $instance['url'];
		echo $before_title.$title.$after_title; 
		echo '<ul class="status">';
		echo status($d=$date, $u=$url);
		echo '</ul><div class="clear"></div>';
		echo $after_widget;
	}
	//保存小工具设置选项
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['date'] = strip_tags($new_instance['date']);
		$instance['url'] = strip_tags($new_instance['url']);
		return $instance;
	}
	//后台小工具表单
	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 
			'title' => '博客统计',
			'date' => '2013-08-18',
			'url' => 'http://www.aimks.com/about' 
			) 
		);
		$title = strip_tags($instance['title']);
		$date = strip_tags($instance['date']);
		$url = strip_tags($instance['url']);
		echo '<p><label>标题：<input class="widefat" id="'.$this->get_field_id('title').'" name="'.$this->get_field_name('title').'" type="text" value="'.$instance['title'].'" /></label></p><p><label>博客建立时间：<input class="widefat" id="'.$this->get_field_id('date').'" name="'.$this->get_field_name('date').'" type="date" value="'.$instance['date'].'" /></label></p><p><label>几天内：<input class="widefat" id="'.$this->get_field_id('url').'" name="'.$this->get_field_name('url').'" type="text" value="'.$instance['url'].'" /></label></p>';
	}
}
//博客统计状态
function status($d,$u){
global $wpdb;
$count_posts = wp_count_posts()->publish;
$count_pages = wp_count_posts('page')->publish;
$count_categories = wp_count_terms('category');
$count_tags = wp_count_terms('post_tag');
$count_comments = get_comment_count();
$count_comments = $count_comments['approved'];
$users = $wpdb->get_var("SELECT COUNT(ID) FROM $wpdb->users");
$views = $wpdb->get_var("SELECT SUM(meta_value) FROM $wpdb->postmeta WHERE meta_key='post_views_count'");
$times = floor((time()-strtotime($d))/86400);
$last = $wpdb->get_results("SELECT MAX(post_modified) AS MAX_m FROM $wpdb->posts WHERE (post_type = 'post' OR post_type = 'page') AND (post_status = 'publish' OR post_status = 'private')");
$last = date('Y-m-d H:i:s', strtotime($last[0]->MAX_m));
$login = '/wp-login.php';
$reg = '/wp-login.php?action=register';
$url = $u;
echo '<li>文章：'.$count_posts.'篇</li><li>页面：'.$count_pages.'个</li><li>分类：'.$count_categories.'个</li><li>标签：'.$count_tags.'个</li><li>评论：'.$count_comments.'条</li><li>用户：'.$users.'人</li><li>浏览：'.$views.'次</li><li>运行：'.$times.'天</li><li class="update">最后更新：'.$last.'</li><li class="user"><a class="login" href="'.$login.'">登陆</a></li><li class="user"><a class="reg" href="'.$reg.'">注册</a></li><li class="user"><a class="comment" href="'.$url.'">留言</a></li>';
}

// 最新评论带头像评论
add_action('widgets_init', create_function('', 'return register_widget("widget_newcomments");'));
class widget_newcomments extends WP_Widget {
	function widget_newcomments() {
		$option = array('classname' => 'widget_newcomments', 'description' => '显示网友最新评论（头像+名称+评论）' );
		$this->WP_Widget(false, '最新评论 ', $option);
	}
	function widget($args, $instance) {
		extract($args, EXTR_SKIP);
		echo $before_widget;
		$title = empty($instance['title']) ? '最新评论' : apply_filters('widget_title', $instance['title']);
		$count = empty($instance['count']) ? '5' : apply_filters('widget_count', $instance['count']);

		echo $before_title . $title . $after_title;
		echo '<ul class="newcomments">';
		echo newcomments( $count );
		echo '</ul>';
		echo $after_widget;
	}
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['count'] = strip_tags($new_instance['count']);
		return $instance;
	}
	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'count' => '' ) );
		$title = strip_tags($instance['title']);
		$count = strip_tags($instance['count']);

		echo '<p><label>标题：<input id="'.$this->get_field_id('title').'" name="'.$this->get_field_name('title').'" type="text" value="'.attribute_escape($title).'" size="24" /></label></p>';
		echo '<p><label>数目：<input id="'.$this->get_field_id('count').'" name="'.$this->get_field_name('count').'" type="text" value="'.attribute_escape($count).'" size="3" /></label></p>';
	}
}

function newcomments( $limit ){
	global $wpdb;
  	$sql = "SELECT ID, post_title, comment_ID, comment_author,comment_author_email,comment_date,comment_content FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID  = $wpdb->posts.ID) WHERE comment_approved = '1' AND comment_type = '' AND post_password = '' ORDER BY comment_date_gmt DESC LIMIT $limit";
	$comments = $wpdb->get_results($sql);
	foreach ( $comments as $comment ) {
		$output .= "<li>" . get_avatar($comment->comment_author_email,32) ."<div class='rcomment'><strong>".$comment->comment_author."</strong>&nbsp;&nbsp;" .human_time_diff(strtotime($comment->comment_date), current_time('timestamp'))."前&nbsp;&nbsp;在&nbsp;&nbsp;<a href='". get_comment_link($comment->comment_ID) . "' title=' " . $comment->post_title .  "'> " . $comment->post_title .  "</a>&nbsp;&nbsp;评论：<div class='box'><span class='jt'>◆<span class='jt2'>◆</span></span>". convert_smilies($comment->comment_content)."</div></div></li>";
	}
	echo $output;
};
?>