<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Jemput extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_setoran','s');
		$this->load->model('m_jemput','j');
		$this->load->model('m_nasabah','n');
		$this->load->model('m_kategorisampah','k');
	}

	public function index()
	{
		if($this->session->userdata('username')) {
			//print_r($data);die();
			$jemput = $this->j->getjemputall()->result_array();
			
			$this->load->view('main/header');
			$this->load->view('pages/jemput', ['jemput' => $jemput]);
			//$this->load->view('main/footer');	
		} else {
			redirect(base_url().'C_User','refresh');
		}
	}

}

/* End of file C_Jemput.php */
/* Location: ./application/controllers/C_Jemput.php */