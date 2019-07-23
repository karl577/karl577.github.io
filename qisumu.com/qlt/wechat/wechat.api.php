<?php
/**
 * 微信通讯接口
 * 回复：sq上墙
 * 关注：插入关注人的信息
 * 取消：删除关注人的信息
 */
require(dirname(dirname(__FILE__)) . '/config/config_global.php');
$pdo = new PDO("mysql:host={$_config['db']['1']['dbhost']};port=3306;dbname={$_config['db']['1']['dbname']}", "{$_config['db']['1']['dbuser']}", "{$_config['db']['1']['dbpw']}");
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
$pdo->query('set names '.$_config['db']['1']['dbcharset']);

require(dirname(__FILE__) . '/wechat.class.php');
$options = array(
	'token'=>'fanqielab',
	'appid'=>'wxe60d67608aaf0c79',
	'appsecret'=>'a7ab03cc548684c2202ee6feb6e948ab',
);
$weObj = new Wechat($options); //实例
$weObj->valid(); //验证

$type = $weObj->getRev()->getRevType(); //消息类型
$data = $weObj->getRev()->getRevData(); //用户数据
$info = $weObj->getUserInfo($data['FromUserName']); //用户信息
switch($type) {
	case Wechat::MSGTYPE_TEXT:
		if (strstr($data['Content'], 'sq')) { 
			$message = str_replace('sq', '', $data['Content']);
			$ppr = $pdo->prepare("INSERT INTO wall (openid, message, time) VALUES ('{$info['openid']}', '$message', ".time().")");
			$ppr->execute();
			$weObj->text("发送上墙成功！")->reply();
		}
		break;
	case Wechat::MSGTYPE_EVENT:
		if ('subscribe' == $data['Event']) {
			$ppr = $pdo->prepare("INSERT INTO weixin_user (openid, nickname, sex, headimgurl, country, province, city, is_follow, createtime) 
				                  VALUES ('{$info['openid']}', '{$info['nickname']}', '{$info['sex']}', '{$info['headimgurl']}', '{$info['country']}', '{$info['province']}', '{$info['city']}', '{$info['subscribe']}', ".time().")");
			$ppr->execute();
		} else if ('unsubscribe' == $data['Event']) {
			$ppr = $pdo->prepare("DELETE FROM weixin_user WHERE openid = '{$info['openid']}'");
			$ppr->execute();
		}
		break;
	default:
		$weObj->text("更多功能，请联系作者qq549327015。")->reply();
}

/*
$menu = $weObj->getMenu(); //获取菜单

$newmenu =  array(
	"button"=> 
	array(
		array(
			'name'=>'一级菜单',
			'sub_button'=>
			array(
				array('type'=>'click','name'=>'二级菜单1','key'=>'MENU_C1'),
				array('type'=>'click','name'=>'二级菜单2','key'=>'MENU_C2'),
			)
		),
		array(
			'type'=>'view','name'=>'链接跳转','url'=>'http://www.fanqielab.com',
		),
	)
);

$result = $weObj->createMenu($newmenu); //创建菜单
*/