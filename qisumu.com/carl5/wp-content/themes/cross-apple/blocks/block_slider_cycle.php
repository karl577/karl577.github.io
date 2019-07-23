<?php 
/*
* ----------------------------------------------------------------------------------------------------
* Cycle SLIDER
* @PACKAGE BY HAWKTHEME
* [slider_cycle effect="turnDown" height="400" speed="800" delay="3000" "easing"="easeOutBounce"]
* ----------------------------------------------------------------------------------------------------
*/
add_shortcode('slider_cycle', 'theme_slider_cycle');

function theme_slider_cycle($atts, $content = null) 
{
	extract(shortcode_atts(
        array(
     		'effect' => 'turnDown',
			'height' => '350',
			'speed' => '800',
			'delay' => '4000',
			'easing' => 'easeOutBounce'
    ), $atts));

	$output = theme_slider_cycle_loop ($effect, $height, $speed, $delay, $easing); 

	return $output;
}



function theme_slider_cycle_loop ($effect, $height, $speed, $delay, $easing) 
{

	$output = '<div class="slider-wrap col-width">'."\n";

	$output .= '<div class="cycleslider-wrap" style=" position:relative;"><div style=" width:67px; height:24px; position:absolute; z-index:9999;   right:5px; top:-35px; top:-30px\9;"><wb:follow-button uid="3095528071" type="red_1" width="67" height="24" ></wb:follow-button></div>'."\n";
	$output .= '<div id="slider" class="cycleslider">'."\n";


	if (have_posts()) 
	{

		$args = array( 
					'post_type' => 'slidershow',
					'posts_per_page' => -1,
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
				$output .= '<div class="cycle-slider">'."\n";
				if($external_link) {
					$output .= '<a href="'.$external_link.'"><img src="'.$image.'" width="970" height="'.$height.'"  title="'.$title.'" alt="" /></a>'."\n";
				}else{
					$output .= '<img src="'.$image.'" width="970" height="'.$height.'"  title="'.$title.'" alt="" />'."\n";
				}

				if($enable_title == true || $enable_desc == true) 
				{
					$output .= '<div class="cycle-slider-caption">'."\n";
					if($title && $enable_title == true) { $output .= '<h3>'.$title.'</h3>'."\n"; }
					if($desc && $enable_desc == true) { $output .= '<section class="text">'.do_shortcode($desc).'</section>'."\n"; }
					$output .= '</div>'."\n";
				}
				$output .= '</div>'."\n";
			}

		}
		wp_reset_postdata();

	}//endif

	$output .= '</div>'."\n";
	$output .= '<a id="cycle-prev" href="#">Prev</a><a id="cycle-next" href="#">Next</a><div id="cycle-nav"></div>'."\n";
	$output .= '</div><!--# cycleslider-wrap-->'."\n";


	$output .= '<div class="loader"></div>'."\n";
	$output .= '</div>'."\n";

	$output .= '<script type="text/javascript">'."\n";
	$output .= '//<![CDATA['."\n";
	$output .= 'jQuery(function() {'."\n";
	$output .= '	jQuery(".cycleslider-wrap").fadeIn(1000);'."\n";
	$output .= '	jQuery(".slider-wrap .loader").css({display: "none"});'."\n";
	$output .= '	jQuery("#slider").cycle({'."\n";
	$output .= '		fx:  "'.$effect.'",'."\n";
	$output .= '		speed:  "'.$speed.'", '."\n";
	$output .= '		timeout: "'.$delay.'",'."\n";
	$output .= '		easing:  "'.$easing.'",'."\n";
	$output .= '		next:  "#cycle-next",'."\n";
	$output .= '		prev:  "#cycle-prev",'."\n";
	$output .= '		pager:  "#cycle-nav"'."\n";
	$output .= '	});'."\n";
	$output .= '});'."\n";
	$output .= '//]]>'."\n";
	$output .= '</script>'."\n";

	return $output;

}

?>