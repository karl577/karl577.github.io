<?php
/*
* ------------------------------------------------------------------------------------------------------------------------
* WIDGET FOR FLICKR
* @PACKAGE BY HAWKTHEME
* ------------------------------------------------------------------------------------------------------------------------
*/

class Flickr_Widget extends WP_Widget{

	/** Construction function**/
	function Flickr_Widget(){
		$title_ops = esc_html__(THEME_NAME.'&raquo; Flickr','HK');
		$widget_ops = array('classname'=>'widget-flickr','description'=>esc_html__('这个小工具将显示Flickr的一部分. ','HK'));
		$control_ops = array('width'=>250);
		$this->WP_Widget(THEME_SLUG. '_flickr',$title_ops,$widget_ops,$control_ops);
	}


	/** Function defined form**/
	function form($instance){
		$instance = wp_parse_args((array)$instance,array(
			'title'=> esc_html__('Flickr','HK'),
			'account' => '',
			'showposts'=> 8,
			'display_mode' => 'latest'			
		));

		$title = htmlspecialchars($instance['title']);
		$account = htmlspecialchars($instance['account']);
		$showposts = htmlspecialchars($instance['showposts']);
		$display_mode = htmlspecialchars($instance['display_mode']);

		echo '<div class="theme-widget-wrap">';
		echo '<label for="'.$this->get_field_id('title').'">'; esc_html_e('Title:','HK'); echo'</label>';
		echo '<input  id="'.$this->get_field_id('title').'" name="'.$this->get_field_name('title').'" type="text" value="'.$title.'" />';
		echo '</div>';

		echo '<div class="theme-widget-wrap">';
		echo '<label for="'.$this->get_field_id('account').'">'; esc_html_e('Account:','HK'); echo'</label>';
		echo '<input  id="'.$this->get_field_id('account').'" name="'.$this->get_field_name('account').'" type="text" value="'.$account.'" />';
		echo '<p class="theme-description"><a href="http://idgettr.com/" target="_blank">';  
		esc_html_e('Get your flickr account.','HK');
		echo '</a></p>';
		echo '</div>';

		echo '<div class="theme-widget-wrap">';
		echo '<label for="'.$this->get_field_id('showposts').'">'; esc_html_e('Showposts:','HK'); echo'</label>';
		echo '<input  id="'.$this->get_field_id('showposts').'" name="'.$this->get_field_name('showposts').'" type="text" value="'.$showposts.'" />';
		echo '</div>';

		echo '<div class="theme-widget-wrap">';
		echo '<label for="'.$this->get_field_id('display_mode').'">'; esc_html_e('Orderby:','HK'); echo'</label>';
		echo '<select name="'.$this->get_field_name('display_mode').'">';
		echo '<option value="latest" '; selected('latest', $instance['display_mode']); echo '>'; esc_html_e('Latest','HK'); echo '</option>';
		echo '<option value="random" '; selected('random', $instance['display_mode']); echo '>'; esc_html_e('Random','HK'); echo '</option>';
		echo '</select>';
		echo '</div>';

	}


	/** Function defined update**/
	function update($new_instance,$old_instance){
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['account'] = strip_tags($new_instance['account']);
		$instance['showposts'] = strip_tags($new_instance['showposts']);
		$instance['display_mode'] = strip_tags($new_instance['display_mode']);
		return $instance;
	}


	/** Definition of widget function that displays a web page**/
	function widget($args,$instance){
		extract($args);
		$title = $instance['title'];
		$account = $instance['account'];
		$showposts = $instance['showposts'];
		$display_mode = $instance['display_mode'];

		echo $before_widget; 
		echo $before_title . $title . '<span><a href="http://www.flickr.com/photos/'.$account.'">View All</a></span>' . $after_title;
		echo '<div id="flickr_badge_wrapper" class="clearfix">';
		echo '<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count='.$showposts.'&amp;display='.$display_mode.'&amp;size=s&amp;layout=x&amp;source=user&amp;user='.$account.'"></script>';
		echo '</div>';
		echo $after_widget; 

	}

}

?>