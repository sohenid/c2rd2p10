<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 * 
 * 
 * 
 * 
 */


class Configuracoes extends Admix_Controller{
	function __construct(){
		parent::__construct();
		
		$this->load->model('configuracoes_m', 'configuracoes');
		$this->load->library('permissoes_lib');
				
		$this->permissoes_lib->validaPermissao($this->router->class, $this->router->method, $this->session->userdata('varUsuario_Id'));
	}	
	
	public function index(){
		$configuracoes = $this->configuracoes->getConfiguracoes();
		
		$dados = array(
			'action' => '/admix/'.$this->router->fetch_class().'/salvar',
			'configuracoes' => $configuracoes
		);
		
		$this->setPagina($this->router->fetch_class().'/configuracao-form.tpl', $dados);	
	}
	
	public function salvar(){
		$configuracoes = $this->configuracoes->getConfiguracoes();
		foreach($configuracoes as $k => $v) {
			$data['Config_Id'] = $v['Config_Id'];
			$data['Config_Valor'] = prep_for_form($this->input->post($v['Config_Identificador'], true));
			if (!empty($data['Config_Valor'])) {
				$this->configuracoes->remover($data);
				$result = $this->configuracoes->inserir($data);
				if(!(isset($result['error']))){
					$msn['sucesso'] = 'Dados cadastrados com sucesso. ('.$result['insert_id'].')';
				}
				else{
					$msn['erro'] = 'Os dados não puderam ser cadastrados. ('.$result['error'].')';
				}			
			}
		}
		$this->session->set_flashdata('malerta', $msn);
		redirect('/admix/'.$this->router->fetch_class());		
	}
	
}