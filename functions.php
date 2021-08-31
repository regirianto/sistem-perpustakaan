<?php 

  function koneksi(){
    return $conn =mysqli_connect('localhost','root','','dbpus');
  }

  function query ($query){
    $conn=koneksi();
    $result=mysqli_query($conn,$query);


    //jika hasilnya hanya satu data atau data tidak menghaslkan arary of array
      // if(mysqli_num_rows($result) == 1){

      //   return mysqli_fetch_assoc($result);
      // }
    $rows=[];
    while($row=mysqli_fetch_assoc($result)){
    $rows[]=$row;
    }
    return $rows;
  }


  function tambahBuku($data,$tabel){
    $conn=koneksi();
    $id=htmlspecialchars($data['idbuku']);
    $judul=htmlspecialchars($data['judulbuku']);
    $tahun=htmlspecialchars($data['tahunbuku']);
    $penulis=htmlspecialchars($data['penulisbuku']);
    $kategori=htmlspecialchars($data['kategori']);
    $cover=uploadCover();
      

    if(empty($id) || empty($judul) || empty($tahun) || empty($kategori) ){
     echo "<script>
              alert('Field Tidak Boleh Kosong');
              document.location.href='tambah-buku.php';
          </script>";
      return false;    
    }

    if(strlen($id) > 5 ){
        echo "<script>
              alert('Field ID Buku Tidak boleh Lebih dari 5 Karakter');
              document.location.href='tambah-buku.php';
          </script>";
      return false;   
    }

    if(query("SELECT * FROM $tabel WHERE idbuku= '$id' ")){
      echo "<script>
              alert('ID Buku Sudah Di Gunakan');
              document.location.href='tambah-buku.php';
          </script>";
      return false;
    }
    $query = "INSERT INTO $tabel VALUES ('$id','$judul','$tahun','$penulis','$kategori','$cover')";

    mysqli_query($conn,$query);

    echo mysqli_error($conn);
    return mysqli_affected_rows($conn);
  }

  function upload(){
    // return false;
    $namaFile=$_FILES['foto']['name'];
    $tipeFile=$_FILES['foto']['type'];
    $ukuranFile=$_FILES['foto']['size'];
    $error=$_FILES['foto']['error'];
    $tmpFile=$_FILES['foto']['tmp_name'];


    $daftarGambar=['jpg','jpeg','png'];
    $ekstensifile=explode('.',$namaFile);
    $ekstensifile=strtolower(end($ekstensifile));

    if($error == 4){

      return 'nofoto.png';
    }

    if(!in_array($ekstensifile,$daftarGambar)){
      echo "<script> alert('format foto harus JPG ,JPEG, PNG') </script>";
      return false;
    }
    // if($tipeFile != 'image/jpeg' && $tipeFile != 'image/jpg' && $tipeFile != 'image/png'){
    //   echo "<script> alert('yang anda upload bukan foto') </script>";
    //   return false;
    // }

      //func nama baru untuk nama file
      $namaFileBaru=uniqid();
      $namaFileBaru.='.';
      $namaFileBaru.=$ekstensifile;
      move_uploaded_file($tmpFile,'../asset/img/'. $namaFileBaru);
      return $namaFileBaru;

  }
  function uploadCover(){
    // return false;
    $namaFile=$_FILES['cover']['name'];
    $tipeFile=$_FILES['cover']['type'];
    $ukuranFile=$_FILES['cover']['size'];
    $error=$_FILES['cover']['error'];
    $tmpFile=$_FILES['cover']['tmp_name'];


    $daftarGambar=['jpg','jpeg','png'];
    $ekstensifile=explode('.',$namaFile);
    $ekstensifile=strtolower(end($ekstensifile));

    if($error == 4){

      return 'coverbook.png';
    }

    if(!in_array($ekstensifile,$daftarGambar)){
      echo "<script> alert('format foto harus JPG ,JPEG, PNG') </script>";
      return false;
    }
    // if($tipeFile != 'image/jpeg' && $tipeFile != 'image/jpg' && $tipeFile != 'image/png'){
    //   echo "<script> alert('yang anda upload bukan foto') </script>";
    //   return false;
    // }

      //func nama baru untuk nama file
      $namaFileBaru=uniqid();
      $namaFileBaru.='.';
      $namaFileBaru.=$ekstensifile;
      move_uploaded_file($tmpFile,'../asset/img/'. $namaFileBaru);
      return $namaFileBaru;

  }
  function tambahAnggota($data){
    $conn=koneksi();
    $id=htmlspecialchars($data['idanggota']);
    $nama=htmlspecialchars($data['namaanggota']);
    $jenisKelamin=htmlspecialchars($data['jeniskelamin']);
    $alamat=htmlspecialchars($data['alamat']);
    // $foto=htmlspecialchars($data['foto']);
    $foto=upload(); 
    if(!$foto){
      return false;
    } 
    if(empty($nama) || empty($id) || empty($alamat)){
         echo "<script>
                  alert('Field tidak boleh kosong');
                  document.location.href='./tambah-anggota.php';
                </script>";
          return false;
    }
      if(query("SELECT * FROM tbanggota WHERE idanggota = '$id'")){

            echo "<script>
                        alert('ID Sudah Di Gunakan');;
                        document.location.href='./tambah-anggota.php';
                  </script>";
           return false;
      }


   
    $query = "INSERT INTO tbanggota VALUES ('$id','$nama','$jenisKelamin','$alamat','$foto')";

    mysqli_query($conn,$query);

    echo mysqli_error($conn);
    return mysqli_affected_rows($conn);

  }

  function hapusBuku($data,$tabel){
    $conn=koneksi();
    $buku=query("SELECT cover FROM  $tabel WHERE idbuku='$data'")[0];
    if($buku['cover'] != 'coverbook.png'){
      unlink('../asset/img/'.$buku['cover']);
    }
    $query = "DELETE FROM $tabel WHERE idbuku='$data'";
    mysqli_query($conn,$query);
    echo mysqli_error($conn);
    return mysqli_affected_rows($conn);
  }

  function hapusAnggota($data,$tabel){
    $conn=koneksi();
  
    $anggota=query("SELECT * FROM $tabel WHERE idanggota='$data'")[0];
      if($anggota['foto'] != 'nofoto.png'){
        unlink('../asset/img/'.$anggota['foto']);
      }

    
    
    $query="DELETE FROM $tabel WHERE idanggota='$data'";
    mysqli_query($conn,$query);
    echo mysqli_error($conn);
    return mysqli_affected_rows($conn);
  }

  function editBuku($data){
    $conn=koneksi();
    $id=htmlspecialchars($data['idbuku']);
    $judul=htmlspecialchars($data['judulbuku']);
    $tahun=htmlspecialchars($data['tahunbuku']);
    $penulis=htmlspecialchars($data['penulisbuku']);
    $kategori=htmlspecialchars($data['kategori']); 
    $coverLama= htmlspecialchars($data['coverlama']); 
    if($_FILES['cover']['error'] === 4){
      $cover=$coverLama;
    } else{
      $cover=uploadCover();
    }
    $query=("UPDATE tbbuku SET judulbuku='$judul',tahunbuku=$tahun,penulisbuku='$penulis',kategori='$kategori',cover='$cover' WHERE idbuku='$id'");

    mysqli_query($conn,$query);
    echo mysqli_error($conn);
    return mysqli_affected_rows($conn);
    
  }
  function editAnggota($data){
    $conn=koneksi();
    $id=htmlspecialchars($data['idanggota']);
    $nama=htmlspecialchars($data['namaanggota']);
    $jenisKelamin=htmlspecialchars($data['jeniskelamin']);
    $alamat=htmlspecialchars($data['alamat']);
    $fotoLama=htmlspecialchars($data['fotolama']); 
    if($_FILES['foto']['error'] === 4){
      $foto=$fotoLama;
    } else{
      $foto=upload();
    }
    $query = ("UPDATE tbanggota SET nama='$nama',jeniskelamin='$jenisKelamin',alamat='$alamat',foto='$foto' WHERE idanggota='$id'");

    mysqli_query($conn,$query);

    echo mysqli_error($conn);
    return mysqli_affected_rows($conn);

  }


  function cariBuku($pencarian){
    $conn=koneksi();
      $query="SELECT * FROM tbbuku WHERE 
                      judulbuku LIKE '%$pencarian%' OR 
                      idbuku LIKE '%$pencarian%' OR
                      tahunbuku LIKE '%$pencarian%' OR 
                      penulisbuku LIKE '%$pencarian%' OR 
                      kategori LIKE '%$pencarian%'" ;

                      return query($query);

  }
  function cariAnggota($pencarian){
    $conn=koneksi();
      $query="SELECT * FROM tbanggota WHERE 
                      nama LIKE '%$pencarian%' OR 
                      idanggota LIKE '%$pencarian%' OR
                      jeniskelamin LIKE '%$pencarian%' OR 
                      alamat LIKE '%$pencarian%' " ;

                      return query($query);

  }


  function registrasi($data){
    $conn=koneksi();
    $userName=htmlspecialchars(strtolower($data['username']));
    $password1=mysqli_real_escape_string($conn,$data['password1']);
    $password2=mysqli_real_escape_string($conn,$data['password2']);


      if(empty($userName) || empty($password1) || empty($password2) ){
        echo "<script>
                alert('Field Tidak Boleh Kosong');
                document.location.href='register.php';
              </script>";
        return false;
      }
      if(query("SELECT * FROM tbadmin WHERE username ='$userName'")){
           echo "<script>
                alert('Username Sudah Terdafatar');
                document.location.href='register.php';
              </script>";
        return false;
      }
      if($password1 !== $password2 ){
           echo "<script>
                alert('Konfirmasi Password Salah');
                document.location.href='register.php';
              </script>";
        return false;
      }
      if(strlen($password2) < 5){
            echo "<script>
                    alert('Password Harus lebih Dari 5 karakter');
                    document.location.href='register.php';
                  </script>";
            return false;
      }

      $passwordBaru=password_hash($password2,PASSWORD_DEFAULT);
      
      $query="INSERT INTO tbadmin VALUES('','$userName','$passwordBaru')";
      mysqli_query($conn,$query) or die(mysqli_error($conn));
      return mysqli_affected_rows($conn);

  }
?>


