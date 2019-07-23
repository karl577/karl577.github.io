<!-- AddThis Button END -->
<?php $wallstreet_pro_options=theme_data_setup();
$current_options = wp_parse_args(  get_option( 'wallstreet_pro_options', array() ), $wallstreet_pro_options ); 
 if($current_options['portfolio_section_enabled'] == true) { ?>
<div class="portfolio-section">
	<div class="container">

		<div class="row">
			<div class="section_heading_title">
				<?php if($current_options['portfolio_title']) { ?>
				<h1><?php echo esc_html($current_options['portfolio_title']); ?></h1>
				<div class="pagetitle-separator">
					<div class="pagetitle-separator-border">
						<div class="pagetitle-separator-box"></div>
					</div>
				</div>
			<?php } ?>
			<?php if($current_options['portfolio_description']) { ?>
				<p><?php echo esc_html($current_options['portfolio_description']); ?></p>
			<?php } ?>				
			</div>
		</div>
		<div class="row">
		<?php if($current_options['portfolio_image_one']) { ?>
			<div class="col-md-3 col-md-6 home-portfolio-area">
				<div class="home-portfolio-showcase">
					<div class="home-portfolio-showcase-media">
					
						<img class="img-responsive home-portfolio-img" alt="Sleek &amp; Beautiful" src="<?php echo esc_url($current_options['portfolio_image_one']); ?>">
					
						<div class="home-portfolio-showcase-overlay">
							<div class="home-portfolio-showcase-overlay-inner">
								<div class="home-portfolio-showcase-detail">
									<?php if($current_options['portfolio_title_one']){ ?>
									<h4><?php echo esc_html($current_options['portfolio_title_one']); ?></h4>
									<?php } ?>
									<?php if($current_options['portfolio_description_one']){ ?>
									<p><?php echo esc_html($current_options['portfolio_description_one']);?></p>
									<?php } ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php } 
			 if($current_options['portfolio_image_two']) { ?>
			<div class="col-md-3 col-md-6 home-portfolio-area">
				<div class="home-portfolio-showcase">
					<div class="home-portfolio-showcase-media">
					
						<img class="img-responsive home-portfolio-img" alt="Sleek &amp; Beautiful" src="<?php echo esc_url($current_options['portfolio_image_two']); ?>">
					
						<div class="home-portfolio-showcase-overlay">
							<div class="home-portfolio-showcase-overlay-inner">
								<div class="home-portfolio-showcase-detail">
									<?php if($current_options['portfolio_title_two']){ ?>
									<h4><?php echo esc_html($current_options['portfolio_title_two']); ?></h4>
									<?php } ?>
									<?php if($current_options['portfolio_description_two']){ ?>
									<p><?php echo esc_html($current_options['portfolio_description_two']);?></p>
									<?php } ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php }
			if($current_options['portfolio_image_three']) { ?>
			<div class="col-md-3 col-md-6 home-portfolio-area">
				<div class="home-portfolio-showcase">
					<div class="home-portfolio-showcase-media">
					
						<img class="img-responsive home-portfolio-img" alt="Sleek &amp; Beautiful" src="<?php echo esc_url($current_options['portfolio_image_three']); ?>">
				
						<div class="home-portfolio-showcase-overlay">
							<div class="home-portfolio-showcase-overlay-inner">
								<div class="home-portfolio-showcase-detail">
									<?php if($current_options['portfolio_title_three']){ ?>
									<h4><?php echo esc_html($current_options['portfolio_title_three']); ?></h4>
									<?php } ?>
									<?php if($current_options['portfolio_description_three']){ ?>
									<p><?php echo esc_html($current_options['portfolio_description_three']);?></p>
									<?php } ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
				<?php }
				if($current_options['portfolio_title_four']) { ?>
			<div class="col-md-3 col-md-6 home-portfolio-area">
				<div class="home-portfolio-showcase">
					<div class="home-portfolio-showcase-media">
					
						<img class="img-responsive home-portfolio-img" alt="Sleek &amp; Beautiful" src="<?php echo esc_url($current_options['portfolio_image_four']); ?>">
				
						<div class="home-portfolio-showcase-overlay">
							<div class="home-portfolio-showcase-overlay-inner">
								<div class="home-portfolio-showcase-detail">
									<?php if($current_options['portfolio_title_four']){ ?>
									<h4><?php echo esc_html( $current_options['portfolio_title_four'] ); ?></h4>
									<?php } ?>
									<?php if($current_options['portfolio_description_four']){ ?>
									<p><?php echo esc_html( $current_options['portfolio_description_four'] );?></p>
									<?php } ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
	<?php } ?>
		</div>
</div>	
</div>
<?php } ?>
<!-- /wallstreet Portfolio Section ---->