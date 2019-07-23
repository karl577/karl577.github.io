<?php
add_action( 'widgets_init', 'mbt_ad' );

function mbt_ad() {
	register_widget( 'mbt_ad' );
}

class mbt_ad extends WP_Widget {
	function mbt_ad() {
		$widget_ops = array( 'classname' => 'mbt_ad', 'description' => '广告' );
		$this->WP_Widget( 'mbt_ad', '36kr-广告', $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );

		//$title = apply_filters('widget_name', $instance['title']);
		$code = $instance['code'];
		

		echo '<div class="block ad">';
		echo $code;
		echo '</div>';
	}

	function form( $instance ) {
?>
		
		<p>
			<label>
				广告代码：
				<textarea id="<?php echo $this->get_field_id('code'); ?>" name="<?php echo $this->get_field_name('code'); ?>" class="widefat" rows="12" style="font-family:Courier New;"><?php echo $instance['code']; ?></textarea>
			</label>
		</p>
		
	<?php
	}
}


?>