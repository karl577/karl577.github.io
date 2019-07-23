<?php get_header(); ?>

<?php
	// get options
	$pinthis_infinite_scroll = get_option('pbpanel_infinite_scroll');
	$pinthis_pinbox_soc_icons = get_option('pbpanel_pinbox_soc_icons');
?>

<section id="content">
	<div class="container fluid">
		<div class="category-title">
			<div class="container">
				<h3 class="title-3"><span class="color-1"><?php echo __('Search results for', 'pinthis'); ?></span> &quot;<?php the_search_query() ?>&quot;</h3>
			</div>
		</div>
		<?php if ( have_posts() ) { ?> 
		<div class="boxcontainer">
			<?php while ( have_posts() ) { the_post(); ?>
				<?php get_template_part('pinbox', get_post_format()); ?>
			<?php } ?>
		</div>
			<?php
				ob_start();
				posts_nav_link(' ', __('Previous Page', 'pinthis'), __('Next Page', 'pinthis'));
				$pinthis_posts_nav_link = ob_get_clean();
			?>
			<?php if(strlen($pinthis_posts_nav_link) > 0) { ?>
				<div class="container">
					<div class="posts-navigation clearfix <?php if ($pinthis_infinite_scroll == 1) { ?>hide<?php } ?>"><?php echo $pinthis_posts_nav_link;  ?></div>
				</div>
			<?php } ?>
		<?php } else { ?>
		<div class="notification-body">
			<p class="notification tcenter"><?php echo __('No posts found.', 'pinthis'); ?></p>
		</div>
		<?php } ?>
	</div>
</section>

<?php get_footer(); ?>