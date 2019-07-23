<?php get_header(); ?>
 <ol class="breadcrumb" style="padding:10px 0 0;">
  <li><a href="<?php bloginfo('url'); ?>">首页</a></li>
  <li><?php the_category(",") ?></li>
  <li><?php the_title(); ?></li>
</ol>
<div class="panel-title" style="position:relative; margin-top:40px;">
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<?php setPostViews(get_the_ID()); ?>
 <h2 class="slbt"  id="paddingsx20"><?php the_title(); ?></h2>
    <ul class="list-inline" style="padding-top:5px; font-size:12px; color:#999; text-align:center;">
	  <li>  <i class="glyphicon glyphicon-user" style="top:2px; margin-right:4px;"></i> By：  <?php the_author_meta( 'display_name'); ?></li>
					    <li>  <i class="glyphicon glyphicon-eye-open" style="top:2px; margin-right:4px;"></i> 阅读 <?php echo getPostViews(get_the_ID()); ?></li>
						<li> <i class="glyphicon glyphicon-comment" style="top:2px; margin-right:4px;"></i> 评论 <?php comments_number( '0', '1', '%' );?></li>
						<li> <i class="glyphicon glyphicon-hand-right" style="top:2px; margin-right:4px;"></i> 发布于： <?php the_time('Y-m-d H:i:s'); ?></li>
					</ul>
  <div class="panel-body" style="padding:15px 0;">
   <?php the_content(); ?>
  </div>
  <div class="pzuodian">
  					    		 <p style="color:#999999;">
                                    感谢你的阅读，本文由 猫猫建站 版权所有，转载时请注明出处，违者必究，谢谢你的合作。 注明出处格式：
                                    <?php the_author_meta( 'display_name'); ?>
                                </p>
                                <a href="<?php bloginfo('url'); ?>">
                                    <?php bloginfo( 'url'); ?>
                                </a>
                               </div>
</div>
<?php comments_template(); ?>
<?php endwhile; endif; ?>

<?php get_footer(); ?>