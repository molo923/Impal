<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_driver extends CI_Model {

	public function getdriverby($id)
	{
		# code...
		$this->db->where('id_banksampah', $id);
		return $this->db->get('driver');
	}
	public function updates($id,$val)
	{
	# code...
	$this->db->where('id_driver', $id);
	return $this->db->update('driver', $val);
	}

}

/* End of file m_driver.php */
/* Location: ./application/models/m_driver.php */

?>