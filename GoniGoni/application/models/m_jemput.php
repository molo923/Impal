<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_jemput extends CI_Model {

	private $t_jemputs = 'jemput_sekali';
	private $t_jemputl = 'jemput_langganan';
	private $t_setoran_langganan = 'setoran_langganan';
	private $t_setoran = 'setoran';

	public function getjemputall() //ambil seluruh data jemput
	{
		$this->db->join('setoran_langganan', 'setoran.id_setoran = setoran_langganan.id_setoran', 'left');
		$this->db->join('jemput_langganan', 'setoran_langganan.id_jemputl = jemput_langganan.id_jemputl', 'left');
		$this->db->join('nasabah', 'setoran.id_nasabah = nasabah.id_nasabah', 'left');
		$this->db->join('jemput_sekali', 'setoran.id_setoran = jemput_sekali.id_setoran', 'left');
		$this->db->where('setoran_langganan.id_jemputl IS NOT NULL');
		$this->db->or_where('id_jemputs IS NOT NULL');
		return $this->db->get('setoran');
	}
	//asaaa

}

/* End of file m_jemput.php */
/* Location: ./application/models/m_jemput.php */