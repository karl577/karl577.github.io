<?php 

			
/*-----------------------------------------------------------------------------------------------------//
	Home Widget One
-------------------------------------------------------------------------------------------------------*/
	
function proper_lite_home_widget_one_style() {

	$widget_column_one = esc_html( get_theme_mod( 'proper_lite_widget_column_one' ));
    			
	if( $widget_column_one != '' ) { 
    
		switch ( $widget_column_one ) { 
            	
			case 'option1':
            // 1 Column 
            break;
			
           	case 'option2':
                	
				echo '<style type="text/css">';
                echo '.home-widget-one .widget, .home-widget-one section { width: 50%; float:left; padding-right: 30px; }';
				echo '@media handheld, only screen and (max-width: 767px) {';
				echo '.home-widget-one .widget, .home-widget-one section { width: 100%; float:none; padding-right: 0px; }';
                echo '}';
				echo '</style>';
                break;
				
           	case 'option3': 
			
                echo '<style type="text/css">';
                echo '.home-widget-one .widget, .home-widget-one section { width: 33.33%; float:left; padding-right: 30px; }';
				echo '@media handheld, only screen and (max-width: 767px) {';
				echo '.home-widget-one .widget, .home-widget-one section { width: 100%; float:none; padding-right: 0px; }';
                echo '}';
				echo '</style>';
                break;
				
			case 'option4':
                	
				echo '<style type="text/css">';
                echo '.home-widget-one .widget, .home-widget-one section { width: 25%; float:left; padding-right: 30px; }'; 
				echo '@media handheld, only screen and (max-width: 767px) {';
				echo '.home-widget-one .widget, .home-widget-one section { width: 100%; float:none; padding-right: 0px; }';
                echo '}'; 
				echo '</style>';
                break; 
				
        }
    }
	
}
	
add_action( 'wp_enqueue_scripts', 'proper_lite_home_widget_one_style' );
	
	
	
/*-----------------------------------------------------------------------------------------------------//
	Home Widget Two
-------------------------------------------------------------------------------------------------------*/

function proper_lite_home_widget_two_style() {
	
	$widget_column_two = esc_html( get_theme_mod( 'proper_lite_widget_column_two' ));
    			
	if( $widget_column_two != '' ) {
    
		switch ( $widget_column_two ) { 
            	
			case 'option1':
            // 1 Column 
            break;
			
           	case 'option2':
                	
				echo '<style type="text/css">';
                echo '.home-widget-two .widget, .home-widget-two section { width: 50%; float:left; padding-right: 30px; }';
				echo '@media handheld, only screen and (max-width: 767px) {';
				echo '.home-widget-two .widget, .home-widget-two section { width: 100%; float:none; padding-right: 0px; }';
                echo '}';
				echo '</style>';
                break;
				
           	case 'option3': 
			
                echo '<style type="text/css">';
                echo '.home-widget-two .widget, .home-widget-two section { width: 33.33%; float:left; padding-right: 30px; }';
				echo '@media handheld, only screen and (max-width: 767px) {';
				echo '.home-widget-two .widget, .home-widget-two section { width: 100%; float:none; padding-right: 0px; }';
                echo '}';
				echo '</style>';
                break;
				
			case 'option4':
                	
				echo '<style type="text/css">';
                echo '.home-widget-two .widget, .home-widget-two section { width: 25%; float:left; padding-right: 30px; }'; 
				echo '@media handheld, only screen and (max-width: 767px) {';
				echo '.home-widget-two .widget, .home-widget-two section { width: 100%; float:none; padding-right: 0px; }';
                echo '}'; 
				echo '</style>';
                break;
				
        }
    }
	
}

add_action( 'wp_enqueue_scripts', 'proper_lite_home_widget_two_style' );
	
	
/*-----------------------------------------------------------------------------------------------------//
	Home Widget Three
-------------------------------------------------------------------------------------------------------*/

function proper_lite_home_widget_three_style() {
	
	$widget_column_three = esc_html( get_theme_mod( 'proper_lite_widget_column_three' )); 
    			
	if( $widget_column_three != '' ) {
    
		switch ( $widget_column_three ) { 
            	
			case 'option1':
            // 1 Column 
            break;
			
           	case 'option2':
                	
				echo '<style type="text/css">';
                echo '.home-widget-three .widget, .home-widget-three section { width: 50%; float:left; padding-right: 30px; }';
				echo '@media handheld, only screen and (max-width: 767px) {';
				echo '.home-widget-three .widget, .home-widget-three section { width: 100%; float:none; padding-right: 0px; }';
                echo '}';
				echo '</style>';
                break;
				
           	case 'option3': 
			
                echo '<style type="text/css">';
                echo '.home-widget-three .widget, .home-widget-three section { width: 33.33%; float:left; padding-right: 30px; }';
				echo '@media handheld, only screen and (max-width: 767px) {';
				echo '.home-widget-three .widget, .home-widget-three section { width: 100%; float:none; padding-right: 0px; }';
                echo '}';
				echo '</style>';
                break;
				
			case 'option4':
                	
				echo '<style type="text/css">';
                echo '.home-widget-three .widget, .home-widget-three section { width: 25%; float:left; padding-right: 30px; }'; 
				echo '@media handheld, only screen and (max-width: 767px) {';
				echo '.home-widget-three .widget, .home-widget-three section { width: 100%; float:none; padding-right: 0px; }';
                echo '}'; 
				echo '</style>';
                break;
				
        }
    }
	
}

add_action( 'wp_enqueue_scripts', 'proper_lite_home_widget_three_style' );
	
	
/*-----------------------------------------------------------------------------------------------------//
	Home Widget Four
-------------------------------------------------------------------------------------------------------*/

function proper_lite_home_widget_four_style() {
	
	$widget_column_four = esc_html( get_theme_mod( 'proper_lite_widget_column_four' ));
    			
	if( $widget_column_four != '' ) {
    
		switch ( $widget_column_four ) {
            	
			case 'option1':
            // 1 Column 
            break;
			
           	case 'option2':
                	
				echo '<style type="text/css">';
                echo '.home-widget-four .widget, .home-widget-four section { width: 50%; float:left; padding-right: 30px; }';
				echo '@media handheld, only screen and (max-width: 767px) {';
				echo '.home-widget-four .widget, .home-widget-four section { width: 100%; float:none; padding-right: 0px; }';
                echo '}';
				echo '</style>';
                break;
				
           	case 'option3': 
			
                echo '<style type="text/css">';
                echo '.home-widget-four .widget, .home-widget-four section { width: 33.33%; float:left; padding-right: 30px; }';
				echo '@media handheld, only screen and (max-width: 767px) {';
				echo '.home-widget-four .widget, .home-widget-four section { width: 100%; float:none; padding-right: 0px; }';
                echo '}';
				echo '</style>';
                break;
				
			case 'option4':
                	
				echo '<style type="text/css">';
                echo '.home-widget-four .widget, .home-widget-four section { width: 25%; float:left; padding-right: 30px; }'; 
				echo '@media handheld, only screen and (max-width: 767px) {';
				echo '.home-widget-four .widget, .home-widget-four section { width: 100%; float:none; padding-right: 0px; }';
                echo '}'; 
				echo '</style>';
                break;
				
        }
    }
	
}

add_action( 'wp_enqueue_scripts', 'proper_lite_home_widget_four_style' );
	
/*-----------------------------------------------------------------------------------------------------//
	Home Widget Five
-------------------------------------------------------------------------------------------------------*/

function proper_lite_home_widget_five_style() {
	
	$widget_column_five = esc_html( get_theme_mod( 'proper_lite_widget_column_five', '1' ));
    			
	if( $widget_column_five != '' ) {
    
		switch ( $widget_column_five ) { 
            	
			case 'option1':
            // 1 Column 
            break;
			
           	case 'option2':
                	
				echo '<style type="text/css">';
                echo '.home-widget-five .widget, .home-widget-five section { width: 50%; float:left; padding-right: 30px; }';
				echo '@media handheld, only screen and (max-width: 767px) {';
				echo '.home-widget-five .widget, .home-widget-five section { width: 100%; float:none; padding-right: 0px; }';
                echo '}';
				echo '</style>';
                break;
				
           	case 'option3': 
			
                echo '<style type="text/css">';
                echo '.home-widget-five .widget, .home-widget-five section { width: 33.33%; float:left; padding-right: 30px; }';
				echo '@media handheld, only screen and (max-width: 767px) {';
				echo '.home-widget-five .widget, .home-widget-five section { width: 100%; float:none; padding-right: 0px; }';
                echo '}';
				echo '</style>';
                break;
				
			case 'option4':
                	
				echo '<style type="text/css">';
                echo '.home-widget-five .widget, .home-widget-five section { width: 25%; float:left; padding-right: 30px; }';
				echo '@media handheld, only screen and (max-width: 767px) {';
				echo '.home-widget-five .widget, .home-widget-five section { width: 100%; float:none; padding-right: 0px; }';
                echo '}'; 
				echo '</style>';
                break; 
				
        }
    }
	
}

add_action( 'wp_enqueue_scripts', 'proper_lite_home_widget_five_style' );