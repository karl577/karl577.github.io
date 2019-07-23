<?php if ( get_post_meta($post->ID, 'postauthor', true) ) : ?>
<div class="authorbio">
	<?php echo get_avatar( get_the_author_meta('email'), '64' ); ?>

	<ul class="spostinfo">
		<?php $author = get_post_meta($post->ID, 'postauthor', true); ?>
		<?php $aurl = get_post_meta($post->ID, 'authorurl', true); ?>
		<li><strong>版权声明：</strong>本文由<a target="_blank" rel="nofollow" href="<?php echo $aurl ?>" ><?php echo $author ?></a>投稿，于<?php echo timeago(get_gmt_from_date(get_the_time('Y-m-d G:i:s'))); ?>发表，<?php echo count_words ($text); ?>。</li>
		<li><strong>转载请注明：</strong><a href="<?php the_permalink() ?>" rel="bookmark" title="本文固定链接 <?php the_permalink() ?>"><?php the_title(); ?> | <?php bloginfo('name');?></a><a href="#" onclick="copy_code('<?php the_permalink() ?>'); return false;"> +复制链接</a></li>
	</ul>
</div>
<?php else: ?>
<div class="authorbio">
	<?php echo get_avatar( get_the_author_meta('email'), '64' ); ?>

	<ul class="spostinfo">
		<?php if ( get_post_meta($post->ID, 'copyright', true) ) : ?>
		<?php $copy = get_post_meta($post->ID, 'copyright', true); ?>
		<li><strong>版权声明：</strong>
		<?php if ( get_post_meta($post->ID, 'from', true) ) : ?>
		<?php $original = get_post_meta($post->ID, 'from', true); ?>
			本文源自 <?php echo $original ?>，
		<?php else: ?>
			本文源自互联网，
		<?php endif; ?>
		于<?php echo timeago(get_gmt_from_date(get_the_time('Y-m-d G:i:s'))); ?>，由<?php the_author_posts_link(); ?>整理发表，<?php echo count_words ($text); ?>。</li>
		<li><strong>原文链接：</strong><a target="_blank" rel="nofollow" href="<?php echo $copy ?>" >点此查看原文</a></li>
		<?php else: ?>
		<li><strong>版权声明：</strong>本站原创文章，于<?php echo timeago(get_gmt_from_date(get_the_time('Y-m-d G:i:s'))); ?>，由<?php the_author_posts_link(); ?>发表，<?php echo count_words ($text); ?>。</li>
		<li><strong>转载请注明：</strong><a href="<?php the_permalink() ?>" rel="bookmark" title="本文固定链接 <?php the_permalink() ?>"><?php the_title(); ?> <?php echo zm_get_option('connector')?> <?php bloginfo('name');?></a><a href="#" onclick="copy_code('<?php the_permalink() ?>'); return false;"> +复制链接</a></li>
		<?php endif; ?>
	</ul>
</div>
<?php endif; ?>