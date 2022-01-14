<?php

include '../functions.php';

if (isset($_POST['submit'])) {
   if (insert($_POST) > 0) {
      echo '<script>
               alert("Berhasil Menambahkan Data");
               document.location.href = "../index.php";
            </script>';
   } else {
      echo '<script>
               alert("Gagal Menambahkan Data");
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
   <title>Insert Data</title>
</head>

<body>
   <h3>Form Insert Data</h3>

   <form action="" method="post">
      <ul>
         <li>
            <label> Nama :
               <input required type="text" name="nama" autofocus>
            </label>
         </li>
         <li>
            <label> NRP :
               <input required type="text" name="nrp">
            </label>
         </li>
         <li>
            <label> Email :
               <input required type="text" name="email">
            </label>
         </li>
         <li>
            <label> Jurusan :
               <input required type="text" name="jurusan">
            </label>
         </li>
         <li>
            <label> Gambar :
               <input required type="text" name="gambar">
            </label>
         </li>
         <li>
            <button type="submit" name="submit">insert</button>
            <button><a href="../index.php">Kembali << </a></button>
         </li>
      </ul>
   </form>
</body>

</html>