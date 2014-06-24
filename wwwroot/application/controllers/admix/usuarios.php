<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 * 
 * Os dados do Usuarios não estão dividos em pastas porque fazem parte do CORE da area administrativa
 * 
 * 
 */


class Usuarios extends Admix_Controller{
	function __construct(){
		parent::__construct();
		
		$this->load->model('usuarios_m', 'usuarios');
		$this->load->model('permissoes_m', 'permissoes');
		$this->load->helper('upload_helper');
		$this->load->library('permissoes_lib');
		$this->load->library('bcrypt');
		
		$this->permissoes_lib->validaPermissao($this->router->class, $this->router->method, $this->session->userdata('varUsuario_Id'));
		$this->isAdministrador = $this->usuarios->isAdministrador($this->session->userdata('varUsuario_Id'));
	}		
	
	public function index(){
		/* paginacao */
		$this->load->helper('pagination_helper');
		
		if($this->input->get('print')) $print = true;
		else $print = false;
		
		$b = array('Usuario_Id', 'Usuario_Nome', 'Usuario_Email', 'Usuario_Status');
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
		$ord['ord_campo'] = ($this->input->get('ord_campo', true)) ? prep_for_form($this->input->get('ord_campo', true)) : 'Usuario_Nome';
		$ord['ord_tipo'] = ($this->input->get('ord_tipo', true)) ? prep_for_form($this->input->get('ord_tipo', true)) : 'desc';
		/* fim da ordenação */
		
		$q = array();
		if($b['Usuario_Id']) 			$q['where']['Usuario_Id'] = $b['Usuario_Id'];
		if($b['Usuario_Nome']) 			$q['like']['Usuario_Nome'] = $b['Usuario_Nome'];
		if($b['Usuario_Email']) 		$q['like']['Usuario_Email'] = $b['Usuario_Email'];
		if($b['Usuario_Status'] != '')	$q['where']['Usuario_Status'] = $b['Usuario_Status'];
		if($this->isAdministrador == FALSE)	$q['where']['Usuario_Administrador'] = 0;
		
		unset($qs['p']);
		$base_url = '/admix/'.$this->router->fetch_class().'/?'.http_build_query($qs);
		$per_page = ($print) ? 1000 : 20;
		$offset = ($print) ? 0 : intval($this->input->get('p'));
		$d = $this->usuarios->getUsuarios($q, $ord, $per_page, $offset);
		
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
		$this->setPagina($this->router->fetch_class().'/usuarios.tpl', $dados);
		
	}
	
	public function inserir(){
		$resposta = $this->session->flashdata('form_resposta') ? $this->session->flashdata('form_resposta') : array();
		$errors = $this->session->flashdata('form_errors') ? $this->session->flashdata('form_errors') : array();
		$dados = array('acao' => 'Inserir',
				'action' => '/admix/'.$this->router->fetch_class().'/'.$this->router->fetch_method().'Post');
		$campos = array('Usuario_Id', 'Usuario_Status', 'Usuario_Nome', 'Usuario_Email', 'Usuario_Senha', 'Usuario_Imagem', 'Usuario_Administrador');
		foreach($campos as $k){
			$v[$k] = (array_key_exists($k, $resposta)) ? $resposta[$k] : '';
			$e[$k] = (array_key_exists($k, $errors)) ? $errors[$k] : '';
		}
		$resposta = array('v' => $v);
		$errors = array('e' => $e);
		
		$p = $this->permissoes->getPermissoes(NULL);
		foreach($p as $pk => $pv){
			foreach ($pv as $pk1 => $pv1){
				$classe = $pv['Permissao_Classe'];
				$metodo = $pv['Permissao_Metodo'];
				$tmpP[$classe][$metodo] = $pv['Permissao_Id'];
			}
		}
		$permissoes = array('permissoes' => $tmpP);
		$permissoesSelected = array('permissoesSelected' => array());
		
		$dados['is_administrador'] = $this->isAdministrador;
		
		$dados = array_merge($dados, $resposta, $errors, $permissoes, $permissoesSelected);
		
		$this->setPagina($this->router->fetch_class().'/usuario-form.tpl', $dados);
	}

	public function inserirPost(){
		$url_retorno = urldecode($this->input->post('url_retorno'));
		// VALIDATION RULES
        $this->load->library('form_validation');
        $this->form_validation->set_rules('Usuario_Nome', 'Nome', 'required|trim');
        $this->form_validation->set_rules('Usuario_Email', 'E-mail', 'required|trim|valid_email');
        $this->form_validation->set_rules('Usuario_Senha', 'Senha', 'required|trim');
		$this->form_validation->set_error_delimiters('', '');

		$data['Usuario_Status'] = $this->input->post('Usuario_Status', true);
		$data['Usuario_Nome'] = $this->input->post('Usuario_Nome', true);
		$data['Usuario_Email'] = $this->input->post('Usuario_Email', true);
		$data['Usuario_Senha'] = $this->input->post('Usuario_Senha', true);
		if($this->isAdministrador == TRUE){
			$data['Usuario_Administrador'] = $this->input->post('Usuario_Administrador', true);
		}
		else $data['Usuario_Administrador'] = 0;
		$data['Permissao_Id'] = $this->input->post('Permissao_Id', true);
		/* armazeno os dados para retorno */
		$this->session->set_flashdata('form_resposta',	$data);
		
		if($this->usuarios->validaEmail($data['Usuario_Email'])){		
			$upload_errors = FALSE;
			$upload = mixdUpload('Usuario_Imagem', '/media/usuarios/', $data['Usuario_Nome']);
			if($upload){
				if(!(isset($upload['error']))) $data['Usuario_Imagem'] = $upload['file_name']; else $upload_errors = TRUE;
			}			

			if (($this->form_validation->run() == FALSE) || ($upload_errors == TRUE)) {
				$this->session->set_flashdata('form_errors', $this->form_validation->error_array());
				redirect('/admix/'.$this->router->fetch_class().'/inserir'.'/'.$url_retorno);
			}
			else{
				$result = $this->usuarios->inserir($data);
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
		else{
			$this->session->set_flashdata('form_errors', array('Usuario_Email'	=> 'E-mail duplicado.'));
			redirect('/admix/'.$this->router->fetch_class().'/inserir'.'/'.$url_retorno);
		}
	}
	
	public function alterar($id=NULL){
		if(!isset($id)) redirect('/admix/'.$this->router->fetch_class());
		
		$q = array();
		$q['where']['Usuario_Id'] = $id;
		if($this->isAdministrador == FALSE){
			$q['where']['Usuario_Administrador'] = 0;
		}
		$d = $this->usuarios->getUsuarios($q);
		if(!$d){
			log_message('info', 'O usuario '.$this->session->userdata('varUsuario_Id').' tentou acessar o usuario '.$id.' ');
			redirect('/admix/');
		}
		$resposta = $d['result'][0];
		
		$errors = $this->session->flashdata('form_errors') ? $this->session->flashdata('form_errors') : array();
		$dados = array('acao' => 'Alterar',
				'action' => '/admix/'.$this->router->fetch_class().'/'.$this->router->fetch_method().'Post');
		
		$campos = array('Usuario_Id', 'Usuario_Status', 'Usuario_Nome', 'Usuario_Email', 'Usuario_Senha', 'Usuario_Imagem', 'Usuario_Administrador');
		foreach($campos as $k){
			$v[$k] = (array_key_exists($k, $resposta)) ? $resposta[$k] : '';
			$e[$k] = (array_key_exists($k, $errors)) ? $errors[$k] : '';
		}
		
		$resposta = array('v' => $v);
		$errors = array('e' => $e);
		
		$permissoesSelected = $this->usuarios->getUsuarioPermissoes($id);
		if($permissoesSelected){
			foreach($permissoesSelected as $kps => $vps){
				$arrayPermissoesSelected[] = $vps['Permissao_Id'];
			}
		}
		else{
			$arrayPermissoesSelected = array();
		}
		$permissoesSelected = array('permissoesSelected' => $arrayPermissoesSelected);
		
		$p = $this->permissoes->getPermissoes(NULL);
		foreach($p as $pk => $pv){
			foreach ($pv as $pk1 => $pv1){
				$classe = $pv['Permissao_Classe'];
				$metodo = $pv['Permissao_Metodo'];
				$tmpP[$classe][$metodo] = $pv['Permissao_Id'];
			}
		}
		$permissoes = array('permissoes' => $tmpP);
		
		$dados['is_administrador'] = $this->isAdministrador;
		
		$dados = array_merge($dados, $resposta, $errors, $permissoes, $permissoesSelected);
				
		$this->setPagina($this->router->fetch_class().'/usuario-form.tpl', $dados);

	}
	
	public function alterarPost(){
		$url_retorno = urldecode($this->input->post('url_retorno', true));

		// VALIDATION RULES
		$this->load->library('form_validation');
		$this->form_validation->set_rules('Usuario_Id', 'Código', 'required|trim');
		$this->form_validation->set_rules('Usuario_Nome', 'Nome', 'required|trim');
		$this->form_validation->set_rules('Usuario_Email', 'E-mail', 'required|trim|valid_email');
		$this->form_validation->set_error_delimiters('', '');
		
		$data['Usuario_Id'] = $this->input->post('Usuario_Id', true);
		$data['Usuario_Status'] = $this->input->post('Usuario_Status', true);
		$data['Usuario_Nome'] = $this->input->post('Usuario_Nome', true);
		$data['Usuario_Email'] = $this->input->post('Usuario_Email', true);
		$data['Usuario_Senha'] = $this->input->post('Usuario_Senha', true);
		$data['Permissao_Id'] = $this->input->post('Permissao_Id', true);
		/* não deixo burlar o administrador */
		if($this->isAdministrador == FALSE){
			if($this->usuarios->isAdministrador($data['Usuario_Id'])){
				log_message('info', 'O usuário '.$this->session->userdata('varUsuario_Id').' tentou editar o usuário '.$data['Usuario_Id'].' ');
				redirect('/admix/');
			}
			else $data['Usuario_Administrador'] = 0;
		}
		else $data['Usuario_Administrador'] = $this->input->post('Usuario_Administrador', true);

		/* armazeno os dados para retorno */
		$this->session->set_flashdata('form_resposta',	$data);
		
		if($this->usuarios->validaEmail($data['Usuario_Email'], $data['Usuario_Id'])){
			$upload_errors = FALSE;
			$upload = mixdUpload('Usuario_Imagem', '/media/usuarios/', $data['Usuario_Nome']);
			if($upload){
				if(!(isset($upload['error']))) $data['Usuario_Imagem'] = $upload['file_name']; else $upload_errors = TRUE;
			}
			
			if (($this->form_validation->run() == FALSE) || ($upload_errors == TRUE)) {
				$this->session->set_flashdata('form_errors', $this->form_validation->error_array());
				redirect('/admix/'.$this->router->fetch_class().'/alterar/'.$data['Usuario_Id'].'/'.$url_retorno);
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
					redirect('/admix/'.$this->router->fetch_class().'/alterar/'.$data['Usuario_Id'].'/'.$url_retorno);
				}
			}
		}
		else{
			$this->session->set_flashdata('form_errors', array('Usuario_Email'	=> 'E-mail duplicado.'));
			redirect('/admix/'.$this->router->fetch_class().'/alterar'.'/'.$url_retorno);
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
		$ord['ord_campo'] = ($this->input->get_post('ord_campo', true)) ? prep_for_form($this->input->get_post('ord_campo', true)) : 'Usuario_Nome';
		$ord['ord_tipo'] = ($this->input->get_post('ord_tipo', true)) ? prep_for_form($this->input->get_post('ord_tipo', true)) : 'desc';
		/* fim da ordenação */
		
		$q = array();
		$q['where_in']['Usuario_Id'] = $id;
		if($this->isAdministrador == FALSE)	$q['where']['Usuario_Administrador'] = 0;
		$d = $this->usuarios->getUsuarios($q, $ord);
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
				
		$this->setPagina($this->router->fetch_class().'/usuarios.tpl', $dados);
	}
	
	public function removerPost(){
		$url_retorno = urldecode($this->input->post('url_retorno', true));
		$data['Usuario_Id'] = $this->input->post('ids', true);
		/* converto para array */
		if(!is_array($data['Usuario_Id'])) $data['Usuario_Id'] = array($data['Usuario_Id']);
		
		foreach($data['Usuario_Id'] as $k => $v){
			if($this->isAdministrador == FALSE){
				if($this->usuarios->isAdministrador($v)){
					log_message('info', 'O usuário '.$this->session->userdata('varUsuario_Id').' tentou excluir o usuário '.$v.' ');
					redirect('/admix/');
				}
				else {
					if($v != $this->session->userdata('varUsuario_Id'))	$usuario_id_limpo[] = $v;
				}
			}
			else{
				if($v != $this->session->userdata('varUsuario_Id')) $usuario_id_limpo[] = $v;
			}
		}
		$data['Usuario_Id'] = $usuario_id_limpo;
		$result = $this->usuarios->remover($data);
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