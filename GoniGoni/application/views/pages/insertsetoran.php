<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Tables</a> </div>
    <h1>Insert Setoran Sampah</h1>

  <div class="container-fluid">
    <hr>
        <div class="widget-box">
          <div class="widget-title"> 
          </div>
          <div class="widget-content nopadding">
          <form action="<?php echo base_url()?>C_Setoran/insertsetoran" method="POST" class="form-horizontal">
            <div  class="form-group fieldGroup">
            <div class="control-group">
              <label class="control-label">Kategori Sampah</label>
              <div class="controls">
                <select name="id_kategorisampah[]">
                  <?php foreach ($kat as $k) { 
                    if ($k['status_kat'] == 'aktif') { ?>
                  <option value="<?php echo $k['id_kategorisampah']?>"><?php echo $k['jenis']?></option>
                <?php } } ?>
                </select>
              </div>
            </div>
            
           <div class="control-group">
              <label class="control-label">Berat :</label>
              <div class="controls">
                <input type="number" step="0.01" class="span3" placeholder="Berat Sampah /Kg" name="berat_setoran[]" required />
              </div>
            </div>
            <hr>

            <div class="input-group-addon"> 
                <center><a href="javascript:void(0)" class="btn btn-success addMore"><span class="glyphicon glyphicon glyphicon-plus" aria-hidden="true"></span>Tambah</a></center>
            </div>
          </div>

            <div class="control-group">
              <label class="control-label">Nasabah</label>
              <div class="controls">
                <select name="id_nasabah">
                  <option value="0">Bukan Nasabah</option>
                <?php foreach ($nasabah as $n) { 
                  if ($n['status_join'] == 'aktif') {
                  ?>
                  <option value="<?php echo $n['id_nasabah']?>"><?php echo $n['nama_nasabah']?></option>
                <?php } }?>
                </select>
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">Tanggal Setoran Masuk :</label>
              <div class="controls">
                <input type="date" class="span3" placeholder="Id Kategori Sampah" name="tgl_setorin" value="<?php echo date("Y-m-d");?>" />
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">Jenis Setoran</label>
              <div class="controls">
                <select name="jenis_setoran">
                  <option value="beli">Beli</option>
                  <option value="hibah">Hibah</option>
                  <option value="lainnya">Lainnya</option>
                </select>
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">Biaya Setoran</label>
              <div class="controls">
                <input type="number" step="0.01" class="span3" placeholder="Tambahan Biaya" name="biaya_setoran" value="0" />
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">Status</label>
              <div class="controls">
                <select name="status_setoran">
                  <option value="diproses" >Diproses</option>
                  <option value="selesai">Selesai</option>
                </select>
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">Keterangan</label>
              <div class="controls">
                <textarea class="span3" name="keterangan_setoran"></textarea>
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
    var maxGroup = 10;
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
              <?php } }?>
          </select>
    </div>
</div>

           <div class="control-group">
              <label class="control-label">Berat :</label>
              <div class="controls">
                <input type="number" step='0.01'class="span3" placeholder="Berat Sampah /Kg" name="berat_setoran[]" required />
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

