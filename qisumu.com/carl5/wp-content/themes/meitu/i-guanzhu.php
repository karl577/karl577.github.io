<?php
/*
Template Name: 我的关注
*/
?>
<?php 
if (is_user_logged_in()) {
	$guanzhu_old = get_the_author_meta('guanzhu',wt_get_user_id());
	if($_GET['uidx']) {
		$userID = get_the_author_meta('ID',$_GET['uidx']);
	    $guanzhu_count_old = get_the_author_meta('guanzhu_count',$userID);
	    if($guanzhu_count_old>0) {
		    $guanzhu_count_new = $guanzhu_count_old-1;
	    } else {
			$guanzhu_count_new = 0;  
	    };
		$guanzhu_array_x = explode(',',$guanzhu_old);
		$str = $_GET['uidx'];
		$len = count( $guanzhu_array_x );
		for( $i=0;$i<$len; $i++) {
			if( $guanzhu_array_x[$i] == $str ) {
				unset( $guanzhu_array_x[$i] );
			}
		};
		$guanzhu_new = implode(',',$guanzhu_array_x);
		array_unique($guanzhu_new);
		update_user_meta(wt_get_user_id(), 'guanzhu', $guanzhu_new);
		wp_update_user( array (
			'ID' => wt_get_user_id(), 
			'guanzhu' => $guanzhu_new,
		) ) ;
		update_user_meta($userID, 'guanzhu_count', $guanzhu_count_new);
		wp_update_user( array (
			'ID' => $userID, 
			'guanzhu_count' => $guanzhu_count_new,
		) ) ;
	};
};
?>
<?php get_header(); ?>
<div class="w968">
	<h1 id="page-title">我的关注</h1>
	<?php if($guanzhu_old) { ?>
	<div id="container">
		<?php
			$guanzhu_array = explode(',',$guanzhu_old);
			array_pop($guanzhu_array);
			foreach($guanzhu_array as $val){
		?>
		<div class="guanzhu-list box">
			<a href="<?php echo get_author_posts_url($val); ?>" class="guanzhu-author">
				<img src="<?php echo touxiang($val); ?>">
				<span><?php echo the_author_meta('display_name',$val); ?></span>
				<em></em>
			</a>
			<a id="guanzhu-btn" class="btn-current" href="javascript:guanzhux2(<?php echo $uid; ?>);">
				<i class="icon-remove-sign"></i> 取消关注
			</a>
			<div class="c"></div>
			<div class="guanzhu-new">
				<?php query_posts('author='.$val.'&showposts=9'); ?>
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<div class="guanzhu-new-img">
					<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><img alt="<?php the_title(); ?>" src="<?php echo img(); ?>"></a>
				</div>
				<?php endwhile; endif; wp_reset_query();  ?>
			</div>
		</div>
		<?php } ?>
	</div>
	<?php } else { ?>
	<div id="tgne" class="col-sm-12">
		<p><i class="glyphicon glyphicon-tint"></i></p>
		<p>您目前没有关注任何人</p>
	</div>
	<?php } ?>
</div>
<script>
							function guanzhux2(uid) {
								$.ajax({
									url: '<?php echo home_url(add_query_arg(array(),$wp->request)); ?>?uidx=' + uid,
									type: 'GET',
									dataType: 'html',
									timeout: 9000,
									error: function() {
										alert('提交失败！');
									},
									success: function(html) {
										window.location.reload(); 
									}
								});
								//return false;
							};
						</script>
<?php get_template_part('list-js'); ?>
<?php get_footer(); ?>