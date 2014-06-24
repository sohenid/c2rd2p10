<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller{
	function __construct(){
		parent::__construct();
		
		$this->load->library('maxmind_geoip');
		$this->load->library('antibruteforce');
		$this->load->library('bcrypt');
		$this->msmarty->assign('malerta', $this->session->flashdata('malerta'));
	}		
	
	public function index(){
		$this->config->load('admix');
		
		$this->msmarty->assign('siteNome', $this->config->item('site_nome'));
				
		$this->msmarty->display('admix/login.tpl');
	}
	
	public function logar(){
		$Usuario_Email = $this->input->post('Usuario_Email', true);
		$Usuario_Senha = $this->input->post('Usuario_Senha', true);
			
		$this->load->model('usuarios_m', 'usuarios');
					
		$auth = $this->usuarios->autenticar($Usuario_Email, $Usuario_Senha);
		if($auth){
			$this->session->set_userdata('varUsuario_Id', $auth['Usuario_Id']);
			$this->session->set_userdata('varUsuario_Nome', $auth['Usuario_Nome']);
			
			$ultimoAcesso = ($auth['Usuario_UltimoAcesso']) ? $auth['Usuario_UltimoAcesso'] : date('Y-m-d H:i:s'); 
			$this->session->set_userdata('varUsuario_UltimoAcesso', $ultimoAcesso);
			
			$this->session->set_userdata('varLogado', true);
			redirect('/admix');
		}
		else{
			$msn['erro'] = 'E-mail ou senha inválidos.';
			$this->session->set_flashdata('malerta', $msn);
			redirect('/admix/login');
		}
	}
		
	public function logout(){
		$this->session->unset_userdata('varUsuario_Id');
		$this->session->unset_userdata('varUsuario_Nome');
		$this->session->unset_userdata('Usuario_UltimoAcesso');
		$this->session->unset_userdata('varLogado');
		redirect('/admix');
	}
	
	public function senha() {
		$q = array();
		$q['where']['Usuario_Email'] = $this->input->post('Usuario_Email', true);
		
		$this->load->model('usuarios_m', 'usuarios');
		
		$result = $this->usuarios->getUsuarios($q);
		
		if (!$result) {
			$msn['erro'] = 'E-mail inválido ou não existente.';
			$this->session->set_flashdata('malerta', $msn);
			redirect('/admix/login');			
		}
		
		$usuario = $result['result'][0];
		
		$rand = rand(0, 9999);
		
		$Usuario_Id = $usuario['Usuario_Id'];
		$Usuario_Email = $usuario['Usuario_Email'];
		$Usuario_Reset = base64_encode(sha1($Usuario_Id.$Usuario_Email.$rand).':'.date('Y-m-d'));

		$this->usuarios->gravarReset($Usuario_Reset, $Usuario_Id);

		$message = '<a href="http://'.$_SERVER['HTTP_HOST'].'/admix/login/recuperar/'.$Usuario_Reset.'">Recuperar senha</a>';
		
		$this->load->model('configuracoes_m', 'configuracoes');
		
		$configuracoes = $this->configuracoes->getConfiguracoesValores();
		
		$this->load->library('email');

		$this->config->load('admix');
		
		$email['mailtype'] = 'html';

		if (!empty($configuracoes['Smtp_Host'])) {
			$email['protocol'] = 'smtp';
			$email['smtp_host'] = $configuracoes['Smtp_Host'];
			$email['smtp_port'] = $configuracoes['Smtp_Port'];
			$email['smtp_user'] = $configuracoes['Smtp_UserName'];
			$email['smtp_pass'] = $configuracoes['Smtp_Password'];		
		}
		
		$this->email->initialize($email);		

		$this->email->from($configuracoes['Smtp_Email'], $this->config->item('site_nome'));
		$this->email->to($Usuario_Email); 
		$this->email->subject($this->config->item('site_nome') . ' :: Recuperar senha');
		$this->email->message($message);	
		
		if ($this->email->send()) {
			$msn['sucesso'] = 'Sua solicitação de nova senha foi enviada para seu e-mail.';
			$this->session->set_flashdata('malerta', $msn);
			header("Location: /admix/login");			
		} else {
			$msn['erro'] = 'Sua solicitação de nova senha não pode ser enviada. Tente novamente mais tarde.';
			$this->session->set_flashdata('malerta', $msn);
			header("Location: /admix/login");			
		}		
	}
	
	public function recuperar($Usuario_Reset) {
		$q = array();
		$q['where']['Usuario_Reset'] = $Usuario_Reset;
		
		$this->load->model('usuarios_m', 'usuarios');
		
		$result = $this->usuarios->getUsuarios($q);

		if (!$result) {
			$msn['erro'] = 'E-mail inválido ou não existente.';
			$this->session->set_flashdata('malerta', $msn);
			redirect('/admix/login');			
		}
		
		$usuario = $result['result'][0];
		
		$base = base64_decode($Usuario_Reset);
		$part = explode(":", $base);
		$Data = $part[1];
		
		if ($Data != date('Y-m-d')) {
			$msn['erro'] = 'Link expirado. Por favor solicite novamente uma nova senha.';
			$this->session->set_flashdata('malerta', $msn);
			redirect('/admix/login');	
		}
		
		$Usuario_Id = $usuario['Usuario_Id'];
		$Usuario_Email = $usuario['Usuario_Email'];
		$Usuario_Senha = substr(sha1(date("His")), 0, 6);

		$this->usuarios->alteraSenha($Usuario_Senha, $Usuario_Id);
	
		$message = 'Nova senha: '.$Usuario_Senha.' <br /><a href="http://'.$_SERVER['HTTP_HOST'].'/admix/login">Acessar administração</a>';
	
		$this->load->model('configuracoes_m', 'configuracoes');
		
		$configuracoes = $this->configuracoes->getConfiguracoesValores();
		
		$this->load->library('email');

		$this->config->load('admix');
		
		$email['mailtype'] = 'html';

		if (!empty($configuracoes['Smtp_Host'])) {
			$email['protocol'] = 'smtp';
			$email['smtp_host'] = $configuracoes['Smtp_Host'];
			$email['smtp_port'] = $configuracoes['Smtp_Port'];
			$email['smtp_user'] = $configuracoes['Smtp_UserName'];
			$email['smtp_pass'] = $configuracoes['Smtp_Password'];		
		}
		
		$this->email->initialize($email);		

		$this->email->from($configuracoes['Smtp_Email'], $this->config->item('site_nome'));
		$this->email->to($Usuario_Email); 
		$this->email->subject($this->config->item('site_nome') . ' :: Nova senha');
		$this->email->message($message);
		
		if ($this->email->send()) {
			$msn['sucesso'] = 'Sua nova senha foi enviada para seu e-mail.';
			$this->session->set_flashdata('malerta', $msn);
			header("Location: /admix/login");			
		} else {
			$msn['erro'] = 'Sua nova senha não pode ser enviada. Tente novamente mais tarde.';
			$this->session->set_flashdata('malerta', $msn);
			header("Location: /admix/login");			
		}	
	}
		
}