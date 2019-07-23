<?php get_header(); ?>
<div class="container">
	<div id="archive">
		<div class="row">
			<div class="col-sm-2">
				<div class="sidebox">
					<a href="<?php echo get_option('mao10_dhlnk_1'); ?>" class="thumbnail home-grid-sm home-grid-sm-1">
						<div class="img-div"><img src="<?php echo get_option('mao10_dhimg_1'); ?>" alt="<?php echo get_option('mao10_dhtit_1'); ?>"></div>
						<div class="caption">
							<h4><?php echo get_option('mao10_dhtit_1'); ?></h4>
							<p><?php echo get_option('mao10_dhtib_1'); ?></p>
						</div>
					</a>
				</div>
				<div class="sidebox">
					<a href="<?php echo get_option('mao10_dhlnk_2'); ?>" class="thumbnail home-grid-sm home-grid-sm-2">
						<div class="img-div"><img src="<?php echo get_option('mao10_dhimg_2'); ?>" alt="<?php echo get_option('mao10_dhtit_2'); ?>"></div>
						<div class="caption">
							<h4><?php echo get_option('mao10_dhtit_2'); ?></h4>
							<p><?php echo get_option('mao10_dhtib_2'); ?></p>
						</div>
					</a>
				</div>
				<div class="sidebox">
					<a href="<?php echo get_option('mao10_dhlnk_3'); ?>" class="thumbnail home-grid-sm home-grid-sm-3">
						<div class="img-div"><img src="<?php echo get_option('mao10_dhimg_3'); ?>" alt="<?php echo get_option('mao10_dhtit_3'); ?>"></div>
						<div class="caption">
							<h4><?php echo get_option('mao10_dhtit_3'); ?></h4>
							<p><?php echo get_option('mao10_dhtib_3'); ?></p>
						</div>
					</a>
				</div>
				<div class="sidebox">
					<a href="<?php echo get_option('mao10_dhlnk_4'); ?>" class="thumbnail home-grid-sm home-grid-sm-4">
						<div class="img-div"><img src="<?php echo get_option('mao10_dhimg_4'); ?>" alt="<?php echo get_option('mao10_dhtit_4'); ?>"></div>
						<div class="caption">
							<h4><?php echo get_option('mao10_dhtit_4'); ?></h4>
							<p><?php echo get_option('mao10_dhtib_4'); ?></p>
						</div>
					</a>
				</div>
				<div class="sidebox">
					<a href="<?php echo get_option('mao10_dhlnk_5'); ?>" class="thumbnail home-grid-sm home-grid-sm-3">
						<div class="img-div"><img src="<?php echo get_option('mao10_dhimg_5'); ?>" alt="<?php echo get_option('mao10_dhtit_5'); ?>"></div>
						<div class="caption">
							<h4><?php echo get_option('mao10_dhtit_5'); ?></h4>
							<p><?php echo get_option('mao10_dhtib_5'); ?></p>
						</div>
					</a>
				</div>
				<div class="sidebox">
					<a href="<?php echo get_option('mao10_dhlnk_6'); ?>" class="thumbnail home-grid-sm home-grid-sm-4">
						<div class="img-div"><img src="<?php echo get_option('mao10_dhimg_6'); ?>" alt="<?php echo get_option('mao10_dhtit_6'); ?>"></div>
						<div class="caption">
							<h4><?php echo get_option('mao10_dhtit_6'); ?></h4>
							<p><?php echo get_option('mao10_dhtib_6'); ?></p>
						</div>
					</a>
				</div>
				<div class="sidebox">
					<a href="<?php echo get_option('mao10_dhlnk_7'); ?>" class="thumbnail home-grid-sm home-grid-sm-1">
						<div class="img-div"><img src="<?php echo get_option('mao10_dhimg_7'); ?>" alt="<?php echo get_option('mao10_dhtit_7'); ?>"></div>
						<div class="caption">
							<h4><?php echo get_option('mao10_dhtit_7'); ?></h4>
							<p><?php echo get_option('mao10_dhtib_7'); ?></p>
						</div>
					</a>
				</div>
				<div class="sidebox">
					<a href="<?php echo get_option('mao10_dhlnk_8'); ?>" class="thumbnail home-grid-sm home-grid-sm-2">
						<div class="img-div"><img src="<?php echo get_option('mao10_dhimg_8'); ?>" alt="<?php echo get_option('mao10_dhtit_8'); ?>"></div>
						<div class="caption">
							<h4><?php echo get_option('mao10_dhtit_8'); ?></h4>
							<p><?php echo get_option('mao10_dhtib_8'); ?></p>
						</div>
					</a>
				</div>
			</div>
			<div class="col-sm-10">
				<ul class="media-list">
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<li class="media">
					<a class="pull-left" href="<?php the_permalink(); ?>">
						<img class="media-object" src="<?php echo img(); ?>" alt="<?php the_title(); ?>">
					</a>
					<div class="media-body">
						<h4 class="media-heading">
							<?php the_title(); ?>
						</h4>
						<?php the_excerpt(); ?>
					</div>
				</li>
				<?php endwhile; endif; ?>
				</ul>
				<ul id="pager" class="pagination">
					<?php par_pagenavi(9); ?>
				</ul>
			</div>
		</div>
	</div>
</div>
<?php get_footer(); ?>