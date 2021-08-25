<?php 
session_start();
if(!isset($_SESSION["login"])){
  header("location: .../index.php");
  exit;
}
require '../functions.php';


if(isset($_POST['cari'])){
  $books=query("SELECT * FROM tbbuku ORDER BY idbuku");
  $books=cariBuku($_POST['pencarian']);
  $halamanAktif=1;
  $jmlhalaman=1;
    if($_POST['pencarian'] === ''){
  $jmlkolom=5;
  $jmldata=count(query('SELECT * FROM tbbuku'));
  $jmlhalaman=ceil($jmldata / $jmlkolom);
  header("location: daftar-buku.php");
  if(isset($_GET['halamanbuku'])){
    
    $halamanAktif=$_GET['halamanbuku'];
  }else{
    $halamanAktif=1;
  }
$awalkolom=($jmlkolom * $halamanAktif) - $jmlkolom;

  
  $books =query("SELECT * FROM tbbuku ORDER BY idbuku LIMIT $awalkolom,$jmlkolom");

    }

}else{

  $jmlkolom=5;
  $jmldata=count(query('SELECT * FROM tbbuku'));
  $jmlhalaman=ceil($jmldata / $jmlkolom);
  if(isset($_GET['halamanbuku'])){

    $halamanAktif=$_GET['halamanbuku'];
  }else{
    $halamanAktif=1;
  }
$awalkolom=($jmlkolom * $halamanAktif) - $jmlkolom;

  
  $books =query("SELECT * FROM tbbuku ORDER BY idbuku LIMIT $awalkolom,$jmlkolom");
  
}



// var_dump($books);
?>





<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sistem Perpustakaan</title>

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
                <a href="./daftar-buku.php" class="nav-link active">
                  <i class="fas fa-book-open nav-icon"></i>
                  <p>Daftar Buku</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../anggota/daftar-anggota.php" class="nav-link ">
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
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3>Daftar Buku</h3>
            <form action="" method="POST"class='float-right'>
            <div class="card-tools mb-4">
              <div class="input-group input-group-sm" style="width: 350px;">
                <input type="text" name="pencarian" class="form-control" placeholder="Search" autocomplete="off">
                <div class="input-group-append">
                  <button type="submit" name="cari" class="btn btn-default"> <i class="fas fa-search"></i>
                  </button>
                  </form>
                </div>
              </div>
            </div>
           <a href="./tambah-buku.php"><button type="button" class="btn btn-primary">Tambah Buku <i class="fas fa-plus pl-2" ></i></button></a>
          </div>
          <!-- /.card-header -->
          <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
              <thead class="text-center">
                <tr>
                  <th>ID</th>
                  <th>Judul Buku</th>
                  <th>Tahun Buku</th>
                  <th>Penulis Buku</th>
                  <th>kategori</th>
                  <th >Aksi</th>
                </tr>
              </thead>
              <tbody>


              <?php foreach($books as $book) : ?>
              <tr class="text-center">
                <td><?= $book['idbuku']; ?></td>
                <td><?= $book['judulbuku']; ?> </td>
                <td><?= $book['tahunbuku']; ?></td>
                <td><?= ucfirst($book['penulisbuku']); ?></td>
                <td><?= $book['kategori']; ?></td>
                <td class="text-center">
                <a href="edit-buku.php?idbuku=<?= $book['idbuku']; ?>"><button type="button" class="btn btn-success btn-sm">Edit</button></a>
                <a href="hapus-buku.php?idbuku=<?= $book['idbuku']; ?>"><button type="button" class="btn btn-danger btn-sm">Hapus</button></a>
                </td>
              </tr>

              <?php endforeach ?>
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>

      
   
    </div>

    <nav aria-label="...">
          <ul class="pagination pagination-md justify-content-center">
            <?php if ($halamanAktif > 1) :?>
              <li class="page-item">
                <a class="page-link" href="?halamanbuku=<?= $halamanAktif -1; ?>" aria-label="Previous">
                <?php else : ?>
                  <li class="page-item disabled">
                  <a class="page-link" href="?halamanbuku=<?= $halamanAktif -1; ?>" aria-label="Previous">
            <?php endif ?>
        <span aria-hidden="true">&laquo;</span>
      </a>
    </li>
            <?php for($i=1; $i <= $jmlhalaman;$i++) : ?>
                <?php if($i == $halamanAktif) : ?> 
                  <li class="page-item active"><a class="page-link" href="?halamanbuku=<?= $i; ?>"><?= $i; ?></a></li>
                  <?php else : ?>
                    <li class="page-item"><a class="page-link" href="?halamanbuku=<?= $i; ?>"><?= $i; ?></a></li>
                  <?php endif ?>     
            <?php endfor ?>

            <?php if($halamanAktif < $jmlhalaman ) : ?>
              <li class="page-item">
           <a class="page-link" href="?halamanbuku=<?= $halamanAktif +1; ?>" aria-label="Next">
              <?php else : ?>
                <li class="page-item disabled bg-transparent">
           <a class="page-link" href="?halamanbuku=<?= $halamanAktif +1; ?>" aria-label="Next">
              <?php endif ?>
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
          </ul>
        </nav>

    <!-- akhir dari daftar buku  -->
   
        

</div>



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
