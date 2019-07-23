<?php 
/*
Template Name: google seacrh
*/
get_header(); 
?>
<article>
	
		
	   <div id="page-header"></div>							
					
				 <div id="page-content">
			<div class="page-sidebar">
        <ul class="page-navbar">
            <?php echo str_replace("</ul></div>", "", ereg_replace("<div[^>]*><ul[^>]*>", "", wp_nav_menu(array('theme_location' => 'pagenav', 'echo' => false)) )); ?>
        </ul>
    </div>
			<script>
  (function() {
    var cx = '015409206179815989517:0lkkxz-heho';
    var gcse = document.createElement('script');
    gcse.type = 'text/javascript';
    gcse.async = true;
    gcse.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') +
        '//www.google.com/cse/cse.js?cx=' + cx;
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(gcse, s);
  })();
</script>
<gcse:search></gcse:search>
		<div class="clear"></div>
								
						
						
				
		</div>
	
	<div class="clear"></div> </article> 
	<?php get_footer(); ?>

