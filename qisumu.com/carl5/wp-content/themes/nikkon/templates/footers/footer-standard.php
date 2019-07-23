<footer id="colophon" class="site-footer site-footer-standard">
	
	<div class="site-footer-widgets">
        <div class="site-container">
            <?php if ( is_active_sidebar( 'nikkon-site-footer-standard' ) ) : ?>
	            <ul>
	                <?php dynamic_sidebar( 'nikkon-site-footer-standard' ); ?>
	            </ul>
	        <?php else : ?>
	        	<div class="site-footer-no-widgets">
	        		<?php _e( 'Add your own widgets here', 'nikkon' ); ?>
	        	</div>
	    	<?php endif; ?>
            <div class="clearboth"></div>
        </div>
    </div>
    
    <?php if ( get_theme_mod( 'nikkon-footer-bottombar', false ) == 0 ) : ?>
		
		<div class="site-footer-bottom-bar">
		
			<?php printf( __( '<div class="site-container"><div class="site-footer-bottom-bar-left">Theme: %1$s by %2$s', 'nikkon' ), 'Nikkon', '<a href="https://kairaweb.com/">Kaira</a>' ); ?>
	                
			</div>
	        
	        <div class="site-footer-bottom-bar-right">
                
	            <?php wp_nav_menu( array( 'theme_location' => 'footer-bar','container' => false, 'fallback_cb' => false, 'depth'  => 1 ) ); ?>
	            
	            <?php get_template_part( '/templates/social-links' ); ?>
                
	        </div></div>
			
	        <div class="clearboth"></div>
		</div>
		
	<?php endif; ?>
	
</footer>