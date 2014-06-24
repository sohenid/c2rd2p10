<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Emails_m extends CI_Model{

	public function getEmails($q, $ord = NULL, $per_page = NULL, $offset = NULL){		
		
		if(isset($q['where'])) $this->db->where($q['where']);
		if(isset($q['where_in'])){
			$array_indice = array_keys($q['where_in']);
			$indice = $array_indice[0];
			$this->db->where_in($indice, $q['where_in'][$indice]);
		}
		if(isset($q['like'])) $this->db->like($q['like']);
		$this->db->order_by($ord['ord_campo'], $ord['ord_tipo']);
		
		$this->db->where('Email_Excluido', 0);
		$this->db->select('SQL_CALC_FOUND_ROWS Email_Id, Email_Nome, Email_Email, Email_DataCadastro', FALSE);
		$query = $this->db->get('tabemails', $per_page, $offset);
		
		$qp = $this->db->query('SELECT FOUND_ROWS() AS COUNT');
		$data['count'] = $qp->row()->COUNT;
		
		#echo $this->db->last_query();
		if($query && ($query->num_rows() > 0)){
			$data['result'] = $query->result_array();
			return $data;
		}
		else return false;	
	}
	
	public function inserir($data){
		if($this->db->insert('tabemails', $data)){
			return array('insert_id'	=> $this->db->insert_id());
		}
		else{
			return array('error'	=> $this->db->_error_number());
		}
	}	
	
	public function remover($data) {
		$num_rows = $error = 0;
		foreach ($data['Email_Id'] as $k => $v){
			$this->db->where('Email_Id', $v);
			$this->db->update('tabemails', array(
					'Email_Excluido'		=> 1,
					'Email_DataExcluido'	=> date('Y-m-d H:i:s')
			));
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
	
	/*
	public function exportEmails(){
		if($id){
			if(is_array($id)){
				$this->db->where_in('Email_Id', $id);
			}
			else{
				$this->db->where('Email_Id', intval($id));
			}
		}
		$query = $this->db->get('tabemails');
		if($query->num_rows() > 0){
			$result =  $query->result_array();
			return $result;
		}
		else return false;
	}
	*/
}

/* End of file emails_m.php */
/* Location: ./application/models/emails_m.php */