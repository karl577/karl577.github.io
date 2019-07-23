<?php 
if (is_user_logged_in()) {
	$guanzhu_old = get_the_author_meta('guanzhu',wt_get_user_id());
	if($_GET['uid']) {
		$userID = get_the_author_meta('ID',$_GET['uid']);
	    $guanzhu_count_old = get_the_author_meta('guanzhu_count',$userID);
	    if($guanzhu_count_old) {
		    $guanzhu_count_new = $guanzhu_count_old+1;
	    } else {
			$guanzhu_count_new = 1;  
	    };
		$guanzhu = $_GET['uid'].','.$guanzhu_old;
		array_unique($guanzhu);
		update_user_meta(wt_get_user_id(), 'guanzhu', $guanzhu);
		wp_update_user( array (
			'ID' => wt_get_user_id(), 
			'guanzhu' => $guanzhu,
		) ) ;
		update_user_meta($userID, 'guanzhu_count', $guanzhu_count_new);
		wp_update_user( array (
			'ID' => $userID, 
			'guanzhu_count' => $guanzhu_count_new,
		) ) ;
	};
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
<?php
	if(isset($_GET['author_name'])) :
	$curauth = get_userdatabylogin($author_name);
	else :
	$curauth = get_userdata(intval($author));
	endif;
?>
<?php if(is_single()) {
	$uid = get_the_author_meta('ID');
} elseif(is_page()) {
	$uid = wt_get_user_id();
} else {
	$uid = $curauth->id;
} ?>
<a id="avatar" href="<?php echo get_author_posts_url($uid); ?>">
			<img src="<?php echo touxiang($uid); ?>">
			<span><?php echo get_the_author_meta('display_name',$uid); ?></span>
			<em></em>
		</a>
		<div id="guanzhu-count" class="side-btn">
			<p>关注</p>
			<p id="guanzhu-count-now"><span id="guanzhu-count-now-span"><?php $guanzhu_count_now = get_the_author_meta('guanzhu_count',$uid); if($guanzhu_count_now) echo $guanzhu_count_now; else echo '0'; ?></span></p>
		</div>
		<div id="like-count" class="side-btn">
			<p>喜欢</p>
			<p><span><?php $xihuan_count_now = get_the_author_meta('xihuan_count',$uid); if($xihuan_count_now) echo $xihuan_count_now; else echo '0'; ?></span></p>
		</div>
		<div id="fav-count" class="side-btn">
			<p>收藏</p>
			<p><span><?php $fav_count_now = get_the_author_meta('fav_count',$uid); if($fav_count_now) echo $fav_count_now; else echo '0'; ?></span></p>
		</div>
		<div class="c"></div>
		<?php if(!is_page()) { ?>
		<?php if (is_user_logged_in()) { ?>
		<?php 
			$guanzhu_array = explode(',',$guanzhu_old);
			if ( in_array($uid,$guanzhu_array) ) {
		?>
		<a id="guanzhu-btn" class="btn-current" href="javascript:guanzhux(<?php echo $uid; ?>);">
			<i class="icon-remove-sign"></i> 取消关注
		</a>
		<?php } else { ?>
		<a id="guanzhu-btn" href="javascript:guanzhu(<?php echo $uid; ?>);">
			<i class="icon-ok-sign"></i> 关注TA
		</a>
		<?php } ?>
		<?php } else { ?>
		<?php if(is_single()) { ?>
		<a id="guanzhu-btn" href="<?php echo get_option('mao10_sign'); ?>?from=<?php the_ID(); ?>">
			<i class="icon-ok-sign"></i> 关注TA
		</a>
		<?php } else { ?>
		<a id="guanzhu-btn" href="<?php echo get_option('mao10_sign'); ?>?froma=<?php echo $uid; ?>">
			<i class="icon-ok-sign"></i> 关注TA
		</a>
		<?php } ?>
		<?php } ?>
		<?php } ?>