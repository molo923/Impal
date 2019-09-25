<?php
use GuzzleHttp\Client;
defined('BASEPATH') OR exit('No direct script access allowed');

class M_sampahkeluar extends CI_Model {

private $client;

	public function __construct()
	{
		parent::__construct();
		$this->client = new Client(['base_uri'=>'http://localhost/gg_server/api/']);
		
	}

	public function getby($id)
{
	# code...
	// $this->db->where('id_sampahkeluar', $id);
	// return $this->db->get('sampahkeluar');
	$response = $this->client->request('GET', 'C_Sampahkeluar/getbyid',
		[
			'query'=>['id_sampahkeluar'=>$id]
		]);
	$result = json_decode($response->getBody()->getContents(), true);
	return $result;
}

	public function insertsampahkeluar($data)
{
	# code...
	//$this->db->insert('sampahkeluar', $data);
	$response = $this->client->request('POST', 'C_Sampahkeluar/postsampahkeluar',
		[
			'form_params'=>$data
		]);
	$result = json_decode($response->getBody()->getContents(), true);
	return $result;
}

	public function insertdetail($data)
{
	# code...
	// $this->db->insert('sampahkeluar_detail', $data);
	$response = $this->client->request('POST', 'C_Sampahkeluar/postskdetail',
		[
			'form_params'=>$data
		]);
	$result = json_decode($response->getBody()->getContents(), true);
	return $result;
}

	public function getalljoin($id)
{
	# code...
	// $this->db->where('id_banksampah', $id);
	// $this->db->join('sampahkeluar_detail', 'sampahkeluar_detail.id_sampahkeluar = sampahkeluar.id_sampahkeluar');
	// $this->db->group_by('sampahkeluar.id_sampahkeluar');
	// return $this->db->get('sampahkeluar');
	$response = $this->client->request('GET', 'C_Sampahkeluar/getallskjoin',
		[
			'query'=>['id_banksampah'=>$id]
		]);
	$result = json_decode($response->getBody()->getContents(), true);
	return $result;
}

	public function getdetailjoinby($id)
{
	# code...
	// $this->db->where('id_sampahkeluar', $id);
	// $this->db->join('kategorisampah', 'kategorisampah.id_kategorisampah = sampahkeluar_detail.id_kategorisampah');
	// $this->db->group_by('sampahkeluar_detail.id_kategorisampah');
	// return $this->db->get('sampahkeluar_detail');
	$response = $this->client->request('GET', 'C_Sampahkeluar/getdetailjoinby',
		[
			'query'=>['id_sampahkeluar'=>$id]
		]);
	$result = json_decode($response->getBody()->getContents(), true);
	return $result;
}

	public function getalljoin2($id)
{
	# code...
	// $this->db->where('sampahkeluar.id_sampahkeluar', $id);
	// $this->db->join('sampahkeluar_detail', 'sampahkeluar_detail.id_sampahkeluar = sampahkeluar.id_sampahkeluar');
	// $this->db->order_by('id_kategorisampah');
	// return $this->db->get('sampahkeluar');
	$response = $this->client->request('GET', 'C_Sampahkeluar/getallskjoin2',
		[
			'query'=>['id_sampahkeluar'=>$id]
		]);
	$result = json_decode($response->getBody()->getContents(), true);
	return $result;
}

	public function editsampahkeluar($data)
{
	# code...
	// $this->db->where('id_sampahkeluar', $id);
	// $this->db->update('sampahkeluar', $data);
	$response = $this->client->request('PUT', 'C_Sampahkeluar/putsampahkeluar',
		[
			'form_params'=>$data
		]);
	$result = json_decode($response->getBody()->getContents(), true);
}
	public function getsampahkeluardetail($data,$id)
{
	# code...
	// $this->db->where('id_kategorisampah', $data);
	// $this->db->where('id_sampahkeluar', $id);
	// return $this->db->get('sampahkeluar_detail');
	$response = $this->client->request('GET', 'C_Sampahkeluar/getskdetail',
		[
			'query'=>['id_sampahkeluar'=>$id,'id_kategorisampah'=>$data]
		]);
	$result = json_decode($response->getBody()->getContents(), true);
	return $result;
}
	public function editsampahkeluardetail($data)
{
	# code...
	// $this->db->where('id_sampahkeluar', $id);
	// $this->db->where('id_kategorisampah', $data);
	// $this->db->update('sampahkeluar_detail', $object);
	$response = $this->client->request('PUT', 'C_Sampahkeluar/putskdetail',
		[
			'form_params'=>$data
		]);
	$result = json_decode($response->getBody()->getContents(), true);

}
	public function deletesampahkeluardetail($id,$data)
{
	# code...
	// $this->db->where('id_kategorisampah', $data);
	// $this->db->where('id_sampahkeluar', $id);
	// $this->db->delete('sampahkeluar_detail');
	$response = $this->client->request('DELETE', 'C_Sampahkeluar/deleteskdetail',
		[
			'form_params'=>['id_sampahkeluar'=>$id,'id_kategorisampah'=>$data]
		]);
	$result = json_decode($response->getBody()->getContents());

}


}

/* End of file m_sampahkeluar.php */
/* Location: ./application/models/m_sampahkeluar.php */