<?php get_template_part('pbpanel/header'); ?>

<div class="pbpanel-column">
	<?php 
		if (isset($_POST['delete_file'])) {
			if (update_option($_POST['delete_file'], '')) {
				echo '<div class="pbpanel-box pbpanel-updated">' . __('File was successfully deleted', 'pbpanel') . '</div>';		
			}
		} else {
			if (isset($_POST["upload_save_files"])) {
				if (!function_exists('wp_handle_upload')) { 
					require_once(ABSPATH . 'wp-admin/includes/file.php');
				}
				$countfiles = 0;
				$file = null;
				$files = $_FILES;
				$upload_overrides = array('test_form' => false);
				foreach ($files as $key => $value) {  
					if ($files[$key]['name']) {  
						$file = array(  
							'name'     => $files[$key]['name'],  
							'type'     => $files[$key]['type'],  
							'tmp_name' => $files[$key]['tmp_name'],  
							'error'    => $files[$key]['error'],  
							'size'     => $files[$key]['size']  
						);  
						$movefile = wp_handle_upload($file, $upload_overrides);
						if (!array_key_exists('error', $movefile)) {
							update_option($key, $movefile['url']);
							echo '<div class="pbpanel-box pbpanel-updated">' . $file['name'] . __(' was successfully uploaded', 'pbpanel') . '</div>';
						} else {
							echo '<div class="pbpanel-box pbpanel-error">' . $file['name'] . ' - ' . $movefile['error'] . '</div>';		
						}
					}
					if ($files[$key]['error'] == 0) {
						++$countfiles; 
					}
				}
				if ($countfiles == 0) {
					echo '<div class="pbpanel-box pbpanel-error">' . $file['name'] . __('No file selected', 'pbpanel') . '</div>';	
				}
			} 
		}
	?>
	<?php if (isset($_POST["update_options"])) { ?>
		<?php
			foreach ($_POST as $key => $value) {
                if ($key != 'update_options') {
					update_option($key, esc_html($value));
				}
            }
		?>
		<div class="pbpanel-box pbpanel-updated"><?php echo __('Settings saved', 'pbpanel'); ?></div>		
	<?php } ?>
	<div class="pbpanel-box">
		<h2><?php echo __('Branding', 'pbpanel'); ?></h2>
	</div>
	<div class="pbpanel-box">
		<form action="" method="post" enctype="multipart/form-data">
		<p>
			<label for="pbpanel_site_skin"><?php echo __('Preset Skins', 'pbpanel'); ?></label>
			<span class="helptext"><?php echo __('Available skins', 'pbpanel'); ?></span>
			<select name="pbpanel_site_skin" id="pbpanel_site_skin" >
				<option value="default" <?php if (get_option('pbpanel_site_skin') == 'default') { ?> selected="selected" <?php } ?>><?php echo __('Default', 'pbpanel'); ?></option>
				<?php
					$results = scandir(SKINS_PATH);
					foreach ($results as $skin) {
						if ($skin === '.' || $skin === '..') {
							continue;
						} else {
							if (is_dir(SKINS_PATH . '/' . $skin)) {
							?>
							<option value="<?php echo $skin; ?>" <?php if (get_option('pbpanel_site_skin') == $skin) { ?> selected="selected" <?php } ?>><?php echo ucwords($skin); ?></option>
							<?php
							}	
						}
				}				
				?>
			</select>
		</p>
		<p>
			<label><?php echo __('Background Image', 'pbpanel'); ?></label>
			<span class="helptext"><?php echo __('Click to enable or disable skin background image', 'pbpanel'); ?></span>
			<label class="radio" for="pbpanel_site_bg_enable"><input type="radio" <?php if (get_option('pbpanel_site_bg') == 1) { ?> checked="checked" <?php } ?> value="1" id="pbpanel_site_bg_enable" name="pbpanel_site_bg"><span class="mark"><?php echo __('Enable', 'pbpanel'); ?></span></label>
			<label class="radio" for="pbpanel_site_bg_disable"><input type="radio" <?php if (get_option('pbpanel_site_bg') == 2) { ?> checked="checked" <?php } ?> value="2" id="pbpanel_site_bg_disable" name="pbpanel_site_bg"><span class="mark"><?php echo __('Disable', 'pbpanel'); ?></span></label>
		</p>
		<p><input type="submit" name="update_options" value="<?php echo __('Save settings', 'pbpanel'); ?>" class="pbpanel-button pbpanel-button-color-1"></p>
		</form>
	</div>
	<div class="pbpanel-box">
		<form action="" method="post" enctype="multipart/form-data">
		<p>
			<label for="pbpanel_site_logo"><?php echo __('Logo', 'pbpanel'); ?></label>
			<span class="helptext"><?php echo __('Upload site logo. Recommended size: 150 x 40 px', 'pbpanel'); ?></span>
			<?php if (get_option('pbpanel_site_logo') && get_option('pbpanel_site_logo') != '') { ?>
			<span class="preview-file">
				<span class="cell"><img src="<?php echo get_option('pbpanel_site_logo'); ?>" alt="<?php echo __('Site logo', 'pbpanel'); ?>"></span>
				<span class="cell"><input type="submit" name="delete_file" class="pbpanel-button-delete" title="<?php echo __('Delete File', 'pbpanel'); ?>" onclick="answer = window.confirm('<?php echo __('Are you sure you want to delete this file?', 'pbpanel'); ?>'); return answer;" value="<?php echo __('pbpanel_site_logo', 'pbpanel'); ?>"></span>
			</span>
			<?php } ?>
			<span class="pbpanel-input-file">
				<a class="pbpanel-button pbpanel-button-color-1" href="javascript:void(0)"><?php echo __('Choose File', 'pbpanel'); ?></a>
				<input type="text" readonly="readonly">
				<input type="file" name="pbpanel_site_logo" id="pbpanel_site_logo" onchange="jQuery(this).parent().find('input[type=text]').val(this.value);">
			</span>
		</p> 
		<p>
			<label for="pbpanel_site_favicon"><?php echo __('Favicon', 'pbpanel'); ?></label>
			<span class="helptext"><?php echo __('Upload site favicon', 'pbpanel'); ?></span>
			<?php if (get_option('pbpanel_site_favicon') && get_option('pbpanel_site_favicon') != '') { ?>
			<span class="preview-file">
				<span class="cell"><img src="<?php echo get_option('pbpanel_site_favicon'); ?>" alt="<?php echo __('Site favicon', 'pbpanel'); ?>"></span>
				<span class="cell"><input type="submit" name="delete_file" class="pbpanel-button-delete" title="<?php echo __('Delete File', 'pbpanel'); ?>" onclick="answer = window.confirm('<?php echo __('Are you sure you want to delete this file?', 'pbpanel'); ?>'); return answer;" value="<?php echo __('pbpanel_site_favicon', 'pbpanel'); ?>"></span>
			</span>
			<?php } ?>
			<span class="pbpanel-input-file">
				<a class="pbpanel-button pbpanel-button-color-1" href="javascript:void(0)"><?php echo __('Choose File', 'pbpanel'); ?></a>
				<input type="text" readonly="readonly">
				<input type="file" name="pbpanel_site_favicon" id="pbpanel_site_favicon" onchange="jQuery(this).parent().find('input[type=text]').val(this.value);">
			</span>
		</p>
		<p><input type="submit" name="upload_save_files" value="<?php echo __('Upload files and save', 'pbpanel'); ?>" class="pbpanel-button pbpanel-button-color-1"></p>
		</form>
	</div>
</div>

<?php get_template_part('pbpanel/footer'); ?>