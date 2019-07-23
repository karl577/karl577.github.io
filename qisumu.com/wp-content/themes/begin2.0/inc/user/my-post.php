<table cellspacing="0" cellpadding="0" border="0">
	<thead>
		<tr>
			<td width="500">标题</td>
			<td width="120">日期</td>
			<td width="100">浏览</td>
			<td width="120">分类</td>
			<td width="100">评论</td>
			<td width="80">状态</td>
		</tr>
	</thead>
	<tbody>
		<?php
		$userinfo=get_userdata(get_current_user_id());
		$user_id= $userinfo->id;
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		$args = array(
			'post_type' => array('post','video','picture','bulletin','tao'),
		    'author' => $user_id,
			'posts_per_page' =>'20',
		    'post_status' => array('publish', 'pending'),
			'orderby' => 'date',
		    'paged' => $paged
		);
		query_posts($args);
		if(have_posts()) : while (have_posts()) : the_post();
		     switch(get_post(get_the_ID())->post_status){
			   case 'publish':
		       $status='通过';
		       break;
			   case 'pending':
		       $status='<span>待审</span>';
		       break;
			 }
		?>
		<tr>
			<td><?php the_title( sprintf( '<a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a>' ); ?></td>
			<td class="tc"><?php the_time( 'Y-m-d' ) ?></td>
			<td class="tc"><?php if( function_exists( 'the_views' ) ) { print ''; the_views(); print '';  } ?></td>
			<td class="tc"><?php echo get_the_term_list(get_the_ID(), array('category','videos','gallery','notice','taobao'), '', ', ', ''); ?></td>
			<td class="tc"><?php echo get_post(get_the_ID())->comment_count?></td>
			<td class="tc"><?php echo $status?></td>
		</tr>
		<?php endwhile; endif;?>

	</tbody>
</table>

<?php begin_pagenav(); ?>
<div class="clear"></div>