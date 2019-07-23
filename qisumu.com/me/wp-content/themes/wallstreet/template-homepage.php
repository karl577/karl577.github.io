		<?php 
		/**
		Template Name: Home Page
		*/
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
		
		?>