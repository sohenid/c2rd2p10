<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * http://codeigniter.com/forums/viewthread/178095/
 * Fix: http://codeigniter.com/forums/viewthread/178095/#934872
 * Fix: MIXD Internet
 */

if ( ! function_exists('mixdThumb')){
	function mixdThumb($file, $resolucao, $resize=TRUE){

		#if($resolucao == FALSE){
		#	list($force_width, $force_height, $type, $attr) = getimagesize($file);
		#}
		#else{
			$arr_res = explode('x', $resolucao);
			$force_width = $arr_res[0];
			$force_height = $arr_res[1];
		#}
		
		if($resize == FALSE){
			$file_name = basename($file);
				
			$cacheFolder = $_SERVER['DOCUMENT_ROOT']."/cache/thumbs/$force_width/$force_height/";
			if(!is_dir($cacheFolder)) mkdir($cacheFolder, 0775, true);
	
			if(!file_exists($cacheFolder.$file_name)){
				copy($file, $cacheFolder.$file_name);
			}
			else{
				return str_replace($_SERVER['DOCUMENT_ROOT'], '', $cacheFolder.$file_name);
				exit();
			}
			$file = $cacheFolder.$file_name;
		}

		$ci=& get_instance();
		$ci->load->library('image_lib');
		
		//math for resize/crop without loss
		$o_size = _get_size($file);
		#$master_dim_new_width = ceil($o_size['width']*$force_height/$o_size['height']);
		#$master_dim_new_height = ceil($force_width*$o_size['height']/$o_size['width']);
		#$master_dim_ratio = (($this->orig_height/$this->orig_width) - ($this->height/$this->width));
		#$ratio = (($o_size['height']/$o_size['width']) - ($force_height/$force_width));
		#$master_dim = ($o_size['width']-$force_width < $o_size['height']-$force_height?'width':'height');
		$master_dim = ((($o_size['height']/$o_size['width']) - ($force_height/$force_width)) < 0) ? 'width' : 'height';
		$master_dim = 'auto';
		
		$perc = max( (100*$force_width)/$o_size['width'] , (100*$force_height)/$o_size['height'] );
		$perc = round($perc, 0);
		
		$w_d = round(($perc*$o_size['width'])/100, 0);
		$h_d = round(($perc*$o_size['height'])/100, 0);
		// end math stuff		
		
		/* se for muito pequena, não faz resize */
		$do_resize = TRUE;
		if(($o_size['width'] < $force_width) && ($o_size['height'] < $force_height)){
			$do_resize = FALSE;
		}
		
		#echo $force_width .' > '. $o_size['width'];
		#echo '<br />';
		#echo $force_height .' > '. $o_size['height'];
		
		$config['image_library'] = 'gd2';
		$config['source_image'] = $file;
		$config['quality'] = '90';
		$config['maintain_ratio'] = TRUE;
		$config['master_dim'] = $master_dim;
		#$config['width'] = $w_d+1;
		#$config['height'] = $h_d+1;
		$config['width'] = $force_width;
		$config['height'] = $force_height;
		$ci->image_lib->clear();
		$ci->image_lib->initialize($config);
		if($do_resize) $ci->image_lib->resize();
		
		/* fundo branco
		$imagem_branca = $_SERVER['DOCUMENT_ROOT']."/cache/imagem_branca.jpg";
		$imagem_base = imagecreatetruecolor($force_width, $force_height);
		$fundo_branco = imagecolorallocate ( $imagem_base, 255, 255, 255 );
		imagefill($imagem_base, 0, 0, $fundo_branco);
		$arquivo_branco = imagejpeg($imagem_base, $imagem_branca, 100);
		*/
		
		
		/* espaco em branco 
		$size = _get_size($file);
		unset($config); // clear $config
		$config['width'] = $force_width;
		$config['height'] = $force_height;
		$config['y_axis'] = ($master_dim == 'width') ? round(($size['height'] - $force_height) / 2) : 0;
		$config['x_axis'] = ($master_dim == 'height') ? round(($size['width'] - $force_width) / 2) : 0;		
		$ci->image_lib->initialize($config);
		$ci->image_lib->crop();*/
		
		/* recorta se for maior */
		/*
		$size = _get_size($file);
		unset($config); // clear $config
		$config['image_library'] = 'gd2';
		$config['source_image'] = $file;
		$config['maintain_ratio'] = FALSE;
		$config['width'] = $force_width;
		$config['height'] = $force_height;
		$config['y_axis'] = ($master_dim == 'width') ? round(($size['height'] - $force_height) / 2) : 0;
		$config['x_axis'] = ($master_dim == 'height') ? round(($size['width'] - $force_width) / 2) : 0;		
		
		
		$ci->image_lib->clear();
		$ci->image_lib->initialize($config);
		$ci->image_lib->crop();
		*/
		$ci->image_lib->clear();
		
		if($resize == FALSE){
			return str_replace($_SERVER['DOCUMENT_ROOT'], '', $file);
		}
	}
}

if ( ! function_exists('_get_size')){
	function _get_size($image) {
		$img = getimagesize($image);
		return array('width'=>$img[0], 'height'=>$img[1]);
	}
}	