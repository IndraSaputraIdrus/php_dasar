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

   $rows = [];
   while ($row = mysqli_fetch_assoc($result)) {
      $rows[] = $row;
   }
   return $rows;
}
