<?php

include '../functions.php';

if (isset($_GET['id'])) {
   if (!$_GET['id']) {
      header("Location: ../index.php");
      exit;
   }
} else {
   header("Location: ../index.php");
   exit;
}

$id = $_GET["id"];

$siswa = query("SELECT * FROM siswa WHERE id = $id");

if (isset($_POST['submit'])) {
   if (edit($_POST) > 0) {
      echo '<script>
               alert("Berhasil Mengubah Data");
               document.location.href = "../index.php";
            </script>';
   } else {
      echo '<script>
               alert("Gagal Mengubah Data");
            </script>';
   }
}



?>



<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Edit Data</title>
</head>

<body>
   <h3>Form Edit Data</h3>

   <form action="" method="post">
      <input type="hidden" name="id" value="<?= $siswa['id']; ?>">
      <ul>
         <li>
            <label> Nama :
               <input required type="text" name="nama" autofocus value="<?= $siswa['nama']; ?>">
            </label>
         </li>
         <li>
            <label> NRP :
               <input required type="text" name="nrp" value="<?= $siswa['nrp']; ?>">
            </label>
         </li>
         <li>
            <label> Email :
               <input required type=" text" name="email" value="<?= $siswa['email']; ?>">
            </label>
         </li>
         <li>
            <label> Jurusan :
               <input required type=" text" name="jurusan" value="<?= $siswa['jurusan']; ?>">
            </label>
         </li>
         <li>
            <label> Gambar :
               <input required type=" text" name="gambar" value="<?= $siswa['gambar']; ?>">
            </label>
         </li>
         <li>
            <button type=" submit" name="submit">Edit</button>
            <button><a href="../index.php">Kembali << </a></button>
         </li>
      </ul>
   </form>
</body>

</html>