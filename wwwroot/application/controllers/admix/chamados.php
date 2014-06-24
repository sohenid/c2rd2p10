<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Chamados extends Admix_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('chamados_m', 'chamados');
        $this->load->library('permissoes_lib');
        $this->load->helper('text');

        $this->permissoes_lib->validaPermissao($this->router->class, $this->router->method, $this->session->userdata('varUsuario_Id'));
    }

    public function index() {
        /* paginacao */
        $this->load->helper('pagination_helper');

        if ($this->input->get('print'))
            $print = true;
        else
            $print = false;

        // Campos que vão vir da pesquisa
        $b = array('id', 'device_id', 'data_insert');
        foreach ($b as $k => $v) {
            $b[$v] = prep_for_form($this->input->get($v, true));
        }

        /* capturo o QUERY_STRING e limpo a paginacao e ordenação */
        parse_str($_SERVER['QUERY_STRING'], $qs);
        $qs_ord = $qs;
        unset($qs_ord['ord_campo']);
        unset($qs_ord['ord_tipo']);
        unset($qs_ord['p']);
        $base_url_order = '/admix/' . $this->router->fetch_class() . '/?' . http_build_query($qs_ord);

        /* ordenação padrão */
        $ord['ord_campo'] = ($this->input->get('ord_campo', true)) ? prep_for_form($this->input->get('ord_campo', true)) : 'id';
        $ord['ord_tipo'] = ($this->input->get('ord_tipo', true)) ? prep_for_form($this->input->get('ord_tipo', true)) : 'DESC';
        /* fim da ordenação */

        // Captura campos para busca
        $q = array();
        if ($b['id'])
            $q['where']['id'] = $b['id'];
        // if($b['status'] != '') $q['where']['Noticia_Status'] = $b['Noticia_Status'];
        if ($b['device_id'])
            $q['like']['device_id'] = $b['device_id'];
        if ($b['data_insert'])
            $q['where']['data_insert >='] = $b['data_insert'];

        unset($qs['p']);

        $base_url = '/admix/' . $this->router->fetch_class() . '/?' . http_build_query($qs);
        $per_page = ($print) ? 1000 : 20;
        $offset = ($print) ? 0 : intval($this->input->get('p'));
        $d = $this->chamados->getChamados($q, $ord, $per_page, $offset);

        /* paginacao */
        $total_rows = $d['count'];
        $paginacao = bspaginacao($base_url, $per_page, $total_rows);
        $nav_paginacao = '<div class="nav-paginacao">' . ($offset + 1) . ' até ' . ($offset + count($d['result'])) . ' de ' . $total_rows . '</div>';

        if ($q)
            $busca = true;
        else
            $busca = false;

        $dados = array(
            'acao' => 'Gerenciar',
            'result' => $d['result'],
            'b' => $b,
            'busca' => $busca,
            'paginacao' => $paginacao,
            'nav_paginacao' => $nav_paginacao,
            'base_url_order' => $base_url_order,
            'ord_campo' => $ord['ord_campo'],
            'ord_tipo' => $ord['ord_tipo'],
            'remover' => FALSE
        );
        $this->setPagina($this->router->fetch_class() . '/chamados.tpl', $dados);
    }

    public function alterar($id = NULL) {
        if (!isset($id))
            redirect('/admix/' . $this->router->fetch_class());

        $q = array();
        $q['where']['id'] = $id;

        $d = $this->chamados->getChamados($q);
        $resposta = $d['result'][0];
        $errors = $this->session->flashdata('form_errors') ? $this->session->flashdata('form_errors') : array();
        $dados = array('acao' => 'Alterar',
            'action' => '/admix/' . $this->router->fetch_class() . '/' . $this->router->fetch_method() . 'Post');

        $campos = array('id', 'device_id', 'data_insert', 'status');
        foreach ($campos as $k) {
            $v[$k] = (array_key_exists($k, $resposta)) ? $resposta[$k] : '';
            $e[$k] = (array_key_exists($k, $errors)) ? $errors[$k] : '';
        }

        $resposta = array('v' => $v);
        $errors = array('e' => $e);
        $dados = array_merge($dados, $resposta, $errors);

        $this->setPagina($this->router->fetch_class() . '/chamado-form.tpl', $dados);
    }

    public function alterarPost() {
        $url_retorno = urldecode($this->input->post('url_retorno', true));

        // Validação
        $this->load->library('form_validation');
        $this->form_validation->set_rules('id', 'ID', 'required|integer|trim');
        $this->form_validation->set_rules('device_id', 'Device ID', 'required|integer|trim');
        $this->form_validation->set_rules('status', 'Status', 'required|trim');
        $this->form_validation->set_error_delimiters('', '');

        $data['id'] = intval($this->input->post('id', true));
        $data['device_id'] = prep_for_form($this->input->post('device_id', true));
        $data['status'] = $this->input->post('status', true);
        $data['data_update'] = date('Y-m-d H:i:s');

        /* armazeno os dados para retorno */
        $this->session->set_flashdata('form_resposta', $data);

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('form_errors', $this->form_validation->error_array());
            redirect('/admix/' . $this->router->fetch_class() . '/alterar/' . $data['id'] . '/' . $url_retorno);
        }
        else {
            $result = $this->chamados->alterar($data);
            if (!(isset($result['error']))) {
                $msn['sucesso'] = 'Dados alterados com sucesso. (' . $result['num_rows'] . ')';
                $this->session->set_flashdata('malerta', $msn);
                redirect('/admix/' . $this->router->fetch_class() . '/' . $url_retorno);
            }
            else {
                $msn['erro'] = 'Os dados não puderam ser alterados. (' . $result['error'] . ')';
                $this->session->set_flashdata('malerta', $msn);
                redirect('/admix/' . $this->router->fetch_class() . '/alterar/' . $data['Noticia_Id'] . '/' . $url_retorno);
            }
        }
    }

    public function remover($id = NULL) {
        if (!$id) {
            $id = $this->input->post('ids');
        }
        if (!$id) {
            $msn['alerta'] = 'Você não possui nenhum item para ser removido.';
            $this->session->set_flashdata('malerta', $msn);
            redirect('/admix/' . $this->router->fetch_class());
        }

        $base_url_order = '/' . $this->router->fetch_class();

        /* ordenação */
        $ord['ord_campo'] = ($this->input->get_post('ord_campo', true)) ? prep_for_form($this->input->get_post('ord_campo', true)) : 'id';
        $ord['ord_tipo'] = ($this->input->get_post('ord_tipo', true)) ? prep_for_form($this->input->get_post('ord_tipo', true)) : 'desc';
        /* fim da ordenação */

        $q = array();
        $q['where_in']['id'] = $id;
        $d = $this->chamados->getChamados($q, $ord);
        if (!$d['result']) {
            $msn['alerta'] = 'Nenhum item foi encontrado.';
            $this->session->set_flashdata('malerta', $msn);
            redirect('/admix/' . $this->router->fetch_class());
        }

        $dados = array(
            'acao' => 'Remover',
            'result' => $d['result'],
            'base_url_order' => $base_url_order,
            'ord_campo' => $ord['ord_campo'],
            'ord_tipo' => $ord['ord_tipo'],
            'remover' => TRUE
        );

        $this->setPagina($this->router->fetch_class() . '/chamados.tpl', $dados);
    }

    public function removerPost() {
        $url_retorno = urldecode($this->input->post('url_retorno', TRUE));
        $data['id'] = $this->input->post('ids', TRUE);

        $result = $this->chamados->remover($data);
        if (!(isset($result['error']))) {
            $msn['sucesso'] = 'Dados removidos com sucesso. (' . $result['num_rows'] . ')';
            $this->session->set_flashdata('malerta', $msn);
            redirect('/admix/' . $this->router->fetch_class() . '/' . $url_retorno);
        }
        else {
            $msn['erro'] = 'Os dados não puderam ser removidos. (' . $result['error'] . ')';
            $this->session->set_flashdata('malerta', $msn);
            redirect('/admix/' . $this->router->fetch_class() . '/' . $url_retorno);
        }
    }

}
