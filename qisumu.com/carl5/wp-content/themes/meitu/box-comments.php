<?php $args = array(
	'callback' => 'cleanr_theme_comment_box_list',
	'per_page' => 3,
	'reverse_top_level' => 1,
);
wp_list_comments($args); ?>