<?php

require 'functions.php';

$siswa = query("SELECT * FROM siswa");
$no = 1;

if (isset($_POST['cari'])) {
   $siswa = cari($_POST['keyword']);
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Daftar Siswa</title>
</head>

<body>
   <h3>Daftar Siswa</h3>
   <a href="pages/insert.php">Tambah Data</a>
   <br><br>

   <form action="" method="post">
      <input type="text" name="keyword" size="35" autocomplete="off" autofocus placeholder="masukkan keyword pencarian">
      <button type="submit" name="cari">Cari!</button>
   </form>

   <br>
   <table border="1" cellpadding='10' cellspacing='0'>
      <tr>
         <th>#</th>
         <th>Gambar</th>
         <th>Nama</th>
         <th>Aksi</th>
      </tr>

      <?php if (empty($siswa)) : ?>
         <tr>
            <td colspan="4">
               <p>Data Tidak Ditemukan!!!</p>
            </td>
         </tr>
      <?php endif; ?>

      <?php foreach ($siswa as $s) : ?>
         <tr>
            <td><?= $no++; ?></td>
            <td><img src="img/<?= $s['gambar']; ?>"></td>
            <td><?= $s['nama']; ?></td>
            <td><a href="pages/detail.php?id=<?= $s['id']; ?>">Detail</a></td>
         </tr>
      <?php endforeach; ?>
   </table>
</body>

</html>