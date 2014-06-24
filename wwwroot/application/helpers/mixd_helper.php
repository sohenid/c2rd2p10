<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2011, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * CodeIgniter Array Helpers
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/helpers/array_helper.html
 */

// ------------------------------------------------------------------------

/*
 * Configura para Portugues Brasil a liguagem da data
 * */
setlocale(LC_ALL, 'pt_BR.utf8');

if ( ! function_exists('_alert')) {
	/*function _alert($msn){
		exit('<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><script type="text/javascript" charset="utf-8">alert("'.strip_tags(str_replace("<p>", "- ", str_replace("</p>", "\\n", trim(str_replace("\n", "", $msn))))).'"); history.back(-1);</script>');
	}*/

		function _alert($msn, $redir){
		/**
		 * <script>alert('$msn'); history.back(-1);</script>
		 */
		echo "<script>alert('$msn');";
		if($redir){
			echo "location.href='".$redir."'";
		}
		else{
			echo "history.back(-1);";
		}
		echo "</script>";
		exit();
	}
}

if ( ! function_exists('malerta')) {
	function malerta($msn){
		$malerta = "<script>
			$('body').mAlerta({message: '$msn', close: 4000});
		</script>";
		return $malerta;
	}	
}

if ( ! function_exists('mixd_escape')) {
	function mixd_escape($vlr){
		if(is_array($vlr)){
			foreach($vlr as $k => $v){
				$tmpVlr[$k] = trim($v);
				$tmpVlr[$k] = strip_tags($tmpVlr[$k], "<b><i><u><br>");
				$tmpVlr[$k] = mysql_real_escape_string($tmpVlr[$k]);
			}
			$vlr = $tmpVlr;
		}
		else{
			$vlr = trim($vlr);
			$vlr = strip_tags($vlr, "<b><i><u><br>");
			$vlr = mysql_real_escape_string($vlr);
		}
		return $vlr;
	}
}

if ( ! function_exists('mixd_strip')) {
	function mixd_strip($vlr){
		$vlr = trim($vlr);
		$vlr = strip_tags($vlr, "<b><i><u><br>");
		$vlr = stripcslashes($vlr);
		return $vlr;
	}
}

if ( ! function_exists('breadcrumb')) {
	function breadcrumb(){
		$bread = explode('/', $_SERVER['REQUEST_URI']);
		$url = '/';
		$countBread = count($bread);
		for($i=1; $i<$countBread; $i++){
			if (($bread[$i]) && (!intval($bread[$i]))){
				$arrayBread[] = $bread[$i];
			}
		}
		if(isset($arrayBread)) $countArrayBread = count($arrayBread);	
		else $countArrayBread = 0;
		$caminho = '';
		if($countArrayBread == 0){
			$breadFinal = '<li class="active">Home</li>';
		}
		else{
			$breadFinal = '<li><a href="/">Home</a> <span class="divider">/</span></li>';
			for($i=0; $i<$countArrayBread; $i++){
				if($i==($countArrayBread-1)){
        			$breadFinal .= '<li class="active">'.ucfirst($arrayBread[$i]).'</li>';
        		}
        		else{
					$caminho .= "/".$arrayBread[$i];
        			$breadFinal .= '<li><a href="'.$caminho.'">'.ucfirst($arrayBread[$i]).'</a> <span class="divider">/</span></li>';
        		}
			}
		}
		return $breadFinal;
	}
}

if ( ! function_exists('find_all_files')) {
	function find_all_files($dir){
		$root = scandir($dir);
		foreach($root as $value){
			if($value === '.' || $value === '..') {
				continue;
			}
			if((is_file("$dir/$value")) && (preg_match('/^.+\.(gif|png|jpe?g)$/i', "$dir/$value"))) {
				$result[]="$dir/$value";
				continue;
			}
			foreach(find_all_files("$dir/$value") as $value){
				$result[]=$value;
			}
		}
		return $result;
	}
}

if ( ! function_exists('muda_data')){
	function muda_data($data){
		if(strpos($data, '/') !== false){
			$aData = explode('/', $data);
			$ano = $aData[2];
			$mes = $aData[1];
			$dia = $aData[0];
			return $ano.'-'.$mes.'-'.$dia;
		}
		elseif(strpos($data, '-') !== false){
			$aData = explode('-', $data);
			$ano = $aData[0];
			$mes = $aData[1];
			$dia = $aData[2];
			return $dia.'/'.$mes.'/'.$ano;
		}
		else{
			return NULL;
		}
	}
}

if ( ! function_exists('dateval')){
	#http://www.devnetwork.net/viewtopic.php?p=65509#p65509
	function dateval($date) {
		if(preg_match('/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/', $date)){
			list($year , $month , $day) = explode('-', $date);
			return checkdate($month , $day , $year);
		}
		else {
			return false;
		}
	}
}

if ( ! function_exists('nullval')){
	function nullval($vlr) {
		if($vlr){
			return $vlr;
		}
		else{
			return NULL;
		}
	}
}

if ( ! function_exists('converteCategorias')){
	#http://stackoverflow.com/a/4844073
	function converteCategorias( $items, $id = NULL, $parent_id = NULL )
	{
		if(!$id) 			$id = 'id';
		if(!$parent_id) 	$parent_id = 'parent_id';

		$childs = array();
		/*$items = array(
		 (object) array('id' => 42, 'parent_id' => 1),
				(object) array('id' => 43, 'parent_id' => 42),
				(object) array('id' => 1, 'parent_id' => 0),
		);*/

		/* gambiarra master para converter array para objeto */
		$items = json_decode (json_encode ($items), FALSE);

		foreach($items as $item)
			$childs[$item->parent_id][] = $item;

		foreach($items as $item) if (isset($childs[$item->id]))
			$item->childs = $childs[$item->id];

		return object_to_array($childs[0]);

	}
}

/* seguir daqui pq ta osso */
if ( ! function_exists('nested2ul')){
	function nested2ul($data) {
		print_r($data);
		if($data){
			$result = array();

			if (sizeof($data) > 0) {
				$result[] = '<ul class="lvl">';
				foreach ($data as $entry) {
					if(!isset($entry['childs'])) $entry['childs'] = FALSE;
					$result[] = sprintf(
							'<li>%s %s</li>',
							$entry['nome'],
							nested2ul($entry['childs'])
					);
				}
				$result[] = '</ul>';
			}
			return implode($result);
		}
	}
}

/* Menu builder function, parentId 0 is the root */
#http://wizardinternetsolutions.com/web-database-design/single-query-dynamic-multi-level-menu/
if ( ! function_exists('build_menu')){
	function build_menu($parent, $menu, $sub = NULL)
	{
		$html = "";
		if (isset($menu['parents'][$parent]))
		{
			if(isset($sub)) $css = "";
			else $css = "nested-sortable";
			$html .= "<ol class=\"$css level-$parent\">\n";
			$first = TRUE;
				
			$j=0;
			foreach ($menu['parents'][$parent] as $itemId)
			{
				if(!isset($menu['parents'][$itemId]))
				{
					$j++;
					$html .= "<li id=\"li_$itemId\" class=\"level-$parent nav-$parent-$j\">\n<div><span class=\"disclose\"><span></span></span><a href=\"#\" class=\"fake-link\">".$menu['items'][$itemId]['name']."</a><span class=\"pull-right\"><a href=\"#\" data-href=\"/admix/categorias/alterar/".$menu['items'][$itemId]['id']."\" class=\"alterar\" title=\"Alterar\"><i class=\"icon-pencil\"></i></a> <a href=\"#\" class=\"remover\"><i class=\"icon-remove\"></i></a></span></div>\n</li> \n";
					#".$menu['items'][$itemId]['link']."
				}
				if(isset($menu['parents'][$itemId]))
				{
					$j++;
					$html .= "<li id=\"li_$itemId\" class=\"level-$parent nav-$parent-$j\">\n<div><span class=\"disclose\"><span></span></span><a href=\"#\" class=\"fake-link\">".$menu['items'][$itemId]['name']."</a><span class=\"pull-right\"><a href=\"#\" data-href=\"/admix/categorias/alterar/".$menu['items'][$itemId]['id']."\" class=\"alterar\" title=\"Alterar\"><i class=\"icon-pencil\"></i></a> <a href=\"#\" class=\"remover\"><i class=\"icon-remove\"></i></a></span></div>\n";
					$html .= build_menu($itemId, $menu, TRUE);
					$html .= "</li> \n";
				}
			}
			$html .= "</ol> \n";
		}
		return $html;
	}
	#echo build_menu(0, $menu);
}

if ( ! function_exists('build_menu_check')){
	function build_menu_check($parent, $menu, $sub = NULL, $check = array())
	{
		$html = "";
		if (isset($menu['parents'][$parent]))
		{
			if(isset($sub)) $css = "";
			else $css = "categorias-check";
			$html .= "<ul class=\"$css level-$parent\">\n";
			$first = TRUE;

			$j=0;
			foreach ($menu['parents'][$parent] as $itemId)
			{
				$checked = ((is_array($check)) && in_array($menu['items'][$itemId]['id'], $check)) ? 'checked="checked"' : '';
				if(!isset($menu['parents'][$itemId]))
				{
					$j++;
					$html .= "<li id=\"li_$itemId\" class=\"level-$parent nav-$parent-$j\">\n<label class=\"checkbox\"><input type=\"checkbox\" name=\"Categoria_Id[]\" $checked value=\"".$menu['items'][$itemId]['id']."\"> ".$menu['items'][$itemId]['name']." </label>\n</li> \n";
					#".$menu['items'][$itemId]['link']."
				}
				if(isset($menu['parents'][$itemId]))
				{
					$j++;
					$html .= "<li id=\"li_$itemId\" class=\"level-$parent nav-$parent-$j\">\n<label class=\"checkbox\"><input type=\"checkbox\" name=\"Categoria_Id[]\" $checked value=\"".$menu['items'][$itemId]['id']."\"> ".$menu['items'][$itemId]['name']." </label>\n";
					$html .= build_menu_check($itemId, $menu, TRUE, $check);
					$html .= "</li> \n";
				}
			}
			$html .= "</ul> \n";
		}
		return $html;
	}
	#echo build_menu(0, $menu);
}

if ( ! function_exists('build_menu_select')){
	function build_menu_select($parent, $menu, $sub = NULL, $select = array(), $sum = 0)
	{
		$html = "";
		if (isset($menu['parents'][$parent]))
		{
			if(isset($sub)) $css = "";
			else $css = "categorias-select";
			#$html .= "<ul class=\"$css level-$parent\">\n";
			#$first = TRUE;
				
			if(isset($sub)) $sum++;
			else $sum = 1;
				
			$j=0;
			foreach ($menu['parents'][$parent] as $itemId)
			{
				$selected = ((is_array($select)) && in_array($menu['items'][$itemId]['id'], $select)) ? 'selected="selected"' : '';
				if(!isset($menu['parents'][$itemId]))
				{
					$j++;
					#$html .= "<li id=\"li_$itemId\" class=\"level-$parent nav-$parent-$j\">\n<label class=\"checkbox\"><input type=\"checkbox\" name=\"Categoria_Id[]\" $checked value=\"".$menu['items'][$itemId]['id']."\"> ".$menu['items'][$itemId]['name']." </label>\n</li> \n";
					$html .= '<option value="'.$menu['items'][$itemId]['id'].'" '.$selected.' >'.str_pad('', ($sum*2), '--').' '.$menu['items'][$itemId]['name'].'</option>';
				}
				if(isset($menu['parents'][$itemId]))
				{
					$j++;
					#					$html .= "<li id=\"li_$itemId\" class=\"level-$parent nav-$parent-$j\">\n<label class=\"checkbox\"><input type=\"checkbox\" name=\"Categoria_Id[]\" $checked value=\"".$menu['items'][$itemId]['id']."\"> ".$menu['items'][$itemId]['name']." </label>\n";
					$html .= '<option value="'.$menu['items'][$itemId]['id'].'" '.$selected.' >'.str_pad('', ($sum*2), '--').' '.$menu['items'][$itemId]['name'].'</option>';
					$html .= build_menu_select($itemId, $menu, TRUE, $select, $sum);
					#					$html .= "</li> \n";
				}
			}
			#$html .= "</ul> \n";
		}
		return $html;
	}
}

if ( ! function_exists('build_menu_busca')){
	function build_menu_busca($parent, $menu, $sub = NULL)
	{
		$html = "";
		if (isset($menu['parents'][$parent]))
		{
			if(isset($sub)) $css = "";
			else $css = "nav-links";
			$html .= "<ul class=\"$css\">\n";
			$first = TRUE;

			$j=0;
			foreach ($menu['parents'][$parent] as $itemId)
			{
				if(!isset($menu['parents'][$itemId]))
				{
					$j++;
					$html .= "<li>\n<a href=\"".$menu['items'][$itemId]['link']."\" class=\"fake-link\">".$menu['items'][$itemId]['name']."</a>\n</li>\n";
					#".$menu['items'][$itemId]['link']."
				}
				if(isset($menu['parents'][$itemId]))
				{
					$j++;
					$html .= "<li>\n<a href=\"".$menu['items'][$itemId]['link']."\" class=\"fake-link\">".$menu['items'][$itemId]['name']."</a>\n";
					$html .= build_menu_busca($itemId, $menu, TRUE);
					$html .= "</li> \n";
				}
			}
			$html .= "</ul> \n";
		}
		return $html;
	}
	#echo build_menu(0, $menu);
}

if ( ! function_exists('build_menu_reindex')){
	function build_menu_reindex($parent, $menu, $sub = NULL, $string = NULL)
	{
		$html = "";
		if (isset($menu['parents'][$parent]))
		{
			foreach ($menu['parents'][$parent] as $itemId)
			{
				if(!isset($menu['parents'][$itemId]))
				{
					$string[] = $menu['items'][$itemId]['name'];
					$html[] = $menu['items'][$itemId]['id'].'|'.implode('/', $string);
						
					array_pop($string);
				}

				if(isset($menu['parents'][$itemId]))
				{
					$string[] = $menu['items'][$itemId]['name'];
					$html[] = $menu['items'][$itemId]['id'].'|'.implode('/', $string);
					$html[] = build_menu_reindex($itemId, $menu, TRUE, $string);
					$string = '';
				}
			}
				
		}
		return $html;
	}
}

if ( ! function_exists('array_flatten')){
	function array_flatten($array) {
		if (!is_array($array)) {
			return FALSE;
		}
		$result = array();
		foreach ($array as $key => $value) {
			if (is_array($value)) {
				$result = array_merge($result, array_flatten($value));
			}
			else {
				$result[] = $value;
			}
		}
		return $result;
	}
}


if ( ! function_exists('object_to_array')){
	function object_to_array($data)
	{
		if (is_array($data) || is_object($data))
		{
			$result = array();
			foreach ($data as $key => $value)
			{
				$result[$key] = object_to_array($value);
			}
			return $result;
		}
		return $data;
	}
}

if ( ! function_exists('mask')){
	function mask($val, $mask)
	{
		$maskared = '';
		$k = 0;
		for($i = 0; $i<=strlen($mask)-1; $i++)
		{
			if($mask[$i] == '#')
			{
				if(isset($val[$k]))
					$maskared .= $val[$k++];
			}
			else
			{
				if(isset($mask[$i]))
					$maskared .= $mask[$i];
			}
		}
		return $maskared;
	}
}

if ( ! function_exists('somente_numeros')){
	function somente_numeros($str) {
		return preg_replace("/[^0-9]/", "", $str);
	}
}

/* Transforma moeda em decimal */
if (!function_exists('floattosql')) {

	/**
	 * Converte a string para o formato do banco. (0,00 => 0.00)
	 * @param string $valor
	 */
	function floattosql($valor){
		if($valor){
			$preco = explode('.',$valor);
			$preco = implode($preco);
			$preco = preg_replace("/,/", ".", $preco);
			return $preco;
		}
		else{
			return NULL;
		}
	}

}

if (!function_exists('template_email')) {
	function template_email($nome, $conteudo){
		$email = file_get_contents($_SERVER['DOCUMENT_ROOT']."/assets/html/template-email.html");
		$email = str_replace("%NOME%", mb_strtoupper($nome), $email);
		$email = str_replace("%HOST%", $_SERVER['HTTP_HOST'], $email);
		$email = str_replace("%CONTEUDO%", $conteudo, $email);

		return $email;
	}
}

if (!function_exists('curl_get_file_contents')) {
	function curl_get_file_contents($URL)
	{
		$c = curl_init();
		curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($c, CURLOPT_TIMEOUT, 30);
		curl_setopt($c, CURLOPT_URL, $URL);
		$contents = curl_exec($c);
		curl_close($c);

		if ($contents) return $contents;
		else return FALSE;
	}
}

if (!function_exists('remove_mask')) {
	function remove_mask($str)
	{
		return str_replace('.', '', str_replace('/', '', str_replace('-', '', str_replace('_', '', $str))));
	}
}

//função para envio de emails, utiliza a biblioteca de emails do codeigniter
if (!function_exists('mmail')) {
	function mmail($para, $assunto, $mensagem, $reply_to, $cc = '')
	{
		$CI = get_instance();
		$CI->load->library('email');
		$CI->config->load('admix');
		$email['mailtype'] = 'html';
		if (!empty($configuracoes['Smtp_Host'])) {
			$email['protocol'] = 'smtp';
			$email['smtp_host'] = $configuracoes['Smtp_Host'];
			$email['smtp_port'] = $configuracoes['Smtp_Port'];
			$email['smtp_user'] = $configuracoes['Smtp_UserName'];
			$email['smtp_pass'] = $configuracoes['Smtp_Password'];
			$email_from = $configuracoes['Smtp_Email'];
		}
		else {
			$email['protocol'] = 'smtp';
			$email['smtp_host'] = 'smtp.mixd.com.br';
			$email['smtp_port'] = '587';
			$email['smtp_user'] = 'autentica@mixd.com.br';
			$email['smtp_pass'] = 'd28m02';
			$email_from = 'autentica@mixd.com.br';
		}
		$CI->email->initialize($email);
		
		$CI->email->from($email_from, $CI->config->item('site_nome'));
		#agrupa em ', ' se for array
		if(is_array($para)) $para = implode(', ', $para);
		$CI->email->to($para);
		if($reply_to) $CI->email->reply_to($v);
		#copia
		if(is_array($cc)) $cc = implode(', ', $cc);
		if($cc) $CI->email->bcc($cc);
		$CI->email->subject($CI->config->item('site_nome') . ' :: '.$assunto);
		$mensagem_template = template_email($CI->config->item('site_nome'), $mensagem);
		$CI->email->message($mensagem_template);
		if ($CI->email->send()) {
			return true;
		}
		else{
			return false;
		}
	}
}
/* End of file mixd_helper.php */
/* Location: ./application/helpers/mixd_helper.php */