<!DOCTYPE html>
<html>
<head>
  <title class="title">Hjuma</title>
  <link rel="stylesheet" href="style/header.style.css">
  <link rel="stylesheet" href="style/search.style.css">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>

<body onload="show1();">
  <nav id="header" class="navbar fixed-top navbar-expand navbar-dark navbar-fixed-top" style="background-color: #22384F;">
    <a class="navbar-brand" href="main">Hjuma</a>
<?php
    session_start();
    require 'scr/dbh.scr.php';
    if (isset($_SESSION['id'])) {
      $username = $_SESSION["username"];
?>
      <a class="btn btn-primary btn-sm" id="btn_main" href="create_challenge" style="margin-left: 15px;">Create Challenge</a>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item dropdown">
            <a class="nav-link my-2 my-sm-0" href="">
              My challenges<span class="sr-only">(current)</span></a>
            </a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle my-2 my-sm-0" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <img src="pics/icon.png" alt="" style="width:25px;height:25px;">
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="#">Account</a>
              <a class="dropdown-item" href="#">Settings</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item btn-danger" href="scr/logout.scr.php">Log out</a>
            </div>
          </li>
      </div>

<?php
    }else {
?>
        <form action="login" class="ml-auto" method="post">
          <button id="loginbtn" class="btn btn-outline-primary" type="submit">Log in</button>
        </form>
        <form action="signup" method="post">
          <button id="loginbtn" class="btn btn-primary" type="submit">Sign up</button>
        </form>
<?php
    }
?>
  </nav>