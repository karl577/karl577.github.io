<?php
/*
* Plugin Name: Contact Bank Lite Edition
* Plugin URI: http://tech-banker.com
* Description: Build Complex, Powerful Contact Forms in Just Seconds. No Programming Knowledge Required! Yeah, It's Really That Easy.
* Author: Tech Banker
* Version: 2.1.38
* Author URI: http://tech-banker.com
* License: GPLv3 or later
* Text Domain: contact-bank
* Domain Path: /languages
 */
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//   D e f i n e     CONSTANTS //////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if(!defined("ABSPATH")) exit; //exit if accessed directly
if(!defined("CONTACT_BK_PLUGIN_DIR")) define("CONTACT_BK_PLUGIN_DIR",  plugin_dir_path( __FILE__ ));
if(!defined("CONTACT_BK_PLUGIN_DIRNAME")) define("CONTACT_BK_PLUGIN_DIRNAME", plugin_basename(dirname(__FILE__)));
if(!defined("CONTACT_BK")) define("CONTACT_BK","contact-bank/contact-bank.php");
if(!defined("CONTACT_BK_PLUGIN_BASENAME")) define("CONTACT_BK_PLUGIN_BASENAME", plugin_basename(__FILE__));
if(!defined("tech_banker_stats_url")) define("tech_banker_stats_url", "http://stats.tech-banker-services.org");
if(!defined("contact_bank_version_number")) define("contact_bank_version_number","2.1.38");

/* Function Name : plugin_install_script_for_contact_bank
 * Paramters : None
 * Return : None
 * Description : This Function check the version number of the plugin database and performs necessary actions related to the plugin database upgrade.
 * Created in Version 1.0
 * Last Modified : 1.0
 * Reasons for change : None
 */

function plugin_install_script_for_contact_bank()
{
        global $wpdb,$current_user,$cb_user_role_permission;
        if (is_super_admin())
        {
                $cb_role = "administrator";
        }
        else
        {
                $cb_role = $wpdb->prefix . "capabilities";
                $current_user->role = array_keys($current_user->$cb_role);
                $cb_role = $current_user->role[0];
        }
        if (is_multisite())
        {
                $blog_ids = $wpdb->get_col("SELECT blog_id FROM $wpdb->blogs");
                foreach($blog_ids as $blog_id)
                {
                        switch_to_blog($blog_id);
                        if(file_exists(CONTACT_BK_PLUGIN_DIR. "/lib/install-script.php"))
                        {
                                include CONTACT_BK_PLUGIN_DIR ."/lib/install-script.php";
                        }
                        restore_current_blog();
                }
        }
        else
        {
                if(file_exists(CONTACT_BK_PLUGIN_DIR. "/lib/install-script.php"))
                {
                        include CONTACT_BK_PLUGIN_DIR ."/lib/install-script.php";
                }
        }
}


/*************************************************************************************/


class class_plugin_info_contact_bank
{
        function get_plugin_info()
        {
                $active_plugins = (array)get_option("active_plugins", array());
                if (is_multisite())
                $active_plugins = array_merge($active_plugins, get_site_option("active_sitewide_plugins", array()));
                $plugins = array();
                if(count($active_plugins) > 0)
                {
                        $get_plugins = array();
                        foreach ($active_plugins as $plugin)
                        {
                                $plugin_data = @get_plugin_data(WP_PLUGIN_DIR . "/" . $plugin);

                                $get_plugins["plugin_name"] = strip_tags($plugin_data["Name"]);
                                $get_plugins["plugin_author"] = strip_tags($plugin_data["Author"]);
                                $get_plugins["plugin_version"] = strip_tags($plugin_data["Version"]);
                                array_push($plugins,$get_plugins);
                        }
                        return $plugins;
                }
        }
}


/*
Function Name: deactivation_function_for_contact_bank
Description: This function is used for executing the code on deactivation.
Parameters: No
Created On: 07-04-2017 09:54
Created By: Tech Banker Team
*/

function deactivation_function_for_contact_bank()
{
    $type = get_option("contact-bank-wizard");
    if($type == "opt_in")
    {
        $class_plugin_info_contact_bank = new class_plugin_info_contact_bank();
        global $wp_version,$wpdb;
        $theme_details = array();
        if($wp_version >= 3.4)
        {
                $active_theme = wp_get_theme();
                $theme_details["theme_name"] = strip_tags($active_theme->Name);
                $theme_details["theme_version"] = strip_tags($active_theme->Version);
                $theme_details["author_url"] = strip_tags($active_theme->{"Author URI"});
        }
        $plugin_stat_data = array();
        $plugin_stat_data["plugin_slug"] = "contact-bank";
        $plugin_stat_data["type"] = "standard_edition";
        $plugin_stat_data["version_number"] = contact_bank_version_number;
        $plugin_stat_data["status"] = $type;
        $plugin_stat_data["event"] = "de-activate";
        $plugin_stat_data["domain_url"] = site_url();
        $plugin_stat_data["wp_language"] = defined("WPLANG") && WPLANG ? WPLANG : get_locale();

        $plugin_stat_data["email"] = get_option("admin_email");
        $plugin_stat_data["wp_version"] = $wp_version;
        $plugin_stat_data["php_version"] = esc_html(phpversion());
        $plugin_stat_data["mysql_version"] = $wpdb->db_version();
        $plugin_stat_data["max_input_vars"] = ini_get("max_input_vars");
        $plugin_stat_data["operating_system"] =  PHP_OS ."  (".PHP_INT_SIZE * 8 .") BIT";
        $plugin_stat_data["php_memory_limit"] = ini_get("memory_limit")  ? ini_get("memory_limit") : "N/A";
        $plugin_stat_data["extensions"] = get_loaded_extensions();
        $plugin_stat_data["plugins"] = $class_plugin_info_contact_bank->get_plugin_info();
        $plugin_stat_data["themes"] = $theme_details;
        $url = tech_banker_stats_url."/wp-admin/admin-ajax.php";
        $response = wp_safe_remote_post($url, array
        (
                "method" => "POST",
                "timeout" => 45,
                "redirection" => 5,
                "httpversion" => "1.0",
                "blocking" => true,
                "headers" => array(),
                "body" => array( "data" => serialize($plugin_stat_data), "site_id" => get_option("contact_bank_site_id") != "" ? get_option("contact_bank_site_id") : "","action"=>"plugin_analysis_data")
        ));
        if(!is_wp_error($response))
        {
                $response["body"] != "" ? update_option("contact_bank_site_id", $response["body"]) : "";
        }
    }
}





/* Function Name : create_global_menus_for_contact_bank
 * Paramters : None
 * Return : None
 * Description : This Function creates menus in the admin menu sidebar and related mention function in each menu are being called.
 * Created in Version 1.0
 * Last Modified : 1.0
 * Reasons for change : None
 */

function create_global_menus_for_contact_bank()
{
        global $wpdb,$current_user;
        if (is_super_admin())
        {
                $cb_role = "administrator";
        }
        else
        {
                $cb_role = $wpdb->prefix . "capabilities";
                $current_user->role = array_keys($current_user->$cb_role);
                $cb_role = $current_user->role[0];
        }
        $contact_bank_wizard =  get_option("contact-bank-wizard");
        global $wp_version;

        switch ($cb_role) {
                case "administrator":
                        if(get_option("contact-bank-wizard"))
                        {
                                add_menu_page("Contact Bank", __("Contact Bank", "contact-bank"), "read", "contact_dashboard","",plugins_url("/assets/images/icon.png" , __FILE__));
                        }
                        else
                        {
                                add_menu_page("Contact Bank", __("Contact Bank", "contact-bank"), "read","contact_bank_wizard","",plugins_url("/assets/images/icon.png" , __FILE__));
                                add_submenu_page("Contact Bank", __("Contact Bank", "contact-bank") ,"","read","contact_bank_wizard", "contact_bank_wizard");
                        }
                        add_submenu_page("contact_dashboard", "Dashboard", __("Dashboard", "contact-bank"), "read", "contact_dashboard", $contact_bank_wizard == "" ? "contact_bank_wizard" : "contact_dashboard");
                        add_submenu_page("","","", "read", "contact_bank","contact_bank");
                        add_submenu_page("contact_dashboard", "Other Settings", __("Other Settings", "contact-bank"), "read", "contact_other_settings", $contact_bank_wizard == "" ? "contact_bank_wizard" : "contact_other_settings" );
                        add_submenu_page("contact_dashboard", "Short-Codes", __("Short-Codes", "contact-bank"), "read", "contact_short_code", $contact_bank_wizard == "" ? "contact_bank_wizard" : "contact_short_code" );
                        add_submenu_page("contact_dashboard", "Form Entries", __("Form Entries", "contact-bank"), "read", "contact_frontend_data", $contact_bank_wizard == "" ? "contact_bank_wizard" : "contact_frontend_data");
                        add_submenu_page("contact_dashboard", "Email Settings", __("Email Settings", "contact-bank"), "read", "contact_email", $contact_bank_wizard == "" ? "contact_bank_wizard" : "contact_email");
                        add_submenu_page("contact_dashboard", "Global Settings", __("Global Settings", "contact-bank"), "read", "contact_layout_settings", $contact_bank_wizard == "" ? "contact_bank_wizard" : "contact_layout_settings");
                        add_submenu_page("contact_dashboard", "Feature Requests", __("Feature Requests", "contact-bank"), "read", "contact_feature_request", $contact_bank_wizard == "" ? "contact_bank_wizard" : "contact_feature_request");
                        add_submenu_page("contact_dashboard", "System Status", __("System Status", "contact-bank"), "read", "contact_system_status", $contact_bank_wizard == "" ? "contact_bank_wizard" : "contact_system_status" );
                        add_submenu_page("contact_dashboard", "Recommendations", __("Recommendations", "contact-bank"), "read", "contact_bank_recommended_plugins", $contact_bank_wizard == "" ? "contact_bank_wizard" : "contact_bank_recommended_plugins");
                        add_submenu_page("contact_dashboard", "Premium Editions", __("Premium Editions", "contact-bank"), "read", "contact_pro_version", $contact_bank_wizard == "" ? "contact_bank_wizard" : "contact_pro_version" );
                        add_submenu_page("contact_dashboard", " Our Other Services ", __("Our Other Services", "contact-bank"), "read", "contact_bank_other_services", $contact_bank_wizard == "" ? "contact_bank_wizard" : "contact_bank_other_services");
                        add_submenu_page("","","", "read", "add_contact_email_settings", "add_contact_email_settings" );
                        add_submenu_page("","","", "read", "form_preview", "form_preview" );
                break;
                case "editor":
                        if(get_option("contact-bank-wizard"))
                        {
                                add_menu_page("Contact Bank", __("Contact Bank", "contact-bank"), "read", "contact_dashboard","",plugins_url("/assets/images/icon.png" , __FILE__));
                        }
                        else
                        {
                                add_menu_page("Contact Bank", __("Contact Bank", "contact-bank"), "read","contact_bank_wizard","",plugins_url("/assets/images/icon.png" , __FILE__));
                                add_submenu_page("Contact Bank", __("Contact Bank", "contact-bank") ,"","read","contact_bank_wizard", "contact_bank_wizard");
                        }
                        add_menu_page("Contact Bank", __("Contact Bank", "contact-bank"), "read", "contact_dashboard","",plugins_url("/assets/images/icon.png" , __FILE__));
                        add_submenu_page("contact_dashboard", "Dashboard", __("Dashboard", "contact-bank"), "read", "contact_dashboard","contact_dashboard");
                        add_submenu_page("","","", "read", "contact_bank","contact_bank");
                        add_submenu_page("contact_dashboard", "Other Settings", __("Other Settings", "contact-bank"), "read", "contact_other_settings", $contact_bank_wizard == "" ? "contact_bank_wizard" : "contact_other_settings" );
                        add_submenu_page("contact_dashboard", "Short-Codes", __("Short-Codes", "contact-bank"), "read", "contact_short_code", $contact_bank_wizard == "" ? "contact_bank_wizard" : "contact_short_code" );
                        add_submenu_page("contact_dashboard", "Form Entries", __("Form Entries", "contact-bank"), "read", "contact_frontend_data", $contact_bank_wizard == "" ? "contact_bank_wizard" : "contact_frontend_data");
                        add_submenu_page("contact_dashboard", "Email Settings", __("Email Settings", "contact-bank"), "read", "contact_email", $contact_bank_wizard == "" ? "contact_bank_wizard" : "contact_email");
                        add_submenu_page("contact_dashboard", "Global Settings", __("Global Settings", "contact-bank"), "read", "contact_layout_settings", $contact_bank_wizard == "" ? "contact_bank_wizard" : "contact_layout_settings");
                        add_submenu_page("contact_dashboard", "Feature Requests", __("Feature Requests", "contact-bank"), "read", "contact_feature_request", $contact_bank_wizard == "" ? "contact_bank_wizard" : "contact_feature_request");
                        add_submenu_page("contact_dashboard", "System Status", __("System Status", "contact-bank"), "read", "contact_system_status", $contact_bank_wizard == "" ? "contact_bank_wizard" : "contact_system_status" );
                        add_submenu_page("contact_dashboard", "Recommendations", __("Recommendations", "contact-bank"), "read", "contact_bank_recommended_plugins", $contact_bank_wizard == "" ? "contact_bank_wizard" : "contact_bank_recommended_plugins");
                        add_submenu_page("contact_dashboard", "Premium Editions", __("Premium Editions", "contact-bank"), "read", "contact_pro_version", $contact_bank_wizard == "" ? "contact_bank_wizard" : "contact_pro_version" );
                        add_submenu_page("contact_dashboard", " Our Other Services ", __("Our Other Services", "contact-bank"), "read", "contact_bank_other_services", $contact_bank_wizard == "" ? "contact_bank_wizard" : "contact_bank_other_services");
                        add_submenu_page("","","", "read", "add_contact_email_settings", "add_contact_email_settings" );
                        add_submenu_page("","","", "read", "form_preview", "form_preview" );
                break;
                case "author":
                        if(get_option("contact-bank-wizard"))
                        {
                                add_menu_page("Contact Bank", __("Contact Bank", "contact-bank"), "read", "contact_dashboard","",plugins_url("/assets/images/icon.png" , __FILE__));
                        }
                        else
                        {
                                add_menu_page("Contact Bank", __("Contact Bank", "contact-bank"), "read","contact_bank_wizard","",plugins_url("/assets/images/icon.png" , __FILE__));
                                add_submenu_page("Contact Bank", __("Contact Bank", "contact-bank") ,"","read","contact_bank_wizard", "contact_bank_wizard");
                        }
                        add_menu_page("Contact Bank", __("Contact Bank", "contact-bank"), "read", "contact_dashboard","",plugins_url("/assets/images/icon.png" , __FILE__));
                        add_submenu_page("contact_dashboard", "Dashboard", __("Dashboard", "contact-bank"), "read", "contact_dashboard","contact_dashboard");
                        add_submenu_page("","","", "read", "contact_bank","contact_bank");
                        add_submenu_page("contact_dashboard", "Other Settings", __("Other Settings", "contact-bank"), "read", "contact_other_settings", $contact_bank_wizard == "" ? "contact_bank_wizard" : "contact_other_settings" );
                        add_submenu_page("contact_dashboard", "Short-Codes", __("Short-Codes", "contact-bank"), "read", "contact_short_code", $contact_bank_wizard == "" ? "contact_bank_wizard" : "contact_short_code" );
                        add_submenu_page("contact_dashboard", "Form Entries", __("Form Entries", "contact-bank"), "read", "contact_frontend_data", $contact_bank_wizard == "" ? "contact_bank_wizard" : "contact_frontend_data");
                        add_submenu_page("contact_dashboard", "Email Settings", __("Email Settings", "contact-bank"), "read", "contact_email", $contact_bank_wizard == "" ? "contact_bank_wizard" : "contact_email");
                        add_submenu_page("contact_dashboard", "Global Settings", __("Global Settings", "contact-bank"), "read", "contact_layout_settings", $contact_bank_wizard == "" ? "contact_bank_wizard" : "contact_layout_settings");
                        add_submenu_page("contact_dashboard", "Feature Requests", __("Feature Requests", "contact-bank"), "read", "contact_feature_request", $contact_bank_wizard == "" ? "contact_bank_wizard" : "contact_feature_request");
                        add_submenu_page("contact_dashboard", "System Status", __("System Status", "contact-bank"), "read", "contact_system_status", $contact_bank_wizard == "" ? "contact_bank_wizard" : "contact_system_status" );
                        add_submenu_page("contact_dashboard", "Recommendations", __("Recommendations", "contact-bank"), "read", "contact_bank_recommended_plugins", $contact_bank_wizard == "" ? "contact_bank_wizard" : "contact_bank_recommended_plugins");
                        add_submenu_page("contact_dashboard", "Premium Editions", __("Premium Editions", "contact-bank"), "read", "contact_pro_version", $contact_bank_wizard == "" ? "contact_bank_wizard" : "contact_pro_version" );
                        add_submenu_page("contact_dashboard", " Our Other Services ", __("Our Other Services", "contact-bank"), "read", "contact_bank_other_services", $contact_bank_wizard == "" ? "contact_bank_wizard" : "contact_bank_other_services");
                        add_submenu_page("","","", "read", "add_contact_email_settings", "add_contact_email_settings" );
                        add_submenu_page("","","", "read", "form_preview", "form_preview" );
                break;
                case "contributor":
                break;

                case "subscriber":
                break;
        }
}

/* Function Name : contact_bank
 * Paramters : None
 * Return : None
 * Description : This Function used to linked menu page is requested.
 * Created in Version 1.0
 * Last Modified : 1.0
 * Reasons for change : None
 */

function contact_bank()
{
        global $wpdb,$current_user,$cb_user_role_permission;
        if (is_super_admin())
        {
                $cb_role = "administrator";
        }
        else
        {
                $cb_role = $wpdb->prefix . "capabilities";
                $current_user->role = array_keys($current_user->$cb_role);
                $cb_role = $current_user->role[0];
        }
        if(file_exists(CONTACT_BK_PLUGIN_DIR ."/views/header.php"))
        {
                include_once CONTACT_BK_PLUGIN_DIR ."/views/header.php";
        }
        if(file_exists(CONTACT_BK_PLUGIN_DIR ."/views/contact_view.php"))
        {
                include_once CONTACT_BK_PLUGIN_DIR ."/views/contact_view.php";
        }
        if(file_exists(CONTACT_BK_PLUGIN_DIR . "/views/includes_common_after.php"))
        {
                include_once CONTACT_BK_PLUGIN_DIR . "/views/includes_common_after.php";
        }
        if(file_exists(CONTACT_BK_PLUGIN_DIR ."/views/footer.php"))
        {
                include_once CONTACT_BK_PLUGIN_DIR ."/views/footer.php";
        }
}


function contact_dashboard()
{
        global $wpdb,$current_user,$cb_user_role_permission;
        if (is_super_admin())
        {
                $cb_role = "administrator";
        }
        else
        {
                $cb_role = $wpdb->prefix . "capabilities";
                $current_user->role = array_keys($current_user->$cb_role);
                $cb_role = $current_user->role[0];
        }
        if(file_exists(CONTACT_BK_PLUGIN_DIR ."/views/header.php"))
        {
                include_once CONTACT_BK_PLUGIN_DIR ."/views/header.php";
        }
        if(file_exists(CONTACT_BK_PLUGIN_DIR ."/views/dashboard.php"))
        {
                include_once CONTACT_BK_PLUGIN_DIR ."/views/dashboard.php";
        }
        if(file_exists(CONTACT_BK_PLUGIN_DIR ."/views/footer.php"))
        {
                include_once CONTACT_BK_PLUGIN_DIR ."/views/footer.php";
        }
}


function contact_bank_wizard()
{
        global $wpdb,$current_user,$cb_user_role_permission;
        if (is_super_admin())
        {
                $cb_role = "administrator";
        }
        else
        {
                $cb_role = $wpdb->prefix . "capabilities";
                $current_user->role = array_keys($current_user->$cb_role);
                $cb_role = $current_user->role[0];
        }
        if(file_exists(CONTACT_BK_PLUGIN_DIR ."/views/wizard.php"))
        {
                include_once CONTACT_BK_PLUGIN_DIR ."/views/wizard.php";
        }
}



function edit_contact_view()
{
        global $wpdb,$current_user,$cb_user_role_permission;
        if (is_super_admin())
        {
                $cb_role = "administrator";
        }
        else
        {
                $cb_role = $wpdb->prefix . "capabilities";
                $current_user->role = array_keys($current_user->$cb_role);
                $cb_role = $current_user->role[0];
        }
        if(file_exists(CONTACT_BK_PLUGIN_DIR ."/views/header.php"))
        {
                include_once CONTACT_BK_PLUGIN_DIR ."/views/header.php";
        }
        if(file_exists(CONTACT_BK_PLUGIN_DIR ."/views/contact_view.php"))
        {
                include_once CONTACT_BK_PLUGIN_DIR ."/views/contact_view.php";
        }
        if(file_exists(CONTACT_BK_PLUGIN_DIR ."/views/footer.php"))
        {
                include_once CONTACT_BK_PLUGIN_DIR ."/views/footer.php";
        }
}


function contact_other_settings()
{
        global $wpdb,$current_user,$cb_user_role_permission;
        if (is_super_admin())
        {
                $cb_role = "administrator";
        }
        else
        {
                $cb_role = $wpdb->prefix . "capabilities";
                $current_user->role = array_keys($current_user->$cb_role);
                $cb_role = $current_user->role[0];
        }
        if(file_exists(CONTACT_BK_PLUGIN_DIR ."/views/header.php"))
        {
                include_once CONTACT_BK_PLUGIN_DIR ."/views/header.php";
        }
        if(file_exists(CONTACT_BK_PLUGIN_DIR ."/views/other-settings.php"))
        {
                include_once CONTACT_BK_PLUGIN_DIR ."/views/other-settings.php";
        }
        if(file_exists(CONTACT_BK_PLUGIN_DIR ."/views/footer.php"))
        {
                include_once CONTACT_BK_PLUGIN_DIR ."/views/footer.php";
        }
}


	function contact_email()
{
        global $wpdb,$current_user,$cb_user_role_permission;
        if (is_super_admin())
        {
                $cb_role = "administrator";
        }
        else
        {
                $cb_role = $wpdb->prefix . "capabilities";
                $current_user->role = array_keys($current_user->$cb_role);
                $cb_role = $current_user->role[0];
        }
        if(file_exists(CONTACT_BK_PLUGIN_DIR ."/views/header.php"))
        {
                include_once CONTACT_BK_PLUGIN_DIR ."/views/header.php";
        }
        if(file_exists(CONTACT_BK_PLUGIN_DIR ."/views/contact_email_settings.php"))
        {
                include_once CONTACT_BK_PLUGIN_DIR ."/views/contact_email_settings.php";
        }
        if(file_exists(CONTACT_BK_PLUGIN_DIR ."/views/footer.php"))
        {
                include_once CONTACT_BK_PLUGIN_DIR ."/views/footer.php";
        }
}


function contact_frontend_data()
{
        global $wpdb,$current_user,$cb_user_role_permission;
        if (is_super_admin())
        {
                $cb_role = "administrator";
        }
        else
        {
                $cb_role = $wpdb->prefix . "capabilities";
                $current_user->role = array_keys($current_user->$cb_role);
                $cb_role = $current_user->role[0];
        }
        if(file_exists(CONTACT_BK_PLUGIN_DIR ."/views/header.php"))
        {
                include_once CONTACT_BK_PLUGIN_DIR ."/views/header.php";
        }
        if(file_exists(CONTACT_BK_PLUGIN_DIR ."/views/contact_frontend_data.php"))
        {
                include_once CONTACT_BK_PLUGIN_DIR ."/views/contact_frontend_data.php";
        }
        if(file_exists(CONTACT_BK_PLUGIN_DIR ."/views/footer.php"))
        {
                include_once CONTACT_BK_PLUGIN_DIR ."/views/footer.php";
        }
}


function add_contact_email_settings()
{
        global $wpdb,$current_user,$cb_user_role_permission;
        if (is_super_admin())
        {
                $cb_role = "administrator";
        }
        else
        {
                $cb_role = $wpdb->prefix . "capabilities";
                $current_user->role = array_keys($current_user->$cb_role);
                $cb_role = $current_user->role[0];
        }
        if(file_exists(CONTACT_BK_PLUGIN_DIR ."/views/header.php"))
        {
                include_once CONTACT_BK_PLUGIN_DIR ."/views/header.php";
        }
        if(file_exists(CONTACT_BK_PLUGIN_DIR ."/views/add_contact_email.php"))
        {
                include_once CONTACT_BK_PLUGIN_DIR ."/views/add_contact_email.php";
        }
        if(file_exists(CONTACT_BK_PLUGIN_DIR ."/views/footer.php"))
        {
                include_once CONTACT_BK_PLUGIN_DIR ."/views/footer.php";
        }
}


function contact_layout_settings()
{
        global $wpdb,$current_user,$cb_user_role_permission;
        if (is_super_admin())
        {
                $cb_role = "administrator";
        }
        else
        {
                $cb_role = $wpdb->prefix . "capabilities";
                $current_user->role = array_keys($current_user->$cb_role);
                $cb_role = $current_user->role[0];
        }
        if(file_exists(CONTACT_BK_PLUGIN_DIR ."/views/header.php"))
        {
                include_once CONTACT_BK_PLUGIN_DIR ."/views/header.php";
        }
        if(file_exists(CONTACT_BK_PLUGIN_DIR ."/views/contact_bank_layout_settings.php"))
        {
                include_once CONTACT_BK_PLUGIN_DIR ."/views/contact_bank_layout_settings.php";
        }
        if(file_exists(CONTACT_BK_PLUGIN_DIR ."/views/footer.php"))
        {
                include_once CONTACT_BK_PLUGIN_DIR ."/views/footer.php";
        }
}

function contact_feature_request()
{
        global $wpdb,$current_user,$user_role_permission;
        if(is_super_admin())
        {
                $cb_role = "administrator";
        }
        else
        {
                $cb_role = $wpdb->prefix . "capabilities";
                $current_user->role = array_keys($current_user->$cb_role);
                $cb_role = $current_user->role[0];
        }
        if(file_exists(CONTACT_BK_PLUGIN_DIR ."/views/header.php"))
        {
                include_once CONTACT_BK_PLUGIN_DIR ."/views/header.php";
        }
        if(file_exists(CONTACT_BK_PLUGIN_DIR ."/views/contact-feedback.php"))
        {
                include_once CONTACT_BK_PLUGIN_DIR ."/views/contact-feedback.php";
        }
        if(file_exists(CONTACT_BK_PLUGIN_DIR ."/views/footer.php"))
        {
                include_once CONTACT_BK_PLUGIN_DIR ."/views/footer.php";
        }
}


function contact_system_status()
{
        global $wpdb,$current_user,$cb_user_role_permission;
        if (is_super_admin())
        {
                $cb_role = "administrator";
        }
        else
        {
                $cb_role = $wpdb->prefix . "capabilities";
                $current_user->role = array_keys($current_user->$cb_role);
                $cb_role = $current_user->role[0];
        }
        if(file_exists(CONTACT_BK_PLUGIN_DIR ."/views/header.php"))
        {
                include_once CONTACT_BK_PLUGIN_DIR ."/views/header.php";
        }
        if(file_exists(CONTACT_BK_PLUGIN_DIR ."/views/contact-bank-system-report.php"))
        {
                include_once CONTACT_BK_PLUGIN_DIR ."/views/contact-bank-system-report.php";
        }
        if(file_exists(CONTACT_BK_PLUGIN_DIR ."/views/footer.php"))
        {
                include_once CONTACT_BK_PLUGIN_DIR ."/views/footer.php";
        }
}


function form_preview()
{
        global $wpdb,$current_user,$cb_user_role_permission;
        if (is_super_admin())
        {
                $cb_role = "administrator";
        }
        else
        {
                $cb_role = $wpdb->prefix . "capabilities";
                $current_user->role = array_keys($current_user->$cb_role);
                $cb_role = $current_user->role[0];
        }
        if(file_exists(CONTACT_BK_PLUGIN_DIR ."/views/header.php"))
        {
                include_once CONTACT_BK_PLUGIN_DIR ."/views/header.php";
        }
        if(file_exists(CONTACT_BK_PLUGIN_DIR ."/views/contact_bank_form_preview.php"))
        {
                include_once CONTACT_BK_PLUGIN_DIR ."/views/contact_bank_form_preview.php";
        }
        if(file_exists(CONTACT_BK_PLUGIN_DIR ."/views/footer.php"))
        {
                include_once CONTACT_BK_PLUGIN_DIR ."/views/footer.php";
        }
}


function contact_pro_version()
{
        global $wpdb,$current_user,$cb_user_role_permission;
        if (is_super_admin())
        {
                $cb_role = "administrator";
        }
        else
        {
                $cb_role = $wpdb->prefix . "capabilities";
                $current_user->role = array_keys($current_user->$cb_role);
                $cb_role = $current_user->role[0];
        }
        if(file_exists(CONTACT_BK_PLUGIN_DIR ."/views/header.php"))
        {
                include_once CONTACT_BK_PLUGIN_DIR ."/views/header.php";
        }
        if(file_exists(CONTACT_BK_PLUGIN_DIR ."/views/purchase_pro_version.php"))
        {
                include_once CONTACT_BK_PLUGIN_DIR ."/views/purchase_pro_version.php";
        }
        if(file_exists(CONTACT_BK_PLUGIN_DIR ."/views/footer.php"))
        {
                include_once CONTACT_BK_PLUGIN_DIR ."/views/footer.php";
        }
}


function contact_bank_recommended_plugins()
{
        global $wpdb,$current_user,$cb_user_role_permission;
        if (is_super_admin())
        {
                $cb_role = "administrator";
        }
        else
        {
                $cb_role = $wpdb->prefix . "capabilities";
                $current_user->role = array_keys($current_user->$cb_role);
                $cb_role = $current_user->role[0];
        }
        if(file_exists(CONTACT_BK_PLUGIN_DIR ."/views/header.php"))
        {
                include_once CONTACT_BK_PLUGIN_DIR ."/views/header.php";
        }
        if(file_exists(CONTACT_BK_PLUGIN_DIR ."/views/recommended-plugins.php"))
        {
                include_once CONTACT_BK_PLUGIN_DIR ."/views/recommended-plugins.php";
        }
        if(file_exists(CONTACT_BK_PLUGIN_DIR ."/views/footer.php"))
        {
                include_once CONTACT_BK_PLUGIN_DIR ."/views/footer.php";
        }
}


function contact_bank_other_services()
{
        global $wpdb,$current_user,$cb_user_role_permission;
        if (is_super_admin())
        {
                $cb_role = "administrator";
        }
        else
        {
                $cb_role = $wpdb->prefix . "capabilities";
                $current_user->role = array_keys($current_user->$cb_role);
                $cb_role = $current_user->role[0];
        }
        if(file_exists(CONTACT_BK_PLUGIN_DIR ."/views/header.php"))
        {
                include_once CONTACT_BK_PLUGIN_DIR ."/views/header.php";
        }
        if(file_exists(CONTACT_BK_PLUGIN_DIR ."/views/other-services.php"))
        {
                include_once CONTACT_BK_PLUGIN_DIR ."/views/other-services.php";
        }
        if(file_exists(CONTACT_BK_PLUGIN_DIR ."/views/footer.php"))
        {
                include_once CONTACT_BK_PLUGIN_DIR ."/views/footer.php";
        }
}

function contact_short_code()
{
        global $wpdb,$current_user,$cb_user_role_permission;
        if (is_super_admin())
        {
                $cb_role = "administrator";
        }
        else
        {
                $cb_role = $wpdb->prefix . "capabilities";
                $current_user->role = array_keys($current_user->$cb_role);
                $cb_role = $current_user->role[0];
        }
        if(file_exists(CONTACT_BK_PLUGIN_DIR ."/views/header.php"))
        {
                include_once CONTACT_BK_PLUGIN_DIR ."/views/header.php";
        }
        if(file_exists(CONTACT_BK_PLUGIN_DIR ."/views/shortcode.php"))
        {
                include_once CONTACT_BK_PLUGIN_DIR ."/views/shortcode.php";
        }
        if(file_exists(CONTACT_BK_PLUGIN_DIR ."/views/footer.php"))
        {
                include_once CONTACT_BK_PLUGIN_DIR ."/views/footer.php";
        }
}

function backend_plugin_js_scripts_contact_bank()
{
        wp_enqueue_script("jquery");
        wp_enqueue_script("jquery-ui-sortable");
        wp_enqueue_script("jquery-ui-droppable");
        wp_enqueue_script("jquery-ui-draggable");
        wp_enqueue_script("farbtastic");
        wp_enqueue_script("jquery-ui-dialog");
        wp_enqueue_script("jquery.Tooltip.js", plugins_url("/assets/js/jquery.Tooltip.js",__FILE__));
        wp_enqueue_script("jquery.dataTables.min", plugins_url("/assets/js/jquery.dataTables.min.js",__FILE__));
        wp_enqueue_script("jquery.validate.min", plugins_url("/assets/js/jquery.validate.min.js",__FILE__));
        wp_enqueue_script("bootstrap.js", plugins_url("/assets/js/bootstrap.js",__FILE__));
        wp_enqueue_script("jquery.prettyPhoto.js", plugins_url("/assets/js/jquery.prettyPhoto.js",__FILE__));
}


function frontend_plugin_js_scripts_contact_bank()
{
        wp_enqueue_script("jquery");
        wp_enqueue_script("jquery.Tooltip.js", plugins_url("/assets/js/jquery.Tooltip.js",__FILE__));
        wp_enqueue_script("jquery.validate.min", plugins_url("/assets/js/jquery.validate.min.js",__FILE__));
}


function backend_plugin_css_styles_contact_bank()
{
        wp_enqueue_style("farbtastic");
        wp_enqueue_style("wp-jquery-ui-dialog");
        wp_enqueue_style("stylesheet", plugins_url("/assets/css/stylesheet.css",__FILE__));
        wp_enqueue_style("simple-line-icon", plugins_url("/assets/css/icons/icons.css",__FILE__));
        wp_enqueue_style("system-message", plugins_url("/assets/css/system-message.css",__FILE__));
        wp_enqueue_style("prettyPhoto", plugins_url("/assets/css/prettyPhoto.css",__FILE__));
        wp_enqueue_style("premium-edition.css", plugins_url("/assets/css/premium-edition.css",__FILE__));
        wp_enqueue_style("responsive.css", plugins_url("/assets/css/responsive.css",__FILE__));
        wp_enqueue_style("google-fonts-roboto", "//fonts.googleapis.com/css?family=Roboto Condensed:300|Roboto Condensed:300|Roboto Condensed:300|Roboto Condensed:regular|Roboto Condensed:300");
}


function frontend_plugin_css_styles_contact_bank()
{
        wp_enqueue_style("stylesheet", plugins_url("/assets/css/stylesheet.css",__FILE__));
        wp_enqueue_style("system-message", plugins_url("/assets/css/system-message.css",__FILE__));
}

if(isset($_REQUEST["action"]))
{
	switch(esc_attr($_REQUEST["action"]))
	{
		case "add_contact_form_library":
			add_action( "admin_init", "add_contact_form_library");
			
                        function add_contact_form_library()
                        {
                                global $wpdb,$current_user,$cb_user_role_permission;
                                if (is_super_admin())
                                {
                                        $cb_role = "administrator";
                                }
                                else
                                {
                                        $cb_role = $wpdb->prefix . "capabilities";
                                        $current_user->role = array_keys($current_user->$cb_role);
                                        $cb_role = $current_user->role[0];
                                }
                                if(file_exists(CONTACT_BK_PLUGIN_DIR ."/lib/contact_view-class.php"))
                                {
                                        include_once CONTACT_BK_PLUGIN_DIR . "/lib/contact_view-class.php";
                                }
                        }
			

		break;

		case "frontend_contact_form_library":

			add_action( "admin_init", "frontend_contact_form_library");
			
                        function frontend_contact_form_library()
                        {
                                if(file_exists(CONTACT_BK_PLUGIN_DIR ."/lib/contact_bank_frontend-class.php"))
                                {
                                        include_once CONTACT_BK_PLUGIN_DIR . "/lib/contact_bank_frontend-class.php";
                                }
                        }
			
		break;

		case "email_contact_form_library":

			add_action( "admin_init", "email_contact_form_library");
			
                        function email_contact_form_library()
                        {
                                global $wpdb,$current_user,$cb_user_role_permission;
                                if (is_super_admin())
                                {
                                        $cb_role = "administrator";
                                }
                                else
                                {
                                        $cb_role = $wpdb->prefix . "capabilities";
                                        $current_user->role = array_keys($current_user->$cb_role);
                                        $cb_role = $current_user->role[0];
                                }
                                if(file_exists(CONTACT_BK_PLUGIN_DIR ."/lib/contact_bank_email-class.php"))
                                {
                                        include_once CONTACT_BK_PLUGIN_DIR . "/lib/contact_bank_email-class.php";
                                }
                        }
			

		break;

		case "email_management_contact_form_library":

			add_action( "admin_init", "email_management_contact_form_library");
			
                        function email_management_contact_form_library()
                        {
                                if(file_exists(CONTACT_BK_PLUGIN_DIR ."/lib/contact_bank_email_management.php"))
                                {
                                        include_once CONTACT_BK_PLUGIN_DIR . "/lib/contact_bank_email_management.php";
                                }
                        }
			

		break;

		case "frontend_data_contact_library":

			add_action( "admin_init", "frontend_data_contact_library");
			
                        function frontend_data_contact_library()
                        {
                                global $wpdb,$current_user,$cb_user_role_permission;
                                if (is_super_admin())
                                {
                                        $cb_role = "administrator";
                                }
                                else
                                {
                                        $cb_role = $wpdb->prefix . "capabilities";
                                        $current_user->role = array_keys($current_user->$cb_role);
                                        $cb_role = $current_user->role[0];
                                }
                                if(file_exists(CONTACT_BK_PLUGIN_DIR ."/lib/contact_frontend_data_class.php"))
                                {
                                        include CONTACT_BK_PLUGIN_DIR . "/lib/contact_frontend_data_class.php";
                                }
                        }
			
		break;

		case "show_form_control_data_contact_library":

			add_action( "admin_init", "show_form_control_data_contact_library");
			
                        function show_form_control_data_contact_library()
                        {
                                global $wpdb,$current_user,$cb_user_role_permission;
                                if (is_super_admin())
                                {
                                        $cb_role = "administrator";
                                }
                                else
                                {
                                        $cb_role = $wpdb->prefix . "capabilities";
                                        $current_user->role = array_keys($current_user->$cb_role);
                                        $cb_role = $current_user->role[0];
                                }
                                if(file_exists(CONTACT_BK_PLUGIN_DIR ."/lib/contact_bank_show_form_control_data-class.php"))
                                {
                                        include CONTACT_BK_PLUGIN_DIR . "/lib/contact_bank_show_form_control_data-class.php";
                                }
                        }
			
		break;

		case "layout_settings_contact_library":

			add_action( "admin_init", "layout_settings_contact_library");
                    
                        function layout_settings_contact_library()
                        {
                                global $wpdb,$current_user,$cb_user_role_permission;
                                if (is_super_admin())
                                {
                                        $cb_role = "administrator";
                                }
                                else
                                {
                                        $cb_role = $wpdb->prefix . "capabilities";
                                        $current_user->role = array_keys($current_user->$cb_role);
                                        $cb_role = $current_user->role[0];
                                }
                                if(file_exists(CONTACT_BK_PLUGIN_DIR ."/lib/contact_bank_layout_settings-class.php"))
                                {
                                        include CONTACT_BK_PLUGIN_DIR . "/lib/contact_bank_layout_settings-class.php";
                                }
                        }
			
		break;
	}
}
/*
 * Description : THESE FUNCTIONS USED FOR REPLACING TABLE NAMES
 * Created in Version 1.0
 * Last Modified : 1.0
 * Reasons for change : None
 */
function contact_bank_contact_form()
{
        global $wpdb;
        return $wpdb->prefix . "cb_contact_form";
}


function contact_bank_dynamic_settings_form()
{
    global $wpdb;
    return $wpdb->prefix . "cb_dynamic_settings";
}

function create_control_Table()
{
    global $wpdb;
    return $wpdb->prefix . "cb_create_control_form";
}

function frontend_controls_data_Table()
{
    global $wpdb;
    return $wpdb->prefix . "cb_frontend_data_table";
}

function contact_bank_email_template_admin()
{
        global $wpdb;
        return $wpdb->prefix . "cb_email_template_admin";
}

function contact_bank_frontend_forms_Table()
{
        global $wpdb;
        return $wpdb->prefix . "cb_frontend_forms_table";
}

function contact_bank_form_settings_Table()
{
    global $wpdb;
    return $wpdb->prefix . "cb_form_settings_table";
}

function contact_bank_layout_settings_Table()
{
    global $wpdb;
    return $wpdb->prefix . "cb_layout_settings_table";
}

function contact_bank_licensing()
{
    global $wpdb;
    return $wpdb->prefix . "cb_licensing";
}

function contact_bank_roles_capability()
{
    global $wpdb;
    return $wpdb->prefix . "cb_roles_capability";
}

function contact_bank_short_code($atts)
{
    extract(shortcode_atts(array(
        "form_id" => "",
        "show_title" => "",
        "show_desc" => "",
    ), $atts));
    if(!is_feed())
    {
        return extract_short_code($form_id,$show_title,$show_desc);
    }
}

function extract_short_code($form_id,$show_title,$show_desc)
{
        ob_start();
        require CONTACT_BK_PLUGIN_DIR."/frontend_views/contact_bank_forms.php";
        $contact_bank_output = ob_get_clean();
        wp_reset_query();
        return $contact_bank_output;
}

function add_contact_bank_icon($meta = TRUE)
{
        if (!is_user_logged_in() )
        {
                return;
        }
        else
        {
                global $wp_admin_bar,$wpdb,$current_user;
                if (is_super_admin())
                {
                        $cb_role = "administrator";
                }
                else
                {
                        $cb_role = $wpdb->prefix . "capabilities";
                        $current_user->role = array_keys($current_user->$cb_role);
                        $cb_role = $current_user->role[0];
                }

                switch ($cb_role)
                {
                        case "administrator":
                        $wp_admin_bar->add_menu( array(
                        "id" => "contact_bank_links",
                        "title" =>  "<img src=\"".plugins_url("/assets/images/icon.png",__FILE__)."\" width=\"25\" height=\"25\" style=\"vertical-align:text-top; margin-right:5px;\" />Contact Bank" ,
                        "href" => site_url() ."/wp-admin/admin.php?page=contact_dashboard",
                        ));
                        $wp_admin_bar->add_menu( array(
                                        "parent" => "contact_bank_links",
                                        "id"     => "cb_dashboard_links",
                                        "href"  => site_url() ."/wp-admin/admin.php?page=contact_dashboard",
                                        "title" => __( "Dashboard", "contact-bank") )         /* set the sub-menu name */
                        );
                        $wp_admin_bar->add_menu( array(
                                        "parent" => "contact_bank_links",
                                        "id"     => "other_settings_links",
                                        "href"  => site_url() ."/wp-admin/admin.php?page=contact_other_settings",
                                        "title" => __( "Other Settings", "contact-bank"))         /* set the sub-menu name */
                        );
                        $wp_admin_bar->add_menu( array(
                                        "parent" => "contact_bank_links",
                                        "id"     => "short_code_links",
                                        "href"  => site_url() ."/wp-admin/admin.php?page=contact_short_code",
                                        "title" => __( "Short-Codes", "contact-bank"))         /* set the sub-menu name */
                        );
                        $wp_admin_bar->add_menu( array(
                                        "parent" => "contact_bank_links",
                                        "id"     => "frontend_data_links",
                                        "href"  => site_url() ."/wp-admin/admin.php?page=contact_frontend_data",
                                        "title" => __( "Form Entries", "contact-bank"))         /* set the sub-menu name */
                        );
                        $wp_admin_bar->add_menu( array(
                                        "parent" => "contact_bank_links",
                                        "id"     => "email_links",
                                        "href"  => site_url() ."/wp-admin/admin.php?page=contact_email",
                                        "title" => __( "Email Settings", "contact-bank") )         /* set the sub-menu name */
                        );
                        $wp_admin_bar->add_menu( array(
                                        "parent" => "contact_bank_links",
                                        "id"     => "form_settings_data_links",
                                        "href"  => site_url() ."/wp-admin/admin.php?page=contact_layout_settings",
                                        "title" => __( "Global Settings", "contact-bank"))         /* set the sub-menu name */
                        );
                        $wp_admin_bar->add_menu( array(
                                        "parent" => "contact_bank_links",
                                        "id"     => "feature_request_data_links",
                                        "href"  => site_url() ."/wp-admin/admin.php?page=contact_feature_request",
                                        "title" => __( "Feature Requests", "contact-bank"))         /* set the sub-menu name */
                        );
                        $wp_admin_bar->add_menu( array(
                                        "parent" => "contact_bank_links",
                                        "id"     => "system_status_data_links",
                                        "href"  => site_url() ."/wp-admin/admin.php?page=contact_system_status",
                                        "title" => __( "System Status", "contact-bank"))         /* set the sub-menu name */
                        );
                        $wp_admin_bar->add_menu(array(
                                        "parent" => "contact_bank_links",
                                        "id" => "contact_bank_recommended_plugins_links",
                                        "href" => site_url() . "/wp-admin/admin.php?page=contact_bank_recommended_plugins",
                                        "title" => __("Recommendations", "contact-bank"))
                        );

                        $wp_admin_bar->add_menu(array(
                                        "parent" => "contact_bank_links",
                                        "id" => "pro_version_links",
                                        "href" => site_url() . "/wp-admin/admin.php?page=contact_pro_version",
                                        "title" => __("Premium Editions", "contact-bank"))
                        );

                        $wp_admin_bar->add_menu(array(
                                        "parent" => "contact_bank_links",
                                        "id" => "contact_bank_other_services_links",
                                        "href" => site_url() . "/wp-admin/admin.php?page=contact_bank_other_services",
                                        "title" => __("Our Other Services", "contact-bank"))
                        );
                        break;

                        case "editor":
                        $wp_admin_bar->add_menu( array(
                                "id" => "contact_bank_links",
                                "title" =>  "<img src=\"".plugins_url("/assets/images/icon.png",__FILE__)."\" width=\"25\" height=\"25\" style=\"vertical-align:text-top; margin-right:5px;\" />Contact Bank" ,
                                "href" => site_url() ."/wp-admin/admin.php?page=contact_dashboard",
                        ));

                        $wp_admin_bar->add_menu( array(
                                "parent" => "contact_bank_links",
                                "id"     => "dashboard_links",
                                "href"  => site_url() ."/wp-admin/admin.php?page=contact_dashboard",
                                "title" => __( "Dashboard", "contact-bank") )         /* set the sub-menu name */
                        );
                        $wp_admin_bar->add_menu( array(
                                "parent" => "contact_bank_links",
                                "id"     => "other_settings_links",
                                "href"  => site_url() ."/wp-admin/admin.php?page=contact_other_settings",
                                "title" => __( "Other Settings", "contact-bank"))         /* set the sub-menu name */
                        );
                        $wp_admin_bar->add_menu( array(
                                "parent" => "contact_bank_links",
                                "id"     => "short_code_links",
                                "href"  => site_url() ."/wp-admin/admin.php?page=contact_short_code",
                                "title" => __( "Short-Codes", "contact-bank"))         /* set the sub-menu name */
                        );
                        $wp_admin_bar->add_menu( array(
                                "parent" => "contact_bank_links",
                                "id"     => "frontend_data_links",
                                "href"  => site_url() ."/wp-admin/admin.php?page=contact_frontend_data",
                                "title" => __( "Form Entries", "contact-bank"))         /* set the sub-menu name */
                        );
                        $wp_admin_bar->add_menu( array(
                                "parent" => "contact_bank_links",
                                "id"     => "email_links",
                                "href"  => site_url() ."/wp-admin/admin.php?page=contact_email",
                                "title" => __( "Email Settings", "contact-bank") )         /* set the sub-menu name */
                        );
                        $wp_admin_bar->add_menu( array(
                                "parent" => "contact_bank_links",
                                "id"     => "form_settings_data_links",
                                "href"  => site_url() ."/wp-admin/admin.php?page=contact_layout_settings",
                                "title" => __( "Global Settings", "contact-bank"))         /* set the sub-menu name */
                        );
                        $wp_admin_bar->add_menu( array(
                                "parent" => "contact_bank_links",
                                "id"     => "feature_request_data_links",
                                "href"  => site_url() ."/wp-admin/admin.php?page=contact_feature_request",
                                "title" => __( "Feature Requests", "contact-bank"))         /* set the sub-menu name */
                        );

                        $wp_admin_bar->add_menu( array(
                                "parent" => "contact_bank_links",
                                "id"     => "system_status_data_links",
                                "href"  => site_url() ."/wp-admin/admin.php?page=contact_system_status",
                                "title" => __( "System Status", "contact-bank"))         /* set the sub-menu name */
                        );
                        $wp_admin_bar->add_menu(array(
                                "parent" => "contact_bank_links",
                                "id" => "contact_bank_recommended_plugins_links",
                                "href" => site_url() . "/wp-admin/admin.php?page=contact_bank_recommended_plugins",
                                "title" => __("Recommendations", "contact-bank"))
                        );

                        $wp_admin_bar->add_menu(array(
                                "parent" => "contact_bank_links",
                                "id" => "pro_version_links",
                                "href" => site_url() . "/wp-admin/admin.php?page=contact_pro_version",
                                "title" => __("Premium Editions", "contact-bank"))
                        );

                        $wp_admin_bar->add_menu(array(
                                "parent" => "contact_bank_links",
                                "id" => "contact_bank_other_services_links",
                                "href" => site_url() . "/wp-admin/admin.php?page=contact_bank_other_services",
                                "title" => __("Our Other Services", "contact-bank"))
                        );
                        break;

                        case "author":
                        $wp_admin_bar->add_menu( array(
                                "id" => "contact_bank_links",
                                "title" =>  "<img src=\"".plugins_url("/assets/images/icon.png",__FILE__)."\" width=\"25\" height=\"25\" style=\"vertical-align:text-top; margin-right:5px;\" />Contact Bank" ,
                                "href" => site_url() ."/wp-admin/admin.php?page=contact_dashboard",
                        ));
                        $wp_admin_bar->add_menu( array(
                                "parent" => "contact_bank_links",
                                "id"     => "dashboard_links",
                                "href"  => site_url() ."/wp-admin/admin.php?page=contact_dashboard",
                                "title" => __( "Dashboard", "contact-bank") )         /* set the sub-menu name */
                        );
                        $wp_admin_bar->add_menu( array(
                                "parent" => "contact_bank_links",
                                "id"     => "other_settings_links",
                                "href"  => site_url() ."/wp-admin/admin.php?page=contact_other_settings",
                                "title" => __( "Other Settings", "contact-bank"))         /* set the sub-menu name */
                        );
                        $wp_admin_bar->add_menu( array(
                                "parent" => "contact_bank_links",
                                "id"     => "short_code_links",
                                "href"  => site_url() ."/wp-admin/admin.php?page=contact_short_code",
                                "title" => __( "Short-Codes", "contact-bank"))         /* set the sub-menu name */
                        );
                        $wp_admin_bar->add_menu( array(
                                "parent" => "contact_bank_links",
                                "id"     => "frontend_data_links",
                                "href"  => site_url() ."/wp-admin/admin.php?page=contact_frontend_data",
                                "title" => __( "Form Entries", "contact-bank"))         /* set the sub-menu name */
                        );
                        $wp_admin_bar->add_menu( array(
                                "parent" => "contact_bank_links",
                                "id"     => "email_links",
                                "href"  => site_url() ."/wp-admin/admin.php?page=contact_email",
                                "title" => __( "Email Settings", "contact-bank") )         /* set the sub-menu name */
                        );
                        $wp_admin_bar->add_menu( array(
                                "parent" => "contact_bank_links",
                                "id"     => "form_settings_data_links",
                                "href"  => site_url() ."/wp-admin/admin.php?page=contact_layout_settings",
                                "title" => __( "Global Settings", "contact-bank"))         /* set the sub-menu name */
                        );
                        $wp_admin_bar->add_menu( array(
                                "parent" => "contact_bank_links",
                                "id"     => "feature_request_data_links",
                                "href"  => site_url() ."/wp-admin/admin.php?page=contact_feature_request",
                                "title" => __( "Feature Requests", "contact-bank"))         /* set the sub-menu name */
                        );
                        $wp_admin_bar->add_menu(array(
                                "parent" => "contact_bank_links",
                                "id" => "contact_bank_recommended_plugins_links",
                                "href" => site_url() . "/wp-admin/admin.php?page=contact_bank_recommended_plugins",
                                "title" => __("Recommendations", "contact-bank"))
                        );

                        $wp_admin_bar->add_menu(array(
                                "parent" => "contact_bank_links",
                                "id" => "pro_version_links",
                                "href" => site_url() . "/wp-admin/admin.php?page=contact_pro_version",
                                "title" => __("Premium Editions", "contact-bank"))
                        );

                        $wp_admin_bar->add_menu(array(
                                "parent" => "contact_bank_links",
                                "id" => "contact_bank_other_services_links",
                                "href" => site_url() . "/wp-admin/admin.php?page=contact_bank_other_services",
                                "title" => __("Our Other Services", "contact-bank"))
                        );
                        break;
                }
        }
}

add_action( "media_buttons_context", "add_contact_shortcode_button", 1);

function add_contact_shortcode_button($context)
{
        add_thickbox();
        $context .= "<a href=\"#TB_inline?width=300&height=400&inlineId=contact-bank\"  class=\"button thickbox\"  title=\"" . __("Add Contact Bank Form", "contact-bank") . "\">
        <span class=\"contact_icon\"></span> Add Contact Bank Form</a>";
        return $context;
}

add_action("admin_footer","add_contact_mce_popup");


function add_contact_mce_popup()
{
        ?>
        <?php add_thickbox(); ?>
        <div id="contact-bank" style="display:none;">
                <div class="fluid-layout responsive">
                        <div style="padding:20px 0 10px 15px;">
                        <h3 class="label-shortcode"><?php _e("Insert Contact Bank Form", "contact-bank"); ?></h3>
                                <span>
                                        <i><?php _e("Select a form below to add it to your post or page.", "contact-bank"); ?></i>
                                </span>
                        </div>
                        <div class="layout-span12 responsive" style="padding:15px 15px 0 0;">
                                <div class="layout-control-group">
                                        <label class="custom-layout-label" for="ux_form_name"><?php _e("Form Name", "contact-bank"); ?> : </label>
                                        <select id="add_contact_form_id" class="layout-span9">
                                                <option value="0"><?php _e("Select a Form", "contact-bank"); ?>  </option>
                                                <?php
                                                global $wpdb;
                                                $forms = $wpdb->get_results
                                                (
                                                        "SELECT * FROM " .contact_bank_contact_form()
                                                );
                                                for($flag = 0;$flag<count($forms);$flag++)
                                                {
                                                        ?>
                                                        <option value="<?php echo intval($forms[$flag]->form_id); ?>"><?php echo esc_html($forms[$flag]->form_name) ?></option>
                                                <?php
                                                }
                                                ?>
                                        </select>
                                </div>
                                <div class="layout-control-group">
                                        <label class="custom-layout-label"><?php _e("Show Form Title", "contact-bank"); ?> : </label>
                                        <input type="checkbox" checked="checked" name="ux_form_title" id="ux_form_title"/>
                                </div>
                                <div class="layout-control-group">
                                        <label class="custom-layout-label"><?php _e("Show Form Description", "contact-bank"); ?> : </label>
                                        <input type="checkbox"  name="ux_form_desc" id="ux_form_desc"/>
                                </div>
                                <div class="layout-control-group">
                                        <label class="custom-layout-label"></label>
                                        <input type="button" class="button-primary" value="<?php _e("Insert Form", "contact-bank"); ?>"
                                                onclick="Insert_Contact_Form();"/>&nbsp;&nbsp;&nbsp;
                                        <a class="button" style="color:#bbb;" href="#"
                                                onclick="tb_remove(); return false;"><?php _e("Cancel", "contact-bank"); ?></a>
                                </div>
                        </div>
                </div>
        </div>
        <script type="text/javascript">
                function Insert_Contact_Form()
                {
                        var form_id = jQuery("#add_contact_form_id").val();
                        var show_title = jQuery("#ux_form_title").prop("checked");
                        var show_desc = jQuery("#ux_form_desc").prop("checked");
                        if(form_id == 0)
                        {
                        alert("<?php _e("Please choose a Form to insert into Shortcode", "contact-bank") ?>");
                        return;
                        }
                        window.send_to_editor("[contact_bank form_id=" + form_id + " show_title=" + show_title +" show_desc=" + show_desc +"]");
                }
        </script>
<?php
}

function plugin_load_textdomain_contact_bank()
{
        load_plugin_textdomain("contact-bank", false, CONTACT_BK_PLUGIN_DIRNAME ."/languages");
}

add_action("plugins_loaded", "plugin_load_textdomain_contact_bank");
$version = get_option("contact-bank-version-number");
if (is_admin() && !request_is_frontend_ajax())
{
	if($version != "")
	{
		add_action("admin_init", "plugin_install_script_for_contact_bank");
	}
}

function contact_bank_plugin_row($links,$file)
{
        if ($file == CONTACT_BK_PLUGIN_BASENAME)
        {
                $cpo_row_meta = array(
                        "docs"  => "<a href='".esc_url( apply_filters("contact_bank_docs_url","http://tech-banker.com/products/wp-contact-bank/knowledge-base/"))."' title='".esc_attr(__( "View Contact Bank Documentation","contact-bank"))."'>".__("Docs","contact-bank")."</a>",
                        "gopremium" => "<a href='" .esc_url( apply_filters("contact_bank_premium_editions_url", "http://tech-banker.com/products/wp-contact-bank/pricing/"))."' title='".esc_attr(__( "View Contact Bank Premium Editions","contact-bank"))."'>".__("Go for Premium!","contact-bank")."</a>",
                );
                return array_merge($links,$cpo_row_meta);
        }
        return (array)$links;
}


function request_is_frontend_ajax()
{
        $script_filename = isset($_SERVER['SCRIPT_FILENAME']) ? $_SERVER['SCRIPT_FILENAME'] : '';
        //Try to figure out if frontend AJAX request... If we are DOING_AJAX; let's look closer
        if((defined('DOING_AJAX') && DOING_AJAX))
        {
                //From wp-includes/functions.php, wp_get_referer() function.
                //Required to fix: https://core.trac.wordpress.org/ticket/25294
                $ref = '';
                if ( ! empty( $_REQUEST['_wp_http_referer'] ) )
                        $ref = wp_unslash( $_REQUEST['_wp_http_referer'] );
                elseif ( ! empty( $_SERVER['HTTP_REFERER'] ) )
                $ref = wp_unslash( $_SERVER['HTTP_REFERER'] );
                //If referer does not contain admin URL and we are using the admin-ajax.php endpoint, this is likely a frontend AJAX request
                if(((strpos($ref, admin_url()) === false) && (basename($script_filename) === 'admin-ajax.php')))
                        return true;
        }
        //If no checks triggered, we end up here - not an AJAX request.
        return false;
}


add_filter("plugin_row_meta","contact_bank_plugin_row", 10, 2 );
/*************************************************************************************/
add_action("admin_bar_menu", "add_contact_bank_icon",100);
// add_action Hook called for function frontend_plugin_css_scripts_contact_bank
add_action("init","frontend_plugin_css_styles_contact_bank");
// add_action Hook called for function backend_plugin_css_scripts_contact_bank
add_action("admin_init","backend_plugin_css_styles_contact_bank");
// add_action Hook called for function frontend_plugin_js_scripts_contact_bank
add_action("init","frontend_plugin_js_scripts_contact_bank");
// add_action Hook called for function backend_plugin_js_scripts_contact_bank
add_action("admin_init","backend_plugin_js_scripts_contact_bank");
// add_action Hook called for function create_global_menus_for_contact_bank
add_action("admin_menu","create_global_menus_for_contact_bank");
// Activation Hook called for function plugin_install_script_for_contact_bank
register_activation_hook(__FILE__,"plugin_install_script_for_contact_bank");
// add_Shortcode Hook called for function contact_bank_short_code for FrontEnd
add_shortcode("contact_bank", "contact_bank_short_code");
// Deactivation Hook called for function deactivation_function_for_contact_bank
register_deactivation_hook(__FILE__,"deactivation_function_for_contact_bank");

add_action( "network_admin_menu", "create_global_menus_for_contact_bank" );

add_filter("widget_text", "do_shortcode");

class Contact_Bank_Widget extends WP_Widget
{
        function __construct()
        {
                parent::__construct(
                        "Contact_Bank_Widget", // Base ID
                        __("Contact Bank Widget", "contact_bank"), // Name
                        array( "description" => __( "Build Complex, Powerful Contact Forms in Just Seconds.", "contact_bank" ), ) // Args
                );
        }

        function form($instance)
        {
                $instance = wp_parse_args((array) $instance, array( "title" => "", "form_id" => "0" ) );
                $title = $instance["title"];
                global $wpdb;
                $form_data = $wpdb->get_results
                (
                                "SELECT * FROM " .contact_bank_contact_form()
                );
                ?>
                <p><label for="<?php echo $this->get_field_id("title"); ?>"> Widget Title: <input class="widefat" id="<?php echo $this->get_field_id("title"); ?>" name="<?php echo $this->get_field_name("title"); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
                <p><label for="<?php echo $this->get_field_id("form_id"); ?>"><?php _e("Select Form :", "contact-bank"); ?></label>
                        <select size="1" name="<?php echo $this->get_field_name("form_id"); ?>" id="<?php echo $this->get_field_id("form_id"); ?>" class="widefat">
                                <option value="0"  ><?php _e("Select Form", "contact-bank"); ?></option>
                                <?php
                                if($form_data)
                                {
                                        foreach($form_data as $form)
                                        {
                                                echo "<option value=\"" . $form->form_id . "\"";
                                                if ($form->form_id == $instance["form_id"])
                                                echo "selected=\"selected\"";
                                                echo ">" . stripslashes(html_entity_decode($form->form_name)) . "</option>" . "\n\t";
                                        }
                                }
                                ?>
                        </select>
                </p>
                <?php
        }
        function update($new_instance, $old_instance)
        {
                $instance = $old_instance;
                $instance["title"] = $new_instance["title"];
                $instance["form_id"] = (int) $new_instance["form_id"];
                return $instance;
        }
        function widget($args, $instance)
        {
                global $wpdb;
                $form_data = $wpdb->get_var
                (
                        $wpdb->prepare
                        (
                                "SELECT count(*) FROM " .contact_bank_contact_form() . " WHERE form_id = %d",
                                $instance["form_id"]
                        )
                );

                extract($args, EXTR_SKIP);
                echo $before_widget;
                $title = empty($instance["title"]) ? " " : apply_filters("widget_title", $instance["title"]);
                if($form_data > 0)
                {
                        if($instance["form_id"] != 0)
                        {
                                echo $before_title . $title . $after_title;
                                $shortcode_for_contact_bank_form = "[contact_bank form_id=" . $instance["form_id"] . " ]";
                                echo do_shortcode( $shortcode_for_contact_bank_form );
                                echo $after_widget;
                        }
                }
        }
}
add_action( "widgets_init", create_function("", "return register_widget(\"Contact_Bank_Widget\");"));
?>
