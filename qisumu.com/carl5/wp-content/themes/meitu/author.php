<?php get_header(); ?>
<div class="w968">
	<div id="container">
		<?php if(!is_paged()) { ?>
		<div class="box">
			<?php get_template_part('author-side'); ?>
		</div>
		<?php } ?>
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<?php get_template_part('loop'); ?>
		<?php endwhile; ?><?php endif; ?>
	</div>
	<div id="page-nav">
		<?php next_posts_link() ?>
	</div>
</div>
<?php get_template_part('list-js'); ?>
<?php get_footer(); ?>