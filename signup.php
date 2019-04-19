<!DOCTYPE html>
<html>
  <head>
    <title>Hjuma</title>
    <link rel="stylesheet" href="style/signup.style.css">
  </head>
  <body>
    <?php require "header.php"; ?>

      <form class="content" action="scr/signup.scr.php" method="post">

        <h1>Registracija</h1>

        <div class="container">
        <?php
          if (isset($_GET['username'])) {
            $username = $_GET['username'];
            echo '<input type="text" name="username" autocomplete="off" placeholder="Korisničko ime" size="30" value="'.$username.'" required/>';
          }
          else {
            echo '<input type="text" name="username" autocomplete="off" placeholder="Korisničko ime" size="30" value="" required/>';
          }
          if (isset($_GET['email'])) {
            $email = $_GET['email'];
            echo '<input type="text" name="email" autocomplete="off" placeholder="E-mail" size="30" value="'.$email.'" required/>';
          }
          else {
            echo '<input type="text" name="email" autocomplete="off" placeholder="E-mail" size="30" value="" required/>';
          }
        ?>
        <input type="password" name="password" autocomplete="off" placeholder="Lozinka" size="30" value="" required/>
        <input type="password" name="password-rp" autocomplete="off" placeholder="Potvrda lozinke" size="30" value="" required/>
        <button type="submit" name="signup-submit" class="submit" autocomplete="off" value="Submit">Registracija</button>
        </div>
      </form>
      <div class="alogin">
        <a href="login">Log in</a>
      </div>
<?php
require 'footer.php';
?>
