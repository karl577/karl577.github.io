<?php 
/*
	template name: 用户中心
	description: template for wazhuti.com Monkey theme 
*/
if(!is_user_logged_in()){
	echo "<script>window.location.href='".get_permalink(get_page_id_from_template('page-login.php'))."';</script>";
}
get_header();
if(is_user_logged_in()){
	global $current_user; 
	get_currentuserinfo();
	$uid = $current_user->ID;
	
	if($_POST['action'] == '1'){

		$user_email = apply_filters( 'user_registration_email', $_POST['email'] );
		$error = 0;$msg = '';
		if ( $user_email == '' ) {
			$error = 1;
			$msg = '邮箱不能为空';
		} elseif ( email_exists( $user_email ) && $user_email != $current_user->user_email) {
			$error = 1;
			$msg = '邮箱已被使用';
		}else{
			$userdata = array();
			$userdata['ID'] = $uid;
			$userdata['nickname'] = str_replace(array('<','>','&','"','\'','#','^','*','_','+','$','?','!'), '', $_POST['nickname']);
			$userdata['user_email'] = $_POST['email'];
			$userdata['description'] = $_POST['description'];
			wp_update_user($userdata);
			update_user_meta($uid, 'qq', $_POST['qq']);
			$error = 0;	
			$msg = '用户资料修改成功';
		}
		echo '<div class="cg-notify-message ng-scope '.($error?'alert-danger':'alert-success').'" ng-class="$classes" style="z-index: 800; margin-left: -68px; top: 150px; margin-top: -60px; visibility: visible; opacity: 1;" data-closing="true"><div ng-show="!$messageTemplate" class="ng-binding">'.$msg.'</div></div><script>setTimeout("$(\'.cg-notify-message\').hide();",2000)</script>';
		
	}elseif($_POST['action'] == '3'){
		$error = 0;$msg = ''; 
    	$password = $wpdb->escape($_POST['password']); 
		$password2 = $wpdb->escape($_POST['password2']); 
		if(strlen($password) < 6){
			$error = 1;
			$msg = '密码长度至少6位';
		}elseif($password != $password2){
			$error = 1;
			$msg = '两次输入密码不一致';
		}else{
			$userdata = array();
			$userdata['ID'] = wp_get_current_user()->ID;
			$userdata['user_pass'] = $password;
			wp_update_user($userdata);
			$error = 0;
			$msg = '用户密码修改成功';
		}
		
		
		echo '<div class="cg-notify-message ng-scope '.($error?'alert-danger':'alert-success').'" ng-class="$classes" style="z-index: 800; margin-left: -68px; top: 150px; margin-top: -60px; visibility: visible; opacity: 1;" data-closing="true"><div ng-show="!$messageTemplate" class="ng-binding">'.$msg.'</div></div><script>setTimeout("$(\'.cg-notify-message\').hide();",2000)</script>';
	}

}
?>

<link rel="stylesheet" href="<?php bloginfo("template_url")?>/static/css/user.css">
<div class="content main-content-wrap ng-scope">
  <div class="user-center-wrapper ng-scope">
    <div class="container">
      <div class="row">
        <?php include('modules/pageUserSide.php');?>
        <div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
          
            <div class="account-wrapper ng-scope">
              <ul class="nav nav-tabs" role="tablist">
                <li class="<?php if($_GET['account'] == 'basic' || !isset($_GET['account'])) echo 'active';?>"><a href="<?php echo MBT_add_querystring_var(selfURL(),'account','basic');?>">账号信息</a></li>
                <li class="<?php if($_GET['account'] == 'password') echo 'active';?>"><a href="<?php echo MBT_add_querystring_var(selfURL(),'account','password');?>">修改密码</a></li>
              </ul>
              <div class="panel panel-default ng-isolate-scope loading-content-wrap loading-show loading-show-active" loading="loading.show">
                <div class="panel-body ng-scope" ui-view="">
                  <?php if($_GET['account'] == 'basic' || !isset($_GET['account'])){?>
                	<!--账号信息开始-->
                  <form action="<?php echo get_bloginfo('template_url');?>/includes/action/avatar.php" method="post" class="form-horizontal account-form ng-pristine ng-valid ng-scope ng-valid-required" role="form" name="AvatarForm" id="AvatarForm"  enctype="multipart/form-data">
                    <div class="form-group">
                      <div class="col-sm-4 col-sm-offset-2">
                        <div class="avatar-editor"> <span class="avatar" style="background-image: url(<?php echo MBT_monkey_get_avatar(get_current_user_id());?>)"></span> <span class="name ng-binding"></span>
                          <a class="edit link-upload ng-scope" href="javascript:void(0)" ng-if="!progress"> 修改头像
                          <input type="file" name="addPic" id="addPic" ng-multiple="false" accept=".jpg, .gif, .png" resetonclick="true">
                          </a>
                        </div>
                      </div>
                    </div>
                  </form>
                  <form action="" method="post" class="form-horizontal account-form ng-pristine ng-valid ng-scope ng-valid-required" role="form" ng-submit="submitForm($event)" name="BasicInfoForm" ng-if="formData.id">
                    <div class="form-group">
                      <label class="col-sm-2 control-label">用户ID</label>
                      <div class="col-sm-4">
                        <input type="text" class="form-control ng-pristine ng-untouched ng-valid ng-valid-required" data-ng-model="formData.username" name="username" required="" value="<?php echo $current_user->user_login;?>" disabled="disabled">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label">用户昵称</label>
                      <div class="col-sm-4">
                        <input type="text" class="form-control ng-pristine ng-untouched ng-valid ng-valid-required" data-ng-model="formData.nickname" name="nickname" required="" placeholder="请输入用户昵称" value="<?php echo $current_user->nickname;?>">
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <label class="col-sm-2 control-label">邮箱</label>
                      <div class="col-sm-4">
                        <input type="email" class="form-control ng-pristine ng-untouched ng-valid ng-valid-required" data-ng-model="formData.email" required="" placeholder="请输入email" value="<?php echo $current_user->user_email;?>" name="email" >
                      </div>
                      <div class="col-sm-6 ng-scope" ng-if="(originData.unconfirmed_email || originData.email)">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label">QQ</label>
                      <div class="col-sm-4">
                        <input type="text" class="form-control ng-pristine ng-untouched ng-valid ng-scope" placeholder="" data-ng-model="formData.qq" name="qq" phone-format="" ng-if="!originData.qq" value="<?php echo get_user_meta($uid,'qq',true);?>">
                      </div>
                    </div>
                    <div class="form-group">
                    <label class="col-sm-2 control-label">一句话简介</label>
                    <div class="col-sm-4">
                    <textarea class="form-control" placeholder="" name="description"><?php echo $current_user->description;?></textarea>
                    </div>
                    <div class="col-sm-4 error-tip">
                    <!--请输入一句话简介-->
                    </div>
                    </div>
                    <div class="form-group">
                      <div class="col-sm-10 col-sm-offset-2">
                        <input type="hidden" name="action" value="1">
                        <button type="submit" class="btn btn-primary btn-lg ladda-button" ladda="submitLoading" data-style="expand-right" ng-click="submitForm($event)"><span class="ladda-label">提交</span><span class="ladda-spinner"></span></button>
                      </div>
                    </div>
                  </form>
                  <!--账号信息结束-->
                  <script src="http://libs.baidu.com/jquery/1.9.0/jquery.js"></script>
                  <script src="<?php echo get_bloginfo('template_url');?>/static/js/jquery.form.js"></script>
                  <script>
				  	jQuery(function($){
						$("#addPic").change(function(){
							$("#AvatarForm").ajaxSubmit({
								dataType:  'json',
								beforeSend: function() {
									//return tips('上传中...');	
								},
								uploadProgress: function(event, position, total, percentComplete) {
									
								},
								success: function(data) {
									if (data == "1") {
										//tips('头像修改成功');
										location.reload();     
									}else if(data == "2"){
										 alert('图片大小至多100K');	
									}else if(data == "3"){
										 alert('图片格式只支持.jpg .png .gif');	
									}else{
										 alert('上传失败');	
									}
								},
								error:function(xhr){
									alert('上传失败.');	
								}
							});
	
						});
					});
					
				  </script>
                  <?php }elseif($_GET['account'] == 'networks'){?>
                  <!--社交绑定开始-->
                  <div class="networks-wrapper ng-scope">
                    <div class="item weibo">
                        <span class="icon"><img src="<?php bloginfo('template_url')?>/static/img/weibo.png" alt=""></span>
                        <?php if( sina_is_active(get_user_meta($uid,'sina_access_token',true)) ){ ?>
                        <span class="status authed ng-scope">已授权</span>
                        <span class="name ng-binding">账号: </span>
                        <span class="op">
                            <a class="btn ng-scope cancle-sina" href="javascript:void(0)">取消授权</a>
                        </span>
                        <?php }else{?>
                        <span class="status ng-scope">未授权</span>
                        <span class="name ng-binding">账号: --</span>
                        <span class="op">
                            <a class="btn btn-primary ng-scope" href="<?php echo sina_login(get_bloginfo('url'));?>" >获取授权</a>
                        </span>
                        <?php }?>
                    </div>
                    <div class="item qq">
                        <span class="icon"><img src="<?php bloginfo('template_url')?>/static/img/qq.png" alt=""></span>
                        <?php if( !qq_is_active($uid)){ ?>
                        <span class="status authed ng-scope">已授权</span>
                        <span class="name ng-binding">账号: </span>
                        <span class="op">
                            <a class="btn ng-scope cancle-qq" href="javascript:void(0)" >取消授权</a>
                        </span>
                        <?php }else{?>
                        <span class="status ng-scope">未授权</span>
                        <span class="name ng-binding">账号: --</span>
                        <span class="op">
                            <a class="btn btn-primary ng-scope" href="<?php echo qq_login(get_bloginfo('url'));?>" >获取授权</a>
                        </span>
                        <?php }?>
                    </div>
                </div>
                <script src="http://libs.baidu.com/jquery/1.9.0/jquery.js"></script>
                <script>
					$(document).on("click", "a.cancle-sina",
					function() {
						$.ajax({
							url: '<?php echo get_bloginfo('url');?>/wp-admin/admin-ajax.php',
							type: "POST",
							data: {
								action:"sina_remove_bind",
								id:"<?php echo $uid;?>",
								},
							success: function(data) {
									$("a.cancle-sina").html("解除绑定成功");
									location.reload(true);
	
							}
						});

					});
					
					$(document).on("click", "a.cancle-qq",
					function() {
						$.ajax({
							url: '<?php echo get_bloginfo('url');?>/wp-admin/admin-ajax.php',
							type: "POST",
							data: {
								action:"qq_remove_bind",
								id:"<?php echo $uid;?>",
								},
							success: function(data) {
									$("a.cancle-qq").html("解除绑定成功");
									location.reload(true);
	
							}
						});

					});
				</script>
                <!--社交绑定结束-->
                <?php }elseif($_GET['account'] == 'password'){?>
                <!--修改密码开始-->
                <form action="" method="post" class="form-horizontal account-form ng-pristine ng-scope ng-invalid ng-invalid-required ng-valid-minlength" role="form" name="PasswordForm">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">输入新密码</label>
                        <div class="col-sm-4">
                            <input type="password" class="form-control ng-pristine ng-untouched ng-invalid ng-invalid-required ng-valid-minlength" placeholder="请输入6位以上密码" data-ng-model="user.password" required="" minlength="6" name="password">
                        </div>
                    </div>
                    
                     <div class="form-group">
                        <label class="col-sm-2 control-label">重复新密码</label>
                        <div class="col-sm-4">
                            <input type="password" class="form-control ng-pristine ng-untouched ng-invalid ng-invalid-required ng-valid-minlength" data-ng-model="user.password2" required="" minlength="6" name="password2">
                        </div>
                    </div>
                
                    <div class="form-group">
                        <div class="col-sm-10 col-sm-offset-2">
                        	<input type="hidden" name="action" value="3">
                            <button type="submit" class="btn btn-primary btn-lg ladda-button" ng-click="submitForm($event)" ladda="submitLoading" data-style="expand-right"><span class="ladda-label">修改</span><span class="ladda-spinner"></span></button>
                        </div>
                    </div>
                </form>
                <!--修改密码结束-->
                <?php }else{?>  
                  <div class="loading-wrap ng-scope ng-hide" ng-show="flag">
                    <div class="la-ball-scale-multiple la-2x">
                      <div></div>
                      <div></div>
                      <div></div>
                    </div>
                  </div>
                <?php }?>
                  
                </div>
              </div>
              
            </div>
          
        </div>
      </div>
    </div>
  </div>
</div>
<?php get_footer();?>