<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Noticias_m extends CI_Model{

	public function getNoticias($q, $ord = NULL, $per_page = NULL, $offset = NULL){
		
		if(isset($q['where'])) $this->db->where($q['where']);
		if(isset($q['where_in'])){
			$array_indice = array_keys($q['where_in']);
			$indice = $array_indice[0];
			$this->db->where_in($indice, $q['where_in'][$indice]);
		}
		if(isset($q['like'])) $this->db->like($q['like']);
		$this->db->order_by('Noticia_Order DESC, Noticia_Ordem ASC');
		if($ord) $this->db->order_by($ord['ord_campo'].' '.$ord['ord_tipo']);
		
		$this->db->where('Noticia_Excluido', 0);
		$this->db->select('SQL_CALC_FOUND_ROWS 
						   CASE WHEN Noticia_Ordem IS NULL THEN 0 ELSE 1 END AS Noticia_Order,
						   Noticia_Id, Noticia_Status, Noticia_Nome, Noticia_Data, Noticia_Descricao, Noticia_Link, Noticia_Url, Noticia_Canonical, Noticia_Ordem', FALSE);
		$query = $this->db->get('tabnoticias', $per_page, $offset);
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
		if($this->db->insert('tabnoticias', $data)){
			$noticiaId = $this->db->insert_id();
			return array('insert_id'	=> $noticiaId);
		}
		else{
			return array('error'	=> $this->db->_error_number());
		}
	}
	
	public function alterar($data) {
		$this->db->where('Noticia_Id', $data['Noticia_Id']);
		$this->db->update('tabnoticias', $data);
		if(!$this->db->_error_number()){
			return array('num_rows'	=> $this->db->affected_rows());
		}
		else{
			return array('error'	=> $this->db->_error_number());
		}
	}

	public function remover($data) {
		$num_rows = $error = 0;
		foreach ($data['Noticia_Id'] as $k => $v){
			$this->db->where('Noticia_Id', $v);
			$this->db->update('tabnoticias', array(
					'Noticia_Excluido'		=> 1,
					'Noticia_DataExcluido'	=> date('Y-m-d H:i:s')
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
	
	public function removerImagens($id) {
		$this->db->select('NoticiaImagem_Id, Noticia_Id');
		$this->db->where('Noticia_Id', $id);
		$query = $this->db->get('tabnoticias_imagens');
		if($query->num_rows() > 0){
			$result = $query->result_array();
			foreach($result as $k => $v) {
				$this->removerImagemPorId($v['NoticiaImagem_Id'], $v['Noticia_Id']);
			}
		}
	}
	
	public function getImagens($id){
		$this->db->select('tabnoticias_imagens.*, (CASE WHEN tabnoticias_imagens.NoticiaImagem_Ordem IS NULL THEN 1 ELSE 0 END) AS NoticiaImagem_Order', FALSE);
		$this->db->from('tabnoticias_imagens');
		$this->db->where('Noticia_Id', $id);
		$this->db->order_by('NoticiaImagem_Order', 'asc');
		$this->db->order_by('NoticiaImagem_Ordem', 'asc');
		$this->db->order_by('NoticiaImagem_Id', 'desc');
		$query = $this->db->get();		
		#exit($this->db->last_query());
		#$this->db->where('Noticia_Id', intval($id));
		#$this->db->order_by('NoticiaImagem_Ordem', 'ASC');
		#$query = $this->db->get('tabnoticias_imagens');
		if($query->num_rows() > 0){
			$result =  $query->result_array();
			return $result;
		}
		else return false;
	}
	
	public function inserirImagem($data){
		if($this->db->insert('tabnoticias_imagens', $data)){
			$noticiaImagemId = $this->db->insert_id();
			
			$this->atualizaImagemPrincipal($data['Noticia_Id']);
			
			return array('insert_id'	=> $noticiaImagemId);
		}
		else{
			return array('error'	=> $this->db->_error_number());
		}
	}
	
	public function removerImagem($file){
		$this->db->select('NoticiaImagem_Id, Noticia_Id');
		$this->db->where('NoticiaImagem_Imagem', '/'.$file);
		$query = $this->db->get('tabnoticias_imagens');
		if($query->num_rows() > 0){
			$result = $query->result_array();
			$noticiaId = $result[0]['Noticia_Id'];
			$noticiaImagemId = $result[0]['NoticiaImagem_Id'];
			
			return $this->removerImagemPorId($noticiaImagemId, $noticiaId);
		}
	}
	
	public function removerImagemPorId($noticiaImagemId, $noticiaId) {
		$this->db->select('NoticiaImagem_Imagem');
		$this->db->where('NoticiaImagem_Id', $noticiaImagemId);
		$query = $this->db->get('tabnoticias_imagens');
		if($query->num_rows() > 0){
			$result = $query->result_array();
			$file = $result[0]['NoticiaImagem_Imagem'];
		}
		
		$this->db->where('NoticiaImagem_Id', $noticiaImagemId);
		$this->db->delete('tabnoticias_imagens');

		if($this->db->affected_rows() == 1){
			
			$this->atualizaImagemPrincipal($noticiaId);

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
		$data = array('NoticiaImagem_Ordem' => $imgOrdem);
		
		$this->db->where('Noticia_Id', $id);
		$this->db->where('NoticiaImagem_Id', $imgId);
		$this->db->update('tabnoticias_imagens', $data);
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
		
		$this->db->select('tabnoticias_imagens.NoticiaImagem_Imagem, (CASE WHEN tabnoticias_imagens.NoticiaImagem_Ordem IS NULL THEN 1 ELSE 0 END) AS NoticiaImagem_Order', FALSE);
		$this->db->from('tabnoticias_imagens');
		$this->db->where('Noticia_Id', $id);
		$this->db->order_by('NoticiaImagem_Order', 'asc');
		$this->db->order_by('NoticiaImagem_Ordem', 'asc');
		$this->db->order_by('NoticiaImagem_Id', 'desc');
		$this->db->limit(1);
		$query = $this->db->get();
		#echo $this->db->last_query();
		$Imagem = '';
		if($query->num_rows() > 0){
			$result =  $query->result_array();
		
			$Imagem = $result[0]['NoticiaImagem_Imagem'];
		}
		
		$data['Noticia_Imagem'] = $Imagem;
		$this->db->where('Noticia_Id', $id);
		$this->db->update('tabnoticias', $data);			
	}
}

/* End of file noticias_m.php */
/* Location: ./application/models/noticias_m.php */