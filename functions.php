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
    $query = "INSERT INTO $tabel VALUES ('$id','$judul','$tahun','$penulis','$kategori')";

    mysqli_query($conn,$query);

    echo mysqli_error($conn);
    return mysqli_affected_rows($conn);
  }

  function tambahAnggota($data,$tabel){
    $conn=koneksi();
    $id=htmlspecialchars($data['idanggota']);
    $nama=htmlspecialchars($data['namaanggota']);
    $jenisKelamin=htmlspecialchars($data['jeniskelamin']);
    $alamat=htmlspecialchars($data['alamat']);
    $foto=htmlspecialchars($data['foto']);  
    $query = "INSERT INTO $tabel VALUES ('$id','$nama','$jenisKelamin','$alamat','$foto')";

    mysqli_query($conn,$query);

    echo mysqli_error($conn);
    return mysqli_affected_rows($conn);

  }

  function hapusBuku($data,$tabel){
    $conn=koneksi();
    $query = "DELETE FROM $tabel WHERE idbuku='$data'";
    mysqli_query($conn,$query);
    echo mysqli_error($conn);
    return mysqli_affected_rows($conn);
  }

  function hapusAnggota($data,$tabel){
    $conn=koneksi();
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
    $query=("UPDATE tbbuku SET judulbuku='$judul',tahunbuku=$tahun,penulisbuku='$penulis',kategori='$kategori' WHERE idbuku='$id'");

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
    $foto=htmlspecialchars($data['foto']);  
    $query = ("UPDATE tbanggota SET nama='$nama',jeniskelamin='$jenisKelamin',alamat='$alamat',foto='$foto' WHERE idanggota='$id'");

    mysqli_query($conn,$query);

    echo mysqli_error($conn);
    return mysqli_affected_rows($conn);

  }
?>