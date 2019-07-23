<?php get_header(); ?>
		<div id="single-content">
			<div id="post-home" class="clearfix">
				<?php if(have_posts()) : while (have_posts()) : the_post(); ?>
				<div class="post-content">
					<?php $postid = get_the_ID();$cnt = post_img_number();$img = wim_single($postid,0);if($img): ?>
						<div id="img" data-id="<?php echo $postid;?>">
							<div id="img-loading"></div>
							<a id="img-left" title="<?php _e('No previous','iphoto');?>"></a>
							<a id="img-right" title="<?php if($cnt>1){_e('Next photo','iphoto');}else{_e('No next','iphoto');}?>"></a>
							<div id="img-number"><span id="img-current">1</span>&#47;<span id="img-cnt"><?php echo $cnt;?></span></div>
							<div id="img-content">
								<?php if($cnt>0){
									for($g=0;$g<$cnt;$g++){
										echo wim_single($postid,$g);
									}
								}?>
							</div>
						</div>
					<?php else : ?>
						<?php the_content(); ?>
					<?php endif; ?>
				</div>
				<?php endwhile; endif; ?>
				<div id="postMsg" class="clearfix">
					<div class="views"><?php if(function_exists('the_views')) {$views = the_views(0);preg_match('/\d+/', $views, $match);echo '<span>阅读</span><br /><span>'.$match[0].'</span>';} ?></div>
					<?php if(function_exists('wizylike')) wizylike('button2');  ?>
					<div class="comments"><span>评论</span><br /><span><?php comments_number('0','1','%'); ?></span></div>
				</div>
				<div id="comments">
					<?php comments_template('', true); ?>
				</div>
			</div>
		</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>