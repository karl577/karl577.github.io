<?php get_header(); ?>
<div class="w1000" id="main">
	<div id="container">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<?php $fmimg = get_post_meta($post->ID, "fmimg_value", true); ?>
		<div <?php post_class() ?>>
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php if($fmimg) { ?><img src="<?php echo $fmimg; ?>" /><?php } else { ?><img src="<?php echo catch_that_image(); ?>" /><?php } ?></a>
			<div class="piax">
				<h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
				<?php the_excerpt(); ?>
				<div class="pac">
				 	<?php the_time('Y.m.d'); ?>
				 	<span class="blog-line">/</span>
				 	<?php the_category(','); ?>
				 	<span class="blog-line">/</span>
				 	<a href="<?php the_permalink(); ?>#comment">
				 		<?php comments_number('0 Comment', '1 Comment', '% Comments' );?>
				 	</a>
				 	<span class="blog-line">/</span>
				 	<?php echo getPostViews(get_the_ID()); ?> views
				</div>
			</div>
		</div>
		<?php endwhile;?><?php endif; ?>
	</div>
	<div class="c"></div>
	<div id="pager"><?php par_pagenavi(9);  ?></div>
	<div class="c"></div>
</div>
<?php get_footer(); ?>