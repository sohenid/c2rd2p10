<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 
 */
if ( ! function_exists('bspaginacao'))
{
	function bspaginacao($base_url, $per_page, $total_rows){
		/* instancio o Codeigniter */
		$CI =& get_instance();
		
		$CI->load->library('pagination');
		
		$config['base_url'] = $base_url;
		$config['page_query_string'] = TRUE;
		$config['query_string_segment'] = 'p';
		$config['num_links'] = 2;
		$config['total_rows'] = $total_rows;
		$config['per_page'] = $per_page;
		/* pagination bootstrap */
		$config['full_tag_open'] = '<div class="pagination pagination-right"><ul>';
		$config['full_tag_close'] = '</ul></div>';
		$config['first_link'] = '<i class="icon-backward"></i> Primeira';
		$config['last_link'] = 'Última <i class="icon-forward"></i>';
		$config['first_tag_open'] = '<li class="first">';
		$config['first_tag_close'] = '</li>';
		$config['prev_link'] = '<i class="icon-caret-left"></i>';
		$config['prev_tag_open'] = '<li class="prev">';
		$config['prev_tag_close'] = '</li>';
		$config['next_link'] = '<i class="icon-caret-right"></i>';
		$config['next_tag_open'] = '<li class="next">';
		$config['next_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li class="last">';
		$config['last_tag_close'] = '</li>';
		$config['cur_tag_open'] =  '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		
		$CI->pagination->initialize($config);

		$paginacao = $CI->pagination->create_links();
		return $paginacao;
	}
}	