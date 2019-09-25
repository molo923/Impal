<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Dashboard extends CI_Controller {

	public function index()
	{
		if($this->session->userdata('username')){
			$this->load->view('main/header');
			$this->load->view('pages/dashboard');
			$this->load->view('main/footer');
		}
		else{
			redirect(base_url().'C_User','refresh');
		}
	}
}

/* End of file C_Dashboard.php */
/* Location: ./application/controllers/C_Dashboard.php */