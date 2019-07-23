<div id="post-<?php the_ID(); ?>" class="post-home">
	<div class="post-thumbnail">
		<?php $id=get_the_ID();$img = wim_index($id);if($img): ?>
			<a class="img" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" target="_blank"><?php echo $img;?></a>
		<?php else : ?>
			<a class="noimg" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" target="_blank"><?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 500,"...");?></a>
		<?php endif; ?>
	</div>
	<div class="post-title">
		<a href="<?php the_permalink(); ?>#single-content" title="<?php the_title();?>" target="_blank"><?php the_title();?></a><?php $cnt = post_img_number();if($cnt>0){?><span>&#40;&#32;<?php echo $cnt;_e('Photos','iphoto');?>&#32;&#41;</span><?php }?>
	</div>
	<div class="post-info">
		<div class="views"><?php if(function_exists('the_views')) {$views = the_views(0);preg_match('/\d+/', $views, $match);echo '<span>'.$match[0].'</span>';} ?></div>
		<div class="comments"><span><?php comments_popup_link('0', '1', '%'); ?></span></div>
		<?php if(function_exists('wizylike')) wizylike('button');  ?>
	</div>
</div>