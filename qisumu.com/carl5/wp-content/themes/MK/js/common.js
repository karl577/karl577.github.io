jQuery(document).ready(function(e){$body=window.opera?document.compatMode=="CSS1Compat"?e("html"):e("body"):e("html,body"),e("#roll_up").mouseover(function(){mk=setInterval(function(){e(window).scrollTop(e(window).scrollTop()-1)},50)}).mouseout(function(){clearInterval(mk)}).click(function(){$body.animate({scrollTop:0},400)}),e("#roll_down").mouseover(function(){mk=setInterval(function(){e(window).scrollTop(e(window).scrollTop()+1)},50)}).mouseout(function(){clearInterval(mk)}).click(function(){$body.animate({scrollTop:e(document).height()},400)}),e("#roll_comment").click(function(){$body.animate({scrollTop:e("#comment").offset().top},400)})})

function runCode(objid) {
	var winname = window.open('', "_blank", '');
	var obj = document.getElementById(objid);
	winname.document.open('text/html', 'replace');
	winname.opener = null; // 防止代码对新版页面修改
	winname.document.write(obj.value);
	winname.document.close();
}
function selectCode(objid){
    var obj = document.getElementById(objid);
    obj.select();
}