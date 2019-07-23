<?php get_header(); ?>
	<div id="cate" data-type="<?php echo isset($_GET['order']) ? "meta" : "index";?>" data-name="<?php if(isset($_GET['order'])) echo $_GET['order'];?>"></div>
	<div class="tu">
		<!-- 111111111 -->
<div class="block blockmb">
	<div class="idxreg clr">
		<div class="left">
		<?php query_posts(array( 'post__in' => get_option('sticky_posts'), 'caller_get_posts' => 1, 'orderby' => rand, 'showposts' => 1));?>
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<?php the_post_thumbnail() ?>
			<a href="<?php the_permalink() ?>" class="cov" hidefocus="true"><?php the_title(); ?></a>
			<p></p>
			<div class="idxalowner">
			<a href="<?php the_author_meta( user_url ); ?>"><?php echo get_avatar(get_the_author_email(),"48");?><?php echo get_the_author(); ?> </a>
			<br>收集到 <?php the_category(', ') ?> 专辑
			</div>
		<?php endwhile; endif; wp_reset_query(); ?>
		</div>
		<div class="right">
			<?php if(is_user_logged_in()){ ?>
            <div class="userme">
				<a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php global $current_user;get_currentuserinfo();echo get_avatar( $current_user->user_email, 48); ?></a>
				<div>
					<a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a> <br>
					你好，欢迎来到<?php bloginfo('name'); ?>
				</div>
			</div>
			<?php }else{?>
			<div class="social">
				<a href="<?php bloginfo('url')?>/wp-login.php?action=register" class="imdreg" id="banreglink">立即注册</a>
				<div>使用已有帐号登录：</div>
				<div class="login1">
				<a class="sina" href="http://open.denglu.cc/transfer/sina?appid=<?php echo $wptm_basic['appid']?>" title="用新浪微博帐号登录"></a>
				<a class="oicq" href="http://open.denglu.cc/transfer/qzone?appid=<?php echo $wptm_basic['appid']?>" title="用QQ帐号登录"></a>
				<a class="qweibo" href="http://open.denglu.cc/transfer/tencent?appid=<?php echo $wptm_basic['appid']?>" title="用腾讯微博帐号登录"></a>
				<a class="douban" href="http://open.denglu.cc/transfer/douban?appid=<?php echo $wptm_basic['appid']?>" title="用豆瓣帐号登录"></a>
				</div>
			</div>
			<?php }?>
			<p>爱摄影，爱生活的每一天！</p>
			<div id="costat">
				<dl class="clr" id="coslider">
				<?php query_posts("showposts=20&caller_get_posts=1&orderby=date&order=DESC"); ?>
                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<dd>
					<a href="<?php the_author_meta( user_url ); ?>" hidefocus="true"><?php echo get_avatar(get_the_author_email(),"24");?><?php echo human_time_diff(get_the_time('U'), current_time('timestamp',1)) .'前'; ?></a>
					<div>
						<a href="<?php the_permalink() ?>" hidefocus="true"><img width="80" height="80" src="<?php echo index_that_image() ?>"></a>
					</div>
				</dd>
                <?php endwhile; endif; wp_reset_query(); ?>
				</dl>
			</div>
			
		</div>
	</div>
</div>
<?php if(get_option('mumale_ad')){?>
<div class="block blockmb">
	<?php echo stripslashes(get_option('mumale_ad')); ?>
</div>
<?php }?>
<div class="block blockmb">
			<div id="idxtagsp">
				<dl>
<?php
       $lanmu =  get_option('mumale_lanmu');
	   $args = array(
	    'type'          => 'post',
	    'child_of'      => 0,
	    'parent'        => '',
	    'orderby'       => 'name',
	    'order'         => 'ASC',
	    'hide_empty'    => 0,
	    'hierarchical'  => 1,
	    'exclude'       => '',
	    'include'       => $lanmu,
	    'number'        => '',
	    'taxonomy'      => 'category',
	    'pad_counts'    => false );
?>
<?php $categories = get_categories( $args );  foreach($categories as $category) { ?> 
				<dd>
					<a href="<?php echo get_category_link( $category->term_id ); ?>" hidefocus="true"><img width="205" height="136" src="<?php bloginfo('template_url'); ?>/images/category/<?php echo $category->category_nicename ?>.jpg"></a>
					<div class="pictag"><div><span><?php echo $category->name ?></span></div></div>
				</dd>
<?php wp_reset_query(); }?>				

				</dl>
				<a hidefocus="true" href="javascript:;" id="idxgonext"></a>
				<a hidefocus="true" href="javascript:;" id="idxgopre"></a>
			</div>
		</div>
	<!-- 111111111 -->
	</div>
	<div id="container">
		<?php if(have_posts()):
			$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
			$paged = $paged*4-3;
			$prePage = get_option('posts_per_page')/4;
			if(isset($_GET['order'])){
				$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
				$args = array(
					'meta_key' => $_GET['order'],
					'orderby'   => 'meta_value_num',
					'showposts'=> $prePage,
					'paged' => $paged,
					'order' => DESC,
					'caller_get_posts' => 1
				);
			}else{
				$args = array(
					'showposts'=>$prePage,
					'paged' => $paged,
					'caller_get_posts' => 1
				);
			}
			query_posts($args);
			while (have_posts()) : the_post(); ?>
			<?php get_template_part( 'content', get_post_format() ); ?>
		<?php endwhile; endif;wp_reset_query();?>
	</div>
	<div id="pagenavi">
		<?php pagenavi();?>
	</div>
	
<?php get_footer(); ?>