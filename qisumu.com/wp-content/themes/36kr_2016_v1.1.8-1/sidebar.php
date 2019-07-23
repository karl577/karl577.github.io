<div class="sidebar">


 <?php 
if(is_home() || is_front_page()){ 
	if (function_exists('dynamic_sidebar') && dynamic_sidebar('sidebar-index')) : endif; 
}elseif(is_single()){ 
	if (function_exists('dynamic_sidebar') && dynamic_sidebar('sidebar-single')) : endif; 
}else{
	if (function_exists('dynamic_sidebar') && dynamic_sidebar('sidebar-other')) : endif; 
}
?>
</div> 