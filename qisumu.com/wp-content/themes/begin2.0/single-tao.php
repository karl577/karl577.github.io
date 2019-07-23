<?php get_header(); ?>

<style type="text/css">
.tao-goods {
	border: 1px solid #fff;
}
.tao-img {
	float: left;
 	width: 261px;
	height: 261px;
	margin: 0 30px 30px 0;
    overflow: hidden;
	transition-duration: .3s;
}
.tao-img a img {
 	width: 261px;
	height: 261px;
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
.brief {
	float: left;
	width: 50%;
	margin: 0 0 0 40px;
	padding: 0 10px 10px 10px;
}
.product {
	font-size: 15px;
	font-weight: bold;
}
.pricex {
	font-size: 16px;
	color: #ff4400;
}

.tao-goods ul li {
    list-style:none;
}
.tao-goods ul li {
    line-height: 180%;
    margin: 0;
}
.brief li {
	padding: 5px 0;
}
.taourl a {
	float: left;
	background: #ff4400;
	color: #fff !important;
	line-height: 35px;
	margin: 40px 0 0 0;
	padding: 0 15px;
	border: 1px solid #ff4400;
	border-radius: 2px;
	box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
}
.taourl a:hover {
	background: #7ab951;
	border: 1px solid #7ab951;
}
@media screen and (max-width: 640px) {
	.brief {
		width: 100%;
	}
.tao-img {
	float: inherit;
	margin: 0 auto 0;

}
}
</style>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<header class="entry-header">
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				</header><!-- .entry-header -->

				<div class="entry-content">
					<div class="single-content">
						<div class="tao-goods">
							<figure class="tao-img">
								<?php tao_thumbnail(); ?>
							</figure>

							<ul class="brief">
								<li class="product"><?php $price = get_post_meta($post->ID, 'product', true);{ echo $price; }?></li>
								<li class="pricex"><strong>￥<?php $price = get_post_meta($post->ID, 'pricex', true);{ echo $price; }?>元</strong></li>
								<?php if ( get_post_meta($post->ID, 'pricey', true) ) : ?>
									<li class="pricey"><del>市场价:<?php $price = get_post_meta($post->ID, 'pricey', true);{ echo $price; }?>元</del></li>
								<?php endif; ?>	
								<div class="taourl"><a target="_blank" rel="external nofollow" href="<?php $url = get_post_meta($post->ID, 'taourl', true);{ echo $url; }?>" >直接购买</a></div>
							</ul>
							<div class="clear"></div>
						</div>

						<div class="clear"></div>

						<?php the_content(); ?>
						<?php if ( get_post_meta($post->ID, 'no_sidebar', true) ) : ?><style>	#primary {width: 100%;}#sidebar,.r-hide {display: none;}</style><?php endif; ?>
						<div class="clear"></div>
						<?php wp_link_pages(array('before' => '<div class="page-links">', 'after' => '', 'next_or_number' => 'next', 'previouspagelink' => '<span><i class="fa fa-angle-left"></i></span>', 'nextpagelink' => "")); ?>
						<?php wp_link_pages(array('before' => '', 'after' => '', 'next_or_number' => 'number', 'link_before' =>'<span>', 'link_after'=>'</span>')); ?>
						<?php wp_link_pages(array('before' => '', 'after' => '</div>', 'next_or_number' => 'next', 'previouspagelink' => '', 'nextpagelink' => '<span><i class="fa fa-angle-right"></i></span> ')); ?>
					</div>

						<?php if (zm_get_option('zm_like')) { ?>
							<?php get_template_part( 'inc/social' ); ?>
						<?php } else { ?>
							<div id="social"></div>
						<?php } ?>

						<footer class="single-footer">
							<ul class="single-meta">
								<?php edit_post_link('编辑', '<li class="edit-link">', '</li>' ); ?>
								<?php if ( post_password_required() ) { ?>
									<li class="comment"><a href="#comments">密码保护</a></li>
								<?php } else { ?>
									<li class="comment"><?php comments_popup_link( '<i class="fa fa-comment-o"></i> 发表评论', '<i class="fa fa-comment-o"></i> 1 ', '<i class="fa fa-comment-o"></i> %' ); ?></li>
								<?php } ?>
								<?php if( function_exists( 'the_views' ) ) { the_views(true, '<li class="views"><i class="fa fa-eye"></i> ','</li>');  } ?>
							</ul>
							<ul id="fontsize">A+</ul>
							<div class="single-cat-tag">
								<div class="single-cat">日期：<?php the_time( 'Y年m月d日' ) ?> 分类：<?php echo get_the_term_list( $post->ID,  'taobao', '' ); ?></div>
								<div class="single-tag"><?php echo get_the_term_list($post->ID,  'taotag', '标签：', ', ', ''); ?></div>
							</div>
						</footer><!-- .entry-footer -->

					<div class="clear"></div>
				</div><!-- .entry-content -->


			</article><!-- #post -->

			<?php if (zm_get_option('copyright')) { ?>
				<div class="wow fadeInUp" data-wow-delay="0.3s"><?php get_template_part( 'inc/copyright' ); ?></div>
			<?php } ?>

			<?php if (zm_get_option('related_img')) { ?>
				<div class="wow fadeInUp" data-wow-delay="0.3s"><?php get_template_part( 'template/single-tao' ); ?></div>
			<?php } ?>

			<div class="wow fadeInUp" data-wow-delay="0.3s"><?php get_template_part('ad/ads', 'comments'); ?></div>

				<nav class="nav-single wow fadeInUp" data-wow-delay="0.3s">
					<?php
						if (get_previous_post()) { previous_post_link( '%link','<span class="meta-nav"><span class="post-nav"><i class="fa fa-angle-left"></i> 上一篇</span><br/>%title</span>' ); } else { echo "<span class='meta-nav'><span class='post-nav'>没有了<br/></span>已是最后文章</span>"; }
						if (get_next_post()) { next_post_link( '%link', '<span class="meta-nav"><span class="post-nav">下一篇 <i class="fa fa-angle-right"></i></span><br/>%title</span>' ); } else { echo "<span class='meta-nav'><span class='post-nav'>没有了<br/></span>已是最新文章</span>"; }
					?>
					<div class="clear"></div>
				</nav>

				<?php
					the_post_navigation( array(
						'next_text' => '<span class="meta-nav-l" aria-hidden="true"><i class="fa fa-angle-right"></i></span>',
						'prev_text' => '<span class="meta-nav-r" aria-hidden="true"><i class="fa fa-angle-left"></i></span>',
					) );
				?>

			<?php if ( comments_open() || get_comments_number() ) : ?>
				<?php comments_template( '', true ); ?>
			<?php endif; ?>

		<?php endwhile; ?>

	</main><!-- .site-main -->
</div><!-- .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>