<?php if (function_exists('cwppos_show_review') && book_rev_lite_wpr_get_status()=="Yes") : ?>

        <div id="wrap-up" class="clearfix">
            <header>
                <h2><?php _e('Wrap Up','book-rev-lite'); ?></h2>
            </header>

            <div class="review-content">
                <div class="review-header clearfix">

                    <div class="review-info">
                        <h3><?php echo book_rev_lite_wpr_get_title(); ?></h3>
                    </div><!-- end .review-info -->

                    <div class="buy-button">
                        <a href="<?php echo book_rev_lite_wpr_get_affiliate_link(); ?>"><?php echo book_rev_lite_wpr_get_affiliate_text(); ?></a>
                    </div><!-- end .buy-button -->

                </div><!-- end .review-header -->

                <div class="review-body clearfix">
                    <div class="book-cover">
                        <div class="inner-wrap">
                            <img src="<?php echo book_rev_lite_wpr_get_product_image(); ?>">
                        </div><!-- end .inner-wrap -->
                    </div><!-- end .book-cover -->

                    <div class="review-options">
                        <ul>
							<?php foreach (book_rev_lite_wpr_get_review_options() as $option) : ?>
								<?php if(!empty($option['grade'])): ?>
		                            <li class="clearfix">
		                                <span class="grade"><?php echo $option['grade']/10; ?>/10</span>
		                                <div class="grade-bar">
		                                    <div class="bar grade <?php echo book_rev_lite_display_review_class($option['grade']/10); ?>" style="width: <?php echo $option['grade']; ?>%;"></div>
		                                </div><!-- end .grade-bar -->
		                                <span class="option-name"><?php echo $option['name']; ?></span>
		                            </li>
	                        	<?php endif; ?>
							<?php endforeach; ?>
                        </ul>
                    </div><!-- end .review-options -->
                    
                    <div class="proscons">
                        <div class="pros">
                            <h2><?php echo cwppos("cwppos_pros_text"); ?></h2>
                            <ul>
                                <?php if(book_rev_lite_wpr_get_pros()): ?>
    								<?php foreach(book_rev_lite_wpr_get_pros() as $pro) : ?>
    									<li><?php if(isset($pro)) echo $pro; ?></li>
    								<?php endforeach; ?>
                                <?php endif; ?>
                            </ul>
                        </div><!-- end .pros -->

                        <div class="cons">
                            <h2><?php echo cwppos("cwppos_cons_text"); ?></h2>
                            <ul>
                                <?php if(book_rev_lite_wpr_get_cons()): ?>
    								<?php foreach(book_rev_lite_wpr_get_cons() as $con) : ?>
    									<li><?php if(isset($con)) echo $con; ?></li>
    								<?php endforeach; ?>
                                <?php endif; ?>
                            </ul>
                        </div><!-- end .cons -->
                    </div><!-- end .procons -->
                </div><!-- end .review-body -->
            </div><!-- end .review-content -->
        </div><!-- end .wrap-up -->

<?php endif; ?>