<?php
/*
* ------------------------------------------------------------------------------------------------------------------------
* WIDGET FOR SEARCH
* @PACKAGE BY HAWKTHEME
* ------------------------------------------------------------------------------------------------------------------------
*/

class Search_Widget extends WP_Widget{

	/** Construction function**/
	function Search_Widget(){
		$title_ops = esc_html__(THEME_NAME.'&raquo; 搜索','HK');
		$widget_ops = array('classname'=>'widget-search','description'=>esc_html__('这个小工具将显示一个搜索。','HK'));
		$control_ops = array('width'=>250);
		$this->WP_Widget(THEME_SLUG. '_search',$title_ops,$widget_ops,$control_ops);
	}


	/** Function defined form**/
	function form($instance){
		$instance = wp_parse_args((array)$instance,array(
			'title'=> esc_html__('Search','HK')		
		));

		$title = htmlspecialchars($instance['title']);

		echo '<div class="theme-widget-wrap">';
		echo '<label for="'.$this->get_field_id('title').'">'; esc_html_e('Title:','HK'); echo'</label>';
		echo '<input  id="'.$this->get_field_id('title').'" name="'.$this->get_field_name('title').'" type="text" value="'.$title.'" />';
		echo '</div>';

	}


	/** Function defined update**/
	function update($new_instance,$old_instance){
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		return $instance;
	}


	/** Definition of widget function that displays a web page**/
	function widget($args,$instance){
		extract($args);
		$title = $instance['title'];

		echo $before_widget; 

		if($title) { echo $before_title . $title . $after_title; }

		echo '<div class="searchbox">';
		echo '<form action="'.home_url('/').'" method="get">'."\n";
		echo '<input type="text" id="widget-search-input" name="s" size="24" value="" placeholder="搜一下..." />';
		echo '<input type="submit"  id="widget-search-button" name="widget-search-button" value="" />'."\n";
		echo '</form>'."\n";
		echo '</div>'."\n";
	
		echo $after_widget; 

	}

}

?>