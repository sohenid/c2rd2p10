<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Banners_m extends CI_Model{

	public function getBanners($q, $ord = NULL, $per_page = NULL, $offset = NULL){
		
		if(isset($q['where'])) $this->db->where($q['where']);
		if(isset($q['where_in'])){
			$array_indice = array_keys($q['where_in']);
			$indice = $array_indice[0];
			$this->db->where_in($indice, $q['where_in'][$indice]);
		}
		if(isset($q['like'])) $this->db->like($q['like']);
		$this->db->join('tabbanners_localizacao', 'tabbanners_localizacao.BannerLocalizacao_Id = tabbanners.Banner_Localizacao', 'LEFT');
		$this->db->order_by('Banner_Order DESC, Banner_Ordem ASC');
		if($ord) $this->db->order_by($ord['ord_campo'], $ord['ord_tipo']);
		
		$this->db->where('Banner_Excluido', 0);
		$this->db->select('SQL_CALC_FOUND_ROWS 
						   CASE WHEN Banner_Ordem IS NULL THEN 0 ELSE 1 END AS Banner_Order,
						   Banner_Id, Banner_Nome, Banner_Localizacao, Banner_DataInicial, Banner_DataFinal, 
						   Banner_Status, BannerLocalizacao_Largura, BannerLocalizacao_Altura, BannerLocalizacao_Nome,
						   Banner_Arquivo, Banner_Link, Banner_Tipo, Banner_Script, Banner_Conteudo, Banner_Ordem', FALSE);
		$query = $this->db->get('tabbanners', $per_page, $offset);
		#echo $this->db->last_query();
		
		$qp = $this->db->query('SELECT FOUND_ROWS() AS COUNT');
		$data['count'] = $qp->row()->COUNT;
		
		if($query && ($query->num_rows() > 0)){
			$data['result'] = $query->result_array();
			return $data;
		}
		else return false;
	}
	
	public function inserir($data){
		if($this->db->insert('tabbanners', $data)){
			$bannerId = $this->db->insert_id();
			return array('insert_id'	=> $bannerId);
		}
		else{
			return array('error'	=> $this->db->_error_number());
		}
	}
	
	public function alterar($data) {
		$this->db->where('Banner_Id', $data['Banner_Id']);
		$this->db->update('tabbanners', $data);
		if(!$this->db->_error_number()){
			return array('num_rows'	=> $this->db->affected_rows());
		}
		else{
			return array('error'	=> $this->db->_error_number());
		}
	}

	public function remover($data) {
		$num_rows = $error = 0;
		foreach ($data['Banner_Id'] as $k => $v){
			$this->db->where('Banner_Id', $v);
			$this->db->update('tabbanners', array(
					'Banner_Excluido'		=> 1,
					'Banner_DataExcluido'	=> date('Y-m-d H:i:s')
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
	
	public function removerArquivo($file){
		$this->db->where('Banner_Arquivo', '/'.$file);
		$this->db->set('Banner_Arquivo', '');
		$this->db->update('tabbanners');
		if($this->db->affected_rows() == 1){
			return array('num_rows'	=> 1);
		}
		else{
			return array('error'	=> 1);
		}
	}
	
	public function getBannersLocalizacao(){
		$query = $this->db->get('tabbanners_localizacao');
		if($query->num_rows() > 0){
			$result =  $query->result_array();
			return $result;
		}
	}
	
	public function getBannersPorLocalizacao($localizacao, $qtd = NULL){
		$this->db->where('Banner_Status', 1);
		$this->db->where('Banner_Excluido', 0);
		$this->db->where('Banner_Localizacao', $localizacao);
		$this->db->where('Banner_DataInicial <=', date('Y-m-d'));
		$this->db->where('Banner_DataFinal >=', date('Y-m-d'));
		$this->db->or_where('Banner_DataFinal IS NULL', NULL, FALSE);
		$this->db->join('tabbanners_localizacao', 'tabbanners_localizacao.BannerLocalizacao_Id = tabbanners.Banner_Localizacao', 'INNER');
		$this->db->select('Banner_Id, Banner_Nome, Banner_Tipo, Banner_Link, Banner_Target, Banner_Arquivo, Banner_Script, BannerLocalizacao_Largura AS Banner_Largura, BannerLocalizacao_Altura AS Banner_Altura, Banner_Conteudo');
		$this->db->order_by('RAND()');
		$query = $this->db->get('tabbanners', $qtd);
		#echo $this->db->last_query();
		
		if($query && ($query->num_rows() > 0)){
			$data['result'] = $query->result_array();
			return $data;
		}
		else return false;	
	}
	
}

/* End of file permissoes_m.php */
/* Location: ./application/models/banners_m.php */