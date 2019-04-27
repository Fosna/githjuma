<?php require'header.php'; ?>
<title>Hjuma</title>
<link rel="stylesheet" href="style/login.style.css">
<link rel="stylesheet" href="style/includes/error.inc.css">
<form class="content" action="scr/login.scr.php" method="post">

  <h1>Prijava</h1>

  <div class="container">
    <input type="text" name="username" placeholder="Korisničko ime" value="" required>
    <input type="password" name="password" autocomplete="off" placeholder="Lozinka" value="" required>
    <button type="submit" class="submit" name="login-submit">Prijava</button>
    <a class="forgotenPassword" href="#">Forgoten password?</a>
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
<?php require 'footer.php'; ?>
