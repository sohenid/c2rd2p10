<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Permissoes_m extends CI_Model{
	public function getPermissoes($id){
		if($id){
			if(is_array($id)){
				$this->db->where_in('Permissao_Id', $id);
			}
			else{
				$this->db->where('Permissao_Id', intval($id));
			}
		}
		$this->db->where('Permissao_Privado', 0);
		$query = $this->db->get('tabpermissoes');
		if($query->num_rows() > 0){
			$result =  $query->result_array();
			return $result;
		}
		else return FALSE;	
	}
	
	public function getPermissaoId($classe, $metodo){
		$this->db->where('Permissao_Classe',	$classe);
		$this->db->where('Permissao_Metodo',	$metodo);
		$query = $this->db->get('tabpermissoes', 1);
		if($query->num_rows() > 0){
			$result = $query->row();
			return $result->Permissao_Id;
		}
		else return FALSE;
	}
	
	public function inserir($classe, $metodo){
		$data['Permissao_Classe'] = $classe;
		$data['Permissao_Metodo'] = $metodo;
		$data['Permissao_Apelido'] = $classe.'/'.$metodo;
		if($this->db->insert('tabpermissoes', $data)) return $this->db->insert_id();
		else return FALSE;
	}
	
	public function validaUsuarioPermissao($id, $permissao){
		$this->db->where('Usuario_Id', $id);
		$this->db->where('Permissao_Id', $permissao);
		$query = $this->db->get('tabusuarios_permissoes');
		if($query->num_rows() > 0){
			return TRUE;
		}
		else return FALSE;
	}

}

/* End of file permissoes_m.php */
/* Location: ./application/models/permissoes_m.php */