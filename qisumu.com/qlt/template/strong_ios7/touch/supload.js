var JSLOADED = [];

function s_setid(id) {
	return !id ? null : document.getElementById(id);
}
function uploadWindow(fid, recall, type) {	
	
	var type = isUndefined(type) ? 'image' : type;
	UPLOADWINRECALL = recall;	
	$('#weipost_sortoptions').load('./forum.php?mod=misc&action=upload&fid=' + fid + '&type=' + type + 'mobile=2')
}

function hideWindow(k) {
 	$("#"+k).remove();
}

function showError(msg) {
	var p = /<script[^\>]*?>([^\x00]*?)<\/script>/ig;
	msg = msg.replace(p, '');
	if(msg !== '') {
		showDialog(msg, 'alert', '´íÎóÐÅÏ¢', null, true, null, '', '', '', 3);
	}
}

function updatetradeattach(aid, url, attachurl) {
	s_setid('tradeaid').value = aid;
	s_setid('tradeattach_image').innerHTML = '<img src="' + attachurl + '/' + url + '" class="spimg" />';
	ATTACHORIMAGE = 1;
}

function updateactivityattach(aid, url, attachurl) {
	s_setid('activityaid').value = aid;
	s_setid('activityattach_image').innerHTML = '<img src="' + attachurl + '/' + url + '" class="spimg" />';
	ATTACHORIMAGE = 1;
}

function updatesortattach(aid, url, attachurl, identifier) {	
	s_setid('sortaid_' + identifier).value = aid;
	s_setid('sortattachurl_' + identifier).value = attachurl + '/' + url;
	s_setid('sortattach_image_' + identifier).innerHTML = '<img src="' + attachurl + '/' + url + '" class="spimg" />';
	ATTACHORIMAGE = 1;
}

function uploadWindowstart() {
	alert();
	s_setid('uploadwindowing').style.visibility = 'visible';
}

function uploadWindowload() {	
	s_setid('uploadwindowing').style.visibility = 'hidden';
	var str = s_setid('uploadattachframe').contentWindow.document.body.innerHTML;
	if(str == '') return;	
	var arr = str.split('|');
	if(arr[0] == 'DISCUZUPLOAD' && arr[2] == 0) {
		UPLOADWINRECALL(arr[3], arr[5], arr[6]);
		hideWindow('sortupfile');
	} else {
		var sizelimit = '';
		if(arr[7] == 'ban') {
			sizelimit = '(附件类型被禁止)';
		} else if(arr[7] == 'perday') {
			sizelimit = '(不能超过 ' + arr[8] + ' 字节)';
		} else if(arr[7] > 0) {
			sizelimit = '(不能超过 ' + arr[7] + ' 字节)';
		}
		showError(STATUSMSG[arr[2]] + sizelimit);
	}
	if(s_setid('attachlimitnotice')) {
		ajaxget('forum.php?mod=ajax&action=updateattachlimit&fid=' + fid, 'attachlimitnotice');
	}
	
}

var showDialogST = null;
function showDialog(msg, mode, t, func, cover, funccancel, leftmsg, confirmtxt, canceltxt, closetime, locationtime) {
	clearTimeout(showDialogST);
	cover = isUndefined(cover) ? (mode == 'info' ? 0 : 1) : cover;
	leftmsg = isUndefined(leftmsg) ? '' : leftmsg;
	mode = in_array(mode, ['confirm', 'notice', 'info', 'right']) ? mode : 'alert';
	var menuid = 'fwin_dialog';
	var menuObj = s_setid(menuid);
	var showconfirm = 1;
	confirmtxtdefault = 'È·¶¨';
	closetime = isUndefined(closetime) ? '' : closetime;
	closefunc = function () {
		if(typeof func == 'function') func();
		else eval(func);
		hideMenu(menuid, 'dialog');
	};
	if(closetime) {
		showPrompt(null, null, '<i>' + msg + '</i>', closetime * 1000, 'popuptext');
		return;
	}
	locationtime = isUndefined(locationtime) ? '' : locationtime;
	if(locationtime) {
		leftmsg = locationtime + ' ÃëºóÒ³ÃæÌø×ª';
		showDialogST = setTimeout(closefunc, locationtime * 1000);
		showconfirm = 0;
	}
	confirmtxt = confirmtxt ? confirmtxt : confirmtxtdefault;
	canceltxt = canceltxt ? canceltxt : 'È¡Ïû';

	if(menuObj) hideMenu('fwin_dialog', 'dialog');
	menuObj = document.createElement('div');
	menuObj.style.display = 'none';
	menuObj.className = 'fwinmask';
	menuObj.id = menuid;
	s_setid('append_parent').appendChild(menuObj);
	var hidedom = '';
	if(!BROWSER.ie) {
		hidedom = '<style type="text/css">object{visibility:hidden;}</style>';
	}
	var s = hidedom + '<table cellpadding="0" cellspacing="0" class="fwin"><tr><td class="t_l"></td><td class="t_c"></td><td class="t_r"></td></tr><tr><td class="m_l">&nbsp;&nbsp;</td><td class="m_c"><h3 class="flb"><em>';
	s += t ? t : 'ÌáÊ¾ÐÅÏ¢';
	s += '</em><span><a href="javascript:;" id="fwin_dialog_close" class="flbc" onclick="hideMenu(\'' + menuid + '\', \'dialog\')" title="¹Ø±Õ">¹Ø±Õ</a></span></h3>';
	if(mode == 'info') {
		s += msg ? msg : '';
	} else {
		s += '<div class="c altw"><div class="' + (mode == 'alert' ? 'alert_error' : (mode == 'right' ? 'alert_right' : 'alert_info')) + '"><p>' + msg + '</p></div></div>';
		s += '<p class="o pns">' + (leftmsg ? '<span class="z xg1">' + leftmsg + '</span>' : '') + (showconfirm ? '<button id="fwin_dialog_submit" value="true" class="pn pnc"><strong>'+confirmtxt+'</strong></button>' : '');
		s += mode == 'confirm' ? '<button id="fwin_dialog_cancel" value="true" class="pn" onclick="hideMenu(\'' + menuid + '\', \'dialog\')"><strong>'+canceltxt+'</strong></button>' : '';
		s += '</p>';
	}
	s += '</td><td class="m_r"></td></tr><tr><td class="b_l"></td><td class="b_c"></td><td class="b_r"></td></tr></table>';
	menuObj.innerHTML = s;
	if(s_setid('fwin_dialog_submit')) s_setid('fwin_dialog_submit').onclick = function() {
		if(typeof func == 'function') func();
		else eval(func);
		hideMenu(menuid, 'dialog');
	};
	if(s_setid('fwin_dialog_cancel')) {
		s_setid('fwin_dialog_cancel').onclick = function() {
			if(typeof funccancel == 'function') funccancel();
			else eval(funccancel);
			hideMenu(menuid, 'dialog');
		};
		s_setid('fwin_dialog_close').onclick = s_setid('fwin_dialog_cancel').onclick;
	}
	showMenu({'mtype':'dialog','menuid':menuid,'duration':3,'pos':'00','zindex':JSMENU['zIndex']['dialog'],'cache':0,'cover':cover});
	try {
		if(s_setid('fwin_dialog_submit')) s_setid('fwin_dialog_submit').focus();
	} catch(e) {}
}


