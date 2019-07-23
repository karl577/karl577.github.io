function getStyle(obj,name)
{
	if(obj.currentStyle)
	{
		return obj.currentStyle[name]
	}
	else
	{
		return getComputedStyle(obj,false)[name]
	}
}

function getByClass(oParent,nClass)
{
	var eLe = oParent.getElementsByTagName('*');
	var aRrent  = [];
	for(var i=0; i<eLe.length; i++)
	{
		if(eLe[i].className == nClass)
		{
			aRrent.push(eLe[i]);
		}
	}
	return aRrent;
}

function startMove(obj,att,add)
{
	clearInterval(obj.timer)
	obj.timer = setInterval(function(){
	   var cutt = 0 ;
	   if(att=='opacity')
	   {
		   cutt = Math.round(parseFloat(getStyle(obj,att)));
	   }
	   else
	   {
		   cutt = Math.round(parseInt(getStyle(obj,att)));
	   }
	   var speed = (add-cutt)/4;
	   speed = speed>0?Math.ceil(speed):Math.floor(speed);
	   if(cutt==add)
	   {
		   clearInterval(obj.timer)
	   }
	   else
	   {
		   if(att=='opacity')
		   {
			   obj.style.opacity = (cutt+speed)/100;
			   obj.style.filter = 'alpha(opacity:'+(cutt+speed)+')';
		   }
		   else
		   {
			   obj.style[att] = cutt+speed+'px';
		   }
	   }
	   
	},30)
}

  window.onload = function()
  {
	  var oDiv = document.getElementById('playBox');
	  var oPre = getByClass(oDiv,'pre')[0];
	  var oNext = getByClass(oDiv,'next')[0];
	  var oUlBig = getByClass(oDiv,'oUlplay')[0];
	  var aBigLi = oUlBig.getElementsByTagName('li');
	  var oDivSmall = getByClass(oDiv,'smalltitle')[0]
	  var aLiSmall = oDivSmall.getElementsByTagName('li');
	  
	  function tab()
	  {
	     for(var i=0; i<aLiSmall.length; i++)
	     {
		    aLiSmall[i].className = '';
	     }
	     aLiSmall[now].className = 'thistitle'
	     startMove(oUlBig,'left',-(now*aBigLi[0].offsetWidth))
	  }
	  var now = 0;
	  for(var i=0; i<aLiSmall.length; i++)
	  {
		  aLiSmall[i].index = i;
		  aLiSmall[i].onclick = function()
		  {
			  now = this.index;
			  tab();
		  }
	 }
	  oPre.onclick = function()
	  {
		  now--
		  if(now ==-1)
		  {
			  now = aBigLi.length;
		  }
		   tab();
	  }
	   oNext.onclick = function()
	  {
		   now++
		  if(now ==aBigLi.length)
		  {
			  now = 0;
		  }
		  tab();
	  }
	  var timer = setInterval(oNext.onclick,3000) //滚动间隔时间设置
	  oDiv.onmouseover = function()
	  {
		  clearInterval(timer)
	  }
	   oDiv.onmouseout = function()
	  {
		  timer = setInterval(oNext.onclick,3000) //滚动间隔时间设置
	  }
  }

$(document).ready(function(e) {
		 $(".moquu_nchannelm").hover(function(){
			 $(this).addClass("moquu_nchannelmr");
			 $(this).find(".moquu_nchannels").show();
		 },function(){
			 $(this).removeClass("moquu_nchannelmr");
			 $(this).find(".moquu_nchannels").hide();
			 });
		$(".moquu_nchannelm").hover(function(){
			 $(this).addClass("moquu_nchannelmr");
			 $(this).find(".moquu_channels").show();
		 },function(){
			 $(this).removeClass("moquu_nchannelmr");
			 $(this).find(".moquu_channels").hide();
			 });	
		$(".moquu_nchannelm").hover(function(){
			 $(this).addClass("moquu_nchannelmr");
			 $(this).find(".moquu_channels2").show();
		 },function(){
			 $(this).removeClass("moquu_nchannelmr");
			 $(this).find(".moquu_channels2").hide();
			 });
		$(".moquu_nchannelm").hover(function(){
			 $(this).addClass("moquu_nchannelmr");
			 $(this).find(".moquu_channels3").show();
		 },function(){
			 $(this).removeClass("moquu_nchannelmr");
			 $(this).find(".moquu_channels3").hide();
			 });
		$(".moquu_searchtext").focusin(function(){
			 $(this).parent().addClass("focus");
			 $(".moquu_searchtext").val("");
		 });
    });
  var urlstr = location.href;
  var urlstatus=false;
  $("#moquu_nnav a").each(function () {
    if ((urlstr + '/').indexOf($(this).attr('href')) > -1&&$(this).attr('href')!='') {
      $(this).addClass('moquu_nhome'); urlstatus = true;
    } else {
      $(this).removeClass('moquu_nhome');
    }
  });
  if (!urlstatus) {$("#moquu_nnav a").eq(0).addClass('moquu_nhome'); }

function b(){h=$(window).height(),t=$(document).scrollTop(),t>h?$("#moquu_top").show():$("#moquu_top").hide()}$(document).ready(function(){b(),$("#moquu_top").click(function(){$(document).scrollTop(0)})}),$(window).scroll(function(){b()});

<!--
//xmlhttp和xmldom对象
var MoquuXHTTP = null;
var MoquuXDOM = null;
var MoquuContainer = null;
var MoquuShowError = false;
var MoquuShowWait = false;
var MoquuErrCon = "";
var MoquuErrDisplay = "下载数据失败";
var MoquuWaitDisplay = "正在下载数据...";

//获取指定ID的元素

function $DE(id) {
    return document.getElementById(id);
}

//gcontainer 是保存下载完成的内容的容器
//mShowError 是否提示错误信息
//MoquuShowWait 是否提示等待信息
//mErrCon 服务器返回什么字符串视为错误
//mErrDisplay 发生错误时显示的信息
//mWaitDisplay 等待时提示信息
//默认调用 MoquuAjax('divid',false,false,'','','')

function MoquuAjax(gcontainer,mShowError,mShowWait,mErrCon,mErrDisplay,mWaitDisplay)
{

    MoquuContainer = gcontainer;
    MoquuShowError = mShowError;
    MoquuShowWait = mShowWait;
    if(mErrCon!="") MoquuErrCon = mErrCon;
    if(mErrDisplay!="") MoquuErrDisplay = mErrDisplay;
    if(mErrDisplay=="x") MoquuErrDisplay = "";
    if(mWaitDisplay!="") MoquuWaitDisplay = mWaitDisplay;


    //post或get发送数据的键值对
    this.keys = Array();
    this.values = Array();
    this.keyCount = -1;
    this.sendlang = 'gb2312';

    //请求头类型
    this.rtype = 'text';

    //初始化xmlhttp
    //IE6、IE5
    if(window.ActiveXObject) {
        try { MoquuXHTTP = new ActiveXObject("Msxml2.XMLHTTP");} catch (e) { }
        if (MoquuXHTTP == null) try { MoquuXHTTP = new ActiveXObject("Microsoft.XMLHTTP");} catch (e) { }
    }
    else {
        MoquuXHTTP = new XMLHttpRequest();
    }

    //增加一个POST或GET键值对
    this.AddKeyN = function(skey,svalue) {
        if(this.sendlang=='utf-8') this.AddKeyUtf8(skey, svalue);
        else this.AddKey(skey, svalue);
    };
    
    this.AddKey = function(skey,svalue) {
        this.keyCount++;
        this.keys[this.keyCount] = skey;
        svalue = svalue+'';
        if(svalue != '') svalue = svalue.replace(/\+/g,'$#$');
        this.values[this.keyCount] = escape(svalue);
    };

    //增加一个POST或GET键值对
    this.AddKeyUtf8 = function(skey,svalue) {
        this.keyCount++;
        this.keys[this.keyCount] = skey;
        svalue = svalue+'';
        if(svalue != '') svalue = svalue.replace(/\+/g,'$#$');
        this.values[this.keyCount] = encodeURI(svalue);
    };

    //增加一个Http请求头键值对
    this.AddHead = function(skey,svalue) {
        this.rkeyCount++;
        this.rkeys[this.rkeyCount] = skey;
        this.rvalues[this.rkeyCount] = svalue;
    };

    //清除当前对象的哈希表参数
    this.ClearSet = function() {
        this.keyCount = -1;
        this.keys = Array();
        this.values = Array();
        this.rkeyCount = -1;
        this.rkeys = Array();
        this.rvalues = Array();
    };


    MoquuXHTTP.onreadystatechange = function() {
        //在IE6中不管阻断或异步模式都会执行这个事件的
        if(MoquuXHTTP.readyState == 4){
            if(MoquuXHTTP.status == 200)
            {
                if(MoquuXHTTP.responseText!=MoquuErrCon) {
                    MoquuContainer.innerHTML = MoquuXHTTP.responseText;
                }
                else {
                    if(MoquuShowError) MoquuContainer.innerHTML = MoquuErrDisplay;
                }
                MoquuXHTTP = null;
            }
            else { if(MoquuShowError) MoquuContainer.innerHTML = MoquuErrDisplay; }
        }
        else { if(MoquuShowWait) MoquuContainer.innerHTML = MoquuWaitDisplay; }
    };

    //检测阻断模式的状态
    this.BarrageStat = function() {
        if(MoquuXHTTP==null) return;
        if(typeof(MoquuXHTTP.status)!=undefined && MoquuXHTTP.status == 200)
        {
            if(MoquuXHTTP.responseText!=MoquuErrCon) {
                MoquuContainer.innerHTML = MoquuXHTTP.responseText;
            }
            else {
                if(MoquuShowError) MoquuContainer.innerHTML = MoquuErrDisplay;
            }
        }
    };

    //发送http请求头
    this.SendHead = function()
    {
        //发送用户自行设定的请求头
        if(this.rkeyCount!=-1)
        { 
            for(var i = 0;i<=this.rkeyCount;i++)
            {
                MoquuXHTTP.setRequestHeader(this.rkeys[i],this.rvalues[i]);
            }
        }
        　if(this.rtype=='binary'){
        　MoquuXHTTP.setRequestHeader("Content-Type","multipart/form-data");
    }else{
        MoquuXHTTP.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    }
};

//用Post方式发送数据
this.SendPost = function(purl) {
    var pdata = "";
    var i=0;
    this.state = 0;
    MoquuXHTTP.open("POST", purl, true);
    this.SendHead();
    //post数据
    if(this.keyCount!=-1)
    {
        for(;i<=this.keyCount;i++)
        {
            if(pdata=="") pdata = this.keys[i]+'='+this.values[i];
            else pdata += "&"+this.keys[i]+'='+this.values[i];
        }
    }
    MoquuXHTTP.send(pdata);
};

//用GET方式发送数据
this.SendGet = function(purl) {
    var gkey = "";
    var i=0;
    this.state = 0;
    //get参数
    if(this.keyCount!=-1)
    { 
        for(;i<=this.keyCount;i++)
        {
            if(gkey=="") gkey = this.keys[i]+'='+this.values[i];
            else gkey += "&"+this.keys[i]+'='+this.values[i];
        }
        if(purl.indexOf('?')==-1) purl = purl + '?' + gkey;
        else  purl = purl + '&' + gkey;
    }
    MoquuXHTTP.open("GET", purl, true);
    this.SendHead();
    MoquuXHTTP.send(null);
};

//用GET方式发送数据，阻塞模式
this.SendGet2 = function(purl) {
    var gkey = "";
    var i=0;
    this.state = 0;
    //get参数
    if(this.keyCount!=-1)
    { 
        for(;i<=this.keyCount;i++)
        {
            if(gkey=="") gkey = this.keys[i]+'='+this.values[i];
            else gkey += "&"+this.keys[i]+'='+this.values[i];
        }
        if(purl.indexOf('?')==-1) purl = purl + '?' + gkey;
        else  purl = purl + '&' + gkey;
    }
    MoquuXHTTP.open("GET", purl, false);
    this.SendHead();
    MoquuXHTTP.send(null);
    //firefox中直接检测XHTTP状态
    this.BarrageStat();
};

//用Post方式发送数据
this.SendPost2 = function(purl) {
    var pdata = "";
    var i=0;
    this.state = 0;
    MoquuXHTTP.open("POST", purl, false);
    this.SendHead();
    //post数据
    if(this.keyCount!=-1)
    {
        for(;i<=this.keyCount;i++)
        {
            if(pdata=="") pdata = this.keys[i]+'='+this.values[i];
            else pdata += "&"+this.keys[i]+'='+this.values[i];
        }
    }
    MoquuXHTTP.send(pdata);
    //firefox中直接检测XHTTP状态
    this.BarrageStat();
};


} // End Class MoquuAjax

//初始化xmldom
function InitXDom() {
    if(MoquuXDOM!=null) return;
    var obj = null;
    // Gecko、Mozilla、Firefox
    if (typeof(DOMParser) != "undefined") { 
        var parser = new DOMParser();
        obj = parser.parseFromString(xmlText, "text/xml");
    }
    // IE
    else { 
        try { obj = new ActiveXObject("MSXML2.DOMDocument");} catch (e) { }
        if (obj == null) try { obj = new ActiveXObject("Microsoft.XMLDOM"); } catch (e) { }
    }
    MoquuXDOM = obj;
};



//读写cookie函数
function GetCookie(c_name)
{
    if (document.cookie.length > 0)
    {
        c_start = document.cookie.indexOf(c_name + "=")
        if (c_start != -1)
        {
            c_start = c_start + c_name.length + 1;
            c_end   = document.cookie.indexOf(";",c_start);
            if (c_end == -1)
            {
                c_end = document.cookie.length;
            }
            return unescape(document.cookie.substring(c_start,c_end));
        }
    }
    return null
}

function SetCookie(c_name,value,expiredays)
{
    var exdate = new Date();
    exdate.setDate(exdate.getDate() + expiredays);
    document.cookie = c_name + "=" +escape(value) + ((expiredays == null) ? "" : ";expires=" + exdate.toGMTString()); //使设置的有效时间正确。增加toGMTString()
}



	$(function(){
		$("a[_for]").mouseover(function(){
			$(this).parents().children("a[_for]").removeClass("thisclass").parents().children("dd").hide();
			$(this).addClass("thisclass").blur();
			$("#"+$(this).attr("_for")).show();
		});
		$("a[_for=uc_member]").mouseover();
		$("a[_for=flink_1]").mouseover();
	});
	
	function CheckLogin(){
	  var taget_obj = document.getElementById('logindiy');
	  myajax = new MoquuAjax(taget_obj,false,false,'','','');
	  myajax.SendGet2("/u/moquu.php");
	  MoquuXHTTP = null;
	}
function postDigg(ftype,aid)
{
	var taget_obj = document.getElementById('newdigg');
	var saveid = GetCookie('diggid');
	if(saveid != null)
	{
		var saveids = saveid.split(',');
		var hasid = false;
		saveid = '';
		j = 1;
		for(i=saveids.length-1;i>=0;i--)
		{
			if(saveids[i]==aid && hasid) continue;
			else {
				if(saveids[i]==aid && !hasid) hasid = true;
				saveid += (saveid=='' ? saveids[i] : ','+saveids[i]);
				j++;
				if(j==20 && hasid) break;
				if(j==19 && !hasid) break;
			}
		}
		if(hasid) { alert("小主大人，您已经赞过该作品 ！"); return; }
		else saveid += ','+aid;
		SetCookie('diggid',saveid,1);
	}
	else
	{
		SetCookie('diggid',aid,1);
	}
	myajax = new MoquuAjax(taget_obj,false,false,'','','');
	var url = "/moquu/good.php?action="+ftype+"&id="+aid;
	myajax.SendGet2(url);
}
function getDigg(aid)
{
	var taget_obj = document.getElementById('newdigg');
	myajax = new MoquuAjax(taget_obj,false,false,'','','');
	myajax.SendGet2("/moquu/good.php?id="+aid);
	MoquuXHTTP = null;
}