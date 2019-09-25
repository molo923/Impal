<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Katsampah extends CI_Controller {

public function __construct()
{
	parent::__construct();
	$this->load->model('M_kategorisampah','kat');
}
	public function index()
	{
		if($this->session->userdata('username')){
			$data['kat'] = $this->kat->getAll($this->session->userdata('id_banksampah'))['message'];
			$this->load->view('main/header');
			$this->load->view('pages/kelolakatsampah',$data);
			$this->load->view('main/footer');
		}
		else{
			redirect(base_url().'C_User','refresh');
		}
	}

	public function tambahkategori()
	{
		# code...
		if($this->session->userdata('username')){
			$data = $this->kat->getby($this->input->post('kode_kat'),$this->session->userdata('id_banksampah'))['message'];
		if( count($data) > 0) {
			
			$this->session->set_flashdata('inkatfail', 'value');
			redirect(base_url().'C_Katsampah','refresh');
		}
		else {
		$data = array(
		'kode_kat'=>$this->input->post('kode_kat'),
		'id_banksampah'=>$this->session->userdata('id_banksampah'),
		'golongan'=>$this->input->post('golongan'),
		'jenis'=>$this->input->post('jenis'),
		'harga'=>$this->input->post('harga'),
		'deskripsi_kat'=>$this->input->post('deskripsi_kat'),
		'status_kat'=>'aktif'
		);

		$this->kat->insertkat($data);
		$this->session->set_flashdata('inkatsuc', 'value');
		redirect(base_url().'C_Katsampah','refresh');
	}
}
			else{
			redirect(base_url().'C_User','refresh');
		}
	}

		public function hapuskat($id)
		{
			# code...
		if($this->session->userdata('username')){
			$hapus = $this->kat->hapuskat($id,$this->session->userdata('id_banksampah'))['status'];
			if($hapus){
				$this->session->set_flashdata('hapuskatsuc', 'value');
				print_r($hapus);
				redirect(base_url().'C_Katsampah','refresh');
			}

		}
		else{
			redirect(base_url().'C_User','refresh');
		}

		}

		public function updatestat()
		{
			# code...
		if($this->session->userdata('username')){
			$id_kategorisampah = $this->input->get('id');
			$status_kat = $this->input->get('stat');
			$result = 'Kategori di'.$status_kat;
			if ($this->kat->updatekat($id_kategorisampah,$status_kat)['status'] > 0) {
				# code...
				//echo json_encode($result);
				$this->session->set_flashdata('inkatup', 'Kategori berhasil di'.$status_kat);
				redirect('C_Katsampah','refresh');

			}
			
		
		}
		else{
			redirect(base_url().'C_User','refresh');
		}

		}

		public function editkatform($id)
		{
			# code...
		if($this->session->userdata('username')){
			$data['kat'] = $this->kat->getby2($id,$this->session->userdata('id_banksampah'))['message'];
			$this->load->view('main/header');
			$this->load->view('pages/editkat',$data);
			$this->load->view('main/footer');
			
		}
		else{
			redirect(base_url().'C_User','refresh');
		}

		}

		public function editkategori($point,$checker)
	 {
		# code...
		if($this->session->userdata('username')){

			$data =$this->kat->getby($this->input->post('kode_kat'),$this->session->userdata('id_banksampah'))['message'];
			//print_r(count($data));

		if(count($data) > 0 && $this->input->post('kode_kat') != $checker) { 
			 
			$this->session->set_flashdata('inkatfail', 'value');
			redirect(base_url().'C_Katsampah','refresh');
		}
		else {
		$data = array(
		'id_banksampah'=>$this->session->userdata('id_banksampah'),
		'id_kategorisampah'=>$point,
		'kode_kat'=>$this->input->post('kode_kat'),
		'golongan'=>$this->input->post('golongan'),
		'jenis'=>$this->input->post('jenis'),
		'harga'=>$this->input->post('harga'),
		'harga_atas'=>0,
		'harga_bawah'=>0,
		'qbeli'=>0,
		'qhibah'=>0,
		'qlainnya'=>0,
		'qresidu'=>0,
		'qmutasian'=>0,
		'qdimutasi'=>0,
		'qjual'=>0,
		'qnonjual'=>0,
		'qreject'=>0,
		'deskripsi_kat'=>$this->input->post('deskripsi_kat')
		);

		$this->kat->editkat($data);
		$this->session->set_flashdata('inkatsuc', 'value');
		redirect(base_url().'C_Katsampah','refresh');
	}
}
			else{
			redirect(base_url().'C_User','refresh');
		}
	}
}

/* End of file C_Katsampah.php */
/* Location: ./application/controllers/C_Katsampah.php */