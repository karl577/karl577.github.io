<?php get_header(); ?>
<div id="content">
<div class="atop">
<div class="inavt clr"><div class="l"><?php get_inavt(); ?></div><div class="r"><?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?></div></div>
<div class="ibdfx">广告位</div>
<div id="container" class="clr">
<?php if ( have_posts() ) : ?>
<?php while ( have_posts() ) : the_post(); ?>
<?php get_template_part( 'sy', get_post_format() ); ?>
<?php endwhile; ?>
<?php else : ?>
<p>找不到你要找的内容</p>
<?php endif; ?>
</div>
<div id="navigation" class="navigation clr"><?php pagenavi(); ?></div>
</div>
</div>
<?php get_footer(); ?>