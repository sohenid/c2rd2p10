<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Cidades_m extends CI_Model{
	
	public function getCidades($id = NULL){
		
		if(!$id){
			return array('error'	=> 'Estado não selecionado');
		}
		else{
			$this->db->where('Estado_Id', $id);
			$this->db->select('Cidade_Id, Cidade_Nome');
			$this->db->order_by('Cidade_Ordem ASC, Cidade_Nome ASC');
			$query = $this->db->get('tabcidades');
			
			if($query && ($query->num_rows() > 0)){
				$data['result'] = $query->result_array();
				return $data;
			}
			else return array('error'	=> 'Nenhuma cidade foi encontrada');
				
		}
	}

}

/* End of file cidades_m.php */
/* Location: ./application/models/cidades_m.php */