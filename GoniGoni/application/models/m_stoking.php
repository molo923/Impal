<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_stoking extends CI_Model {

	public function getAll($id)
	{
		# code...
		return $this->db->query("SELECT * FROM `kategorisampah` WHERE `id_banksampah` = '$id' ORDER BY `id_kategorisampah` ASC");
	}

	public function getalls($kode,$id)
	{
		# code...
		return $this->db->query("SELECT * FROM sampah_mutasi WHERE idkatsam_mutasi = (SELECT id_kategorisampah from kategorisampah WHERE kode_kat = '$kode' AND id_banksampah = '$id') GROUP BY idkatsam_dimutasi");

	}

	public function getall_mutasi($kode,$id)
	{
		# code...
		return $this->db->query(" SELECT * FROM sampah_mutasi WHERE idkatsam_dimutasi = (SELECT id_kategorisampah from kategorisampah WHERE kode_kat = '$kode' AND id_banksampah = '$id') GROUP BY idkatsam_mutasi");

	}

	public function getmutasian($id,$point)
	{
		# code...
		
		return $this->db->query("SELECT *, sum(berat_kg) as berat FROM `sampah_mutasi` JOIN kategorisampah on sampah_mutasi.idkatsam_mutasi = kategorisampah.id_kategorisampah WHERE idkatsam_mutasi = '$id' AND idkatsam_dimutasi = '$point' GROUP BY idkatsam_mutasi");
	}

	public function getdimutasi($id,$point)
	{
		# code...
		return $this->db->query("SELECT *, sum(berat_kg) as berat FROM `sampah_mutasi` JOIN kategorisampah on sampah_mutasi.idkatsam_dimutasi = kategorisampah.id_kategorisampah WHERE idkatsam_dimutasi = '$id' AND idkatsam_mutasi = '$point' GROUP BY idkatsam_dimutasi");
	}

	public function getmbykode($kodemut)
	{
		# code...
		$this->db->where('kode_mutasi', $kodemut);
		return $this->db->get('sampah_mutasi');
	}

	public function getrbykode($koderes)
	{
		# code...
		$this->db->where('kode_residu', $koderes);
		return $this->db->get('sampah_residu');
	}

	public function getmaxperiode($id)
	{
		# code...
		return $this->db->query("SELECT date_format(max(histori_sampah.tanggal_histori),'%Y-%m') as periode FROM histori_sampah where id_banksampah = '$id'");
	}

	public function getAllbyper($id,$periode)
	{
		# code...
		return $this->db->query("SELECT *,jenis , kode_kat FROM histori_sampah JOIN kategorisampah using(id_kategorisampah) where histori_sampah.id_banksampah = '$id' AND date_format(tanggal_histori,'%Y-%m') = '$periode' ");
	}

	public function insertmut($data)
	{
		# code...
		$this->db->insert('sampah_mutasi', $data);

	}

	public function insertres($data)
	{
		# code...
		$this->db->insert('sampah_residu', $data);

	}

	public function detailz($id,$kat,$periode,$date)
	{
		# code...
		return $this->db->query("SELECT setoran.tgl_setordone as tgl, setoran_detail.status_sampah as kondisi,setoran.id_setoran as kode, kategorisampah.jenis as jenis, setoran.jenis_setoran as status, setoran_detail.berat as berat, setoran_detail.beratsetoran_reject as rijek FROM setoran_detail JOIN setoran using(id_setoran) JOIN kategorisampah using(id_kategorisampah) WHERE setoran_detail.id_kategorisampah = '$kat' AND kategorisampah.id_banksampah= '$id' AND setoran.tgl_setordone <> '0000-00-00' AND date_format(setoran.tgl_setordone, '%Y-%m') = '$periode' AND date_format(setoran.tgl_setordone, '%d') = $date
UNION ALL
SELECT  sampahkeluar.tgl_done as tgl, sampahkeluar_detail.status_terima, sampahkeluar.id_sampahkeluar, kategorisampah.jenis, sampahkeluar.jenis_sampahkeluar,sampahkeluar_detail.berat, sampahkeluar_detail.berat_reject FROM sampahkeluar_detail JOIN sampahkeluar using(id_sampahkeluar) JOIN kategorisampah using(id_kategorisampah) WHERE sampahkeluar_detail.id_kategorisampah = '$kat' AND kategorisampah.id_banksampah= '$id' AND sampahkeluar.tgl_done <> '0000-00-00'AND date_format(sampahkeluar.tgl_done, '%Y-%m') = '$periode' AND date_format(sampahkeluar.tgl_done, '%d') = $date
UNION ALL
SELECT sampah_residu.tgl_residu as tgl, 'residu', sampah_residu.kode_residu, kategorisampah.jenis, 'residu', sampah_residu.berat_residu,0  from sampah_residu JOIN kategorisampah using(id_kategorisampah) WHERE sampah_residu.id_kategorisampah = '$kat' AND kategorisampah.id_banksampah= '$id' AND date_format(sampah_residu.tgl_residu, '%Y-%m') = '$periode' AND date_format(sampah_residu.tgl_residu, '%d') = $date
UNION ALL
SELECT sampah_mutasi.tgl_mutasi as tgl, 'dimutasi', sampah_mutasi.kode_mutasi, kategorisampah.jenis, 'dimutasi', sampah_mutasi.berat_kg,0 FROM sampah_mutasi JOIN kategorisampah ON sampah_mutasi.idkatsam_mutasi = kategorisampah.id_kategorisampah WHERE sampah_mutasi.idkatsam_mutasi = '$kat' AND kategorisampah.id_banksampah= '$id' AND date_format(sampah_mutasi.tgl_mutasi, '%Y-%m') = '$periode' AND date_format(sampah_mutasi.tgl_mutasi, '%d') = $date
UNION ALL
SELECT sampah_mutasi.tgl_mutasi as tgl, 'mutasian', sampah_mutasi.kode_mutasi, kategorisampah.jenis, 'mutasian', sampah_mutasi.berat_kg,0 FROM sampah_mutasi JOIN kategorisampah ON sampah_mutasi.idkatsam_dimutasi = kategorisampah.id_kategorisampah WHERE sampah_mutasi.idkatsam_dimutasi = '$kat' AND kategorisampah.id_banksampah = '$id' AND date_format(sampah_mutasi.tgl_mutasi, '%Y-%m') = '$periode' AND date_format(sampah_mutasi.tgl_mutasi, '%d') = $date
ORDER by tgl
");
	}

	public function detailz1($id,$kat,$periode)
	{
		# code...
		return $this->db->query("SELECT setoran.tgl_setordone as tgl, setoran_detail.status_sampah as kondisi,setoran.id_setoran as kode, kategorisampah.jenis as jenis, setoran.jenis_setoran as status, setoran_detail.berat as berat, setoran_detail.beratsetoran_reject as rijek FROM setoran_detail JOIN setoran using(id_setoran) JOIN kategorisampah using(id_kategorisampah) WHERE setoran_detail.id_kategorisampah = '$kat' AND kategorisampah.id_banksampah= '$id' AND setoran.tgl_setordone <> '0000-00-00' AND date_format(setoran.tgl_setordone, '%Y-%m') = '$periode'
UNION ALL
SELECT  sampahkeluar.tgl_done as tgl, sampahkeluar_detail.status_terima, sampahkeluar.id_sampahkeluar, kategorisampah.jenis, sampahkeluar.jenis_sampahkeluar,sampahkeluar_detail.berat, sampahkeluar_detail.berat_reject FROM sampahkeluar_detail JOIN sampahkeluar using(id_sampahkeluar) JOIN kategorisampah using(id_kategorisampah) WHERE sampahkeluar_detail.id_kategorisampah = '$kat' AND kategorisampah.id_banksampah= '$id' AND sampahkeluar.tgl_done <> '0000-00-00'AND date_format(sampahkeluar.tgl_done, '%Y-%m') = '$periode'
UNION ALL
SELECT sampah_residu.tgl_residu as tgl, 'residu', sampah_residu.kode_residu, kategorisampah.jenis, 'residu', sampah_residu.berat_residu,0  from sampah_residu JOIN kategorisampah using(id_kategorisampah) WHERE sampah_residu.id_kategorisampah = '$kat' AND kategorisampah.id_banksampah= '$id' AND date_format(sampah_residu.tgl_residu, '%Y-%m') = '$periode'
UNION ALL
SELECT sampah_mutasi.tgl_mutasi as tgl, 'dimutasi', sampah_mutasi.kode_mutasi, kategorisampah.jenis, 'dimutasi', sampah_mutasi.berat_kg,0 FROM sampah_mutasi JOIN kategorisampah ON sampah_mutasi.idkatsam_mutasi = kategorisampah.id_kategorisampah WHERE sampah_mutasi.idkatsam_mutasi = '$kat' AND kategorisampah.id_banksampah= '$id' AND date_format(sampah_mutasi.tgl_mutasi, '%Y-%m') = '$periode'
UNION ALL
SELECT sampah_mutasi.tgl_mutasi as tgl, 'mutasian', sampah_mutasi.kode_mutasi, kategorisampah.jenis, 'mutasian', sampah_mutasi.berat_kg,0 FROM sampah_mutasi JOIN kategorisampah ON sampah_mutasi.idkatsam_dimutasi = kategorisampah.id_kategorisampah WHERE sampah_mutasi.idkatsam_dimutasi = '$kat' AND kategorisampah.id_banksampah = '$id' AND date_format(sampah_mutasi.tgl_mutasi, '%Y-%m') = '$periode'
ORDER by tgl");
	}

	public function getmaxdate($id,$kat,$periode)
	{
		# code...

		return $this->db->query(" SELECT date_format(MAX(setoran.tgl_setordone), '%d') as tgl FROM setoran_detail JOIN setoran using(id_setoran) JOIN kategorisampah using(id_kategorisampah) WHERE setoran_detail.id_kategorisampah = '$kat' AND kategorisampah.id_banksampah= '$id' AND setoran.tgl_setordone <> '0000-00-00' AND date_format(setoran.tgl_setordone, '%Y-%m') = '$periode'
UNION ALL

SELECT  date_format(MAX(sampahkeluar.tgl_done), '%d') as tgl FROM sampahkeluar_detail JOIN sampahkeluar using(id_sampahkeluar) JOIN kategorisampah using(id_kategorisampah) WHERE sampahkeluar_detail.id_kategorisampah = '$kat' AND kategorisampah.id_banksampah= '$id' AND sampahkeluar.tgl_done <> '0000-00-00'AND date_format(sampahkeluar.tgl_done, '%Y-%m') = '$periode'
UNION ALL

SELECT date_format(MAX(sampah_residu.tgl_residu), '%d') as tgl from sampah_residu JOIN kategorisampah using(id_kategorisampah) WHERE sampah_residu.id_kategorisampah = '$kat' AND kategorisampah.id_banksampah= '$id' AND date_format(sampah_residu.tgl_residu, '%Y-%m') = '$periode'
UNION ALL

SELECT date_format(MAX(sampah_mutasi.tgl_mutasi), '%d') as tgl FROM sampah_mutasi JOIN kategorisampah ON sampah_mutasi.idkatsam_mutasi = kategorisampah.id_kategorisampah WHERE sampah_mutasi.idkatsam_mutasi = '$kat' AND kategorisampah.id_banksampah= '$id' AND date_format(sampah_mutasi.tgl_mutasi, '%Y-%m') = '$periode'
UNION ALL

SELECT date_format(MAX(sampah_mutasi.tgl_mutasi), '%d') as tgl FROM sampah_mutasi JOIN kategorisampah ON sampah_mutasi.idkatsam_dimutasi = kategorisampah.id_kategorisampah WHERE sampah_mutasi.idkatsam_dimutasi = '$kat' AND kategorisampah.id_banksampah = '$id' AND date_format(sampah_mutasi.tgl_mutasi, '%Y-%m') = '$periode'

ORDER by tgl");
	}



	


}

/* End of file m_stoking.php */
/* Location: ./application/models/m_stoking.php */