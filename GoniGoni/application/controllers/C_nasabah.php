<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_nasabah extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_nasabah','n');
		$this->load->model('m_setoran','s');

	}
	///ssss

	public function index()
	{

		$data['nasabah'] = $this->n->getnasabahby1($this->session->userdata('id_banksampah'))['message'];
		$this->load->view('main/header');
		$this->load->view('pages/nasabah',$data);	
	}

	public function updatestat()
	{
		# code...
		$id = $this->input->post('id');
		$val=array('status_join'=>$this->input->post('val'));
		if($this->input->post('val')=='keluar'){
			$val=array(
				'status_join'=>$this->input->post('val'),
				'tanggal_out'=>date("Y-m-d H:i:s")
		);
		}
		$query = $this->n->updates($id,$val);
	}

	public function insertnasabahform()
	{
		# code...
		$this->load->view('main/header');
		$this->load->view('pages/insertnasabah');
	}

	public function insertnasabah()
	{
		# code...
		$data = [
		'nomorn_wallet' => null,
		'username'=>$this->input->post('nama_nasabah'),
		'password'=>null,
		'nama_nasabah' => $this->input->post('nama_nasabah'),
		'jenis_kelamin' => $this->input->post('jenis_kelamin'),
		'nohp_nasabah' => $this->input->post('nohp_nasabah'),
		'email_nasabah' => $this->input->post('email_nasabah'),
		'alamat_nasabah' => $this->input->post('alamat_nasabah'),
		'longitude' => null,
		'latitude' => null,
		'status_nasabah' => 'Baru'
		];

		if ($this->n->insertnasabah($data)['status'] == true) {
			# code...
			$nasabah = $this->n->getnasabahbyusr($data['username'])['message'];
		$data = 
		[
		'id_banksampah'=>$this->session->userdata('id_banksampah'),
		'id_nasabah'=>$nasabah[0]['id_nasabah'],
		'tanggal_join'=> date("Y-m-d H:i:s"),
		'tanggal_out'=>'000-00-00',
		'status_join'=>'tidak aktif'
		];
			

			if ($this->n->insertjoins($data)['status'] == true) {
				# code...
				$this->session->set_flashdata('inkatsuc', 'Selamat data sudah terdaftar');
				redirect(base_url().'C_nasabah','refresh');
			}
		}

	}

	public function editnasabahform($id)
	{
		# code...
		$data['nasabah'] = $this->n->getnasabahbyid($id)['message'];
		$this->load->view('main/header',$data);
		$this->load->view('pages/editnasabah');
	}

	public function editnasabah()
	{
		# code...
		$data = [
		'id_nasabah'=>$this->input->post('id_nasabah'),
		'username'=>$this->input->post('nama_nasabah'),
		'nama_nasabah' => $this->input->post('nama_nasabah'),
		'jenis_kelamin' => $this->input->post('jenis_kelamin'),
		'nohp_nasabah' => $this->input->post('nohp_nasabah'),
		'email_nasabah' => $this->input->post('email_nasabah'),
		'alamat_nasabah' => $this->input->post('alamat_nasabah')
		];

		// $cuh = $this->n->editnasabah($data);
		// print_r($cuh);die();

		if ($this->n->editnasabah($data)['status'] == true) {
			# code...
			$this->session->set_flashdata('inkatsuc', 'Selamat data sudah terdaftar');
			redirect(base_url().'C_nasabah','refresh');
		}
		
	}

	public function detailnasabah($id)
	{
		# code...
		$data['setoran'] = $this->s->getsetorannasabahq($id)->result_array();
		//print_r($data);die();
		$this->load->view('main/header');
		$this->load->view('pages/detailnasabah',$data);
		//$this->load->view('main/footer');	
	}

	public function ceksetorannasabah()
	{
		# code...
		$id_nasabah = $this->input->post('id_nasabah');
		$data = $this->s->getsetorannasabah($id_nasabah)->result_array();
		echo json_encode($data);
		//die();
	}

}

/* End of file C_nasabah.php */
/* Location: ./application/controllers/C_nasabah.php */
?>