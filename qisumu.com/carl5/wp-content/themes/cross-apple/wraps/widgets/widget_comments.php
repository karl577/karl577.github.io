<?php
/*
* ------------------------------------------------------------------------------------------------------------------------
* WIDGET FOR COMMENTS
* @PACKAGE BY HAWKTHEME
* ------------------------------------------------------------------------------------------------------------------------
*/

class Comments_Widget extends WP_Widget{

	/** Construction function**/
	function Comments_Widget(){
		$title_ops = esc_html__(THEME_NAME.'&raquo; 评论','HK');
		$widget_ops = array('classname'=>'widget-comments','description'=>esc_html__('这是一个评论列表.','HK'));
		$control_ops = array('width'=>250);
		$this->WP_Widget(THEME_SLUG. '_comments',$title_ops,$widget_ops,$control_ops);
	}


	/** Function defined form**/
	function form($instance){
		$instance = wp_parse_args((array)$instance,array(
			'title' => esc_html__('评论','HK'),
			'showposts' => 3,
			'avatar' => 'true',
		));

		$title = htmlspecialchars($instance['title']);
		$showposts = htmlspecialchars($instance['showposts']);
		$avatar = htmlspecialchars($instance['avatar']);

		echo '<div class="theme-widget-wrap">';
		echo '<label for="'.$this->get_field_id('title').'">'; esc_html_e('Title:','HK'); echo'</label>';
		echo '<input  id="'.$this->get_field_id('title').'" name="'.$this->get_field_name('title').'" type="text" value="'.$title.'" />';
		echo '</div>';

		echo '<div class="theme-widget-wrap theme-shorttext">';
		echo '<label for="'.$this->get_field_id('showposts').'">'; esc_html_e('Showposts:','HK'); echo'</label>';
		echo '<input  id="'.$this->get_field_id('showposts').'" name="'.$this->get_field_name('showposts').'" type="text" value="'.$showposts.'" />';
		echo '</div>';

		echo '<div class="theme-widget-wrap">';

		echo '<label for="'.$this->get_field_id('avatar').'">'; 
		echo '<input type="checkbox" name="'.$this->get_field_name('avatar').'"'; 
		checked('true', $instance['avatar']); 
		echo 'value="true" />';
		echo '<em>'; esc_html_e('Display with avatar.','HK'); echo '</em>';
		echo'</label>';

		echo '</div>';

	}


	/** Function defined update**/
	function update($new_instance,$old_instance){
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['showposts'] = strip_tags($new_instance['showposts']);
		$instance['avatar'] = strip_tags($new_instance['avatar']);

		return $instance;
	}


	/** Definition of widget function that displays a web page**/
	function widget($args,$instance){
		extract($args);
		$title = $instance['title'];
		$showposts = $instance['showposts'];
		$avatar = $instance['avatar'];

		echo $before_widget; 
		echo $before_title . $title . $after_title;

		echo '<ul>'."\n";

		$show_comments = $showposts+1; 
		$my_email = get_option('admin_email'); 
		$comments = get_comments('number='.$show_comments.'&status=approve&type=comment'); 

		foreach ($comments as $rc_comment) {

			if ($rc_comment->comment_author_email != $my_email) {

			echo '<li class="clearfix">'."\n";

			if($avatar == 'true') {

			echo '<figure class="alignleft post-thumb-comment">'."\n";
			echo '<a href="'.get_permalink($rc_comment->comment_post_ID).'#comment-'.$rc_comment->comment_ID.'">';
			echo get_avatar($rc_comment->comment_author_email,50);
			echo '</a></figure>'."\n";

			}

			echo '<section>'."\n";
			echo '<h5><a href="'.get_permalink($rc_comment->comment_post_ID).'#comment-'.$rc_comment->comment_ID.'">'.theme_max_char($rc_comment->comment_content, 60," ").'</a></h5>'."\n";
			echo '<p class="post-meta">';
			esc_html_e('Post: ','HK'); 
			echo $rc_comment->comment_date;
			echo '</p>'."\n";
			echo '</section>'."\n";

			echo '</li>'."\n";

			}

		}//END FOREACH

		wp_reset_postdata();

		echo '</ul>'."\n";

		echo $after_widget; 

	}

}

?>