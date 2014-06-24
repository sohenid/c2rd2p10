<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Permissoes_lib{

	public function __construct(){
		#$CI = get_instance();       
	}
	
	function validaPermissao($classe, $metodo, $usuario_id){

		/*
		 * Macgyver
		 * */
		$metodo = str_replace('Post', '', $metodo);
		$permitidos = array('index', 'inserir', 'alterar', 'remover');
		if(!in_array($metodo, $permitidos)) $metodo = 'alterar';
		
		/*
		* Criando uma instância do CodeIgniter para poder acessar
		* banco de dados, sessions, models, etc...
		*/
		$CI = get_instance();       
		$CI->load->model('permissoes_m', 'permissoes');
		$CI->load->model('usuarios_m', 'usuarios');
			
		if($usuario_id){
			/* movido para popular a tabela */
			$permissao_id = $CI->permissoes->getPermissaoId($classe, $metodo);
			if(!$permissao_id) $permissao_id = $CI->permissoes->inserir($classe, $metodo);
				
			if($CI->usuarios->isAdministrador($usuario_id) === FALSE){
				/**/
				if($permissao_id){
					if(!$CI->permissoes->validaUsuarioPermissao($usuario_id, $permissao_id)){
						redirect('/admix/sem-permissao', 'refresh');
					}
				}
				else{
					redirect('/admix/sem-permissao', 'refresh');
				}
			}
		}	
		else{
			redirect('/', 'refresh');
		}	
	}
}