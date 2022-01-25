<?php
require_once "../functions.php";

if (!isset($_SESSION['login'])) {
   header("Location: login.php");
}

if (isset($_GET['id'])) {
   if (!$_GET['id']) {
      header("Location: ../index.php");
      exit;
   }
} else {
   header("Location: ../index.php");
   exit;
}

$id =  $_GET['id'];

if (hapus($id) > 0) {
   echo '<script>
               alert("Berhasil Menghapus Data");
               document.location.href = "../index.php";
            </script>';
} else {
   echo '<script>
               alert("Gagal Menghapus Data");
            </script>';
}
