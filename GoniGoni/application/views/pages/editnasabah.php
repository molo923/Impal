<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Tables</a> </div>
    <h1>Tambah Nasabah</h1>
  </div>

  
            <form action="<?php echo base_url()?>C_Nasabah/editnasabah" method="POST" class="form-horizontal">
            <div class="control-group">
              <label class="control-label">Nama Nasabah :</label>
              <div class="controls">
                <div class="span3">
                <input type="text" placeholder="Nama Nasabah" name="nama_nasabah" value="<?= $nasabah[0]['nama_nasabah']?>" />
              </div>
              </div>
            </div>
            <input type="hidden" name="id_nasabah" value="<?= $nasabah[0]['id_nasabah']?>">
            <div class="control-group">
              <label class="control-label">Jenis Kelamin :</label>
              <div class="controls">
                <div class="span3">
                <select name="jenis_kelamin">
                  <option value="Pria" <?php if($nasabah[0]['jenis_kelamin'] == 'Pria'){echo 'selected';}?>>Pria</option>
                  <option value="Wanita" <?php if($nasabah[0]['jenis_kelamin'] == 'Wanita'){echo 'selected';}?>>Wanita</option>
                </select>
                </div>
              </div>
            </div>

              <div class="control-group">
              <label class="control-label">Nomor Hp Nasabah :</label>
              <div class="controls">
                <div class="span3">
                <input type="text" placeholder="Nomor Nasabah" name="nohp_nasabah" value="<?= $nasabah[0]['nohp_nasabah']?>"/>
              </div>
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">Email Nasabah :</label>
              <div class="controls">
                <div class="span3">
                <input type="text" placeholder="Email Nasabah" name="email_nasabah" value="<?= $nasabah[0]['email_nasabah']?>" />
              </div>
              </div>
            </div>

            <div class="control-group">
              <label class="control-label">Alamat Nasabah</label>
              <div class="controls">
                <div class="span3">
                <textarea  name="alamat_nasabah"><?= $nasabah[0]['alamat_nasabah']?></textarea>
              </div>
            </div>  
            </div>


            <div class="modal-footer">
            <div class="form-actions">
              <button type="submit" class="btn btn-success">Save</button>
              <a data-dismiss="modal" class="btn" href="<?php echo base_url()?>C_Nasabah/">Cancel</a> 
            </div></div>
          </form>

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