<?php

function wizylike($args, $echo = true, $clear = true){
	global $user_ID;
	
	get_currentuserinfo();
	
	if($user_ID == ''){
		$user_ID = $user_ID = 0;	
	} else {
		$user_ID = $user_ID;	
	}
	
	$wizylike = new wizylike(get_the_ID(), $user_ID);
	$post_meta = get_post_meta(get_the_ID(), 'wizylike', true); 
	$content = '';
	
	if($post_meta != 'disabled'){
		// check first parameter
		switch ($args){
			case 'count':
				$content .= $wizylike->likes_count;
			break;
			
			case 'button':
				$content .= $wizylike->like_button();
			break;
			
			case 'button2':
				$content .= $wizylike->like_button2();
		}
	}
	
	
	// echo or return
	if($echo){
		echo apply_filters('wizylike', $content);	
	} else {
		return apply_filters('wizylike', $content);	
	}
} // end wizylike

?>