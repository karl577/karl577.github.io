<?php
/*
Plugin Name: Stat Counter
Plugin URI: http://seo.uk.net/stat-counter/
Description: Stat Counter Widget can show to your users how much traffic you have, it counts online users, pageviews, unique hits and more! 
Author: Seo UK Team
Version: 2.1
Author URI: http://seo.uk.net
*/

function traffic_counter_control() {

  $options = get_sc_options();

  if ($_POST['wp_sc_Submit']){

    $options['wp_sc_WidgetTitle'] = htmlspecialchars($_POST['wp_sc_WidgetTitle']);
    $options['wp_sc_sctext_Visitors'] = htmlspecialchars($_POST['wp_sc_sctext_Visitors']);
    $options['wp_sc_sctext_LastDay'] = htmlspecialchars($_POST['wp_sc_sctext_LastDay']);
    $options['wp_sc_sctext_LastWeek'] = htmlspecialchars($_POST['wp_sc_sctext_LastWeek']);
    $options['wp_sc_sctext_LastMonth'] = htmlspecialchars($_POST['wp_sc_sctext_LastMonth']);
    $options['wp_sc_sctext_Online'] = htmlspecialchars($_POST['wp_sc_sctext_Online']);
    $options['wp_sc_sctext_log_opt'] = htmlspecialchars($_POST['wp_sc_sctext_log_opt']);
    $options['wp_sc_sctext_bots_filter'] = htmlspecialchars($_POST['wp_sc_sctext_bots_filter']);
    $options['wp_sc_sctext_Hits'] = htmlspecialchars($_POST['wp_sc_sctext_Hits']);
    $options['wp_sc_sctext_Unique'] = htmlspecialchars($_POST['wp_sc_sctext_Unique']);
    $options['wp_sc_sctext_Default_Tab'] = htmlspecialchars($_POST['wp_sc_sctext_Default_Tab']);
    $options['wp_sc_sctext_wlink'] = htmlspecialchars($_POST['wp_sc_sctext_wlink']);
    update_option("widget_traffic_counter", $options); 

}
?>
  <p>Do you need help with SEO?. Visit our website <a href="http://seo.uk.net" title="Link will open in a new window" target="_blank">www.seo.uk.net</a> for more information.</p>
  <p><strong>Use options below to translate english labels</strong></p>
  <p>
    <label for="wp_sc_WidgetTitle">Text Title: </label>
    <input type="text" id="wp_sc_WidgetTitle" name="wp_sc_WidgetTitle" value="<?php echo ($options['wp_sc_WidgetTitle'] =="" ? "Traffic Stats" : $options['wp_sc_WidgetTitle']); ?>" />
  </p>
  <p>
    <label for="wp_sc_sctext_Visitors">Text Page Views : </label>
    <input type="text" id="wp_sc_sctext_Visitors" name="wp_sc_sctext_Visitors" value="<?php echo ($options['wp_sc_sctext_Visitors'] =="" ? "Pages" : $options['wp_sc_sctext_Visitors']); ?>" />
  </p>
  <p>
    <label for="wp_sc_sctext_Hits">Text Hits: </label>
    <input type="text" id="wp_sc_sctext_Hits" name="wp_sc_sctext_Hits" value="<?php echo ($options['wp_sc_sctext_Hits'] =="" ? "Hits" : $options['wp_sc_sctext_Hits']); ?>" />
  </p>
  <p>
    <label for="wp_sc_sctext_Unique">Text Unique: </label>
    <input type="text" id="wp_sc_sctext_Unique" name="wp_sc_sctext_Unique" value="<?php echo ($options['wp_sc_sctext_Unique'] =="" ? "Unique" : $options['wp_sc_sctext_Unique']); ?>" />
  </p>
  <p>
    <label for="wp_sc_sctext_LastDay">Text Last 24 Hours: </label>:
    <input type="text" id="wp_sc_sctext_LastDay" name="wp_sc_sctext_LastDay" value="<?php echo ($options['wp_sc_sctext_LastDay'] =="" ? "Last 24 hours" : $options['wp_sc_sctext_LastDay']); ?>" />
  </p>
  <p>
    <label for="wp_sc_sctext_LastWeek">Text Last 7 Days: </label>:
    <input type="text" id="wp_sc_sctext_LastWeek" name="wp_sc_sctext_LastWeek" value="<?php echo ($options['wp_sc_sctext_LastWeek'] =="" ? "Last 7 days" : $options['wp_sc_sctext_LastWeek']); ?>" />
  </p>
  <p>
    <label for="wp_sc_sctext_LastMonth">Text Last 30 Days: </label>:
    <input type="text" id="wp_sc_sctext_LastMonth" name="wp_sc_sctext_LastMonth" value="<?php echo ($options['wp_sc_sctext_LastMonth'] =="" ? "Last 30 days" : $options['wp_sc_sctext_LastMonth']); ?>" />
  </p>
  <p>
    <label for="wp_sc_sctext_Online">Text Online Now: </label>:
    <input type="text" id="wp_sc_sctext_Online" name="wp_sc_sctext_Online" value="<?php echo ($options['wp_sc_sctext_Online'] =="" ? "Online now" : $options['wp_sc_sctext_Online']); ?>" />
  </p>
  <p>
    <label for="wp_sc_sctext_Default_Tab">Default Tab</label>:
    <select id="wp_sc_sctext_Default_Tab" name="wp_sc_sctext_Default_Tab">
      <option value="1" <?php echo ($options['wp_sc_sctext_Default_Tab'] == "1" ? "selected" : "" ); ?> >Page Views</option>
      <option value="2" <?php echo ($options['wp_sc_sctext_Default_Tab'] == "2" ? "selected" : "" ); ?> >Hits</option>
      <option value="3" <?php echo ($options['wp_sc_sctext_Default_Tab'] == "3" ? "selected" : "" ); ?> >Unique Visitors</option>
    </select>
  </p>
  <p>
    <label for="wp_sc_sctext_bots_filter">Automatic Traffic</label>:
    <select id="wp_sc_sctext_bots_filter" name="wp_sc_sctext_bots_filter">
      <option value="1" <?php echo ($options['wp_sc_sctext_bots_filter'] == "1" ? "selected" : "" ); ?> >Log and show</option>
      <option value="2" <?php echo ($options['wp_sc_sctext_bots_filter'] == "2" ? "selected" : "" ); ?> >Log do not show</option>
      <option value="3" <?php echo ($options['wp_sc_sctext_bots_filter'] == "3" ? "selected" : "" ); ?> >Do not log</option>
    </select>
  </p>
  <p>
    <label for="wp_sc_sctext_log_opt">Automatically delete old logs:*</label>
    <input type="checkbox" id="wp_sc_sctext_log_opt" name="wp_sc_sctext_log_opt" <?php echo ($options['wp_sc_sctext_log_opt'] == "on" ? "checked" : "" ); ?> />
  </p>
<p>*Caution! By unchecking this you will have to manually delete old logs from time to time! Checking this would only keep logs for the past 1-2 months</p>
 
 <p>
    <label for="wp_sc_sctext_wlink">Please support our plugin by showing a small link under the stats.</label><p align="right">Activate it: 
    <input type="checkbox" id="wp_sc_sctext_wlink" name="wp_sc_sctext_wlink" <?php echo ($options['wp_sc_sctext_wlink'] == "on" ? "checked" : "" ); ?> /></p>
  </p>
  
  <p>
    <input type="hidden" id="wp_sc_Submit" name="wp_sc_Submit" value="1" />
  </p>

<?php
}
function counterinst_activate() { 
add_option('installredirect_do_activation_redirect', true); wp_redirect('../wp-admin/widgets.php');
 };


function get_sc_options() {

  $options = get_option("widget_traffic_counter");
  if (!is_array( $options )) {
    $options = array(
                     'wp_sc_WidgetTitle' => 'Traffic Stats',
                     'wp_sc_sctext_Visitors' => 'Pages',
                     'wp_sc_sctext_Hits' => 'Hits',
                     'wp_sc_sctext_Unique' => 'Unique',
                     'wp_sc_sctext_LastDay' => 'Last 24 hours',
                     'wp_sc_sctext_LastWeek' => 'Last 7 days',
                     'wp_sc_sctext_LastMonth' => 'Last 30 days',
                     'wp_sc_sctext_Online' => 'Online now',
                     'wp_sc_sctext_log_opt' => 'on',
                     'wp_sc_sctext_Default_Tab' => '1',
                     'wp_sc_sctext_bots_filter' => '1',
                     'wp_sc_sctext_wlink' => ''
                    );
  }
  return $options;
}

function get_traffic ($sex, $unique, $hit=false) {

  global $wpdb;
  $table_name = $wpdb->prefix . "sc_log";
  $options = get_sc_options();
  $sql = '';
  $stime = time()-$sex;
  $sql = "SELECT COUNT(".($unique ? "DISTINCT IP" : "*").") FROM $table_name where Time > ".$stime;

  if ($hit)
   $sql .= ' AND IS_HIT = 1 ';

  if ($options['wp_sc_sctext_bots_filter'] > 1)
      $sql .= ' AND IS_BOT <> 1';

  return number_format_i18n($wpdb->get_var($sql));
}



function view() {

  global $wpdb;
  $options = get_sc_options();
  $table_name = $wpdb->prefix . "sc_log";

  if ($options['wp_sc_sctext_log_opt'] == 'on' && date('j') == 1 && date('G') == 23)
     $wpdb->query('DELETE FROM '.$table_name.' WHERE Time < '.(time()-2592000));

  if (sc_is_bot() && ($options ['wp_sc_sctext_bots_filter'] == 3 ))
     return;

  if ($_SERVER['HTTP_X_FORWARD_FOR'])
       $ip = $_SERVER['HTTP_X_FORWARD_FOR'];
  else
       $ip = $_SERVER['REMOTE_ADDR'];

  $user_count = $wpdb->get_var("SELECT COUNT(*) FROM $table_name where ".time()." - Time <= 3 and IP = '".$ip."'");

  if (!$user_count) {
    $data = array (
                 'IP' => $ip,
                 'Time' => time(),
                 'IS_BOT'=> sc_is_bot(),
                 'IS_HIT'=> is_hit($ip)
                );
    $format  = array ('%s','%d', '%b','%b');
    $wpdb->insert( $table_name, $data, $format );
  }
?>

<strong> <p id="sc_stats_title"><?php
$ttl = $options['wp_sc_sctext_Visitors'];
if ($options['wp_sc_sctext_Default_Tab'] == 2)
  $ttl =$options['wp_sc_sctext_Hits'];
else if ($options['wp_sc_sctext_Default_Tab'] == 3)
         $ttl = $options['wp_sc_sctext_Unique'];
echo $ttl;?></p></strong>

<p id="scmenu"><a href="javascript:sc_show('pages','<?php echo plugins_url('Stat-counterimg.gif', __FILE__); ?>', '<?php echo site_url(); ?>')" target="_self"><?php echo ($options['wp_sc_sctext_Visitors'] == '' ? 'Pages' : $options['wp_sc_sctext_Visitors']); ?></a>|<a href="javascript:sc_show('hits','<?php echo plugins_url('Stat-counterimg.gif', __FILE__); ?>', '<?php echo site_url(); ?>')" target="_self" ><?php echo ($options['wp_sc_sctext_Hits'] == '' ? 'Hits' : $options['wp_sc_sctext_Hits']); ?> </a>|<a href="javascript:sc_show('unique','<?php echo plugins_url('Stat-counterimg.gif', __FILE__); ?>', '<?php echo site_url(); ?>')" target="_self" ><?php echo ($options['wp_sc_sctext_Unique'] == '' ? 'Unique' : $options['wp_sc_sctext_Unique']); ?></a></p>

  <?php $scuni = ($options['wp_sc_sctext_Default_Tab'] == 3); ?>

  <ul>
  <li><?php echo $options["wp_sc_sctext_LastDay"].": <span id='sc_lds'>".get_traffic(86400,$scuni); ?></span></li>
  <li><?php echo $options["wp_sc_sctext_LastWeek"].": <span id='sc_lws'>".get_traffic(604800,$scuni); ?></span></li>
  <li><?php echo $options["wp_sc_sctext_LastMonth"].": <span id='sc_lms'>".get_traffic(2592000,$scuni); ?></span></li>
  <li><?php echo $options["wp_sc_sctext_Online"].": ".get_traffic(600, true); ?></li>
  </ul>
<?php if ($options['wp_sc_sctext_wlink'] == "on") { ?>
<small><a href="http://seo.uk.net/stat-plugin/" target="_blank">Traffic Stats Plugin</a> by <a href="http://seo.uk.net/" target="_blank">seo.uk.net</a>.</small>
<?php } ?>

<?php
}

function widget_traffic_counter($args) {
  extract($args);

  $options = get_sc_options();

  echo $before_widget;
  echo $before_title.$options["wp_sc_WidgetTitle"];
  echo $after_title;
  view();
  echo $after_widget;
}

function sc_is_bot(){

        if (isset($_SESSION['scrobot']))
           return true;

	$user_agent = $_SERVER['HTTP_USER_AGENT'];
	$bots = array( 'Google Bot' => 'googlebot', 'Google Bot' => 'google', 'MSN' => 'msnbot', 'Alex' => 'ia_archiver', 'Lycos' => 'lycos', 'Ask Jeeves' => 'jeeves', 'Altavista' => 'scooter', 'AllTheWeb' => 'fast-webcrawler', 'Inktomi' => 'slurp@inktomi', 'Turnitin.com' => 'turnitinbot', 'Technorati' => 'technorati', 'Yahoo' => 'yahoo', 'Findexa' => 'findexa', 'NextLinks' => 'findlinks', 'Gais' => 'gaisbo', 'WiseNut' => 'zyborg', 'WhoisSource' => 'surveybot', 'Bloglines' => 'bloglines', 'BlogSearch' => 'blogsearch', 'PubSub' => 'pubsub', 'Syndic8' => 'syndic8', 'RadioUserland' => 'userland', 'Gigabot' => 'gigabot', 'Become.com' => 'become.com', 'Baidu' => 'baidu', 'Yandex' => 'yandex', 'Amazon' => 'amazonaws.com', 'crawl' => 'crawl', 'spider' => 'spider', 'slurp' => 'slurp', 'ebot' => 'ebot' );

	foreach ( $bots as $name => $lookfor )
		if ( stristr( $user_agent, $lookfor ) !== false )
			return true;

        return false;
}

function is_hit ($ip) {

   global $wpdb;
   $table_name = $wpdb->prefix . "sc_log";

   $user_count = $wpdb->get_var("SELECT COUNT(*) FROM $table_name where ".time()." - Time <= 1000 and IP = '".$ip."'");

   return $user_count == 0;
}

function wp_sc_install_db () {
   global $wpdb;

   $table_name = $wpdb->prefix . "sc_log";
   $gTable = $wpdb->get_var("show tables like '$table_name'");
   $gColumn = $wpdb->get_results("SHOW COLUMNS FROM ".$table_name." LIKE 'IS_BOT'");
   $hColumn = $wpdb->get_results("SHOW COLUMNS FROM ".$table_name." LIKE 'IS_HIT'");

   if($gTable != $table_name) {

      $sql = "CREATE TABLE " . $table_name . " (
           IP VARCHAR( 17 ) NOT NULL ,
           Time INT( 11 ) NOT NULL ,
           IS_BOT BOOLEAN NOT NULL,
           IS_HIT BOOLEAN NOT NULL,
           PRIMARY KEY ( IP , Time )
           );";

      require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
      dbDelta($sql);

   } else {
     if (empty($gColumn)) {  //old table version update

       $sql = "ALTER TABLE ".$table_name." ADD IS_BOT BOOLEAN NOT NULL";
       $wpdb->query($sql);
     }

     if (empty($hColumn)) {  //old table version update

       $sql = "ALTER TABLE ".$table_name." ADD IS_HIT BOOLEAN NOT NULL";
       $wpdb->query($sql);
     }
   }
}

function traffic_counter_init() {

  wp_sc_install_db ();
  register_sidebar_widget(__('Stat Counter'), 'widget_traffic_counter');
  register_widget_control(__('Stat Counter'), 'traffic_counter_control', 300, 200 );
}

function uninstall_sc(){

  global $wpdb;
  $table_name = $wpdb->prefix . "sc_log";
  delete_option("widget_traffic_counter");
  delete_option("wp_sc_WidgetTitle");
  delete_option("wp_sc_sctext_Visitors");
  delete_option("wp_sc_sctext_LastDay");
  delete_option("wp_sc_sctext_LastWeek");
  delete_option("wp_sc_sctext_LastMonth");
  delete_option("wp_sc_sctext_Online");
  delete_option("wp_sc_sctext_log_opt");
  delete_option("wp_sc_sctext_bots_filter");
  delete_option("wp_sc_sctext_Hits");
  delete_option("wp_sc_sctext_Unique");
  delete_option("wp_sc_sctext_Default_Tab");
  delete_option("wp_sc_sctext_wlink");

  $wpdb->query("DROP TABLE IF EXISTS $table_name");
}

function add_sc_stylesheet() {
            wp_register_style('scStyleSheets', plugins_url('sc-styles.css',__FILE__));
            wp_enqueue_style( 'scStyleSheets');
}

function add_sc_ajax () {
  wp_enqueue_script('scScripts', plugins_url('wp-sc-ajax.js',__FILE__));
}

function sc_ajax_response () {

 $options = get_sc_options();
 $stat = $_REQUEST['reqstats'];

 if ($stat == 'pages')
   echo $options['wp_sc_sctext_Visitors'].'~'.get_traffic(86400,false).'~'.get_traffic(604800,false).'~'.get_traffic(2592000,false);
 if ($stat == 'hits')
   echo $options['wp_sc_sctext_Hits'].'~'.get_traffic(86400, false ,true).'~'.get_traffic(604800, false, true). '~' . get_traffic(2592000, false, true);
 if ($stat == 'unique')
   echo $options['wp_sc_sctext_Unique'].'~'.get_traffic(86400, true).'~'.get_traffic(604800,true).'~'.get_traffic(2592000,true);
die();
}

add_action("plugins_loaded", "traffic_counter_init");
add_action('wp_print_styles', 'add_sc_stylesheet');
add_action('init', 'add_sc_ajax');

add_action('wp_ajax_scstats', 'sc_ajax_response');
add_action('wp_ajax_nopriv_scstats', 'sc_ajax_response');

register_deactivation_hook( __FILE__, 'uninstall_sc' );

register_activation_hook( __FILE__,'counterinst_activate');
add_action('admin_init', 'installredirect_redirect');

function installredirect_redirect() {
if (get_option('installredirect_do_activation_redirect', false)) { delete_option('installredirect_do_activation_redirect'); wp_redirect('../wp-admin/widgets.php');
}
}

?>