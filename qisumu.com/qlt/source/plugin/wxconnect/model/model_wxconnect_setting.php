<?php
if(!defined('IN_DISCUZ')) {
	exit('Access Denied');
}
class model_wxconnect_setting
{
	
    public function getDefault()
    {
		$siteurl = wxconnect_env::get_siteurl();
		$plugin_path = wxconnect_env::get_plugin_path();
		$setting = array (
			'wx_app_id' => '',
			'wx_app_secret' => '',
			'wx_login_callback' => $siteurl.'/plugin.php?id=wxconnect:wxcallback',
			'pc_wxlogin_only' => 0,
			'tc_wxlogin_only' => 0,
			'groupid' => 21,
		);
		return $setting;
    }
    
	public function get()
	{
		$setting = $this->getDefault();
		global $_G;
		if (isset($_G['setting']['wxconnect_config'])){
			$config = unserialize($_G['setting']['wxconnect_config']);
			foreach ($setting as $key => &$item) {
				if (isset($config[$key])) $item = $config[$key];
			}
		}
		return $setting;
	}
}
?>