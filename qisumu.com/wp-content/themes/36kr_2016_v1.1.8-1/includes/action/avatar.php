<?php
require( dirname(__FILE__).'/../../../../../wp-load.php' );

if(is_uploaded_file($_FILES['addPic']['tmp_name']) && is_user_logged_in()){
	$picname = $_FILES['addPic']['name'];
	$picsize = $_FILES['addPic']['size'];
	$arrType=array('image/jpg','image/gif','image/png','image/bmp','image/pjpeg',"image/jpeg");
	$userid = wp_get_current_user()->ID;
	if ($picname != "") {
		if ($picsize > 102400) {
			echo "2";
		}
		elseif (!in_array($_FILES['addPic']['type'],$arrType)) {
			echo "3";
		}else{
			$pics = 'avatar-'.$userid.'.jpg';
			//上传路径
			$upfile = '../../../../../wp-content/uploads/avatar/';
			if(!file_exists($upfile)){  mkdir($upfile,0777,true);} 
			$pic_path = '../../../../../wp-content/uploads/avatar/'. $pics;
			if(move_uploaded_file($_FILES['addPic']['tmp_name'], $pic_path)){
				$upload_dir = wp_upload_dir();
				update_user_meta($userid, 'avatar', get_bloginfo('siteurl').'/wp-content/uploads/avatar/'.$pics);
				echo "1";
			}else{
				echo "0";
			}
		}
	}
	
}
?>