<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 * 
 * 
 * 
 * 
 */


class Banners extends Admix_Controller{
	function __construct(){
		parent::__construct();
		
		$this->load->model('banners_m', 'banners');
		$this->load->helper('upload_helper');
		$this->load->helper('image_helper');
		$this->load->library('permissoes_lib');
				
		$this->permissoes_lib->validaPermissao($this->router->class, $this->router->method, $this->session->userdata('varUsuario_Id'));
	}		
	
	public function index(){
		/* paginacao */
		$this->load->helper('pagination_helper');
		
		/* select de localizacao */
		$bannersLocalizacao = $this->banners->getBannersLocalizacao();
		$localizacao = array('l' => $bannersLocalizacao);
			
		if($this->input->get('print')) $print = true;
		else $print = false;
		
		$b = array('Banner_Id', 'Banner_Nome', 'Banner_Status', 'Banner_Localizacao', 'Banner_DataInicial', 'Banner_DataFinal', 'Banner_Ordem');
		foreach($b as $k => $v){
			$b[$v] = prep_for_form($this->input->get($v, true));
		}
		
		/* capturo o QUERY_STRING e limpo a paginacao e ordenação */
		parse_str($_SERVER['QUERY_STRING'], $qs);
		
		/* ordenação */
		$ord['ord_campo'] = ($this->input->get('ord_campo', true)) ? prep_for_form($this->input->get('ord_campo', true)) : 'Banner_Status';
		$ord['ord_tipo'] = ($this->input->get('ord_tipo', true)) ? prep_for_form($this->input->get('ord_tipo', true)) : 'desc';
		
		$qs_ord = $qs;
		unset($qs_ord['ord_campo']);
		unset($qs_ord['ord_tipo']);
		unset($qs_ord['p']);
		$base_url_order = '/admix/'.$this->router->fetch_class().'/?'.http_build_query($qs_ord);
		/* fim da ordenação */
		
		$q = array();
		if($b['Banner_Id']) 			$q['where']['Banner_Id'] = $b['Banner_Id'];
		if($b['Banner_Nome']) 			$q['like']['Banner_Nome'] = $b['Banner_Nome'];
		if($b['Banner_Localizacao']) 	$q['where_in']['Banner_Localizacao'] = $b['Banner_Localizacao'];
		if($b['Banner_Status'] != '')	$q['where']['Banner_Status'] = $b['Banner_Status'];
		if($b['Banner_DataInicial']) 	$q['where']['Banner_DataInicial >='] = $b['Banner_DataInicial'];
		if($b['Banner_DataFinal']) 		$q['where']['Banner_DataFinal <='] = $b['Banner_DataFinal'];
		
		unset($qs['p']);
		$base_url = '/admix/'.$this->router->fetch_class().'/?'.http_build_query($qs);
		$per_page = ($print) ? 1000 : 20;
		$offset = ($print) ? 0 : intval($this->input->get('p'));
		$d = $this->banners->getBanners($q, $ord, $per_page, $offset);
		
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
		$dados = array_merge($dados, $localizacao);
		$this->setPagina($this->router->fetch_class().'/banners.tpl', $dados);
	}
	
	public function inserir(){
		$bannersLocalizacao = $this->banners->getBannersLocalizacao();
		$localizacao = array('l' => $bannersLocalizacao);
		
		$resposta = $this->session->flashdata('form_resposta') ? $this->session->flashdata('form_resposta') : array('Banner_Status' => 1);
		$errors = $this->session->flashdata('form_errors') ? $this->session->flashdata('form_errors') : array();
		$dados = array('acao' => 'Inserir',
				'action' => '/admix/'.$this->router->fetch_class().'/'.$this->router->fetch_method().'Post');
		$campos = array('Banner_Id', 'Banner_Status', 'Banner_Nome', 'Banner_DataInicial', 'Banner_DataFinal', 'Banner_Tipo', 'Banner_Localizacao',
						'Banner_Link', 'Banner_Target', 'Banner_Arquivo', 'Banner_Script', 'Banner_Conteudo', 'Banner_Ordem');
		foreach($campos as $k){
			$v[$k] = (array_key_exists($k, $resposta)) ? $resposta[$k] : '';
			$e[$k] = (array_key_exists($k, $errors)) ? $errors[$k] : '';
		}
		$resposta = array('v' => $v);
		$errors = array('e' => $e);

		$dados = array_merge($dados, $resposta, $errors, $localizacao);
	
		$this->setPagina($this->router->fetch_class().'/banner-form.tpl', $dados);
	}
	
	public function inserirPost(){
		$url_retorno = urldecode($this->input->post('url_retorno'));
		// VALIDATION RULES
		$this->load->library('form_validation');
		$this->form_validation->set_rules('Banner_Nome', 'Nome', 'required|trim');
		$this->form_validation->set_rules('Banner_DataInicial', 'Data Inicial', 'required|trim|valid_date');
		$this->form_validation->set_rules('Banner_Tipo', 'Tipo', 'required|trim');
		$this->form_validation->set_rules('Banner_Localizacao', 'Localização', 'required|trim');
		$this->form_validation->set_error_delimiters('', '');
		$data['Banner_Status'] = prep_for_form($this->input->post('Banner_Status', true));
		$data['Banner_Nome'] = prep_for_form($this->input->post('Banner_Nome', true));
		$data['Banner_DataInicial'] = prep_for_form($this->input->post('Banner_DataInicial', true));
		$data['Banner_DataFinal'] = value_null(prep_for_form($this->input->post('Banner_DataFinal', true)));
		$data['Banner_Tipo'] = prep_for_form($this->input->post('Banner_Tipo', true));
		$data['Banner_Localizacao'] = prep_for_form($this->input->post('Banner_Localizacao', true));
		$data['Banner_Target'] = value_null(prep_for_form($this->input->post('Banner_Target', true)));
		$data['Banner_Link'] = value_null(prep_for_form($this->input->post('Banner_Link', true)));
		$data['Banner_Script'] = value_null(prep_for_form($this->input->post('Banner_Script')));
		$data['Banner_Conteudo'] = value_null(prep_for_form($this->input->post('Banner_Conteudo')));
		$data['Banner_Ordem'] = value_null(prep_for_form($this->input->post('Banner_Ordem')));
		$data['Banner_DataCadastro'] = date('Y-m-d H:i:s');
		$data['Banner_DataAtualizacao'] = date('Y-m-d H:i:s');
		
		/* armazeno os dados para retorno */
		$this->session->set_flashdata('form_resposta',	$data);
	
		$upload_errors = FALSE;
		$upload = mixdUpload('Banner_Arquivo', '/media/banners/', $data['Banner_Nome'], NULL, FALSE);
		if($upload){
			if(!(isset($upload['error']))) $data['Banner_Arquivo'] = $upload['file_name']; else $upload_errors = TRUE;
		}
		
		if ($this->form_validation->run() == FALSE || ($upload_errors == TRUE)) {
			$this->session->set_flashdata('form_errors', $this->form_validation->error_array());
			redirect('/admix/'.$this->router->fetch_class().'/inserir'.'/'.$url_retorno);
		}
		else{
			$result = $this->banners->inserir($data);
			if(!(isset($result['error']))){
				$msn['sucesso'] = 'Dados cadastrados com sucesso. ('.$result['insert_id'].')';
				$this->session->set_flashdata('malerta', $msn);
				redirect('/admix/'.$this->router->fetch_class().'/'.$url_retorno);
			}
			else{
				$msn['erro'] = 'Os dados não puderam ser cadastrados. ('.$result['error'].')';
				$this->session->set_flashdata('malerta', $msn);
				redirect('/admix/'.$this->router->fetch_class().'/inserir'.'/'.$url_retorno);
			}
		}
	}
	
	public function alterar($id=NULL){
		if(!isset($id)) redirect('/admix/'.$this->router->fetch_class());
		
		$bannersLocalizacao = $this->banners->getBannersLocalizacao();
		$localizacao = array('l' => $bannersLocalizacao);
		
		$q = array();
		$q['where']['Banner_Id'] = $id;
		
		$d = $this->banners->getBanners($q);
		$resposta = $d['result'][0];
		
		$errors = $this->session->flashdata('form_errors') ? $this->session->flashdata('form_errors') : array();
		$dados = array('acao' => 'Alterar',
				'action' => '/admix/'.$this->router->fetch_class().'/'.$this->router->fetch_method().'Post');
		
		$campos = array('Banner_Id', 'Banner_Status', 'Banner_Nome', 'Banner_DataInicial', 'Banner_DataFinal', 'Banner_Tipo', 'Banner_Localizacao',
						'Banner_Link', 'Banner_Target', 'Banner_Arquivo', 'Banner_Script', 'Banner_Conteudo', 'Banner_Ordem');
		foreach($campos as $k){
			$v[$k] = (array_key_exists($k, $resposta)) ? $resposta[$k] : '';
			$e[$k] = (array_key_exists($k, $errors)) ? $errors[$k] : '';
		}
		
		$resposta = array('v' => $v);
		$errors = array('e' => $e);
		$dados = array_merge($dados, $resposta, $errors, $localizacao);
		
		$this->setPagina($this->router->fetch_class().'/banner-form.tpl', $dados);
	}
	
	public function alterarPost(){
		$url_retorno = urldecode($this->input->post('url_retorno', true));
		
		// VALIDATION RULES
		$this->load->library('form_validation');
		$this->form_validation->set_rules('Banner_Id', 'Código', 'required|integer|trim');
		$this->form_validation->set_rules('Banner_Nome', 'Nome', 'required|trim');
		$this->form_validation->set_rules('Banner_DataInicial', 'Data Inicial', 'required|trim|valid_date');
		$this->form_validation->set_rules('Banner_Tipo', 'Tipo', 'required|trim');
		$this->form_validation->set_rules('Banner_Localizacao', 'Localização', 'required|trim');
		$this->form_validation->set_error_delimiters('', '');
		
		$data['Banner_Id'] = intval($this->input->post('Banner_Id', true));
		$data['Banner_Status'] = prep_for_form($this->input->post('Banner_Status', true));
		$data['Banner_Nome'] = prep_for_form($this->input->post('Banner_Nome', true));
		$data['Banner_DataInicial'] = prep_for_form($this->input->post('Banner_DataInicial', true));
		$data['Banner_DataFinal'] = value_null(prep_for_form($this->input->post('Banner_DataFinal')));
		$data['Banner_Tipo'] = prep_for_form($this->input->post('Banner_Tipo', true));
		$data['Banner_Localizacao'] = prep_for_form($this->input->post('Banner_Localizacao', true));
		$data['Banner_Target'] = value_null(prep_for_form($this->input->post('Banner_Target', true)));
		$data['Banner_Link'] = value_null(prep_for_form($this->input->post('Banner_Link', true)));
		$data['Banner_Script'] = value_null(prep_for_form($this->input->post('Banner_Script')));
		$data['Banner_Conteudo'] = value_null(prep_for_form($this->input->post('Banner_Conteudo')));
		$data['Banner_Ordem'] = value_null(prep_for_form($this->input->post('Banner_Ordem')));
		$data['Banner_DataAtualizacao'] = date('Y-m-d H:i:s');
		
		/* armazeno os dados para retorno */
		$this->session->set_flashdata('form_resposta',	$data);
		
		$upload_errors = FALSE;
		$upload = mixdUpload('Banner_Arquivo', '/media/banners/', $data['Banner_Nome'], NULL, FALSE);
		if($upload){
			if(!(isset($upload['error']))) $data['Banner_Arquivo'] = $upload['file_name']; else $upload_errors = TRUE;
		}
		
		if ($this->form_validation->run() == FALSE || ($upload_errors == TRUE)) {
			$this->session->set_flashdata('form_errors', $this->form_validation->error_array());
			redirect('/admix/'.$this->router->fetch_class().'/alterar/'.$data['Banner_Id']);
		}
		else{
			$result = $this->banners->alterar($data);
			if(!(isset($result['error']))){
				$msn['sucesso'] = 'Dados alterados com sucesso. ('.$result['num_rows'].')';
				$this->session->set_flashdata('malerta', $msn);
				redirect('/admix/'.$this->router->fetch_class().'/'.$url_retorno);
			}
			else{
				$msn['erro'] = 'Os dados não puderam ser alterados. ('.$result['error'].')';
				$this->session->set_flashdata('malerta', $msn);
				redirect('/admix/'.$this->router->fetch_class().'/alterar/'.$data['Banner_Id'].'/'.$url_retorno);
			}
		}
	}
	
	public function remover($id=NULL){
		if(!$id){ $id = $this->input->post('ids'); }
		if(!$id){
			$msn['alerta'] = 'Você não possui nenhum item para ser removido.';
			$this->session->set_flashdata('malerta', $msn);
			redirect('/admix/'.$this->router->fetch_class());
		}
		
		$base_url_order = '/'.$this->router->fetch_class();
		
		/* ordenação */
		$ord['ord_campo'] = ($this->input->get_post('ord_campo', true)) ? prep_for_form($this->input->get_post('ord_campo', true)) : 'Banner_Status';
		$ord['ord_tipo'] = ($this->input->get_post('ord_tipo', true)) ? prep_for_form($this->input->get_post('ord_tipo', true)) : 'desc';
		/* fim da ordenação */
		
		$q = array();
		$q['where_in']['Banner_Id'] = $id;
		$d = $this->banners->getBanners($q, $ord);
		if(!$d['result']){
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
				
		$this->setPagina($this->router->fetch_class().'/banners.tpl', $dados);
	}
	
	public function removerPost(){
		$url_retorno = urldecode($this->input->post('url_retorno', true));
		$data['Banner_Id'] = $this->input->post('ids', true);
		
		$result = $this->banners->remover($data);
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
	
	public function removerArquivo(){
		$url_retorno = $this->input->get('url_retorno', true);
		$url = $this->uri->uri_string();
		#exit($url_retorno);
		$file = str_replace('admix/'.$this->router->fetch_class().'/'.$this->router->fetch_method().'/', '', $url);
		$file = $this->security->sanitize_filename($file, TRUE);
		$result = $this->banners->removerArquivo($file);
		if(!(isset($result['error']))){
			$remover = mixdUploadRemover($file);
			$msn['sucesso'] = 'Arquivo removido com sucesso. ('.$result['num_rows'].')';
			$this->session->set_flashdata('malerta', $msn);
			/*redirect('/admix/'.$this->router->fetch_class().'/'.$url_retorno);*/
			redirect($url_retorno);
		}
		else{
			$msn['erro'] = 'Os arquivos não puderam ser removidos ou encontrados. ('.$result['error'].')';
			$this->session->set_flashdata('malerta', $msn);
			/*redirect('/admix/'.$this->router->fetch_class().'/'.$url_retorno);*/
			redirect($url_retorno);
		}
	}
	
}