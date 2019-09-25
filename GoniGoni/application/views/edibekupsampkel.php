<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Tables</a> </div>
    <h1>Table Edit Sampah Keluar</h1>

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
          </div>
          <div class="widget-content nopadding">
          <form action="<?php echo base_url()?>C_Sampahkeluar/editsampahkeluars/<?php echo $data[0]['id_sampahkeluar'];?>" method="POST" class="form-horizontal">
                      <div class="input-group-addon"> 
                 <span class="pull-right">
                  <a href="javascript:void(0)" class="btn btn-success addMore"><span class="glyphicon glyphicon glyphicon-plus" aria-hidden="true"></span>Tambah Kategori</a></span>
            </div>    
            <div  class="form-group fieldGroup">
            <div class="control-group">
              <label class="control-label">Kategori Sampah</label>
              <div class="controls">
                <input type="text" name="id_kategorisampah[]" value="<?php echo $data[0]['id_kategorisampah']?>" readonly><?php foreach ($kat as $k) { ?>
                 <?php if ($k['id_kategorisampah'] == $data[0]['id_kategorisampah']) {
                    echo $k['jenis'];
                  }}?>
              </div>
            </div>
            
           <div class="control-group">
              <label class="control-label">Berat :</label>
              <div class="controls">
                <input type="number" class="span3" placeholder="Berat Sampah /Kg" name="berat[]" value="<?php echo $data[0]['berat']?>"  />
              </div>
              <label class="control-label">Berat Reject :</label>
              <div class="controls">
                <input type="number" class="span3" placeholder="Berat Sampah Reject /Kg" name="berat_reject[]" value="<?php echo $data[0]['berat_reject']?>" />
              </div>
            </div>

          <div class="control-group">
              <label class="control-label">Harga/Kg :</label>
              <div class="controls">
                <input type="number" class="span3" placeholder="Harga/Kg" name="harga[]" value="<?php echo $data[0]['harga_kg']?>" />
              </div>
            </div>

          <div class="control-group">
              <label class="control-label">Status Penerimaan</label>
              <div class="controls">
                <select name="status_terima[]">
                  <option value="belum terima" <?php if ($data[0]['status_terima'] == 'belum terima') {
                    # code...
                    echo "selected";
                  }?>>Belum Terima</option>
                  <option value="terima" <?php if ($data[0]['status_terima'] == 'terima') {
                    # code...
                    echo "selected";
                  }?>>Terima</option>
                </select>
              </div>
            </div>
            <hr>

            <div class="input-group-addon"> 

                <center>
                  <a href="javascript:void(0)" class="btn btn-danger remove"><span class="glyphicon glyphicon glyphicon-remove" aria-hidden="true"></span> Hapus</a>
                </center>
            </div>
          </div>



          <?php
          if (count($data)> 1) {

          for ($i=1; $i <= count($data)-1 ; $i++) { ?>
            <div  class="form-group fieldGroup">
            <div class="control-group">
              <label class="control-label">Kategori Sampah</label>
              <div class="controls">
                <input type="text" name="id_kategorisampah[]" value="<?php echo $data[$i]['id_kategorisampah']?>" readonly><?php foreach ($kat as $k) { ?>
                 <?php if ($k['id_kategorisampah'] == $data[$i]['id_kategorisampah']) {
                    echo $k['jenis'];
                  }}?>
              </div>
            </div>
            
           <div class="control-group">
              <label class="control-label">Berat :</label>
              <div class="controls">
                <input type="number" class="span3" placeholder="Berat Sampah /Kg" name="berat[]" value="<?php echo $data[$i]['berat']?>" />
              </div>
              <label class="control-label">Berat Reject :</label>
              <div class="controls">
                <input type="number" class="span3" placeholder="Berat Sampah Reject /Kg" name="berat_reject[]" value="<?php echo $data[$i]['berat_reject']?>" />
              </div>
            </div>

          <div class="control-group">
              <label class="control-label">Harga/Kg :</label>
              <div class="controls">
                <input type="number" class="span3" placeholder="Harga/Kg" name="harga[]" value="<?php echo $data[$i]['harga_kg']?>" />
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">Status Penerimaan</label>
              <div class="controls">
                <select name="status_terima[]">
                  <option value="belum terima" <?php if ($data[$i]['status_terima'] == 'belum terima') {
                    # code...
                    echo "selected";
                  }?>>Belum Terima</option>
                  <option value="terima" <?php if ($data[$i]['status_terima'] == 'terima') {
                    # code...
                    echo "selected";
                  }?>>Terima</option>
                </select>
              </div>
            </div>
            <hr>

          <div class="input-group-addon"> 
           <center><a href="javascript:void(0)" class="btn btn-danger remove"><span class="glyphicon glyphicon glyphicon-remove" aria-hidden="true"></span> Hapus</a></center>
        </div>
          </div>

        <?php } }?>

            <div class="control-group">
              <label class="control-label">Tanggal Sampah Keluar :</label>
              <div class="controls">
                <input type="text" class="span3" placeholder="Id Kategori Sampah" name="tgl_sampahkeluar" value="<?php echo $data[0]['tgl_sampahkeluar'];?>" readonly/>
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">Jenis Sampah Keluar</label>
              <div class="controls">
                <select name="jenis_sampahkeluar" >
                  <option value="jual" <?php if ($data[0]['jenis_sampahkeluar'] == 'jual') {
                    # code...
                    echo "selected";
                  }?>>Jual</option>
                  <option value="nonjual" <?php if ($data[0]['jenis_sampahkeluar'] == 'nonjual') {
                    # code...
                    echo "selected";
                  }?>>Nonjual</option>
                </select>
              </div>
            </div>

            <div class="control-group" >
              <label class="control-label">Status Sampah Keluar</label>
              <div class="controls">
                <select name="status_sampahkeluar">
                  <option value="diproses" <?php if ($data[0]['status_sampahkeluar'] == 'diproses') {
                    # code...
                    echo "selected";
                  }?>>Diproses</option>
                  <option value="selesai" <?php if ($data[0]['status_sampahkeluar'] == 'selesai') {
                    # code...
                    echo "selected";
                  }?>>Selesai</option>
                </select>
              </div>
            </div>


            <div class="control-group">
              <label class="control-label">Keterangan</label>
              <div class="controls">
                <textarea class="span3" name="keterangan_sampahkeluar"><?php echo $data[0]['keterangan_sampahkeluar'];?></textarea>
              </div>
            </div>
            <div class="form-actions">
              <button type="submit" class="btn btn-success">Save</button>
              <a data-dismiss="modal" class="btn" href="<?php echo base_url()?>C_Sampahkeluar">Cancel</a> 
            </div>
          </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!--Footer-part-->
    <script>
$(document).ready(function(){
    //group add limit
    var maxGroup = 10;
    //add more fields group
    $(".addMore").click(function(){

            var fieldHTML = `<div class="form-group fieldGroup">
            <div class="form-group fieldGroupCopy">    
            <div class="control-group">
            <label class="control-label">Kategori Sampah</label>
            <div class="controls">
            <select name="id_kategorisampah[]" id='countss'>
            <?php foreach ($kat as $k) { ?>
              <option value="<?php echo $k['id_kategorisampah']?>"><?php echo $k['jenis']?></option>
              <?php } ?>
          </select>
    </div>
</div>

           <div class="control-group">
              <label class="control-label">Berat :</label>
              <div class="controls">
                <input type="number" class="span3" placeholder="Berat Sampah /Kg" name="berat[]" required />
              </div>
              <label class="control-label">Berat Reject :</label>
              <div class="controls">
                <input type="number" class="span3" placeholder="Berat Sampah Reject /Kg" name="berat_reject[]"/>
              </div>
            </div>

          <div class="control-group">
              <label class="control-label">Harga/Kg :</label>
              <div class="controls">
                <input type="number" class="span3" placeholder="Harga/Kg" name="harga[]" required />
              </div>
            </div>
            <hr>

          <div class="input-group-addon"> 
           <center><a href="javascript:void(0)" class="btn btn-danger remove"><span class="glyphicon glyphicon glyphicon-remove" aria-hidden="true"></span> Hapus</a></center>
        </div>
        </div>
        </div>`;
            $('body').find('.fieldGroup:last').after(fieldHTML);
    });
    
    //remove fields group
    $("body").on("click",".remove",function(){ 
        $(this).parents(".fieldGroup").remove();
    });
});
    </script>
  <script src="<?php echo base_url()?>assets/assettmp/js/jquery.min.js"></script> 
<script src="<?php echo base_url()?>assets/assettmp/js/jquery.ui.custom.js"></script> 
<script src="<?php echo base_url()?>assets/assettmp/js/bootstrap.min.js"></script> 
<script src="<?php echo base_url()?>assets/assettmp/js/bootstrap-colorpicker.js"></script> 
<script src="<?php echo base_url()?>assets/assettmp/js/bootstrap-datepicker.js"></script> 
<script src="<?php echo base_url()?>assets/assettmp/js/jquery.toggle.buttons.js"></script> 
<script src="<?php echo base_url()?>assets/assettmp/js/masked.js"></script> 
<script src="<?php echo base_url()?>assets/assettmp/js/jquery.uniform.js"></script> 
<script src="<?php echo base_url()?>assets/assettmp/js/select2.min.js"></script> 
<script src="<?php echo base_url()?>assets/assettmp/js/matrix.js"></script> 
<script src="<?php echo base_url()?>assets/assettmp/js/matrix.form_common.js"></script> 
<script src="<?php echo base_url()?>assets/assettmp/js/wysihtml5-0.3.0.js"></script> 
<script src="<?php echo base_url()?>assets/assettmp/js/jquery.peity.min.js"></script> 
<script src="<?php echo base_url()?>assets/assettmp/js/bootstrap-wysihtml5.js"></script> 
<script src="<?php echo base_url()?>assets/assettmp/js/hideshow.js"></script>
</body>

    
</html>

