<?php
// 文章相关自定义栏目
$new_meta_boxes =
array(
	"thumbnail" => array(
		"name" => "thumbnail",
		"std" => "",
		"title" => "缩略图地址（图片比例大于等于280×210px）",
		"type"=>"text"),

	"show" => array(
		"name" => "show",
		"std" => "",
		"title" => "在此输入图片链接地址，则显示在首页幻灯中（图片宽度大于760px，尺寸必须相同）",
		"type"=>"text"),

	"go_url" => array(
		"name" => "show_url",
		"std" => "",
		"title" => "幻灯链接地址",
		"type"=>"text"),

	"description" => array(
		"name" => "description",
		"std" => "",
		"title" => "SEO文章描述（留空，则自动截取首段一定字数作为文章描述）",
		"type"=>"textarea"),

	"keywords" => array(
		"name" => "keywords",
		"std" => "",
		"title" => "SEO文章关键词，多个关键词用半角逗号隔开",
		"type"=>"text"),

	"hot" => array(
		"name" => "hot",
		"std" => "",
		"title" => "添加到“本站推荐”小工具中（有缩略图）",
		"type"=>"checkbox"),

	"posts" => array(
		"name" => "posts",
		"std" => "",
		"title" => "添加到“推荐文章”小工具中（无缩略图）",
		"type"=>"checkbox"),

	"cms_top" => array(
		"name" => "cms_top",
		"std" => "",
		"title" => "首页推荐文章",
		"type"=>"checkbox"),

	"cat_top" => array(
		"name" => "cat_top",
		"std" => "",
		"title" => "分类推荐文章",
		"type"=>"checkbox"),

	"no_sidebar" => array(
		"name" => "no_sidebar",
		"std" => "",
		"title" => "无侧边栏",
		"type"=>"checkbox"),

	"from" => array(
		"name" => "from",
		"std" => "",
		"title" => "文章源自",
		"type"=>"text"),

	"copyright" => array(
		"name" => "copyright",
		"std" => "",
		"title" => "文章原文链接",
		"type"=>"text"),

	"direct" => array(
		"name" => "direct",
		"std" => "",
		"title" => "直达链接",
		"type"=>"text"),

	"button1" => array(
		"name" => "button1",
		"std" => "",
		"title" => "输入下载按钮名称",
		"type"=>"text"),

	"url1" => array(
		"name" => "url1",
		"std" => "",
		"title" => "输入下载链接",
		"type"=>"text"),

	"file_os" => array(
		"name" => "file_os",
		"std" => "",
		"title" => "适用平台（仅用于软件文章形式）",
		"type"=>"text"),

	"file_inf" => array(
		"name" => "file_inf",
		"std" => "",
		"title" => "软件版本（仅用于软件文章形式）",
		"type"=>"text"),
);

// 面板内容
function new_meta_boxes() {
    global $post, $new_meta_boxes;
	//获取保存
    foreach($new_meta_boxes as $meta_box) {
        $meta_box_value = get_post_meta($post->ID, $meta_box['name'].'', true);

        if($meta_box_value != "")
        	//将默认值替换为已保存的值
            $meta_box['std'] = $meta_box_value;

        echo'<input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';

        //选择类型输出不同的html代码
        switch ( $meta_box['type'] ){
            case 'title':
                echo'<h4>'.$meta_box['title'].'</h4>';
                break;
			case 'text':
                echo'<h4>'.$meta_box['title'].'</h4>';
                echo '<span class="form-field"><input type="text" size="40" name="'.$meta_box['name'].'" value="'.$meta_box['std'].'" /></span><br />';
                break;
            case 'textarea':
                echo'<h4>'.$meta_box['title'].'</h4>';
                echo '<textarea cols="60" rows="3" name="'.$meta_box['name'].'">'.$meta_box['std'].'</textarea><br />';
                break;
            case 'radio':
                echo'<h4>'.$meta_box['title'].'</h4>';
                $counter = 1;
                foreach( $meta_box['buttons'] as $radiobutton ) {
                    $checked ="";
                    if(isset($meta_box['std']) && $meta_box['std'] == $counter) {
                        $checked = 'checked = "checked"';
                    }
                    echo '<input '.$checked.' type="radio" class="kcheck" value="'.$counter.'" name="'.$meta_box['name'].'_value"/>'.$radiobutton;
                    $counter++;
                }
				break;
            case 'checkbox':
                if( isset($meta_box['std']) && $meta_box['std'] == 'true' )
                    $checked = 'checked = "checked"';
                else
                    $checked  = '';
                echo '<br /><input type="checkbox" name="'.$meta_box['name'].'" value="true"  '.$checked.' />';
                echo'<label>'.$meta_box['title'].'</label><br />';
				break;
        }
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
	"no_sidebar" => array(
		"name" => "no_sidebar",
		"std" => "",
		"title" => "无侧边栏",
		"type"=>"checkbox"),

	"description" => array(
		"name" => "description",
		"std" => "",
		"title" => "文章描述（留空，则自动截取首段一定字数作为文章描述）",
		"type"=>"textarea"),

	"keywords" => array(
		"name" => "keywords",
		"std" => "",
		"title" => "文章关键词，多个关键词用半角逗号隔开",
		"type"=>"text"),

	"button1" => array(
		"name" => "button1",
		"std" => "",
		"title" => "输入下载按钮名称",
		"type"=>"text"),

	"url1" => array(
		"name" => "url1",
		"std" => "",
		"title" => "输入下载链接",
		"type"=>"text")
);

// 面板内容
function new_meta_page_boxes() {
    global $post, $new_meta_page_boxes;
	//获取保存
    foreach($new_meta_page_boxes as $meta_box) {
        $meta_box_value = get_post_meta($post->ID, $meta_box['name'].'', true);

        if($meta_box_value != "")
        	//将默认值替换为已保存的值
            $meta_box['std'] = $meta_box_value;

        echo'<input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';

        //选择类型输出不同的html代码
        switch ( $meta_box['type'] ){
            case 'title':
                echo'<h4>'.$meta_box['title'].'</h4>';
                break;
			case 'text':
                echo'<h4>'.$meta_box['title'].'</h4>';
                echo '<span class="form-field"><input type="text" size="40" name="'.$meta_box['name'].'" value="'.$meta_box['std'].'" /></span><br />';
                break;
            case 'textarea':
                echo'<h4>'.$meta_box['title'].'</h4>';
                echo '<textarea cols="60" rows="3" name="'.$meta_box['name'].'">'.$meta_box['std'].'</textarea><br />';
                break;
            case 'radio':
                echo'<h4>'.$meta_box['title'].'</h4>';
                $counter = 1;
                foreach( $meta_box['buttons'] as $radiobutton ) {
                    $checked ="";
                    if(isset($meta_box['std']) && $meta_box['std'] == $counter) {
                        $checked = 'checked = "checked"';
                    }
                    echo '<input '.$checked.' type="radio" class="kcheck" value="'.$counter.'" name="'.$meta_box['name'].'_value"/>'.$radiobutton;
                    $counter++;
                }
				break;
            case 'checkbox':
                if( isset($meta_box['std']) && $meta_box['std'] == 'true' )
                    $checked = 'checked = "checked"';
                else
                    $checked  = '';
                echo '<br /><input type="checkbox" name="'.$meta_box['name'].'" value="true"  '.$checked.' />';
                echo'<label>'.$meta_box['title'].'</label><br />';
				break;
        }
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
		"title" => "缩略图地址（图片比例大于等于280×210px）",
		"type"=>"text"),

	"description" => array(
		"name" => "description",
		"std" => "",
		"title" => "文章描述（留空，则自动截取首段一定字数作为文章描述）",
		"type"=>"textarea"),

	"keywords" => array(
		"name" => "keywords",
		"std" => "",
		"title" => "文章关键词，多个关键词用半角逗号隔开",
		"type"=>"text"),

	"no_sidebar" => array(
		"name" => "no_sidebar",
		"std" => "",
		"title" => "无侧边栏",
		"type"=>"checkbox"),

	"button1" => array(
		"name" => "button1",
		"std" => "",
		"title" => "输入下载按钮名称",
		"type"=>"text"),

	"url1" => array(
		"name" => "url1",
		"std" => "",
		"title" => "输入下载链接",
		"type"=>"text"),
);

// 面板内容
function new_meta_picture_boxes() {
    global $post, $new_meta_picture_boxes;
	//获取保存
    foreach($new_meta_picture_boxes as $meta_box) {
        $meta_box_value = get_post_meta($post->ID, $meta_box['name'].'', true);

        if($meta_box_value != "")
        	//将默认值替换为已保存的值
            $meta_box['std'] = $meta_box_value;

        echo'<input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';

        //选择类型输出不同的html代码
        switch ( $meta_box['type'] ){
            case 'title':
                echo'<h4>'.$meta_box['title'].'</h4>';
                break;
			case 'text':
                echo'<h4>'.$meta_box['title'].'</h4>';
                echo '<span class="form-field"><input type="text" size="40" name="'.$meta_box['name'].'" value="'.$meta_box['std'].'" /></span><br />';
                break;
            case 'textarea':
                echo'<h4>'.$meta_box['title'].'</h4>';
                echo '<textarea cols="60" rows="3" name="'.$meta_box['name'].'">'.$meta_box['std'].'</textarea><br />';
                break;
            case 'radio':
                echo'<h4>'.$meta_box['title'].'</h4>';
                $counter = 1;
                foreach( $meta_box['buttons'] as $radiobutton ) {
                    $checked ="";
                    if(isset($meta_box['std']) && $meta_box['std'] == $counter) {
                        $checked = 'checked = "checked"';
                    }
                    echo '<input '.$checked.' type="radio" class="kcheck" value="'.$counter.'" name="'.$meta_box['name'].'_value"/>'.$radiobutton;
                    $counter++;
                }
				break;
            case 'checkbox':
                if( isset($meta_box['std']) && $meta_box['std'] == 'true' )
                    $checked = 'checked = "checked"';
                else
                    $checked  = '';
                echo '<br /><input type="checkbox" name="'.$meta_box['name'].'" value="true"  '.$checked.' />';
                echo'<label>'.$meta_box['title'].'</label><br />';
				break;
        }
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
		"title" => "缩略图地址（图片比例大于等于280×210px）",
		"type"=>"text"),

	"big" => array(
		"name" => "big",
		"std" => "",
		"title" => "输入视频代码",
		"type"=>"text"),

	"description" => array(
		"name" => "description",
		"std" => "",
		"title" => "文章描述（留空，则自动截取首段一定字数作为文章描述）",
		"type"=>"textarea"),

	"keywords" => array(
		"name" => "keywords",
		"std" => "",
		"title" => "文章关键词，多个关键词用半角逗号隔开",
		"type"=>"text"),

	"no_sidebar" => array(
		"name" => "no_sidebar",
		"std" => "",
		"title" => "无侧边栏",
		"type"=>"checkbox"),

	"button1" => array(
		"name" => "button1",
		"std" => "",
		"title" => "输入下载按钮名称",
		"type"=>"text"),

	"url1" => array(
		"name" => "url1",
		"std" => "",
		"title" => "输入下载链接",
		"type"=>"text"),
);

// 面板内容
function new_meta_video_boxes() {
    global $post, $new_meta_video_boxes;
	//获取保存
    foreach($new_meta_video_boxes as $meta_box) {
        $meta_box_value = get_post_meta($post->ID, $meta_box['name'].'', true);

        if($meta_box_value != "")
        	//将默认值替换为已保存的值
            $meta_box['std'] = $meta_box_value;

        echo'<input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';

        //选择类型输出不同的html代码
        switch ( $meta_box['type'] ){
            case 'title':
                echo'<h4>'.$meta_box['title'].'</h4>';
                break;
			case 'text':
                echo'<h4>'.$meta_box['title'].'</h4>';
                echo '<span class="form-field"><input type="text" size="40" name="'.$meta_box['name'].'" value="'.$meta_box['std'].'" /></span><br />';
                break;
            case 'textarea':
                echo'<h4>'.$meta_box['title'].'</h4>';
                echo '<textarea cols="60" rows="3" name="'.$meta_box['name'].'">'.$meta_box['std'].'</textarea><br />';
                break;
            case 'radio':
                echo'<h4>'.$meta_box['title'].'</h4>';
                $counter = 1;
                foreach( $meta_box['buttons'] as $radiobutton ) {
                    $checked ="";
                    if(isset($meta_box['std']) && $meta_box['std'] == $counter) {
                        $checked = 'checked = "checked"';
                    }
                    echo '<input '.$checked.' type="radio" class="kcheck" value="'.$counter.'" name="'.$meta_box['name'].'_value"/>'.$radiobutton;
                    $counter++;
                }
				break;
            case 'checkbox':
                if( isset($meta_box['std']) && $meta_box['std'] == 'true' )
                    $checked = 'checked = "checked"';
                else
                    $checked  = '';
                echo '<br /><input type="checkbox" name="'.$meta_box['name'].'" value="true"  '.$checked.' />';
                echo'<label>'.$meta_box['title'].'</label><br />';
				break;
        }
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
		"title" => "缩略图地址（图片比例大于等于300×300px",
		"type"=>"text"),

	"product" => array(
		"name" => "product",
		"std" => "",
		"title" => "商品描述",
		"type"=>"text"),

	"pricex" => array(
		"name" => "pricex",
		"std" => "",
		"title" => "商品现价",
		"type"=>"text"),

	"pricey" => array(
		"name" => "pricey",
		"std" => "",
		"title" => "商品原价（可选）",
		"type"=>"text"),

	"taourl" => array(
		"name" => "taourl",
		"std" => "",
		"title" => "商品购买链接",
		"type"=>"text"),

	"description" => array(
		"name" => "description",
		"std" => "",
		"title" => "文章描述（留空，则自动截取首段一定字数作为文章描述）",
		"type"=>"textarea"),

	"keywords" => array(
		"name" => "keywords",
		"std" => "",
		"title" => "文章关键词，多个关键词用半角逗号隔开",
		"type"=>"text"),

	"no_sidebar" => array(
		"name" => "no_sidebar",
		"std" => "",
		"title" => "无侧边栏",
		"type"=>"checkbox"),

);

// 面板内容
function new_meta_tao_boxes() {
    global $post, $new_meta_tao_boxes;
	//获取保存
    foreach($new_meta_tao_boxes as $meta_box) {
        $meta_box_value = get_post_meta($post->ID, $meta_box['name'].'', true);

        if($meta_box_value != "")
        	//将默认值替换为已保存的值
            $meta_box['std'] = $meta_box_value;

        echo'<input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';

        //选择类型输出不同的html代码
        switch ( $meta_box['type'] ){
            case 'title':
                echo'<h4>'.$meta_box['title'].'</h4>';
                break;
			case 'text':
                echo'<h4>'.$meta_box['title'].'</h4>';
                echo '<span class="form-field"><input type="text" size="40" name="'.$meta_box['name'].'" value="'.$meta_box['std'].'" /></span><br />';
                break;
            case 'textarea':
                echo'<h4>'.$meta_box['title'].'</h4>';
                echo '<textarea cols="60" rows="3" name="'.$meta_box['name'].'">'.$meta_box['std'].'</textarea><br />';
                break;
            case 'radio':
                echo'<h4>'.$meta_box['title'].'</h4>';
                $counter = 1;
                foreach( $meta_box['buttons'] as $radiobutton ) {
                    $checked ="";
                    if(isset($meta_box['std']) && $meta_box['std'] == $counter) {
                        $checked = 'checked = "checked"';
                    }
                    echo '<input '.$checked.' type="radio" class="kcheck" value="'.$counter.'" name="'.$meta_box['name'].'_value"/>'.$radiobutton;
                    $counter++;
                }
				break;
            case 'checkbox':
                if( isset($meta_box['std']) && $meta_box['std'] == 'true' )
                    $checked = 'checked = "checked"';
                else
                    $checked  = '';
                echo '<br /><input type="checkbox" name="'.$meta_box['name'].'" value="true"  '.$checked.' />';
                echo'<label>'.$meta_box['title'].'</label><br />';
				break;
        }
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