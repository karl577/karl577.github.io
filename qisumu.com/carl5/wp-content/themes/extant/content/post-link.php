<article <?php hybrid_attr( 'post' ); ?>>

	<?php if ( is_single( get_the_ID() ) ) : // If viewing a single post. ?>

		<div <?php hybrid_attr( 'entry-content' ); ?>>
			<?php the_content(); ?>
			<?php wp_link_pages(); ?>
		</div><!-- .entry-content -->

		<footer class="entry-footer">
			<?php hybrid_post_format_link(); ?>
			<span class="sep"><?php _ex( '&middot;', 'post meta separator', 'extant' ); ?></span>
			<time <?php hybrid_attr( 'entry-published' ); ?>><?php echo get_the_date(); ?></time>
			<?php hybrid_post_terms( array( 'taxonomy' => 'category', 'before' => '<br />' ) ); ?>
			<?php hybrid_post_terms( array( 'taxonomy' => 'post_tag' ) ); ?>
		</footer><!-- .entry-footer -->

	<?php else : // If not viewing a single post. ?>

		<?php extant_featured_image(); ?>

		<header class="entry-header">
			<?php the_title( '<h2 ' . hybrid_get_attr( 'entry-title' ) . '><a href="' . hybrid_get_the_post_format_url() . '">', is_rtl() ? ' <span class="meta-nav">&larr;</span>' : ' <span class="meta-nav">&rarr;</span>' . '</a></h2>' ); ?>
		</header><!-- .entry-header -->

		<footer class="entry-footer">
			<a class="entry-permalink" href="<?php the_permalink(); ?>" rel="bookmark" itemprop="url"><time <?php hybrid_attr( 'entry-published' ); ?>><?php echo get_the_date(); ?></time></a>
			<span class="sep"><?php _ex( '&middot;', 'post meta separator', 'extant' ); ?></span>
			<?php comments_popup_link( false, false, false, 'comments-link' ); ?>
		</footer><!-- .entry-footer -->

	<?php endif; // End single post check. ?>

</article><!-- .entry -->
