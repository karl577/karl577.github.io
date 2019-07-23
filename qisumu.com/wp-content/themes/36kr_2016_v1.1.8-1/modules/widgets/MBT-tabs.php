<?php
add_action( 'widgets_init', 'mbt_post_news' );

function mbt_post_news() {
	register_widget( 'mbt_post_news' );
}

class mbt_post_news extends WP_Widget {
	function mbt_post_news() {
		$widget_ops = array( 'classname' => 'top-articles', 'description' => '文字展示' );
		$this->WP_Widget( 'mbt_post_news', '36kr-Tabs选项卡', $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );

		$limit        = $instance['limit'];
		$count        = $instance['count'];		
		
		echo '<div class="fast-section mobile-hide"><div class="list J_fastSectionList">';
		echo '<div class="tabs J_fastSectionNavBar"><a class="active newsflashes_nav" href="#">推荐阅读</a><a class="product_notes_nav" href="#">快讯</a></div>'; 
		echo '<div class="wrap"><div class="panel">';
		MBT_posts_recommend_tabs_list($limit);
		echo '</div>';
		echo '<div class="panel" style="display: none">';
		MBT_posts_news_tabs_list($count);
		echo '</div>';
		echo '</div></div></div>';
	}

	function form( $instance ) {
?>

<p>
  <label> 显示推荐数目：
  <input style="width:100%;" id="<?php echo $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>" type="number" value="<?php echo $instance['limit']; ?>" size="24" />
  </label>
</p>
<p>
  <label> 显示快讯数目：
  <input style="width:100%;" id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>" type="number" value="<?php echo $instance['count']; ?>" size="24" />
  </label>
</p>

<?php
	}
}



function MBT_posts_recommend_tabs_list($limit) {
	$args = array(
		'post_type'        => 'post',
		'order'            => DESC,
		'orderby'          => 'date',
		'caller_get_posts' => 1,
		'meta_query' => array(array('key'=>'recommend','value'=>'1')),
		'showposts'        => $limit
	);
	query_posts($args);
	while (have_posts()) : the_post(); 
?>
<section class="selected">
    <h3><?php the_title(); ?></h3>
    <div class="desc"> <?php echo MBT_monkey_get_excerpt(120,'');?><a href="<?php the_permalink();?>" target="_blank">[查看详情]</a></div>
    <div class="info"><span class="time">
      <time class="timeago" datetime="<?php echo get_gmt_from_date(get_the_time('Y-m-d G:i:s') ) ?>"><?php echo timeago( get_gmt_from_date(get_the_time('Y-m-d G:i:s')) ) ?></time>
      </span><span class="share"> 分享到
      <div class="share-group"><a class="weixin mobile-hide" href="javascript:void(0)" ref="nofollow" target="_blank"><i class="icon-weixin"></i>
        <div class="panel-weixin">
          <section class="weixin-section">
            <p><img alt="<?php the_title(); ?>" src="http://s.jiathis.com/qrcode.php?url=<?php the_permalink();?>?via=wechat_qr" /></p>
          </section>
          <h3>打开微信“扫一扫”，打开网页后点击屏幕右上角分享按钮</h3>
        </div>
        </a><a class="weibo" href="http://share.baidu.com/s?type=text&amp;searchPic=0&amp;sign=on&amp;to=tsina&amp;url=<?php the_permalink();?>&amp;title=<?php the_title(); ?>" ref="nofollow" target="_blank"><i class="icon-weibo"></i></a></div>。
      </span></div>
  </section>
<?php endwhile; wp_reset_query();

}

function MBT_posts_news_tabs_list($limit) {
	$args = array(
		'post_type'        => 'news',
		'order'            => DESC,
		'orderby'          => 'date',
		'showposts'        => $limit
	);
	query_posts($args);
	while (have_posts()) : the_post(); 
?>
<section class="product">
	<a href="<?php the_permalink();?>" target="_blank">
    <h3><?php the_title(); ?></h3>
    </a>
    <?php the_content();?>
    <div class="info"><span class="time"><?php echo timeago( get_gmt_from_date(get_the_time('Y-m-d G:i:s')) ) ?></span><span class="share"> 分享到
      <div class="share-group"><a class="weixin mobile-hide" href="javascript:void(0)" ref="nofollow" target="_blank"><i class="icon-weixin"></i>
        <div class="panel-weixin">
          <section class="weixin-section">
            <p><img alt="533066" src="http://s.jiathis.com/qrcode.php?url=<?php the_permalink();?>?via=wechat_qr" /></p>
          </section>
          <h3>打开微信“扫一扫”，打开网页后点击屏幕右上角分享按钮</h3>
        </div>
        </a><a class="weibo" href="http://share.baidu.com/s?type=text&amp;searchPic=0&amp;sign=on&amp;to=tsina&amp;url=<?php the_permalink();?>&amp;title=<?php the_title(); ?>" ref="nofollow" target="_blank"><i class="icon-weibo"></i></a></div>
      </span></div>
  </section>
<?php endwhile; wp_reset_query();}?>
