<?php 

  require '../functions.php';

  $idanggota=$_GET['idanggota'];
    if(isset($_GET['idanggota'])){
      if(hapusAnggota($idanggota,'tbanggota') > 0){
        echo "<script>
        alert('Data Berhasil Di hapus');
        document.location.href ='daftar-anggota.php';
      </script>";
        }else{
        echo " echo 
        <script>
          alert('Data Gagal Di hapus');
        </script>";
             }
      }

    
?>
