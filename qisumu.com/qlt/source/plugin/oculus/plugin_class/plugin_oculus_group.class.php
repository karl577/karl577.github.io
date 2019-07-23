<?php 
if(! defined('IN_DISCUZ')) {
	exit('Access Denied');
}
class plugin_oculus_group  extends plugin_oculus{  
    
    function post_middle(){
        if ($this->_cur_mod_is_valid()) {
            $cur_mod = 'newthread';
            $page_type = 'newthread_reply_grade';
            $oc_oculus_id = 'oc_post_middle';
            return $this->_code_output($cur_mod ,$oc_oculus_id, $page_type).$this->fix_post_middle();
        }
    }

    function fix_post_middle(){
        $output = <<<JS
    <script type="text/javascript">
        function js_fix_post_middle() {
            var postsubmit = document.getElementById('postsubmit');
            oc_tx.style.color = "red";
            postsubmit.disabled = true;
            var oculus_passed = false;
            window.oc_custom_ajax = function(result) {
                oculus_passed = result;
                var oc_tx = document.getElementById("oc_tx");
                if(oculus_passed == true){
                    postsubmit.disabled = false;
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


    function post_infloat_middle() { 
        if ($this->_cur_mod_is_valid()) {
            $cur_mod = 'newthread';
            $page_type = 'newthread_reply_float';
            $oc_oculus_id = 'oc_post_infloat_middle';
            return $this->_code_output($cur_mod, $oc_oculus_id, $page_type);
        }
    }

    function viewthread_fastpost_content () {
        if ($this->_cur_mod_is_valid()) {
            $cur_mod = 'reply';
            $page_type = 'reply';
            $oc_oculus_id = 'oc_viewthread_fastpost_content';
            return $this->_fix_fastpost_btn_extra_pos($oc_oculus_id).$this->_code_output($cur_mod, $oc_oculus_id, $page_type);
        }
    }

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

    //修复快速回复，包含到form表单中
    function _fix_fast_reply_pos($oc_oculus_id){
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

    function _fix_zhibo_reply($oc_oculus_id) {
        $output = <<<JS
    <script type="text/javascript">
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

    //页面底部发帖
    function forumdisplay_fastpost_btn_extra() {
        if ($this->_cur_mod_is_valid()) {
            $cur_mod = 'newthread';
            $page_type = 'newthread';
            $oc_oculus_id = 'oc_forumdisplay_fastpost_btn_extra';
            return $this->_fix_fastpost_btn_extra_pos($oc_oculus_id).$this->_code_output($cur_mod, $oc_oculus_id, $page_type);
        }
    }

    //快速回复
    function viewthread_modaction(){
        //2.5版本不存在快速回复
        include_once(DISCUZ_ROOT.'/source/discuz_version.php');
        //其他版本
        global $_G;
        
        $allowfastreply = $_G['setting']['allowfastreply'] && $_G['group']['allowpost'];
        //快速回复是否开启,并且有发帖权限
        if(DISCUZ_VERSION != "X2.5" && $allowfastreply == 1){
            $cur_mod = 'reply';
            $oc_oculus_id = 'oc_viewthread_modaction';
            return $this->_code_output($cur_mod, $oc_oculus_id).$this->_fix_fast_reply_pos($oc_oculus_id);
        }

    }

    
    //处理发帖/恢复/编辑验证
    function post_recode() {
        global $_G;
        if( ! $this->has_authority() ){
            return;
        }
        $success = 0;
       if(!preg_match("/^[0-9a-z_]{1,}$/i",$_POST["_NC"])){
            $_POST["_NC"] = "nc";
        }
        if($this->_cur_mod_is_valid() && $this->captcha_allow) {
            if(submitcheck('topicsubmit', 0, $seccodecheck, $secqaacheck) || submitcheck('replysubmit', 0, $seccodecheck, $secqaacheck) || submitcheck('editsubmit', 0, $seccodecheck, $secqaacheck) ) {
                 if(( $_POST['sessionId'] == null && $_POST['sig'] == null && $_POST['app_token'] == NULL)){
                    showmessage(lang('plugin/oculus', 'seccode_slide'),'',array(),array('extrajs' => '<script type="text/javascript" reload="1">window.'.htmlspecialchars($_POST['_NC']).'.reload();</script>'));
                }
                $response = $this->oculus_validate();
                if($response != 1){//
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
        //2.5版本不存在快速回复
        global $_G;
        include_once(DISCUZ_ROOT.'/source/discuz_version.php');
        if(DISCUZ_VERSION == "X2.5" && $_GET['handlekey'] == "vfastpost"){
             return false ;
        }
        //针对掌上论坛不需要验证
        if( $_GET['mobile'] == 'no' && $_GET['module'] == 'sendreply' ){
            return false;
        }
        if( $_GET['mobile'] == 'no' && $_GET['module'] == 'newthread' ){
            return false;
        }
        //针对广播，回复不好验证。有三处回复
        if( $_GET['action'] == 'reply' && $_GET['inajax'] == '1' &&  $_GET['handlekey'] != 'reply' &&  $_GET['infloat'] != 'yes'){
            return false;
        }
        $action = $_GET['action'];
        //快速回复是否开启,并且有发帖权限,日志
        if($action == 'newthread' && $_G['group']['allowpost'] != 1 ){//发帖
            return false;
        }else if($action == 'reply' && $_G['group']['allowreply'] != 1 ){//回复
            return false;
        }
        return true;
    }
}

 ?>