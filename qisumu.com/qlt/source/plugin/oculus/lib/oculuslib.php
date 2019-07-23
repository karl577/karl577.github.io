<?php
if (! defined('IN_DISCUZ')) {
	exit('Access Denied');
}
loadcache('oc_cache');
C::import('TopSdk', 'plugin/oculus/top');
class Oculus {
	private $pop_config = array ();
	private $top_config = array ();
	public function __construct() {
		loadcache('nc_cache', true);
		global $_G;
		if(self::isPop()) {
			$this->pop_config = $_G['cache']['oc_cache'];
		} else {
			$nc_cache = $_G['cache']['nc_cache'];
			if($nc_cache == '' || ! isset($nc_cache)) {
				$config = @include DISCUZ_ROOT . 'source/plugin/oculus/lib/config.php';
				$this->$config['nc_config'];
			} else {
				$this->top_config = $nc_cache;
			}
		}
	}
	public function getAppKey() {
		if(self::isPop()) {
			return $this->pop_config['oculus_appkey'];
		}
		return $this->top_config['afs_key'];
	}
	public function getAppVer() {
		if(self::isPop()) {
			return $this->pop_config['oculus_version'];
		}
		return $this->top_config['oculus_version'];
	}
	public static function isPop() {
		global $_G;
		$appkey = $_G['cache']['oc_cache']['oculus_appkey'];
		if($appkey == '' || ! isset($appkey)) {
			return false;
		}
		return $appkey != 'IGVP';
	}
	private static function percent_encode($str) {
		$res = urlencode($str);
		$res = preg_replace('/\+/', '%20', $res);
		$res = preg_replace('/\*/', '%2A', $res);
		$res = preg_replace('/%7E/', '~', $res);
		return $res;
	}
	private static function computeSignature($parameters, $accessKeySecret) {
		ksort($parameters);
		$canonicalizedQueryString = '';
		foreach($parameters as $key => $value) {
			$canonicalizedQueryString .= '&' . self::percent_encode($key) . '=' . self::percent_encode($value);
		}
		$stringToSign = 'GET&%2F&' . self::percent_encode(substr($canonicalizedQueryString, 1));
		$signature = base64_encode(hash_hmac('sha1', $stringToSign, $accessKeySecret . "&", true));
		
		return $signature;
	}
	public function check_oculus_risk($token, $sessionId, $remoteIp, $sig) {
		if(self::isPop()) {
			return $this->check_oculus_risk_for_pop($token, $sessionId, $remoteIp, $sig);
		}
		return $this->check_oculus_risk_for_top($token, $sessionId, $remoteIp, $sig);
	}
	
	/*
	 * 1:true,-1:false,0:error
	 */
	private function check_oculus_risk_for_pop($token, $sessionId, $remoteIp, $sig) {
		$query_params = array ();
		$query_params["Token"] = $token;
		$query_params["SessionId"] = $sessionId;
		$query_params["Sig"] = $sig;
		$query_params["RemoteIp"] = $remoteIp;
		$query_params["AppKey"] = $this->pop_config['oculus_appkey'];
		$query_params["Serno"] = md5($query_params["AppKey"] . $this->pop_config['oculus_appsecret'] . $query_params["Token"] . $query_params["Sig"]);
		$query_params["RegionId"] = "cn-hangzhou";
		$query_params["AccessKeyId"] = $this->pop_config['oculus_accesskeyid'];
		$query_params["Format"] = "JSON";
		$query_params["SignatureMethod"] = "HMAC-SHA1";
		$query_params["SignatureVersion"] = "1.0";
		$query_params["SignatureNonce"] = uniqid();
		date_default_timezone_set("GMT");
		$query_params["Timestamp"] = date('Y-m-d\TH:i:s\Z');
		$query_params["Action"] = "Authenticate";
		$query_params["Version"] = "2015-11-27";
		$query_params["Signature"] = self::computeSignature($query_params, $this->pop_config['oculus_accesskeysecret']);
		
		$request_url = "https://cf.aliyuncs.com/?";
		foreach($query_params as $query_param_key => $query_param_value) {
			$request_url .= "$query_param_key=" . urlencode($query_param_value) . "&";
		}
		$res_risk = dfsockopen($request_url);
		if($res_risk) {
			$response_json = json_decode($res_risk, true);
			if(array_key_exists("SigAuthenticateResult", $response_json)) {
				if($response_json["SigAuthenticateResult"]["Code"] == 100 || $response_json["SigAuthenticateResult"]["Code"] == 200) { // 所有参数正常返回状态
					return 1;
				} else {
					return - 1;
				}
			}
			if($response_json["Code"] === "Throttling.User") { // 每天1000次流量已用完
				return 1;
			}
			return 0;
		} else {
			return 1;
		}
	}
	
	/*
	 * 1:true,-1:false,0:error
	 */
	private function check_oculus_risk_for_top($token, $sessionId, $remoteIp, $sig) {
		$top_client = new TopClient();
		$top_client->format = 'json';
		$top_client->appkey = $this->top_config['top_appkey'];
		$top_client->secretKey = $this->top_config['top_secret'];
		$top_url = $this->top_config['top_url'];
		if(isset($top_url) && $top_url != '') {
			$top_client->gatewayUrl = $top_url;
		}
		$req = new AlibabaSecurityJaqAfsCheckRequest();
		$req->setPlatform("3");
		$req->setToken($token);
		$req->setSessionId($sessionId);
		$req->setSig($sig);
		$req->setAfsKey($this->top_config['afs_key']);
		$resp = $top_client->execute($req);
		if(isset($resp->data)) {
			if($resp->data) {
				return 1;
			} else {
				return - 1;
			}
		} else {
			return 0;
		}
	}
	public function check_yundun_appkey($appkey, $appsecret, $accesskeyid, $accesskeysecret) {
		$query_params = array ();
		$query_params["Token"] = "6c3a46781ee15f1601a8096554627b78";
		$query_params["SessionId"] = "7dce8fd00a128497459fda5284b04771";
		$query_params["Sig"] = "047b_IoVqqQEMkIX9PoXMsIsX9PY6l-6LPObdXmmh_jA8pBwYmZLzWh8cdigBqnpHiB0EUuw2uzdbc81h8WoCYinYvcvcUUhCUsdGbe8ArIWNJaze_SOQCCJJhO_GjnZOAAHkO58r9u9Jkn5HplVwJKw";
		$query_params["RemoteIp"] = "8.8.8.8";
		$query_params["AppKey"] = $appkey;
		$query_params["Serno"] = md5($appkey . $appsecret . $query_params["Token"] . $query_params["Sig"]);
		$query_params["RegionId"] = "cn-hangzhou";
		$query_params["AccessKeyId"] = $accesskeyid;
		$query_params["Format"] = "JSON";
		$query_params["SignatureMethod"] = "HMAC-SHA1";
		$query_params["SignatureVersion"] = "1.0";
		$query_params["SignatureNonce"] = uniqid();
		date_default_timezone_set("GMT");
		$query_params["Timestamp"] = date('Y-m-d\TH:i:s\Z');
		$query_params["Action"] = "Authenticate";
		$query_params["Version"] = "2015-11-27";
		$query_params["Signature"] = self::computeSignature($query_params, $accesskeysecret);
		
		$request_url = "https://cf.aliyuncs.com/?";
		
		foreach($query_params as $query_param_key => $query_param_value) {
			$request_url .= "$query_param_key=" . urlencode($query_param_value) . "&";
		}
		$response = dfsockopen($request_url);
		if($response) {
			$response_json = json_decode($response, true);
			if(array_key_exists("SigAuthenticateResult", $response_json)) {
				if($response_json["SigAuthenticateResult"]["Msg"] === "appkey valitation error") { // oculus_appsecret 错误
					return 3;
				} else {
					return 1;
				}
			} /* 容错处理 */
elseif($response_json["Code"] === "SignatureDoesNotMatch") { // oculus_accesskeysecret 错误
				return 4;
			} elseif($response_json["Code"] === "InvalidAccessKeyId.NotFound") { // oculus_accesskeyid 错误
				return 5;
			} elseif($response_json["Code"] === 'SignatureNonceUsed' || $response_json["Code"] === 'Throttling.User') {
				return 1;
			} else {
				return 2;
			}
		}
	}
}
