<?php
use GuzzleHttp\Client;
defined('BASEPATH') OR exit('No direct script access allowed');

class M_wallet extends CI_Model {
private $client;

public function __construct()
{
	parent::__construct();
	$this->client = new Client(['base_uri'=>'http://localhost/gg_server/api/']);
}

public function insert($data)
{
	# code...

	//return $this->db->insert('goniwallet', $data);

	//$client = new Client();
	$response = $this->client->request('POST', 'C_User/wallets',
		['form_params'=>[
		'nomor_wallet'=> $data['nomor_wallet'],
		'saldo'=>$data['saldo'],
		'limit_wallet'=>$data['limit_wallet']
					]
		]
	);
	$result = json_decode($response->getBody()->getContents(),true);
	return $result;
}
	

}

/* End of file m_wallet.php */
/* Location: ./application/models/m_wallet.php */