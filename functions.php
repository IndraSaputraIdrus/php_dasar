<?php
session_start();

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

function upload(){
   $nama_file = $_FILES['gambar']['name'];
   $tipe_file = $_FILES['gambar']['type'];
   $ukuran_file = $_FILES['gambar']['size'];
   $error = $_FILES['gambar']['error'];
   $tmp_file = $_FILES['gambar']['tmp_name'];

   // ketika tidak ada gambar di pilih
   if ($error == 4) {
     return 'nophoto.png'; 
   }

   // cek ekstensi file
   $daftar_gambar = ["jpg", "jpeg", "png"];
   $ekstensi_file = explode(".", $nama_file);
   $ekstensi_file = strtolower(end($ekstensi_file));

   if (!in_array($ekstensi_file, $daftar_gambar)) {
      echo '
      <script>
         alert("Yang anda pilih bukan gambar");
      </script>';
      return false;
   }

   // cek tipe file
   if ($tipe_file != "image/jpeg" && $tipe_file != "image/png") {
         echo '
      <script>
         alert("Yang anda pilih bukan gambar");
      </script>';
      return false;
   }

   // cek ukuran file
   // max 5mb == 5000000
   if ($ukuran_file > 5000000) {
         echo '
      <script>
         alert("Ukuran gambar terlalu besar");
      </script>';
      return false;
   }

   // lolos pengecekan siap upload file
   // generate nama file baru
   $nama_file_baru = uniqid();
   $nama_file_baru .= ".";
   $nama_file_baru .= $ekstensi_file;
   move_uploaded_file($tmp_file, "../img/" . $nama_file_baru);

   return $nama_file_baru;
}

function insert($post)
{
   $conn = koneksi();

   $nama = htmlspecialchars($post['nama']);
   $nrp = htmlspecialchars($post['nrp']);
   $email = htmlspecialchars($post['email']);
   $jurusan = htmlspecialchars($post['jurusan']);
   // $gambar = htmlspecialchars($post['gambar']);

   // upload gambar
   $gambar = upload();

   if (!$gambar) {
      return false;
   }

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

   // menghapus gambar di folder
   $siswa = query("SELECT * FROM siswa WHERE id = $id");
   if ($siswa['gambar'] != "nophoto.png") {
      unlink("../img/" . $siswa['gambar']);   
   }

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
   $gambar_lama = htmlspecialchars($post['gambar_lama']);
   $id = htmlspecialchars($post['id']);

   $gambar = upload();
   if (!$gambar) {
      return false; 
   }

   if ($gambar == "nophoto.png") {
      $gambar = $gambar_lama;
   } else if ($gambar_lama != $gambar && $gambar_lama != "nophoto.png") {
      $siswa = query("SELECT * FROM siswa WHERE id = $id");
      unlink("../img/" . $siswa['gambar']);
   } {

   }

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

function login($post)
{
   $conn = koneksi();

   $username = htmlspecialchars($post['username']);
   $password = htmlspecialchars($post['password']);

   $query = query("SELECT * FROM user WHERE username = '$username'");


   if ($query) {
      if (password_verify($password, $query['password'])) {
         $_SESSION['login'] = true;
         return 'berhasil';
      }
   }

   return [
      "error" => true,
      "pesan" => "Username / Password salah!"
   ];
}


function daftar($post)
{
   $conn = koneksi();

   $username = htmlspecialchars($post['username']);
   $password1 = mysqli_real_escape_string($conn, $post['password1']);
   $password2 = mysqli_real_escape_string($conn, $post['password2']);

   if (empty($username) || empty($password1) || empty($password2)) {
      return [
         'error' => true,
         'pesan' => "Isi field yang kosong"
      ];
   }

   if ($password1 != $password2) {
      return [
         'error' => true,
         'pesan' => "Password Tidak Sama"
      ];
   }

   // username sudah ada
   if (query("SELECT * FROM user WHERE username = '$username'")) {
      return [
         'error' => true,
         'pesan' => "Username sudah ada"
      ];
   }

   // panjang password > 5
   if (strlen($password1) > 5) {
      return [
         'error' => true,
         'pesan' => "Password terlalu panjang"
      ];
   }

   $new_password = password_hash($password1, PASSWORD_DEFAULT);
   // insert to table
   $query = "INSERT INTO user VALUES (null, '$username', '$new_password')";
   mysqli_query($conn, $query);
   if (mysqli_affected_rows($conn) > 0) {
      return [
         'error' => false,
         'pesan' => "Berhasil Menambahkan user baru"
      ];
   }

   return [
      'error' => true,
      'pesan' => "Gagal Menambahkan User baru"
   ];
}
