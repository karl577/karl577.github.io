<?php
class SimpleTaggingMuAdmin {
	var $clientObj;
	
	function SimpleTaggingMuAdmin( $clientObj ) {
		// Stock object client
		$this->clientObj = $clientObj;
		unset($clientObj);
		
		if ( is_admin() ) {
			add_action('admin_menu', array(&$this, 'adminMenu'));
			
			// Remove prototype		
			if ( strpos( $_GET['page'], 'simpletagging.mu.php' ) != false ) {
				add_action('admin_print_scripts', array(&$this, 'remove_prototype'));
			}		
		}
	}
	
	function adminMenu() {
		if ( is_site_admin() ) {
			$pfile = basename(dirname(__FILE__)) . '/' . basename(__FILE__);
			add_submenu_page('wpmu-admin.php', __('Simple Tagging: Mu Options','simpletagging'), __('Simple Tagging','simpletagging'), 0, $pfile, array(&$this, 'pageMuOptions'));
		}
	}
	
	function remove_prototype() { 				
		wp_deregister_script('prototype');
		wp_deregister_script('jquery');		
		// Desactive Switcher Blog for this pages
		remove_action( 'admin_print_scripts', 'switcher_scripts' );
		remove_action( 'admin_head', 'switcher_css' );
		remove_action( 'admin_footer', 'add_switcher' );
	}
	
	function pageMuOptions() {
		if ( !is_site_admin() ) {
			wp_die(__('Only MU Admin.', 'simpletagging'));
		}
		
		// presentation data for each configurable option
		$option_data = array(
			__('Options MU', 'simpletagging') => array(
				array('mu_query_varname', __('MU Tag search base:', 'simpletagging'), 'text', 80),
				array('mu_template', __('MU search results template file:', 'simpletagging'), 'text', 80),
				array('mu_all_site', __('Include all site in MU posts list and tag cloud:', 'simpletagging'), 'checkbox', '1'),
				array('include_page', __('Include pages in MU posts list:', 'simpletagging'), 'checkbox', '1'),
				array('include_protected_content', __('Include protected content in MU posts list:', 'simpletagging'), 'checkbox', '1'),
			),
			__('Tag Cloud', 'simpletagging') => array(
				array('cloud_linkformat', __('Cloud tag link format:', 'simpletagging'), 'text', 80, 
					'<ul>
						<li>'.__('<code>%tagname%</code> &ndash; Replaced by the name of the tag.', 'simpletagging').'</li>
						<li>'.__('<code>%fulltaglink%</code> &ndash; Replaced by the full link, e.g. <em>http://site.com/tag/Coffee+and+Tea</em>.', 'simpletagging').'</li>
						<li>'.__('<code>%feedtaglink%</code> &ndash; Replaced by the feed link, e.g. <em>http://site.com/tag/Coffee+and+Tea/feed</em>.', 'simpletagging').'</li>
						<li>'.__('<code>%taglink%</code> &ndash; Replaced by the link, e.g. <em>Coffee_and_Tea</em>. Can be used to create links e.g. to Technorati.', 'simpletagging').'</li>
						<li>'.__('<code>%flickr%</code> &ndash; Replaced by the encoded version of the tag which conforms to Flickr link standards., e.g. <em>coffeeandtea</em>.', 'simpletagging').'</li>
						<li>'.__('<code>%delicious%</code> &ndash; Replaced by the encoded version of the tag which conforms to del.icio.us link standards., e.g. <em>coffeeandtea</em>.', 'simpletagging').'</li>
						<li>'.__('<code>%count%</code> &ndash; Replaced by the actual number of times the tag has been used.', 'simpletagging').'</li>
						<li>'.__('<code>%scale%</code> &ndash; Replaced by the value the tag is scaled to.', 'simpletagging').'</li>
						<li>'.__('<code>%color%</code> &ndash; Replaced by the color of the tag, e.g. <em>color: #CCCCCC;</em>.', 'simpletagging').'</li>
						<li>'.__('<code>%size%</code> &ndash; Replaced by the size of the tag, e.g. <em>font-size: 14px;</em>.', 'simpletagging').'</li>
						<li>'.__('<code>%colorsize%</code> &ndash; Replaced by the color <strong>and</strong> size of the tag, e.g. <em>color: #CCCCCC; font-size: 14px;</em>.', 'simpletagging').'</li>
					</ul>'),
				array('cloud_tagseparator', __('Cloud tag separator(s):', 'simpletagging'), 'text', 80),
				array('cloud_sortorder', __('Tag cloud sort order:', 'simpletagging'), 'dropdown', 'natural/countup/countdown/asc/desc/random', 
					'<ul>
						<li>'.__('<code>Natural</code> &ndash; natural case sorting (i.e. treats capital & non-capital the same).', 'simpletagging').'</li>
						<li>'.__('<code>Countup/Asc</code> &ndash; ascending order by tag usage.', 'simpletagging').'</li>
						<li>'.__('<code>Countdown/Desc</code> &ndash; descending order by tag usage.', 'simpletagging').'</li>
						<li>'.__('<code>Alpha Asc</code> &ndash; strict alphabetic order (capitals first).', 'simpletagging').'</li>
						<li>'.__('<code>Alpha Desc</code> &ndash; strict alphabetic order (capitals first), descending.', 'simpletagging').'</li>
						<li>'.__('<code>Random</code> &ndash; randomized every time the page is loaded.', 'simpletagging').'</li>
					</ul>'),
				array('cloud_displaymax', __('Maximum number of tags to display:', 'simpletagging'), 'text', 40,
					__("Set to zero (0) to show all tags.", 'simpletagging')),
				array('cloud_displaymin', __('Minimum tag count required:', 'simpletagging'), 'text', 40, 
					__("Tags must be used at least this many times to show up in the cloud.", 'simpletagging')),
				array('cloud_scalemax', __('Tag count scaling maximum:', 'simpletagging'), 'text', 40, 
					__("Set to zero (0) to disable tag scaling and color cloud.", 'simpletagging')),
				array('cloud_scalemin', __('Tag count scaling minimum:', 'simpletagging'), 'text', 40, 
					__("Use with the maximum scale to limit the range between your most popular and least popular tags.", 'simpletagging')),
				array('cloud_max_color', __('Most popular color:', 'simpletagging'), 'text', 40, 
					__("The colours are hexadecimal colours,  and need to have the full six digits (#eee is the shorthand version of #eeeeee).", 'simpletagging')),
				array('cloud_min_color', __('Least popular color:', 'simpletagging'), 'text', 40), 	
				array('cloud_max_size', __('Most popular font size:', 'simpletagging'), 'text', 20, 
					__("The two font sizes are the size of the largest and smallest tags.", 'simpletagging')),
				array('cloud_min_size', __('Least popular font size:', 'simpletagging'), 'text', 20),
				array('cloud_unit', __('The units to display the font sizes with, on tag clouds:', 'simpletagging'), 'dropdown', 'px/em/%', 
					__("The font size units option determines the units that the two font sizes use.", 'simpletagging')),
				array('cloud_notagstext', __('Text to display if no tags found:', 'simpletagging'), 'text', 80)
			)
		);
		
	
		// handle form actions
		if (!empty($_POST['updateoptions'])) { //Pressed button: Update Options
			foreach($this->clientObj->objMu->mu_option as $key => $value) {	
				if ( $key != 'version_for_install' && $key != 'tags_table' ) {
					$newval = ( isset($_POST[$key]) ) ? stripslashes($_POST[$key]) : '0';
					if ($newval != $value) {
						$this->clientObj->objMu->setOption($key, $newval);					
					}
				}
			}
			$this->clientObj->objMu->saveOptions();
			$pagemsgArr = array('type' => 'updated', 'msg' => __('Mu options saved', 'simpletagging'));
		} 
		elseif (!empty($_POST['resetoptions'])) { //Pressed button: Reset Options
			foreach($this->mu_defaultoption as $key => $value) {	
				$this->clientObj->objMu->setOption($key, $value);						
				$this->clientObj->objMu->saveOptions();
			}
			$this->clientObj->objMu->resetToDefaultOptions( false );
			$pagemsgArr = array('type' => 'updated', 'msg' => __('Mu options resetted to default options!', 'simpletagging'));
		}
		
		// Display message
		$res['pagemsg'] = '';
		if (!empty($pagemsgArr)) {
			$res['pagemsg'] = '<div id="message" class="' . $pagemsgArr['type'] . ' fade"><p><strong>' . $pagemsgArr['msg'] . '</strong></p></div>';
		}
		
		// URL for form actions
		$actionurl = stripslashes($_SERVER['REQUEST_URI']);	// additional slashes are added when saving, so we remove 'em... 
		
		// Put submit & reset buttons into string
		$res['buttons'] = '<p class="submit">
				<input type="submit" name="updateoptions" value="' . __('Update Options', 'simpletagging') . ' &raquo;" />
				<input type="submit" name="resetoptions" class="stpwarn" onclick=\'return confirm("'.__('Do you really want to restore the default options?', 'simpletagging').'");\' value="' . __('Reset Mu options', 'simpletagging') . '" />
			</p>';

		// Put options into string		
		$res['options'] = $this->clientObj->objAdmin->printOptions( $option_data, $this->clientObj->objMu->mu_option );
		
		########################### OUTPUT #####################################		
		?>
		<?php echo $res['pagemsg']; ?>
		<style type="text/css">
			input.stpwarn:hover { background: #ce0000; color: #fff; }
			.stpexplan { font-size: 95%; line-height:120%; }
			.stpexplan ul, .stpexplan ul li {margin: 0; padding:0; line-height:120%;  }
			.stpexplan ul { margin-left: 20px; }
			.stp_admin { text-align: center; font-size: .85em; }
		</style>

		<div class="wrap"> 
			<h2><?php _e('Simple Tagging: Mu Options', 'simpletagging'); ?></h2>
			<p><?php _e('Visit the <a href="http://trac.herewithme.fr/project/simpletagging/">plugin\'s homepage</a> for further details.', 'simpletagging'); ?></p>
			<form action="<?php echo $actionurl; ?>" method="post">
				<?php echo $res['buttons']; ?>
				<?php echo $res['options']; ?>
				<?php echo $res['buttons']; ?>
			</form>	
			<?php $this->clientObj->objAdmin->printAdminFooter(); ?>
		</div> <!-- [wrap] -->
		<?php
	}
	
}
?>