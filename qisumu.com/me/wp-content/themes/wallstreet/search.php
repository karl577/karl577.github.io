<?php get_header(); ?>
<!-- Page Title Section -->
<div class="page-mycarousel">
	<img src="<?php echo get_template_directory_uri(); ?>/images/page-header-bg.jpg"  class="img-responsive">
	<div class="container page-title-col">
		<div class="row">
			<div class="col-md-12 col-sm-12">
				<h1><?php echo get_search_query(); ?></h1>			
			</div>	
		</div>
	</div>
	<div class="page-breadcrumbs">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<ol class="breadcrumbs">
						<?php if (function_exists('webriti_custom_breadcrumbs')) webriti_custom_breadcrumbs();?>
					</ol>
				</div>
			</div>	
		</div>
	</div>
</div>
<!-- /Page Title Section -->

<!-- Blog & Sidebar Section -->
<div class="container">
	<div class="row">
		<div class="col-md-8">
			<?php if ( have_posts() ) { ?>
				<h1 class="search_heading">
				<?php printf( __("Search results for: %s", 'wallstreet' ), '<span>' . get_search_query() . '</span>' ); ?>
				</h1>
			<?php while ( have_posts() ) { the_post();  ?>
			<div id="post-<?php the_ID(); ?>" <?php post_class('blog-section-right'); ?>>
				<?php if(has_post_thumbnail()){ ?>
				<?php $defalt_arg =array('class' => "img-responsive"); ?>
				<div class="blog-post-img">
					<?php the_post_thumbnail('', $defalt_arg); ?>
				</div>
				<?php } ?>
				<div class="clear"></div>
				<div class="blog-post-title">
					<div class="blog-post-date"><span class="date"><a href="<?php the_permalink();?>"><?php echo get_the_date('j'); ?> <small><?php echo get_the_date('M'); ?></small></a></span>
						<span class="comment"><i class="fa fa-comment"></i><?php comments_number('0', '1','%'); ?></span>
					</div>
					<div class="blog-post-title-wrapper">
						<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						<?php the_content(); ?>		
						<div class="blog-btn-col"><a href="<?php the_permalink(); ?>" class="blog-btn"><?php _e('Read More','wallstreet'); ?></a></div>
						<div class="blog-post-meta">
							<a id="blog-author" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><i class="fa fa-user"></i> <?php the_author(); ?></a>
							<?php 	$tag_list = get_the_tag_list();
							if(!empty($tag_list)) { ?>
							<div class="blog-tags">
								<i class="fa fa-tags"></i><?php the_tags('', ', ', ''); ?>
							</div>
							<?php } ?>
						</div>
					</div>
				</div>	
			</div>
			<?php } ?>
			<div class="blog-pagination">
				<?php next_posts_link( __('Previous','wallstreet') ); ?>
				<?php previous_posts_link( __('Next','wallstreet') ); ?>
			</div>
			<?php } else { ?>
				<div class="search_error">
				<div class="search_err_heading"><h2><?php _e( "Nothing Found","wallstreet"); ?></h2> </div>
				<div class="wallstreet_searching">
				<p><?php _e( "Sorry, but nothing matched your search criteria. Please try again with some different keywords.","wallstreet"); ?></p>
				</div>	
					
				</div>
				<?php get_search_form(); ?>
			<?php } ?>	
		</div><!--/Blog Area-->
		<?php get_sidebar(); ?>
	</div>
</div>
<?php get_footer(); ?>
<!-- /Blog & Sidebar Section -->		