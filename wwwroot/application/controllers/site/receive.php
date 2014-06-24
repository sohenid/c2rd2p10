<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Receive extends Site_Controller {

    public function __construct() {
        parent::__construct();
        #parse_str($_SERVER['QUERY_STRING'], $_GET);
    }

    public function Index() {
        
    }

    public function SetChamado() {

        if ($this->input->post('device_id', true) != null) {

            $data = array(
                'device_id' => $this->input->post('device_id', true),
                'data_insert' => date("Y-m-d H:i:s")
            );

            if ($this->db->insert('chamado', $data)) {
                echo 'Garçom avisado! Aguarde o atendimento.';
            }
            else {
                echo 'Não foi possível chamar o Garçom! Tente novamente mais tarde.';
            }
        }
        else {
            echo 'Não foi possível chamar o Garçom! Tente novamente mais tarde.';
        }
    }

}

/* End of file receive.php */
/* Location: ./application/controllers/receive.php */