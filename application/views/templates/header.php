<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= $title;?></title>

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
 
  <link rel="stylesheet" href="<?= base_url('assets/vendor/admin-lte/').'plugins/fontawesome-free/css/all.min.css'?> ">

  <!-- <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> -->

  <link rel="stylesheet" href="<?= base_url('assets/vendor/admin-lte/').'plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css'?> ">

  <link rel="stylesheet" href="<?= base_url('assets/vendor/admin-lte/').'plugins/icheck-bootstrap/icheck-bootstrap.min.css'?> ">

  <link rel="stylesheet" href="<?= base_url('assets/vendor/admin-lte/').'plugins/jqvmap/jqvmap.min.css'?> ">

  <link rel="stylesheet" href="<?= base_url('assets/vendor/admin-lte/').'dist/css/adminlte.min.css'?> ">
 
  <link rel="stylesheet" href="<?= base_url('assets/vendor/admin-lte/').'plugins/overlayScrollbars/css/OverlayScrollbars.min.css'?> ">

  <link rel="stylesheet" href="<?= base_url('assets/vendor/admin-lte/').'plugins/daterangepicker/daterangepicker.css'?> ">

  <!-- <link rel="stylesheet" href="<?= base_url('assets/vendor/admin-lte/').'plugins/summernote/summernote-bs4.min.css'?> "> -->
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed text-sm">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__wobble" src="<?= base_url('assets/img/logo/').'fird_logo.png'?>" alt="AdminLTELogo" height="30">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <!-- <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li> -->
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>

      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <?php if(!$count_notif):?>
					<?php else:?>
					<span class="badge badge-danger navbar-badge"><?= $count_notif?></span>
					<?php endif;?>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
				<?php if(!$notif):?>
					<div class="media dropdown-item">
						<div class="media-body">
							<h3 class="dropdown-item-title">
								<strong>No recent recent activity</strong> 
								<span class="float-right text-sm text-danger"></span>
							</h3>
							<p class="text-sm">Activities will listed here</p>
						</div>
					</div>
				<?php else:?>
					<?php foreach ($notif as $n):?>
					<?php if($n['notif_user_to']!=$userData['user_id']):?>
					<?php else:?>
						<a href="<?= base_url('notif/goto/').$n['notif_id'];?>" class="dropdown-item">
							<!-- Message Start -->
							<div class="media">
								<img src="<?= base_url('assets/img/profile/').$n['user_profile'];?>" alt="User Avatar" class="img-size-50 mr-3 img-circle">
								<div class="media-body">
									<h3 style="
										font-weight:<?php if($n['notif_status']==0){echo 'bold';}else{ echo 'normal';}?>;
									" class="dropdown-item-title">
										<?= $n['user_firstname']?> <?= $n['user_lastname']?>
										<span class="float-right text-sm text-danger"></span>
									</h3>
									<p class="text-sm"><?= $n['notif_message'];?></p>
									<p class="text-sm text-muted">
									
									<?php 
									$date = $n['notif_date_created'];
									if(empty($date)) {
										return "No date provided";
									}
									
									$periods         = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
									$lengths         = array("60","60","24","7","4.35","12","10");
									$now             = time();
									$unix_date       = strtotime($date);
									
										// check validity of date
									if(empty($unix_date)) {   
										return "Bad date";
									}
								
									// is it future date or past date
									if($now > $unix_date) {   
										$difference     = $now - $unix_date;
										$tense         = "ago";
										
									} else {
										$difference     = $unix_date - $now;
										$tense         = "from now";
									}
									
									for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
										$difference /= $lengths[$j];
									}
									
									$difference = round($difference);
									
									if($difference != 1) {
										$periods[$j].= "s";
									}
									
									echo "$difference $periods[$j] {$tense}";
									
									?>
									
									
									</p>
								</div>
							</div>
							<!-- Message End -->
						</a>
						<?php endif;?>
						<?php endforeach;?>
					
          <div class="dropdown-divider"></div>
          <a href="<?= base_url('notif');?>" class="dropdown-item dropdown-footer">See All Notifications</a>
					<?php endif;?>
        </div>

      </li>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <!-- <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-danger navbar-badge">15</span>
        </a> -->
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
      <!-- <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li> -->
      <!-- <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li> -->
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-light-primary elevation-0">
    <!-- Brand Logo -->
    <a href="<?= base_url('work');?>" class="brand-link">
      <span class="brand-text ml-3 font-weight-bold">WINPAD</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img style="width: 40px; height:40px" src="<?= base_url('assets/img/profile/').$userData['user_profile'];?>" class="img-circle elevation-1" alt="User Image">
        </div>
        <div class="info">
          <a href="<?= base_url().'profile';?>" class="d-block"><?= $userData['user_firstname'];?> <?= $userData['user_lastname'];?> </a>
        </div>
      </div>

      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
              <a href="<?= base_url('login/logout');?>" class="nav-link">
                <i class="nav-icon fa fa-power-off text-danger"></i>
                <p>Logout</p>
              </a>
            </li>
        </ul>
      </nav>
      

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
              <?php if($userData['user_role']==0):?>
              <?php else:?>
              <li class="nav-item">
                <a href="<?= base_url('admin');?>" class="nav-link">
                  <i class="fa fa-user nav-icon"></i>
                  <p>Admin</p>
                </a>
              <?php endif;?>
              </li><li class="nav-item">
                <a href="<?= base_url('work');?>" class="nav-link">
                  <i class="fa fa-globe-asia nav-icon"></i>
                  <p>Workline</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('work/my_work');?>" class="nav-link">
                  <i class="fa fa-globe-asia nav-icon"></i>
                  <p>My Work</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('permit');?>" class="nav-link">
                  <i class="fa fa-briefcase nav-icon"></i>
                  <p>My Permit</p>
                </a>
              </li>
              <?php if($userData['user_is_manage']== 1):?>
              <li class="nav-item">
                <a href="<?= base_url('docline');?>" class="nav-link">
                  <i class="fa fa-list nav-icon"></i>
                  <p>Docline</p>
                </a>
              </li>
              <?php else:?>
              <?php endif;?>
              <hr>
              <li>
              Developed by: 
              <br >
              <a href="https://www.firdgroup.com"><img src="<?= base_url('assets/img/logo/fird_logo.png')?>" alt="Fird Logo" width="70px"></a>
              </li>
        </ul>

      
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  
  <div class="content-wrapper">

    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"><?= $title;?></h1>
          </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
