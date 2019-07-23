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
		<h2><?php echo __('SEO', 'pbpanel'); ?></h2>
	</div>
	<div class="pbpanel-box">
		<form action="" method="post" enctype="multipart/form-data">
		<p>
			<label for="pbpanel_meta_keywords"><?php echo __('Keywords', 'pbpanel'); ?></label>
			<span class="helptext"><?php echo __('Words that identify what the page is about, usually used in search engines', 'pbpanel'); ?></span>
			<input type="text" name="pbpanel_meta_keywords" id="pbpanel_meta_keywords" value="<?php echo stripslashes_deep(get_option('pbpanel_meta_keywords')); ?>">
		</p>
		<p>
			<label for="pbpanel_meta_description"><?php echo __('Description', 'pbpanel'); ?></label>
			<span class="helptext"><?php echo __('A short description of the page', 'pbpanel'); ?></span>
			<input type="text" name="pbpanel_meta_description" id="pbpanel_meta_description" value="<?php echo stripslashes_deep(get_option('pbpanel_meta_description')); ?>">
		</p>
		<p>
			<label for="pbpanel_meta_author"><?php echo __('Author', 'pbpanel'); ?></label>
			<span class="helptext"><?php echo __('The author\'s name and possibly email address', 'pbpanel'); ?></span>
			<input type="text" name="pbpanel_meta_author" id="pbpanel_meta_author" value="<?php echo stripslashes_deep(get_option('pbpanel_meta_author')); ?>">
		</p>
		<p>
			<label for="pbpanel_title_separator"><?php echo __('Define a character to separate Blog name and Post title', 'pbpanel'); ?></label>
			<input type="text" name="pbpanel_title_separator" id="pbpanel_title_separator" value="<?php echo stripslashes_deep(get_option('pbpanel_title_separator')); ?>">
		</p>
		<p><input type="submit" name="update_options" value="<?php echo __('Save settings', 'pbpanel'); ?>" class="pbpanel-button pbpanel-button-color-1"></p>
		</form>
	</div>
</div>

<?php get_template_part('pbpanel/footer'); ?>