<?php
/* 
Plugin Name: Genki Announcement
Version: 1.4.1
Plugin URI: http://ericulous.com/2007/03/09/genki_announcement/
Description: Display an announcement on your blog
Author: Genkisan
Author URI: http://ericulous.com
*/
load_plugin_textdomain('genki_announce');

add_action('admin_menu', 'genki_announcement_menu');
add_action('wp_head', 'genki_announcement_loopstart');
add_action('genki_announcement_cronon', 'genki_announcement_showmsg');
add_action('genki_announcement_cronoff', 'genki_announcement_hidemsg');

function genki_announcement_menu() {
	add_option('genki_announcement_location', '0');
	add_option('genki_announcement_msg', '');
	add_option('genki_announcement_multimsg', '0');
	add_option('genki_announcement_msgguests', '');
	add_option('genki_announcement_msgsubscribers', '');
	add_option('genki_announcement_msgcontributors', '');
	add_option('genki_announcement_msgauthors', '');
	add_option('genki_announcement_msgeditors', '');
	add_option('genki_announcement_msgadmins', '');
	add_option('genki_announcement_timeon', '');
	add_option('genki_announcement_timeoff', '');
	add_option('genki_announcement_bordercolor', '#ffffff');
	add_option('genki_announcement_bgcolor', '#ffffff');
	
    if (function_exists('add_options_page')) {
		add_options_page(__('Genki Announcement', 'genki_announce'), __('Genki Announcement', 'genki_announce'), 8, basename(__FILE__), 'genki_announcement_manage');
	}
}

function genki_announcement_loopstart() {
	if (get_option('genki_announcement_location') == 1) {
			add_action ('loop_start', 'genki_announcement_showmsg');
	}
}

function genki_announcement() {
	if (get_option('genki_announcement_location') == 3) {
			genki_announcement_showmsg();
	}
}

function genki_announcement_showmsg($preview = false) {
	$bordercolor = get_option('genki_announcement_bordercolor');
	if ($bordercolor != '')
		$bordercolor = 'border: 1px solid ' . $bordercolor . ';';

	$bgcolor = get_option('genki_announcement_bgcolor');
	if ($bgcolor != '')
		$bgcolor = 'background: ' . $bgcolor . ';';
		
	$timeon = get_option('genki_announcement_timeon');

	global $msgShownBefore;
	if ($preview || $timeon == '' || (strtotime($timeon . ':00 GMT') < (time() + (get_option('gmt_offset') * 3600)))) {
		if (get_option('genki_announcement_multimsg') == '0') {
			if (!isset($msgShownBefore)) {
				$msgShownBefore = 'yes';
				echo '<div class="genki-announcement" style="' . $bordercolor . $bgcolor . '">' . stripslashes(get_option('genki_announcement_msg')) . '</div>';
			}
		}
		else {
			global $msgShownBefore;
			if (!is_user_logged_in()) { if (!isset($msgShownBefore)) { $msgShownBefore = 'yes'; echo '<div class="genki-announcement" style="' . $bordercolor . $bgcolor . '">' . stripslashes(get_option('genki_announcement_msgguests')) . '</div>'; }}
			else if (current_user_can('administrator')) { if (!isset($msgShownBefore)) { $msgShownBefore = 'yes'; echo '<div class="genki-announcement" style="' . $bordercolor . $bgcolor . '">' . stripslashes(get_option('genki_announcement_msgadmins')) . '</div>'; }}
			else if (current_user_can('editor')) { if (!isset($msgShownBefore)) { $msgShownBefore = 'yes'; echo '<div class="genki-announcement" style="' . $bordercolor . $bgcolor . '">' . stripslashes(get_option('genki_announcement_msgeditors')) . '</div>'; }}
			else if (current_user_can('author')) { if (!isset($msgShownBefore)) { $msgShownBefore = 'yes'; echo '<div class="genki-announcement" style="' . $bordercolor . $bgcolor . '">' . stripslashes(get_option('genki_announcement_msgauthors')) . '</div>'; }}
			else if (current_user_can('contributor')) { if (!isset($msgShownBefore)) { $msgShownBefore = 'yes'; echo '<div class="genki-announcement" style="' . $bordercolor . $bgcolor . '">' . stripslashes(get_option('genki_announcement_msgcontributors')) . '</div>'; }}
			else if (current_user_can('subscriber')) { if (!isset($msgShownBefore)) { $msgShownBefore = 'yes'; echo '<div class="genki-announcement" style="' . $bordercolor . $bgcolor . '">' . stripslashes(get_option('genki_announcement_msgsubscribers')) . '</div>'; }}
		}
	
		if (!$preview) {
			update_option('genki_announcement_timeon', '');
		}
	}
}

function genki_announcement_hidemsg() {
	update_option('genki_announcement_location', '0');
	update_option('genki_announcement_timeoff', '');
}

function genki_announcement_manage() {
if (isset($_POST['update_message'])) {

	?><div id="message" class="updated fade"><p><strong><?php

	update_option('genki_announcement_location', $_POST["location"]);
	update_option('genki_announcement_multimsg', $_POST["multimsg"]);
	update_option('genki_announcement_msg', $_POST["messageall"]);
	update_option('genki_announcement_msgguests', $_POST["msgguests"]);
	update_option('genki_announcement_msgsubscribers', $_POST["msgsubscribers"]);
	update_option('genki_announcement_msgcontributors', $_POST["msgcontributors"]);
	update_option('genki_announcement_msgauthors', $_POST["msgauthors"]);
	update_option('genki_announcement_msgeditors', $_POST["msgeditors"]);
	update_option('genki_announcement_msgadmins', $_POST["msgadmins"]);
	update_option('genki_announcement_timeon', $_POST["timeon"]);
	update_option('genki_announcement_timeoff', $_POST["timeoff"]);
	update_option('genki_announcement_bordercolor', $_POST['bordercolor']);
	update_option('genki_announcement_bgcolor', $_POST['bgcolor']);
	
	$timeon = $_POST["timeon"];
	if ($timeon != '') {
		$post_date_gmt = strtotime($timeon . ':00 GMT') - (get_option('gmt_offset') * 3600);
		wp_clear_scheduled_hook('genki_announcement_cronon');
		wp_schedule_single_event($post_date_gmt, 'genki_announcement_cronon');
	}

	$timeoff = $_POST["timeoff"];
	if ($timeoff != '') {
		$post_date_gmt = strtotime($timeoff . ':00 GMT') - (get_option('gmt_offset') * 3600);
		wp_clear_scheduled_hook('genki_announcement_cronoff');
		wp_schedule_single_event($post_date_gmt, 'genki_announcement_cronoff');
	}

	echo __("Settings saved.","genki_announce");

	?></strong></p></div><?php

}

$location = get_option('genki_announcement_location');
$msg = get_option('genki_announcement_msg');
$multimsg = get_option('genki_announcement_multimsg');
$msgguests = get_option('genki_announcement_msgguests');
$msgsubscribers = get_option('genki_announcement_msgsubscribers');
$msgcontributors = get_option('genki_announcement_msgcontributors');
$msgauthors = get_option('genki_announcement_msgauthors');
$msgeditors = get_option('genki_announcement_msgeditors');
$msgadmins = get_option('genki_announcement_msgadmins');
$timeon = get_option('genki_announcement_timeon');
$timeoff = get_option('genki_announcement_timeoff');
$bordercolor = get_option('genki_announcement_bordercolor');
$bgcolor = get_option('genki_announcement_bgcolor');
?>

	<div class=wrap>
		<?php screen_icon(); ?>
		<h2><?php _e('Genki Announcement', 'genki_announce'); ?></h2>
		<form name="formamt" method="post" action="<?php echo $_SERVER["REQUEST_URI"]; ?>">	
			<table class="form-table">
			<tr valign="top">
				<th scope="row"><label for="location"><?php _e('Announcement Status', 'genki_announce'); ?></label></th>
				<td>
					<input name="location" type="radio" id="location" value="0" <?php if ($location == '0') echo 'checked' ; ?> /> <?php _e('Don\'t show announcement', 'genki_announce'); ?><br />
					<input name="location" type="radio" id="location" value="1" <?php if ($location == '1') echo 'checked' ; ?> /> <?php _e('Show above first post (may not work with some themes)', 'genki_announce'); ?><br />
					<input name="location" type="radio" id="location" value="2" <?php if ($location == '2') echo 'checked' ; ?> /> <?php _e('Show in Widget (remember to activate the Genki Announcement Widget)', 'genki_announce'); ?><br />
					<input name="location" type="radio" id="location" value="3" <?php if ($location == '3') echo 'checked' ; ?> /> <?php echo __('Show where I insert the', 'genki_announce') . ' &lt;?php if(function_exists(\'genki_announcement\')) { genki_announcement(); } ?> ' . __('template function', 'genki_announce'); ?>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="bordercolor"><?php _e('Border Color', 'genki_announce'); ?></label></th>
				<td><input name="bordercolor" id="bordercolor" type="text" value="<?php echo $bordercolor; ?>" class="regular-text" /></td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="bgcolor"><?php _e('Background Color', 'genki_announce'); ?></label></th>
				<td><input name="bgcolor" id="bgcolor" type="text" value="<?php echo $bgcolor; ?>" class="regular-text" /></td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="timeon"><?php _e('Date to Turn On Announcement', 'genki_announce'); ?></label></th>
				<td><input name="timeon" id="timeon" type="text" value="<?php echo $timeon; ?>" class="regular-text" /><br /><?php _e('- Format: yyyy-mm-dd hh:mm e.g', 'genki_announce'); ?> <?php echo substr(current_time('mysql', 0),0,-3); ?><br /><?php _e('- Leave blank to turn on immediately', 'genki_announce'); ?></td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="timeoff"><?php _e('Date to Turn Off Announcement', 'genki_announce'); ?></label></th>
				<td><input name="timeoff" id="timeoff" type="text" value="<?php echo $timeoff; ?>" class="regular-text" /><br /><?php _e('- Format: yyyy-mm-dd hh:mm e.g', 'genki_announce'); ?> <?php echo substr(current_time('mysql', 0),0,-3); ?><br /><?php _e('- Leave blank to turn off manually', 'genki_announce'); ?></td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="multimsg"><?php _e('Roles/Users', 'genki_announce'); ?></label></th>
				<td>
					<input type="radio" id="multimsg" name="multimsg" value="0" <?php if ($multimsg == '0') echo 'checked' ; ?> onClick="javascript:document.getElementById('msgsep').style.display='none';document.getElementById('msgall').style.display='block'" /> <?php _e('Single message for all roles/users', 'genki_announce'); ?><br />
					<input type="radio" id="multimsg" name="multimsg" value="1" <?php if ($multimsg == '1') echo 'checked' ; ?> onClick="javascript:document.getElementById('msgsep').style.display='block';document.getElementById('msgall').style.display='none'" /> <?php _e('Different message for different roles/users', 'genki_announce'); ?>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="message"><?php _e('Message', 'genki_announce'); ?></label></th>
				<td>
					<div id="msgall"<?php if ($multimsg == '1') { ?> style="display: none" <?php } ?>>
						<legend><?php _e('Message for All ~ HTML allowed', 'genki_announce'); ?>
							<textarea name="messageall" id="messageall" cols="120" rows="8" style="width: 100%;"><?php echo stripslashes($msg); ?></textarea>
						</legend>
					</div>
					
					<div id="msgsep"<?php if ($multimsg == '0') { ?> style="display: none" <?php } ?>>
						<legend><?php _e('Message for Guests ~ HTML allowed', 'genki_announce'); ?>
							<p><textarea name="msgguests" id="msgguests" cols="120" rows="8" style="width: 100%;"><?php echo stripslashes($msgguests); ?></textarea></p>
						</legend>
						<legend><?php _e('Message for Subscribers ~ HTML allowed', 'genki_announce'); ?>
							<p><textarea name="msgsubscribers" id="msgsubscribers" cols="120" rows="8" style="width: 100%;"><?php echo stripslashes($msgsubscribers); ?></textarea></p>
						</legend>
						<legend><?php _e('Message for Contributors ~ HTML allowed', 'genki_announce'); ?>
							<p><textarea name="msgcontributors" id="msgcontributors" cols="120" rows="8" style="width: 100%;"><?php echo stripslashes($msgcontributors); ?></textarea></p>
						</legend>
						<legend><?php _e('Message for Authors ~ HTML allowed', 'genki_announce'); ?>
							<p><textarea name="msgauthors" id="msgauthors" cols="120" rows="8" style="width: 100%;"><?php echo stripslashes($msgauthors); ?></textarea></p>
						</legend>
						<legend><?php _e('Message for Editors ~ HTML allowed', 'genki_announce'); ?>
							<p><textarea name="msgeditors" id="msgeditors" cols="120" rows="8" style="width: 100%;"><?php echo stripslashes($msgeditors); ?></textarea></p>
						</legend>
						<legend><?php _e('Message for Admins ~ HTML allowed', 'genki_announce'); ?>
							<p><textarea name="msgadmins" id="msgadmins" cols="120" rows="8" style="width: 100%;"><?php echo stripslashes($msgadmins); ?></textarea></p>
						</legend>
					</div>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label for="preview"><?php _e('Preview', 'genki_announce'); ?></label></th>
				<td><?php genki_announcement_showmsg(true) ?></td>
			</tr>
			</table>
			
			<p><input class="button button-primary" type="submit" name="update_message" value="<?php _e('Save Changes', 'genki_announce'); ?>" /></p>
			<p><strong>Looking to change your theme? Visit <a href="http://ericulous.com/" title="Smashing Wordpress Themes">Smashing Wordpress Themes!</a></strong></p>
		</form>
	</div>
<?php
}

//Widgets Stuff
function widget_genkiannouncement_init() {

	if ( !function_exists('register_sidebar_widget') )
		return;

	function widget_genkiannouncement($args) {
		extract($args);
		
		$options = get_option('widget_genkiannouncement');
		$title = $options['title'];
		
		if (get_option('genki_announcement_location') == 2) {
			echo $before_widget . $before_title . $title . $after_title;
		$url_parts = parse_url(get_bloginfo('home'));

		genki_announcement_showmsg();
		echo $after_widget;
		}
	}

	function widget_genkiannouncement_control() {

		$options = get_option('widget_genkiannouncement');
		if ( !is_array($options) )
			$options = array('title'=>'');
		if ( $_POST['genkiannouncement-submit'] ) {
			$options['title'] = strip_tags(stripslashes($_POST['genkiannouncement-title']));
			update_option('widget_genkiannouncement', $options);
		}

		$title = htmlspecialchars($options['title'], ENT_QUOTES);
		
		echo '<p><label for="genkiannouncement-title">' . __('Title:', 'genki_announce') . ' <input style="width: 75%;" id="genkiannouncement-title" name="genkiannouncement-title" type="text" value="' . $title . '" /></label></p>';
		echo __('To set your message and other options, go to', 'genki_announce') . ' <a href="' . admin_url() . 'options-general.php?page=genki_announcement.php">' . __('Genki Announcement options page', 'genki_announce') . '</a>';
		echo '<input type="hidden" id="genkiannouncement-submit" name="genkiannouncement-submit" value="1" />';
	}
	
	register_sidebar_widget(array('Genki Announcement', 'widgets'), 'widget_genkiannouncement');
	register_widget_control(array('Genki Announcement', 'widgets'), 'widget_genkiannouncement_control', 200);
}

add_action('widgets_init', 'widget_genkiannouncement_init');
?>