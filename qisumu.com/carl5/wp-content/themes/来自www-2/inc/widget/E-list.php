<?php
add_action( 'widgets_init', 'e_postlists' );

function e_postlists() {
	register_widget( 'e_postlist' );
}

class e_postlist extends WP_Widget {
	function e_postlist() {
		$widget_ops = array( 'classname' => 'e_postlist', 'description' => '图文展示（最新文章+热门文章+随机文章）' );
		$this->WP_Widget( 'e_postlist', 'Enews-聚合文章', $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );

		$title        = apply_filters('widget_name', $instance['title']);
		$limit        = $instance['limit'];
		$cat          = $instance['cat'];
		$orderby      = $instance['orderby'];
		$img = $instance['img'];

		$mo='';
		$style='';
		if( !$img ) $style = 'nopic';
		echo $before_widget;
		echo $before_title.$mo.$title.$after_title; 
		echo '<ul class="juhe'.$style.'">';
		echo enews_posts_list( $orderby,$limit,$cat,$img );
		echo '</ul>';
		echo $after_widget;
	}

	function form( $instance ) {
?>

<p>
  <label> 标题：
    <input style="width:100%;" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $instance['title']; ?>" />
  </label>
</p>
<p>
  <label> 排序：
    <select id="<?php echo $this->get_field_id('orderby'); ?>" name="<?php echo $this->get_field_name('orderby'); ?>" style="width:100%;">
      <option value="comment_count" <?php selected('comment_count', $instance['orderby']); ?>>评论数</option>
      <option value="date" <?php selected('date', $instance['orderby']); ?>>发布时间</option>
      <option value="rand" <?php selected('rand', $instance['orderby']); ?>>随机</option>
    </select>
  </label>
</p>
<p>
  <label> 分类限制： <a style="font-weight:bold;color:#f60;text-decoration:none;" href="javascript:;" title="格式：1,2 &nbsp;表限制ID为1,2分类的文章&#13;格式：-1,-2 &nbsp;表排除分类ID为1,2的文章&#13;也可直接写1或者-1；注意逗号须是英文的">？</a>
    <input style="width:100%;" id="<?php echo $this->get_field_id('cat'); ?>" name="<?php echo $this->get_field_name('cat'); ?>" type="text" value="<?php echo $instance['cat']; ?>" size="24" />
  </label>
</p>
<p>
  <label> 显示数目：
    <input style="width:100%;" id="<?php echo $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>" type="number" value="<?php echo $instance['limit']; ?>" size="24" />
  </label>
</p>
<p>
  <label>
    <input style="vertical-align:-3px;margin-right:4px;" class="checkbox" type="checkbox" <?php checked( $instance['img'], 'on' ); ?> id="<?php echo $this->get_field_id('img'); ?>" name="<?php echo $this->get_field_name('img'); ?>">
    显示图片 </label>
</p>
<?php
	}
}


function enews_posts_list($orderby,$limit,$cat,$img) {
	$args = array(
		'order'            => DESC,
		'cat'              => $cat,
		'orderby'          => $orderby,
		'showposts'        => $limit,
		'caller_get_posts' => 1
	);
	query_posts($args);
	while (have_posts()) : the_post(); 
?>
<li><a href="<?php the_permalink(); ?>">
  <?php if( $img ){echo '<span class="thumbnail"><img src="'; echo catch_first_image(); echo '" /></span>'; }else{$img = '';} ?>
  <span class="text">
  <?php the_title(); ?>
  </span><span class="muted">
  <?php the_time('Y-m-d');?>
  </span><span class="muted">
  <?php comments_number('', '1评论', '%评论'); ?>
  </span></a></li>
<?php
	
    endwhile; wp_reset_query();
}

?>
