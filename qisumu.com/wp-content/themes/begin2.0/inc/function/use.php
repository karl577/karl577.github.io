<?php

add_action('media_buttons', 'begin_select', 11);
add_action('admin_notices', 'showadminmessages');
add_action('admin_head', 'begin_button_js');
add_action('save_post', 'clear_archives_cache');
add_filter('user_contactmethods', 'zm_user_contact');
add_filter('esc_html', 'zm_post_formats');
add_action('wp_head', 'head_color');
add_action('wp_head', 'head_css');

require get_template_directory() . '/inc/function/widget.php';
require get_template_directory() . '/inc/function/comment-template.php';
require get_template_directory() . '/inc/function/custom-field.php';
require get_template_directory() . '/inc/function/notify.php';
require get_template_directory() . '/inc/function/meta-boxes.php';
require get_template_directory() . '/inc/options/options-framework.php';
if (is_admin() && $_GET['activated'] == 'true') {
	header("Location: themes.php?page=options-framework");
}
require get_template_directory() . '/inc/function/guide.php';
require get_template_directory() . '/inc/function/post-type.php';
require get_template_directory() . '/inc/function/default.php';
require get_template_directory() . '/inc/function/the-thumbnail.php';
require get_template_directory() . '/inc/function/addclass.php';
require get_template_directory() . '/inc/function/lazy-avatars.php';
if (zm_get_option('smart_ideo')) {
	require get_template_directory() . '/inc/function/smartideo.php';
}
if (zm_get_option('qt')) {
	require get_template_directory() . '/inc/function/qaptcha.php';
}
if (zm_get_option('auto_tags')) {
	add_action('save_post', 'auto_add_tags');
}
if (zm_get_option('page_html')) {
	add_action('init', 'html_page_permalink', -1);
}
if (zm_get_option('no_admin')) {
	add_action('admin_init', 'redirect_non_admin_users');
}
if (zm_get_option('scroll')) {
	add_action('wp_footer', 'ajax_scroll_js', 100);
}
if (zm_get_option('comment_scroll')) {
	add_action('wp_footer', 'ajax_c_scroll_js', 100);
}
function begin_title()
{
	get_template_part('inc/function/seo');
}
function type_breadcrumb()
{
	get_template_part('/inc/function/type-breadcrumb');
}
function setTitle()
{
	$term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
	echo $title = $term->name;
}
function zm_category()
{
	$category = get_the_category();
	if ($category[0]) {
		echo '<a href="' . get_category_link($category[0]->term_id) . '">' . $category[0]->cat_name . '</a>';
	}
}

if (zm_get_option('check_admin')) {
	if (!is_user_logged_in()) {
		add_filter('preprocess_comment', 'usercheck');
	}
}
add_action('wp_head', 'zm_width');
add_shortcode('reply', 'reply_read');
add_shortcode('password', 'secret');
add_shortcode('img', 'gallery');
add_shortcode('file', 'button_a');
add_shortcode('button', 'button_b');
add_shortcode('url', 'button_url');
add_shortcode('videos', 'my_videos');
add_action('wp_ajax_nopriv_zm_ding', 'begin_ding');
add_action('wp_ajax_zm_ding', 'begin_ding');
add_shortcode('s', 'show_more');
add_shortcode("p", 'section_content');
add_filter('category_description', 'deletehtml');
add_filter('comment_text', 'message_img');
add_action('init', 'begin_smilies', 5);