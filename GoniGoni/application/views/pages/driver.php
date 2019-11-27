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
            <span class="pull-right"><a href="#" class="btn btn-primary">Tambah</a> </span>

          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Id Driver</th>
                  <th>Nama Driver</th>
                  <th>Jenis Kelamin</th>
                  <th>No Hp</th>
                  <th>Alamat Driver</th>
                  <th>Status Driver</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($driver as $d) { ?>
                <tr>
                  <td><?php echo $d['id_driver']; ?></td>
                  <td><?php echo $d['nama_driver']; ?></td>
                  <td><?php echo $d['jk_driver']; ?></td>
                  <td><?php echo $d['nohp_driver']; ?></td>
                  <td><?php echo $d['alamat_driver']; ?> </td>
                  <td> 
                    <select onchange="diaktifkan(this.value,<?php echo $d['id_driver']; ?>)">
                      <option value="aktif" <?php if ($d['status_driver']=='aktif') {
                        # code...
                        echo 'selected';
                      }?>>Aktif</option>
                      <option value="tidak aktif" <?php if ($d['status_driver']=='tidak aktif') {
                        # code...
                        echo 'selected';
                      }?>>Tidak Aktif</option>
                    </select>
                  </td>
                  </tr>
              <?php } ?>
              </tbody>
            </table>
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
    url : "<?php echo base_url();?>C_driver/updatestat",
    data : {val:val,id:id},
  });
}
</script>
<script src="<?php echo base_url()?>assets/assettmp/js/jquery.dataTables.min.js"></script> 
<script src="<?php echo base_url()?>assets/assettmp/js/matrix.tables.js"></script>
