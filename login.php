<?php require 'header.php'; ?>
<title>Hjuma</title>
<link rel="stylesheet" href="style/login_signup.style.css">
<link rel="stylesheet" href="style/login.style.css">
<link rel="stylesheet" href="style/includes/error.inc.css">
<style>
 
</style>
<form class="main-form needs-validation" action="scr/login.scr.php" method="post" novalidate>
  <div class="container">
    <h1>Login</h1>
    <hr class="my-2">
    <div class="form-group">
      <label for="username">Username</label>
      <input type="text" class="form-control" name="username" aria-describedby="username" placeholder="Enter your username" required>
      <div class="invalid-feedback">
        This field can't be empty!
      </div>
    </div>
    <div class="form-group">
      <label for="password">Password</label>
      <input type="password" class="form-control" name="password" placeholder="Enter your password" required>
      <div class="invalid-feedback">
        This field can't be empty!
      </div>
    </div>
    <button type="submit" class="btn btn-success btn-block" name="login-submit">Login</button>
    <!-- <input type="checkbox"  name="remember">Remember me<br> -->
    <!-- <a class="forgotenPassword" href="#">Forgoten password?</a> -->
  </div>
</form>
<script type="text/javascript">
    var form = document.querySelector('.needs-validation');

    form.addEventListener('submit', function(event){
        if (form.checkValidity() === false){
            event.preventDefault();
            event.stopPropagation();
        }
        form.classList.add('was-validated');
    });
</script>
<?php
  if (isset($_GET['error'])) {
    $error = $_GET['error'];
    if ($error == "invalidusernameandmail") {
      echo '<div class="error">Username and password are incorrect!</div>';
    }
    elseif ($error == "empty") {
      echo '<div class="error">You must fill all fields</div>';
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

