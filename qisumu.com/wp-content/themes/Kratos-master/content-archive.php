<article class="animate-box">
	<div class="kratos-hentry kratos-post-inner clearfix">
		<header class="kratos-entry-header">
			<h1 class="kratos-entry-title text-center"><?php the_title(); ?></h1>
			<div class="kratos-post-meta text-center">
				<span>
				<a href="#"><i class="fa fa-calendar"></i> <?php the_time('Y/n/j') ?></a>
				</span>
				<span>
				<?php $category = get_the_category(); echo '<a href="'.get_category_link($category[0]->term_id ).'"><i class="fa fa-folder-open-o"></i> '.$category[0]->cat_name.'</a>'; ?>
				<?php comments_popup_link('<i class="fa fa-commenting-o"></i> 0 Comment', '<i class="fa fa-commenting-o"></i> 1 Comment', '<i class="fa fa-commenting-o"></i> % Comments', '', '<i class="fa fa-commenting-o"></i> 0 Comment'); ?>
				</span>
				<span>
				<a href="<?php the_permalink() ?>"><i class="fa fa-eye"></i> <?php echo kratos_get_post_views();?> Views</a>
				</span>
			</div>
		</header>
		<div class="kratos-post-content"><?php the_content(); ?></div>
		<footer class="kratos-entry-footer clearfix">
			<?php switch (kratos_option('post_like_donate')) {case '0':?>
			<div class="post-like-donate visible-lg text-center clearfix">
    			<a href="javascript:;" data-action="love" data-id="<?php the_ID(); ?>" class="KratosLove btn btn-primary <?php if(isset($_COOKIE['kratos_love_'.$post->ID])) echo 'done';?>" >
    				<i class="fa fa-heart-o"></i> 喜欢</a>
    			<span class="post-like-donate-count">
       				 	<?php if( get_post_meta($post->ID,'kratos_love',true) ){ echo get_post_meta($post->ID,'kratos_love',true); } else { echo '0'; }?></span>
   				<a href="<?php echo kratos_option('donate_links');?>" class="KratosDonate btn btn-primary"><i class="fa fa-bitcoin"></i> 打赏</a>
    		</div>
    		<?php ;break;default:break;}?>		
			<div class="footer-tag clearfix">
				<div class="pull-left">
				<i class="fa fa-tags"></i>
				<?php if ( get_the_tags() ) { the_tags('', ' ', ''); } else{ echo '<a>No Tag</a>';  }?>
				</div>
		</div>					 
		</footer>
	</div>
	<?php switch (kratos_option('post_cc')) {case '0':?>
	<div class="kratos-hentry kratos-copyright text-center clearfix">
		<img alt="知识共享许可协议" src="<?php echo get_template_directory_uri(); ?>/images/licenses.png">
		<h5>本作品采用 <a rel="license nofollow" target="_blank" href="http://creativecommons.org/licenses/by-sa/4.0/">知识共享署名-相同方式共享 4.0 国际许可协议</a> 进行许可</h5>
	</div>
	<?php ;break;default:break;}?>
	<nav class="navigation post-navigation clearfix" role="navigation">
		<?php
		$prev_post = get_previous_post(TRUE);
		if(!empty($prev_post)):?>
		<div class="nav-previous clearfix">
			<a title="<?php echo $prev_post->post_title;?>" href="<?php echo get_permalink($prev_post->ID);?>">&lt; 上一篇</a>
		</div>
		<?php endif;?>
		<?php
		$next_post = get_next_post(TRUE);
		if(!empty($next_post)):?>
		<div class="nav-next">
			<a title="<?php echo $next_post->post_title;?>" href="<?php echo get_permalink($next_post->ID);?>">下一篇 &gt;</a>
		</div>
		<?php endif;?>
	</nav>
	<?php comments_template(); ?>
</article>
