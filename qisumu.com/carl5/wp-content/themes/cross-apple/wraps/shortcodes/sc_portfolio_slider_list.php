<?php 
/*
* ----------------------------------------------------------------------------------------------------
* Portfolio Slider List
* @PACKAGE BY HAWKTHEME
* ----------------------------------------------------------------------------------------------------
*/

add_shortcode('portfolio_slider_list', 'theme_sc_portfolio_slider_list');

function theme_sc_portfolio_slider_list( $atts, $content = null)
{

	extract(shortcode_atts(
        array(
            'category_slug_name' => '',
			'show_posts' => '8',
			'show_title' => 'yes',
			'show_desc' => 'yes',
			'desc_length' => '60',
			'lightbox' => 'yes',
			'fade' => 'yes'
    ), $atts));
	
	$output = '<div class="sc-slider-list sc-portfolio-slider-list flex-container">'."\n";
	$output .= theme_sc_portfolio_slider_list_loop($category_slug_name, $show_posts, $show_title, $show_desc, $desc_length, $lightbox, $fade);
	$output .= '</div>'."\n";

	return $output;

}



function theme_sc_portfolio_slider_list_loop($category_slug_name, $show_posts, $show_title, $show_desc, $desc_length, $lightbox, $fade)
{
	$loop_count = 0;
	$args = array( 
				'post_type' => 'portfolio',
				'portfolio-types' => $category_slug_name,
				'posts_per_page' => $show_posts,
				'post_status' => 'publish'
				); 
	$query = new WP_Query( $args );

	$output = '<div class="flexslider sc-flexslider">'."\n";
	$output .= '<ul class="slides">'."\n";

	while ($query->have_posts()) { $query->the_post();

		$loop_count++; 
		$post_id = get_the_id();

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

		if(($loop_count -1) % 4 == 0) 
		{ 
			$item_class = 'sc-slider-item sc-slider-item-first';
		}
		else
		{
			$item_class = 'sc-slider-item';
		}

		if(($loop_count -1) % 4 == 0) 
		{ 
			$output .= '<li>'."\n"; 
		}

		$output .= '<div class="'.$item_class.'">'."\n";

		if ( has_post_thumbnail()) {
			$output .= '<figure class="post-thumb">';
			$output .= '<a href="'.$link.'" '.$rel.' '.$link_class.'>'."\n";
			$output .= get_the_post_thumbnail($post_id,'205-140');
			$output .= '</a>'."\n";
			$output .= '</figure>'."\n";
		}

		if($show_title == 'yes' || $show_desc == 'yes') {

			$output .= '<section>'."\n";

			if($show_title == 'yes') { $output .= '<h3><a href="'.get_permalink().'"  rel="bookmark" title="'.get_the_title().'">'.get_the_title().'</a></h3>'."\n"; }
			if($show_desc == 'yes') { $output .= '<p>'.theme_pop_description($desc_length).'</p>'; }

			$output .= '</section>'."\n";

		}

		$output .= '</div>'."\n";

		if($loop_count % 4 == 0) 
		{ 
			$output .= '</li>'."\n";
		}

	}
	wp_reset_postdata();

	$output .= '</ul>'."\n";
	$output .= '</div>'."\n";

	return $output;
}

?>