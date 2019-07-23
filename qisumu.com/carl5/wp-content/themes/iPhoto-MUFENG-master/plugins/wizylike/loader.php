<?php
/*
Plugin Name: WizyLike
Description: A plugin that allow users or the puplic to like/unlike posts with a sidebar widget to display most liked posts.
Version: 1.6
Author: WizyLabs
Author URI: http://wizylabs.com
*/

// constants paths
define('WL_PATH', dirname(__FILE__));

// constants URIs
define('WL_URI', get_bloginfo('wpurl') . '/wp-content/plugins/wizylike');
define('WL_JSURI', WL_URI . '/js');


// Calls database global
global $wpdb, $wl_tablename;


// Combines default db tables prefix with our newly tabel name
$wl_tablename = $wpdb->prefix . 'wizylike';

// Runs when the plugin is activated
function wizylike_activate() {
	global $wpdb, $wl_tablename;
	
	if (!empty($wpdb->charset))
		$charset_collate = "DEFAULT CHARACTER SET $wpdb->charset";
		
		// run the SQL statement on the database
		$wpdb->query("CREATE TABLE {$wl_tablename} (
							id BIGINT(20) NOT NULL AUTO_INCREMENT,
							post_id BIGINT(20) NOT NULL,
							ip_address VARCHAR(25) NOT NULL,
							like_status VARCHAR(25) NOT NULL DEFAULT 'like',
							PRIMARY KEY (id), 
							UNIQUE (id)
							){$charset_collate};");	
}
register_activation_hook(__FILE__, 'wizylike_activate');


// Runs when the plugin is deactivated
function wizylike_deactivate() {
	global $wpdb, $wl_tablename;
	$wpdb->query("DROP TABLE IF EXISTS {$wl_tablename};");
}
register_deactivation_hook(__FILE__, 'wizylike_deactivate');



add_action('init', 'wizylike_init');


// wizylike front-end init
function wizylike_init(){
	
	// includes main class
	require_once(WL_PATH . '/class.wizylike.php');
	
	// includes template tags for ease of usage
	require_once(WL_PATH . '/template-tags.php');
	
}

add_action('wp_head', 'load_js');
function load_js() {
	if(is_single()){
		wp_enqueue_script('wizylike', WL_JSURI . '/wizylike2.js', false, '1.0', false);
	}else{
		wp_enqueue_script('wizylike', WL_JSURI . '/wizylike.js', false, '1.0', false);
	}
}

?>