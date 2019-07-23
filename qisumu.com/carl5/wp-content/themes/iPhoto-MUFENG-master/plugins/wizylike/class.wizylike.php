<?php

class wizylike {
	
	private		$ip;
	public		$post_id;
	public		$likes_count;
	
	
	public function __construct($post_id){
		$this->ip = $_SERVER['REMOTE_ADDR'];
		$this->post_id = $post_id;
		$this->likes_count();
	} // end wizylike __construct
	public function likes_count(){
		global $wpdb, $wl_tablename;
		
		// check in the db for likes
		$likes_count = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM $wl_tablename WHERE post_id = %d AND like_status = %s", $this->post_id, 'like'));
		
		// returns likes, return 0 if no likes were found
		$this->likes_count = $likes_count;
		
	} // likes_count
	
	
	public function check_recurring_like(){
		global $wpdb, $wl_tablename;
			// user not logged in, check by ip address
			$likes_check = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM $wl_tablename
											WHERE	post_id = %d
											AND		ip_address = %s
											AND		like_status = %s", $this->post_id, $this->ip, 'like'));
			
			if($likes_check === 0){
				// ip didn't like this post before
				return false;
			} elseif($likes_check >= 1){
				// if liked this post before
				return true;	
			}
	} // end check_recurring_like
	
	
	public function check_recurring_unlike(){
		global $wpdb, $wl_tablename;
			// user not logged in, check by ip address
			$likes_check = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) FROM $wl_tablename
											WHERE	post_id = %d
											AND		ip_address = %s
											AND		like_status = %s", $this->post_id, $this->ip,'unlike'));
			
			if($likes_check === 0){
				// ip didn't un;ike this post before
				return false;
			} elseif($likes_check >= 1){
				// if unliked this post before
				return true;	
			}
	} // end check_recurring_unlike
	
	
	public function like_post(){
		global $wpdb, $wl_tablename;
		
		if(!$this->check_recurring_like() && !$this->check_recurring_unlike()){
			
				$wpdb->insert($wl_tablename, array('post_id' => $this->post_id,
													'ip_address' => $this->ip,
													'like_status' => 'like')
												);
			
		} elseif(!$this->check_recurring_like() && $this->check_recurring_unlike()){
			
				$wpdb->update($wl_tablename, 
								array('like_status' => 'like'),
								array('post_id' => $this->post_id,'ip_address' => $this->ip)
							);
		}
		
	} // end like_post
	
	
	public function unlike_post(){
		global $wpdb, $wl_tablename;
		
		if($this->check_recurring_like()){
				// unlick usign user id = 0 and ip
				$wpdb->update($wl_tablename, 
								array('like_status' => 'unlike'),
								array('post_id' => $this->post_id,'ip_address' => $this->ip)
							);
			$this->likes_count();
		}
	} // end unlike_post
	
	
	public function like_button(){

			if(!$this->check_recurring_like()){
				
				// onclick javascript function for processing. found in wizylike.js in /js folder
				$onclick_like = 'wizylike(' . $this->post_id . ', \'like\');';
				
				// like button
				$button =  '<div class="likes" id="wizylike-post-'.$this->post_id.'">' . "\n";
				$button .= '<span class="wizylike_icon" onclick="'.$onclick_like.'"></span><span class="wizylike_count">'.$this->likes_count.'</span></div>';
				
				
			} elseif($this->check_recurring_like()){
				// onclick javascript function for processing the unlike. found in wizylike.js in /js folder
				$onclick_unlike = 'wizylike(' . $this->post_id . ', \'unlike\')';
			
				// like button
				$button =  '<div class="likes" id="wizylike-post-'.$this->post_id.'">' . "\n";
				$button .= '<span class="wizylike_icon" onclick="'.$onclick_unlike.'"></span><span class="wizylike_count">'.$this->likes_count.'</span></div>';
			
			}
				
		return $button;
	}
	
	public function like_button2(){

			if(!$this->check_recurring_like()){
				
				// onclick javascript function for processing. found in wizylike.js in /js folder
				$onclick_like = 'wizylike(' . $this->post_id . ', \'like\');';
				
				// like button
				$button =  '<div class="likes" id="wizylike-post-'.$this->post_id.'">' . "\n";
				$button .= '<span class="wizylike_icon" onclick="'.$onclick_like.'">喜欢</span><br /><span class="wizylike_count">'.$this->likes_count.'</span></div>';
				
				
			} elseif($this->check_recurring_like()){
				// onclick javascript function for processing the unlike. found in wizylike.js in /js folder
				$onclick_unlike = 'wizylike(' . $this->post_id . ', \'unlike\')';
			
				// like button
				$button =  '<div class="likes" id="wizylike-post-'.$this->post_id.'">' . "\n";
				$button .= '<span class="wizylike_icon" onclick="'.$onclick_unlike.'">喜欢</span><br /><span class="wizylike_count">'.$this->likes_count.'</span></div>';
			
			}
				
		return $button;
	}
	
}

?>