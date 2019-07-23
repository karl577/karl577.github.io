<?php if(!defined('IN_DISCUZ')) exit('Access Denied'); 
0
|| checktplrefresh('./source/plugin/qiniuyun/template/fast_upload.htm', './template/default/common/upload.htm', 1487569105, 'qiniuyun', './data/template/8_qiniuyun_fast_upload.tpl.php', './source/plugin/qiniuyun/template', 'fast_upload')
;?><?php
$__VERHASH = VERHASH;$__IMGDIR = IMGDIR;$return = <<<EOF

EOF;
 if(empty($_G['uploadjs'])) { 
$return .= <<<EOF

<script src="{$_G['setting']['jspath']}upload.js?{$__VERHASH}" type="text/javascript"></script>
EOF;
 $_G['uploadjs'] = 1;
$return .= <<<EOF

EOF;
 } 
$return .= <<<EOF
<script type="text/javascript">

EOF;
 if($_G['cache']['plugin']['qiniuyun']['url']) { 
$return .= <<<EOF

function fileDialogComplete(numFilesSelected, numFilesQueued) {
try {
if(this.customSettings.uploadSource == 'forum') {
if(this.customSettings.uploadType == 'attach') {
if(typeof switchAttachbutton == "function") {
switchAttachbutton('attachlist');
}
try {
if(this.getStats().files_queued) {
$('attach_tblheader').style.display = '';
$('attach_notice').style.display = '';
}
} catch (ex) {}
} else if(this.customSettings.uploadType == 'image') {
if(typeof switchImagebutton == "function") {
switchImagebutton('imgattachlist');
}
try {
$('imgattach_notice').style.display = '';
} catch (ex) {}
}
var objId = this.customSettings.uploadType == 'attach' ? 'attachlist' : 'imgattachlist';
var listObj = $(objId);
var tableObj = listObj.getElementsByTagName("table");
if(!tableObj.length) {
listObj.innerHTML = "";
}
} else if(this.customSettings.uploadType == 'blog') {
if(typeof switchImagebutton == "function") {
switchImagebutton('imgattachlist');
}
}
var _upload = this;
var _ajax = new Ajax('JSON');
_ajax.get('plugin.php?id=qiniuyun:token',function(res){
if(res.token){
_upload.setUploadURL('http://up.qiniu.com/');
_upload.setFilePostName('file');
_upload.settings.post_params['token'] = res.token;
//console.info(this)
_upload.startUpload();
}
})

} catch (ex)  {
this.debug(ex);
}
}
function serialize(data,sep){
var send_string = '';
for(_key in data){
if(typeof (data[_key])!='object' && typeof (data[_key])!='array'){
if(sep){
send_string += sep+'['+_key+"]="+data[_key]+"&";
}
else{
send_string += _key+"="+data[_key]+"&";
}

}
else{
send_string += serialize(data[_key],_key);
}
}
return send_string;
}

function uploadSuccess1(file, serverData) {
var swfobj = this;
var _ajax = new Ajax('JSON');
serverData = JSON.parse(serverData);
for(_key in swfobj.settings.post_params){
serverData[_key]  = swfobj.settings.post_params[_key];
}
var send_string = serialize(serverData);
_ajax.post('plugin.php?id=qiniuyun:upload&operation=upload',send_string,function(res){

uploadSuccess.call(swfobj,file, res);
})
}

EOF;
 } else { 
$return .= <<<EOF

function uploadSuccess1(file, serverData) {
var swfobj = this;
uploadSuccess.call(swfobj,file, serverData);
}

EOF;
 } 
$return .= <<<EOF

var upload = new SWFUpload({
upload_url: "{$_G['siteurl']}misc.php?mod=swfupload&action=swfupload&operation=upload&fid={$_G['fid']}",
post_params: {"uid" : "{$_G['uid']}", "hash":"{$swfconfig['hash']}"},
file_size_limit : "{$swfconfig['max']}",
file_types : "{$swfconfig['attachexts']['ext']}",
file_types_description : "{$swfconfig['attachexts']['depict']}",
file_upload_limit : {$swfconfig['limit']},
file_queue_limit : 0,
swfupload_preload_handler : preLoad,
swfupload_load_failed_handler : loadFailed,
file_dialog_start_handler : fileDialogStart,
file_queued_handler : fileQueued,
file_queue_error_handler : fileQueueError,
file_dialog_complete_handler : fileDialogComplete,
upload_start_handler : uploadStart,
upload_progress_handler : uploadProgress,
upload_error_handler : uploadError,
upload_success_handler : uploadSuccess1,
upload_complete_handler : uploadComplete,
button_image_url : "{$__IMGDIR}/uploadbutton_small.png",
button_placeholder_id : "spanButtonPlaceholder",
button_width: 17,
button_height: 25,
button_cursor:SWFUpload.CURSOR.HAND,
button_window_mode: "transparent",
custom_settings : {
progressTarget : "attachlist",
uploadSource: 'forum',
uploadType: 'attach',

EOF;
 if($swfconfig['maxsizeperday']) { 
$return .= <<<EOF

maxSizePerDay: {$swfconfig['maxsizeperday']},

EOF;
 } if($swfconfig['maxattachnum']) { 
$return .= <<<EOF

maxAttachNum: {$swfconfig['maxattachnum']},

EOF;
 } 
$return .= <<<EOF

uploadFrom: 'fastpost'
},
debug: false
});
</script>

EOF;
?>