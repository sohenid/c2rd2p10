<?php
/**
 * Smarty plugin
 *
 * @package Smarty
 * @subpackage PluginsFilter
 */

/**
 * Smarty minify outputfilter plugin
 *
 * File:     outputfilter.minify.php<br>
 * Type:     minify<br>
 * Name:     minify<br>
 * Date:     Jun 26, 2011<br>
 * Purpose:  Remove all /n /t and excessive blank space
 *           
 * Install:  Drop into the plugin directory, call
 *           <code>$smarty->load_filter('output','minify');</code>
 *           from application.
 * @author   MIXD Internet <atendimento at mixd dot com dot br>
 * @author   Irineu Martins Junior <irineu at mixd dot com dot br>
 * @version  0.1
 * @param string $source input string
 * @param object &$smarty Smarty object
 * @return string filtered output
 */
function smarty_outputfilter_minify($source, $smarty){
	$source = str_replace("\n", "", $source);
	$source = str_replace("\t", "", $source);
    $source = preg_replace("/\s+/", " ", $source);
    return $source;
}
?>