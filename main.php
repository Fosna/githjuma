<?php require 'header.php'; ?>
<link rel="stylesheet" href="style/main.style.css">
<?php
if (!isset($_SESSION['id'])) {
  header("Location: hjuma");
}
?>
<!-- Opis aplikacije -->
 <div class="jumbotron rounded-0">
    <h1 class="display-3"><b>Code Your Way</b></h1>
    <p class="lead">
    </p>
    <p class="lead">
        <div class="form-check form-check-inline">
           <a class="btn btn-primary btn-lg" id="btn_main" href="create_challenge">Create Challenge</a>
        </div>
    </p>
</div>
<!--<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" data-interval="3000">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" src="pics/1.jpg" alt="First slide">
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
          <a class="btn btn-primary btn-lg btn-block" id="btn_main" href="create_challenge">Create Challenge</a>
      </div>
    </div>
  </div>
</div>-->
<!-- Opis aplikacije -->
<h1 class="pop-challenges">Popular Challenges</h1>
<!-- Challenge tabovi -->
<?php require 'challengetab.php' ?>
<!-- Challenge tabovi -->
<?php require 'footer.php' ?>
