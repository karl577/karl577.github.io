</div>
<!-- End #content -->
	</div>
	<!-- End #wrapper -->
	<!-- Begin #footer -->
	<div id="footer">
		<div id="footerInner">
		<?php if ( ! dynamic_sidebar( 'footer' ) ) :
			  endif; ?>
				<!-- BEGIN COPYRIGHT -->
		<div id="copyright">
			<?php if (get_option('journal_copyright') <> ""){
				echo stripslashes(stripslashes(get_option('journal_copyright')));
				}else{
					echo '马上去主题管理加上你的版权声明吧，添加后将自动替换成你的声明！！！';
				}?> 
				
		</div>
		<!-- END COPYRIGHT -->	
		</div>
	</div>
	<!-- End #footer -->
</div>
<?php if (get_option('journal_analytics') <> "") { 
		echo stripslashes(stripslashes(get_option('journal_analytics'))); 
	} ?>
<?php wp_footer(); ?>
<!--[if IE 6]>
	<script type="text/javascript" src="http://letskillie6.googlecode.com/svn/trunk/letskillie6.zh_CN.pack.js"></script>
</body>
</html>
