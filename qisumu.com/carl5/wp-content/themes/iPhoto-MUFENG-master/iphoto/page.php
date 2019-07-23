<?php get_header(); ?>
		<div id="single-content">
			<div id="post-home" class="clearfix">
				<?php if(have_posts()) : while (have_posts()) : the_post(); ?>
				<div id="post-header" class="clearfix">
					<?php if (function_exists('get_avatar')) { echo get_avatar( get_the_author_email(), '48' ); }?>
					<div id="post-title">
						<h1><?php the_title_attribute(); ?></h1>
						<p>by <?php the_author_link(); ?> &#160;&#124;&#160;<?php the_time('M d, Y'); ?>&#160;&#124;&#160;in <?php the_category(', '); ?>&#160;&#124;&#160;<?php if(function_exists('the_views')) {$views = the_views(0);preg_match('/\d+/', $views, $match);echo '<span>'._e( 'Views',iphoto).' '.$match[0].'</span>';} ?>&#160;&#124;&#160;<?php _e( 'Comments',iphoto).' ';?><?php comments_popup_link('0', '1', '%'); ?></p>			 
					</div>
				</div>
				<div class="post-content">
					<?php the_content(''); ?>
					<?php if (get_option('iphoto_Ap1')!="") {?>
					<div id="iphotoAp1"><?php echo stripslashes(get_option('iphoto_Ap1')); ?></div>
					<?php }?>
				</div>
				<?php endwhile; endif; ?>
				<div id="comments">
					<?php comments_template('', true); ?>
				</div>
			</div>
		</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>