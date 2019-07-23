<?php
/*
* ----------------------------------------------------------------------------------------------------
* Single
* @PACKAGE BY HAWKTHEME
* ----------------------------------------------------------------------------------------------------
*/
get_header(); 
$time = theme_get_option('blog','enable_time');
$comment = theme_get_option('blog','enable_comment');
$author = theme_get_option('blog','enable_author');
$category = theme_get_option('blog','enable_category');

?>
<!--Begin Container-->
<div id="container" class="clearfix side-right">

<?php theme_page_banner(); ?> 

<div id="container-wrap" class="col-width clearfix">


<!--Begin Content-->
<article id="content">
<?php if (have_posts()) : the_post(); ?>

<div class="post post-single post-blog-single" id="post-<?php the_ID(); ?>">

	<div class="post-entry">
		<h2><?php the_title(); ?></h2>
		<p class="post-meta">
		<?php if($author == true) : ?><?php esc_html_e('作者： ','HK'); the_author_posts_link(); ?><span>//</span><?php endif; ?>
		<?php if($time == true) : ?><?php printf( __('%1$s', 'HK'), get_the_time('F j, Y') ); ?><span>//</span><?php endif; ?>
		<?php if($comment == true) : ?><?php comments_popup_link(__('无评论', 'HK'), __('1评论', 'HK'), __('%评论', 'HK'), '', __('评论关闭', 'HK')); ?><span>//</span><?php endif; ?>
		<?php if($category == true) : ?><?php the_category(', '); ?><span>//</span><?php endif; ?>
		<?php edit_post_link( __( '编辑', 'HK' ), '', '<span>//</span>' ); ?>
		</p>
	</div>
        
	<div class="post-content"><?php the_content(); ?></div>
	<!--end post content-->
<br/><br/><br/>

<!-- Baidu Button BEGIN -->
<div id="bdshare" class="bdshare_t bds_tools_32 get-codes-bdshare">
<a class="bds_qzone"></a>
<a class="bds_tsina"></a>
<a class="bds_tqq"></a>
<a class="bds_renren"></a>
<span class="bds_more"></span>
<a class="shareCount"></a>
</div>
<script type="text/javascript" id="bdshare_js" data="type=tools&amp;uid=6497807" ></script>
<script type="text/javascript" id="bdshell_js"></script>
<script type="text/javascript">
var bds_config={"snsKey":{'tsina':'735675299','tqq':'801256606','t163':'','tsohu':''}}
document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date()/3600000)
</script>
<!-- Baidu Button END -->


<br/><br/><br/>
	<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'HK' ), 'after' => '</div>' ) ); //end link page ?>

	<?php echo get_the_term_list( $post->ID, 'post_tag', '<div class="tags">'. __('<span>相关标签:</span> ','HK'), ' , ', '</div>' ); ?>

</div>
<!--end post page-->
<br/><br/>
<nav class="single-page-navigation clearfix">
<?php previous_post_link( '%link', __( '<span class="nav-previous">上一篇</span>', 'HK' ) ); ?>
<?php next_post_link( '%link', __( '<span class="nav-next">下一篇</span>', 'HK' )); ?>
</nav>


<div class="related-posts related-posts-blog">
<h3><?php esc_html_e('相关内容','HK'); ?></h3>
<?php theme_related_post('category', $lightbox = 'yes'); ?>
</div>

<?php theme_post_author(); ?>

<?php comments_template( '', true ); ?>

<?php else : ?>

<!--Begin No Post-->
<div class="no-post">
	<h2><?php esc_html_e('没有找到', 'HK'); ?></h2>
	<p><?php esc_html_e("对不起,你想要的东西没有找到", 'HK'); ?></p>
</div>
<!--End No Post-->

<?php endif; ?>
</article>
<!--End Content-->

<?php theme_blog_sidebar(); ?> 

</div>
</div>
<!--End Container-->
<?php get_footer(); ?>