<?php

require_once(dirname(__FILE__) . '/../../../wp-load.php');		// includes wordpress loads for using wordpress vars
require_once(dirname(__FILE__) . '/class.wizylike.php');		// includes wizylike class to process likes and unlikes


$wizylike = new wizylike($_POST['post_id'], $_POST['user_id']);	// new wizylike class
$post_id = $_POST['post_id'];									// gets post id
$user_id = $_POST['user_id'];									// gets user id
$like = $_POST['like'];											// gets like type (returns like or unlike)
$button_txt = '';
$button_onclick = '';


// process likes & unlikes
if($like === 'like' && preg_match('/^([0-9]+)$/', $post_id . $user_id)){
	
	$wizylike->like_post();
	$button_txt = $wizylike->unlike_txt;
	$button_onclick = 'wizylike(' . $post_id . ', ' . $user_id . ', \'unlike\')';
	
} elseif($like === 'unlike' && preg_match('/^([0-9]+)$/', $post_id . $user_id)){
	
	$wizylike->unlike_post();
	$button_txt = $wizylike->like_txt;
	$button_onclick = 'wizylike(' . $post_id . ', ' . $user_id . ', \'like\')';
	
}

// count likes
$wizylike->likes_count();

$result =  $wizylike->likes_count;

update_post_meta($post_id, 'likes', $result);

// echos the result
echo $result;

?>