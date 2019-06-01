<?php require 'header.php'; ?>
<link rel="stylesheet" href="style/main.style.css">
<div class="header_space"></div>
<!-- Opis aplikacije -->
<div class="jumbotron">
    <h1 class="display-4">Code Wars!</h1>
    <p class="lead">Challange your friends! Make Friends! Become a better coder!</p>
    <hr class="my-4">
    <p class="lead">
        <a class="btn btn-primary btn-lg" id="btn_main" href="create_challenge">Create Challenge</a>
<?php
        if (!isset($_SESSION['id'])) {
?>
        <a class="btn btn-outline-secondary btn-lg" id="btn_main" href="login">Log in</a>
<?php
        }
?>
    </p>
</div>
<!-- Opis aplikacije -->
</body>
</html>