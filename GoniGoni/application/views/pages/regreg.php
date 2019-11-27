<!DOCTYPE html>
<html lang="en">
    
<head>
        <title>Gonigoni Bank Sampah</title><meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" href="<?php echo base_url()?>assets/assettmp/css/bootstrap.min.css" />
		<link rel="stylesheet" href="<?php echo base_url()?>assets/assettmp/css/bootstrap-responsive.min.css" />
        <link rel="stylesheet" href="<?php echo base_url()?>assets/assettmp/css/matrix-login.css" />
        <link rel="stylesheet" href="<?php echo base_url()?>assets/assettmp/css/matrix-style.css" />
        <link rel="stylesheet" href="<?php echo base_url()?>assets/assettmp/css/matrix-media.css" />
        <link href="<?php echo base_url()?>assets/assettmp/font-awesome/css/font-awesome.css" rel="stylesheet" />
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>


    </head>
    <body>
        <div id="loginbox">            
            <form id="form-wizard" class="form-vertical" method="POST" action="<?php echo base_url()?>C_User/insertdata">
				 <div class="control-group normal_text"> <h3><img src="<?php echo base_url()?>assets/assettmp/img/logo.png" alt="Logo" /></h3></div>

                 <div id="form-wizard-1" class="step">

                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <label class="control-label">Nama Bank Sampah</label>
                            <input type="text" placeholder="Nama Bank Sampah" name="namabs" id="username" 
                            onBlur="checkAvailability()"/>
                        </div>
                    </div>
                </div>

                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <label class="control-label">Alamat Bank Sampah</label>
                            <input type="text" placeholder="Alamat Bank Sampah" name="alamat" />
                        </div>
                    </div>
                </div>

                 <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
              <label class="control-label">Jenis Bank Sampah</label>
              <div class="controls">
                <select name="jenis" id='selector'>
                  <option value="induk">Induk</option>
                  <option value="unit">Unit</option>
                </select>
              </div>
            </div></div></div>

                <div class="control-group" id="otherDiv">
                    <div class="controls">
                        <div class="main_input_box">
                            <label class="control-label">Kode Induk Bank Sampah</label>
                            <input type="text" placeholder="Kode Induk Bank Sampah" name="idinduk"  />
                        </div>
                    </div>
                </div>


                 </div>
     
                 <div id="form-wizard-2" class="step">

                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <label class="control-label">Nohp Bank Sampah</label>
                            <input type="text" placeholder="Nohp Bank Sampah" name="nohp" />
                        </div>
                    </div>
                </div>

                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <label class="control-label">Email Bank Sampah</label>
                            <input type="text" placeholder="Email Bank Sampah" name="email" />
                        </div>
                    </div>
                </div>


                 </div> 

                 <div id="form-wizard-3" class="step">

                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <label class="control-label">Username Bank Sampah</label>
                            <input type="text" placeholder="Username Bank Sampah" name="username" />
                        </div>
                    </div>
                </div>

                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <label class="control-label">Password Bank Sampah</label>
                            <input type="password" placeholder="Password Bank Sampah" name="password" id=password />
                        </div>
                    </div>
                </div>

                            <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <label class="control-label">Konfirmasi Password Bank Sampah</label>
                            <input type="password" placeholder="Password Bank Sampah" name="password2" />
                        </div>
                    </div>
                </div>

                 </div> 





                <div class="form-actions">
                <span class="pull-right"><input id="next" class="btn btn-primary" type="submit" value="Next" /></span>
                <span class="pull-right"><input id="back" class="btn btn-primary" type="reset" value="Back" /></span>
                <span class="pull-left"><a type="submit" href="<?php echo base_url()?>C_User" class="btn btn-warning" /> Login</a></span>
                <div id="status"></div>
              </div>
              <div id="submitted"></div>
            </form>
        </div>
        

        <script src="<?php echo base_url()?>assets/assettmp/js/jquery.min.js"></script>  
        <script src="<?php echo base_url()?>assets/assettmp/js/matrix.login.js"></script>
        <script src="<?php echo base_url()?>assets/assettmp/js/jquery.ui.custom.js"></script> 
        <script src="<?php echo base_url()?>assets/assettmp/js/bootstrap.min.js"></script> 
        <script src="<?php echo base_url()?>assets/assettmp/js/jquery.validate.js"></script> 
        <script src="<?php echo base_url()?>assets/assettmp/js/jquery.wizard.js"></script> 
        <script src="<?php echo base_url()?>assets/assettmp/js/matrix.js"></script> 
        <script src="<?php echo base_url()?>assets/assettmp/js/matrix.wizard.js"></script> 
        <script src="<?php echo base_url()?>assets/assettmp/js/googlemap.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCHKtKw1L00pUXGqR-8Z9MVR71_DIjVLDw&callback=myMap"></script>
        <script src="<?php echo base_url()?>assets/assettmp/js/hideshow.js"></script>
        <script type="text/javascript">
            function checkAvailability() {
            var id = $('#username').val();
            //alert(id);
            $.ajax({
                type: "POST",
                url : "<?php echo base_url();?>C_User/cekusername",
                data: { id : id },
                async : false,
                dataType: "json",
                success: function (data) {
                var obj = $.parseJSON(JSON.stringify(data));
                if(obj.length > 0){
                    
                }
                else{
                    
                }
                },
                error: function (response) {
                alert('eror');
        }

            });
        }
        </script>
        
    </body>

</html>
