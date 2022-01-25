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

function hapus($id)
{
   $conn = koneksi();
   mysqli_query($conn, "DELETE FROM siswa WHERE id = $id") or die(mysqli_error($conn));
   return mysqli_affected_rows($conn);
}

function Edit($post)
{
   $conn = koneksi();

   $nama = htmlspecialchars($post['nama']);
   $nrp = htmlspecialchars($post['nrp']);
   $email = htmlspecialchars($post['email']);
   $jurusan = htmlspecialchars($post['jurusan']);
   $gambar = htmlspecialchars($post['gambar']);
   $id = htmlspecialchars($post['id']);

   if (!is_numeric($nrp)) {
      return false;
   }

   $query = "UPDATE siswa SET
               nama = '$nama',
               nrp = '$nrp',
               email = '$email',
               jurusan = '$jurusan',
               gambar = '$gambar'
            WHERE id = $id;
            ";
   mysqli_query($conn, $query);

   echo mysqli_error($conn);

   return mysqli_affected_rows($conn);
}

function cari($keyword)
{
   $conn = koneksi();

   $query = "SELECT * FROM siswa 
                  WHERE 
            nama LIKE '%$keyword%' OR
            nrp LIKE '%$keyword%' OR
            jurusan LIKE '%$keyword%' OR
            email LIKE '%$keyword%'
            ";

   $result = mysqli_query($conn, $query);

   $rows = [];
   while ($row = mysqli_fetch_assoc($result)) {
      $rows[] = $row;
   }
   return $rows;
}
