<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Sampahkeluar extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_kategorisampah','k');
		$this->load->model('m_sampahkeluar','sk');
	}

	public function index()
	{
	if($this->session->userdata('username')){
	
	//print_r($data);die();
	$data['sampahkeluar'] = $this->sk->getalljoin($this->session->userdata('id_banksampah'))['message'];
	$this->load->view('main/header');
	$this->load->view('pages/sampahkeluar',$data);
	//$this->load->view('main/footer');	
		}
	else{
		redirect(base_url().'C_User','refresh');
	}
	}

	public function insertsampahkeluarform()
	{
	if($this->session->userdata('username')){

	$data['kat'] = $this->k->getAll($this->session->userdata('id_banksampah'))['message'];

	$this->load->view('main/header');
	$this->load->view('pages/insertsampahkeluar',$data);
	//$this->load->view('pages/super',$data);
	//$this->load->view('main/footer');		
	}
	else{
		redirect(base_url().'C_User','refresh');
	}

	}

	public function insertsampahkeluar()
	{
	if($this->session->userdata('username')){
	$id_kategorisampah = $this->input->post('id_kategorisampah');
	$tgl_sampahkeluar = $this->input->post('tgl_sampahkeluar');
	$tujuan_sampahkeluar = $this->input->post('tujuan_sampahkeluar');
	$biaya_sampahkeluar = $this->input->post('biaya_sampahkeluar');
	$tgl_done ='0000-00-00';
	$berat = $this->input->post('berat');
	$harga = $this->input->post('harga');
	$jenis_sampahkeluar= $this->input->post('jenis_sampahkeluar');
	$status_sampahkeluar= $this->input->post('status_sampahkeluar');
	$keterangan_sampahkeluar= $this->input->post('keterangan_sampahkeluar');
	$status_terima='belum terima';
	$total_harga_sampahkeluar=0;
	$berat_sampahkeluar=0;
	

	if ($status_sampahkeluar == 'selesai') {
		# code...
		$tgl_done =  date("Y-m-d H:i:s");
	}
	do {
		# code...
		$id_sampahkeluar ='SK-';
		for ($i=1; $i <=5 ; $i++) { 
			# code...
			$nomor = rand(0,9);
			$id_sampahkeluar= $id_sampahkeluar.$nomor;
		}
		// echo($id_sampahkeluar);
		$ququ = $this->sk->getby($id_sampahkeluar)['message'];
	//echo $ququ->num_rows();

	} while (count($ququ) > 0);
	// //echo $id_setoran;

	for ($i=0; $i <count($id_kategorisampah); $i++) { 
		# code...

		if($jenis_sampahkeluar != 'nonjual'){

		$sub_harga[$i] = $berat[$i]*$harga[$i];
		}
		else {
		$harga[$i] = 0;
		$sub_harga[$i] = 0;
		}

	}
	for ($i=0; $i <count($sub_harga); $i++) { 
		# code...
		$total_harga_sampahkeluar += $sub_harga[$i];
		$berat_sampahkeluar += $berat[$i];

	}

	$data = array(
		'id_sampahkeluar' => $id_sampahkeluar,
		'jenis_sampahkeluar'=>$jenis_sampahkeluar,
		'berat_sampahkeluar'=>$berat_sampahkeluar,
		'tberat_reject'=>'0',
		'total_harga_sampahkeluar'=>$total_harga_sampahkeluar - $biaya_sampahkeluar,
		'tujuan_sampahkeluar'=>$tujuan_sampahkeluar,
		'biaya_sampahkeluar'=>$biaya_sampahkeluar,
		'id_banksampah' =>$this->session->userdata('id_banksampah'),
		'tgl_sampahkeluar'=>$tgl_sampahkeluar,
		'tgl_done'=>$tgl_done,
		'status_sampahkeluar'=>$status_sampahkeluar,
		'keterangan_sampahkeluar'=>$keterangan_sampahkeluar
	 );
	$query=$this->sk->insertsampahkeluar($data);
	for ($i=0; $i <count($id_kategorisampah); $i++) { 
		# code...
		if ($status_sampahkeluar == 'selesai') {
			# code...
			$status_terima = 'terima';
			$yuhu = $this->k->getby2($id_kategorisampah[$i],$this->session->userdata('id_banksampah'))['message'];
			if ($jenis_sampahkeluar=='jual') {
				# code...
				$tambah = $yuhu['qjual']+$berat[$i];
				$datag = [
					'id_banksampah'=>$this->session->userdata('id_banksampah'),
					'id_kategorisampah'=>$id_kategorisampah[$i],
					'qnonjual'=>$yuhu['qnonjual'],
					'qjual' =>$tambah];
			}
			elseif ($jenis_sampahkeluar == 'nonjual') {
				# code...
				$tambah = $yuhu['qnonjual']+$berat[$i];
				$datag = [
					'id_banksampah'=>$this->session->userdata('id_banksampah'),
					'id_kategorisampah'=>$id_kategorisampah[$i],
					'qnonjual' =>$tambah,
					'qjual' =>$yuhu['qjual']
				];
			}

			$this->k->editkat2($datag);
		}
		else {
			$status_terima = 'belum terima';
		}

		$datas = [
			'id_sampahkeluar' => $id_sampahkeluar,
			'id_kategorisampah'=>$id_kategorisampah[$i],
			'berat'=>$berat[$i],
			'berat_reject'=>0,
			'harga_kg'=>$harga[$i],
			'sub_harga'=>$sub_harga[$i],
			'status_terima'=>$status_terima ];
		$this->sk->insertdetail($datas);
	}
		$this->session->set_flashdata('inkatsuc', 'value');
		redirect(base_url().'C_Sampahkeluar','refresh');

	}
	else{
		redirect(base_url().'C_User','refresh');
	}

	}

		public function getdetail()
	{
		# code...
		$id = $this->input->post('id');
		$data = $this->sk->getdetailjoinby($id)['message'];
		echo json_encode($data);

	}
		public function editsampahkeluarform($id="")
	{
		# code...
	if($this->session->userdata('username')){


	$data['kat'] = $this->k->getAll($this->session->userdata('id_banksampah'))['message'];
	$data['data'] = $this->sk->getalljoin2($id)['message'];
	//print_r($datas);die();
	$this->load->view('main/header');
	$this->load->view('pages/editsampahkeluar',$data);
	//$this->load->view('pages/super',$data);
	//$this->load->view('main/footer');		
	}
	else{
		redirect(base_url().'C_User','refresh');
	}
	}

	public function editsampahkeluars($id)
	{
	if($this->session->userdata('username')){
	$dataf = $this->sk->getalljoin2($id)['message'];
	$id_kategorisampah = $this->input->post('id_kategorisampah');
	$tujuan_sampahkeluar = $this->input->post('tujuan_sampahkeluar');
	$biaya_sampahkeluar = $this->input->post('biaya_sampahkeluar');
	$tgl_sampahkeluar = $this->input->post('tgl_sampahkeluar');
	$tgl_done ='0000-00-00';
	$berat = $this->input->post('berat');
	$berat_reject = $this->input->post('berat_reject');
	$harga = $this->input->post('harga');
	$jenis_sampahkeluar = $this->input->post('jenis_sampahkeluar');
	$status_sampahkeluar = $this->input->post('status_sampahkeluar');
	$status_terima= $this->input->post('status_terima');
	$keterangan_sampahkeluar = $this->input->post('keterangan_sampahkeluar');
	$total_reject = 0;
	$tberat_reject = 0;
	$total_harga_sampahkeluar=0;
	$berat_sampahkeluar=0;


	for ($i=0; $i <count($id_kategorisampah); $i++) { 
		# code...

	if ($status_sampahkeluar == 'reject') {
		# code...
		$tgl_done =  date("Y-m-d H:i:s");
		$status_terima[$i] = 'reject';
		$berat_reject[$i] = $berat[$i];

	}
	elseif ($status_sampahkeluar == 'selesai') {
		# code...
		$tgl_done =  date("Y-m-d H:i:s");
		if ($status_terima[$i] != 'reject') {
			# code...
			$status_terima[$i] = 'terima';
		}
		else{
			$status_terima[$i] = 'reject';
			$berat_reject[$i] = $berat[$i];
		}
	}

	if($jenis_sampahkeluar != 'nonjual' ){
				# code...

				$sub_harga[$i] = $berat[$i]*$harga[$i];
				$sub_reject[$i] = $berat_reject[$i]*$harga[$i];
			
	}
	else {
		$harga[$i] = 0;
		$sub_harga[$i] = 0;
		$sub_reject[$i] = 0;
		}

	}

	for ($i=0; $i <count($sub_harga); $i++) { 
		# code...
		$total_harga_sampahkeluar += $sub_harga[$i];
		$berat_sampahkeluar += $berat[$i];
		$total_reject += $sub_reject[$i];
		$tberat_reject += $berat_reject[$i];

	}
	$total_harga_sampahkeluar = $total_harga_sampahkeluar - $total_reject;
	//echo $total_harga_sampahkeluar;die();

		$datax = 
		[
		'id_sampahkeluar'=>$id,
		'jenis_sampahkeluar'=>$jenis_sampahkeluar,
		'berat_sampahkeluar'=>$berat_sampahkeluar-$tberat_reject,
		'tberat_reject'=>$tberat_reject,
		'total_harga_sampahkeluar'=>$total_harga_sampahkeluar-$biaya_sampahkeluar,
		'tujuan_sampahkeluar'=>$tujuan_sampahkeluar,
		'biaya_sampahkeluar'=>$biaya_sampahkeluar,
		'tgl_sampahkeluar'=>$tgl_sampahkeluar,
		'tgl_done'=>$tgl_done,
		'status_sampahkeluar'=>$status_sampahkeluar,
		'keterangan_sampahkeluar'=>$keterangan_sampahkeluar
	 ];

	$this->sk->editsampahkeluar($datax);//CHANGE DATA SK IN DB
	for ($i=0; $i <count($id_kategorisampah); $i++) { 
		# code...
		$sub_harga[$i]=$sub_harga[$i]-$sub_reject[$i];
		$datas = 
		[
			'id_sampahkeluar'=>$id,
			'id_kategorisampah'=>$id_kategorisampah[$i],
			'berat'=>$berat[$i]-$berat_reject[$i],
			'berat_reject'=>$berat_reject[$i],
			'harga_kg'=>$harga[$i],
			'sub_harga'=>$sub_harga[$i],
			'status_terima'=>$status_terima[$i]
		];
		// $this->s->insertdetail($datas);
		$t = $this->sk->getsampahkeluardetail($id_kategorisampah[$i],$id)['message'];
		$yuhu = $this->k->getby2($id_kategorisampah[$i],$this->session->userdata('id_banksampah'))['message'];
		if ($status_terima[$i] == 'terima' && $t['status_terima'] != 'terima' ) {
			# code...
					
			// $yuhu = $this->k->getby2($id_kategorisampah[$i],$this->session->userdata('id_banksampah'))->row_array();
			if ($jenis_sampahkeluar=='jual') {
				# code...
				$datag = [
					'id_banksampah'=>$this->session->userdata('id_banksampah'),
					'id_kategorisampah'=>$id_kategorisampah[$i],
					'qjual' =>$yuhu['qjual']+($berat[$i]-$berat_reject[$i]),
					'qnonjual'=>$yuhu['qnonjual'],
					'qreject'=>$yuhu['qreject']+$berat_reject[$i]
				];
			}
			elseif ($jenis_sampahkeluar == 'nonjual') {
				# code...
				$datag = [
					'id_banksampah'=>$this->session->userdata('id_banksampah'),
					'id_kategorisampah'=>$id_kategorisampah[$i],
					'qjual'=>$yuhu['qjual'],
					'qnonjual' =>$yuhu['qnonjual']+($berat[$i]-$berat_reject[$i]),
					'qreject'=>$yuhu['qreject']+$berat_reject[$i]
				];
			}

			$this->k->editkat3($datag);
	}

	elseif($status_terima[$i] == 'reject' && $t['status_terima'] != 'reject'){
		// $yuhu = $this->k->getby2($id_kategorisampah[$i],$this->session->userdata('id_banksampah'))->row_array();
		// $berat_reject[$i] = $berat[$i];
			$datag = [
				'id_banksampah'=>$this->session->userdata('id_banksampah'),
				'id_kategorisampah'=>$id_kategorisampah[$i],
				'qjual' =>$yuhu['qjual']+0,
				'qnonjual'=>$yuhu['qnonjual']+0,
				'qreject'=>$yuhu['qreject']+$berat_reject[$i]
			];
			//echo($berat_reject[$i]);
			$this->k->editkat3($datag);

		}

		if (count($t)>0) {
			# code...
			 $this->sk->editsampahkeluardetail($datas);
		}
		else{

			$this->sk->insertdetail($datas);
		}
	}

		// print_r($id_kategorisampah);
	// echo "<br>";
	for ($i=0; $i <count($dataf) ; $i++) { 
		# code...
		if (!in_array($dataf[$i]['id_kategorisampah'], $id_kategorisampah)) {
			# code...
			$this->sk->deletesampahkeluardetail($id,$dataf[$i]['id_kategorisampah']);
		}

	}

		$this->session->set_flashdata('inkatsuc', 'value');
		redirect(base_url().'C_Sampahkeluar','refresh');


	}
	else{
		redirect(base_url().'C_User','refresh');
	}

	}

}

/* End of file C_Sampahkeluar.php */
/* Location: ./application/controllers/C_Sampahkeluar.php */
?>