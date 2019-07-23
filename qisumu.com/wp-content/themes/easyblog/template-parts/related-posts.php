<?php
/**
 * Related Posts
 */

$dt_post_per_page = 3;


$easyblog_related = get_posts(
	array(
		'category__in' 			=> wp_get_post_categories( $post->ID ),
		'post__not_in' 			=> array( $post->ID ),
		'orderby'           	=> 'rand',
		'posts_per_page'		=> $dt_post_per_page,
		'ignore_sticky_posts'	=> 1
	)
); ?>


	<div class="dt-news-layout-wrap dt-related-posts">
		<h2>Related posts</h2>

		<ul>
			<?php
			if( $easyblog_related ) foreach( $easyblog_related as $post ) {
				setup_postdata($post); ?>
					<li class="dt-news-post">
						<figure class="dt-news-post-img">
							<?php if ( has_post_thumbnail() ) :
								$image = '';
								$title_attribute = get_the_title( $post->ID );
								$image .= '<a href="'. esc_url( get_permalink() ) . '" title="' . the_title( '', '', false ) .'">';
								$image .= get_the_post_thumbnail( $post->ID, 'easyblog-recent-posts-img', array( 'title' => esc_attr( $title_attribute ), 'alt' => esc_attr( $title_attribute ) ) ).'</a>';
								echo $image;
							else : ?>
								<div class="dt-no-image"></div>
							<?php endif; ?>

							<a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark"><span class="transition35"><i class="fa fa-search transition35"></i></span></a>
						</figure>

						<h3><a href="<?php esc_url( the_permalink() ); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
					</li>
			<?php }
			?>
			<div class="clearfix"></div>
		</ul>
	</div>

	<?php wp_reset_postdata(); ?>

