<?php
/**
 * Includes of Monkey WordPress Theme of wazhuti.com
**/

?>
<div id="sign" class="sign">
    <div class="part loginPart">
    <form id="login" action="<?php echo get_option('home'); ?>/wp-login.php" method="post" novalidate="novalidate">
        <?php if(get_option('users_can_register')==1){ ?><div id="register-active" class="switch">还没账号？马上注册&gt;&gt;</div><?php } ?>
        <h3>登录<p class="status"></p></h3>
        <p>
            <label class="icon" for="username"><i class="fa fa-user"></i></label>
            <input class="input-control" id="username" type="text" placeholder="请输入用户名" name="username" required="" aria-required="true">
        </p>
        <p>
            <label class="icon" for="password"><i class="fa fa-lock"></i></label>
            <input class="input-control" id="password" type="password" placeholder="请输入密码" name="password" required="" aria-required="true">
        </p>
        <p class="safe">
            <label class="remembermetext" for="rememberme"><input name="rememberme" type="checkbox" checked="checked" id="rememberme" class="rememberme" value="forever">记住我的登录</label>
            <a class="lost" href="<?php echo get_option('home'); ?>/wp-login.php?action=lostpassword"><?php _e('忘记密码 ?','tinection'); ?></a>
        </p>
        <p>
            <input class="submit login-loader" type="button" value="登录" name="submit">
            <input type="hidden" name="action" value="mobantu_login">
        </p>
        <a class="close"><i class="headericon-close"></i></a>
        <input type="hidden" id="security" name="security" value="<?php echo  wp_create_nonce( 'security_nonce' );?>">
		<input type="hidden" name="_wp_http_referer" value="<?php echo $_SERVER['REQUEST_URI']; ?>">
	</form>
    <div class="other-sign">
      <p>使用第三方帐号快捷登录</p>
	  
      <div class="2-col"><a class="qqlogin" href="<?php echo qq_login(get_bloginfo('url'));?>" rel="nofollow"><span>Q Q 登 录</span></a></div>
	  
	  <div class="2-col"><a class="weibologin" href="<?php echo sina_login(get_bloginfo('url'));?>" rel="nofollow"><span>微 博 登 录</span></a></div>
      
    </div>
    <div class="sign-tips"></div>
    </div>
    <div class="part registerPart">
    <form id="register" action="<?php bloginfo('url'); ?>/wp-login.php?action=register" method="post" novalidate="novalidate">
        <div id="login-active" class="switch">已有账号？快去登录&gt;&gt;</div>
        <h3>注册<p class="status"></p></h3>    
        <p>
            <label class="icon" for="user_name"><i class="fa fa-user"></i></label>
            <input class="input-control" id="user_name" type="text" name="user_name" placeholder="输入英文用户名" required="" aria-required="true">
        </p>
        <p>
            <label class="icon" for="user_email"><i class="fa fa-envelope"></i></label>
            <input class="input-control" id="user_email" type="email" name="user_email" placeholder="输入常用邮箱" required="" aria-required="true">
        </p>
        <p>
            <label class="icon" for="user_pass"><i class="fa fa-lock"></i></label>
            <input class="input-control" id="user_pass" type="password" name="user_pass" placeholder="密码最小长度为6" required="" aria-required="true">
        </p>
        <p>
            <label class="icon" for="user_pass2"><i class="fa fa-retweet"></i></label>
            <input class="input-control" id="user_pass2" type="password" name="user_pass2" placeholder="再次输入密码" required="" aria-required="true">
        </p>
        <p id="captcha_inline">
            <input class="input-control inline" type="text" id="captcha" name="captcha" placeholder="输入验证码" required>
            <img src="<?php echo THEME_URI.'/static/img/captcha-clk.png'; ?>" class="captcha_img inline" title="点击刷新验证码">
            <input type="hidden" name="action" value="mobantu_register">
            <input class="submit inline register-loader" type="button" value="注册" name="submit" style="height: 38px;">
        </p>
        <a class="close"><i class="headericon-close"></i></a>  
        <input type="hidden" id="user_security" name="user_security" value="<?php echo  wp_create_nonce( 'user_security_nonce' );?>"><input type="hidden" name="_wp_http_referer" value="<?php echo $_SERVER['REQUEST_URI']; ?>"> 
    </form>
    <div class="sign-tips"></div>
    </div>
    <div class="clear"></div>
</div>