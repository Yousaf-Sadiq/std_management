<?php 
 require_once dirname(__DIR__)."/../include/web.php";
 require_once dirname(__DIR__)."/../include/table.php";
?>
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from akademi.dexignlab.com/flask/demo/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 18 Sep 2024 05:08:48 GMT -->

<head>
 <meta charset="utf-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="author" content="DexignLab">
 <meta name="robots" content="">
 <meta name="keywords"
  content="school, school admin, education, academy, admin dashboard, college, college management, education management, institute, school management, school management system, student management, teacher management, university, university management">
 <meta name="description"
  content="Discover Akademi - the ultimate Flask admin dashboard and Bootstrap 5 template. Specially designed for professionals, and for business. Akademi provides advanced features and an easy-to-use interface for creating a top-quality website with School and Education Dashboard">
 <meta property="og:title" content="Akademi - Flask School and Education Management Admin Dashboard Template">
 <meta property="og:description"
  content="Akademi - the ultimate admin dashboard and Bootstrap 5 template. Specially designed for professionals, and for business. Akademi provides advanced features and an easy-to-use interface for creating a top-quality website with School and Education Dashboard">
 <meta property="og:image" content="../social-image.png">
 <meta name="format-detection" content="telephone=no">

 <!-- Mobile Specific -->
 <meta name="viewport" content="width=device-width, initial-scale=1">

 <!-- Page Title Here -->
 <title>Akademi - Flask School and Education Management Admin Dashboard Template</title>

 <!-- FAVICONS ICON -->
 <link rel="shortcut icon" type="image/png" href="images/favicon.png">
 <link href="<?php echo AdminAsset; ?>vendor/wow-master/css/libs/animate.css" rel="stylesheet">
 <link href="<?php echo AdminAsset; ?>vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
 <link rel="stylesheet" href="<?php echo AdminAsset; ?>vendor/bootstrap-select-country/css/bootstrap-select-country.min.css">
 <link rel="stylesheet" href="<?php echo AdminAsset; ?>vendor/jquery-nice-select/css/nice-select.css">
 <link href="<?php echo AdminAsset; ?>vendor/datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">

 <link href="<?php echo AdminAsset; ?>vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
 <!--swiper-slider-->
 <link rel="stylesheet" href="<?php echo AdminAsset; ?>vendor/swiper/css/swiper-bundle.min.css">
 <!-- Style css -->
 <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">
 <link href="<?php echo AdminAsset; ?>css/style.css" rel="stylesheet">
<style>
    #error{
        position: fixed;
        top: 10px;
        right: 10px;
        width: 300px;
        z-index: 999999999999999999;
    }
</style>
</head>

<body>

 <!--*******************
        Preloader start
    ********************-->
 <div id="preloader">
  <div class="loader">
   <div class="dots">
    <div class="dot mainDot"></div>
    <div class="dot"></div>
    <div class="dot"></div>
    <div class="dot"></div>
    <div class="dot"></div>
   </div>

  </div>
 </div>
 <!--*******************
        Preloader end
    ********************-->
 <!--**********************************
        Main wrapper start
    ***********************************-->
 <div id="main-wrapper" class="wallet-open active">

  <?php
  require_once "component/Navheader.php";
  require_once "component/chatbox.php";
  require_once "component/startHeader.php";
  require_once "component/sidebar.php";
  require_once "component/walletSidebar.php";

  ?>


  <!--**********************************
            Content body start
        ***********************************-->
  <div class="content-body">
   <!-- row -->
   <div class="container-fluid">
   <div id="error"></div>