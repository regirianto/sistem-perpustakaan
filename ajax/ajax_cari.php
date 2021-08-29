<?php 
require '../functions.php';
$books=cariBuku($_GET['keyword']);

?>
 <div class="row justify-content-center">
        <?php foreach($books as $book) :?>
        <div class="col-md-4 mb-4">
        <div class="card shadow" style="width: 18rem; ">
            <img src="./asset/img/<?= $book['cover']; ?>" class="pt-3 mx-auto" alt="..." width="120px">
            <div class="card-body">
              <h5 class="card-title"><?= $book['judulbuku']; ?></h5>
              <h5>Penulis :</h5>
              <p><?= ucfirst($book['penulisbuku']); ?></p>
              <h5>Tahun</h5>
              <p><?= $book['tahunbuku']; ?></p>
              <h5>kategori</h5>
              <p><?= $book['kategori']; ?></p>
            </div>
          </div>
        </div>
        <?php endforeach  ?>
        </div>