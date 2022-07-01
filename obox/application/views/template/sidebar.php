<body id="page-top">
<?php
if (!isset($data_master_active)) {
  $data_master_active=null;
}
if (!isset($data_master_show)) {
  $data_master_show=null;
}
if (!isset($data_kantor_active)) {
  $data_kantor_active=null;
}
if (!isset($peran_pengguna_active)) {
  $peran_pengguna_active=null;
}
if (!isset($input_antrian_active)) {
  $input_antrian_active=null;
}
if (!isset($input_antrian_batch_active)) {
  $input_antrian_batch_active=null;
}
if (!isset($data_antrian_active)) {
  $data_antrian_active=null;
}
if (!isset($data_user_active)) {
  $data_user_active=null;
}
if (!isset($jenis_ljk_active)) {
  $jenis_ljk_active=null;
}
if (!isset($generate)) {
  $generate=null;
}
if (!isset($kolek)) {
  $kolek=null;
}


if (!isset($inisialisasi)) {
  $inisialisasi=null;
}

if (!isset($headerpage)) {
  $headerpage=null;
}


 ?>
  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul style="position: fixed;
    top: auto;
    float: none!important;
    z-index: 1027;" class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a style="padding-left: 0px;padding-right: 0px;background: #f3f4f7" class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url() ?>">
        <div style="">
          <img width="100%" src="<?= base_url('assets/images/side_obox.jpg'); ?>">
             <!-- <div class="small">Logged in as : <?php //echo username() ?></div>
                        <?php //echo cabang($this->session->userdata("user_id")) ?> -->
        </div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item ">
        <a class="nav-link" href="<?= site_url('home') ?>">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

 <?php if (user_level()=="1"): ?>
      <!-- Heading -->
      <div class="sidebar-heading">
        Resource
      </div>


      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item <?= $generate ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
          <i class="fas fa-fw fa-folder"></i>
          <span>OBOX OJK</span>
        </a>
        <div id="collapsePages" class="collapse <?=  $headerpage; ?>" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          
          <div class="bg-white py-2 collapse-inner rounded ">
            <h6 class="collapse-header">Menu Screens:</h6>
             <a class="collapse-item <?=  $generate; ?>" href="<?= site_url('generate') ?>">Generate Report OBOX</a>
              <div class="collapse-divider"></div>
             <a class="collapse-item <?=  $inisialisasi; ?>" href="<?= site_url('generate/inisialisasi') ?>">Inisialisasi</a>
              <div class="collapse-divider"></div>
          </div>
        </div>
      </li>
      
      <?php endif ?>

      <?php if (user_level()=="1"): ?>
      <div class="sidebar-heading">
        Kredit 
      </div>
       <li class="nav-item <?= $data_user_active; ?>">
        <a class="nav-link" href="<?= site_url('generate/perubahankolek') ?>">
          <i class="fas fa-fw fa-file"></i>
          <span> Perubahan Kolektibilitas</span></a>
      </li>
        <?php endif ?>

      <?php if (user_level()=="1"): ?>
      <div class="sidebar-heading">
        Setting
      </div>
       <li class="nav-item <?= $data_user_active; ?>">
        <a class="nav-link" href="<?= site_url('auth/data_users') ?>">
          <i class="fas fa-fw fa-user"></i>
          <span> Data Users / Pengguna</span></a>
      </li>
        <?php endif ?>
      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center ">
        <button onClick="myFunction()"  class="rounded-circle" id="sidebarToggle"></button>
      </div>

      

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div  id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">
