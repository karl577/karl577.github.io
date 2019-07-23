<?php get_header(); ?>
<!-- 分类杂志布局 -->
<script type="text/javascript" src="<?php echo esc_url( get_template_directory_uri() );?>/js/slides.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$("#slider-cat").responsiveSlides({
			auto: true,
			pager: true,
			speed: 800,
			maxwidth: 1080
		});
	});
</script>

<div id="slideshow">
	<ul class="rslides" id="slider-cat">
		<!-- 幻灯调用指定文章，修改下面"include=1,2,3"中的数字为文章ID -->
		<?php $posts = get_posts("include=1,2,3"); if($posts) : foreach( $posts as $post ) : setup_postdata( $post );$do_not_duplicate[] = $post->ID; ?>
		<?php $image = get_post_meta($post->ID, 'cat_img', true); ?>
			<li>
				<a href="<?php the_permalink() ?>" rel="bookmark"><img src="<?php echo $image; ?>" alt="<?php the_title(); ?>" /></a>
				<p class="slider-caption"><?php the_title(); ?></p>
			</li>
		<?php endforeach; endif; ?>
		<?php wp_reset_query(); ?>
	</ul>
</div>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<!-- 最新文章调用篇数，修改下面"posts_per_page' =>"后面的数字 -->
			<?php query_posts( array( "category__in" => array(get_query_var("cat")), 'posts_per_page' => 4, 'ignore_sticky_posts' => 1) ); ?>
			<?php while ( have_posts() ) : the_post();$do_not_duplicate[] = $post->ID; ?>
				<?php get_template_part( 'template/content', get_post_format() ); ?>
			<?php endwhile; ?>
			<div class="clear"></div>

			<?php get_template_part('ad/ads', 'cms'); ?>

			<div class="line-small">

				<!-- 调用指定分类，修改下面"array(6,8,10,5)"中数字为分类ID -->
				<?php $display_categories =  array(6,8,10,5); foreach ($display_categories as $category) { ?>
				
				<?php query_posts( array( 'showposts' => 1, 'cat' => $category, 'post__not_in' => $do_not_duplicate ) ); ?>
				<div class="xl2 xm2">
					<div class="cat-box">
						<h3 class="cat-title"><a href="<?php echo get_category_link($category);?>" title="<?php echo strip_tags(category_description($category)); ?>"><i class="fa fa-bars"></i><?php single_cat_title(); ?></a></h3>
						<div class="clear"></div>
						<div class="cat-site">
							<?php while ( have_posts() ) : the_post(); ?>
								<figure class="small-thumbnail"><?php if (zm_get_option('lazy_s')) { zm_long_thumbnail_h(); } else { zm_long_thumbnail(); } ?></figure>
								<?php the_title( sprintf( '<h2 class="entry-small-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
							<?php endwhile; ?>
							<div class="clear"></div>

							<ul class="cat-list">
								<!-- 分类文章列表篇数，修改下面"'showposts' => 8"中的数字 -->
								<?php query_posts( array( 'showposts' => 8, 'cat' => $category, 'offset' => 1, 'post__not_in' => $do_not_duplicate ) ); ?>

								<?php while ( have_posts() ) : the_post(); ?>
									<?php if (zm_get_option('list_date')) { ?><span class="list-date"><?php the_time('m/d') ?></span><?php } ?>
									<?php the_title( sprintf( '<li class="list-title"><i class="fa fa-angle-right"></i><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></li>' ); ?>
								<?php endwhile; ?>
								<?php wp_reset_query(); ?>
							</ul>
						</div>
					</div>
				</div>
				<?php } ?>
				<div class="clear"></div>
			</div>

		</main><!-- .site-main -->
	</div><!-- .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>