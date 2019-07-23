<?php 
if(!defined('IN_DISCUZ') || !defined('IN_ADMINCP')) {
    exit('Access Denied');
}
date_default_timezone_set("UTC"); 
$config = include DISCUZ_ROOT . '/source/plugin/oculus/lib/config.php';
loadcache('oc_cache');
loadcache('oc_mobile');
C::import('oculuslib', 'plugin/oculus/lib');


$web_id_key = plang("web_id_key");
$mobile_id_key = plang("mobile_id_key");
$oculus_appkey = plang("oculus_appkey");
$oculus_appsecret = plang("oculus_appsecret");
$oculus_accesskeyid = plang("oculus_accesskeyid");
$oculus_accesskeysecret = plang("oculus_accesskeysecret");
$mobile_oculus_appkey = plang("mobile_oculus_appkey");
$mobile_oculus_appsecret = plang("mobile_oculus_appsecret");
$mobile_oculus_accesskeyid = plang("mobile_oculus_accesskeyid");
$mobile_oculus_accesskeysecret = plang("mobile_oculus_accesskeysecret");

$appkey_note = plang("appkey_note");
$appsecret_note =plang("appsecret_note");
$accesskeyid_note = plang("accesskeyid_note");
$accesskeysecret_note =plang("accesskeysecret_note");
$web_button_note = plang("web_button_note");
$mobile_button_note = plang("mobile_button_note");
$modify_id_key = plang("modify_id_key");
$click_modify = plang("click_modify");
$remind1 = plang("remind1");
$remind2 = plang("remind2");
$remind3 = plang("remind3");
$remind4 = plang("remind4");
$html = <<<HTML
<script src="//code.jquery.com/jquery-1.6.min.js" type="text/javascript"></script>
<script src="./source/plugin/oculus/js/edit_appkey.js" type="text/javascript"></script>
<form action="" method="post">
    <table class="tb tb2 ">
        <tbody>
        <tr>
            <th colspan="15" class="partition">$web_id_key
            </th>
        </tr>
        <tr>
            <td class="td27" s="1">$oculus_appkey</td>
        </tr>
        <tr class="noborder">
            <td class="vtop rowform">     
                <input name="oculus_appkey" value="{$_G['cache']['oc_cache']['oculus_appkey']}" type="text" class="txt" id="oculus_appkey" style="border:none;" disabled="disabled">
            </td>
            <td class="vtop tips2" s="1" ><span id="msg_web_id"></span><span id="label_web_id">$appkey_note</span>
            </td>
        </tr>
        <tr>
            <td class="td27" s="1">$oculus_appsecret<span></span></td>
        </tr>
        <tr class="noborder">
            <td class="vtop rowform">
                <input name="oculus_appsecret" value="{$_G['cache']['oc_cache']['oculus_appsecret']}" type="text" class="txt" id="oculus_appsecret" style="border:none;" disabled="disabled">
            </td>
            <td class="vtop tips2" s="1"><span id="msg_web_key"></span><span id="label_web_key">$appsecret_note</span>
            </td>
        </tr>
        <tr>
            <td class="td27" s="1">$oculus_accesskeyid<span></span></td>
        </tr>
        <tr class="noborder">
            <td class="vtop rowform">
                <input name="oculus_accesskeyid" value="{$_G['cache']['oc_cache']['oculus_accesskeyid']}" type="text" class="txt" id="oculus_accesskeyid" style="border:none;" disabled="disabled">
            </td>
            <td class="vtop tips2" s="1"><span id="msg_web_key"></span><span id="label_web_key">$accesskeyid_note</span>
            </td>
        </tr>
        <tr>
            <td class="td27" s="1">$oculus_accesskeysecret<span></span></td>
        </tr>
        <tr class="noborder">
            <td class="vtop rowform">
                <input name="oculus_accesskeysecret" value="{$_G['cache']['oc_cache']['oculus_accesskeysecret']}" type="text" class="txt" id="oculus_accesskeysecret" style="border:none;" disabled="disabled">
            </td>
            <td class="vtop tips2" s="1"><span id="msg_web_key"></span><span id="label_web_key">$accesskeysecret_note</span>
            </td>
        </tr>         
        <tr class="noborder">
            <td class="vtop rowform">
            <div id="web_btn" style="width: 113px;">
                    <div class="web_set1" style="">$modify_id_key</div>
                    <div class="web_set2" style="display:none;">$click_modify</div>
            </div>

            </td>
                <td class="vtop tips2" s="1">$web_button_note
            </td>
        </tr>
        </tbody>
    </table>
    </form>
        <div style="width:780px;color:red;">
            <br>
            <p>$remind1</p>
            <p>$remind2</p>
            <p>$remind3</p><br>
        </div>
    <style type="text/css">
    .web_set1,.web_set2,.mobile_set1,.mobile_set2,.rele{
  background-color: #00b7f1;
  color: #fff !important;
  padding: 0 20px;
  height: 22px;
  line-height: 22px;
  position: relative;
  cursor:pointer;
    }
    </style>
HTML;
echo $html;


if (!empty($_POST['web_keyset'])) {
    $oculus = new Oculus();
    $web_keyset = $_POST['web_keyset'];
    $oc_cache = check($web_keyset);
    $response = $oculus->check_yundun_appkey($oc_cache["oculus_appkey"], $oc_cache["oculus_appsecret"], $oc_cache["oculus_accesskeyid"], $oc_cache["oculus_accesskeysecret"]);
    if($response !=1){
        if($response == 3){
            cpmsg(lang('plugin/oculus', 'oculus_appsecret_fail'), ''  , 'error');
        }
        elseif($response == 4){
            cpmsg(lang('plugin/oculus', 'oculus_accesskeysecret_fail'), ''  , 'error');
        }
        elseif($response == 5){
            cpmsg(lang('plugin/oculus', 'oculus_accesskeyid_fail'), ''  , 'error');
        }
        else{
            cpmsg(lang('plugin/oculus', 'oculus_appkey_fail'), ''  , 'error');
        }
    }
    savecache('oc_cache',$oc_cache); 
    $config['keyset'] = $oc_cache;
    file_put_contents(DISCUZ_ROOT . '/source/plugin/oculus/lib/config.php', "<?php\n" . " return " . var_export($config, true) . ";?>");
    cpmsg(lang('plugin/oculus', 'modify_sucess'), '' , 'succeed');
}

function check($data){
    if ($data != "" || $data != null ) {
        $keyset = explode("/", $data);
        $keyset['0'] = trim($keyset['0']);
        $keyset['1'] = trim($keyset['1']);
        $keyset['2'] = trim($keyset['2']); 
        $keyset['3'] = trim($keyset['3']);
        $oculus_key = array(
                'oculus_appkey'=>$keyset['0'],
                'oculus_appsecret'=>$keyset['1'],
                'oculus_accesskeyid'=>$keyset['2'],
                'oculus_accesskeysecret'=>$keyset['3'],
                'oculus_version'=>time(),
            );
        return $oculus_key;
    }
}
function plang($str) {
    return lang('plugin/oculus', $str);
}
?>