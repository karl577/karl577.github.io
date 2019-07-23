<?php get_header(); ?>
	<article>  
			
				<div id="content">		
<div class="breadcrumbsclear"><div class="breadcrumbs"><li><a href="<?php bloginfo('url'); ?>">Home&nbsp;</a> &gt; Category Archives</li></div></div>				
				   <?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
				   <?php /* If this is a category archive */ if (is_category()) { ?>
					<div class="archive_category">Category Archives: <?php single_cat_title(); ?></div>
				   <?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
					<div class="archive_tag">标签&nbsp; ”<?php single_tag_title(); ?>“ &nbsp;下的文章</div>
				   <?php /* If this is a daily archive */ } elseif (is_day()) { ?>
					<h1>Archive for <?php the_time('F jS, Y'); ?></h1>
				   <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
					<h1>Archive for <?php the_time('Y年F '); ?></h1>
				   <?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
					<h1>Archive for <?php the_time('Y'); ?></h1>
				   <?php /* If this is an author archive */ } elseif (is_author()) { ?>
					<h1>Author Archive</h1>
				   <?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
					<h1>Blog Archives</h1>
				   <?php } ?>       
					<section id="primary">
      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
      <div class="post">
	  <div class="selfthum"><a href="<?php the_permalink(); ?> " rel="nofollow"><?php post_thumbnail( 200,135 ); ?></a></div>
	  <div class="hometime">Fatesinger</div>
	  <div class="post-entry">
        <h2><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" rel="bookmark">
          <?php the_title(); ?>
          </a></h2>
        <?php if(function_exists('the_ratings')) { the_ratings(); } ?>
        <div class="entry-content">
           <?php echo mb_strimwidth(strip_tags(apply_filters('the_content', $post->post_content)), 0, 320,"……"); ?>
        </div>
        <div class="post-meta"><span><?php the_author() ?></span><span><?php the_category(', ') ?></span><span><?php the_time('d,m,Y')?></span><span><?php comments_popup_link('No Reply', '1 Reply', '% Replies'); ?></span></div>
      </div></div>
      
      <?php endwhile; endif;?>
	  </section>
      <div id="postnavigation"><?php par_pagenavi(6); ?></div>	
				</div><!--#end content-->	 <?php get_sidebar(); ?>
		</article>
		
		<?php get_footer(); ?>
	<!--#end layout-->
	