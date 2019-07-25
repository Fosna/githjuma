<?php require 'header.php'; ?>
<link rel="stylesheet" href="style/main.style.css">
<!-- Opis aplikacije -->
<!-- <div class="jumbotron rounded-0">
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
</div> -->
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" data-interval="3000">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" src="pics/hjuma-background1.png" alt="First slide">
      <div class="carousel-caption d-none d-md-block">
          <h1 class="text-secondary">Challenge your friends</h1>
          <a class="btn btn-primary btn-lg btn-block" id="btn_main" href="create_challenge">Create Challenge</a>
      </div>
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="pics/hjuma-background3.png" alt="Second slide">
      <div class="carousel-caption d-none d-md-block">
          <h1 class="text-secondary">Become a better coder</h1>
          <a class="btn btn-primary btn-lg btn-block" id="btn_main" href="create_challenge">Create Challenge</a>
      </div>
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="pics/hjuma-background2.png" alt="Third slide">
      <div class="carousel-caption d-none d-md-block">
          <!-- <h1 class="text-secondary">Create your team</h1> -->
          <a class="btn btn-primary btn-lg btn-block" id="btn_main" href="create_challenge">Create Challenge</a>
      </div>
    </div>
  </div>
</div>
<hr>
<!-- Opis aplikacije -->
<!-- Challenge tabovi -->
<?php require 'challengetab.php' ?>
<!-- Challenge tabovi -->
<?php require 'footer.php' ?>
