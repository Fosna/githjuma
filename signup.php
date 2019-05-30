<!DOCTYPE html>
<html>
  <head>
  <?php require 'header.php'; ?>
    <title>Hjuma</title>
    <link rel="stylesheet" href="style/login_signup.style.css">
  </head>
  <body>
 
      <form class="content" action="scr/signup.scr.php" method="post">
<div class="container">
        <h1 style="text-align: center; padding: 60px;">Sign up</h1>
        <hr class="my-2">

        <?php
          if (isset($_GET['username'])) {
            $username = $_GET['username'];
            echo '<input type="text" class="form-control" name="username" autocomplete="off" placeholder="Korisničko ime" size="30" value="'.$username.'" required/>';
          }
          else {
            echo '
            <div class="form-group">
            Username:
            <input type="text" name="username" class="form-control" autocomplete="off" placeholder="" size="30" value="" required/>
            </div>';
          }
          if (isset($_GET['email'])) {
            $email = $_GET['email'];
            echo '
            <div class="form-group">
            E-mail:
            <input type="text" name="email" class="form-control" autocomplete="off" placeholder="" size="30" value="'.$email.'" required/>
            </div>';
          }
          else {
            echo '
            <div class="form-group">
            E-mail:
            <input type="text" name="email"class="form-control" autocomplete="off" placeholder="" size="30" value="" required/>
            </div>
            ';
          }
        ?>
        <div class="form-group">
        Password:
        <input type="password" name="password" class="form-control" autocomplete="off" placeholder="" size="30" value="" required/>
      </div>
      <div class="form-group">
      Confirm password:
        <input type="password" name="password-rp" class="form-control" autocomplete="off" placeholder="" size="30" value="" required/>
      </div>
        <button type="submit" name="signup-submit" class="btn btn-success btn-block" autocomplete="off" value="Submit">Sign up</button>
        </div>
      </form>
      <div class="alogin">

      </div>
