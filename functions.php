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
      var_dump($anggota['foto']);

    
    
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

?>


