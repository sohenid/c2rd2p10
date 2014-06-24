<?php

#PowerCMS  Plugin youtube
#PowerCMS (c)2011 by Jan Czarnowski  (czarnowski@powercms.org)
#This project's homepage is: http://powercms.org
#
#This program is free software; you can redistribute it and/or modify
#it under the terms of the GNU General Public License as published by
#the Free Software Foundation; either version 2 of the License, or
#(at your option) any later version.
#
#This program is distributed in the hope that it will be useful,
#but WITHOUT ANY WARRANTY; without even the implied warranty of
#MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
#GNU General Public License for more details.
#You should have received a copy of the GNU General Public License
#along with this program; if not, write to the Free Software
#Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA

function smarty_function_youtube($params, &$smarty) {
    $code = trim(isset($params['code']) ? $params['code'] : '');
    $height = trim(isset($params['height']) ? $params['height'] : 344);
    $width = trim(isset($params['width']) ? $params['width'] : 425);
    #$start = trim(isset($params['start']) ? '&amp;start=' . $params['start'] : '');
    #$end = trim(isset($params['end']) ? '&amp;end=' . $params['end'] : '');
    $type = trim(isset($params['type']) ? $params['type'] : '');
    
    if($code <> ''){
		preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#", $code, $matches);
		$idVideo = $matches[0];
	    if($type == 'image'){
	    	
			$cacheFolder = $_SERVER['DOCUMENT_ROOT'].'/cache/img/youtube';
			if(!is_dir($cacheFolder."/")) mkdir($cacheFolder."/", 0775, true);

			$cacheFile = $idVideo.'.jpg';
			
			if(file_exists($cacheFolder.'/'.$cacheFile)){	    	
				$img = str_replace($_SERVER['DOCUMENT_ROOT'], '', $cacheFolder.'/'.$cacheFile);
			}
			else{
				$tmpImage = fopen($cacheFolder.'/'.$cacheFile, "w");
				$extImage = file_get_contents("http://i3.ytimg.com/vi/".$idVideo."/hqdefault.jpg");
				fwrite($tmpImage, $extImage);	
				fclose($tmpImage);
				$img = str_replace($_SERVER['DOCUMENT_ROOT'], '', $cacheFolder.'/'.$cacheFile);
			}
			echo thumb($img, $width, $height);
			#echo "http://i3.ytimg.com/vi/".$idVideo."/default.jpg";	    	
	    }
	    else{
	    	echo "<iframe width=\"$width\" height=\"$height\" src=\"http://www.youtube.com/embed/$idVideo\" frameborder=\"0\" allowfullscreen></iframe>";
	    }
    }
    else{
        return false;
    }
	/*        
	echo '<object type="application/x-shockwave-flash" style="width:' . $width . 'px; height:' . $height . 'px;" data="http://www.youtube.com/v/' . $code . $start . $end . '&amp;rel=0">
	<param name="movie" value="http://www.youtube.com/v/' . $code . $start . $end . '&amp;rel=0" /></object>';
	*/
}
?>  