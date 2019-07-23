<?php get_header(); ?>
<div id="content">
<div class="atop">
<div class="inavt clr"><div class="l"><?php get_inavt(); ?></div><div class="r"><?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?></div></div>
<div class="ibdfx"><script type="text/javascript">
/*960*90，创建于2013-4-11*/
var cpro_id = "u1258635";
</script>
<script src="http://cpro.baidustatic.com/cpro/ui/c.js" type="text/javascript"></script></div>
<div id="container" class="clr">
<?php $postcnt = 1; ?>
<?php if ( have_posts() ) : ?>
<?php while ( have_posts() ) : the_post(); ?>
<?php get_template_part( 'sy', get_post_format() ); ?>
<?php if ($wp_query->current_post == 0) : ?>
<!--<div class="item col1">11111</div>-->
<?php endif; ?>
<?php if ($postcnt==6) : ?>
<!--<div class="item col1">666</div>-->
<?php endif; $postcnt++; ?>
<?php endwhile; ?>
<?php else : ?>
<p>找不到你要找的内容</p>
<?php endif; ?>
</div>
<div id="navigation" class="navigation clr"><?php pagenavi(); ?></div>
</div>
</div>
<?php get_footer(); ?>