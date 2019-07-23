function openxiaomyDialog(tag) {
	checkFocus();
	showWXDialog(tag);
	return;
}

function showWXDialog(tag, params) {
	var sel, selection;
	var str = '', strdialog = 0;
	var ctrlid = editorid + (params ? '_cst' + params + '_' : '_') + tag;
	var opentag = '[' + tag + ']';
	var closetag = '[/' + tag + ']';
	var menu = $(ctrlid + '_menu');
	var pos = [0, 0];
	var menuwidth = 450;
	var menupos = '43!';
	var menutype = 'menu';
	selection = sel ? (wysiwyg ? sel.htmlText : sel.text) : getSel();	
	intputhtml = '<p class="pbn"><input name="wxurl"  id="wxurl"   class="px" style="width: 370px;height:25px;" type="text"></p>';
	menupos = '00';
	menutype = 'win';
	var menu = document.createElement('div');
	menu.id = ctrlid + '_menu';
	menu.style.display = 'none';
	menu.className = 'p_pof upf';
	menu.style.width = menuwidth + 'px';
	if(menupos == '00') {
			menu.className = 'fwinmask';
			s = '<table width="100%" cellpadding="0" cellspacing="0" class="fwin"><tr><td class="t_l"></td><td class="t_c"></td><td class="t_r"></td></tr><tr><td class="m_l">&nbsp;&nbsp;</td><td class="m_c">'
				+ '<h3 class="flb">' + xiaomytitle + '<span><a onclick="hideMenu(\'\', \'win\');return false;" class="flbc" href="javascript:;"></a></span></h3><div class="c">' + intputhtml + '</div>'
				+ '<p class="o pns"><button type="submit" id="' + ctrlid + '_submit" class="pn pnc"><strong>'+btntitle+'</strong></button></p>'
				+ '</td><td class="m_r"></td></tr><tr><td class="b_l"></td><td class="b_c"></td><td class="b_r"></td></tr></table>';
		} else {
			s = '<div class="p_opt cl"><span class="y" style="margin:-10px -10px 0 0"><a onclick="hideMenu();return false;" class="flbc" href="javascript:;"></a></span><div>' + intputhtml + '</div><div class="pns mtn"><button type="submit" id="' + ctrlid + '_submit" class="pn pnc"><strong>'+xiaomytitle+'</strong></button></div></div>';
		}
	menu.innerHTML = s;
	$(editorid + '_editortoolbar').appendChild(menu);
	showMenu({'ctrlid':ctrlid,'mtype':menutype,'evt':'click','duration':3,'cache':0,'drag':1,'pos':menupos});

	try {
		if($(ctrlid + '_param_1')) {
			$(ctrlid + '_param_1').focus();
		}
	} catch(e) {}
	var objs = menu.getElementsByTagName('*');
	for(var i = 0; i < objs.length; i++) {
		_attachEvent(objs[i], 'keydown', function(e) {
			e = e ? e : event;
			obj = BROWSER.V   ? event.srcElement : e.target;
			if((obj.type == 'text' && e.keyCode == 13) || (obj.type == 'textarea' && e.ctrlKey && e.keyCode == 13)) {
				if($(ctrlid + '_submit') && tag != 'image') $(ctrlid + '_submit').click();
				doane(e);
			} else if(e.keyCode == 27) {
				hideMenu();
				doane(e);
			}
		});
	}
	if($(ctrlid + '_submit')) $(ctrlid + '_submit').onclick = function() {
		checkFocus();
		var wxurl = document.getElementById('wxurl').value;
		showDialog('<div><p class="mbn">'+loadtitle+'</p><p><img src="source/plugin/xiaomy_getwxarticle/css/ajax_loader.gif" alt="" /></p></div>', 'notice', '', null, 1);
		sendAjaxrequest('plugin.php?id=xiaomy_getwxarticle:getwxarticle&formhash='+formhash+'&wechaturl='+escape(wxurl));
		hideMenu('', 'win');
		hideMenu();
	};
}

var xiaomyReq;

function sendAjaxrequest(url) {  
	try {  
    	xiaomyReq = new ActiveXObject("Msxml2.XMLHTTP");
    }  
    catch(E) {  
        try {  
        	xiaomyReq = new ActiveXObject("Microsoft.XMLHTTP");
        }  
        catch(E) {  
        	xiaomyReq = new XMLHttpRequest();
        }  
    }                               
    xiaomyReq.open("post", url, true);  
    xiaomyReq.onreadystatechange = stateChanged; 
    xiaomyReq.send(null);  
}  

function stateChanged() {  
    if (xiaomyReq.readyState == 4) {  
        if (xiaomyReq.status == 200) {  
            var text = xiaomyReq.responseText;
            var json=JSON.parse(text);
            var sel;
    		document.getElementById('subject').value=json.subject;
    		//document.getElementById('e_textarea').value=json.message;
    			parent.ATTACHORIMAGE = 1;
    			parent.setbodycontent(json.message);
        }  
    } 
} 


function setbodycontent(msg) {
	hideMenu('fwin_dialog', 'dialog');
	//alert(msg);
	if(msg == ''  ||  msg==null) {
		showError(laodfail);
	} else {
		ajaxget('forum.php?mod=ajax&action=imagelist&pid=' + pid + '&posttime=' + $('posttime').value + (!fid ? '' : '&fid=' + fid), 
				'imgattachlist', null, null, null, function(){
						if(wysiwyg) {
								editdoc.body.innerHTML = msg;
								switchEditor(0);
								switchEditor(1)
						} else {
								textobj.value = msg;
						}
					}
		);
		switchImagebutton('imgattachlist');
		$('imgattach_notice').style.display = '';
		showDialog(laodsucess, 'right', null, null, 0, null, null, null, null, 3);
	}
	hideMenu();
}