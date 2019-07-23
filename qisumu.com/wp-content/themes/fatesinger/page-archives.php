<?php 
/*
Template Name: 存档模板
*/
get_header(); 
?>
	<article>        
								
					
				<div id="page-header"></div>							
					
				 <div id="page-content">
			<div class="page-sidebar">
        <ul class="page-navbar">
            <?php echo str_replace("</ul></div>", "", ereg_replace("<div[^>]*><ul[^>]*>", "", wp_nav_menu(array('theme_location' => 'pagenav', 'echo' => false)) )); ?>
        </ul>
    </div>	
<div class="breadcrumbsclear"><div class="breadcrumbs"><li><a href="<?php bloginfo('url'); ?>">Home&nbsp;</a> &gt; <?php the_title(); ?></li></div></div>				
									
					<h1>
						<?php the_title(); ?>
					</h1>					
					<div class="archives">
		<?php
        $previous_year = $year = 0;
        $previous_month = $month = 0;
        $ul_open = false;
         
        $myposts = get_posts('numberposts=-1&orderby=post_date&order=DESC');
        
        foreach($myposts as $post) :
            setup_postdata($post);
         
            $year = mysql2date('Y', $post->post_date);
            $month = mysql2date('n', $post->post_date);
            $day = mysql2date('j', $post->post_date);
            
            if($year != $previous_year || $month != $previous_month) :
                if($ul_open == true) : 
                    echo '</table>';
                endif;
         
                echo '<h4>'; echo the_time('F Y'); echo '</h4>';
                echo '<table>';
                $ul_open = true;
         
            endif;
         
            $previous_year = $year; $previous_month = $month;
        ?>
            <tr>
                <td width="40" style="text-align:right;"><?php the_time('j'); ?>日</td>
                <td width=""><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></td>
               
            </tr>
        <?php endforeach; ?>
        </table>
    </div>	
				
					<div class="clear"></div>					
							
			</div> 			
			
 
		<div class="clear"></div> </article> 
		<?php get_footer(); ?>
	