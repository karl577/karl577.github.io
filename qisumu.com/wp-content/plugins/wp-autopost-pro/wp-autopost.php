<?php
/*
Plugin Name: WP-AutoPost Pro
Plugin URI: http://wp-autopost.org
Description: WP-AutoPost Plugin can automatically post content from any other site. It is very simple to use, without complicated setting, and powerful enough.
Version: 2.9.6
Author: WP-AutoPost.ORG
Author URI: http://wp-autopost.org
*/

define('WPAPPRO_PATH',WP_PLUGIN_DIR.'/wp-autopost-pro');
load_plugin_textdomain('wp-autopost', WP_PLUGIN_URL.'/wp-autopost-pro/languages/', 'wp-autopost-pro/languages/');
if (!function_exists('add_action')) {
	$wp_root = '../../..';
	if (file_exists($wp_root.'/wp-load.php')) {
		require_once($wp_root.'/wp-load.php');
	} else {
		require_once($wp_root.'/wp-config.php');
	}
}
add_action('admin_menu', 'wp_autopost_pro_menu');
function wp_autopost_pro_menu() {
	if (function_exists('add_menu_page')) {
		add_menu_page('Auto Post Pro','Auto Post Pro', 'administrator', 'wp-autopost-pro/wp-autopost-tasklist.php', '',WP_PLUGIN_URL.'/wp-autopost-pro/images/menu_icon.png');
	}
	if (function_exists('add_submenu_page')) {
		add_submenu_page('wp-autopost-pro/wp-autopost-tasklist.php', __('Posts'), __('Posts'),  'administrator', 'wp-autopost-pro/wp-autopost-updatedpost.php');
		add_submenu_page('wp-autopost-pro/wp-autopost-tasklist.php', __('Auto Link','wp-autopost'), __('Auto Link','wp-autopost'),  'administrator', 'wp-autopost-pro/wp-autopost-link.php');
		add_submenu_page('wp-autopost-pro/wp-autopost-tasklist.php', __('Options','wp-autopost'), __('Options','wp-autopost'),  'administrator', 'wp-autopost-pro/wp-autopost-options.php');
        add_submenu_page('wp-autopost-pro/wp-autopost-tasklist.php', __('Watermark Options','wp-autopost'), __('Watermark Options','wp-autopost'),  'administrator', 'wp-autopost-pro/wp-autopost-watermark.php');
		add_submenu_page('wp-autopost-pro/wp-autopost-tasklist.php', __('Microsoft Translator','wp-autopost'), __('Microsoft Translator','wp-autopost'),  'administrator', 'wp-autopost-pro/wp-autopost-translator.php');
		add_submenu_page('wp-autopost-pro/wp-autopost-tasklist.php', __('Proxy','wp-autopost'), __('Proxy','wp-autopost'),  'administrator', 'wp-autopost-pro/wp-autopost-proxy.php');
		add_submenu_page('wp-autopost-pro/wp-autopost-tasklist.php', __('Flickr','wp-autopost'), __('Flickr','wp-autopost'),  'administrator', 'wp-autopost-pro/wp-autopost-flickr.php');
		add_submenu_page('wp-autopost-pro/wp-autopost-tasklist.php', __('Qiniu','wp-autopost'), __('Qiniu','wp-autopost'),  'administrator', 'wp-autopost-pro/wp-autopost-qiniu.php');
		add_submenu_page('wp-autopost-pro/wp-autopost-tasklist.php', __('Upyun','wp-autopost'), __('Upyun','wp-autopost'),  'administrator', 'wp-autopost-pro/wp-autopost-upyun.php');
		add_submenu_page('wp-autopost-pro/wp-autopost-tasklist.php', __('Logs','wp-autopost'), __('Logs','wp-autopost'),  'administrator', 'wp-autopost-pro/wp-autopost-logs.php');
		add_submenu_page('wp-autopost-pro/wp-autopost-tasklist.php', __('Documentation','wp-autopost'), __('Documentation','wp-autopost'),  'administrator', 'wp-autopost-pro/wp-autopost-documentation.php');
	
	}
}

include WPAPPRO_PATH.'/wp-autopost-page.php';

global  $wp_autopost_root,$table_prefix,$t_ap_config,$t_ap_config_option,$t_ap_config_url_list,$t_ap_updated_record,$t_ap_log,$t_autolink,$t_ap_more_content,$t_ap_flickr_img,$t_ap_flickr_oauth,$t_ap_qiniu_img,$t_ap_upyun_img,$t_ap_download_img_temp;
$wp_autopost_root = WP_PLUGIN_URL."/wp-autopost-pro/";
$t_ap_config = $table_prefix.'ap_config';
$t_ap_config_option = $table_prefix.'ap_config_option';
$t_ap_config_url_list = $table_prefix.'ap_config_url_list';
$t_ap_updated_record = $table_prefix.'ap_updated_record';
$t_ap_log = $table_prefix.'ap_log';
$t_autolink = $table_prefix.'autolink';
$t_ap_more_content = $table_prefix.'ap_more_content';
$t_ap_flickr_img = $table_prefix.'ap_flickr_img';
$t_ap_qiniu_img = $table_prefix.'ap_qiniu_img';
$t_ap_upyun_img = $table_prefix.'ap_upyun_img';
$t_ap_flickr_oauth = $table_prefix.'ap_flickr_oauth';
$t_ap_download_img_temp = $table_prefix.'ap_download_img_temp';

function wp_autopost_pro_install () {
  add_option('wp_autopost_updateMethod', '0');
  add_option('wp_autopost_timeLimit', '0');
  add_option('wp_autopost_runOnlyOneTask', '1');
  add_option('wp_autopost_runOnlyOneTaskIsRunning', '0');
  add_option('wp_autopost_downImgMinWidth', '100');
  add_option('wp_autopost_delComment', '1');
  add_option('wp_autopost_delAttrId', '1');
  add_option('wp_autopost_delAttrClass', '1');
  add_option('wp_autopost_delAttrStyle', '0');
  add_option('wp_autopost_cdkey', '');
  //add_option('wp_autopost_delEmptyTag', '0');

  global $wpdb; $wp_autopost_db_version = '2.9.6';
  global $t_ap_config,$t_ap_config_option,$t_ap_config_url_list,$t_ap_updated_record,$t_ap_log,$t_autolink,$t_ap_more_content,$t_ap_flickr_img,$t_ap_flickr_oauth,$t_ap_qiniu_img,$t_ap_upyun_img,$t_ap_download_img_temp;
  $old_db_version = get_option('wp_autopost_db_version');
  require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
  
  if(($wpdb->get_var("SHOW TABLES LIKE '$t_ap_config'") != $t_ap_config)||$wp_autopost_db_version!=$old_db_version){
    $sql = "CREATE TABLE " . $t_ap_config . " (
    id SMALLINT(5) UNSIGNED NOT NULL AUTO_INCREMENT,
	m_extract TINYINT(3) UNSIGNED NOT NULL DEFAULT '0',
	activation TINYINT(3) UNSIGNED NOT NULL DEFAULT '0',
	name CHAR(200) NOT NULL COLLATE 'utf8_unicode_ci',
	page_charset CHAR(30) NOT NULL DEFAULT '0' COLLATE 'utf8_unicode_ci',
	content_test_url CHAR(255) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	a_match_type TINYINT(3) UNSIGNED NOT NULL DEFAULT '0',
	title_match_type TINYINT(3) UNSIGNED NOT NULL DEFAULT '0',
    content_match_type VARCHAR(300) NOT NULL DEFAULT '0',
	page_match_type TINYINT(3) UNSIGNED NOT NULL DEFAULT '0',
	a_selector VARCHAR(400) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	title_selector VARCHAR(400) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	content_selector VARCHAR(400) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	page_selector VARCHAR(400) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	fecth_paged TINYINT(3) UNSIGNED NOT NULL DEFAULT '0',
	same_paged TINYINT(3) UNSIGNED NOT NULL DEFAULT '0',
	source_type TINYINT(3) UNSIGNED NOT NULL DEFAULT '0',
	start_num SMALLINT(5) UNSIGNED NOT NULL DEFAULT '0',
	end_num SMALLINT(5) UNSIGNED NOT NULL DEFAULT '0',
	title_prefix CHAR(80) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	title_suffix CHAR(80) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	content_prefix VARCHAR(1000) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	content_suffix VARCHAR(1000) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	updated_num MEDIUMINT(8) UNSIGNED NOT NULL DEFAULT '0',
	cat VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	author SMALLINT(5) UNSIGNED NULL DEFAULT NULL,
	update_interval SMALLINT(5) UNSIGNED NOT NULL DEFAULT '60',
	published_interval SMALLINT(5) UNSIGNED NOT NULL DEFAULT '60',
	post_scheduled VARCHAR(20)  NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	post_scheduled_last_time INT(10) UNSIGNED NOT NULL DEFAULT '0',
	download_img CHAR(10) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	img_insert_attachment CHAR(40) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	auto_tags CHAR(10) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	whole_word TINYINT(3) UNSIGNED NOT NULL DEFAULT '0',
	tags VARCHAR(500) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	use_trans VARCHAR(50)  NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	use_rewrite VARCHAR(100) NULL DEFAULT '0' COLLATE 'utf8_unicode_ci',
	last_update_time INT(10) UNSIGNED NOT NULL DEFAULT '0',
	last_check_fetch_time INT(10) UNSIGNED NOT NULL DEFAULT '0',
	post_id INT(10) UNSIGNED NOT NULL DEFAULT '0',
	last_error INT(10) UNSIGNED NOT NULL DEFAULT '0',
	is_running TINYINT(3) UNSIGNED NOT NULL DEFAULT '0',
	reverse_sort TINYINT(3) UNSIGNED NOT NULL DEFAULT '0',
	add_source_url VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	proxy CHAR(10) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	post_type VARCHAR(50) NULL DEFAULT 'post' COLLATE 'utf8_unicode_ci',
	post_format VARCHAR(20) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	check_duplicate TINYINT(3) UNSIGNED NOT NULL DEFAULT '0',
	custom_field VARCHAR(2000) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	err_status TINYINT(3) NOT NULL DEFAULT '1',
	cookie VARCHAR(4000) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	PRIMARY KEY (id)
     ) COLLATE='utf8_unicode_ci' ENGINE=MyISAM";

	 dbDelta($sql);  
  }

  if(($wpdb->get_var("SHOW TABLES LIKE '$t_ap_config_option'") != $t_ap_config_option)||$wp_autopost_db_version!=$old_db_version){
    $sql = "CREATE TABLE " . $t_ap_config_option . " (
    id SMALLINT(5) UNSIGNED NOT NULL AUTO_INCREMENT,
	config_id SMALLINT(5) UNSIGNED NOT NULL DEFAULT '0',
	option_type TINYINT(3) UNSIGNED NOT NULL DEFAULT '0',
	para1 CHAR(255) NOT NULL,
	para2 CHAR(255) NULL DEFAULT NULL,
	PRIMARY KEY (id),
	INDEX config_id (config_id)
     ) COLLATE='utf8_unicode_ci' ENGINE=MyISAM";

	 dbDelta($sql);  
  }

  if(($wpdb->get_var("SHOW TABLES LIKE '$t_ap_config_url_list'") != $t_ap_config_url_list)||$wp_autopost_db_version!=$old_db_version){
    $sql = "CREATE TABLE " . $t_ap_config_url_list . " (
	id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	config_id SMALLINT(5) UNSIGNED NOT NULL DEFAULT '0',
	url CHAR(255) NOT NULL,
	PRIMARY KEY (id)
     ) COLLATE='utf8_unicode_ci' ENGINE=MyISAM";

	 dbDelta($sql);  
  }

  if(($wpdb->get_var("SHOW TABLES LIKE '$t_ap_updated_record'") != $t_ap_updated_record)||$wp_autopost_db_version!=$old_db_version){
    $sql = "CREATE TABLE " . $t_ap_updated_record . " (
	id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	config_id SMALLINT(5) UNSIGNED NOT NULL,
	url VARCHAR(1000) NOT NULL COLLATE 'utf8_unicode_ci',
	title VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8_unicode_ci',
	post_id INT(10) UNSIGNED NOT NULL,
	date_time INT(10) UNSIGNED NOT NULL,
    url_status TINYINT(3) NOT NULL DEFAULT '1',
	PRIMARY KEY (id),
	INDEX url (url),
	INDEX title (title)
     ) COLLATE='utf8_unicode_ci' ENGINE=MyISAM";

	 dbDelta($sql);  
  }

  if(($wpdb->get_var("SHOW TABLES LIKE '$t_ap_log'") != $t_ap_log)||$wp_autopost_db_version!=$old_db_version){
    $sql = "CREATE TABLE " . $t_ap_log . " (
	id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	config_id INT(10) UNSIGNED NULL DEFAULT NULL,
	date_time INT(10) UNSIGNED NULL DEFAULT NULL,
	info VARCHAR(255) NULL DEFAULT NULL,
	url VARCHAR(255) NULL DEFAULT NULL,
	PRIMARY KEY (id)
     ) COLLATE='utf8_unicode_ci' ENGINE=MyISAM";

	 dbDelta($sql);  
  }

  if(($wpdb->get_var("SHOW TABLES LIKE '$t_autolink'") != $t_autolink)||$wp_autopost_db_version!=$old_db_version){
    $sql = "CREATE TABLE " . $t_autolink . " (
    id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	keyword VARCHAR(50) NOT NULL COLLATE 'utf8_unicode_ci',  
	details VARCHAR(200) NOT NULL COLLATE 'utf8_unicode_ci',
	PRIMARY KEY (id)
     ) COLLATE='utf8_unicode_ci' ENGINE=MyISAM";

	 dbDelta($sql);  
  }

  if(($wpdb->get_var("SHOW TABLES LIKE '$t_ap_more_content'") != $t_ap_more_content)||$wp_autopost_db_version!=$old_db_version){
    $sql = "CREATE TABLE " . $t_ap_more_content . " (
    id INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	config_id SMALLINT(5) UNSIGNED NOT NULL DEFAULT '0',
	option_type SMALLINT(5) UNSIGNED NOT NULL DEFAULT '0',
	content VARCHAR(1000) NOT NULL COLLATE 'utf8_unicode_ci',
	PRIMARY KEY (id)
     ) COLLATE='utf8_unicode_ci' ENGINE=MyISAM";

	 dbDelta($sql);  
  }

  if(($wpdb->get_var("SHOW TABLES LIKE '$t_ap_flickr_img'") != $t_ap_flickr_img)||$wp_autopost_db_version!=$old_db_version){
    $sql = "CREATE TABLE " . $t_ap_flickr_img . " (
    id BIGINT(20) UNSIGNED NOT NULL,
	flickr_photo_id VARCHAR(20) NOT NULL,  
	url_info VARCHAR(100) NOT NULL,
	oauth_id SMALLINT(5) UNSIGNED NOT NULL,
	local_key VARCHAR(100) NULL DEFAULT NULL,
	in_local TINYINT(3) NOT NULL DEFAULT '0',
	date_time INT(10) UNSIGNED NULL DEFAULT NULL,
	INDEX id (id)
     ) COLLATE='utf8_unicode_ci' ENGINE=MyISAM";

	 dbDelta($sql);  
  }

  if(($wpdb->get_var("SHOW TABLES LIKE '$t_ap_flickr_oauth'") != $t_ap_flickr_oauth)||$wp_autopost_db_version!=$old_db_version){
    $sql = "CREATE TABLE " . $t_ap_flickr_oauth . " (
    oauth_id SMALLINT(5) UNSIGNED NOT NULL AUTO_INCREMENT,
	oauth_token VARCHAR(100) NOT NULL COLLATE 'utf8_unicode_ci',  
	oauth_token_secret VARCHAR(50) NOT NULL COLLATE 'utf8_unicode_ci',
    PRIMARY KEY (oauth_id)
	) COLLATE='utf8_unicode_ci' ENGINE=MyISAM";

	 dbDelta($sql);  
  }

  if(($wpdb->get_var("SHOW TABLES LIKE '$t_ap_qiniu_img'") != $t_ap_qiniu_img)||$wp_autopost_db_version!=$old_db_version){
    $sql = "CREATE TABLE " . $t_ap_qiniu_img . " (
    id BIGINT(20) UNSIGNED NOT NULL,
	qiniu_key VARCHAR(100) NOT NULL,
	local_key VARCHAR(100) NULL DEFAULT NULL,
	in_local TINYINT(3) NOT NULL DEFAULT '0',
	date_time INT(10) UNSIGNED NULL DEFAULT NULL,
	INDEX id (id)
     ) COLLATE='utf8_unicode_ci' ENGINE=MyISAM";

	 dbDelta($sql);  
  }

  if(($wpdb->get_var("SHOW TABLES LIKE '$t_ap_upyun_img'") != $t_ap_upyun_img)||$wp_autopost_db_version!=$old_db_version){
    $sql = "CREATE TABLE " . $t_ap_upyun_img . " (
    id BIGINT(20) UNSIGNED NOT NULL,
	upyun_key VARCHAR(100) NOT NULL,
	local_key VARCHAR(100) NULL DEFAULT NULL,
	in_local TINYINT(3) NOT NULL DEFAULT '0',
	date_time INT(10) UNSIGNED NULL DEFAULT NULL,
	INDEX id (id)
     ) COLLATE='utf8_unicode_ci' ENGINE=MyISAM";

	 dbDelta($sql);  
  }

  if(($wpdb->get_var("SHOW TABLES LIKE '$t_ap_download_img_temp'") != $t_ap_download_img_temp)||$wp_autopost_db_version!=$old_db_version){
    $sql = "CREATE TABLE " . $t_ap_download_img_temp . " (
	config_id SMALLINT(5) UNSIGNED NOT NULL DEFAULT '0',
    url VARCHAR(1000) NOT NULL,
	save_type TINYINT(3) NOT NULL DEFAULT '0',
	remote_url VARCHAR(1000) NOT NULL,
    downloaded_url varchar(500) NOT NULL,
    local_key varchar(100) NULL DEFAULT NULL,
	remote_key varchar(100) NULL DEFAULT NULL,
    file_path varchar(500) NULL DEFAULT NULL,
	file_name varchar(100) NULL DEFAULT NULL,
	mime_type varchar(20) NULL DEFAULT NULL
     ) COLLATE='utf8_unicode_ci' ENGINE=MyISAM";

	 dbDelta($sql);  
  }

  if($wp_autopost_db_version!=$old_db_version){
    $MicroTransOptions = get_option('wp-autopost-micro-trans-options');
	if($MicroTransOptions!=null){
       $array = array();
       $newArray = array();
       $newArray['clientID']=$MicroTransOptions['clientID'];
       $newArray['clientSecret']=$MicroTransOptions['clientSecret'];
       $array[] = $newArray;
       update_option('wp-autopost-micro-trans-options',$array);
	}
  }
  

  update_option("wp_autopost_db_version", $wp_autopost_db_version);

  //watermark
  $upload_image = dirname(__FILE__).'/watermark/uploads/watermark.png';
  $upload_image_url = plugins_url('/watermark/uploads/watermark.png', __FILE__ );
  
  $options = array(
	  'type' => 0,
	  'position' => 9,
	  'font' => '',
	  'text' => get_bloginfo('url'),
	  'size' => 16,
	  'color' => '#ffffff',
	  'x-adjustment' => 0,
	  'y-adjustment' => 0,
	  'transparency' => 80,
	  'upload_image' => $upload_image,
	  'upload_image_url' => $upload_image_url,
	  'min_width' => 300,
	  'min_height' => 300,
	  'jpeg_quality' => 90
   );
   add_option( 'wp-watermark-options', $options );

   $flickrOptions = array(
	  'api_key' => 'fc1ec013e1bfb8f17b952a89efbe355e',
	  'api_secret' => 'bbba8595664cfd10',
	  'oauth_token' => '',
	  'oauth_token_secret' => '',
	  'user_id' => '',
	  'flickr_set'=>'',
	  'is_public' => 0
   );
   add_option( 'wp-autopost-flickr-options', $flickrOptions );

   $qiniuOptions = array(
	  'domain' => '',
	  'bucket' => '',
	  'access_key' => '',
	  'secret_key' => ''
   );
   add_option( 'wp-autopost-qiniu-options', $flickrOptions );



}
register_activation_hook( __FILE__,'wp_autopost_pro_install');




include WPAPPRO_PATH.'/wp-autopost-function.php';


?>