<?php require 'header.php'; ?>
<link rel="stylesheet" href="style/signup.style.css">
<form class="main-form needs-validation" action="scr/signup.scr.php" method="post" novalidate>
  <div class="container">
    <h1><b>Sign Up</b></h1>
    <hr class="my-2">
    <div class="form-group">
      <input type="text" class="form-control" name="username" autocomplete="off" placeholder="Username" size="30" maxlength="10" autocomplete="off" required/>
      <small class="form-text text-muted">Max characters are 10</small>
      <div class="invalid-feedback">
        This field can not be empty!
      </div>
    </div>
    <div class="form-group">
        <input type="email" name="email" class="form-control" autocomplete="off" placeholder="Email" size="30" required/>
        <div class="invalid-feedback">
            Use a valid email!
        </div>
    </div>
    <div class="row">
        <div class="col">
          <div class="form-group">
            <input type="password" class="form-control" name="password" placeholder="Password" required>
            <div class="invalid-feedback">
                This field can not be empty!
            </div>
            <small id="passwordHelp" class="form-text text-muted">We'll never share your password with anyone else!</small>
          </div>
        </div>
        <div class="col">
          <div class="form-group">
            <input type="password" class="form-control" name="password-rp" placeholder="Confirm your password" required>
            <div class="invalid-feedback">
                This field can not be empty!
            </div>
          </div>
        </div>
    </div>
    <div class="custom-control custom-checkbox" style="margin-bottom: 15px;">
      <input type="checkbox" class="custom-control-input" id="privacy">
      <label class="custom-control-label" for="privacy">Privacy Policy</label>
    </div>
    <button type="submit" class="btn btn-primary btn-block btn-lg" name="signup-submit">Sign Up</button>
    <a href="login" class="login-link">Log In</a>
<?php
  if (isset($_GET['error'])) {
    $error = $_GET['error'];
    if ($error == "email") {
      echo '<div class="alert alert-danger" role="alert">Email is not existing!</div>';
    }
    elseif ($error == "empty") {
      echo '<div class="alert alert-danger" role="alert">You must fill all fields</div>';
    }
    elseif ($error == "pwd") {
      echo '<div class="alert alert-danger" role="alert">Passwords are not matching!</div>';
    }
    elseif ($error == "nouser") {
      echo '<div class="alert alert-danger" role="alert">There is no user like that!</div>';
    }
    elseif ($error == "username") {
      echo '<div class="alert alert-danger" role="alert">Use different characters for username!</div>';
    }
    elseif ($error == "maxchar") {
      echo '<div class="alert alert-danger" role="alert">Naughty boy you are using too many characters!</div>';
    }
  }
?>
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
<?php require 'footer.php'; ?>
