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
		<h2><?php echo __('Main', 'pbpanel'); ?></h2>
	</div>
	<div class="pbpanel-box">
		<form action="" method="post" enctype="multipart/form-data">
		<p>
			<label><?php echo __('Infinite scroll', 'pbpanel'); ?></label>
			<span class="helptext"><?php echo __('Click to enable or disable infinite scroll', 'pbpanel'); ?></span>
			<label class="radio" for="pbpanel_infinite_scroll_enable"><input type="radio" <?php if (get_option('pbpanel_infinite_scroll') == 1) { ?> checked="checked" <?php } ?> value="1" id="pbpanel_infinite_scroll_enable" name="pbpanel_infinite_scroll"><span class="mark"><?php echo __('Enable', 'pbpanel'); ?></span></label>
			<label class="radio" for="pbpanel_infinite_scroll_disable"><input type="radio" <?php if (get_option('pbpanel_infinite_scroll') == 2) { ?> checked="checked" <?php } ?> value="2" id="pbpanel_infinite_scroll_disable" name="pbpanel_infinite_scroll"><span class="mark"><?php echo __('Disable', 'pbpanel'); ?></span></label>
		</p>
		<hr>
		<p>
			<label><?php echo __('Links To Posts In Same Category', 'pbpanel'); ?></label>
			<span class="helptext"><?php echo __('Displays links to the previous/next post within the same category as the current post.', 'pbpanel'); ?></span>
			<label class="radio" for="pbpanel_posts_in_same_cat_enable"><input type="radio" <?php if (get_option('pbpanel_posts_in_same_cat') == 1) { ?> checked="checked" <?php } ?> value="1" id="pbpanel_posts_in_same_cat_enable" name="pbpanel_posts_in_same_cat"><span class="mark"><?php echo __('Enable', 'pbpanel'); ?></span></label>
			<label class="radio" for="pbpanel_posts_in_same_cat_disable"><input type="radio" <?php if (get_option('pbpanel_posts_in_same_cat') == 2) { ?> checked="checked" <?php } ?> value="2" id="pbpanel_posts_in_same_cat_disable" name="pbpanel_posts_in_same_cat"><span class="mark"><?php echo __('Disable', 'pbpanel'); ?></span></label>
		</p>
		<hr>
		<p>
			<label><?php echo __('Pinboxes Metadata', 'pbpanel'); ?></label>
			<span class="helptext"><?php echo __('Choose whether to show the date and number of comments', 'pbpanel'); ?></span>
			<label class="checkbox" for="pbpanel_pinbox_show_comments">
				<input type="hidden" value="0" name="pbpanel_pinbox_show_comments">
				<input type="checkbox" <?php if (get_option('pbpanel_pinbox_show_comments') == 1) { ?> checked="checked" <?php } ?> value="1" id="pbpanel_pinbox_show_comments" name="pbpanel_pinbox_show_comments">
				<span class="mark"><?php echo __('Show number of comments', 'pbpanel'); ?></span>
			</label>
			<label class="checkbox" for="pbpanel_pinbox_show_postdate">
				<input type="hidden" value="0" name="pbpanel_pinbox_show_postdate">
				<input type="checkbox" <?php if (get_option('pbpanel_pinbox_show_postdate') == 1) { ?> checked="checked" <?php } ?> value="1" id="pbpanel_pinbox_show_postdate" name="pbpanel_pinbox_show_postdate">
				<span class="mark"><?php echo __('Show post date', 'pbpanel'); ?></span>
			</label>
		</p>
		<hr>
		<p>
			<label for="pbpanel_header_code"><?php echo __('Header Code', 'pbpanel'); ?></label>
			<span class="helptext"><?php echo __('Add code to the head of your blog', 'pbpanel'); ?></span>
			<textarea name="pbpanel_header_code" id="pbpanel_header_code"><?php echo stripslashes_deep(get_option('pbpanel_header_code')); ?></textarea>
		</p>
		<p>
			<label for="pbpanel_google_code"><?php echo __('Google Analytics Code', 'pbpanel'); ?></label>
			<span class="helptext"><?php echo __('Paste your Google Analytics tracking code here', 'pbpanel'); ?></span>
			<textarea name="pbpanel_google_code" id="pbpanel_google_code"><?php echo stripslashes_deep(get_option('pbpanel_google_code')); ?></textarea>
		</p>
		<p>
			<label for="pbpanel_footer_showlinks"><?php echo __('Number of Links displayed in Footer', 'pbpanel'); ?></label>
			<span class="helptext"><?php echo __('Pages, Bookmarks, Recent Posts, Popular Posts', 'pbpanel'); ?></span>
			<input type="text" name="pbpanel_footer_showlinks" id="pbpanel_footer_showlinks" value="<?php echo stripslashes_deep(get_option('pbpanel_footer_showlinks')); ?>">
		</p>
		<p>
			<label for="pbpanel_footer_copyright"><?php echo __('Footer text', 'pbpanel'); ?></label>
			<span class="helptext"><?php echo __('Enter footer text ex. copyright description', 'pbpanel'); ?><br><?php echo __('Default:', 'pbpanel'); ?> <?php echo __('Copyright', 'pbpanel'); ?> &copy; <?php echo date("Y"); ?> <?php bloginfo('name'); ?></span>
			<input type="text" name="pbpanel_footer_copyright" id="pbpanel_footer_copyright"  value="<?php echo stripslashes_deep(get_option('pbpanel_footer_copyright')); ?>">
		</p>
		<p><input type="submit" name="update_options" value="<?php echo __('Save settings', 'pbpanel'); ?>" class="pbpanel-button pbpanel-button-color-1"></p>
		</form>
	</div>
</div>

<?php get_template_part('pbpanel/footer'); ?>