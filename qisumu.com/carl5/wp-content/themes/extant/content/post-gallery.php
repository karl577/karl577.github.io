<article <?php hybrid_attr( 'post' ); ?>>

	<?php if ( is_single( get_the_ID() ) ) : // If viewing a single post. ?>

		<header class="entry-header">

			<h1 <?php hybrid_attr( 'entry-title' ); ?>><?php single_post_title(); ?></h1>

			<div class="entry-byline">
				<?php hybrid_post_format_link(); ?>
				<span class="sep"><?php _ex( '&middot;', 'post meta separator', 'extant' ); ?></span>
				<time <?php hybrid_attr( 'entry-published' ); ?>><?php echo get_the_date(); ?></time>
				<span class="sep"><?php _ex( '&middot;', 'post meta separator', 'extant' ); ?></span>
				<?php comments_popup_link( false, false, false, 'comments-link' ); ?>
			</div><!-- .entry-byline -->

		</header><!-- .entry-header -->

		<div <?php hybrid_attr( 'entry-content' ); ?>>
			<?php the_content(); ?>
			<?php wp_link_pages(); ?>
		</div><!-- .entry-content -->

		<footer class="entry-footer">
			<?php hybrid_post_terms( array( 'taxonomy' => 'category' ) ); ?>
			<?php hybrid_post_terms( array( 'taxonomy' => 'post_tag' ) ); ?>
		</footer><!-- .entry-footer -->

	<?php else : // If not viewing a single post. ?>

		<?php $count = hybrid_get_gallery_item_count(); ?>
		<?php $gallery_count = '<p class="gallery-count">' . sprintf( _n( '%s gallery item', '%s gallery items', $count, 'extant' ), $count ) . '</p>'; ?>

		<?php extant_featured_image( array( 'after' => $gallery_count . '</div>' ) ); ?>

		<header class="entry-header">

			<?php the_title( '<h2 ' . hybrid_get_attr( 'entry-title' ) . '><a href="' . esc_url( get_permalink() ) . '" rel="bookmark" itemprop="url">', '</a></h2>' ); ?>

			<div class="entry-byline">
				<a class="entry-permalink" href="<?php the_permalink(); ?>" rel="bookmark" itemprop="url"><time <?php hybrid_attr( 'entry-published' ); ?>><?php echo get_the_date(); ?></time></a>
				<span class="sep"><?php _ex( '&middot;', 'post meta separator', 'extant' ); ?></span>
				<?php comments_popup_link( false, false, false, 'comments-link' ); ?>
			</div><!-- .entry-byline -->

		</header><!-- .entry-header -->

	<?php endif; // End single post check. ?>

</article><!-- .entry -->
