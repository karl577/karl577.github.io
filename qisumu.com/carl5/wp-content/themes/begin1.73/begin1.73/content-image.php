<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">
		<?php if ( is_single() ) : ?>
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		<?php else : ?>
			<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php if ( ! is_single() ) : ?>
			<span class="post-format">
				<a class="entry-format" href="<?php echo esc_url( get_post_format_link( 'image' ) ); ?>"><i class="fa fa-picture-o"></i></a>
			</span>
			<figure class="content-image">
				<a href="<?php the_permalink() ?>" rel="bookmark"><?php all_img($post->post_content);?><div class="clear"></div></a>
			</figure>
			<span class="title-l"></span>
		<?php else : ?>
			<div class="single-content">
				<?php if ( has_excerpt() ) { ?><span class="abstract"><span>摘要</span><?php the_excerpt() ?></span><?php }?>

				<?php get_template_part('ad/ads', 'single'); ?>

				<?php the_content(); ?>
			</div>

			<?php get_template_part( 'inc/file' ); ?>

			<?php wp_link_pages(array('before' => '<div class="page-links">', 'after' => '', 'next_or_number' => 'next', 'previouspagelink' => '<span>上一页</span>', 'nextpagelink' => "")); ?>
			<?php wp_link_pages(array('before' => '', 'after' => '', 'next_or_number' => 'number', 'link_before' =>'<span>', 'link_after'=>'</span>')); ?>
			<?php wp_link_pages(array('before' => '', 'after' => '</div>', 'next_or_number' => 'next', 'previouspagelink' => '', 'nextpagelink' => "<span>下一页</span>")); ?>

				<?php get_template_part('ad/ads', 'single-b'); ?>

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
						<li class="comment"><?php comments_popup_link( '发表评论', '评论 1 ', '评论 % ' ); ?></li>
					<?php } ?>
					<?php if( function_exists( 'the_views' ) ) { print '<li class="views"> 阅读 '; the_views(); print ' </li>';  } ?>
					<li class="r-hide"><a href="javascript:pr()" onclick="javascript:this.innerHTML=(this.innerHTML=='隐藏边栏'?'显示边栏':'隐藏边栏');">隐藏边栏</a></li>
				</ul>

				<ul id="fontsize">A+</ul>
				<div class="single-cat-tag">
					<div class="single-cat">发布日期：<?php the_time( 'Y年m月d日' ); ?>&nbsp;&nbsp;所属分类：<?php the_category( '&nbsp;&nbsp;' ); ?></div>
					<div class="single-tag">标签：<?php the_tags('','',''); ?></div>
				</div>
			</footer><!-- .entry-footer -->

		<?php endif; ?>
	</div><!-- .entry-content -->

</article><!-- #post -->