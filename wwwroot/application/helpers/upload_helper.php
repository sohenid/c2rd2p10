<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

if (!function_exists('mixdUpload')) {

    function mixdBase64EncodeImage($filename = string, $filetype = string) {
        if ($filename) {
            $imgbinary = fread(fopen($filename, "r"), filesize($filename));
            return 'data:image/' . $filetype . ';base64,' . base64_encode($imgbinary);
        }
    }

    function mixdGetUploadedImageSmallExtension($file_type) {
        $extension = explode("/", $file_type);
        return end($extension);
    }

    function mixdUpload($file, $destino, $nome = NULL, $formato = NULL, $resize = '1024x768') {

        if (isset($_FILES[$file]['size']) && $_FILES[$file]['size'] > 0) {
            if (!$destino)
                die('A pasta de destino deve ser especificada');

            $ci = & get_instance();

            $subdir = date("m/d");
            $cacheFolder = $_SERVER['DOCUMENT_ROOT'] . "/cache/upload/$subdir/";
            if (!is_dir($cacheFolder))
                mkdir($cacheFolder, 0775, true);

            $targetFolder = $_SERVER['DOCUMENT_ROOT'] . $destino . $subdir . '/';
            if (!is_dir($targetFolder))
                mkdir($targetFolder, 0775, true);

            $ci->load->library('upload');
            $ci->load->helper('text_helper');
            $ci->load->helper('image_helper');

            $fileinfo = pathinfo($_FILES[$file]['name']);
            if (!$nome)
                $nome = basename($_FILES[$file]['name'], '.' . $fileinfo['extension']);
            $config['file_name'] = str_replace('.', '', strtolower(url_title(convert_accented_characters($nome))));
            $config['upload_path'] = $cacheFolder;
            $config['remove_spaces'] = TRUE;
            $config['overwrite'] = FALSE;
            #$config['allowed_types'] = 'gif|jpg|png|pdf|mp3|csv|xls|xlsx|ppt|doc|docx|word|txt|swf';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = 3072;

            $ci->upload->initialize($config);
            $upload = $ci->upload->do_upload($file);
            if (!$upload) {
                $msn['erro'] = $ci->upload->display_errors('', '');
                $ci->session->set_flashdata('malerta', $msn);
                return array('error' => $ci->upload->display_errors('', ''));
            }
            else {
                $dados = $ci->upload->data();

                $shell = antiShell($dados['full_path']);
                if ($shell) {
                    return false;
                    exit();
                }

                if ($dados['is_image'] == 1) {
                    #$dados['image_width'] => 640 
                    #$dados['image_height'] => 480
                    #trabalhar a proporcionalidade e passar pelo mixdThumb
                    if ($resize) {
                        mixdThumb($cacheFolder . $dados['file_name'], $resize);
                    }
                }

                if (file_exists($targetFolder . $dados['file_name']))
                    $nomeFinal = date('his') . '_' . strtolower(convert_accented_characters($dados['file_name']));
                else
                    $nomeFinal = strtolower(convert_accented_characters($dados['file_name']));

                rename($cacheFolder . $dados['file_name'], $targetFolder . $nomeFinal);

                //Return JSON data
                if ((IS_AJAX) || ($formato == 'json')) {   //this is why we put this in the constants to pass only json data

                    /* gero o thumb */
                    #copy($targetFolder.$nomeFinal, $cacheFolder.'thumb_'.$nomeFinal);
                    $thumb = mixdThumb($targetFolder . $nomeFinal, '260x195', FALSE);

                    $info = new stdClass();

                    $info->name = $nomeFinal;
                    $info->size = (string) $dados['file_size'];
                    $info->type = $dados['file_type'];
                    $info->url = $destino . '' . $subdir . '/' . $nomeFinal;
                    $info->thumbnail_url = $thumb; //I set this to original file since I did not create thumbs.  change to thumbnail directory if you do = $upload_path_url .'/thumbs' .$name
                    $info->delete_url = '/admix/' . $ci->router->fetch_class() . '/' . $ci->router->fetch_method() . 'Remover/' . $destino . '' . $subdir . '/' . $nomeFinal;
                    $info->delete_type = 'DELETE'; /**/
                    return array($info);
                    //this has to be the only the only data returned or you will get an error.
                    //if you don't give this a json array it will give you a Empty file upload result error
                    //it you set this without the if(IS_AJAX)...else... you get ERROR:TRUE (my experience anyway)
                }
                else {   // so that this will still work if javascript is not enabled
                    return array('file_name' => $destino . '' . $subdir . '/' . $nomeFinal, 'file_type' => $dados['file_type']);
                }
            }
        }
        else
            return false;
    }

}

if (!function_exists('mixdUploadRemover')) {

    function mixdUploadRemover($file) {
        @unlink($_SERVER['DOCUMENT_ROOT'] . '/' . $file);
    }

}

if (!function_exists('mixdMoveImagem')) {

    function mixdMoveImagem($file_base, $file_target) {
        /* unlink($_SERVER['DOCUMENT_ROOT'].'/'.$file); */
        if (file_exists($file_base)) {
            if (!antiShell($file_base)) {

                /* cria as pastas caso nao existam */
                $sub_pastas = str_replace(basename($file_target), '', $file_target);
                if (!is_dir($sub_pastas))
                    mkdir($sub_pastas, 0775, true);

                rename($file_base, $file_target);
                return str_replace($_SERVER['DOCUMENT_ROOT'], '', $file_target);
            }
            else {
                return false;
                exit();
            }
        }
    }

}

if (!function_exists('antiShell')) {

    function antiShell($file) {
        /* https://github.com/emposha/PHP-Shell-Detector/blob/master/shelldetect.php */
        $regex = '%(preg_replace.*\/e|\bpassthru\b|\bshell_exec\b|\bexec\b|\bbase64_decode\b|\beval\b|\bsystem\b|\bproc_open\b|\bpopen\b|\bcurl_exec\b|\bcurl_multi_exec\b|\bparse_ini_file\b|\bshow_source\b)%';
        $content = file_get_contents($file);

        /* se tiver base64_decode ja joga fora */
        if (strpos($content, "base64_decode") === false) {
            /* arquivos suspeitos */
            if (preg_match_all($regex, $content, $matches)) {
                /* se tiver mais que 5 itens suspeitos, já bloqueamos */
                if (count($matches[0]) > 5) {
                    unlink($file);
                    return true;
                }
                else {
                    return false;
                }
            }
            else {
                return false;
            }
        }
        else {
            unlink($file);
            return true;
        }
    }

}