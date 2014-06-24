<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Produtos extends Admix_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('produtos_m', 'produtos');
        $this->load->model('categorias_m', 'categorias');
        $this->load->helper('upload_helper');
        $this->load->helper('image_helper');
        $this->load->library('permissoes_lib');
        $this->load->helper('text');

        $this->permissoes_lib->validaPermissao($this->router->class, $this->router->method, $this->session->userdata('varUsuario_Id'));
    }

    public function index() {

        $this->load->helper('pagination_helper');

        if ($this->input->get('print'))
            $print = true;
        else
            $print = false;

        $b = array('id', 'categoria_id', 'descricao', 'preco', 'imagem', 'status', 'data_insert', 'data_update');

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

        /* ordenação */
        $ord['ord_campo'] = ($this->input->get('ord_campo', true)) ? prep_for_form($this->input->get('ord_campo', true)) : 'descricao';
        $ord['ord_tipo'] = ($this->input->get('ord_tipo', true)) ? prep_for_form($this->input->get('ord_tipo', true)) : 'asc';
        /* fim da ordenação */

        // Busca
        $q = array();
        if ($b['id']) {
            $q['where']['id'] = $b['id'];
        }
        if ($b['categoria_id'] != '') {
            $q['where']['categoria_id'] = $b['categoria_id'];
        }
        if ($b['status'] != '') {
            $q['where']['status'] = $b['status'];
        }
        if ($b['descricao']) {
            $q['like']['descricao'] = $b['descricao'];
        }
        if ($b['data_insert']) {
            $q['where']['data_insert >='] = $b['data_insert'];
        }

        unset($qs['p']);

        $base_url = '/admix/' . $this->router->fetch_class() . '/?' . http_build_query($qs);
        $per_page = ($print) ? 1000 : 20;
        $offset = ($print) ? 0 : intval($this->input->get('p'));
        $d = $this->produtos->getProdutos($q, $ord, $per_page, $offset);

        //Categorias
        $q2['where']['status'] = '1';
        $ord2 = array('ord_campo' => 'descricao', 'ord_tipo' => 'asc');
        $d2 = $this->categorias->getCategorias($q2, $ord2);
        $categorias = $d2['result'];

        /* paginacao */
        $total_rows = $d['count'];
        $paginacao = bspaginacao($base_url, $per_page, $total_rows);
        $nav_paginacao = '<div class="nav-paginacao">' . ($offset + 1) . ' até ' . ($offset + count($d['result'])) . ' de ' . $total_rows . '</div>';

        if ($q) {
            $busca = true;
        }
        else {
            $busca = false;
        }

        $dados = array(
            'acao' => 'Gerenciar',
            'result' => $d['result'],
            'b' => $b,
            'busca' => $busca,
            'categorias' => $categorias,
            'paginacao' => $paginacao,
            'nav_paginacao' => $nav_paginacao,
            'base_url_order' => $base_url_order,
            'ord_campo' => $ord['ord_campo'],
            'ord_tipo' => $ord['ord_tipo'],
            'remover' => FALSE
        );
        $this->setPagina($this->router->fetch_class() . '/produtos.tpl', $dados);
    }

    public function inserir() {

        $resposta = $this->session->flashdata('form_resposta') ? $this->session->flashdata('form_resposta') : array();
        $errors = $this->session->flashdata('form_errors') ? $this->session->flashdata('form_errors') : array();
        $dados = array('acao' => 'Inserir',
            'action' => '/admix/' . $this->router->fetch_class() . '/' . $this->router->fetch_method() . 'Post');

        $campos = array('id', 'categoria_id', 'descricao', 'preco', 'imagem', 'status', 'data_insert', 'data_update');

        foreach ($campos as $k) {
            $v[$k] = (array_key_exists($k, $resposta)) ? $resposta[$k] : '';
            $e[$k] = (array_key_exists($k, $errors)) ? $errors[$k] : '';
        }

        $q2['where']['status'] = '1';
        $ord2 = array('ord_campo' => 'descricao', 'ord_tipo' => '');
        $d2 = $this->categorias->getCategorias($q2, $ord2);
        $categorias['categorias'] = $d2['result'];

        $resposta = array('v' => $v);
        $errors = array('e' => $e);

        $dados = array_merge($dados, $resposta, $errors, $categorias);

        $this->setPagina($this->router->fetch_class() . '/produto-form.tpl', $dados);
    }

    public function inserirPost() {

        $url_retorno = urldecode($this->input->post('url_retorno'));

        $this->load->library('form_validation');
        $this->form_validation->set_rules('categoria_id', 'Categoria', 'required|trim');
        $this->form_validation->set_rules('descricao', 'Descrição', 'required|trim');
        $this->form_validation->set_rules('preco', 'Preço', 'required|trim');
        $this->form_validation->set_error_delimiters('', '');

        $data['status'] = prep_for_form($this->input->post('status', true));
        $data['categoria_id'] = prep_for_form($this->input->post('categoria_id', true));
        $data['descricao'] = prep_for_form($this->input->post('descricao', true));
        $data['preco'] = prep_for_form($this->input->post('preco', true));
        $data['preco'] = str_replace('.', '', $data['preco']);
        $data['preco'] = str_replace(',', '.', $data['preco']);

        /* armazeno os dados para retorno */

        $this->session->set_flashdata('form_resposta', $data);

        $upload_errors = FALSE;
        $upload = mixdUpload('imagem', '/media/produtos/', $data['descricao'], NULL, FALSE);
        if ($upload) {
            if (!(isset($upload['error']))) {
                $data['imagem'] = $upload['file_name'];
                // Converte a imagem em base 64
                $upload_image_directory = getcwd() . $upload['file_name'];
                $data['imagem_base_64'] = mixdBase64EncodeImage($upload_image_directory, mixdGetUploadedImageSmallExtension($upload['file_type']));
            }
            else {
                $upload_errors = TRUE;
            }
        }

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('form_errors', $this->form_validation->error_array());
            redirect('/admix/' . $this->router->fetch_class() . '/inserir' . '/' . $url_retorno);
        }
        else {
            $result = $this->produtos->inserir($data);
            if (!(isset($result['error']))) {
                $msn['sucesso'] = 'Dados cadastrados com sucesso. (' . $result['insert_id'] . ')';
                $this->session->set_flashdata('malerta', $msn);
                redirect('/admix/' . $this->router->fetch_class() . '/' . $url_retorno);
            }
            else {
                $msn['erro'] = 'Os dados não puderam ser cadastrados. (' . $result['error'] . ')';
                $this->session->set_flashdata('malerta', $msn);
                redirect('/admix/' . $this->router->fetch_class() . '/inserir' . '/' . $url_retorno);
            }
        }
    }

    public function alterar($id = NULL) {

        if (!isset($id))
            redirect('/admix/' . $this->router->fetch_class());

        $q = array();
        $q['where']['id'] = $id;
        $d = $this->produtos->getProdutos($q);
        $resposta = $d['result'][0];

        $errors = $this->session->flashdata('form_errors') ? $this->session->flashdata('form_errors') : array();
        $dados = array('acao' => 'Alterar',
            'action' => '/admix/' . $this->router->fetch_class() . '/' . $this->router->fetch_method() . 'Post');

        $campos = array('id', 'categoria_id', 'descricao', 'preco', 'imagem', 'status', 'data_insert', 'data_update');

        foreach ($campos as $k) {
            $v[$k] = (array_key_exists($k, $resposta)) ? $resposta[$k] : '';
            $e[$k] = (array_key_exists($k, $errors)) ? $errors[$k] : '';
        }

        //Categorias
        $q2['where']['status'] = '1';
        $ord2 = array('ord_campo' => 'descricao', 'ord_tipo' => 'asc');
        $d2 = $this->categorias->getCategorias($q2, $ord2);
        $categorias['categorias'] = $d2['result'];

        $resposta = array('v' => $v);
        $errors = array('e' => $e);
        $dados = array_merge($dados, $resposta, $errors, $categorias);

        $this->setPagina($this->router->fetch_class() . '/produto-form.tpl', $dados);
    }

    public function alterarPost() {
        $url_retorno = urldecode($this->input->post('url_retorno', true));

        // VALIDATION RULES
        $this->load->library('form_validation');
        $this->form_validation->set_rules('status', 'Status', 'required|trim');
        $this->form_validation->set_rules('categoria_id', 'categoria', 'required|integer|trim');
        $this->form_validation->set_rules('descricao', 'Descrição', 'required|trim');
        $this->form_validation->set_rules('preco', 'Preço', 'required|trim');
        $this->form_validation->set_error_delimiters('', '');

        $data['id'] = intval($this->input->post('id', true));
        $data['categoria_id'] = intval($this->input->post('categoria_id', true));
        $data['descricao'] = prep_for_form($this->input->post('descricao', true));
        $data['preco'] = prep_for_form($this->input->post('preco', true));
        $data['preco'] = str_replace('.', '', $data['preco']);
        $data['preco'] = str_replace(',', '.', $data['preco']);
        $data['status'] = prep_for_form($this->input->post('status', true));
        $data['data_update'] = date('Y-m-d H:i:s');

        /* armazeno os dados para retorno */
        $this->session->set_flashdata('form_resposta', $data);

        $upload_errors = FALSE;
        $upload = mixdUpload('imagem', '/media/produtos/', $data['descricao'], NULL, FALSE);
        if ($upload) {
            if (!(isset($upload['error']))) {
                $data['imagem'] = $upload['file_name'];
                // Converte a imagem em base 64
                $upload_image_directory = getcwd() . $upload['file_name'];
                $data['imagem_base_64'] = mixdBase64EncodeImage($upload_image_directory, mixdGetUploadedImageSmallExtension($upload['file_type']));
            }
            else {
                $upload_errors = TRUE;
            }
        }

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('form_errors', $this->form_validation->error_array());
            redirect('/admix/' . $this->router->fetch_class() . '/alterar/' . $data['id'] . '/' . $url_retorno);
        }
        else {
            $result = $this->produtos->alterar($data);
            if (!(isset($result['error']))) {
                $msn['sucesso'] = 'Dados alterados com sucesso. (' . $result['num_rows'] . ')';
                $this->session->set_flashdata('malerta', $msn);
                redirect('/admix/' . $this->router->fetch_class() . '/' . $url_retorno);
            }
            else {
                $msn['erro'] = 'Os dados não puderam ser alterados. (' . $result['error'] . ')';
                $this->session->set_flashdata('malerta', $msn);
                redirect('/admix/' . $this->router->fetch_class() . '/alterar/' . $data['id'] . '/' . $url_retorno);
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
        $ord['ord_campo'] = ($this->input->get_post('ord_campo', true)) ? prep_for_form($this->input->get_post('ord_campo', true)) : 'descricao';
        $ord['ord_tipo'] = ($this->input->get_post('ord_tipo', true)) ? prep_for_form($this->input->get_post('ord_tipo', true)) : 'asc';
        /* fim da ordenação */

        $q = array();
        $q['where_in']['id'] = $id;
        $d = $this->produtos->getProdutos($q, $ord);
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

        $this->setPagina($this->router->fetch_class() . '/produtos.tpl', $dados);
    }

    public function removerPost() {

        $url_retorno = urldecode($this->input->post('url_retorno', TRUE));
        $data['id'] = $this->input->post('ids', TRUE);

        $result = $this->produtos->remover($data);
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

    public function imagens($id) {
        if (!isset($id))
            redirect('/admix/' . $this->router->fetch_class());

        $resposta = $this->session->flashdata('form_resposta') ? $this->session->flashdata('form_resposta') : array();
        $errors = $this->session->flashdata('form_errors') ? $this->session->flashdata('form_errors') : array();
        $dados = array('acao' => 'Inserir',
            'action' => '/admix/' . $this->router->fetch_class() . '/' . $this->router->fetch_method() . 'Post',
            'id' => $id);
        $campos = array('Cliente_Id', 'Cliente_Nome', 'Cliente_DataCadastro', 'Cliente_Ordem');
        foreach ($campos as $k) {
            $v[$k] = (array_key_exists($k, $resposta)) ? $resposta[$k] : '';
            $e[$k] = (array_key_exists($k, $errors)) ? $errors[$k] : '';
        }
        $resposta = array('v' => $v);
        $errors = array('e' => $e);

        $dados = array_merge($dados, $resposta, $errors);

        $this->setPagina($this->router->fetch_class() . '/cliente-imagens.tpl', $dados);
    }

    public function imagensUpload() {
        $metodo = $this->input->get('metodo', true);
        if ($metodo == 'consultar') {
            $id = intval($this->input->get('id'));
            $resposta = $this->clientes->getImagens($id);
            if ($resposta !== FALSE) {
                foreach ($resposta as $k => $v) {
                    $info = new stdClass();

                    $info->id = $v['ClienteImagem_Id'];
                    $info->name = $v['ClienteImagem_Nome'] ? $v['ClienteImagem_Nome'] : basename($v['ClienteImagem_Imagem']);
                    $info->size = (string) filesize($_SERVER['DOCUMENT_ROOT'] . $v['ClienteImagem_Imagem']);
                    $info->type = "image/jpeg";
                    $info->url = $v['ClienteImagem_Imagem'];
                    #$info->thumbnail_url = mixdThumb($_SERVER['DOCUMENT_ROOT'].$v['ClienteImagem_Imagem'], '80x60', FALSE);
                    $info->thumbnail_url = mixdThumb($_SERVER['DOCUMENT_ROOT'] . $v['ClienteImagem_Imagem'], '260x195', FALSE);
                    $info->delete_url = '/admix/' . $this->router->fetch_class() . '/' . $this->router->fetch_method() . 'Remover' . $v['ClienteImagem_Imagem'];
                    $info->delete_type = 'DELETE'; /**/
                    $array_imagens[] = $info;
                }
                if (isset($array_imagens)) {
                    echo json_encode($array_imagens);
                }
            }
        }
        elseif ($metodo !== false) {
            return false;
        }
        else {
            $id = $this->input->post('id', true);
            $upload_errors = FALSE;
            $upload = mixdUpload('files', '/media/clientes/', '', 'json');
            if (isset($upload[0]->url)) {

                $data['Cliente_Id'] = $id;
                $data['ClienteImagem_Imagem'] = prep_for_form($upload[0]->url);
                $data['ClienteImagem_Ordem'] = 9999; //Go horse NULL

                $result = $this->clientes->inserirImagem($data);

                $upload[0]->id = $result['insert_id'];
                echo json_encode($upload);
            }
            else {
                /* tratar falha no upload */
                return false;
            }
        }
    }

    public function imagensUploadRemover() {
        $url = $this->uri->uri_string();
        $file = str_replace('admix/' . $this->router->fetch_class() . '/' . $this->router->fetch_method() . '/', '', $url);
        $file = $this->security->sanitize_filename($file, TRUE);
        $result = $this->clientes->removerImagem($file);
        if (!(isset($result['error']))) {
            $remover = mixdUploadRemover($file);
        }
    }

    public function redactorImagensUpload() {
        $_FILES['file']['type'] = strtolower($_FILES['file']['type']);
        if ($_FILES['file']['type'] == 'image/png' || $_FILES['file']['type'] == 'image/jpg' ||
                $_FILES['file']['type'] == 'image/gif' || $_FILES['file']['type'] == 'image/jpeg' ||
                $_FILES['file']['type'] == 'image/pjpeg') {

            $upload = mixdUpload('file', '/media/clientes/redactor/', '', 'json');
            if ($upload[0]->url) {
                /* displaying file */
                $array = array(
                    'filelink' => $upload[0]->url
                );
                echo stripslashes(json_encode($array));
            }
        }
    }

    public function redactorImagensJson() {
        $dir = $_SERVER['DOCUMENT_ROOT'] . '/media/clientes/redactor';
        $lista = find_all_files($dir);
        foreach ($lista as $k => $v) {
            $thumb = mixdThumb($v, '100x74', FALSE);
            $image = str_replace($_SERVER['DOCUMENT_ROOT'], '', $v);

            $json[$k]['thumb'] = $thumb;
            $json[$k]['image'] = $image;
        }
        echo stripslashes(json_encode($json));
    }

    public function imagensOrdenar() {
        $id = prep_for_form($this->input->post('id', TRUE));
        $item = prep_for_form($this->input->post('item', TRUE));
        foreach ($item as $imgOrdem => $imgId) {
            $result = $this->clientes->ordenarImagem($id, $imgId, $imgOrdem);
        }
    }

    public function removerArquivo() {
        $url_retorno = $this->input->get('url_retorno', true);
        $url = $this->uri->uri_string();
        #exit($url_retorno);
        $file = str_replace('admix/' . $this->router->fetch_class() . '/' . $this->router->fetch_method() . '/', '', $url);
        $file = $this->security->sanitize_filename($file, TRUE);
        $result = $this->produtos->removerArquivo($file);
        if (!(isset($result['error']))) {
            $remover = mixdUploadRemover($file);
            $msn['sucesso'] = 'Arquivo removido com sucesso. (' . $result['num_rows'] . ')';
            $this->session->set_flashdata('malerta', $msn);
            /* redirect('/admix/'.$this->router->fetch_class().'/'.$url_retorno); */
            redirect($url_retorno);
        }
        else {
            $msn['erro'] = 'Os arquivos não puderam ser removidos ou encontrados. (' . $result['error'] . ')';
            $this->session->set_flashdata('malerta', $msn);
            /* redirect('/admix/'.$this->router->fetch_class().'/'.$url_retorno); */
            redirect($url_retorno);
        }
    }

}
