<?php
if(! defined('IN_DISCUZ')) {
	exit('Access Denied');
}
class plugin_oculus_home extends plugin_oculus {
    //修正验证条的位置
	function _fix_fastpost_btn_extra_pos($oc_oculus_id) {
		$output = <<<JS
    <script type="text/javascript">
        function move_oculus_before_submit() {
            var oc_submitBtn = document.getElementById('fastpostsubmit');
            var oculus = document.getElementById('$oc_oculus_id');
            oc_submitBtn.parentNode.insertBefore(oculus, oc_submitBtn);
        }
        paxmac_ready(function(){move_oculus_before_submit();});

    </script>
JS;
		return $output;
	}
	//包含到form表单中
	function _fix_fast_form_pos($oc_oculus_id, $fastpostform){
         $output = <<<JS
    <script type="text/javascript">
        function move_fast_oculus_before_submit() {
            var fastpostform = document.getElementById('$fastpostform');
            var oculus = document.getElementById('$oc_oculus_id');
            fastpostform.insertBefore(oculus, fastpostform.firstChild);		
            oculus.style.marginBottom="10px";
         		
        }
        paxmac_ready(function(){move_fast_oculus_before_submit();});
    </script>
JS;
		return $output;
	}
	//修复支付提交
	function _fix_pay_submit($oc_oculus_id) {
		$output = <<<JS
    <script type="text/javascript">
        function move_oculus_before_submit() {
            var oc_submitBtn = document.getElementById('addfundssubmit_btn');
            var oculus = document.getElementById('$oc_oculus_id');
            oc_submitBtn.parentNode.insertBefore(oculus, oc_submitBtn);
        }
        paxmac_ready(function(){move_oculus_before_submit();});

    </script>
JS;
		return $output;
	}

	//支付
	function spacecp_credit_bottom(){
		if ($this->_cur_mod_is_valid()) {
			$cur_mod = 'popup';
			$btn_id = "addfundssubmit_btn";
			$oc_oculus_id = 'oc_spacecp_credit_bottom';
			return $this->_code_output($cur_mod, $oc_oculus_id, "", $btn_id).$this->_fix_pay_submit($oc_oculus_id);
		}
	}
	//广播
	function follow_top() {
		if ($this->_cur_mod_is_valid()) {
			$cur_mod = 'follow';
			$oc_oculus_id = 'oc_follow_top';
			$page_type = 'follow';
			return $this->modify_follow_css().$this->_code_output($cur_mod, $oc_oculus_id, $page_type).$this->_fix_fast_form_pos($oc_oculus_id, 'fastpostform');
		}
	}
            function modify_follow_css(){
                $css = <<<html
                <style>
                .mn {overflow: initial !important;}
                </style>
html;
                return $css;
            }
	//日志
	function spacecp_blog_middle() {
		if ($this->_cur_mod_is_valid()) {
			$cur_mod = 'blog';
			$oc_oculus_id = 'oc_spacecp_blog_middle';
			$page_type = 'blog';
			return $this->_code_output($cur_mod, $oc_oculus_id, $page_type);
		}
	}
	//日志评论
	function space_blog_face_extra() {
		if ($this->_cur_mod_is_valid()) {
			$cur_mod = 'popup';
			$oc_oculus_id = 'oc_space_blog_face_extra';
			$btn_id = "commentsubmit_btn";
			return $this->_code_output($cur_mod, $oc_oculus_id, "",$btn_id);
		}
	}
	
	function space_wall_face_extra(){
		if ($this->_cur_mod_is_valid()) {
			$cur_mod = "popup";
			$oc_oculus_id = "oc_space_wall_face_extra";
			$btn_id = "commentsubmit_btn";
			return $this->_code_output($cur_mod, $oc_oculus_id,"", $btn_id);     
		}
	}
    //处理广播、日志验证
    function spacecp_follow_recode(){
    	
    	$this->spacecp_recode();
    }
    function spacecp_blog_recode(){
    	$this->spacecp_recode();
    }
    function spacecp_comment_recode(){
    	
    	$this->spacecp_recode();
    }
	
	function spacecp_recode() {
		if( ! $this->has_authority() ){
                    return;
		}
                global $_G;
		$success = 0;
                if(!preg_match("/^[0-9a-z_]{1,}$/i",$_POST["_NC"])){
                    $_POST["_NC"] = "nc";
                }
		if($this->_cur_mod_is_valid() && $this->captcha_allow) {
			
			if(submitcheck('topicsubmit', 0, $seccodecheck, $secqaacheck) || submitcheck('blogsubmit', 0, $seccodecheck, $secqaacheck)) {
                            if(( $_POST['sessionId'] == null && $_POST['sig'] == null && $_POST['app_token'] == NULL)){
                                    showmessage(lang('plugin/oculus', 'seccode_slide'),'',array(),array('extrajs' => '<script type="text/javascript" reload="1">window.'.htmlspecialchars($_POST['_NC']).'.reload();</script>'));
                                }                           
                            $response = $this->oculus_validate();
				if($response != 1){
					if($response == -1){
						showmessage(lang('plugin/oculus', 'seccode_invalid'),'',array(),array('extrajs' => '<script type="text/javascript" reload="1">window.'.htmlspecialchars($_POST['_NC']).'.reload();</script>'));
					}else if($response == 0){
						showmessage( lang('plugin/oculus', 'seccode_expired'),'',array(),array('extrajs' => '<script type="text/javascript" reload="1">window.'.htmlspecialchars($_POST['_NC']).'.reload();</script>'));
					}
				}else{
					$success = 1;
				}
				
			}
		}
		
		if($success == 1){
			$post_count = $_G['cookie']['pc_size_c'];
			$post_count = intval($post_count);
			$post_count = ($post_count + 1);
			$arr = array('a','b','c','d','e','f');
			shuffle($arr);
			$post_count = $post_count.implode("",$arr);
			dsetcookie('pc_size_c',  $post_count);
		}
	}

    //判断是否有权限发帖留言，或者其他
	function has_authority(){
		//针对掌上论坛不需要验证
        if( $_GET['mobile'] == 'no' && $_GET['submodule'] == 'checkpost' ){
            return false;
        }
        
		global $_G;
		
        $action = $_GET['ac'];
        //快速回复是否开启,并且有发帖权限,日志
        if($action == 'follow' && $_G['group']['allowpost'] != 1 ){//发帖
            return false;
        }else if($action == 'blog' && $_G['group']['allowblog'] != 1 ){//回复
			return false;
        }else if($action == 'comment' && $_G['group']['allowcomment'] != 1 ){//回复
			return false;
        }

        return true;
	}
	

}
