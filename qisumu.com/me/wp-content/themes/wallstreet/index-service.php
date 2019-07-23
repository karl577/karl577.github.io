<?php $wallstreet_pro_options=theme_data_setup();
	  $current_options = wp_parse_args(  get_option( 'wallstreet_pro_options', array() ), $wallstreet_pro_options ); 
	  if($current_options['service_section_enabled'] == true) { ?>
<!-- wallstreet Service Section ---->
<div class="service-section">
<div class="container">
	<div class="row">
		<div class="section_heading_title">
		<?php if($current_options['service_title']) { ?>
			<h1><?php echo esc_html($current_options['service_title']); ?></h1>
			<div class="pagetitle-separator">
				<div class="pagetitle-separator-border">
					<div class="pagetitle-separator-box"></div>
				</div>
			</div>
		<?php } ?>
		<?php if($current_options['service_description']) { ?>
			<p><?php echo esc_html($current_options['service_description']); ?></p>
		<?php } ?>
		</div>
	</div>	
	<div class="row">
		<div class="col-md-4 col-sm-6 service-effect">
			<?php if($current_options['service_image_one']) { ?>
			<div class="service-box">
				<img class="img-responsive service-box-image" alt="Sleek &amp; Beautiful" src="<?php echo esc_url($current_options['service_image_one']); ?>">
			</div>
			<?php } ?>
			<div class="service-area">
			<?php if($current_options['service_title_one']) { ?>
			<h2><a href="#"><?php echo esc_html($current_options['service_title_one']); ?></a></h2>
			<?php } ?>
			<?php if($current_options['service_description_one']) { ?>
			<p><?php echo esc_html($current_options['service_description_one']); ?></p>
			<?php } ?>
			</div><!-- / service-area -->
		</div> <!-- / service-effect column -->
		
		<div class="col-md-4 col-sm-6 service-effect">
			<?php if($current_options['service_image_two']) { ?>
			<div class="service-box">
				<img class="img-responsive service-box-image" alt="Sleek &amp; Beautiful" src="<?php echo esc_url($current_options['service_image_two']); ?>">
			</div>
			<?php } ?>
			<div class="service-area">
			<?php if($current_options['service_title_two']) { ?>
			<h2><a href="#"><?php echo esc_html($current_options['service_title_two']); ?></a></h2>
			<?php } ?>
			<?php if($current_options['service_description_two']) { ?>
			<p><?php echo esc_html($current_options['service_description_two']); ?></p>
			<?php } ?>
			</div><!-- / service-area -->
		</div> <!-- / service-effect column -->
		
		<div class="col-md-4 col-sm-6 service-effect">
			<?php if($current_options['service_image_three']) { ?>
			<div class="service-box">
				<img class="img-responsive service-box-image" alt="Sleek &amp; Beautiful" src="<?php echo esc_url($current_options['service_image_three']); ?>">
			</div>
			<?php } ?>
			<div class="service-area">
			<?php if($current_options['service_title_three']) { ?>
			<h2><a href="#"><?php echo esc_html($current_options['service_title_three']); ?></a></h2>
			<?php } ?>
			<?php if($current_options['service_description_three']) { ?>
			<p><?php echo esc_html($current_options['service_description_three']); ?></p>
			<?php } ?>
			</div><!-- / service-area -->
		</div> <!-- / service-effect column -->
		
	</div>	
</div>
</div>
<?php } ?>
<!-- /wallstreet Service Section ---->