<?php
add_action( 'widgets_init', 'mbt_vendor_links' );

function mbt_vendor_links() {
	register_widget( 'mbt_vendor_links' );
}

class mbt_vendor_links extends WP_Widget {
	function mbt_vendor_links() {
		$widget_ops = array( 'classname' => 'mbt_vendor_links', 'description' => '图文' );
		$this->WP_Widget( 'mbt_vendor_links', '36kr-快速链接', $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );

		$title = apply_filters('widget_name', $instance['title']);
		$code = $instance['code'];
		

		echo '<div class="vendor-links"><h3>'.$title.'</h3>';
		echo $code;
		echo '</div>';
	}

	function form( $instance ) {
?>
		<p>
			<label>
				标题：
				<input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $instance['title']; ?>" class="widefat" />
			</label>
		</p>
		<p>
			<label>
				代码：
				<textarea id="<?php echo $this->get_field_id('code'); ?>" name="<?php echo $this->get_field_name('code'); ?>" class="widefat" rows="12" style="font-family:Courier New;"><?php echo $instance['code']; ?></textarea>
			</label>
            例如（一行）：<br>&lt;article class="sidebar-sponsored__posts sidebar-popular__posts cf"&gt;<br>
                  &lt;div class="image thumb-60 right"&gt;&lt;img src="图片地址">&lt;/div&gt;<br>
                  &lt;a href="链接地址" class="external" target="_blank"&gt;标题&lt;/a&gt;<br>
                &lt;/article&gt;
		</p>
		
	<?php
	}
}


?>