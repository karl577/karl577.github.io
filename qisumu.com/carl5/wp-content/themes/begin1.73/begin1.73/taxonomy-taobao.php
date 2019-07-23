<?php get_header(); ?>

<style type="text/css">
.product-box {
	padding: 10px;
}
.product {
	height: 75px;
	margin-bottom: 15px;
	overflow: hidden;
}
.taourl a {
	float: right;
	background: #ff4400;
	color: #fff;
	line-height: 30px;
	margin: 0 0 10px 0;
	padding: 0 10px;
	border: 1px solid #ff4400;
	border-radius: 2px;
	box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
}
.detail a {
	float: right;
	background: #fff;
	line-height: 30px;
	margin: 0 0 5px 0;
	padding: 0 10px;
	border: 1px solid #ddd;
	border-radius: 2px;
	box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
}
.price {
	float: left;
	height: 55px;
	width: 50%;
}
.pricex {
	color: #ff4400;
}
.pricey {
	font-size: 12px;
	color: #999;
}
.edit-tao a {
	color: #999;
	padding: 0 5px 0 0;
	display: block;
}
.tao-box {
	background: #fff;
	margin: 0 0 10px 0;
	padding: 0px;
	border: 1px solid #ddd;
	border-radius: 2px;
	box-shadow: 0 1px 1px rgba(0, 0, 0, 0.03);
}
.tao-img {
	max-width: 100%;
 	width: auto;
	height: auto;
    overflow: hidden;
	transition-duration: .3s;
}
.tao-img a img {
	max-width: 100%;
 	width: auto;
	height: auto;
	-webkit-transition: -webkit-transform .3s linear;
	-moz-transition: -moz-transform .3s linear;
	-o-transition: -o-transform .3s linear;
	transition: transform .3s linear
}
.tao-img:hover a img {
	transition: All 0.7s ease;
	-webkit-transform: scale(1.1);
	-moz-transform: scale(1.1);
	-ms-transform: scale(1.1);
	-o-transform: scale(1.1);
}
.tao-title {
	text-align: center;
	line-height: 30px;
	margin: 0 10px 5px 10px;
	white-space: nowrap;
	text-overflow: ellipsis;
	overflow: hidden;
}
.tao {
	margin: 0 -5px;
}
.tao .xlt {
	position: relative;
	min-height: 1px;
	padding: 0 5px;
}
.xmt {
	position: relative;
	min-height: 1px;
}
@media screen and (min-width:320px) {
	.xlt {
		float: left;
		width: 50%;
		transition-duration: .5s;
	}
}
@media screen and (min-width:800px) {
	.xmt {
		float: left;
		width: 25%;
		transition-duration: .5s;
	}
}
@media screen and (min-width:999px) {
	.tao-img {
		overflow: hidden;
	}
}
@media screen and (max-width: 480px) {
	.xmt {
		float: left;
		width: 100%;
		transition-duration: .5s;
	}
	.tao {
		margin: 0 -4px;
	}
}
@media screen and (max-width: 900px) {
	#tao {
		width: 99.9%;
	}
}
</style>

<section id="tao" class="content-area">
	<main id="main" class="site-main" role="main">
		<?php $posts = query_posts($query_string . '&orderby=date&showposts=32');?>
		<?php while ( have_posts() ) : the_post(); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<div class="xlt xmt">
				<div class="tao-box">
					<figure class="tao-img">
						<?php tao_thumbnail(); ?>
					</figure>
					<div class="product-box">
						<div class="product"><?php $price = get_post_meta($post->ID, 'product', true);{ echo $price; }?></div>
						<ul class="price">
							<li class="pricex"><strong>￥<?php $price = get_post_meta($post->ID, 'pricex', true);{ echo $price; }?>元</strong></li>
							<?php if ( get_post_meta($post->ID, 'pricey', true) ) : ?>
								<li class="pricey"><del>市场价:<?php $price = get_post_meta($post->ID, 'pricey', true);{ echo $price; }?>元</del></li>
							<?php endif; ?>
							<?php edit_post_link('编辑', '<span class="edit-tao">', '</span>' ); ?>
						</ul>
						<div class="detail"><a href="<?php the_permalink(); ?>" rel="bookmark">查看详情</a></div>
						<div class="taourl"><a target="_blank" rel="external nofollow" href="<?php $url = get_post_meta($post->ID, 'taourl', true);{ echo $url; }?>" >马上抢购</a></div>
						<div class="clear"></div>
					</div>
				</div>
			</div>

		</article><!-- #post -->
		<?php endwhile; ?>

		<?php if (zm_get_option('scroll')) { ?>
			<?php zmingcx_page_nav( 'nav-below' ); ?>
		<?php } ?>

	</main><!-- .site-main -->

	<div class="clear"></div>
	<?php pagenavi(); ?>

</section><!-- .content-area -->

<?php get_footer(); ?>