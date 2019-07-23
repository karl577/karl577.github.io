<?php get_header(); ?>
	<div id="cate" data-type="<?php if(is_category()){$type = 'category_name';echo "cat";}else if(is_tag()){$type = 'tag';echo "tag";}?>" data-name="<?php if(is_category()){$cat_name = single_tag_title('',false);$cat_ID = get_cat_ID($cat_name);$cat = get_category($cat_ID);echo $name=$cat->slug;}else if(is_tag()){echo $name=single_tag_title('',false);}?>" ></div>
	<div id="container" class="clearfix">
		<?php if(have_posts()) : 
			$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
			$paged = $paged*4-3;
			$prePage = get_option('posts_per_page')/4;
			$args = array($type => $name,'showposts'=>$prePage,'paged' => $paged);
			query_posts($args);	
			while (have_posts()) : the_post(); ?>
			<?php get_template_part( 'content', get_post_format() ); ?>
		<?php endwhile; endif; ?>
	</div>
	<div id="pagenavi">
		<?php pagenavi();?>
	</div>
	<div class="clear"></div>
<?php get_footer(); ?>