<?php 
session_start();


if(isset($_SESSION["login"])){
  header("location: dashboard.php");
  exit;
}

require './functions.php';
if(isset($_POST['login'])){
  $conn=koneksi();  
    $username=$_POST['username'];
    $password=$_POST['password'];

    $result=mysqli_query($conn,"SELECT * FROM tbadmin WHERE username = '$username' ");

    if(mysqli_num_rows($result) === 1){

      $row=mysqli_fetch_assoc($result);
     if($password === $row['password']){
       $_SESSION["login"]=true;
        header("location: dashboard.php");
        exit;


     }else{
      echo '<script>alert("anda gagal login");</script>';
     }
      
    }

    else{
      echo '<script>alert("anda gagal login");</script>';
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sistem Perpustakaan</title>
 <!-- Google Font: Source Sans Pro -->
 <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
  <style>
    .fa-book-reader{
      font-size: 100px;
      margin-bottom: 20px;
    };
  </style>
</head>
<body>
  <div class="container text-center mt-5">
   <div class="row">
     <div class="col-md ">
     <div class="row justify-content-center ">
      <div class="col-md-4">
      <form class="shadow-lg p-3 rounded-lg" method="POST" action="">
      <i class="fas fa-book-reader text-primary"></i>
      <h1 class="h3 mb-3 font-weight-normal">Sistem Informasi Perpustakaan</h1>
      <input type="text" id="username" class="form-control mb-2" placeholder="Username" name="username">
      <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="password">
      <div class="checkbox mb-2">
        <label>
        </label>
      </div>
      <button class="btn btn-lg btn-primary btn-block mb-3" type="submit" name="login">Masuk</button>
      <a href="./list-buku.php">Lihat Daftar Buku</a>
    </form>
      </div>
    </div>    
     </div>
   </div>
  </div>
</body>>
</html>