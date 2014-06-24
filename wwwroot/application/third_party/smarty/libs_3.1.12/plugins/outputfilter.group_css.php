<?php
/**
* outputfilter group all css with pattern like <link href="/css/layout.css" rel="stylesheet" type="text/css" />
* @param string
* @param Smarty
* @return string
*/
function smarty_outputfilter_group_css($tpl_output, &$smarty){
	
	if(strpos($_SERVER['HTTP_HOST'], ".mixd") === false){ 
		#$static_host = 'http://static.'.$_SERVER['HTTP_HOST'];
		#$static_host = 'http://static.compreauto.com.br';
	}
	
	$cache_dir = '/cache/css';
	
	$html_output = preg_replace('/\<!--\/\/(.*?)\-->/is', '', $tpl_output);
	preg_match_all('/\<!--(.*?)\-->/is', $tpl_output, $comment);
	foreach($comment[0] as $k => $v){
		$array_comment_replace[$k] = "!@@COMMENT".$k."@@!";
		$array_comment[$k] = $v;
		
		// replace all comments
		$tpl_output = str_replace($v, "!@@COMMENT".$k."@@!", $tpl_output);
	}

	// grab all css
    preg_match_all('/<link (href=")(.*\.css)(.*)/i', $tpl_output, $patterns);
    
    $url_css = array_unique($patterns[0]);
    foreach($url_css as $k => $v){
    	if($k==0){
    		// creat a maker on the first css
    		$marker_css = "!@@COMBINECSS@@!";
    		// set where all css will be put together
    		/* alternativa para 
    		 * $tpl_output = preg_replace($v, $marker_css, $tpl_output, 1); 
    		 * */
    		$pos = strpos($tpl_output, $v);
    		if ($pos !== false) {
    			$tpl_output = substr_replace($tpl_output, $marker_css, $pos, strlen($v));
    		} 
    		// if have some other css like the first one, remove it
			$tpl_output = str_replace($v, '', $tpl_output);
    	}
    	else{
    		// remove all css from source
			$tpl_output = str_replace($v, '', $tpl_output);
    	}
    }

    $all_css = array_unique($patterns[2]);
    $lastmodified = 0;
    $body_css = '';
    foreach($all_css as $k => $v){
		$file_css = $_SERVER["DOCUMENT_ROOT"]."".$v;
		$lastmodified = max($lastmodified, filemtime($file_css));    	
    	$body_css .= file_get_contents($file_css); 
    }
    
    /*if($static_host){
    	$body_css = str_replace('background:url(/', "background:url($static_host/", $body_css);
    }*/
    
    // minify our css
    $body_css = smarty_outputfilter_group_css_minify($body_css);
    
    $group_css = implode(",", $all_css);
    $hash = $lastmodified."-".md5($group_css);
    $cache_file = "css-cache-".$hash.".css";
    $full_path_file = $_SERVER["DOCUMENT_ROOT"]."".$cache_dir."/".$cache_file;
    
    if(!file_exists($full_path_file)){
		if(!is_dir(dirname($full_path_file))) mkdir(dirname($full_path_file), 0775, true); 
		file_put_contents($full_path_file, $body_css);
    }
    
	// our new css file
    $group_css = "<link href=\"".$cache_dir."/".$cache_file."\" rel=\"stylesheet\" type=\"text/css\" />";
    
    // give back all comments
    $tpl_output = str_replace($array_comment_replace, $array_comment, $tpl_output);
    
    return str_replace($marker_css, $group_css, $tpl_output);
}

/**
 * css_minify common function
 *
 * Function: smarty_function_css_minify<br>
 * Purpose:  Minifies stylesheet definitions
 * @author   Joe Scylla <joe dot scylla at gmail dot com>
 * @author	 MIXD Internet < atendimento at mixd dot com dot br>
 * @param 	string	$v	Stylesheet definitions as string
 * @return 	string		Minified stylesheet definitions
 */
function smarty_outputfilter_group_css_minify($string){
	
	$string = trim($string);
	$string = str_replace("\r\n", "\n", $string);
	$search = array("/\/\*[\d\D]*?\*\/|\t+/", "/\s+/", "/\}\s+/");
	$replace = array(null, " ", "}\n");
	$string = preg_replace($search, $replace, $string);
	$search = array("/\\;\s/", "/\s+\{\\s+/", "/\\:\s+\\#/", "/,\s+/i", "/\\:\s+\\\'/i", "/\\:\s+([0-9]+|[A-F]+)/i");
	$replace = array(";", "{", ":#", ",", ":\'", ":$1");
	$string = preg_replace($search, $replace, $string);
	$string = str_replace("\n", null, $string);
	
	return $string;
}

?>