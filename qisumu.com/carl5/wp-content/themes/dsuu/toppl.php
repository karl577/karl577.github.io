<?php
/**
Template Name: 本月评论榜
url : /toppl/
*/
get_header();
?>
<div id="content">
<div class="atop">
<div class="inavt clr"><div class="l"><ul><li><u>热门排行榜:</u></li><li><a href="/top/">月浏览榜</a></li><li><a href="/toppl/">月热评榜</a></li><li><a href="/hot/">总浏览榜</a></li><li><a href="/hotpl/">总热评榜</a></li><li><a href="/comment/">最新评论</a></li></ul></div><div class="r"><?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?></div></div>
<div class="ibdfx">广告位</div>
<div id="container" class="clr">
<?php $postcnt = 1; ?>
<?php if ( have_posts() ) : ?>
<?php
function filter_where( $where = '' ) {
	$where .= " AND post_date > '" . date('Y-m-d', strtotime('-30 days')) . "'";
	return $where;
}
add_filter( 'posts_where', 'filter_where' );
query_posts($query_string);
 
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args = array(
'orderby' => comment_count,
'paged' => $paged,
'order' => DESC
);
query_posts($args);
while ( have_posts() ) : the_post(); ?>
<?php get_template_part( 'sy', get_post_format() ); ?>
<?php endwhile; ?>
<?php else : ?>
<p>找不到你要找的内容</p>
<?php endif; ?>
</div>
<div id="navigation" class="navigation clr"><?php pagenavi(); ?></div>
</div>
</div>
<?php wp_reset_query(); ?>
<?php get_footer(); ?>