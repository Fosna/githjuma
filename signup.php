<?php require 'header.php'; ?>
<link rel="stylesheet" href="style/login_signup.style.css">
<link rel="stylesheet" href="style/signup.style.css">
<form class="content" action="scr/signup.scr.php" method="post">
  <div class="container">
    <h1>Sign up</h1>
    <hr class="my-2">
    <?php
    if (isset($_GET['username'])) {
      $username = $_GET['username'];
      echo '
      <div class="form-group">
      <label for="username">Username:</label>
      <input type="text" class="form-control" name="username" autocomplete="off" placeholder="Enter your username" size="30" value="'.$username.'" required/>
      </div>';
    }
    else {
      echo '
      <div class="form-group">
      <label for="username">Username:</label>
      <input type="text" name="username" class="form-control" autocomplete="off" placeholder="Enter your username" size="30" value="" required/>
      </div>';
    }
    if (isset($_GET['email'])) {
      $email = $_GET['email'];
      echo '
      <div class="form-group">
      <label for="email">Email:</label>
      <input type="text" name="email" class="form-control" autocomplete="off" placeholder="Enter your email" size="30" value="'.$email.'" required/>
      </div>';
    }
    else {
      echo '
      <div class="form-group">
      <label for="email">Email:</label>
      <input type="text" name="email"class="form-control" autocomplete="off" placeholder="Enter your email" size="30" value="" required/>
      </div>';
    }
  ?>
    <div class="form-group">
      <label for="password">Password:</label>
      <input type="password" class="form-control" name="password" placeholder="Enter your password">
      <small id="passwordHelp" class="form-text text-muted">We'll never share your password with anyone else!</small>
    </div>
    <div class="form-group">
      <label for="password">Confirm password:</label>
      <input type="password" class="form-control" name="password-rp" placeholder="Confirm your password">
    </div>
    <button type="submit" class="btn btn-success btn-block" name="signup-submit">Sign up</button>
  </div>
</form>