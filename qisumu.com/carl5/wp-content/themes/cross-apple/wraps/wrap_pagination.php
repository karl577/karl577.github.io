<?php 
/*
* ----------------------------------------------------------------------------------------------------
* Pagination Functions
* @PACKAGE BY HAWKTHEME
* ----------------------------------------------------------------------------------------------------
*/


/*------------------------------------------------------------------------
*Theme Pagination
------------------------------------------------------------------------*/
function theme_pagination() 
{
	$pagination = theme_get_option('general','pagination');

	if($pagination == '1') {
		theme_page_navi ();
	}elseif($pagination == '3' && function_exists('wp_pagenavi')){	
		wp_pagenavi();	
	}else{
		theme_prev_next();	
	}
}


/*------------------------------------------------------------------------
*Load WP Pagination
------------------------------------------------------------------------*/
function theme_page_navi ($pages = '')
{
	global $paged;

	if(empty($paged))$paged = 1;

	$prev = $paged - 1;							
	$next = $paged + 1;	
	$range = 2; // only edit this if you want to show more page-links
	$showitems = ($range * 2)+1;

	if($pages == '')
	{	
		global $wp_query;
		$pages = $wp_query->max_num_pages;
		if(!$pages)
		{
			$pages = 1;
		}
	}


	if(1 != $pages)
	{
		echo "<div class='pagination clearfix'>";
		echo ($paged > 2 && $paged > $range+1 && $showitems < $pages)? "<a href='".get_pagenum_link(1)."'>&laquo;</a>":"";
		echo ($paged > 1 && $showitems < $pages)? "<a href='".get_pagenum_link($prev)."'>&lsaquo;</a>":"";
	
		
		for ($i=1; $i <= $pages; $i++){
		if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )){
		echo ($paged == $i)? "<span class='current'>".$i."</span>":"<a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a>"; 
		}
		}
	
		echo ($paged < $pages && $showitems < $pages) ? "<a href='".get_pagenum_link($next)."'>&rsaquo;</a>" :"";
		echo ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) ? "<a href='".get_pagenum_link($pages)."'>&raquo;</a>":"";
		echo "</div>\n";
	}
}



/*------------------------------------------------------------------------
*Load Prev Next Pagination
------------------------------------------------------------------------*/
function theme_prev_next () 
{
	 echo '<div class="normal-pagination fixed"><span class="prev">';
	 previous_posts_link(__('Previous', 'HK')); 
	 echo '</span><span class="next">';
	 next_posts_link(__('Next', 'HK')); 
	 echo '</span></div>';
}

?>