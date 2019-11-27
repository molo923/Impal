<!DOCTYPE html>
<html lang="en">
    
<head>
        <title>Gonigoni Bank Sampah</title><meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" href="<?php echo base_url()?>assets/assettmp/css/bootstrap.min.css" />
		<link rel="stylesheet" href="<?php echo base_url()?>assets/assettmp/css/bootstrap-responsive.min.css" />
        <link rel="stylesheet" href="<?php echo base_url()?>assets/assettmp/css/matrix-login.css" />
        <link href="<?php echo base_url()?>assets/assettmp/font-awesome/css/font-awesome.css" rel="stylesheet" />
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>

    </head>
    <body>

        <div id="loginbox">
            <?php if($this->session->flashdata('insertp')){ ?>
            <div class="widget-box">
           <div class="alert alert-success">
              <button class="close" data-dismiss="alert" >×</button>
              <strong>Success!</strong> Data Anda Telah Terdaftar</div>
        </div>      <?php } ?>  
        <?php if($this->session->flashdata('logail')){ ?>
                <div class="widget-box">
           <div class="alert alert-error">
              <button class="close" data-dismiss="alert"  >×</button>
              <strong>Error!</strong> Username/Password anda salah</div>
        </div>      <?php } ?> 
        <?php if($this->session->flashdata('logail1')){ ?>
                <div class="widget-box">
           <div class="alert alert-error">
              <button class="close" data-dismiss="alert"  >×</button>
              <strong>Error!</strong> Akun anda belum diaktivasi. Harap hubungi admin Gonigoni(082273696930) </div>
        </div>      <?php } ?> 

            <form id="loginform" class="form-vertical" action="<?php echo base_url()?>C_User/ceklogin" method="POST">
				 <div class="control-group normal_text"> <h3><img src="<?php echo base_url()?>assets/assettmp/img/logo.png" alt="Logo" /></h3></div>
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_lg"><i class="icon-user"> </i></span><input type="text" placeholder="Username" name="username" />
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_ly"><i class="icon-lock"></i></span><input type="password" placeholder="Password" name="password" />
                        </div>
                    </div>
                </div>
                <input type="checkbox" name="remember" value="yes"> Ingat Saya



                <div class="form-actions">
                    <span class="pull-left"><a href="#" class="flip-link btn btn-info" id="to-recover">Lost password?</a></span>


                    <span class="pull-right"><input type="submit" name="login" class="btn btn-success" value="Login"></span>
                    <span class="pull-right"><a type="submit" href="<?php echo base_url()?>C_User/regisform" class="btn btn-warning" /> Registrasi</a></span>

                </div>
            </form>
            <form id="recoverform" action="#" class="form-vertical">
				<p class="normal_text">Enter your e-mail address below and we will send you instructions how to recover a password.</p>
				
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_lo"><i class="icon-envelope"></i></span><input type="text" placeholder="E-mail address" />
                        </div>
                    </div>
               
                <div class="form-actions">
                    <span class="pull-left"><a href="#" class="flip-link btn btn-success" id="to-login">&laquo; Back to login</a></span>
                    <span class="pull-right"><a class="btn btn-info"/>Recover</a></span>
                </div>
            </form>
        </div>
        
        <script src="<?php echo base_url()?>assets/assettmp/js/jquery.min.js"></script>  
        <script src="<?php echo base_url()?>assets/assettmp/js/matrix.login.js"></script> 
        <script src="<?php echo base_url()?>assets/assettmp/js/matrix.interface.js"></script> 
        <script src="<?php echo base_url()?>assets/assettmp/js/jquery.ui.custom.js"></script> 
        <script src="<?php echo base_url()?>assets/assettmp/js/bootstrap.min.js"></script> 
        <script src="<?php echo base_url()?>assets/assettmp/js/jquery.peity.min.js"></script> 
        <script src="<?php echo base_url()?>assets/assettmp/js/matrix.js"></script> 
        <script src="<?php echo base_url()?>assets/assettmp/js/matrix.interface.js"></script> 
        <script src="<?php echo base_url()?>assets/assettmp/js/matrix.popover.js"></script>
    </body>

</html>
