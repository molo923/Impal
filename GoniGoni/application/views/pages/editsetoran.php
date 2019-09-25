<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Tables</a> </div>
    <h1>Table Setoran Sampah</h1>

  <div class="container-fluid">
    <hr>
        <div class="widget-box">
          <div class="widget-title"> 
          </div>
          <div class="widget-content nopadding">
          <form action="<?php echo base_url()?>C_Setoran/editsetorans/<?php echo $data[0]['id_setoran'];?>" method="POST" class="form-horizontal">
                      <div class="input-group-addon"> 
                 <span class="pull-right">
                  <a href="javascript:void(0)" class="btn btn-success addMore"><span class="glyphicon glyphicon glyphicon-plus" aria-hidden="true"></span>Tambah Kategori</a></span>
            </div>    
            <div  class="form-group fieldGroup">
            <div class="control-group">
              <label class="control-label">Kategori Sampah</label>
              <div class="controls">
                <input type="hidden" name="id_kategorisampah[]" value="<?php echo $data[0]['id_kategorisampah']?>" readonly><?php foreach ($kat as $k) { ?>
                 <?php if ($k['id_kategorisampah'] == $data[0]['id_kategorisampah']) { ?>
                  <input type="text" name="" value="<?=$k['jenis'];?>" readonly>
                    
                  <?php }}?>
              </div>
            </div>
            
           <div class="control-group">
              <label class="control-label">Berat Sampah (Kg) :</label>
              <div class="controls">
                <input type="number" class="span3" placeholder="Berat Sampah(Kg)" name="berat_setoran[]" value="<?php echo $data[0]['berat']?>" step='0.01' required />
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">Status Sampah</label>
              <div class="controls">
                <select name="status_sampah[]">
                  <option value="belum selesai" <?php if ($data[0]['status_sampah'] == 'belum selesai') {
                    # code...
                    echo "selected";
                  }?>>Belum Selesai</option>
                  <option value="selesai" <?php if ($data[0]['status_sampah'] == 'selesai') {
                    # code...
                    echo "selected";
                  }?>>Selesai</option>
                  <option value="reject" <?php if ($data[0]['status_sampah'] == 'reject') {
                    # code...
                    echo "selected";
                  }?>>Reject</option>
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
                   <input type="hidden" name="id_kategorisampah[]" value="<?php echo $data[$i]['id_kategorisampah']?>" readonly><?php foreach ($kat as $k) { ?>
                 <?php if ($k['id_kategorisampah'] == $data[$i]['id_kategorisampah']) { ?>
                  <input type="text" name="" value="<?=$k['jenis'];?>" readonly>
                    
                  <?php }}?>
              </div>
            </div>
            
           <div class="control-group">
              <label class="control-label">Berat Sampah (Kg) :</label>
              <div class="controls">
                <input type="number" class="span3" placeholder="Berat Sampah(Kg)" name="berat_setoran[]" value="<?php echo $data[$i]['berat']?>" step='0.01' required/>
              </div>
            </div>

              <div class="control-group">
              <label class="control-label">Status Sampah</label>
              <div class="controls">
                <select name="status_sampah[]">
                  <option value="belum selesai" <?php if ($data[$i]['status_sampah'] == 'belum selesai') {
                    # code...
                    echo "selected";
                  }?>>Belum Selesai</option>
                  <option value="selesai" <?php if ($data[$i]['status_sampah'] == 'selesai') {
                    # code...
                    echo "selected";
                  }?>>Selesai</option>
                  <option value="reject" <?php if ($data[$i]['status_sampah'] == 'reject') {
                    # code...
                    echo "selected";
                  }?>>Reject</option>
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
              <label class="control-label">Biaya Setoran Sampah :</label>
              <div class="controls">
                <input type="number" class="span3" placeholder="Biaya Setoran" name="biaya_setoran" value="<?php echo $data[0]['biaya_setoran']?>" step='0.01' />
              </div>
              </div>

              <div class="control-group">
              <label class="control-label">Nasabah</label>
              <div class="controls">
                <select name="id_nasabah" readonly>
                  <option value="1" <?php if($data[0]['id_nasabah'] == null) {echo 'selected';}?> >Bukan Nasabah</option>
                 <?php foreach ($nasabah as $n) { ?>
                  <option value="<?php echo $n['id_nasabah']?>"<?php if($data[0]['id_nasabah'] == $n['id_nasabah']) {echo 'selected';}?> ><?php echo $n['nama_nasabah'];?></option>
                  <?php } ?>
                </select>
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">Tanggal Setoran Masuk :</label>
              <div class="controls">
                <input type="date" class="span3"  name="tgl_setorin" value="<?php echo $data[0]['tgl_setorin'];?>"/>
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">Jenis Setoran</label>
              <div class="controls">
                <select name="jenis_setoran">
                  <option value="beli" <?php if ($data[0]['jenis_setoran'] == 'beli') {
                    # code...
                    echo "selected";
                  }?>>Beli</option>
                  <option value="hibah" <?php if ($data[0]['jenis_setoran'] == 'hibah') {
                    # code...
                    echo "selected";
                  }?>>Hibah</option>
                  <option value="lainnya" <?php if ($data[0]['jenis_setoran'] == 'lainnya') {
                    # code...
                    echo "selected";
                  }?>>Lainnya</option>
                </select>
              </div>
            </div>

            <div class="control-group" >
              <label class="control-label">Status</label>
              <div class="controls">
                <select name="status_setoran">
                  <option value="diproses" <?php if ($data[0]['status_setoran'] == 'diproses') {
                    # code...
                    echo "selected";
                  }?>>Diproses</option>
                  <option value="selesai" <?php if ($data[0]['status_setoran'] == 'selesai') {
                    # code...
                    echo "selected";
                  }?>>Selesai</option>
                  <option value="reject" <?php if ($data[0]['status_setoran'] == 'reject') {
                    # code...
                    echo "selected";
                  }?>>Reject</option>
                </select>
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">Keterangan</label>
              <div class="controls">
                <textarea class="span3" name="keterangan_setoran"><?php echo $data[0]['keterangan_setoran'];?></textarea>
              </div>
            </div>
            <div class="form-actions">
              <button type="submit" class="btn btn-success">Save</button>
              <a data-dismiss="modal" class="btn" href="<?php echo base_url()?>C_Setoran">Cancel</a> 
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
    //add more fields group
    $(".addMore").click(function(){
        
            var fieldHTML = `<div class="form-group fieldGroup">
            <div class="form-group fieldGroupCopy">    
            <div class="control-group">
            <label class="control-label">Kategori Sampah</label>
            <div class="controls">
            <select name="id_kategorisampah[]" id='countss'>
            <?php foreach ($kat as $k) { 
                    if ($k['status_kat'] == 'aktif') { ?>
              <option value="<?php echo $k['id_kategorisampah']?>"><?php echo $k['jenis']?></option>
              <?php }} ?>
          </select>
    </div>
</div>

           <div class="control-group">
              <label class="control-label">Berat Sampah (Kg)</label>
              <div class="controls">
                <input type="number" class="span3" placeholder="Berat Sampah /Kg" name="berat_setoran[]" step="0.01" required />
              </div>
            </div>
            
              <div class="control-group">
              <label class="control-label">Status Sampah</label>
              <div class="controls">
                <select name="status_sampah[]">
                  <option value="belum selesai" >Belum Selesai</option>
                  <option value="selesai">Selesai</option>
                  <option value="reject">Reject</option>
                </select>
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

