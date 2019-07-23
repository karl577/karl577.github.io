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
		<h2><?php echo __('Slider', 'pbpanel'); ?></h2>
	</div>
	<div class="pbpanel-box">
		<form action="" method="post" enctype="multipart/form-data">
		<p>
			<label><?php echo __('Show Slider', 'pbpanel'); ?></label>
			<span class="helptext"><?php echo __('Make slider appear on the front page or all pages', 'pbpanel'); ?></span>
			<label class="radio" for="pbpanel_slider_show_disable"><input type="radio" <?php if (get_option('pbpanel_slider_show') == 1) { ?> checked="checked" <?php } ?> value="1" id="pbpanel_slider_show_disable" name="pbpanel_slider_show"><span class="mark"><?php echo __('Disable', 'pbpanel'); ?></span></label>
			<label class="radio" for="pbpanel_slider_show_frontpage"><input type="radio" <?php if (get_option('pbpanel_slider_show') == 2) { ?> checked="checked" <?php } ?> value="2" id="pbpanel_slider_show_frontpage" name="pbpanel_slider_show"><span class="mark"><?php echo __('Front Page', 'pbpanel'); ?></span></label>
			<label class="radio" for="pbpanel_slider_show_allpages"><input type="radio" <?php if (get_option('pbpanel_slider_show') == 3) { ?> checked="checked" <?php } ?> value="3" id="pbpanel_slider_show_allpages" name="pbpanel_slider_show"><span class="mark"><?php echo __('All Pages', 'pbpanel'); ?></span></label>
		</p>
		<p><input type="submit" name="update_options" value="<?php echo __('Save settings', 'pbpanel'); ?>" class="pbpanel-button pbpanel-button-color-1"></p>
		</form>
	</div>
	<div class="pbpanel-box">
		<form action="" method="post" enctype="multipart/form-data">
		<h3><?php echo __('Slider Options', 'pbpanel'); ?></h3>
		<hr>
		<p>
			<label><?php echo __('Arrows', 'pbpanel'); ?></label>
			<span class="helptext"><?php echo __('Arrows are used to navigate back and forth between the slides', 'pbpanel'); ?></span>
			<label class="radio" for="pbpanel_slider_arrows_enable"><input type="radio" <?php if (get_option('pbpanel_slider_arrows') == 'true') { ?> checked="checked" <?php } ?> value="true" id="pbpanel_slider_arrows_enable" name="pbpanel_slider_arrows"><span class="mark"><?php echo __('Enable', 'pbpanel'); ?></span></label>
			<label class="radio" for="pbpanel_slider_arrows_disable"><input type="radio" <?php if (get_option('pbpanel_slider_arrows') == 'false') { ?> checked="checked" <?php } ?> value="false" id="pbpanel_slider_arrows_disable" name="pbpanel_slider_arrows"><span class="mark"><?php echo __('Disable', 'pbpanel'); ?></span></label>
		</p>
		<p>
			<label><?php echo __('Arrows Constraint', 'pbpanel'); ?></label>
			<span class="helptext"><?php echo __('When you get to the end of the slides pressing the next arrow will navigate you to the beginning again should you have a false constraint. The same applies to the previous arrow', 'pbpanel'); ?></span>
			<label class="radio" for="pbpanel_slider_arrows_constraint_enable"><input type="radio" <?php if (get_option('pbpanel_slider_arrows_constraint') == 'true') { ?> checked="checked" <?php } ?> value="true" id="pbpanel_slider_arrows_constraint_enable" name="pbpanel_slider_arrows_constraint"><span class="mark"><?php echo __('Enable', 'pbpanel'); ?></span></label>
			<label class="radio" for="pbpanel_slider_arrows_constraint_disable"><input type="radio" <?php if (get_option('pbpanel_slider_arrows_constraint') == 'false') { ?> checked="checked" <?php } ?> value="false" id="pbpanel_slider_arrows_constraint_disable" name="pbpanel_slider_arrows_constraint"><span class="mark"><?php echo __('Disable', 'pbpanel'); ?></span></label>
		</p>
		<hr>
		<p>
			<label><?php echo __('Autoplay', 'pbpanel'); ?></label>
			<span class="helptext"><?php echo __('Sets the slider to run automatically. A manual slider resets pause interval', 'pbpanel'); ?></span>
			<label class="radio" for="pbpanel_slider_slideshow_enable"><input type="radio" <?php if (get_option('pbpanel_slider_slideshow') == 'true') { ?> checked="checked" <?php } ?> value="true" id="pbpanel_slider_slideshow_enable" name="pbpanel_slider_slideshow"><span class="mark"><?php echo __('Enable', 'pbpanel'); ?></span></label>
			<label class="radio" for="pbpanel_slider_slideshow_disable"><input type="radio" <?php if (get_option('pbpanel_slider_slideshow') == 'false') { ?> checked="checked" <?php } ?> value="false" id="pbpanel_slider_slideshow_disable" name="pbpanel_slider_slideshow"><span class="mark"><?php echo __('Disable', 'pbpanel'); ?></span></label>
		</p>
		<p>
			<label for="pbpanel_slider_slideshow_delay"><?php echo __('Pause Interval', 'pbpanel'); ?></label>
			<span class="helptext"><?php echo __('The time interval between image changes in seconds', 'pbpanel'); ?></span>
			<input type="text" name="pbpanel_slider_slideshow_delay" id="pbpanel_slider_slideshow_delay" value="<?php echo stripslashes_deep(get_option('pbpanel_slider_slideshow_delay')); ?>">
		</p>
		<hr>
		<p>
			<label><?php echo __('Block Text', 'pbpanel'); ?></label>
			<span class="helptext"><?php echo __('Will show a black transparent color behind slide title and text for easy reading', 'pbpanel'); ?></span>
			<label class="radio" for="pbpanel_slider_blocktext_enable"><input type="radio" <?php if (get_option('pbpanel_slider_blocktext') == 'true') { ?> checked="checked" <?php } ?> value="true" id="pbpanel_slider_blocktext_enable" name="pbpanel_slider_blocktext"><span class="mark"><?php echo __('Enable', 'pbpanel'); ?></span></label>
			<label class="radio" for="pbpanel_slider_blocktext_disable"><input type="radio" <?php if (get_option('pbpanel_slider_blocktext') == 'false') { ?> checked="checked" <?php } ?> value="false" id="pbpanel_slider_blocktext_disable" name="pbpanel_slider_blocktext"><span class="mark"><?php echo __('Disable', 'pbpanel'); ?></span></label>
		</p>
		<hr>
		<p>
			<label><?php echo __('Dot Navigation', 'pbpanel'); ?></label>
			<span class="helptext"><?php echo __('Dot navigation is used to indicate and navigate between the slides', 'pbpanel'); ?></span>
			<label class="radio" for="pbpanel_slider_dotnav_enable"><input type="radio" <?php if (get_option('pbpanel_slider_dotnav') == 'true') { ?> checked="checked" <?php } ?> value="true" id="pbpanel_slider_dotnav_enable" name="pbpanel_slider_dotnav"><span class="mark"><?php echo __('Enable', 'pbpanel'); ?></span></label>
			<label class="radio" for="pbpanel_slider_dotnav_disable"><input type="radio" <?php if (get_option('pbpanel_slider_dotnav') == 'false') { ?> checked="checked" <?php } ?> value="false" id="pbpanel_slider_dotnav_disable" name="pbpanel_slider_dotnav"><span class="mark"><?php echo __('Disable', 'pbpanel'); ?></span></label>
		</p>
		<p>
			<label for="pbpanel_slider_dotnav_alignment"><?php echo __('Dot Alignment', 'pbpanel'); ?></label>
			<span class="helptext"><?php echo __('Set the horizontal alignment of the dots to either left, center or right', 'pbpanel'); ?></span>
			<select name="pbpanel_slider_dotnav_alignment" id="pbpanel_slider_dotnav_alignment" >
				<option value="left" <?php if (get_option('pbpanel_slider_dotnav_alignment') == 'left') { ?> selected="selected" <?php } ?>><?php echo __('Left', 'pbpanel'); ?></option>
				<option value="center" <?php if (get_option('pbpanel_slider_dotnav_alignment') == 'center') { ?> selected="selected" <?php } ?>><?php echo __('Center', 'pbpanel'); ?></option>
				<option value="right" <?php if (get_option('pbpanel_slider_dotnav_alignment') == 'right') { ?> selected="selected" <?php } ?>><?php echo __('Right', 'pbpanel'); ?></option>
			</select>
		</p>
		<hr>
		<p>
			<label for="pbpanel_slider_slide_position"><?php echo __('Slide Position', 'pbpanel'); ?></label>
			<span class="helptext"><?php echo __('Set the starting slide', 'pbpanel'); ?></span>
			<input type="text" name="pbpanel_slider_slide_position" id="pbpanel_slider_slide_position" value="<?php echo stripslashes_deep(get_option('pbpanel_slider_slide_position')); ?>">
		</p>
		<p><input type="submit" name="update_options" value="<?php echo __('Save settings', 'pbpanel'); ?>" class="pbpanel-button pbpanel-button-color-1"></p>
		</form>
	</div>
</div>

<?php get_template_part('pbpanel/footer'); ?>