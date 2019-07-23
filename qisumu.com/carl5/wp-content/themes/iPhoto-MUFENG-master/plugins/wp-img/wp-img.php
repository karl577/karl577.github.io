<?php
/*
Plugin Name: WP-Img
Plugin URI: http://mufeng.me
Description: Wordpress thumbnail plugin. Wordpress缩略图插件.
Version: 1.0.0
Author: mufeng
Author URI: http://mufeng.me
*/

defined('ABSPATH') or die('This file can not be loaded directly.');
define('WL_PATH', dirname(__FILE__));
global $wpdb, $wim;
$table_prefix = (isset($table_prefix)) ? $table_prefix : $wpdb->prefix;
$wim = $table_prefix . 'wim';


$wim_thumb_path = ABSPATH . "wp-content/uploads/thumbnail/";
if (file_exists ($wim_thumb_path)) {
    if (! is_writeable ( $wim_thumb_path )) {
        chmod ( $wim_thumb_path, '511' );
    }
} else {
    mkdir ( $wim_thumb_path, '511', true );
}

include_once ("wp-resize.php");

/* 启用插件 */
function wim_activate() {
 global $wpdb, $wim;
// 建立数据库
 if ($wpdb->get_var("show tables like '$wim'") != $wim) {
  $wpdb->query("CREATE TABLE ". $wim ." (
  id       BIGINT(20) NOT NULL AUTO_INCREMENT,
  mid  BIGINT(20) NOT NULL,
  sn       int(8)  NOT NULL,
  width    int(8)  NOT NULL,
  height   int(8)  NOT NULL,
  UNIQUE KEY id (id)
  ) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1");
 }
}
register_activation_hook(__FILE__, 'wim_activate');

/* 停用插件 */
function wim_deactivate() {
 global $wpdb, $wim;
 $wpdb->query("DROP TABLE IF EXISTS $wim");
}
register_deactivation_hook(__FILE__, 'wim_deactivate');

// 首页缩略图
function wim_index($id){
	$img = get_bloginfo('wpurl').'/wp-content/uploads/thumbnail/'.$id.'2550.jpg';
	$sn = 0;
	$src_h = wim_exist($id, 255, 0);
	if($src_h > 0){
		return '<img src="'.$img.'" height="'.$src_h.'" />';
	}else{
		ob_start();
		ob_end_clean();
		$fpost = get_post($id);
		$content = $fpost->post_content;
		$output = preg_match_all('/\<img.+?src="(.+?)".*?\/>/is',$content,$matches ,PREG_SET_ORDER);
		$cnt = count( $matches );
		if($cnt>0){
			wim_delete($id, 255, 0);
			$args = resizeimg($id, $matches[0][1], 0, 255);
			$w = $args['width'];
			$h = $args['height'];
			wim_insert($id, $sn, $w, $h);
			return '<img src="'.$img.'" height="'.$h.'" />';
		}else{
			return false;
		}
	}
}

function wim_sidebar($id){
	$img = get_bloginfo('wpurl').'/wp-content/uploads/thumbnail/'.$id.'600.jpg';
	$sn = 0;
	$src_h = wim_exist($id, 60, 0);
	if($src_h > 0){
		return '<img src="'.$img.'" height="'.$src_h.'" />';
	}else{
		ob_start();
		ob_end_clean();
		$fpost = get_post($id);
		$content = $fpost->post_content;
		$output = preg_match_all('/\<img.+?src="(.+?)".*?\/>/is',$content,$matches ,PREG_SET_ORDER);
		$cnt = count( $matches );
		if($cnt>0){
			wim_delete($id, 60, 0);
			$args = resizeimg($id, $matches[0][1], 0, 60, 1, 60);
			$w = $args['width'];
			$h = $args['height'];
			wim_insert($id, $sn, $w, $h);
			return '<img src="'.$img.'" height="'.$h.'" />';
		}else{
			return false;
		}
	}
}

function wim_single($id, $sn=0){
	$img = get_bloginfo('wpurl').'/wp-content/uploads/thumbnail/'.$id.'750'.$sn.'.jpg';
	$out = "";
	$src_h = wim_exist($id, 750, $sn);
	if($src_h > 0){
		$out = '<img src="'.$img.'" height="'.$src_h.'" />';
		if($sn>0) $out = '<img datasrc="'.$img.'" height="'.$src_h.'" />';
	}else{
		ob_start();
		ob_end_clean();
		$fpost = get_post($id);
		$content = $fpost->post_content;
		$output = preg_match_all('/\<img.+?src="(.+?)".*?\/>/is',$content,$matches ,PREG_SET_ORDER);
		$cnt = count( $matches );
		if($cnt>0){
			wim_delete($id, 750, $sn);
			$args = resizeimg($id, $matches[$sn][1], $sn, 750);
			$w = $args['width'];
			$h = $args['height'];
			wim_insert($id, $sn, $w, $h);
			$out = '<img src="'.$img.'" height="'.$h.'" />';
			if($sn>0) $out = '<img datasrc="'.$img.'" height="'.$src_h.'" />';
		}
	}
	return $out;
}

?>