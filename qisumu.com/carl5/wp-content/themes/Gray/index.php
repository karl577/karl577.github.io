<?php get_header(); ?>
   <div class="hidden-xs" style="background:#4A525F; padding: 20px 10px; position:fixed; top:95px; left:50%; margin-left:-580px; width:200px;">
        <div>
            <img class="img-responsive" src="<?php echo get_option('mao10_fimg'); ?>" />
        </div>
        <div style="color:#ABB7B7; font-weight:bold;">
            <h4><p><?php echo get_option('mao10_description0'); ?></h4>
			<p><?php echo get_option('mao10_description1'); ?></p>
			
        </div>
    </div>
    <div class="col-md-10 col-md-offset-2" id="paddingleft">
     
		<div class="row destacados">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<?php $num++; ?>
		<div class="col-md-4" id="pgs">
    		<div>
				<a href="<?php the_permalink(); ?>"><div class="img-div"><img src="<?php echo img(); ?>" /></div></a>
				<a href="<?php the_permalink(); ?>"><h4 style="color:#38485A; height:20px; overflow:hidden;"><?php the_title(); ?></h4></a>
				<?php the_excerpt(); ?>
				<a href="<?php the_permalink(); ?>" class="btn btn-primary kkbjs" title="点击阅读">点击阅读 »</a>
				
					<ul class="list-inline" style="padding-top:15px; font-size:12px; color:#999;">
					    <li>  <i class="glyphicon glyphicon-eye-open" style="top:2px; margin-right:4px;"></i> 阅读 <?php echo getPostViews(get_the_ID()); ?></li>
						<li> <i class="glyphicon glyphicon-comment" style="top:2px; margin-right:4px;"></i> 评论 <?php comments_number('0', '1', '%' );?></li>
					</ul>
				
			</div>
		</div>
		<?php if($num%3==0) { ?>
			<div class="clearfix"></div>
		<?php } ?>
		<?php endwhile; endif; ?>
	</div>
	<ul class="pagination"><?php par_pagenavi(9); ?></ul>
	
    </div>
    <?php get_footer(); ?>