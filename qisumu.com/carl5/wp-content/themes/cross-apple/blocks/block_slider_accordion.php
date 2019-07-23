<?php 
/*
* ----------------------------------------------------------------------------------------------------
* Lite Accordion SLIDER
* @PACKAGE BY HAWKTHEME
* [slider_accordion autoplay="ture" speed="800" delay="3000"]
* ----------------------------------------------------------------------------------------------------
*/
add_shortcode('slider_accordion', 'theme_slider_accordion');

function theme_slider_accordion($atts, $content = null) 
{
	extract(shortcode_atts(
        array(
     		'autoplay' => 'true',
			'speed' => '800',
			'delay' => '4000'
    ), $atts));

	$output = theme_slider_accordion_loop ($autoplay, $speed, $delay); 

	return $output;
}



function theme_slider_accordion_loop ($autoplay, $speed, $delay) 
{
	$output = '<div class="slider-wrap col-width">'."\n";

	$output .= '<div class="lite-accordion-wrap">'."\n";
	$output .= '<div id="slider" class="lite-accordion-slider">'."\n";
	$output .= '<ol>'."\n";

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

			if($image)
			{

				$output .= '<li>'."\n";
				$output .= '<h2><span>'.$title.'</span></h2>'."\n";
				$output .= '<div><figure>'."\n";

				if($external_link) {
					$output .= '<a href="'.$external_link.'"><img src="'.$image.'" title="'.$title.'" alt="" /></a>'."\n";
				}else{
					$output .= '<img src="'.$image.'" title="'.$title.'" alt="" />'."\n";
				}

				if($enable_desc == true) 
				{
					$output .= '<figcaption>'."\n";
					$output .= '<section class="text">'.do_shortcode($desc).'</section>'."\n"; 
					$output .= '</figcaption>'."\n";
				}
				$output .= '</figure></div>'."\n";
				$output .= '</li>'."\n";

			}
		
		}
		wp_reset_postdata();

	}//endif

	$output .= '</ol>'."\n";
	$output .= '</div>'."\n";
	$output .= '</div><!--# lite-accordion-wrap-->'."\n";


	$output .= '<div class="loader"></div>'."\n";
	$output .= '</div>'."\n";

	$output .= '<script type="text/javascript">'."\n";
	$output .= '//<![CDATA['."\n";
	$output .= 'jQuery(document).ready(function(){'."\n";
	$output .= 'jQuery(".lite-accordion-wrap").fadeIn(1000);'."\n";
	$output .= 'jQuery(".slider-wrap .loader").css({display: "none"});'."\n";
	$output .= '	jQuery("#slider").liteAccordion({'."\n";
	$output .= '		autoPlay : '.$autoplay.','."\n";
	$output .= '		containerWidth : 970,'."\n";
	$output .= '		containerHeight : 350,'."\n";
	$output .= '		headerWidth : 56,'."\n";
	$output .= '		pauseOnHover : true,'."\n";
	$output .= '		theme : "light",'."\n";
	$output .= '		rounded : false,'."\n";
	$output .= '		slideSpeed : '.$speed.','."\n";
	$output .= '		cycleSpeed : '.$delay.','."\n";
	$output .= '		enumerateSlides : false,'."\n";
	$output .= '		activateOn: "mouseover"'."\n";	
	$output .= '	}).find("figcaption:first").show();'."\n";
	$output .= '});'."\n";
	$output .= '//]]>'."\n";
	$output .= '</script>'."\n";

	return $output;

}

?>