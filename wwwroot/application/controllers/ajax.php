<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 
 * 
 * 
 * 
 * 
 */


class Ajax extends CI_Controller{
	function __construct(){
		parent::__construct();
		
	}		
	
	public function index(){
		$result = array('error' => 'Nenhum parametro foi encontrado');
		echo json_encode($result);
	}
	
	public function estados (){
		$this->load->model('estados_m', 'estados');
	
		$d_sel = $this->estados->getEstados();
		$r_sel = $d_sel['result'];
		$j = 0;
		foreach($r_sel as $k_sel => $v_sel){
			#$select_estados[$v_sel['Estado_Id']] = $v_sel['Estado_Nome'];
			$select_estados[] = array($j => array('k' => $v_sel['Estado_Id'], 'v' => $v_sel['Estado_Nome']));
			$j++;
		}
		echo json_encode($select_estados);
	}
	
	
	public function cidades($estado = NULL){
		$this->load->model('cidades_m', 'cidades');
		
		$result = NULL;
		if($estado){
			$d_sel = $this->cidades->getCidades($estado);
			if(isset($d_sel['error'])){
				$result = $d_sel;
			}
			else{
				$r_sel = $d_sel['result'];
				$j = 0;
				foreach($r_sel as $k_sel => $v_sel){
					$select_cidades[] = array($j => array('k' => $v_sel['Cidade_Id'], 'v' => $v_sel['Cidade_Nome']));
					$j++;
				}
				$result = $select_cidades;
			}	
		}
		else{
			$result = array('error' => 'O estado deve ser preenchido');
		}
		echo json_encode($result);
	}

}