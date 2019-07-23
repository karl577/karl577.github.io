<?php  
add_action( 'widgets_init', 'mbt_comments' );

function mbt_comments() {
	register_widget( 'mbt_comments' );
}

class mbt_comments extends WP_Widget {
	function mbt_comments() {
		$widget_ops = array( 'classname' => 'mbt_comments', 'description' => '显示网友最新评论（头像+名称+评论）' );
		$this->WP_Widget( 'mbt_comments', '36kr-最新评论', $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );

		$title = apply_filters('widget_name', $instance['title']);
		$limit = $instance['limit'];
		$outer = $instance['outer'];
		$outpost = $instance['outpost'];
		
		echo $before_widget;
		echo $before_title.$title.$after_title; 
		echo '<ul>';
		echo MBT_monkey_comments( $limit,$outpost,$outer );
		echo '</ul>';
		echo $after_widget;
	}

	function form($instance) {

?>
		<p>
			<label>
				标题：
				<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $instance['title']; ?>" />
			</label>
		</p>
		<p>
			<label>
				显示数目：
				<input class="widefat" id="<?php echo $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>" type="number" value="<?php echo $instance['limit']; ?>" />
			</label>
		</p>
		<p>
			<label>
				排除某用户ID：
				<input class="widefat" id="<?php echo $this->get_field_id('outer'); ?>" name="<?php echo $this->get_field_name('outer'); ?>" type="number" value="<?php echo $instance['outer']; ?>" />
			</label>
		</p>
		<p>
			<label>
				排除某文章ID：
				<input class="widefat" id="<?php echo $this->get_field_id('outpost'); ?>" name="<?php echo $this->get_field_name('outpost'); ?>" type="text" value="<?php echo $instance['outpost']; ?>" />
			</label>
		</p>

<?php
	}
}

function MBT_monkey_comments( $limit,$outpost,$outer ){
	global $wpdb;
	$sql = "SELECT DISTINCT ID, post_title, post_password, comment_ID, comment_post_ID, comment_author, user_id, comment_date_gmt, comment_approved,comment_author_email, comment_type,comment_author_url, SUBSTRING(comment_content,1,40) AS com_excerpt FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID = $wpdb->posts.ID) WHERE comment_post_ID!='".$outpost."' AND user_id!='".$outer."' AND comment_approved = '1' AND comment_type = '' AND post_password = '' ORDER BY comment_date_gmt DESC LIMIT $limit";
	$comments = $wpdb->get_results($sql);
	foreach ( $comments as $comment ) {
		$output .= '<li><img alt="" src="'.MBT_monkey_get_avatar($comment->user_id).'" class="avatar avatar-36 photo" height="36" width="36"> <a href="'.get_permalink($comment->ID).'#comment-'.$comment->comment_ID.'" title="'.$comment->post_title.' 的评论" class="comment_r"><p>'.strip_tags($comment->comment_author).'：</p><p>'.str_replace(' src=', ' data-original=', convert_smilies(strip_tags($comment->com_excerpt))).'</p></a></li>';
	}
	echo $output;
};

?>