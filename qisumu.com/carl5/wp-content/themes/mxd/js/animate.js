/*
* yandeng 视觉滚动差效果插件
*/
var slideScroll = (function() {
	var rows,links,scollPageSpeed,iconSpeed,win,winSize,lineHeight,topd,bottomd,menu;
    function init(option) {
        rows = jQuery(option.rows),
        links = jQuery(option.links),
		topd = option.top,
		bottomd = option.bottom,
        scollPageSpeed = option.scollPageSpeed,
		retn = jQuery(option.retn),
        win = jQuery(window),
        winSize = {},
        lineHeight = option.lineHeight,
		menu = '.' + option.menu,
        anim = false,
        scollPageEasing = 'easeInOutExpo';

        this.getWinSize();
        this.initEvents(); // 初始化事件
        this.placeRows();
        this.menu();
    }
    init.prototype = {
        getWinSize: function() {
            winSize.width = win.width(); // 窗口可视区域的宽度
            winSize.height = win.height();  // 窗口可视区域的高度
        },
        initEvents: function() { //事件初始化
            var _this = this;
            links.on('click.Scrolling', function(event) {
                jQuery('html, body')
                    .stop()
                    .animate({
                    scrollTop: jQuery($(this)
                        .attr('href'))
                        .offset()
                        .top
                }, scollPageSpeed, scollPageEasing);
                return false;
            });
            jQuery(window)
                .on({
                'scroll.Scrolling': function(event) {
                    if (anim) return false;
                    anim = true
                    setTimeout(function() {
                        _this.placeRows();
                        anim = false;
                    }, 10);
                }
            });

        },
        placeRows: function() {
            var winscroll = win.scrollTop(), // window滚动条的高度
                _this = this,
                winCenter = lineHeight / 2 + winscroll;
            rows.each(function() {
                var row = jQuery(this),
                    rowL = row.find('div.r-left'),
                    rowR = row.find('div.r-right'),
                    rowTop = row.find('div.r-top'),
                    rowTop2 = row.find('div.r-top2'),
                    rowBottom = row.find('div.r-bottom'),
                    rowT = row.offset().top; //每一块距离顶部的高度距离
                links.removeClass('com-scroll-link01h');
                links.removeClass('com-scroll-link02h');
                links.removeClass('com-scroll-link03h');
                if (winscroll > lineHeight && winscroll < lineHeight * 2) {
                    jQuery('#r-links a:eq(0)')
                        .addClass('com-scroll-link01h');
                } else if (winscroll > lineHeight * 2 && winscroll < lineHeight * 3) {
                    jQuery('#r-links a:eq(1)')
                        .addClass('com-scroll-link02h');
                } else if (winscroll > lineHeight * 3 && winscroll < lineHeight * 4) {
                    jQuery('#r-links a:eq(2)')
                        .addClass('com-scroll-link03h');
                }
                if (rowT > lineHeight + winscroll) {
                    rowL.css({
                        left: '-50%'
                    });
                    rowR.css({
                        right: '-50%'
                    });
                    rowTop.css({
                        top: '90%'
                    });
                    rowTop2.css({
                        top: '-60%'
                    });
                    rowBottom.css({
                        bottom: '30%'
                    })
                } else {
                    var rowH = row.height(),
                        factor = ((rowT + rowH / 2) - winCenter) / rowH , // 值是1-0
                        factor2 = (1 - (((rowT + rowH / 2) - winCenter) / rowH )) - 2 / 3, // 值是-2/3到1/3
                        factor3 = (1 - (((rowT + rowH / 2) - winCenter) / rowH)), // 值是0到1
                        val = Math.max(factor * 50, 0),  //50到0
                        val2 = Math.max(factor * 90, 0),  //90到0
                        val3 = factor2 * 90;              //-60到30
                    rowL.css({
                        left: '-' + val + '%'    //从-50%到0%的变化
                    });
                    rowR.css({
                        right: '-' + val + '%'    //从-50%到0%的变化
                    });

                    rowTop2.css({
                        top: val3 + '%'   //从-60%到30%的变化
                    });
                    if (val3 > topd) {
                        rowTop2.css({
                            top: topd + '%'   //从-60%到14%的变化
                        })
                    }
					rowTop.css({
                        top: (val2 + bottomd) + '%'  //从101%到11%的变化
                    });
                }
            });
        },
        menu: function() {
			var sheight = jQuery(window).height(),
				menuHeight = jQuery(menu).height();
			var theight = sheight - menuHeight;
			jQuery(menu).css({
                    top: '708px'
                });
            if (window.screen.height <= 1000 && window.screen.height > 768) {
                jQuery(menu)
                    .css({
                    top: '588px'
                })
            } else if (window.screen.height <= 768) {
                jQuery(menu)
                    .css({
                    top: theight + 'px'
                })
            };
            if ($.browser.msie && ($.browser.version == "6.0")) {
                jQuery(window)
                    .on({
                    'scroll.Scrolling': function() {
                        var ftop = jQuery(document)
                            .scrollTop() + 708 + 'px';
                        jQuery(menu)
                            .css({
                            'top': ftop
                        });
                        if (window.screen.height <= 1000 && window.screen.height > 768) {
                            var ftop = jQuery(document)
                                .scrollTop() + 588 + 'px';
                            jQuery(menu)
                                .css({
                                'top': ftop
                            });
                        } else if (window.screen.height <= 768) {
                            var ftop = jQuery(document)
                                .scrollTop() + theight + 'px';
                            jQuery(menu)
                                .css({
                                'top': ftop
                            });
                        }
                    }
                })
            };
            retn.click(function() {
                jQuery('html,body')
                    .stop()
                    .animate({
                    scrollTop: '0px'
                }, 1200);
            });
        }
    }
    return {
        init: init
    }
})();

/*
*  返回首屏组件
*/
var isAnimating = false;
var rt = (function () {
	var rt,bottom,time;
	function init (option) {
		rt = option.rt;
		bottom = option.bottom;
		time = option.time;
		this.scrollBar();
		this.menu();
	}
	init.prototype = {
		scrollBar : function () {
            
			$(rt + ' a').click(function () {
                if(isAnimating){
                    return false;
                }
                isAnimating = true;
				$('html,body').animate({scrollTop : 
					$($(this).attr('href')).offset().top},time,'easeOutExpo',function(){isAnimating=false;}
				);
                return false;							
			})
		},
		menu : function () {
			var wheight = $(window).height();
			if ($.browser.msie && ($.browser.version == "6.0")) {
				$(window).scroll( function () {
					var srHeight = $(window).scrollTop()	;
					
					$(rt).css({top: srHeight + wheight - $(rt).height() - bottom + 'px'  })
				})		
			}
			$(window).scroll( function () {
					var srHeight = $(window).scrollTop()	;
					if(srHeight > 0) {
						$(rt).css({'display' : 'block'})
					} else {
						$(rt).css({'display' : 'none'})	
					}
			})
		}
	}
	return {init : init};
})();

/*
*  视觉差滚动2
*/
function scrollTwo (param) {
    var $doc = $(document);
    var $win = $(window);
    var isChrome = navigator.userAgent.indexOf('Chrome') > 0; //判断chrome浏览器
    var windowHeight, windowWidth,fullHeight, scrollHeight;
    calculateDimensions();  //页面需要滚动的页面长度
    var isNight = false;
    var currentPosition = getScrollTop() / scrollHeight;// 页面的实际滚动长度和页面可以滚动的最大长度的比值，值是0-1
    var targetPosition = currentPosition;

    // 元素
    var $allNavAnchors = $(param.menu);  //导航链接元素
    var $timeElements = $('[data-day]');  //块元素
    var timeElements = [];
    var hotspots = {};  //包含元素的对象,全局对象

    $timeElements.each(function(){  //遍历每个移动块的元素
        var $view = $(this);
        var id = $view.attr('id');
        var elem = new TimeElement(this);   //构造一个元素对象，它有选中块的属性
        timeElements.push( elem ); //把每个元素的属性放到timeElements数组中
        if ( id ) hotspots[id] = elem;  //对象赋给名称
        var offset = $view.offset();
        $view.css({position: 'fixed' , top: offset.top });  //定义每个滚动块的属性
    });

    // 操作锚点链接  导航 点击链接滑动到相应的位置
    $('a[href^="#"]').click(function(event){
        event.preventDefault();
        var target = $(this).attr('href').substr(1); //获取a链接的锚点中文元素
        var hotspot = hotspots[target];  
        if ( hotspot ) {
            var pos = hotspot.getPosition();
            setScrollTop( pos * scrollHeight ); //点击菜单移动到相应的模块
        }
    });

    function setScrollTop(value) {  //设置滚动到哪里
        $win.scrollTop(value);
    }
    
    function getScrollTop() {    //页面的实际滚动高度
        return $win.scrollTop() || (document.documentElement && document.documentElement.scrollTop);
    }
    
    function calculateDimensions() {  
        windowWidth = $win.width(); //浏览器可视区域的宽度
        windowHeight = $win.height(); //浏览器可视区域的高度
        fullHeight = $(param.ele).height();   //文档的实际高度;
        scrollHeight = fullHeight - windowHeight;//页面需要滚动的页面长度
    }
    function setTargetPosition( position , immediate ) {   //设置目标的位置
        targetPosition = position;
        if ( immediate ) currentPosition = targetPosition;
    }
    function handleResize() {
        calculateDimensions(); //计算页面最大的滚动长度
        renderTimeline( currentPosition );  //每个滚动块的运动
        handleScroll();
    }
    function handleScroll() {  //设置滚动后菜单的显示隐藏
        setTargetPosition( getScrollTop() / scrollHeight );  //设置目标的位置
    }
    // rendering

    var scrollActivateTimeout;

    function renderTimeline( position ) {
        var minY = -500, maxY = windowHeight + 500;
        // element position   元素的位置
        $.each(timeElements,function(index,element){  //遍历每个数组的值，element 相当于每个对象，index是数组的下标
            var elemPosition = element.getPosition();   //每个滚动元素的位置
            var elemY = windowHeight/2 + element.speed * (elemPosition-position) * scrollHeight;  //元素的y值
            var active = false;
            if ( elemY < minY || elemY > maxY ) {  //没进入可视区域的时候
                element.view.css({'visiblity':'none', top: '-1000px','webkitTransform':'none'});
            } else {
                element.view.css('visiblity','visible');
                positionElement(element.view,null,elemY);  //添加样式属性到每个div元素上，elemY的值由大到小，计算y值的运动轨迹
                if ( elemY < windowHeight/2 ) { //刚刚到每个要滚动的元素块
                    var x = (windowHeight/2 - elemY)/100;   //x随着滚动条运动而动
                    x = x*x * 20;  //半圆曲线
                    if ( element.view.hasClass('hotspot') ) {  //判断元素是否包含hotspot样式，x轴做半圆曲线运动
                        if ( element.view.hasClass('right') ) {
                            element.view.css('margin-right',-x);
                        } else
                        if ( element.view.hasClass('left') ) {
                            element.view.css('margin-left',-x);
                        }
                    }
                } else  //运动块还没开始运动的时候
                if ( element.view.hasClass('hotspot') ) {
                    element.view.css({'margin-left':0,'margin-right':0});
                }
                active = Math.abs(windowHeight/2 - elemY) < Math.max(windowHeight/5,100);  //判断真假
            }
            if ( getElementActive(element.view) != active ) {  //如果不是选中状态的时候
                clearTimeout( element.scrollActivateTimeout );
                setElementActive(element.view,active);  //把元素的elem填充数据active 
                function doit() {
                    activateElement( element.view , active );
                }
                if ( active ) {
                    element.scrollActivateTimeout = setTimeout( doit , 1000 );
                } else {
                    doit();
                }
                activateElement( element.anchor , active );
            }
        });
    }

    function positionElement( elem , x , y ) {   //添加属性到元素上
        if ( Modernizr.csstransforms ) {  //全局的Modernizr对象也可以用来探测是否支持CSS3特性,这里检测CSS transforms属性
            var xpos = ( x === null ? $.data(elem,'x') : x ) || 0;  //因为x是null所以xpos的值为存储数据到元素上
            var ypos = ( y === null ? $.data(elem,'y') : y ) || 0;   //因为y不是null所以ypos的值为y
            $.data(elem,'x',xpos);
            $.data(elem,'y',ypos);
        }
        
        if ( $.browser.safari && !isChrome ) {
            elem.css({top:-1000,webkitTransform:'translate3d('+(xpos)+'px,'+(ypos+1000)+'px,0px)'});
        } else 
        if ( Modernizr.csstransforms ) {
            var transform = 'translate('+(xpos)+'px,'+(ypos+1000)+'px)';
            elem.css({
                top: -1000,
                '-webkit-transform':transform,
                '-moz-transform':transform,
                '-o-transform':transform,
                '-ms-transform':transform
            });
        } else
        {
            if ( x !== null ) {
                elem.css('left',x);
            }
            if ( y !== null ) {
                elem.css('top',y);
            }
        }
    }
    function activateElement( elem , active ) {
        $.data( elem , 'active' , active );
        active ? elem.addClass('active') : elem.removeClass('active');
    }
    function setElementActive( elem , active ) {   
        $.data( elem , 'active' , active );
    }
    function getElementActive( elem ) {   //获取elem上的actve数据
        return $.data( elem , 'active' );
    }

    // main render loop
    window.requestAnimFrame = (function(){
      return  window.requestAnimationFrame       ||
              window.webkitRequestAnimationFrame ||
              window.mozRequestAnimationFrame    ||
              window.oRequestAnimationFrame      ||
              window.msRequestAnimationFrame     ||
              function(/* function */ callback, /* DOMElement */ element){
                window.setTimeout(callback, 1000 / 60);
              };
    })();

    //页面滚动
    function animloop(){
        requestAnimFrame(animloop);
        if ( Math.floor(currentPosition*5000) != Math.floor(targetPosition*5000) ) { //Math.floor对下取舍
            var deaccelerate = Math.max( Math.min( Math.abs(targetPosition-currentPosition)*5000 , 10 ) , 2 );  //值在2跟10之间
            currentPosition += (targetPosition - currentPosition) / deaccelerate;
            renderTimeline(currentPosition);
        }
    }
    animloop();

    $win.resize( handleResize );
    $win.scroll( handleScroll );
    handleResize();

    function TimeElement( view , options ) {   //时间元素的构造函数，是一些属性和方法的集合
        options = options || {};
        var $view = $(view);
        this.id = $view.attr('id');
        this.view = $view;
        this.anchor = $allNavAnchors.filter('[href="#'+$view.attr('id')+'"]');  //选取href=# 响应的锚点元素
        this.anchor = this.anchor.closest('li'); //选取对应的li
        this.getPosition = function() { return  this.dayPosition; }; 
        this.dayPosition = options.dayPosition || Number( $view.attr('data-day')/100 ); //获取data-day/100 
        this.speed = options.speed || Number( $view.attr('data-speed') ) || 1;  //获取data-speed
        this.align = options.align || $view.attr('data-align') || 'left';   //获取data-align
    }
}