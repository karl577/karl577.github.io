<?php
/*
Template Name: 商品分类
*/
?>
<?php get_header(); ?>
<style type="text/css">
.tao-cat {
	position: absolute;
	background: #ff4400;
	margin: 1px 6px;
	padding: 5px 15px;
	z-index: 2;
    border-radius: 2px 0 0 0;
}
.tao-cat a {
	font-size: 16px;
	font-size: 1.6rem;
	color: #fff;
}
.tao-cat a:hover {
	color: #fff;
}
.tao-cat .fa-bookmark-o {
	font-size: 18px;
	font-size: 1.8rem;
	margin: 0 5px 0 0;
}
.tao {
	position: relative;
	float: left;
	min-height: 1px;
	padding: 0 5px;
	transition-duration: .5s;
}
@media screen and (min-width:900px) {
	.tao {
		width: 25%;
	}
}
@media screen and (max-width:900px) {
	.tao {
		width: 33.33333333333333333%;
	}
}
@media screen and (max-width:690px) {
	.tao {
		width: 50%;
	}
}
@media screen and (max-width: 420px) {
	.tao {
		float: left;
		width: 50%;
	}
	#tao {
		margin: 0 -3px;
	}
}

</style>

<section id="tao" class="content-area">
	<main id="main" class="site-main" role="main">
		<?php
		$taxonomy = 'taobao'; $terms = get_terms($taxonomy); foreach ($terms as $cat) {
		$catid = $cat->term_id;
		$args = array(
			'showposts' => zm_get_option('custom_cat_n'),
			'tax_query' => array( array( 'taxonomy' => $taxonomy, 'terms' => $catid ) )
		);
		$query = new WP_Query($args);
		if( $query->have_posts() ) { ?>
		<div class="clear"></div>
		<h3 class="tao-cat"><a href="<?php echo get_term_link( $cat ); ?>" ><i class="fa fa-bookmark-o"></i><?php echo $cat->name; ?></a></h3>
		<div class="clear"></div>
		<?php while ($query->have_posts()) : $query->the_post();?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<div class="tao-box wow fadeInUp" data-wow-delay="0.3s">
						<figure class="tao-img">
							<?php if (zm_get_option('lazy_s')) { tao_thumbnail_h(); } else { tao_thumbnail(); } ?>
						</figure>
						<div class="product-box">
							<?php the_title( sprintf( '<h2><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
							<div class="product"><?php $price = get_post_meta($post->ID, 'product', true);{ echo $price; }?></div>
							<div class="ded">
								<ul class="price">
									<li class="pricex"><strong>￥ <?php $price = get_post_meta($post->ID, 'pricex', true);{ echo $price; }?>元</strong></li>
									<?php if ( get_post_meta($post->ID, 'pricey', true) ) : ?>
										<li class="pricey"><del>市场价：<?php $price = get_post_meta($post->ID, 'pricey', true);{ echo $price; }?>元</del></li>
									<?php endif; ?>
								</ul>
								<div class="go-url">
									<div class="taourl">
										<?php if ( get_post_meta($post->ID, 'taourl', true) ) { ?>
											<a target="_blank" rel="external nofollow" href="<?php $url = get_post_meta($post->ID, 'taourl', true);{ echo $url; }?>" >购买</a>
										<?php } else { ?>
											<a href="<?php the_permalink(); ?>" >购买</a>
										<?php } ?>
									</div>
									<div class="detail"><a href="<?php the_permalink(); ?>" rel="bookmark">详情</a></div>
								</div>
								<div class="clear"></div>
							</div>
						</div>
					</div>
				<div class="clear"></div>
			</article>
		<?php endwhile; ?>
		<?php } wp_reset_query(); ?>
		<?php } ?>
	</main>
	<div class="clear"></div>
</section>

<?php get_footer(); ?>