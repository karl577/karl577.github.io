<?php 
/*
* ----------------------------------------------------------------------------------------------------
* Portfolio Category List
* @PACKAGE BY HAWKTHEME
* ----------------------------------------------------------------------------------------------------
*/

add_shortcode('portfolio_category_list', 'theme_sc_portfolio_category_list');

function theme_sc_portfolio_category_list( $atts, $content = null)
{

	extract(shortcode_atts(
        array(
			'title' => 'Your Title',
            'category_slug_name' => '',
			'show_posts' => '8',
			'lightbox' => 'yes',
			'fade' => 'yes'
    ), $atts));
	
	$output = '<div class="sc-portfolio-category-list">'."\n";
	if($title) { $output .= '<h3>'.$title.'</h3>'."\n"; }
	if($content) { $output .= '<p>'.theme_remove_autop(stripslashes($content)).'</p>'."\n"; }
	$output .= theme_sc_portfolio_category_list_loop($category_slug_name, $show_posts, $lightbox, $fade);
	$output .= '</div>'."\n";

	return $output;

}



function theme_sc_portfolio_category_list_loop($category_slug_name, $show_posts, $lightbox, $fade)
{
	$args = array( 
				'post_type' => 'portfolio',
				'portfolio-types' => $category_slug_name,
				'posts_per_page' => $show_posts,
				'post_status' => 'publish'
				); 
	$query = new WP_Query( $args );

	$loop_count = 0;

	$output = '<ul class="clearfix">'."\n";

	while ($query->have_posts()) { $query->the_post();

		$post_id = get_the_id();
		$loop_count++; 

		if ( ($loop_count-1) % 4 == 0 ) {
			$post_class = 'class="post first"';
		}elseif( $loop_count % 4 == 0 ) {
			$post_class = 'class="post last"';
		}else{
			$post_class = 'class="post"';
		}

		if($lightbox == 'yes') 
		{
			$link = theme_large_image_uri();
			$rel = 'data-id="fancybox"';
		}else{
			$link = get_permalink();
			$rel = 'rel="bookmark"';
		}

		if($fade == 'yes') 
		{
			$link_class = 'class="image-link"';
		}else{
			$link_class = '';
		}

		$output .= '<li '.$post_class.'>'."\n";

		if ( has_post_thumbnail()) {
			$output .= '<figure class="post-thumb">';
			$output .= '<a href="'.$link.'" '.$rel.' '.$link_class.'>'."\n";
			$output .= get_the_post_thumbnail($post_id,'125-90');
			$output .= '</a>'."\n";
			$output .= '</figure>';
		}

		$output .= '</li>'."\n";

	}
	wp_reset_postdata();

	$output .= '</ul>'."\n";

	return $output;
}

?>