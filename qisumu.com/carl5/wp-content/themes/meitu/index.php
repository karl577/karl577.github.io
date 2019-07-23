<?php get_header(); ?>
<div class="w968">
	<div id="container">
		<?php if(!is_paged()) { ?>
		<div class="box">
			<div id="list-tag">
				<h4><i class="icon-bookmark"></i> 热门标签</h4>
				<?php $args = array(
				    'smallest'                  => 14, 
				    'largest'                   => 14,
				    'unit'                      => 'px', 
				    'number'                    => 30,
				    'orderby'                   => 'count', 
				    'order'                     => 'DESC',
				    'exclude'                   => null, 
				    'include'                   => null, 
				    'topic_count_text_callback' => default_topic_count_text,
				    'link'                      => 'view', 
				    'taxonomy'                  => 'post_tag', 
				    'echo'                      => true
				); ?>
				<?php wp_tag_cloud( $args ); ?>
			</div>
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