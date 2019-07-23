<?php

// loads the shortcodes class, wordpress is loaded with it
require_once( 'shortcodes_class.php' );

// get popup type
$popup = trim( $_GET['popup'] );
$shortcode = new dot_shortcodes( $popup );

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><!-- qisumu.com Baidu tongji analytics -->
<script>
var _hmt = _hmt || [];
(function() {
var hm = document.createElement("script");
hm.src = "https://hm.baidu.com/hm.js?cd8191d648355b940efdb3f1ba7fb3a0";
var s = document.getElementsByTagName("script")[0];
s.parentNode.insertBefore(hm, s);
})();
</script>
</head>
<body>
<div id="dot-popup">

	<div id="dot-shortcode-wrap">
		
		<div id="dot-sc-form-wrap">
		
			<div id="dot-sc-form-head">
			
				<?php echo $shortcode->popup_title; ?>
			
			</div>
			<!-- /#dot-sc-form-head -->
			
			<form method="post" id="dot-sc-form">
			
				<table id="dot-sc-form-table">
				
					<?php echo $shortcode->output; ?>
					
					<tbody>
						<tr class="form-row">
							<?php if( ! $shortcode->has_child ) : ?><td class="label">&nbsp;</td><?php endif; ?>
							<td class="field"><a href="#" class="button-primary dot-insert">Insert Shortcode</a></td>							
						</tr>
					</tbody>
				
				</table>
				<!-- /#dot-sc-form-table -->
				
			</form>
			<!-- /#dot-sc-form -->
		
		</div>
		<!-- /#dot-sc-form-wrap -->
		
		<div id="dot-sc-preview-wrap">
		
			<div id="dot-sc-preview-head">
		
				Shortcode Preview
					
			</div>
			<!-- /#dot-sc-preview-head -->
			
			<?php if( $shortcode->no_preview ) : ?>
			<div id="dot-sc-nopreview">Shortcode has no preview</div>		
			<?php else : ?>			
			<iframe src="<?php echo TINYMCE_URI; ?>/preview.php?sc=" width="249" frameborder="0" id="dot-sc-preview"></iframe>
			<?php endif; ?>
			
		</div>
		<!-- /#dot-sc-preview-wrap -->
		
		<div class="clear"></div>
		
	</div>
	<!-- /#dot-shortcode-wrap -->

</div>
<!-- /#dot-popup -->

</body>
</html>