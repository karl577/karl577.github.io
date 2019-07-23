<?php
// 自动缩略图
function zm_thumbnail() {
    global $post;
    if ( get_post_meta($post->ID, 'thumbnail', true) ) {
    	$image = get_post_meta($post->ID, 'thumbnail', true);
        echo '<a href="'.get_permalink().'"><img src=';
        echo $image;
        echo ' alt="'.$post->post_title .'" /></a>';
    } else {
	    if ( has_post_thumbnail() ) {
	        echo '<a href="'.get_permalink().'">';
	        the_post_thumbnail('content', array('alt' => get_the_title()));
	        echo '</a>';
		} else {
	        $content = $post->post_content;
	        preg_match_all('/<img.*?(?: |\\t|\\r|\\n)?src=[\'"]?(.+?)[\'"]?(?:(?: |\\t|\\r|\\n)+.*?)?>/sim', $content, $strResult, PREG_PATTERN_ORDER);
	        $n = count($strResult[1]);
	        if($n > 0){
				echo '<a href="'.get_permalink().'"><img src="'.get_template_directory_uri().'/timthumb.php?src='.$strResult[1][0].'&w='.zm_get_option('img_w').'&h='.zm_get_option('img_h').'&zc=1" alt="'.$post->post_title .'" /></a>';
	        } else { 
				$random = mt_rand(1, 20);
				echo '<a href="'.get_permalink().'"><img src="'.get_template_directory_uri().'/img/random/'. $random .'.jpg" alt="'.$post->post_title .'" /></a>';
	        }
		}
	}
}


function zm_thumbnailnolink() {
    global $post;
    if ( get_post_meta($post->ID, 'thumbnail', true) ) {
    	$image = get_post_meta($post->ID, 'thumbnail', true);
        echo $image;
    } else {
	    if ( has_post_thumbnail() ) {
	        the_post_thumbnail('content');
		} else {
	        $content = $post->post_content;
	        preg_match_all('/<img.*?(?: |\\t|\\r|\\n)?src=[\'"]?(.+?)[\'"]?(?:(?: |\\t|\\r|\\n)+.*?)?>/sim', $content, $strResult, PREG_PATTERN_ORDER);
	        $n = count($strResult[1]);
	        if($n > 0){
				echo ''.get_template_directory_uri().'/timthumb.php?src='.$strResult[1][0].'&w='.zm_get_option('img_w').'&h='.zm_get_option('img_h').'&zc=1';
	        } else { 
				$random = mt_rand(1, 20);
				echo ''.get_template_directory_uri().'/img/random/'. $random .'.jpg';
	        }
		}
	}
}


function zm_thumbnail_h() {
    global $post;
    if ( get_post_meta($post->ID, 'thumbnail', true) ) {
    	$image = get_post_meta($post->ID, 'thumbnail', true);
        echo '<div class="load"><a href="'.get_permalink().'"><img src="' . get_template_directory_uri() . '/img/loading.png" data-original=';
        echo $image;
        echo ' alt="'.$post->post_title .'" /></a></div>';
    } else {
	    if ( has_post_thumbnail() ) {
	        echo '<a href="'.get_permalink().'">';
	        the_post_thumbnail('content', array('alt' => get_the_title()));
	        echo '</a>';
		} else {
	        $content = $post->post_content;
	        preg_match_all('/<img.*?(?: |\\t|\\r|\\n)?src=[\'"]?(.+?)[\'"]?(?:(?: |\\t|\\r|\\n)+.*?)?>/sim', $content, $strResult, PREG_PATTERN_ORDER);
	        $n = count($strResult[1]);
	        if($n > 0){
				echo '<div class="load"><a href="'.get_permalink().'"><img src="' . get_template_directory_uri() . '/img/loading.png" data-original="'.get_template_directory_uri().'/timthumb.php?src='.$strResult[1][0].'&w='.zm_get_option('img_w').'&h='.zm_get_option('img_h').'&zc=1" alt="'.$post->post_title .'" /></a></div>';
	        } else { 
	        	$random = mt_rand(1, 20);
				echo '<div class="load"><a href="'.get_permalink().'"><img src="' . get_template_directory_uri() . '/img/loading.png" data-original="'.get_template_directory_uri().'/img/random/'. $random .'.jpg" alt="'.$post->post_title .'" /></a></div>';
	        }
		}
	}
}

function zm_long_thumbnail() {
    global $post;
	$content = $post->post_content;
	preg_match_all('/<img.*?(?: |\\t|\\r|\\n)?src=[\'"]?(.+?)[\'"]?(?:(?: |\\t|\\r|\\n)+.*?)?>/sim', $content, $strResult, PREG_PATTERN_ORDER);
	$n = count($strResult[1]);
	if($n > 0){
		echo '<a href="'.get_permalink().'"><img src="'.get_template_directory_uri().'/timthumb.php?src='.$strResult[1][0].'&w='.zm_get_option('img_k_w').'&h='.zm_get_option('img_k_h').'&zc=1" alt="'.$post->post_title .'" /></a>';
	} else { 
		echo '<a class="random-img" href="'.get_permalink().'"><img src="'.get_template_directory_uri().'/img/random/long.jpg" alt="'.$post->post_title .'" /></a>';
	}
}

function zm_long_thumbnail_h() {
    global $post;
	$content = $post->post_content;
	preg_match_all('/<img.*?(?: |\\t|\\r|\\n)?src=[\'"]?(.+?)[\'"]?(?:(?: |\\t|\\r|\\n)+.*?)?>/sim', $content, $strResult, PREG_PATTERN_ORDER);
	$n = count($strResult[1]);
	if($n > 0){
		echo '<div class="load"><a href="'.get_permalink().'"><img src="' . get_template_directory_uri() . '/img/long.png" data-original="'.get_template_directory_uri().'/timthumb.php?src='.$strResult[1][0].'&w='.zm_get_option('img_k_w').'&h='.zm_get_option('img_k_h').'&zc=1" alt="'.$post->post_title .'" /></a></div>';
	} else { 
		echo '<div class="load"><a class="random-img" href="'.get_permalink().'"><img src="' . get_template_directory_uri() . '/img/long.png" data-original="'.get_template_directory_uri().'/img/random/long.jpg" alt="'.$post->post_title .'" /></a></div>';
	}
}




function img_thumbnail() {
    global $post;
    if ( get_post_meta($post->ID, 'thumbnail', true) ) {
    	$image = get_post_meta($post->ID, 'thumbnail', true);
        echo '<a href="'.get_permalink().'"><img src=';
        echo $image;
        echo ' alt="'.$post->post_title .'" /></a>';
    } else {
	    if ( has_post_thumbnail() ) {
	        echo '<a href="'.get_permalink().'">';
	        the_post_thumbnail('content', array('alt' => get_the_title()));
	        echo '</a>';
		} else {
	        $content = $post->post_content;
	        preg_match_all('/<img.*?(?: |\\t|\\r|\\n)?src=[\'"]?(.+?)[\'"]?(?:(?: |\\t|\\r|\\n)+.*?)?>/sim', $content, $strResult, PREG_PATTERN_ORDER);
	        $n = count($strResult[1]);
	        if($n > 0){
				echo '<a href="'.get_permalink().'"><img src="'.get_template_directory_uri().'/timthumb.php?src='.$strResult[1][0].'&w='.zm_get_option('img_i_w').'&h='.zm_get_option('img_i_h').'&zc=1" alt="'.$post->post_title .'" /></a>';
	        } else { 
				$random = mt_rand(1, 20);
				echo '<a href="'.get_permalink().'"><img src="'.get_template_directory_uri().'/img/random/'. $random .'.jpg" alt="'.$post->post_title .'" /></a>';
	        }
		}
	}
}

function img_thumbnail_h() {
    global $post;
    if ( get_post_meta($post->ID, 'thumbnail', true) ) {
    	$image = get_post_meta($post->ID, 'thumbnail', true);
        echo '<div class="load"><a href="'.get_permalink().'"><img src="' . get_template_directory_uri() . '/img/loading.png" data-original=';
        echo $image;
        echo ' alt="'.$post->post_title .'" /></a></div>';
    } else {
	    if ( has_post_thumbnail() ) {
	        echo '<a href="'.get_permalink().'">';
	        the_post_thumbnail('content', array('alt' => get_the_title()));
	        echo '</a>';
		} else {
	        $content = $post->post_content;
	        preg_match_all('/<img.*?(?: |\\t|\\r|\\n)?src=[\'"]?(.+?)[\'"]?(?:(?: |\\t|\\r|\\n)+.*?)?>/sim', $content, $strResult, PREG_PATTERN_ORDER);
	        $n = count($strResult[1]);
	        if($n > 0){
				echo '<div class="load"><a href="'.get_permalink().'"><img src="' . get_template_directory_uri() . '/img/loading.png" data-original="'.get_template_directory_uri().'/timthumb.php?src='.$strResult[1][0].'&w='.zm_get_option('img_i_w').'&h='.zm_get_option('img_i_h').'&zc=1" alt="'.$post->post_title .'" /></a></div>';
	        } else { 
	        	$random = mt_rand(1, 20);
				echo '<div class="load"><a href="'.get_permalink().'"><img src="' . get_template_directory_uri() . '/img/loading.png" data-original="'.get_template_directory_uri().'/img/random/'. $random .'.jpg" alt="'.$post->post_title .'" /></a></div>';
	        }
		}
	}
}

function videos_thumbnail_h() {
    global $post;
    if ( get_post_meta($post->ID, 'small', true) ) {
    	$image = get_post_meta($post->ID, 'small', true);
        echo '<div class="load"><a class="videos" href="'.get_permalink().'"><img src="' . get_template_directory_uri() . '/img/loading.png" data-original=';
        echo $image;
        echo ' alt="'.$post->post_title .'" /><i class="fa fa-play-circle-o"></i></a></div>';
    } else {
		if ( has_post_thumbnail() ) {
			echo '<a class="videos" href="'.get_permalink().'">';
			the_post_thumbnail('content', array('alt' => get_the_title()));
	        echo '<i class="fa fa-play-circle-o"></i></a>';
			} else {
				$content = $post->post_content;
	        	preg_match_all('/<img.*?(?: |\\t|\\r|\\n)?src=[\'"]?(.+?)[\'"]?(?:(?: |\\t|\\r|\\n)+.*?)?>/sim', $content, $strResult, PREG_PATTERN_ORDER);
				$n = count($strResult[1]);
				if($n > 0){
					echo '<div class="load"><a class="videos" href="'.get_permalink().'"><img src="' . get_template_directory_uri() . '/img/loading.png" data-original="'.get_template_directory_uri().'/timthumb.php?src='.$strResult[1][0].'&w='.zm_get_option('img_v_w').'&h='.zm_get_option('img_v_h').'&zc=1" ';
					echo ' alt="'.$post->post_title .'" /><i class="fa fa-play-circle-o"></i></a></div>';
					} else { 
						$random = mt_rand(1, 20);
						echo '<div class="load"><a class="videos" href="'.get_permalink().'"><img src="' . get_template_directory_uri() . '/img/loading.png" data-original="'.get_template_directory_uri().'/img/random/'. $random .'.jpg" ';
						echo ' alt="'.$post->post_title .'" /><i class="fa fa-play-circle-o"></i></a></div>';
					}
			}
	}
}

function videos_thumbnail() {
    global $post;
    if ( get_post_meta($post->ID, 'small', true) ) {
    	$image = get_post_meta($post->ID, 'small', true);
        echo '<a class="videos" href="'.get_permalink().'"><img src=';
        echo $image;
        echo ' alt="'.$post->post_title .'" /><i class="fa fa-play-circle-o"></i></a>';
    } else {
		if ( has_post_thumbnail() ) {
			echo '<a class="videos" href="'.get_permalink().'">';
			the_post_thumbnail('content', array('alt' => get_the_title()));
	        echo '<i class="fa fa-play-circle-o"></i></a>';
			} else {
				$content = $post->post_content;
	        	preg_match_all('/<img.*?(?: |\\t|\\r|\\n)?src=[\'"]?(.+?)[\'"]?(?:(?: |\\t|\\r|\\n)+.*?)?>/sim', $content, $strResult, PREG_PATTERN_ORDER);
				$n = count($strResult[1]);
				if($n > 0){
					echo '<a class="videos" href="'.get_permalink().'"><img src="'.get_template_directory_uri().'/timthumb.php?src='.$strResult[1][0].'&w='.zm_get_option('img_v_w').'&h='.zm_get_option('img_v_h').'&zc=1" ';
					echo ' alt="'.$post->post_title .'" /><i class="fa fa-play-circle-o"></i></a>';
					} else { 
						$random = mt_rand(1, 20);
						echo '<a class="videos" href="'.get_permalink().'"><img src="'.get_template_directory_uri().'/img/random/'. $random .'.jpg" ';
						echo ' alt="'.$post->post_title .'" /><i class="fa fa-play-circle-o"></i></a>';
					}
			}
	}
}

function video_thumbnail() {
    global $post;
    $img = get_post_meta($post->ID, 'big', true);
    if ( get_post_meta($post->ID, 'small', true) ) {
    	$image = get_post_meta($post->ID, 'small', true);
        echo '<a class="videos" href="'.$img.'"><img src=';
        echo $image;
        echo ' alt="'.$post->post_title .'" /><i class="fa fa-play-circle-o"></i></a>';
    } else {
	    if ( has_post_thumbnail() ) {
	        echo '<a class="videos" href="'.$img.'">';
	        the_post_thumbnail('content', array('alt' => get_the_title()));
	        echo '<i class="fa fa-play-circle-o"></i></a>';
			} else {
				$content = $post->post_content;
	        	preg_match_all('/<img.*?(?: |\\t|\\r|\\n)?src=[\'"]?(.+?)[\'"]?(?:(?: |\\t|\\r|\\n)+.*?)?>/sim', $content, $strResult, PREG_PATTERN_ORDER);
				$n = count($strResult[1]);
				if($n > 0){
					echo '<a class="videos" href="'.$img.'"><img src="'.get_template_directory_uri().'/timthumb.php?src='.$strResult[1][0].'&w='.zm_get_option('img_v_w').'&h='.zm_get_option('img_v_h').'&zc=1" ';
					echo ' alt="'.$post->post_title .'" /><i class="fa fa-play-circle-o"></i></a>';
					} else { 
						$random = mt_rand(1, 20);
						echo '<a class="videos" href="'.$img.'"><img src="'.get_template_directory_uri().'/img/random/'. $random .'.jpg" ';
						echo ' alt="'.$post->post_title .'" /><i class="fa fa-play-circle-o"></i></a>';
					}
			}
	}
}

function videor_thumbnail_h() {
    global $post;
    if ( get_post_meta($post->ID, 'small', true) ) {
    	$image = get_post_meta($post->ID, 'small', true);
        echo '<div class="load"><a class="videor" href="'.get_permalink().'"><img src="' . get_template_directory_uri() . '/img/loading.png" data-original=';
        echo $image;
        echo ' alt="'.$post->post_title .'" /><i class="fa fa-play-circle-o"></i></a></div>';
    } else {
		if ( has_post_thumbnail() ) {
			echo '<a class="videor" href="'.get_permalink().'">';
			the_post_thumbnail('content', array('alt' => get_the_title()));
	        echo '<i class="fa fa-play-circle-o"></i></a>';
			} else {
				$content = $post->post_content;
	        	preg_match_all('/<img.*?(?: |\\t|\\r|\\n)?src=[\'"]?(.+?)[\'"]?(?:(?: |\\t|\\r|\\n)+.*?)?>/sim', $content, $strResult, PREG_PATTERN_ORDER);
				$n = count($strResult[1]);
				if($n > 0){
					echo '<div class="load"><a class="videor" href="'.get_permalink().'"><img src="' . get_template_directory_uri() . '/img/loading.png" data-original="'.get_template_directory_uri().'/timthumb.php?src='.$strResult[1][0].'&w='.zm_get_option('img_v_w').'&h='.zm_get_option('img_v_h').'&zc=1" ';
					echo ' alt="'.$post->post_title .'" /><i class="fa fa-play-circle-o"></i></a></div>';
					} else { 
						$random = mt_rand(1, 20);
						echo '<div class="load"><a class="videor" href="'.get_permalink().'"><img src="' . get_template_directory_uri() . '/img/loading.png" data-original="'.get_template_directory_uri().'/img/random/'. $random .'.jpg" ';
						echo ' alt="'.$post->post_title .'" /><i class="fa fa-play-circle-o"></i></a></div>';
					}
			}
	}
}

function videor_thumbnail() {
    global $post;
    if ( get_post_meta($post->ID, 'small', true) ) {
    	$image = get_post_meta($post->ID, 'small', true);
        echo '<a class="videor" href="'.get_permalink().'"><img src=';
        echo $image;
        echo ' alt="'.$post->post_title .'" /><i class="fa fa-play-circle-o"></i></a>';
    } else {
		if ( has_post_thumbnail() ) {
			echo '<a class="videor" href="'.get_permalink().'">';
			the_post_thumbnail('content', array('alt' => get_the_title()));
	        echo '<i class="fa fa-play-circle-o"></i></a>';
			} else {
				$content = $post->post_content;
	        	preg_match_all('/<img.*?(?: |\\t|\\r|\\n)?src=[\'"]?(.+?)[\'"]?(?:(?: |\\t|\\r|\\n)+.*?)?>/sim', $content, $strResult, PREG_PATTERN_ORDER);
				$n = count($strResult[1]);
				if($n > 0){
					echo '<a class="videor" href="'.get_permalink().'"><img src="'.get_template_directory_uri().'/timthumb.php?src='.$strResult[1][0].'&w='.zm_get_option('img_v_w').'&h='.zm_get_option('img_v_h').'&zc=1" ';
					echo ' alt="'.$post->post_title .'" /><i class="fa fa-play-circle-o"></i></a>';
					} else { 
						$random = mt_rand(1, 20);
						echo '<a class="videor" href="'.get_permalink().'"><img src="'.get_template_directory_uri().'/img/random/'. $random .'.jpg" ';
						echo ' alt="'.$post->post_title .'" /><i class="fa fa-play-circle-o"></i></a>';
					}
			}
	}
}

function tao_thumbnail() {
		global $post;
		$url = get_post_meta($post->ID, 'taourl', true);
		if ( get_post_meta($post->ID, 'thumbnail', true) ) {
		$image = get_post_meta($post->ID, 'thumbnail', true);
		echo '<a href="'.esc_url( get_permalink() ).'"><img src=';
		echo $image;
		echo ' /></a>';
    } else {
	    $content = $post->post_content;
	    preg_match_all('/<img.*?(?: |\\t|\\r|\\n)?src=[\'"]?(.+?)[\'"]?(?:(?: |\\t|\\r|\\n)+.*?)?>/sim', $content, $strResult, PREG_PATTERN_ORDER);
	    $n = count($strResult[1]);
	    if($n > 0){
			echo '<a href="'.get_permalink().'"><img src="'.get_template_directory_uri().'/timthumb.php?src='.$strResult[1][0].'&w='.zm_get_option('img_t_w').'&h='.zm_get_option('img_t_h').'&zc=1" alt="'.$post->post_title .'" /></a>';
	    }
	}
}

function tao_thumbnail_h() {
		global $post;
		$url = get_post_meta($post->ID, 'taourl', true);
		if ( get_post_meta($post->ID, 'thumbnail', true) ) {
		$image = get_post_meta($post->ID, 'thumbnail', true);
		echo '<div class="load"><a href="'.esc_url( get_permalink() ).'"><img src="' . get_template_directory_uri() . '/img/loading.png" data-original=';
		echo $image;
		echo ' /></a></div>';
    } else {
	    $content = $post->post_content;
	    preg_match_all('/<img.*?(?: |\\t|\\r|\\n)?src=[\'"]?(.+?)[\'"]?(?:(?: |\\t|\\r|\\n)+.*?)?>/sim', $content, $strResult, PREG_PATTERN_ORDER);
	    $n = count($strResult[1]);
	    if($n > 0){
			echo '<div class="load"><a href="'.get_permalink().'"><img src="' . get_template_directory_uri() . '/img/loading.png" data-original="'.get_template_directory_uri().'/timthumb.php?src='.$strResult[1][0].'&w='.zm_get_option('img_t_w').'&h='.zm_get_option('img_t_h').'&zc=1" alt="'.$post->post_title .'" /></a></div>';
	    }
	}
}


function format_image_thumbnail() {
    global $post;
	$content = $post->post_content;
	preg_match_all('/<img.*?(?: |\\t|\\r|\\n)?src=[\'"]?(.+?)[\'"]?(?:(?: |\\t|\\r|\\n)+.*?)?>/sim', $content, $strResult, PREG_PATTERN_ORDER);
	echo '<div class="f4"><div class="format-img"><a href="'.get_permalink().'"><img src="'.get_template_directory_uri().'/timthumb.php?src='.$strResult[1][0].'&w='.zm_get_option('img_w').'&h='.zm_get_option('img_h').'&zc=1" alt="'.$post->post_title .'" /></a></div></div>';
	echo '<div class="f4"><div class="format-img"><a href="'.get_permalink().'"><img src="'.get_template_directory_uri().'/timthumb.php?src='.$strResult[1][1].'&w='.zm_get_option('img_w').'&h='.zm_get_option('img_h').'&zc=1" alt="'.$post->post_title .'" /></a></div></div>';
	echo '<div class="f4"><div class="format-img"><a href="'.get_permalink().'"><img src="'.get_template_directory_uri().'/timthumb.php?src='.$strResult[1][2].'&w='.zm_get_option('img_w').'&h='.zm_get_option('img_h').'&zc=1" alt="'.$post->post_title .'" /></a></div></div>';
	echo '<div class="f4"><div class="format-img"><a href="'.get_permalink().'"><img src="'.get_template_directory_uri().'/timthumb.php?src='.$strResult[1][3].'&w='.zm_get_option('img_w').'&h='.zm_get_option('img_h').'&zc=1" alt="'.$post->post_title .'" /></a></div></div>';
}

function format_image_thumbnail_h() {
    global $post;
	$content = $post->post_content;
	preg_match_all('/<img.*?(?: |\\t|\\r|\\n)?src=[\'"]?(.+?)[\'"]?(?:(?: |\\t|\\r|\\n)+.*?)?>/sim', $content, $strResult, PREG_PATTERN_ORDER);
	echo '<div class="f4"><div class="format-img"><div class="load"><a href="'.get_permalink().'"><img src="' . get_template_directory_uri() . '/img/loading.png" data-original="'.get_template_directory_uri().'/timthumb.php?src='.$strResult[1][0].'&w='.zm_get_option('img_w').'&h='.zm_get_option('img_h').'&zc=1" alt="'.$post->post_title .'" /></a></div></div></div>';
	echo '<div class="f4"><div class="format-img"><div class="load"><a href="'.get_permalink().'"><img src="' . get_template_directory_uri() . '/img/loading.png" data-original="'.get_template_directory_uri().'/timthumb.php?src='.$strResult[1][1].'&w='.zm_get_option('img_w').'&h='.zm_get_option('img_h').'&zc=1" alt="'.$post->post_title .'" /></a></div></div></div>';
	echo '<div class="f4"><div class="format-img"><div class="load"><a href="'.get_permalink().'"><img src="' . get_template_directory_uri() . '/img/loading.png" data-original="'.get_template_directory_uri().'/timthumb.php?src='.$strResult[1][2].'&w='.zm_get_option('img_w').'&h='.zm_get_option('img_h').'&zc=1" alt="'.$post->post_title .'" /></a></div></div></div>';
	echo '<div class="f4"><div class="format-img"><div class="load"><a href="'.get_permalink().'"><img src="' . get_template_directory_uri() . '/img/loading.png" data-original="'.get_template_directory_uri().'/timthumb.php?src='.$strResult[1][3].'&w='.zm_get_option('img_w').'&h='.zm_get_option('img_h').'&zc=1" alt="'.$post->post_title .'" /></a></div></div></div>';
}