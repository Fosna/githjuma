<?php require'header.php'; ?>
<title>Hjuma</title>
<link rel="stylesheet" href="style/login.style.css">
<form class="content" action="scr/login.scr.php" method="post">

  <h1>Prijava</h1>

  <div class="container">
    <input type="text" name="username" placeholder="Korisničko ime" value="" required>
    <input type="password" name="password" autocomplete="off" placeholder="Lozinka" value="" required>
    <button type="submit" name="login-submit">Prijava</button>
  </div>

</form>
<?php
  if (isset($_GET['error'])) {
    $error = $_GET['error'];
    if ($error == "invalidusernameandmail") {
      echo '<div class="error">Korisničko ime i E-mail je pogrešno!</div>';
    }
    elseif ($error == "invalidemail") {
      echo '<div class="error">E-mail je pogrešan!</div>';
    }
    elseif ($error == "invalidusername") {
      echo '<div class="error">Slova su nevažeća!</div>';
    }
    elseif ($error == "passwordcheck") {
      echo '<div class="error">Lozinke se ne poklapaju!</div>';
    }
    elseif ($error == "pwd") {
      echo '<div class="error">Lozinka je pogrešna!</div>';
    }
    elseif ($error == "nouser") {
      echo '<div class="error">Takav korisnik ne postoji!</div>';
    }
  }
?>
<?php require 'footer.php'; ?>
