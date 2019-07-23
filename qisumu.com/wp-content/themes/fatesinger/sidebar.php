<aside id="secondary">


		
  
    
	  
	
	<?php if ( ! dynamic_sidebar( 'Sidebar' )) : ?>
	
	<?php endif; ?>
	<div id="sidebar2">
	<div class="widgit-area2">
<h3>Ad Widget</h3>
	<?php if( dopt('fate_adpost_04_b') ) echo dopt('fate_adpost_04'); ?></div>
	</div>
	
	<div id="sidebar3">
	<?php if ( ! dynamic_sidebar( 'Sidebar lite right' )) : ?>
	<?php endif; ?>
	</div>
  
<div id="sidebarfooter"><?php bloginfo('name');?></div>
</aside>
