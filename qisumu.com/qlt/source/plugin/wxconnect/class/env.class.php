<?php
if(!defined('IN_DISCUZ')) {
    exit('Access Denied');
}
require_once 'log.class.php';
require_once 'utils.class.php';
class wxconnect_env
{
    private static $_log_obj = null;
	
    public static function get_siteurl()
    {
        global $_G;
        $siteurl = rtrim($_G['siteurl'], '/');
		
		return $siteurl;
    }
	
    public static function get_sitename()
    {
        global $_G;
        $sitename = $_G["setting"]["sitename"];
        $charset = strtolower($_G['charset']);
        if ($charset=='gbk') {
            $sitename = wxconnect_utils::piconv($charset, "UTF-8", $sitename);
        }
        return $sitename;
    }
	
    public static function get_bbname()
    {
        global $_G;
        $sitename = $_G["setting"]["bbname"];
        $charset = strtolower($_G['charset']);
        if ($charset=='gbk') {
            $sitename = wxconnect_utils::piconv($charset, "UTF-8", $sitename);
        }
        return $sitename;
    }
    
    public static function get_admin_email()
    {
        global $_G;
        return $_G["setting"]["adminemail"];
    }
    
    public static function get_plugin_path()
    {
        return self::get_siteurl().'/source/plugin/wxconnect';
    }
	
	public static function get_wxlogin_logo() 
	{
		return self::get_plugin_path()."/template/libs/site/wxlogin.jpg";
	}
    
	public static function get_wxlogin_url_pc()
	{
		return self::get_siteurl()."/plugin.php?id=wxconnect&mod=wxlogin";
	}
    
    public static function result(array $result, $json_header=true)
    {
        if (!isset($result['retcode'])) {
            $result['retcode'] = 0;
        }
        if (!isset($result['retmsg'])) {
            $result['retmsg'] = 'succ';
        }
        if ($json_header) {
            header("Content-type: application/json");
        }
        echo json_encode($result);
        exit;
    }
    
    public static function getlog()
    {
        if (!self::$_log_obj) {
            $logcfg = array (
                'log_level' => 16, 
            );  
            self::$_log_obj = new wxconnect_log($logcfg);
        }   
        return self::$_log_obj;
    }
}
?>