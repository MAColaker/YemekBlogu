<?php
ob_start();
session_start();
include '../netting/baglan.php';
date_default_timezone_set('Europe/Istanbul');

$kullanicisor=$db->prepare("select * from kullanici where kullanici_ad=:ad");
$kullanicisor->execute(array(
  'ad' => $_SESSION['kullanici_ad']
  ));

$say=$kullanicisor->rowCount();

if ($say==0) {
 
 header("Location:login.php?durum=izinsiz");
 exit;
}



$kullanicicek=$kullanicisor->fetch(PDO::FETCH_ASSOC);


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Yönetim Paneli</title>
  
  <script src="../vendors/jquery/dist/jquery.min.js"></script>
  <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>


  <!-- Dropzone.js -->
  <link href="../vendors/dropzone/dist/min/dropzone.min.css" rel="stylesheet">

  <!-- Dropzone.js -->
  <script src="../vendors/dropzone/dist/min/dropzone.min.js"></script>

  
  <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">

  
  <script src="../ckeditor/ckeditor.js"></script>

  <!-- Bootstrap -->
  <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <!-- NProgress -->
  <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">

  <!-- Custom Theme Style -->
  <link href="../build/css/custom.min.css" rel="stylesheet">
</head>

<body class="nav-md">
  <div class="container body">
    <div class="main_container">
      <div class="col-md-3 left_col">
        <div class="left_col scroll-view">
          <div class="navbar nav_title" style="border: 0;">
            <a href="index.php" class="site_title"><i class="fa fa-cog"></i> <span>Panel</span></a>
          </div>

          <div class="clearfix"></div>

          <!-- menu profile quick info -->
          <div class="profile clearfix">
            <div class="profile_pic">
                <?php
                if (strlen($kullanicicek['kullanici_resim'])>0) {?>

                    <img width="150"  src="../../<?php echo $kullanicicek['kullanici_resim']; ?>" class="img-circle profile_img">

                <?php } else {?>


                    <img width="150"  src="../../dimg/kullanici-resim-yok.jpg" class="img-circle profile_img">


                <?php } ?>

            </div>
            <div class="profile_info">
              <span>Hoşgeldin,</span>
              <h2><?php echo $_SESSION['kullanici_ad']; ?></h2>
              


              
            </div>
            <div class="clearfix"></div>
          </div>
          <!-- /menu profile quick info -->

          <br />

          <?php include 'sidebar.php'; ?>

        </div>
      </div>

      <!-- top navigation -->
      <div class="top_nav">
        <div class="nav_menu">
          <nav>
            <div class="nav toggle">
              <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>

            <ul class="nav navbar-nav navbar-right">
              <li class="">
                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                  <img src="https://pbs.twimg.com/profile_images/597790471302356993/EovEDQrv.jpg" alt=""><?php echo $_SESSION['kullanici_ad']; ?>
                  <span class=" fa fa-angle-down"></span>
                </a>
                <ul class="dropdown-menu dropdown-usermenu pull-right">
                  <li><a href="kullanici-profil.php"> Kullanıcı Profili</a></li>                  

                  <li><a href="logout.php"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
                </ul>
              </li>
            </ul>
          </nav>
        </div>
      </div>
        <!-- /top navigation -->