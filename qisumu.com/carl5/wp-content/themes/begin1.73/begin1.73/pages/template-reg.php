<?php
/*
Template Name: 用户注册
*/
?>
<?php
	if( !empty($_POST['user_reg']) ) {
		$error = '';
		$sanitized_user_login = sanitize_user( $_POST['user_login'] );
		$user_email = apply_filters( 'user_registration_email', $_POST['user_email'] );

  // 检查名称
	if ( $sanitized_user_login == '' ) {
		$error .= '<strong>错误</strong>：请输入用户名。<br />';
	} elseif ( ! validate_username( $sanitized_user_login ) ) {
		$error .= '<strong>错误</strong>：此用户名包含无效字符，请输入有效的用户名<br />。';
		$sanitized_user_login = '';
	} elseif ( username_exists( $sanitized_user_login ) ) {
		$error .= '<strong>错误</strong>：该用户名已被注册，请再选择一个。<br />';
	}

  // 检查邮件
	if ( $user_email == '' ) {
		$error .= '<strong>错误</strong>：请填写电子邮件地址。<br />';
	} elseif ( ! is_email( $user_email ) ) {
		$error .= '<strong>错误</strong>：电子邮件地址不正确。！<br />';
		$user_email = '';
	} elseif ( email_exists( $user_email ) ) {
		$error .= '<strong>错误</strong>：该电子邮件地址已经被注册，请换一个。<br />';
	}
   
  // 检查密码
	if(strlen($_POST['user_pass']) < 6)
		$error .= '<strong>错误</strong>：密码长度至少6位!<br />';
		elseif($_POST['user_pass'] != $_POST['user_pass2'])
		$error .= '<strong>错误</strong>：两次输入的密码必须一致!<br />';
     
	if($error == '') {
			$user_id = wp_create_user( $sanitized_user_login, $_POST['user_pass'], $user_email );
	   
		if ( ! $user_id ) {
			$error .= sprintf( '<strong>错误</strong>：无法完成您的注册请求... 请联系<a href=\"mailto:%s\">管理员</a>！<br />', get_option( 'admin_email' ) );
		}
		else if (!is_user_logged_in()) {
			$user = get_userdatabylogin($sanitized_user_login);
			$user_id = $user->ID;
	 
	      // 自动登录
			wp_set_current_user($user_id, $user_login);
			wp_set_auth_cookie($user_id);
			do_action('wp_login', $user_login);
		}
	}
}
?>
<?php get_header(); ?>

<style type="text/css">
body{
	background: url('http://ww1.sinaimg.cn/large/703be3b1jw1ew0wrzdyguj21hc0u0tcy.jpg');
	width:100%;
	height:100%;
	-moz-background-size: 100% 100%;
	-o-background-size: 100% 100%;
	-webkit-background-size: 100% 100%;
	background-size: 100% 100%;
}
#primary {
	width: 100%;
	height: 700px;
	box-shadow: none;
}
#primary .page {
	background: transparent !important;
	padding: 0 !important;
	border: none !important;
	box-shadow: none !important;
}
#primary .single-content {
	float: left;
	font-size: 16px;
	color: #fff;
	margin: 100px 0 0 14%;
	border-left: 1px solid #ccc;
}
.user_reg {
	padding: 20px;
}
.reg-page {
	position: relative;
	float: left;
	margin: 50px 0 0 14%;
}
.reg-page p {
	text-indent: 0em;
}
p.user_error {
	position: absolute;
	top: -93px;
	left: 20px;
	background: #ffebe8;
	background: rgba(255, 235, 232, 0.5);
	margin: 16px 0;
	padding: 12px;
	border: 1px solid #f3f3f3;
}
p.user_is {
	width: 300px;
	color: #fff;
	line-height: 40px;
	text-align: center;
	margin: 50px auto;
	padding: 12px;
}
.user_is a {
	background: #e73c31;
	color: #fff;
	padding: 5px 10px;
	border: 1px solid #e73c31;
	border-radius: 2px;
	-webkit-appearance: none;
}
.user_is a:hover {
	background: #fb5548;
	border: 1px solid #fb5548;
 	transition: all 0.2s ease-in 0s;
}
.user_is img {
	margin: 0 auto;
}
.user_reg label {
	color: #fff;
	cursor: pointer;
}
.user_reg .input {
	background: #fff;
	width: 260px;
	margin: 5px 0;
	padding: 5px 10px;
	border: 1px solid #ddd;
	border-radius: 2px;
	-webkit-appearance: none;
}
.reg-page #submit {
	background: #e73c31;
	font-size: 16px;
	color: #fff;
	width: 100px;
	margin: 0 10px 10px 0;
	padding: 6px;
	cursor: pointer;
	border: 1px solid #e73c31;
	border-radius: 2px;
	-webkit-appearance: none;
}
.reg-page #submit:hover {
	background: #fb5548;
	border: 1px solid #fb5548;
 	transition: all 0.2s ease-in 0s;
}
.droperror {
	color: #fff;
}
@media screen and (max-width: 800px) {
	#primary .single-content {
    display: none;
	}
	.reg-page {
		margin: 0 0 0 1%;
	}
}
</style>

<div id="primary" class="content-reg">
	<main id="main" class="site-main" role="main">
	<?php while ( have_posts() ) : the_post(); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="reg-page">
				<?php if(!empty($error)) {
					echo '<p class="user_error">'.$error.'</p>';
					}
				if (!is_user_logged_in()) { ?>
					<form name="registerform" method="post" action="<?php echo $_SERVER["REQUEST_URI"]; ?>" class="user_reg">
					    <p>
							<label for="user_login">用户名<br />
					        <input type="text" name="user_login" tabindex="1" id="user_login" class="input" placeholder="请输入用户名" value="<?php if(!empty($sanitized_user_login)) echo $sanitized_user_login; ?>" size="30" />
					      </label>
					    </p>

					    <p>
							<label for="user_email">电子邮件<br />
					        <input type="text" name="user_email" tabindex="2" id="user_email" class="input" placeholder="请输入电子邮件" value="<?php if(!empty($user_email)) echo $user_email; ?>" size="30" />
					      </label>
					    </p>

					    <p>
							<label for="user_pwd1">密码(至少6位)<br />
					        <input id="user_pwd1" class="input" tabindex="3" type="password" tabindex="21" size="30" placeholder="请输入密码(至少6位)" value="" name="user_pass" />
					      </label>
					    </p>

					    <p>
							<label for="user_pwd2">重复密码<br />
					        <input id="user_pwd2" class="input" tabindex="4" type="password" tabindex="21" size="30" placeholder="重复密码" value="" name="user_pass2" />
					      </label>
					    </p>

					   <div class="qaptcha"></div>

					    <p class="submit">
							<input type="hidden" name="user_reg" value="ok" />
					        <input id="submit" name="submit" type="submit" value="提交注册"/>
					    </p>
					</form>
				<?php } else { ?>
					<p class="user_is">
						<strong><?php echo $user_identity; ?></strong><br />
						欢迎您成为本站会员！<br/><br/>
				         <a href="<?php echo wp_logout_url( home_url() ); ?>" title="">退出</a>
						<?php
						    if (current_user_can('manage_options')) {
						        echo '&nbsp;&nbsp;<a href="' . admin_url() . '">管理站点</a>';
						    } else {
						    	echo '&nbsp;&nbsp;<a href="' . get_permalink( zm_get_option('user_url') ) . '" target="_blank">个人中心</a>';
						    }
						?>
					</p>
				<?php } ?>
			</div>

			<div class="entry-content">
				<div class="single-content">
					<?php the_content(); ?>
				</div> <!-- .single-content -->
			</div><!-- .entry-content -->
			<div class="clear"></div>
		</article><!-- #page -->
	<?php endwhile; ?>
	</main><!-- .site-main -->
</div><!-- .content-area -->

<?php get_footer(); ?> 