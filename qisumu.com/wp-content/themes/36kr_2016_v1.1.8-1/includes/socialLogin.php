<?php
$options = get_option('monkey-options');

function do_post($url, $data) {
	$ch = curl_init ();
	curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, TRUE );
	curl_setopt ( $ch, CURLOPT_POST, TRUE );
	curl_setopt ( $ch, CURLOPT_POSTFIELDS, $data );
	curl_setopt ( $ch, CURLOPT_URL, $url );
	curl_setopt ( $ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	$ret = curl_exec ( $ch );
	curl_close ( $ch );
	return $ret;
}
function get_url_contents($url) {
	$ch = curl_init ();
	curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, TRUE );
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
	curl_setopt ( $ch, CURLOPT_URL, $url );
	$result = curl_exec ( $ch );
	curl_close ( $ch );
	return $result;
}


add_action( 'init', 'signup_social' );
function signup_social(){
	$options = get_option('monkey-options');
    if($_SERVER['REQUEST_METHOD'] == 'GET')
    {
       
        if (isset($_GET['code']) && isset($_GET['type']) && $_GET['type'] == 'sina')
        {
			$return_url='http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
			$fin_url=parse_url($return_url,PHP_URL_PATH);
            $code = $_GET['code'];
            $url = "https://api.weibo.com/oauth2/access_token";
            $data = "client_id=".$options['weiboid']."&client_secret=".$options['weibokey']."&grant_type=authorization_code&redirect_uri=".urlencode (home_url($fin_url))."&code=".$code;//替换成你自己的appkey和appsecret
            $output = json_decode(do_post($url,$data));
            $sina_access_token = $output->access_token;
            $sina_uid = $output->uid;
            if(empty($sina_uid)){
                wp_redirect(home_url());//获取失败的时候直接返回首页
                exit();
            }
            if(is_user_logged_in()){
				$get_user_info = "https://api.weibo.com/2/users/show.json?uid=".$sina_uid."&access_token=".$sina_access_token;
				$data = get_url_contents ( $get_user_info );
				$str  = json_decode($data , true);
				$userimg = $str['avatar_large'];
				
				$this_user = wp_get_current_user();
				update_user_meta($this_user->ID ,"sina_uid",$sina_uid);
				update_user_meta($this_user->ID ,"sina_access_token",$sina_access_token);
				update_user_meta($this_user->ID ,"sina_avatar",$userimg);
				wp_redirect(home_url($fin_url));//已登录用户授权
			exit;
            }else{
            $user_fb = get_users(array("meta_key "=>"sina_uid","meta_value"=>$sina_uid));
            if(is_wp_error($user_fb) || !count($user_fb)){
                $get_user_info = "https://api.weibo.com/2/users/show.json?uid=".$sina_uid."&access_token=".$sina_access_token;
                $data = get_url_contents ( $get_user_info );
                $str  = json_decode($data , true);
                $username = $str['screen_name'];
				$userimg = $str['avatar_large'];
                $login_name = wp_create_nonce($sina_uid);
                $random_password = wp_generate_password( $length=12, $include_standard_special_chars=false );
                $userdata=array(
                    'user_login' => $login_name,
                    'display_name' => $username,
                    'user_pass' => $random_password,
                    'nick_name' => $username
                );
                $user_id = wp_insert_user( $userdata );
                wp_signon(array("user_login"=>$login_name,"user_password"=>$random_password),false);
                update_user_meta($user_id ,"sina_uid",$sina_uid);
                update_user_meta($user_id ,"sina_access_token",$sina_access_token);
				update_user_meta($user_id ,"sina_avatar",$userimg);
                wp_redirect(home_url('/profile'));//创建帐号成功	
				exit();

            }else{
                update_user_meta($user_fb[0]->ID ,"sina_access_token",$sina_access_token);
                wp_set_auth_cookie($user_fb[0]->ID);              
                wp_redirect(home_url($fin_url));//已绑定，直接登录。
				exit();
				
            }
            }
        }
    }

}
function sina_login($sina_url){
	$options = get_option('monkey-options');
    return  "https://api.weibo.com/oauth2/authorize?client_id=".$options['weiboid']."&response_type=code&redirect_uri=" . urlencode (home_url('?type=sina'));//替换成你的appkey

}


function sina_is_active($access_token){
	$url = "https://api.weibo.com/oauth2/get_token_info";
	$data = "access_token=".$access_token;
	$output = json_decode(do_post($url,$data),true);
	$sina_uid=$output["uid"];
	if(isset($sina_uid)):
	return true;
	else: 
	return false;
	endif;

	//var_dump($output);	
}

add_action('wp_ajax_nopriv_sina_remove_bind', 'sina_remove_bind');
add_action('wp_ajax_sina_remove_bind', 'sina_remove_bind');
function sina_remove_bind(){
	$userid=$_POST["id"];
	$access_token = get_user_meta($userid,'sina_access_token',true);
	$url = "https://api.weibo.com/oauth2/revokeoauth2";
	$data = "access_token=".$access_token;
	delete_user_meta($userid,'sina_access_token');
	delete_user_meta($userid,'sina_uid');
	delete_user_meta($userid,'sina_avatar');
	
	$output = json_decode(do_post($url,$data),true);
	$result=$output["result"];
	if(isset($result)&&$result==true):
	return true;
	else:
	return false;
	endif;
	die();
}



function qq_is_active($userid){
	$qq_token=get_user_meta($userid,'qq_access_token',true);
	if(isset($qq_token)&&empty($qq_token)):
	return true;
	else: 
	return false;
	endif;	
}

add_action('wp_ajax_nopriv_qq_remove_bind', 'qq_remove_bind');
add_action('wp_ajax_qq_remove_bind', 'qq_remove_bind');
function qq_remove_bind(){
	$userid=$_POST["id"];
	
	delete_user_meta($userid,'qq_access_token');
	delete_user_meta($userid,'qq_openid');

	return true;

	die();
}









function qq_login($qq_url){
	$options = get_option('monkey-options');
    $_SESSION ['state'] = md5 ( uniqid ( rand (), true ) );
    return  "https://graph.qq.com/oauth2.0/authorize?client_id=".$options['qqid']."&state=" . $_SESSION ['state'] . "&response_type=code&redirect_uri=" . urlencode (home_url('?type=qq'));//替换成你的appkey
}

session_start();
add_action( 'init', 'signup_qq' );
function signup_qq(){
	$options = get_option('monkey-options');
	$return_url='http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	$fin_url=parse_url($return_url,PHP_URL_PATH); 
    if($_SERVER['REQUEST_METHOD'] == 'GET')
    {
        if (isset($_GET['code']) && isset($_GET['type']) && $_GET['type'] == 'qq')
        {
            if (!empty($_GET ['state']) && $_GET ['state'] == $_SESSION ['state']) {$code = $_GET['code'];
                $token_url = "https://graph.qq.com/oauth2.0/token?client_id=".$options['qqid']."&client_secret=".$options['qqkey']."&grant_type=authorization_code&redirect_uri=".urlencode (home_url($fin_url))."&code=".$code;//替换你的appkey和appsecret
                $response = get_url_contents ( $token_url );
                if (strpos ( $response, "callback" ) !== false) {
                    $lpos = strpos ( $response, "(" );
                    $rpos = strrpos ( $response, ")" );
                    $response = substr ( $response, $lpos + 1, $rpos - $lpos - 1 );
                    $msg = json_decode ( $response );
                    if (isset ( $msg->error )) {
                        echo "<h3>错误代码:</h3>" . $msg->error;
                        echo "<h3>信息  :</h3>" . $msg->error_description;
                        exit ();
                    }
                }
                $params = array ();
                parse_str ( $response, $params );
                $qq_access_token = $params ["access_token"];} else {
                echo ("The state does not match. You may be a victim of CSRF.");
                exit;
            }
            $graph_url = "https://graph.qq.com/oauth2.0/me?access_token=" . $qq_access_token;
            $str = get_url_contents ( $graph_url );
            if (strpos ( $str, "callback" ) !== false) {
                $lpos = strpos ( $str, "(" );
                $rpos = strrpos ( $str, ")" );
                $str = substr ( $str, $lpos + 1, $rpos - $lpos - 1 );
            }
            $user = json_decode ( $str );
            if (isset ( $user->error )) {
                echo "<h3>错误代码:</h3>" . $user->error;
                echo "<h3>信息  :</h3>" . $user->error_description;
                exit ();
            }
            $qq_openid = $user->openid;
			
			$get_user_info = "https://graph.qq.com/user/get_user_info?" . "access_token=" . $qq_access_token . "&oauth_consumer_key="  .$options['qqid'] . "&openid=" . $qq_openid . "&format=json";
			$data = get_url_contents ( $get_user_info );
			$str  = json_decode($data , true);
			
			$sina_avatar = $str[figureurl_qq_2]; 
            if(empty($qq_openid)){
                wp_redirect(home_url('/?3'.$qq_openid));//授权错误跳转
                exit;
            }
            if(is_user_logged_in()){
                $this_user = wp_get_current_user();
                update_user_meta($this_user->ID ,"qq_openid",$qq_openid);
                update_user_meta($this_user->ID ,"qq_access_token",$qq_access_token);
				update_user_meta($this_user->ID ,"sina_avatar",$sina_avatar);
                wp_redirect(home_url($fin_url));//已登录授权
				exit();
            }else{
                $user_fb = get_users(array("meta_key "=>"qq_openid","meta_value"=>$qq_openid));
                if(is_wp_error($user_fb) || !count($user_fb)){
                    $username = $str[nickname];
					$sina_avatar = $str[figureurl_qq_2]; 
                    $login_name = wp_create_nonce($qq_openid);
                    $random_password = wp_generate_password( $length=12, $include_standard_special_chars=false );
                    $userdata=array(
                        'user_login' => $login_name,
                        'display_name' => $username,
                        'user_pass' => $random_password,
                        'nick_name' => $username
                    );
                    $user_id = wp_insert_user( $userdata );
                    wp_signon(array("user_login"=>$login_name,"user_password"=>$random_password),false);
                    update_user_meta($user_id ,"qq_openid",$qq_openid);
                    update_user_meta($user_id ,"qq_access_token",$qq_access_token);
					update_user_meta($user_id ,"sina_avatar",$sina_avatar);
                    wp_redirect(get_permalink(get_page_id_from_template('page-user.php')));//新用户注册跳转
					exit();
                }else{                    
                    wp_set_auth_cookie($user_fb[0]->ID);
                    wp_redirect(home_url($fin_url));//已授权用户登录跳转
					exit();
                }
            }
        }
    }

}