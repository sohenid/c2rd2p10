<?php
/**
 * Smarty plugin
 *
 * @package Smarty
 * @subpackage PluginsFunction
 */

/**
 * Smarty {adm_table_title} function plugin
 *
 * Type:     function<br>
 * Name:     adm_table_title<br>
 * Date:     May 3, 2002<br>
 * Purpose:  facilitar nossa vida com as urls das tabelas<br>
 *
 * @author Irineu Martins Junior <irineu at mixd dot com dot br>
 */

function smarty_function_adm_table_title($params)
{
	#{adm_table_title titulo='Nome' campo='Noticia_Id' url_base=$base_url_order ord_campo=$ord_campo ord_tipo=$ord_tipo}
	#<a href="{$base_url_order}&ord_campo=Banner_Id&ord_tipo={if ($ord_campo == 'Banner_Id') && ($ord_tipo == 'asc') }desc {assign var="seta" value="<i class='icon-caret-down'>"}{else}asc {assign var="seta" value="<i class='icon-caret-up'>"}{/if}">#</a> {if ($ord_campo == 'Banner_Id')}{$seta}{/if}
	
	$url_base 	= $params['url_base'];
	$titulo 	= $params['titulo'];
	$campo		= $params['campo'];
	$ord_campo	= $params['ord_campo'];
	$ord_tipo	= $params['ord_tipo'];
	
	if(($ord_campo == $campo) && ($ord_tipo == 'asc')){
		$ordenacao = 'desc';
		$seta = 'icon-caret-up';
	}
	else{
		$ordenacao = 'asc';
		$seta = 'icon-caret-down';
	}
	
	$prepara_seta = ($ord_campo == $campo) ? '<i class="'.$seta.'"></i>' : '';
	
	$url = '<a href="'.$url_base.'&ord_campo='.$campo.'&ord_tipo='.$ordenacao.'">'.$titulo.' '.$prepara_seta.'</a>';
	return $url;
}

?>