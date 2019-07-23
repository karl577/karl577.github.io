<?php
//带破解热门收费主题，详细请联系QQ:403641198
require get_template_directory() . '/inc/function/widgets.php';
require get_template_directory() . '/inc/function/comment-template.php';
require get_template_directory() . '/inc/function/notify.php';
require get_template_directory() . '/inc/function/addclass.php';
require get_template_directory() . '/inc/function/metabox.php';
require get_template_directory() . '/inc/admin/options-framework.php';
if (is_admin() && $_GET['activated'] == 'true') {
	header("Location: themes.php?page=options-framework");
}
require get_template_directory() . '/inc/function/guide.php';
require get_template_directory() . '/inc/function/post-type.php';
require get_template_directory() . '/inc/function/setting.php';
require get_template_directory() . '/inc/function/lazyclass.php';
require get_template_directory() . '/inc/function/local-avatars.php';
if (zm_get_option('qt')) {
	require get_template_directory() . '/inc/function/qaptcha.php';
}
function button_a($atts, $content = null)
{
	return '<div id="down"><a id="load" title="下载链接" href="#button_file"><i class="icon-down"></i>下载地址</a><div class="clear"></div></div>';
}

add_shortcode('file', 'button_a');
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

add_action('wp_ajax_nopriv_zm_ding', 'zm_ding');
add_action('wp_ajax_zm_ding', 'zm_ding');
function zm_ding()
{
	global $wpdb, $post;
	$id = $_POST["um_id"];
	$action = $_POST["um_action"];
	if ($action == 'ding') {
		$bigfa_raters = get_post_meta($id, 'zm_like', true);
		$expire = time() + 99999999;
		setcookie('zm_like_' . $id, $id, $expire, '/', $domain, false);
		if (!$bigfa_raters || !is_numeric($bigfa_raters)) {
			update_post_meta($id, 'zm_like', 1);
		} else {
			update_post_meta($id, 'zm_like', ($bigfa_raters + 1));
		}
		echo get_post_meta($id, 'zm_like', true);
	}
	die;
}

if (zm_get_option('no') !== 'no'): if (!zm_get_option('gravatar_url') || (zm_get_option('gravatar_url') == 'cn')) {
	add_filter('get_avatar', 'get_cn_avatar');
}
	if (zm_get_option('gravatar_url') == 'duoshuo') {
		add_filter('get_avatar', 'get_duoshuo_avatar');
	}
	if (zm_get_option('gravatar_url') == 'ssl') {
		add_filter('get_avatar', 'get_ssl_avatar');
	}endif;
function clear_zal_cache()
{
	update_option('cx_archives_list', '');
}

add_action('save_post', 'clear_zal_cache');
add_filter('user_contactmethods', 'my_user_contactmethods');
add_filter('esc_html', 'rename_post_formats');
add_action('wp_head', 'head_color');
add_action('wp_head', 'head_css');
add_action('wp_head', 'head_width');
add_shortcode('reply', 'reply_to_read');
add_shortcode('img', 'picture');
add_shortcode('button', 'button_b');
add_action('wp_ajax_nopriv_zm_ding', 'zm_ding');
add_action('wp_ajax_zm_ding', 'zm_ding');
add_shortcode("s", 'show_more');
add_shortcode("p", 'section_content');
add_filter('category_description', 'deletehtml');
add_filter('comment_text', 'cx_images');
add_action('init', 'init_smilies', 5);