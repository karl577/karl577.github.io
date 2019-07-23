<?php
// 文章相关自定义栏目
$new_meta_boxes =
array(
    "thumbnail" => array(
        "name" => "thumbnail",
        "std" => "",
        "title" => "缩略图地址（图片比例:≥280px×210px）:"),

    "show" => array(
        "name" => "show",
        "std" => "",
        "title" => "置顶后显示在幻灯中的图片地址（图片宽度:≥760px 高度：任意，但图片尺寸必须相同）"),

    "go_url" => array(
        "name" => "show_url",
        "std" => "",
        "title" => "幻灯外链地址"),

    "description" => array(
        "name" => "description",
        "std" => "",
        "title" => "文章描述（留空，则自动截取首段一定字数作为文章描述）"),

    "keywords" => array(
        "name" => "keywords",
        "std" => "",
        "title" => "文章关键词，多个关键词用半角逗号隔开"),

    "copyright" => array(
        "name" => "copyright",
        "std" => "",
        "title" => "转载文章原文链接"),

    "hot" => array(
        "name" => "hot",
        "std" => "",
        "title" => "输入 hot，设置为侧边栏推荐文章"),

    "button1" => array(
        "name" => "button1",
        "std" => "",
        "title" => "输入下载按钮名称"),

    "url1" => array(
        "name" => "url1",
        "std" => "",
        "title" => "输入下载链接"),

    "file_os" => array(
        "name" => "file_os",
        "std" => "",
        "title" => "适用平台（仅用于软件文章形式）"),

    "file_inf" => array(
        "name" => "file_inf",
        "std" => "",
        "title" => "软件版本（仅用于软件文章形式）")
);

// 面板内容
function new_meta_boxes() {
    global $post, $new_meta_boxes;

    foreach($new_meta_boxes as $meta_box) {
        $meta_box_value = get_post_meta($post->ID, $meta_box['name'].'', true);

        if($meta_box_value == "")
            $meta_box_value = $meta_box['std'];

        echo'<input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';

        // 自定义字段标题
        echo'<h4>'.$meta_box['title'].'</h4>';

        // 自定义字段输入框
        echo '<span class="form-field"><input type="text" size="60" value="'.$meta_box_value.'" name="'.$meta_box['name'].'"></input></span>';
    }
}

// 创建面板
function create_meta_box() {
    global $theme_name;

    if ( function_exists('add_meta_box') ) {
        add_meta_box( 'new-meta-boxes', '文章设置', 'new_meta_boxes', 'post', 'normal', 'high' );
    }
}

// 保存数据
function save_postdata( $post_id ) {
    global $post, $new_meta_boxes;

    foreach($new_meta_boxes as $meta_box) {
        if ( !wp_verify_nonce( $_POST[$meta_box['name'].'_noncename'], plugin_basename(__FILE__) ))  {
            return $post_id;
        }

        if ( 'page' == $_POST['post_type'] ) {
            if ( !current_user_can( 'edit_page', $post_id ))
                return $post_id;
        }
        else {
            if ( !current_user_can( 'edit_post', $post_id ))
                return $post_id;
        }

        $data = $_POST[$meta_box['name'].''];

        if(get_post_meta($post_id, $meta_box['name'].'') == "")
            add_post_meta($post_id, $meta_box['name'].'', $data, true);
        elseif($data != get_post_meta($post_id, $meta_box['name'].'', true))
            update_post_meta($post_id, $meta_box['name'].'', $data);
        elseif($data == "")
            delete_post_meta($post_id, $meta_box['name'].'', get_post_meta($post_id, $meta_box['name'].'', true));
    }
}

// 触发
add_action('admin_menu', 'create_meta_box');
add_action('save_post', 'save_postdata'); 


// 页面相关自定义栏目
$new_meta_page_boxes =
array(
    "description" => array(
        "name" => "description",
        "std" => "",
        "title" => "页面描述"),

    "keywords" => array(
        "name" => "keywords",
        "std" => "",
        "title" => "页面关键词"),

    "button1" => array(
        "name" => "button1",
        "std" => "",
        "title" => "输入下载按钮名称"),

    "url1" => array(
        "name" => "url1",
        "std" => "",
        "title" => "输入下载链接")
);

function new_meta_page_boxes() {
    global $post, $new_meta_page_boxes;

    foreach($new_meta_page_boxes as $meta_box) {
        $meta_box_value = get_post_meta($post->ID, $meta_box['name'].'', true);

        if($meta_box_value == "")
            $meta_box_value = $meta_box['std'];

        echo'<input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';

        echo'<h4>'.$meta_box['title'].'</h4>';

        echo '<span class="form-field"><input type="text" size="60" value="'.$meta_box_value.'" name="'.$meta_box['name'].'"></input></span>';
    }
}

function create_meta_page_box() {
    global $theme_name;

    if ( function_exists('add_meta_box') ) {
        add_meta_box( 'new-meta-boxes', '页面设置', 'new_meta_page_boxes', 'page', 'normal', 'high' );
    }
}

function save_page_postdata( $post_id ) {
    global $post, $new_meta_page_boxes;

    foreach($new_meta_page_boxes as $meta_box) {
        if ( !wp_verify_nonce( $_POST[$meta_box['name'].'_noncename'], plugin_basename(__FILE__) ))  {
            return $post_id;
        }

        if ( 'page' == $_POST['post_type'] ) {
            if ( !current_user_can( 'edit_page', $post_id ))
                return $post_id;
        }
        else {
            if ( !current_user_can( 'edit_post', $post_id ))
                return $post_id;
        }

        $data = $_POST[$meta_box['name'].''];

        if(get_post_meta($post_id, $meta_box['name'].'') == "")
            add_post_meta($post_id, $meta_box['name'].'', $data, true);
        elseif($data != get_post_meta($post_id, $meta_box['name'].'', true))
            update_post_meta($post_id, $meta_box['name'].'', $data);
        elseif($data == "")
            delete_post_meta($post_id, $meta_box['name'].'', get_post_meta($post_id, $meta_box['name'].'', true));
    }
}

add_action('admin_menu', 'create_meta_page_box');
add_action('save_post', 'save_page_postdata'); 

// 图片日志
$new_meta_picture_boxes =
array(
    "thumbnail" => array(
        "name" => "thumbnail",
        "std" => "",
        "title" => "缩略图地址（图片比例::≥280px×210px）")

);

function new_meta_picture_boxes() {
    global $post, $new_meta_picture_boxes;

    foreach($new_meta_picture_boxes as $meta_box) {
        $meta_box_value = get_post_meta($post->ID, $meta_box['name'].'', true);

        if($meta_box_value == "")
            $meta_box_value = $meta_box['std'];

        echo'<input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';

        echo'<h4>'.$meta_box['title'].'</h4>';

        echo '<span class="form-field"><input type="text" size="60" value="'.$meta_box_value.'" name="'.$meta_box['name'].'"></input></span>';
    }
}

function create_meta_picture_box() {
    global $theme_name;

    if ( function_exists('add_meta_box') ) {
        add_meta_box( 'new-meta-boxes', '图片设置', 'new_meta_picture_boxes', 'picture', 'normal', 'high' );
    }
}

function save_picture_postdata( $post_id ) {
    global $post, $new_meta_picture_boxes;

    foreach($new_meta_picture_boxes as $meta_box) {
        if ( !wp_verify_nonce( $_POST[$meta_box['name'].'_noncename'], plugin_basename(__FILE__) ))  {
            return $post_id;
        }

        if ( 'page' == $_POST['post_type'] ) {
            if ( !current_user_can( 'edit_page', $post_id ))
                return $post_id;
        }
        else {
            if ( !current_user_can( 'edit_post', $post_id ))
                return $post_id;
        }

        $data = $_POST[$meta_box['name'].''];

        if(get_post_meta($post_id, $meta_box['name'].'') == "")
            add_post_meta($post_id, $meta_box['name'].'', $data, true);
        elseif($data != get_post_meta($post_id, $meta_box['name'].'', true))
            update_post_meta($post_id, $meta_box['name'].'', $data);
        elseif($data == "")
            delete_post_meta($post_id, $meta_box['name'].'', get_post_meta($post_id, $meta_box['name'].'', true));
    }
}

add_action('admin_menu', 'create_meta_picture_box');
add_action('save_post', 'save_picture_postdata'); 

// 视频日志
$new_meta_video_boxes =
array(
    "small" => array(
        "name" => "small",
        "std" => "",
        "title" => "缩略图地址（图片比例::≥280px×210px）"),
    "big" => array(
        "name" => "big",
        "std" => "",
        "title" => "输入视频代码")
);

function new_meta_video_boxes() {
    global $post, $new_meta_video_boxes;

    foreach($new_meta_video_boxes as $meta_box) {
        $meta_box_value = get_post_meta($post->ID, $meta_box['name'].'', true);

        if($meta_box_value == "")
            $meta_box_value = $meta_box['std'];

        echo'<input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';

        echo'<h4>'.$meta_box['title'].'</h4>';

        echo '<span class="form-field"><input type="text" size="60" value="'.$meta_box_value.'" name="'.$meta_box['name'].'"></input></span>';
    }
}

function create_meta_video_box() {
    global $theme_name;

    if ( function_exists('add_meta_box') ) {
        add_meta_box( 'new-meta-boxes', '视频设置', 'new_meta_video_boxes', 'video', 'normal', 'high' );
    }
}

function save_video_postdata( $post_id ) {
    global $post, $new_meta_video_boxes;

    foreach($new_meta_video_boxes as $meta_box) {
        if ( !wp_verify_nonce( $_POST[$meta_box['name'].'_noncename'], plugin_basename(__FILE__) ))  {
            return $post_id;
        }

        if ( 'page' == $_POST['post_type'] ) {
            if ( !current_user_can( 'edit_page', $post_id ))
                return $post_id;
        }
        else {
            if ( !current_user_can( 'edit_post', $post_id ))
                return $post_id;
        }

        $data = $_POST[$meta_box['name'].''];

        if(get_post_meta($post_id, $meta_box['name'].'') == "")
            add_post_meta($post_id, $meta_box['name'].'', $data, true);
        elseif($data != get_post_meta($post_id, $meta_box['name'].'', true))
            update_post_meta($post_id, $meta_box['name'].'', $data);
        elseif($data == "")
            delete_post_meta($post_id, $meta_box['name'].'', get_post_meta($post_id, $meta_box['name'].'', true));
    }
}

add_action('admin_menu', 'create_meta_video_box');
add_action('save_post', 'save_video_postdata'); 

// 淘客
$new_meta_tao_boxes =
array(
    "thumbnail" => array(
        "name" => "thumbnail",
        "std" => "",
        "title" => "缩略图地址（图片比例:≥400px×400px）"),

    "product" => array(
        "name" => "product",
        "std" => "",
        "title" => "商品描述:"),

    "pricex" => array(
        "name" => "pricex",
        "std" => "",
        "title" => "商品现价:"),

    "pricey" => array(
        "name" => "pricey",
        "std" => "",
        "title" => "商品原价（可选）:"),

    "taourl" => array(
        "name" => "taourl",
        "std" => "",
        "title" => "商品购买链接")

);

function new_meta_tao_boxes() {
    global $post, $new_meta_tao_boxes;

    foreach($new_meta_tao_boxes as $meta_box) {
        $meta_box_value = get_post_meta($post->ID, $meta_box['name'].'', true);

        if($meta_box_value == "")
            $meta_box_value = $meta_box['std'];

        echo'<input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';

        echo'<h4>'.$meta_box['title'].'</h4>';

        echo '<span class="form-field"><input type="text" size="60" value="'.$meta_box_value.'" name="'.$meta_box['name'].'"></input></span>';
    }
}

function create_meta_tao_box() {
    global $theme_name;

    if ( function_exists('add_meta_box') ) {
        add_meta_box( 'new-meta-boxes', '商品设置', 'new_meta_tao_boxes', 'tao', 'normal', 'high' );
    }
}

function save_tao_postdata( $post_id ) {
    global $post, $new_meta_tao_boxes;

    foreach($new_meta_tao_boxes as $meta_box) {
        if ( !wp_verify_nonce( $_POST[$meta_box['name'].'_noncename'], plugin_basename(__FILE__) ))  {
            return $post_id;
        }

        if ( 'page' == $_POST['post_type'] ) {
            if ( !current_user_can( 'edit_page', $post_id ))
                return $post_id;
        }
        else {
            if ( !current_user_can( 'edit_post', $post_id ))
                return $post_id;
        }

        $data = $_POST[$meta_box['name'].''];

        if(get_post_meta($post_id, $meta_box['name'].'') == "")
            add_post_meta($post_id, $meta_box['name'].'', $data, true);
        elseif($data != get_post_meta($post_id, $meta_box['name'].'', true))
            update_post_meta($post_id, $meta_box['name'].'', $data);
        elseif($data == "")
            delete_post_meta($post_id, $meta_box['name'].'', get_post_meta($post_id, $meta_box['name'].'', true));
    }
}

add_action('admin_menu', 'create_meta_tao_box');
add_action('save_post', 'save_tao_postdata'); 

?>