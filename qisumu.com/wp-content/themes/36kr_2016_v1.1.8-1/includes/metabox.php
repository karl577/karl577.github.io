<?php

$postmeta_froms = array(
    "推荐" => array(
        "name" => "recommend",
        "std" => "",
		"type" => "checkbox",
        "title" => "推荐："
	)
);

function mobantu_postmeta_from() {
    global $post, $postmeta_froms;
    foreach($postmeta_froms as $meta_box) {
        $meta_box_value = get_post_meta($post->ID, $meta_box['name'], true);
        /*if($meta_box_value == "")
            $meta_box_value = $meta_box['std'];*/
        echo'<p>'.$meta_box['title'];
		if($meta_box['type'] == 'checkbox'){
			echo '<input type="checkbox" name="'.$meta_box['name'].'" value="1" '.($meta_box_value=='1'?'checked':'').'> ';
		}elseif($meta_box['type'] == 'text'){
        	echo '<input type="text" style="width:80%" value="'.$meta_box_value.'" name="'.$meta_box['name'].'"></p>';
		}
    }
   
    echo '<input type="hidden" name="post_newmetaboxes_noncename" id="post_newmetaboxes_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';
}

function mobantu_create_meta_box() {
    global $theme_name;
    if ( function_exists('add_meta_box') ) {
        add_meta_box( 'new-meta-boxes', '文章属性', 'mobantu_postmeta_from', 'post', 'side', 'high' );
    }
}

function mobantu_save_postdata( $post_id ) {
    global $postmeta_froms;
   
    if ( !wp_verify_nonce( $_POST['post_newmetaboxes_noncename'], plugin_basename(__FILE__) ))
        return;
   
    if ( !current_user_can( 'edit_posts', $post_id ))
        return;
                   
    foreach($postmeta_froms as $meta_box) {
        $data = $_POST[$meta_box['name']];
        if(get_post_meta($post_id, $meta_box['name']) == "")
            add_post_meta($post_id, $meta_box['name'], $data, true);
        elseif($data != get_post_meta($post_id, $meta_box['name'], true))
            update_post_meta($post_id, $meta_box['name'], $data);
        elseif($data == "")
            delete_post_meta($post_id, $meta_box['name'], get_post_meta($post_id, $meta_box['name'], true));
    }
}

add_action('admin_menu', 'mobantu_create_meta_box');
add_action('save_post', 'mobantu_save_postdata');

?>