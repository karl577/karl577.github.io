<?php
function get_mu_permalink() {
	global $post;
	return get_blog_permalink( $post->blog_id, $post->ID );
}

function the_mu_permalink() {
	echo get_mu_permalink();
}

function get_mu_blog_permalink() {
	global $post;
	$blog_details = get_blog_details( $post->blog_id );
	return $blog_details->siteurl;
}

function the_mu_blog_permalink() {
	echo get_mu_blog_permalink();
}

function get_blog_name() {
	global $post;
	$blog_details = get_blog_details( $post->blog_id );
	return $blog_details->blogname;
}

function the_blog_name() {
	echo get_blog_name();
}

function STP_getSiteTagCloud($format=null, $tagseparator=null, $sort_order=null, $display_max=null, $display_min=null, $scale_max=null, $scale_min=null, $notagstext=null, $max_color=null, $min_color=null, $max_size=null, $min_size=null, $unit=null, $site_id = null, $include_page = null) {
	global $STagging;
	return $STagging->objMu->createSiteTagCloud($format, $tagseparator, $sort_order, $display_max, $display_min, $scale_max, $scale_min, $notagstext, $max_color, $min_color, $max_size, $min_size, $unit, $site_id, $include_page);	
}

function STP_displaySiteTagCloud($format=null, $tagseparator=null, $sort_order=null, $display_max=null, $display_min=null, $scale_max=null, $scale_min=null, $notagstext=null, $max_color=null, $min_color=null, $max_size=null, $min_size=null, $unit=null, $site_id = null, $include_page = null) {
	echo STP_getSiteTagCloud($format, $tagseparator, $sort_order, $display_max, $display_min, $scale_max, $scale_min, $notagstext, $max_color, $min_color, $max_size, $min_size, $unit, $site_id, $include_page);
}

function STP_MU_GetCurrentTagSet($separator=', ') {
	global $STagging;
	return $STagging->tag_url2name($STagging->objMu->search_tag, $separator);
}
function STP_MU_CurrentTagSet($separator=', ') {
	echo STP_MU_GetCurrentTagSet($separator);
}
?>