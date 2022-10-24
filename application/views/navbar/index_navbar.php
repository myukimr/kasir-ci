<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
	  <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script
    src="https://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
    crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    
    <title><?php echo $title; ?> - Kasir.com</title>
  </head>
  <body>
<!-- Start Sidebar -->
<nav class="navbar navbar-expand-md navbar-dark bg-dark" style="">
  <a class="navbar-brand" href="#" style="margin-left: 45%;">
    <img src="https://www.keokukschools.org/wp-content/uploads/2018/03/keokuk-logo-K.png" width="30" height="30" class="d-inline-block align-top" alt="">
    <span class="menu-collapsed" style="">
		<b>Kasir.com</b>
	</span>
  </a>
  <a href="<?php echo base_url().'Login_controller/logout'?>" style="color: white; margin-left: 42%;"><i class="fa fa-sign-out-alt"></i></a>
</nav>

<div class="row" id="body-row">
    <div id="sidebar-container" class="sidebar-expanded d-none d-md-block bg-dark" style="color: #9803fc;">
        <ul class="list-group">
            <li class="list-group-item sidebar-separator-title text-muted d-flex align-items-center menu-collapsed bg-dark">
                <small>Main Menu</small>
            </li>
            <a href="<?php echo base_url().'Index_controller'?>" class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-start align-items-center" style="margin-left: -5%;">
                    <span class="fa fa-crown fa-fw mr-3"></span>
                    <span class="menu-collapsed"><img src=""><b>New Product</b></span>
                </div>
            </a>
            <a href="#submenu1" data-toggle="collapse" aria-expanded="false" class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-start align-items-center" style="margin-left: -5%;">
                    <span class="fa fa-align-justify fa-fw mr-3"></span>
                    <span class="menu-collapsed"><img src=""><b>Menu</b></span>
                    <span class="submenu-icon ml-auto"></span>
                </div>
            </a>
            <div id='submenu1' class="collapse sidebar-submenu">
                <a href="<?php echo base_url().'Food_controller'?>" class="list-group-item list-group-item-action bg-dark text-white">
                    <span class="fa fa-concierge-bell fa-fw"></span>
                    <span class="menu-collapsed" style="margin-left: 5%;">Food</span>
                </a>
                <a href="<?php echo base_url().'Beverages_controller'?>" class="list-group-item list-group-item-action bg-dark text-white">
                    <span class="fa fa-coffee fa-fw"></span>
                    <span class="menu-collapsed" style="margin-left: 5%;">Beverages</span>
                </a> 
                <a href="<?php echo base_url().'Snack_controller'?>" class="list-group-item list-group-item-action bg-dark text-white">
                    <span class="fa fa-stroopwafel fa-fw"></span>
                    <span class="menu-collapsed" style="margin-left: 5%;">Snack</span>
                </a>
            </div>
            <a href="#submenu2" data-toggle="collapse" aria-expanded="false" class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-start align-items-center" style="margin-left: -5%;">
                    <span class="fa fa-calculator fa-fw mr-3"></span>
                    <span class="menu-collapsed"><img src=""><b>Transaksi</b></span>
                    <span class="submenu-icon ml-auto"></span>
                </div>
            </a>
            <div id='submenu2' class="collapse sidebar-submenu">
                <a href="<?php echo base_url().'Transaksi_controller'?>" class="list-group-item list-group-item-action bg-dark text-white">
                    <span class="fa fa-donate fa-fw"></span>
                    <span class="menu-collapsed" style="margin-left: 5%;">Checkout Transaksi</span>
                </a>
                <a href="<?php echo base_url().'Riwayattransaksi_controller'?>" class="list-group-item list-group-item-action bg-dark text-white">
                    <span class="fa fa-calendar-alt fa-fw"></span>
                    <span class="menu-collapsed" style="margin-left: 5%;">Riwayat Transaksi</span>
                </a>
            </div>
            <a href="#submenu3" data-toggle="collapse" aria-expanded="false" class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-start align-items-center" style="margin-left: -5%;">
                    <span class="fa fa-book fa-fw mr-3"></span>
                    <span class="menu-collapsed"><img src=""><b>Laporan</b></span>
                    <span class="submenu-icon ml-auto"></span>
                </div>
            </a>
            <div id='submenu3' class="collapse sidebar-submenu">
                <a href="<?php echo base_url().'Laporantransaksi_controller'?>" class="list-group-item list-group-item-action bg-dark text-white">
                    <span class="fa fa-money-check-alt fa-fw"></span>
                    <span class="menu-collapsed" style="margin-left: 5%;">Laporan Product</span>
                </a>
            </div>
            <?php if ($this->session->userdata('level')=="admin") { ?>
            <a href="#submenu4" data-toggle="collapse" aria-expanded="false" class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-start align-items-center" style="margin-left: -5%;">
                    <span class="fa fa-user-cog fa-fw mr-3"></span>
                    <span class="menu-collapsed"><img src=""><b>Administrator</b></span>
                    <span class="submenu-icon ml-auto"></span>
                </div>
            </a>
            <div id='submenu4' class="collapse sidebar-submenu">
                <a href="<?php echo base_url().'User_controller'?>" class="list-group-item list-group-item-action bg-dark text-white">
                    <span class="fa fa-user-edit fa-fw"></span>
                    <span class="menu-collapsed" style="margin-left: 5%;">Manajemen User</span>
                </a>
                <a href="<?php echo base_url().'Menu_controller'?>" class="list-group-item list-group-item-action bg-dark text-white">
                    <span class="fa fa-toolbox fa-fw"></span>
                    <span class="menu-collapsed" style="margin-left: 5%;">Manajemen Product</span>
                </a> 
            </div>
            <a href="#submenu5" data-toggle="collapse" aria-expanded="false" class="bg-dark list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-start align-items-center" style="margin-left: -5%;">
                    <span class="fa fa-server fa-fw mr-3"></span>
                    <span class="menu-collapsed"><img src=""><b>Database</b></span>
                    <span class="submenu-icon ml-auto"></span>
                </div>
            </a>
            <div id='submenu5' class="collapse sidebar-submenu">
                <a href="<?php echo base_url().'BackupDatabase_controller/backup'?>" class="list-group-item list-group-item-action bg-dark text-white">
                    <span class="fa fa-database fa-fw"></span>
                    <span class="menu-collapsed" style="margin-left: 5%;">Backup Database</span>
                </a>
            </div>
            <?php } ?>          
        </ul>
    </div> 
    <!-- End Sidebar -->