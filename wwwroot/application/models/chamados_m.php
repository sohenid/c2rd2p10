<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Chamados_m extends CI_Model {

    public function getChamados($q, $ord = NULL, $per_page = NULL, $offset = NULL) {
        if (isset($q['where'])) {
            $this->db->where($q['where']);
        }
        if (isset($q['where_in'])) {
            $array_indice = array_keys($q['where_in']);
            $indice = $array_indice[0];
            $this->db->where_in($indice, $q['where_in'][$indice]);
        }
        if (isset($q['like'])) {
            $this->db->like($q['like']);
        }
        if ($ord) {
            $this->db->order_by($ord['ord_campo'] . ' ' . $ord['ord_tipo']);
        }

        $this->db->order_by('id DESC');

        $this->db->where('status', '1');

        $this->db->select('SQL_CALC_FOUND_ROWS id, device_id, data_insert', FALSE);
        $query = $this->db->get('chamado', $per_page, $offset);
        #echo $this->db->last_query();

        $qp = $this->db->query('SELECT FOUND_ROWS() AS COUNT');
        $data['count'] = $qp->row()->COUNT;

        if ($query && ($query->num_rows() > 0)) {
            $data['result'] = $query->result_array();
            return $data;
        }
        else {
            return false;
        }
    }

    public function alterar($data) {
        $this->db->where('id', $data['id']);
        $this->db->update('chamado', $data);
        if (!$this->db->_error_number()) {
            return array('num_rows' => $this->db->affected_rows());
        }
        else {
            return array('error' => $this->db->_error_number());
        }
    }

    public function remover($data) {
        $num_rows = $error = 0;
        foreach ($data['id'] as $k => $v) {
            $this->db->where('id', $v);
            $this->db->update('chamado', array(
                'status' => '0',
                'data_update' => date('Y-m-d H:i:s')
            ));
            if ($this->db->affected_rows() == 1)
                $num_rows++;
            else
                $error++;
        }
        if ($error == 0) {
            return array('num_rows' => $num_rows);
        }
        else {
            return array('error' => $error);
        }
    }

}

/* End of file categorias_m.php */
/* Location: ./application/models/categorias_m.php */