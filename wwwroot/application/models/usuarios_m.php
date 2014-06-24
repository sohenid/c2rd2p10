<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Usuarios_m extends CI_Model{

	public function autenticar($usuarioEmail, $usuarioSenha){
		$this->db->where('Usuario_Email', $usuarioEmail);
		$this->db->where('Usuario_Status', 1);
		$query = $this->db->get('tabusuarios', 1, 0);
		if($query->num_rows() > 0){
			$result = $query->result_array();
			if($this->bcrypt->check($usuarioSenha, $result[0]['Usuario_Senha'])){
				$this->inserirUltimoAcesso($result[0]['Usuario_Id']);
				$this->inserirAcesso($result[0]['Usuario_Nome'], $result[0]['Usuario_Email']);
				
				return $result[0];
			}
			else{
				$this->antibruteforce->check();
			}
		}
		$this->antibruteforce->check();
		return false;
	}
	
	public function autenticado(){
        if(!$this->session->userdata('varUsuario_Id')){
			$msn['alerta'] = 'Por favor faça seu login.';
			$this->session->set_flashdata('malerta', $msn);
			redirect('/admix/login');
		}
	}
	
	public function getUsuarios($q, $ord = NULL, $per_page = NULL, $offset = NULL){

		if(isset($q['where'])) $this->db->where($q['where']);
		if(isset($q['where_in'])){
			$array_indice = array_keys($q['where_in']);
			$indice = $array_indice[0];
			$this->db->where_in($indice, $q['where_in'][$indice]);
		}
		if(isset($q['like'])) $this->db->like($q['like']);
		if($ord) $this->db->order_by($ord['ord_campo'].' '.$ord['ord_tipo']);
		
		$this->db->select('SQL_CALC_FOUND_ROWS
				Usuario_Id, Usuario_Nome, Usuario_Email, Usuario_Imagem, Usuario_UltimoAcesso, Usuario_Status, Usuario_Administrador', FALSE);
		$query = $this->db->get('tabusuarios', $per_page, $offset);
		#echo $this->db->last_query();
		
		$qp = $this->db->query('SELECT FOUND_ROWS() AS COUNT');
		$data['count'] = $qp->row()->COUNT;
		
		#echo $this->db->last_query();
		if($query && ($query->num_rows() > 0)){
			$data['result'] = $query->result_array();
			return $data;
		}
		else return false;
	}
	
	public function getPermissoes($id){
		
		$this->db->where('Usuario_Id', intval($id));		
		$query = $this->db->get('tabusuarios_permissoes');
		if($query->num_rows() > 0){
			$result =  $query->result_array();
			return $result;
		}
		else return false;	
	}
	
	public function getAvatar($id){
	
		$this->db->select('Usuario_Imagem');
		$this->db->where('Usuario_Id', intval($id));
		$query = $this->db->get('tabusuarios');
		if($query->num_rows() > 0){
			$result =  $query->result_array();
			return $result[0]['Usuario_Imagem'];
		}
	}
	
	public function inserir($data){
		
		$data['Usuario_Senha'] = $this->bcrypt->hash($data['Usuario_Senha']);
		$data['Usuario_UltimoAcesso'] = date('Y-m-d H:i:s');
		
		if($this->validaEmail($data['Usuario_Email'])){
			$permissaoId = $data['Permissao_Id'];
			unset($data['Permissao_Id']);

			$privados = $this->_getPermissoesPrivados();
			if(isset($privados) && ($privados != FALSE) && ($this->isAdministrador($this->session->userdata('varUsuario_Id')) == FALSE)) $this->db->where_not_in('Permissao_Id', $privados);
			
			if($this->db->insert('tabusuarios', $data)){
				$usuarioId = $this->db->insert_id();

				/* se nao for administrador não permite inserção de itens privados */
				$privados = ($this->isAdministrador($this->session->userdata('varUsuario_Id')) == FALSE) ? $this->_getPermissoesPrivados() : array();
				
				/* permissoes */
				foreach($permissaoId as $k => $v){
					if(!in_array($v, $privados)){
						$permissoes = array(
							'Permissao_Id' => $v,
							'Usuario_Id' => $usuarioId
						);
						$this->db->insert('tabusuarios_permissoes', $permissoes);
					}	
				}
				return array('insert_id'	=> $usuarioId);
			}
			else{
				return array('error'	=> $this->db->_error_number());
			}
		}
		else{
			return array('error'	=> 'E-mail já cadastrado');
		}
	}
	
	public function alterar($data) {

		if(!empty($data['Usuario_Senha'])) $data['Usuario_Senha'] = $this->bcrypt->hash($data['Usuario_Senha']); else unset($data['Usuario_Senha']);
				
		if($this->validaEmail($data['Usuario_Email'], $data['Usuario_Id'])){
			/* permissoes */ /* isso tinha que ter ficado no controle */
			$privados = $this->_getPermissoesPrivados();
			if(isset($privados) && ($privados != FALSE) && ($this->isAdministrador($this->session->userdata('varUsuario_Id')) == FALSE)) $this->db->where_not_in('Permissao_Id', $privados);
			$this->db->where('Usuario_Id', $data['Usuario_Id']);
			$this->db->delete('tabusuarios_permissoes');
			foreach($data['Permissao_Id'] as $k => $v){
				$permissoes = array('Permissao_Id' => $v,
									'Usuario_Id' => $data['Usuario_Id']
								   );
				$this->db->insert('tabusuarios_permissoes', $permissoes);
			}
			unset($data['Permissao_Id']);
			$this->db->where('Usuario_Id', $data['Usuario_Id']);
			$this->db->update('tabusuarios', $data);
			if(!$this->db->_error_number()){
				return array('num_rows'	=> $this->db->affected_rows());
			}
			else{
				return array('error'	=> $this->db->_error_number());
			}
		}
		else{
			return array('error'	=> 'E-mail já cadastrado');
		}
	}

	public function remover($data) {
		$num_rows = $error = 0;
		foreach ($data['Usuario_Id'] as $k => $v){
			
			/* permissoes */
			$this->db->where('Usuario_Id', $v);
			$this->db->delete('tabusuarios_permissoes');
			
			$this->db->where('Usuario_Id', $v);
			$this->db->delete('tabusuarios');
			if($this->db->affected_rows() == 1) $num_rows++;
			else $error++;
		}
		if($error == 0){
			return array('num_rows'	=> $num_rows);
		}
		else{
			return array('error'	=> $error);
		}
	}
	
	public function getUsuarioPermissoes($id){
		if($id){
			$this->db->where('Usuario_Id', intval($id));
			$query = $this->db->get('tabusuarios_permissoes');
			if($query->num_rows() > 0){
				$result =  $query->result_array();
				return $result;
			}
			else return false;
		}
		else{
			return false;
		}	
	}
	
	/*
	public function getPermissao($Permissao_Id) {
		$this->db->where('Usuario_Id', $this->session->userdata('Usuario_Id'));
		$this->db->where('Permissao_Id', $Permissao_Id);
		$result = $this->db->get('tabusuarios_permissoes')->result_array();
		if ($result)
			return $result[0];
		else
			return array('Permissao_Visualizar' => 0, 'Permissao_Inserir' => 0, 'Permissao_Alterar' => 0, 'Permissao_Excluir' => 0);
	}
	
	public function GetPermissoes() {
		$this->db->where('Usuario_Id', $this->session->userdata('Usuario_Id'));
		$result = $this->db->get('tabusuarios_permissoes')->result_array();
		$array = array();
		foreach($result as $row) {
			$array[$row['Permissao_Id']] = $row;		
		}
		return $array;
	}
	*/
	
	private function inserirUltimoAcesso($Usuario_Id){
		$usuario['Usuario_UltimoAcesso'] = date('Y-m-d H:i:s');
		
		$this->db->where('Usuario_Id', $Usuario_Id);
		$update = $this->db->update('tabusuarios', $usuario);
	}
		
	private function inserirAcesso($nome, $email){	
		$acesso['Acesso_Nome'] = $nome;
		$acesso['Acesso_Email'] = $email;
		$acesso['Acesso_Data'] = date("Y-m-d H:i:s");
		$acesso['Acesso_IP'] = $this->input->ip_address(); #'200.219.204.188';
		$acesso['Acesso_Pais'] = $this->maxmind_geoip->retornaPais($acesso['Acesso_IP']);
		#$acesso['Acesso_Bandeira'] = 'flag_'.strtolower($this->maxmind_geoip->retornaBandeira($acesso['Acesso_IP'])).'.gif';
		$acesso['Acesso_Bandeira'] = $this->maxmind_geoip->retornaBandeira($acesso['Acesso_IP']);
		
		$this->db->insert('tabacessos', $acesso);
	}
	
	public function validaEmail($email, $id=NULL){
		$this->db->where('Usuario_Email', $email);
if($id) $this->db->where('Usuario_Id <>', $id);		
		$query = $this->db->get('tabusuarios', 1);
		if($query->num_rows() > 0){
			return FALSE;
		}
		else{
			return TRUE;
		}
	}
	
	public function removerImagem($file){
		$this->db->where('Usuario_Imagem', '/'.$file);
		$this->db->set('Usuario_Imagem', '');
		$this->db->update('tabusuarios');
	
		if($this->db->affected_rows() == 1){
			return array('num_rows'	=> 1);
		}
		else{
			return array('error'	=> 1);
		}
	}

	public function isAdministrador($usuario_id){
		$this->db->where('Usuario_Id', $usuario_id);
		$this->db->select('Usuario_Administrador');
		$query = $this->db->get('tabusuarios');
		if($query->num_rows() > 0){
			$result =  $query->result_array();
			if($result[0]['Usuario_Administrador'] == 1) return TRUE;
			else return FALSE;
		}
		else return FALSE;
	}
	
	private function _getPermissoesPrivados(){
		$this->db->where('Permissao_Privado', 1);
		$query = $this->db->get('tabpermissoes');
		if($query && ($query->num_rows() > 0)){
			$data['result'] = $query->result_array();
			foreach($data['result'] as $k => $v){
				$array_privados[] = $v['Permissao_Id'];
			}
			return $array_privados;
		}
		else return FALSE;
	}
	
	public function gravarReset($Usuario_Reset, $Usuario_Id){
		$usuario['Usuario_Reset'] = $Usuario_Reset;
		
		$this->db->where('Usuario_Id', $Usuario_Id);
		$update = $this->db->update('tabusuarios', $usuario);
	}	
	
	public function alteraSenha($Usuario_Senha, $Usuario_Id) {
		$usuario['Usuario_Senha'] = $this->bcrypt->hash($Usuario_Senha);
		$usuario['Usuario_Reset'] = "";
		
		$this->db->where('Usuario_Id', $Usuario_Id);
		$update = $this->db->update('tabusuarios', $usuario);		
	}
}

/* End of file usuarios.php */
/* Location: ./application/models/usuarios.php */