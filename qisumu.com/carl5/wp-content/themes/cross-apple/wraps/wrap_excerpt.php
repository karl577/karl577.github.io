<?php 
/*
* ------------------------------------------------------------------------------------------------------------------------
* Excerpt Functions 
* @PACKAGE BY HAWKTHEME
* ------------------------------------------------------------------------------------------------------------------------
*/


/*------------------------------------------------------------------------
*THEME DESCRIPTION
------------------------------------------------------------------------*/
function theme_description($max_char) 
{
	$desc = get_the_excerpt();

	if($desc) {

		theme_excerpt($max_char);

	}else{

		theme_content($max_char);

	}
}



/*------------------------------------------------------------------------
*THEME POP DESCRIPTION
------------------------------------------------------------------------*/
function theme_pop_description($max_char) 
{
	$desc = get_the_excerpt();

	if($desc) {

		return theme_pop_excerpt($max_char);

	}else{

	    return theme_pop_content($max_char);

	}
}




/*------------------------------------------------------------------------
*THEME EXCERPT
------------------------------------------------------------------------*/
function theme_excerpt($max_char)
{
	$excerpt = get_the_excerpt();
	$excerpt = preg_replace('/\[.+\]/','', $excerpt);
	$excerpt = apply_filters('the_excerpt', $excerpt);
	$excerpt = str_replace(']]>', ']]&gt;', $excerpt);
	$excerpt = strip_tags($excerpt);
	if ((strlen($excerpt)>$max_char) && ($espacio = strpos($excerpt, " ", $max_char ))) {
		$excerpt = substr($excerpt, 0, $espacio);
		$excerpt = $excerpt;
		echo $excerpt.'...';
	}
	else {
		echo $excerpt;
	}
}



/*------------------------------------------------------------------------
*THEME POP EXCERPT
------------------------------------------------------------------------*/
function theme_pop_excerpt($max_char)
{

	$excerpt = get_the_excerpt();
	$excerpt = preg_replace('/\[.+\]/','', $excerpt);
	$excerpt = apply_filters('the_excerpt', $excerpt);
	$excerpt = str_replace(']]>', ']]&gt;', $excerpt);
	$excerpt = strip_tags($excerpt);
	if ((strlen($excerpt)>$max_char) && ($espacio = strpos($excerpt, " ", $max_char ))) {
		$excerpt = substr($excerpt, 0, $espacio);
		$excerpt = $excerpt;
		return $excerpt.'...';
	}
	else {
		return $excerpt;
	}

}



/*------------------------------------------------------------------------
*THEME CONTENT
------------------------------------------------------------------------*/
function theme_content($max_char) 
{

	$content = get_the_content();
	$content = preg_replace('/\[.+\]/','', $content);
	$content = apply_filters('the_content', $content);
	$content = str_replace(']]>', ']]&gt;', $content);
	$content = strip_tags($content);
	if ((strlen($content)>$max_char) && ($espacio = strpos($content, " ", $max_char ))) {
		$content = substr($content, 0, $espacio);
		$content = $content;
		echo $content.'...';
	}
	else {
		echo $content;
	}

}



/*------------------------------------------------------------------------
*THEME POP CONTENT
------------------------------------------------------------------------*/
function theme_pop_content($max_char) 
{

	$content = get_the_content();
	$content = preg_replace('/\[.+\]/','', $content);
	$content = apply_filters('the_content', $content);
	$content = str_replace(']]>', ']]&gt;', $content);
	$content = strip_tags($content);
	if ((strlen($content)>$max_char) && ($espacio = strpos($content, " ", $max_char ))) {
		$content = substr($content, 0, $espacio);
		$content = $content;
		return $content.'...';
	}
	else {
		return $content;
	}

}




/*------------------------------------------------------------------------
*This function shortens a string, Use for comments
------------------------------------------------------------------------*/
function theme_max_char($string, $limit, $break=".", $pad="...") 
{
	if(strlen($string) <= $limit) return $string;
	
	if(false !== ($breakpoint = strpos($string, $break, $limit))) 
	{ 
		if($breakpoint < strlen($string) - 1) 
		{ 
			$string = substr($string, 0, $breakpoint) . $pad; 
		} 
	} 
	return $string; 
}


?>