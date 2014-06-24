<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 * 
 * 
 * 
 * 
 */


class Noticias extends Admix_Controller{
	function __construct(){
		parent::__construct();
		
		$this->load->model('noticias_m', 'noticias');
		$this->load->helper('upload_helper');
		$this->load->helper('image_helper');
		$this->load->library('permissoes_lib');
		$this->load->helper('text');
				
		$this->permissoes_lib->validaPermissao($this->router->class, $this->router->method, $this->session->userdata('varUsuario_Id'));
	}		
	
	public function index(){
		/* paginacao */
		$this->load->helper('pagination_helper');
		
		if($this->input->get('print')) $print = true;
		else $print = false;
		
		$b = array('Noticia_Id', 'Noticia_Nome', 'Noticia_Status', 'Noticia_DataI', 'Noticia_DataF');
		foreach($b as $k => $v){
			$b[$v] = prep_for_form($this->input->get($v, true));
		}
		
		/* capturo o QUERY_STRING e limpo a paginacao e ordenação */
		parse_str($_SERVER['QUERY_STRING'], $qs);
		$qs_ord = $qs;
		unset($qs_ord['ord_campo']);
		unset($qs_ord['ord_tipo']);
		unset($qs_ord['p']);
		$base_url_order = '/admix/'.$this->router->fetch_class().'/?'.http_build_query($qs_ord);
		
		/* ordenação */
		$ord['ord_campo'] = ($this->input->get('ord_campo', true)) ? prep_for_form($this->input->get('ord_campo', true)) : 'Noticia_Data';
		$ord['ord_tipo'] = ($this->input->get('ord_tipo', true)) ? prep_for_form($this->input->get('ord_tipo', true)) : 'DESC';
		/* fim da ordenação */
		
		$q = array();
		if($b['Noticia_Id']) 			$q['where']['Noticia_Id'] = $b['Noticia_Id'];
		if($b['Noticia_Status'] != '')	$q['where']['Noticia_Status'] = $b['Noticia_Status'];
		if($b['Noticia_Nome']) 			$q['like']['Noticia_Nome'] = $b['Noticia_Nome'];
		if($b['Noticia_DataI']) 		$q['where']['Noticia_Data >='] = $b['Noticia_DataI'];
		if($b['Noticia_DataF']) 		$q['where']['Noticia_Data <='] = $b['Noticia_DataF'];
		
		unset($qs['p']);
		$base_url = '/admix/'.$this->router->fetch_class().'/?'.http_build_query($qs);
		$per_page = ($print) ? 1000 : 20;
		$offset = ($print) ? 0 : intval($this->input->get('p'));
		$d = $this->noticias->getNoticias($q, $ord, $per_page, $offset);
		
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
		$this->setPagina($this->router->fetch_class().'/noticias.tpl', $dados);
	}
	
	public function inserir(){
		$resposta = $this->session->flashdata('form_resposta') ? $this->session->flashdata('form_resposta') : array();
		$errors = $this->session->flashdata('form_errors') ? $this->session->flashdata('form_errors') : array();
		$dados = array('acao' => 'Inserir',
				'action' => '/admix/'.$this->router->fetch_class().'/'.$this->router->fetch_method().'Post');
		$campos = array('Noticia_Id', 'Noticia_Status', 'Noticia_Nome', 'Noticia_Data', 'Noticia_Descricao', 'Noticia_Ordem');
		foreach($campos as $k){
			$v[$k] = (array_key_exists($k, $resposta)) ? $resposta[$k] : '';
			$e[$k] = (array_key_exists($k, $errors)) ? $errors[$k] : '';
		}
		$resposta = array('v' => $v);
		$errors = array('e' => $e);

		$dados = array_merge($dados, $resposta, $errors);
	
		$this->setPagina($this->router->fetch_class().'/noticia-form.tpl', $dados);
	}
	
	public function inserirPost(){
		$url_retorno = urldecode($this->input->post('url_retorno'));
		// VALIDATION RULES
		$this->load->library('form_validation');
		$this->form_validation->set_rules('Noticia_Nome', 'Nome', 'required|trim');
		$this->form_validation->set_rules('Noticia_Data', 'Data', 'required|trim|valid_date');
		$this->form_validation->set_rules('Noticia_Descricao', 'Descrição', 'required|trim');
		$this->form_validation->set_error_delimiters('', '');
		$data['Noticia_Status'] = prep_for_form($this->input->post('Noticia_Status', true));
		$data['Noticia_Nome'] = prep_for_form($this->input->post('Noticia_Nome', true));
		$data['Noticia_Data'] = prep_for_form($this->input->post('Noticia_Data', true));
		$data['Noticia_Descricao'] = prep_for_form($this->input->post('Noticia_Descricao'));
		$data['Noticia_Link'] = strtolower(url_title(convert_accented_characters($data['Noticia_Nome'])));
		$data['Noticia_Url'] = $this->_url($data['Noticia_Link']);
		$data['Noticia_Canonical'] = $this->_canonical($data['Noticia_Url']);
		$data['Noticia_Ordem'] = value_null(prep_for_form($this->input->post('Noticia_Ordem')));
		$data['Noticia_DataCadastro'] = date('Y-m-d H:i:s');
		$data['Noticia_DataAtualizacao'] = date('Y-m-d H:i:s');
		
		/* armazeno os dados para retorno */
		$this->session->set_flashdata('form_resposta',	$data);
	
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('form_errors', $this->form_validation->error_array());
			redirect('/admix/'.$this->router->fetch_class().'/inserir'.'/'.$url_retorno);
		}
		else{
			$result = $this->noticias->inserir($data);
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
		
		$q = array();
		$q['where']['Noticia_Id'] = $id;
		
		$d = $this->noticias->getNoticias($q);
		$resposta = $d['result'][0];
		$errors = $this->session->flashdata('form_errors') ? $this->session->flashdata('form_errors') : array();
		$dados = array('acao' => 'Alterar',
					   'action' => '/admix/'.$this->router->fetch_class().'/'.$this->router->fetch_method().'Post');
		
		$campos = array('Noticia_Id', 'Noticia_Status', 'Noticia_Nome', 'Noticia_Data', 'Noticia_Descricao', 'Noticia_Ordem');
		foreach($campos as $k){
			$v[$k] = (array_key_exists($k, $resposta)) ? $resposta[$k] : '';
			$e[$k] = (array_key_exists($k, $errors)) ? $errors[$k] : '';
		}
		
		$resposta = array('v' => $v);
		$errors = array('e' => $e);
		$dados = array_merge($dados, $resposta, $errors);
		
		$this->setPagina($this->router->fetch_class().'/noticia-form.tpl', $dados);
	}
	
	public function alterarPost(){
		$url_retorno = urldecode($this->input->post('url_retorno', true));
		
		// VALIDATION RULES
		$this->load->library('form_validation');
		$this->form_validation->set_rules('Noticia_Id', 'Código', 'required|integer|trim');
		$this->form_validation->set_rules('Noticia_Nome', 'Nome', 'required|trim');
		$this->form_validation->set_error_delimiters('', '');
		
		$data['Noticia_Id'] = intval($this->input->post('Noticia_Id', true));
		$data['Noticia_Status'] = intval($this->input->post('Noticia_Status', true));
		$data['Noticia_Nome'] = prep_for_form($this->input->post('Noticia_Nome', true));
		$data['Noticia_Data'] = prep_for_form($this->input->post('Noticia_Data', true));
		$data['Noticia_Descricao'] = prep_for_form($this->input->post('Noticia_Descricao'));
		$data['Noticia_Link'] = strtolower(url_title(convert_accented_characters($data['Noticia_Nome'])));
		$data['Noticia_Url'] = $this->_url($data['Noticia_Link']);
		$data['Noticia_Canonical'] = $this->_canonical($data['Noticia_Url']);
		$data['Noticia_Ordem'] = value_null(prep_for_form($this->input->post('Noticia_Ordem')));
		$data['Noticia_DataAtualizacao'] = date('Y-m-d H:i:s');
		
		/* armazeno os dados para retorno */
		$this->session->set_flashdata('form_resposta',	$data);
		
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('form_errors', $this->form_validation->error_array());
			redirect('/admix/'.$this->router->fetch_class().'/alterar/'.$data['Noticia_Id'].'/'.$url_retorno);
		}
		else{
			$result = $this->noticias->alterar($data);
			if(!(isset($result['error']))){
				$msn['sucesso'] = 'Dados alterados com sucesso. ('.$result['num_rows'].')';
				$this->session->set_flashdata('malerta', $msn);
				redirect('/admix/'.$this->router->fetch_class().'/'.$url_retorno);
			}
			else{
				$msn['erro'] = 'Os dados não puderam ser alterados. ('.$result['error'].')';
				$this->session->set_flashdata('malerta', $msn);
				redirect('/admix/'.$this->router->fetch_class().'/alterar/'.$data['Noticia_Id'].'/'.$url_retorno);
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
		$ord['ord_campo'] = ($this->input->get_post('ord_campo', true)) ? prep_for_form($this->input->get_post('ord_campo', true)) : 'Noticia_Data';
		$ord['ord_tipo'] = ($this->input->get_post('ord_tipo', true)) ? prep_for_form($this->input->get_post('ord_tipo', true)) : 'desc';
		/* fim da ordenação */
		
		$q = array();
		$q['where_in']['Noticia_Id'] = $id;
		$d = $this->noticias->getNoticias($q, $ord);
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
		
		$this->setPagina($this->router->fetch_class().'/noticias.tpl', $dados);
	}
	
	public function removerPost(){
		$url_retorno = urldecode($this->input->post('url_retorno', TRUE));
		$data['Noticia_Id'] = $this->input->post('ids', TRUE);
				
		$result = $this->noticias->remover($data);
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
	
	public function imagens($id){
		if(!isset($id)) redirect('/admix/'.$this->router->fetch_class());
		
		$resposta = $this->session->flashdata('form_resposta') ? $this->session->flashdata('form_resposta') : array();
		$errors = $this->session->flashdata('form_errors') ? $this->session->flashdata('form_errors') : array();
		$dados = array('acao' => 'Inserir',
					   'action' => '/admix/'.$this->router->fetch_class().'/'.$this->router->fetch_method().'Post',
					   'id' => $id );
		$campos = array('Noticia_Id', 'Noticia_Nome', 'Noticia_Data', 'Noticia_Descricao', 'Noticia_Ordem');
		foreach($campos as $k){
			$v[$k] = (array_key_exists($k, $resposta)) ? $resposta[$k] : '';
			$e[$k] = (array_key_exists($k, $errors)) ? $errors[$k] : '';
		}
		$resposta = array('v' => $v);
		$errors = array('e' => $e);

		$dados = array_merge($dados, $resposta, $errors);
	
		$this->setPagina($this->router->fetch_class().'/noticia-imagens.tpl', $dados);
	}
	
	public function imagensUpload(){
		$metodo = $this->input->get('metodo', true);
		if($metodo == 'consultar'){
			$id = intval($this->input->get('id'));
			$resposta = $this->noticias->getImagens($id);
			if($resposta !== FALSE){
				foreach($resposta as $k => $v){
					$info = new stdClass();

					$info->id = $v['NoticiaImagem_Id'];
					$info->name = $v['NoticiaImagem_Nome'] ? $v['NoticiaImagem_Nome'] : basename($v['NoticiaImagem_Imagem']);
					$info->size = (string)filesize($_SERVER['DOCUMENT_ROOT'].$v['NoticiaImagem_Imagem']);
					$info->type = "image/jpeg";
					$info->url = $v['NoticiaImagem_Imagem'];
					#$info->thumbnail_url = mixdThumb($_SERVER['DOCUMENT_ROOT'].$v['NoticiaImagem_Imagem'], '80x60', FALSE);
					$info->thumbnail_url = mixdThumb($_SERVER['DOCUMENT_ROOT'].$v['NoticiaImagem_Imagem'], '260x195', FALSE);
					$info->delete_url = '/admix/'.$this->router->fetch_class().'/'.$this->router->fetch_method().'Remover'.$v['NoticiaImagem_Imagem'];
					$info->delete_type = 'DELETE';/**/
					$array_imagens[] = $info;
				}
				if(isset($array_imagens)){
					echo json_encode($array_imagens);
				}
			}	
		}
		elseif($metodo !== false){
			return false;
		}
		else{
			$id = $this->input->post('id', true);
			$upload_errors = FALSE;
			$upload = mixdUpload('files', '/media/noticias/', '', 'json');
			if(isset($upload[0]->url)){
				
				$data['Noticia_Id'] = $id;
				$data['NoticiaImagem_Imagem'] = prep_for_form($upload[0]->url);
				$data['NoticiaImagem_Ordem'] = 9999; //Go horse NULL
				$result = $this->noticias->inserirImagem($data);
				
				$upload[0]->id = $result['insert_id'];
				echo json_encode($upload);
				
			}
			else{
				/* tratar falha no upload */
				return false;
			}
		}	
	}
	
	public function imagensUploadRemover(){
		$url = $this->uri->uri_string();
		$file = str_replace('admix/'.$this->router->fetch_class().'/'.$this->router->fetch_method().'/', '', $url);
		$file = $this->security->sanitize_filename($file, TRUE);
		$result = $this->noticias->removerImagem($file);
		if(!(isset($result['error']))){
			$remover = mixdUploadRemover($file);
		}
	}
	
	public function redactorImagensUpload(){
		$_FILES['file']['type'] = strtolower($_FILES['file']['type']);		
		if ($_FILES['file']['type'] == 'image/png' || $_FILES['file']['type'] == 'image/jpg' || 
		 	$_FILES['file']['type'] == 'image/gif' || $_FILES['file']['type'] == 'image/jpeg' || 
			$_FILES['file']['type'] == 'image/pjpeg'){		
		
			$upload = mixdUpload('file', '/media/noticias/redactor/', '', 'json');
			if($upload[0]->url){
				/* displaying file */
				$array = array(
						'filelink' => $upload[0]->url
				);
				echo stripslashes(json_encode($array));
			}
		}
	}
	
	public function redactorImagensJson(){
		$dir = $_SERVER['DOCUMENT_ROOT'].'/media/noticias/redactor';
		$lista = find_all_files($dir);
		foreach($lista as $k => $v){
			$thumb = mixdThumb($v, '100x74', FALSE);
			$image = str_replace($_SERVER['DOCUMENT_ROOT'], '', $v);
			
			$json[$k]['thumb'] = $thumb;
			$json[$k]['image'] = $image;
		}
		echo stripslashes(json_encode($json));
	}
	
	public function imagensOrdenar(){
		$id = prep_for_form($this->input->post('id', TRUE));
		$item = prep_for_form($this->input->post('item', TRUE));
		foreach($item as $imgOrdem => $imgId){
			$result = $this->noticias->ordenarImagem($id, $imgId, $imgOrdem);
		}
	}
	
	private function _canonical($link)
	{
		return base_url().substr($link, 1);
	}
	
	private function _url($link)
	{
		return '/noticia/'.$link;
	}
	
}