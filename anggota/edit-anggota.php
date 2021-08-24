<?php 
session_start();
if(!isset($_SESSION["login"])){
  header("location: .../index.php");
  exit;
}
  require '../functions.php';
  $idanggota=$_GET['idanggota'];

  $m=query("SELECT * FROM tbanggota WHERE idanggota='$idanggota'")[0];

  if(isset($_POST['edit'])){

     if( editAnggota($_POST) > 0 ){
    echo "<script>alert('Data Berhasil Diubah');
    document.location.href ='daftar-anggota.php';
    </script>";
    }else{
    echo "<script>
              alert('Data Gagal Di Ubah');
              document.location.href ='edit-anggota.php';
        </script>";
    
    }
 }



  

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="../plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="../plugins/summernote/summernote-bs4.min.css">
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">



  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>    
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
  

    <!-- Sidebar -->
      



      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
            <i class="nav-icon fas fa-chevron-circle-down"></i>
              <p>
                Menu
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../dashboard.php" class="nav-link">
                  <i class="fas fa-tachometer-alt  nav-icon"></i>
                  <p>Dashboard</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../buku/daftar-buku.php" class="nav-link ">
                  <i class="fas fa-book-open nav-icon"></i>
                  <p>Daftar Buku</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../anggota/daftar-anggota.php" class="nav-link active">
                  <i class="fas fa-users nav-icon"></i>
                  <p>Daftar Anggota</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../logout.php" class="nav-link">
                <i class="fas fa-sign-out-alt ml-1"></i>
                <p>Logout</p>
                </a>
              </li>
            </ul>   
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

   <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <!-- Main content -->
      <div class="container mt-1 mb-3">
        <div class="row justify-content-center">
          <!-- left column -->
          <div class="col-md-8">
            <!-- general form elements -->
            <div class="card card-secondary">
              <div class="card-header">
                <h3 class="card-title">Form Edit Anggota</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="form-group">
                    <input type="hidden" name="fotolama" value="<?= $m['foto']; ?>">
                    <label for="idanggota">ID Anggota</label>
                    <input type="text" class="form-control" id="idbuku" name="idanggota" value="<?= $m['idanggota']; ?>" readonly>
                  </div>
                  <div class="form-group">
                    <label for="namaanggota">Nama Anggota</label>
                    <input type="text" class="form-control" id="namaanggota" placeholder="Masukan Judul Buku" name="namaanggota" required value="<?= $m['nama']; ?>">
                  </div>
                  <div class="form-group ">
                  <label for="">Jenis Kelamin</label>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="jeniskelamin" id="laki-laki" value="Laki-laki" checked>
                          <label class="form-check-label" for="laki-laki">Laki-laki</label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" id="perempuan" name="jeniskelamin" value="Perempuan">
                          <label class="form-check-label mb-2 " for="perempuan">Perempuan</label>
                        </div>
                  <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <input type="text" class="form-control" id="alamat" placeholder="Masukan Penulis Buku" name="alamat" required value="<?= $m['alamat']; ?>">
                  </div>
                  <div class="form-group">
                  <img src="../asset/img/<?= $m['foto']; ?>" alt="" class="ml-3  img-preview" width="60px" style="display: block;" >                    <label for="">Foto</label><br>
                  <input type="file" id="foto" name="foto" onchange="previewimage()" class="gambar-uploud">
                    <p class="text-muted">File harus PNG,JPEG,JPG</p>
                  </div>                  
                  <button type="submit" class="btn btn-primary" name="edit">Simpan</button>
                </div>



    <!-- akhir dari daftar buku  -->
   
        
</div>


<script src="../asset/js/myscript.js"></script>
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="../plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="../plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="../plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="../plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="../plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="../plugins/moment/moment.min.js"></script>
<script src="../plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="../plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../dist/js/pages/dashboard.js"></script>
</body>
</html>
