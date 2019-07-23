<?php get_template_part('pbpanel/header'); ?>

<div class="pbpanel-column">
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
		<h2><?php echo __('Social Networks', 'pbpanel'); ?></h2>
	</div>
	<div class="pbpanel-box">
		<form action="" method="post" enctype="multipart/form-data">
		<p>
			<label><?php echo __('Show social icons in Pins', 'pbpanel'); ?></label>
			<span class="helptext"><?php echo __('Click to enable or disable icons in pinboxes to share posts on social networks', 'pbpanel'); ?></span>
			<label class="radio" for="pbpanel_pinbox_soc_icons_enable"><input type="radio" <?php if (get_option('pbpanel_pinbox_soc_icons') == 1) { ?> checked="checked" <?php } ?> value="1" id="pbpanel_pinbox_soc_icons_enable" name="pbpanel_pinbox_soc_icons"><span class="mark"><?php echo __('Enable', 'pbpanel'); ?></span></label>
			<label class="radio" for="pbpanel_pinbox_soc_icons_disable"><input type="radio" <?php if (get_option('pbpanel_pinbox_soc_icons') == 2) { ?> checked="checked" <?php } ?> value="2" id="pbpanel_pinbox_soc_icons_disable" name="pbpanel_pinbox_soc_icons"><span class="mark"><?php echo __('Disable', 'pbpanel'); ?></span></label>
		</p>
		<hr>
		<p>
			<label><?php echo __('Social icons in Footer', 'pbpanel'); ?></label>
			<span class="helptext"><?php echo __('Add links to your social profiles', 'pbpanel'); ?></span>
		</p>
		<p>
			<label for="pbpanel_url_facebook"><?php echo __('Facebook', 'pbpanel'); ?></label>
			<input type="text" name="pbpanel_url_facebook" id="pbpanel_url_facebook" value="<?php echo stripslashes_deep(get_option('pbpanel_url_facebook')); ?>">
		</p>
		<p>
			<label for="pbpanel_url_pinterest"><?php echo __('Pinterest', 'pbpanel'); ?></label>
			<input type="text" name="pbpanel_url_pinterest" id="pbpanel_url_pinterest" value="<?php echo stripslashes_deep(get_option('pbpanel_url_pinterest')); ?>">
		</p>
		<p>
			<label for="pbpanel_url_twitter"><?php echo __('Twitter', 'pbpanel'); ?></label>
			<input type="text" name="pbpanel_url_twitter" id="pbpanel_url_twitter" value="<?php echo stripslashes_deep(get_option('pbpanel_url_twitter')); ?>">
		</p>
		<p>
			<label for="pbpanel_url_instagram"><?php echo __('Instagram', 'pbpanel'); ?></label>
			<input type="text" name="pbpanel_url_instagram" id="pbpanel_url_instagram" value="<?php echo stripslashes_deep(get_option('pbpanel_url_instagram')); ?>">
		</p>
		<p>
			<label for="pbpanel_url_youtube"><?php echo __('Youtube', 'pbpanel'); ?></label>
			<input type="text" name="pbpanel_url_youtube" id="pbpanel_url_youtube" value="<?php echo stripslashes_deep(get_option('pbpanel_url_youtube')); ?>">
		</p>
		<p>
			<label for="pbpanel_url_linkedin"><?php echo __('LinkedIn', 'pbpanel'); ?></label>
			<input type="text" name="pbpanel_url_linkedin" id="pbpanel_url_linkedin" value="<?php echo stripslashes_deep(get_option('pbpanel_url_linkedin')); ?>">
		</p>
		<p>
			<label for="pbpanel_url_gplus"><?php echo __('Google+', 'pbpanel'); ?></label>
			<input type="text" name="pbpanel_url_gplus" id="pbpanel_url_gplus" value="<?php echo stripslashes_deep(get_option('pbpanel_url_gplus')); ?>">
		</p>
		<p>
			<label for="pbpanel_url_behance"><?php echo __('Behance', 'pbpanel'); ?></label>
			<input type="text" name="pbpanel_url_behance" id="pbpanel_url_behance" value="<?php echo stripslashes_deep(get_option('pbpanel_url_behance')); ?>">
		</p>
		<p>
			<label for="pbpanel_url_flickr"><?php echo __('Flickr', 'pbpanel'); ?></label>
			<input type="text" name="pbpanel_url_flickr" id="pbpanel_url_flickr" value="<?php echo stripslashes_deep(get_option('pbpanel_url_flickr')); ?>">
		</p>
		<p>
			<label for="pbpanel_url_foursquare"><?php echo __('Foursquare', 'pbpanel'); ?></label>
			<input type="text" name="pbpanel_url_foursquare" id="pbpanel_url_foursquare" value="<?php echo stripslashes_deep(get_option('pbpanel_url_foursquare')); ?>">
		</p>
		<p>
			<label for="pbpanel_url_vimeo"><?php echo __('Vimeo', 'pbpanel'); ?></label>
			<input type="text" name="pbpanel_url_vimeo" id="pbpanel_url_vimeo" value="<?php echo stripslashes_deep(get_option('pbpanel_url_vimeo')); ?>">
		</p>
		<p>
			<label for="pbpanel_url_soundcloud"><?php echo __('Soundcloud', 'pbpanel'); ?></label>
			<input type="text" name="pbpanel_url_soundcloud" id="pbpanel_url_soundcloud" value="<?php echo stripslashes_deep(get_option('pbpanel_url_soundcloud')); ?>">
		</p>
		<p><input type="submit" name="update_options" value="<?php echo __('Save settings', 'pbpanel'); ?>" class="pbpanel-button pbpanel-button-color-1"></p>
		</form>
	</div>
</div>

<?php get_template_part('pbpanel/footer'); ?>