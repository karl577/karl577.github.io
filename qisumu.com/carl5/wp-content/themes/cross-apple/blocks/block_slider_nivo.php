<?php 
/*
* ----------------------------------------------------------------------------------------------------
* NIVO SLIDER
* @PACKAGE BY HAWKTHEME
* [slider_nivo effect="fade" height="400" speed="800" delay="3000"]
* ----------------------------------------------------------------------------------------------------
*/
add_shortcode('slider_nivo', 'theme_slider_nivo');

function theme_slider_nivo($atts, $content = null) 
{
	extract(shortcode_atts(
        array(
     		'effect' => 'fade',
			'height' => '350',
			'speed' => '800',
			'delay' => '4000'
    ), $atts));

	$output = theme_slider_nivo_loop ($effect, $height, $speed, $delay); 

	return $output;
}



function theme_slider_nivo_loop ($effect, $height, $speed, $delay) 
{

	$output = '<div class="slider-wrap controlnav-thumbs col-width">'."\n";

	$output .= '<div class="nivoSlider-wrap">'."\n";
	$output .= '<div id="slider" class="nivoSlider">'."\n";

	if (have_posts()) 
	{

		$args = array( 
					'post_type' => 'slidershow',
					'posts_per_page' => 4,
					'orderby' => 'menu_order',
					'order' => 'ASC',
					'post_status' => 'publish'
					); 
		$query = new WP_Query( $args );

		while ($query->have_posts()) {
			$query->the_post();

			#
			#Custom Files
			#
			$enable_title = get_meta_option('enable_slidershow_title');
			$enable_desc = get_meta_option('enable_slidershow_desc');
			$external_link = get_meta_option('slidershow_external_link');
			$title = get_the_title();
			$desc = stripslashes(get_meta_option('slidershow_desc'));
			$image = get_meta_option('slidershow_image');
			$thumbnail = get_meta_option('slidershow_thumbnail');


			//Add Images
			if($image && $thumbnail) 
			{ 
				if($enable_title == true || $enable_desc == true) { $title_caption = 'title="#html-caption-'.get_the_ID().'"'; }

				if($external_link) {
					$output .= '<a href="'.$external_link.'"><img src="'.$image.'" width="970" height="'.$height.'" title="'.$title.'" rel="'.$thumbnail.'" '.$title_caption.' /></a>'."\n";
				}else{
					$output .= '<img src="'.$image.'" width="970" height="'.$height.'" title="'.$title.'" rel="'.$thumbnail.'" '.$title_caption.' />'."\n";
				}
			}

		}
		wp_reset_postdata();

	}//endif


	$output .= '</div>'."\n";
	$output .= '</div><!--# nivoSlider-wrap-->'."\n";


	if (have_posts()) 
	{

		$args = array( 
					'post_type' => 'slidershow',
					'posts_per_page' => 4,
					'orderby' => 'menu_order',
					'order' => 'ASC',
					'post_status' => 'publish'
					); 
		$query = new WP_Query( $args );

		while ($query->have_posts()) {
			$query->the_post();

			#
			#Custom Files
			#
			$enable_title = get_meta_option('enable_slidershow_title');
			$enable_desc = get_meta_option('enable_slidershow_desc');
			$external_link = get_meta_option('slidershow_external_link');
			$title = get_the_title();
			$desc = stripslashes(get_meta_option('slidershow_desc'));
			$image = get_meta_option('slidershow_image');
			$thumbnail = get_meta_option('slidershow_thumbnail');


			//Add title and description
			if($enable_title == true || $enable_desc == true) 
			{
				$output .= '<div id="html-caption-'.get_the_ID().'" class="nivo-html-caption">'."\n";
				if($title && $enable_title == true) { $output .= '<h3>'.$title.'</h3>'."\n"; }
				if($desc && $enable_desc == true) { $output .= '<section class="text">'.do_shortcode($desc).'</section>'."\n"; }
				$output .= '</div>'."\n";
			}


		}
		wp_reset_postdata();

	}//endif

	$output .= '<div class="loader"></div>'."\n";

	$output .= '</div>'."\n";


	$output .= '<script type="text/javascript">'."\n";
	$output .= '//<![CDATA['."\n";
	$output .= 'jQuery(window).load(function(){'."\n";
	$output .= 'jQuery(".nivoSlider-wrap").fadeIn(1000);'."\n";
	$output .= 'jQuery(".slider-wrap .loader").css({display: "none"});'."\n";
	$output .= '	jQuery("#slider").nivoSlider({'."\n";
	$output .= '		effect:"'.$effect.'",'."\n";
	$output .= '		slices:15,'."\n";
	$output .= '		boxCols:8,'."\n";
	$output .= '		boxRows:4,'."\n";
	$output .= '		animSpeed:'.$speed.','."\n";
	$output .= '		pauseTime:'.$delay.','."\n";
	$output .= '		startSlide:0,'."\n";
	$output .= '		captionOpacity:1,'."\n";
	$output .= '		directionNav:true,'."\n";
	$output .= '		directionNavHide:false,'."\n";
	$output .= '		controlNav:true,'."\n";
	$output .= '		controlNavThumbs:true,'."\n";
	$output .= '		controlNavThumbsFromRel:true'."\n";
	$output .= '	});'."\n";
	//$output .= 'jQuery(".controlnav-thumbs .nivo-controlNav a img").css({opacity: "0.8"});'."\n";
	//$output .= 'jQuery(".controlnav-thumbs .nivo-controlNav a.active img").css({opacity: "1"});'."\n";
	$output .= '});'."\n";
	$output .= '//]]>'."\n";
	$output .= '</script>'."\n";

	return $output;

}

?>