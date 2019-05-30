<?php require 'header.php'; ?>
<title>Hjuma</title>
<link rel="stylesheet" href="style/login_signup.style.css">
<link rel="stylesheet" href="style/includes/error.inc.css">
<style>

</style>
<form class="content" action="scr/login.scr.php" method="post">
  <div class="container">
  <h1 style="text-align: center; padding: 60px;">Login</h1>
  <hr class="my-2">
  <div class="form-group">
  Username:
    <input type="text" name="username"  class="form-control"  value="" required>
  </div>
 
  <div class="form-group">
  Password:
    <input type="password" name="password"  class="form-control" autocomplete="off" value="" required>
  </div>
  <button type="submit" class="btn btn-primary btn-block" name="login-submit">Login</button>
  <!-- <input type="checkbox"  name="remember">Remember me<br> -->
  <!-- <a class="forgotenPassword" href="#">Forgoten password?</a> -->
  </div>

</form>
<?php
  if (isset($_GET['error'])) {
    $error = $_GET['error'];
    if ($error == "invalidusernameandmail") {
      echo '<div class="error">Username and password are incorrect!</div>';
    }
    elseif ($error == "invalidemail") {
      echo '<div class="error">E-mail is incorrect!</div>';
    }
    elseif ($error == "invalidusername") {
      echo '<div class="error">Use different characters!</div>';
    }
    elseif ($error == "passwordcheck") {
      echo '<div class="error">Passwords are not matching!</div>';
    }
    elseif ($error == "pwd") {
      echo '<div class="error">Password is incorrect!</div>';
    }
    elseif ($error == "nouser") {
      echo '<div class="error">There is no user like that!</div>';
    }
  }
?>

