<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 * 
 * 
 * 
 * 
 */


class Emails extends Admix_Controller{
	function __construct(){
		parent::__construct();
		
		$this->load->model('emails_m', 'emails');
		$this->load->library('permissoes_lib');
		
		$this->permissoes_lib->validaPermissao($this->router->class, $this->router->method, $this->session->userdata('varUsuario_Id'));
	}		
	
	public function index(){
		/* paginacao */
		$this->load->helper('pagination_helper');
		
		if($this->input->get('print')) $print = true;
		else $print = false;

		$b = array('Email_Id', 'Email_Nome', 'Email_Email');
		foreach($b as $k => $v){
			$b[$v] = prep_for_form($this->input->get($v, true));
		}
		
		
		/* capturo o QUERY_STRING e limpo a paginacao e ordenação */
		parse_str($_SERVER['QUERY_STRING'], $qs);
		
		/* ordenação */
		$ord['ord_campo'] = ($this->input->get('ord_campo', true)) ? prep_for_form($this->input->get('ord_campo', true)) : 'Email_DataCadastro';
		$ord['ord_tipo'] = ($this->input->get('ord_tipo', true)) ? prep_for_form($this->input->get('ord_tipo', true)) : 'desc';
		
		$qs_ord = $qs;
		unset($qs_ord['ord_campo']);
		unset($qs_ord['ord_tipo']);
		unset($qs_ord['p']);
		$base_url_order = '/admix/'.$this->router->fetch_class().'/?'.http_build_query($qs_ord);
		/* fim da ordenação */
		
		$q = array();
		if($b['Email_Id']) 		$q['where']['Email_Id'] = $b['Email_Id'];
		if($b['Email_Nome']) 	$q['like']['Email_Nome'] = $b['Email_Nome'];
		if($b['Email_Email']) 	$q['like']['Email_Email'] = $b['Email_Email'];

		unset($qs['p']);
		$base_url = '/admix/'.$this->router->fetch_class().'/?'.http_build_query($qs);
		$per_page = ($print) ? 1000 : 20;
		$offset = ($print) ? 0 : intval($this->input->get('p'));
		$d = $this->emails->getEmails($q, $ord, $per_page, $offset);
		
		/* paginacao */
		$total_rows = $d['count'];
		$paginacao = bspaginacao($base_url, $per_page, $total_rows);
		$nav_paginacao = '<div class="nav-paginacao">'.($offset+1).' até '.($offset+count($d['result'])).' de '.$total_rows.'</div>';
		
		if($q) $busca = true;
		else $busca = false;
		
		$dados = array(
						'acao'				=> 'Gerenciar',
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
		$this->setPagina($this->router->fetch_class().'/emails.tpl', $dados);
	}
	
	public function remover($id=NULL){
		if(!$id){
			$id = $this->input->post('ids');
		}
		if(!$id){
			$msn['alerta'] = 'Você não possui nenhum item para ser removido.';
			$this->session->set_flashdata('malerta', $msn);
			redirect('/admix/'.$this->router->fetch_class());
		}
		
		$base_url_order = '/'.$this->router->fetch_class();
		
		/* ordenação */
		$ord['ord_campo'] = ($this->input->get_post('ord_campo', true)) ? prep_for_form($this->input->get_post('ord_campo', true)) : 'Email_DataCadastro';
		$ord['ord_tipo'] = ($this->input->get_post('ord_tipo', true)) ? prep_for_form($this->input->get_post('ord_tipo', true)) : 'desc';
		
		$q['where_in']['Email_Id'] = $id;
		
		$d = $this->emails->getEmails($q, $ord);
		if(!$d){
			$msn['alerta'] = 'Nenhum item foi encontrado.';
			$this->session->set_flashdata('malerta', $msn);
			redirect('/admix/'.$this->router->fetch_class());
		}
		
		$dados = array( 
				'acao'				=> 'Remover',
				'result' 			=> $d['result'],
				'base_url_order'	=> $base_url_order,
				'ord_campo'			=> $ord['ord_campo'],
				'ord_tipo'			=> $ord['ord_tipo'],
				'remover'			=> TRUE
		);
		
		
		$this->setPagina($this->router->fetch_class().'/emails.tpl', $dados);
	}
	
	public function removerPost(){
		$url_retorno = urldecode($this->input->post('url_retorno', true));
		$data['Email_Id'] = $this->input->post('ids', true);
				
		$result = $this->emails->remover($data);
		if(!(isset($result['error']))){
			$msn['sucesso'] = 'Dados removidos com sucesso. ('.$result['num_rows'].')';
			$this->session->set_flashdata('malerta', $msn);
			redirect('/admix/'.$this->router->fetch_class().'/'.$url_retorno);
		}
		else{
			$msn['erro'] = 'Os dados não puderam ser removidos. ('.$result['error'].')';
			$this->session->set_flashdata('malerta', $msn);
			redirect('/admix/'.$this->router->fetch_class().'/'.$url_retorno);
		}
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