<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Setoran extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_setoran','s');
		$this->load->model('m_nasabah','n');
		$this->load->model('m_kategorisampah','k');
	}
	
	public function index()
	{
	if($this->session->userdata('username')){
	$data['setoran'] = $this->s->getalljoin($this->session->userdata('id_banksampah'))['message'];
	//print_r($data);die();
	$this->load->view('main/header');
	$this->load->view('pages/setoran',$data);
	//$this->load->view('main/footer');	
		}
	else{
		redirect(base_url().'C_User','refresh');
	}
	}

	public function insertsetoranform()
	{
	if($this->session->userdata('username')){

	$data['nasabah'] = $this->n->getnasabahby1($this->session->userdata('id_banksampah'))['message'];
	$data['kat'] = $this->k->getAll($this->session->userdata('id_banksampah'))['message'];

	$this->load->view('main/header');
	$this->load->view('pages/insertsetoran',$data);
	//$this->load->view('pages/super',$data);
	//$this->load->view('main/footer');		
	}
	else{
		redirect(base_url().'C_User','refresh');
	}

	}

	public function insertsetoran()
	{
	if($this->session->userdata('username')){
	$id_kategorisampah = $this->input->post('id_kategorisampah');
	$biaya_setoran = $this->input->post('biaya_setoran');
	$id_nasabah = $this->input->post('id_nasabah');
	$tgl_setorin = $this->input->post('tgl_setorin');
	$tgl_setordone ='0000-00-00';
	$berat_setoran = $this->input->post('berat_setoran');
	$jenis_setoran = $this->input->post('jenis_setoran');
	$status_setoran = $this->input->post('status_setoran');
	$keterangan_setoran = $this->input->post('keterangan_setoran');
	$total_harga=0;
	$total_berat=0;


	if ($status_setoran == 'selesai') {
		# code...
		$tgl_setordone =  date("Y-m-d H:i:s");
	}
	do {
		# code...
		$id_setoran ='S-';
		for ($i=1; $i <=5 ; $i++) { 
			# code...
			$nomor = rand(0,9);
			$id_setoran= $id_setoran.$nomor;
		}
		$ququ = $this->s->getby($id_setoran)['message'];
		//echo $ququ->num_rows();

	} while (count($ququ) > 0);
	//echo $id_setoran;
	if ($id_nasabah == '0') {
		# code...
		$id_nasabah=null;
	}
	for ($i=0; $i <count($id_kategorisampah); $i++) { 
	
		$data = $this->k->getby2($id_kategorisampah[$i],$this->session->userdata('id_banksampah'))['message'];

		if($jenis_setoran == 'hibah' || $jenis_setoran == 'lainnya') {
			$harga[$i] = 0;
			$sub_harga[$i] = 0;
		}

		else{
			$harga[$i] = $data['harga'];
			$sub_harga[$i] = $berat_setoran[$i]*$harga[$i];
		}
	}

	for ($i=0; $i <count($sub_harga); $i++) { 
		# code...
		$total_harga += $sub_harga[$i];
		$total_berat += $berat_setoran[$i];
	}

	$data = array(
		'id_setoran' => $id_setoran,
		'jenis_setoran'=>$jenis_setoran,
		'total_berat'=>$total_berat,
		'total_harga'=>$total_harga - $biaya_setoran,
		'id_banksampah' =>$this->session->userdata('id_banksampah'),
		'id_nasabah'=>$id_nasabah,
		'tgl_setorin'=>$tgl_setorin,
		'tgl_setordone'=>$tgl_setordone,
		'biaya_setoran'=>$biaya_setoran,
		'status_setoran'=>$status_setoran,
		'keterangan_setoran'=>$keterangan_setoran
	 );
	$this->s->insertsetoran($data);//insert to setoran db

	for ($i=0; $i <count($id_kategorisampah); $i++) { //START OF AGREGATE LOOP
		# code...
		if ($status_setoran == 'selesai') {
			# code...
			$status_sampah = 'selesai';
			$yuhu = $this->k->getby2($id_kategorisampah[$i],$this->session->userdata('id_banksampah'))['message'];
			if ($jenis_setoran=='beli') {
				# code...
				$tambah = $yuhu['qbeli']+$berat_setoran[$i];
				$datag = [
					'id_banksampah'=>$this->session->userdata('id_banksampah'),
					'id_kategorisampah'=>$id_kategorisampah[$i],
					'qbeli' =>$tambah,
					'qhibah'=>$yuhu['qhibah'],
					'qlainnya'=>$yuhu['qlainnya']
				];
			}
			elseif ($jenis_setoran == 'hibah') {
				# code...
				$tambah = $yuhu['qhibah']+$berat_setoran[$i];
				$datag = [
					'id_banksampah'=>$this->session->userdata('id_banksampah'),
					'id_kategorisampah'=>$id_kategorisampah[$i],
					'qbeli'=>$yuhu['qbeli'],
					'qhibah' =>$tambah,
					'qlainnya'=>$yuhu['qlainnya']
				];
			}
			else{
				$tambah = $yuhu['qlainnya']+$berat_setoran[$i];
				$datag = [
					'id_banksampah'=>$this->session->userdata('id_banksampah'),
					'id_kategorisampah'=>$id_kategorisampah[$i],
					'qbeli'=>$yuhu['qbeli'],
					'qhibah' =>$yuhu['qhibah'],
					'qlainnya'=>$tambah
				];
			}
			$this->k->editkat1($datag); //edit kat quantity
		}
		else {
				$status_sampah = 'belum selesai';
			}

		$datas = [
			'id_setoran' => $id_setoran ,
			'id_kategorisampah'=>$id_kategorisampah[$i],
			'berat'=>$berat_setoran[$i],
			'sub_harga'=>$sub_harga[$i],
			'status_sampah'=>$status_sampah
		];

		$this->s->insertdetail($datas); //insert to detail


	} //END OF AGREGATE LOOP

		$this->session->set_flashdata('inkatsuc', 'value');
		redirect(base_url().'C_Setoran','refresh');

	}
	else{
		redirect(base_url().'C_User','refresh');
	}

	}

	public function getdetail()
	{
		# code...
		$id = $this->input->post('id');
		$data = $this->s->getdetailjoinby($id)['message'];
		echo json_encode($data);

	}

	public function editsetoranform($id="")
	{
		# code...
	if($this->session->userdata('username')){

	$data['nasabah'] = $this->n->getnasabahby($this->session->userdata('id_banksampah'))->result_array();
	$data['kat'] = $this->k->getAll($this->session->userdata('id_banksampah'))['message'];
	$data['data'] = $this->s->getalljoin2($id)['message'];
	//print_r($datas);die();
	$this->load->view('main/header');
	$this->load->view('pages/editsetoran',$data);
	//$this->load->view('pages/super',$data);
	//$this->load->view('main/footer');		
	}
	else{
		redirect(base_url().'C_User','refresh');
	}
	}

	public function editsetorans($id)
	{
	if($this->session->userdata('username')){
	$dataf = $this->s->getalljoin2($id)['message'];
	$id_kategorisampah = $this->input->post('id_kategorisampah');
	$id_nasabah = $this->input->post('id_nasabah');
	$tgl_setorin = $this->input->post('tgl_setorin');
	$tgl_setordone ='0000-00-00';
	$berat_setoran = $this->input->post('berat_setoran');
	$jenis_setoran = $this->input->post('jenis_setoran');
	$status_setoran = $this->input->post('status_setoran');
	$status_sampah = $this->input->post('status_sampah');
	$keterangan_setoran = $this->input->post('keterangan_setoran');
	$biaya_setoran = $this->input->post('biaya_setoran');
	$total_harga=0;
	$total_berat=0;

	//echo(count($dataf));die();

	for ($i=0; $i <count($id_kategorisampah); $i++) { 
		# code...
	if ($status_setoran == 'reject') {
		# code...
		$tgl_setordone =  date("Y-m-d H:i:s");
		$status_sampah[$i] = 'reject';

	}
	elseif ($status_setoran == 'selesai') {
		# code...
		$tgl_setordone =  date("Y-m-d H:i:s");
		if ($status_sampah[$i] != 'reject') {
			# code...
			$status_sampah[$i] = 'selesai';
		}
		else {
			$status_sampah[$i] = 'reject';
		}


	}

		$data = $this->k->getby2($id_kategorisampah[$i],$this->session->userdata('id_banksampah'))['message'];

		if($jenis_setoran == 'hibah' || $jenis_setoran == 'lainnya') {
		$harga[$i] = 0;
		$sub_harga[$i] = 0;
		
		}

		else{
		$harga[$i] = $data['harga'];
		$sub_harga[$i] = $berat_setoran[$i]*$harga[$i];
		}

	}
	for ($i=0; $i <count($sub_harga); $i++) { 
		# code...
		if ($status_sampah[$i] != 'reject') {
			$total_harga += $sub_harga[$i];
			$total_berat += $berat_setoran[$i];
		}
		
	}

	$datax = array(
		'id_setoran'=>$id,
		'jenis_setoran'=>$jenis_setoran,
		'total_berat'=>$total_berat,
		'tgl_setorin'=>$tgl_setorin,
		'tgl_setordone'=>$tgl_setordone,
		'total_harga'=>$total_harga-$biaya_setoran,
		'biaya_setoran'=>$biaya_setoran,
		'status_setoran'=>$status_setoran,
		'keterangan_setoran'=>$keterangan_setoran
	 );

	$this->s->editsetoran($id,$datax);//edit setoran in db

	for ($i=0; $i <count($id_kategorisampah); $i++) { 
		# code...
		$datas = array(
			'id_setoran'=>$id,
			'id_kategorisampah'=>$id_kategorisampah[$i],
			'berat'=>$berat_setoran[$i],
			'status_sampah'=>$status_sampah[$i],
			'sub_harga'=>$sub_harga[$i]);
		// $this->s->insertdetail($datas);
		$t = $this->s->getsetorandetail($id_kategorisampah[$i], $id)['message'];
		if ($status_sampah[$i] == 'selesai' && $t['status_sampah'] != 'selesai' ) {
			# code...
			$yuhu = $this->k->getby2($id_kategorisampah[$i],$this->session->userdata('id_banksampah'))['message'];
			if ($status_sampah[$i] != 'reject') {
				# code...
			if ($jenis_setoran=='beli') {
				# code...
				$datag = [
					'id_banksampah'=>$this->session->userdata('id_banksampah'),
					'id_kategorisampah'=>$id_kategorisampah[$i],
					'qbeli' =>$yuhu['qbeli']+ $berat_setoran[$i],
					'qhibah'=>$yuhu['qhibah'],
					'qlainnya'=>$yuhu['qlainnya']
				];
			}
			elseif ($jenis_setoran == 'hibah') {
				# code...
				$datag = [
					'id_banksampah'=>$this->session->userdata('id_banksampah'),
					'id_kategorisampah'=>$id_kategorisampah[$i],
					'qbeli' =>$yuhu['qbeli'],
					'qhibah' =>$yuhu['qhibah']+ $berat_setoran[$i],
					'qlainnya'=>$yuhu['qlainnya']
				];
			}
			else{
				$datag = [
					'id_banksampah'=>$this->session->userdata('id_banksampah'),
					'id_kategorisampah'=>$id_kategorisampah[$i],
					'qbeli' =>$yuhu['qbeli'],
					'qhibah' =>$yuhu['qhibah'],
					'qlainnya' =>$yuhu['qlainnya']+ $berat_setoran[$i]
				];
			}

			$this->k->editkat1($datag);//kategori edit in db

		}
	}
	$cnt = $this->s->getsetorandetail($id_kategorisampah[$i],$id)['message'];

		if (isset($cnt)) {
			# code...
			 $this->s->editsetorandetail($datas);
		}
		else{

			$this->s->insertdetail($datas);
		}
	}
	for ($i=0; $i <count($dataf) ; $i++) { 
		# code...
		if (!in_array($dataf[$i]['id_kategorisampah'], $id_kategorisampah)) {
			# code...
			$this->s->deletesetorandetail($id,$dataf[$i]['id_kategorisampah']);
		}

	}
		$this->session->set_flashdata('inkatsuc', 'value');
		redirect(base_url().'C_Setoran','refresh');

	}
	else{
		redirect(base_url().'C_User','refresh');
	}

	}

	public function hadiah()
	{
		# code...
		$val = $this->input->post('val');
		$qu = $this->s->cekhadiah($val)->row_array();
		echo($qu["a('$val')"]);
		
	}


}

/* End of file C_Setoran.php */
/* Location: ./application/controllers/C_Setoran.php */