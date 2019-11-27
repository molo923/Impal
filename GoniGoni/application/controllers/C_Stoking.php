<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_Stoking extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->model('m_stoking','st');
		$this->load->model('m_kategorisampah','k');
	}

	public function index()
	{
	if($this->session->userdata('username')){
	$data['stoking'] = $this->st->getAll($this->session->userdata('id_banksampah'))->result_array();
	$this->load->view('main/header');
	$this->load->view('pages/stoking',$data);

		}
	else{
		redirect(base_url().'C_User','refresh');
	}
	}

	public function histori_sampah()
	{
	if($this->session->userdata('username')){

	$periode = $this->st->getmaxperiode($this->session->userdata('id_banksampah'))->row_array()['periode'];
	if ($this->input->post('periode')) {
			# code...
			$periode = $this->input->post('periode');
			if ($periode == date('Y-m')) {
				# code...
				$stok = $this->st->getAll($this->session->userdata('id_banksampah'))->result_array();
			}
			else{
				$stok = $this->st->getAllbyper($this->session->userdata('id_banksampah'),$periode)->result_array();
			}
		}
	else{
		$stok = $this->st->getAllbyper($this->session->userdata('id_banksampah'),$periode)->result_array();
	}
	$data['periode'] = $periode;
	$data['stoking'] = $stok;
	//print_r($data['stoking']);die();
	$this->load->view('main/header');
	$this->load->view('pages/histori_sampah',$data);

		}
	else{
		redirect(base_url().'C_User','refresh');
	}
	}

	public function detailstok($kat)
	{
		# code...
		$cek = 0;
		$setoran = 0;
		$setoranr = 0;
		$jual = 0;
		$jualr = 0;
		$mutasi = 0;
		$dimutasi = 0;
		$residu = 0;
		$periode = date('Y-m');
		

		if ($this->input->post('periode')) {
			# code...
			$periode = $this->input->post('periode');
		}

		$tang = $this->st->getmaxdate($this->session->userdata('id_banksampah'),$kat,$periode)->result_array();
		$date = 0;
		for ($i=0; $i < count($tang); $i++) { 
			# code...
			if ($date < $tang[$i]['tgl']) {
				# code...
				$date = $tang[$i]['tgl'];
			}

		}
		//print_r($date);die();
		if ($date <= 0) {
			# code...
			$date = '0';
		}
		
		if ($this->input->post('date')) {
			# code...
				$date = $this->input->post('date');
			}

		$dataz = $this->st->detailz($this->session->userdata('id_banksampah'),$kat,$periode,$date)->result_array();
		foreach ($dataz as $d) {
			# code...
			if (substr($d['kode'],0 ,2)=='S-') {
				# code...
				if ($d['kondisi'] == 'reject') {
					# code...
					$setoranr += $d['berat']; 
				}
				else{
					$setoran += $d['berat'];
				}
			}
			else if(substr($d['kode'],0 ,2) == 'SK'){
				if ($d['rijek'] > 0) {
					# code... 
					if ($d['kondisi'] != 'reject' ) {
						# code...
						$jualr += $d['rijek'];
						$jual += $d['berat'];
					}
					else{
						$jualr += $d['rijek'];
					}
				}
				else{
					$jual += $d['berat'];
				}
			}
			else if(substr($d['kode'],0 ,2) == 'M-'){
				if ($d['kondisi'] == 'mutasian') {
					# code...
					$mutasi += $d['berat'];
				}
				else{
					$dimutasi += $d['berat'];
				}
			}
			else{
				$residu += $d['berat'];
			}
			
		}

		if ($this->input->post('detail')) {
			# code...
			$cek = 1;
		}
		$data['maxtang'] = $tang[0]['tgl'];
		$data['date'] = $date;
		$data['cek'] = $cek;
		$data['detail'] = $dataz ;
		$data['periode'] = $periode;
		$data['id_kat'] = $kat;
		$data['kat'] = $this->k->getby2($kat,$this->session->userdata('id_banksampah'))['message'];
		$data['setoran'] = $setoran;
		$data['setoranr'] = $setoranr; 
		$data['jual'] = $jual;
		$data['jualr'] = $jualr;
		$data['mutasi'] = $mutasi;
		$data['dimutasi'] = $dimutasi;
		$data['residu'] = $residu;
		$this->load->view('main/header');
		$this->load->view('pages/detail',$data);
		//$this->load->view('main/footer');
	}

	public function getsumsampah()
	{
		# code...
		$kat = $this->input->post('kat');
		$setorna = [];
		$setoranra = [];
		$juala = [];
		$jualra = [];
		$mutasia = [];
		$dimutasia = [];
		$residua = [];
		$no = 0;
		
		for ($i= date("m", strtotime("- 1 months")); $i > 0 ; $i--) { 
			# code...
		
		$setoran = 0;
		$setoranr = 0;
		$jual = 0;
		$jualr = 0;
		$mutasi = 0;
		$dimutasi = 0;
		$residu = 0;
		
		$dataz = $this->st->detailz1($this->session->userdata('id_banksampah'),$kat,date("Y-m", strtotime("- $i months")))->result_array();
		foreach ($dataz as $d) {
			# code...
			if (substr($d['kode'],0 ,2)=='S-') {
				# code...
				if ($d['kondisi'] == 'reject') {
					# code...
					$setoranr += $d['berat']; 
				}
				else{
					$setoran += $d['berat'];
				}
			}
			else if(substr($d['kode'],0 ,2) == 'SK'){
				if ($d['rijek'] > 0) {
					# code... 
					if ($d['kondisi'] != 'reject' ) {
						# code...
						$jualr += $d['rijek'];
						$jual += $d['berat'];
					}
					else{
						$jualr += $d['rijek'];
					}
				}
				else{
					$jual += $d['berat'];
				}
			}
			else if(substr($d['kode'],0 ,2) == 'M-'){
				if ($d['kondisi'] == 'mutasian') {
					# code...
					$mutasi += $d['berat'];
				}
				else{
					$dimutasi += $d['berat'];
				}
			}
			else{
				$residu += $d['berat'];
			}
			
		}
		$no +=1;
		$setorana[$no] = $setoran;
		$setoranra[$no] = $setoranr;
		$juala[$no] = $jual;
		$jualra[$no] = $jualr;
		$mutasia[$no] = $mutasi;
		$dimutasia[$no] = $dimutasi;
		$residua[$no] = $residu;
	}
	
	$result = [$setorana, $setoranra, $juala, $jualra, $mutasia, $dimutasia, $residua];
	
	echo json_encode($result);
	}
	
	public function getmutasian()
	{
		# code...
		$id = $this->input->post('val');
		$data=[];
		$all = $this->st->getall_mutasi($id,$this->session->userdata('id_banksampah'))->result();
		for ($i=0; $i < count($all) ; $i++) { 
			# code...
			$data[$i] =  $this->st->getmutasian($all[$i]->idkatsam_mutasi, $all[$i]->idkatsam_dimutasi)->result();
			
		}
		echo json_encode($data);

	}

		public function getdimutasi()
	{
		# code...
		$id = $this->input->post('val');
		$data=[];
		$all = $this->st->getAlls($id,$this->session->userdata('id_banksampah'))->result();
		for ($i=0; $i < count($all) ; $i++) { 
			# code...
			$point[$i] = $all[$i]->idkatsam_dimutasi;
			$data[$i] =  $this->st->getdimutasi( $all[$i]->idkatsam_dimutasi,$all[$i]->idkatsam_mutasi)->result();
			
			
		}
		echo json_encode($data);

	}

		public function mutasiform($id)
	{
		# code...
			$data['kat'] = $this->k->getAll($this->session->userdata('id_banksampah'))['message'];
			$data['id'] = $id;
			$this->load->view('main/header');
			$this->load->view('pages/mutasi',$data);

	}
		public function insertmutasi($id)
	{
		# code...
			$tgl_mutasi = $this->input->post('tgl_mutasi');
			$id_kategorisampah =  $this->input->post('id_kategorisampah');
			$berat_kg =  $this->input->post('berat_kg');
			$t = $this->k->getby($id,$this->session->userdata('id_banksampah'))['message'];

			do {
		# code...
					$kode_mutasi ='M-';
					for ($i=1; $i <=3 ; $i++) { 
						# code...
						$nomor = rand(0,9);
						$kode_mutasi = $kode_mutasi.$nomor;
					}
					$ququ = $this->st->getmbykode($kode_mutasi)->result_array();
					//echo count($ququ);die();

				} while (count($ququ) > 0);
		
				# code...
				$t1 = $this->k->getby2($id_kategorisampah,$this->session->userdata('id_banksampah'))['message'];
				$data = array(
				'id_banksampah'=>$this->session->userdata('id_banksampah'),
				'kode_mutasi'=>$kode_mutasi,
				'tgl_mutasi' => $tgl_mutasi,
				'idkatsam_mutasi'=>$t[0]['id_kategorisampah'],
				'idkatsam_dimutasi'=>$id_kategorisampah,
				'berat_kg'=>$berat_kg);
				$this->st->insertmut($data);

				$mutasian = 
				[
					'id_banksampah'=>$this->session->userdata('id_banksampah'),
					'id_kategorisampah'=>$id_kategorisampah,
					'qmutasian'=>$t1['qmutasian']+$berat_kg
				];
				//echo($mutasian['qmutasian']);die();
				$this->k->editkat4($mutasian);

				$dimutasi = 
				[
					'id_banksampah'=>$this->session->userdata('id_banksampah'),
					'id_kategorisampah'=>$t[0]['id_kategorisampah'],
					'qdimutasi'=> $t[0]['qdimutasi']+$berat_kg
				];
			$this->k->editkat5($dimutasi);
			
			$this->session->set_flashdata('inkatsuc', 'value');
			redirect(base_url().'C_Stoking','refresh');

	}

	public function insertresidu($id)
	{
		# code...
		$qresidu = $this->input->post('qresidu');
		$t = $this->k->getby($id,$this->session->userdata('id_banksampah'))['message'];
		$tgl_residu =  date("Y-m-d H:i:s");

		do {
		# code...
					$kode_residu ='R-';
					for ($i=1; $i <=3 ; $i++) { 
						# code...
						$nomor = rand(0,9);
						$kode_residu = $kode_residu.$nomor;
					}
					$ququ = $this->st->getrbykode($kode_residu)->result_array();
					//echo count($ququ);die();

				} while (count($ququ) > 0);

		$datab = array(
				'id_banksampah'=>$this->session->userdata('id_banksampah'),
				'kode_residu'=>$kode_residu,
				'tgl_residu' => $tgl_residu,
				'id_kategorisampah'=>$t[0]['id_kategorisampah'],
				'berat_residu'=>$qresidu);
				$this->st->insertres($datab);

		$data = 
		[
			'id_kategorisampah'=>$t[0]['id_kategorisampah'],
			'id_banksampah'=>$this->session->userdata('id_banksampah'),
			'qresidu'=>$t[0]['qresidu'] + $qresidu
		];
		$this->k->editkat6($data);
		$this->session->set_flashdata('inkatsuc', 'value');
		redirect(base_url().'C_Stoking','refresh');

	}

}

/* End of file C_Stoking.php */
/* Location: ./application/controllers/C_Stoking.php */
?>