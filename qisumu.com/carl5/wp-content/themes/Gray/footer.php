<div class="clearfix"></div>
<div class="stepwizard" style="margin-top:40px;">
	    <div class="stepwizard-row">
	    	<?php $result2 = mysql_query("select * from wp_term_taxonomy where taxonomy = 'category' ORDER BY term_taxonomy_id DESC limit 0,6");  while ($row=mysql_fetch_array($result2)) { ?>
	        <div class="stepwizard-step">
	            <a href="<?php echo get_category_link(''. $row['term_id'] .'') ?>"><button type="button" class="btn btn-default btn-circle"></button></a>
	            <a href="<?php echo get_category_link(''. $row['term_id'] .'') ?>"><p><?php echo get_cat_name(''. $row['term_id'] .'') ?></p></a>
	        </div>
	        <?php } ?>
	    </div>
    </div>
<div class="clearfix"></div>

</div>
	</div>
	<div class="container visible-lg" id="footer" style="text-align:center; padding: 20px 0px; margin-top:20px;">
       <p style="color:#666;">
          Copyright © 2014 <?php bloginfo('name'); ?>. All Rights Reserved  Powered by WordPress. Designed By <a href="http://www.mao01.com" title="wordpress主题定制">猫猫建站</a>  <a href="http://www.v7v3.com">wordpress主题</a>
        </p>
    </div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="<?php bloginfo('template_directory'); ?>/js/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="<?php bloginfo('template_directory'); ?>/js/bootstrap.min.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/cat.js"></script>
</body>
</html>