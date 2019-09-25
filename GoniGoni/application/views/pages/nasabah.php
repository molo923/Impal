<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Tables</a> </div>
    <h1>Table Data Nasabah</h1>

     <?php if($this->session->flashdata('inkatfail')){ ?>
                <div class="widget-box">
           <div class="alert alert-error">
              <button class="close" data-dismiss="alert"  >×</button>
              <strong>Gagal Menambahkan!</strong> Id Kategori Sampah Sudah Ada</div>
        </div>      <?php } ?> 

         <?php if($this->session->flashdata('inkatsuc')){ ?>
                <div class="widget-box">
           <div class="alert alert-success">
              <button class="close" data-dismiss="alert">×</button>
              <strong>Berhasil !</strong>Data Berhasil Ditambahkan </div>
        </div>      <?php } ?> 

        <?php if($this->session->flashdata('hapuskatsuc')){ ?>
                <div class="widget-box">
           <div class="alert alert-success">
              <button class="close" data-dismiss="alert">×</button>
              <strong>Berhasil !</strong>Data Berhasil Dihapus </div>
        </div>      <?php } ?> 
  </div>
  <div class="container-fluid">
    <hr>
        <div class="widget-box">
          <div class="widget-title"> 
            <span class="pull-right"><a href="<?php echo base_url()?>C_nasabah/insertnasabahform" class="btn btn-primary">Tambah</a> </span>

          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Id Join</th>
                  <th>Id Nasabah</th>
                  <th>Nomor Wallet</th>
                  <th>Nama Nasabah</th>
                  <th>Jenis Kelamin</th>
                  <th>No Hp</th>
                  <th>Email Nasabah</th>
                  <th>Alamat</th>
                  <th>Tanggal Gabung</th>
                  <th>Tanggal Keluar</th>
                  <th>Status Join</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($nasabah as $n) { ?>
                <tr>
                  <td><?php echo $n['id_joins']; ?></td>
                  <td><?php echo $n['id_nasabah']; ?></td>
                  <td><center><?php if ($n['nomorn_wallet'] == null) {echo '-';} else{ echo $n['nomorn_wallet'];}?></center></td>
                  <td><?php echo $n['nama_nasabah']; ?></td>
                  <td><?php echo $n['jenis_kelamin']; ?></td>
                  <td><?php echo $n['nohp_nasabah']; ?></td>
                  <td><?php echo $n['email_nasabah']; ?> </td>
                  <td><?php echo $n['alamat_nasabah']; ?> </td>
                  <td><?php echo $n['tanggal_join']; ?></td>
                  <td><?php echo $n['tanggal_out']; ?></td>
                  <td>
                    <?php if ($n['status_join'] !='keluar'){ ?>
                    <select onchange="diaktifkan(this.value,<?php echo $n['id_joins']; ?>)">
                      <option value="aktif" <?php if ($n['status_join']=='aktif') {
                        # code...
                        echo 'selected';
                      }?>>Aktif</option>
                      <option value="tidak aktif" <?php if ($n['status_join']=='tidak aktif') {
                        # code...
                        echo 'selected';
                      }?>>Tidak Aktif</option>
                      <option value="keluar">Keluar</option>
                    </select>
                  <?php } else{ ?>
                    <input type='text' name="" value="<?php echo $n['status_join'];?>" readonly>
                    <?php } ?>
                  </td>
                <td>
                  <?php if ($n['nomorn_wallet'] == null) { ?>
                    <a href="<?php echo base_url();?>C_nasabah/editnasabahform/<?php echo $n['id_nasabah']?>" class="btn btn-warning">Edit</a>
                  <?php } else{?>
                  <button class="btn btn-warning" onclick="javascript: return alert('Tidak dapat mengedit data nasabah')"> Edit</button> <?php } ?>
  
                    <a href="#myAlert" data-toggle="modal"><button class="btn btn-primary" id="detail" value='' onclick="detailsetoran(<?php echo $n['id_nasabah'];?>)">Detail</button></a>

                     <a href="<?php echo base_url();?>C_nasabah/detailnasabah/<?php echo $n['id_nasabah']?>" class="btn btn-primary">Detail</a>
                  
                </td>
                  </tr>
              <?php } ?>
              </tbody>
            </table>

             <div id="myAlert" class="modal hide">
              <div class="modal-header">
                <a data-dismiss="modal" class="close">×</a>
                <h3 id="huhu">Histori Setoran</h3>
              </div>
              <div class="modal-body">
              <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Id Setoran</th>
                  <th>Tanggal Setor</th>
                  <th>Tanggal Selesai</th>
                  <th>Id Kategori Sampah</th>
                  <th>Jenis Sampah</th>
                  <th>Berat</th>
                  <th>Sub Harga</th>
                  <th>Status Sampah</th>
                </tr>
              </thead>
              <tbody class="detailer">

              </tbody>
            </table>

            </div>
            <div class="modal-footer">
            </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!--Footer-part-->

<script src="<?php echo base_url()?>assets/assettmp/js/jquery.min.js"></script> 
<script src="<?php echo base_url()?>assets/assettmp/js/jquery.ui.custom.js"></script> 
<script src="<?php echo base_url()?>assets/assettmp/js/bootstrap.min.js"></script> 
<script src="<?php echo base_url()?>assets/assettmp/js/jquery.gritter.min.js"></script> 
<script src="<?php echo base_url()?>assets/assettmp/js/jquery.peity.min.js"></script> 
<script src="<?php echo base_url()?>assets/assettmp/js/matrix.js"></script> 
<script src="<?php echo base_url()?>assets/assettmp/js/jquery.dataTables.min.js"></script> 
<script src="<?php echo base_url()?>assets/assettmp/js/matrix.interface.js"></script> 
<script src="<?php echo base_url()?>assets/assettmp/js/matrix.popover.js"></script>
<script type="text/javascript">
function diaktifkan(val,id) {
  // body...
  //alert(id);
  $.ajax({
    type: "POST",
    url : "<?php echo base_url();?>C_nasabah/updatestat",
    data : {val:val,id:id},
  });
}
</script>
<script type="text/javascript">
function detailsetoran(val) {
  // body...
  id_nasabah = val;
  $.ajax({
    type: "POST",
    url:"<?php echo base_url();?>C_nasabah/ceksetorannasabah",
    data:{id_nasabah:id_nasabah},
    dataType:"json",
    success:function(data) {
      // body...
      var html ='';
      for (var i = 0; i < data.length; i++){
      html += `
                <tr class="odd gradeX">
                  <td>`+data[i].id_setoran+`</td>
                  <td>`+data[i].tgl_setorin+`</td>
                  <td>`+data[i].tgl_setordone+`</td>
                  <td>`+data[i].kode_kat+`</td>
                  <td>`+data[i].jenis+`</td>
                  <td>`+data[i].berat+`Kg</td>
                  <td>Rp`+data[i].sub_harga+`,-</td>
                  <td>`+data[i].status_sampah+`</td>
                </tr>
               `;
             }
      $('.detailer').html(html);
      
    },
    error:function(data){
      alert('data');
    }
  });
  
}
</script>
<script src="<?php echo base_url()?>assets/assettmp/js/jquery.dataTables.min.js"></script> 
<script src="<?php echo base_url()?>assets/assettmp/js/matrix.tables.js"></script>
