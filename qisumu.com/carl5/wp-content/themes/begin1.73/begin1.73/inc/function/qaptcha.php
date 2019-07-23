<?php

function Qaptcha_footer() {
	if (is_singular()) {
		$url = get_bloginfo("template_url");
		$outer.= '<script type="text/javascript" src="' . $url . '/js/jquery-ui.min.js"></script>'."\n";
		$outer.= '<script type="text/javascript" src="' . $url . '/js/qaptcha.jquery.js"></script>'."\n";
		$outer.= '<script type="text/javascript">var QaptchaJqueryPage="' . $url . '/inc/function/qaptcha.jquery.php"</script>'."\n";
		$outer.= '
		<script type="text/javascript">
		$(document).ready(function(){
			$(\'.qaptcha\').QapTcha({disabledSubmit:true,autoRevert:true});});
		</script>'."\n";
		echo $outer;
	}
}

function Qaptcha_comment($comment) {
	if(!session_id()) session_start();
	if ( isset($_SESSION['qaptcha']) && $_SESSION['qaptcha']) {
		unset($_SESSION['qaptcha']);
		return($comment);
	} else {
		if (isset($_POST['isajaxtype']) && $_POST['isajaxtype'] > -1) {
			die("请滑动滚动条解锁");
		} else {
			if(function_exists('err'))
				err("请滑动滚动条解锁");
			else
				err("请滑动滚动条解锁");
		}
	}
}
if ( !is_admin() ) {
add_action('wp_footer', 'Qaptcha_footer');
add_action('preprocess_comment', 'Qaptcha_comment');
}
?>