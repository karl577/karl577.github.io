<?php
/**
 * Specific function for site tags:
 * - Permalink: the_mu_permalink()
 * 
 * Classic function working:
 * - ID: the_ID()
 * - Title: the_title()
 * - Time: the_time() / the_date()
 * - Content: the_content() / the_excerpt()
 * 
 * Disabled function : (no errors, but not working, display wrong data.) 
 * - the_category()
 * - the_permalink()
 * - edit_post_link()
 * - comments_popup_link()
 * - the_author() 
 **/
?>

<?php get_header(); ?>

	<div id="content" class="narrowcolumn">
		<h2 class="pagetitle">All tag results for &#8216;<?php STP_MU_CurrentTagSet(); ?>&#8217;</h2>
		
		<?php if (have_posts()) : ?>
			<?php while (have_posts()) : the_post(); ?>
				<div class="post post-<?php the_ID(); ?>">
					<h2><a href="<?php the_mu_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h2>
					<small><?php the_time('F jS, Y') ?></small>
					<div class="entry">
						<?php the_content('Read the rest of this entry &raquo;'); ?>
					</div>
					<p class="postmetadata">Blog: <a href="<?php the_mu_blog_permalink(); ?>" title="Permanent Link to <?php the_blog_name(); ?>"><?php the_blog_name(); ?></a></p>
				</div>
			<?php endwhile; ?>
			<div class="navigation">
				<div class="alignleft"><?php next_posts_link('&laquo; Older Entries') ?></div>
				<div class="alignright"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
			</div>
		<?php else : ?>
			<h2 class="center">Not Found</h2>
			<p class="center">Sorry, but you are looking for something that isn't here.</p>
			<?php include (TEMPLATEPATH . "/searchform.php"); ?>
		<?php endif; ?>
	</div>
	
<?php get_sidebar(); ?>
<?php get_footer(); ?>