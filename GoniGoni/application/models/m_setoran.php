<?php
use GuzzleHttp\Client;
defined('BASEPATH') OR exit('No direct script access allowed');

class M_setoran extends CI_Model {

private $client;

public function __construct()
{
	parent::__construct();
	$this->client = new Client(['base_uri'=>'http://localhost/gg_server/api/']);
}

public function insertsetoran($data)
{
	# code...
	// $this->db->insert('setoran', $data);
	$response = $this->client->request('POST', 'C_Setoran/postsetoran',
		[
			'form_params'=>$data
		]);
	// $result = json_decode($response->getBody()->getContents(),true);
	// return $result;
}

public function getalljoin($id)
{
	# code...
	// $this->db->where('id_banksampah', $id);
	// $this->db->join('setoran_detail', 'setoran_detail.id_setoran = setoran.id_setoran');
	// $this->db->join('nasabah', 'nasabah.id_nasabah = setoran.id_nasabah','left');
	// $this->db->group_by('setoran.id_setoran');
	// return $this->db->get('setoran');
	$response = $this->client->request('GET', 'C_Setoran/getsetoranjoin',
		[
			'query'=>['id_banksampah'=>$id]
		]);
	$result = json_decode($response->getBody()->getContents(), true);
	return $result;

}

public function getby($id)
{
	# code...
	// $this->db->where('id_setoran', $id);
	// return $this->db->get('setoran');
	$response = $this->client->request('GET', 'C_Setoran/getsetoranbyid',
		[
			'query'=>['id_setoran'=>$id]
		]
	);
	$result = json_decode($response->getBody()->getContents(),true);
	return $result;
}

public function getdetailjoinby($id)
{
	# code...
	// $this->db->where('id_setoran', $id);
	// $this->db->join('kategorisampah', 'kategorisampah.id_kategorisampah = setoran_detail.id_kategorisampah');
	// $this->db->group_by('setoran_detail.id_kategorisampah');
	// return $this->db->get('setoran_detail');
	$response = $this->client->request('GET', 'C_Setoran/getdetailjoinby',
		[
			'query'=>['id_setoran'=>$id]
		]);
	$result = json_decode($response->getBody()->getContents(),true);
	return $result;

}
public function insertdetail($data)
{
	# code...
	// $this->db->insert('setoran_detail', $data);
	$response = $this->client->request('POST', 'C_Setoran/postdetail',
		[
			'form_params'=>$data
		]);
	// $result = json_decode($response->getBody()->getContents(), true);
	// return $result;
}

public function getalljoin2($id)
{
	# code...
	// $this->db->where('setoran.id_setoran', $id);
	// $this->db->join('setoran_detail', 'setoran_detail.id_setoran = setoran.id_setoran');
	// $this->db->join('nasabah', 'nasabah.id_nasabah = setoran.id_nasabah','left');
	// $this->db->order_by('id_kategorisampah');
	// return $this->db->get('setoran');
	$response = $this->client->request('GET', 'C_Setoran/getsetoranjoin1',
		[
			'query'=>['id_banksampah'=>$id]
		]);
	$result = json_decode($response->getBody()->getContents(), true);
	return $result;
}

public function editsetoran($id,$data)
{
	# code...
	// $this->db->where('id_setoran', $id);
	// return $this->db->update('setoran', $data);
	$response = $this->client->request('PUT', 'C_Setoran/putsetoran',
		[
			'form_params'=>$data
		]);
	$result = json_decode($response->getBody()->getContents(), true);
	return $result;

}

public function getsetorandetail($data,$id)
{
	# code...
	// $this->db->where('id_kategorisampah', $data);
	// $this->db->where('id_setoran', $id);
	// return $this->db->get('setoran_detail');
	$response = $this->client->request('GET', 'C_Setoran/getsetorandetail',
		[
			'query'=>['id_kategorisampah'=>$data,'id_setoran'=>$id]
		]);
	$result = json_decode($response->getBody()->getContents(), true);
	return $result;
}

public function editsetorandetail($data)
{
	# code...
	// $this->db->where('id_setoran', $id);
	// $this->db->where('id_kategorisampah', $data);
	// $this->db->update('setoran_detail', $object);
	$response = $this->client->request('PUT', 'C_Setoran/putsetorandetail',
		[
			'form_params'=>$data
		]);
	// $result = json_decode($response->getBody()->getContents(), true);
	// return $result;
}

public function deletesetorandetail($id,$data)
{
	# code...
	// $this->db->where('id_kategorisampah', $data);
	// $this->db->where('id_setoran', $id);
	// $this->db->delete('setoran_detail');
	$response = $this->client->request('DELETE', 'C_Setoran/deletesetorandetail',
		[
			'form_params' =>
			['id_setoran'=>$id,
			'id_kategorisampah'=>$data]
		]);
}

public function getsetorannasabahq($id)
{
	# code...
		$this->db->where('nasabah.id_nasabah', $id);
		$this->db->join('setoran_detail', 'setoran_detail.id_setoran = setoran.id_setoran');
		$this->db->join('nasabah', 'nasabah.id_nasabah = setoran.id_nasabah','left');
		$this->db->group_by('setoran.id_setoran');
		return $this->db->get('setoran');
}
public function getsetorannasabah($id_nasabah)
{
	# code...
	return $this->db->query("SELECT nasabah.nama_nasabah, nasabah.nomorn_wallet, setoran.id_setoran, setoran.tgl_setorin,setoran.tgl_setordone, kategorisampah.kode_kat, kategorisampah.jenis,setoran_detail.berat,setoran_detail.sub_harga, setoran_detail.status_sampah FROM setoran JOIN setoran_detail USING(id_setoran) JOIN kategorisampah using(id_kategorisampah) JOIN nasabah USING(id_nasabah) WHERE id_nasabah = '$id_nasabah' ORDER BY setoran.tgl_setorin DESC");
}


}

/* End of file m_setoran.php */
/* Location: ./application/models/m_setoran.php */
?>