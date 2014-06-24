<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Configuracoes_m extends CI_Model{

	public function inserir($data){
		if($this->db->insert('tabconfiguracoes_valores', $data)){
			$categoriaId = $this->db->insert_id();
			return array('insert_id'	=> $categoriaId);
		}
		else{
			return array('error'	=> $this->db->_error_number());
		}
	}

	public function remover($data) {
		$num_rows = $error = 0;
		//foreach ($data['Config_Id'] as $k => $v){
			$this->db->where('Config_Id', $data['Config_Id'] );
			$this->db->delete('tabconfiguracoes_valores');
			if($this->db->affected_rows() == 1) $num_rows++;
			else $error++;
		//}
		if($error == 0){
			return array('num_rows'	=> $num_rows);
		}
		else{
			return array('error'	=> $error);
		}
	}
		
	public function getConfiguracoes(){
		$this->db->select('tabconfiguracoes.Config_Id, tabconfiguracoes.Config_Nome, tabconfiguracoes.Config_Descricao, tabconfiguracoes.Config_Identificador, tabconfiguracoes.Config_Tipo, tabconfiguracoes_valores.Config_Valor');
		$this->db->from('tabconfiguracoes');
		$this->db->join('tabconfiguracoes_valores', 'tabconfiguracoes.Config_Id = tabconfiguracoes_valores.Config_Id', 'left');
		$this->db->order_by('Config_Ordem', 'asc');
		$query = $this->db->get();
		
		if($query->num_rows() > 0){
			$result =  $query->result_array();
			return $result;
		}
	}	
	
	public function getConfiguracoesValores(){
		$this->db->select('tabconfiguracoes.Config_Identificador, tabconfiguracoes_valores.Config_Valor');
		$this->db->from('tabconfiguracoes');
		$this->db->join('tabconfiguracoes_valores', 'tabconfiguracoes.Config_Id = tabconfiguracoes_valores.Config_Id', 'left');
		$this->db->order_by('Config_Ordem', 'asc');
		$query = $this->db->get();
		
		if($query->num_rows() > 0){
			$result =  $query->result_array();
			$config = array();
			foreach($result as $k => $v) {
				$config[$v['Config_Identificador']] = $v['Config_Valor'];
			}
			return $config;
		}
	}	
	
}

/* End of file configuracoes_m.php */
/* Location: ./application/models/configuracoes_m.php */