<?php 
session_start();
if(!isset($_SESSION["login"])){
  header("location: ../index.php");
  exit;
}
  require "../functions.php";

  //mengambil id dari url

  $idanggota=$_GET['idanggota'];

  //query mahasiswa berdasarkan nrp

  $m=query("SELECT * FROM tbanggota WHERE idanggota='$idanggota'")[0];


?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sistem Perpustakaan</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
</head>
<body>
  
<div class="card mb-3 m-3 bg-secondary  text-white" style="max-width: 540px;">
  <div class="row no-gutters">
    <div class="col-md-4 mt-3">
      <img src="../asset/img/<?= $m['foto']; ?>" alt="..." width="100%" >
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <h5 class="card-title">Kartu Anggota</h5>
        <p class="card-text">ID anggota : <?= ucfirst($m['idanggota']); ?></p>
        <p class="card-text">Nama : <?= ucfirst($m['nama']); ?></p>
        <p class="card-text">jenis Kelamin : <?= ucfirst($m['jeniskelamin']); ?></p>
        <p class="card-text">Alamat : <?= ucfirst($m['alamat']); ?></p>

      </div>
    </div>
  </div>
</div>

<script>
  window.print();
</script>
</body>
</html>

