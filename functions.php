<?php

function koneksi()
{
   // koneksi 
   $host = 'localhost';
   $username = 'root';
   $password = '';
   $db = 'sekolah';

   $conn = mysqli_connect($host, $username, $password, $db);
   return $conn;
}

function query($query)
{
   $conn = koneksi();

   $result = mysqli_query($conn, $query);

   // jika data hanya satu
   if (mysqli_num_rows($result) == 1) {
      return mysqli_fetch_assoc($result);
   }

   $rows = [];
   while ($row = mysqli_fetch_assoc($result)) {
      $rows[] = $row;
   }
   return $rows;
}

function insert($post)
{
   $conn = koneksi();

   $nama = htmlspecialchars($post['nama']);
   $nrp = htmlspecialchars($post['nrp']);
   $email = htmlspecialchars($post['email']);
   $jurusan = htmlspecialchars($post['jurusan']);
   $gambar = htmlspecialchars($post['gambar']);

   if (!is_numeric($nrp)) {
      return false;
   }

   $query = "INSERT INTO siswa VALUES (NULL, '$nama', '$nrp', '$email', '$jurusan', '$gambar')";
   mysqli_query($conn, $query);

   echo mysqli_error($conn);

   return mysqli_affected_rows($conn);
}
