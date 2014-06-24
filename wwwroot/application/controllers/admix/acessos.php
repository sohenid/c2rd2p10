<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 * 
 * 
 * 
 * 
 */


class Acessos extends Admix_Controller{
	function __construct(){
		parent::__construct();
		
		$this->load->model('acessos_m', 'acessos');
		$this->load->library('permissoes_lib');
		
		#$this->permissoes_lib->validaPermissao($this->router->class , $this->router->method);
		$this->permissoes_lib->validaPermissao($this->router->class, $this->router->method, $this->session->userdata('varUsuario_Id'));
	}		
	
	public function index(){
		/* paginacao */
		$this->load->helper('pagination_helper');
		
		if($this->input->get('print')) $print = true;
		else $print = false;

		$b = array('Acesso_Id', 'Acesso_Nome', 'Acesso_Email', 'Acesso_Data', 'Acesso_IP');
		foreach($b as $k => $v){
			$b[$v] = prep_for_form($this->input->get($v, true));
		}
		
		if($b['Acesso_Data']){
			$data = explode(' - ', $b['Acesso_Data']);
			$datai = $data[0];
			$dataf = $data[1];
			$b['Acesso_DataI'] = dateval(muda_data($datai)) ? muda_data($datai) : date('Y-m-d');
			$b['Acesso_DataF'] = dateval(muda_data($dataf)) ? muda_data($dataf) : date('Y-m-d');
		}
		else{
			$b['Acesso_DataI'] = NULL;
			$b['Acesso_DataF'] = NULL;
		}
				
		/* capturo o QUERY_STRING e limpo a paginacao e ordenação */
		parse_str($_SERVER['QUERY_STRING'], $qs);
		
		/* ordenação */
		$ord['ord_campo'] = ($this->input->get('ord_campo', true)) ? prep_for_form($this->input->get('ord_campo', true)) : 'Acesso_Data';
		$ord['ord_tipo'] = ($this->input->get('ord_tipo', true)) ? prep_for_form($this->input->get('ord_tipo', true)) : 'desc';
		
		$qs_ord = $qs;
		unset($qs_ord['ord_campo']);
		unset($qs_ord['ord_tipo']);
		unset($qs_ord['p']);
		$base_url_order = '/admix/'.$this->router->fetch_class().'/?'.http_build_query($qs_ord);
		/* fim da ordenação */
		
		$q = array();
		if($b['Acesso_Id']) 	$q['where']['Acesso_Id'] = $b['Acesso_Id'];
		if($b['Acesso_Nome']) 	$q['like']['Acesso_Nome'] = $b['Acesso_Nome'];
		if($b['Acesso_Email']) 	$q['like']['Acesso_Email'] = $b['Acesso_Email'];
		if($b['Acesso_IP']) 	$q['where']['Acesso_IP'] = $b['Acesso_IP'];
		if($b['Acesso_DataI']) 	$q['where']['DATE(Acesso_Data) >='] = $b['Acesso_DataI'];
		if($b['Acesso_DataF']) 	$q['where']['DATE(Acesso_Data) <='] = $b['Acesso_DataF'];
		
		unset($qs['p']);
		$base_url = '/admix/'.$this->router->fetch_class().'/?'.http_build_query($qs);
		$per_page = ($print) ? 1000 : 20;
		$offset = ($print) ? 0 : intval($this->input->get('p'));
		$d = $this->acessos->getAcessos($q, $ord, $per_page, $offset);
		
		/* paginacao */
		$total_rows = $d['count'];
		$paginacao = bspaginacao($base_url, $per_page, $total_rows);
		$nav_paginacao = '<div class="nav-paginacao">'.($offset+1).' até '.($offset+count($d['result'])).' de '.$total_rows.'</div>';
		
		if($q) $busca = true;
		else $busca = false;
		
		$dados = array(
						'result' 			=> $d['result'],
						'b'					=> $b,
						'busca'				=> $busca,
						'paginacao'			=> $paginacao,
						'nav_paginacao' 	=> $nav_paginacao,
						'base_url_order'	=> $base_url_order,
						'ord_campo'			=> $ord['ord_campo'],
						'ord_tipo'			=> $ord['ord_tipo'],
						'remover'			=> FALSE
					  );
		$this->setPagina($this->router->fetch_class().'/acessos.tpl', $dados);
	}
	
	public function exportar(){

		$result = $this->emails->getEmails(NULL);
		$csv = '';
		foreach($result as $k => $v){
			$csv .= "\"".$v['Email_Nome']."\";\"".$v['Email_Email']."\"\n";
		}
		
		$arquivo = date("Ymd-his")."-emails.csv";
		// Configurações header para forçar o download
		header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
		header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
		header ("Cache-Control: no-cache, must-revalidate");
		header ("Pragma: no-cache");
		header ("Content-type: application/x-msexcel");
		header ("Content-Disposition: attachment; filename=\"{$arquivo}\"" );
		header ("Content-Description: PHP Generated Data" );
		
		echo $csv;	
		
	}
	
}