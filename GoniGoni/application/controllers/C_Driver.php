<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Driver extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_driver','d');

	}

	public function index()
	{

		$data['driver'] = $this->d->getdriverby($this->session->userdata('id_banksampah'))->result_array();
		$this->load->view('main/header');
		$this->load->view('pages/driver',$data);	
	}

	public function updatestat()
	{
		# code...
		$id = $this->input->post('id');
		$val=array('status_driver'=>$this->input->post('val'));
		$query = $this->d->updates($id,$val);
	}
}

/* End of file C_Driver.php */
/* Location: ./application/controllers/C_Driver.php */
?>