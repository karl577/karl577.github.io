<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
			<div class="single-content">
				<?php the_content(); ?>

				<?php get_template_part( 'inc/file' ); ?>
				<?php if ( get_post_meta($post->ID, 'no_sidebar', true) ) : ?><style>	#primary {width: 100%;}#sidebar,.r-hide {display: none;}</style><?php endif; ?>

				<?php wp_link_pages(array('before' => '<div class="page-links">', 'after' => '', 'next_or_number' => 'next', 'previouspagelink' => '<span>上一页</span>', 'nextpagelink' => "")); ?>
				<?php wp_link_pages(array('before' => '', 'after' => '', 'next_or_number' => 'number', 'link_before' =>'<span>', 'link_after'=>'</span>')); ?>
				<?php wp_link_pages(array('before' => '', 'after' => '</div>', 'next_or_number' => 'next', 'previouspagelink' => '', 'nextpagelink' => "<span>下一页</span>")); ?>
			</div>

			<footer class="single-footer">
				<ul class="single-meta">
					<?php edit_post_link('编辑', '<li class="edit-link">', '</li>' ); ?>
					<li class="comment"><?php comments_popup_link( '评论 0', '评论 1 ', '评论 % ' ); ?></span>
					<?php if( function_exists( 'the_views' ) ) { print '<li class="views"> 阅读 '; the_views(); print ' </li>';  } ?>
					<li class="r-hide"><a href="javascript:pr()" onclick="javascript:this.innerHTML=(this.innerHTML=='隐藏边栏'?'显示边栏':'隐藏边栏');">隐藏边栏</a></li>
				</ul>

				<ul id="fontsize">A+</ul>
			</footer><!-- .entry-footer -->

	</div><!-- .entry-content -->

</article><!-- #page -->