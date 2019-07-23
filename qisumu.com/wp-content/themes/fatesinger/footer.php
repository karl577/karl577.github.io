<nav class="footernav"><?php wp_nav_menu( array( 'theme_location' => 'singlenav','menu_id'=>'footnav','container'=>'ul')); ?></nav>
<?php wp_footer();?>
<p class="link-back2top"><a href="#" title="Back to top">Back to top</a></p>

	<div class="statistic">
		<?php if( dopt('fate_track_b') != '' ) echo dopt('fate_track'); ?>
	</div>




	<script type="text/javascript" src="<?php bloginfo('template_url');?>/js/xBorder.js"></script>
	<script type="text/javascript" src="<?php bloginfo('template_url');?>/js/lazyload.js"></script>

</body>
</html>