<?php get_header(); ?>
<title>分类页面：<?php the_title(); ?>-<?php bloginfo('name'); ?></title>
	<?php include_once("banner.php"); ?>
<div id="content">
        	<div style="position:relative;z-index:100;">
                <h1>文章列表</h1>
            </div>
            
            <?php include_once("fenlei.php"); ?>
            
<section class="bloglist" style="position: relative;">
    <div class="grid-sizer"></div>
    <div class="gutter-sizer"></div>
    <div class="blog-loading"></div>
                <?php if(have_posts()) : while (have_posts()) : the_post(); ?>
                        <article class="item" id="post-<?php the_ID(); ?>" style="position: absolute; left: 0px; top: 0px;">
             		<div class="blog-cover">
                                                <img src="<?php echo get_content_first_image(get_the_content()); ?>" alt="<?php the_title_attribute(); ?>">
                        
                        <div class="cover-text">
                            <a href="<?php the_permalink() ?>" onclick="showLoading(event,926);">
                                <div class="text-detail">
                                    <p class="text-read">阅读详细</p>
                                    <p class="text-line">————————</p>
                                    <!--p class="text-dt">DETAIL</p-->
                                    <!--div class="author-face"><img alt='' src='http://0.gravatar.com/avatar/04fadebcd93590a74dff06b279cf614c?s=32&amp;d=http%3A%2F%2F0.gravatar.com%2Favatar%2Fad516503a11cd5ca435acc9bb6523536%3Fs%3D32&amp;r=G' class='avatar avatar-32 photo' height='32' width='32' /></div-->
                                    <p class="text-author"><?php the_author(); ?></p>

                                </div>
                                <div class="cover-loading"></div>
                            </a>

                        </div>

                    </div>
                    <div class="blog-title">
                        <h2 style="overflow:hidden;white-space:nowrap;text-overflow:ellipsis;"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    </div>
                    <div class="blog-info clearfix">
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
                    <div class="blog-content">
                        <?php the_excerpt(); ?>
                    </div>
                </article>
                <?php endwhile; endif; ?>
                        
                
            
</section><!--section .bloglist-->
<script type="text/javascript">
    var msnry;
    var imageLoaded = false;
    $(window).on('load', function(){
        var container = document.querySelector('.bloglist');
        imagesLoaded(container,function(){
                msnry = new Masonry( container, {
                columnWidth: '.grid-sizer',
                itemSelector: '.item',
                gutter: '.gutter-sizer',
                hiddenStyle: { opacity: 0, transform: 'translateY(50px)' },
                visibleStyle:{ opacity: 1, transform: 'translateY(0px)' }
            });
            imageLoaded = true;
        });
         
    });

        
    </script>
</div>
<!--#content-->
<div class="pagenavi">
    	<?php if(function_exists('wp_pagenavi')) { wp_pagenavi();} ?>
          </div>
<?php include_once("membercallback.php"); ?>
<?php get_footer(); ?>