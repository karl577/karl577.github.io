<?php

if ( ! function_exists( 'shaped_blog_color_theme' ) ) :

function shaped_blog_color_theme(){?>

	<style>

		/* Border Color */
		.btn-social:hover,
		blockquote,
		#respond input:focus[type="text"], 
	    #respond input:focus[type="email"], 
	    #respond input:focus[type="url"],
	    #respond textarea:focus,
	    #comments .comment-reply a:hover
		{
			border-color: <?php echo esc_attr(get_theme_mod('shaped_blog_theme_color')); ?>;
		}

		
		/* Background Color */
		.scroll-up a,
		.btn-social:hover,
		button,
		input[type="button"],
		input[type="reset"],
		input[type="submit"],
		.navbar-default .navbar-nav .dropdown-menu li a:hover, .dropdown-menu li a:focus, .navbar-default .navbar-nav .dropdown-menu .active a,
		.pagination>li>a:focus, .pagination>li>a:hover, .pagination>li>span:focus, .pagination>li>span:hover, .pagination li .current,
		.next-previous-posts .next-post a:hover,
		.next-previous-posts .previous-post a:hover,
		.btn-goback,
		.btn-submit,
		a.more-link,
		.featured-post .fa,
		#comments .comment-reply a:hover,
		.widget .tagcloud a
		{
			background-color: <?php echo esc_attr(get_theme_mod('shaped_blog_theme_color')); ?>;
		}

		
		/* Color */
		.text-logo a,
		.navbar-default .navbar-nav .active a, .navbar-default .navbar-nav .active a:hover, .navbar-default .navbar-nav .active a:focus,
		.navbar-default .navbar-nav li a:hover, .navbar-default .navbar-nav li a:focus,
		a:hover,
    	a:focus,
		.next-previous-posts .previous-post a,
		.next-previous-posts .next-post a,
		.pagination>li>a, .pagination>li>span,
		#comments .comment-author a:hover, 
    	#respond .logged-in-as a:hover,
    	#wp-calendar a,
    	h2.entry-title a:hover
		{
			color: <?php echo esc_attr(get_theme_mod('shaped_blog_theme_color')); ?>;
		}


		/* A Color */
		a{
			color: <?php echo esc_attr(get_theme_mod('shaped_blog_anchor_color')); ?>;
		}

		/* a:hover Color */
		a:hover,
		a:focus,
		a:active,
		.widget a:hover,
		.post .post-content .entry-meta ul li a:hover
		{
			color: <?php echo esc_attr(get_theme_mod('shaped_blog_anchor_hover_color')); ?>;
		}

		/* .featured-post .fa:after*/
		.featured-post .fa:after{
			border-color: <?php echo esc_attr(get_theme_mod('shaped_blog_theme_color')); ?> <?php echo esc_attr(get_theme_mod('shaped_blog_theme_color')); ?> transparent <?php echo esc_attr(get_theme_mod('shaped_blog_theme_color')); ?>;
		}


		<?php if (get_theme_mod('shaped_blog_custom_css')) {
			echo wp_strip_all_tags(get_theme_mod('shaped_blog_custom_css'));
		} ?>


	</style>
<?php
}
add_action('wp_head', 'shaped_blog_color_theme');

endif;
