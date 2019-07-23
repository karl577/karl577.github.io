<p><iframe src="<?php echo get_permalink( zm_get_option('user_profile') ); ?>" width="100%" height="800" frameborder="0"></iframe></p>
<?php if (zm_get_option('scroll')) { ?>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/infinite-scroll.js"></script>
<?php } ?>