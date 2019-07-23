<?php  
add_action( 'widgets_init', 'e_tags' );

function e_tags() {
	register_widget( 'e_tag' );
}

class e_tag extends WP_Widget {
	function e_tag() {
		$widget_ops = array( 'classname' => 'e_tag', 'description' => '显示热门标签' );
		$this->WP_Widget( 'e_tag', 'Enews-标签云', $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );

		$title = apply_filters('widget_name', $instance['title']);
		$count = $instance['count'];
		$offset = $instance['offset'];
		$more = $instance['more'];
		$link = $instance['link'];

		$mo='';
		if( $more!='' && $link!='' ) $mo='<a class="btn btn-primary" href="'.$link.'">'.$more.'</a>';

		echo $before_widget;
		echo $before_title.$mo.$title.$after_title; 
		echo '<div class="e_tags" id="e_tags">';
		$tags_list = get_tags('orderby=count&order=DESC&number='.$count.'&offset='.$offset);
		if ($tags_list) { 
			foreach($tags_list as $tag) {
				echo '<a href="'.get_tag_link($tag).'">'. $tag->name .' ('. $tag->count .')</a>'; 
			} 
		}else{
			echo '暂无标签！';
		}
		echo '</div>';
		echo $after_widget;
	}

	function form($instance) {
?>

<p>
  <label> 名称：
    <input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $instance['title']; ?>" class="widefat" />
  </label>
</p>
<p>
  <label> 显示数量：
    <input id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>" type="number" value="<?php echo $instance['count']; ?>" class="widefat" />
  </label>
</p>
<p>
  <label> 去除前几个：
    <input id="<?php echo $this->get_field_id('offset'); ?>" name="<?php echo $this->get_field_name('offset'); ?>" type="number" value="<?php echo $instance['offset']; ?>" class="widefat" />
  </label>
</p>
<?php
	}
}

?>
