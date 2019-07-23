<?php

     
    add_action('admin_menu', 'proper_lite_setup_menu');
     
    function proper_lite_setup_menu(){
    	add_theme_page( esc_html__('Proper Lite Theme Details', 'proper-lite' ), esc_html__('Proper Lite Theme Details', 'proper-lite' ), 'edit_theme_options', 'proper-lite-setup', 'proper_lite_init' ); 
    }  
      
 	function proper_lite_init(){
		
		wp_enqueue_style( 'proper-lite-font-awesome-admin', get_template_directory_uri() . '/fonts/font-awesome.css' ); 
		wp_enqueue_style( 'proper-lite-style-admin', get_template_directory_uri() . '/panel/css/theme-admin-style.css' ); 
		
	 	echo '<div class="grid grid-pad"><div class="col-1-1"><h1 style="text-align: center;">'; 
		printf( esc_html__('Thank you for using Proper Lite!', 'proper-lite' )); 
        echo "</h1></div></div>";
			
		echo '<div class="grid grid-pad" style="border-bottom: 1px solid #ccc; padding-bottom: 40px; margin-bottom: 30px;" ><div class="col-1-3"><h2>'; 
		printf( esc_html__('Premium Plugins', 'proper-lite' )); 
        echo '</h2>';
		
		echo '<p>';
		printf( esc_html__('Want to add more functionality to your theme? Use ModernThemes Premium Plugins to add content to your widget areas and pages.', 'proper-lite' )); 
		echo '</p>';
		
		echo '<a href="https://modernthemes.net/plugins/" target="_blank"><button>'; 
		printf( esc_html__('Get Plugins', 'proper-lite' ));  
		echo "</button></a></div>";
		
		echo '<div class="col-1-3"><h2>'; 
		printf( esc_html__('Documentation', 'proper-lite' ));
        echo '</h2>';  
		
		echo '<p>';
		printf( esc_html__('Check out our Proper Documentation to learn how to use Proper and for tutorials on theme functions. ', 'proper-lite' ));  
		echo '</p>'; 
		
		echo '<a href="https://modernthemes.net/proper-lite-documentation/" target="_blank"><button>';
		printf( esc_html__('Read Docs', 'proper-lite' ));
		echo "</button></a></div>";
		
		echo '<div class="col-1-3"><h2>'; 
		printf( esc_html__('ModernThemes', 'proper-lite' )); 
        echo '</h2>';  
		
		echo '<p>';
		printf( esc_html__('Need some more themes? We have a large selection of both free and premium themes to add to your collection.', 'proper-lite' ));
		echo '</p>';
		
		echo '<a href="https://modernthemes.net/" target="_blank"><button>'; 
		printf( esc_html__('Visit Us', 'proper-lite' ));
		echo '</button></a></div></div>';
		
		echo '<div class="grid grid-pad senswp"><div class="col-1-1"><h1 style="padding-bottom: 30px; text-align: center;">';
		printf( esc_html__('Get the Premium Experience.', 'proper-lite' )); 
		echo '</h1></div>';
		
        echo '<div class="col-1-4"><i class="fa fa-cogs"></i><h4>';
		printf( esc_html__('Plugin Compatibility', 'proper-lite' ));
		echo '</h4>';
		
        echo '<p>';
		printf( esc_html__('Use our new free plugins with this theme to add functionality for things like projects, clients, team members and more. Compatible with all premium themes!', 'proper-lite' ));
		echo '</p></div>';
		
		echo '<div class="col-1-4"><i class="fa fa-home"></i><h4>';
        printf( esc_html__('More Widget Areas', 'proper-lite' ));
		echo '</h4>';
		
        echo '<p>';
		printf( esc_html__('Add more plugin content as Proper Premium comes with 3 additional home widget areas and 1 Footer Call-to-Action to work with.', 'proper-lite' )); 
		echo '</p></div>';
		
        echo '<div class="col-1-4"><i class="fa fa-image"></i><h4>';
        printf( esc_html__('Sliders + Video', 'proper-lite' ));
		echo '</h4>';
		
        echo '<p>';
		printf( esc_html__('Make your brand more modern with sliders or fullscreen video on your home page. The best looking websites give the best first impressions.', 'proper-lite' ));
		echo '</p></div>'; 
		
		echo '<div class="col-1-4"><i class="fa fa-th"></i><h4>';
        printf( esc_html__('Footer Widget Areas', 'proper-lite' ));
		echo '</h4>';
		
        echo '<p>';
		printf( esc_html__('Want more content for your footer? Proper Premium has footer widget areas to populate with any content you want.', 'proper-lite' ));
		echo '</p></div>';
		
            
        echo '<div class="grid grid-pad senswp"><div class="col-1-4"><i class="fa fa-shopping-cart"></i><h4>'; 
		printf( esc_html__( 'WooCommerce', 'proper-lite' ));
		echo '</h4>';
		
        echo '<p>';
		printf( esc_html__( 'Turn your website into a powerful eCommerce machine. Proper Premium is fully compatible with WooCommerce.', 'proper-lite' ));
		echo '</p></div>';
		
       	echo '<div class="col-1-4"><i class="fa fa-font"></i><h4>More Google Fonts</h4><p>';
		printf( esc_html__( 'Access an additional 65 Google fonts with Proper right in the WordPress customizer.', 'proper-lite' ));
		echo '</p></div>'; 
		
       	echo '<div class="col-1-4"><i class="fa fa-file-image-o"></i><h4>';
		printf( esc_html__( 'PSD Files', 'proper-lite' ));
		echo '</h4>';
		
        echo '<p>';
		printf( esc_html__( 'Premium versions include PSD files. Preview your own content or showcase a customized version for your clients.', 'proper-lite' ));
		echo '</p></div>';
            
        echo '<div class="col-1-4"><i class="fa fa-support"></i><h4>';
		printf( esc_html__( 'Free Support', 'proper-lite' )); 
		echo '</h4>';
		
        echo '<p>';
		printf( esc_html__( 'Call on us to help you out. Premium themes come with free support that goes directly to our support staff.', 'proper-lite' ));
		echo '</p></div></div>';
		
		echo '<div class="grid grid-pad" style="border-bottom: 1px solid #ccc; padding-bottom: 50px; margin-bottom: 30px;"><div class="col-1-1"><a href="https://modernthemes.net/wordpress-themes/proper-lite/proper-premium/" target="_blank"><button class="pro">'; 
		printf( esc_html__( 'View Premium Version', 'proper-lite' )); 
		echo '</button></a></div></div>';
		
		
		
		echo '<div class="grid grid-pad senswp"><div class="col-1-1"><h1 style="padding-bottom: 30px; text-align: center;">';
		printf( esc_html__('Premium Membership. Premium Experience.', 'proper-lite' )); 
		echo '</h1></div>';
		
        echo '<div class="col-1-4"><i class="fa fa-cogs"></i><h4>'; 
		printf( esc_html__('Plugin Compatibility', 'proper-lite' ));
		echo '</h4>';
		
        echo '<p>';
		printf( esc_html__('Use our new free plugins with this theme to add functionality for things like projects, clients, team members and more. Compatible with all premium themes!', 'proper-lite' ));
		echo '</p></div>';
		
		echo '<div class="col-1-4"><i class="fa fa-desktop"></i><h4>'; 
        printf( esc_html__('Agency Designed Themes', 'proper-lite' ));
		echo '</h4>';
		
        echo '<p>';
		printf( esc_html__('Look as good as can be with our new premium themes. Each one is agency designed with modern styles and professional layouts.', 'proper-lite' ));
		echo '</p></div>'; 
		
        echo '<div class="col-1-4"><i class="fa fa-users"></i><h4>';
        printf( esc_html__('Membership Options', 'proper-lite' )); 
		echo '</h4>';
		
        echo '<p>';
		printf( esc_html__('We have options to fit every budget. Choose between a single theme, or access to all current and future themes for a year, or forever!', 'proper-lite' ));
		echo '</p></div>'; 
		
		echo '<div class="col-1-4"><i class="fa fa-calendar"></i><h4>'; 
		printf( esc_html__( 'Access to New Themes', 'proper-lite' )); 
		echo '</h4>';
		
        echo '<p>';
		printf( esc_html__( 'New themes added monthly! When you purchase a premium membership you get access to all premium themes, with new themes added monthly.', 'proper-lite' ));   
		echo '</p></div>';
		
		
		echo '<div class="grid grid-pad" style="border-bottom: 1px solid #ccc; padding-bottom: 50px; margin-bottom: 30px;"><div class="col-1-1"><a href="https://modernthemes.net/premium-wordpress-themes/" target="_blank"><button class="pro">'; 
		printf( esc_html__( 'Get Premium Membership', 'proper-lite' ));
		echo '</button></a></div></div>';
		
		
		echo '<div class="grid grid-pad"><div class="col-1-1"><h2 style="text-align: center;">';
		printf( esc_html__( 'Changelog' , 'proper-lite' ) );
        echo "</h2>";
		
		echo '<p style="text-align: center;">'; 
		printf( esc_html__('1.2.1 - Fix: font selector now changes the side menu navigation font', 'proper-lite' )); 
		echo '</p>';
		
		echo '<p style="text-align: center;">'; 
		printf( esc_html__('1.2.0 - Fix: number input bug in theme customizer', 'proper-lite' )); 
		echo '</p>';
		
		echo '<p style="text-align: center;">'; 
		printf( esc_html__('1.1.9 - Fix: removed http from Skype social icons', 'proper-lite' )); 
		echo '</p>';
		
		echo '<p style="text-align: center;">'; 
		printf( esc_html__('1.1.7 - Update: Tested with WordPress 4.5, Updating Font Awesome icons to 4.6, Added Snapchat and Weibo social icon options', 'proper-lite' )); 
		echo '</p>';
		
		echo '<p style="text-align: center;">'; 
		printf( esc_html__('1.1.6 - Update: added many new social icon options to MT - Social Icons widget', 'proper-lite' )); 
		echo '</p>';
		
		echo '<p style="text-align: center;">'; 
		printf( esc_html__('1.1.5 - Fix: mobile menu bug fix for android devices', 'proper-lite' ));
		echo '</p>';
		
		echo '<p style="text-align: center;">'; 
		printf( esc_html__('1.1.4 - Update: added option to display full content on Blog page. Go to Appearance => Customize => Blog and select Content under Post Content to show full content.', 'proper-lite' ));
		echo '</p>';
		
		echo '<p style="text-align: center;">';  
		printf( esc_html__('1.1.3 - Fix: bug fixes for plugins on multisite', 'proper-lite' )); 
		echo '</p>';
		
		echo '<p style="text-align: center;">'; 
		printf( esc_html__('1.1.1 - Fix: bug fixes for hero section on tablets', 'proper-lite' )); 
		echo '</p>'; 
		
		echo '<p style="text-align: center;">'; 
		printf( esc_html__('1.1.0 - Update: updated demo link in theme description', 'proper-lite' )); 
		echo '</p>'; 
		
		echo '<p style="text-align: center;">'; 
		printf( esc_html__('1.0.0 - New Theme!', 'proper-lite' )); 
		echo '</p></div></div>';
		
    }
	
?>