<?php get_header(); ?>
<link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/cms/cms.css" />
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
		<!-- 幻灯调用指定文章，修改"include=1,2,3"中的数字为文章ID -->
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
			<!-- 最新文章调用篇数，修改"posts_per_page' =>"后面的数字 -->
			<?php query_posts( array( "category__in" => array(get_query_var("cat")), 'posts_per_page' => 4, 'ignore_sticky_posts' => 1) ); ?>
			<?php while ( have_posts() ) : the_post();$do_not_duplicate[] = $post->ID; ?>
			<?php get_template_part( 'content', get_post_format() ); ?>
			<?php endwhile; ?>
			<div class="clear"></div>

			<?php get_template_part('ad/ads', 'cms'); ?>

			<div class="line-small">
				<!-- 调用指定分类，修改"array(6,8,10,5)"中数字为分类ID -->
				<?php $display_categories =  array(6,8,10,5); foreach ($display_categories as $category) { ?>
				<?php query_posts( array( 'showposts' => 1, 'cat' => $category, 'post__not_in' => $do_not_duplicate ) ); ?>
				<div class="xl2 xm2">
					<div class="cat-box">
						<?php while ( have_posts() ) : the_post(); ?>
						<h3 class="cat-title"><i class="fa fa-bars"></i><a href="<?php echo get_category_link($category);?>" title="<?php echo strip_tags(category_description($category)); ?>"><?php single_cat_title(); ?></a></h3>
						<div class="clear"></div>
						<div class="cat-site">
							<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
							<figure class="thumbnail">
								<?php 
									if (zm_get_option('lazy_s')) {
									zm_the_thumbnail_h();
									} else {
									zm_the_thumbnail();
									}
								 ?>
							</figure>
							<div class="cat-main">
								<?php if (zm_get_option('abstract')) { ?>
								<?php if (has_excerpt('')){ ?>
								<?php the_excerpt(); ?>
								<?php } else { echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 86,"..."); } ?>
								<?php } else { ?>
								<?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 86,"..."); ?>
								<?php } ?>
								<?php endwhile; ?>
							</div>

							<div class="clear"></div>

							<ul class="cat-list">
								<!-- 分类文章列表篇数，修改"'showposts' => 10"中的数字 -->
								<?php query_posts( array( 'showposts' => 10, 'cat' => $category, 'offset' => 1, 'post__not_in' => $do_not_duplicate ) ); ?>
								<?php while ( have_posts() ) : the_post(); ?>
									<?php if (zm_get_option('list_date')) { ?><span class="list-date"><?php the_time('m/d') ?></span><?php } ?>
									<?php the_title( sprintf( '<li class="list-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></li>' ); ?>
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