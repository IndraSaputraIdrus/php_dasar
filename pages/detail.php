<?php

require_once '../functions.php';

if (isset($_GET['id'])) {

   $id = $_GET['id'];
   $siswa = query("SELECT * FROM siswa WHERE id = $id");

   if (!$siswa) {
      echo "<script>
            alert('Data tidak ditemukan');
            document.location.href = '../index.php';
            </script>";
   }
} else {

   echo "<script>
         alert('Data tidak ditemukan');
         document.location.href = '../index.php';
         </script>";
}



?>



<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Detail siswa</title>
</head>

<body>
   <ul>
      <li><img src="../img/<?= $siswa['gambar']; ?>" width="150"></li>
      <li>Nama : <?= $siswa['nama']; ?></li>
      <li>NRP : <?= $siswa['nrp']; ?></li>
      <li>Email : <?= $siswa['email']; ?></li>
      <li>Jurusan :
         <?= ($siswa['jurusan'] == 'rpl') ? "Rekayasa Perangkat Lunak" : "tidak diketahui";

         ?>
      </li>
      <li><a href="edit.php?id=<?= $siswa['id']; ?>">Ubah</a> | <a id="del" href="delete.php?id=<?= $siswa['id']; ?>">Hapus</a></li>
      <li><a href="../index.php">Kembali >></a></li>
   </ul>
</body>

<script src="../script.js"></script>

</html>