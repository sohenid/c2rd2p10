<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends Admix_Controller{
	function __construct(){
		parent::__construct();
		
		$this->load->model('usuarios_m', 'usuarios');
	}		
	
	public function index(){
		
		$usuarioId = $this->session->userdata('varUsuario_Id');
		$usuarioNome = $this->session->userdata('varUsuario_Nome');
		$usuarioUltimoAcesso = $this->session->userdata('varUsuario_UltimoAcesso');
		$dados = array(
					   'usuarioId' => $usuarioId,
					   'usuarioNome' => $usuarioNome,
					   'usuarioUltimoAcesso' => $usuarioUltimoAcesso
					   );
        $this->setPagina('principal.tpl', $dados);
        
	}
		
}