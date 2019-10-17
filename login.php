<?php require 'header.php'; ?>
<link rel="stylesheet" href="style/login.style.css">
<form class="form-signin" action="scr/login.scr.php" method="post">
  <div class="text-center mb-4">
    <h3 class="h1 font-weight-normal"><b>Log In or Sign Up</b></h3>
  </div>
  <a href="signup" class="btn btn-lg btn-outline-secondary btn-block">Sign Up</a>
  <hr>
  <div class="form-label-group">
    <input type="text" id="inputUsername" name="username" class="form-control" placeholder="Username" value="<?php echo $_SESSION['remember_username']; ?>" required autofocus>
    <label for="inputUsername">Username</label>
  </div>

  <div class="form-label-group">
    <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" value="<?php echo $_SESSION['remember_password']; ?>" required>
    <label for="inputPassword">Password</label>
  </div>

  <div class="custom-control custom-checkbox" style="margin-bottom: 15px;">
    <input type="checkbox" class="custom-control-input" id="rememberme" name="rememberme">
    <label class="custom-control-label" for="rememberme">Remember me</label>
  </div>

  <button class="btn btn-lg btn-primary btn-block" name="login-submit" type="submit">Log In</button>
  <div class="form-label-group">
  <?php
  if (isset($_GET['error'])) {
    $error = $_GET['error'];
    if ($error == "invalidusernameandmail") {
      echo '<div class="alert alert-danger" role="alert">Username and password are incorrect!</div>';
    }
    elseif ($error == "empty") {
      echo '<div class="alert alert-danger" role="alert">You must fill all fields</div>';
    }
    elseif ($error == "pwd") {
      echo '<div class="alert alert-danger" role="alert">Password is incorrect!</div>';
    }
    elseif ($error == "nouser") {
      echo '<div class="alert alert-danger" role="alert">There is no user like that!</div>';
    }
  }
  //require 'footer.php';
?>
  </div>
  <div class="alert alert-warning alert-dismissible fade show" role="alert">
    <a class="alert-link">Log in</a> for for using an application!
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
</form>
</body>
</html>
