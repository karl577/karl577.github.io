jQuery(document).ready(function($) {
	$('.theme-login').click(function(){
		$('.theme-popover-mask').show();
		$('.theme-popover').slideDown(300);
	})
	$('.theme-poptit .close').click(function(){
		$('.theme-popover-mask').hide();
		$('.theme-popover').slideUp(300);
	})

	$('.theme-gologin').click(function(){
		$('.theme-signin').fadeIn();
	})

	$('.theme-tabs li').each(function(e){
		$(this).click(function(){
			$(this).addClass('active').siblings().removeClass('active');
			$($('.theme-main')[e]).fadeIn(200).siblings('.theme-main').hide();
		})
	})

	var 
		btnPrev = $('.theme-picbox-prev'),
		btnNext = $('.theme-picbox-next'),
		roller	= $('.theme-picbox-roller');
		descer	= $('.theme-picbox-desc')
		i = 0,
		flag=true;


	var picboxNum = 0;
	for(var e in picboxInfo){
		picboxNum++;
	}
	picboxNum = picboxNum-1;

	for(e=1;e<3;e++){
		roller.find('ul').append('<li><img alt="'+picboxInfo[e]+'" src="'+picboxSrc+e+'.jpg"><div class="imgtitle">'+picboxInfo[e]+'</div></li>');
		
	}

	roller.find('ul').width(roller.width()*2);

	btnNext.click(function(){
		if(i >= roller.find('li').length-1){
			return;
		};
		if(flag == true){
			i++;
			flag = false;
			roller.find('ul').animate({
				marginLeft:'-'+roller.width()*i+'px'
			},{
				duration:300,
				complete:function(){
					flag = true;
					if(i >= roller.find('li').length-1 && i<picboxNum){
						var picDesc  = picboxInfo[i+2];
						roller.find('ul').append('<li><img alt="'+picDesc+'" src="'+picboxSrc+(i+2)+'.jpg"><div class="imgtitle">'+picDesc+'</div></li>');
						
						roller.find('ul').width(roller.width()*roller.find('li').length);
						//descer.find('ul').width(descer.width()*roller.find('li').length);
					}
				}
			})
			
		};

	})

	btnPrev.click(function(){
		if(i <= 0){
			return;
		};
		if(flag == true){
			i--;
			flag = false;
			roller.find('ul').animate({
				marginLeft:'-'+roller.width()*i+'px'
			},{
				duration:300,
				complete:function(){
					flag = true;
				}
			})
			descer.find('ul').animate({
				marginTop:'-'+descer.height()*i+'px'
			},{
				duration:300,
				complete:function(){
					flag = true;
				}
			})
		};
		
	});
	
	

})