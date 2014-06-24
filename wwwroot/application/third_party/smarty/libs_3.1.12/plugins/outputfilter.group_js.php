<?php
/**
* outputfilter group all js with pattern like <script src="/js/jquery.min.js"></script>
* @param string
* @param Smarty
* @return string
*/
function smarty_outputfilter_group_js($tpl_output, &$smarty){

	require($_SERVER["DOCUMENT_ROOT"].'/application/third_party/JavaScriptPacker.php');
	
	$cache_dir = '/cache/js';
	
	$html_output = preg_replace('/\<!--\/\/(.*?)\-->/is', '', $tpl_output);
	preg_match_all('/\<!--(.*?)\-->/is', $tpl_output, $comment);
	foreach($comment[0] as $k => $v){
		$array_comment_replace[$k] = "!@@COMMENT".$k."@@!";
		$array_comment[$k] = $v;
		
		// replace all comments
		$tpl_output = str_replace($v, "!@@COMMENT".$k."@@!", $tpl_output);
	}
	
	// grab all js
    preg_match_all('/<script (src=")(.*\.js)(.*)/i', $tpl_output, $patterns);
    
    $url_js = array_unique($patterns[0]);
    foreach($url_js as $k => $v){
    	/* if($k==0){
    		// creat a maker on the first js
    		$marker_js = "!@@COMBINEJS@@!";
    		// set where all js will be put together || replace / for \/ to avoid reg-exp bug
    		$tpl_output = preg_replace('/'.str_replace('/', '\/', $v).'/', $marker_js, $tpl_output, 1);
    		// if have some other js like the first one, remove it
			$tpl_output = str_replace($v, '', $tpl_output);
    	}
    	else{*/
    		// remove all js from source
			$tpl_output = str_replace($v, '', $tpl_output);
    	/*}*/
    }
    
    $all_js = array_unique($patterns[2]);
    $lastmodified = 0;
    $body_js = '';
    foreach($all_js as $k => $v){
		$file_js = $_SERVER["DOCUMENT_ROOT"]."".$v;
		$lastmodified = max($lastmodified, filemtime($file_js));
    	$body_js .= file_get_contents($file_js); 
    }
    
    // minify our js
    $body_js = smarty_outputfilter_group_js_minify($body_js);
    
    $group_js = implode(",", $all_js);
    $hash = $lastmodified."-".md5($group_js);
    $cache_file = "js-cache-".$hash.".js";
    
    /* obfuscate */
    $packer = new JavaScriptPacker($body_js, 'Normal', true, false);
    $packed = $packer->pack();
    $body_js = $packed; 
        
    $full_path_file = $_SERVER["DOCUMENT_ROOT"]."".$cache_dir."/".$cache_file;
    
    if(!file_exists($full_path_file)){
		if(!is_dir(dirname($full_path_file))) mkdir(dirname($full_path_file), 0775, true); 
		file_put_contents($full_path_file, $body_js);
    }
    
	// our new js file
    $group_js = "<script src=\"".$cache_dir."/".$cache_file."\"></script>";

    // give back all comments
    $tpl_output = str_replace($array_comment_replace, $array_comment, $tpl_output);
	
	return str_replace('</body>', $group_js."\n</body>", $tpl_output);    
}

function smarty_outputfilter_group_js_minify($string){
	$string = preg_replace('!/\*.*?\*/!s', '', $string);
	$string = str_replace('\n', '', $string);
	$string = str_replace('\t', '', $string);
    $string = preg_replace('/\s+/', ' ', $string);
    return $string;
	
}
?>