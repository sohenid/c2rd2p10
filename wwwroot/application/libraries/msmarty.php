<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

	require APPPATH."third_party/smarty/libs_3.1.12/Smarty.class.php";

	class Msmarty extends Smarty{
		public function __construct(){
			parent::__construct();

			$config =& get_config();			

			$this->left_delimiter	=  '{';
			$this->right_delimiter	=  '}';
			
			// absolute path prevents "template not found" errors
			$this->template_dir = (!empty($config['smarty_template_dir']) ? $config['smarty_template_dir'] : FCPATH . APPPATH . 'views/');																		
			$this->compile_dir  = (!empty($config['smarty_compile_dir']) ? $config['compile_dir'] : FCPATH . 'cache/tpl_c/');
		}
	}
?>