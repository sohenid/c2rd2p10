<?php
/**
 * Smarty plugin
 *
 * @package Smarty
 * @subpackage PluginsFunction
 */

/**
 * Smarty {malerta} function plugin
 *
 * Type:     function<br>
 * Name:     malerta<br>
 * Date:     Mar 27, 2012<br>
 * Purpose:  Mostar as mensagem passadas por array<br>
 * Input:
 *         - array('tipo', 'mensagem')
 *
 * Examples:<br>
 * <pre>
 * {malerta msn=$mensagem} 
 * </pre>
 * @author MIXD Internet <atendimento@mixd.com.br>
 * @author credit to MIXD Internet <atendimento@mixd.com.br>
 * @param $params é obrigatório 
 * @return string|null
 */

function smarty_function_malerta($params, &$smarty){ 
	if(empty($params['msn'])){
        return;
    }
    
    if(is_array($params['msn'])){
		foreach($params['msn'] as $k => $v){
			$alerta = "
			<script>
				$('body').mAlerta({message: '$v', close: 4000, css: '$k'});
			</script>";
		}
    }
    else{
		$alerta = "
		<script>
			$('body').mAlerta({message: '".$params['msn']."', close: 4000});
		</script>
		";    	
    }
    return $alerta;
}
?>