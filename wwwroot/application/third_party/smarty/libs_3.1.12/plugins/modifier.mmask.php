<?php
/**
 * Smarty plugin
 * 
 * @package Smarty
 * @subpackage PluginsModifier
 */

/**
 * Smarty mmask modifier plugin
 * 
 * Type:     modifier<br>
 * Name:     mmask<br>
 * Purpose:  aplica a mascara conforme passada Ex. 20120215|mmask:####/##/## -> 2012/02/15
 * 
 * @link http://clares.wordpress.com/2010/11/12/php-mascara-cnpj-cpf-data-e-qualquer-outra-coisa
 * @author MIXD Internet <irineu at mixd dot com dot br> 
 * @param string $ 
 * @return string 
 */
function smarty_modifier_mmask($val, $mask){ 
	$maskared = '';
	$k = 0;
	$len = strlen($mask)-1;
	for($i = 0; $i<=$len; $i++){
		if($mask[$i] == '#'){
			if(isset($val[$k])) $maskared .= $val[$k++];
		}
		else{
			if(isset($mask[$i])) $maskared .= $mask[$i];
		}
	}
	return $maskared;
} 

?>