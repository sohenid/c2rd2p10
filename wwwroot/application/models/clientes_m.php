<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Clientes_m extends CI_Model{

	public function getClientes($q, $ord = NULL, $per_page = NULL, $offset = NULL){
		
		$this->db->where('Cliente_Excluido', 0);

		if(isset($q['where']))
		{
		 $this->db->where($q['where']);
		}
		if(isset($q['where_in'])){
			$array_indice = array_keys($q['where_in']);
			$indice = $array_indice[0];
			$this->db->where_in($indice, $q['where_in'][$indice]);
		}
		if(isset($q['like'])) $this->db->like($q['like']);
		if($ord) $this->db->order_by('Cliente_Order DESC, Cliente_Ordem ASC, '.$ord['ord_campo'].' '.$ord['ord_tipo']);
		
		$this->db->select('SQL_CALC_FOUND_ROWS 
						   CASE WHEN Cliente_Ordem IS NULL THEN 0 ELSE 1 END AS Cliente_Order,
						   Cliente_Id, Cliente_Nome, Cliente_DataCadastro, Cliente_Ordem, Cliente_Imagem, Cliente_Status', FALSE);
		$query = $this->db->get('tabclientes', $per_page, $offset);
		//echo $this->db->last_query();
		//exit();
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

		$data['Cliente_DataCadastro'] = date("Y-m-d H:i:s");
		$data['Cliente_DataAlteracao'] = date("Y-m-d H:i:s");
		//print_r($data);
		//exit();

		if($this->db->insert('tabclientes', $data)){
			$ClienteId = $this->db->insert_id();
			return array('insert_id'	=> $ClienteId);
		}
		else{
			#echo $this->db->last_query();
			#exit();
			return array('error'	=> $this->db->_error_number());
		}
	}
	
	public function alterar($data) {		

		$data['Cliente_DataAlteracao'] = date("Y-m-d H:i:s");

		$this->db->where('Cliente_Id', $data['Cliente_Id']);
		//print_r($data);
		//exit();
		$this->db->update('tabclientes', $data);
		if(!$this->db->_error_number()){
			return array('num_rows'	=> $this->db->affected_rows());
		}
		else{
			return array('error'	=> $this->db->_error_number());
		}
	}

	public function remover($data) {
		$num_rows = $error = 0;
		foreach ($data['Cliente_Id'] as $k => $v){
			$this->db->where('Cliente_Id', $v);

			$dataE['Cliente_DataExcluido'] = date("Y-m-d H:i:s");
			$dataE['Cliente_Excluido'] = 1;

			$this->db->update('tabclientes', $dataE);
			if($this->db->affected_rows() == 1) $num_rows++;
			else $error++;
			
			//$this->removerImagens($v);
		}
		if($error == 0){
			return array('num_rows'	=> $num_rows);
		}
		else{
			return array('error'	=> $error);
		}
	}
	
	public function removerImagens($id) {
		$this->db->select('ClienteImagem_Id, Cliente_Id');
		$this->db->where('Cliente_Id', $id);
		$query = $this->db->get('tabclientes_imagens');
		if($query->num_rows() > 0){
			$result = $query->result_array();
			foreach($result as $k => $v) {
				$this->removerImagemPorId($v['ClienteImagem_Id'], $v['Cliente_Id']);
			}
		}
	}
	
	public function getImagens($id){
		$this->db->where('Cliente_Id', intval($id));
		$this->db->order_by('ClienteImagem_Ordem', 'ASC');
		$query = $this->db->get('tabclientes_imagens');
		if($query->num_rows() > 0){
			$result =  $query->result_array();
			return $result;
		}
		else return false;
	}
	
	public function inserirImagem($data){
		if($this->db->insert('tabclientes_imagens', $data)){
			$ClienteImagemId = $this->db->insert_id();
			
			$this->atualizaImagemPrincipal($data['Cliente_Id']);
			
			return array('insert_id'	=> $ClienteImagemId);
		}
		else{
			return array('error'	=> $this->db->_error_number());
		}
	}
	
	public function removerImagem($file){
		$this->db->select('ClienteImagem_Id, Cliente_Id');
		$this->db->where('ClienteImagem_Imagem', '/'.$file);
		$query = $this->db->get('tabclientes_imagens');
		if($query->num_rows() > 0){
			$result = $query->result_array();
			$ClienteId = $result[0]['Cliente_Id'];
			$ClienteImagemId = $result[0]['ClienteImagem_Id'];
			
			return $this->removerImagemPorId($ClienteImagemId, $ClienteId);
		}
	}
	
	public function removerImagemPorId($ClienteImagemId, $ClienteId) {
		$this->db->select('ClienteImagem_Imagem');
		$this->db->where('ClienteImagem_Id', $ClienteImagemId);
		$query = $this->db->get('tabclientes_imagens');
		if($query->num_rows() > 0){
			$result = $query->result_array();
			$file = $result[0]['ClienteImagem_Imagem'];
		}
		
		$this->db->where('ClienteImagem_Id', $ClienteImagemId);
		$this->db->delete('tabclientes_imagens');

		if($this->db->affected_rows() == 1){
			
			$this->atualizaImagemPrincipal($ClienteId);

			if (file_exists($_SERVER['DOCUMENT_ROOT'].$file)) {
				unlink($_SERVER['DOCUMENT_ROOT'].$file);
			}
			
			return array('num_rows'	=> 1);
		}	
		else{
			return array('error'	=> 1);
		}		
	}
	
	public function ordenarImagem($id, $imgId, $imgOrdem){
		$data = array('ClienteImagem_Ordem' => $imgOrdem);
		
		$this->db->where('Cliente_Id', $id);
		$this->db->where('ClienteImagem_Id', $imgId);
		$this->db->update('tabclientes_imagens', $data);
		#echo $this->db->last_query();
		if(!$this->db->_error_number()){
			$this->atualizaImagemPrincipal($id);
			return array('num_rows'	=> $this->db->affected_rows());
		}
		else{
			return array('error'	=> $this->db->_error_number());
		}
	}
	
	public function atualizaImagemPrincipal($id) {
		
		$this->db->select('tabclientes_imagens.ClienteImagem_Imagem, (CASE WHEN tabclientes_imagens.ClienteImagem_Ordem IS NULL THEN 1 ELSE 0 END) AS ClienteImagem_Order', FALSE);
		$this->db->from('tabclientes_imagens');
		$this->db->where('Cliente_Id', $id);
		$this->db->order_by('ClienteImagem_Order', 'asc');
		$this->db->order_by('ClienteImagem_Ordem', 'asc');
		$this->db->order_by('ClienteImagem_Id', 'desc');
		$this->db->limit(1);
		$query = $this->db->get();
		#echo $this->db->last_query();
		$Imagem = '';
		if($query->num_rows() > 0){
			$result =  $query->result_array();
		
			$Imagem = $result[0]['ClienteImagem_Imagem'];
		}
		
		$data['Cliente_Imagem'] = $Imagem;
		$this->db->where('Cliente_Id', $id);
		$this->db->update('tabclientes', $data);			
	}

	public function removerArquivo($file){
		$this->db->where('Cliente_Imagem', '/'.$file);
		$this->db->set('Cliente_Imagem', '');
		$this->db->update('tabclientes');
		if($this->db->affected_rows() == 1){
			return array('num_rows'	=> 1);
		}
		else{
			return array('error'	=> 1);
		}
	}
}

/* End of file Clientes_m.php */
/* Location: ./application/models/clientes_m.php */