<?php

require_once '../functions.php';

$siswa = cari($_GET['keyword']);
$no = 1;
?>

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