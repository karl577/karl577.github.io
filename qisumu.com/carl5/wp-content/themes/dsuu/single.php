<?php get_header(); ?>
<?php while ( have_posts() ) : the_post(); ?>
<div id="content">
<div class="atop">
<div class="layer" id="mblogdetail">
<div class="tube tube-a">
<div class="block" id="detailcnt">
<div class="center section">
<div class="crumb clr"><?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?></div>
<article itemscope itemtype="http://schema.org/Article">
<div class="userinfo clr"><div class="l"><?php echo get_avatar( get_the_author_meta('ID'), 48, $default, $alt=get_the_author($id)); ?></div><div class="l nrbt"><h1 itemprop="name"><?php the_title(); ?></h1><h5>作者：<span class="name"><?php the_author_posts_link(); ?></span> 收集到 <?php the_tags('', ' ' , ''); ?> <span class="time" itemprop="datePublished" datetime="<?php the_time('Y-m-j');?>"><?php the_time('Y-m-j');?></span><span class="pbb"><a href="#replytop">讨论：<?php comments_number('0', '1', '%'); ?></a></span><span class="pbb">浏览：<?php the_views(); ?></span><span class="weixin" id="viewReInfo"><i class="ico__weixin"></i></span></h5></div></div>
<div id="receiptInfo" class="receiptInfo">
<p><img src="http://api.qrserver.com/v1/create-qr-code/?size=200×200&data=<?php the_permalink() ?>" width="200" height="200" alt="分享到微信"></p>
<p>用微信“扫一扫”</p>
<p>把本内容分享给您的微信好友。</p>
</div>
<div class="article clr" id="article">
<div class="detailinfo <?php echo get_post_format($post_id); ?>" id="detailinfo" itemprop="articleBody">
<div class="wzlj"><script type="text/javascript">
/*自定义标签云，文章内容上*/
var cpro_id = "u1330884";
</script>
<script src="http://cpro.baidustatic.com/cpro/ui/c.js" type="text/javascript"></script></div>
<?php the_content('<span class="more">继续阅读 &gt;&gt;</span>'); ?>
<a name="replytop"></a>
</div>
<div class="pageview">
<div class="nrpre"><?php if (get_next_post()) { next_post_link('%link','上一页',true);} else { echo "前面没了";} ?></div>
<div class="nrnext"><?php if (get_previous_post()) { previous_post_link('%link','下一页',true);} else { echo "后面没了";} ?></div>
</div>
<div class="bdfx"><script type="text/javascript">
/*640*60，创建于2013-4-11*/
var cpro_id = "u1258613";
</script>
<script src="http://cpro.baidustatic.com/cpro/ui/c.js" type="text/javascript"></script></div>
</div>
<div class="fxwz">
<div class="fxwzt">
<p>title: <a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a> | tag: <?php tagtext(); ?></p>
<p>url: <?php the_permalink() ?></p></div>
<div id="bdshare" class="bdshare_b" style="width:auto;height:24px;line-height:24px;margin-top:8px;overflow:hidden;">
<img src="http://bdimg.share.baidu.com/static/images/type-button-5.jpg?cdnversion=20120831" height="24" alt="分享精彩" />
<a class="shareCount"></a>
</div></div>
<div class="wmxg"><script type="text/javascript" id="wumiiRelatedItems"></script></div>
<div class="replyinfo">
<div class="itop"></div>
<?php comments_template( '', true ); ?>
</div>
</article>			
</div>
<div class="bottom"></div>	
</div>
</div>

<div class="tube tube-b" id="wrapper">
<div class="block">
<div class="aright">
<div class="section mt20" id="sidebar"><script type="text/javascript">
/*300*250，创建于2013-4-11*/
var cpro_id = "u1258622";
</script>
<script src="http://cpro.baidustatic.com/cpro/ui/c.js" type="text/javascript"></script></div>
<div class="section mt10" id="curalbum">
<h4 class="clr">你可能也会喜欢<i><a href="/top/" target="_blank" rel="nofollow">更多</a></i></h4>
<div class="switch clr"><div class="p5"> 
<ul>
<?php
global $post;
$cats = wp_get_post_categories($post->ID);
if ($cats) {
$args = array(
        'category__in' => array( $cats[0] ),
        'post__not_in' => array( $post->ID ),
		'meta_key' =>'_thumbnail_id',
        'showposts' => 6,
		'orderby' =>'rand'
    );
query_posts($args);
if (have_posts()) : while (have_posts()) : the_post(); update_post_caches($posts); ?>
<li><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><img class="postimg" src="<?php get_image_url(); ?>" width="100" height="100" alt="<?php the_title(); ?>"/></a></li>
<?php endwhile; endif; wp_reset_query(); ?> 
<?php } ?>
</ul>
</div></div>
</div>
<div class="section mt20" id="curalbum">
<h4 class="clr">最新评论<i><a href="/comment/" target="_blank" rel="nofollow">更多</a></i></h4>
<div class="switch clr">
<div id="con">
<?php get_new_comments();?>
</div>
</div>
</div>
</div>
</div>
<div class="block dbi blockevent"></div>
</div>
</div>
<div id="container" class="zd">
<?php $post_tags=wp_get_post_tags($post->ID);
if($post_tags) { 
foreach($post_tags as $tag) $tag_list[] .= $tag->term_id; 
$args = array( 
'tag__in' => $tag_list, 
'post__not_in' => array($post->ID),
'showposts' => 12,
'caller_get_posts' => 1, 
); 
query_posts($args); 
if(have_posts()):while (have_posts()) : the_post(); update_post_caches($posts); ?>
<?php get_template_part( 'sy', get_post_format() ); ?>
<?php endwhile; endif; wp_reset_query(); } ?> 
</div>
<?php endwhile; ?>
</div>
</div>

<?php get_footer(); ?>