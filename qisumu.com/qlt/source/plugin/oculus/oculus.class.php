<?php
if (! defined('IN_DISCUZ')) {
	exit('Access Denied');
}
loadcache('plugin');
loadcache('oc_cache');
loadcache('nc_cache');
C::import('oculuslib', 'plugin/oculus/lib');
class plugin_oculus {
	public $captcha_allow = false;
	public $mods = array ();
	// public $keyset = array();
	public $style = array ();
	public $app_key = "";
	public $open;
	public $oculus_notice;
	function plugin_oculus() {
		global $_G;
		// 读缓存信息
		$this->mods = unserialize($_G['cache']['plugin']['oculus']['mod']);
		$this->open = $_G['cache']['plugin']['oculus']['open'];
		$oculus = new Oculus();
		$this->app_key = $oculus->getAppKey();
		$this->app_ver = $oculus->getAppVer();
		
		$this->style = $_G['cache']['plugin']['oculus'];
		$this->oculus_notice = lang('plugin/oculus', 'oculus_notice');
		$this->oculus_notice_1 = lang('plugin/oculus', 'oculus_notice_1');
		// 初始化
		if ($this->open == '1') {
			// 登陆注册不需要选择用户组
			if (CURMODULE == "logging" || CURMODULE == "register") {
				$this->captcha_allow = true;
			} else if (in_array($_G['groupid'], unserialize($_G['cache']['plugin']['oculus']['groupid']))) {
				$this->captcha_allow = true;
			} else {
				$this->captcha_allow = false;
			}
		} else {
			$this->captcha_allow = false;
		}
		// 发帖大于限定数，则不用插件
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
			if ($post_num != 0 && $post_count >= $post_num) {
				$this->captcha_allow = false;
			}
		}
	}
	
	// 修复QQ互联注册
	function _fix_register($oc_oculus_id) {
		$output = <<<JS
    <script type="text/javascript" defer="true">
        function move_fast_oculus_before_submit() {
            var registerformsubmit = document.getElementById('registerformsubmit');
            var oculus = document.getElementById('$oc_oculus_id');
            registerformsubmit.parentNode.insertBefore(oculus, registerformsubmit);
        }
        paxmac_ready(function(){move_fast_oculus_before_submit();});
    </script>
JS;
		return $output;
	}
	public function global_header() {
		$cur = CURMODULE;
		if ($cur == "connect" && $this->_cur_mod_is_valid()) {
			$cur_mod = "popup";
			$oc_oculus_id = "oc_global_header";
			$btn_id = "registerformsubmit";
			// return $this->_code_output($cur_mod, $oc_oculus_id, '', $btn_id) . $this->_fix_register($oc_oculus_id);
		}
		$ncjs = <<<HTML
            <link rel="stylesheet" href="source/plugin/oculus/js/oculus.css?t=$this->app_ver">
            <link rel="stylesheet" href="//g.alicdn.com/sd/ncpc/nc.css?t=$this->app_ver">
            <script src="//g.alicdn.com/sd/ncpc/nc.js?t=$this->app_ver"></script>
            <script src="source/plugin/oculus/js/oculus_nc.js?t=$this->app_ver"></script>
            <div id="nc-float" style="display:none;">
                <div class="nc-f-head">
                    <img class="nc-f-icon" src="//img.alicdn.com/tps/TB1_3FrKVXXXXbdXXXXXXXXXXXX-129-128.png" alt="" height="20" width="20">
                    <span class="nc-f-title">$this->oculus_notice_1</span>
                    <a class="close" href="#"><i class="nc_iconfont">&#xe60c;</i></a>
                </div>
                <div class="nc-f-body" id="oculus-nc-f-body">
                <div class="nc-f-des">$this->oculus_notice</div>
                    <div id="nocaptcha"></div>
                </div>
            </div>
HTML;
		return $ncjs;
	}
	function global_login_extra() {
		global $_G;
		if ($_G['uid'] == '1') {
			return;
		} else if ($_G['uid'] == '0' && $this->logging_mod_valid()) {
			$html = <<<HTML
            <link rel="stylesheet" href="source/plugin/oculus/js/oculus.css?t=$this->app_ver">
            <link rel="stylesheet" href="//g.alicdn.com/sd/ncpc/nc.css?t=$this->app_ver">
            <script type="text/javascript" src="//g.alicdn.com/sd/ncpc/nc.js?t=$this->app_ver"></script>
            <script type="text/javascript" src="source/plugin/oculus/js/oculus_nc.js?t=$this->app_ver"></script>
            <div id="nc-float" style="display:none;">
                <div class="nc-f-head">
                    <img class="nc-f-icon" src="//img.alicdn.com/tps/TB1_3FrKVXXXXbdXXXXXXXXXXXX-129-128.png" alt="" height="20" width="20">
                    <span class="nc-f-title">$this->oculus_notice_1</span>
                    <a class="close" href="#"><i class="nc_iconfont">&#xe60c;</i></a>
                </div>
                <div class="nc-f-body" id="oculus-nc-f-body">
                    <div class="nc-f-des">$this->oculus_notice</div>
                    <div  id="_umfp" style="width:1px;height:1px"></div>
                    <div id="nocaptcha"></div>
                </div>
            </div>
            <script type="text/javascript" reload="1" defer="true">
            paxmac_ready(function(){
            var lsform = document.getElementById('lsform');
            var o = document.createElement("button");
            o.id = "header-loggin-btn";
            o.setAttribute('type', 'submit');
            o.value = "";
            o.style.display = "none";
            try{
            lsform.appendChild(o);
                }
            catch(err){
                
            }
            window['aq-nc-grey-ratio'] = 1;
            o.onclick = function() {
                var ncf = new NCFloat(document.getElementById('nc-float'));
                _nc_plugin_init('$this->app_key', 'nocaptcha', 'lsform', 'discuz_header_nc');
                discuz_header_nc.on('success', function(){
                            ncf.hide(1);
                            lsSubmit();
                    });
                discuz_header_nc.on('after_code', function() {
                    document.getElementById('oculus-nc-f-body').style.height = "300px";
                });
                ncf.show();

            };
            });
            </script>                
HTML;
			return $html;
		}
	}
	public function _code_output($cur_mod = '', $oculus_id = 'oc_oculus', $page_type = '', $param = '') {
		if (! $this->captcha_allow) {
			return;
		}
		global $_G;
		$random_id = "conqu3r_" . $oculus_id;
		$random_nc = $oculus_id . "_nc";
		$nchtml = <<<HTML
            <script type="text/javascript" reload="1" defer="true">
                paxmac_ready(function(){
                _nc_plugin_init('$this->app_key', '$random_id', '$random_id', '$random_nc');
                $random_nc.on('success', function(){
                        window.oc_custom_ajax(true);
                    });
                });
            </script>
HTML;
		$nchtml_extra = <<<HTML
            <script type="text/javascript" reload="1" defer="true">
                paxmac_ready(function(){
                    var lost = document.getElementsByName("lostpwsubmit");
                    if (lost.length) {
                        lost[0].onclick = function(e) {
                            var ncf = new NCFloat(document.getElementById('nc-float'));
                            var event = e || window.event;
                            if (event.preventDefault) event.preventDefault();
                            else event.returnValue=false;
                            _nc_plugin_init('$this->app_key', 'nocaptcha', 'lostpwsubmit', 'lostpw_nc');
                            lostpw_nc.on('success', function(){
                                ncf.hide(1);
                                var postForm = findParentByTagName(document.getElementsByName("lostpwsubmit")[0], 'form');
                                postForm && postForm.submit();
                            });
                            lostpw_nc.on('after_code', function() {
                                document.getElementById('oculus-nc-f-body').style.height = "300px";
                            });
                            ncf.show();

                                }  
                            }
                    });
            </script>
HTML;
		if (in_array("10", $this->mods)) {
			$nchtml = $nchtml . $nchtml_extra;
		}
		$nchtml2 = <<<HTML
        <script type="text/javascript" reload="1" defer="true">
        paxmac_ready(function(){
        document.getElementById("$param").onclick = function (e) {
            var ncf = new NCFloat(document.getElementById('nc-float'));
            var event = e || window.event; 
            event.preventDefault();
            _nc_plugin_init('$this->app_key', 'nocaptcha', '$param', '$random_nc');
            $random_nc.on('success', function(){
                ncf.hide(1);
                var postForm = findParentByTagName(document.getElementById("$param"), 'form');
                postForm && postForm.submit();
            });
            $random_nc.on('after_code', function() {
                document.getElementById('oculus-nc-f-body').style.height = "300px";
            });
            ncf.show();
        };
        });
        </script>
HTML;
		$output = '';
		$cur_mod = empty($cur_mod) ? CURMODULE : $cur_mod;
		$style = $this->getStyle($page_type);
		switch ($cur_mod) {
			case 'register' :
			case 'logging' :
				$output = "<div id='$oculus_id' class='rfm' style='$style'><table><tbody><tr><th><div><span class=\"rq\">*</span>&#28369;&#21160;&#39564;&#35777;:</div></th><td>";
				$output .= '<style>
                                #' . $random_id . ' .clickCaptcha{
                                top: -270px;
                                }
                                </style>
                                <div  id="_umfp" style="display:inline;width:1px;height:1px;overflow:hidden"></div>
                                <div id="' . $random_id . '"></div>';
				$output .= '</td></tr></tbody></table></div>';
				$output .= $nchtml;
				break;
			
			case 'newthread' :
			case 'reply' :
			case 'edit' :
				$output = "<div id='$oculus_id' class='' style='$style'><table><tbody><tr><th style='width:80px;'><div id='oc_tx'><span class=\"rq\">*</span>&#28369;&#21160;&#39564;&#35777;:</div></th><td>";
				$output .= '<style>
                                #' . $random_id . ' .clickCaptcha{
                                top: -270px;
                                }
                                </style>
                                <div  id="_umfp" style="display:inline;width:1px;height:1px;overflow:hidden"></div>
                                <div id="' . $random_id . '"></div>';
				$output .= '</td></tr></tbody></table></div>';
				$output .= $nchtml;
				break;
			
			case 'blog' :
			case 'follow' :
			case 'comment' :
				$output = "<div id='$oculus_id' class='' style='$style'><table><tbody><tr><th style='width:80px;'><div><span class=\"rq\">*</span>&#28369;&#21160;&#39564;&#35777;:</div></th><td>";
				$output .= '<style>
                                #' . $random_id . ' .clickCaptcha{
                                top: -270px;
                                }
                                </style>
                                <div  id="_umfp" style="display:inline;width:1px;height:1px;overflow:hidden"></div>
                                <div id="' . $random_id . '"></div>';
				$output .= '</td></tr></tbody></table></div>';
				$output .= $nchtml;
				break;
			case 'popup' :
				$output = "<div id='$oculus_id'><input name = '_NC' value ='nc'  type = 'hidden'/>";
				$output .= '<div id="' . $random_id . '"></div>';
				$output .= $nchtml2;
				$output .= '</div>';
				break;
		}
		
		return $output;
		/*
		 * }
		 * else {
		 * return;
		 * }
		 */
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
	public function oculus_validate() {
		$oculus = new Oculus();
		// $oculus->get_option ( $this->keyset );
		return $oculus->check_oculus_risk($_POST["app_token"], $_POST["sessionId"], $this->getIps(), $_POST["sig"]);
	}
	public function logging_mod_valid() {
		$mod = "2";
		return in_array($mod, $this->mods);
	}
	public function _cur_mod_is_valid() {
		$cur = CURMODULE;
		switch (CURMODULE) {
			case "logging" :
				$mod = "2";
				break;
			
			case "register" :
				$mod = "1";
				break;
			
			case "post" :
				if ($_GET["action"] == "reply") {
					$mod = "4";
				} else if ($_GET["action"] == "newthread") {
					$mod = "3";
				} else if ($_GET["action"] == "edit") {
					$mod = "5";
				}
				break;
			
			case "forumdisplay" :
				$mod = "3";
				break;
			
			case "viewthread" :
				$mod = "4";
				break;
			
			case "follow" :
				$mod = "6";
				break;
			
			case "spacecp" :
				if ($_GET["ac"] == "blog") {
					$mod = "7";
				}
				if ($_GET["ac"] == "comment") {
					$mod = "8";
				}
				if ($_GET["ac"] == "follow") {
					$mod = "6";
				}
				if ($_GET["ac"] == "credit") {
					$mod = "9";
				}
				break;
			
			case "space" :
				if ($_GET["do"] == "wall") {
					$mod = "8";
				}
				if ($_GET["do"] == "blog" || $_GET["do"] == "index") {
					$mod = "7";
				} else {
					$mod = "4";
				}
				
				break;
			
			case "connect" :
				$mod = "1";
				break;
			
			case "index" :
				$mod = "2";
				break;
			case "lostpasswd" :
				$mod = "10";
				break;
			default :
				return 1;
		}
		return in_array($mod, $this->mods);
	}
	private function getStyle($page_type) {
		$style_str = $style_str = $this->style[$page_type];
		
		$style_arr = explode(" ", $style_str);
		$top = $style_arr[0] == "auto" ? "auto" : $style_arr[0] . 'px ';
		$bottom = $style_arr[1] == "auto" ? "auto" : $style_arr[1] . 'px ';
		$left = $style_arr[2] == "auto" ? "auto" : $style_arr[2] . 'px ';
		$right = $style_arr[3] == "auto" ? "auto" : $style_arr[3] . 'px';
		$margin = "margin:" . $top . ' ' . $right . ' ' . $bottom . ' ' . $left;
		return $margin;
	}
}
include ('plugin_class/plugin_oculus_member.class.php');

include ('plugin_class/plugin_oculus_forum.class.php');

include ('plugin_class/plugin_oculus_home.class.php');

include ('plugin_class/plugin_oculus_group.class.php');
?>