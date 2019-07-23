<?php
/*
* ----------------------------------------------------------------------------------------------------
* 404
* @PACKAGE BY HAWKTHEME
* ----------------------------------------------------------------------------------------------------
*/
get_header(); 
?>

<!--Begin Container-->
<div id="container" class="clearfix fullwidth">
<div id="container-wrap" class="col-width clearfix">

<!--BEGIN CONTENT-->
<article id="content">

<div class="page-error">
<h1><?php esc_html_e('404','HK'); ?></h1>
<h3><?php esc_html_e('Not Found','HK'); ?></h3>
<p><?php esc_html_e('Sorry, but the page you are looking for does not exist. You can try to go to the Homepage and find your way.','HK'); ?></p>
</div>

</article>
<!--End Content-->

</div>
</div>
<!--End Container-->

<?php get_footer(); ?>