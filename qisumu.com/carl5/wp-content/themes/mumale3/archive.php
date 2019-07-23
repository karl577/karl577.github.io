<?php get_header(); ?>
<div id="cate" data-type="<?php if(is_category()){$type = 'category_name';echo "cat";}else if(is_tag()){$type = 'tag';echo "tag";}?>" data-name="<?php if(is_category()){$cat_name = single_tag_title('',false);$cat_ID = get_cat_ID($cat_name);$cat = get_category($cat_ID);echo $name=$cat->slug;}else if(is_tag()){echo $name=single_tag_title('',false);}?>" ></div>
	<div class="archive-bar">
	<h1><?php the_category(', ') ?></h1>
	<?php 
	 $url_this = 'http://'.$_SERVER['SERVER_NAME'].$_SERVER["REQUEST_URI"];
	?>
	<li><a <?php if($url_this==get_category_link($cat))echo 'class="current"';?> href="<?php echo get_category_link($cat); ?>">最新排序</a></li>

	<li><a <?php if ( isset($_GET['order']) && ($_GET['order']=='hot') ) echo 'class="current"'; ?> href="<?php echo get_category_link($cat); ?>?order=hot">最热排序</a></li>

	<li><a <?php if ( isset($_GET['order']) && ($_GET['order']=='comment') ) echo 'class="current"'; ?> href="<?php echo get_category_link($cat); ?>?order=comment">评论最多</a></li>

	<li><a <?php if ( isset($_GET['order']) && ($_GET['order']=='sale') ) echo 'class="current"'; ?> href="<?php echo get_category_link($cat); ?>?order=sale">只看商品</a></li>
	</div>
	<div id="container" class="clearfix">
		<div id="post-tags" class="post-home clearfix">
			<h2><?php _e( 'Tags Cloud','mumale');?></h2>
			<?php 
			$tag_num = get_option('mumale_tag');
			$args = array(
				'format'=>'list',
                'smallest'=>'10',
				'largest'=>'10',
                'orderby'=> count,
                'order'=>'DESC',
				'number'=> $tag_num,
			);
			wp_tag_cloud($args);
			?>
		</div>
		<?php if(have_posts()) : 
			$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
			$paged = $paged*4-3;
			$prePage = get_option('posts_per_page')/4;
	  if ( isset($_GET['order']) ){
		if($_GET['order']==hot){
		 $args = array($type => $name,'showposts'=>$prePage,'paged' => $paged,'orderby'=> 'meta_value_num','meta_key' => 'views');
		}
		elseif($_GET['order']==comment){
		 $args = array($type => $name,'showposts'=>$prePage,'paged' => $paged,'orderby'=> comment_count);
		}
		elseif($_GET['order']==sale){
		 $args = array($type => $name,'showposts'=>$prePage,'paged' => $paged,'posts_per_page'=> '-1','meta_key' => 'sale_url','orderby' => 'meta_key');
		}
       else{
		   $args = array($type => $name,'showposts'=>$prePage,'paged' => $paged,);
	    }
      }else{
	     $args = array($type => $name,'showposts'=>$prePage,'paged' => $paged,);
	  }
			query_posts($args);	
			while (have_posts()) : the_post(); ?>
			<?php get_template_part( 'content', get_post_format() ); ?>
		<?php endwhile; endif;wp_reset_query();?>
	</div>
	
	
	<div id="pagenavi">
		<?php pagenavi();?>
	</div>
	<div class="clear"></div>
<?php get_footer(); ?>