<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Tables</a> </div>
    <h1>Edit Kategori Sampah</h1>
  </div>

  
            <form action="<?php echo base_url()?>C_Katsampah/editkategori/<?php echo $kat['id_kategorisampah']?>" method="POST" class="form-horizontal">
            <div class="control-group">
              <label class="control-label">Id Kategori Sampah :</label>
              <div class="controls">
                <input type="text" class="span3" placeholder="Id Kategori Sampah" name="id_kategorisampah" value="<?php echo $kat['id_kategorisampah']?>" />
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">Golongan</label>
              <div class="controls">
                <select name="golongan">

                  <option value="anorganik" <?php if ($kat['golongan']=='anorganik') echo "selected";?>>Anorganik</option>
                  <option value="organik" <?php if ($kat['golongan']=='organik') echo "selected";?>>Organik</option>
                  <option value="lainnya" <?php if ($kat['golongan']=='lainnya') echo "selected";?>>Lainnya</option><
                </select>

              </div>
            </div>

            <div class="control-group">
              <label class="control-label">Jenis :</label>
              <div class="controls">
                <input type="text" class="span3" placeholder="Jenis Sampah" name="jenis" value="<?php echo $kat['jenis']?>" />
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Harga :</label>
              <div class="controls">
                <input type="number" class="span3" placeholder="Harga Sampah /Kg" name="harga" value="<?php echo $kat['harga']?>" />
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Deskripsi</label>
              <div class="controls">
                <textarea class="span3" name="deskripsi_kat" > <?php echo $kat['deskripsi_kat']?></textarea>
              </div>
            </div>
            <div class="modal-footer">
            <div class="form-actions">
              <button type="submit" class="btn btn-success">Save</button>
              <a data-dismiss="modal" class="btn" href="<?php echo base_url()?>C_Katsampah/">Cancel</a> 
            </div></div>
          </form>

              </div>
            </div>
          </div>
        </div>
      </div>
 
<!--Footer-part-->
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
<script>
  $('.textarea_editor').wysihtml5();
</script>