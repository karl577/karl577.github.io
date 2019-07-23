<?php
/*
Template Name: 注册/登陆
*/
?>
<?php
$log = $_GET['log'];
$laiyuan = $_GET['form'];
$account = get_option('mao10_account');
if( !empty($_POST['ludou_reg1']) ) {
  $error1 = '';
  $sanitized_user_login = sanitize_user( $_POST['user_login'] );

  $user_login = $_POST['user_login'];
	$user_pass = $_POST['user_pass'];
	if ( !user_pass_ok( $user_login, $user_pass )) {
		  $error1 .= '用户名与密码不符，请重新填写。';
	}
  
  if($error1 == '') {
    if (!is_user_logged_in()) {
      $user = get_userdatabylogin($sanitized_user_login);
      $user_id = $user->ID;
  
      // 自动登录
      wp_set_current_user($user_id, $user_login);
      wp_set_auth_cookie($user_id);
      do_action('wp_login', $user_login);
    }
  }
};
if( !empty($_POST['ludou_reg2']) ) {
  $error2 = '';
  $sanitized_user_login = sanitize_user( $_POST['user_login'] );
  $user_email = apply_filters( 'user_registration_email', $_POST['user_email'] );

  // Check the username
  if ( $sanitized_user_login == '' ) {
    $error2 .= '<strong>错误</strong>：请输入用户名。<br />';
  } elseif ( ! validate_username( $user_login ) ) {
    $error2 .= '<strong>错误</strong>：此用户名包含无效字符，请输入有效的用户名<br />。';
    $sanitized_user_login = '';
  } elseif ( username_exists( $sanitized_user_login ) ) {
    $error2 .= '<strong>错误</strong>：该用户名已被注册，请再选择一个。<br />';
  }

  // Check the e-mail address
  if ( $user_email == '' ) {
    $error2 .= '<strong>错误</strong>：请填写电子邮件地址。<br />';
  } elseif ( ! is_email( $user_email ) ) {
    $error2 .= '<strong>错误</strong>：电子邮件地址不正确。！<br />';
    $user_email = '';
  } elseif ( email_exists( $user_email ) ) {
    $error2 .= '<strong>错误</strong>：该电子邮件地址已经被注册，请换一个。<br />';
  }
    
  // Check the password
  if(strlen($_POST['user_pass']) < 6)
    $error2 .= '<strong>错误</strong>：密码长度至少6位!<br />';
  elseif($_POST['user_pass'] != $_POST['user_pass2'])
    $error2 .= '<strong>错误</strong>：两次输入的密码必须一致!<br />';
      
    if($error2 == '') {
    $user_id = wp_create_user( $sanitized_user_login, $_POST['user_pass'], $user_email );
    
    if ( ! $user_id ) {
      $error .= sprintf( '<strong>错误</strong>：无法完成您的注册请求... 请联系<a href=\"mailto:%s\">管理员</a>！<br />', get_option( 'admin_email' ) );
    }
    else if (!is_user_logged_in()) {
      $user = get_userdatabylogin($sanitized_user_login);
      $user_id = $user->ID;
      
      /*
      $xck = wp_insert_term(
		get_the_author_meta('user_login',$user_id).'的小仓库','category',array('slug' => get_the_author_meta('user_login',$user_id))
	  );
	  */
	  
	  //达人页面生成
	  global $wpdb;
	  $last_post = $wpdb->get_var("SELECT post_date FROM $wpdb->posts WHERE post_type = 'daren' ORDER BY post_date DESC LIMIT 1");
	  
	  $tougao_sjs = array(
	      'post_title' => get_the_author_meta( 'user_login',$user_id),
	      'post_author' => $user_id,
	      'post_type' => 'daren',
	      'post_status' => 'publish',
	  );
	  $status_sjs = wp_insert_post( $tougao_sjs );
	  if ($status_sjs != 0) { 
	  	$touxiang = get_the_author_meta( 'touxiang',$user_id);
	  	add_post_meta($status_sjs, 'fmimg_value', $touxiang,TRUE);
	  };
	  
	  //默认小仓库生成
	  global $wpdb;
	  $last_post = $wpdb->get_var("SELECT post_date FROM $wpdb->posts WHERE post_type = 'cangku' ORDER BY post_date DESC LIMIT 1");
	  
	  $tougao_cangku = array(
	      'post_title' => get_the_author_meta( 'user_login',$user_id),
	      'post_author' => $user_id,
	      'post_type' => 'cangku',
	      'post_status' => 'publish',
	  );
	  $status_cangku = wp_insert_post( $tougao_cangku );
	  if ($status_cangku != 0) { 
	  	$touxiang = get_the_author_meta( 'touxiang',$user_id);
	  	add_post_meta($status_cangku, 'fmimg_value', $touxiang,TRUE);
	  	  update_user_meta($user_id, 'album', $status_cangku);
	      wp_update_user( array (
	      	'ID' => $user_id,
	      	'album' => $status_cangku
	      ) ) ;
	  };
  
      // 自动登录
      wp_set_current_user($user_id, $user_login);
      wp_set_auth_cookie($user_id);
      update_user_meta($user_id, 'user_nicename', $user_id);
      do_action('wp_login', $user_login);
    }
  }
}
?>
<?php get_header(); ?>
<div class="w960">
<div id="content-post">
	<?php if (!is_user_logged_in()) { ?>
	<div class="single-bottom-tab" id="single-bottom-tab-1">
	<div id="loginform">
		<h2><dt></dt><dd>登陆</dd></h2>
		<form name="loginform" action="<?php echo home_url(add_query_arg(array(),$wp->request)); ?>" method="post">
		<dl>
			<dt>用户名</dt>
			<dd>
				<input class="input" type="text"  name="user_login" id="regUserAccount" maxLength="30"  value="" onkeyup="value=value.replace(/[^\w\.\/]/ig,'')" />
			</dd>
		</dl>
		<dl>
			<dt>密码</dt>
			<dd>
				<input class="input"  type="password" name="user_pass" id="regPwd"  value="" />
			</dd>
		</dl>
		<dl class="nomargin">
			<dt>&nbsp</dt>
			<dd><a href="<?php bloginfo('url'); ?>/wp-login.php?action=lostpassword">忘记密码</a></dd>
		</dl>
		<dl>
			<dt>&nbsp</dt>
			<dd><input type="submit" class="submit" value="登陆" /></dd>
		</dl>
		<input type="hidden" name="ludou_reg1" value="ok" />
		</form>
		<?php if(!empty($error1)) { 
		echo '<p class="look">'.$error1.'</p>';
		} ?>
	</div>
	</div>
	<div class="single-bottom-tab" id="single-bottom-tab-2">
	<div id="registerform">
		<h2><dt></dt><dd>注册</dd></h2>
		<form name="registerform" action="<?php echo home_url(add_query_arg(array(),$wp->request)); ?>" method="post">
		<dl>
			<dt>用户名 <span>*</span></dt>
			<dd>
				<input class="input" type="text"  name="user_login" id="regUserAccount" maxLength="30"  value="" onkeyup="value=value.replace(/[^\w\.\/]/ig,'')" />
			</dd>
		</dl>
		<dl class="nomargin">
			<dt>&nbsp;</dt>
			<dd>
				<p style="color:#e60012;">*用户名只可为英文和数字，不可使用中文及特殊字符。登陆后可设置中文昵称。</p>
			</dd>
		</dl>
		<dl>
			<dt>Email <span>*</span></dt>
			<dd>
				<input class="input" type="text"  name="user_email" id="user_email" maxLength="30"  value="" />
			</dd>
		</dl>
		<dl>
			<dt>密码 <span>*</span></dt>
			<dd>
				<input class="input"  type="password" name="user_pass" id="regPwd"  value="" />
			</dd>
		</dl>
		<dl>
			<dt>确认密码 <span>*</span></dt>
			<dd>
				<input class="input"  type="password" name="user_pass2" id="regPwd2"  value="" />
			</dd>
		</dl>
		<dl>
			<dt>&nbsp;</dt>
			<dd>
				<input type="submit" class="submit" value="注册" />
			</dd>
		</dl>
		<input type="hidden" name="ludou_reg2" value="ok" />
		</form>
		<?php if(!empty($error2)) { 
		echo '<p style="color:#f00;">'.$error2.'</p>';
		} ?>
	</div>
	</div>
	<?php } else { ?>
	<script language=javascript>window.location.href="<?php if($laiyuan) echo $laiyuan; elseif($account) echo $account; else bloginfo('url'); ?>"</script> 
	<div id="loginnow"><h2>正在登陆</h2><p>如果您的浏览器不支持跳转,<a style="text-decoration: none" href="<?php bloginfo('url'); ?>"><font color="#f00">请点这里</font></a>.</p></div>
	<?php } ?>
	<div class="c"></div>
</div>
</div>
<?php get_footer(); ?>