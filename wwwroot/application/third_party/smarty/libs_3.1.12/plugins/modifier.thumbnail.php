<?php
$class = $_SERVER['DOCUMENT_ROOT'].'/application/helpers/image_helper.php';
require_once($class);

/**
* Smarty plugin
* @package Smarty
* @subpackage plugins
*/

/**
* Smarty plugin
*
* Type: modifier
* Name: thumbnail
* Date: 22-11-2008
* Purpose: Creates an thumbnail with a path to an image. Thumbnail gets the given width and height. Returnes the path to the thumb.
* Example: {/img/semImagem.jpg|thumbnail:800x600}
* @version 1.0
* @param string, path to original image
* @param str, resolution
* @return string path to thumb
*/
function smarty_modifier_thumbnail($image, $resolution) {
		$resolution = explode('x', $resolution);
        $width = $resolution[0];
        $height = $resolution[1];

        if((!is_file($_SERVER['DOCUMENT_ROOT'].$image))) $image = '/assets/img/estrutura/semImagem.jpg';
		
        $subdir = $width."/".$height."/".date("m/d", filemtime($_SERVER['DOCUMENT_ROOT'].$image));
		$cacheFolder = $_SERVER['DOCUMENT_ROOT']."/cache/img/$subdir";

		if(!is_dir($cacheFolder."/")) mkdir($cacheFolder."/", 0775, true); 
		
        $thumb = sprintf("%s/%d_%d_%s", $cacheFolder, $width, $height, basename($image));
		$image = $_SERVER['DOCUMENT_ROOT'].$image;
		
		if ((!file_exists($thumb))) {
			$imgOriginal = file_get_contents($image);
			$imgThumb = file_put_contents($thumb, $imgOriginal);
			mixdThumb($thumb, $width.'x'.$height);
		}
        return str_replace($_SERVER['DOCUMENT_ROOT'], '', $thumb);
}        
?>