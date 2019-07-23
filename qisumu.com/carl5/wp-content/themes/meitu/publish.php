<?php
require('../../../wp-config.php');
if( isset($_POST['tougao_form']) && $_POST['tougao_form'] == 'send')
{
    global $wpdb;
    $last_post = $wpdb->get_var("SELECT post_date FROM $wpdb->posts WHERE post_type = 'post' ORDER BY post_date DESC LIMIT 1");
    
    if ( current_time('timestamp') - strtotime($last_post) < 120 )
    {
        wp_die('您操作也太勤快了吧，先歇会儿！ <a href="'.get_bloginfo('url').'">返回首页</a>');
    }
        
    // 表单变量初始化
    $title =  isset( $_POST['tougao_title'] ) ? trim(htmlspecialchars($_POST['tougao_title'], ENT_QUOTES)) : '';
	$fmimg = isset( $_POST['tougao_fmimg'] ) ? trim($_POST['tougao_fmimg']) : '';
	$tags = isset( $_POST['post_tags'] ) ? $_POST['post_tags'] : '';
    
    if ( empty($title) || mb_strlen($title) > 100 )
    {
        wp_die('标题必须填写，且长度不得超过100字！ <a href="'.get_bloginfo('url').'">返回首页</a>');
    }
    
    $user_id = wt_get_user_id();
  
    $tougao = array(
        'post_title' => $title,
        'post_author' => ''.$user_id.'',
        'post_status' => 'publish',
        'tags_input' => $tags,
        //'post_category' => array($category)
    );


    // 将文章插入数据库
    $status = wp_insert_post( $tougao );
    $url = get_permalink($status);
    if ($status != 0) 
    { 
        add_post_meta($status, 'fmimg_value', $fmimg,TRUE);
        Header("Location:$url");
    }
    else
    {
        wp_die('发布失败！ <a href="'.get_bloginfo('url').'">返回首页</a>');
    }
}
?>