<?php
/**
Template Name: 留言板
url : /guestbook/
*/
get_header();
?>
<div id="content">
<div class="atop">
<div class="layer" id="mblogdetail">
<div class="tube tube-a">
<div class="block" id="detailcnt">
<div class="center section">
<div class="crumb clr"><?php if (function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?></div>
<div class="article clr" id="article">
<div class="bdfx"><script type="text/javascript">
/*640*60，创建于2013-4-11*/
var cpro_id = "u1258613";
</script>
<script src="http://cpro.baidustatic.com/cpro/ui/c.js" type="text/javascript"></script></div>
<?php
    $query="SELECT COUNT(comment_ID) AS cnt, comment_author, comment_author_url, comment_author_email FROM (SELECT * FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->posts.ID=$wpdb->comments.comment_post_ID) WHERE comment_date > date_sub( NOW(), INTERVAL 24 MONTH ) AND user_id='0' AND comment_author_email != 'cxshow@gmail.com' AND post_password='' AND comment_approved='1' AND comment_type='') AS tempcmt GROUP BY comment_author_email ORDER BY cnt DESC LIMIT 24";
    $wall = $wpdb->get_results($query);
    $maxNum = $wall[0]->cnt;
    foreach ($wall as $comment)
    {
        $width = round(40 / ($maxNum / $comment->cnt),2);//此处是对应的血条的宽度
        if( $comment->comment_author_url )
        $url = $comment->comment_author_url;
        else $url="#";
  $avatar = get_avatar($comment,$size='36',$default, $alt=get_comment_author($id));
        $tmp = "<li><a target=\"_blank\" href=\"".$comment->comment_author_url."\">".$avatar."<em>".$comment->comment_author."</em> <strong>+".$comment->cnt."</strong></br>".$comment->comment_author_url."</a></li>";
        $output .= $tmp;
     }
    $output = "<div class=\"mb10\"><ul class=\"readers-list\">".$output."</ul></div>";
    echo $output ;
?>
</div>
<div class="replyinfo">
<div class="itop"></div>
<div id="comments">
<?php comments_template(); ?>
<div id="respond-line" class="line"></div>
<div id="respond">
</div>
</div>
</div>
</div>
<div class="bottom"></div>	
</div>
</div>
<div class="tube tube-b" id="wrapper">
<div class="block">
<div class="aright">
<div class="section mt20" id="sidebar">
<script type="text/javascript">
/*300*250，创建于2013-4-11*/
var cpro_id = "u1258622";
</script>
<script src="http://cpro.baidustatic.com/cpro/ui/c.js" type="text/javascript"></script>
</div>
<div class="section mt10" id="curalbum">
<h4 class="clr">你可能也会喜欢<i><a href="/top/">更多</a></i></h4>
<div class="switch clr"><div class="p5"> 
<ul>
<?php query_posts('showposts=9&meta_key=_thumbnail_id'); ?>
<?php while (have_posts()) : the_post(); ?>
<li><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><img class="postimg" src="<?php get_image_url(); ?>" width="100" height="100" alt="<?php the_title(); ?>"/></a></li>
<?php endwhile; ?>
</ul>
</div></div>
</div>
</div>
</div>
<div class="block dbi blockevent"></div>
</div>
</div>
</div>
</div>
<?php get_footer(); ?>