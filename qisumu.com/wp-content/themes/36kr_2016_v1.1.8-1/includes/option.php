<?php
	ob_start();
	
	function mbthemes_admin_menu() {
		add_menu_page('36kr主题设置', '主题设置', 'edit_themes', 'monkey-option', 'mbthemes_settings_page', 'dashicons-hammer', 59);
		
		add_action( 'admin_init', 'mbthemes_settings' );
	}

	
	function mbthemes_page_init(){
		global $pagenow;
		$dir = get_bloginfo('template_directory');
		if ( $pagenow =="admin.php" && $_GET['page'] == 'monkey-option') {
			wp_enqueue_style('admincss', $dir . '/static/css/admin.css', false, '1.0', false);
			wp_enqueue_script("jquery-ui-core");
			wp_enqueue_script("jquery-ui-sortable");
			wp_enqueue_script('media-upload');
			wp_enqueue_style('thickbox');
			wp_enqueue_script('adminjs', $dir . '/static/js/admin.js', false, '1.0', false);
		}
	}

	$current = get_transient('update_themes');

	function mbthemes_settings() {
		register_setting( 'mbthemes-settings-group', 'monkey-options' );	
	}
	
	function mbthemes_export_page() {
		if(mbt_domain_can_use()){
		if (!isset($_POST['export'])) { 
		?>
			<div class="wrap">
				<div id="icon-tools" class="icon32"><br /></div>
				<h2>导出设置</h2>
				<p>在您点击下面的按钮后，WordPress会创建一个json文件，供您保存到计算机中。</p>
				<p>保存完下载的文件后，便可以在其它WordPress站点中使用monkey的“导入设置”功能进行内容导入。</p>
				<h3>选择导出的内容</h3>
				<form method='post'>
					<p><label><input type="radio" name="content" value="all" checked="checked"> 所有内容</label></p>
					<p class="description">选择此项，则将包含monkey主题设置和小工具设置。</p>
					<p><label><input type="radio" name="content" value="theme"> 主题设置</label></p>
					<p><label><input type="radio" name="content" value="widget"> 小工具设置</label></p>					
					<p class="submit">
						<?php wp_nonce_field('ie-export'); ?>
						<input type='submit' name='export' class='button' value='下载导出的文件'/>
					</p>
				</form>
			</div>
		<?php 
		} else if (check_admin_referer('ie-export')) {
			$date = date("Y-m-d");
			
			$need_options = array();
			
			if( isset($_POST["content"]) ){
				
				if( $_POST["content"] == "widget" || $_POST["content"] == "all" ){
					$widgets = wp_get_sidebars_widgets();
					$need_options["sidebars_widgets"] = $widgets;
					
					$widgets_name = array(); // array_unique
					
					foreach($widgets as $key => $value){
						if( is_array($value) ){
							foreach($value as $k => $v){
								$v = preg_replace('/\-\d+/is', "", $v);
								$widgets_name[] = "widget_".$v;
							}
						}
					}
					
					$widgets_name = array_unique($widgets_name);
					
					foreach($widgets_name as $key){
						$need_options[$key] = get_option($key);
					}
				}
				
				if( $_POST["content"] == "theme" || $_POST["content"] == "all" ){
					$options = get_option('monkey-options');
					$need_options["monkey-options"] = $options;
				}
				
				$json_file = base64_encode( json_encode($need_options) ); // Encode data into json data
					
				ob_clean();
				echo $json_file;
				header("Content-Type: text/json; charset=" . get_option( 'blog_charset'));
				header("Content-Disposition: attachment; filename=monkey.{$date}.json");
				exit();
			
			}else{
				echo "<div class='error'><p>文件类型无效或者文件太大.</p></div>";
				exit();
			}
		}	
		}else{echo "<br /><br />域名未授权，请联系QQ 2243748";}		
	}

	
	function mbthemes_import_page(){
		if(mbt_domain_can_use()){
		?>
			<div class="wrap">
				<div id="icon-tools" class="icon32"><br /></div>
				<h2>导入设置</h2>
				<?php
					if (isset($_FILES['import']) && check_admin_referer('monkey-import')) {
						if ($_FILES['import']['error'] > 0) 
							wp_die("Error happens");		
						else {
							$file_name = $_FILES['import']['name'];
							$file_ext = strtolower(end(explode(".", $file_name)));
							$file_size = $_FILES['import']['size'];
							if (($file_ext == "json") && ($file_size < 500000)) {
								$encode_options = file_get_contents($_FILES['import']['tmp_name']);
								$options = json_decode( base64_decode($encode_options), true);
								
								foreach($options as $key => $value){
									update_option($key, $value);
								}
								echo "<div class='updated'><p>所有的选项都恢复成功.</p></div>";
							}	
							else 
								echo "<div class='error'><p>文件类型无效或者文件太大.</p></div>";
						}
					}
				?>
				<p>点击选择文件按钮，并选择你之前备份的json文件。</p>
				<p>点击上传文件并导入按钮，将会为你恢复之前保存的设置。</p>
				<form method='post' enctype='multipart/form-data'>
					<p><label for="import">从您的计算机上选择一个文件：</label> (最大大小：0.5MB) <input type='file' name='import' /></p>
					<p><input type='submit' name='submit' class="button" value='上传文件并导入'/></p>
					<?php wp_nonce_field('monkey-import'); ?>
				</form>
			</div>
		<?php	}else{echo "<br /><br />域名未授权，请联系QQ 2243748";}
	}
	
	


function mbthemes_settings_page() {
	if(mbt_domain_can_use()){
		if ( isset($_REQUEST['settings-updated']) ) echo '<div id="message" class="updated fade"><p><strong>主题设置已保存.</strong></p></div>';
		if( 'reset' == isset($_REQUEST['reset']) ) {
			delete_option('monkey-options');
			echo '<div id="message" class="updated fade"><p><strong>主题设置已重置!</strong></p></div>';
		}
	?>

		<div class="wrap">
			<p style="font-size:25px; font-weight:bold; line-height:10px;">36kr-2016主题设置</p><br /><br />
			<form method="post" action="options.php">
				<?php settings_fields( 'mbthemes-settings-group' ); ?>
				<?php $options = get_option('monkey-options'); ?>
				<div id="set-nav">
					<ul>
						<li><a class="current" href="#">基础设置</a></li>
						<li><a href="#">外观设置</a></li>
						<li><a href="#">文章设置</a></li>
						<li><a href="#">社交设置</a></li>
                        <li><a href="#">广告设置</a></li>
                        
					</ul>
				</div>
				<div id="set-cont" class="clx">
					<ul>
						<li class="current">
							<div class="item item-1 clx">
								<div class="span span1"><label class="set-label" for="monkey-options[description]">网站描述</label></div>
								<div class="span span2"><textarea type="textarea" class="set-textaera" name="monkey-options[description]"><?php echo $options['description']; ?></textarea></div>
								<div class="span span3"><span class="set-span">用简洁凝练的话对你的网站进行描述</span></div>
							</div>
							<div class="item clx">
								<div class="span span1"><label class="set-label" for="monkey-options[keywords]">网站关键词</label></div>
								<div class="span span2"><textarea type="textarea" class="set-textaera" name="monkey-options[keywords]"><?php echo $options['keywords']; ?></textarea></div>
								<div class="span span3"><span class="set-span">多个关键词请用英文逗号隔开</span></div>
							</div>
							<div class="item clx">
								<div class="span span1"><label class="set-label" for="monkey-options[analysis]">网站统计</label></div>
								<div class="span span2"><textarea type="textarea" class="set-textaera" name="monkey-options[analysis]"><?php echo $options['analysis']; ?></textarea></div>
								<div class="span span3"><span class="set-span">输入统计代码</span></div>
							</div>
                            <div class="item clx">
								<div class="span span1"><label class="set-label" for="monkey-options[css]">自定义css</label></div>
								<div class="span span2"><textarea type="textarea" class="set-textaera" name="monkey-options[css]"><?php echo $options['css']; ?></textarea></div>
								<div class="span span3"><span class="set-span"></span></div>
							</div>
                            <div class="item clx">
								<div class="span span1"><label class="set-label" for="monkey-options[copyright]">版权信息</label></div>
								<div class="span span2"><textarea type="textarea" class="set-textaera" name="monkey-options[copyright]"><?php echo $options['copyright']; ?></textarea></div>
								<div class="span span3"><span class="set-span"></span></div>
							</div>
						</li>
						<li>
							<div class="item item-1 clx">
								<div class="span span1"><label class="set-label" for="monkey-options[favicon]">自定义Favicon图标</label></div>
								<div class="span span2">
									<input type="text" class="set-favicon set-input" name="monkey-options[favicon]" value="<?php echo $options['favicon']; ?>" placeholder="Favicon图标地址" /><a href="#" class="button" action-data="">上传Favicon</a>
								</div>
								<div class="span span3 span-preview"><img src="<?php echo $options['favicon']; ?>" alt="" /></div>
							</div>
							<div class="item clx">
								<div class="span span1"><label class="set-label" for="monkey-options[logo]">自定义Logo图片</label></div>
								<div class="span span2">
									<input type="text" class="set-logo set-input" name="monkey-options[logo]" value="<?php echo $options['logo']; ?>" placeholder="Logo图片地址" /><a href="#" class="button" action-data="">上传Logo</a>
								</div>
								<div class="span span3 span-preview"><img src="<?php echo $options['logo']; ?>" alt="" /></div>
							</div>	
                            
                            
                                                        
                            <div class="item clx">
								<div class="span span1"><label class="set-label" for="monkey-options[pingback]">站内Pingback</label></div>
								<div class="span span2 span2-notes clx">
									<?php $switch = ($options['pingback'] == 1)? 1 :0;
										$switch_class = $switch ? "" : "disabled";
									?>
									<div class="switch switch-pingback <?php echo $switch_class;?>">
										<div class="switch-button"></div>
										<input type="hidden" name="monkey-options[pingback]" value="<?php echo $switch;?>" />
									</div>
									<div> "禁止" Pingback</div>
								</div>	
								<div class="span span3"><span class="set-span">默认为 "允许" </span></div>
							</div>	
                            <div class="item clx">
								<div class="span span1"><label class="set-label" for="monkey-options[fixtop]">固定顶部</label></div>
								<div class="span span2 span2-notes clx">
									<?php $switch = ($options['fixtop'] == 1)? 1 :0;
										$switch_class = $switch ? "" : "disabled";
									?>
									<div class="switch switch-fixtop <?php echo $switch_class;?>">
										<div class="switch-button"></div>
										<input type="hidden" name="monkey-options[fixtop]" value="<?php echo $switch;?>" />
									</div>
									<div>顶部菜单固定</div>
								</div>	
								<div class="span span3"><span class="set-span"></span></div>
							</div>
							<div class="item clx">
								<div class="span span1"><label class="set-label" for="monkey-options[ajaxpage]">无限加载</label></div>
								<div class="span span2 span2-notes clx">
									<?php $switch = ($options['ajaxpage'] == 1)? 1 :0;
										$switch_class = $switch ? "" : "disabled";
									?>
									<div class="switch switch-ajaxpage <?php echo $switch_class;?>">
										<div class="switch-button"></div>
										<input type="hidden" name="monkey-options[ajaxpage]" value="<?php echo $switch;?>" />
									</div>
									<div>下拉自动刷新</div>
								</div>	
								<div class="span span3"><span class="set-span"></span></div>
							</div>
                           <div class="item clx">
								<div class="span span1"><label class="set-label" for="monkey-options[catmenu]">分类菜单</label></div>
								<div class="span span2 span2-notes clx">
									<?php $switch = ($options['catmenu'] == 1)? 1 :0;
										$switch_class = $switch ? "" : "disabled";
									?>
									<div class="switch switch-catmenu <?php echo $switch_class;?>">
										<div class="switch-button"></div>
										<input type="hidden" name="monkey-options[catmenu]" value="<?php echo $switch;?>" />
									</div>
									<div>列表页上面分类菜单</div>
								</div>	
								<div class="span span3"><span class="set-span"></span></div>
							</div>
                            <div class="item clx">
								<div class="span span1"><label class="set-label" for="monkey-options[focusenabled]">显示焦点图</label></div>
								<div class="span span2 span2-notes clx">
									<?php $switch = ($options['focusenabled'] == 1)? 1 :0;
										$switch_class = $switch ? "" : "disabled";
										$ssstyle = $switch ? '' : 'display:none';
									?>
									<div class="switch switch-focusenabled <?php echo $switch_class;?>">
										<div class="switch-button"></div>
										<input type="hidden" name="monkey-options[focusenabled]" value="<?php echo $switch;?>" />
									</div>
									<div> "首页显示焦点图" 功能<br /> 大图填写文章标签，其余小图为自动获取的顶置文章，至少3篇</div>
								</div>
								<div class="span span3"><span class="set-span">默认 首页 <strong>不显示</strong> 焦点图</span></div>
							</div>	
                            
                            <div id="focus-itemwrap" style="margin-left:80px;<?php echo $ssstyle;?>">
                            	
                                
                                
                                <div class="set-sns clx">
									<div class="span span1"><label class="set-label" for="monkey-options[feedrrs]">-------轮播图文章标签</label></div>
									<div class="span span2"><input type="text" class="set-input" name="monkey-options[feedtag]" value="<?php echo $options['feedtag']; ?>" /></div>
									<div class="span span3"><span class="set-span"></span></div>
								</div>
                                
                                
                                
                              
                                
                            </div>
                            
							<div class="item clx">
								<div class="item-tipstop">
									<p><b>自定义缺省缩略图</b> </p>
									<p>可以自定义多个缩略图，随机显示，缩略图大小为：<strong>180*120px</strong>。如需删除，点击右上角的X。</p>
									<div><a href="javascript:;" id="addbutton-thumb" class="button">+添加缩略图</a></div>
								</div>
								<div id="thumb-preview" class="clx">
									<?php $thumbs = $options['thumbs'];
										$cnt = count($thumbs);
										if($cnt>0){
											foreach($thumbs as $val){
												printf('<div class="thumb-preview"><img src="%s"><input type="hidden" name="monkey-options[thumbs][]" value="%s"><a href="javascript:;">X</a></div>', $val, $val);
											}
										}
									?>
								</div>
							</div>
						</li>
						<li>
                            <div class="item item-1 clx">
								<div class="span span1"><label class="set-label" for="monkey-options[share]">文章分享</label></div>
								<div class="span span2 span2-notes clx">
									<?php $switch = ($options['share'] == 1)? 1 :0;
										$switch_class = $switch ? "" : "disabled";
									?>
									<div class="switch switch-share <?php echo $switch_class;?>">
										<div class="switch-button"></div>
										<input type="hidden" name="monkey-options[share]" value="<?php echo $switch;?>" />
									</div>
									<div> "文章内容页分享" 功能</div>
								</div>	
								<div class="span span3"><span class="set-span"></span></div>
							</div>
                            
                            <div class="item clx">
								<div class="span span1"><label class="set-label" for="monkey-options[relate]">相关文章</label></div>
								<div class="span span2 span2-notes clx">
									<?php $switch = ($options['relate'] == 1)? 1 :0;
										$switch_class = $switch ? "" : "disabled";
									?>
									<div class="switch switch-relate <?php echo $switch_class;?>">
										<div class="switch-button"></div>
										<input type="hidden" name="monkey-options[relate]" value="<?php echo $switch;?>" />
									</div>
									<div> "文章内容页相关文章" 功能</div>
								</div>	
								<div class="span span3"><span class="set-span"></span></div>
							</div>							
						</li>
						
						<li>
							<div class="item item-1 ">
								<!--div class="set-sns clx">
									<div class="span span1"><label class="set-label" for="monkey-options[qqid]">QQ登录id</label></div>
									<div class="span span2"><input type="text" class="set-input" name="monkey-options[qqid]" value="<?php echo $options['qqid']; ?>" /></div>
									<div class="span span3"><span class="set-span">用户QQ绑定登录</span></div>
								</div><div class="set-gap"></div>
								<div class="set-sns clx">
									<div class="span span1"><label class="set-label" for="monkey-options[qqkey]">QQ登录key</label></div>
									<div class="span span2"><input type="text" class="set-input" name="monkey-options[qqkey]" value="<?php echo $options['qqkey']; ?>" /></div>
									<div class="span span3"><span class="set-span">用户QQ绑定登录</span></div>
								</div><div class="set-gap"></div>
								<div class="set-sns clx">
									<div class="span span1"><label class="set-label" for="monkey-options[weiboid]">微博登录key</label></div>
									<div class="span span2"><input type="text" class="set-input" name="monkey-options[weiboid]" value="<?php echo $options['weiboid']; ?>" /></div>
									<div class="span span3"><span class="set-span">用户微博绑定登录</span></div>
								</div><div class="set-gap"></div>
								<div class="set-sns clx">
									<div class="span span1"><label class="set-label" for="monkey-options[weibokey]">微博登录secret</label></div>
									<div class="span span2"><input type="text" class="set-input" name="monkey-options[weibokey]" value="<?php echo $options['weibokey']; ?>" /></div>
									<div class="span span3"><span class="set-span">用户微博绑定登录</span></div>
								</div><div class="set-gap"></div-->
                                <div class="set-sns clx">
									<div class="span span1"><label class="set-label" for="monkey-options[feedrrs]">订阅地址</label></div>
									<div class="span span2"><input type="text" class="set-input" name="monkey-options[feedrrs]" value="<?php echo $options['feedrrs']; ?>" /></div>
									<div class="span span3"><span class="set-span">订阅地址，不填则显示默认feed地址</span></div>
								</div><div class="set-gap"></div>
								<div class="set-sns clx">
									<div class="span span1"><label class="set-label" for="monkey-options[sinawb]">新浪微博</label></div>
									<div class="span span2"><input type="text" class="set-input" name="monkey-options[sinawb]" value="<?php echo $options['sinawb']; ?>" /></div>
									<div class="span span3"><span class="set-span">新浪微博地址</span></div>
								</div><div class="set-gap"></div>
                                <div class="set-sns clx">
									<div class="span span1"><label class="set-label" for="monkey-options[facebook]">facebook</label></div>
									<div class="span span2"><input type="text" class="set-input" name="monkey-options[facebook]" value="<?php echo $options['facebook']; ?>" /></div>
									<div class="span span3"><span class="set-span">facebook地址</span></div>
								</div><div class="set-gap"></div>
                                <div class="set-sns clx">
									<div class="span span1"><label class="set-label" for="monkey-options[twitter]">twitter</label></div>
									<div class="span span2"><input type="text" class="set-input" name="monkey-options[twitter]" value="<?php echo $options['twitter']; ?>" /></div>
									<div class="span span3"><span class="set-span">twitter地址</span></div>
								</div><div class="set-gap"></div>
								<div class="set-sns clx">
									<div class="span span1"><label class="set-label" for="monkey-options[weixin]">微信</label></div>
									<div class="span span2"><input type="text" class="set-logo set-input" name="monkey-options[weixin]" value="<?php echo $options['weixin']; ?>" placeholder="微信二维码"/><a href="#" class="button" action-data="">上传二维码</a></div>
									<div class="span span3 span-preview"><img src="<?php echo $options['weixin']; ?>" alt="" /></div>
								</div>
                                <!--div class="set-sns clx">
									<div class="span span1"><label class="set-label" for="monkey-options[app]">客户端</label></div>
									<div class="span span2"><input type="text" class="set-app set-input" name="monkey-options[app]" value="<?php echo $options['app']; ?>" placeholder="顶部客户端二维码"/><a href="#" class="button" action-data="">上传二维码</a></div>
									<div class="span span3 span-preview"><img src="<?php echo $options['app']; ?>" alt="" /></div>
								</div-->
							</div>	
						</li>
                        <li>
                        	<div class="item item-1 clx">
								<div class="span span1"><label class="set-label" for="monkey-options[archivead]">存档页顶部</label></div>
								<div class="span span2"><textarea type="textarea" class="set-textaera" name="monkey-options[archivead]"><?php echo $options['archivead']; ?></textarea></div>
								<div class="span span3"><span class="set-span">日期存档以及标签页面 输入广告代码</span></div>
							</div>
							<div class="item clx">
								<div class="span span1"><label class="set-label" for="monkey-options[singlead]">文章正文下</label></div>
								<div class="span span2"><textarea type="textarea" class="set-textaera" name="monkey-options[singlead]"><?php echo $options['singlead']; ?></textarea></div>
								<div class="span span3"><span class="set-span">输入广告代码</span></div>
							</div>
							<div class="item clx">
								<div class="span span1"><label class="set-label" for="monkey-options[listad]">列表插播</label></div>
								<div class="span span2 span2-notes clx">
									<?php $switch = ($options['listad'] == 1)? 1 :0;
										$switch_class = $switch ? "" : "disabled";
										$ssstyle = $switch ? "" : 'style="display:none"';
									?>
									<div class="switch switch-listad <?php echo $switch_class;?>">
										<div class="switch-button"></div>
										<input type="hidden" name="monkey-options[listad]" value="<?php echo $switch;?>" />
									</div>
									<div> 文章列表第三项 "显示一则广告" 模块</div>
								</div>	
								<div class="span span3"><span class="set-span">默认为 <strong>不显示</strong></span></div>
							</div>	
                            			
                            <div id="listad-itemwrap" <?php echo $ssstyle;?>>
                            	<div class="item clx">
                                    <div class="span span1"><label class="set-label" for="monkey-options[adlist]">自定义广告</label></div>
                                    <div class="span span2"><textarea type="textarea" class="set-textaera" name="monkey-options[adlist]"><?php echo $options['adlist']; ?></textarea></div>
                                    <div class="span span3"><span class="set-span">留空则显示下面的定向广告</span></div>
                                </div>	
                            </div>
						</li>
                        <li>
                        
                        </li>
                        
					</ul>
				</div>
				<div class="mbthemes_submit_form">
					<input type="submit" class="button-primary mbthemes_submit_form_btn" name="save" value="<?php _e('Save Changes') ?>"/>
				</div>
			</form>
		<form method="post">
			<div class="mbthemes_reset_form">
				<input type="submit" name="reset" value="<?php _e('重置数据') ?>" class="button-secondary mbthemes_reset_form_btn"/> 重置有风险，操作需谨慎！
				<input type="hidden" name="reset" value="reset" />
			</div>
		</form>
		</div>
		<?php
			$ajax_url = get_bloginfo('template_directory'). "/timthumb.php";
			$admin_url = admin_url();
			echo "<script type='text/javascript'>var ajax_url = \"$ajax_url\"; </script>\n<script type='text/javascript'>var admin_url = \"$admin_url\"; </script>\n";
		?>
<?php }else{  ?>

	<div class="wrap">
		<br /><br />
				<?php settings_fields( 'mbthemes-settings-group' ); ?>
				<div id="set-nav">
					<ul>
						<li><a class="current" href="#">正版授权</a></li>
					</ul>
				</div>
				
		</div>
		<?php
			$ajax_url = get_bloginfo('template_directory'). "/timthumb.php";
			$admin_url = admin_url();
			echo "<script type='text/javascript'>var ajax_url = \"$ajax_url\"; </script>\n<script type='text/javascript'>var admin_url = \"$admin_url\"; </script>\n";}
		?>

<?php 
}

	//$options = get_option('monkey-options'); 
	add_action('admin_menu', 'mbthemes_admin_menu');
	add_action('admin_init', 'mbthemes_page_init');	
?>