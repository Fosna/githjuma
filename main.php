<?php require 'header.php'; ?>
<link rel="stylesheet" href="style/main.style.css">
<!-- Opis aplikacije -->
<div class="jumbotron rounded-0">
    <h1 class="display-4">Code Your Way</h1>
    <p class="lead">
        <code>
            $ Challenge your friends
            <br>
            $ Become a better coder
            <br>
            $ Create your team
        </code>
    </p>
    <hr class="my-6">
    <p class="lead">
        <div class="form-check form-check-inline">
           <a class="btn btn-primary btn-lg" id="btn_main" href="create_challenge">Create Challenge</a>
        </div>
    </p>
</div>
<!-- Opis aplikacije -->
<!-- Challenge tabovi -->
<?php require 'challengetab.php' ?>
<!-- Challenge tabovi -->
<?php require 'footer.php' ?>
