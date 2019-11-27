<?php
use GuzzleHttp\Client;
defined('BASEPATH') OR exit('No direct script access allowed');

class M_nasabah extends CI_Model {

private $client;
public function __construct()
{
	parent::__construct();
	$this->client = new Client(['base_uri'=>'http://localhost/gg_server/api/']);
}

public function insertnasabah($data)
{
	# code...
	// $this->db->insert('nasabah', $data);
	$response = $this->client->request('POST', 'C_Nasabah/nasabah',
		[
			'form_params'=> $data
		]);
	$result = json_decode($response->getBody()->getContents(), true);
	return $result;
}

public function getnasabahby($id)
{
	# code...
	return $this->db->query("SELECT banksampah.id_banksampah,banksampah.nama_banksampah,nasabah.id_nasabah,nasabah.nama_nasabah,join_akun.tanggal_join FROM join_akun JOIN banksampah using(id_banksampah) JOIN nasabah using(id_nasabah) WHERE banksampah.id_banksampah='$id'");	

}

public function getnasabahbyid($id)
{
	# code...
	$response = $this->client->request('GET', 'C_Nasabah/nasabahid',
		[
			'query'=>['id_nasabah'=>$id]
		]);
	$result =json_decode($response->getBody()->getContents(),true);
	return $result;
}

public function getnasabahbyusr($usr)
{
	# code...
	$response = $this->client->request('GET', 'C_Nasabah/nasabah',
		[
			'query'=>['username'=>$usr]
		]);
	$result = json_decode($response->getBody()->getContents(),true);
	return $result;
}

public function getnasabahby1($id)
{
	# code...
	// $this->db->where('banksampah.id_banksampah', $id);
	// $this->db->join('nasabah', 'nasabah.id_nasabah = join_akun.id_nasabah');
	// $this->db->join('banksampah', 'banksampah.id_banksampah = join_akun.id_banksampah');
	// return $this->db->get('join_akun');
	$response = $this->client->request('GET', 'C_Nasabah/nasabahbs',
		[
			'query'=>['id_banksampah'=>$id]
		]);
	$result = json_decode($response->getBody()->getContents(),true);
	return $result;
}

public function insertjoins($data)
{
	# code...
	$response = $this->client->request('POST', 'C_Nasabah/joinakun',
		[
			'form_params'=> $data
		]);
	$result = json_decode($response->getBody()->getContents(), true);
	return $result;
}

public function updates($id,$val)
{
	# code...
	$this->db->where('id_joins', $id);
	return $this->db->update('join_akun', $val);
}

public function editnasabah($data)
{
	# code...
	$response = $this->client->request('PUT', 'C_Nasabah/editnasabah',
		[
			'form_params'=>$data
		]);
	$result = json_decode($response->getBody()->getContents(),true);
	return $result;
}


}

/* End of file m_nasabah.php */
/* Location: ./application/models/m_nasabah.php */

?>