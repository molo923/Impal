<?php
use GuzzleHttp\Client;
defined('BASEPATH') OR exit('No direct script access allowed');

class M_kategorisampah extends CI_Model {

private $client;

public function __construct()
{
	parent::__construct();
	$this->client = new Client(['base_uri'=>'http://localhost/gg_server/api/']);
}

public function getAll($id)
{
	# code...
	// $this->db->where('id_banksampah', $id);
	// return $this->db->get('kategorisampah');
	$response = $this->client->request('GET', 'C_Katsampah/getkatsampah',
		[
			'query'=>['id_banksampah'=>$id]
		]);
	$result = json_decode($response->getBody()->getContents(),true);
	return $result;

}

public function getby($data,$id)
{
	# code...
	// $this->db->where('id_banksampah', $id);
	// $this->db->where('kode_kat', $data);
	// return $this->db->get('kategorisampah');
	$response = $this->client->request('GET', 'C_Katsampah/getkatsampahbykode',
		[
			'query'=>
			[
				'id_banksampah'=>$id,
				'kode_kat'=>$data
			]
		]);
	$result = json_decode($response->getBody()->getContents(),true);
	return $result;

}
public function getby2($data,$id)
{
	# code...
	// $this->db->where('id_banksampah', $id);
	// $this->db->where('id_kategorisampah', $data);
	// return $this->db->get('kategorisampah');
	$response = $this->client->request('GET', 'C_Katsampah/getkatsampahby1',
		[
			'query'=>
			[
				'id_banksampah'=> $id,
				'id_kategorisampah'=> $data
			]
		]);
	$result = json_decode($response->getBody()->getContents(),true);
	return $result;
}


public function insertkat($data)
{
	# code...
	// return $this->db->insert('kategorisampah', $data);
	$response = $this->client->request('POST', 'C_Katsampah/postkatsampah',
		[
			'form_params'=> $data
		]);
	$result = json_decode($response->getBody()->getContents(),true);
	return $result;
}

public function hapuskat($data,$id)
{
	# code...
	// $this->db->where('id_banksampah', $id);
	// $this->db->where('id_kategorisampah', $data);
	// return $this->db->delete('kategorisampah');
	$response = $this->client->request('DELETE', 'C_Katsampah/hapuskatsampah',
		[
			'form_params'=>
			[
				'id_banksampah'=> $id,
				'id_kategorisampah'=> $data
			]
		]);
	$result = json_decode($response->getBody()->getContents(),true);
	return $result;
}

public function updatekat($id,$status)
{
	# code...
	$response = $this->client->request('PUT', 'C_Katsampah/putstatus',
		[
			'form_params'=>
			[
				'id_kategorisampah' => $id,
					'status_kat'=>$status
			]
		]);
	$result = json_decode($response->getBody()->getContents(), true);
	return $result;
}

public function editkat($data)
{
	# code...
	// $this->db->where('id_banksampah', $id);
	// $this->db->where('id_kategorisampah', $point);
	// $this->db->update('kategorisampah', $data);
	$response = $this->client->request('PUT', 'C_Katsampah/putkatsampah',
		[
			'form_params'=>$data
		]);
	$result = json_decode($response->getBody()->getContents(),true);
	return $result;
}


public function editkat1($data)
{
	# code...
	// $this->db->where('id_banksampah', $id);
	// $this->db->where('id_kategorisampah', $point);
	// $this->db->update('kategorisampah', $data);
	$response = $this->client->request('PUT', 'C_Katsampah/putkatsampah1',
		[
			'form_params'=>$data
		]);
	$result = json_decode($response->getBody()->getContents(),true);
	return $result;
}

public function editkat2($data)
{
	# code...
	// $this->db->where('id_banksampah', $id);
	// $this->db->where('id_kategorisampah', $point);
	// $this->db->update('kategorisampah', $data);
	$response = $this->client->request('PUT', 'C_Katsampah/putkatsampah2',
		[
			'form_params'=>$data
		]);
	$result = json_decode($response->getBody()->getContents(),true);
	return $result;
}

public function editkat3($data)
{
	# code...
	// $this->db->where('id_banksampah', $id);
	// $this->db->where('id_kategorisampah', $point);
	// $this->db->update('kategorisampah', $data);
	$response = $this->client->request('PUT', 'C_Katsampah/putkatsampah3',
		[
			'form_params'=>$data
		]);
	$result = json_decode($response->getBody()->getContents(),true);
	return $result;
}

public function editkat4($data)
{
	# code...
		$this->db->where('id_banksampah', $data['id_banksampah']);
		$this->db->where('id_kategorisampah', $data['id_kategorisampah']);
		$this->db->update('kategorisampah', $data);
	// $response = $this->client->request('PUT', 'C_Katsampah/putkatsampah3',
	// 	[
	// 		'form_params'=>$data
	// 	]);
	// $result = json_decode($response->getBody()->getContents(),true);
	// return $result;
}

public function editkat5($data)
{
	# code...
		$this->db->where('id_banksampah', $data['id_banksampah']);
		$this->db->where('id_kategorisampah', $data['id_kategorisampah']);
		$this->db->update('kategorisampah', $data);
	// $response = $this->client->request('PUT', 'C_Katsampah/putkatsampah3',
	// 	[
	// 		'form_params'=>$data
	// 	]);
	// $result = json_decode($response->getBody()->getContents(),true);
	// return $result;
}

public function editkat6($data)
{
	# code...
		$this->db->where('id_banksampah', $data['id_banksampah']);
		$this->db->where('id_kategorisampah', $data['id_kategorisampah']);
		$this->db->update('kategorisampah', $data);
	// $response = $this->client->request('PUT', 'C_Katsampah/putkatsampah3',
	// 	[
	// 		'form_params'=>$data
	// 	]);
	// $result = json_decode($response->getBody()->getContents(),true);
	// return $result;
}


}

/* End of file m_kategorisampah.php */
/* Location: ./application/models/m_kategorisampah.php */