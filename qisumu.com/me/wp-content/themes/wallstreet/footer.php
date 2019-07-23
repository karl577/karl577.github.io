<!-- Footer Widget Secton -->
<?php $wallstreet_pro_options=theme_data_setup();
	  $current_options = wp_parse_args(  get_option( 'wallstreet_pro_options', array() ), $wallstreet_pro_options ); ?>
<div class="footer_section">

	<?php if($current_options['footer_social_media_enabled']==true) { ?>
				<div class="footer-social-area"><ul class="footer-social-icons">
					<?php if($current_options['social_media_twitter_link']!='') { ?>
					<li><a href="<?php echo esc_url( $current_options['social_media_twitter_link']); ?>"><i class="fa fa-twitter"></i></a></li>
					<?php }
					if($current_options['social_media_facebook_link']!='') { ?>
					<li><a href="<?php echo esc_url( $current_options['social_media_facebook_link']); ?>"><i class="fa fa-facebook"></i></a></li>
					<?php }					
					if($current_options['social_media_googleplus_link']!='') { ?>
					<li><a href="<?php echo esc_url( $current_options['social_media_googleplus_link']); ?>"><i class="fa fa-google-plus"></i></a></li>
					<?php }
					if($current_options['social_media_linkedin_link']!='') { ?>
					<li><a href="<?php echo esc_url( $current_options['social_media_linkedin_link']); ?>"><i class="fa fa-linkedin"></i></a></li>
					<?php }
					if($current_options['social_media_youtube_link']!='') { ?>
					<li><a href="<?php echo esc_url( $current_options['social_media_youtube_link']); ?>"><i class="fa fa-youtube"></i></a></li>					
					<?php } ?>
				</div></ul>
				<?php } ?>
	
	<div class="container">
		<div class="row footer-widget-section">
		<?php 
			if ( is_active_sidebar( 'footer-widget-area' ) )
			{ dynamic_sidebar( 'footer-widget-area' );	}
		?>
		</div>
        <div class="row">
			<div class="col-md-12">
				<div class="footer-copyright">
					<p><?php echo $current_options['footer_copyright'];?> 
				</p>
				</div>
			</div>
		</div>
	</div>
</div>
</div> <!-- end of wrapper -->
<?php wp_footer(); ?>
</body>
</html>