<div class="sidebar">
<?php 
if ( is_single() ) {//文章页显示文章页侧栏
      if (function_exists('dynamic_sidebar') && dynamic_sidebar('widget_postsidebar')){}
}
else{//除了文章页的其他页面
	 if (function_exists('dynamic_sidebar') && dynamic_sidebar('widget_homesidebar')){}
}
?>
</div>