<?php get_header(); ?>
<title><?php the_title(); ?>-<?php bloginfo('name'); ?></title>


	<section class="posts"><?php if(have_posts()) : while (have_posts()) : the_post(); ?>
				            <article id="post-<?php the_ID(); ?>" class="post">
                <div class="post-header">
                    <h2 class="post-title"><?php the_title(); ?></h2>
                    <div class="blog-info clearfix">
                      <div class="view author-name"><?php the_author(); ?></div>
                      <div class="view publish-time"><?php the_time('Y.m.d') ?></div>
                        <div class="view view-amount"><i class="icon-amount"></i><?php if(function_exists('the_views')) { the_views(); } ?></div>
                        <div class="view view-reply"><i class="icon-reply"></i><span class="ds-thread-count" data-thread-key="<?php the_ID(); ?>"></span></div>
                        <div class="view view-share">
                          <i class="icon-share"></i>
                          <ul class="com-share-dest">
                          <i class="icon-share"></i>
                         <li>
                            <a href="javascript:void(0);" onclick="var _t = encodeURI('<?php the_title(); ?>');var _url = encodeURIComponent('<?php the_permalink() ?>');var _appkey = encodeURI('7ed7ca445fa74fbf94602744149db914');var _pic = '';var _site = '';var _u = 'http://v.t.qq.com/share/share.php?title='+_t+'&amp;url='+_url+'&amp;appkey='+_appkey+'&amp;site='+_site+'&amp;pic='+_pic;window.open( _u,'', 'width=700, height=680, top=0, left=0, toolbar=no, menubar=no, scrollbars=no, location=yes, resizable=no, status=no' );">
                              <span class="share-tqq"></span>腾讯微博</a>
                          </li>
                          <li><a href="javascript:void(0);" onclick="window.open('http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url='+encodeURIComponent('<?php the_permalink() ?>'));return false;">
                              <span class="share-qzone"></span>QQ空间</a>
                          </li>
                          </ul>

                     </div>
                    </div>
                </div>
                <div class="post-content">
                    <?php the_content(); ?>
<address>&lt;所有商品的版权不归本站所有，米苏仅为交流目的发布，请勿在没有获得授权的情况下，用于任何商业性转载、改写或出版物，一经发现，本站将通知原作者联合进行合法维权&gt;</address>
                </div>
               <?php get_sidebar(); ?>
  
           </article><?php endwhile; endif; ?>
          <a name="comments"></a>
	<div class="ds-thread"></div>
                        <div class="post-previous"><?php previous_post('% &raquo;  ',
 '  ', 'no'); ?></div>
            
                        <div class="post-next"><?php next_post('% &raquo;  ',
 '  ', 'no'); ?></div>
             
			
</section>

<?php get_footer(); ?>