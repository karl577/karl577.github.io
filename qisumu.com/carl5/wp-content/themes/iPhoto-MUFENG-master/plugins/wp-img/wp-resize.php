<?php

function resizeimg($id, $img, $sn=0, $newwidth=null, $cut=0, $newheight=null){
	$newfile = "wp-content/uploads/thumbnail/".$id.$newwidth.$sn.".jpg";
		$imgsize = getimagesize($img);
		$filename = basename($img);
		$cut_width = 0;
		$cut_height = 0;
		if($imgsize[2]==2) $im = imagecreatefromjpeg($img);
		if($imgsize[2]==1) $im = imagecreatefromgif($img);
		if($imgsize[2]==3) $im = imagecreatefrompng($img);
		$tmp_width = 0;
		$tmp_height = 0;
		if($cut){
			if($imgsize[0]>$imgsize[1]){
				$tmp_width = intval( ($imgsize[0]/$imgsize[1]) * $newheight);
				$tmp_height = $newheight;
				$cut_width = ($newwidth - $tmp_width)/2;
			}else{
				$tmp_height = intval( ($imgsize[1]/$imgsize[0]) * $newwidth);
				$tmp_width = $newwidth;	
				$cut_height = ($newheight - $tmp_height)/2;
			}
			$newimg = imagecreatetruecolor($newwidth,$newheight);
			imagecopyresampled($newimg, $im, $cut_width, $cut_height, 0, 0, $tmp_width, $tmp_height, $imgsize[0], $imgsize[1]);
		}else{
			$newheight = ($imgsize[1]/$imgsize[0]) * $newwidth;
			$newimg = imagecreatetruecolor($newwidth,$newheight);
			imagecopyresampled($newimg, $im, 0, 0, 0, 0, $newwidth, $newheight, $imgsize[0], $imgsize[1]);
		}
		ImageJpeg ($newimg,$newfile,100);
		ImageDestroy ($im); 
		$args = array(
			"src" => get_bloginfo('wpurl').'/'.$newfile,
			"width" => $newwidth,
			"height" => (int) $newheight
		);
		return $args;
}
function wim_exist($id, $w, $sn){
	global $wpdb, $wim;
	$results = $wpdb->get_results("SELECT height FROM  $wim  WHERE mid = '$id' AND width = '$w' AND sn = '$sn' ");
	foreach ($results as $result) {
		$h = $result->height;
	}
	return $h;
}

function wim_delete($id, $w, $sn){
	global $wpdb, $wim;
	$wpdb->query("DELETE FROM $wim WHERE $wim  WHERE mid = '$id' AND width = '$w' AND sn = '$sn' ");
}

function wim_insert($id, $sn, $w, $h){
	global $wpdb, $wim;
	$wpdb->query("INSERT INTO $wim VALUES ('', '$id', '$sn', '$w', '$h')");
}
?>