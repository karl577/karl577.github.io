/**
 *      A plugin for user to get a article from weixin
 *      version: 1.1.2
 *      author: Kim.L, email: pxbeta@qq.com
 *      $Id: wxart.js 2017/01/09 $
 */
function bindWxart(){checkFocus();showWxartMenu();return false}function showWxartMenu(){var sel,selection;var str="",strdialog=0,stitle="";var ctrlid="ex_wxart";var menu=$(ctrlid+"_menu");var pos=[0,0];var menuwidth=270;var menupos="43!";var menutype="menu";if(BROWSER.ie){sel=wysiwyg?editdoc.selection.createRange():document.selection.createRange();pos=getCaret()}selection=sel?(wysiwyg?sel.htmlText:sel.text):getSel();if(menu){if($(ctrlid).getAttribute("menupos")!==null){menupos=$(ctrlid).getAttribute("menupos")}if($(ctrlid).getAttribute("menuwidth")!==null){menu.style.width=$(ctrlid).getAttribute("menuwidth")+"px"}showMenu({"ctrlid":ctrlid,"evt":"click","pos":menupos,"timeout":250,"duration":3,"drag":1})}else{str='<p class="pbn">'+wxlang["title"]+'</p><p class="pbn"><textarea type="text" id="'+ctrlid+'_param_1" class="txtarea" value="" style="width:98%;" rows="5"></textarea></p>';var menu=document.createElement("div");menu.id=ctrlid+"_menu";menu.style.display="none";menu.className="p_pof upf";menu.style.width=menuwidth+"px";s='<div class="p_opt cl"><span class="y" style="margin:-10px -10px 0 0"><a onclick="hideMenu();return false;" class="flbc" href="javascript:;">�ر�</a></span><div>'+str+'</div><div class="pns mtn"><button type="submit" id="'+ctrlid+'_submit" class="pn pnc"><strong>'+wxlang["btn_text"]+"</strong></button></div></div>";menu.innerHTML=s;$(editorid+"_editortoolbar").appendChild(menu);showMenu({"ctrlid":ctrlid,"mtype":menutype,"evt":"click","duration":3,"cache":0,"drag":1,"pos":menupos})}try{if($(ctrlid+"_param_1")){$(ctrlid+"_param_1").focus()}}catch(e){}var objs=menu.getElementsByTagName("*");for(var i=0;i<objs.length;i++){_attachEvent(objs[i],"keydown",function(e){e=e?e:event;obj=BROWSER.ie?event.srcElement:e.target;if((obj.type=="text"&&e.keyCode==13)||(obj.type=="textarea"&&e.ctrlKey&&e.keyCode==13)){if($(ctrlid+"_submit")&&tag!="image"){$(ctrlid+"_submit").click()}doane(e)}else{if(e.keyCode==27){hideMenu();doane(e)}}})}if($(ctrlid+"_submit")){$(ctrlid+"_submit").onclick=function(){checkFocus();if(BROWSER.ie&&wysiwyg){setCaret(pos[0])}var url=$(ctrlid+"_param_1").value;if(!/^(http|https):\/\/mp\.weixin\.qq\.com/.test(url)){showDialog("<p>"+wxlang["error"]+'</p><p class="xg1">http://mp.weixin.qq.com/s?__biz=MzA3NTI2MjIxMg==&mid=...</p>',"alert");return true}showDialog('<div id="wxartinfo" style="padding:30px;"><p class="mbn">'+wxlang["catching"]+'</p><p><br/><img src="'+STATICURL+'image/common/uploading.gif" alt="" /></p></div>',"info");var x=new Ajax("HTML");x.get("plugin.php?id=wxart&wysiwyg="+wysiwyg+"&url="+encodeURIComponent(url),function(s){hideMenu("fwin_dialog","dialog");if(s=="error"){showDialog('<div id="wxartinfo">'+wxlang["catch_error"]+"</div>","alert","",null,0,null,"","",3);return true}else{if(s=="permission deny"){showDialog('<div id="wxartinfo">'+wxlang["no_right"]+"</div>","alert","",null,0,null,"","",3);return true}}checkFocus();var ret=s.split("{@@}");insertText((wysiwyg==1?htmlspecialcharsDecode(ret[1].replace(/\{n\}/g,"\n")):ret[1].replace(/\{n\}/g,"\n")),0,0,false);$("subject").value=$("subject").value.length>3?$("subject").value:ret[0]});hideMenu()}}}function htmlspecialcharsDecode(str){str=str.replace(/&nbsp;/g," ");str=str.replace(/&amp;/g,"&");str=str.replace(/&lt;/g,"<");str=str.replace(/&gt;/g,">");str=str.replace(/&quot;/g,'"');str=str.replace(/&#039;/g,"'");return str};