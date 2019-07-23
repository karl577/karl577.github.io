<?php
/*
* ------------------------------------------------------------------------------------------------------------------------
* WIDGET FOR ADS
* @PACKAGE BY HAWKTHEME
* ------------------------------------------------------------------------------------------------------------------------
*/

class Ads_Widget extends WP_Widget{

	/** Construction function**/
	function Ads_Widget(){
		$title_ops = esc_html__(THEME_NAME.'&raquo; Ads 125*125','HK');
		$widget_ops = array('classname'=>'widget-ads','description'=>esc_html__('这是一个显示广告的小工具.','HK'));
		$control_ops = array('width'=>600);
		$this->WP_Widget(THEME_SLUG. '_ads_125',$title_ops,$widget_ops,$control_ops);
	}


	/** Function defined form**/
	function form($instance){
		$image = THEME_URI.'/assets/images/ad-125.png';
		$instance = wp_parse_args((array)$instance,array(
			'title'=> 'Advertisement',
			'title_1'=> '', 'link_1'=> '', 'image_url_1' => $image,
			'title_2'=> '', 'link_2'=> '', 'image_url_2' => $image,
			'title_3'=> '', 'link_3'=> '', 'image_url_3' => $image,
			'title_4'=> '', 'link_4'=> '', 'image_url_4' => $image
		));
		$title = htmlspecialchars($instance['title']);
		$title_1 = htmlspecialchars($instance['title_1']);
		$link_1 = $instance['link_1'];
		$image_url_1 = $instance['image_url_1'];
		$title_2 = htmlspecialchars($instance['title_2']);
		$link_2 = $instance['link_2'];
		$image_url_2 = $instance['image_url_2'];
		$title_3 = htmlspecialchars($instance['title_3']);
		$link_3 = $instance['link_3'];
		$image_url_3 = $instance['image_url_3'];
		$title_4 = htmlspecialchars($instance['title_4']);
		$link_4 = $instance['link_4'];
		$image_url_4 = $instance['image_url_4'];

		echo '<div class="theme-widget-wrap theme-widget-ads">';
		echo '<label for="'.$this->get_field_id('title').'">'; esc_html_e('Title:','HK'); echo'</label>';
		echo '<input  id="'.$this->get_field_id('title').'" name="'.$this->get_field_name('title').'" type="text" value="'.$title.'" />';
		echo '</div>';

		echo '<div class="theme-ads-title">'; esc_html_e('Ads One','HK'); echo '</div>';
		echo '<div class="theme-ads-wrap">';
				echo '<div class="theme-widget-wrap">';
				echo '<label for="'.$this->get_field_id('title_1').'">'; esc_html_e('Title:','HK'); echo'</label>';
				echo '<input  id="'.$this->get_field_id('title_1').'" name="'.$this->get_field_name('title_1').'" type="text" value="'.$title_1.'" />';
				echo '</div>';

				echo '<div class="theme-widget-wrap">';
				echo '<label for="'.$this->get_field_id('image_url_1').'">'; esc_html_e('Image Url:','HK'); echo'</label>';
				echo '<input  id="'.$this->get_field_id('image_url_1').'" name="'.$this->get_field_name('image_url_1').'" type="text" value="'.$image_url_1.'" />';
				echo '</div>';

				echo '<div class="theme-widget-wrap">';
				echo '<label for="'.$this->get_field_id('link_1').'">'; esc_html_e('Link:','HK'); echo'</label>';
				echo '<input  id="'.$this->get_field_id('link_1').'" name="'.$this->get_field_name('link_1').'" type="text" value="'.$link_1.'" />';
				echo '</div>';
		echo '</div>';

		echo '<div class="theme-ads-title">'; esc_html_e('Ads Two','HK'); echo '</div>';
		echo '<div class="theme-ads-wrap">';
				echo '<div class="theme-widget-wrap">';
				echo '<label for="'.$this->get_field_id('title_2').'">'; esc_html_e('Title:','HK'); echo'</label>';
				echo '<input  id="'.$this->get_field_id('title_2').'" name="'.$this->get_field_name('title_2').'" type="text" value="'.$title_2.'" />';
				echo '</div>';

				echo '<div class="theme-widget-wrap">';
				echo '<label for="'.$this->get_field_id('image_url_2').'">'; esc_html_e('Image Url:','HK'); echo'</label>';
				echo '<input  id="'.$this->get_field_id('image_url_2').'" name="'.$this->get_field_name('image_url_2').'" type="text" value="'.$image_url_2.'" />';
				echo '</div>';
				
				echo '<div class="theme-widget-wrap">';
				echo '<label for="'.$this->get_field_id('link_2').'">'; esc_html_e('Link:','HK'); echo'</label>';
				echo '<input  id="'.$this->get_field_id('link_2').'" name="'.$this->get_field_name('link_2').'" type="text" value="'.$link_2.'" />';
				echo '</div>';
		echo '</div>';

		echo '<div class="theme-ads-title">'; esc_html_e('Ads Three','HK'); echo '</div>';
		echo '<div class="theme-ads-wrap">';
				echo '<div class="theme-widget-wrap">';
				echo '<label for="'.$this->get_field_id('title_3').'">'; esc_html_e('Title:','HK'); echo'</label>';
				echo '<input  id="'.$this->get_field_id('title_3').'" name="'.$this->get_field_name('title_3').'" type="text" value="'.$title_3.'" />';
				echo '</div>';

				echo '<div class="theme-widget-wrap">';
				echo '<label for="'.$this->get_field_id('image_url_3').'">'; esc_html_e('Image Url:','HK'); echo'</label>';
				echo '<input  id="'.$this->get_field_id('image_url_3').'" name="'.$this->get_field_name('image_url_3').'" type="text" value="'.$image_url_3.'" />';
				echo '</div>';

				echo '<div class="theme-widget-wrap">';
				echo '<label for="'.$this->get_field_id('link_3').'">'; esc_html_e('Link:','HK'); echo'</label>';
				echo '<input  id="'.$this->get_field_id('link_3').'" name="'.$this->get_field_name('link_3').'" type="text" value="'.$link_3.'" />';
				echo '</div>';
		echo '</div>';

		echo '<div class="theme-ads-title">'; esc_html_e('Ads Four','HK'); echo '</div>';
		echo '<div class="theme-ads-wrap">';
				echo '<div class="theme-widget-wrap">';
				echo '<label for="'.$this->get_field_id('title_4').'">'; esc_html_e('Title:','HK'); echo'</label>';
				echo '<input  id="'.$this->get_field_id('title_4').'" name="'.$this->get_field_name('title_4').'" type="text" value="'.$title_4.'" />';
				echo '</div>';

				echo '<div class="theme-widget-wrap">';
				echo '<label for="'.$this->get_field_id('image_url_4').'">'; esc_html_e('Image Url:','HK'); echo'</label>';
				echo '<input  id="'.$this->get_field_id('image_url_4').'" name="'.$this->get_field_name('image_url_4').'" type="text" value="'.$image_url_4.'" />';
				echo '</div>';
				
				echo '<div class="theme-widget-wrap">';
				echo '<label for="'.$this->get_field_id('link_4').'">'; esc_html_e('Link:','HK'); echo'</label>';
				echo '<input  id="'.$this->get_field_id('link_4').'" name="'.$this->get_field_name('link_4').'" type="text" value="'.$link_4.'" />';
				echo '</div>';
		echo '</div>';
	}


	/** Function defined update**/
	function update($new_instance,$old_instance){

		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['title_1'] = strip_tags($new_instance['title_1']);
		$instance['title_2'] = strip_tags($new_instance['title_2']);
		$instance['title_3'] = strip_tags($new_instance['title_3']);
		$instance['title_4'] = strip_tags($new_instance['title_4']);
		$instance['link_1'] = strip_tags($new_instance['link_1']);
		$instance['link_2'] = strip_tags($new_instance['link_2']);
		$instance['link_3'] = strip_tags($new_instance['link_3']);
		$instance['link_4'] = strip_tags($new_instance['link_4']);
		$instance['image_url_1'] = strip_tags($new_instance['image_url_1']);
		$instance['image_url_2'] = strip_tags($new_instance['image_url_2']);
		$instance['image_url_3'] = strip_tags($new_instance['image_url_3']);
		$instance['image_url_4'] = strip_tags($new_instance['image_url_4']);
		return $instance;

	}


	/** Definition of widget function that displays a web page**/
	function widget($args,$instance){
		extract($args);

		$title = $instance['title'];
		$title_1 = $instance['title_1'];
		$title_2 = $instance['title_2'];
		$title_3 = $instance['title_3'];
		$title_4 = $instance['title_4'];
		$link_1 = $instance['link_1'];
		$link_2 = $instance['link_2'];
		$link_3 = $instance['link_3'];
		$link_4 = $instance['link_4'];
		$image_url_1 = $instance['image_url_1'];
		$image_url_2 = $instance['image_url_2'];
		$image_url_3 = $instance['image_url_3'];
		$image_url_4 = $instance['image_url_4'];

		echo $before_widget; 
		echo $before_title . $title . $after_title;

		echo '<ul class="clearfix">'."\n";

		if($image_url_1) {
			echo '<li><a href="'.$link_1.'"  title="'.$title_1.'" alt="'.$title_1.'" rel="external"><img src="'.$image_url_1.'" alt="'.$title_1.'"  /></a></li>';
		}

		if($image_url_2) {
			echo '<li class="last"><a href="'.$link_2.'"  title="'.$title_2.'" alt="'.$title_2.'" rel="external"><img src="'.$image_url_2.'" alt="'.$title_2.'"  /></a></li>';
		}

		if($image_url_3) {
			echo '<li><a href="'.$link_3.'"  title="'.$title_3.'" alt="'.$title_3.'" rel="external"><img src="'.$image_url_3.'" alt="'.$title_3.'" /></a></li>';
		}

		if($image_url_4) {
			echo '<li class="last"><a href="'.$link_4.'" title="'.$title_4.'" alt="'.$title_4.'" rel="external"><img src="'.$image_url_4.'" alt="'.$title_4.'" /></a></li>';
		}

		echo '</ul>'."\n";

		echo $after_widget; 

	}

}

?>