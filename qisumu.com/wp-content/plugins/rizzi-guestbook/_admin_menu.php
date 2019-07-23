<?php

//Set default options.
add_option($opt_vgb_items_per_pg, 10);
add_option($opt_vgb_max_upload_siz, 50);
add_option($opt_vgb_no_anon_signers, false);
add_option($opt_vgb_show_browsers, true);
add_option($opt_vgb_show_flags, true);
add_option($opt_vgb_style, "Default");
add_option($opt_vgb_show_cred_link, false);
add_option($opt_vgb_digg_pagination, false);

/*
 * Tell WP about the Admin page
 */
add_action('admin_menu', 'vgb_add_admin_page', 99);
function vgb_add_admin_page()
{ 
    add_options_page('Rizzi Guestbook Options', 'Rizzi Guestbook', 'administrator', "rizzi-guestbook", 'vgb_admin_page');
}

/**
  * Link to Settings on Plugins page 
  */
add_filter('plugin_action_links', 'vgb_add_plugin_links', 10, 2);
function vgb_add_plugin_links($links, $file)
{
    if( dirname(plugin_basename( __FILE__ )) == dirname($file) )
        $links[] = '<a href="options-general.php?page=' . "rizzi-guestbook" .'">' . __('Settings',WPVGB_DOMAIN) . '</a>';
    return $links;
}


/*
 * Output the Admin page
 */
function vgb_admin_page()
{
    global $vgb_name, $vgb_homepage, $vgb_version;
    global $opt_vgb_page, $opt_vgb_style, $opt_vgb_reverse, $opt_vgb_allow_upload, $opt_rgb_homepage_field, $opt_rgb_captcha_key, $opt_rgb_use_captcha, $rgb_hide_value_section, $opt_rgb_sign_page, $opt_rgb_show_page, $opt_rgb_show_powered_by;
    global $opt_vgb_items_per_pg, $opt_vgb_max_upload_siz;
	global $opt_vgb_no_anon_signers;
    global $opt_vgb_show_browsers, $opt_vgb_show_flags, $opt_vgb_show_cred_link;
    global $opt_vgb_hidesponsor, $opt_vgb_digg_pagination;
    ?>
    <div class="wrap">
      <?php
      if( isset($_POST['opts_updated']) )
      {
          update_option( $opt_vgb_page, $_POST[$opt_vgb_page] );
          update_option( $opt_vgb_style, $_POST[$opt_vgb_style] );
          update_option( $opt_vgb_items_per_pg, $_POST[$opt_vgb_items_per_pg] );
          update_option( $opt_vgb_reverse, $_POST[$opt_vgb_reverse] );
          update_option( $opt_rgb_homepage_field, $_POST[$opt_rgb_homepage_field] );
          update_option( $opt_rgb_show_powered_by, $_POST[$opt_rgb_show_powered_by] );
          update_option( $opt_rgb_sign_page, $_POST[$opt_rgb_sign_page] );
          update_option( $opt_rgb_show_page, $_POST[$opt_rgb_show_page] );
          update_option( $rgb_hide_value_section, $_POST[$rgb_hide_value_section] );
          update_option( $opt_rgb_use_captcha, $_POST[$opt_rgb_use_captcha] );
          update_option( $opt_rgb_captcha_key, $_POST[$opt_rgb_captcha_key] );
          update_option( $opt_vgb_allow_upload, $_POST[$opt_vgb_allow_upload] );
          update_option( $opt_vgb_max_upload_siz, $_POST[$opt_vgb_max_upload_siz] );
		  update_option( $opt_vgb_no_anon_signers, $_POST[$opt_vgb_no_anon_signers] );
          update_option( $opt_vgb_show_browsers, $_POST[$opt_vgb_show_browsers] );
          update_option( $opt_vgb_show_flags, $_POST[$opt_vgb_show_flags] );
          update_option( $opt_vgb_show_cred_link, $_POST[$opt_vgb_show_cred_link] );
		  update_option( $opt_vgb_digg_pagination, $_POST[$opt_vgb_digg_pagination] );
          ?><div class="updated"><p><strong><?php _e('Options saved.', WPVGB_DOMAIN ); ?></strong></p></div><?php
      }
      if( isset($_REQUEST[$opt_vgb_hidesponsor]) )
          update_option($opt_vgb_hidesponsor, $_REQUEST[$opt_vgb_hidesponsor]);
      ?>
      <h2 style="clear: none">
         <?php _e('Rizzi Guestbook Options', WPVGB_DOMAIN) ?>
         <?php if( get_option($opt_vgb_page) ): ?>
         <?php endif;?>
      </h2>
<hr /> 
    <center><?php
 $image_url = "//".$_SERVER['HTTP_HOST']."/wp-content/plugins/rizzi-guestbook/img/";
 echo "<a href='http://software.jamrizzi.com/store/products/rizzi-guestbook/' target='_blank'><img src='".$image_url."rizzi-guestbook.png' width='100%'></a>";
 ?><br />
    <h2><a href="edit-comments.php?p=<?php echo get_option($opt_vgb_page)?>"><?php _e('Manage Entries', WPVGB_DOMAIN) ?> &raquo;</a></h2></center>
      
<hr />
<center>
<h1>Click the banner to upgrade to Rizzi Guestbook Pro</h1>
<?php
 $image_url = "//".$_SERVER['HTTP_HOST']."/wp-content/plugins/rizzi-guestbook/img/";
 echo "<a href='http://software.jamrizzi.com/store/products/rizzi-guestbook/' target='_blank'><img src='".$image_url."rizzi-guestbook-pro.png' width='100%'></a>";
?>
<h2><u>Features</u></h2>
</center>
<h3>
<ol>
    <li>Add a date stamp so you know when people signed your guestbook.  There are multiple date stamp formats to choose from.</li>
    <li>Choose how many entries are displayed on each page.</li>
    <li>Option to list entries from oldest to newest.</li>
    <li>Remove the user value fields for users that are already logged in.</li>
    <li>Change the page names.</li>
    <li>Add Google's new No Captcha reCaptcha.</li>
    <li>Remove <i>Powered by JamRizzi Technologies</i> stamp.</li>
    <li>Hide advertisements.</li>
</ol>
</h3>
<center>
<hr />
<h1>Click the EYE to get eyeMessage for Windows</h1>
<h3>Seamlessly iMessage straight from your Windows computer</h3>
<table>
  <tr>
    <td>
<?php
 $image_url = "//".$_SERVER['HTTP_HOST']."/wp-content/plugins/rizzi-guestbook/img/";
 echo "<a href='http://software.jamrizzi.com/store/products/eyemessage-for-windows/' target='_blank'><img src='".$image_url."imessage-for-windows.png' width='100%'></a>";
?>
    </td>
    <td>
<iframe width="640" height="360" src="https://www.youtube.com/embed/f6pNFSKq41s?feature=player_embedded" frameborder="0" allowfullscreen></iframe>
    </td>
  </tr>
</table>
</center>


<?php
           _e('
<hr />
<h2>Instructions:</h2>
<h4>To add a guestbook to your website, create a new page, select it in the first combo box below, and click <u>Save Settings</u>.', WPVGB_DOMAIN) ?><br /><br />
        Click <a href='http://support.jamrizzi.com' target='_blank'>HERE</a> to get official support from JamRizzi Technologies.</h4>
      <hr />
      
      <h2><?php _e('Main Settings', WPVGB_DOMAIN) ?>:</h2>
      <form name="formOptions" method="post" action="">

        <h3><?php _e('Guestbook Page', WPVGB_DOMAIN) ?><span style="word-spacing:9px;">:</span>
        <select style="width:150px;" name="<?php echo $opt_vgb_page?>">
          <?php
            $pages = get_pages(array('post_status'=>'publish,private'));  
            $vgb_page = get_option($opt_vgb_page);
            echo '<option value="0" selected>&lt;None&gt;</option>';
            foreach($pages as $page)
               echo '<option value="'.$page->ID.'"'. ($page->ID==$vgb_page?' selected':'').'>'.$page->post_title.'</option>'."\n";
          ?>
        </select>
          <br /><br />
        <input type="checkbox" name="<?php echo $opt_vgb_no_anon_signers?>" value="1" <?php echo get_option($opt_vgb_no_anon_signers)?'checked="checked"':''?> /> <?php _e('Only Allow Registered Users',WPVGB_DOMAIN)?><br /><br />
<?php
     echo "<a href='http://software.jamrizzi.com/store/products/rizzi-guestbook/' target='_blank'><img src='".$image_url."pro-settings.jpg' width='100%'></a>";
?>
        <h3 style="display:none"> <?php _e('Entries per Page: ', WPVGB_DOMAIN)?><input type="text" size="3" name="<?php echo $opt_vgb_items_per_pg?>" value="<?php echo get_option($opt_vgb_items_per_pg) ?>" /><br /><br />
        <?php _e('Date Stamp', WPVGB_DOMAIN) ?><span style="word-spacing:3px">:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
        <select style="width:53px;" name="<?php echo $opt_vgb_style?>">
          <?php
             $stylesDir = opendir(dirname(__FILE__) . "/styles");
             while ($file = readdir($stylesDir))
             {
                if( ($fileEnding = strpos($file, '.css'))===FALSE ) continue;
                $styleName = substr($file, 0, $fileEnding);
                echo '<option value="'.$styleName.'"'. ($styleName==get_option($opt_vgb_style)?' selected':'').'>'.$styleName.'</option>'."\n";
             }
             closedir($stylesDir);

          ?></h3>
        </select>

        <h3><input type="checkbox" name="<?php echo $opt_vgb_digg_pagination?>" value="1" <?php echo get_option($opt_vgb_digg_pagination)?'checked="checked"':''?> /> <?php _e('Use Digg-style pagination', WPVGB_DOMAIN)?><br /></h3>
        <h4>It is strongly recommended that you do not use Digg-style pagination because it is buggy. &nbsp;This option is only here to let users turn it off if it was already enabled.</h4>
        <input type="hidden" name="opts_updated" value="1" />
        <span class="submit"><input type="submit" name="Submit" value="<?php _e('Save Settings',WPVGB_DOMAIN)?>" /></div>
      </form>
    <br />    
    <hr />  

This plugin was created by JamRizzi Technologies. &nbsp;For more information, visit <a href="http://jamrizzi.com" target="_blank">jamrizzi.com</a>.


    <?php
}
?>