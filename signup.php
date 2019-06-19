<?php require 'header.php'; ?>
<link rel="stylesheet" href="style/signup.style.css">
<form class="main-form needs-validation" action="scr/signup.scr.php" method="post" novalidate>
  <div class="container">
    <h1>Sign up</h1>
    <hr class="my-2">
    <div class="form-group">
      <input type="text" class="form-control" name="username" autocomplete="off" placeholder="Username" size="30" required/>
      <div class="invalid-feedback">
        This field can not be empty!
      </div>
    </div>
    <div class="form-group">
        <input type="text" name="email" class="form-control" autocomplete="off" placeholder="Email" size="30" required/>
        <div class="invalid-feedback">
            This field can not be empty!
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
    <div class="checkbox mb-3">
    <label>
      <input type="checkbox" value="remember-me"> Privacy policy i ta sranja
    </label>
  </div>
    <button type="submit" class="btn btn-success btn-block" name="signup-submit">Sign up</button>
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
