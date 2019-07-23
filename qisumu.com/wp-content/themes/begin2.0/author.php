<?php get_header(); ?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<div class="post">
			<div class="author-meta">
				<figure class="author-avatar"><?php echo get_avatar( get_the_author_meta('email'), '64' ); ?></figure>
				<header class="entry-header"><h2 class="entry-title"><span class="new-icon">关于作者</span><?php wp_title( ''); ?></h2><span class="title-l"></span></header>
				<div class="entry-content"><?php  echo the_author_meta( 'description' ); ?></div>
				<ul>
					<li>邮箱：<?php  echo the_author_meta( 'user_email' ); ?></li>
					<li>QQ：<?php  echo the_author_meta( 'qq' ); ?></li>
					<li>微信：<?php  echo the_author_meta( 'weixin' ); ?></li>	
				</ul>
					<span class="entry-more"><a href="<?php  echo the_author_meta( 'user_url' ); ?>" rel="bookmark">作者网站</a></span>
				<div class="clear"></div>
			</div>
		</div>

			<?php if ( have_posts() ) : ?>

			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'template/content', get_post_format() ); ?>

				<?php get_template_part('ad/ads', 'archive'); ?>

			<?php endwhile; ?>

			<?php else : ?>
				<?php get_template_part( 'template/content', 'none' ); ?>

			<?php endif; ?>

		</main><!-- .site-main -->

		<?php begin_pagenav(); ?>

	</section><!-- .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>