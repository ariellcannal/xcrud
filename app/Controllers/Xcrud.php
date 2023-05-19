<?php
if (! defined('BASEPATH'))
	exit('No direct script access allowed');
class Ajax extends SYS_Controller {

	function __construct(){
		parent::__construct();
	}

	public function xcrud(){
	    $this->load->library('session');
		$this->load->helper(array(
				'url',
				'xcrud'));
		Xcrud_config::$scripts_url = base_url('');
		$this->output->set_output(Xcrud::get_requested_instance($this));
	}

	public function termos(){
		$this->vars['content'] = $this->load->view('termos.php', $this->vars, true);
		$this->load->view('responsive.php', $this->vars);
	}
	
	public function set_termos(){
		if(in_array($this->session->userdata('usr_tipo'),array('cliente','empresa'))){
			$this->usuarios_model->setTermos();
		}
	}
	
	public function ping(){
		if ($this->session->userdata('usr_id') != "") {
			exit('success');
		} else {
			exit('error');
		}
	}

	public function teste(){
	    exit(date('Y-m-d H:i:s'));     
	    $this->load->library('email');
	    $this->email->to('arielcannal@gmail.com');
	    $this->email->subject('Teste');
	    $msg = 'testesdsds';
	    $this->email->message($msg);
	    print $this->email->send();
	    print $this->email->print_debugger();
	    exit;
		$this->load->model('clientes_model');
		print $this->clientes_model->getTotal();
		exit();
	}

	public function consultaCEP(){
		if ($_REQUEST['cep'] == "" || strlen($_REQUEST['cep']) < 8)
			exit(json_encode(array()));
		else { // exit($_REQUEST['cep']);
			$post = array(
					'cepEntrada' => $_REQUEST['cep'],
					'tipoCep' => '',
					'cepTemp' => '',
					'metodo' => 'buscarCep');
			$this->load->library('curl');
			$this->load->helper('domparser');
			$html = str_get_html($this->curl->simple_post("http://m.correios.com.br/movel/buscaCepConfirma.do", $post));
			// exit($html);
			$dados['logradouro'] = utf8_encode(trim($html->find('.respostadestaque', 0)->innertext));
			if (strpos($dados['logradouro'], ',')) {
				
				$logradouro = explode(",", $dados['logradouro']);
				
				$dados['logradouro'] = trim($logradouro[0]);
				$dados['numero'] = trim($logradouro[1]);
			}
			$dados['bairro'] = utf8_encode(trim($html->find('.respostadestaque', 1)->innertext));
			$cidade_estado = trim($html->find('.respostadestaque', 2)->innertext);
			$cidade_estado = explode("/", $cidade_estado);
			$dados['cidade'] = utf8_encode(trim($cidade_estado[0]));
			$dados['estado'] = utf8_encode(trim($cidade_estado[1]));
			$dados['cep'] = utf8_encode(trim($html->find('.respostadestaque', 3)->innertext));
			exit(json_encode($dados));
		}
	}

	public function set_var(){
		if (! $this->input->is_ajax_request())
			show_404();
		if ($_POST['var'] != "" && $_POST['val'] != "") {
			$this->session->set_userdata($_POST['var'], $_POST['val']);
			exit('1');
		} else {
			exit('0');
		}
	}

	public function set_pref(){
		if (! $this->input->is_ajax_request() && ! $this->session->userdata('usr_id'))
			show_404();
		if ($_POST['var'] != "" && $_POST['val'] != "") {
			if(is_array($_POST['val'])){
				$_POST['val'] = json_encode($_POST['val']);
			}
			$this->usuarios_model->setPreferencia($this->session->userdata('usr_id'), array($_POST['var']=>$_POST['val']));
			exit('1');
		} else {
			exit('0');
		}
	}

	public function hist_emp(){
		$this->load->model('vagas_model');
		$vagas = $this->vagas_model->getHistoricoEmpresa($_POST['emp']);
		foreach ($vagas as $k => $v) {
			if ($v['vag_ativa'] == 0)
				$vagas[$k]['vag_ativa'] = 'Não';
			else if ($v['vag_ativa'] == 1)
				$vagas[$k]['vag_ativa'] = 'Sim';
		}
		// $vagas['vagas'] = $vagas;
		exit(json_encode($vagas));
	}
}

/* End of file ajax.php */
/* Location: ./application/controllers/ajax.php */