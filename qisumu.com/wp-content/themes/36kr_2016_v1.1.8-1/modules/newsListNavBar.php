 <?php if (is_home ()&&!is_paged() ) : ?> 
<div class="categories J_newsListNavBar"><ul class="newslistul">
<?php echo str_replace("</ul></div>", "", ereg_replace("<div[^>]*><ul[^>]*>", "", wp_nav_menu(array('theme_location' => 'cat', 'echo' => false)) )); ?>
</ul></div><?php endif; ?>
