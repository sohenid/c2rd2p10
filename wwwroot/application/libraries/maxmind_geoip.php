<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

	require APPPATH.'third_party/MaxMind/geoip.inc';

	class Maxmind_geoip {
		
		public function __construct(){
			$this->ci = &get_instance();
		}
		
		public function retornaPais($ip){
			#$ip = '66.249.73.163';
			$gi = geoip_open(APPPATH.'third_party/MaxMind/GeoIP.dat', GEOIP_STANDARD);
			$pais = geoip_country_code_by_addr3($gi, $ip);
			geoip_close($gi);
			
			return $pais;
		}
		
		public function retornaBandeira($ip){
			#$ip = '66.249.73.163';
			$gi = geoip_open(APPPATH.'third_party/MaxMind/GeoIP.dat', GEOIP_STANDARD);
			$pais = geoip_country_code_by_addr($gi, $ip);
			geoip_close($gi);
			
			return $pais;
		}
	}
?>