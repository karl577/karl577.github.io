
<?php if (get_theme_mod( 'shaped_blog_home_layout' ) == 'col-md-8 col-md-push-4') { ?>
	<div class="col-md-4 col-md-pull-8">
	    <div class="primary-sidebar widget-area" role="complementary">
	        <?php dynamic_sidebar('shaped-blog-sidebar'); ?>
	    </div>
	</div>

<?php } elseif (get_theme_mod( 'shaped_blog_home_layout' ) == 'col-md-8') { ?>
	<div class="col-md-4">
	    <div class="primary-sidebar widget-area" role="complementary">
	        <?php dynamic_sidebar('shaped-blog-sidebar'); ?>
	    </div>
	</div>

<?php } elseif (get_theme_mod( 'shaped_blog_home_layout' ) == 'col-md-12') {

	//No Sidebar

} else { ?>
	<div class="col-md-4">
	    <div class="primary-sidebar widget-area" role="complementary">
	        <?php dynamic_sidebar('shaped-blog-sidebar'); ?>
	    </div>
	</div>
<?php } ?>