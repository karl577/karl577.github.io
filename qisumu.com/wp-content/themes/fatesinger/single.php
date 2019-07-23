<?php get_header(); ?>


	<article>        
			<div id="page-header"></div><div id="single-content">
			<div id="sharebar"><h3>分享</h3>
			<ul>
			<li id="tengxunweibo"><a href="http://v.t.qq.com/share/share.php?title=<?php the_title(); ?>&amp;url=<?php the_permalink(); ?>&amp;site=<?php bloginfo('url');?>" target="_blank" rel="nofollow">腾讯微博</a></li>
			<li id="sinaweibo"><a href="http://v.t.sina.com.cn/share/share.php?url=<?php the_permalink(); ?>&amp;title=<?php the_title(); ?>" target="_blank" rel="nofollow">新浪微博</a></li>
           <li id="twitter"><a href="http://twitter.com/share?url=<?php the_permalink(); ?>&amp;text=<?php the_title(); ?>" target="_blank" rel="nofollow">Twitter</a></li>
           <li id="fanfou"><a href="http://fanfou.com/sharer?u=<?php the_permalink(); ?>&amp;t=<?php the_title(); ?>" target="_blank" rel="nofollow">饭否</a></li>
           <li id="wangyi"><a href="http://t.163.com/article/user/checkLogin.do?link=<?php the_permalink(); ?>source=<?php bloginfo('url');?>&amp;info=<?php the_title(); ?><?php the_permalink(); ?>" target="_blank" rel="nofollow">网易微博</a></li>
           <li id="sohu"><a href="http://t.sohu.com/third/post.jsp?&amp;url=<?php the_permalink(); ?>&amp;title=<?php the_title(); ?>&amp;content=utf-8" target="_blank" rel="nofollow">搜狐微博</a></li>
           <li id="facebook"><a href="http://facebook.com/share.php?u=<?php the_permalink(); ?>&amp;t=<?php the_title(); ?>" target="_blank" rel="nofollow">Facebook</a></li>
           <li id="kaixin"><a href="http://www.kaixin001.com/repaste/share.php?rurl=<?php the_permalink(); ?>&amp;rcontent=<?php the_permalink(); ?>&amp;rtitle=<?php the_title(); ?>" target="_blank" rel="nofollow">开心网</a></li>
           <li id="renren"><a href="http://share.renren.com/share/buttonshare?link=<?php the_permalink(); ?>&amp;title=<?php the_title(); ?>" target="_blank" rel="nofollow">人人网</a></li>
           <li id="douban"><a href="http://www.douban.com/recommend/?url=<?php the_permalink(); ?>&amp;title=<?php the_title(); ?>" target="_blank" rel="nofollow">豆瓣网</a></li>
           <li id="greader"><a href="http://www.google.com/reader/link?url=<?php the_permalink(); ?>&amp;title=<?php the_title(); ?>&snippet=&srcTitle=&srcUrl=<?php bloginfo('url');?>" target="_blank" rel="nofollow" title="Google Reader">GReader</a></li>    
           <li id="digg"><a href="http://digg.com/submit?url=<?php the_permalink(); ?>&amp;title=<?php the_title(); ?>" target="_blank" rel="nofollow">Digg</a></li>     
           <li id="delicious"><a href="http://delicious.com/post?url=<?php the_permalink(); ?>&amp;title=<?php the_title(); ?>" target="_blank" rel="nofollow">delicious</a></li>   
           
			</ul>
			
			<img class="sharead" width="120" height="160" alt="" src="<?php bloginfo('template_directory');?>/images/120x160.png" style="background-color: rgb(248, 248, 248);">
			</div>
							<section id="primary">	
				    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>													
				      <div class="breadcrumbsclear"><div class="breadcrumbs"><a href="<?php bloginfo('url'); ?>">Home&nbsp;</a> &gt; Categories &gt; <?php the_category(' &gt; '); ?> &gt; <?php the_title(); ?></div></div>				
				      
				      
					   <h2><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" rel="bookmark"><?php the_title(); ?></a></h2> 	
					  	 <div class="single-meta"><span><?php the_author() ?></span><span><?php the_category(', ') ?></span><span><?php the_time('d,m,Y')?></span><span><?php comments_popup_link('No Reply', '1 Reply', '% Replies'); ?></span><span><?php edit_post_link(__('Edit', 'Fatesinger')); ?></span></div>
    <!--.postMeta-->	
				
				        <div class="post-content">									
					        <?php the_content(__('Read More'));?>
						</div>
                        <div class="clear"></div>
						<div id="authortail">
						<ul>
						<li>本文作者：<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author"><?php the_author(); ?></a></li>
						<li>本文地址：<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" rel="bookmark"><?php the_permalink() ?></a></li>
						
						<li>付费支持：<a href="<?php echo dopt('fate_pay'); ?>" target="_blank" title="支付宝捐赠"><?php echo dopt('fate_pay'); ?></a></li>
						</ul></div>

						<div class="singletags">

                  
						<?php if ( get_the_tags() ) { the_tags('Tagged with: ',' , '); } else{ echo "Tagged with nothing";  } ?></div>
						 <div class="sep"></div>
					<?php comments_template( '', true ); ?>

					
				
				<?php endwhile; endif;?>    
				</section>
				<div class="clear">
			</div>
		
		
	
		<div class="clear"></div>  
		</div><aside id="secondary">
        <h3>暧昧贴</h3>
		<div id="postloading"></div>
		<?php include_once('relatedpost.php');?>
		<?php if( dopt('fate_adpost_02_b') ) echo ''.dopt('fate_adpost_02').''; ?>
		
		<div id="sidebarfooter">Fatesinger</div>
    </aside>
	</article>

<script type="text/javascript" src="<?php bloginfo('template_url');?>/js/single.js"></script>

	  <?php get_footer(); ?>