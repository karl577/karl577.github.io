<?php get_header(); ?>
		<div id="single-content">
			<div id="post-home">
				<?php if(have_posts()) : while (have_posts()) : the_post();
				 $sale_title = get_post_meta($post->ID, 'sale_title', true);
				 $sale_url = get_post_meta($post->ID, 'sale_url', true); 
				 $sale_price = get_post_meta($post->ID, 'sale_price', true);
				?>
				<div id="post-header">
					<?php if (function_exists('get_avatar')) { echo get_avatar( get_the_author_email(), '48' ); }?>
					<div id="post-title">
						<h1><?php the_title_attribute(); ?></h1>
						<p>by <?php the_author_link(); ?> &#160;&#124;&#160;<?php the_time('M d, Y'); ?>&#160;&#124;&#160;in <?php the_category(', '); ?>&#160;&#124;&#160;<?php if(function_exists('the_views')) {$views = the_views(0);preg_match('/\d+/', $views, $match);echo '<span>'._e( 'Views',mumale).' '.$match[0].'</span>';} ?>&#160;&#124;&#160;
						<?php _e( 'Comments',mumale).' ';?>
						<?php comments_popup_link('0', '1', '%'); ?>
						</p>			 
					</div>
					<div class="clear"></div>
				</div>
				<div class="sep"></div>
				<div class="post-content">
				 <!-- 来源 -->
				<div class="mbtfvt">
					<p class="mbtsocp">来源：
					<?php if($sale_title==''){?>
					<?php bloginfo('name')?></p>
					<?php }else{?>
					<a id="mbreslnk" href="<?php echo $sale_url ?>"><?php echo $sale_title ?><b>￥<?php echo $sale_price ?></b></a></p>
					
						<a class="mbtobuy" href="<?php echo $sale_url ?>">去购买</a>
					<?php }?>
				</div>
				<!-- 来源END -->
				<?php the_content(''); ?>
				</div>
				<?php endwhile; endif; ?>
				<!-- 版权声明start -->
				 <div id="copyright">
				   <div class="incopyright">
				    <div class="copyimg"></div>
					<div class="copyline"></div>
					<div class="copyright">
				       转载文章请注明来自<a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a><br>
                       如果这篇文章侵犯到你的权益，请及时联系站长<br>
                       如果你觉得这篇文章不错，你可以把他推分享给你的朋友和家人
					</div>
				   </div>
				 </div>
				<!-- 版权声明end -->
				<div id="comments">
					<?php comments_template('', true); ?>
				</div>
			</div>
		</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>