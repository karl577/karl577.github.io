<div class="qqonline">
	<div class="online"><a href="javascript:void(0)" ><i class="fa fa-qq"></i><span><?php echo zm_get_option('qq_name'); ?></span></a></div>
	<div class="qqonline-box">
		<div class="qqonline-main">
		<?php if ( zm_get_option('weixing_qr') == '' ) { ?>
		<?php } else { ?>
			<span class="nline-wiexin">
				<h4>微信</h4>
				<img title="微信" src="<?php echo zm_get_option('weixing_qr'); ?>"/>
			</span>
		<?php } ?>
			<span class="nline-qq"><a target=blank href=http://wpa.qq.com/msgrd?V=3&uin=<?php echo zm_get_option('qq_id'); ?>&Site=QQ&Menu=yes><i class="fa fa-qq"></i>在线咨询</a></span>
			</div>
		</div>
	</div>
</div>