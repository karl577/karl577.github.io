<div id="widget_icon">

		
		
		<?php if($options['snsicon']) : ?>
		
			<?php if($options['rss_select']) : ?>	
				<div id="widget_icon_rss">
					<a href="<?php bloginfo( 'rss2_url' ); ?>" target="_blank" title="RSS2.0订阅"></a>	
				</div>
			<?php endif; ?>	
			
			<?php if($options['twitter_select'] && $options['twitter_url']) : ?>
				<div id="widget_icon_twitter">
					<a href="<?php echo($options['twitter_url']); ?>" target="_blank" title="Follow me"></a>	
				</div>
			<?php endif; ?>		
			
			<?php if($options['facebook_select'] && $options['facebook_url']) : ?>
				<div id="widget_icon_facebook">
					<a href="<?php echo($options['facebook_url']); ?>" target="_blank" title="My Facebook"></a>	
				</div>
			<?php endif; ?>
			
			<?php if($options['da_select'] && $options['da_url']) : ?>
				<div id="widget_icon_da">
					<a href="<?php echo($options['da_url']); ?>" target="_blank" title="My Deviantart"></a>	
				</div>
			<?php endif; ?>
			
			<?php if($options['googleplus_select'] && $options['googleplus_url']) : ?>
				<div id="widget_icon_googleplus">
					<a href="<?php echo($options['googleplus_url']); ?>" target="_blank" title="My Google+"></a>	
				</div>
			<?php endif; ?>
			
			<?php if($options['dribbble_select'] && $options['dribbble_url']) : ?>
				<div id="widget_icon_dribbble">
					<a href="<?php echo($options['dribbble_url']); ?>" target="_blank" title="My Dribbble"></a>	
				</div>
			<?php endif; ?>
			
			
			<?php if($options['flicker_select'] && $options['flicker_url']) : ?>
				<div id="widget_icon_flicker">
					<a href="<?php echo($options['flicker_url']); ?>" target="_blank" title="My Flickr"></a>	
				</div>
			<?php endif; ?>
			
			
			<?php if($options['spotify_select'] && $options['spotify_url']) : ?>
				<div id="widget_icon_spotify">
					<a href="<?php echo($options['spotify_url']); ?>" target="_blank" title="My Spotify"></a>	
				</div>
			<?php endif; ?>
			
			<?php if($options['tumblr_select'] && $options['tumblr_url']) : ?>
				<div id="widget_icon_tumblr">
					<a href="<?php echo($options['tumblr_url']); ?>" target="_blank" title="My Tumblr" ></a>	
				</div>
			<?php endif; ?>
			
			<?php if($options['weibo_select'] && $options['weibo_url']) : ?>
				<div id="widget_icon_weibo">
					<a href="<?php echo($options['weibo_url']); ?>" target="_blank" title="新浪微博"></a>	
				</div>
			<?php endif; ?>
			
			<?php if($options['qqweibo_select'] && $options['qqweibo_url']) : ?>
				<div id="widget_icon_qqweibo">
					<a href="<?php echo($options['qqweibo_url']); ?>" target="_blank" title="腾讯微博"></a>	
				</div>
			<?php endif; ?>
			
			<?php if($options['kaixin_select'] && $options['kaixin_url']) : ?>
				<div id="widget_icon_kaixin">
					<a href="<?php echo($options['kaixin_url']); ?>" target="_blank" title="开心网"></a>	
				</div>
			<?php endif; ?>
			
			<?php if($options['renren_select'] && $options['renren_url']) : ?>
				<div id="widget_icon_renren">
					<a href="<?php echo($options['renren_url']); ?>" target="_blank" title="人人网"></a>	
				</div>
			<?php endif; ?>
			
			<?php if($options['douban_select'] && $options['douban_url']) : ?>
				<div id="widget_icon_douban">
					<a href="<?php echo($options['douban_url']); ?>" target="_blank" title="豆瓣" ></a>	
				</div>
			<?php endif; ?>
			
			<?php if($options['sohu_select'] && $options['sohu_url']) : ?>
				<div id="widget_icon_sohu">
					<a href="<?php echo($options['sohu_url']); ?>" target="_blank" title="搜狐微博"></a>	
				</div>
			<?php endif; ?>
			
			<?php if($options['wangyi_select'] && $options['wangyi_url']) : ?>
				<div id="widget_icon_wangyi">
					<a href="<?php echo($options['wangyi_url']); ?>" target="_blank" title="网易微博"></a>	
				</div>
			<?php endif; ?>
			
		<?php endif; ?>	
</div>
<div class="clear"></div>  