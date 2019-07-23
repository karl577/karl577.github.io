<?php 
		
		if('page' == get_option('show_on_front')){ get_template_part('index');}

		else {
		get_header();
		//****** Get Feature Image ********//
		get_template_part('index', 'static-banner');

		//****** get index service  ********
		get_template_part('index', 'service');
		
		//****** get index portfolio  ********
		get_template_part('index', 'portfolio');
		
		//****** get index blog  ********
		get_template_part('index', 'blog');

		get_footer(); 
		}
?>