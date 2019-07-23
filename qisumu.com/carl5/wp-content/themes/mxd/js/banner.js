/* ================================================================ 
yandeng  baner切换图
=================================================================== */
$.fn.banner = function(option){
	var dot = $('.' + option.navigation + ' ul li a'),
		navigation = $('.' + option.navigation),
		photo = $('.' + option.photo + 'ul li'),
		number = dot.length,
		clickButtom,current,autoPlay,
		banner = $('.' + option.banner),
		index = 1,
		current = 1,
		button = 1,
		width = option.width,
		previous = $('.' + option.previous),
		next = $('.' + option.next),navLeft;
		$('.com-banner-photo img').attr({'width':width, 'height':width*0.38});
		$('.com-banner-photo').css('height', width*0.38);
		var aid;
		$(window).on('resize', function () {
			if (aid) {
				clearTimeout(aid);
				aid = undefined;
			}
			aid = setTimeout(function() {
				console.log('aaa');
				if (!autoPlay){
					autoPlay = setInterval(function (){
						button = current;
						if(current >= dot.length){
							current = 0;
						}
						current ++;
						animateLeft(current, button,true);
					},option.time);
				}
				
				spinCanvas(current);
				aid = undefined;
			}, 1000);
			width = $('#banner .com-banner-photo').width();
			$('.com-banner-photo img').attr({'width':width, 'height':width*0.38});
			$('.com-banner-photo').css('height', width*0.38);
			layoutImages(current);
			clearInterval(autoPlay);
			autoPlay = null;
			toggleCanvas(current);
		});
		
	//第一帧的状态
	$('.' + option.pic + 1).css('left','0px');
	//previous.hide();
	//next.hide();
	navLeft = (width - navigation.width())/2;
	
	//圆点点击事件
	dot.click(function(){
		if (isPlaying){
			return false;
		}
		button = current;
		clickButton = this.href.toString();
		current = clickButton.split('#')[1];
		if(current > button){
			animateLeft(current,button)
		}
		if(current < button){
			animateRight(current,button)
		}
		return false;
	})

	function layoutImages(current){
		if(current==1){
			$('.' + option.pic + '1').css('left','0px');
			$('.' + option.pic + '2').css('left',width + 'px');
			//$('.' + option.pic + '3').css('left',-width + 'px');
		}else if (current==2){
			$('.' + option.pic + '2').css('left','0px');
			//$('.' + option.pic + '3').css('left',width + 'px');
			$('.' + option.pic + '1').css('left',-width + 'px');
		}else{
			//$('.' + option.pic + '3').css('left','0px');
			$('.' + option.pic + '1').css('left',width + 'px');
			$('.' + option.pic + '2').css('left',-width + 'px');
		}
	}

	function popUp(current){
		if(current==1){
			$('.' + option.pic + '1').css('z-index','99');
			$('.' + option.pic + '2').css('z-index','98');
			//$('.' + option.pic + '3').css('z-index','98');
		}else if (current==2){
			$('.' + option.pic + '2').css('z-index','99');
			$('.' + option.pic + '1').css('z-index','98');
			//$('.' + option.pic + '3').css('z-index','98');
		}else{
			//$('.' + option.pic + '3').css('z-index','99');
			$('.' + option.pic + '2').css('z-index','98');
			$('.' + option.pic + '1').css('z-index','98');
		}
	}
	
	var isPlaying = false;

	//向左运动的函数
	function animateLeft(current,button,isAuto){		
		$('.' + option.pic + current).css('left',width + 'px');
		$('.' + option.pic + current).animate({'left': '0px'},1000,"easeInOutExpo",function(){isPlaying = false;});
		$('.' + option.pic + button).animate({'left': -width + 'px'},1000,"easeInOutExpo",function(){isPlaying = false;});
		isPlaying = true;
		if (isAuto){
			if(current==1){
				spinCanvas(1);
				resetCanvas(2,false);
				//resetCanvas(3,false);
			}else if (current==2){
				spinCanvas(2);
				resetCanvas(1,false);
				//resetCanvas(3,false);
			}else{
				//spinCanvas(3);
				resetCanvas(1,false);
				resetCanvas(2,false);
			}
		}else{
			setButton();
		}
		
	}
	
	//向右运动函数
	function animateRight(current,button){
		$('.' + option.pic + current).css('left',-width + 'px');
		$('.' + option.pic + current).animate({'left': '0px'},1000,'easeInOutExpo',function(){isPlaying = false;});
		$('.' + option.pic + button).animate({'left': width + 'px'},1000,'easeInOutExpo',function(){isPlaying = false;});
		isPlaying = true;
		setButton();
	}
	
	//dot点状态的设置
	function setButton(){
		dot.removeClass(option.highlight).eq(current - 1).addClass(option.highlight);
		if(current==1){
			toggleCanvas(1);
			resetCanvas(2,false);
			//resetCanvas(3,false);
		}else if (current==2){
			toggleCanvas(2);
			resetCanvas(1,false);
			//resetCanvas(3,false);
		}else{
			//toggleCanvas(3);
			resetCanvas(1,false);
			resetCanvas(2,false);
		}
	}
	
	//自动轮播
	autoPlay = setInterval(function (){
		button = current;
		if(current >= number){
			current = 0;
		}
		current ++;
		animateLeft(current, button,true);
	},option.time)
	
	//前一页点击
	previous.click(function(){
		if (isPlaying){
			return;
		}
		button = current;
		if(current <= 1){
			current = number+1;	
		}
		current --;
		animateRight(current,button)
	})
	
	//下一页点击
	next.click(function(){
		if (isPlaying){
			return;
		}
		button = current;
		if(current >= number){
			current = 0;
		}
		current ++;
		animateLeft(current, button);
	})
	
	//鼠标点击显示前后按钮
	var isArrowHover = false;	

	previous.bind('mouseover',function(e){
		isArrowHover = true;
	});

	previous.bind('mouseout',function(e){
		isArrowHover = false;
	});

	next.bind('mouseover',function(e){
		isArrowHover = true;
	});

	next.bind('mouseout',function(e){
		isArrowHover = false;
	});

	var isBannerHover = false;
	
	//鼠标移到banner图里面取消自动轮播
	banner.bind('mouseover',function(e){
		isBannerHover = true;
		previous.find('i').animate({left:'0px'},100);
		next.find('i').animate({right:'0px'},100);
		clearInterval(autoPlay);
		autoPlay = null;
		toggleCanvas(current);
	})
	
	//鼠标移到banner外面继续轮播
	banner.bind('mouseout',function(e){
		isBannerHover = false;
		setTimeout(function(){
			if (!isArrowHover&&!isBannerHover){
				previous.find('i').animate({left:'-70px'},100);
				next.find('i').animate({right:'-70px'},100);
			}
		},10);
		
		//next.find('i').animate({right:'-70px'},500);
		if (!autoPlay){
			autoPlay = setInterval(function (){
				button = current;
				if(current >= dot.length){
					current = 0;
				}
				current ++;
				animateLeft(current, button,true);
			},option.time);
		}
		
		spinCanvas(current);
		e.stopPropagation(); 
	})
}

var bannerWidth = $('#banner .com-banner-photo').width();
console.log(bannerWidth);
$.fn.banner({
	banner : 'com-banner',   //banner图
	photo : 'com-banner-photo',	// 大图切换	
	navigation : 'com-banner-navigation', // dot点轮播
	highlight : 'highlight',   //dot点高亮状态
	pic : 'com-banner-pic',  //切换的图片
	previous :'btn-left',   //前一个图片
	next :'btn-right',   //后一个图片
	width : bannerWidth,     //页面宽度
	time :6000   //轮播图的时间间隔，单位是毫秒
});

var bannerCount = 2;
for (var i=1;i<=bannerCount;i++){
	var canvas=document.getElementById("dotCanvas"+i);
    var context=canvas.getContext("2d");
    if (i==1){
    	context.fillStyle="#858585";
    }else{
    	context.fillStyle="#CCC";
    }
    
    context.beginPath();
    context.arc(6,6,6,0,2*Math.PI); 
    context.closePath();
    context.fill();
}

var dps = -0.5*Math.PI+Math.PI/180*6;

var intervalId = setInterval("drawCircle("+1+")",100);

function resetCanvas(i,selected){
	var canvas=document.getElementById("dotCanvas"+i);
	var context=canvas.getContext("2d");
	context.clearRect(0,0,12,12);
	if (selected){
    	context.fillStyle="#858585";
    }else{
    	context.fillStyle="#CCC";
    }
	context.beginPath();
	context.arc(6,6,6,0,2*Math.PI); 
	context.lineTo(6,6);
	context.closePath();
	context.fill();
}

function drawCircle(i){
	if (Math.abs(dps-1.5*Math.PI)<0.000001){
		resetCanvas(i,false);
		clearInterval(intervalId);
	 	return;
	}
	var canvas=document.getElementById("dotCanvas"+i);
	var context=canvas.getContext("2d");
	context.fillStyle="#FFF";
	
	context.beginPath();
	context.arc(6,6,6,-0.5*Math.PI,dps,false); 
	context.lineTo(6,6);
	context.closePath();
	context.fill();
	dps += Math.PI/180*6;
}

function spinCanvas(i){
	dps = -0.5*Math.PI+Math.PI/180*6;
	clearInterval(intervalId);
	var canvas=document.getElementById("dotCanvas"+i);
    var context=canvas.getContext("2d");
    context.fillStyle="#858585";
    context.beginPath();
    context.arc(6,6,6,0,2*Math.PI); 
    context.closePath();
    context.fill();
    intervalId = setInterval("drawCircle("+i+")",100);
}

function toggleCanvas(i){
	clearInterval(intervalId);
	resetCanvas(i,true);
}


