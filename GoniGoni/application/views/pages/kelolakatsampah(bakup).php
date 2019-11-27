<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Tables</a> </div>
    <h1>Table Kategori Sampah</h1>

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
            <span class="pull-right"><a href="#myAlert" data-toggle="modal" class="btn btn-primary">Tambah</a> </span>
            <div id="myAlert" class="modal hide">
              <div class="modal-header">
                <button data-dismiss="modal" class="close" type="button">×</button>
                <h3>Tambah Kategori</h3>
              </div>
              <div class="modal-body">

            <form action="<?php echo base_url()?>C_Katsampah/tambahkategori" method="POST" class="form-horizontal">
            <div class="control-group">
              <label class="control-label">Id Kategori Sampah :</label>
              <div class="controls">
                <input type="text" class="span3" placeholder="Id Kategori Sampah" name="id_kategorisampah" required />
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">Golongan</label>
              <div class="controls">
                <select name="golongan">
                  <option value="anorganik">Anorganik</option>
                  <option value="organik">Organik</option>
                  <option value="lainnya">Lainnya</option>
                </select>
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">Jenis :</label>
              <div class="controls">
                <input type="text" class="span3" placeholder="Jenis Sampah" name="jenis" required />
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Harga :</label>
              <div class="controls">
                <input type="number" class="span3" placeholder="Harga Sampah /Kg" name="harga" required />
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Deskripsi</label>
              <div class="controls">
                <textarea class="span3" name="deskripsi_kat"></textarea>
              </div>
            </div>
            <div class="modal-footer">
            <div class="form-actions">
              <button type="submit" class="btn btn-success">Save</button>
              <a data-dismiss="modal" class="btn" href="#">Cancel</a> 
            </div></div>
          </form>

              </div>
            </div>

          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>Id Kategori Sampah</th>
                  <th>Golongan</th>
                  <th>Jenis</th>
                  <th>Harga</th>
                  <th>Deskripsi</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                if ($kat) {
                  foreach ($kat as $k) { ?>
                  <tr>
                    <td><?php echo $k['id_kategorisampah'];?></td>
                    <td><?php echo $k['golongan'];?></td>
                    <td><?php echo $k['jenis'];?></td>
                    <td>Rp<?php echo $k['harga'];?>,-/Kg</td>
                    <td><?php echo $k['deskripsi_kat'];?></td>
                     <td><center><a href="<?php echo base_url()?>C_Katsampah/editkatform/<?php echo $k['id_kategorisampah'];?>"><button class="btn btn-warning">edit</button></a>
                     <a href="<?php echo base_url()?>C_Katsampah/hapuskat/<?php echo $k['id_kategorisampah'];?>"><button class="btn btn-danger" onclick="javascript: return confirm('Anda yakin hapus ?')">hapus</button></a>
                    </center></td>
                  </tr>
                <?php  }
                    }
                  ?>
              </tbody>

            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!--Footer-part-->
<script src="<?php echo base_url()?>assets/assettmp/js/bootstrap-colorpicker.js"></script> 
<script src="<?php echo base_url()?>assets/assettmp/js/bootstrap-datepicker.js"></script> 
<script src="<?php echo base_url()?>assets/assettmp/js/jquery.toggle.buttons.js"></script> 
<script src="<?php echo base_url()?>assets/assettmp/js/masked.js"></script> 
<script src="<?php echo base_url()?>assets/assettmp/js/matrix.form_common.js"></script>
<script src="<?php echo base_url()?>assets/assettmp/js/wysihtml5-0.3.0.js"></script> 
<script src="<?php echo base_url()?>assets/assettmp/js/jquery.peity.min.js"></script> 
<script src="<?php echo base_url()?>assets/assettmp/js/bootstrap-wysihtml5.js"></script> 
<script src="<?php echo base_url()?>assets/assettmp/js/jquery.min.js"></script> 
<script src="<?php echo base_url()?>assets/assettmp/js/jquery.ui.custom.js"></script> 
<script src="<?php echo base_url()?>assets/assettmp/js/bootstrap.min.js"></script> 
<script src="<?php echo base_url()?>assets/assettmp/js/jquery.uniform.js"></script> 
<script src="<?php echo base_url()?>assets/assettmp/js/select2.min.js"></script> 
<script src="<?php echo base_url()?>assets/assettmp/js/jquery.dataTables.min.js"></script> 
<script src="<?php echo base_url()?>assets/assettmp/js/matrix.tables.js"></script>
<script src="<?php echo base_url()?>assets/assettmp/js/matrix.interface.js"></script> 
<script src="<?php echo base_url()?>assets/assettmp/js/matrix.popover.js"></script>
<script>
  $('.textarea_editor').wysihtml5();
</script>