<div id="user-profile">
<?php
	global $user_identity,$user_level;
	get_currentuserinfo();
	if ($user_identity) { ?>
	  欢迎回来！<?php echo $user_identity; ?>
		<?php if ( zm_get_option('user_url') == '' ) { ?>
		<?php } else { ?>
	  		<a href="<?php echo get_permalink( zm_get_option('user_url') ); ?>" target="_blank">用户中心</a>
	  	<?php } ?>
	<?php } else { ?>
		<?php if ( zm_get_option('reg_url') == '' ) { ?>
			<?php echo stripslashes( zm_get_option('wel_come') ); ?>
		<?php } else { ?>
			<a href="<?php echo stripslashes( zm_get_option('reg_url') ); ?>" target="_blank">立即注册</a>
		<?php } ?>
	<?php } ?>

	<?php if (zm_get_option('login')) { ?>
		<?php if ( current_user_can('level_10') ){ ?>
			<span class="nav-set">
			 	<span class="nav-login">
			 	<?php if ( is_user_logged_in()){ ?>
					<a href="#login" class="flatbtn" id="login-main" >管理</a>
				<?php } else { ?>
				<a href="#login" class="flatbtn" id="login-main" >登录</a>
				<?php } ?>
				</span>
			</span>
		<?php } else { ?>
			<?php if (zm_get_option('user_l')) { ?>
				<span class="nav-set">
				 	<span class="nav-login">
				 	<?php if ( is_user_logged_in()){ ?>
				 	<a href="<?php echo wp_logout_url( home_url() ); ?>" title=""> 退出</a>
					<?php } else { ?>
					<a href="<?php echo wp_login_url(  home_url() ); ?>" title="Login">登录</a>
					<?php } ?>
					</span>
				</span>
			<?php } else { ?>
				<span class="nav-set">
				 	<span class="nav-login">
				 	<?php if ( is_user_logged_in()){ ?>
				 	<a href="<?php echo wp_logout_url( home_url() ); ?>" title=""> 退出</a>
					<?php } else { ?>
					<a href="#login" class="flatbtn" id="login-main" >登录</a>
					<?php } ?>
					</span>
				</span>
			<?php } ?>
		<?php } ?>
	<?php } ?>
	<?php if (zm_get_option('weibo_t')) { get_template_part( 'inc/weibo' ); } ?>
</div>