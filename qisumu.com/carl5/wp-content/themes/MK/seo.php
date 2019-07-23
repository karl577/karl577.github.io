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
    }else{
        if(preg_match('/<p>(.*)<\/p>/iU',trim(strip_tags($post->post_content,"<p>")),$result)){
        $post_content = $result['1'];
   }else{
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
else{   
    $description = "关注网站技术，一个特立独行的程序员，我是明凯，这里是我的个人博客，享受编程的乐趣，面朝大海，春暖花开。";   
    $keywords = "asp,css,js,sql,web,wordpress,明凯,网站技术,编程,程序员,站长,数据库,个人博客,明凯博客,前端设计,后台开发";   
} 
?>
<?php echo "\n"; ?>
<meta name="description" content="<?php echo trim($description); ?>" />
<meta name="keywords" content="<?php echo rtrim($keywords,','); ?>" />
<meta name="robots" content="all"> 
<meta name="author" content="明凯"> 
<meta name="copyright" content="www.aimks.com">