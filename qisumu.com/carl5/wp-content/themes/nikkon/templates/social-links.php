<?php
if( get_theme_mod( 'nikkon-social-email' ) ) :
    echo '<a href="' . esc_url( 'mailto:' . antispambot( get_theme_mod( 'nikkon-social-email' ), 1 ) ) . '" title="' . esc_attr__( 'Send Us an Email', 'nikkon' ) . '" class="social-icon social-email"><i class="fa fa-envelope-o"></i></a>';
endif;

if( get_theme_mod( 'nikkon-social-skype' ) ) :
    echo '<a href="skype:' . esc_html( get_theme_mod( 'nikkon-social-skype' ) ) . '?userinfo" title="' . esc_attr__( 'Contact Us on Skype', 'nikkon' ) . '" class="social-icon social-skype"><i class="fa fa-skype"></i></a>';
endif;

if( get_theme_mod( 'nikkon-social-facebook' ) ) :
    echo '<a href="' . esc_url( get_theme_mod( 'nikkon-social-facebook' ) ) . '" target="_blank" title="' . esc_attr__( 'Find Us on Facebook', 'nikkon' ) . '" class="social-icon social-facebook"><i class="fa fa-facebook"></i></a>';
endif;

if( get_theme_mod( 'nikkon-social-twitter' ) ) :
    echo '<a href="' . esc_url( get_theme_mod( 'nikkon-social-twitter' ) ) . '" target="_blank" title="' . esc_attr__( 'Follow Us on Twitter', 'nikkon' ) . '" class="social-icon social-twitter"><i class="fa fa-twitter"></i></a>';
endif;

if( get_theme_mod( 'nikkon-social-linkedin' ) ) :
    echo '<a href="' . esc_url( get_theme_mod( 'nikkon-social-linkedin' ) ) . '" target="_blank" title="' . esc_attr__( 'Find Us on LinkedIn', 'nikkon' ) . '" class="social-icon social-linkedin"><i class="fa fa-linkedin"></i></a>';
endif;

if( get_theme_mod( 'nikkon-social-tumblr' ) ) :
    echo '<a href="' . esc_url( get_theme_mod( 'nikkon-social-tumblr' ) ) . '" target="_blank" title="' . esc_attr__( 'Find Us on Tumblr', 'nikkon' ) . '" class="social-icon social-tumblr"><i class="fa fa-tumblr"></i></a>';
endif;

if( get_theme_mod( 'nikkon-social-flickr' ) ) :
    echo '<a href="' . esc_url( get_theme_mod( 'nikkon-social-flickr' ) ) . '" target="_blank" title="' . esc_attr__( 'Find Us on Flickr', 'nikkon' ) . '" class="social-icon social-flickr"><i class="fa fa-flickr"></i></a>';
endif;
