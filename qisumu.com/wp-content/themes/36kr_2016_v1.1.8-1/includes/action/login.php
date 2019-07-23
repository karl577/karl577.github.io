<?php 
require( dirname(__FILE__) . '/../../../../../wp-load.php' ); 
if($_POST['action']){ 
	$action = $_POST['action'];
	if($action == 'mobantu_login'){
		$username = $wpdb->escape($_POST['usr']);   
    	$password = $wpdb->escape($_POST['pwd']);   
		$login_data = array();   
		$login_data['user_login'] = $username;   
		$login_data['user_password'] = $password; 
		$login_data['remember'] = false;   
		if($_POST['rememberme'] == 'forever') 
			$login_data['remember'] = true;   
		
		$user_verify = wp_signon( $login_data, false );  
		if ( is_wp_error($user_verify) ) {    
			echo "0";   
		} else {    
			echo "1";
		}  
	}elseif($action == 'mobantu_register'){
		$sanitized_user_login = sanitize_user( $_POST['user_register'] );
    	$user_email = apply_filters( 'user_registration_email', $_POST['user_email'] );
		
		if ( $sanitized_user_login == '' ) {
			$error .= '请输入用户名 ';
		  } elseif ( ! validate_username( $user_login ) ) {
			$error .= '此用户名包含无效字符，请输入有效的用户名 ';
			$sanitized_user_login = '';
		  } elseif ( username_exists( $sanitized_user_login ) ) {
			$error .= '该用户名已被注册 ';
		  }
		
		  if ( $user_email == '' ) {
			$error .= '请填写电子邮件地址 ';
		  } elseif ( ! is_email( $user_email ) ) {
			$error .= '电子邮件地址不正确 ';
			$user_email = '';
		  } elseif ( email_exists( $user_email ) ) {
			$error .= '该电子邮件地址已经被注册 ';
		  }
		  
		  if($_POST['password'] == '') $error .= '请输入密码 ';
		  elseif(strlen($_POST['password']) < 6) $error .= '密码长度不得小于6位 ';
		  
		  if(empty($_POST['captcha']) || empty($_SESSION['MBT_monkey_captcha']) || trim(strtolower($_POST['captcha'])) != $_SESSION['MBT_monkey_captcha']){
		  	  $error .= '验证码错误 ';
		  }
		  unset($_SESSION['MBT_monkey_captcha']);
		  
		  if($error){ echo $error;}
		  else{
		  	$new_password = $_POST['password'];
		  	$userdata=array(
			  'ID' => '',
			  'user_login' => $sanitized_user_login,
			  'user_pass' => $new_password,
			  'user_email' => $user_email,
			  'role' => get_option('default_role'),
			);
			$user_id = wp_insert_user( $userdata );
			if ( is_wp_error( $user_id ) ) {
				echo "系统超时，请稍后重试";
			}else{
				wp_set_auth_cookie($user_id,true,false);
				//wp_set_password( $new_password, $user_id ); 
				$message = __('注册成功！') . "\r\n\r\n";   
				$message .= sprintf(__('用户名: %s'), $sanitized_user_login) . "\r\n\r\n";   
				$message .= sprintf(__('密码: %s'), $new_password) . "\r\n\r\n";   
				wp_mail($user_email, '用户注册-'.get_bloginfo('name'), $message);    
				echo "1";
			}
		  }
	}
	
}
?>
