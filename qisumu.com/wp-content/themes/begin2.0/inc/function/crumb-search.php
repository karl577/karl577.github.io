<?php 
	$allsearch = new WP_Query("s=$s&showposts=-1");
	$key = esc_html($s, 1);
	$count = $allsearch->post_count;
	_e(''); _e(' ');
	echo $key; _e(' 找到 ');
	echo $count . ' '; _e(' 个与之相关的文章');
	wp_reset_query();
?>