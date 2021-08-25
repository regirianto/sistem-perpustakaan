<?php 

require '../functions.php';
$anggota =query("SELECT * FROM tbanggota ORDER BY idanggota");

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sistem Perpustakaan</title>
</head>
<body>
<h1>Daftar Anggota</h1>
   <table style="width: 90%; text-align:left;" border="1">
              <thead >        
                <tr>
                  <th>No</th>
                  <th>ID Anggota</th>
                  <th >Nama</th>
                  <th>Jenis Kelamin</th>
                  <th>Alamat</th>
                  <th>Foto</th>
                  <!-- <th>Aksi</th> -->
                </tr>

                
              </thead>
              <tbody >
                <?php $i=1; ?>
              <?php foreach ($anggota as $m) : ?>
                <tr>
                  <td><?= $i++; ?></td>
                  <td><?= ucfirst($m['idanggota']); ?></td>
                  <td><?= ucfirst($m['nama']); ?></td>
                  <td><?= $m['jeniskelamin']; ?></td>
                  <td><?= $m['alamat']; ?></td>
                  <td><img src="../asset/img/<?= $m['foto']; ?>" style="width: 25px;" alt=""></td>
                  <!-- <td>
                  <a href="edit-anggota.php?idanggota=<?= $m['idanggota']; ?>"><button type="button" class="btn btn-success btn-sm">Edit</button></a>
                  <a href=""><button type="button" class="btn btn-secondary btn-sm">Cetak Kartu</button></a>
                  <a href="hapus-anggota.php?idanggota=<?= $m['idanggota']; ?>"><button type="button" class="btn btn-danger btn-sm">Hapus</button></a>
                </td> -->
                </tr>
                <?php endforeach ?>
              <?php  ?>
                
              </tbody>
            </table>
            <script>
              window.print();
            </script>
</body>
</html>