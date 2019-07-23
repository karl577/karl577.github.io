<div class="tab-site">
	<div id="layout-tab" class="tab-product">
	    <h2 class="tab-hd">
		    <span class="tab-hd-con"><a href="javascript:"><?php echo zm_get_option('tab_a'); ?></a></span>
		    <span class="tab-hd-con"><a href="javascript:"><?php echo zm_get_option('tab_b'); ?></a></span>
		    <span class="tab-hd-con"><a href="javascript:"><?php echo zm_get_option('tab_c'); ?></a></span>
	    </h2>

		<ul class="tab-bd dom-display">

			<div class="tab-bd-con current">
				<?php query_posts('showposts='.zm_get_option('tabt_n').'&cat='.zm_get_option('tabt_id')); while (have_posts()) : the_post(); ?>
				<?php the_title( sprintf( '<li class="list-title"><i class="fa fa-angle-right"></i><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></li>' ); ?>
				<?php endwhile; ?>
				<?php wp_reset_query(); ?>
			</div>

			<div class="tab-bd-con">
				<?php query_posts('showposts='.zm_get_option('tabt_n').'&cat='.zm_get_option('tabz_n')); while (have_posts()) : the_post(); ?>
				<?php the_title( sprintf( '<li class="list-title"><i class="fa fa-angle-right"></i><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></li>' ); ?>
				<?php endwhile; ?>
				<?php wp_reset_query(); ?>
		    </div>

			<div class="tab-bd-con">
				<?php $rand_post=get_posts('numberposts='.zm_get_option('tabt_n').'&orderby=rand'); foreach($rand_post as $post) : ?>
				<?php the_title( sprintf( '<li class="list-title"><i class="fa fa-angle-right"></i><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></li>' ); ?>
				<?php endforeach; ?>
				<?php wp_reset_query(); ?>
			</div>

		</ul>
	</div>
</div>
<div class="clear"></div>