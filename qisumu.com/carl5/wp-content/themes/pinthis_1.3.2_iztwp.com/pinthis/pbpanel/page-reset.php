<?php get_template_part('pbpanel/header'); ?>

<div class="pbpanel-column">
	<?php if (isset($_POST["update_options"])) { ?>
		<?php pbpanel_options('update_option'); ?>
		<div class="pbpanel-box pbpanel-updated"><?php echo __('The Reset complete successfully', 'pbpanel'); ?></div>		
	<?php } ?>
	<div class="pbpanel-box">
		<h2><?php echo __('Reset', 'pbpanel'); ?></h2>
	</div>
	<div class="pbpanel-box">
		<form action="" method="post" enctype="multipart/form-data">
		<h3><?php echo __('Reset PB Panel', 'pbpanel'); ?></h3>
		<p><?php echo __('Restore theme options to default settings', 'pbpanel'); ?></p>
		<hr>
		<p><input type="submit" name="update_options" value="<?php echo __('Reset settings', 'pbpanel'); ?>" class="pbpanel-button pbpanel-button-color-1" onclick="answer = window.confirm('<?php echo __('Are you sure you want to reset all settings to the default values?', 'pbpanel'); ?>'); return answer;"></p>
		</form>
	</div>
</div>

<?php get_template_part('pbpanel/footer'); ?>