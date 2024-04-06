<?php
// session_start();
// // After successful login
// $_SESSION['email'] = $userEmail; // Replace $userEmail with the actual user's email
?>


<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>CRM-CI</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="robots" content="all,follow">
  <!-- Google fonts - Poppins -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,700">




  <!-- fa fa-icon link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


  <!-- Choices CSS-->
  <link rel="stylesheet" href="<?= base_url('assets/vendor/choices.js/public/assets/styles/choices.min.css'); ?>">

  <!-- theme stylesheet-->
  <link rel="stylesheet" href="<?= base_url('assets/css/style.default.css'); ?>">

  <!-- Custom stylesheet - for your changes-->
  <link rel="stylesheet" href="<?= base_url('assets/css/custom.css'); ?>">

  <!-- Favicon-->
  <!-- <link rel="shortcut icon" href="<?php echo base_url() ?>assets/img/favicon.ico"> -->

  <!-- autocomplete css -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/autocomplete.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>js-snackbar-master/src/js-snackbar.css">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" >
  
  <!--bootstrap icon link   -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.1/css/fontawesome.min.css">



  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<script src="https://code.jquery.com/jquery-3.6.3.min.js"></script> 
<!-- <script src ="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
<body>
  <div class="page">
    <header class="header z-index-50">
      <nav class="nav navbar py-3 px-0 shadow-sm text-white position-relative">
        <div class="search-box shadow-sm">
          <button class="dismiss d-flex align-items-center">
            <svg class="svg-icon svg-icon-heavy">
              <use xlink:href="#close-1"> </use>
            </svg>
          </button>
        </div>
        <div class="container-fluid w-100">
          <div class="navbar-holder d-flex align-items-center justify-content-between w-100">
            <div class="navbar-header">
              <a class="navbar-brand d-none d-sm-inline-block" href="https://sansoftwares.com/">
                <div class="brand-text d-none d-lg-inline-block"><span></span><img src="<?php echo base_url('/assets/img/') ?>" style="width: 220px;"></div>  <!-- /assets/img/Sansoftwares-logo-1.png -->
            </div>

            <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
              <li class="nav-item d-flex align-items-center"><a id="search" href="<?php echo base_url(); ?>Login.php"></a></li>
              <!-- <li class="nav-item d-flex align-items-center"><a id="dd" href="#">hello</a></li> -->
              <?php
              //  if (isset($_SESSION['email'])) { 
              ?>
      <!-- <li class="nav-item">
        <span class="nav-link text-white">Logged in as: <?php echo $_SESSION['email'];  ?></span>
      </li> -->
    <?php
    //  }
      ?>

              <!-- Logout    -->
              <li class="nav-item">
                <a class="nav-link text-white" href="<?=base_url('Login/logout')?>">
                  <span class="d-none d-sm-inline">Logout</span>
                  <svg class="svg-icon svg-icon-xs svg-icon-heavy">
                    <use xlink:href="#security-1"></use>
                  </svg>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </header>
    <div class="page-content d-flex align-items-stretch">
      <!-- Side Navbar -->
      <nav class="side-navbar z-index-40 pt-4" >
        <div class="sidebar-header d-flex align-items-center  px-3">
          <div class="ms-3 title">
          </div>
        </div>
        <ul class="list-unstyled">
          <!-- <hr> -->
          <li class="sidebar-item" style="background-color: white; "  >
            <a class="sidebar-link" style=" text-decoration: none;" href="<?php echo base_url() ?>Dashboard">
            <img src="<?php echo base_url('/assets/using_image/dashboardimage.png') ?>" alt="" style="width: 25px; height: 25px; margin-left: 25px;">
                <use xlink:href=""> </use>
              </svg><span style="margin-left: 20px; font-size: 15px; color: black; text-decoration:none;"> <b>Dashboard</b> </span>
            </a>
          </li>
          <hr>

          <li class="sidebar-item">
            <a class="sidebar-link" style=" text-decoration: none;" href="<?php echo base_url() ?>Usermaster">
            <img src="<?php echo base_url('/assets/using_image/programmer.png') ?>" alt="" style="width: 25px; height: 25px; margin-left: 25px;">
                <use xlink:href="#portfolio-grid-1"> </use>
              </svg><span style="margin-left: 20px; font-size: 15px; color: black;"> <b>UserMaster</b> </span>
            </a>
          </li>
          <hr>

          <li class="sidebar-item">
            <a class="sidebar-link" style=" text-decoration: none;" href="<?php echo base_url() ?>Clientmaster">
            <img src="<?php echo base_url('/assets/using_image/target.png') ?>" alt="" style="width: 25px; height: 25px; margin-left: 25px;">
                <use xlink:href="#sales-up-1"> </use>
              </svg><span style="margin-left: 20px; font-size: 15px; color: black;"> <b>ClientMaster</b> </span>
            </a>
          </li>
          <hr>

          <li class="sidebar-item">
            <a class="sidebar-link" style=" text-decoration: none;" href="<?php echo base_url() ?>Itemmaster">
            <img src="<?php echo base_url('/assets/using_image/procurement.png') ?>" alt="" style="width: 25px; height: 25px; margin-left: 26px;">
                <use xlink:href="#survey-1"> </use>
              </svg><span style="margin-left: 20px; font-size: 15px; color: black;"> <b>ItemMaster</b> </span>
            </a>
          </li>
          <hr>
          <li class="sidebar-item">
            <a class="sidebar-link" style=" text-decoration: none;" href="<?php echo base_url() ?>Invoicemaster">
            <img src="<?php echo base_url('/assets/using_image/invoice.png') ?>" alt="" style="width: 25px; height: 25px; margin-left: 25px;">
                <use xlink:href="#browser-window-1"> </use>
              </svg><span style="margin-left: 20px; font-size: 15px; color: black;"> <b>InvoiceMaster</b> </span>
            </a>
          </li>
          <hr>

          <!-- <li class="sidebar-item"><a class="sidebar-link" href="#">
              <svg class="svg-icon svg-icon-sm svg-icon-heavy me-xl-2">
                <use xlink:href="#disable-1"> </use>
              </svg>Logout </a>
          </li> -->
        </ul>
        </ul>
      </nav>


      <div class="content-inner w-100 bg-light">