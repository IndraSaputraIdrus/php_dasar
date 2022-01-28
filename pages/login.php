<?php
require_once '../functions.php';

if (isset($_SESSION['login'])) {
   header('Location: ../index.php');
}

if (isset($_POST['login'])) {
   $login = login($_POST);
   if ($login == 'berhasil') {
      header("Location: ../index.php");
      exit;
   }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login</title>
</head>

<body>
   <h3>Login</h3>
   <?php if (isset($login['error'])) : ?>
      <p><?= $login['pesan']; ?></p>
   <?php endif; ?>
   <form action="" method="post">
      <ul>
         <li>
            <label for="username">Username:</label><br>
            <input type="text" name="username" id="username" required autocomplete="off">
         </li>
         <li>
            <label for="password">Password:</label><br>
            <input type="password" name="password" id="password" required>
         </li>
         <button type="submit" name="login">Login!</button>
         <button><a href="register.php">Daftar</a></button>
      </ul>
   </form>
</body>

</html>