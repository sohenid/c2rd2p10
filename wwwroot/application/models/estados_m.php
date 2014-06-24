<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Estados_m extends CI_Model{
	
	public function getEstados($id = NULL){
		
		/* somente ativos */
		if($id) $this->db->where('Estado_Id', $id);
		$this->db->select('Estado_Id, Estado_Nome, Estado_Sigla');
		$query = $this->db->get('tabestados');
		#echo $this->db->last_query();
		
		if($query && ($query->num_rows() > 0)){
			$data['result'] = $query->result_array();
			return $data;
		}
		else return false;
	}

}

/* End of file estados_m.php */
/* Location: ./application/models/estados_m.php */