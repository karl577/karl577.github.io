<?php 
if (!zm_get_option('layout') || (zm_get_option("layout") == 'blog')) {
	get_template_part( 'blog');
}
if (zm_get_option('layout') == 'img') {
	get_template_part( 'grid');
}
if (zm_get_option('layout') == 'cms') {
	get_template_part( 'cms');
}
 ?>