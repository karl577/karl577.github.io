<div id="login">
	<?php get_currentuserinfo();global $current_user, $user_ID, $user_identity;	if( !$user_ID || '' == $user_ID ) { ?>
		<div class="login-t">用户登录</div>
		<form action="<?php echo wp_login_url( get_permalink() ); ?>" method="post" id="loginform">
			<input type="username" type="text"  name="log" id="log" placeholder="名称" required/>
			<input type="password" name="pwd" id="pwd" placeholder="密码" required/>
			<input type="submit" id="submit" value="登录">
			<input type="hidden" name="redirect_to" value="<?php echo $_SERVER[ 'REQUEST_URI' ]; ?>" />
			<label><input type="checkbox" name="rememberme" id="modlogn_remember" value="yes"  checked="checked" alt="Remember Me" >自动登录</label>
			<a href="<?php echo esc_url( home_url('/') ); ?>wp-login.php?action=lostpassword">&nbsp;&nbsp;忘记密码？</a>
			<?php if ( zm_get_option('reg_url') == '' ) { ?><?php } else { ?><a href="<?php echo stripslashes( zm_get_option('reg_url') ); ?>" target="_blank"> 立即注册</a><?php } ?>
		</form>
	<?php } ?>
	<?php global $user_identity,$user_level;get_currentuserinfo();if ($user_identity) { ?>
		<div class="login-t">网站管理</div>
		<div class="login-user">
			<?php global $current_user;	get_currentuserinfo();
				echo get_avatar( $current_user->user_email, 64);
			?>
			登录者：<?php echo $user_identity; ?><br/>
			<?php if (current_user_can('level_10') ){ ?><?php wp_register('', ''); ?><br/><?php } ?>
			<a href="<?php echo wp_logout_url( home_url() ); ?>" title=""> 退出</a>
		</div>
	 <?php } ?>
	<div class="login-b"></div>
</div>