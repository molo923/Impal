<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Tables</a> </div>
    <h1>Insert Sampah Keluar</h1>

  <div class="container-fluid">
    <hr>
        <div class="widget-box">
          <div class="widget-title"> 
          </div>
          <div class="widget-content nopadding">
          <form action="<?php echo base_url()?>C_Sampahkeluar/insertsampahkeluar" method="POST" class="form-horizontal">
            <div  class="form-group fieldGroup">
            <div class="control-group">
              <label class="control-label">Kategori Sampah</label>
              <div class="controls">
                <select name="id_kategorisampah[]">
                  <?php foreach ($kat as $k) { 
                    if ($k['status_kat'] == 'aktif') { ?>
                  <option value="<?php echo $k['id_kategorisampah']?>"><?php echo $k['jenis']?></option>
                <?php }} ?>
                </select>
              </div>
            </div>
            
           <div class="control-group">
              <label class="control-label">Berat :</label>
              <div class="controls">
                <input type="number" step='0.01' class="span3" placeholder="Berat Sampah /Kg" name="berat[]" required />
              </div>
            </div>

          <div class="control-group">
              <label class="control-label">Harga/Kg :</label>
              <div class="controls">
                <input type="number" step='0.01' class="span3" placeholder="Harga/Kg" name="harga[]" required />
              </div>
            </div>
            <hr>

            <div class="input-group-addon"> 
                <center><a href="javascript:void(0)" class="btn btn-success addMore"><span class="glyphicon glyphicon glyphicon-plus" aria-hidden="true"></span>Tambah</a></center>
            </div>
          </div>


            <div class="control-group">
              <label class="control-label">Tanggal Sampah Keluar :</label>
              <div class="controls">
                <input type="date" class="span3" placeholder="Id Kategori Sampah" name="tgl_sampahkeluar" value="<?php echo date("Y-m-d");?>" />
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Tujuan Sampah Keluar :</label>
              <div class="controls">
                <input type="text" class="span3" placeholder="Tujuan Sampah Keluar" name="tujuan_sampahkeluar" required />
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">Biaya Sampah Keluar :</label>
              <div class="controls">
                <input type="number" step='0.01' class="span3" placeholder="Biaya Sampah" name="biaya_sampahkeluar" value="0" />
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">Jenis Sampah Keluar</label>
              <div class="controls">
                <select name="jenis_sampahkeluar" >
                  <option value="jual">Jual</option>
                  <option value="nonjual">Nonjual</option>
                </select>
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">Status</label>
              <div class="controls">
                <select name="status_sampahkeluar">
                  <option value="diproses">Diproses</option>
                  <option value="selesai">Selesai</option>
                </select>
              </div>
            </div>


            <div class="control-group">
              <label class="control-label">Keterangan</label>
              <div class="controls">
                <textarea class="span3" name="keterangan_sampahkeluar"></textarea>
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
            <?php foreach ($kat as $k) { 
                    if ($k['status_kat'] == 'aktif') { ?>
              <option value="<?php echo $k['id_kategorisampah']?>"><?php echo $k['jenis']?></option>
              <?php }}?>
          </select>
    </div>
</div>

           <div class="control-group">
              <label class="control-label">Berat :</label>
              <div class="controls">
                <input type="number" class="span3" placeholder="Berat Sampah /Kg" name="berat[]" required />
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

