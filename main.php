<?php require 'header.php'; ?>
<link rel="stylesheet" href="style/main.style.css">
<div class="header_space"></div>
<!-- Opis aplikacije -->
<div class="jumbotron">
    <h1 class="display-4">Code Wars!</h1>
    <p class="lead">Challange your friends! Make Friends! Become a better coder!</p>
    <hr class="my-4">
<?php
    error_reporting(0);
    if (!isset($_SESSION['id'])) {
      error_reporting(0);
?>
      <p class="lead">
        <a class="btn btn-primary btn-lg" id="btn_main" href="create_challenge">Create Challenge</a>
        <a class="btn btn-outline-secondary btn-lg" id="btn_main" href="login">Log in</a>
      </p>
<?php
    }else{
?>
        <p class="lead">
            <div class="btn-group" role="group" aria-label="main_btns">
                <a class="btn btn-primary btn-lg" id="btn_main" href="create_challenge">Create Challenge</a>
            </div>
        </p>
<?php
    }
?>
</div>
<!-- Opis aplikacije -->
</body>
</html>