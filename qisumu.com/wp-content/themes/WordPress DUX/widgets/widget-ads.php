<?php

class widget_ui_ads extends WP_Widget {
	function __construct(){
		parent::__construct( 'widget_ui_ads', 'DUX 广告', array( 'classname' => 'widget_ui_ads' ) );
	}

	function widget( $args, $instance ) {
		extract( $args );

		$title = apply_filters('widget_name', $instance['title']);
		$code = isset($instance['code']) ? $instance['code'] : '';

		echo $before_widget;
		echo '<div class="item">'.$code.'</div>';
		echo $after_widget;
	}

	function form($instance) {
		$defaults = array( 
			'title' => '广告',
			'code' => '<a href="http://themebetter.com/theme/dux" target="_blank"><img src="http://themebetter.com/uploads/2016/05/tb_dux.jpg"></a>'
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
?>
		<p>
			<label>
				广告名称：
				<input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $instance['title']; ?>" class="widefat" />
			</label>
		</p>
		<p>
			<label>
				广告代码：
				<textarea id="<?php echo $this->get_field_id('code'); ?>" name="<?php echo $this->get_field_name('code'); ?>" class="widefat" rows="12" style="font-family:Courier New;"><?php echo $instance['code']; ?></textarea>
			</label>
		</p>
<?php
	}
}