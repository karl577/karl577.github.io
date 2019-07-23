<?php 
/*
* ----------------------------------------------------------------------------------------------------
* SHORTCODE FOR TESTIMONIALS
* @PACKAGE BY HAWKTHEME
* ----------------------------------------------------------------------------------------------------
*/
add_shortcode('testimonials', 'theme_sc_testimonials');


function theme_sc_testimonials($atts, $content=null)
{	
	extract(shortcode_atts(array(
		'avatar' => 'yes',
		'image' => 'http://yourwebsite.com/avatar.jpg',
		'title' => 'Title',
		'name' => 'Name',
		'desc' => 'The desc for name.'
	), $atts));

	if($avatar == 'yes') {
		$class = 'sc-testimonials';
	}else{
		$class = 'sc-testimonials sc-testimonials-no-avatar';
	}
	
	$output = '<div class="'.$class.'">'."\n";
	if($avatar == 'yes') {
		$output .= '<div class="avatar alignleft"><img src="'.$image.'" /></div>';
	}
	$output .= '<div class="box">';
	$output .= '<h5>'.$title.'</h5>';
	$output .= '<p>'. theme_remove_autop($content) .'</p>';
	$output .= '<h6>'.$name.'</h6>';
	$output .= '<span class="desc">'.$desc.'</span>';
	$output .= '<div class="arrow"></div>';
	$output .= '</div>';
	$output .= '</div>'."\n";

	return $output;
}

?>