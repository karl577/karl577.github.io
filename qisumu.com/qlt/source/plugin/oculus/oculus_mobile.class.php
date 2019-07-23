<?php
if (! defined('IN_DISCUZ')) {
	exit('Access Denied');
}
loadcache('plugin');
loadcache('oc_mobile');
loadcache('nc_cache');
C::import('oculuslib', 'plugin/oculus/lib');
class mobileplugin_oculus {
	public $captcha_allow = false;
	public $mobile;
	public $mod = array ();
	public $captcha = '';
	public $private = '';
	public function mobileplugin_oculus() {
		global $_G;
		// 读缓存信息
		$this->mod = unserialize($_G['cache']['plugin']['oculus']['mod']);
		$this->mobile = $_G['cache']['plugin']['oculus']['mobile'];
		
		$oculus = new Oculus();
		$this->app_key = $oculus->getAppKey();
		$this->app_ver = $oculus->getAppVer();
		if (in_array($_G['groupid'], unserialize($_G['cache']['plugin']['oculus']['groupid'])) && $this->mobile) {
			$this->captcha_allow = true;
		}
		$this->app_token = "dzplugin" . $this->Random_token();
		$post_count = $_G['cookie']['pc_size_c'];
		if ($post_count == null) {
			$arr = array (
					'a',
					'b',
					'c',
					'd',
					'e',
					'f' 
			);
			shuffle($arr);
			$post_count = '0' . explode($arr);
			dsetcookie('pc_size_c', $post_count, 24 * 60 * 60);
		} else {
			$post_count = intval($post_count);
			$post_num = intval($_G['cache']['plugin']['oculus']['post_num']);
			
			if (($post_num != 0 && $post_count >= $post_num)) {
				$this->captcha_allow = false;
			}
		}
	}
	public function Random_token() {
		return md5("conqu3r" . date('Y-m-d\TH:i:s\Z'));
	}
	public function _cur_mod_is_valid() {
		$cur = CURMODULE;
		switch (CURMODULE) {
			case "logging" :
				$cur = "2";
				break;
			case "register" :
				$cur = "1";
				break;
			case "post" : // 论坛模块
				if ($_GET["action"] == "reply") {
					$cur = "4";
				} else if ($_GET["action"] == "newthread") {
					$cur = "3";
				} else if ($_GET["action"] == "edit") {
					$cur = "5";
				}
				break;
			case "forumdisplay" :
			case "viewthread" :
				$cur = "4";
				break;
		}
		return in_array($cur, $this->mod);
	}
	public function _code_output() {
		if (! ($this->_cur_mod_is_valid() && $this->captcha_allow)) {
			return;
		}
		$oculuslib = new Oculus();
		global $_G;
		$oculus_notice = lang('plugin/oculus', 'oculus_notice');
		$output = '<script charset="utf-8" src="//g.alicdn.com/sd/nch5/index.js?t=' . $this->app_ver . '"></script>
                   <link rel="stylesheet" type="text/css" href="source/plugin/oculus/js/oculus.css?t=' . $this->app_ver . '" />
                   <div class="oculus" id="oculus" style="display: none;">
                   <div class="waf-nc-h5-mask"></div>
                   <div id="WAF_NC_WRAPPER" class="waf-nc-h5-wrapper">
                        <div class="waf-nc-h5-panel"><img class="waf-nc-h5-icon" src="//img.alicdn.com/tps/TB1zmO_LXXXXXcBXFXXXXXXXXXX-200-200.png" alt="" height="30" width="30">
                            <div class="waf-nc-h5-description">' . $oculus_notice . '</div>
                        </div>
                        <hr class="waf-nc-h5-hr">
                        <div id="ncContainer" class="nc-container" data-nc-idx="1"></div>
                        </div>
                    </div>
                <img height="0" src="//ynuf.aliapp.org/dc.htm?token=' . $this->app_token . '" width="0" />
            ';
		$output .= '</div>';
		return $output;
	}
	public function fix_formattribute() {
		$output = <<<JS
                <script type="text/javascript" reload="1">
                            $(document).on('click', '#messagetext input', function() {
                            location.reload();
                             }); 
                            NoCaptcha.init({
                                renderTo: '#ncContainer',
                                appkey :'$this->app_key' ,
                                token : '$this->app_token',
                                scene: 'bbs_h5',
                                is_Opt:1,
                                is_tbLogin: false,
                                language:'cn',
                                inline: true,
                                callback: function (data) {// 校验成功回调
                                if(data_form == "y") {data_form = "postform" ;}
                                var insertparent = document.getElementById(data_form);
                                var wrapper = document.createElement("div");
                                wrapper.style.display = 'none';
                                wrapper.innerHTML = '<input name = "sessionId" value = ' + data.csessionid  + ' type = "hidden"/>' + 
                                                   '<input name = "sig" value = ' + data.sig  + ' type = "hidden"/>' + 
                                                   '<input name = "app_token" value = "$this->app_token" type = "hidden"/>';
                                insertparent.appendChild(wrapper);
                                window.oc_custom_ajax(true, "oculus");

                                }
                            });
                          NoCaptcha.setEnabled(true);
                          </script>
JS;
		return $output;
	}
	public function getIps() {
		if (getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), 'unknown')) {
			$IP = getenv('HTTP_CLIENT_IP');
		} elseif (getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), 'unknown')) {
			$IP = getenv('HTTP_X_FORWARDED_FOR');
		} elseif (getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), 'unknown')) {
			$IP = getenv('REMOTE_ADDR');
		} elseif (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], 'unknown')) {
			$IP = $_SERVER['REMOTE_ADDR'];
		}
		return $IP ? $IP : "unknow";
	}
	public function fix_register() {
		return '<script id="testScript" type="text/javascript" src="source/plugin/oculus/js/oculus_mobile.js?t=' . $this->app_ver . '" data-btn="btn_register" data-form="registerform"></script>';
	}
	public function fix_login() {
		return '<script id="testScript" type="text/javascript" src="source/plugin/oculus/js/oculus_mobile.js?t=' . $this->app_ver . '" data-btn="btn_login" data-form="loginform"></script>';
	}
	public function global_footer_mobile() {
		if (CURMODULE == 'register' && $this->_cur_mod_is_valid() && $this->captcha_allow) {
			return $this->_code_output() . $this->fix_register() . $this->fix_formattribute();
		} elseif (CURMODULE == 'logging' && $this->_cur_mod_is_valid() && $this->captcha_allow) {
			return $this->_code_output() . $this->fix_login() . $this->fix_formattribute();
		} else {
			return;
		}
	}
	public function oculus_validate() {
		$oculus = new Oculus();
		//$oculus->get_option($this->keyset);
		return $oculus->check_oculus_risk($_POST["app_token"], $_POST["sessionId"], $this->getIps(), $_POST["sig"]);
	}
}
class mobileplugin_oculus_member extends mobileplugin_oculus {
	function logging_code() {
		global $_G;
		if ($_GET['action'] == "logout") {
			return;
		}
		
		if ($this->_cur_mod_is_valid() && $this->captcha_allow) {
			if (submitcheck('loginsubmit', 1, $seccodestatus) && empty($_GET['lssubmit'])) { //
				if (($_POST['sessionId'] == null && $_POST['sig'] == null && $_POST['app_token'] == NULL)) {
					showmessage(lang('plugin/oculus', 'seccode_slide'));
				}
				$response = $this->oculus_validate();
				if ($response != 1) { //
					if ($response == - 1) {
						showmessage(lang('plugin/oculus', 'seccode_invalid'));
					} else if ($response == 0) {
						showmessage(lang('plugin/oculus', 'seccode_expired'));
					}
				}
			}
		}
	}
	function register_code() {
		global $_G;
		if ($this->_cur_mod_is_valid() && $this->captcha_allow) {
			if (submitcheck('regsubmit', 0, $seccodecheck, $secqaacheck)) {
				if (($_POST['sessionId'] == null && $_POST['sig'] == null && $_POST['app_token'] == NULL)) {
					showmessage(lang('plugin/oculus', 'seccode_slide'));
				}
				$response = $this->oculus_validate();
				if ($response != 1) { //
					if ($response == - 1) {
						showmessage(lang('plugin/oculus', 'seccode_invalid'));
					} else if ($response == 0) {
						showmessage(lang('plugin/oculus', 'seccode_expired'));
					}
				}
			}
		}
	}
}
class mobileplugin_oculus_forum extends mobileplugin_oculus {
	public function fix_viewthread() {
		return '<script id="testScript" type="text/javascript" src="source/plugin/oculus/js/oculus_mobile.js?t=' . $this->app_ver . '" data-btn="fastpostsubmit" data-form="fastpostsubmitline"></script>';
	}
	// 手机底部回复
	public function viewthread_fastpost_button_mobile() {
		if (! ($this->_cur_mod_is_valid() && $this->captcha_allow)) {
			return;
		} else {
			return $this->_code_output() . $this->fix_viewthread() . $this->fix_formattribute();
		}
	}
	
	// 手机跳转回复及发帖
	public function post_bottom_mobile() {
		if (CURMODULE == "post" && $this->_cur_mod_is_valid() && $this->captcha_allow) {
			return $this->_code_output() . $this->fix_post() . $this->fix_formattribute();
		} else {
			return;
		}
	}
	public function fix_post() {
		return '<script id="testScript" type="text/javascript" src="source/plugin/oculus/js/oculus_mobile.js?t=' . $this->app_ver . '" data-btn="postsubmit" data-form="y"></script>';
	}
	function post_rccode() {
		global $_G;
		$success = 0;
		if ($this->_cur_mod_is_valid() && $this->captcha_allow) {
			if (submitcheck('topicsubmit', 0, $seccodecheck, $secqaacheck) || submitcheck('replysubmit', 0, $seccodecheck, $secqaacheck) || submitcheck('editsubmit', 0, $seccodecheck, $secqaacheck)) {
				if (($_POST['sessionId'] == null && $_POST['sig'] == null && $_POST['app_token'] == NULL)) {
					showmessage(lang('plugin/oculus', 'seccode_slide'));
				}
				$response = $this->oculus_validate();
				if ($response != 1) {
					if ($response == - 1) {
						showmessage(lang('plugin/oculus', 'seccode_invalid'));
					} else if ($response == 0) {
						showmessage(lang('plugin/oculus', 'seccode_expired'));
					}
				} else {
					$success == 1;
				}
			}
		}
		
		if ($success == 1) {
			$post_count = $_G['cookie']['pc_size_c'];
			$post_count = intval($post_count);
			$post_count = ($post_count + 1);
			$arr = array (
					'a',
					'b',
					'c',
					'd',
					'e',
					'f' 
			);
			shuffle($arr);
			$post_count = $post_count . implode("", $arr);
			dsetcookie('pc_size_c', $post_count);
		}
	}
}
?>