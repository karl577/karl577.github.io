<div id="sidebar" class="widget-area">
	<?php wp_reset_query(); if ( is_home() ) : ?>
		<div class="wow fadeInUp" data-wow-delay="0.5s">
			<?php dynamic_sidebar( 'sidebar-h-t' ); ?>
		</div>
		<div class="sidebar-roll">
			<?php dynamic_sidebar( 'sidebar-h-r' ); ?>
		</div>
		<div class="wow fadeInUp" data-wow-delay="0.5s">
			<?php dynamic_sidebar( 'sidebar-h-b' ); ?>
		</div>
	<?php endif; ?>

	<?php if (is_single() || is_page() ) : ?>
		<div class="wow fadeInUp" data-wow-delay="0.5s">
			<?php dynamic_sidebar( 'sidebar-s-t' ); ?>
		</div>
		<div class="sidebar-roll">
			<?php dynamic_sidebar( 'sidebar-s-r' ); ?>
		</div>
		<div class="wow fadeInUp" data-wow-delay="0.5s">
			<?php dynamic_sidebar( 'sidebar-s-b' ); ?>
		</div>
	<?php endif; ?>

	<?php if ( is_archive() || is_search() || is_404() ) : ?>
		<div class="wow fadeInUp" data-wow-delay="0.5s">
			<?php dynamic_sidebar( 'sidebar-a-t' ); ?>
		</div>
		<div class="sidebar-roll">
			<?php dynamic_sidebar( 'sidebar-a-r' ); ?>
		</div>
		<div class="wow fadeInUp" data-wow-delay="0.5s">
			<?php dynamic_sidebar( 'sidebar-a-b' ); ?>
		</div>
	<?php endif; ?>
</div>

<div class="clear"></div>