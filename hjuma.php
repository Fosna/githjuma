<!DOCTYPE html>
<html>
<head>
  <title class="title">hjuma</title>
  <link rel="stylesheet" href="style/header.style.css">
  <link rel="stylesheet" href="style/hjuma.style.css">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="pics/favicon.ico" type="image/icon type">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
  <script src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.2/modernizr.js"></script>
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
 <script type="text/javascript">
  $(window).load(function() {
      $(".se-pre-con").fadeOut("");
    });
  </script>
</head>
<body>
  <div class="se-pre-con"></div>
  <nav class="navbar fixed-top navbar-expand-lg bg-transparent">
    <a class="navbar-brand margin-left" href="main"><b>hjuma</b></a>
    <!-- <form action="search_challenges" class="form-inline my-2 my-lg-0" style="margin-left: 15px;" method="post">
      <input name="search_challenge" class="form-control mr-sm-2 search_input" type="search" placeholder="Search challenges..." aria-label="Search" autocomplete="off">
      <button name="search_challenge-submit" class="btn btn-outline-primary my-2 my-sm-0" type="submit">Search</button>
    </form> -->
    
<?php
    error_reporting(0);
    session_start();
    require 'scr/dbh.scr.php';
    require_once 'vendor/autoload.php';
    if (!isset($_SESSION['id'])) {
?>
        <button class="btn btn-link ml-auto wih">What is Hjuma?</button>
        <a href="login" id="loginbtn" class="btn btn-outline-primary margin-right">Log In</a>
<?php
    }
?>
  </nav>
  <div class="header_space"></div>
  <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
  <script type="text/javascript">
    $(function() {
      var header = $(".navbar");
      $(window).scroll(function() {
          var scroll = $(window).scrollTop();

          if (scroll >= 10) {
              header.removeClass('bg-transparent').addClass("bg-light");
          } else {
              header.removeClass("bg-light").addClass('bg-transparent');
          }
      });
    });
  </script>
  <h1 class="main-text">Code all day long against <br> your best friends!</h1>
  <div>
    <img id="img" src="pics/pic.png" class="img-fluid" alt="Responsive image">
    <div>
  <div class="container">
  </div>
</body>
</html>