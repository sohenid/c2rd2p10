<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('converteBanner')){
	/*
	 * 
	 * 
	 * 
	 * */
	function converteBanner($banners){
		if($banners){
			foreach($banners as $fk => $v){
				#$v = $v[0];
				if($v['Banner_Tipo'] == 1){ /* banner javascript*/
					$banner = '<div class="estat-banner" data-id="'.$v['Banner_Id'].'">'.$v['Banner_Script'].'</div>';
				}
				else{ /* banner tradicional*/
					$info = pathinfo($v['Banner_Arquivo']);
					if(strtolower($info['extension']) == 'swf'){
						$banner = '<div class="lista-banners">
									<div class="wrap-banner-flash">
										<script type="text/javascript">swfobject.embedSWF("'.$v['Banner_Arquivo'].'", "banner-'.$v['Banner_Id'].'", "'.$v['Banner_Largura'].'", "'.$v['Banner_Altura'].'", "6.0.0");</script>
								   		<div id="banner-'.$v['Banner_Id'].'"><p>Alternative content</p></div>
									</div>
									<div class="wrap-banner-link">
										<a href="'.$v['Banner_Link'].'" target="'.$v['Banner_Target'].'" class="estat-banner" data-id="'.$v['Banner_Id'].'"><img src="/assets/img/estrutura/transparente.gif" width="'.$v['Banner_Largura'].'" height="'.$v['Banner_Altura'].'"></a>
									</div>   
								</div>';
						#swfobject.embedSWF("myContent.swf", "myContent", "300", "120", "9.0.0");
					}
					else{
						$banner = '<div class="lista-banners"><a href="'.$v['Banner_Link'].'" target="'.$v['Banner_Target'].'" class="estat-banner" data-id="'.$v['Banner_Id'].'"><img src="'.$v['Banner_Arquivo'].'" title="'.$v['Banner_Nome'].'"></a></div>';
					}
				}
				$retorno_banners[] = $banner;
			}
			return $retorno_banners;
		}
		else return false;	
	}
}