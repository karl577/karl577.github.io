function cr180_scrollTop(obj){
	// obj为滚动到对象
	var Top = jQc(obj).offset().top;
	if(Top){
		Top = Top -75;
		jQc('html,body').animate({scrollTop:Top},500);
	}
}

function cr180_sidepic_nextpage(Obj,num,onceheight,movetitle){
	var IMGlist = jQuery('#'+Obj+'_c .cr_img_list');
	if(num && onceheight){
		var Length = IMGlist.length;
		var page = Math.ceil(Length / num);
		var pageH = '';
		for(i=0;i<page;i++){
			if(i == 0){
				pageH += '<span class="a"></span>';
			}else{
				pageH += '<span></span>';
			}
		}
		jQuery('#'+Obj+'_t').html(pageH);
		jQuery('#'+Obj+'_b').css({'height':(num * onceheight)+'px'});
		jQuery('#'+Obj+'_t span').each(function(index,ele){
			jQuery(ele).click(function(){
				jQuery('#'+Obj+'_t span').removeClass('a').eq(index).addClass('a');
				jQuery('#'+Obj+'_c').animate({top:'-'+(onceheight *index * num)+'px'});
			});
		});
	}
	if(movetitle == "1"){
		IMGlist.mouseenter(function(){
			jQuery(this).find('.cr_img_text').animate({height:'50px'},200);
		}).mouseleave(function(){
			jQuery(this).find('.cr_img_text').animate({height:'0px'},200);
		});
	}

	if(movetitle == "2"){
		IMGlist.mouseenter(function(){
			jQuery(this).find('.cr_img_text_bg').animate({opacity:'0.5'},200);
		}).mouseleave(function(){
			jQuery(this).find('.cr_img_text_bg').animate({opacity:'0.2'},200);
		});
	}
}

function dgtle_sidepic_a(boxid,boxwidth,times){
	var boxwidth = parseInt(boxwidth);
	var times = parseInt(times);
	if(!times) times = 3000;
	var obj = jQuery(boxid);
	obj.attr('index',0);
	var length = obj.find('.cr_piclist ul li').length;
	obj.find('.cr_piclist ul').css('width',((boxwidth * length) +10)+'px');
	var Auto = function(T){
		var index = obj.attr('index');
		if(T =='+'){
			index ++;
		}
		if(T =='-'){
			index --;
		}
		if(index >= length || index <=0){
			index = 0;
		}
		var moveWidth = boxwidth * index;
		obj.find('.cr_piclist ul').animate({'margin-left':'-'+moveWidth+'px'});
		if(!T) index ++;
		if(index >= length){
			index = 0;
		}
		obj.attr('index',index);
	}
	var S = setInterval(Auto, times);
	obj.find('.cr_pre').click(function(){
		Auto('-');
	});
	obj.find('.cr_next').click(function(){
		Auto('+');
	});
	obj.mouseenter(function(){
		clearInterval(S);
		obj.addClass('a');
	}).mouseleave(function(){
		S = setInterval(Auto, times);
		obj.removeClass('a');
	});
}
// function dgtle_body_bgimg(n){
// 	jQuery('#dgtle_body_bg').css('background-image','url(./template/dgstyle/cr180_static/images/style/bg_s'+n+'.jpg)');
// 	setcookie('dgtle_body_bg',n);
// }

// 轮播功能 acwong 2014.11
function dgtle_slider(id,width) {
	var sliderBox = jQuery('#' + id),
		sliderW = width,
		sliderUl = sliderBox.find('.slider'),
		sliderLis = sliderUl.find('li'),
		btnList = sliderBox.find('.slider_btn'),
		len = sliderLis.length,
		firstLi = sliderLis.eq(0),
		lastLi = sliderLis.eq(len - 1),
		next = sliderBox.find('.next'),
		pre = sliderBox.find('.pre'),
		timer = 0,
		index = 0;

	for (var i = 0; i < len; i++) {
		btnList.append(jQuery('<li>'));
	}
	firstLi.clone().appendTo(sliderUl);
	lastLi.clone().prependTo(sliderUl);
	sliderLis = sliderUl.find('li');
	len = sliderLis.length;
    sliderLis.find('img').css('min-width', width + 'px');

	sliderUl.css({
		'width': len * sliderW + 'px',
		'left': -sliderW + 'px'
	});
	showBtn(index);

	btnList.find('li').on('click', function() {
		if (sliderUl.is(':animated')) {
			return false;
		}
		var newLeft = (jQuery(this).index() + 1) * -sliderW + 'px';
		sliderUl.animate({'left': newLeft}, 500);
		index = jQuery(this).index();
		showBtn(index);
	});

	next.on('click', nextMove);
	pre.on('click', preMove);

	timer = setInterval(nextMove,5000);
	sliderBox.hover(function() {
		clearInterval(timer);
	}, function() {
		timer = setInterval(nextMove,5000);
	});

	function nextMove() {
		if (sliderUl.is(':animated')) {
            return false;
        }
        var left = parseInt(sliderUl.css('left'));
        if (left === -sliderW * (len - 2)) {
        	sliderUl.css('left', '0px');
        }
        sliderAnimate(-sliderW);
        if (index === len - 3) {
        	index = 0;
        } else {
        	index++;
        }
        showBtn(index);
	}

	function preMove() {
		if (sliderUl.is(':animated')) {
            return false;
        }
        var left = parseInt(sliderUl.css('left'));
        if (left === 0) {
        	sliderUl.css('left', -sliderW * (len - 2) + 'px');
        }
        sliderAnimate(sliderW);
        if (index === 0) {
        	index = len - 3;
        } else {
        	index--;
        }
        showBtn(index);
	}

	function sliderAnimate(offset) {
		var newLeft = parseInt(sliderUl.css('left')) + offset + 'px';
		sliderUl.animate({'left': newLeft}, 500);
	}

	function showBtn(index) {
		btnList.find('li').eq(index).addClass('selected').siblings().removeClass('selected');
	}
}

// 轮播功能2 zjj 2015.6
function dgtle_slider2(id,width) {
	var sliderBox = jQuery('#' + id),
		sliderW = width,
		sliderUl = sliderBox.find('.slider'),
		sliderLis = sliderUl.find('li'),
		sliderimgs = sliderLis.find('img'),
		btnList = sliderBox.find('.slider_btn'),
		len = sliderLis.length,
		firstLi =jQuery('<li>'),
		lastLi = jQuery('<li>'),
		firstImg =jQuery('<img>'),
		lastImg = jQuery('<img>'),
		next = sliderBox.find('.next'),
		pre = sliderBox.find('.pre'),
		timer = 0,
		index = 0;

	firstImg.attr("src",sliderimgs.eq(0).attr("src"));
	firstImg.attr("title",sliderimgs.eq(0).attr("title"));
	lastImg.attr("src",sliderimgs.eq(len - 1).attr("src"));
	lastImg.attr("title",sliderimgs.eq(len - 1).attr("title"));
	firstLi.append(firstImg);
	lastLi.append(lastImg);
	
	for (var i = 0; i < len; i++) {
		btnList.append(jQuery('<li>'));
		var btnli=btnList.find('li');
		var btnimg=jQuery('<img>');
		btnimg.attr("src",sliderimgs.eq(i).attr("src"));
		btnimg.attr("title",sliderimgs.eq(i).attr("title"));
		btnli.eq(i).append(btnimg);

	}
	var btnlist_margin=(jQuery("#index_slider").width()-btnList.find('li').outerWidth(true)*btnList.find('li').size())/2;
	btnlist_margin=(btnlist_margin<=0)?0:btnlist_margin;
	btnList.css("margin-left",btnlist_margin+"px");

	sliderUl.append(firstLi);
	sliderUl.prepend(lastLi);
	sliderLis = sliderUl.find('li');
	len = sliderLis.length;
    sliderLis.find('img').css('width', width + 'px');

	sliderUl.css({
		'width': len * sliderW + 'px',
		'left': -sliderW + 'px'
	});
	showBtn(index);

	btnList.find('li').hover(function() {
		var btn_index=jQuery(this).index();
		 btntimer = setTimeout(function(){
		       var newLeft = (btn_index + 1) * -sliderW + 'px';
				sliderUl.animate({'left': newLeft}, 500);
				showBtn(btn_index);
				index=btn_index;
		    	},200);
		},function(){
		    clearTimeout(btntimer);
		});

	next.on('click', nextMove);
	pre.on('click', preMove);

	timer = setInterval(nextMove,5000);
	sliderBox.hover(function() {
		clearInterval(timer);
	}, function() {
		timer = setInterval(nextMove,5000);
	});

	function nextMove() {
		if (sliderUl.is(':animated')) {
            return false;
        }
        var left = parseInt(sliderUl.css('left'));
        if (left === -sliderW * (len - 2)) {
        	sliderUl.css('left', '0px');
        }
        sliderAnimate(-sliderW);
        if (index === len - 3) {
        	index = 0;
        } else {
        	index++;
        }
        showBtn(index);
	}

	function preMove() {
		if (sliderUl.is(':animated')) {
            return false;
        }
        var left = parseInt(sliderUl.css('left'));
        if (left === 0) {
        	sliderUl.css('left', -sliderW * (len - 2) + 'px');
        }
        sliderAnimate(sliderW);
        if (index === 0) {
        	index = len - 3;
        } else {
        	index--;
        }
        showBtn(index);
	}

	function sliderAnimate(offset) {
		var newLeft = parseInt(sliderUl.css('left')) + offset + 'px';
		sliderUl.animate({'left': newLeft}, 500);
	}

	function showBtn(index) {
		btnList.find('li').eq(index).addClass('selected').siblings().removeClass('selected');
	}
}
// 首页尾巴体验 acwong 2014.12
function dg_exp() {
	var exp_new_ul;
	var list_length = 0;
	var move_times = 0;
	var height_more_times = 0;
	var ajax_count =1;
	var pre_btn = jQuery('.move_left');
	var next_btn = jQuery('.move_right');
	var new_btn = jQuery('#new_btn');
	var hot_btn = jQuery('#hot_btn');
	var all_btn = jQuery('#all_btn');

	function reset(id) {
		var exp_new = jQuery('#' + id);
		exp_new_ul = exp_new.find('ul');
		list_length = exp_new_ul.find('li').size();
		move_times = Math.ceil(list_length / 4) - 1;
		exp_new_ul.css('width', list_length * 245 + 'px');
		exp_new_ul.css('left', 0);
		pre_btn.css('display','none');
		next_btn.css('display','');
	}
	
	reset('dg_exp_new');
	
	next_btn.on('click', function() {
		if (exp_new_ul.is(':animated')) {
			return false;
		}
		var left = parseInt(exp_new_ul.css('left'));
		if (left === move_times * 4 * -245) {
			return false;
		}
		pre_btn.css('display','');
		newLeft = (left + (4 * -245)) + 'px';
		exp_new_ul.animate({
			'left': newLeft
		}, 'normal');
		if (parseInt(newLeft) === move_times * 4 * -245) {
			jQuery(this).css('display','none');
		}
	});
	pre_btn.on('click', function() {
		if (exp_new_ul.is(':animated')) {
			return false;
		}
		var left = parseInt(exp_new_ul.css('left'));
		if (left === 0) {
			return false;
		}
		next_btn.css('display','');
		newLeft = (left + (4 * 245)) + 'px';
		exp_new_ul.animate({
			'left': newLeft
		}, 'normal');
		if (parseInt(newLeft) === 0) {
			jQuery(this).css('display','none');
		}
		/* Act on the event */
	});
	next_btn.hover(function() {
		var left = parseInt(exp_new_ul.css('left'));
		if (left === move_times * 4 * -245) {
			return false;
		}
		jQuery(this).addClass('hover');
	}, function() {
		jQuery(this).removeClass('hover');
	});
	pre_btn.hover(function() {
		var left = parseInt(exp_new_ul.css('left'));
		if (left === 0) {
			return false;
		}
		jQuery(this).addClass('hover');
	}, function() {
		jQuery(this).removeClass('hover');
	});
	new_btn.on('click', function() {
		jQuery('#dg_exp_hot').hide();
		jQuery('#dg_exp_new').fadeIn();
		new_btn.addClass('selected').siblings().removeClass('selected');
		reset('dg_exp_new');
	});
	hot_btn.on('click', function() {
		jQuery('#dg_exp_new').hide();
		jQuery('#dg_exp_hot').fadeIn();
		hot_btn.addClass('selected').siblings().removeClass('selected');
		reset('dg_exp_hot');
	});

	all_btn.toggle(function(){
		jQuery('#all_experience').fadeIn();
		jQuery('#dg_exp_new').hide();
		pre_btn.css('display',"none");
		next_btn.css('display',"none");
		jQuery('.more_close').css("display","");
		jQuery('.more_ico').removeClass("close_ico");
		jQuery('#more_btn').css("display","");
		jQuery('#close_btn').css("display","none");
		jQuery('.dg_exp_content').css("padding","0px 0px 40px 0px");
		if (ajax_count ==1) {
		ajaxget('portal.php?mod=index&experience=1','all_experience','','','',"getAllExperience('all_experience')");
		ajax_count =2;
		}else if(ajax_count==2){getAllExperience('all_experience');}
		
		all_btn.html("<div class='all_ico z'></div>关闭列表");

	},function(){
		jQuery('#all_experience').css('height',295  + 'px');
		jQuery('.more_close').css("display","none");
		jQuery('.more_ico').removeClass("close_ico");
		jQuery('#close_btn').css("display","none");
		jQuery('#more_btn').css("display","");
		jQuery('.dg_exp_content').css("padding","");
		all_btn.html("<div class='all_ico z'></div>查看更多");
		setTimeout(function(){
			jQuery('#all_experience').hide();
			jQuery('#dg_exp_new').fadeIn();
			pre_btn.css('display',"");
			next_btn.css('display',"");
			var left = parseInt(exp_new_ul.css('left'));
			if (left === move_times * 4 * -245) {
			next_btn.css('display',"none");
			}
			if (left === 0) {
				pre_btn.css('display',"none");
			}
			jQuery(document).scrollTop(550);
		},1000);

	});

}
function getAllExperience(id){

	
		var all_new = jQuery('#' + id);
		var all_new_ul = all_new.find('ul');
		var all_list_length = all_new_ul.find('li').size();
		var height_more_times = Math.floor(all_list_length / 16) ;
		height_more_times = height_more_times?height_more_times:'1';
		var more_btn = jQuery('#more_btn');
		var close_btn = jQuery('#close_btn');
		var height_mod = all_list_length % 16;
		var row = 4;
		
		if (height_more_times ==1) {
			if(height_mod <=16 && height_mod >12){
				row = 4;
				all_new.css("height", (295*row) + 'px');
			}else if(height_mod<=12 && height_mod>8){
				row = 3;
				all_new.css("height", (295*row) + 'px');
			}else if(height_mod<=8 && height_mod>4){
				row = 2;
				all_new.css("height", (295*row) + 'px');
			}else if(height_mod<=4 && height_mod>=1){
				row = 1;
				all_new.css("height", (295*row) + 'px');
			}

			
				close_btn.css("display","");
				more_btn.css("display","none");
		}
		all_new.css("height", (295*row) + 'px');	
	more_btn.on('click', function() {

		if (all_new_ul.is(':animated')) {
			return false;
		}

		var height = parseInt(all_new.css('height'));

		var newheight = (height + (295 * 4)) + 'px';

		if (height === 295 * 4* (height_more_times)) {
			var height_mod = all_list_length % 16;
			if(height_mod <=16 && height_mod >12){
				var newheight = height + (295*4) + 'px';
			}else if(height_mod<=12 && height_mod>8){
				var newheight = (height + (295 * 3)) + 'px';
			}else if(height_mod<=8 && height_mod>4){
				var newheight = (height + (295 * 2)) + 'px';
			}else if(height_mod<=4 && height_mod>=1){
				var newheight = (height + (295 * 1)) + 'px';
			}

			jQuery('.more_ico').addClass("close_ico");
			close_btn.css("display","");
			more_btn.css("display","none");
		}
		
		all_new.css("height",newheight);
	});
	close_btn.on('click',function(){
			jQuery('#all_btn').click();
	
	});
	
}
// 获取更多回帖点评 acwong 2014.12
function getMoreComments(href,id,btn,max,page) {
	page++;
	var commentcount = 0,
	    dom=jQuery("#"+id).find('.comment_more_box');
	    dom.before("<div id='"+id+"_"+page+"'></div>");
	    showid =id+"_"+page;
	if (page == max) {
		btn.style.display = "none";
	}
	href = href + "&page=" + page;

	ajaxget(href,showid);
	
	btn.dataset.page = page;
	commentcount = parseInt(btn.getElementsByTagName('span')[0].innerHTML) - 5;
	btn.getElementsByTagName('span')[0].innerHTML = commentcount;
}
// 获取更多回帖点评 acwong 2014.12
function getMoreComments_backup(href,id,btn,max,page) {
	var dom = jQuery('#' + id),
	    xmlhttp = new XMLHttpRequest(),
	    parser = new DOMParser(),
	    patt = /\<\!\[CDATA\[/,
	    patt2 = /\]\]\>/,
	    result = "",
	    responsexml = null,
	    commentcount = 0;
	page++;
	if (page == max) {
		btn.style.display = "none";
	}
	href = href + "&page=" + page;
	xmlhttp.open("GET", href, false);
	xmlhttp.send(null);
	responsexml = xmlhttp.responseXML;
	result = responsexml.getElementsByTagName('root')[0].innerHTML.replace(patt,"").replace(patt2,"");
	result = jQuery(result);
	result[result.length - 1] = null;
	btn.dataset.page = page;
	commentcount = parseInt(btn.getElementsByTagName('span')[0].innerHTML) - 5;
	btn.getElementsByTagName('span')[0].innerHTML = commentcount;
	dom.append(result);
}
// 使用api和ajax提交收藏 acwong 2014.12
function favorite(href, formhash) {
	var tHref = "http://" + location.hostname + href;
	jQuery.ajax({
			url: tHref,
			type: 'POST',
			data: {
				"favoritesubmit": true,
				"handlekey": "k_favorite",
				"description": "",
				"favoritesubmit_btn": true,
				"formhash": formhash
			}
		})
		.done(function(data) {
			var json = JSON.parse(data);
			var msg = json.Message.showmessage;
			if (json.Message.showmessage_val === "favorite_repeat") {
				showDialog(msg);
			} else {
				showDialog(msg, "right");
			}
		});
}

// 使用api和ajax提交删除收藏 ZJJ 2014.12
function favoriteTid(id,tid,formhash) {
	
	if (id === "favorite_delete") {
		var tHref = "http://" + location.hostname + "/api/dgtle_api/v1/api.php?REQUESTCODE=1&apikeys=DGTLECOM_APITEST1&tid=" + tid;
		jQuery.ajax({
			url: tHref,
			type: 'POST',
			data: {
				"formhash": formhash
			}
		})
		.done(function(data) {
			var json = JSON.parse(data);
			var msg = json.returnData.result;
			if(msg){
				jQuery("#favorite_delete").attr("id","k_favorite");
				
			}
			
		});
	}else if(id === "k_favorite"){
		var tHref = "http://" + location.hostname + "/api/dgtle_api/v1/api.php?charset=UTF8&dataform=json&swh=480x800&apikeys=DGTLECOM_APITEST1&modules=space_cp&actions=favorite&type=thread&id=" + tid;
		jQuery.ajax({
			url: tHref,
			type: 'POST',
			data: {
				"favoritesubmit": true,
				"handlekey": "k_favorite",
				"description": "",
				"favoritesubmit_btn": true,
				"formhash": formhash
			}
		})
		.done(function(data) {
			var json = JSON.parse(data);
			var msg = json.Message.showmessage;
			if (json.Message.showmessage_val === "favorite_repeat") {
				showDialog(msg);
			} else if (json.Message.showmessage_val === "favorite_do_success"){
				jQuery("#k_favorite").attr("id","favorite_delete");
				

			} else{
				showDialog(msg, "right");
			}
		});
	}
}

/*社区首页*/
function WeiBa_forum_boxmove(This,n,Mbox){
	if(Mbox =='Wei_Ba_HangHai'){
		movepx = 420;
	}else if(Mbox =='WeiBa_ShaLong'){
		movepx = 110;
	}else{
		return;
	}
	var movepx = (n -1) * movepx;
	jQuery('.'+Mbox+'_c').attr('index',n).animate({'margin-top':'-'+movepx+'px'});
	jQuery(This).siblings().removeClass('a');
	jQuery(This).addClass('a');
}
function WeiBa_forum_auto(obj,times){
	var OBJ = jQuery('.'+obj+'_c');
	if(OBJ){
		var times = times ? times : 3000;
		var Auto = function(){
			var length = OBJ.find('dl').length;
			var index = OBJ.attr('index');
			index = index ? index : 0;
			if(index >= length){
				index =0;
			}
			var Tag = 'dl';
			if(obj =='WeiBa_ShaLong'){
				Tag = 'span';
			}
			var objnum = jQuery('.'+obj+'_t '+Tag).eq(index);
			index ++;
			WeiBa_forum_boxmove(objnum,index,obj);
			OBJ.attr('index',index);
		}
		S = setInterval(Auto, times);
		jQuery('.'+obj+'_t').mouseenter(function(){
			clearInterval(S);
		}).mouseleave(function(){
			S = setInterval(Auto, times);
		});
	}
}

function show_recomment_list(id) {
	jQuery(function() {
		jQuery('#' + id).hover(function() {
			jQuery(this).find('.cr_users').css('overflow', 'visible');
		}, function() {
			jQuery(this).find('.cr_users').css('overflow', 'hidden');
		});
	});
}


/*显示点评回复按钮*/
function show_reply_button(obj){
	var reply_area=jQuery(obj).find(".reply_area");

	reply_area.css("visibility","visible"); 
	reply_area.css("top",(jQuery(obj).height()/2-20)+"px");
   
}
function hide_reply_button(obj){
   jQuery(obj).find(".reply_area").css("visibility","hidden"); 

}
/*end*/

/*首页资讯控*/
function dg_informkong() {
	var inform_ul;
	var list_length = 0;
	var move_times = 0;
	var pre_btn = jQuery('.inform_move_left');
	var next_btn = jQuery('.inform_move_right');


	function reset(id) {
		var inform = jQuery('#' + id);
		inform_ul = inform.find('ul');
		list_length = inform_ul.find('li').size();
		move_times = Math.ceil(list_length / 4) - 1;
		inform_ul.css('width', list_length * 245 + 'px');
		inform_ul.css('left', 0);
		pre_btn.css('display','none');
		next_btn.css('display','');
	}
	
	reset('dg_inform');
	
	next_btn.on('click', function() {
		if (inform_ul.is(':animated')) {
			return false;
		}
		var left = parseInt(inform_ul.css('left'));
		if (left === move_times * 4 * -245) {
			return false;
		}
		pre_btn.css('display','');
		newLeft = (left + (4 * -245)) + 'px';
		inform_ul.animate({
			'left': newLeft
		}, 'normal');
		if (parseInt(newLeft) === move_times * 4 * -245) {
			jQuery(this).css('display','none');
		}
	});
	pre_btn.on('click', function() {
		if (inform_ul.is(':animated')) {
			return false;
		}
		var left = parseInt(inform_ul.css('left'));
		if (left === 0) {
			return false;
		}
		next_btn.css('display','');
		newLeft = (left + (4 * 245)) + 'px';
		inform_ul.animate({
			'left': newLeft
		}, 'normal');
		if (parseInt(newLeft) === 0) {
			jQuery(this).css('display','none');
		}
		/* Act on the event */
	});
	next_btn.hover(function() {
		var left = parseInt(inform_ul.css('left'));
		if (left === move_times * 4 * -245) {
			return false;
		}
		jQuery(this).addClass('hover');
	}, function() {
		jQuery(this).removeClass('hover');
	});
	pre_btn.hover(function() {
		var left = parseInt(inform_ul.css('left'));
		if (left === 0) {
			return false;
		}
		jQuery(this).addClass('hover');
	}, function() {
		jQuery(this).removeClass('hover');
	});


	

}
function CRid(id) {
	return ! id ? null: document.getElementById(id)
}

function CR_sidepic(M,tag,s,mtag){
	//幻灯 触摸滑动
	var T = M+'_T';
	var JM = jQuery('#'+M);
	if(JM.find(tag).length <1) return;
	mtag = mtag ? mtag : 'span';//状态框架子标签

	JM.wrapInner('<div></div>');//包裹一层
	if(!jQuery('#'+T).attr('class')){
		//创建状态菜单
		var CSS = {
			'h':'5px',//高度
			'b':'#ccc',//默认颜色
			'ba':'#f00'//高亮颜色
		}
		var H = '<div id="'+T+'" class="sidepic_menu" '+(s ? ('style="height:'+CSS.h+'px; width:100%; overflow:hidden"') : '')+'>';
		for(i=0;i < JM.find(tag).length; i++){
			H += '<span '+(i ==0 ? ' class="a"' : '')+'></span>';
		}
		H += '</div>';
		JM.after(H);

		var T = jQuery('#'+T);

		var S = T.find(mtag);
		if(s){
			S.css({
				'width':	parseInt(T.width() / S.length)+'px',
				'height':CSS.h,
				'overflow':'hidden',
				'display':'block',
				'background':CSS.b,
				'float':'left'
			});
			T.find(mtag+'.a').css('background','#f00');
		}
		T.on('click','span',function(event){
			var i = jQuery(event.target).index();
			tabs.slide(i);
			tabs.setPos(i);
		});
	}

	//幻灯标题
	var TEXT = jQuery('#'+M+'_TEXT');
	if(TEXT.attr('class')){
		TEXT.find('a').eq(0).addClass('a');
	}

	//开始滑动处理
	tabs = new Swipe(CRid(M), {
		auto: 3000,
		continuous: true,
		callback: function(index) {
			if(s){
				T.find(mtag).css('background',CSS.b);
				T.find(mtag).eq(index).css('background',CSS.ba);
			}else{
				T.find(mtag).removeClass('a');
				T.find(mtag).eq(index).addClass('a');
			}
			if(TEXT.attr('class')){
				TEXT.find('a').removeClass('a');
				TEXT.find('a').eq(index).addClass('a');
			}
		}
	});

	JM.on('mouseenter',function(){
		tabs.stopAutoplay();
	}).on('mouseleave',function(){
		tabs.startAutoplay();
	});
}