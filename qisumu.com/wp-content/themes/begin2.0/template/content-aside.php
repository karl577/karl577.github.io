<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">
		<?php if ( is_single() ) : ?>
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		<?php else : ?>
			<span class="format-cat"><?php zm_category(); ?></span>
			<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php if ( ! is_single() ) : ?>
			<div class="archive-content">
				<?php if (has_excerpt('')){ echo wp_trim_words( get_the_excerpt(), 90, '...' ); } else { echo wp_trim_words( get_the_content(), 100, '...' ); } ?>
			</div>
			<span class="title-l"></span>
			<span class="post-format"><i class="fa fa-file-text"></i></span>
			<span class="entry-meta">
				<span class="date"><?php the_time( 'Y年m月d日' ); ?>&nbsp;</span>
				<?php if( function_exists( 'the_views' ) ) { the_views( true, '<span class="views">阅读 ','</span>' ); } ?>
				<?php if ( post_password_required() ) { ?>
					<span class="comment"><a href=""><i class="icon-scroll-c"></i> 密码保护</a></span>
				<?php } else { ?>
					<span class="comment"><?php comments_popup_link( '<i class="fa fa-comment-o"></i> 发表评论', '<i class="fa fa-comment-o"></i> 1 ', '<i class="fa fa-comment-o"></i> %' ); ?></span>
				<?php } ?>
			</span>
		<?php else : ?>
			<div class="single-content">
				<?php if ( has_excerpt() ) { ?><span class="abstract"><span>摘要</span><?php the_excerpt() ?></span><?php }?>

				<?php get_template_part('ad/ads', 'single'); ?>

				<?php the_content(); ?>
			</div>

			<?php get_template_part( 'inc/file' ); ?>
			<?php if ( get_post_meta($post->ID, 'no_sidebar', true) ) : ?><style>	#primary {width: 100%;}#sidebar,.r-hide {display: none;}</style><?php endif; ?>

			<?php wp_link_pages(array('before' => '<div class="page-links">', 'after' => '', 'next_or_number' => 'next', 'previouspagelink' => '<span><i class="fa fa-angle-left"></i></span>', 'nextpagelink' => "")); ?>
			<?php wp_link_pages(array('before' => '', 'after' => '', 'next_or_number' => 'number', 'link_before' =>'<span>', 'link_after'=>'</span>')); ?>
			<?php wp_link_pages(array('before' => '', 'after' => '</div>', 'next_or_number' => 'next', 'previouspagelink' => '', 'nextpagelink' => '<span><i class="fa fa-angle-right"></i></span> ')); ?>

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
						<li class="comment"><?php comments_popup_link( '<i class="fa fa-comment-o"></i> 发表评论', '<i class="fa fa-comment-o"></i> 1 ', '<i class="fa fa-comment-o"></i> %' ); ?></li>
					<?php } ?>
					<?php if( function_exists( 'the_views' ) ) { the_views(true, '<li class="views"><i class="fa fa-eye"></i> ','</li>');  } ?>
				 	<li class="r-hide"><a href="javascript:pr()" title="侧边栏"><i class="fa fa-caret-left"></i> <i class="fa fa-caret-right"></i></a></li>
				</ul>

				<ul id="fontsize">A+</ul>
				<div class="single-cat-tag">
					<div class="single-cat">发布日期：<?php the_time( 'Y年m月d日' ); ?>&nbsp;&nbsp;所属分类：<?php the_category( '&nbsp;&nbsp;' ); ?></div>
					<div class="single-tag"><?php the_tags('标签：','',''); ?></div>
				</div>
			</footer><!-- .entry-footer -->

		<?php endif; ?>
		<div class="clear"></div>
	</div><!-- .entry-content -->

	<?php if ( ! is_single() ) : ?>
		<?php if ( get_post_meta($post->ID, 'direct', true) ) { ?>
		<?php $direct = get_post_meta($post->ID, 'direct', true); ?>
		<span class="entry-more"><a href="<?php echo $direct ?>" target="_blank" rel="nofollow"><?php echo zm_get_option('direct_w'); ?></a></span>
		<?php } else { ?>
		<span class="entry-more"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php echo zm_get_option('more_w'); ?></a></span>
		<?php } ?>
	<?php endif; ?>
</article><!-- #post -->