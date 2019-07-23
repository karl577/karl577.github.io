<?php get_header(); ?>
<div id="content">
<div class="atop">
<div class="layer" id="mblogdetail">
<div class="tube tube-a">
<div class="block" id="detailcnt">
<div class="center section">
<div class="crumb clr"><?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?></div>
<article itemscope itemtype="http://schema.org/Article">
<div class="article clr" id="article">
<div class="detailinfo" id="detailinfo" itemprop="articleBody">
<h1>404 没有找到你所需要的内容</h1>
<p><a href="/" title="返回首页"><img src="/wp-content/themes/twentytwelve/images/404.png" alt="404"></a></p>
</div>
</div>
<div class="replyinfo">
<div class="itop"></div>
</div>
</article>			
</div>
<div class="bottom"></div>	
</div>
</div>

<div class="tube tube-b" id="wrapper">
<div class="block">
<div class="aright">
<div class="section mt20" id="curalbum"></div>
<div class="section mt20" id="curalbum">
<h4 class="clr">最新评论<i><a href="/comment/" target="_blank" rel="nofollow">更多</a></i></h4>
<div class="switch clr">
<div id="con">
<?php get_new_comments();?>
</div>
</div>
</div>
<div class="section mt20" id="sidebar"></div>
</div>
</div>
<div class="block dbi blockevent"></div>
</div>
</div>
<div id="container">
<?php query_posts('showposts=12&meta_key=_thumbnail_id'); ?>
<?php while (have_posts()) : the_post(); ?>
<?php get_template_part( 'sy', get_post_format() ); ?>
<?php endwhile; ?>
</div>
</div>
</div>
<?php get_footer(); ?>