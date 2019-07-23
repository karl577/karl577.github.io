<?php 
/*
* ----------------------------------------------------------------------------------------------------
* SHORTCODE FOR STYLE IMAGE
* @PACKAGE BY HAWKTHEME
* ----------------------------------------------------------------------------------------------------
*/
add_shortcode('style_image', 'theme_sc_style_image');


function theme_sc_style_image($atts, $content=null)
{	
	extract(shortcode_atts(array(
		'width' => '',
		'height' => '',
		'image' => '',
		'alt' => 'Image description or alternate text.',
		'url' => 'http://yourwebsite.com/',
		'align' => 'alignleft',
		'border' => 'yes',
		'lightbox' => 'yes',
		'fade' => 'yes',
	), $atts));

	if($border == 'yes') 
	{
		$class = 'sc-style-image post-thumb';
	}else{
		$class = 'sc-style-image';
	}

	if($lightbox == 'yes') 
	{
		$rel = 'data-id="fancybox"';
	}else{
		$rel = 'rel="bookmark"';
	}

	if($fade == 'yes') 
	{
		$link_class = 'class="image-link"';
	}else{
		$link_class = '';
	}
	
	$output = '<div class="'.$class.' '.$align.'" style="width: '.$width.'px;">'."\n";
	$output .= '<a href="'.$url.'" '.$rel.' '.$link_class.'><img src="'.$image.'" alt="'.$alt.'" width="'.$width.'" height="'.$height.'" class="wp-post-image" /></a>'."\n";
	$output .= '</div>'."\n";

	return $output;
}

?>