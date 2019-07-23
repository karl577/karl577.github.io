<?php get_header(); ?>
<div class="container">
	<div class="row">
		<div class="col-sm-4">
			<div id="carousel-example-generic" class="carousel slide mb-10" data-ride="carousel">
				<ol class="carousel-indicators">
					<li data-target="#carousel-example-generic" data-slide-to="0" class="active">
					</li>
					<li data-target="#carousel-example-generic" data-slide-to="1">
					</li>
					<li data-target="#carousel-example-generic" data-slide-to="2">
					</li>
				</ol>
				<!-- Wrapper for slides -->
				<div class="carousel-inner">
					<?php query_posts('showposts=3&meta_key=fbt_value'); ?>
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					<?php $hdnum++; ?>
					<div class="item <?php if($hdnum==1) echo 'active'; ?>">
						<div class="img-div"><img src="<?php echo img(); ?>" alt="<?php the_title(); ?>"></div>
						<div class="carousel-caption">
							<h2>
								<?php the_title(); ?>
								<div class="clearfix"></div>
								<small><?php echo meta('fbt'); ?></small>
							</h2>
							<div class="hd-caption">
								<?php echo get_the_excerpt(); ?>
							</div>
						</div>
					</div>
					<?php endwhile; endif; wp_reset_query(); ?>
				</div>
			</div>
		</div>
		<div class="col-sm-8">
			<div class="row">
				<div class="col-sm-3">
					<a href="<?php echo get_option('mao10_dhlnk_1'); ?>" class="thumbnail home-grid-sm home-grid-sm-1">
						<div class="img-div"><img src="<?php echo get_option('mao10_dhimg_1'); ?>" alt="<?php echo get_option('mao10_dhtit_1'); ?>"></div>
						<div class="caption">
							<h4><?php echo get_option('mao10_dhtit_1'); ?></h4>
							<p><?php echo get_option('mao10_dhtib_1'); ?></p>
						</div>
					</a>
				</div>
				<div class="col-sm-3">
					<a href="<?php echo get_option('mao10_dhlnk_2'); ?>" class="thumbnail home-grid-sm home-grid-sm-2">
						<div class="img-div"><img src="<?php echo get_option('mao10_dhimg_2'); ?>" alt="<?php echo get_option('mao10_dhtit_2'); ?>"></div>
						<div class="caption">
							<h4><?php echo get_option('mao10_dhtit_2'); ?></h4>
							<p><?php echo get_option('mao10_dhtib_2'); ?></p>
						</div>
					</a>
				</div>
				<div class="col-sm-3">
					<a href="<?php echo get_option('mao10_dhlnk_3'); ?>" class="thumbnail home-grid-sm home-grid-sm-3">
						<div class="img-div"><img src="<?php echo get_option('mao10_dhimg_3'); ?>" alt="<?php echo get_option('mao10_dhtit_3'); ?>"></div>
						<div class="caption">
							<h4><?php echo get_option('mao10_dhtit_3'); ?></h4>
							<p><?php echo get_option('mao10_dhtib_3'); ?></p>
						</div>
					</a>
				</div>
				<div class="col-sm-3">
					<a href="<?php echo get_option('mao10_dhlnk_4'); ?>" class="thumbnail home-grid-sm home-grid-sm-4">
						<div class="img-div"><img src="<?php echo get_option('mao10_dhimg_4'); ?>" alt="<?php echo get_option('mao10_dhtit_4'); ?>"></div>
						<div class="caption">
							<h4><?php echo get_option('mao10_dhtit_4'); ?></h4>
							<p><?php echo get_option('mao10_dhtib_4'); ?></p>
						</div>
					</a>
				</div>
				<div class="clearfix"></div>
				<div class="col-sm-3">
					<a href="<?php echo get_option('mao10_dhlnk_5'); ?>" class="thumbnail home-grid-sm home-grid-sm-3">
						<div class="img-div"><img src="<?php echo get_option('mao10_dhimg_5'); ?>" alt="<?php echo get_option('mao10_dhtit_5'); ?>"></div>
						<div class="caption">
							<h4><?php echo get_option('mao10_dhtit_5'); ?></h4>
							<p><?php echo get_option('mao10_dhtib_5'); ?></p>
						</div>
					</a>
				</div>
				<div class="col-sm-3">
					<a href="<?php echo get_option('mao10_dhlnk_6'); ?>" class="thumbnail home-grid-sm home-grid-sm-4">
						<div class="img-div"><img src="<?php echo get_option('mao10_dhimg_6'); ?>" alt="<?php echo get_option('mao10_dhtit_6'); ?>"></div>
						<div class="caption">
							<h4><?php echo get_option('mao10_dhtit_6'); ?></h4>
							<p><?php echo get_option('mao10_dhtib_6'); ?></p>
						</div>
					</a>
				</div>
				<div class="col-sm-3">
					<a href="<?php echo get_option('mao10_dhlnk_7'); ?>" class="thumbnail home-grid-sm home-grid-sm-1">
						<div class="img-div"><img src="<?php echo get_option('mao10_dhimg_7'); ?>" alt="<?php echo get_option('mao10_dhtit_7'); ?>"></div>
						<div class="caption">
							<h4><?php echo get_option('mao10_dhtit_7'); ?></h4>
							<p><?php echo get_option('mao10_dhtib_7'); ?></p>
						</div>
					</a>
				</div>
				<div class="col-sm-3">
					<a href="<?php echo get_option('mao10_dhlnk_8'); ?>" class="thumbnail home-grid-sm home-grid-sm-2">
						<div class="img-div"><img src="<?php echo get_option('mao10_dhimg_8'); ?>" alt="<?php echo get_option('mao10_dhtit_8'); ?>"></div>
						<div class="caption">
							<h4><?php echo get_option('mao10_dhtit_8'); ?></h4>
							<p><?php echo get_option('mao10_dhtib_8'); ?></p>
						</div>
					</a>
				</div>
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="col-sm-8 mb-10">
			<div id="home-grid-two-left">
				<div class="row">
					<?php query_posts('showposts=2&cat='.get_option('mao10_homearc_1')); ?>
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					<?php $arcnum1++; ?>
					<div class="col-sm-6">
						<?php if($arcnum1==1) : ?>
						<div class="media">
							<a class="pull-left img-div" href="<?php the_permalink(); ?>">
								<img class="media-object" src="<?php echo img(); ?>" alt="<?php the_title(); ?>">
							</a>
							<div class="media-body">
								<h4 class="media-heading">
									<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								</h4>
								<?php echo get_the_excerpt(); ?>
							</div>
						</div>
						<?php else : ?>
						<div class="media-body">
							<h4 class="media-heading">
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</h4>
							<?php echo get_the_excerpt(); ?>
						</div>
						<?php endif; ?>
					</div>
					<?php endwhile; endif; wp_reset_query(); ?>
				</div>
			</div>
		</div>
		<div class="col-sm-4 mb-10">
			<div id="home-grid-two-right">
				<div class="img-div">
					<a href="<?php echo get_option('mao10_adlnk_1'); ?>"><img src="<?php echo get_option('mao10_adimg_1'); ?>"></a>
				</div>
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="col-sm-4 mb-10">
			<div id="home-grid-three-left" class="home-grid-three">
				<div class="img-div">
					<?php query_posts('showposts=1&cat='.get_option('mao10_homearc_2')); ?>
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					<a href="<?php the_permalink(); ?>"><img src="<?php echo img(); ?>"></a>
					<?php endwhile; endif; wp_reset_query(); ?>
				</div>
				<div class="panel panel-default">
					<!-- Default panel contents -->
					<div class="panel-heading">
						<?php echo get_cat_name(get_option('mao10_homearc_2')) ?>
					</div>
					<!-- List group -->
					<ul class="list-group">
						<?php query_posts('showposts=5&cat='.get_option('mao10_homearc_2')); ?>
						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
						<a class="list-group-item" href="<?php the_permalink(); ?>">
							<?php the_title(); ?>
						</a>
						<?php endwhile; endif; wp_reset_query(); ?>
					</ul>
				</div>
			</div>
		</div>
		<div class="col-sm-4 mb-10">
			<div id="home-grid-three-center" class="home-grid-three">
				<div class="panel panel-default">
					<!-- Default panel contents -->
					<div class="panel-heading">
						<?php echo get_cat_name(get_option('mao10_homearc_3')) ?>
					</div>
					<!-- List group -->
					<ul class="list-group">
						<?php query_posts('showposts=10&cat='.get_option('mao10_homearc_3')); ?>
						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
						<?php $arcnum3++; if($arcnum3==6) echo '<hr>'; ?>
						<a class="list-group-item" href="<?php the_permalink(); ?>">
							<?php the_title(); ?>
						</a>
						<?php endwhile; endif; wp_reset_query(); ?>
					</ul>
				</div>
			</div>
		</div>
		<div class="col-sm-4 mb-10">
			<div id="home-grid-three-right" class="home-grid-three">
				<div class="panel panel-default">
					<!-- Default panel contents -->
					<div class="panel-heading">
						<?php echo get_cat_name(get_option('mao10_homearc_4')) ?>
					</div>
					<div class="panel-body">
						<?php query_posts('showposts=2&cat='.get_option('mao10_homearc_4')); ?>
						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
						<?php $arcnum4++; ?>
						<div class="img-div <?php if($arcnum4==1) echo 'mb-10'; ?>">
							<a href="<?php the_permalink(); ?>"><img src="<?php echo img(); ?>"></a>
						</div>
						<?php endwhile; endif; wp_reset_query(); ?>
					</div>
					<!-- List group -->
					<ul class="list-group">
						<?php query_posts('offset=2&showposts=5&cat='.get_option('mao10_homearc_4')); ?>
						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
						<a class="list-group-item" href="<?php the_permalink(); ?>">
							<?php the_title(); ?>
						</a>
						<?php endwhile; endif; wp_reset_query(); ?>
					</ul>
				</div>
			</div>
		</div>
		<div class="clearfix"></div>
		<div class="col-sm-2">
			<a href="<?php echo get_option('mao10_dhlnk_9'); ?>" class="thumbnail home-grid-sm home-grid-sm-4">
				<div class="img-div"><img src="<?php echo get_option('mao10_dhimg_9'); ?>" alt="<?php echo get_option('mao10_dhtit_9'); ?>"></div>
				<div class="caption">
					<h4><?php echo get_option('mao10_dhtit_9'); ?></h4>
					<p><?php echo get_option('mao10_dhtib_9'); ?></p>
				</div>
			</a>
		</div>
		<div class="col-sm-6">
			<div id="home-grid-four-center">
				<div class="row">
					<div class="col-sm-4">
						<a href="<?php echo get_option('mao10_dhlnk_10'); ?>" class="thumbnail home-grid-sm home-grid-sm-1">
							<div class="img-div"><img src="<?php echo get_option('mao10_dhimg_10'); ?>" alt="<?php echo get_option('mao10_dhtit_10'); ?>"></div>
							<div class="caption">
								<h4><?php echo get_option('mao10_dhtit_10'); ?></h4>
								<p><?php echo get_option('mao10_dhtib_10'); ?></p>
							</div>
						</a>
					</div>
					<div class="col-sm-8">
						<?php query_posts('showposts=1&cat='.get_option('mao10_homearc_5')); ?>
						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
						<div class="media-body">
							<h4 class="media-heading">
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</h4>
							<?php echo get_the_excerpt(); ?>
						</div>
						<?php endwhile; endif; wp_reset_query(); ?>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-2">
			<a href="<?php echo get_option('mao10_dhlnk_11'); ?>" class="thumbnail home-grid-sm home-grid-sm-3">
				<div class="img-div"><img src="<?php echo get_option('mao10_dhimg_11'); ?>" alt="<?php echo get_option('mao10_dhtit_11'); ?>"></div>
				<div class="caption">
					<h4><?php echo get_option('mao10_dhtit_11'); ?></h4>
					<p><?php echo get_option('mao10_dhtib_11'); ?></p>
				</div>
			</a>
		</div>
		<div class="col-sm-2">
			<a href="<?php echo get_option('mao10_dhlnk_12'); ?>" class="thumbnail home-grid-sm home-grid-sm-2">
				<div class="img-div"><img src="<?php echo get_option('mao10_dhimg_12'); ?>" alt="<?php echo get_option('mao10_dhtit_12'); ?>"></div>
				<div class="caption">
					<h4><?php echo get_option('mao10_dhtit_12'); ?></h4>
					<p><?php echo get_option('mao10_dhtib_12'); ?></p>
				</div>
			</a>
		</div>
	</div>
</div>
<?php get_footer(); ?>