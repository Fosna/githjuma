<?php require 'header.php'; ?>
<link rel="stylesheet" href="style/login.style.css">
<form class="form-signin" action="scr/login.scr.php" method="post">
  <div class="text-center mb-4">
    <h1 class="h1 font-weight-normal">Log In</h1>
  </div>

  <div class="form-label-group">
    <input type="text" id="inputUsername" name="username" class="form-control" placeholder="Username" required autofocus>
    <label for="inputUsername">Username</label>
  </div>

  <div class="form-label-group">
    <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
    <label for="inputPassword">Password</label>
  </div>

  <div class="checkbox mb-3">
    <label>
      <input type="checkbox" value="remember-me"> Remember me
    </label>
  </div>
  <button class="btn btn-lg btn-success btn-block" name="login-submit" type="submit">Log In</button>
  <a href="signup" class="signup-link">Sign Up</a>
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
</form>
</body>
</html>