<?php 
/*
* ----------------------------------------------------------------------------------------------------
* Anything SLIDER
* @PACKAGE BY HAWKTHEME
* [slider_slides_js effect="fade" height="400" speed="800" delay="4000"]
* ----------------------------------------------------------------------------------------------------
*/
add_shortcode('slider_slides_js', 'theme_slider_slides_js');

function theme_slider_slides_js($atts, $content = null) 
{
	extract(shortcode_atts(
        array(
			'speed' => '800',
			'height' => '350',
			'delay' => '4000'
    ), $atts));

	$output = theme_slider_slides_js_loop ($speed, $height, $delay); 

	return $output;
}



function theme_slider_slides_js_loop ($speed, $height, $delay) 
{

	$output = '<div class="slider-wrap">'."\n";

	$output .= '<div class="slides-js-wrap col-width">'."\n";
	$output .= '<div id="slides">'."\n";
	$output .= '<div class="slides_container">'."\n";


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
			if($image) 
			{ 
				$output .= '<div class="slide" style="height: '.$height.'px;">'."\n";
				if($external_link) {
					$output .= '<a href="'.$external_link.'"><img src="'.$image.'" width="490" height="'.$height.'" title="'.$title.'" alt="" /></a>'."\n";
				}else{
					$output .= '<img src="'.$image.'" width="490" title="'.$title.'" alt="" />'."\n";
				}

				if($enable_title == true || $enable_desc == true) 
				{
					$output .= '<div class="caption">'."\n";
					if($title && $enable_title == true) { $output .= '<h3>'.$title.'</h3>'."\n"; }
					if($desc && $enable_desc == true) { $output .= '<p>'.do_shortcode($desc).'</p>'."\n"; }
					$output .= '</div>'."\n";
				}
				$output .= '</div>'."\n";
			}

	}
		wp_reset_postdata();

	}//endif


	$output .= '</div>'."\n";
	$output .= '<a href="#" class="prev">Arrow Prev</a>'."\n";
	$output .= '<a href="#" class="next">Arrow Next</a>'."\n";
	$output .= '</div>'."\n";
	$output .= '</div><!--# slides-js-wrap-->'."\n";


	$output .= '<div class="loader"></div>'."\n";
	$output .= '</div>'."\n";

	$output .= '<script type="text/javascript">'."\n";
	$output .= '//<![CDATA['."\n";
	$output .= 'jQuery(function(){'."\n";
	$output .= 'jQuery(".slides-js-wrap").fadeIn(1000);'."\n";
	$output .= 'jQuery(".slider-wrap .loader").css({display: "none"});'."\n";
	$output .= '	jQuery("#slides").slides({'."\n";
	$output .= '		preload: false,'."\n";
	$output .= '		play: '.$delay.','."\n";
	$output .= '		pause: '.$speed.','."\n";
	$output .= '		hoverPause: true,'."\n";
	$output .= '		animationStart: function(current){'."\n";
	$output .= '			jQuery(".caption").animate({'."\n";
	$output .= '				top:-400'."\n";
	$output .= '			},200);'."\n";
	$output .= '			if (window.console && console.log) {'."\n";
	$output .= '				// example return of current slide number'."\n";
	$output .= '				console.log("animationStart on slide: ", current);'."\n";
	$output .= '			};'."\n";
	$output .= '		},'."\n";
	$output .= '		animationComplete: function(current){'."\n";
	$output .= '			jQuery(".caption").animate({'."\n";
	$output .= '				top:80'."\n";
	$output .= '			},200);'."\n";
	$output .= '			if (window.console && console.log) {'."\n";
	$output .= '				// example return of current slide number'."\n";
	$output .= '				console.log("animationComplete on slide: ", current);'."\n";
	$output .= '			};'."\n";
	$output .= '		},'."\n";
	$output .= '		slidesLoaded: function() {'."\n";
	$output .= '			jQuery(".caption").animate({'."\n";
	$output .= '				top:80'."\n";
	$output .= '			},200);'."\n";
	$output .= '		}'."\n";
	$output .= '	});'."\n";
	$output .= '});'."\n";
	$output .= '//]]>'."\n";
	$output .= '</script>'."\n";

	return $output;

}

?>