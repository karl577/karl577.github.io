<?php
/**
* @package WordPress
Template Name: 读者墙
*/

?>
<?php get_header(); ?>



<!-- Begin #colleft -->

			<div id="colLeft">

			<h1><?php the_title(); ?></h1>	

		<h4><?php if (have_posts()) : while (have_posts()) : the_post(); ?></h4>

		<?php the_content(); ?>
<h2>筑墙啦~~</h2>
       <?php

$query="SELECT COUNT(comment_ID) AS cnt, comment_author, comment_author_url, comment_author_email FROM (SELECT * FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->posts.ID=$wpdb->comments.comment_post_ID) WHERE comment_date > date_sub( NOW(), INTERVAL 1 YEAR ) AND user_id='0' AND comment_author_email != 'pooxiao@gmail.com' AND comment_author_email != 'mu@qijiemutou.com' AND post_password='' AND comment_approved='1' AND comment_type='') AS tempcmt GROUP BY comment_author_email ORDER BY cnt DESC LIMIT 100";

$wall = $wpdb->get_results($query);

foreach ($wall as $comment)

{

if( $comment->comment_author_url )

$url = $comment->comment_author_url;

else $url="#";

$tmp = "<a href='".$url."' title='".$comment->comment_author." (".$comment->cnt.")'target=\"_blank\"'>".get_avatar($comment->comment_author_email, 40)."</a>";

$output .= $tmp;

}

$output = "<div id='readerswall'>".$output."</div>";

echo $output ;

?>

		<?php if ( comments_open() ) comments_template(); ?>

		<?php endwhile; else: ?>

		<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>

		<?php endif; ?>

			

			</div>

			<!-- End #colLeft -->

			



<?php get_sidebar(); ?>	

<?php get_footer(); ?>