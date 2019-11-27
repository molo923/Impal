<?php
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Uploadblob extends CI_Model {

	
public function upload($id)
{
	# code...
$koneksi=mysqli_connect("localhost","root","","gg") OR die (" tidak terkoneksi dengan database " );

 $file_name = $_FILES['file']['name']; 
    $tmp_name  = $_FILES['file']['tmp_name']; //nama local temp file di server
    $file_size = $_FILES['file']['size']; 
    $ext = pathinfo($file_name, PATHINFO_EXTENSION);
	
	//OPERASI FILE//
	if($ext = '.pdf'){
    $fp = fopen($tmp_name, 'r'); // open file (read-only, binary)
    $file = fread($fp, $file_size) or die("Tidak dapat membaca source file"); // read file
    $file_content = mysqli_real_escape_string($koneksi,$file) or die("Tidak dapat membaca source file"); // parse image ke string
    fclose($fp); 

    //QUERY DATABASE//

	$qu = "UPDATE banksampah SET legaldoc = $file_content Where username = $id";
	$re = mysqli_query($koneksi,$qu);
	if($re){
		$this->session->set_flashdata('blobsuc', 'Gambar Berhasil Diupload'); }

		else
			{ $this->session->set_flashdata('blobfail', 'Gambar Gagal Diupload'); 
	}
	
	}
 	
 	else{
 		$this->session->set_flashdata('blolbout', 'Harus format .pdf');	
 	} 
}
}

/* End of file uploadblob.php */
/* Location: ./application/models/uploadblob.php */