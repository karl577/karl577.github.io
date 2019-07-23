<?php get_header(); ?>
<style>#main {padding-top: 150px;}</style>
<div class="w1000" id="main">
	<div id="content" class="w750">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div id="entry">
		<h1><?php the_title(); ?></h1>
		<div class="postinfo">
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
		<div id="postarea">
			<?php the_content(); ?>
		</div>
		<?php endwhile;?><?php endif; ?>
		</div>
		<div class="c"></div>
		<div id="comment">
			<?php comments_template(); ?>
		</div>
	</div>
	<div class="w250">
	 	<div id="arcls">
	 	<?php wp_nav_menu( array( 'theme_location' => 'right-side','container' => '','menu_class' => 'nav_right_side','before' => '','after' => '') ); ?>
	 	<?php 	/* Widgetized sidebar, if you have the plugin installed. */
			if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar() ) : ?>
		<?php endif; ?>
	 	</div>
	</div>
	<div class="c"></div>
	<div id="pager"><?php wp_pagenavi(); ?></div>
	<div class="c"></div>
</div>
<?php get_footer(); ?>