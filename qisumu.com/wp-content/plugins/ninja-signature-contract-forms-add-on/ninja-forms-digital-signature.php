<?php
/**
 * @package   	      Ninja Forms Signature Contract Add-On
 * @contributors      Kevin Michael Gray (Approve Me), Abu Shoaib (Approve Me), Arafat Rahman (Approve Me)
 * @wordpress-plugin
 * Plugin Name:       Ninja Forms Signature Contract Add-On
 * Plugin URI:        http://aprv.me/ninja-forms
 * Description:       This add-on makes it possible to automatically email a WP E-Signature contract (or redirect a user to a contract) after the user has successfully submitted a Ninja Form. You can also insert data from the submitted Ninja Form into the WP E-Signature contract.
 * Version:           1.4.4
 * Author:            Approve Me
 * Author URI:        http://aprv.me/NinjaForms
 * Text Domain:       esig-nfds
 * Domain Path:       /languages
 * License/Terms & Conditions: http://www.approveme.me/terms-conditions/
 * Privacy Policy: http://www.approveme.me/privacy-policy/
 */

 // If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}


/*----------------------------------------------------------------------------*
 * Public-Facing Functionality
 *----------------------------------------------------------------------------*/

require_once( plugin_dir_path( __FILE__ ) . 'includes/esig-nfds.php' );


/*
 * Register hooks that are fired when the plugin is activated or deactivated.
 * When the plugin is deleted, the uninstall.php file is loaded.
 */
 
register_activation_hook( __FILE__, array( 'ESIG_NFDS', 'activate' ) );
register_deactivation_hook( __FILE__, array( 'ESIG_NFDS', 'deactivate' ) );


//if (is_admin()) {
         
	require_once( plugin_dir_path( __FILE__ ) . 'admin/esig-nfds-admin.php' );
        add_action( 'plugins_loaded', array( 'ESIG_NFDS_Admin', 'get_instance' ) );
        
        
       require_once( plugin_dir_path( __FILE__ ) . 'includes/esig-ninjaform-document-view.php' );
        



/**
 * Load plugin textdomain.
 *
 * @since 1.1.3
 */
function esig_nfds_load_textdomain() {
    
  load_plugin_textdomain('esig-nfds', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' ); 
}
add_action( 'plugins_loaded', 'esig_nfds_load_textdomain');

