<?php  
add_action( 'widgets_init', 'e_banners' );

function e_banners() {
	register_widget( 'e_banner' );
}

class e_banner extends WP_Widget {
	function e_banner() {
		$widget_ops = array( 'classname' => 'e_banner', 'description' => '显示一个广告(包括富媒体)，或者是其它的html代码' );
		$this->WP_Widget( 'e_banner', 'Enews-广告', $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );

		$title = apply_filters('widget_name', $instance['title']);
		$code = $instance['code'];

		echo $before_widget;
		echo '<div class="adhtml">'.$code.'</div>';
		echo $after_widget;
	}

	function form($instance) {
?>

<p>
  <label> 标题：
    <input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $instance['title']; ?>" class="widefat" />
  </label>
</p>
<p>
  <label> 代码：
    <textarea id="<?php echo $this->get_field_id('code'); ?>" name="<?php echo $this->get_field_name('code'); ?>" class="widefat" rows="12" style="font-family:Courier New;"><?php echo $instance['code']; ?></textarea>
  </label>
</p>
<?php
	}
}

?>
