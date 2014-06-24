<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 * 
 * 
 * 
 * 
 */


class Meusdados extends Admix_Controller{
	function __construct(){
		parent::__construct();
		
		$this->load->model('usuarios_m', 'usuarios');
		$this->load->helper('upload_helper');
		$this->load->library('bcrypt');
		//$this->load->library('permissoes_lib');
				
		//$this->permissoes_lib->validaPermissao($this->router->class, $this->router->method, $this->session->userdata('varUsuario_Id'));
	}	
	
	public function index(){
		$q['where']['Usuario_Id'] = $this->session->userdata('varUsuario_Id');
		$d = $this->usuarios->getUsuarios($q);
		
		$resposta = $d['result'][0];

		$errors = $this->session->flashdata('form_errors') ? $this->session->flashdata('form_errors') : array();
		$dados = array('acao' => 'Alterar',
				'action' => '/admix/'.$this->router->fetch_class().'/'.$this->router->fetch_method().'Post');
		
		$campos = array('Usuario_Id', 'Usuario_Nome', 'Usuario_Email', 'Usuario_Senha', 'Usuario_Imagem');
		foreach($campos as $k){
			$v[$k] = (array_key_exists($k, $resposta)) ? $resposta[$k] : '';
			$e[$k] = (array_key_exists($k, $errors)) ? $errors[$k] : '';
		}
		
		$resposta = array('v' => $v);
		$errors = array('e' => $e);
		
		$dados = array_merge($dados, $resposta, $errors);
						
		$this->setPagina($this->router->fetch_class().'/meus-dados.tpl', $dados);
	}
	
	public function indexPost() {
		$url_retorno = urldecode($this->input->post('url_retorno', true));

		// VALIDATION RULES
		/*$this->load->library('form_validation');
		$this->form_validation->set_rules('Usuario_Id', 'Código', 'required|trim');
		$this->form_validation->set_rules('Usuario_Nome', 'Nome', 'required|trim');
		$this->form_validation->set_rules('Usuario_Email', 'E-mail', 'required|trim|valid_email');
		$this->form_validation->set_error_delimiters('', '');*/
		
		$data['Usuario_Id'] = $this->session->userdata('varUsuario_Id');
		$data['Usuario_Senha'] = $this->input->post('Usuario_Senha', true);

		/* armazeno os dados para retorno */
		$this->session->set_flashdata('form_resposta',	$data);

		$upload_errors = FALSE;
		$upload = mixdUpload('Usuario_Imagem', '/media/usuarios/', $data['Usuario_Nome']);
		if($upload){
			if(!(isset($upload['error']))) $data['Usuario_Imagem'] = $upload['file_name']; else $upload_errors = TRUE;
		}
		
		if (/*($this->form_validation->run() == FALSE) ||*/ ($upload_errors == TRUE)) {
			$this->session->set_flashdata('form_errors', $this->form_validation->error_array());
			redirect('/admix/'.$this->router->fetch_class().'/meusdados/'.$url_retorno);
		}
		else{
			$result = $this->usuarios->alterar($data);
			if(!(isset($result['error']))){
				$msn['sucesso'] = 'Dados alterados com sucesso. ('.$result['num_rows'].')';
				$this->session->set_flashdata('malerta', $msn);
				redirect('/admix/'.$this->router->fetch_class().'/'.$url_retorno);
			}
			else{
				$msn['erro'] = 'Os dados não puderam ser alterados. ('.$result['error'].')';
				$this->session->set_flashdata('malerta', $msn);
				redirect('/admix/'.$this->router->fetch_class().'/meusdados/'.$url_retorno);
			}
		}						
	}
	
	public function removerImagem(){
		$url_retorno = $this->input->get('url_retorno', true);
		$url = $this->uri->uri_string();
		$file = str_replace('admix/'.$this->router->fetch_class().'/'.$this->router->fetch_method().'/', '', $url);
		$file = $this->security->sanitize_filename($file, TRUE);
		$result = $this->usuarios->removerImagem($file);
		if(!(isset($result['error']))){
			$remover = mixdUploadRemover($file);
			$msn['sucesso'] = 'Imagem removida com sucesso. ('.$result['num_rows'].')';
			$this->session->set_flashdata('malerta', $msn);
			redirect($url_retorno);
		}
		else{
			$msn['erro'] = 'A imagem não pode ser removida ou encontrada. ('.$result['error'].')';
			$this->session->set_flashdata('malerta', $msn);
			redirect($url_retorno);
		}
	}		
}

