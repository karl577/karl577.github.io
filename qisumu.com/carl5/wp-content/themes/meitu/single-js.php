<script>
							function guanzhu(uid) {
								$.ajax({
									url: '<?php echo home_url(add_query_arg(array(),$wp->request)); ?>?uid=' + uid,
									type: 'GET',
									dataType: 'html',
									timeout: 9000,
									error: function() {
										alert('提交失败！');
									},
									success: function(html) {
										$("#guanzhu-btn").attr('href','javascript:guanzhux('+uid+');');
										$("#guanzhu-btn").html('<i class="icon-remove-sign"></i> 取消关注');
										$("#guanzhu-btn").addClass('btn-current');
										$("#guanzhu-count-now").load("<?php echo home_url(add_query_arg(array(),$wp->request)); ?> #guanzhu-count-now-span");
										//alert('提交成功！');
										//window.location.reload(); 
									}
								});
								//return false;
							};
							function guanzhux(uid) {
								$.ajax({
									url: '<?php echo home_url(add_query_arg(array(),$wp->request)); ?>?uidx=' + uid,
									type: 'GET',
									dataType: 'html',
									timeout: 9000,
									error: function() {
										alert('提交失败！');
									},
									success: function(html) {
										$("#guanzhu-btn").attr('href','javascript:guanzhu('+uid+');');
										$("#guanzhu-btn").html('<i class="icon-ok-sign"></i> 关注TA');
										$("#guanzhu-btn").removeClass('btn-current');
										$("#guanzhu-count-now").load("<?php echo home_url(add_query_arg(array(),$wp->request)); ?> #guanzhu-count-now-span");
										//alert('提交成功！');
										//window.location.reload(); 
									}
								});
								//return false;
							};
						</script>
<script>
function like(uid) {
	$.ajax({
		url: '<?php echo home_url(add_query_arg(array(),$wp->request)); ?>?like=' + uid,
		type: 'GET',
		dataType: 'html',
		timeout: 9000,
		error: function() {
			alert('提交失败！');
		},
		success: function(html) {
			$("#like-btn").attr('href','javascript:;');
			$("#like-btn").html('<i class="icon-heart"></i> 已喜欢');
		}
	});
};
function fav(uid) {
	$.ajax({
		url: '<?php echo home_url(add_query_arg(array(),$wp->request)); ?>?fav=' + uid,
		type: 'GET',
		dataType: 'html',
		timeout: 9000,
		error: function() {
			alert('提交失败！');
		},
		success: function(html) {
			$("#fav-btn").attr('href','javascript:favx('+uid+');');
			$("#fav-btn").html('<i class="icon-star"></i> 取消收藏');
		}
	});
};
function favx(uid) {
	$.ajax({
		url: '<?php echo home_url(add_query_arg(array(),$wp->request)); ?>?favx=' + uid,
		type: 'GET',
		dataType: 'html',
		timeout: 9000,
		error: function() {
			alert('提交失败！');
		},
		success: function(html) {
			$("#fav-btn").attr('href','javascript:fav('+uid+');');
			$("#fav-btn").html('<i class="icon-star-empty"></i> 收藏');
		}
	});
};
</script>
<script src="<?php bloginfo('template_directory'); ?>/js/jquery.masonry.min.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/jquery.infinitescroll.min.js"></script>
<script>
  $(function(){ 
    var $container = $('#container');
    
    $container.imagesLoaded(function(){
      $container.masonry({
        itemSelector: '.box',
        columnWidth: 242
      });
    });
    
    $container.infinitescroll({
      navSelector  : '#page-nav',    // selector for the paged navigation 
      nextSelector : '#page-nav a',  // selector for the NEXT link (to page 2)
      itemSelector : '.box',     // selector for all items you'll retrieve
      loading: {
          finishedMsg: '<i class="icon-warning-sign"></i> 全部内容加载完毕...',
          img: '<?php bloginfo('template_directory'); ?>/img/themeload.gif'
        }
      },
      // trigger Masonry as a callback
      function( newElements ) {
        // hide new items while they are loading
        var $newElems = $( newElements ).css({ opacity: 0 });
        // ensure that images load before adding to masonry layout
        $newElems.imagesLoaded(function(){
          // show elems now they're ready
          $newElems.animate({ opacity: 1 });
          $container.masonry( 'appended', $newElems, true ); 
        });
        $(".box").hover(function(){
			$('.box-btn',this).css('display','block');
		}, function() {
			$('.box-btn',this).css('display','none');
		});
      }
    );
    
  });
</script>