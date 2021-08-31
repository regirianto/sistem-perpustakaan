<?php 

  require './functions.php';
  if(isset($_POST['register'])){
    if(registrasi($_POST) > 0){
     echo "<script>
              alert('Pendaftaran Berhasil Silahkan Login');
              document.location.href='index.php';
          </script>";
    }else{
       echo "<script>
              alert('Pendaftaran Gagal');
              document.location.href='register.php';
          </script>";
    }
  }

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
</head>
<body>
  <div class="container mt-5">
   <div class="row">
     <div class="col-md p-5">
     <div class="row justify-content-center ">
      <div class="col-md-6">
      <form class="shadow-lg p-3 rounded-lg p-4" method="POST" action="">
       <a href="./index.php"><i class="bi bi-arrow-left-square text-primary">   Kembali</i></a>
      <div class="form-group">
      <h1 class="h3 mb-3 font-weight-normal text-center">Form Register</h1>
      <label for="Username">Masukan Username :</label>
      <input type="text" id="username" class="form-control mb-2" placeholder=" Masukan Username" name="username" required>
      <label for="password1">Masukan Password :</label>
      <input type="password" id="password1" class="form-control mb-2" placeholder="Masukan Password" name="password1" required>
      <label for="password2">Konfirmasi Password :</label>
      <input type="password" id="inputPassword" class="form-control mb-2" placeholder="Konfirmasi Password" name="password2" required>
      <div class="checkbox mb-2">
        <label>
        </label>
      </div>
      <button class="btn btn-primary btn-block mb-3" type="submit" name="register">Daftar</button>
      </div>
    </form>
  </div>
    </div>    
     </div>
   </div>
  </div>
</body>
</html>