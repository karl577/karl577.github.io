<?php

class widget_ui_sticky extends WP_Widget {
function __construct(){
		parent::__construct( 'widget_ui_sticky', 'DUX 置顶推荐', array( 'classname' => 'widget_ui_posts' ) );
	}

	function widget( $args, $instance ) {
		extract( $args );

		$title = apply_filters('widget_name', $instance['title']);
		$limit = isset($instance['limit']) ? $instance['limit'] : 6;
		$img   = isset($instance['img']) ? $instance['img'] : '';

		$style='';
		if( !$img ) $style = ' class="nopic"';
		echo $before_widget;
		echo $before_title.$title.$after_title; 
		echo '<ul'.$style.'>';
		echo dd_sticky_posts_list( $limit,$img );
		echo '</ul>';
		echo $after_widget;
	}

	function form( $instance ) {
		$defaults = array( 
			'title' => '置顶推荐', 
			'limit' => 6,  
			'img' => ''
		);
		$instance = wp_parse_args( (array) $instance, $defaults );
?>
		<p>
			<label>
				标题：
				<input style="width:100%;" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $instance['title']; ?>" />
			</label>
		</p>
		<p>
			<label>
				显示数目：
				<input style="width:100%;" id="<?php echo $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>" type="number" value="<?php echo $instance['limit']; ?>" size="24" />
			</label>
		</p>
		<p>
			<label>
				<input style="vertical-align:-3px;margin-right:4px;" class="checkbox" type="checkbox" <?php checked( $instance['img'], 'on' ); ?> id="<?php echo $this->get_field_id('img'); ?>" name="<?php echo $this->get_field_name('img'); ?>">显示图片
			</label>
		</p>
		
	<?php
	}
}


function dd_sticky_posts_list($limit,$img) {
	$sticky = get_option('sticky_posts'); rsort( $sticky );
	$args = array(
		'post__in' => $sticky,
		'showposts'        => $limit,
		'ignore_sticky_posts' => 1
	);
	query_posts($args);
	while (have_posts()) : the_post(); 
?>
<li><a<?php echo _post_target_blank() ?> href="<?php the_permalink(); ?>"><?php if( $img ){echo '<span class="thumbnail">'; echo _get_post_thumbnail(); echo '</span>'; }else{$img = '';} ?><span class="text"><?php the_title(); ?></span><span class="muted"><?php the_time('Y-m-d');?></span><span class="muted"><?php echo '评论(', comments_number('', '1', '%'), ')'; ?></span></a></li>
<?php
	
    endwhile; wp_reset_query();
}