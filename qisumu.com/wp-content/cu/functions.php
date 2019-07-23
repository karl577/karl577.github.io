<?php
//theme info
include( 'info.php' );
//谷歌字体
function remove_open_sans() {
    wp_deregister_style( 'open-sans' );
    wp_register_style( 'open-sans', false );
    wp_enqueue_style('open-sans','');
}
add_action( 'init', 'remove_open_sans' );
//注册导航
register_nav_menus(
      array(
       'main' => __( '主菜单导航' )
      )
   );
   
//禁止代码标点转换
remove_filter('the_content', 'wptexturize');

//编辑器增强
 function enable_more_buttons($buttons) {
     $buttons[] = 'hr';
     $buttons[] = 'del';
     $buttons[] = 'sub';
     $buttons[] = 'sup'; 
     $buttons[] = 'fontselect';
     $buttons[] = 'fontsizeselect';
     $buttons[] = 'cleanup';   
     $buttons[] = 'styleselect';
     $buttons[] = 'wp_page';
     $buttons[] = 'anchor';
     $buttons[] = 'backcolor';
     return $buttons;
     }
add_filter("mce_buttons_3", "enable_more_buttons");

//给文章图片自动添加alt和title信息
add_filter('the_content', 'imagesalt');
function imagesalt($content) {
       global $post;
       $pattern ="/<a(.*?)href=('|\")(.*?).(bmp|gif|jpeg|jpg|png)('|\")(.*?)>/i";
       $replacement = '<a$1href=$2$3.$4$5 alt="'.$post->post_title.'" title="'.$post->post_title.'"$6>';
       $content = preg_replace($pattern, $replacement, $content);
       return $content;
}

/*激活友情链接后台*/
add_filter( 'pre_option_link_manager_enabled', '__return_true' );

//文章字数统计
function count_words ($text) {  
global $post;  
if ( '' == $text ) {  
   $text = $post->post_content;  
   if (mb_strlen($output, 'UTF-8') < mb_strlen($text, 'UTF-8')) $output .= '共写了' . mb_strlen(preg_replace('/\s/','',html_entity_decode(strip_tags($post->post_content))),'UTF-8') . '个字';  
   return $output;  
}  
}

//头像问题
function replace_avatar_url($avatar) {
    $avatar = str_replace(array("www.gravatar.com","0.gravatar.com","1.gravatar.com","2.gravatar.com"),"ds-gravatar.qiniudn.com",$avatar);
    return $avatar;
}
add_filter( 'get_avatar', 'replace_avatar_url', 10, 3 );