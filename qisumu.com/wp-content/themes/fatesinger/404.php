<?php get_header(); ?>
	<article>      
						
						
				<div id="content">
<section>
      <h1>404 ERROR！</h1>	
					<div class="archives">
									
					
						对不起，你请求的页面不存在！请 <a href="<?php bloginfo('url');?>"> 返回首页 </a>或者看看本站的最近文章
					
		<?php
        $previous_year = $year = 0;
        $previous_month = $month = 0;
        $ul_open = false;
         
        $myposts = get_posts('numberposts=30&orderby=post_date&order=DESC');
        
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
			
	  </section>				
																		
				</div>				
						
			<?php get_sidebar(); ?>
		 </article>
	
		<?php get_footer(); ?>
	