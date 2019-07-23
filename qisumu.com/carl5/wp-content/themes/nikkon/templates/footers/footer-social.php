<footer id="colophon" class="site-footer site-footer-social">
	
	<div class="site-footer-icons">
        <div class="site-container">
            
            <?php
			if( get_theme_mod( 'nikkon-social-email' ) ) :
			    echo '<a href="' . esc_url( 'mailto:' . antispambot( get_theme_mod( 'nikkon-social-email' ), 1 ) ) . '" title="' . esc_attr__( 'Send Us an Email', 'nikkon' ) . '" class="footer-social-icon footer-social-email"><i class="fa fa-envelope-o"></i></a>';
			endif;

			if( get_theme_mod( 'nikkon-social-skype' ) ) :
			    echo '<a href="skype:' . esc_html( get_theme_mod( 'nikkon-social-skype' ) ) . '?userinfo" title="' . esc_attr__( 'Contact Us on Skype', 'nikkon' ) . '" class="footer-social-icon footer-social-skype"><i class="fa fa-skype"></i></a>';
			endif;
			
			if( get_theme_mod( 'nikkon-social-facebook' ) ) :
			    echo '<a href="' . esc_url( get_theme_mod( 'nikkon-social-facebook' ) ) . '" target="_blank" title="' . esc_attr__( 'Find Us on Facebook', 'nikkon' ) . '" class="footer-social-icon footer-social-facebook"><i class="fa fa-facebook"></i></a>';
			endif;
			
			if( get_theme_mod( 'nikkon-social-twitter' ) ) :
			    echo '<a href="' . esc_url( get_theme_mod( 'nikkon-social-twitter' ) ) . '" target="_blank" title="' . esc_attr__( 'Follow Us on Twitter', 'nikkon' ) . '" class="footer-social-icon footer-social-twitter"><i class="fa fa-twitter"></i></a>';
			endif;
			
			if( get_theme_mod( 'nikkon-social-linkedin' ) ) :
			    echo '<a href="' . esc_url( get_theme_mod( 'nikkon-social-linkedin' ) ) . '" target="_blank" title="' . esc_attr__( 'Find Us on LinkedIn', 'nikkon' ) . '" class="footer-social-icon footer-social-linkedin"><i class="fa fa-linkedin"></i></a>';
			endif;

			if( get_theme_mod( 'nikkon-social-tumblr' ) ) :
			    echo '<a href="' . esc_url( get_theme_mod( 'nikkon-social-tumblr' ) ) . '" target="_blank" title="' . esc_attr__( 'Find Us on Tumblr', 'nikkon' ) . '" class="footer-social-icon footer-social-tumblr"><i class="fa fa-tumblr"></i></a>';
			endif;

			if( get_theme_mod( 'nikkon-social-flickr' ) ) :
			    echo '<a href="' . esc_url( get_theme_mod( 'nikkon-social-flickr' ) ) . '" target="_blank" title="' . esc_attr__( 'Find Us on Flickr', 'nikkon' ) . '" class="footer-social-icon footer-social-flickr"><i class="fa fa-flickr"></i></a>';
			endif; ?>
			
        	<div class="site-footer-social-ad">
        		<i class="fa fa-map-marker"></i> <?php echo wp_kses_post( get_theme_mod( 'nikkon-website-site-add', __( 'Cape Town, South Africa', 'nikkon' ) ) ) ?>
        	
				<?php printf( __( '</div><div class="site-footer-social-copy">Theme: %1$s by %2$s', 'nikkon' ), 'Nikkon', '<a href="https://kairaweb.com/">Kaira</a>' ); ?>
			</div>
            
            <div class="clearboth"></div>
        </div>
    </div>
    
</footer>

<?php if ( get_theme_mod( 'nikkon-footer-bottombar', false ) == 0 ) : ?>
	
	<div class="site-social-bottom-bar site-footer-bottom-bar">
	
		<div class="site-container">
			
	        <?php wp_nav_menu( array( 'theme_location' => 'footer-bar','container' => false, 'depth'  => 1 ) ); ?>
                
	    </div>
		
        <div class="clearboth"></div>
	</div>
	
<?php endif; ?>