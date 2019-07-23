<?php if (zm_get_option('wp_title')) { ?>
<?php if ( is_home() ) { ?><title><?php bloginfo('name'); ?> <?php echo zm_get_option('connector')?> <?php bloginfo('description'); ?></title><?php } ?>
<?php if ( is_search() ) { ?><title>搜索结果 <?php echo zm_get_option('connector')?> <?php bloginfo('name'); ?></title><?php } ?>
<?php if ( is_single() ) { ?><title><?php echo trim(wp_title('',0)); ?><?php if (get_query_var('page')) { echo '-第'; echo get_query_var('page'); echo '页';}?> <?php echo zm_get_option('connector')?> <?php bloginfo('name'); ?></title><?php } ?>
<?php if ( is_page() ) { ?><title><?php echo trim(wp_title('',0)); ?> <?php echo zm_get_option('connector')?> <?php bloginfo('name'); ?></title><?php } ?>
<?php if ( is_category() ) { ?><title><?php single_cat_title(); ?> <?php echo zm_get_option('connector')?> <?php bloginfo('name'); ?></title><?php } ?>
<?php if ( is_year() ) { ?><title><?php the_time('Y年'); ?>所有文章 <?php echo zm_get_option('connector')?> <?php bloginfo('name'); ?></title><?php } ?>
<?php if ( is_month() ) { ?><title><?php the_time('F'); ?>份所有文章 <?php echo zm_get_option('connector')?> <?php bloginfo('name'); ?></title><?php } ?>
<?php if ( is_day() ) { ?><title><?php the_time('Y年n月j日'); ?>所有文章 <?php echo zm_get_option('connector')?> <?php bloginfo('name'); ?></title><?php } ?>
<?php if ( is_author() ) { ?><title><?php wp_title( ''); ?>发表的所有文章 <?php echo zm_get_option('connector')?> <?php bloginfo('name'); ?></title><?php } ?>
<?php if ( is_404() ) { ?><title><?php echo stripslashes( zm_get_option('404_t') ); ?><?php echo zm_get_option('connector')?> <?php bloginfo('name'); ?></title><?php } ?>
<?php if (function_exists('is_tag')) { if ( is_tag() ) { ?><title><?php  single_tag_title("", true); ?> <?php echo zm_get_option('connector')?> <?php bloginfo('name'); ?></title><?php } ?><?php } ?>
<?php if ( ! is_single() && ! is_home() && ! is_category() && ! is_search() ) { ?>
<?php if ( has_post_format( 'aside' ) ) { ?><title><?php echo get_post_format_string( 'aside' ); ?> <?php echo zm_get_option('connector')?> <?php bloginfo('name'); ?></title><?php } ?>
<?php if ( has_post_format( 'image' ) ) { ?><title><?php echo get_post_format_string( 'image' ); ?> <?php echo zm_get_option('connector')?> <?php bloginfo('name'); ?></title><?php } ?>
<?php } ?>
<?php if ( is_tax('notice') ) { ?><title><?php setTitle(); ?> <?php echo zm_get_option('connector')?> <?php bloginfo('name'); ?></title><?php } ?>
<?php if ( is_tax('gallery') ) { ?><title><?php setTitle(); ?> <?php echo zm_get_option('connector')?> <?php bloginfo('name'); ?></title><?php } ?>
<?php if ( is_tax('videos') ) { ?><title><?php setTitle(); ?> <?php echo zm_get_option('connector')?> <?php bloginfo('name'); ?></title><?php } ?>
<?php if ( is_tax('taobao') ) { ?><title><?php setTitle(); ?> <?php echo zm_get_option('connector')?> <?php bloginfo('name'); ?></title><?php } ?>
<?php if( is_single() || is_page() ) {
    if( function_exists('get_query_var') ) {
        $cpage = intval(get_query_var('cpage'));
        $commentPage = intval(get_query_var('comment-page'));
    }
    if( !empty($cpage) || !empty($commentPage) ) {
        echo '<meta name="robots" content="noindex, nofollow" />';
        echo "\n";
    }
}
?>
<?php
if (!function_exists('utf8Substr')) {
 function utf8Substr($str, $from, $len)
 {
     return preg_replace('#^(?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$from.'}'.
          '((?:[\x00-\x7F]|[\xC0-\xFF][\x80-\xBF]+){0,'.$len.'}).*#s',
          '$1',$str);
 }
}
if ( is_single() ){
    if ($post->post_excerpt) {
        $description  = $post->post_excerpt;
    } else {
   if(preg_match('/<p>(.*)<\/p>/iU',trim(strip_tags($post->post_content,"<p>")),$result)){
    $post_content = $result['1'];
   } else {
    $post_content_r = explode("\n",trim(strip_tags($post->post_content)));
    $post_content = $post_content_r['0'];
   }
         $description = utf8Substr($post_content,0,220);
  } 
    $keywords = "";
    $tags = wp_get_post_tags($post->ID);
    foreach ($tags as $tag ) {
        $keywords = $keywords . $tag->name . ",";
    }
}
?>
<?php echo "\n"; ?>
<?php if ( is_single() ) { ?>
<?php if ( get_post_meta($post->ID, 'description', true) ) : ?>
<meta name="description" content="<?php $description = get_post_meta($post->ID, 'description', true);{echo $description;}?>" />
<meta name="keywords" content="<?php $keywords = get_post_meta($post->ID, 'keywords', true);{echo $keywords;}?>" />
<?php else: ?>
<meta name="description" content="<?php echo trim($description); ?>" />
<meta name="keywords" content="<?php echo trim($keywords,','); ?>" />
<?php endif; ?>
<?php } ?>
<?php if ( is_page() ) { ?>
<meta name="description" content="<?php $description = get_post_meta($post->ID, 'description', true);{echo $description;}?>" />
<meta name="keywords" content="<?php $keywords = get_post_meta($post->ID, 'keywords', true);{echo $keywords;}?>" />
<?php } ?>
<?php if ( is_category() ) { ?>
<meta name="description" content="<?php echo category_description( $categoryID ); ?>" />
<?php } ?>
<?php if ( is_tag() ) { ?>
<meta name="description" content="<?php echo single_tag_title(); ?>" />
<?php } ?>
<?php if ( is_home() ) { ?>
<meta name="description" content="<?php echo zm_get_option('description'); ?>" />
<meta name="keywords" content="<?php echo zm_get_option('keyword'); ?>" />
<?php } ?>
<?php } else { ?>
<title><?php wp_title( '|', true, 'right' ); ?></title>
<?php } ?>