<?php
class SpiUtils{
	private static $top_sign_list = "HTTP_TOP_SIGN_LIST";
	private static $timestamp = "timestamp";
	private static $header_real_ip = array("X_Real_IP", "X_Forwarded_For", "Proxy_Client_IP",
											"WL_Proxy_Client_IP", "HTTP_CLIENT_IP", "HTTP_X_FORWARDED_FOR");
	public static function checkSign4FormRequest($secret){
		return self::checkSign(null,null,$secret);
	}

	public static function checkSign4TextRequest($body,$secret){
		return self::checkSign(null,$body,$secret);
	}
	
	public static function checkSign4FileRequest($form, $secret){
		return self::checkSign($form, null, $secret);
	}

	private static function checkSign($form, $body, $secret) {
		$params = array();
		$headerMap = self::getHeaderMap();
		foreach ($headerMap as $k => $v){
			$params[$k] = $v ;
		}

		$queryMap = self::getQueryMap();
		foreach ($queryMap as $k => $v){
			$params[$k] = $v ;
		}

		if ($form == null && $body == null) {
			$formMap = self::getFormMap();
			foreach ($formMap as $k => $v){
				$params[$k] = $v ;
			}
		} else if ($form != null) {
			foreach ($form as $k => $v){
				$params[$k] = $v ;
			}
		}

		if($body == null){
			$body = file_get_contents('php://input');
		}

		$remoteSign = $queryMap["sign"];
		$localSign = self::sign($params, $body, $secret);
		if (strcmp($remoteSign, $localSign) == 0) {
			return true;
		} else {
			$paramStr = self::getParamStrFromMap($params);
			self::logCommunicationError($remoteSign,$localSign,$paramStr,$body);
			return false;
		}
	}

	private static function getHeaderMap() {
		$headerMap = array();
		$signList = $_SERVER['HTTP_TOP_SIGN_LIST']; 
		$signList = trim($signList);
		if (strlen($signList) > 0){
			$params = split(",", $signList);
			foreach ($_SERVER as $k => $v){
				if (substr($k, 0, 5) == 'HTTP_'){
					foreach($params as $kk){
						$upperkey = strtoupper($kk);
						if(self::endWith($k,$upperkey)){
							$headerMap[$kk] = $v;
						}
					}
				}
			}
		}
		return $headerMap;
	}

	private static function getQueryMap(){
		$queryStr = $_SERVER["QUERY_STRING"];
		$resultArray = array();
		foreach (explode('&', $queryStr) as $pair) {
		    list($key, $value) = explode('=', $pair);
		    if (strpos($key, '.') !== false) {
		        list($subKey, $subVal) = explode('.', $key);

		        if (preg_match('/(?P<name>\w+)\[(?P<index>\w+)\]/', $subKey, $matches)) {
		            $resultArray[$matches['name']][$matches['index']][$subVal] = $value;
		        } else {
		            $resultArray[$subKey][$subVal] = urldecode($value);
		        }
		    } else {
		        $resultArray[$key] = urldecode($value);
		    }
		}
		return $resultArray;
	}

	private static function checkRemoteIp(){
		$remoteIp = $_SERVER["REMOTE_ADDR"];
		foreach ($header_real_ip as $k){
			$realIp = $_SERVER[$k];
			$realIp = trim($realIp);
			if(strlen($realIp) > 0 && strcasecmp("unknown",$realIp)){
				$remoteIp = $realIp;
				break;
			}
		}
		return self::startsWith($remoteIp,"140.205.144.") || self::startsWith($remoteIp,"40.205.145.");
	}

	private static function getFormMap(){
		$resultArray = array();
		foreach($_POST as $key=>$v) { 
			$resultArray[$key] = $v ;
		}
		return $resultArray ;	
	}

	private static function startsWith($haystack, $needle) {
    	return $needle === "" || strpos($haystack, $needle) === 0;
	}

	private static function endWith($haystack, $needle) {   
	    $length = strlen($needle);  
	    if($length == 0)
	    {    
	        return true;  
	    }  
	    return (substr($haystack, -$length) === $needle);
 	}

	private static function checkTimestamp(){
		$ts = $_POST['timestamp'];
		if($ts){
			$clientTimestamp = strtotime($ts);
			$current = $_SERVER['REQUEST_TIME'];
			return ($current - $clientTimestamp) <= 5*60*1000;
		}else{
			return false;
		}
	}

	private static function getParamStrFromMap($params){
		ksort($params);
		$stringToBeSigned = "";
		foreach ($params as $k => $v)
		{
			if(strcmp("sign", $k) != 0)
			{
				$stringToBeSigned .= "$k$v";
			}
		}
		unset($k, $v);
		return $stringToBeSigned;
	}

	private static function sign($params,$body,$secret){
		ksort($params);

		$stringToBeSigned = $secret;
		$stringToBeSigned .= self::getParamStrFromMap($params);

		if($body)
			$stringToBeSigned .= $body;
		$stringToBeSigned .= $secret;
		return strtoupper(md5($stringToBeSigned));
	}

	protected static function logCommunicationError($remoteSign, $localSign, $paramStr, $body)
	{
		$localIp = isset($_SERVER["SERVER_ADDR"]) ? $_SERVER["SERVER_ADDR"] : "CLI";
		$logger = new TopLogger;
		$logger->conf["log_file"] = rtrim(TOP_SDK_WORK_DIR, '\\/') . '/' . "logs/top_comm_err_". date("Y-m-d") . ".log";
		$logger->conf["separator"] = "^_^";
		$logData = array(
		"checkTopSign error" ,
		"remoteSign=".$remoteSign ,
		"localSign=".$localSign ,
		"paramStr=".$paramStr ,
		"body=".$body
		);
		$logger->log($logData);
	}
	private static function clear_blank($str, $glue='')
	{
		$replace = array(" ", "\r", "\n", "\t"); return str_replace($replace, $glue, $str);
	}
}
?>