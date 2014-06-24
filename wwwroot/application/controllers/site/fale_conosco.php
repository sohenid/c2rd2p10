<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Fale_Conosco extends Site_Controller {
    public function __construct(){
        parent::__construct();
		
		$this->load->model('configuracoes_m', 'configuracoes');
    }
	
	public function Index()
	{
		$dados = array();
		
		$dados['seo'] = array('title'		=> '',
			 'description'	=> '',
			 'keywords'		=> '',
			 'canonical'	=> base_url('/fale-conosco'));		 
			 
		$this->setPagina($this->router->fetch_class().'/fale_conosco.tpl', $dados);
	}
	
	public function Localizacao() {
		$dados = array();
		
		$dados['seo'] = array('title'		=> '',
			 'description'	=> '',
			 'keywords'		=> '',
			 'canonical'	=> base_url('/fale-conosco/localizacao'));		 
			 
		$this->setPagina($this->router->fetch_class().'/localizacao.tpl', $dados);		
	}
	
	public function Enviar()
	{
		// VALIDATION RULES
		$this->load->library('form_validation');
		$this->form_validation->set_rules('Fale_Nome', 'Nome', 'required|trim');
		$this->form_validation->set_rules('Fale_Email', 'E-mail', 'required|trim');
		$this->form_validation->set_error_delimiters('', '');
		$Contato_Nome = prep_for_form($this->input->post('Fale_Nome', true));
		$Contato_Email = prep_for_form($this->input->post('Fale_Email', true));
		$Contato_Email = prep_for_form($this->input->post('Fale_Email', true));
		$Contato_Telefone = prep_for_form($this->input->post('Fale_Telefone', true));
		$Contato_Cidade = prep_for_form($this->input->post('Fale_Cidade', true));
		$Contato_Estado = prep_for_form($this->input->post('Fale_Estado', true));
		$Contato_Assunto = prep_for_form($this->input->post('Fale_Assunto', true));
		$Contato_Mensagem = prep_for_form($this->input->post('Fale_Mensagem', true));
		$Contato_Cadastro = prep_for_form($this->input->post('Fale_Cadastro', true));

		$mensagem = "
		<b>Nome:</b> $Contato_Nome<br />
		<b>E-mail:</b> $Contato_Email<br />
		<b>Telefone:</b> $Contato_Telefone<br />
		<b>Cidade:</b> $Contato_Cidade - $Contato_Estado<br />
		<b>Assunto:</b> $Contato_Assunto<br />
		<b>Mensagem:</b><br />
		$Contato_Mensagem
		";
						
		if ($this->form_validation->run() !== FALSE)
		{
			if($Contato_Email)
			{
				$configuracoes = $this->configuracoes->getConfiguracoesValores();
				if (mmail($configuracoes['Contato_Email'], 'Contato', $mensagem, $Contato_Email, null)) {
					//Código que insere o email no banco de dados
					$this->load->model('emails_m', 'emails');
	
					$data = array();
					$data['Email_Nome'] = $Contato_Nome;
					$data['Email_Email'] = $Contato_Email;
					$data['Email_Telefone'] = $Contato_Telefone;
					$data['Email_Cidade'] = $Contato_Cidade;
	
					$this->emails->inserir($data);
	
					$msn['sucesso'] = 'Seus dados foram enviados com sucesso.';
					$this->session->set_flashdata('malerta', $msn);
					redirect('/');			
				}
				else
				{
					$msn['erro'] = 'Seu e-mail não pode ser enviado. Tente novamente mais tarde.';
					$this->session->set_flashdata('malerta', $msn);
					redirect('/');
				}
			}
		}
		else
		{
			$msn['erro'] = implode('<br />', $this->form_validation->error_array());
			$this->session->set_flashdata('malerta', $msn);
			redirect('/');
		}	
	}
}

/* End of file fale_conosco.php */
/* Location: ./application/controllers/site/fale_conosco.php */