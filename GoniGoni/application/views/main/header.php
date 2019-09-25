<!DOCTYPE html>
<html lang="en">
<head>
<title>Gonigoni Bank Sampah</title>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="<?php echo base_url()?>assets/assettmp/css/bootstrap.min.css" />
<link rel="stylesheet" href="<?php echo base_url()?>assets/assettmp/css/bootstrap-responsive.min.css" />
<link rel="stylesheet" href="<?php echo base_url()?>assets/assettmp/css/fullcalendar.css" />
<link rel="stylesheet" href="<?php echo base_url()?>assets/assettmp/css/colorpicker.css" />
<link rel="stylesheet" href="<?php echo base_url()?>assets/assettmp/css/datepicker.css" />
<link rel="stylesheet" href="<?php echo base_url()?>assets/assettmp/css/uniform.css" />
<link rel="stylesheet" href="<?php echo base_url()?>assets/assettmp/css/select2.css" />
<link rel="stylesheet" href="<?php echo base_url()?>assets/assettmp/css/matrix-style.css" />
<link rel="stylesheet" href="<?php echo base_url()?>assets/assettmp/css/matrix-media.css" />
<link rel="stylesheet" href="<?php echo base_url()?>assets/assettmp/css/bootstrap-wysihtml5.css" />
<link href="<?php echo base_url()?>assets/assettmp/font-awesome/css/font-awesome.css" rel="stylesheet" />
<link rel="<?php echo base_url()?>assets/assettmp/stylesheet" href="css/jquery.gritter.css" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
<link href='<?php echo base_url()?>assets/fullcalendar/core/main.css' rel='stylesheet' />
<link href='<?php echo base_url()?>assets/fullcalendar/daygrid/main.css' rel='stylesheet' />
<script src="<?php echo base_url()?>assets/fullcalendar/core/main.js"></script>
<script src="<?php echo base_url()?>assets/fullcalendar/bootstrap/main.js"></script>
<script src="<?php echo base_url()?>assets/fullcalendar/daygrid/main.js"></script>
</head>
<body>

<!--Header-part-->
<div id="header">
  <h1><a href="dashboard.html">Gonigoni Bank Sampah</a></h1>
</div>
<!--close-Header-part--> 


<!--top-Header-menu-->
<div id="user-nav" class="navbar navbar-inverse">
  <ul class="nav">
    <!-- <li  class="dropdown" id="profile-messages" ><a title="" href="#" data-toggle="dropdown" data-target="#profile-messages" class="dropdown-toggle"><i class="icon icon-user"></i>  <span class="text">Welcome User</span><b class="caret"></b></a>
      <ul class="dropdown-menu">
        <li><a href="#"><i class="icon-user"></i> My Profile</a></li>
        <li class="divider"></li>
        <li><a href="#"><i class="icon-check"></i> My Tasks</a></li>
        <li class="divider"></li>
        <li><a href="login.html"><i class="icon-key"></i> Log Out</a></li>
      </ul>
    </li>
    <li class="dropdown" id="menu-messages"><a href="#" data-toggle="dropdown" data-target="#menu-messages" class="dropdown-toggle"><i class="icon icon-envelope"></i> <span class="text">Messages</span> <span class="label label-important">5</span> <b class="caret"></b></a>
      <ul class="dropdown-menu">
        <li><a class="sAdd" title="" href="#"><i class="icon-plus"></i> new message</a></li>
        <li class="divider"></li>
        <li><a class="sInbox" title="" href="#"><i class="icon-envelope"></i> inbox</a></li>
        <li class="divider"></li>
        <li><a class="sOutbox" title="" href="#"><i class="icon-arrow-up"></i> outbox</a></li>
        <li class="divider"></li>
        <li><a class="sTrash" title="" href="#"><i class="icon-trash"></i> trash</a></li>
      </ul>
    </li>
    <li class=""><a title="" href="#"><i class="icon icon-cog"></i> <span class="text">Settings</span></a></li> -->
    <li class=""><a title="" href="<?php echo base_url()?>C_user/logout"><i class="icon icon-share-alt"></i> <span class="text">Logout</span></a></li>
  </ul>
</div>
<!--close-top-Header-menu-->
<!--start-top-serch-->
<div id="search">
  <input type="text" placeholder="Search here..."/>
  <button type="submit" class="tip-bottom" title="Search"><i class="icon-search icon-white"></i></button>
</div>
<!--close-top-serch-->
<!--sidebar-menu-->
<div id="sidebar"><a href="#" class="visible-phone"><i class="icon icon-home"></i> Dashboard</a>
  <ul>
    <?php $uriSegments = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
    //echo $uriSegments[2];
     ?>
    <li class="<?php if($uriSegments[2]=='C_Dashboard') echo'active'?>"><a href="<?php echo base_url(); ?>C_Dashboard"><i class="icon icon-home"></i> <span>Dashboard</span></a> </li>
    <li class="<?php if($uriSegments[2]=='C_Nasabah') echo'active'?>"> <a href="<?php echo base_url();?>C_Nasabah"><i class="icon icon-group"></i> <span>Nasabah</span></a> </li>
    <li class="<?php if($uriSegments[2]=='C_Driver') echo'active'?>"> <a href="<?php echo base_url();?>C_Driver"><i class="icon icon-group"></i> <span>Driver</span></a> </li>
    <li class="<?php if($uriSegments[2]=='C_Katsampah') echo'active'?>"> <a href="<?php echo base_url(); ?>C_Katsampah"><i class="icon icon-tag"></i> <span>Kelola Kategori Sampah</span></a> </li>
    <li class="submenu <?php if($uriSegments[2]=='C_Setoran' || $uriSegments[2]=='C_Sampahkeluar') echo'active'?>"> <a href="#"><i class="icon icon-leaf"></i> <span>Transaksi Sampah</span> <span class="label label-important"></span></a>
      <ul>
        <li class="<?php if($uriSegments[2]=='C_Setoran') echo'active'?>"><a href="<?php echo base_url();?>C_Setoran">Setoran</a></li>
        <li class="<?php if($uriSegments[2]=='C_Sampahkeluar') echo'active'?>"><a href="<?php echo base_url();?>C_Sampahkeluar">Sampah Keluar</a></li>
        <li class="<?php if($uriSegments[2]=='C_Jemput') echo'active'?>"><a href="<?php echo base_url();?>C_Jemput">Setoran Jemput</a></li>
      </ul>
    </li>
    <li class="<?php if($uriSegments[2]=='C_Stoking') echo'active'?>"> <a href="<?php echo base_url();?>C_Stoking"><i class="icon icon-tag"></i> <span>Kelola Stok</span></a> </li>
  
</div>
<!--sidebar-menu-->



