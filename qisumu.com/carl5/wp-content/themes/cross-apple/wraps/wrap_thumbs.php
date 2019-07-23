<?php
/*
* ----------------------------------------------------------------------------------------------------
* Thumbs Function
* @PACKAGE BY HAWKTHEME
* ----------------------------------------------------------------------------------------------------
*/


/* =========================================
   Set the thumbs size for the posts
   ======================================== */
$thumb_size['imgSize']['50-50'] = array('width'=>50,  'height'=>50);
$thumb_size['imgSize']['64-64'] = array('width'=>64,  'height'=>64);
$thumb_size['imgSize']['80-80'] = array('width'=>80,  'height'=>80);
$thumb_size['imgSize']['125-90'] = array('width'=>125,  'height'=>90);
$thumb_size['imgSize']['190-120'] = array('width'=>190,  'height'=>120);
$thumb_size['imgSize']['205-140'] = array('width'=>205,  'height'=>140);
$thumb_size['imgSize']['290-190'] = array('width'=>290,  'height'=>190);
$thumb_size['imgSize']['460-320'] = array('width'=>460,  'height'=>320);
$thumb_size['imgSize']['650-200'] = array('width'=>650,  'height'=>200);
$thumb_size['imgSize']['650-260'] = array('width'=>650,  'height'=>260);
$thumb_size['imgSize']['650-330'] = array('width'=>650,  'height'=>330);

theme_add_thumbnail_size($thumb_size);



/* =========================================
   Creates wordpress image thumb sizes for the theme
   ======================================== */
function theme_add_thumbnail_size($thumb_size)
{	
	foreach ($thumb_size['imgSize'] as $sizeName => $size)
	{
		if($sizeName == 'base')
		{
			set_post_thumbnail_size($thumb_size['imgSize'][$sizeName]['width'], $thumb_size[$sizeName]['height'], true);
		}
		else
		{	
			add_image_size(	 
				$sizeName,
				$thumb_size['imgSize'][$sizeName]['width'], 
				$thumb_size['imgSize'][$sizeName]['height'], 
				true);
		}
	}
}



/* =========================================
   Get full image uri
   ======================================== */
/*GET FULL IMAGE URI*/
function theme_large_image_uri() {
	global $post;
	$thumb_uri = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large');
	return $thumb_uri[0];	
}

?>