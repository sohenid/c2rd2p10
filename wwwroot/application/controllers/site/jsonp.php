<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Jsonp extends Site_Controller {

    public function __construct() {
        parent::__construct();
        parse_str($_SERVER['QUERY_STRING'], $_GET);
    }

    public function Index() {
        
    }

    public function CategoriasUpdates() {

        header('Content-type: application/json');

        $params = $this->uri->uri_to_assoc();

        if (!array_key_exists('id', $params) || $params['id'] == '0') {
            $query = $this->db->query("SELECT * FROM categoria ORDER BY id ASC");
        }
        else {
            if (!array_key_exists('data_update', $params) || $params['data_update'] == '0') {
                $sql = sprintf("SELECT * FROM categoria WHERE id <= '%s' AND data_update IS NOT NULL ORDER BY data_update ASC", $params['id']);
                $query = $this->db->query($sql);
            }
            else {
                $sql = sprintf("SELECT * FROM categoria WHERE id <= '%s' AND data_update > '%s' ORDER BY data_update ASC", $params['id'], str_replace('%20', ' ', $params['data_update']));
                $query = $this->db->query($sql);
            }
        }

        $jsonp_records = array();

        foreach ($query->result() as $row) {
            $jsonp_records[] = $row;
        }

        echo @$_GET['jsoncallback'] . '(' . json_encode($jsonp_records) . ');';
    }

    public function CategoriasNews() {

        header('Content-type: application/json');

        $params = $this->uri->uri_to_assoc();

        $jsonp_records = array();

        if (array_key_exists('id', $params) && $params['id'] != '0') {
            $sql = sprintf("SELECT * FROM categoria WHERE id > '%s' ORDER BY id ASC", $params['id']);
            $query = $this->db->query($sql);
            foreach ($query->result() as $row) {
                $jsonp_records[] = $row;
            }
        }

        echo @$_GET['jsoncallback'] . '(' . json_encode($jsonp_records) . ');';
    }

    public function ProdutosUpdates() {

        header('Content-type: application/json');

        $params = $this->uri->uri_to_assoc();

        $jsonp_records = array();

        if (!array_key_exists('id', $params) || $params['id'] == '0') {
            $query = $this->db->query("SELECT * FROM produto ORDER BY id ASC");
        }
        else {
            if (!array_key_exists('data_update', $params) || $params['data_update'] == '0') {
                $sql = sprintf("SELECT * FROM produto WHERE id <= '%s' AND data_update IS NOT NULL ORDER BY data_update ASC", $params['id']);
                $query = $this->db->query($sql);
            }
            else {
                $sql = sprintf("SELECT * FROM produto WHERE id <= '%s' AND data_update > '%s' ORDER BY data_update ASC", $params['id'], str_replace('%20', ' ', $params['data_update']));
                $query = $this->db->query($sql);
            }
        }


        foreach ($query->result() as $row) {
            $jsonp_records[] = $row;
        }

        echo @$_GET['jsoncallback'] . '(' . json_encode($jsonp_records) . ');';
    }

    public function ProdutosNews() {

        header('Content-type: application/json');

        $params = $this->uri->uri_to_assoc();

        $jsonp_records = array();

        if (array_key_exists('id', $params) && $params['id'] != '0') {
            $sql = sprintf("SELECT * FROM produto WHERE id > '%s' ORDER BY id ASC", $params['id']);
            $query = $this->db->query($sql);
            foreach ($query->result() as $row) {
                $jsonp_records[] = $row;
            }
        }

        echo @$_GET['jsoncallback'] . '(' . json_encode($jsonp_records) . ');';
    }

}

/* End of file jsonp.php */
/* Location: ./application/controllers/jsonp.php */