<?php require 'header.php'; ?>
<link rel="stylesheet" href="style/main.style.css">
<div class="header_space"></div>
<!-- Opis aplikacije -->
<div class="jumbotron">
    <h1 class="display-4">Code Wars!</h1>
    <p class="lead">Challange your friends! Make Friends! Become a better coder!</p>
    <hr class="my-4">
    <p class="lead">
        <div class="form-check form-check-inline">
           <a class="btn btn-primary btn-lg" id="btn_main" href="create_challenge">Create Challenge</a>
<?php
        if (!isset($_SESSION['id'])) {
?>
           <div class="btn-group" role="group" aria-label="Basic example">
                <a class="btn btn-outline-secondary btn-lg" id="btn_main" href="login" style="margin-left: 15px;">Log in</a>
                <a class="btn btn-outline-secondary btn-lg" id="btn_main" href="signup">Sign Up</a>
           </div>
<?php
        }
?>
        </div>
    </p>
</div>
<!-- Opis aplikacije -->
<h1>ovaj jumbotron background ili drugi (slika u folderu pics)-Ian</h1>
</body>
</html>