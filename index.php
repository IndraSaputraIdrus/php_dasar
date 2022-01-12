<?php

require 'functions.php';

$siswa = query("SELECT * FROM siswa");
$no = 1;

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
   <table border="1" cellpadding='10' cellspacing='0'>
      <tr>
         <th>#</th>
         <th>Gambar</th>
         <th>NRP</th>
         <th>Nama</th>
         <th>Email</th>
         <th>Jurusan</th>
         <th>Aksi</th>
      </tr>

      <?php foreach ($siswa as $s) : ?>
         <tr>
            <td><?= $no++; ?></td>
            <td><img src="img/<?= $s['gambar']; ?>"></td>
            <td><?= $s['nrp']; ?></td>
            <td><?= $s['nama']; ?></td>
            <td><?= $s['email']; ?></td>
            <td><?= $s['jurusan']; ?></td>
            <td><a href="">Edit</a> | <a href="">delete</a></td>
         </tr>
      <?php endforeach; ?>
   </table>
</body>

</html>