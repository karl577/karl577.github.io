<?php get_header('alternative'); ?>

<div id="content" class="site-content">	
	<div class="container">	
		<div class="row">
			<div class="col-md-12">
				<div id="primary" class="content-area">
					<main id="main" class="site-main" role="main">
						<section class="error-404 not-found text-center">
						    <strong><?php _e( '404', "shaped-blog" ); ?></strong>
						    <br/>
						    <span><?php _e( 'Page Not Found!', "shaped-blog" ); ?></span>

							<footer class="page-footer">
								<a href="<?php echo esc_url(home_url());?>" class="btn btn-goback"><?php _e( 'Go Back to Home', "shaped-blog" ); ?></a>
							</footer> <!-- /.page-footer -->

						</section> <!-- /.errot-404 -->
					</main><!-- .site-main -->
				</div><!-- .content-area -->
			</div> <!-- /.col -->
		</div> <!-- /.row -->
	</div>	
</div> <!-- /.site-content -->

<?php get_footer('alternative'); ?>