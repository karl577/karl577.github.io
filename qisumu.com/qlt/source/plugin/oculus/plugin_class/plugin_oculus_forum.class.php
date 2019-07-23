<?php
error_reporting(E_ERROR);
if(! defined('IN_DISCUZ')) {
	exit('Access Denied');
}
class plugin_oculus_forum extends plugin_oculus {
	
	// 修正验证条的位置
	function _fix_fastpost_btn_extra_pos($oc_oculus_id) {
		$nc_ready_name = $oc_oculus_id . "_nc";
		$output = <<<JS
    <script type="text/javascript" defer="true">
        function move_oculus_before_submit() {
            var oc_submitBtn = document.getElementById('fastpostsubmit');
            var oculus = document.getElementById('$oc_oculus_id');
            var postForm = document.getElementById('fastpostform');
            oc_submitBtn.parentNode.parentNode.insertBefore(oculus, oc_submitBtn.parentNode);
        }
        paxmac_ready(function(){
        $nc_ready_name.on('ready',function(){move_oculus_before_submit();});
         });
        function get_button(){
            var b = [];
            var buttons = document.getElementsByTagName("button")
            for(var i=0; i<buttons.length; i++){
                var button = buttons[i];
                if(button.type == "submit"){
                    b.push(button)
                }
            }   
            return b;           
        }
     </script>
JS;
		return $output;
	}
	
	// 修复快速回复，包含到form表单中
	function _fix_fast_reply_pos($oc_oculus_id) {
		$output = <<<JS
    <script type="text/javascript">
        function move_fast_oculus_before_submit() {
            var vfastposttb = document.getElementById('vfastposttb');
            var oculus = document.getElementById('$oc_oculus_id');
            vfastposttb.parentNode.insertBefore(oculus, vfastposttb);

            oculus.style.backgroundColor="white";
            oculus.style.marginTop="-20px";
            oculus.style.marginLeft="-3px";
            oculus.style.marginRight="-3px";
            oculus.style.marginBottom="3px";
                
            document.getElementById('vfastpost').style.marginTop = "60px";    
        }
        paxmac_ready(function(){move_fast_oculus_before_submit();});

    </script>
JS;
		return $output;
	}
	
	// 修复直播贴
	function _fix_zhibo_reply($oc_oculus_id) {
		$output = <<<JS
    <script type="text/javascript" defer="true">
        function move_fast_oculus_before_submit() {
            var livereplysubmit = document.getElementById('livereplysubmit');
            var oculus = document.getElementById('$oc_oculus_id');
            livereplysubmit.parentNode.insertBefore(oculus, livereplysubmit);
        }
        paxmac_ready(function(){move_fast_oculus_before_submit();});

    </script>
JS;
		return $output;
	}
	
	// 页面底部发帖
	function forumdisplay_fastpost_btn_extra() {
		if($this->_cur_mod_is_valid()) {
			$cur_mod = 'newthread';
			$page_type = 'newthread';
			$oc_oculus_id = 'oc_forumdisplay_fastpost_btn_extra';
			return $this->_code_output($cur_mod, $oc_oculus_id, $page_type) . $this->_fix_fastpost_btn_extra_pos($oc_oculus_id);
		}
	}
	
	// 弹窗发帖回复
	function post_infloat_middle() {
		if($this->_cur_mod_is_valid()) {
			$cur_mod = 'newthread';
			$page_type = 'newthread_reply_float';
			$oc_oculus_id = 'oc_post_infloat_middle';
			return $this->_code_output($cur_mod, $oc_oculus_id, $page_type);
		}
	}
	
	// 页面底部回复
	function viewthread_fastpost_content() {
		if($this->_cur_mod_is_valid()) {
			$cur_mod = 'reply';
			$page_type = 'reply';
			$oc_oculus_id = 'oc_viewthread_fastpost_content';
			return $this->_code_output($cur_mod, $oc_oculus_id, $page_type) . $this->_fix_fastpost_btn_extra_pos($oc_oculus_id);
		}
	}
	
	// 高级发帖回复
	function post_middle() {
		if($this->_cur_mod_is_valid()) {
			$cur_mod = 'newthread';
			$page_type = 'newthread_reply_grade';
			$oc_oculus_id = 'oc_post_middle';
			return $this->_code_output($cur_mod, $oc_oculus_id, $page_type) . $this->fix_post_middle();
		}
	}
	function fix_post_middle() {
		$notice_message = lang('plugin/oculus', 'seccode_slide');
		$output = <<<JS
    <script type="text/javascript">
        function js_fix_post_middle() {
            var postsubmit = document.getElementById('postsubmit');
            oc_tx.style.color = "red";
            var oculus_passed = false;
            postsubmit.onclick = function(){
                if(oc_tx.style.color == "red"){
                    showError("$notice_message");
                    return false;
                    }
            }
            window.oc_custom_ajax = function(result) {
                oculus_passed = result;
                var oc_tx = document.getElementById("oc_tx");
                if(oculus_passed == true){
                    oc_tx.style.color = "black";                    
                }else{
                    postsubmit.disabled = true;
                    oc_tx.style.color = "red";                  
                }
            }

        }
        paxmac_ready(function(){js_fix_post_middle();});

    </script>
JS;
		return $output;
	}
	
	// 快速回复
	function viewthread_modaction() {
		
		// 2.5版本不存在快速回复
		include_once (DISCUZ_ROOT . '/source/discuz_version.php');
		
		// 其他版本
		// global $_G;
		//
		// $allowfastreply = $_G['setting']['allowfastreply'] && $_G['group']['allowpost'];
		//
		// //快速回复是否开启,并且有发帖权限
		//
		// if (DISCUZ_VERSION != "X2.5" && $allowfastreply == 1 && $this->_cur_mod_is_valid()) {
		// $cur_mod = 'reply';
		// $oc_oculus_id = 'oc_viewthread_modaction';
		// return $this->_code_output($cur_mod, $oc_oculus_id) . $this->_fix_fast_reply_pos($oc_oculus_id);
		// }
	}
	
	// 处理发帖/恢复/编辑验证
	function post_recode() {
		if(! $this->has_authority()) {
			return;
		}
		
		global $_G;
		$success = 0;
		if($_POST["_NC"]) {
			if(! preg_match("/^[0-9a-z_]{1,}$/i", $_POST["_NC"])) {
				$_POST["_NC"] = "nc";
			}
		}
		if($this->_cur_mod_is_valid() && $this->captcha_allow) {
			if(submitcheck('topicsubmit', 0, $seccodecheck, $secqaacheck) || submitcheck('replysubmit', 0, $seccodecheck, $secqaacheck) || submitcheck('editsubmit', 0, $seccodecheck, $secqaacheck)) {
				if(($_POST['sessionId'] == null && $_POST['sig'] == null && $_POST['app_token'] == NULL)) {
					showmessage(lang('plugin/oculus', 'seccode_slide'), '', array (), array (
							'extrajs' => '<script type="text/javascript" reload="1">window.' . htmlspecialchars($_POST['_NC']) . '.reload(); </script>' 
					));
				}
				$response = $this->oculus_validate();
				if($response != 1) {
					
					//
					if($response == - 1) {
						showmessage(lang('plugin/oculus', 'seccode_invalid'), '', array (), array (
								'extrajs' => '<script type="text/javascript" reload="1">window.' . htmlspecialchars($_POST['_NC']) . '.reload(); </script>' 
						));
					} else if($response == 0) {
						showmessage(lang('plugin/oculus', 'seccode_expired'), '', array (), array (
								'extrajs' => '<script type="text/javascript" reload="1">window.' . htmlspecialchars($_POST['_NC']) . '.reload(); </script>' 
						));
					}
				} else {
					$success = 1;
				}
			}
		}
		
		if($success == 1) {
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
	
	// 判断是否有权限发帖留言，或者其他
	function has_authority() {
		
		// 2.5版本不存在快速回复
		include_once (DISCUZ_ROOT . '/source/discuz_version.php');
		if(DISCUZ_VERSION == "X2.5" && $_GET['handlekey'] == "vfastpost") {
			return false;
		}
		
		// 针对掌上论坛不需要验证
		if($_GET['mobile'] == 'no' && $_GET['module'] == 'sendreply') {
			return false;
		}
		if($_GET['mobile'] == 'no' && $_GET['module'] == 'newthread') {
			return false;
		}
		
		// 针对广播，回复不好验证。有三处回复
		if($_GET['action'] == 'reply' && $_GET['inajax'] == '1' && $_GET['handlekey'] != 'reply' && $_GET['infloat'] != 'yes') {
			
			return false;
		}
		
		global $_G;
		
		$action = $_GET['action'];
		
		// 快速回复是否开启,并且有发帖权限,日志
		if($action == 'newthread' && $_G['group']['allowpost'] != 1) {
			
			// 发帖
			return false;
		} else if($action == 'reply' && $_G['group']['allowreply'] != 1) {
			
			// 回复
			return false;
		}
		
		return true;
	}
}
