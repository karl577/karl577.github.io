<article <?php hybrid_attr( 'post' ); ?>>

	<?php if ( is_single( get_the_ID() ) ) : // If viewing a single post. ?>

		<header class="entry-header">
			<h1 <?php hybrid_attr( 'entry-title' ); ?>><?php single_post_title(); ?></h1>
		</header><!-- .entry-header -->

		<div <?php hybrid_attr( 'entry-content' ); ?>>
			<?php the_content(); ?>
			<?php wp_link_pages(); ?>
		</div><!-- .entry-content -->

		<footer class="entry-footer">
			<?php hybrid_post_terms( array( 'taxonomy' => 'portfolio_category' ) ); ?>
			<?php hybrid_post_terms( array( 'taxonomy' => 'portfolio_tag' ) ); ?>

			<?php
				$meta = '';
				$meta .= ccp_get_project_client(     array( 'wrap' => '<li %s><span class="project-key">' . __( 'Client',    'extant' ) . '</span> %s</li>' ) );
				$meta .= ccp_get_project_location(   array( 'wrap' => '<li %s><span class="project-key">' . __( 'Location',  'extant' ) . '</span> %s</li>' ) );
				$meta .= ccp_get_project_start_date( array( 'wrap' => '<li %s><span class="project-key">' . __( 'Started',   'extant' ) . '</span> %s</li>' ) );
				$meta .= ccp_get_project_end_date(   array( 'wrap' => '<li %s><span class="project-key">' . __( 'Completed', 'extant' ) . '</span> %s</li>' ) );
			?>

			<?php if ( $meta ) : ?>
				<ul class="project-meta"><?php echo $meta; ?></ul>
			<?php endif; ?>

			<?php ccp_project_link( array( 'text' => __( 'View Project Site', 'extant' ), 'before' => '<div class="project-link-wrap">', 'after' => '</div>' ) ); ?>
		</footer><!-- .entry-footer -->

	<?php else : // If not viewing a single post. ?>

		<?php extant_featured_image(); ?>

		<header class="entry-header">
			<?php the_title( '<h2 ' . hybrid_get_attr( 'entry-title' ) . '><a href="' . esc_url( get_permalink() ) . '" rel="bookmark" itemprop="url">', '</a></h2>' ); ?>
		</header><!-- .entry-header -->

	<?php endif; // End single post check. ?>

</article><!-- .entry -->
