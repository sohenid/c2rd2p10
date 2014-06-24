<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Acessos_m extends CI_Model{

	public function getAcessos($q, $ord = NULL, $per_page = NULL, $offset = NULL){		
		
		if(isset($q['where'])) $this->db->where($q['where']);
		if(isset($q['where_in'])){
			$array_indice = array_keys($q['where_in']);
			$indice = $array_indice[0];
			$this->db->where_in($indice, $q['where_in'][$indice]);
		}
		if(isset($q['like'])) $this->db->like($q['like']);
		$this->db->order_by($ord['ord_campo'], $ord['ord_tipo']);
		
		$this->db->select('SQL_CALC_FOUND_ROWS Acesso_Id, Acesso_Nome, Acesso_Email, Acesso_Data, Acesso_IP, Acesso_Pais, Acesso_Bandeira', FALSE);
		$query = $this->db->get('tabacessos', $per_page, $offset);
		#echo $this->db->last_query();
		
		$qp = $this->db->query('SELECT FOUND_ROWS() AS COUNT');
		$data['count'] = $qp->row()->COUNT;
		
		if($query && ($query->num_rows() > 0)){
			$data['result'] = $query->result_array();
			return $data;
		}
		else return false;	
	}
	
}

/* End of file emails_m.php */
/* Location: ./application/models/emails_m.php */