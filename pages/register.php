<?php

require_once "../functions.php";

if (isset($_POST['daftar'])) {
   $daftar = daftar($_POST);
   if ($daftar['error'] == false) {
   }
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Register User</title>
</head>

<body>

   <h3>Register User</h3>

   <?php if (isset($daftar['error'])) : ?>
      <p><?= $daftar['pesan']; ?></p>
   <?php endif; ?>

   <form action="" method="post">
      <ul>
         <li>
            <label for="username">Username:</label><br>
            <input type="text" name="username" id="username" required autocomplete="off">
         </li>
         <li>
            <label for="password">Password:</label><br>
            <input type="password" name="password1" id="password1" required>
         </li>
         <li>
            <label for="password">Password Confirm:</label><br>
            <input type="password" name="password2" id="password2" required>
         </li>
         <button type="submit" name="daftar">Daftar</button>
         <a href="login.php">kembali<< </a>
      </ul>
   </form>
</body>

</html>