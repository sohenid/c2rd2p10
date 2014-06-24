<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * helper para velidar o www no url
 * redireciona para a pagina com www caso nao haja na mesma
 * retorna true caso seja dominio interno(.mixd) ou já haja www na url
 */
if ( ! function_exists('wwwRedirect'))
{
	function wwwRedirect(){
		/*código que redireciona para o site com www*/
		if(strpos($_SERVER['HTTP_HOST'], ".mixd") === FALSE){
	   		$www = substr($_SERVER['HTTP_HOST'], 0, 3);
	    	if($www != 'www'){
		        $redirect = "http://www.".$_SERVER['HTTP_HOST']."".$_SERVER['REQUEST_URI'];    
		        header ('HTTP/1.1 301 Moved Permanently');
		        header ('Location: '.$redirect);
	    	}else{
	    		return true;
	    	}	
		}else{
			return true;	
		}
	}
}