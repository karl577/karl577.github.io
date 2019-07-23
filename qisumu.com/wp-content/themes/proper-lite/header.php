<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package proper-lite
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php wp_head(); ?>



<!-- qisumu.com Baidu tongji analytics -->
<script>
var _hmt = _hmt || [];
(function() {
var hm = document.createElement("script");
hm.src = "https://hm.baidu.com/hm.js?cd8191d648355b940efdb3f1ba7fb3a0";
var s = document.getElementsByTagName("script")[0];
s.parentNode.insertBefore(hm, s);
})();
</script>



</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'proper-lite' ); ?></a> 

	<header id="masthead" class="site-header animated fadeIn delay-2">
		<div class="site-branding">
			
            <?php if ( get_theme_mod( 'proper_lite_logo' ) ) : ?>
              
    			<div class="site-logo site-title"> 
                
       				<a href='<?php echo esc_url( home_url( '/' ) ); ?>' title='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>' rel='home'>
                    
                    	<img 
                        	src='<?php echo esc_url( get_theme_mod( 'proper_lite_logo' ) ); ?>'
                            
							<?php if ( get_theme_mod( 'logo_size' ) ) : ?>
                            	width="<?php echo esc_attr( get_theme_mod( 'logo_size', '120' )); ?>
                            "<?php endif; ?> 
                            
                            alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
                    
                    </a> 
                    
    			</div><!-- site-logo -->
                
			<?php else : ?>
            
    			<hgroup>
       				<h1 class='site-title'>
                    
                    	<a href='<?php echo esc_url( home_url( '/' ) ); ?>' title='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>' rel='home'>
                        
							<?php bloginfo( 'name' ); ?>
                            
                    	</a>
                        
                    </h1>
    			</hgroup>
                
			<?php endif; ?> 
            
		</div><!-- .site-branding -->
        
    
    <?php if ( 'option1' == proper_lite_sanitize_index_content( get_theme_mod( 'proper_lite_menu_method' ) ) ) : ?>
                
                <div class="navigation-container">
                
                    <a id="sidr-menu" href="#sidr">
                    
                    <?php $menu_toggle_option = proper_lite_sanitize_menu_toggle_display( get_theme_mod( 'proper_lite_menu_toggle', 'icon' )); 
    
                        $proper_lite_menu_display = '';
    
                        if ( $menu_toggle_option == 'icon' ) {
                    
                            $proper_lite_menu_display = sprintf( '<i class="fa fa-bars"></i>' );
                
                        } else if ( $menu_toggle_option == 'label' ) {
                    
                            $proper_lite_menu_display = esc_html__( 'Menu', 'proper-lite' );
                
                        } 
    
                        echo wp_kses_post( $proper_lite_menu_display ); ?>
                        
                        </a>
        		</div>
                
			</header><!-- #masthead -->
            
            <div id="sidr">
              <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?> 
            </div>
                
     <?php else : ?>
            
           
     			<div class="classic-navigation">
        			<nav id="site-navigation" class="main-navigation" role="navigation">
                    
            			<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
                        
            		</nav><!-- #site-navigation --> 
        		</div><!-- navigation-container --> 
                
                <div class="navigation-container classic-menu">
        			<a id="sidr-menu" href="#sidr">
                    
                    <?php $menu_toggle_option = proper_lite_sanitize_menu_toggle_display( get_theme_mod( 'proper_lite_menu_toggle', 'icon' )); 
    
                        $proper_lite_menu_display = '';
    
                        if ( $menu_toggle_option == 'icon' ) {
                    
                            $proper_lite_menu_display = sprintf( '<i class="fa fa-bars"></i>' );
                
                        } else if ( $menu_toggle_option == 'label' ) {
                    
                            $proper_lite_menu_display = esc_html__( 'Menu', 'proper-lite' );
                
                        } 
    
                        echo wp_kses_post( $proper_lite_menu_display ); ?>
                        
                        </a>
        		</div> 
                
                
            </header><!-- #masthead --> 
                    
            <div id="sidr">
              <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?> 
            </div>
            
        			
    <?php endif; ?>
    
    

	<div id="content" class="site-content">
