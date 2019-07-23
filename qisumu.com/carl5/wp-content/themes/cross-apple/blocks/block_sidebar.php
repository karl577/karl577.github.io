<?php 
/*
* ----------------------------------------------------------------------------------------------------
* Sidebars
* @PACKAGE BY HAWKTHEME
* ----------------------------------------------------------------------------------------------------
*/


/*------------------------------------------------------------------------
*Page Sidebar
------------------------------------------------------------------------*/
function theme_page_sidebar() 
{
	echo '<!--BEGIN SIDE-->'."\n";
	echo '<aside id="sidebar">'."\n";

	if ( !dynamic_sidebar('page-widget-area') ) {
		theme_no_sidebar();				
	}

	echo '</aside>'."\n";
	echo '<!--END SIDE-->'."\n";
}



/*------------------------------------------------------------------------
*Blog Sidebar
------------------------------------------------------------------------*/
function theme_blog_sidebar() 
{
	echo '<!--BEGIN SIDE-->'."\n";
	echo '<aside id="sidebar">'."\n";

	if ( !dynamic_sidebar('blog-widget-area') ) {
		theme_no_sidebar();				
	}

	echo '</aside>'."\n";
	echo '<!--END SIDE-->'."\n";
}



/*------------------------------------------------------------------------
*Portfolio Sidebar
------------------------------------------------------------------------*/
function theme_portfolio_sidebar() 
{
	echo '<!--BEGIN SIDE-->'."\n";
	echo '<aside id="sidebar">'."\n";

	if ( !dynamic_sidebar('portfolio-widget-area') ) {
		theme_no_sidebar();				
	}

	echo '</aside>'."\n";
	echo '<!--END SIDE-->'."\n";
}



/*------------------------------------------------------------------------
*Product Sidebar
------------------------------------------------------------------------*/
function theme_product_sidebar() 
{
	echo '<!--BEGIN SIDE-->'."\n";
	echo '<aside id="sidebar">'."\n";

	if ( !dynamic_sidebar('product-widget-area') ) {
		theme_no_sidebar();				
	}

	echo '</aside>'."\n";
	echo '<!--END SIDE-->'."\n";
}



/*------------------------------------------------------------------------
*Archives Sidebar
------------------------------------------------------------------------*/
function theme_archives_sidebar() 
{
	echo '<!--BEGIN SIDE-->'."\n";
	echo '<aside id="sidebar">'."\n";

	if ( !dynamic_sidebar('archives-widget-area') ) {
		theme_no_sidebar();				
	}

	echo '</aside>'."\n";
	echo '<!--END SIDE-->'."\n";
}



/*------------------------------------------------------------------------
*Contact Sidebar
------------------------------------------------------------------------*/
function theme_contact_sidebar() 
{
	echo '<!--BEGIN SIDE-->'."\n";
	echo '<aside id="sidebar">'."\n";

	if ( !dynamic_sidebar('contact-widget-area') ) {
		theme_no_sidebar();				
	}

	echo '</aside>'."\n";
	echo '<!--END SIDE-->'."\n";
}



/*------------------------------------------------------------------------
*Search Sidebar
------------------------------------------------------------------------*/
function theme_search_sidebar() 
{
	echo '<!--BEGIN SIDE-->'."\n";
	echo '<aside id="sidebar">'."\n";

	if ( !dynamic_sidebar('search-widget-area') ) {
		theme_no_sidebar();				
	}

	echo '</aside>'."\n";
	echo '<!--END SIDE-->'."\n";
}



/*------------------------------------------------------------------------
*Footer Sidebar
------------------------------------------------------------------------*/
function theme_footer_sidebar() 
{
	$enable_footer_widgets = theme_get_option('footer','enable_footer_widgets');
	if($enable_footer_widgets == 'yes')
	{

	$columns = theme_get_option('footer','widget_columns');
	$first_col = ' footer-col-first';
	switch($columns)
	{
		case 1: $class = 'footer-col-1-1'; break;
		case 2: $class = 'footer-col-2-1'; break;
		case 3: $class = 'footer-col-3-1'; break;
		case 4: $class = 'footer-col-4-1'; break;
	}

	echo '<!--Begin Footer Widget-->'."\n";
	echo '<div class="footer-widget col-width clearfix">'."\n";

    for ($i = 1; $i <= $columns; $i++)
	{
		echo '<div class="'.$class.$first_col.'">'."\n";
		dynamic_sidebar('footer-widget-area-'.$i);
		echo '</div>'."\n";
		$first_col = '';
	}

	echo '</div>'."\n";
	echo '<!--End Footer Widget-->'."\n";

	}
}



/*------------------------------------------------------------------------
*No Sidebar Notice
------------------------------------------------------------------------*/
function theme_no_sidebar() 
{
	echo '<div class="notice-sidebar">'."\n";
	echo '哎呀,你需要添加的小工具. <b><a href="'.home_url().'/wp-admin/widgets.php">马上去!</a></b>';
	echo '</div>'."\n";
}

?>