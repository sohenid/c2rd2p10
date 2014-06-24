<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 * 
 * 
 * 
 * 
 */


class Sem_permissao extends Admix_Controller{
	function __construct(){
		parent::__construct();
	}		
	
	public function index(){
		
		$dados = array('result' => '');
        $this->setPagina('sem-permissao.tpl', $dados);
        
	}
}