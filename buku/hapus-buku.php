<?php 
require '../functions.php';
$idbuku=$_GET['idbuku'];
  if(isset($_GET['idbuku'])){
      if(hapusBuku($idbuku,'tbbuku') > 0){
        echo "<script>
                alert('Data Berhasil Di hapus');
                document.location.href ='daftar-buku.php';
              </script>";
      }else{
        echo " echo 
        <script>
          alert('Data Gagal Di hapus');
        </script>";
      }
  }
?>