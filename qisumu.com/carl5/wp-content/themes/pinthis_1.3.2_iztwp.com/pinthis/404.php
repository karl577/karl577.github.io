<?php get_header(); ?>

<section id="content">
	<div class="container">
		<div class="notice-body">	
			<p class="icon"><img src="<?php echo pinthis_get_skin_src(); ?>/images/icon-error-404.png" width="183" height="182" alt="404" /></p>
			<h2 class="title-4"><?php echo __('404', 'pinthis'); ?></h2>
			<p class="notice"><?php echo __('Sorry, the page you were looking for was not found.', 'pinthis'); ?></p>
		</div>
	</div>
</section>

<?php get_footer(); ?>