<?php
/**
 * Smarty plugin
 * 
 * @package Smarty
 * @subpackage PluginsModifier
 */

/**
 * Smarty mclear modifier plugin
 * 
 * Type:     modifier<br>
 * Name:     mclear<br>
 * Purpose:  limpa a acentuação das palavras e acrescenta traço(-) no lugar espaço
 * 
 * @link 
 * @author MIXD Internet <irineu at mixd dot com dot br> 
 * @param string $ 
 * @return string 
 */
function smarty_modifier_mclear($string, $traco=true){ 
    // passa tudo para minusculo
    $lower_string = mb_strtolower(trim($string), 'UTF-8');
	
    // removo os acentos
    $acentos = array(
		'a' => '/&agrave;|&aacute;|&acirc;|&atilde;|&auml;|&aring;/',
		'c' => '/&ccedil;/',
		'e' => '/&egrave;|&eacute;|&ecirc;|&euml;/',
		'i' => '/&igrave;|&iacute;|&icirc;|&iuml;/',
		'n' => '/&ntilde;/',
		'o' => '/&ograve;|&oacute;|&ocirc;|&otilde;|&ouml;/',
		'u' => '/&ugrave;|&uacute;|&ucirc;|&uuml;/',
		'y' => '/&yacute;|&yuml;/',
		'a.' => '/&ordf;/',
		'o.' => '/&ordm;/',
		' '	=> '#([^a-z0-9]+)#i'
	);
 	$lower_string = preg_replace($acentos, array_keys($acentos), htmlentities($lower_string,ENT_NOQUOTES, "UTF-8"));
    
    if ($traco)	$string_limpa = str_replace(" ", "-", $lower_string);
    else $string_limpa = $lower_string;
    
    return $string_limpa;
} 

?>