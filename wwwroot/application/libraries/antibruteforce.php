<?
/*
define(DBFILEIP,		$_SERVER['DOCUMENT_ROOT'].'/img/cache/ips.ban');
define(NUMTRY, 			3);
define(SLEEPTIME,		30); // seconds
define(CLEANTIME,		10); // minutes
*/

class Antibruteforce{
	protected static $_DBFILEIP = '/cache/ips.ban';
	protected static $_NUMTRY = 3;
	protected static $_SLEEPTIME = 30; // seconds
	protected static $_CLEANTIME = 10; // minutes
	
	function check(){
		self::createDir();
		self::cleanIP();
		self::insertIP();
		$countIP = self::getCountIP();
		if($countIP > self::$_NUMTRY){
			sleep($countIP*self::$_SLEEPTIME);
		}
	}
	
	function getClientIP(){
		$trackIP = getenv('REMOTE_ADDR');
         if (getenv('HTTP_X_FORWARDED_FOR')){
         	$trackIP.=','.getenv('HTTP_X_FORWARDED_FOR');
         }
         return $trackIP;
	}

	function insertIP(){
		$ip = self::getClientIP();
		file_put_contents($_SERVER['DOCUMENT_ROOT'].self::$_DBFILEIP, strtotime("now").":".$ip.";", FILE_APPEND);
	}
	
	function getCountIP(){
		$ip = self::getClientIP();
		$allIps = file_get_contents($_SERVER['DOCUMENT_ROOT'].self::$_DBFILEIP);
		$countIps = substr_count($allIps, $ip);
		return $countIps;
	}
	
	function cleanIP(){
		$allIps = file_get_contents($_SERVER['DOCUMENT_ROOT'].self::$_DBFILEIP);
		if($allIps){
			$arrayIps = explode(";", $allIps);
			foreach($arrayIps as $k => $v){
				$time = explode(":", $v);
				$now = mktime(date("H"), date("i"), date("s"), date("m"), date("d"), date("Y"));
				if($time[0]){
					$diff = $now - $time[0];
					if($diff < (self::$_CLEANTIME*60)){
						$arrayBlocks[] = $v.";";	
					}
				}
			}
			$ipBlocks = implode("", $arrayBlocks);
			file_put_contents($_SERVER['DOCUMENT_ROOT'].self::$_DBFILEIP, $ipBlocks);
		}	
	}
	
	function createDir(){
		$dir = dirname($_SERVER['DOCUMENT_ROOT'].self::$_DBFILEIP);
		if(!is_dir($dir)){ 
			mkdir($dir, 0775, true);
		}
	}
}	
?>