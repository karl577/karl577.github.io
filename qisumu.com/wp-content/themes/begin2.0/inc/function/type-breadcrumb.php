<?php 
if ( is_tax('gallery') ) {
	$current_term = $wp_query->get_queried_object();
	$ancestors = array_reverse( get_ancestors( $current_term->term_id, 'gallery' ) );
	foreach ( $ancestors as $ancestor ) {
		$ancestor = get_term( $ancestor, 'gallery' );
		echo $before .  '<a href="' . get_term_link( $ancestor ) . '">' . esc_html( $ancestor->name ) . '</a><i class="fa fa-angle-right"></i>' . $after . $delimiter;
	}
	echo $before . esc_html( $current_term->name ) . $after;
}

if ( is_tax('videos') ) {
	$current_term = $wp_query->get_queried_object();
	$ancestors = array_reverse( get_ancestors( $current_term->term_id, 'videos' ) );
	foreach ( $ancestors as $ancestor ) {
		$ancestor = get_term( $ancestor, 'videos' );
		echo $before .  '<a href="' . get_term_link( $ancestor ) . '">' . esc_html( $ancestor->name ) . '</a><i class="fa fa-angle-right"></i>' . $after . $delimiter;
	}
	echo $before . esc_html( $current_term->name ) . $after;
}

if ( is_tax('taobao') ) {
	$current_term = $wp_query->get_queried_object();
	$ancestors = array_reverse( get_ancestors( $current_term->term_id, 'taobao' ) );
	foreach ( $ancestors as $ancestor ) {
		$ancestor = get_term( $ancestor, 'taobao' );
		echo $before .  '<a href="' . get_term_link( $ancestor ) . '">' . esc_html( $ancestor->name ) . '</a><i class="fa fa-angle-right"></i>' . $after . $delimiter;
	}
	echo $before . esc_html( $current_term->name ) . $after;
}

if ( is_tax('notice') ) {
	$current_term = $wp_query->get_queried_object();
	$ancestors = array_reverse( get_ancestors( $current_term->term_id, 'notice' ) );
	foreach ( $ancestors as $ancestor ) {
		$ancestor = get_term( $ancestor, 'notice' );
		echo $before .  '<a href="' . get_term_link( $ancestor ) . '">' . esc_html( $ancestor->name ) . '</a><i class="fa fa-angle-right"></i>' . $after . $delimiter;
	}
	echo $before . esc_html( $current_term->name ) . $after;
}

if ( 'tao' == get_post_type() && is_single() ) {
	if ( $terms = begin_taxonomy_terms( $post->ID, 'taobao', array( 'orderby' => 'parent', 'order' => 'DESC' ) ) ) {
		$main_term = $terms[0];
		$ancestors = get_ancestors( $main_term->term_id, 'taobao' );
		$ancestors = array_reverse( $ancestors );
		foreach ( $ancestors as $ancestor ) {
			$ancestor = get_term( $ancestor, 'taobao' );
			if ( ! is_wp_error( $ancestor ) && $ancestor ) {
				echo $before . '<a href="' . get_term_link( $ancestor ) . '">' . $ancestor->name . '</a><i class="fa fa-angle-right"></i>' . $after . $delimiter;
			}
		}
		echo $before . '<a href="' . get_term_link( $main_term ) . '">' . $main_term->name . '</a><i class="fa fa-angle-right"></i>' . $after . $delimiter;
	}
	// echo $before . get_the_title() . $after;
	echo 正文;
}

if ( 'picture' == get_post_type() && is_single() ) {
	if ( $terms = begin_taxonomy_terms( $post->ID, 'gallery', array( 'orderby' => 'parent', 'order' => 'DESC' ) ) ) {
		$main_term = $terms[0];
		$ancestors = get_ancestors( $main_term->term_id, 'gallery' );
		$ancestors = array_reverse( $ancestors );
		foreach ( $ancestors as $ancestor ) {
			$ancestor = get_term( $ancestor, 'gallery' );
			if ( ! is_wp_error( $ancestor ) && $ancestor ) {
				echo $before . '<a href="' . get_term_link( $ancestor ) . '">' . $ancestor->name . '</a><i class="fa fa-angle-right"></i>' . $after . $delimiter;
			}
		}
		echo $before . '<a href="' . get_term_link( $main_term ) . '">' . $main_term->name . '</a><i class="fa fa-angle-right"></i>' . $after . $delimiter;
	}
	// echo $before . get_the_title() . $after;
	echo 正文;
}

if ( 'video' == get_post_type() && is_single() ) {
	if ( $terms = begin_taxonomy_terms( $post->ID, 'videos', array( 'orderby' => 'parent', 'order' => 'DESC' ) ) ) {
		$main_term = $terms[0];
		$ancestors = get_ancestors( $main_term->term_id, 'videos' );
		$ancestors = array_reverse( $ancestors );
		foreach ( $ancestors as $ancestor ) {
			$ancestor = get_term( $ancestor, 'videos' );
			if ( ! is_wp_error( $ancestor ) && $ancestor ) {
				echo $before . '<a href="' . get_term_link( $ancestor ) . '">' . $ancestor->name . '</a><i class="fa fa-angle-right"></i>' . $after . $delimiter;
			}
		}
		echo $before . '<a href="' . get_term_link( $main_term ) . '">' . $main_term->name . '</a><i class="fa fa-angle-right"></i>' . $after . $delimiter;
	}
	// echo $before . get_the_title() . $after;
	echo 正文;
}

if ( 'bulletin' == get_post_type() && is_single() ) {
	if ( $terms = begin_taxonomy_terms( $post->ID, 'notice', array( 'orderby' => 'parent', 'order' => 'DESC' ) ) ) {
		$main_term = $terms[0];
		$ancestors = get_ancestors( $main_term->term_id, 'notice' );
		$ancestors = array_reverse( $ancestors );
		foreach ( $ancestors as $ancestor ) {
			$ancestor = get_term( $ancestor, 'notice' );
			if ( ! is_wp_error( $ancestor ) && $ancestor ) {
				echo $before . '<a href="' . get_term_link( $ancestor ) . '">' . $ancestor->name . '</a><i class="fa fa-angle-right"></i>' . $after . $delimiter;
			}
		}
		echo $before . '<a href="' . get_term_link( $main_term ) . '">' . $main_term->name . '</a><i class="fa fa-angle-right"></i>' . $after . $delimiter;
	}
	// echo $before . get_the_title() . $after;
	echo 正文;
}
?>