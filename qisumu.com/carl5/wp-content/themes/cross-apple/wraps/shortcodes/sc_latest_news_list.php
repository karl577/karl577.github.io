<?php 
/*
* ----------------------------------------------------------------------------------------------------
* Latest News List
* @PACKAGE BY HAWKTHEME
* ----------------------------------------------------------------------------------------------------
*/

add_shortcode('latest_news_list', 'theme_sc_latest_news_list');

function theme_sc_latest_news_list( $atts, $content = null)
{

	extract(shortcode_atts(
        array(
            'category_slug_name' => '',
			'show_posts' => '3',
			'lightbox' => 'yes'
    ), $atts));
	
	$output = '<div class="sc-latest-news-list widget-posts">'."\n";
	$output .= theme_sc_latest_news_list_loop($category_slug_name, $show_posts, $lightbox);
	$output .= '</div>'."\n";

	return $output;

}



function theme_sc_latest_news_list_loop($category_slug_name, $show_posts, $lightbox)
{
	$args = array( 
				'post_type' => 'post',
				'category_name' => $category_slug_name,
				'posts_per_page' => $show_posts,
				'post_status' => 'publish'
				); 
	$query = new WP_Query( $args );

	$loop_count = 0;

	$output = '<ul>'."\n";

	while ($query->have_posts()) { $query->the_post();

		$post_id = get_the_id();

		if($lightbox == 'yes') 
		{
			$link = theme_large_image_uri();
			$rel = 'data-id="fancybox"';
		}else{
			$link = get_permalink();
			$rel = 'rel="bookmark"';
		}

		$output .= '<li class="clearfix">'."\n";

		if ( has_post_thumbnail()) {
			$output .= '<figure class="post-thumb alignleft">';
			$output .= '<a href="'.$link.'" '.$rel.' class="image-link">'."\n";
			$output .= get_the_post_thumbnail($post_id,'50-50');
			$output .= '</a>'."\n";
			$output .= '</figure>';
		}

		$output .= '<section>'."\n";
		$output .= '<h5><a href="'.get_permalink().'"  rel="bookmark" title="'.get_the_title().'">'.get_the_title().'</a></h5>'."\n";
		$output .= '<p class="post-meta">';
		ob_start(); printf( __('%1$s', 'HK'), get_the_time('F j, Y') ); $output .= ob_get_clean();
		$output .= '<span></span>';
		ob_start(); comments_popup_link(__('No Comment', 'HK'), __('1Comment', 'HK'), __('%评论', 'HK'), '', __('Comment Off', 'HK')); $output .= ob_get_clean();
		$output .= '</p>';
		$output .= '</section>'."\n";

		$output .= '</li>'."\n";

	}
	wp_reset_postdata();

	$output .= '</ul>'."\n";

	return $output;
}

?>