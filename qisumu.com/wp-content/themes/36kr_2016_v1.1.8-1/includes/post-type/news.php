<?php

add_action( 'init', 'create_monkey_news_item' );
function create_monkey_news_item() {
    register_post_type( 'news',
        array(
            'labels' => array(
                'name' => '快讯',
                'singular_name' => '快讯',
                'add_new' => '发布快讯',
                'add_new_item' => '发布新快讯',
                'edit' => '编辑',
                'edit_item' => '编辑快讯',
                'new_item' => '新快讯',
                'view' => '查看',
                'view_item' => '查看快讯',
                'search_items' => '搜索快讯',
                'not_found' => '暂无快讯',
                'not_found_in_trash' => '垃圾箱里暂无快讯',
                'parent' => '父快讯'
            ),
 
            'public' => true,
            'menu_position' => 9,
            'supports' => array( 'title', 'editor', 'comments', 'thumbnail' ),
            //'taxonomies' => array( '' ),
            'menu_icon' => 'dashicons-flag',
            'has_archive' => true
        )
    );
}


add_filter( 'template_include', 'include_monkey_news_item_template', 1 );
function include_monkey_news_item_template( $template_path ) {
    if ( get_post_type() == 'news' ) {
        if ( is_single() ) {
            if ( $theme_file = locate_template( array ( 'single-news.php' ) ) ) {
                $template_path = $theme_file;
            }
        }elseif ( is_archive() ) {
            if ( $theme_file = locate_template( array ( 'archive-news.php' ) ) ) {
                $template_path = $theme_file;
            }
        }
    }
    return $template_path;
}

?>
