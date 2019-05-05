<!DOCTYPE html>
<html>
  <head>
    <title>Hjuma</title>
    <link rel="stylesheet" href="style/login_signup.style.css">
  </head>
  <body>
    <?php require "header.php"; ?>
      <form class="content" action="scr/signup.scr.php" method="post">
<div class="container">
        <h1 style="text-align: center; padding: 60px;">Sign up</h1>


        <?php
          if (isset($_GET['username'])) {
            $username = $_GET['username'];
            echo '<input type="text" class="form-control" name="username" autocomplete="off" placeholder="Korisničko ime" size="30" value="'.$username.'" required/>';
          }
          else {
            echo '
            <div class="form-group">
            <input type="text" name="username" class="form-control" autocomplete="off" placeholder="Korisničko ime" size="30" value="" required/>
            </div>';
          }
          if (isset($_GET['email'])) {
            $email = $_GET['email'];
            echo '
            <div class="form-group">
            <input type="text" name="email" class="form-control" autocomplete="off" placeholder="E-mail" size="30" value="'.$email.'" required/>
            </div>';
          }
          else {
            echo '
            <div class="form-group">
            <input type="text" name="email"class="form-control" autocomplete="off" placeholder="E-mail" size="30" value="" required/>
            </div>
            ';
          }
        ?>
        <div class="form-group">
        <input type="password" name="password" class="form-control" autocomplete="off" placeholder="Lozinka" size="30" value="" required/>
      </div>
      <div class="form-group">
        <input type="password" name="password-rp" class="form-control" autocomplete="off" placeholder="Potvrda lozinke" size="30" value="" required/>
      </div>
        <button type="submit" name="signup-submit" class="btn btn-primary" autocomplete="off" value="Submit">Registracija</button>
        <a class="forgotenPassword" href="#">Forgoten password?</a>
        </div>
      </form>
      <div class="alogin">

      </div>
<?php
require 'footer.php';
?>
