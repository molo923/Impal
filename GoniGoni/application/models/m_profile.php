<?php
use GuzzleHttp\Client;
defined('BASEPATH') OR exit('No direct script access allowed');

class M_profile extends CI_Model {
	private $client;

	public function __construct()
	{
		parent::__construct();
		$this->client = new Client(['base_uri'=>'http://localhost/gg_server/api/']);
	}


	public function insertprofile($data)
	{
		# code...
		//$this->db->insert('banksampah', $data);
		$response = $this->client->request('POST', 'C_User/users',
			['form_params'=>[
			'nama_banksampah'=>$data['nama_banksampah'],
			'nomor_wallet'=>$data['nomor_wallet'],
			'username'=>$data['username'],
			'password'=>$data['password'],
			'alamat_banksampah'=>$data['alamat_banksampah'],
			'id_induk'=> $data['id_induk'],
			'nohp_banksampah'=>$data['nohp_banksampah'],
			'email_banksampah'=>$data['email_banksampah'],
			'status_banksampah'=>$data['status_banksampah'],
			'longitude'=>$data['longitude'],
			'latitude'=>$data['latitude']
			]
		]);
		$result = json_decode($response->getBody()->getContents(),true);
		return $result;
	}

	public function getby1($param,$val)
	{
		# code...
		$this->db->where('$param', $val);
		return $this->db->get('banksampah');
	}
	public function getbyjoin($username,$password)
	{
		# code...
	// $this->db->where('username',$username);
	// $this->db->where('password',$password);
	// $this->db->join('goniwallet', 'goniwallet.nomor_wallet = banksampah.nomor_wallet');
	// return $query = $this->db->get('banksampah');
		// $client = new Client();
		$response = $this->client->request('GET', 'C_User/users',
			['query'=>[
				'username'=> $username,
				'password'=> $password
			]]);
		$result = json_decode($response->getBody()->getContents(),true);
		 return $result;
	}

}

/* End of file m_profile.php */
/* Location: ./application/models/m_profile.php */