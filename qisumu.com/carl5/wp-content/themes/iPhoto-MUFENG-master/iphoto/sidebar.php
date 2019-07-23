	<div id="sidebar">
		<div id="sidebar-inner">
			<div class="sidebar-inner clearfix">
				<div id="popular" class="widgets">
						<h2>最受欢迎</h2>
						<ul class="clearfix">
						<?php
						$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
						$args = array(
							'meta_key' => 'views',
							'orderby'   => 'meta_value_num',
							'paged' => $paged,
							'order' => DESC,
							'showposts' => 9
						);
						query_posts($args);
							while (have_posts()) : the_post();?>
						<li>
							<?php $pid=get_the_ID();$pimg = wim_sidebar($pid);if($pimg): ?>
								<a class="img" href="<?php the_permalink(); ?>#single-content" title="<?php the_title(); ?>" target="_blank"></span><?php echo $pimg;?></a>
							<?php endif; ?>
						</li>
						<?php endwhile; wp_reset_query(); ?>
						</ul>
				</div>
				<div class="widgets">
					<h2>相关美图</h2>
					<ul class="clearfix">
						<?php
							foreach(get_the_category() as $category){
							$cat = $category->cat_ID;
							}
							query_posts('cat=' . $cat . '&orderby=rand&showposts=9');
							while (have_posts()) : the_post();?>
						<li>
							<?php $rid=get_the_ID();$rimg = wim_sidebar($rid);if($rimg): ?>
								<a class="img" href="<?php the_permalink(); ?>#single-content" title="<?php the_title(); ?>" target="_blank"></span><?php echo $rimg;?></a>
							<?php endif; ?>
						</li>
						<?php endwhile; wp_reset_query(); ?>
					</ul>
				</div>
			</div>
		</div>
	</div>