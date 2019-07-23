<?php get_header(); ?>
<div class="container">
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<?php setPostViews(get_the_ID()); ?>
<div id="single">
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
		</div>
		<div class="col-sm-8">
			<img id="fmimg" src="<?php echo img(); ?>">
			<div id="entry">
				<h1 class="title text-center"><?php the_title(); ?></h1>
				<?php the_content(); ?>
				<ul class="list-inline">
					<?php the_tags('<li><i class="glyphicon glyphicon-tags"></i>标签：',',','</li>'); ?>
					<li><i class="glyphicon glyphicon-eye-open"></i>浏览：<?php echo getPostViews(get_the_ID()); ?></li>
					<li><i class="glyphicon glyphicon-comment"></i>评论：<?php comments_number('0', '1', '%' );?></li>
				</ul>
				<hr>
				<div class="panel panel-default" id="comment-title">
					<div class="panel-heading">
						<h4 class="panel-title">发表新的回复</h4>
					</div>
					<div class="panel-body">
						<div id="comment">
							<?php comments_template(); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-2">
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
	</div>
</div>
<?php endwhile; endif; ?>
</div>
<?php get_footer(); ?>