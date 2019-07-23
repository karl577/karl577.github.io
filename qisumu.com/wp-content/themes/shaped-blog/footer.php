    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <hr>
            </div>
        </div>
    </div>
    <footer class="site-footer" role="contentinfo">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-center">
  
                    <p><?php
                        $copyright = get_theme_mod('shaped_blog_footer_copyright');
                        $allowed_tags = array(
                            'strong' => array(),
                            'a' => array(
                                'href' => array(),
                                'title' => array()
                            )
                        );
                     echo wp_kses( $copyright, $allowed_tags ); ?></p>
                    
                    <?php if (!get_theme_mod('shaped_blog_footer_social_check' )) : ?>
                        <div class="footer-social-icons">
                            <?php if (get_theme_mod('shaped_blog_facebook')) : ?>
                                <a class="btn btn-social" href="<?php echo esc_url(get_theme_mod('shaped_blog_facebook')); ?>"><i class="fa fa-facebook"></i></a>
                            <?php endif; ?>
                            <?php if (get_theme_mod('shaped_blog_twitter')) : ?>
                                <a class="btn btn-social" href="<?php echo esc_url(get_theme_mod('shaped_blog_twitter')); ?>"><i class="fa fa-twitter"></i></a>
                            <?php endif; ?>
                            <?php if (get_theme_mod('shaped_blog_google')) : ?>
                                <a class="btn btn-social" href="<?php echo esc_url(get_theme_mod('shaped_blog_google')); ?>"><i class="fa fa-google-plus"></i></a>
                            <?php endif; ?>
                            <?php if (get_theme_mod('shaped_blog_youtube')) : ?>
                                <a class="btn btn-social" href="<?php echo esc_url(get_theme_mod('shaped_blog_youtube')); ?>"><i class="fa fa-youtube"></i></a>
                            <?php endif; ?>
                            <?php if (get_theme_mod('shaped_blog_skype')) : ?>
                                <a class="btn btn-social" href="<?php echo esc_url(get_theme_mod('shaped_blog_skype')); ?>"><i class="fa fa-skype"></i></a>
                            <?php endif; ?>
                            <?php if (get_theme_mod('shaped_blog_pinterest')) : ?>
                                <a class="btn btn-social" href="<?php echo esc_url(get_theme_mod('shaped_blog_pinterest')); ?>"><i class="fa fa-pinterest"></i></a>
                            <?php endif; ?>
                            <?php if (get_theme_mod('shaped_blog_flickr')) : ?>
                                <a class="btn btn-social" href="<?php echo esc_url(get_theme_mod('shaped_blog_flickr')); ?>"><i class="fa fa-flickr"></i></a>
                            <?php endif; ?>
                            <?php if (get_theme_mod('shaped_blog_linkedin')) : ?>
                                <a class="btn btn-social" href="<?php echo esc_url(get_theme_mod('shaped_blog_linkedin')); ?>"><i class="fa fa-linkedin"></i></a>
                            <?php endif; ?>
                            <?php if (get_theme_mod('shaped_blog_vimeo')) : ?>
                                <a class="btn btn-social" href="<?php echo esc_url(get_theme_mod('shaped_blog_vimeo')); ?>"><i class="fa fa-vimeo-square"></i></a>
                            <?php endif; ?>
                            <?php if (get_theme_mod('shaped_blog_instagram')) : ?>
                                <a class="btn btn-social" href="<?php echo esc_url(get_theme_mod('shaped_blog_instagram')); ?>"><i class="fa fa-instagram"></i></a>
                            <?php endif; ?>
                            <?php if (get_theme_mod('shaped_blog_dribbble')) : ?>
                                <a class="btn btn-social" href="<?php echo esc_url(get_theme_mod('shaped_blog_dribbble')); ?>"><i class="fa fa-dribbble"></i></a>
                            <?php endif; ?>
                            <?php if (get_theme_mod('shaped_blog_tumblr')) : ?>
                                <a class="btn btn-social" href="<?php echo esc_url(get_theme_mod('shaped_blog_tumblr')); ?>"><i class="fa fa-tumblr"></i></a>
                            <?php endif; ?>
                            
                        </div>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </footer>

    <?php if (!get_theme_mod('shaped_blog_back_to_top')): ?>
        <div class="scroll-up">
            <a href="#"><i class="fa fa-angle-up"></i></a>
        </div>
    <?php endif; ?>
    <!-- Scroll Up -->

    <?php wp_footer();?>
    </body>
</html>