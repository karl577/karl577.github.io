<?php
/*
* ------------------------------------------------------------------------------------------------------------------------
* WIDGET FOR SOCIAL MEDIA
* @PACKAGE BY HAWKTHEME
* ------------------------------------------------------------------------------------------------------------------------
*/

class Social_Media_Widget extends WP_Widget{

	/** Construction function**/
	function Social_Media_Widget(){
		$title_ops = esc_html__(THEME_NAME.'&raquo; 社会媒体','HK');
		$widget_ops = array('classname'=>'widget-social-media','description'=>esc_html__('这是一个社会媒体列表','HK'));
		$control_ops = array('width'=>450);
		$this->WP_Widget(THEME_SLUG. '_social_media',$title_ops,$widget_ops,$control_ops);
	}


	/** Function defined form**/
	function form($instance){
		$instance = wp_parse_args((array)$instance,array(
			'title' => esc_html__('Social Media','HK'),
			'feed' => esc_attr( get_bloginfo('rss2_url') ),
			'twitter' => '',
			'youtube' => '',
			'linkedin' => '',
			'facebook' => '',
			'digg' => '',
			'flickr' => '',
			'delicious' => '',
			'stumble' => '',
			'myspace' => '',
			'google' => ''
		));

		$title = htmlspecialchars($instance['title']);
		$feed = htmlspecialchars($instance['feed']);
		$twitter = htmlspecialchars($instance['twitter']);
		$youtube = htmlspecialchars($instance['youtube']);
		$linkedin = htmlspecialchars($instance['linkedin']);
		$facebook = htmlspecialchars($instance['facebook']);
		$digg = htmlspecialchars($instance['digg']);
		$flickr = htmlspecialchars($instance['flickr']);
		$delicious = htmlspecialchars($instance['delicious']);
		$stumble = htmlspecialchars($instance['stumble']);
		$myspace = htmlspecialchars($instance['myspace']);
		$google = htmlspecialchars($instance['google']);

		echo '<div class="theme-widget-wrap">';
		echo '<label for="'.$this->get_field_id('title').'">'; esc_html_e('Title:','HK'); echo'</label>';
		echo '<input  id="'.$this->get_field_id('title').'" name="'.$this->get_field_name('title').'" type="text" value="'.$title.'" />';
		echo '</div>';

		echo '<div class="theme-widget-wrap">';
		echo '<label for="'.$this->get_field_id('feed').'">'; esc_html_e('Feed Rss:','HK'); echo'</label>';
		echo '<input  id="'.$this->get_field_id('feed').'" name="'.$this->get_field_name('feed').'" type="text" value="'.$feed.'" />';
		echo '</div>';

		echo '<div class="theme-widget-wrap">';
		echo '<label for="'.$this->get_field_id('twitter').'">'; esc_html_e('Twitter:','HK'); echo'</label>';
		echo '<input  id="'.$this->get_field_id('twitter').'" name="'.$this->get_field_name('twitter').'" type="text" value="'.$twitter.'" />';
		echo '</div>';

		echo '<div class="theme-widget-wrap">';
		echo '<label for="'.$this->get_field_id('youtube').'">'; esc_html_e('Youtube:','HK'); echo'</label>';
		echo '<input  id="'.$this->get_field_id('youtube').'" name="'.$this->get_field_name('youtube').'" type="text" value="'.$youtube.'" />';
		echo '</div>';

		echo '<div class="theme-widget-wrap">';
		echo '<label for="'.$this->get_field_id('linkedin').'">'; esc_html_e('Linkedin:','HK'); echo'</label>';
		echo '<input  id="'.$this->get_field_id('linkedin').'" name="'.$this->get_field_name('linkedin').'" type="text" value="'.$linkedin.'" />';
		echo '</div>';

		echo '<div class="theme-widget-wrap">';
		echo '<label for="'.$this->get_field_id('facebook').'">'; esc_html_e('Facebook:','HK'); echo'</label>';
		echo '<input  id="'.$this->get_field_id('facebook').'" name="'.$this->get_field_name('facebook').'" type="text" value="'.$facebook.'" />';
		echo '</div>';

		echo '<div class="theme-widget-wrap">';
		echo '<label for="'.$this->get_field_id('digg').'">'; esc_html_e('Digg:','HK'); echo'</label>';
		echo '<input  id="'.$this->get_field_id('digg').'" name="'.$this->get_field_name('digg').'" type="text" value="'.$digg.'" />';
		echo '</div>';

		echo '<div class="theme-widget-wrap">';
		echo '<label for="'.$this->get_field_id('flickr').'">'; esc_html_e('Flickr:','HK'); echo'</label>';
		echo '<input  id="'.$this->get_field_id('flickr').'" name="'.$this->get_field_name('flickr').'" type="text" value="'.$flickr.'" />';
		echo '</div>';

		echo '<div class="theme-widget-wrap">';
		echo '<label for="'.$this->get_field_id('delicious').'">'; esc_html_e('Delicious:','HK'); echo'</label>';
		echo '<input  id="'.$this->get_field_id('delicious').'" name="'.$this->get_field_name('delicious').'" type="text" value="'.$delicious.'" />';
		echo '</div>';

		echo '<div class="theme-widget-wrap">';
		echo '<label for="'.$this->get_field_id('stumble').'">'; esc_html_e('Stumble:','HK'); echo'</label>';
		echo '<input  id="'.$this->get_field_id('stumble').'" name="'.$this->get_field_name('stumble').'" type="text" value="'.$stumble.'" />';
		echo '</div>';

		echo '<div class="theme-widget-wrap">';
		echo '<label for="'.$this->get_field_id('myspace').'">'; esc_html_e('Myspace:','HK'); echo'</label>';
		echo '<input  id="'.$this->get_field_id('myspace').'" name="'.$this->get_field_name('myspace').'" type="text" value="'.$myspace.'" />';
		echo '</div>';

		echo '<div class="theme-widget-wrap">';
		echo '<label for="'.$this->get_field_id('google').'">'; esc_html_e('Google:','HK'); echo'</label>';
		echo '<input  id="'.$this->get_field_id('google').'" name="'.$this->get_field_name('google').'" type="text" value="'.$google.'" />';
		echo '</div>';

	}


	/** Function defined update**/
	function update($new_instance,$old_instance){
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['feed'] = strip_tags($new_instance['feed']);
		$instance['twitter'] = strip_tags($new_instance['twitter']);
		$instance['youtube'] = strip_tags($new_instance['youtube']);
		$instance['linkedin'] = strip_tags($new_instance['linkedin']);
		$instance['facebook'] = strip_tags($new_instance['facebook']);
		$instance['digg'] = strip_tags($new_instance['digg']);
		$instance['flickr'] = strip_tags($new_instance['flickr']);
		$instance['delicious'] = strip_tags($new_instance['delicious']);
		$instance['stumble'] = strip_tags($new_instance['stumble']);
		$instance['myspace'] = strip_tags($new_instance['myspace']);
		$instance['google'] = strip_tags($new_instance['google']);

		return $instance;
	}


	/** Definition of widget function that displays a web page**/
	function widget($args,$instance){
		extract($args);
		$title = $instance['title'];
		$feed = $instance['feed'];
		$twitter = $instance['twitter'];
		$youtube = $instance['youtube'];
		$linkedin = $instance['linkedin'];
		$facebook = $instance['facebook'];
		$digg = $instance['digg'];
		$flickr = $instance['flickr'];
		$delicious = $instance['delicious'];
		$stumble = $instance['stumble'];
		$myspace = $instance['myspace'];
		$google = $instance['google'];

		echo $before_widget; 
		if($title) { echo $before_title . $title . $after_title; }

		echo '<div class="social-media-box clearfix">';

		if($feed) {
			echo '<a href="'.$feed.'" rel="external" class="rss">'; esc_html_e('rss','HK'); echo '</a>';
		}

		if($twitter) {
			echo '<a href="'.$twitter.'" rel="external" class="twitter">'; esc_html_e('twitter','HK'); echo '</a>';
		}

		if($youtube) {
			echo '<a href="'.$youtube.'" rel="external" class="youtube">'; esc_html_e('youtube','HK'); echo '</a>';
		}

		if($linkedin) {
			echo '<a href="'.$linkedin.'" rel="external" class="linkedin">'; esc_html_e('linkedin','HK'); echo '</a>';
		}

		if($facebook) {
			echo '<a href="'.$facebook.'" rel="external" class="facebook">'; esc_html_e('facebook','HK'); echo '</a>';
		}

		if($digg) {
			echo '<a href="'.$digg.'" rel="external" class="digg">'; esc_html_e('digg','HK'); echo '</a>';
		}

		if($flickr) {
			echo '<a href="'.$flickr.'" rel="external" class="flickr">'; esc_html_e('flickr','HK'); echo '</a>';
		}

		if($delicious) {
			echo '<a href="'.$delicious.'" rel="external" class="delicious">'; esc_html_e('delicious','HK'); echo '</a>';
		}

		if($stumble) {
			echo '<a href="'.$stumble.'" rel="external" class="stumble">'; esc_html_e('stumble','HK'); echo '</a>';
		}

		if($myspace) {
			echo '<a href="'.$myspace.'" rel="external" class="myspace">'; esc_html_e('myspace','HK'); echo '</a>';
		}

		if($google) {
			echo '<a href="'.$google.'" rel="external" class="google">'; esc_html_e('google','HK'); echo '</a>';
		}

		echo '</div>';

		echo $after_widget; 

	}

}

?>